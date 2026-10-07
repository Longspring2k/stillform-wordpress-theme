<?php
/* Template Name: Studio */
get_header(); while (have_posts()) : the_post(); ?>
<main id="main" class="page-main page-studio">
    <header class="page-hero site-shell"><p class="eyebrow"><?php echo esc_html(stillform_page_kicker()); ?></p><h1><?php the_title(); ?></h1></header>
    <?php if (has_post_thumbnail()) : ?><figure class="page-banner image-reveal"><?php the_post_thumbnail('stillform-hero'); ?></figure><?php endif; ?>
    <div class="site-shell page-frame"><aside class="page-index"><span>01</span><p><?php esc_html_e('An independent practice for architecture, interiors and objects.', 'stillform'); ?></p></aside><article class="entry-content entry-content--wide"><?php the_content(); wp_link_pages(); ?></article></div>
</main>
<?php endwhile; get_footer(); ?>
