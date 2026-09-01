<?php
/** Stage 3: real articles and notices. */
if (!defined('ABSPATH')) exit;

function melkino_register_stage_three_content() {
    register_post_type('melkino_article', array(
        'labels'=>array('name'=>'مقالات','singular_name'=>'مقاله','add_new'=>'افزودن مقاله','add_new_item'=>'افزودن مقاله جدید','edit_item'=>'ویرایش مقاله','new_item'=>'مقاله جدید','view_item'=>'مشاهده مقاله','search_items'=>'جستجوی مقالات','not_found'=>'مقاله‌ای پیدا نشد','menu_name'=>'مقالات'),
        'public'=>true,'show_in_rest'=>true,'menu_icon'=>'dashicons-edit-page','has_archive'=>true,'rewrite'=>array('slug'=>'articles'),'supports'=>array('title','editor','thumbnail','excerpt','author')
    ));
    register_post_type('melkino_notice', array(
        'labels'=>array('name'=>'اطلاعیه‌ها','singular_name'=>'اطلاعیه','add_new'=>'افزودن اطلاعیه','add_new_item'=>'افزودن اطلاعیه جدید','edit_item'=>'ویرایش اطلاعیه','new_item'=>'اطلاعیه جدید','view_item'=>'مشاهده اطلاعیه','search_items'=>'جستجوی اطلاعیه‌ها','not_found'=>'اطلاعیه‌ای پیدا نشد','menu_name'=>'اطلاعیه‌ها'),
        'public'=>true,'show_in_rest'=>true,'menu_icon'=>'dashicons-megaphone','has_archive'=>true,'rewrite'=>array('slug'=>'notices'),'supports'=>array('title','editor','thumbnail','excerpt')
    ));
    register_taxonomy('melkino_article_category','melkino_article',array('labels'=>array('name'=>'دسته‌های مقالات','singular_name'=>'دسته مقاله'),'public'=>true,'show_in_rest'=>true,'hierarchical'=>true,'rewrite'=>array('slug'=>'article-category')));
}
add_action('init','melkino_register_stage_three_content');

function melkino_stage_three_assets(){
    $v=wp_get_theme()->get('Version');
    if(is_post_type_archive('melkino_article')||is_singular('melkino_article')||is_post_type_archive('melkino_notice')||is_singular('melkino_notice')) wp_enqueue_style('melkino-stage-three',get_template_directory_uri().'/stage-three.css',array('melkino-style'),$v);
}
add_action('wp_enqueue_scripts','melkino_stage_three_assets',20);

function melkino_stage_three_meta_boxes(){
    add_meta_box('melkino_article_details','اطلاعات مقاله','melkino_article_details_box','melkino_article','side','high');
    add_meta_box('melkino_notice_details','اطلاعات اطلاعیه','melkino_notice_details_box','melkino_notice','side','high');
}
add_action('add_meta_boxes','melkino_stage_three_meta_boxes');
function melkino_article_details_box($post){
    wp_nonce_field('melkino_save_article','melkino_article_nonce');
    $featured=get_post_meta($post->ID,'_melkino_article_featured',true);
    $reading=get_post_meta($post->ID,'_melkino_article_reading_time',true);
    echo '<p><label><strong>زمان مطالعه</strong><input class="widefat" type="text" name="melkino_article_reading_time" value="'.esc_attr($reading).'" placeholder="۵ دقیقه"></label></p>';
    echo '<p><label><input type="checkbox" name="melkino_article_featured" value="1" '.checked($featured,'1',false).'> مقاله ویژه</label></p>';
}
function melkino_notice_details_box($post){
    wp_nonce_field('melkino_save_notice','melkino_notice_nonce');
    $important=get_post_meta($post->ID,'_melkino_notice_important',true);
    $label=get_post_meta($post->ID,'_melkino_notice_label',true);
    echo '<p><label><strong>برچسب اطلاعیه</strong><input class="widefat" type="text" name="melkino_notice_label" value="'.esc_attr($label).'" placeholder="اطلاعیه"></label></p>';
    echo '<p><label><input type="checkbox" name="melkino_notice_important" value="1" '.checked($important,'1',false).'> اطلاعیه مهم</label></p>';
}
function melkino_save_stage_three_meta($post_id){
    if(defined('DOING_AUTOSAVE')&&DOING_AUTOSAVE)return;
    if(get_post_type($post_id)==='melkino_article' && isset($_POST['melkino_article_nonce']) && wp_verify_nonce($_POST['melkino_article_nonce'],'melkino_save_article') && current_user_can('edit_post',$post_id)){
        update_post_meta($post_id,'_melkino_article_reading_time',isset($_POST['melkino_article_reading_time'])?sanitize_text_field(wp_unslash($_POST['melkino_article_reading_time'])):'');
        update_post_meta($post_id,'_melkino_article_featured',isset($_POST['melkino_article_featured'])?'1':'0');
    }
    if(get_post_type($post_id)==='melkino_notice' && isset($_POST['melkino_notice_nonce']) && wp_verify_nonce($_POST['melkino_notice_nonce'],'melkino_save_notice') && current_user_can('edit_post',$post_id)){
        update_post_meta($post_id,'_melkino_notice_label',isset($_POST['melkino_notice_label'])?sanitize_text_field(wp_unslash($_POST['melkino_notice_label'])):'');
        update_post_meta($post_id,'_melkino_notice_important',isset($_POST['melkino_notice_important'])?'1':'0');
    }
}
add_action('save_post','melkino_save_stage_three_meta');
function melkino_article_meta($id,$key,$default=''){ $v=get_post_meta($id,'_melkino_article_'.$key,true);return $v!==''?$v:$default; }
function melkino_notice_meta($id,$key,$default=''){ $v=get_post_meta($id,'_melkino_notice_'.$key,true);return $v!==''?$v:$default; }

function melkino_stage_three_rewrite_refresh(){
    if(get_option('melkino_stage_three_rewrite_version')!=='1'){
        melkino_register_stage_three_content();
        flush_rewrite_rules(false);
        update_option('melkino_stage_three_rewrite_version','1');
    }
}
add_action('init','melkino_stage_three_rewrite_refresh',100);
