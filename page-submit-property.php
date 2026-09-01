<?php
if (!defined('ABSPATH')) exit;
get_header();
$success = isset($_GET['submitted']) ? 'ملک شما با موفقیت ثبت شد و پس از بررسی مدیر منتشر خواهد شد.' : melkino_submit_notice('success');
$error = melkino_submit_notice('error');
$types = get_terms(array('taxonomy'=>'property_type','hide_empty'=>false));
$areas = get_terms(array('taxonomy'=>'property_area','hide_empty'=>false));
$deals = get_terms(array('taxonomy'=>'property_deal','hide_empty'=>false));
?>
<main class="melkino-submit-page"><div class="container">
<section class="submit-hero"><div><span>ملکینو</span><h1>ملکتان را ثبت کنید</h1><p>اطلاعات ملک را وارد کنید؛ پس از بررسی، آگهی در سایت منتشر می‌شود.</p></div><div class="submit-hero-mark">+</div></section>
<?php if($success): ?><div class="submit-notice success">✓ <?php echo esc_html($success); ?></div><?php endif; ?>
<?php if($error): ?><div class="submit-notice error">! <?php echo esc_html($error); ?></div><?php endif; ?>
<form class="submit-form" method="post" enctype="multipart/form-data">
<?php wp_nonce_field('melkino_submit_property','melkino_submit_nonce'); ?>
<input type="hidden" name="melkino_submit_property" value="1">
<div class="form-card"><div class="form-title"><span>۱</span><div><h2>اطلاعات اصلی ملک</h2><p>مشخصات پایه آگهی را وارد کنید.</p></div></div>
<div class="form-grid">
<label class="full"><b>عنوان ملک *</b><input required type="text" name="property_title" placeholder="مثلاً ویلای دوبلکس نزدیک ساحل رامسر"></label>
<label><b>نوع ملک</b><select name="property_type"><option value="">انتخاب کنید</option><?php foreach($types as $term): ?><option value="<?php echo esc_attr($term->term_id); ?>"><?php echo esc_html($term->name); ?></option><?php endforeach; ?></select></label>
<label><b>نوع معامله</b><select name="property_deal"><option value="">انتخاب کنید</option><?php foreach($deals as $term): ?><option value="<?php echo esc_attr($term->term_id); ?>"><?php echo esc_html($term->name); ?></option><?php endforeach; ?></select></label>
<label><b>منطقه</b><select name="property_area"><option value="">انتخاب کنید</option><?php foreach($areas as $term): ?><option value="<?php echo esc_attr($term->term_id); ?>"><?php echo esc_html($term->name); ?></option><?php endforeach; ?></select></label>
<label><b>آدرس کوتاه</b><input type="text" name="property_address" placeholder="محله، خیابان یا محدوده"></label>
</div></div>
<div class="form-card"><div class="form-title"><span>۲</span><div><h2>مشخصات و قیمت</h2><p>اطلاعاتی که در کارت ملک نمایش داده می‌شود.</p></div></div>
<div class="form-grid">
<label><b>قیمت (تومان)</b><input type="text" name="property_price" placeholder="مثلاً ۸,۵۰۰,۰۰۰,۰۰۰"></label>
<label><b>متراژ (متر)</b><input type="number" min="0" name="property_area_size" placeholder="250"></label>
<label><b>تعداد خواب</b><input type="number" min="0" name="property_bedrooms" placeholder="3"></label>
<label><b>تعداد سرویس</b><input type="number" min="0" name="property_bathrooms" placeholder="2"></label>
<label><b>سال ساخت</b><input type="text" name="property_year_built" placeholder="1402"></label>
<label><b>شماره تماس *</b><input required type="tel" name="property_phone" placeholder="09xxxxxxxxx"></label>
</div></div>
<div class="form-card"><div class="form-title"><span>۳</span><div><h2>توضیحات و تصاویر</h2><p>جزئیات ملک را کامل بنویسید و تصاویر را اضافه کنید.</p></div></div>
<label class="full"><b>توضیحات</b><textarea name="property_description" rows="7" placeholder="امکانات، موقعیت، شرایط فروش یا اجاره و هر اطلاعات مفید دیگر..."></textarea></label>
<label class="upload"><b>تصاویر ملک</b><input type="file" name="property_images[]" accept="image/jpeg,image/png,image/webp" multiple><span>چند تصویر انتخاب کنید؛ اولین تصویر به‌عنوان تصویر شاخص ثبت می‌شود.</span></label>
</div>
<div class="submit-actions"><p>آگهی ابتدا برای بررسی مدیر ارسال می‌شود.</p><button type="submit">ارسال ملک برای بررسی <span>←</span></button></div>
</form></div></main>
<?php get_footer(); ?>
