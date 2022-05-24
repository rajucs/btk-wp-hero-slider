<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://linktr.ee/armancs
 * @since      1.0.0
 *
 * @package    Btk_Wp_Hero_Slider
 * @subpackage Btk_Wp_Hero_Slider/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Btk_Wp_Hero_Slider
 * @subpackage Btk_Wp_Hero_Slider/includes
 * @author     Arman H <bluetekbd@gmail.com>
 */
class Btk_Wp_Hero_Slider
{

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Btk_Wp_Hero_Slider_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct()
	{
		if (defined('BTK_WP_HERO_SLIDER_VERSION')) {
			$this->version = BTK_WP_HERO_SLIDER_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'btk-wp-hero-slider';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Btk_Wp_Hero_Slider_Loader. Orchestrates the hooks of the plugin.
	 * - Btk_Wp_Hero_Slider_i18n. Defines internationalization functionality.
	 * - Btk_Wp_Hero_Slider_Admin. Defines all hooks for the admin area.
	 * - Btk_Wp_Hero_Slider_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies()
	{

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-btk-wp-hero-slider-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-btk-wp-hero-slider-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-btk-wp-hero-slider-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */

		require_once plugin_dir_path(dirname(__FILE__)) . 'public/class-btk-wp-hero-slider-public.php';

		/**
		 * Load Widgets for hero slider
		 * 
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'widgets/class-btk-wp-hero-slider-carousel.php';

		$this->loader = new Btk_Wp_Hero_Slider_Loader();
	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Btk_Wp_Hero_Slider_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale()
	{

		$plugin_i18n = new Btk_Wp_Hero_Slider_i18n();

		$this->loader->add_action('plugins_loaded', $plugin_i18n, 'load_plugin_textdomain');
	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks()
	{

		$plugin_admin = new Btk_Wp_Hero_Slider_Admin($this->get_plugin_name(), $this->get_version());

		$this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_styles');
		$this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts');
		$this->loader->add_action('init', $plugin_admin, 'bk_wp_hero_slider_post_types');
		$this->loader->add_action('add_meta_boxes', $plugin_admin, 'btk_wp_hero_slider_meta_boxes');
		$this->loader->add_action("save_post", $plugin_admin, "btk_wp_hero_slider_save_post", 10, 3);
		$this->loader->add_action('widgets_init', $plugin_admin, 'btk_wp_hero_register_widgets');

		// manage clue table columns
		$this->loader->add_filter('manage_bk-hero-slider_posts_columns', $plugin_admin, 'set_new_btk_hero_slider_post_custom_column');
		$this->loader->add_action('manage_bk-hero-slider_posts_custom_column', $plugin_admin, 'btk_hero_slider_post_custom_column_value', 10, 2);
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks()
	{

		$plugin_public = new Btk_Wp_Hero_Slider_Public($this->get_plugin_name(), $this->get_version());

		$this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_styles');
		$this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_scripts');
		$this->loader->add_shortcode('btk-hero-slider', $plugin_public, 'btk_wp_hero_slider');
		$this->loader->add_action('wp_footer', $plugin_public, 'btk_wp_footer');
		$this->loader->add_action('wp_ajax_btk_wp_file_downloaded', $plugin_public, 'btk_wp_file_downloaded');
		$this->loader->add_action('wp_ajax_nopriv_btk_wp_file_downloaded', $plugin_public, 'btk_wp_file_downloaded');
		$this->loader->add_filter('wp_mail_content_type', $plugin_public, 'btk_mail_content');
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run()
	{
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name()
	{
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Btk_Wp_Hero_Slider_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader()
	{
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version()
	{
		return $this->version;
	}
}
