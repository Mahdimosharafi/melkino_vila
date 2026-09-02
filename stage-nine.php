<?php
/** Stage 9 extra footer pages: buying guide, selling guide, sitemap, terms, FAQ. */
if (!defined('ABSPATH')) exit;

function melkino_stage_nine_page($slug,$title){
    $page=get_page_by_path($slug,OBJECT,'page');
    if(!$page){
        $id=wp_insert_post(array(
            'post_title'=>$title,
            'post_name'=>$slug,
            'post_status'=>'publish',
            'post_type'=>'page',
            'post_content'=>''
        ),true);
        if(!is_wp_error($id)&&$id) $page=get_post($id);
    }
    return $page;
}

function melkino_stage_nine_ensure_pages(){
    melkino_stage_nine_page('buying-guide','راهنمای خرید');
    melkino_stage_nine_page('selling-guide','راهنمای فروش');
    melkino_stage_nine_page('sitemap','سایت مپ');
    melkino_stage_nine_page('terms','شرایط و قوانین');
    melkino_stage_nine_page('faq','سوالات متداول');
    if(get_option('melkino_stage_nine_pages_version')!=='2'){
        update_option('melkino_stage_nine_pages_version','2',false);
        flush_rewrite_rules(false);
    }
}
add_action('init','melkino_stage_nine_ensure_pages',31);

function melkino_stage_nine_template_include($template){
    $map=array(
        'buying-guide'=>'page-buying-guide.php',
        'selling-guide'=>'page-selling-guide.php',
        'sitemap'=>'page-sitemap.php',
        'terms'=>'page-terms.php',
        'faq'=>'page-faq.php'
    );
    foreach($map as $slug=>$file){
        if(is_page($slug)){
            $custom=get_template_directory().'/'.$file;
            if(file_exists($custom)) return $custom;
        }
    }
    return $template;
}
add_filter('template_include','melkino_stage_nine_template_include');
