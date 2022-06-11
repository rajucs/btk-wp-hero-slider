<?php
$bk_global_settings = json_decode(get_option('bk_hero_slider_global_settings'));
?>
<div class="bootstrap">
    <div class="container mt-5 py-3">
        <div class="row">
            <div class="col-3">
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link active" id="v-pills-building-settings-tab" data-toggle="pill" href="#v-pills-building-settings" role="tab" aria-controls="v-pills-building-settings" aria-selected="true">Settings</a>
                </div>
            </div>
            <div class="col-9">
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-building-settings" role="tabpanel" aria-labelledby="v-pills-building-settings-tab">
                        <form action="" method="post" id="bk-hero-slider-global-settings">
                            <div class="form-group">
                                <label for="bk-building-global-btn-bg" class="pr-4">Button Background :</label>
                                <input type="text" value="<?php echo ($bk_global_settings->bk_global_btn_bg != '') ? $bk_global_settings->bk_global_btn_bg : 'green'; ?>" class="bk-building-color-field" data-default-color="#effeff" name="bk_global_btn_bg" />
                            </div>
                            <div class="form-group">
                                <label for="bk-building-global-btn-color" class="pr-4">Button Text Color :</label>
                                <input type="text" value="<?php echo ($bk_global_settings->bk_global_btn_color != '') ? $bk_global_settings->bk_global_btn_color : 'green'; ?>" class="bk-building-color-field" data-default-color="#effeff" name="bk_global_btn_color" />
                            </div>
                            <!-- <div class="form-group">
                                <label for="bk-building-contact-form-bg" class="pr-4">Contact Form Background :</label>
                                <input type="text" value="<?php echo ($bk_global_settings->bk_contact_form_bg != '') ? $bk_global_settings->bk_contact_form_bg : 'green'; ?>" class="bk-building-color-field" data-default-color="#effeff" name="bk_building_contact_form_bg" />
                            </div> -->
                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-success btn-sm">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    jQuery(document).ready(function($) {
        $('.bk-building-color-field').wpColorPicker();
    });
</script>