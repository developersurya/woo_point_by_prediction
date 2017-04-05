 <?php 
 /**
 * The admin-specific functionality of the plugin.
 *
 * @link       hellosurya.com.np
 * @since      1.0.0
 *
 * @package    Woo_points_by_prediction
 * @subpackage Woo_points_by_prediction/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Woo_points_by_prediction
 * @subpackage Woo_points_by_prediction/admin
 * @author     surya manandhar <suryamanandhar1@gmail.com>
 */
 class Woo_points_by_prediction_admin{
 	
 	public  function __construct(){
 		 add_action('admin_menu', array($this, 'admin_menu'));
 		   add_action('admin_menu',  array( $this,'submenu_page'));
 	}


 	/**
     * Add menu for custom plugin
     **/

    public function admin_menu()
    {
        add_menu_page(
            'Prediction page',
            'Predictions',
            'manage_options',
            'options_predicts',
            array(
                $this,
                'settings_page'
            ),
            'dashicons-welcome-view-site',
            60
        );
    }


    /**
     * Add sub menu for custom plugin
     **/
    public function submenu_page(){

        add_submenu_page( 'options_predicts', 'Predictions ', 'Predictions ',
            'manage_options', 'options_predicts');
        add_submenu_page( 'options_predicts', 'New Question Predicts', 'New Question Predicts',
            'manage_options', 'options_page_predicts',array(
                $this,'member_upgrade_settings'));
        //call register settings function
        //add_action( 'admin_init',array( $this, 'register_mysettings') );

        //woocommerce_add_to_cart
    }


    /**
     * Create form for updating point code data
     * Update delete point code data
     */
    public function settings_page()
    {
        global $wpdb;

        ?>
        <div class="wrap">
        <h1>Predict and win extra points</h1>
        <p>Add your new points offer with currect Prediction .It will display in page with shortcode as
            [PredictionTemplate].<br/>
            Only one time each user can get the offer points.</p>
        <hr/>
        <h2>Prediction records</h2>

        <table class=" wp-list-table widefat striped posts">
            <thead>
            <tr>
                <td class="manage-column">S.N</td>
                <td class="manage-column">Prediction Title</td>
                <td class="manage-column">Prediction Question</td>
                <td class="manage-column">Point/Price</td>
                <td class="manage-column">Published </td>
                <td class="manage-column">End Date</td>
                <td class="manage-column">Update</td>
                <td class="manage-column">Delete</td>
            </tr>
            </thead>
            <tbody id="the-list">
            <?php
            global $wpdb;

        //delete the point code
        if (isset($_GET['predicts_nonce']) || wp_verify_nonce($_GET['predicts_nonce'], 'predicts_delete')) {
            $get_id = $_GET['predict_id'];
            echo $get_id;
            $delete = $wpdb->delete('wp_woo_points_by_prediction', array('predict_id' => $get_id), array('%d'));
            if ($delete) {
                echo '<div id="message" class="updated notice notice-success xis-dismissible" style="position: relative;">
                     <p>Delete successful.</p>
                     <a style="position: absolute;top: 0;right: 20px;" href="http://localhost/surya/demo/wp-admin/admin.php?page=options_predicts"><button type="button" class="notice-dismiss return-back" >
                     <span class="screen-reader-text">Dismiss this notice.</span>
                     </button></a>
                     </div>';
                //return;
            }
        } 

        //check the answer and update the points
        if (isset($_GET['predicts_add_nonce']) || wp_verify_nonce($_GET['predicts_add_nonce'], 'predicts_add_check')) {
            $get_id = $_GET['predict_id'];
            $userid = $_GET['userid'];
            $userpointprice = 500;
           
            $update =  $wpdb->update( 
						'wp_woo_points_by_prediction', 
						array( 
							'woo_predict_update' => '1'
						), 
						array( 'predict_id' => $get_id ), 
						array( 
							'%s'
						)); 
            if ($update) {

                //update user points
                //insert into db
                $insert = $wpdb->insert(
                    'wp_yith_ywpar_points_log',
                    array(
                        'user_id' => $userid,
                        'action' => admin_action,
                        'order_id' => 0,
                        'amount' => $userpointprice
                    ),
                    array(
                        '%s',
                        '%s',
                        '%s',
                        '%s'
                    )
                );

                $query = "SELECT * FROM wp_yith_ywpar_points_log WHERE user_id = $userid ";
                $points = $wpdb->get_results($query);
                $point_amount = 0;
                foreach ($points as $point) {
                    $point_amount = $point->amount;
                    $point_amt += $point_amount;
                }

                //make up-to-date
                $update_userpoint = update_usermeta($userid, '_ywpar_user_total_points', $point_amt);
               if($update_userpoint){
                echo '<div id="message" class="updated notice notice-success xis-dismissible" style="position: relative;">
                points also updated!!!</div>';
               }




                 //$update_userpoint = update_usermeta($userid, '_ywpar_user_total_points', $point_amt);
                echo '<div id="message" class="updated notice notice-success xis-dismissible" style="position: relative;">
                     <p>Update successful.</p>
                     <a style="position: absolute;top: 0;right: 20px;" href="http://localhost/surya/demo/wp-admin/admin.php?page=options_predicts"><button type="button" class="notice-dismiss return-back" >
                     <span class="screen-reader-text">Dismiss this notice.</span>
                     </button></a>
                     </div>';
                //return;
            }
        } 
        if (isset($_GET['predicts_remove_nonce']) || wp_verify_nonce($_GET['predicts_remove_nonce'], 'predicts_remove_check')) {
            $get_id = $_GET['predict_id'];
             echo $get_id;
           $update =  $wpdb->update( 
						'wp_woo_points_by_prediction', 
						array( 
							'woo_predict_update' => '1'
						), 
						array( 'predict_id' => $get_id ), 
						array( 
							'%s'
						)); 
            if ($update) {
                echo '<div id="message" class="updated notice notice-success xis-dismissible" style="position: relative;">
                     <p>Delete successful.</p>
                     <a style="position: absolute;top: 0;right: 20px;" href="http://localhost/surya/demo/wp-admin/admin.php?page=options_predicts"><button type="button" class="notice-dismiss return-back" >
                     <span class="screen-reader-text">Dismiss this notice.</span>
                     </button></a>
                     </div>';
                //return;
            }
        } 



            //INSERT INTO `wp_woo_points_by_prediction` (`predict_id`, `woo_predict_user`, `woo_predict_question_id`, `woo_predict_user_ans`, `woo_predict_date_end`, `woo_predict_points_added`) VALUES (NULL, '3', '3', 'answers', '1', '2');
            //
            //
            //

             $custom_predictions = $wpdb->get_results("SELECT * FROM wp_woo_points_by_prediction");
            $count = 1;
            foreach ($custom_predictions as $custom_prediction) {
                ?>
                <tr>
                    <td><?php echo $count; ?></td>
                    <td><?php echo $custom_prediction->woo_predict_user; ?></td>
                    <td><?php echo $custom_prediction->woo_predict_question_id; ?></td>
                    <td><?php echo $custom_prediction->woo_predict_user_ans; ?></td>
                    <td><?php echo $custom_prediction->woo_predict_points_added; ?></td>
                    <td><?php echo $custom_prediction->woo_predict_date_end; ?></td>
                    <td><?php $checek_update =  $custom_prediction->woo_predict_update; 
                    if($checek_update){
                    	echo "<div class='dashicons dashicons-plus'></div> Points updated";
                    	}else{ ?>
                    		
                    		<a href="<?php echo wp_nonce_url(admin_url('admin.php?page=options_predicts&userid='.$custom_prediction->woo_predict_user.'&predict_id='. $custom_prediction->predict_id), 'predicts_add_delete', 'predicts_add_nonce'); ?>"
                           class="dashicons dashicons-yes"></a>
                    		  
                    		  	<a href="<?php echo wp_nonce_url(admin_url('admin.php?page=options_predicts&predict_id=' . $custom_prediction->predict_id), 'predicts_remove_delete', 'predicts_remove_nonce'); ?>"
                           class="dashicons dashicons-no"></a>
                    		 
                    		<?php } ?></td>
                    <td>
                        <a href="<?php echo wp_nonce_url(admin_url('admin.php?page=options_predicts&predict_id=' . $custom_prediction->predict_id), 'predicts_delete', 'predicts_nonce'); ?>"
                           class="dashicons dashicons-trash"></a></td>
                </tr>

                <?php $count++;
            }
            ?>

            </tbody>
        </table>
        <?php 
    }


    public function member_upgrade_settings(){?>
         echo "";
    <?php }
 }