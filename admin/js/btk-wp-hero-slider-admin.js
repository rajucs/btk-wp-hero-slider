(function ($) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

	$(document).ready(function () {
		var newSlider = parseInt($('#btk-add-new-slide').data('total-slider'));
		$('#btk-add-new-slide').on('click', function () {
			newSlider++;
			$('#btk-wp-hero-slider-accordion').append(`
			<div class="card mt-2 p-0 m-0">
				<div class="card-header p-0 d-flex justify-content-between" id="btk-heading-`+ newSlider + `">
					<h5 class="mb-0 p-2">
						#slider`+ newSlider + `
					</h5>
					<div>
						<button class=" btn" type="button" data-toggle="collapse" data-target="#collapse-btk-slider-`+ newSlider + `" aria-expanded="true" aria-controls="collapse-btk-slider-` + newSlider + `"><span class="dashicons dashicons-minus"></span></button>
						<button class="btk-wp-remove-slider btn" type="button"><span class="text-danger dashicons dashicons-trash"></span></button>
					</div>
				</div>
				<div id="collapse-btk-slider-`+ newSlider + `" class="collapse show" aria-labelledby="btk-heading-` + newSlider + `" data-parent="#btk-wp-hero-slider-accordion">
					<div class="card-body">
						<div class="row">
							<div class="col-md-3 col-12">
								<div>
									<p class="mb-0">Slider Image</p>
									<label class="dragBox btk-slider-image-upload-`+ newSlider + `" for="btk-slider-image-upload-` + newSlider + `">
										upload image
										<input type="file" class="btk-slider-image-upload" data-serial='`+ newSlider + `' id="btk-slider-image-upload-` + newSlider + `" data-name="btk_slider_images[]" />
										<div class="btk-hidden-field"></div>
										<div id="preview"></div>
									</label>
								</div>
								<div>
									<p class="mb-0">Overlay Front Image</p>
									<label class="dragBox btk-overlay-front-image-upload-`+ newSlider + `" for="btk-overlay-front-image-upload-` + newSlider + `">
										upload image
										<input type="file" class="btk-overlay-front-image-upload" data-serial='`+ newSlider + `' id="btk-overlay-front-image-upload-` + newSlider + `" data-name="btk_overlay_front_images[]" />
										<div class="btk-hidden-field"></div>
										<div id="preview"></div>
									</label>
								</div>
							</div>
							<div class="col-md-9 col-12">
								<div class="form-group">
									<label for="btk-slider-title">Title</label>
									<input type="text" name="btk_slider_title[]" class="form-control form-control-sm" id="btk-slider-title" placeholder="Title">
								</div>
								<div class="form-group">
									<label for="btk-slider-btn-text">Button Text</label>
									<input type="text" name="btk_slider_btn_text[]" class="form-control form-control-sm" id="btk-slider-btn-text" placeholder="text">
								</div>
								<div class="form-group">
									<label for="btk-slider-btn-downloadlink">Button Download Link</label>
									<input type="text" class="btk-slider-btn-downloadlink form-control form-control-sm" id="btk-slider-btn-downloadlink" placeholder="link" readonly>
								</div>
								<div class="form-group form-check">
									<input type="checkbox" class="form-check-input" id="btk-show-popup-form" value="1" name="btk_show_popup_form[]>
									<label class="form-check-label" for="btk-show-popup-form">Show popup form before downloading.</label>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			`);
		})
		$(document).on('click', '.btk-wp-remove-slider', function () {
			const swalWithBootstrapButtons = Swal.mixin({
				customClass: {
					container: 'bootstrap',
					confirmButton: 'btn btn-success btn-sm ',
					cancelButton: 'btn btn-danger btn-sm mr-2'
				},
				buttonsStyling: false
			})

			swalWithBootstrapButtons.fire({
				title: 'Are you sure?',
				text: "You won't be able to revert this!",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonText: 'Yes, delete it!',
				cancelButtonText: 'No, cancel!',
				reverseButtons: true
			}).then((result) => {
				if (result.isConfirmed) {
					$(this).parent().parent().parent().remove();
					swalWithBootstrapButtons.fire(
						'Deleted!',
						'Slider has been removed.',
						'success'
					)
				} else if (
					/* Read more about handling dismissals below */
					result.dismiss === Swal.DismissReason.cancel
				) {
					swalWithBootstrapButtons.fire(
						'Cancelled',
						'Slider removing cancelled :)',
						'error'
					)
				}
			})
		})
	})

})(jQuery);
