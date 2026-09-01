<?php
/**
 * Melkino Vila - WordPress theme fallback template.
 *
 * The homepage HTML is kept in index.html for now, but its asset paths are
 * rewritten to the active theme directory so CSS/JS work correctly in WordPress.
 */

if (!defined('ABSPATH')) {
    exit;
}

$html = file_get_contents(get_template_directory() . '/index.html');
$theme_uri = get_template_directory_uri();

$html = str_replace(
    array('href="styles.css"', 'src="script.js"'),
    array('href="' . esc_url($theme_uri . '/styles.css') . '"', 'src="' . esc_url($theme_uri . '/script.js') . '"'),
    $html
);

echo $html;
