<?php $email = stillform_contact_email(); ?>
<footer class="site-footer">
    <div class="site-shell footer-lead">
        <p class="eyebrow"><?php esc_html_e('Start a project', 'stillform'); ?></p>
        <a class="footer-email" href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a>
    </div>
    <div class="site-shell footer-grid">
        <div class="footer-brand"><strong><?php bloginfo('name'); ?></strong><p><?php esc_html_e('Architecture, interiors and objects shaped with restraint.', 'stillform'); ?></p></div>
        <div><span class="eyebrow"><?php esc_html_e('Studio', 'stillform'); ?></span><address><?php esc_html_e('Demo studio · London / Remote', 'stillform'); ?><br><?php esc_html_e('By appointment', 'stillform'); ?></address></div>
    <div><span class="eyebrow"><?php esc_html_e('Navigate', 'stillform'); ?></span><?php if (has_nav_menu('footer')) wp_nav_menu(['theme_location' => 'footer', 'container' => false]); ?></div>
        <div><span class="eyebrow"><?php esc_html_e('Note', 'stillform'); ?></span><p><?php esc_html_e('Stillform is a fictional demonstration studio. Replace the contact address before launch.', 'stillform'); ?></p></div>
    </div>
    <div class="site-shell legal"><span>© <?php echo esc_html(wp_date('Y')); ?> <?php bloginfo('name'); ?></span><a href="#top"><?php esc_html_e('Back to top ↑', 'stillform'); ?></a></div>
</footer>
<?php wp_footer(); ?>
</body></html>
