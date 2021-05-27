<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://woocommerce.db-dzine.com
 * @since      1.0.0
 *
 * @package    WooCommerce_Better_Compare
 * @subpackage WooCommerce_Better_Compare/admin
 * @author     Daniel Barenkamp <support@db-dzine.com>
 */

class WooCommerce_Better_Compare_Admin extends WooCommerce_Better_Compare {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	protected $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	protected $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->notice = "";

	}

    /**
     * Enqueue Admin Styles
     * @author Daniel Barenkamp
     * @version 1.0.0
     * @since   1.0.0
     * @link    http://plugins.db-dzine.com
     * @return  boolean
     */
    public function enqueue_styles()
    {
        wp_enqueue_style($this->plugin_name.'-admin', plugin_dir_url(__FILE__).'css/woocommerce-better-compare-admin.css', array(), $this->version, 'all');
    }

    /**
     * Load Extensions
     * @author Daniel Barenkamp
     * @version 1.0.0
     * @since   1.0.0
     * @link    http://woocommerce.db-dzine.de
     * @return  boolean
     */
    public function load_extensions()
    {
        // if(!is_admin() || !current_user_can('administrator') || (defined('DOING_AJAX') && DOING_AJAX && !$_POST['action'] == "woocommerce_better_compare_options_ajax_save")){
        //     return false;
        // }

        // Load the theme/plugin options
        if (file_exists(plugin_dir_path(dirname(__FILE__)).'admin/options-init.php')) {
            require_once plugin_dir_path(dirname(__FILE__)).'admin/options-init.php';
        }
    }

	/**
	 * Init admin
	 *
	 * @since    1.0.0
	 */
    public function init()
    {
    	global $woocommerce_better_compare_options;

        // if(!is_admin() || !current_user_can('administrator') || (defined('DOING_AJAX') && DOING_AJAX)){
        //     $woocommerce_better_compare_options = get_option('woocommerce_better_compare_options');
        // }

        $this->options = $woocommerce_better_compare_options;
    }

    /**
     * [register_widgets description]
     * @author Daniel Barenkamp
     * @version 1.0.0
     * @since   1.0.0
     * @link    https://plugins.db-dzine.com
     * @return  [type]                       [description]
     */
    public function register_widgets()
    {
        register_widget( 'WooCommerce_Better_Compare_Widget' );
        register_widget( 'WooCommerce_Better_Compare_Autocomplete_Widget' );
    }
}