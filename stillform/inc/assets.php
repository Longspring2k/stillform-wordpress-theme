<?php
function stillform_assets() {
 $v=wp_get_theme()->get('Version');
 wp_enqueue_style('stillform-style', get_stylesheet_uri(), [], $v);
 wp_enqueue_style('stillform-global', get_template_directory_uri().'/assets/css/global.css', ['stillform-style'], $v);
 wp_enqueue_script('stillform-site', get_template_directory_uri().'/assets/js/site.js', [], $v, true);
}
add_action('wp_enqueue_scripts','stillform_assets');
