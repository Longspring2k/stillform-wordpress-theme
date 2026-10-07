<?php
/** Theme setup and native content model. */
if (!defined('ABSPATH')) { exit; }

function stillform_setup() {
    load_theme_textdomain('stillform', get_template_directory() . '/languages');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo', ['height' => 96, 'width' => 320, 'flex-height' => true, 'flex-width' => true]);
    add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script']);
    add_theme_support('align-wide');
    add_theme_support('responsive-embeds');
    add_theme_support('editor-styles');
    add_editor_style('assets/css/editor.css');
    register_nav_menus([
        'primary' => __('Primary navigation', 'stillform'),
        'footer'  => __('Footer navigation', 'stillform'),
    ]);
    add_image_size('stillform-hero', 1800, 1300, true);
    add_image_size('stillform-card', 1000, 1250, true);
}
add_action('after_setup_theme', 'stillform_setup');

function stillform_register_content_types() {
    register_post_type('project', [
        'labels' => [
            'name' => __('Projects', 'stillform'),
            'singular_name' => __('Project', 'stillform'),
            'add_new_item' => __('Add project', 'stillform'),
            'edit_item' => __('Edit project', 'stillform'),
        ],
        'public' => true,
        'has_archive' => true,
        'rewrite' => ['slug' => 'projects', 'with_front' => false],
        'show_in_rest' => true,
        'menu_icon' => 'dashicons-building',
        'supports' => ['title', 'editor', 'excerpt', 'thumbnail', 'revisions', 'page-attributes'],
        'taxonomies' => ['project_type'],
    ]);
    register_taxonomy('project_type', ['project'], [
        'labels' => ['name' => __('Project types', 'stillform'), 'singular_name' => __('Project type', 'stillform')],
        'public' => true,
        'show_in_rest' => true,
        'hierarchical' => true,
        'rewrite' => ['slug' => 'project-type'],
    ]);
}
add_action('init', 'stillform_register_content_types');

function stillform_excerpt_length() { return 28; }
add_filter('excerpt_length', 'stillform_excerpt_length');

function stillform_contact_email() {
    $email = sanitize_email((string) get_theme_mod('stillform_contact_email', 'studio@example.com'));
    return sanitize_email((string) apply_filters('stillform_contact_email', $email));
}

function stillform_customize_register($customizer) {
    $customizer->add_section('stillform_contact', [
        'title' => __('Stillform contact', 'stillform'),
        'priority' => 135,
    ]);
    $customizer->add_setting('stillform_contact_email', [
        'default' => 'studio@example.com',
        'sanitize_callback' => 'sanitize_email',
        'transport' => 'refresh',
    ]);
    $customizer->add_control('stillform_contact_email', [
        'section' => 'stillform_contact',
        'label' => __('Contact email address', 'stillform'),
        'description' => __('Shown as a mail link on the Contact template and in the footer. Stillform does not include a contact form.', 'stillform'),
        'type' => 'email',
    ]);
}
add_action('customize_register', 'stillform_customize_register');

function stillform_archive_project_count($query) {
    if (!is_admin() && $query->is_main_query() && is_post_type_archive('project')) {
        $query->set('posts_per_page', 12);
        $query->set('orderby', ['menu_order' => 'ASC', 'date' => 'DESC']);
    }
}
add_action('pre_get_posts', 'stillform_archive_project_count');
