<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://woocommerce.db-dzine.com
 * @since      1.0.0
 *
 * @package    WooCommerce_Better_Compare
 * @subpackage WooCommerce_Better_Compare/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    WooCommerce_Better_Compare
 * @subpackage WooCommerce_Better_Compare/includes
 * @author     Daniel Barenkamp <support@db-dzine.com>
 */
class WooCommerce_Better_Compare {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      WooCommerce_Better_Compare_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */

	public function __construct($version) {

		$this->plugin_name = 'woocommerce-better-compare';
		$this->version = $version;

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - WooCommerce_Better_Compare_Loader. Orchestrates the hooks of the plugin.
	 * - WooCommerce_Better_Compare_i18n. Defines internationalization functionality.
	 * - WooCommerce_Better_Compare_Admin. Defines all hooks for the admin area.
	 * - WooCommerce_Better_Compare_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-woocommerce-better-compare-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-woocommerce-better-compare-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-woocommerce-better-compare-admin.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-woocommerce-better-compare-widget.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-woocommerce-better-compare-autocomplete-widget.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-woocommerce-better-compare-public.php';


		$this->loader = new WooCommerce_Better_Compare_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the WooCommerce_Better_Compare_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$this->plugin_i18n = new WooCommerce_Better_Compare_i18n();

		$this->loader->add_action( 'plugins_loaded', $this->plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$this->plugin_admin = new WooCommerce_Better_Compare_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action('init', $this->plugin_admin, 'init', 1);
		$this->loader->add_action('plugins_loaded', $this->plugin_admin, 'load_extensions');
		$this->loader->add_action('admin_enqueue_scripts', $this->plugin_admin, 'enqueue_styles', 999);
		$this->loader->add_action('widgets_init', $this->plugin_admin, 'register_widgets');
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {
		
		$this->plugin_public = new WooCommerce_Better_Compare_Public( $this->get_plugin_name(), $this->get_version() );

        $this->loader->add_action('wp_enqueue_scripts', $this->plugin_public, 'enqueue_styles');
        $this->loader->add_action('wp_enqueue_scripts', $this->plugin_public, 'enqueue_scripts');

		$this->loader->add_action( 'init', $this->plugin_public, 'init', 10 );
		$this->loader->add_action( 'init', $this->plugin_public, 'single_product_page', 25 );
		$this->loader->add_action( 'template_redirect', $this->plugin_public, 'maybe_show_compare_button_on_single_product', 25 );
		$this->loader->add_action( 'wp_footer', $this->plugin_public, 'compare_bar', 10 );

		add_shortcode( 'woocommerce_better_compare', array($this->plugin_public, 'compare_products_shortcode'));
		add_shortcode( 'woocommerce_better_compare_button', array($this->plugin_public, 'compare_button_shortcode'));
		add_shortcode( 'woocommerce_better_compare_autocomplete', array($this->plugin_public, 'autocomplete_shortcode'));

		// AJAX
        $this->loader->add_action('wp_ajax_nopriv_compare_products_get_single', $this->plugin_public, 'get_single_product');
        $this->loader->add_action('wp_ajax_compare_products_get_single', $this->plugin_public, 'get_single_product');

        $this->loader->add_action('wp_ajax_nopriv_compare_products_get_all', $this->plugin_public, 'get_all_products');
        $this->loader->add_action('wp_ajax_compare_products_get_all', $this->plugin_public, 'get_all_products');

		$this->loader->add_action('wp_ajax_nopriv_compare_check_product', $this->plugin_public, 'check_product');
        $this->loader->add_action('wp_ajax_compare_check_product', $this->plugin_public, 'check_product');

        $this->loader->add_action('wp_ajax_nopriv_compare_products_get_single_column', $this->plugin_public, 'compare_products_get_single_column');
        $this->loader->add_action('wp_ajax_compare_products_get_single_column', $this->plugin_public, 'compare_products_get_single_column');

        
        
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    WooCommerce_Better_Compare_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

    /**
     * Get Options
     * @author Daniel Barenkamp
     * @version 1.0.0
     * @since   1.0.0
     * @link    http://plugins.db-dzine.com
     * @param   mixed                         $option The option key
     * @return  mixed                                 The option value
     */
    protected function get_option($option)
    {
        if (!is_array($this->options)) {
            return false;
        }

        if (!array_key_exists($option, $this->options)) {
            return false;
        }

        return $this->options[$option];
    }
}