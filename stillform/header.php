<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link" href="#main"><?php esc_html_e('Skip to content', 'stillform'); ?></a>
<header class="site-header" data-header>
    <div class="site-shell header-inner">
        <a class="brand" href="<?php echo esc_url(home_url('/')); ?>" aria-label="<?php echo esc_attr(get_bloginfo('name')); ?>">
            <?php if (has_custom_logo()) { the_custom_logo(); } else { ?>
                <span class="brand__name"><?php bloginfo('name'); ?></span>
                <span class="brand__line"><?php echo esc_html(get_bloginfo('description')); ?></span>
            <?php } ?>
        </a>
        <button class="nav-toggle" type="button" aria-controls="primary-menu" aria-expanded="false"><span><?php esc_html_e('Menu', 'stillform'); ?></span><i aria-hidden="true"></i></button>
        <nav class="primary-nav" aria-label="<?php esc_attr_e('Primary navigation', 'stillform'); ?>">
        <?php if (has_nav_menu('primary')) {
            wp_nav_menu(['theme_location' => 'primary', 'menu_id' => 'primary-menu', 'container' => false]);
        } else { ?>
            <ul id="primary-menu"><li><a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Home', 'stillform'); ?></a></li></ul>
        <?php } ?>
        </nav>
    </div>
</header>