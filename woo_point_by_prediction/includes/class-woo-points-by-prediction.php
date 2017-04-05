<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       hellosurya.com.np
 * @since      1.0.0
 *
 * @package    Woo_points_by_prediction
 * @subpackage Woo_points_by_prediction/includes
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
 * @package    Woo_points_by_prediction
 * @subpackage Woo_points_by_prediction/includes
 * @author     surya manandhar <suryamanandhar1@gmail.com>
 */

class Woo_points_by_prediction{
	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	Protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */

	Protected $plugin_version;

	public function __construct(){
		global $wpdb;
		$this->plugin_name = 'woo-points-by-prediction';
		$this->plugin_version = '9.9';
		$this->wpdb =$wpdb;
		$this->load_dependencies();
		$this->define_admin_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Woo_points_by_prediction_Loader. Orchestrates the hooks of the plugin.
	 * - Woo_points_by_prediction_i18n. Defines internationalization functionality.
	 * - Woo_points_by_prediction_Admin. Defines all hooks for the admin area.
	 * - Woo_points_by_prediction_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies(){
		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-woo-points-by-prediction-admin.php';


	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {
		$plugin_admin = $this->plugin_name;  
		add_action( 'admin_init',array($this,'load_script'));
		//should be hooked in wp_enque_
		

	}
	public function load_script(){
		$plugin_admin = $this->plugin_name;
		wp_enqueue_style($plugin_admin, plugins_url($plugin_admin.'/css/style.css'));
       wp_enqueue_script($plugin_admin,plugins_url().$plugin_admin.'/js/script.js', array(), '1.0.0', true );
	}


}
new Woo_points_by_prediction;
new Woo_points_by_prediction_admin();