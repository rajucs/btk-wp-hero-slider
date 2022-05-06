<?

if ($post->post_type == 'bk-hero-slider') {
    echo '3333';
    exit();
    $btk_slider_metas = [];
    // for ($total = 0; $total <= $total_slider; $total++) {
    foreach ($_POST['btk_slider_title'] as $k => $v) {
        $btk_slider_metas[] = array(
            'slider_image' => $_POST['btk_slider_images'][$k],
            'slider_overlay_image' => $_POST['btk_overlay_front_images'][$k],
            'slider_title' => $_POST['btk_slider_title'][$k],
            'slider_btn_text' => $_POST['btk_slider_btn_text'][$k],
            'slider_btn_dl_link' => $_POST['btk_slider_btn_downloadlink'][$k],
            'show_popup_form' => $_POST['btk_show_popup_form'][$k],
        );
    }

    $slider_metas = json_encode($btk_slider_metas, JSON_FORCE_OBJECT);
    update_post_meta($post->ID, 'btk_slider_data', $slider_metas);
}
