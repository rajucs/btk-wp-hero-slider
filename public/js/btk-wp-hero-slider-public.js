(function ($) {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
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
		$('.btk-hero-slider').slick({
			dots: true,
			autoplay: true,
			infinite: false,
			speed: 3000,
			slidesToShow: 1,
			slidesToScroll: 1,
			responsive: [
				{
					breakpoint: 1024,
					settings: {
						slidesToShow: 1,
						slidesToScroll: 1,
						infinite: true,
						dots: true
					}
				},
				{
					breakpoint: 600,
					settings: {
						slidesToShow: 1,
						slidesToScroll: 1
					}
				},
				{
					breakpoint: 480,
					settings: {
						slidesToShow: 1,
						slidesToScroll: 1
					}
				}
				// You can unslick at a given breakpoint now by adding:
				// settings: "unslick"
				// instead of a settings object
			]
		});
		var btkBuildingTitle;
		$('.btk-show-popup-form').on('click', function () {
			var downloadFile = $(this).data('download-file');
			btkBuildingTitle = $(this).data('building-title');
			$('#btk-show-popup-form-modal form #btk-download-file').html(`
				<input type="hidden" value="`+ downloadFile + `" id="btk-downloaded-file">
			`)
			$('#btk-show-popup-form-modal').modal('show');
		})
		var input = $('.validate-input .btk-input-field');

		$('#btk-download-form').on('submit', function (e) {
			e.preventDefault();  //stop the browser from following
			var check = true;
			var formData = $(this).serialize();
			for (var i = 0; i < input.length; i++) {
				if (btkFormValidate(input[i]) == false) {
					btkShowValidate(input[i]);
					check = false;
				}
			}

			if (check) {

				var btkDownloadFile = $('#btk-downloaded-file').val();
				// window.location.href = btkDownloadFile;
				// window.open(btkDownloadFile , '_blank');
				var link = document.createElement("a");
				// If you don't know the name or want to use
				// the webserver default set name = ''
				link.setAttribute('download', 'Download Broucer');
				link.href = btkDownloadFile;
				document.body.appendChild(link);
				link.click();
				btkHideValidate(input)
				jQuery.ajax({
					url: btk_wp_obj.ajax_url,
					type: "POST",
					data: {
						action: "btk_wp_file_downloaded",
						btkBuildingTitle: btkBuildingTitle,
						formData: formData,
						security: btk_wp_obj.nonce,
					},
					success: function (data) {
						console.log(data)
					},
					error: function (xhr, status, error) {
						var errorMessage = xhr.status + ": " + xhr.statusText;
						alert("Error - " + errorMessage);
					},
				})
			}

		})



		/*[ Validate ]*/

		$('.validate-form .btk-input-field').each(function () {
			$(this).focus(function () {
				btkHideValidate(this);
			});
		});

		function btkFormValidate(input) {
			if ($(input).attr('type') == 'email' || $(input).attr('name') == 'email') {
				if ($(input).val().trim().match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/) == null) {
					return false;
				}
			}
			else {
				if ($(input).val().trim() == '') {
					return false;
				}
			}
		}

		function btkShowValidate(input) {
			var thisAlert = $(input).parent();

			$(thisAlert).addClass('alert-validate');
		}

		function btkHideValidate(input) {
			var thisAlert = $(input).parent();

			$(thisAlert).removeClass('alert-validate');
		}


	})

})(jQuery);
