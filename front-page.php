<?php
/** Front Page Template: Melkino Vila */
if (!defined('ABSPATH')) exit;

ob_start();
require get_template_directory() . '/index.php';
$homepage = ob_get_clean();

$properties_url = get_post_type_archive_link('property') ?: home_url('/properties/');
$areas_url = get_post_type_archive_link('melkino_area') ?: home_url('/areas/');
$agents_url = get_post_type_archive_link('agent') ?: home_url('/agents/');
$articles_url = get_post_type_archive_link('melkino_article') ?: home_url('/articles/');
$notices_url = get_post_type_archive_link('melkino_notice') ?: home_url('/notices/');

$homepage = str_replace('href="#properties"', 'href="' . esc_url($properties_url) . '"', $homepage);
$homepage = str_replace('href="#all-properties"', 'href="' . esc_url($properties_url) . '"', $homepage);
$homepage = str_replace('href="#areas"', 'href="' . esc_url($areas_url) . '"', $homepage);
$homepage = str_replace('href="#consultants"', 'href="' . esc_url($agents_url) . '"', $homepage);
$homepage = str_replace('href="#articles"', 'href="' . esc_url($articles_url) . '"', $homepage);
$homepage = str_replace('href="#notices"', 'href="' . esc_url($notices_url) . '"', $homepage);
$homepage = str_replace('href="#all-articles"', 'href="' . esc_url($articles_url) . '"', $homepage);
$homepage = str_replace('href="#all-notices"', 'href="' . esc_url($notices_url) . '"', $homepage);

$homepage = str_replace('href="/areas/"', 'href="' . esc_url($areas_url) . '"', $homepage);
$homepage = str_replace('href="/agents/"', 'href="' . esc_url($agents_url) . '"', $homepage);
$homepage = str_replace('href="/articles/"', 'href="' . esc_url($articles_url) . '"', $homepage);
$homepage = str_replace('href="/notices/"', 'href="' . esc_url($notices_url) . '"', $homepage);

echo $homepage;
