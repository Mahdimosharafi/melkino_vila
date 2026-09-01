<?php
/** Stage 4: front-end property submission workflow. */
if (!defined('ABSPATH')) exit;

function melkino_stage_four_setup() {
    if (!get_page_by_path('submit-property')) {
        wp_insert_post(array(
            'post_title' => 'ثبت ملک',
            'post_name' => 'submit-property',
            'post_status' => 'publish',
            'post_type' => 'page',
        ));
    }
}
add_action('init','melkino_stage_four_setup',20);

function melkino_stage_four_template($template) {
    if (is_page('submit-property')) {
        $custom = get_template_directory() . '/page-submit-property.php';
        if (file_exists($custom)) return $custom;
    }
    return $template;
}
add_filter('template_include','melkino_stage_four_template');

function melkino_stage_four_assets() {
    if (is_page('submit-property')) {
        wp_enqueue_style('melkino-stage-four',get_template_directory_uri().'/stage-four.css',array('melkino-style'),wp_get_theme()->get('Version'));
    }
}
add_action('wp_enqueue_scripts','melkino_stage_four_assets',30);

function melkino_handle_property_submission() {
    if (!isset($_POST['melkino_submit_property'])) return;
    if (!isset($_POST['melkino_submit_nonce']) || !wp_verify_nonce($_POST['melkino_submit_nonce'],'melkino_submit_property')) return;

    $title = sanitize_text_field(wp_unslash($_POST['property_title'] ?? ''));
    $description = wp_kses_post(wp_unslash($_POST['property_description'] ?? ''));
    $phone = sanitize_text_field(wp_unslash($_POST['property_phone'] ?? ''));
    if (!$title || !$phone) {
        set_transient('melkino_submit_error_'.wp_get_session_token(), 'لطفاً عنوان ملک و شماره تماس را وارد کنید.', 60);
        wp_safe_redirect(wp_get_referer() ?: home_url('/submit-property/')); exit;
    }

    $post_id = wp_insert_post(array(
        'post_type'=>'property',
        'post_title'=>$title,
        'post_content'=>$description,
        'post_excerpt'=>wp_trim_words(wp_strip_all_tags($description),30),
        'post_status'=>'pending',
        'post_author'=>get_current_user_id() ?: 0,
    ),true);

    if (is_wp_error($post_id)) {
        set_transient('melkino_submit_error_'.wp_get_session_token(), 'ثبت ملک انجام نشد. دوباره تلاش کنید.', 60);
        wp_safe_redirect(wp_get_referer() ?: home_url('/submit-property/')); exit;
    }

    $fields = array('price','area_size','bedrooms','bathrooms','year_built','address','phone');
    foreach ($fields as $key) {
        if (isset($_POST['property_'.$key])) {
            update_post_meta($post_id,'_melkino_'.$key,sanitize_text_field(wp_unslash($_POST['property_'.$key])));
        }
    }
    update_post_meta($post_id,'_melkino_featured','0');

    foreach (array('property_type'=>'property_type','property_area'=>'property_area','property_deal'=>'property_deal') as $field=>$taxonomy) {
        if (!empty($_POST[$field])) wp_set_object_terms($post_id,(int)$_POST[$field],$taxonomy,false);
    }

    if (!empty($_FILES['property_images']['name'][0])) {
        require_once ABSPATH.'wp-admin/includes/file.php';
        require_once ABSPATH.'wp-admin/includes/media.php';
        require_once ABSPATH.'wp-admin/includes/image.php';
        $files = $_FILES['property_images'];
        $first_attachment = 0;
        foreach ($files['name'] as $i=>$name) {
            if (!$name || $files['error'][$i] !== UPLOAD_ERR_OK) continue;
            $file = array('name'=>$files['name'][$i],'type'=>$files['type'][$i],'tmp_name'=>$files['tmp_name'][$i],'error'=>$files['error'][$i],'size'=>$files['size'][$i]);
            $_FILES['melkino_single_image'] = $file;
            $attachment_id = media_handle_upload('melkino_single_image',$post_id);
            if (!is_wp_error($attachment_id)) {
                if (!$first_attachment) $first_attachment = $attachment_id;
            }
        }
        unset($_FILES['melkino_single_image']);
        if ($first_attachment) set_post_thumbnail($post_id,$first_attachment);
    }

    set_transient('melkino_submit_success_'.wp_get_session_token(), 'ملک شما با موفقیت ثبت شد و پس از بررسی مدیر منتشر خواهد شد.', 120);
    wp_safe_redirect(add_query_arg('submitted','1',get_permalink(get_page_by_path('submit-property')))); exit;
}
add_action('template_redirect','melkino_handle_property_submission');

function melkino_submit_notice($type) {
    $key = 'melkino_submit_'.($type==='success'?'success':'error').'_'.wp_get_session_token();
    $message = get_transient($key);
    if ($message) delete_transient($key);
    return $message;
}
