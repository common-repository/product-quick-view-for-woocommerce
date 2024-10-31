<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://gitlab.com/greatdane89/woocommerce-quick-view
 * @since      1.0.0
 *
 * @package    product-quick-view-for-woocommerce
 * @subpackage product-quick-view-for-woocommerceincludes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    product-quick-view-for-woocommerce
 * @subpackage product-quick-view-for-woocommerce/includes
 * @author     David Baty https://davebuildswebites.com
 */
class Product_quick_view_for_woocommerce_i18n {

	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'product-quick-view-for-woocommerce',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}

}//Product_quick_view_for_woocommerce_i18n
