<?php
/**
 * Melkino Vila - WordPress homepage.
 * Assets are embedded here so the homepage cannot lose its styling because of
 * relative-path/rewrite issues while the theme is being developed.
 */
if (!defined('ABSPATH')) {
    exit;
}

$html_file = get_template_directory() . '/index.html';
$css_file  = get_template_directory() . '/styles.css';
$js_file   = get_template_directory() . '/script.js';

$html = file_exists($html_file) ? file_get_contents($html_file) : '';
$css  = file_exists($css_file) ? file_get_contents($css_file) : '';
$js   = file_exists($js_file) ? file_get_contents($js_file) : '';

/* Remove the standalone asset tags because we inject the files below. */
$html = preg_replace('/<link[^>]+href=[\"\']styles\.css[\"\'][^>]*>/i', '', $html);
$html = preg_replace('/<script[^>]+src=[\"\']script\.js[\"\'][^>]*><\/script>/i', '', $html);

/* Keep the Google Font from the HTML, but make its loading non-blocking. */
$html = str_replace('</head>', '<style id="melkino-theme-css">' . $css . '</style></head>', $html);
$html = str_replace('</body>', '<script id="melkino-theme-js">' . $js . '</script></body>', $html);

echo $html;
