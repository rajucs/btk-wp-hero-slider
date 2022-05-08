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
			// autoplay: true,
			infinite: false,
			speed: 300,
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
		$('.btk-show-popup-form').on('click', function () {
			$('#btk-show-popup-form-modal').modal('show');
		})
		$('#btk-download-form').on('submit', function (e) {
			e.preventDefault();  //stop the browser from following
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

		})
	})

})(jQuery);
