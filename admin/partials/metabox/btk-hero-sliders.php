<?php
$slider_data = get_post_meta($post->ID, 'btk_all_slider_data', true);
$sliders = json_decode(stripslashes($slider_data), false);
if (!empty($sliders)) :
    $total_slider = count((array)$sliders);
else :
    $total_slider = 0;
endif;
?>
<div class="bootstrap">
    <div class="btk-sliders-lists">
        <div class="row">
            <div class="col-12 text-right">
                <button type="button" class="btn btn-primary btn-sm" id="btk-add-new-slide" data-total-slider="<?php echo $total_slider; ?>"><span class="dashicons dashicons-plus-alt"></span> New Slider</button>
            </div>
        </div>
        <div class="row btk-single-slider-panel-settings">
            <div class="col-12 pt-3">
                <div class="accordion" id="btk-wp-hero-slider-accordion">
                    <?php
                    if (!empty($sliders)) :
                        $slider_loop = 1;
                        foreach ($sliders as $slider) :
                            // var_dump($slider);
                            // exit();
                    ?>
                            <div class="card mt-2 p-0 m-0">
                                <div class="card-header p-0 d-flex justify-content-between" id="btk-heading-<?php echo $slider_loop; ?>">
                                    <h5 class="mb-0 p-2">
                                        #slider<?php echo $slider_loop; ?>
                                    </h5>
                                    <div>
                                        <button class=" btn" type="button" data-toggle="collapse" data-target="#collapse-btk-slider-<?php echo $slider_loop; ?>" aria-expanded="true" aria-controls="collapse-btk-slider-<?php echo $slider_loop; ?>"><span class="dashicons dashicons-minus"></span></button>
                                        <button class="btk-wp-remove-slider btn" type="button"><span class="text-danger dashicons dashicons-trash"></span></button>
                                    </div>
                                </div>
                                <div id="collapse-btk-slider-<?php echo $slider_loop; ?>" class="collapse <?php echo ($slider_loop==1)? 'show':''; ?>" aria-labelledby="btk-heading-<?php echo $slider_loop; ?>" data-parent="#btk-wp-hero-slider-accordion">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-3 col-12">
                                                <div>
                                                    <p class="mb-0">Slider Image</p>
                                                    <label class="dragBox btk-slider-image-upload-<?php echo $slider_loop; ?>" for="btk-slider-imge-upload-<?php echo $slider_loop; ?>">
                                                        upload image
                                                        <input type="file" class="btk-slider-image-upload" data-serial='<?php echo $slider_loop; ?>' id="btk-slider-imge-upload-<?php echo $slider_loop; ?>" data-name="btk_slider_images[]" value="<?php echo $slider->slider_image; ?>" />
                                                        <div class="btk-hidden-field">
                                                            <input type="hidden" name="btk_slider_images[]" value="<?php echo $slider->slider_image; ?>">
                                                        </div>
                                                        <div id="preview">
                                                            <img src="<?php echo wp_get_attachment_image_url((int)$slider->slider_image, 'full'); ?>" class="btk-preview-img">
                                                        </div>
                                                    </label>
                                                </div>
                                                <div>
                                                    <p class="mb-0">Overlay Front Image</p>
                                                    <label class="dragBox btk-overlay-front-image-upload-<?php echo $slider_loop; ?>" for="btk-slider-front-img-upload-<?php echo $slider_loop; ?>">
                                                        upload image
                                                        <input type="file" class="btk-overlay-front-image-upload" data-serial='<?php echo $slider_loop; ?>' id="btk-slider-front-img-upload-<?php echo $slider_loop; ?>" data-name="btk_overlay_front_images[]" value="<?php echo $slider->slider_overlay_image; ?>" />
                                                        <div class="btk-hidden-field">
                                                            <input type="hidden" name="btk_overlay_front_images[]" value="<?php echo $slider->slider_overlay_image; ?>">
                                                        </div>
                                                        <div id="preview">
                                                            <img src="<?php echo wp_get_attachment_image_url((int)$slider->slider_overlay_image, 'full'); ?>" class="btk-preview-img">
                                                        </div>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-9 col-12">
                                                <div class="form-group">
                                                    <label for="btk-slider-title">Title</label>
                                                    <input type="text" name="btk_slider_title[]" class="form-control form-control-sm" id="btk-slider-title" value="<?php echo $slider->slider_title; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="btk-slider-paragraph">Paragraph</label>
                                                    <input type="text" name="btk_slider_paragraph[]" class="form-control form-control-sm" id="btk-slider-paragraph" value="<?php echo $slider->slider_paragraph; ?>">
                                                </div>
                                                <div class="form-group form-check">
                                                    <input type="checkbox" class="form-check-input" id="btk-show-download-btn" value="1" <?php echo ($slider->show_download_btn == 1) ? 'checked' : ''; ?> name="btk_show_download_btn[]">
                                                    <label class="form-check-label" for="btk-show-download-btn">Show Download Button.</label>
                                                </div>
                                                <div class="form-group">
                                                    <label for="btk-slider-btn-text">Button Text</label>
                                                    <input type="text" name="btk_slider_btn_text[]" class="form-control form-control-sm" id="btk-slider-btn-text" placeholder="text" value="<?php echo $slider->slider_btn_text; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="btk-slider-btn-downloadlink">Button Download Link</label>
                                                    <input type="text" class="btk-slider-btn-downloadlink form-control form-control-sm" id="btk-slider-btn-downloadlink" placeholder="link" readonly value="<?php echo wp_get_attachment_url($slider->slider_btn_dl_link); ?>">
                                                    <input type="hidden" value="<?php echo $slider->slider_btn_dl_link; ?>" name="btk_slider_btn_downloadlink[]">
                                                </div>
                                                <div class="form-group form-check">
                                                    <input type="checkbox" class="form-check-input" id="btk-show-popup-form" value="1" <?php echo ($slider->show_popup_form == 1) ? 'checked' : ''; ?> name="btk_show_popup_form[]">
                                                    <label class="form-check-label" for="btk-show-popup-form">Show popup form before downloading.</label>
                                                </div>
                                                <div class="form-group form-check">
                                                    <input type="checkbox" class="form-check-input" id="btk-show-site-logo" value="1" <?php echo ($slider->show_site_logo == 1) ? 'checked' : ''; ?> name="btk_show_site_logo[]">
                                                    <label class="form-check-label" for="btk-show-site-logo">Show site logo.</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php
                            $slider_loop++;
                        endforeach;
                    endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>



