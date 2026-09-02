<?php
/** Front Page Template: Melkino Vila */
if (!defined('ABSPATH')) exit;
ob_start();
require get_template_directory() . '/index.php';
$homepage = ob_get_clean();

/* Replace the static featured-property cards with published properties marked as «ملک ویژه» in the WordPress dashboard. */
$featured_query = new WP_Query(array(
    'post_type'      => 'property',
    'post_status'    => 'publish',
    'posts_per_page' => 4,
    'meta_query'     => array(array(
        'key'     => '_melkino_featured',
        'value'   => '1',
        'compare' => '=',
    )),
    'no_found_rows'  => true,
));

if ($featured_query->have_posts()) {
    $featured_html = '';
    while ($featured_query->have_posts()) {
        $featured_query->the_post();
        $id = get_the_ID();
        $image = get_the_post_thumbnail_url($id, 'large');
        $image_style = $image ? ' style="background-image:url(\'' . esc_url($image) . '\')"' : '';
        $price_value = get_post_meta($id, '_melkino_price', true);
        $price = $price_value !== '' ? number_format_i18n((float) preg_replace('/[^0-9.]/', '', $price_value)) . ' تومان' : 'تماس بگیرید';
        $size = get_post_meta($id, '_melkino_area_size', true);
        $beds = get_post_meta($id, '_melkino_bedrooms', true);
        $address = get_post_meta($id, '_melkino_address', true) ?: 'رامسر';
        $area_terms = wp_get_post_terms($id, 'property_area', array('fields' => 'names'));
        if (!is_wp_error($area_terms) && !empty($area_terms)) {
            $address = $area_terms[0] . '، رامسر';
        }

        $featured_html .= '<article class="property-card">';
        $featured_html .= '<a class="property-image dynamic-property-image" href="' . esc_url(get_permalink($id)) . '"' . $image_style . ' aria-label="' . esc_attr(get_the_title()) . '">';
        $featured_html .= '<span class="badge">ویژه</span><button class="heart" type="button" aria-label="افزودن به علاقه‌مندی‌ها">♡</button></a>';
        $featured_html .= '<div class="property-body">';
        $featured_html .= '<h3><a href="' . esc_url(get_permalink($id)) . '">' . esc_html(get_the_title()) . '</a></h3>';
        $featured_html .= '<p>' . esc_html($address) . '</p>';
        $featured_html .= '<div class="meta"><span>' . esc_html($size ?: '—') . ' متر</span><span>' . esc_html($beds ?: '—') . ' خواب</span></div>';
        $featured_html .= '<strong>' . esc_html($price) . '</strong>';
        $featured_html .= '</div></article>';
    }
    wp_reset_postdata();

    $homepage = preg_replace(
        '/<div class="property-grid">.*?<\/div>\s*<\/section>/s',
        '<div class="property-grid">' . $featured_html . '</div></section>',
        $homepage,
        1
    );
}

$properties_url = get_post_type_archive_link('property') ?: home_url('/properties/');
$areas_url = get_post_type_archive_link('melkino_area') ?: home_url('/areas/');
$agents_url = get_post_type_archive_link('agent') ?: home_url('/agents/');
$articles_url = get_post_type_archive_link('melkino_article') ?: home_url('/articles/');
$notices_url = get_post_type_archive_link('melkino_notice') ?: home_url('/notices/');
$submit_property_url = home_url('/submit-property/');
$login_url = home_url('/login/');
$account_url = home_url('/account/');
$about_page = get_page_by_path('about');
$contact_page = get_page_by_path('contact');
$buying_page = get_page_by_path('buying-guide');
$selling_page = get_page_by_path('selling-guide');
$sitemap_page = get_page_by_path('sitemap');
$terms_page = get_page_by_path('terms');
$faq_page = get_page_by_path('faq');
$about_url = $about_page ? get_permalink($about_page) : home_url('/about/');
$contact_url = $contact_page ? get_permalink($contact_page) : home_url('/contact/');
$buying_url = $buying_page ? get_permalink($buying_page) : home_url('/buying-guide/');
$selling_url = $selling_page ? get_permalink($selling_page) : home_url('/selling-guide/');
$sitemap_url = $sitemap_page ? get_permalink($sitemap_page) : home_url('/sitemap/');
$terms_url = $terms_page ? get_permalink($terms_page) : home_url('/terms/');
$faq_url = $faq_page ? get_permalink($faq_page) : home_url('/faq/');

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
$homepage = str_replace('href="#sell"', 'href="' . esc_url($submit_property_url) . '"', $homepage);
$homepage = str_replace('href="/submit-property/"', 'href="' . esc_url($submit_property_url) . '"', $homepage);
$homepage = str_replace('href="#register-property"', 'href="' . esc_url($submit_property_url) . '"', $homepage);
$homepage = str_replace('href="#login"', 'href="' . esc_url(is_user_logged_in() ? $account_url : $login_url) . '"', $homepage);
$homepage = str_replace('href="#about"', 'href="' . esc_url($about_url) . '"', $homepage);
$homepage = str_replace('href="#contact"', 'href="' . esc_url($contact_url) . '"', $homepage);
$homepage = str_replace('href="#guide-buy"', 'href="' . esc_url($buying_url) . '"', $homepage);
$homepage = str_replace('href="#guide-sell"', 'href="' . esc_url($selling_url) . '"', $homepage);
$homepage = str_replace('href="#sitemap"', 'href="' . esc_url($sitemap_url) . '"', $homepage);
$homepage = str_replace('href="#terms"', 'href="' . esc_url($terms_url) . '"', $homepage);
$homepage = str_replace('href="#faq"', 'href="' . esc_url($faq_url) . '"', $homepage);
$homepage = str_replace('href="/buying-guide/"', 'href="' . esc_url($buying_url) . '"', $homepage);
$homepage = str_replace('href="/selling-guide/"', 'href="' . esc_url($selling_url) . '"', $homepage);
$homepage = str_replace('href="/sitemap/"', 'href="' . esc_url($sitemap_url) . '"', $homepage);
$homepage = str_replace('href="/terms/"', 'href="' . esc_url($terms_url) . '"', $homepage);
$homepage = str_replace('href="/faq/"', 'href="' . esc_url($faq_url) . '"', $homepage);
if(is_user_logged_in()) $homepage = str_replace('ورود / ثبت‌نام','حساب کاربری',$homepage);
$homepage = preg_replace('/href=["\']#(?:submit-property|submit)["\']/i', 'href="' . esc_url($submit_property_url) . '"', $homepage);
echo $homepage;
