<?php
if (!defined('ABSPATH')) { exit; }
function stillform_assets() {
    $version = wp_get_theme()->get('Version');
    wp_enqueue_style('stillform-style', get_stylesheet_uri(), [], $version);
    wp_enqueue_style('stillform-global', get_template_directory_uri() . '/assets/css/global.css', ['stillform-style'], $version);
    if (is_front_page()) wp_enqueue_style('stillform-front', get_template_directory_uri() . '/assets/css/front-page.css', ['stillform-global'], $version);
    if (is_page()) wp_enqueue_style('stillform-page', get_template_directory_uri() . '/assets/css/page.css', ['stillform-global'], $version);
    if (is_archive() || is_home() || is_search()) wp_enqueue_style('stillform-archive', get_template_directory_uri() . '/assets/css/archive.css', ['stillform-global'], $version);
    if (is_singular(['post', 'project'])) wp_enqueue_style('stillform-single', get_template_directory_uri() . '/assets/css/single.css', ['stillform-global'], $version);
    wp_enqueue_script('stillform-site', get_template_directory_uri() . '/assets/js/site.js', [], $version, true);
}
add_action('wp_enqueue_scripts', 'stillform_assets');
