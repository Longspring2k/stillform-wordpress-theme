<?php get_header(); while (have_posts()) : the_post(); ?>
<main id="main" class="single-project">
<header class="project-hero site-shell"><div><p class="eyebrow"><?php echo esc_html(stillform_project_meta()); ?></p><h1><?php the_title(); ?></h1><p class="project-deck"><?php echo esc_html(get_the_excerpt()); ?></p></div><span class="project-number"><?php echo esc_html(sprintf('%02d', max(1, get_post_field('menu_order') + 1))); ?></span></header>
<?php if (has_post_thumbnail()) : ?><figure class="project-cover image-reveal"><?php the_post_thumbnail('full'); ?></figure><?php endif; ?>
<div class="site-shell project-body"><aside class="project-facts"><div><span><?php esc_html_e('Type', 'stillform'); ?></span><strong><?php $terms = get_the_terms(get_the_ID(), 'project_type'); echo esc_html(($terms && !is_wp_error($terms)) ? $terms[0]->name : __('Architecture', 'stillform')); ?></strong></div><div><span><?php esc_html_e('Year', 'stillform'); ?></span><strong><?php echo esc_html(get_post_meta(get_the_ID(), '_stillform_year', true)); ?></strong></div><div><span><?php esc_html_e('Status', 'stillform'); ?></span><strong><?php echo esc_html(get_post_meta(get_the_ID(), '_stillform_status', true) ?: __('Concept', 'stillform')); ?></strong></div></aside><article class="entry-content project-content"><?php the_content(); ?></article></div>
<nav class="site-shell project-nav"><?php previous_post_link('%link', '← %title'); next_post_link('%link', '%title →'); ?></nav>
</main>
<?php endwhile; get_footer(); ?>
