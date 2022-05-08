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
    if (!empty($sliders)) :
?>
        <section id="btk-wp-hero" class="btk-wp-slider">
            <div class="btk-hero-slider">
                <?php foreach ($sliders as $slider) : ?>
                    <div>
                        <div class="hero-child " style="background-image: url(<?php echo wp_get_attachment_image_url((int)$slider->slider_image, 'full'); ?>);">
                            <div class="container position-relative h-100">
                                <div class="row align-items-start align-items-md-center h-100">
                                    <div class="btk-col-md-6">
                                        <div class="hero-content">
                                            <?php if ($slider->show_site_logo) : ?>
                                                <div class="btk-logo">
                                                    <img src="<?php echo (!empty($site_logo_img_url)) ? $site_logo_img_url : $es_site_logo_img; ?>" alt="">
                                                </div>
                                            <?php endif; ?>
                                            <h1 class="btk-wp-head-title">
                                                <?php echo $slider->slider_title; ?>
                                            </h1>
                                            <p class="pra-1 btk-text-white">
                                                <?php echo $slider->slider_paragraph; ?>
                                            </p>
                                            <div class="hero-btn-parent">
                                                <?php if ($slider->show_popup_form) : ?>
                                                    <button type="button" class="btk-btn download-btn btk-show-popup-form"><i class="fa fa-download"></i><?php echo $slider->slider_btn_text; ?></button>
                                                <?php else : ?>
                                                    <a href="<?php echo wp_get_attachment_url($slider->slider_btn_dl_link); ?>" class="download-btn" download="Building Broucher"><?php echo $slider->slider_btn_text; ?></a>
                                                <?php endif; ?>
                                            </div>
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

        <!-- Modal -->
        <div class="modal fade" id="btk-show-popup-form-modal" tabindex="-1" role="dialog" aria-labelledby="btk-show-popup-form-modalTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form method="post" id="btk-download-form">
                        <div class="modal-header">
                            <h5 class="modal-title" id="btk-show-popup-form-modalTitle">Download Form</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="btk-subscribe-name">Name</label>
                                <input type="text" class="form-control" id="btk-subscribe-name" placeholder="John Doe" required>
                            </div>
                            <div class="form-group">
                                <label for="btk-subscribe-email">Email address</label>
                                <input type="email" class="form-control" id="btk-subscribe-email" placeholder="name@example.com" required>
                            </div>
                            <div class="form-group">
                                <label for="btk-subscribe-phone">Phone Number</label>
                                <input type="text" class="form-control" id="btk-subscribe-phone">
                            </div>
                            <input type="hidden" value="<?php echo wp_get_attachment_url($slider->slider_btn_dl_link); ?>" id="btk-downloaded-file">
                        </div>
                        <div class="modal-footer modal-btn-parent">
                            <button type="button" class="btk-btn btk-secondary-btn" data-dismiss="modal">Close</button>
                            <button type="submit" class="btk-btn modal-download-btn btk-download-modal-file">Download</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
<?php endif;
endif;
