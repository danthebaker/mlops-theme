<?php

/**
 * The plugin bootstrap file
 *
 *
 * @link              https://welaunch.io/plugins/woocommerce-better-compare/
 * @since             1.0.0
 * @package           WooCommerce_Better_Compare
 *
 * @wordpress-plugin
 * Plugin Name:       WooCommerce Better Compare
 * Plugin URI:        https://welaunch.io/plugins/woocommerce-better-compare/
 * Description:       Let your users compare products with ease
 * Version:           1.5.7
 * Author:            weLaunch
 * Author URI:        https://welaunch.io
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       woocommerce-better-compare
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-woocommerce-better-compare-activator.php
 */
function activate_WooCommerce_Better_Compare() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-woocommerce-better-compare-activator.php';
	WooCommerce_Better_Compare_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-woocommerce-better-compare-deactivator.php
 */
function deactivate_WooCommerce_Better_Compare() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-woocommerce-better-compare-deactivator.php';
	WooCommerce_Better_Compare_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_WooCommerce_Better_Compare' );
register_deactivation_hook( __FILE__, 'deactivate_WooCommerce_Better_Compare' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-woocommerce-better-compare.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_WooCommerce_Better_Compare() {

	$plugin_data = get_plugin_data( __FILE__ );
	$version = $plugin_data['Version'];

	$plugin = new WooCommerce_Better_Compare($version);
	$plugin->run();

	return $plugin;
}

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if ( is_plugin_active( 'woocommerce/woocommerce.php') && (is_plugin_active('redux-dev-master/redux-framework.php') || is_plugin_active('redux-framework/redux-framework.php') ||  is_plugin_active('welaunch-framework/welaunch-framework.php') ) ){
	$WooCommerce_Better_Compare = run_WooCommerce_Better_Compare();
} else {
	add_action( 'admin_notices', 'woocommerce_better_compare_installed_notice' );
}

function woocommerce_better_compare_installed_notice()
{
	?>
    <div class="error">
      <p><?php _e( 'WooCommerce Better Compare requires the WooCommerce & free weLaunch Framework plugin. Please install or activate them: https://www.welaunch.io/updates/welaunch-framework.zip', 'woocommerce-better-compare'); ?></p>
    </div>
    <?php
}