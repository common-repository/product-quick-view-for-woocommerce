<?php

/**
 * Fired during plugin activation
 *
 * @link       https://gitlab.com/greatdane89/woocommerce-quick-view
 * @since      1.0.0
 *
 * @package    product-quick-view-for-woocommerce
 * @subpackage product-quick-view-for-woocommerce/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    product-quick-view-for-woocommerce
 * @subpackage product-quick-view-for-woocommerce/includes
 * @author     David Baty https://davebuildswebsites.com
 */
class Product_quick_view_for_woocommerce_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
  		set_transient( '_product_quick_view_for_woocommerce_welcome_screen_activation_redirect', true, 30 );
	}

}
