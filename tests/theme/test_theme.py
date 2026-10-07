from pathlib import Path
import json, re

ROOT = Path(__file__).resolve().parents[2]
THEME = ROOT / "stillform"
SEED = ROOT / "setup-demo.php"


def text(rel):
    return (THEME / rel).read_text(encoding="utf-8")


def test_complete_native_template_set():
    required = [
        "style.css", "theme.json", "functions.php", "header.php", "footer.php",
        "front-page.php", "page.php", "single.php", "single-project.php",
        "archive.php", "archive-project.php", "index.php", "404.php",
        "templates/studio.php", "templates/projects.php", "templates/journal.php", "templates/contact.php",
        "inc/setup.php", "inc/assets.php", "inc/template-tags.php",
        "assets/css/global.css", "assets/css/front-page.css", "assets/css/page.css",
        "assets/css/archive.css", "assets/css/single.css", "assets/js/site.js",
    ]
    assert not [p for p in required if not (THEME / p).is_file()]


def test_native_hooks_and_menu_contract():
    assert "wp_head()" in text("header.php")
    assert "wp_body_open()" in text("header.php")
    assert "body_class()" in text("header.php")
    assert "wp_footer()" in text("footer.php")
    header = text("header.php")
    assert "has_nav_menu('primary')" in header
    assert 'aria-controls="primary-menu"' in header


def test_project_model_and_editable_native_content():
    setup = text("inc/setup.php")
    assert "register_post_type('project'" in setup
    assert "show_in_rest" in setup
    assert "post-thumbnails" in setup
    assert "the_content()" in text("page.php")
    assert "the_content()" in text("single.php")
    assert "the_content()" in text("single-project.php")


def test_no_remote_fonts_or_page_id_url_template_selection():
    combined = "\n".join(p.read_text(encoding="utf-8", errors="ignore") for p in THEME.rglob("*") if p.is_file())
    assert "fonts.googleapis.com" not in combined
    assert "fonts.gstatic.com" not in combined
    templates = '\n'.join(p.read_text(encoding='utf-8') for p in THEME.glob('*.php'))
    assert "get_page_by_path" not in templates
    assert not re.search(r"is_page\s*\(\s*\d+", combined)


def test_seed_is_explicit_idempotent_and_substantial():
    seed = SEED.read_text(encoding="utf-8")
    assert "defined('WP_CLI')" in seed
    assert 'stillform_install_demo_content' in seed
    seed = text('inc/sample-content.php') + text('inc/demo-data.php')
    assert "current_user_can('edit_theme_options')" in seed
    assert "check_admin_referer('stillform_install_demo')" in seed
    assert '_stillform_demo_owner' in seed and "'preserved'" in seed
    assert "wp_insert_post" in seed and "wp_update_post" in seed
    assert "stillform_register_content_types" in seed
    assert seed.count("stillform_demo_upsert('project'") >= 1
    assert len(re.findall(r"\['[a-z0-9-]+','[^']+','[^']+','(?:Residential|Hospitality|Cultural)'", seed)) >= 4
    assert seed.count("stillform_demo_upsert('post'") >= 1
    assert len(re.findall(r"\['[a-z0-9-]+','[^']+','[^']+','[^']+\.jpg','2026-", seed)) >= 3
    for title in ["Home", "Studio", "Projects", "Journal", "Contact"]:
        assert f"'{title}'" in seed
    assert "wp_set_object_terms" in seed
    assert "set_post_thumbnail" in seed
    assert "wp_update_nav_menu_item" in seed
    assert "wp_nav_menu(" not in seed


def test_seed_uses_local_licensed_photography_and_records_provenance():
    seed = text('inc/sample-content.php')
    assert "assets/images/architecture" in seed
    assert "_stillform_source_url" in seed
    assert "_stillform_license" in seed
    provenance = text("assets/images/PROVENANCE.md")
    assert provenance.count("Unsplash License") >= 8
    assert "Downloaded" in provenance


def test_theme_json_is_valid_and_has_editor_palette():
    data = json.loads(text("theme.json"))
    assert data["version"] == 3
    assert len(data["settings"]["color"]["palette"]) >= 4


def test_accessible_motion_and_contact_contract():
    css = text("assets/css/global.css")
    js = text("assets/js/site.js")
    footer = text("footer.php")
    assert "prefers-reduced-motion" in css
    assert "Escape" in js
    assert "aria-expanded" in js
    assert "mailto:" in footer
    assert "stillform_contact_email" in footer
