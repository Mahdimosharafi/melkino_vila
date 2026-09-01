<?php if (!defined('ABSPATH')) exit; get_header(); ?>
<main class="melkino-stage3-page"><div class="container">
<section class="melkino-stage3-hero"><span>مرکز اطلاع‌رسانی ملکینو</span><h1>آخرین اطلاعیه‌ها</h1><p>خبرها و اطلاعیه‌های مهم ملکینو را اینجا دنبال کنید.</p></section>
<?php if(have_posts()): ?><div class="melkino-stage3-grid">
<?php while(have_posts()): the_post(); $important=melkino_notice_meta(get_the_ID(),'important')==='1'; $label=melkino_notice_meta(get_the_ID(),'label','اطلاعیه'); ?>
<article class="melkino-stage3-card"><a href="<?php the_permalink(); ?>"><div class="melkino-stage3-thumb"><?php if(has_post_thumbnail()) the_post_thumbnail('large'); ?></div></a><div class="melkino-stage3-body"><div class="melkino-stage3-meta"><span class="melkino-stage3-badge"><?php echo esc_html($important?'مهم':$label); ?></span><span><?php echo esc_html(get_the_date('j F Y')); ?></span></div><h2><?php the_title(); ?></h2><p><?php echo esc_html(wp_trim_words(get_the_excerpt() ?: get_the_content(),24,'...')); ?></p><a class="melkino-stage3-link" href="<?php the_permalink(); ?>">مشاهده اطلاعیه ←</a></div></article>
<?php endwhile; ?></div><div class="melkino-stage3-pagination"><?php echo paginate_links(array('type'=>'plain','prev_text'=>'→','next_text'=>'←')); ?></div><?php else: ?><div class="melkino-stage3-empty"><h2>هنوز اطلاعیه‌ای منتشر نشده</h2><p>از پیشخوان وردپرس اولین اطلاعیه را اضافه کنید.</p></div><?php endif; ?>
</div></main><?php get_footer(); ?>
