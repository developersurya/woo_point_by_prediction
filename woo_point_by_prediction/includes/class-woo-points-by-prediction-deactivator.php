<?php

/**
 * Fired during plugin activation
 *
 * @link       ktmfreelancer.com.np
 * @since      1.0.0
 *
 * @package    Woo_points_by_prediction
 * @subpackage Woo_points_by_prediction/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Woo_points_by_prediction
 * @subpackage Woo_points_by_prediction/includes
 * @author     surya manandhar <suryamanandhar1@gmail.com>
 */
class Woo_points_by_prediction_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
		echo "plugin deactivated";
	}

}
