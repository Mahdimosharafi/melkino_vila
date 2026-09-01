<?php
/** Melkino Vila WordPress theme functions. */
if (!defined('ABSPATH')) exit;
require_once get_template_directory() . '/stage-two.php';
require_once get_template_directory() . '/stage-three.php';
require_once get_template_directory() . '/stage-four.php';

function melkino_vila_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array('search-form','comment-form','comment-list','gallery','caption','style','script'));
    register_nav_menus(array('primary'=>'منوی اصلی'));
}
add_action('after_setup_theme','melkino_vila_setup');

function melkino_vila_assets() {
    $version = wp_get_theme()->get('Version');
    wp_enqueue_style('melkino-vazirmatn','https://fonts.googleapis.com/css2?family=Vazirmatn:wght@400;500;600;700;800;900&display=swap',array(),null);
    wp_enqueue_style('melkino-estedad','https://fonts.googleapis.com/css2?family=Estedad:wght@400;500;600;700;800;900&display=swap',array(),null);
    wp_enqueue_style('melkino-style',get_stylesheet_uri(),array(),$version);
    wp_enqueue_script('melkino-script',get_template_directory_uri().'/script.js',array(),$version,true);
    if (is_post_type_archive('property') || is_singular('property')) wp_enqueue_style('melkino-property',get_template_directory_uri().'/property.css',array('melkino-style'),$version);
}
add_action('wp_enqueue_scripts','melkino_vila_assets');
function melkino_vila_body_class($classes){$classes[]='melkino-vila';return $classes;}
add_filter('body_class','melkino_vila_body_class');

function melkino_register_property_content() {
    register_post_type('property',array(
        'labels'=>array('name'=>'املاک','singular_name'=>'ملک','add_new'=>'افزودن ملک','add_new_item'=>'افزودن ملک جدید','edit_item'=>'ویرایش ملک','new_item'=>'ملک جدید','view_item'=>'مشاهده ملک','search_items'=>'جستجوی املاک','not_found'=>'ملکی پیدا نشد','menu_name'=>'املاک'),
        'public'=>true,'show_in_rest'=>true,'menu_icon'=>'dashicons-building','has_archive'=>true,'rewrite'=>array('slug'=>'properties'),'supports'=>array('title','editor','thumbnail','excerpt')
    ));
    register_taxonomy('property_type','property',array('labels'=>array('name'=>'نوع ملک','singular_name'=>'نوع ملک'),'public'=>true,'show_in_rest'=>true,'hierarchical'=>true,'rewrite'=>array('slug'=>'property-type')));
    register_taxonomy('property_area','property',array('labels'=>array('name'=>'مناطق','singular_name'=>'منطقه'),'public'=>true,'show_in_rest'=>true,'hierarchical'=>true,'rewrite'=>array('slug'=>'area')));
    register_taxonomy('property_deal','property',array('labels'=>array('name'=>'نوع معامله','singular_name'=>'نوع معامله'),'public'=>true,'show_in_rest'=>true,'hierarchical'=>false,'rewrite'=>array('slug'=>'deal')));
}
add_action('init','melkino_register_property_content');

function melkino_property_meta_boxes(){add_meta_box('melkino_property_details','جزئیات ملک','melkino_property_details_box','property','normal','high');}
add_action('add_meta_boxes','melkino_property_meta_boxes');
function melkino_property_details_box($post){
    wp_nonce_field('melkino_save_property','melkino_property_nonce');
    $fields=array('price'=>'قیمت (تومان)','area_size'=>'متراژ (متر)','bedrooms'=>'تعداد خواب','bathrooms'=>'تعداد سرویس','deal_type'=>'نوع معامله','address'=>'آدرس کوتاه','phone'=>'شماره تماس','year_built'=>'سال ساخت');
    echo '<div class="melkino-admin-fields">';
    foreach($fields as $key=>$label){$value=get_post_meta($post->ID,'_melkino_'.$key,true);echo '<p><label><strong>'.esc_html($label).'</strong><input type="text" name="melkino_'.esc_attr($key).'" value="'.esc_attr($value).'" class="widefat"></label></p>';}
    $featured=get_post_meta($post->ID,'_melkino_featured',true); echo '<p><label><input type="checkbox" name="melkino_featured" value="1" '.checked($featured,'1',false).'> ملک ویژه</label></p></div>';
}
function melkino_save_property_meta($post_id){
    if(!isset($_POST['melkino_property_nonce'])||!wp_verify_nonce($_POST['melkino_property_nonce'],'melkino_save_property'))return;
    if(defined('DOING_AUTOSAVE')&&DOING_AUTOSAVE)return; if(!current_user_can('edit_post',$post_id)||get_post_type($post_id)!=='property')return;
    foreach(array('price','area_size','bedrooms','bathrooms','deal_type','address','phone','year_built') as $key) if(isset($_POST['melkino_'.$key])) update_post_meta($post_id,'_melkino_'.$key,sanitize_text_field(wp_unslash($_POST['melkino_'.$key])));
    update_post_meta($post_id,'_melkino_featured',isset($_POST['melkino_featured'])?'1':'0');
}
add_action('save_post_property','melkino_save_property_meta');
function melkino_property_flush_rewrite(){melkino_register_property_content();melkino_register_stage_two_content();flush_rewrite_rules();}
add_action('after_switch_theme','melkino_property_flush_rewrite');
function melkino_stage_two_rewrite_refresh(){
    if (get_option('melkino_stage_two_rewrite_version') !== '2') {
        melkino_register_property_content(); melkino_register_stage_two_content(); flush_rewrite_rules(false); update_option('melkino_stage_two_rewrite_version','2');
    }
}
add_action('init','melkino_stage_two_rewrite_refresh',99);
function melkino_property_meta($id,$key,$default=''){ $v=get_post_meta($id,'_melkino_'.$key,true);return $v!==''?$v:$default; }
function melkino_price($value){if(!$value)return 'تماس بگیرید';return number_format_i18n((float)preg_replace('/[^0-9.]/','',$value)).' تومان';}
