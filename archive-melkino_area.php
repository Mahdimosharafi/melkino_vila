<?php if(!defined('ABSPATH'))exit; get_header(); ?>
<main class="stage-wrap">
<section class="stage-hero"><p class="stage-kicker">مناطق منتخب ملکینو</p><h1>مناطق محبوب رامسر</h1><p>محله‌ها و مناطق پرتقاضای رامسر را با اطلاعات و فایل‌های مرتبط بررسی کنید.</p></section>
<?php if(have_posts()): ?><div class="stage-grid">
<?php while(have_posts()):the_post(); $count=melkino_area_meta(get_the_ID(),'count','0');$subtitle=melkino_area_meta(get_the_ID(),'subtitle','بهترین انتخاب برای سرمایه‌گذاری'); ?>
<article class="stage-card"><a class="stage-link" href="<?php the_permalink(); ?>"><div class="stage-image"><?php if(has_post_thumbnail())the_post_thumbnail('large'); ?></div><div class="stage-body"><h2><?php the_title(); ?></h2><p><?php echo esc_html($subtitle); ?></p><span class="area-count"><?php echo esc_html($count); ?> ملک</span></div></a></article>
<?php endwhile; ?></div><div class="stage-pagination"><?php echo wp_kses_post(paginate_links(array('type'=>'plain'))); ?></div><?php else: ?><div class="stage-empty"><h2>هنوز منطقه‌ای ثبت نشده</h2><p>از پیشخوان وردپرس اولین منطقه را اضافه کنید.</p></div><?php endif; ?>
</main><?php get_footer(); ?>