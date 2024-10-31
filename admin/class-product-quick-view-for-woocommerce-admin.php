<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
/**
 * The admin-specific functionality of the plugin.
 *
 * @since      1.0.0
 *
 * @package    product_quick_view_for_woocommerce
 * @subpackage product_quick_view_for_woocommerce/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    product_quick_view_for_woocommerce
 * @subpackage product_quick_view_for_woocommerce/admin
 * @author     David Baty <davebuildswebsites.com>
 */
class Product_quick_view_for_woocommerce_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $product_quick_view_for_woocommerce    The ID of this plugin.
	 */
	private $product_quick_view_for_woocommerce;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $product_quick_view_for_woocommerce       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $product_quick_view_for_woocommerce, $version ) {

		$this->product_quick_view_for_woocommerce = $product_quick_view_for_woocommerce;
		$this->version = $version;

	}



	/**
	* render the welcom screen
	* @since 1.0.0
	* @link  https://codex.wordpress.org/Function_Reference/add_dashboard_page
	* @see   $this->welcome_screen_content()
	*/
	public function welcome_screen_pages() {
  		add_dashboard_page(
    		'Welcome To Product Quick View For WooCommerce',
    		'Welcome To Product Quick View For WooCommerce',
    		'read',
    		'product-quick-view-for-woocommerce-welcome',
     		array( $this, 'welcome_screen_content')
  		);
	}



	/**
	* welcome screen content
	* @since 1.0.0
	* @link  https://codex.wordpress.org/Function_Reference/add_dashboard_page
	* @see  $this->welcome_screen_pages()
	*/
	public function welcome_screen_content() {
		$shop_page_url = get_permalink( wc_get_page_id( 'shop' ) );

  		?>
  			
  			<div class="wrap">
    		


    			<h1>Thank You for using Product Quick View For WooCommerce </h1>

    			<h2>Getting Started</h2>

    			<p>You are ready to go from here! The Quick View Button will show on your product listngs. <a target="_blank" href="<?php echo $shop_page_url; ?>">Check it out:</a></p>

    			<p>But if you want to further customize this plugin like change the button text, or hide the button on all products check out the settings page: <a href="/wp-admin/admin.php?page=woocommerce_quick_view">Settings</a></p>


    			<h3>Video Instructions</h3>

					<h5>How to change the button text</h5>
					<iframe width="350" height="175" src="https://www.youtube.com/embed/h_XZtcBNW-g" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>

					<h5>How to hide the quick view button globally</h5>
					<iframe width="350" height="175" src="https://www.youtube.com/embed/7fXDQKXuQP0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>

					<h5>how to hide the quick view button on certain products</h5>
					<iframe width="350" height="175" src="https://www.youtube.com/embed/J8gzC36UjLw" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>

    			<h3>Helpful Links</h3>
    				<ul>
    					<li><a target="_blank" href="https://gitlab.com/greatdane89/woocommerce-quick-view">Docs.</a></li>
    					<li></li>
    				</ul>
  			</div>
  		
  		<?php
	}


	/**
	* Redirects to the welcome page only if the transient is set which the transient will only be set on activate 
	* @since 1.0.0
	* @link  https://codex.wordpress.org/Transients_API
	* @link  https://codex.wordpress.org/Function_Reference/wp_safe_redirect
	* @see  /includes/class-product-quick-view-for-woocommerce-activator.phh -> Product_quick_view_for_woocommerce_Activator::activate();
	*/
	public function welcome_screen_do_activation_redirect() {
  		
  		// Bail if no activation redirect
    	if ( ! get_transient( '_product_quick_view_for_woocommerce_welcome_screen_activation_redirect' ) ) {
    		return;
  		}

  		// Delete the redirect transient
  		delete_transient( '_product_quick_view_for_woocommerce_welcome_screen_activation_redirect' );

  		// Bail if activating from network, or bulk
  		if ( is_network_admin() || isset( $_GET['activate-multi'] ) ) {
    		return;
  		}

  		// Redirect to bbPress about page
  		wp_safe_redirect( add_query_arg( array( 'page' => 'product-quick-view-for-woocommerce-welcome' ), admin_url( 'index.php' ) ) );

	}


	/**
	* remove the dashboard menu page if it exists
	* @since 1.0.0
	*
	*
	*/
	public function welcome_screen_remove_menus() {
    	remove_submenu_page( 'index.php', 'product-quick-view-for-woocommerce-welcome' );
	}


  
	/**
 	* Modifies the admin credits.
 	* @since   1.0.0
 	* @param   string         $footer_text        text for 
 	* @link    https://codex.wordpress.org/Function_Reference/get_current_screen
 	* @link    https://developer.wordpress.org/reference/hooks/admin_footer_text/
 	*/
	public function my_custom_admin_credits( $footer_text ) {

		$footer_text = __( 'Thank you for using Product Quick View For WooCommerce' );

		$screen = get_current_screen();

		if($screen->id == 'woocommerce_page_woocommerce_quick_view' ) {
			return $footer_text;
		}
	}




	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {


		//wp_enqueue_style( $this->product_quick_view_for_woocommerce, plugin_dir_url( __FILE__ ) . 'css/product-quick-view-for-woocommerceadmin.css', array(), $this->version, 'all' );

	}



	
	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 * @link     https://developer.wordpress.org/reference/hooks/admin_enqueue_scripts/
	 * @see      class-product-quick-view-for-woocommerce.php   function define_public_hooks
	 * @param    string   Required   $handle  Name of the script. Should be unique.
	 * @param    string   optional   $src     Full URL of the script, or path of the script relative to the WordPress root directory
	 * @param    array    Optional   $deps    An array of registered script handles this script depends on.
	 * @param    string|bool|null   optional  $ver  String specifying script version number
	 * @param    bool     optional  $in_footer  Whether to enqueue the script before </body> instead of in the <head>
	 */
	public function enqueue_scripts() {

		//wp_enqueue_script( $this->product_quick_view_for_woocommerce, plugin_dir_url( __FILE__ ) . 'js/product-quick-view-for-woocommerce-admin.js', array( 'jquery' ), $this->version, false );

	}




	/**
	* Check user role 
	* @since 1.0.0
	* @example if($this->wcqv_check_user_role() == 1 ) {
	* @example if( Product_quick_view_for_woocommerce::wcqv_check_user_role()  == 1 ) { echo 'string';}
	*/
	public function wcqv_check_user_role( $arr ) {


		foreach ($arr as $wcqv_cap ) {
			if( current_user_can( $wcqv_cap ) ) {
				return true;

			} else {
				return false;
			}
		}


	}




    /**
    * @since 1.0.0
    * @link https://developer.wordpress.org/reference/functions/add_submenu_page/
    * @param   string    required   $parent_slug   The slug name for the parent menu (or the file name of a standard WordPress admin page
    * @param   string    required   $page_title    The text to be displayed in the title tags of the page when the menu is selected.
    * @param   string    required   $menu_title    The text to be used for the menu.
    * @param   string    required   $menu_slug     The slug name to refer to this menu by
    * @param   callable  optional   $function      he function to be called to output the content for this page.
    */
	public function woocommerce_quick_view_add_admin_menu() { 


		//add_submenu_page( 'woocommerce', 'Quick view', 'Quick view', 'manage_options', 'woocommerce_quick_view',   array( $this, 'woocommerce_quick_view_options_page' )); 

		if($this->wcqv_check_user_role( array('manage_options') ) == true ) { 

				add_submenu_page( 'woocommerce', 'Quick view', 'Quick view', 'manage_options', 'woocommerce_quick_view',   array( $this, 'wcqv_admin_settings_page' )); 
		}

	}




	/**
	* register settings section and fields
	* @since 1.0.0
	*
	* @link     https://codex.wordpress.org/Settings_API
	*
	**/
	public function woocommerce_quick_view_settings_init() { 
		
		register_setting( 
			'product_quick_view_for_woocommerce_general', // Option group
			'woocommerce_quick_view_settings',// Option name
			array( $this, 'sanitize' ) // Sanitize
		);

			add_settings_section(
				'woocommerce_quick_view_product_quick_view_for_woocommerce_section', 
				__( 'General Settings', 'woocommerce_quick_view' ), 
				array( $this, 'woocommerce_quick_view_settings_section_callback'), 
				'product_quick_view_for_woocommerce_general'
			);


				add_settings_field(
					'woocommerce_quick_view_button_text',
					__('Button text:<br/> "default is Quick View"'),
					array( $this, 'woocommerce_quick_view_button_text_render' ), 
					'product_quick_view_for_woocommerce_general', 
					'woocommerce_quick_view_product_quick_view_for_woocommerce_section' 			
				);		

				add_settings_field(
					'woocommerce_quick_view_button_hide',
					__('Hide Quick View Button'),
					array( $this, 'woocommerce_quick_view_button_hide_render' ), 
					'product_quick_view_for_woocommerce_general', 
					'woocommerce_quick_view_product_quick_view_for_woocommerce_section' 			
				);	


		register_setting( 
			'product_quick_view_for_woocommerce_advanced', // Option group
			'woocommerce_quick_view_settings',// Option name
			array( $this, 'sanitize' ) // Sanitize
		);

			add_settings_section(
				'woocommerce_quick_view_product_quick_view_for_woocommerce_section', 
				__( 'Advanced settings', 'woocommerce_quick_view' ), 
				array( $this, 'woocommerce_quick_view_settings_section_callback'), 
				'product_quick_view_for_woocommerce_advanced'
			);

				add_settings_field( 
					'woocommerce_quick_view_checkbox_cond_load_scripts', 
					__( 'Load script/styles on woocommerce pages only', 'woocommerce_quick_view' ), 
		 			array( $this, 'woocommerce_quick_view_checkbox_cond_load_scripts_render' ),
					'product_quick_view_for_woocommerce_advanced', 
					'woocommerce_quick_view_product_quick_view_for_woocommerce_section' 
				);

				add_settings_field( 
					'woocommerce_quick_view_checkbox_defer_load_scripts', 
					__( 'defer load script <br/>"for faster speed"', 'woocommerce_quick_view' ), 
					array( $this, 'woocommerce_quick_view_checkbox_defer_load_scripts_render' ), 
					'product_quick_view_for_woocommerce_advanced', 
					'woocommerce_quick_view_product_quick_view_for_woocommerce_section' 
				);

				add_settings_field( 
					'woocommerce_quick_view_checkbox_async_load_scripts', 
					__( 'async load script <br/>"for faster speed"', 'woocommerce_quick_view' ), 
					array( $this, 'woocommerce_quick_view_checkbox_async_load_scripts_render' ), 
					'product_quick_view_for_woocommerce_advanced', 
					'woocommerce_quick_view_product_quick_view_for_woocommerce_section' 
				);

				add_settings_field( 
					'woocommerce_quick_view_checkbox_defer_load_styles', 
					__( 'Defer load style <br/>"for faster speed"', 'woocommerce_quick_view' ), 
					array( $this, 'woocommerce_quick_view_checkbox_defer_load_styles_render' ), 
					'product_quick_view_for_woocommerce_advanced', 
					'woocommerce_quick_view_product_quick_view_for_woocommerce_section' 
				);

				add_settings_field( 
					'woocommerce_quick_view_checkbox_async_load_styles', 
					__( 'async load style <br/>"for faster speed"', 'woocommerce_quick_view' ), 
					array( $this, 'woocommerce_quick_view_checkbox_async_load_styles_render' ), 
					'product_quick_view_for_woocommerce_advanced', 
					'woocommerce_quick_view_product_quick_view_for_woocommerce_section' 
				);		


		register_setting( 
			'product_quick_view_for_woocommerce_troubleshooting', // Option group
			'woocommerce_quick_view_settings',// Option name
			array( $this, 'sanitize' ) // Sanitize
		);

			add_settings_section(
				'woocommerce_quick_view_product_quick_view_for_woocommerce_section', 
				__( 'TroubleShooting', 'woocommerce_quick_view' ), 
				array( $this, 'woocommerce_quick_view_settings_troubleshooting_callback'), 
				'product_quick_view_for_woocommerce_troubleshooting'
			);



	}//woocommerce_quick_view_settings_init	




	/**
	* set up the settings page tabs
	* @since 1.0.0
	* @see function woocommerce_quick_view_add_admin_menu()
	* @link     https://codex.wordpress.org/Settings_API
	* 
	**/
	public function wcqv_admin_settings_page(){
		global $sd_active_tab;
		$sd_active_tab = isset( $_GET['tab'] ) ? $_GET['tab'] : 'wcqvGeneralSettings'; ?>
 
 			<h1><?php _e( 'Product Quick View For WooCommerce Settings', 'woocommerce_quick_view' ); ?></h1>
				<h2 class="nav-tab-wrapper">
					<?php
						do_action( 'wcqv_settings_tab' );
					?>
				</h2>
					<?php
						do_action( 'wcqv_settings_content' );
	}




	/**
	* set up general tab url
	* @since 1.0.0
	*
	* @link     https://codex.wordpress.org/Settings_API
	**/
	public function wcqv_general_tab_init(){
		global $sd_active_tab; ?>
			<a class="nav-tab <?php echo $sd_active_tab == 'wcqvGeneralSettings' || '' ? 'nav-tab-active' : ''; ?>" href="<?php echo admin_url( 'admin.php?page=woocommerce_quick_view&tab=wcqvGeneralSettings' ); ?>"><?php _e( 'General Settings', 'woocommerce_quick_view' ); ?> </a>
		<?php
	}




	/**
	* general options tab content/settings
	* @since 1.0.0
	* @link     https://codex.wordpress.org/Settings_API
	*
	**/
	public function wcqv_general_render_options_tab() {
		global $sd_active_tab;
			if ( '' || 'wcqvGeneralSettings' != $sd_active_tab )
				return;



		if($this->wcqv_check_user_role( array('manage_options') ) == true ) { 

		?>


			<form action='options.php' method='post'>

					<?php
						settings_fields( 'product_quick_view_for_woocommerce_general');
						do_settings_sections( 'product_quick_view_for_woocommerce_general');
						submit_button();
					?>

			</form>
		<?php
		}	
	}




	/**
	* set up advanced options tab url
	* @since 1.0.0
	*
	* @link     https://codex.wordpress.org/Settings_API
	**/
	public function wcqv_advanced_tab_init(){
		global $sd_active_tab; ?>
			<a class="nav-tab <?php echo $sd_active_tab == 'wcqv-advanced-settings' ? 'nav-tab-active' : ''; ?>" href="<?php echo admin_url( 'admin.php?page=woocommerce_quick_view&tab=wcqv-advanced-settings' ); ?>"><?php _e( 'Advanced Settings', 'woocommerce_quick_view' ); ?> </a>
		<?php
	}
 



	/**
	* advanced options tab content
	* @since 1.0.0
	*
	* @link     https://codex.wordpress.org/Settings_API
	**/ 
	public function wcqv_advanced_tab_tab() {
		global $sd_active_tab;
			if ( 'wcqv-advanced-settings' != $sd_active_tab )
				return;
			if($this->wcqv_check_user_role( array('manage_options') ) == true ) { 
		?>
			<form action='options.php' method='post'>

					<?php
						settings_fields( 'product_quick_view_for_woocommerce_advanced');
						do_settings_sections( 'product_quick_view_for_woocommerce_advanced');
						submit_button();
					?>

			</form>
		<?php
		}
	}




	/**
	* set up advanced options tab url
	* @since 1.0.0
	*
	* @link     https://codex.wordpress.org/Settings_API
	**/
	public function wcqv_troubleshooting_init(){
		global $sd_active_tab; ?>
			<a class="nav-tab <?php echo $sd_active_tab == 'wcqv-troubleshooting' ? 'nav-tab-active' : ''; ?>" href="<?php echo admin_url( 'admin.php?page=woocommerce_quick_view&tab=wcqv-troubleshooting' ); ?>"><?php _e( 'Troubleshooting', 'woocommerce_quick_view' ); ?> </a>
		<?php
	}
 



	/**
	* advanced options tab content
	* @since 1.0.0
	*
	* @link     https://codex.wordpress.org/Settings_API
	**/ 
	public function wcqv_troubleshooting_tab() {
		global $sd_active_tab;
			if ( 'wcqv-troubleshooting' != $sd_active_tab )
				return;
			if($this->wcqv_check_user_role( array('manage_options') ) == true ) { 
		?>
			<form action='options.php' method='post'>

					<?php
						settings_fields( 'product_quick_view_for_woocommerce_troubleshooting');
						do_settings_sections( 'product_quick_view_for_woocommerce_troubleshooting');
		
					?>

			</form>
		<?php
		}
	}






    /**
     * Sanitize each setting field as needed
     * @since 1.0.0
     * @param array $input Contains all settings fields as array keys
     * @link https://codex.wordpress.org/Validating_Sanitizing_and_Escaping_User_Data
     */
    public function sanitize( $input ) {
        $new_input = array();

        	if( isset( $input['woocommerce_quick_view_checkbox_cond_load_scripts'] ) )
            	$new_input['woocommerce_quick_view_checkbox_cond_load_scripts'] = absint( $input['woocommerce_quick_view_checkbox_cond_load_scripts'] );
        		
        	if( isset( $input['woocommerce_quick_view_checkbox_defer_load_scripts'] ) )
            	$new_input['woocommerce_quick_view_checkbox_defer_load_scripts'] = absint( $input['woocommerce_quick_view_checkbox_defer_load_scripts'] );

        	if( isset( $input['woocommerce_quick_view_checkbox_async_load_scripts'] ) )
            	$new_input['woocommerce_quick_view_checkbox_async_load_scripts'] = absint( $input['woocommerce_quick_view_checkbox_async_load_scripts'] );

        	if( isset( $input['woocommerce_quick_view_checkbox_defer_load_styles'] ) )
            	$new_input['woocommerce_quick_view_checkbox_defer_load_styles'] = absint( $input['woocommerce_quick_view_checkbox_defer_load_styles'] );   
            		
        	if( isset( $input['woocommerce_quick_view_checkbox_async_load_styles'] ) )
            	$new_input['woocommerce_quick_view_checkbox_async_load_styles'] = absint( $input['woocommerce_quick_view_checkbox_async_load_styles'] );               		         	

        	/*if( isset( $input['woocommerce_quick_view_enable_logging'] ) )
            	$new_input['woocommerce_quick_view_enable_logging'] = absint( $input['woocommerce_quick_view_enable_logging'] ); */

        	if( isset( $input['woocommerce_quick_view_button_text'] ) )
            	$new_input['woocommerce_quick_view_button_text'] = sanitize_text_field( $input['woocommerce_quick_view_button_text'] );             

        	if( isset( $input['woocommerce_quick_view_button_hide'] ) )
            	$new_input['woocommerce_quick_view_button_hide'] = absint( $input['woocommerce_quick_view_button_hide'] ); 

        	return $new_input;
    }




    /**
    * render woocommerce_quick_view_checkbox_cond_load_scripts input
    * @since 1.0.0
    * @link     https://codex.wordpress.org/Settings_API
    */
	public function woocommerce_quick_view_checkbox_cond_load_scripts_render(  ) { 

		$options = get_option( 'woocommerce_quick_view_settings' );
		$options['woocommerce_quick_view_checkbox_cond_load_scripts'] = empty( $options['woocommerce_quick_view_checkbox_cond_load_scripts'] ) ? 0 : 1;		

			?>
				<input type='checkbox' name='woocommerce_quick_view_settings[woocommerce_quick_view_checkbox_cond_load_scripts]' <?php checked( $options['woocommerce_quick_view_checkbox_cond_load_scripts'], 1 ); ?> value='1'>
			<?php

	}




    /**
    * render woocommerce_quick_view_checkbox_defer_load_scripts input
    * @since 1.0.0
    * @link     https://codex.wordpress.org/Settings_API
    */
	public function woocommerce_quick_view_checkbox_defer_load_scripts_render(  ) { 

		$options = get_option( 'woocommerce_quick_view_settings' );
		$options['woocommerce_quick_view_checkbox_defer_load_scripts'] = empty( $options['woocommerce_quick_view_checkbox_defer_load_scripts'] ) ? 0 : 1;		

			?>
			
				<input type='checkbox' name='woocommerce_quick_view_settings[woocommerce_quick_view_checkbox_defer_load_scripts]' <?php checked( $options['woocommerce_quick_view_checkbox_defer_load_scripts'], 1 ); ?> value='1'>
			<?php

	}




    /**
    * render woocommerce_quick_view_checkbox_async_load_scripts input
    * @since 1.0.0
    * @link     https://codex.wordpress.org/Settings_API
    */
	public function woocommerce_quick_view_checkbox_async_load_scripts_render(  ) { 

		$options = get_option( 'woocommerce_quick_view_settings' );
		$options['woocommerce_quick_view_checkbox_async_load_scripts'] = empty( $options['woocommerce_quick_view_checkbox_async_load_scripts'] ) ? 0 : 1;		
			?>
				<input type='checkbox' name='woocommerce_quick_view_settings[woocommerce_quick_view_checkbox_async_load_scripts]' <?php checked( $options['woocommerce_quick_view_checkbox_async_load_scripts'], 1 ); ?> value='1'>
			<?php

	}




    /**
    * render woocommerce_quick_view_checkbox_defer_load_styles input
    * @since 1.0.0
    * @link     https://codex.wordpress.org/Settings_API
    */
	public function woocommerce_quick_view_checkbox_defer_load_styles_render(  ) { 

		$options = get_option( 'woocommerce_quick_view_settings' );
		$options['woocommerce_quick_view_checkbox_defer_load_styles'] = empty( $options['woocommerce_quick_view_checkbox_defer_load_styles'] ) ? 0 : 1;

			?>
				<input type='checkbox' name='woocommerce_quick_view_settings[woocommerce_quick_view_checkbox_defer_load_styles]' <?php checked( $options['woocommerce_quick_view_checkbox_defer_load_styles'], 1 ); ?> value='1'>
			<?php

	}




    /**
    * render woocommerce_quick_view_checkbox_async_load_styles input
    * @since 1.0.0
    * @link     https://codex.wordpress.org/Settings_API
    */
	public function woocommerce_quick_view_checkbox_async_load_styles_render(  ) { 

		$options = get_option( 'woocommerce_quick_view_settings' );
		$options['woocommerce_quick_view_checkbox_async_load_styles'] = empty( $options['woocommerce_quick_view_checkbox_async_load_styles'] ) ? 0 : 1;

			?>
				<input type='checkbox' name='woocommerce_quick_view_settings[woocommerce_quick_view_checkbox_async_load_styles]' <?php checked( $options['woocommerce_quick_view_checkbox_async_load_styles'], 1 ); ?> value='1'>
			<?php

	}





	/**
	* render  woocommerce_quick_view_button_text input
	* @since 1.0.0
	* @link     https://codex.wordpress.org/Settings_API
	**/
	public function woocommerce_quick_view_button_text_render() {
		$options = get_option( 'woocommerce_quick_view_settings' );
		$options['woocommerce_quick_view_button_text'] = empty( $options['woocommerce_quick_view_button_text'] ) ? '' : $options['woocommerce_quick_view_button_text'];

			?>
				<input type='text' name='woocommerce_quick_view_settings[woocommerce_quick_view_button_text]'  value='<?php echo $options['woocommerce_quick_view_button_text']; ?>'>

			<?php

	}




	/**
	* render  woocommerce_quick_view_button_text input
	* @since    1.0.0
	* @link     https://codex.wordpress.org/Settings_API
	*
	**/
	public function woocommerce_quick_view_button_hide_render(  ) { 


			$options = get_option( 'woocommerce_quick_view_settings' );
			$options['woocommerce_quick_view_button_hide'] = empty( $options['woocommerce_quick_view_button_hide'] ) ? 0 : 1;

			?>
				<input type='checkbox' name='woocommerce_quick_view_settings[woocommerce_quick_view_button_hide]' <?php checked( $options['woocommerce_quick_view_button_hide'], 1 ); ?> value='1'>
			<?php

	}




    /**
    * settings section callback function
    * @since 	1.0.0
    * @link     https://codex.wordpress.org/Settings_API
    *
    */
	public function woocommerce_quick_view_settings_section_callback(  ) { 

		echo __( '', 'woocommerce_quick_view' );

	}




    /**
    * settings section callback function
    * @since 	1.0.0
    * @link     https://codex.wordpress.org/Settings_API
    *
    */
	public function woocommerce_quick_view_settings_troubleshooting_callback(  ) { 

		?>
<p>first check out the error log: <a href="/wp-admin/admin.php?page=wc-status&tab=logs">Error Log</a></p>
					
					<h3>Helpful Videos</h3>
					<h4>How to change the button text</h4>
					<iframe width="350" height="175" src="https://www.youtube.com/embed/h_XZtcBNW-g" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>

					<h4>How to hide the quick view button globally</h4>
					<iframe width="350" height="175" src="https://www.youtube.com/embed/7fXDQKXuQP0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>

					<h4>how to hide the quick view button on certain products</h4>
					<iframe width="350" height="175" src="https://www.youtube.com/embed/J8gzC36UjLw" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
							<ul>
							<li><h4>The button is not showing on my product listing page:</h4>
								<ul>
									<li>Have you customized the WooCommerce archive-product.php file, in order for the button to display by default it uses the 'woocommerce_after_shop_loop_item' hook</li>
									<li>Check the settings page under WooCommerce -> Quick View and ensure the "hide quick view is unchecked".</li>
								</ul>
							</li>										
							<li><h4>I tried using a custom hook but it is not working:</h4>
								<ul>
									<li>when you use a custom hook a product ID must be passed in and it must be a product id</li>
								</ul>
							</li>
							<li><h4>I tried using shortcode but it is not working:</h4>
								<ul>
									<li>When using shortcode be sure to use the correct format: 
										<code>
											
    											echo do_shortcode('[wcqv_insert id="YOUR_PRODUCT_ID_HERE" ]');
								

										</code> 
										<br/><br/>
										or use <code>[wcqv_insert_slider id="PRODUCT_ID_HERE" ]</code> in the wordpress editor
									</li>
								</ul>
							</li>
				
						</ul>

		<?

	}



	/**
	* @since 	1.0.0
	* @link 	https://docs.woocommerce.com/document/adding-a-section-to-a-settings-tab/
	* @link 	https://www.ibenic.com/how-to-add-woocommerce-custom-product-fields/
	*
	*/
	public function wcqv_custom_tab_action_render() {
  		?>
 			<li class="custom_tab">
    			<a href="#wcqv_custom_panel">
     				<span><?php _e( 'Product Quick View', 'product-quick-view-for-woocommerce' ); ?></span>
    			</a>
 			</li>
  		<?php
	}




	/**
	* @since 		1.0.0
	* @link 		https://docs.woocommerce.com/document/adding-a-section-to-a-settings-tab/
	* @link 		https://www.ibenic.com/how-to-add-woocommerce-custom-product-fields/
	* @example 		echo get_post_meta( $post->ID, 'ID_GOES_HERE', true );
	* @example 		echo get_post_meta( get_the_ID(), 'ID_GOES_HERE', true );
	*/
	public function product_qv_wv_custom_tab() {
  		?>
  			<div id="wcqv_custom_panel" class="panel woocommerce_options_panel">
    			<div class="options_group">
      				<?php  

						$wcqv_chkbx_field = array(
							'id'            => '_checkbox', //slug
							'wrapper_class' => 'show_if_simple', 
							'label'         => __('Hide Quick View', 'product-quick-view-for-woocommerce' ), 
							'description'   => __( '<em>Hide Quick View on this product</em>', 'product-quick-view-for-woocommerce' ) 
        				);
        				// Checkbox
						woocommerce_wp_checkbox( $wcqv_chkbx_field );

     				?>
   				 </div>
  			</div>
		<?php
	}	




	/**
	* @since 	1.0.0
	* @link 	https://docs.woocommerce.com/document/adding-a-section-to-a-settings-tab/
	* @link 	https://www.ibenic.com/how-to-add-woocommerce-custom-product-fields/
	* @param	bool     $post_id     product ID
	*/
	public function product_qv_wv_custom_tab_save( $post_id ){

		// Checkbox
		$wcqv_woocommerce_checkbox = isset( $_POST['_checkbox'] ) ? 'yes' : 'no';
		update_post_meta( $post_id, '_checkbox', $wcqv_woocommerce_checkbox );

	}	


}// end Product_quick_view_for_woocommerce_Admin
