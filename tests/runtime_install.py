"""Verify a fresh Docker database using the exact unpacked release ZIP."""
import subprocess, json, urllib.request
from pathlib import Path
ROOT=Path(__file__).resolve().parents[1]
secret=dict(x.split('=',1) for x in (ROOT/'.env').read_text().splitlines())
BASE=['docker','compose','-f',str(ROOT/'tests/compose-package.yaml'),'--env-file',str(ROOT/'.env'),'run','--rm','cli','wp']
def wp(*args):
    r=subprocess.run(BASE+list(args),capture_output=True,text=True,encoding='utf-8',errors='replace')
    out=r.stdout+'\n'+r.stderr
    for value in secret.values(): out=out.replace(value,'[REDACTED]')
    if r.returncode: raise RuntimeError(out)
    print(r.stdout.strip())
    return r.stdout.strip()
if subprocess.run(BASE+['core','is-installed'],capture_output=True).returncode:
    wp('core','install','--url=http://127.0.0.1:8098','--title=Stillform','--admin_user=stillform_local','--admin_password='+secret['WP_ADMIN_PASSWORD'],'--admin_email=local@example.test','--skip-email')
wp('option','update','permalink_structure','/%postname%/')
wp('post','update','1','--post_status=draft')
before=wp('post','list','--post_type=page,post,project','--format=count')
wp('theme','activate','stillform')
after=wp('post','list','--post_type=page,post,project','--format=count')
assert before==after, 'Activation mutated content'
wp('eval-file','/workspace/setup-demo.php','--user=stillform_local')
first=wp('post','list','--post_type=page,post,project,attachment','--format=count')
wp('eval-file','/workspace/setup-demo.php','--user=stillform_local')
second=wp('post','list','--post_type=page,post,project,attachment','--format=count')
assert first==second,'Installer duplicated content'
wp('rewrite','flush','--hard')
counts=json.loads(wp('eval',"echo json_encode(['pages'=>count(get_posts(['post_type'=>'page','meta_key'=>'_stillform_demo_owner','meta_value'=>STILLFORM_DEMO_OWNER,'numberposts'=>-1])),'projects'=>(int)wp_count_posts('project')->publish,'posts'=>(int)wp_count_posts('post')->publish,'images'=>count(get_posts(['post_type'=>'attachment','post_status'=>'inherit','meta_key'=>'_stillform_demo_owner','meta_value'=>STILLFORM_DEMO_OWNER,'numberposts'=>-1]))]);"))
assert counts=={'pages':5,'projects':4,'posts':3,'images':8},counts
# Verify native content edits appear then restore the precise prior value.
wp('eval',"$p=get_page_by_path('studio');update_option('stillform_qa_original',$p->post_content);wp_update_post(['ID'=>$p->ID,'post_content'=>$p->post_content.'<p>EDITOR_RENDER_PROBE_731</p>']);")
try:
    assert 'EDITOR_RENDER_PROBE_731' in urllib.request.urlopen('http://127.0.0.1:8098/studio/').read().decode()
finally:
    wp('eval',"$p=get_page_by_path('studio');wp_update_post(['ID'=>$p->ID,'post_content'=>get_option('stillform_qa_original')]);delete_option('stillform_qa_original');")
wp('theme','mod','set','stillform_contact_email','qa@example.test')
try:
    for path in ['', 'contact/']:
        assert 'mailto:qa@example.test' in urllib.request.urlopen('http://127.0.0.1:8098/'+path).read().decode()
finally: wp('theme','mod','remove','stillform_contact_email')
# A non-owned conflict must retain its content after another import.
wp('eval',"$p=get_page_by_path('studio');delete_post_meta($p->ID,'_stillform_demo_owner');update_option('stillform_qa_hash',hash('sha256',$p->post_content));")
try:
    wp('eval-file','/workspace/setup-demo.php','--user=stillform_local')
    assert wp('eval',"$p=get_page_by_path('studio');echo hash('sha256',$p->post_content)===get_option('stillform_qa_hash')?'preserved':'MODIFIED';")=='preserved'
finally:
    wp('eval',"$p=get_page_by_path('studio');update_post_meta($p->ID,'_stillform_demo_owner',STILLFORM_DEMO_OWNER);delete_option('stillform_qa_hash');")
wp('eval-file','/workspace/setup-demo.php','--user=stillform_local')
report={'activation_preserves_content':True,'installer_idempotent':True,'counts':counts,'native_content_edit_renders':True,'customizer_contact_renders':True,'non_owned_conflict_preserved':True,'url':'http://127.0.0.1:8098','source':'exact release ZIP extracted into fresh Docker WordPress volume'}
(ROOT/'runtime-evidence.json').write_text(json.dumps(report,indent=2))
print(json.dumps(report,indent=2))
