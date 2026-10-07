<?php
/* Template Name: Projects Landing */
get_header();
$projects = new WP_Query(['post_type' => 'project', 'posts_per_page' => -1, 'orderby' => ['menu_order' => 'ASC', 'date' => 'DESC']]);
while (have_posts()) : the_post(); ?>
<main id="main" class="page-main projects-landing">
<header class="page-hero site-shell"><p class="eyebrow"><?php echo esc_html(stillform_page_kicker()); ?></p><h1><?php the_title(); ?></h1><div class="page-intro entry-content"><?php the_content(); ?></div></header>
<div class="site-shell project-grid project-grid--archive"><?php $i = 0; while ($projects->have_posts()) : $projects->the_post(); stillform_project_card(get_the_ID(), $i++); endwhile; wp_reset_postdata(); ?></div>
</main>
<?php endwhile; get_footer(); ?>
