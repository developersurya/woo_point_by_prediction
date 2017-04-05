<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              ktmfreelancer.com.np
 * @since             1.0.0
 * @package           Woo_point_by_prediction
 *
 * @wordpress-plugin
 * Plugin Name:       woo points by prediction
 * Plugin URI:        hellosurya.com.np/plugins
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            surya manandhar
 * Author URI:        ktmfreelancer.com.np
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       woo_points_by_prediction
 * Domain Path:       /languages
 */

// If this file is called directly, abort.//restrict wp-includes  
if ( ! defined( 'WPINC' ) ) {
	die;
}
/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-woo_points_by_prediction-activator.php
 */
function activate_woo_points_by_prediction() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-woo-points-by-prediction-activator.php';
	Woo_points_by_prediction_Activator::activate();
}
/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-woo_points_by_prediction-deactivator.php
 */
function deactivate_woo_points_by_prediction() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-woo-points-by-prediction-deactivator.php';
	Woo_points_by_prediction_Deactivator::deactivate();
}
register_activation_hook( __FILE__, 'activate_woo_points_by_prediction' );
register_deactivation_hook( __FILE__, 'deactivate_woo_points_by_prediction' );
/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-woo-points-by-prediction.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_woo_points_by_prediction() {

	$plugin = new Woo_points_by_prediction();

}
run_woo_points_by_prediction();