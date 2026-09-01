<?php get_header(); ?>
<div class="property-page" dir="rtl">
<header class="property-header"><div class="container property-header-inner"><a class="back-home" href="<?php echo esc_url(home_url('/')); ?>">← صفحه اصلی</a><div><span class="eyebrow">ملکینو / املاک</span><h1>همه املاک</h1><p>ملک مناسب خودت را با فیلترهای دقیق پیدا کن.</p></div></div></header>
<main class="container property-archive">
<form class="property-filters" method="get" action="<?php echo esc_url(get_post_type_archive_link('property')); ?>">
<div><label>جستجو</label><input name="s" value="<?php echo esc_attr(get_search_query()); ?>" placeholder="نام ملک یا منطقه..." /></div>
<div><label>نوع ملک</label><select name="property_type"><option value="">همه انواع</option><?php foreach(get_terms(array('taxonomy'=>'property_type','hide_empty'=>false)) as $term): ?><option value="<?php echo esc_attr($term->slug); ?>" <?php selected(isset($_GET['property_type'])?sanitize_text_field(wp_unslash($_GET['property_type'])):'',$term->slug); ?>><?php echo esc_html($term->name); ?></option><?php endforeach; ?></select></div>
<div><label>منطقه</label><select name="property_area"><option value="">همه مناطق</option><?php foreach(get_terms(array('taxonomy'=>'property_area','hide_empty'=>false)) as $term): ?><option value="<?php echo esc_attr($term->slug); ?>" <?php selected(isset($_GET['property_area'])?sanitize_text_field(wp_unslash($_GET['property_area'])):'',$term->slug); ?>><?php echo esc_html($term->name); ?></option><?php endforeach; ?></select></div>
<div><label>نوع معامله</label><select name="property_deal"><option value="">همه معاملات</option><?php foreach(get_terms(array('taxonomy'=>'property_deal','hide_empty'=>false)) as $term): ?><option value="<?php echo esc_attr($term->slug); ?>" <?php selected(isset($_GET['property_deal'])?sanitize_text_field(wp_unslash($_GET['property_deal'])):'',$term->slug); ?>><?php echo esc_html($term->name); ?></option><?php endforeach; ?></select></div>
<button class="filter-submit" type="submit">جستجوی ملک <span>⌕</span></button>
</form>
<?php
$paged=max(1,get_query_var('paged'));
$tax_query=array('relation'=>'AND');
foreach(array('property_type','property_area','property_deal') as $tax){if(!empty($_GET[$tax]))$tax_query[]=array('taxonomy'=>$tax,'field'=>'slug','terms'=>sanitize_text_field(wp_unslash($_GET[$tax])));}
$args=array('post_type'=>'property','posts_per_page'=>12,'paged'=>$paged,'s'=>get_search_query(),'orderby'=>'date','order'=>'DESC'); if(count($tax_query)>1)$args['tax_query']=$tax_query;
$query=new WP_Query($args);
?>
<div class="results-bar"><strong><?php echo esc_html(number_format_i18n($query->found_posts)); ?> ملک</strong><span>پیشنهادهای به‌روز ملکینو</span></div>
<?php if($query->have_posts()): ?><div class="property-results">
<?php while($query->have_posts()):$query->the_post(); $id=get_the_ID(); ?>
<a class="property-tile" href="<?php the_permalink(); ?>"><div class="tile-image"><?php if(has_post_thumbnail()) the_post_thumbnail('large'); ?><span class="tile-badge"><?php echo melkino_property_meta($id,'deal_type','فروش'); ?></span><span class="tile-heart">♡</span></div><div class="tile-body"><h2><?php the_title(); ?></h2><p><?php echo esc_html(melkino_property_meta($id,'address','رامسر')); ?></p><div class="tile-meta"><span><?php echo esc_html(melkino_property_meta($id,'area_size','—')); ?> متر</span><span><?php echo esc_html(melkino_property_meta($id,'bedrooms','—')); ?> خواب</span></div><strong><?php echo esc_html(melkino_price(melkino_property_meta($id,'price'))); ?></strong></div></a>
<?php endwhile; ?></div><div class="property-pagination"><?php echo wp_kses_post(paginate_links(array('total'=>$query->max_num_pages,'current'=>$paged,'type'=>'list'))); ?></div><?php else: ?><div class="empty-state"><div>⌂</div><h2>ملکی با این مشخصات پیدا نشد</h2><p>فیلترها را کمی بازتر کن یا دوباره جستجو کن.</p><a href="<?php echo esc_url(get_post_type_archive_link('property')); ?>">نمایش همه املاک</a></div><?php endif; wp_reset_postdata(); ?>
</main></div><?php get_footer(); ?>
