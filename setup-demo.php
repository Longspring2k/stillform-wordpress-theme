<?php
/** WP-CLI wrapper for the installer bundled with Stillform. */
if (!defined('WP_CLI') || !WP_CLI) { exit("Run this file with WP-CLI.\n"); }
$theme = wp_get_theme('stillform');
if (!$theme->exists()) { WP_CLI::error('The Stillform theme is not installed.'); }
if (get_stylesheet() !== 'stillform') { WP_CLI::error('Activate Stillform first. This wrapper does not activate themes.'); }
if (!function_exists('stillform_install_demo_content')) { WP_CLI::error('The bundled Stillform installer is unavailable.'); }
$result = stillform_install_demo_content();
if (is_wp_error($result)) { WP_CLI::error($result->get_error_message()); }
WP_CLI::success(sprintf(
    'Stillform demo installed: %d created, %d refreshed, %d conflicts preserved, %d bundled images available.',
    $result['counts']['created'], $result['counts']['updated'], $result['counts']['preserved'], $result['media']
));