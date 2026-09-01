<?php
get_header();

$archive_url = get_post_type_archive_link('property');
if (!$archive_url) {
    $archive_url = home_url('/properties/');
}

$types = get_terms(array(
    'taxonomy' => 'property_type',
    'hide_empty' => false,
));
$areas = get_terms(array(
    'taxonomy' => 'property_area',
    'hide_empty' => false,
));
$deals = get_terms(array(
    'taxonomy' => 'property_deal',
    'hide_empty' => false,
));

$search = melkino_property_filter_value('s');
$type = melkino_property_filter_value('property_type');
$area = melkino_property_filter_value('property_area');
$deal = melkino_property_filter_value('property_deal');
$min_price = melkino_property_filter_value('min_price');
$max_price = melkino_property_filter_value('max_price');
$min_area = melkino_property_filter_value('min_area');
$max_area = melkino_property_filter_value('max_area');
$bedrooms = melkino_property_filter_value('bedrooms');
$bathrooms = melkino_property_filter_value('bathrooms');
$featured = melkino_property_filter_value('featured');
$sort = melkino_property_filter_value('sort', 'newest');

if (!in_array($sort, array('newest', 'price_low', 'price_high', 'area_low', 'area_high'), true)) {
    $sort = 'newest';
}
?>
<div class="property-page" dir="rtl">
    <header class="property-header">
        <div class="container property-header-inner">
            <a class="back-home" href="<?php echo esc_url(home_url('/')); ?>">← صفحه اصلی</a>
            <div>
                <span class="eyebrow">ملکینو / جستجوی هوشمند</span>
                <h1>همه املاک</h1>
                <p>با فیلترهای دقیق، سریع‌تر به ملک مناسب خودت برس.</p>
            </div>
        </div>
    </header>

    <main class="container property-archive">
        <form class="property-filters property-filters-advanced" method="get" action="<?php echo esc_url($archive_url); ?>">
            <div class="filter-field filter-search">
                <label>جستجوی نام یا توضیحات</label>
                <input name="s" value="<?php echo esc_attr($search); ?>" placeholder="مثلاً ویلای ساحلی، رامسر..." />
            </div>

            <div class="filter-field">
                <label>نوع ملک</label>
                <select name="property_type">
                    <option value="">همه انواع</option>
                    <?php if (!is_wp_error($types)) : foreach ($types as $term) : ?>
                        <option value="<?php echo esc_attr($term->slug); ?>" <?php selected($type, $term->slug); ?>><?php echo esc_html($term->name); ?></option>
                    <?php endforeach; endif; ?>
                </select>
            </div>

            <div class="filter-field">
                <label>منطقه</label>
                <select name="property_area">
                    <option value="">همه مناطق</option>
                    <?php if (!is_wp_error($areas)) : foreach ($areas as $term) : ?>
                        <option value="<?php echo esc_attr($term->slug); ?>" <?php selected($area, $term->slug); ?>><?php echo esc_html($term->name); ?></option>
                    <?php endforeach; endif; ?>
                </select>
            </div>

            <div class="filter-field">
                <label>نوع معامله</label>
                <select name="property_deal">
                    <option value="">همه معاملات</option>
                    <?php if (!is_wp_error($deals)) : foreach ($deals as $term) : ?>
                        <option value="<?php echo esc_attr($term->slug); ?>" <?php selected($deal, $term->slug); ?>><?php echo esc_html($term->name); ?></option>
                    <?php endforeach; endif; ?>
                </select>
            </div>

            <div class="filter-field">
                <label>حداقل قیمت</label>
                <input name="min_price" inputmode="numeric" value="<?php echo esc_attr($min_price); ?>" placeholder="تومان" />
            </div>

            <div class="filter-field">
                <label>حداکثر قیمت</label>
                <input name="max_price" inputmode="numeric" value="<?php echo esc_attr($max_price); ?>" placeholder="تومان" />
            </div>

            <div class="filter-field">
                <label>حداقل متراژ</label>
                <input name="min_area" type="number" min="0" value="<?php echo esc_attr($min_area); ?>" placeholder="متر" />
            </div>

            <div class="filter-field">
                <label>حداکثر متراژ</label>
                <input name="max_area" type="number" min="0" value="<?php echo esc_attr($max_area); ?>" placeholder="متر" />
            </div>

            <div class="filter-field">
                <label>خواب</label>
                <select name="bedrooms">
                    <option value="">فرقی ندارد</option>
                    <?php for ($i = 1; $i <= 8; $i++) : $label = ($i === 8) ? '۸+' : (string) $i; ?>
                        <option value="<?php echo esc_attr($i); ?>" <?php selected($bedrooms, (string) $i); ?>><?php echo esc_html($label); ?> خواب</option>
                    <?php endfor; ?>
                </select>
            </div>

            <div class="filter-field">
                <label>سرویس</label>
                <select name="bathrooms">
                    <option value="">فرقی ندارد</option>
                    <?php for ($i = 1; $i <= 6; $i++) : $label = ($i === 6) ? '۶+' : (string) $i; ?>
                        <option value="<?php echo esc_attr($i); ?>" <?php selected($bathrooms, (string) $i); ?>><?php echo esc_html($label); ?> سرویس</option>
                    <?php endfor; ?>
                </select>
            </div>

            <div class="filter-field">
                <label>مرتب‌سازی</label>
                <select name="sort">
                    <option value="newest" <?php selected($sort, 'newest'); ?>>جدیدترین</option>
                    <option value="price_low" <?php selected($sort, 'price_low'); ?>>ارزان‌ترین</option>
                    <option value="price_high" <?php selected($sort, 'price_high'); ?>>گران‌ترین</option>
                    <option value="area_low" <?php selected($sort, 'area_low'); ?>>کمترین متراژ</option>
                    <option value="area_high" <?php selected($sort, 'area_high'); ?>>بیشترین متراژ</option>
                </select>
            </div>

            <label class="featured-filter">
                <input type="checkbox" name="featured" value="1" <?php checked($featured, '1'); ?> />
                <span>فقط ملک‌های ویژه</span>
            </label>

            <div class="filter-actions">
                <button class="filter-submit" type="submit">جستجوی ملک <span>⌕</span></button>
                <a class="filter-reset" href="<?php echo esc_url($archive_url); ?>">پاک کردن فیلترها</a>
            </div>
        </form>

        <?php
        $paged = max(1, (int) get_query_var('paged'));

        $tax_query = array('relation' => 'AND');
        $taxonomy_filters = array(
            'property_type' => $type,
            'property_area' => $area,
            'property_deal' => $deal,
        );

        foreach ($taxonomy_filters as $taxonomy => $value) {
            if ($value !== '') {
                $tax_query[] = array(
                    'taxonomy' => $taxonomy,
                    'field' => 'slug',
                    'terms' => $value,
                );
            }
        }

        $meta_query = array('relation' => 'AND');
        $numeric_filters = array(
            'min_price' => array('_melkino_price', '>=', 'price'),
            'max_price' => array('_melkino_price', '<=', 'price'),
            'min_area' => array('_melkino_area_size', '>=', 'area'),
            'max_area' => array('_melkino_area_size', '<=', 'area'),
            'bedrooms' => array('_melkino_bedrooms', '>=', 'bedrooms'),
            'bathrooms' => array('_melkino_bathrooms', '>=', 'bathrooms'),
        );

        foreach ($numeric_filters as $request => $config) {
            $value = ${$request};
            $clean_value = preg_replace('/[^0-9.]/', '', $value);
            if ($value !== '' && $clean_value !== '' && is_numeric($clean_value)) {
                $meta_query[] = array(
                    'key' => $config[0],
                    'value' => (float) $clean_value,
                    'compare' => $config[1],
                    'type' => 'NUMERIC',
                );
            }
        }

        if ($featured === '1') {
            $meta_query[] = array(
                'key' => '_melkino_featured',
                'value' => '1',
                'compare' => '=',
            );
        }

        $args = array(
            'post_type' => 'property',
            'post_status' => 'publish',
            'posts_per_page' => 12,
            'paged' => $paged,
            's' => $search,
        );

        if (count($tax_query) > 1) {
            $args['tax_query'] = $tax_query;
        }
        if (count($meta_query) > 1) {
            $args['meta_query'] = $meta_query;
        }

        switch ($sort) {
            case 'price_low':
                $args['meta_key'] = '_melkino_price';
                $args['orderby'] = 'meta_value_num';
                $args['order'] = 'ASC';
                break;
            case 'price_high':
                $args['meta_key'] = '_melkino_price';
                $args['orderby'] = 'meta_value_num';
                $args['order'] = 'DESC';
                break;
            case 'area_low':
                $args['meta_key'] = '_melkino_area_size';
                $args['orderby'] = 'meta_value_num';
                $args['order'] = 'ASC';
                break;
            case 'area_high':
                $args['meta_key'] = '_melkino_area_size';
                $args['orderby'] = 'meta_value_num';
                $args['order'] = 'DESC';
                break;
            default:
                $args['orderby'] = 'date';
                $args['order'] = 'DESC';
                break;
        }

        $query = new WP_Query($args);

        $active_count = 0;
        foreach (array($search, $type, $area, $deal, $min_price, $max_price, $min_area, $max_area, $bedrooms, $bathrooms) as $value) {
            if ($value !== '') {
                $active_count++;
            }
        }
        if ($featured === '1') {
            $active_count++;
        }

        $sort_labels = array(
            'newest' => 'جدیدترین',
            'price_low' => 'ارزان‌ترین',
            'price_high' => 'گران‌ترین',
            'area_low' => 'کمترین متراژ',
            'area_high' => 'بیشترین متراژ',
        );
        $current_sort_label = isset($sort_labels[$sort]) ? $sort_labels[$sort] : 'جدیدترین';
        ?>

        <div class="results-bar">
            <div>
                <strong><?php echo esc_html(number_format_i18n($query->found_posts)); ?> ملک</strong>
                <span><?php echo $active_count ? ' · ' . $active_count . ' فیلتر فعال' : ' · پیشنهادهای به‌روز ملکینو'; ?></span>
            </div>
            <span class="results-sort">مرتب‌سازی: <?php echo esc_html($current_sort_label); ?></span>
        </div>

        <?php if ($query->have_posts()) : ?>
            <div class="property-results">
                <?php while ($query->have_posts()) : $query->the_post(); $id = get_the_ID(); ?>
                    <a class="property-tile" href="<?php the_permalink(); ?>">
                        <div class="tile-image">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('large'); ?>
                            <?php else : ?>
                                <div class="tile-no-image"><span>ملکینو</span><small>تصویر ملک</small></div>
                            <?php endif; ?>
                            <span class="tile-badge"><?php echo esc_html(melkino_property_meta($id, 'deal_type', 'فروش')); ?></span>
                            <span class="tile-heart">♡</span>
                        </div>
                        <div class="tile-body">
                            <h2><?php the_title(); ?></h2>
                            <p><?php echo esc_html(melkino_property_meta($id, 'address', 'رامسر')); ?></p>
                            <div class="tile-meta">
                                <span><?php echo esc_html(melkino_property_meta($id, 'area_size', '—')); ?> متر</span>
                                <span><?php echo esc_html(melkino_property_meta($id, 'bedrooms', '—')); ?> خواب</span>
                                <span><?php echo esc_html(melkino_property_meta($id, 'bathrooms', '—')); ?> سرویس</span>
                            </div>
                            <strong><?php echo esc_html(melkino_price(melkino_property_meta($id, 'price'))); ?></strong>
                        </div>
                    </a>
                <?php endwhile; ?>
            </div>

            <?php
            $pagination = paginate_links(array(
                'base' => str_replace('999999999', '%#%', esc_url(get_pagenum_link(999999999))),
                'format' => '?paged=%#%',
                'current' => $paged,
                'total' => $query->max_num_pages,
                'type' => 'list',
                'add_args' => melkino_property_filter_url_args(),
            ));
            if ($pagination) :
            ?>
                <div class="property-pagination"><?php echo wp_kses_post($pagination); ?></div>
            <?php endif; ?>

        <?php else : ?>
            <div class="empty-state">
                <div>⌂</div>
                <h2>ملکی با این مشخصات پیدا نشد</h2>
                <p>فیلترها را کمی بازتر کن یا محدوده قیمت و متراژ را تغییر بده.</p>
                <a href="<?php echo esc_url($archive_url); ?>">نمایش همه املاک</a>
            </div>
        <?php endif; wp_reset_postdata(); ?>
    </main>
</div>
<?php get_footer(); ?>
