<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://woocommerce.db-dzine.com
 * @since      1.0.0
 *
 * @package    WooCommerce_Better_Compare
 * @subpackage WooCommerce_Better_Compare/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    WooCommerce_Better_Compare
 * @subpackage WooCommerce_Better_Compare/includes
 * @author     Daniel Barenkamp <support@db-dzine.com>
 */
class WooCommerce_Better_Compare_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		$loaded = load_plugin_textdomain(
			'woocommerce-better-compare',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
