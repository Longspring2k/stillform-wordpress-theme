<?php
function stillform_setup() {
 load_theme_textdomain('stillform', get_template_directory() . '/languages');
 add_theme_support('title-tag'); add_theme_support('post-thumbnails'); add_theme_support('custom-logo', ['height'=>80,'width'=>240,'flex-height'=>true,'flex-width'=>true]);
 add_theme_support('html5', ['search-form','comment-form','comment-list','gallery','caption','style','script']);
 add_theme_support('align-wide'); add_theme_support('editor-styles'); add_editor_style('assets/css/editor.css');
 register_nav_menus(['primary'=>__('Primary navigation','stillform'),'footer'=>__('Footer navigation','stillform')]);
}
add_action('after_setup_theme','stillform_setup');
function stillform_excerpt_length(){ return 24; } add_filter('excerpt_length','stillform_excerpt_length');
