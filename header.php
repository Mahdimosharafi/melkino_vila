<?php
if (!defined('ABSPATH')) exit;
$home_url = home_url('/');
$properties_url = get_post_type_archive_link('property') ?: home_url('/properties/');
$areas_url = get_post_type_archive_link('melkino_area') ?: home_url('/areas/');
$agents_url = get_post_type_archive_link('agent') ?: home_url('/agents/');
$is_properties = is_post_type_archive('property') || is_singular('property');
$is_areas = is_post_type_archive('melkino_area') || is_singular('melkino_area');
$is_agents = is_post_type_archive('agent') || is_singular('agent');
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="theme-color" content="#58c66d">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<header class="property-site-nav">
  <div class="container property-nav-inner">
    <a class="property-brand" href="<?php echo esc_url($home_url); ?>">
      <strong>ملکینو</strong>
      <span>پلتفرم هوشمند املاک رامسر</span>
    </a>
    <nav aria-label="منوی اصلی">
      <a class="<?php echo $is_properties ? 'active' : ''; ?>" href="<?php echo esc_url($properties_url); ?>">املاک</a>
      <a class="<?php echo $is_areas ? 'active' : ''; ?>" href="<?php echo esc_url($areas_url); ?>">مناطق</a>
      <a class="<?php echo $is_agents ? 'active' : ''; ?>" href="<?php echo esc_url($agents_url); ?>">مشاوران</a>
      <a href="<?php echo esc_url($home_url); ?>">صفحه اصلی</a>
    </nav>
    <a class="property-nav-btn" href="<?php echo esc_url($home_url . '#sell'); ?>">ثبت ملک <b>+</b></a>
  </div>
</header>
