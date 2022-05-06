<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://linktr.ee/armancs
 * @since      1.0.0
 *
 * @package    Btk_Wp_Hero_Slider
 * @subpackage Btk_Wp_Hero_Slider/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Btk_Wp_Hero_Slider
 * @subpackage Btk_Wp_Hero_Slider/admin
 * @author     Arman H <bluetekbd@gmail.com>
 */
class Btk_Wp_Hero_Slider_Admin
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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the admin area.
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

		wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/btk-wp-hero-slider-admin.css', array(), $this->version, 'all');
	}

	/**
	 * Register the JavaScript for the admin area.
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
		wp_enqueue_script($this->plugin_name . '-sweat-alert', '//cdn.jsdelivr.net/npm/sweetalert2@11', array('jquery'), $this->version, false);

		wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/btk-wp-hero-slider-admin.js', array('jquery'), $this->version, false);
	}

	public function bk_wp_hero_slider_post_types()
	{
		$post_type = [
			'bk-hero-slider' => [
				'name'              => 'Hero Slider',
				'slug'              => 'bk-hero-slider',
				'title'       		=> true,
				'editor'            => false,
				'is_category'       => false,
				'taxonomy'          => 'bk-hero-slider-taxonomy',
				'icon'              => 'dashicons-schedule',
				'map_meta_cap' 		=> true,
				'thumbnail'         => false
			]
		];
		$i = 3;
		foreach ($post_type as $k => $v) {
			if ($v['editor']) {
				$editor = 'editor';
			} else {
				$editor = '';
			}
			if ($v['thumbnail']) {
				$thumbnail = 'thumbnail';
			} else {
				$thumbnail = '';
			}
			if ($v['title']) {
				$title = 'title';
			} else {
				$title = '';
			}
			register_post_type(
				$k,
				array(
					'labels' => array(
						'name'          => __($v['name']),
						'singular_name' => __($v['name']),
						'add_new'       => __('Add New'),
						'add_new_item'  => __('Add New ' . $v['name']),
						'edit_item'     => __('Edit ' . $v['name']),
						'new_item'      => __('New ' . $v['name']),
						'view_item'     => __('View ' . $v['name']),
						'not_found'     => __('Sorry, we couldn\'t find the ' . $v['name'] . ' Menu you are looking for.')
					),
					'public' => true,
					'publicly_queryable' => true,
					'exclude_from_search' => true,
					'menu_position'      => $i,
					'has_archive'        => true,
					'hierarchical'       => false,
					'menu_icon'          => $v['icon'],
					'taxonomies'         => array($v['taxonomy']),
					'capability_type'    => 'page',
					'rewrite'            => array('slug' => $v['name']),
					'supports'           => [$title, $editor, $thumbnail]
				)
			);

			if ($v['is_category']) {
				$labels = array(
					'name'              => _x($v['name'], 'taxonomy general name'),
					'singular_name'     => _x(' Category', 'taxonomy singular name'),
					'search_items'      => __('Search '),
					'all_items'         => __('All '),
					'parent_item'       => __('Parent Category'),
					'parent_item_colon' => __('Parent Category:'),
					'edit_item'         => __('Edit Category'),
					'update_item'       => __('Update Category'),
					'add_new_item'      => __('Add New Category'),
					'new_item_name'     => __('New Category'),
					'menu_name'         => __(' Category'),
					'rewrite' => array(
						'slug' => $v['taxonomy'],
						'with_front' => false
					)
				);
				$args = array(
					'labels' => $labels,
					'hierarchical' => true,
				);
				register_taxonomy($v['taxonomy'], array($k), $args);
				$i++;
			}
		}
	}


	// create custom field
	public function btk_wp_hero_slider_meta_boxes()
	{
		//this will add the metabox data for the publisher post type -  publishing date metabox
		add_meta_box('meta_box_btk_wp_hero_sliders', __('Sliders', 'btk-wp-hero-slider'), array($this, 'btk_wp_hero_sliders'), 'bk-hero-slider');
	}
	public function btk_wp_hero_sliders($post)
	{
		wp_nonce_field('bk_nonce_field', 'bk_nonce');
		include('partials/metabox/btk-hero-sliders.php');
	}
	function btk_wp_hero_slider_save_post($post_id, $post, $update)
	{
		if ($post->post_type == 'bk-hero-slider') {
			$btk_slider_metas = [];
			// for ($total = 0; $total <= $total_slider; $total++) {
			foreach ($_POST['btk_slider_title'] as $k => $v) {
				if ($_POST['btk_show_popup_form'][$k]) {
					$show_popup_form  = $_POST['btk_show_popup_form'][$k];
				} else {
					$show_popup_form = 0;
				}
				$btk_slider_metas[] = array(
					'slider_image' => $_POST['btk_slider_images'][$k],
					'slider_overlay_image' => $_POST['btk_overlay_front_images'][$k],
					'slider_title' => $_POST['btk_slider_title'][$k],
					'slider_btn_text' => $_POST['btk_slider_btn_text'][$k],
					'slider_btn_dl_link' => $_POST['btk_slider_btn_downloadlink'][$k],
					'show_popup_form' => $show_popup_form,
				);
			}

			$slider_metas = json_encode($btk_slider_metas, JSON_FORCE_OBJECT);
			// echo "<pre>";
			// var_dump($btk_slider_metas);
			// exit();
			update_post_meta($post->ID, 'btk_all_slider_data', $slider_metas);
		}
	}

	public function btk_wp_hero_register_widgets()
	{
		register_widget('btk_wp_hero_slider_widget');
	}
}
