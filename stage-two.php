<?php
/** Stage 2: real estate areas and agents. */
if (!defined('ABSPATH')) exit;

function melkino_register_stage_two_content() {
    register_post_type('agent', array(
        'labels'=>array('name'=>'مشاوران','singular_name'=>'مشاور','add_new'=>'افزودن مشاور','add_new_item'=>'افزودن مشاور جدید','edit_item'=>'ویرایش مشاور','new_item'=>'مشاور جدید','view_item'=>'مشاهده مشاور','search_items'=>'جستجوی مشاوران','not_found'=>'مشاوری پیدا نشد','menu_name'=>'مشاوران'),
        'public'=>true,'show_in_rest'=>true,'menu_icon'=>'dashicons-businessperson','has_archive'=>true,'rewrite'=>array('slug'=>'agents'),'supports'=>array('title','editor','thumbnail','excerpt')
    ));
    register_post_type('melkino_area', array(
        'labels'=>array('name'=>'مناطق','singular_name'=>'منطقه','add_new'=>'افزودن منطقه','add_new_item'=>'افزودن منطقه جدید','edit_item'=>'ویرایش منطقه','new_item'=>'منطقه جدید','view_item'=>'مشاهده منطقه','search_items'=>'جستجوی مناطق','not_found'=>'منطقه‌ای پیدا نشد','menu_name'=>'مناطق'),
        'public'=>true,'show_in_rest'=>true,'menu_icon'=>'dashicons-location-alt','has_archive'=>true,'rewrite'=>array('slug'=>'areas'),'supports'=>array('title','editor','thumbnail','excerpt')
    ));
}
add_action('init','melkino_register_stage_two_content');

function melkino_agent_meta_boxes(){add_meta_box('melkino_agent_details','اطلاعات مشاور','melkino_agent_details_box','agent','normal','high');}
add_action('add_meta_boxes','melkino_agent_meta_boxes');
function melkino_agent_details_box($post){
    wp_nonce_field('melkino_save_agent','melkino_agent_nonce');
    $fields=array('phone'=>'شماره تماس','whatsapp'=>'واتساپ','rating'=>'امتیاز','reviews'=>'تعداد نظرات','specialty'=>'تخصص / توضیح کوتاه');
    echo '<div class="melkino-admin-fields">';
    foreach($fields as $key=>$label){$value=get_post_meta($post->ID,'_melkino_agent_'.$key,true);echo '<p><label><strong>'.esc_html($label).'</strong><input type="text" name="melkino_agent_'.esc_attr($key).'" value="'.esc_attr($value).'" class="widefat"></label></p>';}
    echo '</div>';
}
function melkino_save_agent_meta($post_id){
    if(!isset($_POST['melkino_agent_nonce'])||!wp_verify_nonce($_POST['melkino_agent_nonce'],'melkino_save_agent'))return;
    if(defined('DOING_AUTOSAVE')&&DOING_AUTOSAVE)return; if(!current_user_can('edit_post',$post_id)||get_post_type($post_id)!=='agent')return;
    foreach(array('phone','whatsapp','rating','reviews','specialty') as $key) if(isset($_POST['melkino_agent_'.$key])) update_post_meta($post_id,'_melkino_agent_'.$key,sanitize_text_field(wp_unslash($_POST['melkino_agent_'.$key])));
}
add_action('save_post_agent','melkino_save_agent_meta');

function melkino_area_meta_boxes(){add_meta_box('melkino_area_details','اطلاعات منطقه','melkino_area_details_box','melkino_area','normal','high');}
add_action('add_meta_boxes','melkino_area_meta_boxes');
function melkino_area_details_box($post){
    wp_nonce_field('melkino_save_area','melkino_area_nonce');
    $fields=array('count'=>'تعداد فایل / ملک','subtitle'=>'زیرعنوان','featured'=>'منطقه محبوب');
    echo '<div class="melkino-admin-fields">';
    foreach($fields as $key=>$label){$value=get_post_meta($post->ID,'_melkino_area_'.$key,true);echo '<p><label><strong>'.esc_html($label).'</strong><input type="text" name="melkino_area_'.esc_attr($key).'" value="'.esc_attr($value).'" class="widefat"></label></p>';}
    echo '</div>';
}
function melkino_save_area_meta($post_id){
    if(!isset($_POST['melkino_area_nonce'])||!wp_verify_nonce($_POST['melkino_area_nonce'],'melkino_save_area'))return;
    if(defined('DOING_AUTOSAVE')&&DOING_AUTOSAVE)return; if(!current_user_can('edit_post',$post_id)||get_post_type($post_id)!=='melkino_area')return;
    foreach(array('count','subtitle','featured') as $key) if(isset($_POST['melkino_area_'.$key])) update_post_meta($post_id,'_melkino_area_'.$key,sanitize_text_field(wp_unslash($_POST['melkino_area_'.$key])));
}
add_action('save_post_melkino_area','melkino_save_area_meta');

function melkino_stage_two_meta($id,$key,$default=''){$v=get_post_meta($id,'_melkino_'.$key,true);return $v!==''?$v:$default;}
function melkino_agent_meta($id,$key,$default=''){$v=get_post_meta($id,'_melkino_agent_'.$key,true);return $v!==''?$v:$default;}
function melkino_area_meta($id,$key,$default=''){$v=get_post_meta($id,'_melkino_area_'.$key,true);return $v!==''?$v:$default;}
