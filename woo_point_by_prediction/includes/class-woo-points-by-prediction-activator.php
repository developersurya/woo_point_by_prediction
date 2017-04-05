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
////does it need extended?
class Woo_points_by_prediction_Activator extends Woo_points_by_prediction{

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		//why i can not access $this->wpdb;
		global $wpdb;
		$wpdb->hide_errors();
		$table_name =$wpdb->prefix . 'woo_points_by_prediction';

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

        // it's important that this table be indexed-up as it can grow quite large
        $sql =
            "CREATE TABLE {$table_name} (
		  predict_id bigint(20) NOT NULL AUTO_INCREMENT,
		  woo_predict_user VARCHAR(20) NOT NULL,
		  woo_predict_question_id longtext DEFAULT NULL,
		  woo_predict_user_ans varchar(255) DEFAULT NULL,
		  woo_predict_date_end DATE DEFAULT NULL,
		  woo_predict_points_added bigint(20) DEFAULT NULL,
		  woo_predict_update BOOLEAN DEFAULT false,
		  PRIMARY KEY  (predict_id)
		) ";
        dbDelta($sql);
		
	}

}
