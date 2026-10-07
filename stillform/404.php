<?php get_header(); ?>
<main id="main" class="error-page site-shell"><p class="eyebrow">404 — <?php esc_html_e('Lost in space', 'stillform'); ?></p><h1><?php esc_html_e('This room does not exist.', 'stillform'); ?></h1><p><?php esc_html_e('Return to the studio or continue through our selected projects.', 'stillform'); ?></p><a class="arrow-link" href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Return home', 'stillform'); ?> <span>↗</span></a></main>
<?php get_footer(); ?>
