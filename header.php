<?php
if (!defined('ABSPATH')) exit;
$home_url=home_url('/');
$properties_url=get_post_type_archive_link('property')?:home_url('/properties/');
$areas_url=get_post_type_archive_link('melkino_area')?:home_url('/areas/');
$agents_url=get_post_type_archive_link('agent')?:home_url('/agents/');
$articles_url=get_post_type_archive_link('melkino_article')?:home_url('/articles/');
$notices_url=get_post_type_archive_link('melkino_notice')?:home_url('/notices/');
$submit_url=home_url('/submit-property/');
$about_page=get_page_by_path('about',OBJECT,'page');
$contact_page=get_page_by_path('contact',OBJECT,'page');
$about_url=$about_page?get_permalink($about_page):home_url('/about/');
$contact_url=$contact_page?get_permalink($contact_page):home_url('/contact/');
$login_url=home_url('/login/');
$account_url=home_url('/account/');
$is_properties=is_post_type_archive('property')||is_singular('property');
$is_areas=is_post_type_archive('melkino_area')||is_singular('melkino_area');
$is_agents=is_post_type_archive('agent')||is_singular('agent');
$is_articles=is_post_type_archive('melkino_article')||is_singular('melkino_article');
$is_notices=is_post_type_archive('melkino_notice')||is_singular('melkino_notice');
$is_about=is_page('about');
$is_contact=is_page('contact');
?>
<!doctype html><html <?php language_attributes(); ?>><head><meta charset="<?php bloginfo('charset'); ?>"><meta name="viewport" content="width=device-width, initial-scale=1"><meta name="theme-color" content="#58c66d"><?php wp_head(); ?></head><body <?php body_class(); ?>><?php wp_body_open(); ?><header class="property-site-nav"><div class="container property-nav-inner"><a class="property-brand" href="<?php echo esc_url($home_url); ?>"><strong>ملکینو</strong><span>پلتفرم هوشمند املاک رامسر</span></a><nav aria-label="منوی اصلی"><a class="<?php echo $is_properties?'active':''; ?>" href="<?php echo esc_url($properties_url); ?>">املاک</a><a class="<?php echo $is_areas?'active':''; ?>" href="<?php echo esc_url($areas_url); ?>">مناطق</a><a class="<?php echo $is_agents?'active':''; ?>" href="<?php echo esc_url($agents_url); ?>">مشاوران</a><a class="<?php echo $is_articles?'active':''; ?>" href="<?php echo esc_url($articles_url); ?>">مقالات</a><a class="<?php echo $is_notices?'active':''; ?>" href="<?php echo esc_url($notices_url); ?>">اطلاعیه‌ها</a><a class="<?php echo $is_about?'active':''; ?>" href="<?php echo esc_url($about_url); ?>">درباره ما</a><a class="<?php echo $is_contact?'active':''; ?>" href="<?php echo esc_url($contact_url); ?>">تماس با ما</a><a href="<?php echo esc_url($home_url); ?>">صفحه اصلی</a></nav><div class="property-nav-user"><a class="property-nav-login" href="<?php echo esc_url(is_user_logged_in()?$account_url:$login_url); ?>"><?php echo is_user_logged_in()?'حساب کاربری':'ورود / ثبت نام'; ?></a><a class="property-nav-btn" href="<?php echo esc_url($submit_url); ?>">ثبت ملک <b>+</b></a></div></div></header>
