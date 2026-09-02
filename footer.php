<?php
if (!defined('ABSPATH')) exit;

$melkino_about_page = get_page_by_path('about', OBJECT, 'page');
$melkino_contact_page = get_page_by_path('contact', OBJECT, 'page');
$melkino_submit_page = get_page_by_path('submit-property', OBJECT, 'page');
$melkino_buying_page = get_page_by_path('buying-guide', OBJECT, 'page');
$melkino_selling_page = get_page_by_path('selling-guide', OBJECT, 'page');
$melkino_sitemap_page = get_page_by_path('sitemap', OBJECT, 'page');
$melkino_terms_page = get_page_by_path('terms', OBJECT, 'page');

$melkino_about_url = $melkino_about_page ? get_permalink($melkino_about_page) : home_url('/about/');
$melkino_contact_url = $melkino_contact_page ? get_permalink($melkino_contact_page) : home_url('/contact/');
$melkino_submit_url = $melkino_submit_page ? get_permalink($melkino_submit_page) : home_url('/submit-property/');
$melkino_buying_url = $melkino_buying_page ? get_permalink($melkino_buying_page) : home_url('/buying-guide/');
$melkino_selling_url = $melkino_selling_page ? get_permalink($melkino_selling_page) : home_url('/selling-guide/');
$melkino_sitemap_url = $melkino_sitemap_page ? get_permalink($melkino_sitemap_page) : home_url('/sitemap/');
$melkino_terms_url = $melkino_terms_page ? get_permalink($melkino_terms_page) : home_url('/terms/');
?>
<footer class="property-footer">
  <div class="container property-footer-grid">
    <div>
      <strong>ملکینو</strong>
      <p>پلتفرم هوشمند خرید، فروش، رهن و اجاره ملک در رامسر.</p>
    </div>
    <div>
      <h3>دسترسی سریع</h3>
      <a href="<?php echo esc_url(get_post_type_archive_link('property')); ?>">املاک</a>
      <a href="<?php echo esc_url(get_post_type_archive_link('melkino_area')); ?>">مناطق</a>
      <a href="<?php echo esc_url(get_post_type_archive_link('agent')); ?>">مشاوران</a>
      <a href="<?php echo esc_url($melkino_about_url); ?>">درباره ما</a>
    </div>
    <div>
      <h3>خدمات</h3>
      <a href="<?php echo esc_url($melkino_submit_url); ?>">ثبت ملک</a>
      <a href="<?php echo esc_url($melkino_contact_url); ?>">تماس با ما</a>
      <a href="<?php echo esc_url($melkino_buying_url); ?>">راهنمای خرید</a>
      <a href="<?php echo esc_url($melkino_selling_url); ?>">راهنمای فروش</a>
      <a href="<?php echo esc_url($melkino_sitemap_url); ?>">سایت مپ</a>
      <a href="<?php echo esc_url($melkino_terms_url); ?>">شرایط و قوانین</a>
    </div>
  </div>
  <div class="property-footer-copy">© <?php echo esc_html(date('Y')); ?> ملکینو؛ تمامی حقوق محفوظ است.</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
