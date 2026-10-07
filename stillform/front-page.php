<?php
get_header();
$projects = new WP_Query(['post_type' => 'project', 'posts_per_page' => 4, 'orderby' => ['menu_order' => 'ASC', 'date' => 'DESC']]);
$journal = new WP_Query(['post_type' => 'post', 'posts_per_page' => 3]);
?>
<main id="main">
<section class="home-hero">
    <div class="site-shell home-hero__grid">
        <div class="home-hero__copy reveal">
            <p class="eyebrow"><?php esc_html_e('Architecture / Interiors / Objects', 'stillform'); ?></p>
            <h1><?php esc_html_e('Spaces for', 'stillform'); ?><br><em><?php esc_html_e('slower living.', 'stillform'); ?></em></h1>
            <p class="home-hero__intro"><?php esc_html_e('Stillform is a fictional architectural practice exploring proportion, material and the everyday rituals that give places meaning.', 'stillform'); ?></p>
            <a class="arrow-link" href="<?php echo esc_url(get_post_type_archive_link('project')); ?>"><?php esc_html_e('View selected work', 'stillform'); ?><span>↗</span></a>
        </div>
        <figure class="home-hero__image image-reveal">
            <?php if (has_post_thumbnail(get_queried_object_id())) echo get_the_post_thumbnail(get_queried_object_id(), 'stillform-hero'); ?>
            <figcaption><span>01</span><?php esc_html_e('Light, material, silence', 'stillform'); ?></figcaption>
        </figure>
    </div>
</section>
<section class="home-statement">
    <div class="site-shell home-statement__grid">
        <p class="eyebrow">01 — <?php esc_html_e('Point of view', 'stillform'); ?></p>
        <h2><?php esc_html_e('We believe rooms should reveal themselves slowly—through changing light, tactile surfaces and a quiet economy of means.', 'stillform'); ?></h2>
    </div>
</section>
<?php if ($projects->have_posts()) : ?>
<section class="home-projects">
    <div class="site-shell">
        <header class="section-title"><p class="eyebrow">02 — <?php esc_html_e('Selected work', 'stillform'); ?></p><h2><?php esc_html_e('Built around the life within.', 'stillform'); ?></h2><a class="arrow-link" href="<?php echo esc_url(get_post_type_archive_link('project')); ?>"><?php esc_html_e('All projects', 'stillform'); ?><span>↗</span></a></header>
        <div class="project-grid">
        <?php $i = 0; while ($projects->have_posts()) : $projects->the_post(); stillform_project_card(get_the_ID(), $i++); endwhile; wp_reset_postdata(); ?>
        </div>
    </div>
</section>
<?php endif; ?>
<section class="home-process">
    <div class="site-shell home-process__grid">
        <div class="home-process__image image-reveal"><img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/architecture/studio-table.jpg'); ?>" alt="<?php esc_attr_e('Architectural studio table with material samples', 'stillform'); ?>" loading="lazy"></div>
        <div class="home-process__copy reveal"><p class="eyebrow">03 — <?php esc_html_e('How we work', 'stillform'); ?></p><h2><?php esc_html_e('Measured, collaborative, exact.', 'stillform'); ?></h2><p><?php esc_html_e('Every project begins with careful observation. We listen for what the site, the existing fabric and the people who will inhabit it are already saying. From there, we edit until each gesture earns its place.', 'stillform'); ?></p><a class="arrow-link" href="<?php echo esc_url(home_url('/studio/')); ?>"><?php esc_html_e('Meet the studio', 'stillform'); ?><span>↗</span></a></div>
    </div>
</section>
<?php if ($journal->have_posts()) : ?>
<section class="home-journal"><div class="site-shell"><header class="section-title section-title--compact"><p class="eyebrow">04 — <?php esc_html_e('Field notes', 'stillform'); ?></p><h2><?php esc_html_e('Journal', 'stillform'); ?></h2></header><div class="journal-preview">
<?php while ($journal->have_posts()) : $journal->the_post(); ?><article><a class="journal-preview__image image-reveal" href="<?php the_permalink(); ?>"><?php the_post_thumbnail('large'); ?></a><p class="eyebrow"><?php echo esc_html(get_the_date('d.m.Y')); ?></p><h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3><p><?php echo esc_html(wp_trim_words(get_the_excerpt(), 20)); ?></p></article><?php endwhile; wp_reset_postdata(); ?>
</div><a class="arrow-link journal-all" href="<?php echo esc_url(home_url('/journal/')); ?>"><?php esc_html_e('Read the journal', 'stillform'); ?><span>↗</span></a></div></section>
<?php endif; ?>
<?php while (have_posts()) : the_post(); if (trim(get_the_content())) : ?><section class="home-editorial site-shell entry-content"><?php the_content(); ?></section><?php endif; endwhile; ?>
</main>
<?php get_footer(); ?>
