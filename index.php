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
$property_css_file = get_template_directory() . '/property-images.css';
$stage_nine_css_file = get_template_directory() . '/stage-nine.css';

$html = file_exists($html_file) ? file_get_contents($html_file) : '';
$css  = file_exists($css_file) ? file_get_contents($css_file) : '';
$js   = file_exists($js_file) ? file_get_contents($js_file) : '';
$property_css = file_exists($property_css_file) ? file_get_contents($property_css_file) : '';
$stage_nine_css = file_exists($stage_nine_css_file) ? file_get_contents($stage_nine_css_file) : '';
$property_css = str_replace('__THEME_URI__', get_template_directory_uri(), $property_css);

/* Remove the standalone asset tags because we inject the files below. */
$html = preg_replace('/<link[^>]+href=[\"\']styles\.css[\"\'][^>]*>/i', '', $html);
$html = preg_replace('/<script[^>]+src=[\"\']script\.js[\"\'][^>]*><\/script>/i', '', $html);

/* Allow the hero background to be changed from Appearance > Customize. */
$hero_background = get_theme_mod('melkino_hero_background', '');
$hero_custom_css = '';
if ($hero_background) {
    $hero_custom_css = '<style id="melkino-hero-custom-css">.hero{background-image:linear-gradient(180deg,rgba(3,15,27,.50),rgba(4,18,25,.22) 45%,rgba(5,18,20,.64)),url("' . esc_url($hero_background) . '") !important;background-position:center;background-size:cover;}</style>';
}

/* Keep the Google Font from the HTML, but make its loading non-blocking. */
$html = str_replace('</head>', '<style id="melkino-theme-css">' . $css . '</style><style id="melkino-property-images-css">' . $property_css . '</style><style id="melkino-stage-nine-css">' . $stage_nine_css . '</style>' . $hero_custom_css . '</head>', $html);
$html = str_replace('</body>', '<script id="melkino-theme-js">' . $js . '</script></body>', $html);

echo $html;
