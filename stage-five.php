<?php
/** Stage 5: advanced property search/filter helpers. */
if (!defined('ABSPATH')) exit;

function melkino_stage_five_assets() {
    if (is_post_type_archive('property')) {
        wp_enqueue_style('melkino-stage-five', get_template_directory_uri().'/stage-five.css', array('melkino-property'), wp_get_theme()->get('Version'));
    }
}
add_action('wp_enqueue_scripts','melkino_stage_five_assets',35);

function melkino_property_filter_value($key, $default='') {
    return isset($_GET[$key]) ? sanitize_text_field(wp_unslash($_GET[$key])) : $default;
}

function melkino_property_filter_url_args() {
    $keys = array('s','property_type','property_area','property_deal','min_price','max_price','min_area','max_area','bedrooms','bathrooms','featured','sort');
    $args = array();
    foreach ($keys as $key) {
        $value = melkino_property_filter_value($key);
        if ($value !== '') $args[$key] = $value;
    }
    return $args;
}
