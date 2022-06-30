<?php
// $slider_data = get_post((int)$atts['sliderid']);
if (get_post_status((int)$atts['sliderid']) == 'publish') :
    $slider_data = get_post_meta((int)$atts['sliderid'], 'btk_all_slider_data', true);
    $sliders = json_decode(stripslashes($slider_data), false);
    $site_logo = get_theme_mod('custom_logo');
    $site_logo_img = wp_get_attachment_image_src($site_logo, 'full');
    $site_logo_img_url = $site_logo_img[0];
    global $ef_options;
    $es_logo_attachment_id = $ef_options->get('logo_attachment_id');
    $es_site_logo_img = wp_get_attachment_image_src($es_logo_attachment_id, 'full')[0];
    $bk_global_settings = json_decode(get_option('bk_hero_slider_global_settings'));

    if (!empty($sliders)) :
?>
        <style>
            .download-btn,
            .btk-form-download-form-btn {
                background-color: <?php echo ($bk_global_settings->bk_global_btn_bg != '') ? $bk_global_settings->bk_global_btn_bg : 'green'; ?>;
                color: <?php echo ($bk_global_settings->bk_global_btn_color != '') ? $bk_global_settings->bk_global_btn_color : 'white'; ?>;
            }
        </style>
        <section id="btk-wp-hero" class="btk-wp-slider">
            <div class="btk-hero-slider">
                <?php foreach ($sliders as $slider) : ?>
                    <div>
                        <div class="hero-child " style="background-image: url(<?php echo wp_get_attachment_image_url((int)$slider->slider_image, 'full'); ?>);">
                            <div class="container position-relative h-100">
                                <div class="row align-items-start align-items-md-center h-100">
                                    <div class="btk-col-md-6">
                                        <div class="hero-content">
                                            <?php if ($slider->btk_owner_signature) : ?>
                                                <div class="btk-signature">
                                                    <img src="<?php echo (!empty($slider->btk_owner_signature)) ? wp_get_attachment_image_url((int)$slider->btk_owner_signature, 'full') : ''; ?>" alt="">
                                                </div>
                                            <?php endif; ?>
                                            <?php if ($slider->show_site_logo) : ?>
                                                <div class="btk-logo">
                                                    <img src="<?php echo (!empty($slider->site_logo)) ? wp_get_attachment_image_url((int)$slider->site_logo, 'full') : $site_logo_img_url; ?>" alt="">
                                                </div>
                                            <?php endif; ?>
                                            <h1 class="btk-wp-head-title">
                                                <?php echo $slider->slider_title; ?>
                                            </h1>
                                            <p class="pra-1 btk-text-white">
                                                <?php echo $slider->slider_paragraph; ?>
                                            </p>
                                            <?php if ($slider->show_download_btn) : ?>
                                                <div class="hero-btn-parent">
                                                    <?php if ($slider->show_popup_form) : ?>
                                                        <button type="button" class="btk-btn download-btn btk-show-popup-form" data-download-file="<?php echo wp_get_attachment_url($slider->slider_btn_dl_link); ?>" data-building-title="<?php echo $slider->slider_title; ?>"><i class="fa fa-download"></i><?php echo $slider->slider_btn_text; ?></button>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="btk-col-md-6 ">
                                        <div class="hero-small-box">
                                            <img src="<?php echo wp_get_attachment_image_url((int)$slider->slider_overlay_image, 'full'); ?>" alt="" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
<?php endif;
endif;
