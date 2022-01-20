<?php
/**
 * Plugin Name: Advisor
 * Plugin URI: https://kellenberger-interactive.ch/
 * Description: Advisor plugin
 * Author: Kellenberger Interactive
 * Version: 1.1.
 * Author URI: https://kellenberger-interactive.ch/
 * Text Domain: advisor
 * Domain Path: /languages
 * License: GPL-2.0+
 */

 // Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

//Definitions
define( 'ADV_VERSION', '1.0.' ); 
define( 'ADVUI_VERSION', '1.0.' );
define( 'ADV_WP_VERSION', get_bloginfo( 'version' ) );

function adv_autoload() {
	require_once plugin_dir_path( __FILE__ ) . 'classes/class-adv.php';
  require_once plugin_dir_path( __FILE__ ) . 'functions/adv-functions.php';
  require_once plugin_dir_path( __FILE__ ) . 'admin/admin-adv.php';
}

add_action( 'init', 'adv_autoload' );

function adv_deactivation() {
	flush_rewrite_rules();
}

register_deactivation_hook( __FILE__, 'adv_deactivation' );

function adv_load_textdomain() {
	load_plugin_textdomain( 'advisor' );
}

add_action( 'plugins_loaded', 'adv_load_textdomain' );

function load_styles() {

	$plugin_url = plugin_dir_url( __FILE__ );

	wp_enqueue_script( 'advisor',  $plugin_url . 'js/advisor.js', array(), '1.0.0', true );

	wp_enqueue_style( 'advisor',  $plugin_url . "css/advisor.css");

}
add_action( 'wp_enqueue_scripts', 'load_styles' );

function adv_activation()
{      
  global $wpdb; 
  $db_table_name = $wpdb->prefix . 'adv_table';
  $charset_collate = $wpdb->get_charset_collate();

//Check to see if the table exists already, if not, then create it
if($wpdb->get_var( "show tables like '$db_table_name'" ) != $db_table_name ) 
 {
       $sql = "CREATE TABLE $db_table_name (
                id int(11) NOT NULL auto_increment,
                category varchar(15) NOT NULL,
                skill varchar(60) NOT NULL,
                gender varchar(200) NOT NULL,
                footsize varchar(10) NOT NULL,
                weight varchar(1000) NOT NULL,
                height varchar(1000) NOT NULL,
                wh_product varchar(1000) NOT NULL,
                advisor varchar(1000) NOT NULL,
                product_id varchar(1000) NOT NULL,
                UNIQUE KEY id (id)
        ) $charset_collate;";

   require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
   dbDelta( $sql );
   add_option( 'test_db_version', $test_db_version );
 }
} 

register_activation_hook( __FILE__, 'adv_activation' );

add_action( 'admin_enqueue_scripts', 'adv_admin_style');

    function adv_admin_style() {
      wp_enqueue_style('adv_admin_css', plugins_url('admin/css/adv_admin.css',__FILE__ ));
}

function adv_shortcode(){
	    
      $content = require_once plugin_dir_path( __FILE__ ) . 'helpers/form-helper.php';
    
    return $content;

}

add_shortcode('advisor', 'adv_shortcode');
