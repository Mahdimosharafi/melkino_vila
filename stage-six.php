<?php
/** Stage 6: About + Contact pages and contact message handling. */
if (!defined('ABSPATH')) exit;

function melkino_register_contact_messages(){
    register_post_type('melkino_message',array(
        'labels'=>array('name'=>'پیام‌های تماس','singular_name'=>'پیام تماس','menu_name'=>'پیام‌های تماس','add_new'=>'افزودن پیام','view_item'=>'مشاهده پیام'),
        'public'=>false,'show_ui'=>true,'show_in_menu'=>true,'menu_icon'=>'dashicons-email-alt','supports'=>array('title','editor')
    ));
}
add_action('init','melkino_register_contact_messages');

function melkino_contact_form_handler(){
    if($_SERVER['REQUEST_METHOD']!=='POST' || empty($_POST['melkino_contact_form'])) return;
    if(!isset($_POST['melkino_contact_nonce']) || !wp_verify_nonce($_POST['melkino_contact_nonce'],'melkino_contact_submit')) return;
    $name=sanitize_text_field(wp_unslash($_POST['contact_name']??''));
    $phone=sanitize_text_field(wp_unslash($_POST['contact_phone']??''));
    $email=sanitize_email(wp_unslash($_POST['contact_email']??''));
    $message=sanitize_textarea_field(wp_unslash($_POST['contact_message']??''));
    if($name==='' || $phone==='' || $message==='') { wp_safe_redirect(add_query_arg('contact_status','error',wp_get_referer()?:home_url('/contact/'))); exit; }
    $post_id=wp_insert_post(array('post_type'=>'melkino_message','post_status'=>'publish','post_title'=>$name.' - '.$phone,'post_content'=>$message));
    if($post_id && !is_wp_error($post_id)){
        update_post_meta($post_id,'_melkino_contact_phone',$phone);
        update_post_meta($post_id,'_melkino_contact_email',$email);
        update_post_meta($post_id,'_melkino_contact_name',$name);
        wp_safe_redirect(add_query_arg('contact_status','success',wp_get_referer()?:home_url('/contact/'))); exit;
    }
    wp_safe_redirect(add_query_arg('contact_status','error',wp_get_referer()?:home_url('/contact/'))); exit;
}
add_action('template_redirect','melkino_contact_form_handler');

function melkino_stage_six_page($slug,$title,$callback){
    $page=get_page_by_path($slug);
    if(!$page){ $id=wp_insert_post(array('post_title'=>$title,'post_name'=>$slug,'post_status'=>'publish','post_type'=>'page','post_content'=>'')); if($id && !is_wp_error($id)) $page=get_post($id); }
    return $page;
}
function melkino_stage_six_activate(){
    melkino_stage_six_page('about','درباره ما','about');
    melkino_stage_six_page('contact','تماس با ما','contact');
    flush_rewrite_rules(false);
}
add_action('after_switch_theme','melkino_stage_six_activate');

function melkino_stage_six_template_include($template){
    if(is_page('about')){ $custom=get_template_directory().'/page-about.php'; if(file_exists($custom)) return $custom; }
    if(is_page('contact')){ $custom=get_template_directory().'/page-contact.php'; if(file_exists($custom)) return $custom; }
    return $template;
}
add_filter('template_include','melkino_stage_six_template_include');
