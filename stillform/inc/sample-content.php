<?php
function stillform_admin_menu(){ add_theme_page(__('Stillform setup','stillform'),__('Stillform setup','stillform'),'edit_theme_options','stillform-setup','stillform_setup_page'); }
add_action('admin_menu','stillform_admin_menu');
function stillform_setup_page(){
 if(!current_user_can('edit_theme_options')) return;
 if(isset($_POST['stillform_seed']) && check_admin_referer('stillform_seed_action')){
  $pages=[
   'Home'=><<<'HTML'
<!-- wp:heading {"level":1,"fontSize":"x-large"} --><h1 class="wp-block-heading has-x-large-font-size">Space, held in balance.</h1><!-- /wp:heading --><!-- wp:paragraph {"fontSize":"large"} --><p class="has-large-font-size">Stillform is an architecture and interior studio shaping quiet, lasting places.</p><!-- /wp:paragraph -->
HTML,
   'Studio'=><<<'HTML'
<!-- wp:heading {"level":1} --><h1 class="wp-block-heading">Studio</h1><!-- /wp:heading --><!-- wp:paragraph --><p>We work between architecture, interiors and objects, pairing exacting detail with an instinct for atmosphere.</p><!-- /wp:paragraph --><!-- wp:quote --><blockquote class="wp-block-quote"><p>Reduce until every remaining gesture carries meaning.</p></blockquote><!-- /wp:quote -->
HTML,
   'Projects'=><<<'HTML'
<!-- wp:heading {"level":1} --><h1 class="wp-block-heading">Selected projects</h1><!-- /wp:heading --><!-- wp:columns --><div class="wp-block-columns"><!-- wp:column --><div class="wp-block-column"><!-- wp:heading {"level":3} --><h3 class="wp-block-heading">Courtyard House</h3><!-- /wp:heading --><!-- wp:paragraph --><p>Residential · 2026</p><!-- /wp:paragraph --></div><!-- /wp:column --><!-- wp:column --><div class="wp-block-column"><!-- wp:heading {"level":3} --><h3 class="wp-block-heading">Ochre Rooms</h3><!-- /wp:heading --><!-- wp:paragraph --><p>Hospitality · 2025</p><!-- /wp:paragraph --></div><!-- /wp:column --></div><!-- /wp:columns -->
HTML,
   'Journal'=><<<'HTML'
<!-- wp:heading {"level":1} --><h1 class="wp-block-heading">Journal</h1><!-- /wp:heading --><!-- wp:paragraph --><p>Notes on material, proportion and the spaces between things.</p><!-- /wp:paragraph --><!-- wp:latest-posts {"displayPostDate":true} /-->
HTML,
   'Contact'=><<<'HTML'
<!-- wp:heading {"level":1} --><h1 class="wp-block-heading">Begin a conversation</h1><!-- /wp:heading --><!-- wp:paragraph {"fontSize":"large"} --><p class="has-large-font-size">For commissions, collaborations and press, write to studio@example.com.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p>This theme intentionally does not simulate form submission. Replace this address or connect your preferred form plugin.</p><!-- /wp:paragraph -->
HTML
  ];
  $ids=[];
  foreach($pages as $title=>$content){
   $query=new WP_Query(['post_type'=>'page','post_status'=>'any','title'=>$title,'posts_per_page'=>1,'no_found_rows'=>true]);
   $existing=$query->have_posts() ? $query->posts[0] : null;
   $ids[$title]=$existing ? $existing->ID : wp_insert_post(['post_title'=>$title,'post_content'=>$content,'post_status'=>'publish','post_type'=>'page']);
  }
  if(!is_wp_error($ids['Home'])){ update_option('show_on_front','page'); update_option('page_on_front',$ids['Home']); }
  echo '<div class="notice notice-success"><p>'.esc_html__('Sample pages created. Existing same-title pages were preserved.','stillform').'</p></div>';
 }
 ?>
 <div class="wrap"><h1><?php esc_html_e('Stillform sample content','stillform'); ?></h1><p><?php esc_html_e('Optional: create five starter pages. Nothing runs on activation and existing same-title pages are not overwritten.','stillform'); ?></p><form method="post"><?php wp_nonce_field('stillform_seed_action'); ?><button class="button button-primary" name="stillform_seed" value="1"><?php esc_html_e('Create sample pages','stillform'); ?></button></form></div>
 <?php
}
