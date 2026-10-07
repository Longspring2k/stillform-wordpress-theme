<?php
/* Template Name: Contact */
get_header(); while (have_posts()) : the_post(); $email = stillform_contact_email(); ?>
<main id="main" class="page-main contact-page">
<div class="site-shell contact-grid">
    <header class="contact-heading"><p class="eyebrow"><?php echo esc_html(stillform_page_kicker()); ?></p><h1><?php the_title(); ?></h1><a class="contact-email" href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a></header>
    <figure class="contact-image image-reveal"><?php if (has_post_thumbnail()) the_post_thumbnail('stillform-hero'); ?></figure>
    <article class="entry-content contact-content"><?php the_content(); ?><div class="contact-note"><span>→</span><p><?php esc_html_e('This is a demonstration address. Change it in Appearance → Customize → Stillform contact before using the site publicly. No form submission is simulated.', 'stillform'); ?></p></div></article>
</div>
</main>
<?php endwhile; get_footer(); ?>
