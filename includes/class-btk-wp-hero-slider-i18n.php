<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://linktr.ee/armancs
 * @since      1.0.0
 *
 * @package    Btk_Wp_Hero_Slider
 * @subpackage Btk_Wp_Hero_Slider/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Btk_Wp_Hero_Slider
 * @subpackage Btk_Wp_Hero_Slider/includes
 * @author     Arman H <bluetekbd@gmail.com>
 */
class Btk_Wp_Hero_Slider_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'btk-wp-hero-slider',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
