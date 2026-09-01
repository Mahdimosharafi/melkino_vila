<?php
/**
 * Melkino Vila - WordPress theme fallback template.
 *
 * The homepage HTML is kept in index.html for now. Asset URLs are rewritten
 * to the active WordPress theme directory so CSS and JavaScript always load.
 */

if (!defined('ABSPATH')) {
    exit;
}

$theme_uri = get_template_directory_uri();
$html = file_get_contents(get_template_directory() . '/index.html');

if ($html === false) {
    wp_die('فایل صفحه اصلی ملکینو پیدا نشد.');
}

$html = str_replace(
    array('href="styles.css"', 'src="script.js"'),
    array(
        'href="' . esc_url($theme_uri . '/styles.css') . '"',
        'src="' . esc_url($theme_uri . '/script.js') . '"'
    ),
    $html
);

echo $html;
