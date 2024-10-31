<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://gitlab.com/greatdane89/woocommerce-quick-view
 * @since      1.0.0
 *
 * @package    product-quick-view-for-woocommerce
 * @subpackage product-quick-view-for-woocommerce/includes
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
 * @package    product-quick-view-for-woocommerce
 * @subpackage product-quick-view-for-woocommerce/includes
 * @author     Your Name <email@example.com>
 */
class Product_quick_view_for_woocommerce {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Product_quick_view_for_woocommerce_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $product_quick_view_for_woocommerce    The string used to uniquely identify this plugin.
	 */
	protected $product_quick_view_for_woocommerce;

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
	public function __construct() {
		if ( defined( 'product_quick_view_for_woocommerce_1.0.0' ) ) {
			$this->version = 'product_quick_view_for_woocommerce_1.0.0';
		} else {
			$this->version = '1.0.0';
		}
		$this->product_quick_view_for_woocommerce = 'product-quick-view-for-woocommerce';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();
	

	}


	/**
	* checks user capabilites
	* @since 1.0.0
	* @link  https://codex.wordpress.org/Roles_and_Capabilities#Capabilities	
	* @param  array      wcqv_allw_capabilities         array of capabilitues   EX: array('manage_options', 'publish_pages') 
	* @example if(Product_quick_view_for_woocommerce::wcqv_check_user_role( array('manage_options', 'publish_pages') ) ) { echo "yes"; } else { echo "no"; }
	* 
	*/
	public function wcqv_check_user_role( $wcqv_allw_capabilities ) {


		foreach ($wcqv_allw_capabilities as $wcqv_allwd) {
    		
    		if( current_user_can( $wcqv_allwd ) ) {
        	
        		$wcqv_allow = true;

    		} else {
        
        		$wcqv_allow = false;
        		break;
    		}
		}


		return $wcqv_allow;

	}




	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Product_quick_view_for_woocommerce_Loader. Orchestrates the hooks of the plugin.
	 * - product_quick_view_for_woocommerce_i18n. Defines internationalization functionality.
	 * - product_quick_view_for_woocommerce_Admin. Defines all hooks for the admin area.
	 * - product_quick_view_for_woocommerce_Public. Defines all hooks for the public side of the site.
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
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-product-quick-view-for-woocommerce-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-product-quick-view-for-woocommerce-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-product-quick-view-for-woocommerce-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-product-quick-view-for-woocommerce-public.php';

		$this->loader = new Product_quick_view_for_woocommerce_Loader();
		

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the product_quick_view_for_woocommerce_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Product_quick_view_for_woocommerce_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Product_quick_view_for_woocommerce_Admin( $this->get_product_quick_view_for_woocommerce(), $this->get_version() );

		//enque admin assets as needed
		//$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		//$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );




		//create welcome page
		$this->loader->add_action('admin_menu', $plugin_admin, 'welcome_screen_pages');
		
		//redirect welcom page
		$this->loader->add_action( 'admin_init', $plugin_admin, 'welcome_screen_do_activation_redirect' );

		//remove welcom page
		$this->loader->add_action( 'admin_head', $plugin_admin, 'welcome_screen_remove_menus' );



		//custom footer text pn plugin settings page
		$this->loader->add_filter( 'admin_footer_text', $plugin_admin, 'my_custom_admin_credits' );

		//add settings page
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'woocommerce_quick_view_add_admin_menu' );
		$this->loader->add_action( 'admin_init', $plugin_admin, 'woocommerce_quick_view_settings_init' );

			//settings page tabs
			$this->loader->add_action( 'wcqv_settings_tab',  $plugin_admin,'wcqv_general_tab_init', 1 );
			$this->loader->add_action( 'wcqv_settings_content', $plugin_admin,'wcqv_general_render_options_tab' );
			$this->loader->add_action( 'wcqv_settings_tab', $plugin_admin,'wcqv_advanced_tab_init' );
			$this->loader->add_action( 'wcqv_settings_content',$plugin_admin, 'wcqv_advanced_tab_tab' );
			$this->loader->add_action( 'wcqv_settings_tab', $plugin_admin,'wcqv_troubleshooting_init' );
			$this->loader->add_action( 'wcqv_settings_content',$plugin_admin, 'wcqv_troubleshooting_tab' );
		//add custom settings tab single product edit
		$this->loader->add_action( 'woocommerce_product_write_panel_tabs', $plugin_admin, 'wcqv_custom_tab_action_render' );

		//custom settings tab content
		$this->loader->add_action( 'woocommerce_product_data_panels', $plugin_admin, 'product_qv_wv_custom_tab' );

		//custom settings tab content save
		$this->loader->add_action( 'woocommerce_process_product_meta', $plugin_admin, 'product_qv_wv_custom_tab_save' );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Product_quick_view_for_woocommerce_Public( $this->get_product_quick_view_for_woocommerce(), $this->get_version() );


		//enqueue public assets
		$this->loader->add_action( 'wp_enqueue_scripts',  $plugin_public, 'wcqv_enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts',  $plugin_public, 'wcqv_enqueue_scripts' );

/*
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'plugins_loaded', $plugin_public, 'enqueue_styles' );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'plugins_loaded', $plugin_public, 'enqueue_scripts' );

*/
		//add button to archive page
		$this->loader->add_action( 'woocommerce_after_shop_loop_item', $plugin_public, 'woocommerce_quick_view_add_modalButton_to_card');

		//defer/async load script tag from class-plugin-public.php
		$this->loader->add_filter( 'script_loader_tag', $plugin_public, 'woocommerece_quick_view_add_defer_attribute', 10, 3);

		//defer/async load style tag from class-plugin-public.php
		$this->loader->add_filter( 'style_loader_tag', $plugin_public, 'woocommerece_quick_view_add_defer_attribute_style', 10, 3);

		
		//custom query to allow quick view button/modal to be place anywhere - must pass in product id
		$this->loader->add_action('wc_quick_view_insert', $plugin_public, 'wcqv_register_custom_query', 7);


		//custom query to allow quick view button/modal to be place anywhere - must pass in product id
		$this->loader->add_action('wc_quick_view_slider', $plugin_public, 'wcqv_register_slider', 7);



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
	public function get_product_quick_view_for_woocommerce() {
		return $this->product_quick_view_for_woocommerce;
	}




	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Product_quick_view_for_woocommerce_Loader    Orchestrates the hooks of the plugin.
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

}//Product_quick_view_for_woocommerce
