<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://linktr.ee/armancs
 * @since      1.0.0
 *
 * @package    Btk_Wp_Hero_Slider
 * @subpackage Btk_Wp_Hero_Slider/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Btk_Wp_Hero_Slider
 * @subpackage Btk_Wp_Hero_Slider/public
 * @author     Arman H <bluetekbd@gmail.com>
 */
class Btk_Wp_Hero_Slider_Public
{

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Btk_Wp_Hero_Slider_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Btk_Wp_Hero_Slider_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_enqueue_style($this->plugin_name . '-bootstrap-style', plugin_dir_url(plugin_dir_path(__FILE__))  . 'assets/bootstrap/css/bootstrap.min.css', array(), $this->version, 'all');
		wp_enqueue_style($this->plugin_name . '-slick-css', plugin_dir_url(plugin_dir_path(__FILE__))  . 'assets/slick/slick.css', array(), $this->version, 'all');
		wp_enqueue_style($this->plugin_name . '-slick-theme-css', plugin_dir_url(plugin_dir_path(__FILE__))  . 'assets/slick/slick-theme.css', array(), $this->version, 'all');
		wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/btk-wp-hero-slider-public.css', array(), $this->version, 'all');
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Btk_Wp_Hero_Slider_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Btk_Wp_Hero_Slider_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_enqueue_script('jquery');

		wp_enqueue_script($this->plugin_name . '-bootstrap-popper', plugin_dir_url(plugin_dir_path(__FILE__)) . 'assets/bootstrap/js/popper.min.js', array('jquery'), $this->version, false);

		wp_enqueue_script($this->plugin_name . '-bootstrap-min', plugin_dir_url(plugin_dir_path(__FILE__)) . 'assets/bootstrap/js/bootstrap.min.js', array('jquery'), $this->version, false);

		wp_enqueue_script($this->plugin_name . '-slick-min-js', plugin_dir_url(plugin_dir_path(__FILE__)) . 'assets/slick/slick.min.js', array('jquery'), $this->version, false);

		wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/btk-wp-hero-slider-public.js', array('jquery'), $this->version, false);
	}
	
	public function btk_wp_hero_slider()
	{
		ob_start();
		include_once('partials/btk-wp-hero-slider-public-display.php');
		$content = ob_get_contents();
		ob_end_clean();
		return $content;
	}
}
