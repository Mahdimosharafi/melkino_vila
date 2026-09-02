<?php
/** Stage 8: Melkino custom admin dashboard. */
if (!defined('ABSPATH')) exit;

function melkino_stage_eight_admin_menu(){
    add_menu_page('داشبورد ملکینو','داشبورد ملکینو','manage_options','melkino-dashboard','melkino_stage_eight_dashboard','dashicons-dashboard',2);
    add_submenu_page('melkino-dashboard','داشبورد','داشبورد','manage_options','melkino-dashboard','melkino_stage_eight_dashboard');
    add_submenu_page('melkino-dashboard','املاک','املاک','manage_options','edit.php?post_type=property');
    add_submenu_page('melkino-dashboard','کاربران','کاربران','manage_options','users.php');
    add_submenu_page('melkino-dashboard','مشاوران','مشاوران','manage_options','edit.php?post_type=agent');
    add_submenu_page('melkino-dashboard','مناطق','مناطق','manage_options','edit.php?post_type=melkino_area');
    add_submenu_page('melkino-dashboard','مقالات','مقالات','manage_options','edit.php?post_type=melkino_article');
    add_submenu_page('melkino-dashboard','اطلاعیه‌ها','اطلاعیه‌ها','manage_options','edit.php?post_type=melkino_notice');
    add_submenu_page('melkino-dashboard','پیام‌های تماس','پیام‌های تماس','manage_options','edit.php?post_type=melkino_message');
}
add_action('admin_menu','melkino_stage_eight_admin_menu',20);

function melkino_stage_eight_count($post_type,$status='any'){
    $counts=wp_count_posts($post_type);
    return isset($counts->{$status}) ? (int)$counts->{$status} : 0;
}

function melkino_stage_eight_dashboard(){
    if(!current_user_can('manage_options')) return;
    $property_total=melkino_stage_eight_count('property','any');
    $property_publish=melkino_stage_eight_count('property','publish');
    $property_pending=melkino_stage_eight_count('property','pending');
    $users=wp_count_users();
    $agents=post_type_exists('agent')?melkino_stage_eight_count('agent','publish'):0;
    $areas=post_type_exists('melkino_area')?melkino_stage_eight_count('melkino_area','publish'):0;
    $articles=post_type_exists('melkino_article')?melkino_stage_eight_count('melkino_article','publish'):0;
    $notices=post_type_exists('melkino_notice')?melkino_stage_eight_count('melkino_notice','publish'):0;
    $messages=post_type_exists('melkino_message')?melkino_stage_eight_count('melkino_message','publish'):0;
    $pending_url=admin_url('edit.php?post_type=property&post_status=pending');
    ?>
    <div class="melkino-admin-wrap" dir="rtl">
      <div class="melkino-admin-hero"><div><span class="melkino-admin-kicker">MELKINO ADMIN</span><h1>داشبورد مدیریت ملکینو</h1><p>مدیریت هوشمند املاک، کاربران و محتوای سایت از یکجا.</p></div><a class="melkino-admin-view" href="<?php echo esc_url(home_url('/')); ?>" target="_blank">مشاهده سایت ↗</a></div>
      <div class="melkino-admin-grid">
        <a class="melkino-admin-card green" href="<?php echo esc_url(admin_url('edit.php?post_type=property')); ?>"><span>🏠</span><small>کل املاک</small><strong><?php echo esc_html($property_total); ?></strong><em>مدیریت آگهی‌ها →</em></a>
        <a class="melkino-admin-card" href="<?php echo esc_url(admin_url('edit.php?post_type=property&post_status=publish')); ?>"><span>✓</span><small>املاک منتشرشده</small><strong><?php echo esc_html($property_publish); ?></strong><em>مشاهده آگهی‌ها →</em></a>
        <a class="melkino-admin-card orange" href="<?php echo esc_url($pending_url); ?>"><span>⏳</span><small>در انتظار بررسی</small><strong><?php echo esc_html($property_pending); ?></strong><em>بررسی و تأیید →</em></a>
        <a class="melkino-admin-card" href="<?php echo esc_url(admin_url('users.php')); ?>"><span>👤</span><small>کاربران</small><strong><?php echo esc_html($users['total_users']); ?></strong><em>مدیریت کاربران →</em></a>
      </div>
      <div class="melkino-admin-columns">
        <section class="melkino-admin-panel"><div class="panel-head"><div><h2>مدیریت سریع</h2><p>دسترسی مستقیم به بخش‌های اصلی</p></div></div><div class="quick-links">
          <a href="<?php echo esc_url(admin_url('post-new.php?post_type=property')); ?>"><b>＋</b><span>ثبت ملک جدید</span></a>
          <a href="<?php echo esc_url(admin_url('edit.php?post_type=agent')); ?>"><b>♙</b><span>مشاوران <small><?php echo esc_html($agents); ?></small></span></a>
          <a href="<?php echo esc_url(admin_url('edit.php?post_type=melkino_area')); ?>"><b>⌖</b><span>مناطق <small><?php echo esc_html($areas); ?></small></span></a>
          <a href="<?php echo esc_url(admin_url('edit.php?post_type=melkino_article')); ?>"><b>▤</b><span>مقالات <small><?php echo esc_html($articles); ?></small></span></a>
          <a href="<?php echo esc_url(admin_url('edit.php?post_type=melkino_notice')); ?>"><b>!</b><span>اطلاعیه‌ها <small><?php echo esc_html($notices); ?></small></span></a>
          <a href="<?php echo esc_url(admin_url('edit.php?post_type=melkino_message')); ?>"><b>✉</b><span>پیام‌های تماس <small><?php echo esc_html($messages); ?></small></span></a>
        </div></section>
        <section class="melkino-admin-panel"><div class="panel-head"><div><h2>وضعیت آگهی‌ها</h2><p>نمای کلی عملکرد بخش املاک</p></div></div><div class="status-line"><span>منتشرشده</span><strong><?php echo esc_html($property_publish); ?></strong></div><div class="status-line"><span>در انتظار بررسی</span><strong><?php echo esc_html($property_pending); ?></strong></div><div class="status-line"><span>کل آگهی‌ها</span><strong><?php echo esc_html($property_total); ?></strong></div><a class="panel-button" href="<?php echo esc_url($pending_url); ?>">بررسی آگهی‌های در انتظار ←</a></section>
      </div>
    </div>
    <?php
}

function melkino_stage_eight_admin_assets($hook){
    if($hook!=='toplevel_page_melkino-dashboard') return;
    wp_enqueue_style('melkino-admin-dashboard',get_template_directory_uri().'/stage-eight.css',array(),wp_get_theme()->get('Version'));
}
add_action('admin_enqueue_scripts','melkino_stage_eight_admin_assets');

function melkino_stage_eight_admin_bar($wp_admin_bar){
    if(!current_user_can('manage_options')) return;
    $wp_admin_bar->add_node(array('id'=>'melkino-dashboard','title'=>'داشبورد ملکینو','href'=>admin_url('admin.php?page=melkino-dashboard')));
}
add_action('admin_bar_menu','melkino_stage_eight_admin_bar',100);
