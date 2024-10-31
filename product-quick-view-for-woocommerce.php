<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
/**
 *
 * @link              https://gitlab.com/greatdane89/woocommerce-quick-view
 * @since             1.0.0
 * @package           product-quick-view-for-woocommerce
 *
 * @wordpress-plugin
 * Plugin Name:       Product Quick View For WooCommerce
 * Plugin URI:        https://gitlab.com/greatdane89/woocommerce-quick-view
 * Description:       Adds a button for quick view on WooCommece product listings
 * Version:           1.0.0
 * Author:            David Baty 
 * Author URI:        https://davebuildswebsites.com/
 * Text Domain:       product-quick-view-for-woocommerce
 * Domain Path:       /languages
 * WC requires at least: 3.3.4
 * WC tested up to: 3.5.2
 * License: GNU General Public License v3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'product_quick_view_for_woocommerce_1.0.0', 'woocommerce_quick_view' );





/**
* add settings to plugins listings before dectivate
* @since 1.0.0
* @link https://codex.wordpress.org/Plugin_API/Filter_Reference/plugin_action_links_(plugin_file_name)
**/


add_filter( 'plugin_action_links', 'wcqv_add_action_plugin', 10, 5 );
function wcqv_add_action_plugin( $wcqv_actions, $wcqv_plugin_file ) 
{
	static $wcqv_plugin;

	if (!isset($wcqv_plugin))
		$wcqv_plugin = plugin_basename(__FILE__);
			if ($wcqv_plugin == $wcqv_plugin_file) {

				$wcqv_settings = array('settings' => '<a href="'.admin_url( 'admin.php?page=woocommerce_quick_view&tab=wcqvGeneralSettings' ).'">' . __('Settings', 'General') . '</a>');
				//$site_link = array('support' => '<a href="http://thetechterminus.com" target="_blank">Support</a>');
    			$wcqv_actions = array_merge($wcqv_settings, $wcqv_actions);
				//$wcqv_actions = array_merge($site_link, $wcqv_actions);			
			}

		return $wcqv_actions;
}



/**
* add links after version in plugin listings
* @since 1.0.0
* @link https://codex.wordpress.org/Plugin_API/Filter_Reference/plugin_row_meta
*
**/

add_filter( 'plugin_row_meta', 'wcqv_custom_plugin_row_meta', 10, 2 );
function wcqv_custom_plugin_row_meta( $wcqv_links, $wcqv_file ) {

	if ( strpos( $wcqv_file, plugin_basename(__FILE__) ) !== false ) {
		$wcqv_new_links = array(
				//'donate' => '<a href="donation_url" target="_blank">Donate</a>',
                'docs' => '<a href="https://gitlab.com/greatdane89/woocommerce-quick-view.git" target="_blank"> Documentation</a>',
                //'Support' => '<a href="https://gitlab.com/greatdane89/woocommerce-quick-view.git" target="_blank">Support</a>',
				);
		
		$wcqv_links = array_merge( $wcqv_links, $wcqv_new_links );
	}
	
	return $wcqv_links;
}


/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-product-quick-view-for-woocommerce-activator.php
 */
function product_quick_view_for_woocommerce() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-product-quick-view-for-woocommerce-activator.php';
	Product_quick_view_for_woocommerce_Activator::activate();
}




/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-product-quick-view-for-woocommerce-deactivator.php
 */
function deproduct_quick_view_for_woocommerce() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-product-quick-view-for-woocommerce-deactivator.php';
	Product_quick_view_for_woocommerce_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'product_quick_view_for_woocommerce' );
register_deactivation_hook( __FILE__, 'deproduct_quick_view_for_woocommerce' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-product-quick-view-for-woocommerce.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 * @see      class-product-quick-view-for-woocommerce.php   class Plugin_Name
 */
function run_product_quick_view_for_woocommerce() {

	$wcqv_plugin = new Product_quick_view_for_woocommerce();
	$wcqv_plugin->run();


/*
add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'add_action_links' );

function add_action_links ( $links ) {
 $mylinks = array(
 '<a href="' . admin_url( 'options-general.php?page=myplugin' ) . '">Settings</a>',
 );
return array_merge( $links, $mylinks );
}
*/


}




/**
 * Check if WooCommerce is active before function run_product_quick_view_for_woocommerce
 * @since 	1.0.0
 * @link    https://docs.woocommerce.com/document/create-a-plugin/
 **/
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	run_product_quick_view_for_woocommerce();
}




