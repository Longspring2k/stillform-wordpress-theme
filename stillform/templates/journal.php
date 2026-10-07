<?php
/* Template Name: Journal Landing */
get_header();
$paged = max(1, get_query_var('paged'));
$notes = new WP_Query(['post_type' => 'post', 'posts_per_page' => 9, 'paged' => $paged]);
while (have_posts()) : the_post(); ?>
<main id="main" class="page-main journal-landing"><header class="page-hero site-shell"><p class="eyebrow"><?php echo esc_html(stillform_page_kicker()); ?></p><h1><?php the_title(); ?></h1><div class="page-intro entry-content"><?php the_content(); ?></div></header>
<div class="site-shell journal-grid"><?php while ($notes->have_posts()) : $notes->the_post(); ?><article class="journal-card"><a class="journal-card__image image-reveal" href="<?php the_permalink(); ?>"><?php the_post_thumbnail('stillform-card'); ?></a><p class="eyebrow"><?php echo esc_html(get_the_date('d.m.Y')); ?></p><h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2><p><?php echo esc_html(wp_trim_words(get_the_excerpt(), 28)); ?></p><a class="text-link" href="<?php the_permalink(); ?>"><?php esc_html_e('Read note', 'stillform'); ?> →</a></article><?php endwhile; ?></div>
<div class="site-shell pagination"><?php echo wp_kses_post(paginate_links(['total' => $notes->max_num_pages])); ?></div><?php wp_reset_postdata(); ?>
</main>
<?php endwhile; get_footer(); ?>
