<?php
/** Reusable presentation helpers. */
if (!defined('ABSPATH')) { exit; }

function stillform_image($post_id, $size = 'stillform-card', $class = '') {
    if (has_post_thumbnail($post_id)) {
        echo get_the_post_thumbnail($post_id, $size, ['class' => $class, 'loading' => 'lazy']);
    }
}

function stillform_project_meta($post_id = null) {
    $post_id = $post_id ?: get_the_ID();
    $terms = get_the_terms($post_id, 'project_type');
    $type = ($terms && !is_wp_error($terms)) ? $terms[0]->name : __('Architecture', 'stillform');
    $year = get_post_meta($post_id, '_stillform_year', true) ?: get_the_date('Y', $post_id);
    return $type . ' · ' . $year;
}

function stillform_project_card($post_id, $index = 0) { ?>
    <article class="project-card <?php echo $index % 3 === 1 ? 'project-card--offset' : ''; ?>">
        <a class="project-card__image image-reveal" href="<?php echo esc_url(get_permalink($post_id)); ?>">
            <?php stillform_image($post_id, 'stillform-card'); ?>
        </a>
        <div class="project-card__meta">
            <h3><a href="<?php echo esc_url(get_permalink($post_id)); ?>"><?php echo esc_html(get_the_title($post_id)); ?></a></h3>
            <p><?php echo esc_html(stillform_project_meta($post_id)); ?></p>
        </div>
    </article>
<?php }

function stillform_page_kicker() {
    $map = ['studio' => 'Practice / People / Process', 'projects' => 'Selected work', 'journal' => 'Ideas and observations', 'contact' => 'Commissions and collaboration'];
    $slug = get_post_field('post_name', get_the_ID());
    return $map[$slug] ?? __('Stillform', 'stillform');
}
