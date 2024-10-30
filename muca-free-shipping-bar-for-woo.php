<?php
/**
 * @package mucaWooFreeShippingBar
 */
/*
Plugin Name: Muca Shipping Bar For WooCommerce
Plugin URI: https://mucasoft.com/
Description: Muca <strong>woo free shipping bar</strong> is a free plugin to display free shipping bar on your website.
Version: 1.0.1
Author: Mahmud Sabuj
Author URI: https://mahmudsabuj.com
License: GPLv2 or later
Text Domain: mucaWooFreeShippingBar
*/

// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
	echo 'Hi there!  You can\'t call me directly.';
	exit;
}

//defines
define( 'MUCAFSB_VERSION', '1.0' );
define( 'MUCAFSB_MINIMUM_WP_VERSION', '5.0' );
define( 'MUCAFSB_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

//activation and deactivation hook
//register_activation_hook( __FILE__, array( 'mucaWooFreeShippingBar', 'plugin_activation' ) );
//register_deactivation_hook( __FILE__, array( 'mucaWooFreeShippingBar', 'plugin_deactivation' ) );

//activation requirements
function MUCAFSB_activate(){
    // Require woocommerce plugin
    if ( ! is_plugin_active( 'woocommerce/woocommerce.php' ) and current_user_can( 'activate_plugins' ) ) {
        // Stop activation redirect and show error
        wp_die('Sorry, this plguin requires woocommerce to be installed and activated. <br><a href="' . admin_url( 'plugins.php' ) . '">&laquo; Return to Plugins</a>');
    }
}
register_activation_hook( __FILE__, 'MUCAFSB_activate' );

add_action( 'init', array( 'mucaWooFreeShippingBar', 'init' ) );

//call admin menu / options
require_once( MUCAFSB_PLUGIN_DIR . 'admin/class.menu.php' );

//call head
require_once( MUCAFSB_PLUGIN_DIR . 'views/class.head.php' );
add_action( 'init', array( 'MUCAFSB_Head', 'init' ) );

//call hooks
require_once( MUCAFSB_PLUGIN_DIR . 'views/class.hooks.php' );
add_action( 'init', array( 'MUCAFSB_script_hooks', 'init' ) );

//register css & js
function MUCAFSB_register_styles() {
    wp_register_style('MUCAFSB_main', plugins_url('assets/main.css',__FILE__ ));
    wp_enqueue_style('MUCAFSB_main');
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script('MUCAFSB_main_script', plugins_url('assets/main.js',__FILE__ ),array('jquery'),false,true);
}
add_action( 'wp_enqueue_scripts','MUCAFSB_register_styles');

//admin style
function MUCAFSB_register_admin_style() {
  wp_enqueue_style('MUCAFSB_admin_styles', plugins_url('assets/admin.css',__FILE__ ));
  wp_enqueue_script('MUCAFSB_admin_script', plugins_url('assets/admin.js',__FILE__ ));
}
add_action('admin_enqueue_scripts', 'MUCAFSB_register_admin_style');

//color picker
function MUCAFSB_admin_color_picker( $hook_suffix ) {
	wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_script( 'MUCAFSB_admin_color_picker_script', plugins_url('assets/admin-color-picker.js', __FILE__ ), array( 'wp-color-picker' ), false, true );
}
add_action( 'admin_enqueue_scripts', 'MUCAFSB_admin_color_picker' );

//link to settings
function MUCAFSB_settings_link( $links ) {
	$links[] = '<a href="' .
		admin_url( 'options-general.php?page=mucaWooFreeShippingBar' ) .
		'">' . __('Settings') . '</a>';
	return $links;
}
add_filter('plugin_action_links_'.plugin_basename(__FILE__), 'MUCAFSB_settings_link');
