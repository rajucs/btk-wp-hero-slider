<?php
// $slider_data = get_post((int)$atts['sliderid']);
$slider_data = get_post_meta((int)$atts['sliderid'], 'btk_all_slider_data', true);
$sliders = json_decode(stripslashes($slider_data), false);
$site_logo = get_theme_mod('custom_logo');
$site_logo_img = wp_get_attachment_image_src($site_logo, 'full');
$site_logo_img_url = $site_logo_img[0];
global $ef_options;
$es_logo_attachment_id = $ef_options->get( 'logo_attachment_id' );
$es_site_logo_img = wp_get_attachment_image_src($es_logo_attachment_id, 'full')[0];
if (!empty($sliders)) :
?>
    <section class="btk-wp-slider">
        <div class="btk-hero-slider">
            <?php foreach ($sliders as $slider) : ?>
                <div class="btk-position-relative btk-slider-item">
                    <img class="btk-w-100" src="<?php echo wp_get_attachment_image_url((int)$slider->slider_image, 'full'); ?>" class="btk-preview-img">
                    <div class="btk-overlay"></div>
                    <div class="btk-position-absolute btk-slider-title-button">
                        <div class="btk-logo">
                            <img src="<?php echo (!empty($site_logo_img_url)) ? $site_logo_img_url : $es_site_logo_img; ?>" alt="">
                        </div>
                        <h1 class="btk-text-white"><?php echo $slider->slider_title; ?></h1>
                        <div class="btk-download-btn">
                            <button type="button" class="btk-btn btk-btn-primary"><i class="fa fa-download"></i><?php echo $slider->slider_btn_text; ?></button>
                        </div>
                    </div>
                    <div class="btk-position-absolute btk-slider-overlay-img">
                        <img src="<?php echo wp_get_attachment_image_url((int)$slider->slider_overlay_image, 'full'); ?>" alt="">
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
<?php endif;
