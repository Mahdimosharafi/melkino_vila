<?php
/**
 * Front Page Template: Melkino Vila
 * Renders the homepage and converts property navigation anchors into the
 * real WordPress property archive URL.
 */
if (!defined('ABSPATH')) {
    exit;
}

ob_start();
require get_template_directory() . '/index.php';
$homepage = ob_get_clean();

$properties_url = get_post_type_archive_link('property');
if (!$properties_url) {
    $properties_url = home_url('/properties/');
}

$homepage = str_replace('href="#properties"', 'href="' . esc_url($properties_url) . '"', $homepage);
$homepage = str_replace('href="#all-properties"', 'href="' . esc_url($properties_url) . '"', $homepage);

echo $homepage;