<script>
    jQuery(document).ready(function($) {
        // Uploading files for slider images
        var file_frame;
        var wp_media_post_id = wp.media.model.settings.post.id; // Store the old id
        var set_to_post_id = <?php echo $post->ID; ?>; // Set this
        jQuery(document).on('click', '.btk-slider-image-upload', function(event) {
            event.preventDefault();
            var thisBtnSerial = $(this).data('serial')
            var nameField = $(this).data('name')
            // Create the media frame.
            file_frame = wp.media.frames.file_frame = wp.media({
                title: 'Select images to upload',
                button: {
                    text: 'Add',
                },
                multiple: false // Set to true to allow multiple files to be selected
            });

            // When an image is selected, run a callback.
            file_frame.on('select', function() {
                // We set multiple to false so only get one image from the uploader
                attachment = file_frame.state().get('selection').first().toJSON();
                // Do something with attachment.id and/or attachment.url here
                // $('#image-preview').attr('src', attachment.url).css('width', '80px');
                console.log('.btk-slider-image-upload-' + thisBtnSerial + ' #preview')
                $('.btk-slider-image-upload-' + thisBtnSerial + ' .btk-hidden-field').html('<input type="hidden" name="' + nameField + '" value="' + attachment.id + '">');
                // Restore the main post ID
                $('.btk-slider-image-upload-' + thisBtnSerial + ' #preview').html('<img src="' + attachment.url + '" class="btk-preview-img">')
                wp.media.model.settings.post.id = wp_media_post_id;
            });
            // Finally, open the modal
            file_frame.open();
        });
        jQuery(document).on('click', '.btk-overlay-front-image-upload', function(event) {
            event.preventDefault();
            var thisBtnSerial = $(this).data('serial')
            var nameField = $(this).data('name')
            // Create the media frame.
            file_frame = wp.media.frames.file_frame = wp.media({
                title: 'Select images to upload',
                button: {
                    text: 'Add',
                },
                multiple: false // Set to true to allow multiple files to be selected
            });

            // When an image is selected, run a callback.
            file_frame.on('select', function() {
                // We set multiple to false so only get one image from the uploader
                attachment = file_frame.state().get('selection').first().toJSON();
                // Do something with attachment.id and/or attachment.url here
                // $('#image-preview').attr('src', attachment.url).css('width', '80px');
                console.log('.btk-overlay-front-image-upload-' + thisBtnSerial + ' #preview')
                $('.btk-overlay-front-image-upload-' + thisBtnSerial + ' .btk-hidden-field').html('<input type="hidden" name="' + nameField + '" value="' + attachment.id + '">');
                // Restore the main post ID
                $('.btk-overlay-front-image-upload-' + thisBtnSerial + ' #preview').html('<img src="' + attachment.url + '" class="btk-preview-img">')
                wp.media.model.settings.post.id = wp_media_post_id;
            });
            // Finally, open the modal
            file_frame.open();
        });
        jQuery(document).on('click', '.btk-slider-btn-downloadlink', function(event) {
            event.preventDefault();
            var thisData = jQuery(this);
            // Create the media frame.
            file_frame = wp.media.frames.file_frame = wp.media({
                title: 'Select images to upload',
                button: {
                    text: 'Add',
                },
                multiple: false // Set to true to allow multiple files to be selected
            });

            // When an image is selected, run a callback.
            file_frame.on('select', function() {
                // We set multiple to false so only get one image from the uploader
                attachment = file_frame.state().get('selection').first().toJSON();
                // Do something with attachment.id and/or attachment.url here
                // Restore the main post ID
                thisData.val(attachment.url)
                thisData.after('<input type="hidden" value=' + attachment.id + ' name="btk_slider_btn_downloadlink[]">')
                wp.media.model.settings.post.id = wp_media_post_id;
            });
            // Finally, open the modal
            file_frame.open();
        });
        // Restore the main ID when the add media button is pressed
        jQuery('a.add_media').on('click', function() {
            wp.media.model.settings.post.id = wp_media_post_id;
        });
    });
</script>