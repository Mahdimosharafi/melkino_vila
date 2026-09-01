<?php
/**
 * Melkino Vila WordPress theme functions.
 */

if (!defined('ABSPATH')) {
    exit;
}

function melkino_vila_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script'));
    register_nav_menus(array(
        'primary' => 'منوی اصلی',
    ));
}
add_action('after_setup_theme', 'melkino_vila_setup');

function melkino_vila_assets() {
    $version = wp_get_theme()->get('Version');
    wp_enqueue_style('melkino-vazirmatn', 'https://fonts.googleapis.com/css2?family=Vazirmatn:wght@400;500;600;700;800;900&display=swap', array(), null);
    wp_enqueue_style('melkino-style', get_stylesheet_uri(), array(), $version);
    wp_enqueue_script('melkino-script', get_template_directory_uri() . '/script.js', array(), $version, true);
}
add_action('wp_enqueue_scripts', 'melkino_vila_assets');

function melkino_vila_body_class($classes) {
    $classes[] = 'melkino-vila';
    return $classes;
}
add_filter('body_class', 'melkino_vila_body_class');
