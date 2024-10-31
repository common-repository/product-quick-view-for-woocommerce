<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}




/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://gitlab.com/greatdane89/woocommerce-quick-view
 * @since      1.0.0
 *
 * @package    Product_quick_view_for_woocommerce
 * @subpackage Product_quick_view_for_woocommerce/public
 */




/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Product_quick_view_for_woocommerce
 * @subpackage Product_quick_view_for_woocommerce/public
 * @author     Your Name <email@example.com>
 */




/**
* @global  type $wcqv_options  get options for wcqv 
* @global  type $product       The WooCommerce product class handles individual product data.
*/
class Product_quick_view_for_woocommerce_public {



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
	 * @since      1.0.0
	 * @param      string    $product_quick_view_for_woocommerce       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $product_quick_view_for_woocommerce, $version ) {

		$this->product_quick_view_for_woocommerce = $product_quick_view_for_woocommerce;
		$this->version = $version;

	}




	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since   1.0.0
	 * @link    https://developer.wordpress.org/reference/functions/wp_enqueue_style/
	 * @see   	class-product-quick-view-for-woocommerce.php    define_public_hooks()
	 * @var     Int     $wcqv_options    If load scripts/styles conditionaly checked	 
	 */
	public function wcqv_enqueue_styles() {


 			$wcqv_options = get_option( 'woocommerce_quick_view_settings' );
			$wcqv_options['woocommerce_quick_view_checkbox_cond_load_scripts'] = empty( $wcqv_options['woocommerce_quick_view_checkbox_cond_load_scripts'] ) ? 0 : 1;
 			
 			if($wcqv_options['woocommerce_quick_view_checkbox_cond_load_scripts'] == 1) {
 			//if(!empty($wcqv_options['woocommerce_quick_view_checkbox_cond_load_scripts']) && checked($wcqv_options['woocommerce_quick_view_checkbox_cond_load_scripts']) == false  ) {

 				if( /*function_exists( 'is_woocommerce' )||*/ is_shop() || is_product_category() || is_product_tag() || is_product() || is_cart() || is_checkout() ) { 

 					if (!wp_style_is( $this->product_quick_view_for_woocommerce, 'enqueued' )) {

						wp_enqueue_style( $this->product_quick_view_for_woocommerce, plugin_dir_url( __FILE__ ) . 'css/product-quick-view-for-woocommerce-public.css', array(), $this->version, 'all' );

 					}	
 				}	
 				
			}  else {

				 	if (!wp_style_is( $this->product_quick_view_for_woocommerce, 'enqueued' )) {

						wp_enqueue_style( $this->product_quick_view_for_woocommerce, plugin_dir_url( __FILE__ ) . 'css/product-quick-view-for-woocommerce-public.css', array(), $this->version, 'all' );
 					}

			}			

	}




	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since   1.0.0
	 * @link    https://developer.wordpress.org/reference/functions/wp_enqueue_script/
	 * @see   	class-product-quick-view-for-woocommerce.php    define_public_hooks()
	 * @var     Int     $wcqv_options    If load scripts/styles conditionaly checked
	 */
	public function wcqv_enqueue_scripts() {

		$wcqv_options = get_option( 'woocommerce_quick_view_settings' );

		//if($wcqv_options['woocommerce_quick_view_checkbox_cond_load_scripts'] == 1) {
			if(!empty($wcqv_options['woocommerce_quick_view_checkbox_cond_load_scripts']) && checked($wcqv_options['woocommerce_quick_view_checkbox_cond_load_scripts']) == false  ) {
	
			if( function_exists( 'is_woocommerce' ) ) { 
		
				if ( is_woocommerce() &&  ! is_cart() && ! is_checkout() ) {

					wp_enqueue_script( $this->product_quick_view_for_woocommerce, plugin_dir_url( __FILE__ ) . 'js/product-quick-view-for-woocommerce-public.js', array(), $this->version, true );
		
				}
			}
		} else {

				wp_enqueue_script( $this->product_quick_view_for_woocommerce, plugin_dir_url( __FILE__ ) . 'js/product-quick-view-for-woocommerce-public.js', array(), $this->version, true );

		}

	}
                 



	/**
	* Adds defer/async to plugin loaded script tag via option
	* @optionName  woocommerce_quick_view_checkbox_async_load_scripts
	* @see  class-product-quick-view-for-woocommerce.php define_public_hooks()	
	* @since 1.0.0
	* @link https://developer.wordpress.org/reference/hooks/script_loader_tag/
	* @param string    $tag  		      The <script> tag for the enqueued script.
	* @param string    $handle            The script's registered handle.
	* @param string    $src               The script's source URL.	
	* @var   array     $scripts_to_defer  Array of script handles to defer.
	*/
	public function woocommerece_quick_view_add_defer_attribute( $tag, $handle, $src ) {
      
      if (!isset($scripts_to_defer)) { 
   		//$scripts_to_defer = array('woocommerce-quick-view-js');
      	$scripts_to_defer = array( $this->product_quick_view_for_woocommerce );
      }
   			
   			foreach($scripts_to_defer as $defer_script) {
      		
      			if ($defer_script === $handle) {


		$wcqv_options = get_option( 'woocommerce_quick_view_settings' );

		$wcqv_options['woocommerce_quick_view_checkbox_defer_load_scripts'] = empty( $wcqv_options['woocommerce_quick_view_checkbox_defer_load_scripts'] ) ? 0 : 1;
		$wcqv_options['woocommerce_quick_view_checkbox_async_load_scripts'] = empty( $wcqv_options['woocommerce_quick_view_checkbox_async_load_scripts'] ) ? 0 : 1;

					   if($wcqv_options['woocommerce_quick_view_checkbox_defer_load_scripts'] == 1 || $wcqv_options['woocommerce_quick_view_checkbox_async_load_scripts'] == 1) {

							 $wcqvDefer = $wcqv_options['woocommerce_quick_view_checkbox_defer_load_scripts']; 
							 $wcqvAsync = $wcqv_options['woocommerce_quick_view_checkbox_async_load_scripts']; 
         
         				
         				return str_replace(' src', ''.($wcqvDefer == 1 ? ' defer' : '').''.($wcqvAsync == 1 ? ' async' : '').' src', $tag);

					   }

      			}
  				
  			}
 
   		return $tag;

	}




	/**
	* Adds defer/async to plugin loaded styles tag via option
	* @optionName  woocommerce_quick_view_checkbox_async_load_scripts
	* @see  class-product-quick-view-for-woocommerce.php define_public_hooks()
	* @since 1.0.0
	* @link https://developer.wordpress.org/reference/hooks/style_loader_tag/
	* @param string    $html  		      The link tag for the enqueued style.
	* @param string    $handle            The style's registered handle.
	* @param string    $href              The stylesheet's source URL.	
	* @var   array     $styles_to_defer   Array of style handlers to defer.
	*/
	public function woocommerece_quick_view_add_defer_attribute_style( $html, $handle, $href ) {
	    if (!isset($styles_to_defer)) { 
   		 	//$styles_to_defer = array('woocommerce-quick-view-style');
     		$styles_to_defer = array(  $this->product_quick_view_for_woocommerce  );
     	} 
   			
   			foreach($styles_to_defer as $defer_script) {
      		
      			if ($defer_script === $handle) {

					$wcqv_options = get_option( 'woocommerce_quick_view_settings' );
	
					$wcqv_options['woocommerce_quick_view_checkbox_defer_load_styles'] = empty( $wcqv_options['woocommerce_quick_view_checkbox_defer_load_styles'] ) ? 0 : 1;
					$wcqv_options['woocommerce_quick_view_checkbox_async_load_styles'] = empty( $wcqv_options['woocommerce_quick_view_checkbox_async_load_styles'] ) ? 0 : 1;


					   if(!empty($wcqv_options['woocommerce_quick_view_checkbox_defer_load_styles']) ||  !empty($wcqv_options['woocommerce_quick_view_checkbox_async_load_styles']) ) {

							  $wcqvDeferStlye = $wcqv_options['woocommerce_quick_view_checkbox_defer_load_styles']; 
							  $wcqvAsyncStyle = $wcqv_options['woocommerce_quick_view_checkbox_async_load_styles']; 
         					
         				return str_replace(' href', ''.($wcqvDeferStlye == 1 ? ' defer' : '').''.($wcqvAsyncStyle == 1 ? ' async' : '').' href', $html);

					   }

      			}
  				
  			}
 
   		return $html;
	}




	/**
	 * Add Quick View Button to woocommerce archive page
	 * @see  class-product-quick-view-for-woocommerce.php         define_public_hooks()	
	 * @see  class-product-quick-view-for-woocommerce-modal.php   Class = wcqvModal
	 * @link https://github.com/woocommerce/woocommerce/search?utf8=%E2%9C%93&q=woocommerce_after_shop_loop_item
	 * @since    1.0.0
	 * @var  string    $wcqvid  Gets Product ID of queried post
	 * @var  string    $createWCQVmodal  Gets Product ID of queried post
	 *
	 */
	public function woocommerce_quick_view_add_modalButton_to_card() {


		global $product;
		if (!isset($wcqvid)) {  $wcqvid = $product->get_id(); }
		if (!isset($wcqvid)) { $createWCQVmodal = $product->get_id(); }


		//get hide on edit page setting
		$wcqv_get_hide_opt = get_post_meta( get_the_ID(), '_checkbox', true );

		//get button text options
	  	$wcqv_options = get_option( 'woocommerce_quick_view_settings' );
 		
		if(empty($wcqv_options['woocommerce_quick_view_button_text']) ) {
 			$wcqvBtnTxt = 'Quick View'; 

 		} else {
 			$wcqvBtnTxt =  $wcqv_options['woocommerce_quick_view_button_text']; 

 		}

 		if(empty($wcqv_options['woocommerce_quick_view_button_hide'])) {

		if( $wcqv_get_hide_opt !== 'yes' ) {

		?>

		<button data-quantity="1" class="button product_type_simple wcqv_modal_toggle" data-product_id="<?php echo $wcqvid ?>"  aria-label="" rel="nofollow"><?php echo  _e( $wcqvBtnTxt ); ?></button>

			     <!-- The Modal -->
	        <div id="wcqv-modal-<?php echo  $wcqvid; ?>" class="wcqv_modal">

  	            <!-- Modal content -->
  	            <div class="wcqv-modal-content">

    	            <span class="wcqvCloseModal" modal_target="<?php echo $wcqvid ?>">&times;</span>

                  <?

                     $createWCQVmodal = new wcqvModal($wcqvid);
                     echo $createWCQVmodal->wcqcDisplayModal();//display it
                  ?>
  	            </div>

            </div>

            <noscript>

                <style>.wcqv_modal_toggle, .wcqv_modal {display: none; }</style>

                <?php

                $logger = wc_get_logger();
				$logger->debug( 'Error: no JavaScript, plugin modal will not fire', array( 'source' => 'product-quick-view-for-woocommerce' ) );

                ?>

            </noscript>
		<?
			}
		}	
	}




	/**
	* custom query to allow quick view button/modal to be place anywhere - must pass in product id else function trys get the id
	* @since 	 1.0.0
	* @link      https://codex.wordpress.org/Plugin_API/Hooks
	* @link      https://codex.wordpress.org/Function_Reference/wp_script_is
	* @param     bool     $wcqvid    id pf product
	* @example   do_action('wc_quick_view_insert', $ID); 
	*/
	public function wcqv_register_custom_query( $wcqvid ) {

		if ( !empty($wcqvid ) && $wcqvid  != null ) {//if id passed in
			
			if(wc_get_product($wcqvid ) == true ) {//if id is woo product

				$wcqv_id = $wcqvid;
				
			}	else { //throw err

				$logger = wc_get_logger();
				$logger->debug( 'Error: the ID passed in is not a product ID.', array( 'source' => 'product-quick-view-for-woocommerce' ) );

				die('Error: the ID passed in is not a product ID. please see the  <a target="_blank" href="https://gitlab.com/greatdane89/woocommerce-quick-view/wikis/WooCommerce-Quick-View-Shortcodes">Documentation</a>');
			}
	
		} else { //id not passed

			$wcqv_id = get_the_ID();

			if($wcqv_id !== false && wc_get_product($wcqv_id ) == true ) { //if post object is available and is a woocommerce id

				  $wcqv_id = get_the_ID(); 		
      					
			} else { //throw err

				$logger = wc_get_logger();
				$logger->debug( 'A product ID is not available and must be passed in', array( 'source' => 'product-quick-view-for-woocommerce' ) );

				die('A product ID is not available and must be passed in. please see the  <a target="_blank" href="https://gitlab.com/greatdane89/woocommerce-quick-view/wikis/WooCommerce-Quick-View-Shortcodes">Documentation</a>');
			} 
		}

    	if (!wp_script_is( $this->product_quick_view_for_woocommerce, 'enqueued' )) {
       		//wp_register_script( $this->product_quick_view_for_woocommerce, plugin_dir_url( __FILE__ ) . 'js/product-quick-view-for-woocommerce-public.js', array(), $this->version, true );
       		//wp_enqueue_script( $this->product_quick_view_for_woocommerce );
       		wp_enqueue_script( $this->product_quick_view_for_woocommerce, plugin_dir_url( __FILE__ ) . 'js/product-quick-view-for-woocommerce-public.js', array(), $this->version, true );

     	} 
    	if (!wp_style_is( $this->product_quick_view_for_woocommerce, 'enqueued' )) {
			//wp_register_style($this->product_quick_view_for_woocommerce, plugins_url( 'my-plugin/css/plugin.css' ) );
			//wp_enqueue_style($this->product_quick_view_for_woocommerce );
			wp_enqueue_style( $this->product_quick_view_for_woocommerce, plugin_dir_url( __FILE__ ) . 'css/product-quick-view-for-woocommerce-public.css', array(), $this->version, 'all' );

     	}	


		//get hide on edit page setting
		$wcqv_get_hide_opt = get_post_meta( get_the_ID(), '_checkbox', true );



		//get button text options
	  	$wcqv_options = get_option( 'woocommerce_quick_view_settings' );
 		//$wcqvBtnTxt =  $wcqv_options['woocommerce_quick_view_button_text']; 
 		if(empty($wcqv_options['woocommerce_quick_view_button_text']) ) {
 			
 			$wcqvBtnTxt = 'Quick View'; 
 		} else {
 			$wcqvBtnTxt =  $wcqv_options['woocommerce_quick_view_button_text']; 
 		}


 		//get global hide option
		//$wcqvGlobalHide = $wcqv_options['woocommerce_quick_view_button_hide']; 

		//if(strlen(trim($wcqvBtnTxt)) <= 0){ $wcqvBtnTxt = 'Quick View'; }  

		//if( $wcqvGlobalHide !== 1 ) {
 		if(empty($wcqv_options['woocommerce_quick_view_button_hide'])  ) {

		if( $wcqv_get_hide_opt !== 'yes' ) {

		?>



		<button data-quantity="1" class="button product_type_simple wcqv_modal_toggle" data-product_id="<?php echo $wcqv_id ?>"  aria-label="" rel="nofollow"><?php echo  _e( $wcqvBtnTxt ); ?></button>


	     <!-- The Modal -->
	        <div id="wcqv-modal-<?php echo  $wcqv_id; ?>" class="wcqv_modal">

  	            <!-- Modal content -->
  	            <div class="wcqv-modal-content">

    	            <span class="wcqvCloseModal" modal_target="<?php echo $wcqv_id ?>">&times;</span>

                  <?

                     $createWCQVmodal = new wcqvModal($wcqv_id);
                     echo $createWCQVmodal->wcqcDisplayModal();//display it
                  ?>
  	            </div>

            </div>
            <noscript>
                <style>.wcqv_modal_toggle, .wcqv_modal {display: none; }</style>

                <?php

                	$logger = wc_get_logger();
					$logger->debug( 'Error: no JavaScript, plugin modal will not fire', array( 'source' => 'product-quick-view-for-woocommerce' ) );

                ?>
            </noscript>

		<?
		}

	  }
	  
	}
	




	/**
	*
	* Registers shortcode 
	*
	* @since 1.0.0
	* @param     array        $wcqv_atts              array of shortcode attributes passed in
	* @var       array        $wcqv_arr               retrieves array from @param $wcqv_atts
	* @var       arrayval     $wcqv_shortcode_p_id    retreves @var $wcqv_arr key value passed in from shortcode 
	*
	* @see  /public/class-pproduct-quick-view-for-woocommerce.php => Plugin_Name_Public->wcqv_register_custom_query();
	* @link https://codex.wordpress.org/Function_Reference/add_shortcode
	* @link https://developer.wordpress.org/reference/functions/add_shortcode/
	* @link https://codex.wordpress.org/Shortcode_API
	* @example echo do_shortcode('[wcqv_insert id="118" ]');
	*
	*/
	public static function wcqv_register_shortcode( $wcqv_atts  ) {

		//if id passed in
		if ( !empty($wcqv_atts['id']) && $wcqv_atts['id'] != null ) {
			
			if(wc_get_product($wcqv_atts['id'] ) == true ) {

				$wcqv_id = $wcqv_atts['id'];
				
			}	else {

				die('Error: the ID passed in is not a product ID. please see the  <a target="_blank" href="https://gitlab.com/greatdane89/woocommerce-quick-view/wikis/WooCommerce-Quick-View-Shortcodes">Documentation</a>');
			}
	
		} else { //id not passed

			$wcqv_id = get_the_ID();

			if($wcqv_id !== false && wc_get_product($wcqv_id ) == true ) { //if post object is available and is a woocommerce id

				  $wcqv_id = get_the_ID(); 		
      					
			} else { //die

				die('A product ID is not available and must be passed in. please see the  <a target="_blank" href="https://gitlab.com/greatdane89/woocommerce-quick-view/wikis/WooCommerce-Quick-View-Shortcodes">Documentation</a>');
			} 
		}

		$wcqv_arr = shortcode_atts( array(
			'id' => array($wcqv_id)
		), $wcqv_atts );

		$wcqv_shortcode_p_id = $wcqv_arr['id'];

	 	do_action('wc_quick_view_insert', $wcqv_shortcode_p_id); 
	
	}


	/**
	* returns an array of 
	* @since     1.0.0
	* @param     array          $vailable_variations           the variations array of a product
	* @return    Array([0] =&gt; Array([thumbnailID] =&gt; 109 [name] =&gt; Green ) [1] =&gt; Array ( [thumbnailID] =&gt; 111[name] =&gt; Black) )
	* @see 		 $this->wcqv_register_slider() 
	*/	
	public function wcqv_get_variations_check( $vailable_variations ) {
	
		$dave = array();
		
		//$variation_names = array();
		
			foreach ($vailable_variations as $variation ) {

				// Get attribute taxonomies
				$taxonomies = array_keys($variation['attributes']);
	
				//$variationImageID = $variation['image_id'];

					// Loop through variation taxonomies to get variation name and slug
					foreach ($taxonomies as $tax) {

						// Check if its a taxonomy you wish to exclude
						// Remove if statement if you're not excluding anything. 

    					global $post;//Need this ?????


						$get_term_tax = str_replace('attribute_', '', $tax);
						$meta = get_post_meta( $variation['variation_id'], $tax, true );
						$term = get_term_by( 'slug', $meta, $get_term_tax );

    						if ( !$term == NULL  ) {

								$var_name = $term->name;
								//$variation_names[] = $var_name;
		
								$rr = array();
								$rr['thumbnailID'] = $variation['image_id'];
								$rr['name'] = $term->name;
								//$dave['thumbnailID'] = $variation['image_id'];
								//$dave['variation_value'] = $term->name;
								$dave[] = $rr;
							}

				}

		

		}

		return $dave;

	}// end wcqv_get_variations_check






	/**
	* @since 1.0.0
	*
	* registers the action for the product carousel
	*
	* @param   bool     $wcqvid      id of passed in product
	* @link  https://codex.wordpress.org/Plugin_API/Hooks
	* @see  /includes/product-quick-view-for-woocommerce-modal.php
	* @see  /public/partials/quick-view.php
	* @example do_action('wc_quick_view_slider', $PRODUCT_ID); 
	*/
	public function wcqv_register_slider(  $wcqvid  ) {


		//if id passed in
		if ( !empty($wcqvid ) && $wcqvid  != null ) {
			
			if(wc_get_product($wcqvid ) == true ) {//if id is woo product

				$wcqv_id = $wcqvid;
				
			}	else { //throw err

               	$logger = wc_get_logger();
				$logger->debug( 'Error: the ID passed in is not a product ID', array( 'source' => 'product-quick-view-for-woocommerce' ) );
				
				die('Error: the ID passed in is not a product ID. please see the  <a target="_blank" href="https://gitlab.com/greatdane89/woocommerce-quick-view/wikis/WooCommerce-Quick-View-Shortcodes">Documentation</a>');
			}
	
		} else { //id not passed

			$wcqv_id = get_the_ID();

			if($wcqv_id !== false && wc_get_product($wcqv_id ) == true ) { //if post object is available and is a woocommerce id

				  $wcqv_id = get_the_ID(); 		
      					
			} else { //throw err

               	$logger = wc_get_logger();
				$logger->debug( 'A product ID is not available and must be passed in.', array( 'source' => 'product-quick-view-for-woocommerce' ) );

				die('A product ID is not available and must be passed in. please see the  <a target="_blank" href="https://gitlab.com/greatdane89/woocommerce-quick-view/wikis/WooCommerce-Quick-View-Shortcodes">Documentation</a>');
			} 
		}


  
    	if (!wp_script_is( $this->product_quick_view_for_woocommerce, 'enqueued' )) {
       		//wp_register_script( $this->product_quick_view_for_woocommerce, plugin_dir_url( __FILE__ ) . 'js/product-quick-view-for-woocommerce-public.js', array(), $this->version, true );
       		//wp_enqueue_script( $this->product_quick_view_for_woocommerce );
       		wp_enqueue_script( $this->product_quick_view_for_woocommerce, plugin_dir_url( __FILE__ ) . 'js/product-quick-view-for-woocommerce-public.js', array(), $this->version, true );

     	} 
    	if (!wp_style_is( $this->product_quick_view_for_woocommerce, 'enqueued' )) {
			//wp_register_style($this->product_quick_view_for_woocommerce, plugins_url( 'my-plugin/css/plugin.css' ) );
			//wp_enqueue_style($this->product_quick_view_for_woocommerce );
			wp_enqueue_style( $this->product_quick_view_for_woocommerce, plugin_dir_url( __FILE__ ) . 'css/product-quick-view-for-woocommerce-public.css', array(), $this->version, 'all' );

     	}	
		
     	    //global $product; 
      		$productID = $wcqv_id;
      		$product =  wc_get_product( $wcqv_id );
      		$this->id = $productID;
      		//$product->get_image_id();   
      		$this->imgUrl = get_the_post_thumbnail_url( /*$product->get_id()*/$this->id, 'full' );
      		$this->attachment_ids = $product->get_gallery_image_ids();
      		$this->FeatImageID = $product->get_image_id();



           		//if have  gallery items && more than 1
                if(!empty($this->attachment_ids) && count($this->attachment_ids) > 1 ) {

            ?>

                <div class="wcqvSliderWrap">
                    
                    <div class="glide" id="glide-<?php echo $this->id ?>">
                           
                        <div class="glide__track" data-glide-el="track">    
                            
                            <ul class="glide__slides">
                                <?php
                                    
                                    $wcqv_count = 0;


										//check to confirm if variation image is in product gallery, if not it adds it
										if ( $product->is_type( 'variable' ) ) {

											$this->available_variations = $product->get_available_variations();
											
											$daveTestinit = $this->wcqv_get_variations_check( $this->available_variations );//array

												//loop matched variation imgs/variation name
												foreach ($daveTestinit as $key) {

													//if the variation thumbnail id is = to featured image
													/*NOTE: by default, if no variation image is select-> the default variation thumbnail id will be the featured image id-we dont want this.*/
													if($key['thumbnailID'] !== $this->FeatImageID) {

														//if variation id/image is not in the product gallery then add it
														if(  in_array($key['thumbnailID'], $this->attachment_ids)  == false ) {
																
															$this->attachment_ids[] = $key['thumbnailID'];
									
														}

																
													}

												}	
										
										}
										//end check


									//loop the gallery
                                    foreach ($this->attachment_ids as $wcqv_gallery_key ) {
                                       
                                       $image_attributes = wp_get_attachment_image_src( $attachment_id = $wcqv_gallery_key );

										?>

                                        <li slideNum="<?php echo $wcqv_count; ?> " class="glide__slide">
                                        	
                                        	<?

												if ( $product->is_type( 'variable' ) ) {

													//get the variations
													$this->available_variations = $product->get_available_variations();
										
													//send to wcqv_get_variations_check and get the matched thumbanil ids to attribute
													/**
													* @see Product_quick_view_for_woocommerce_public->wcqv_get_variations_check();
													*/
													$daveTest = $this->wcqv_get_variations_check( $this->available_variations );


													//set image id to its thumbnail id	
													$wcqv_galleryImg_id = $wcqv_gallery_key;


														//loop  the thumbnail id to varaitation name array
														foreach ($daveTest as $key) {

															if($key['thumbnailID'] == $wcqv_gallery_key ) {
						
																$wcqv_galleryImg_id = "glide_slide_".$key['name']."";
															}

														}	

												}


                                ?>
               									<img id="<?php echo  $wcqv_galleryImg_id; ?>" src="<?php echo $image_attributes[0]; ?>" alt="<?php echo $image_attributes[0]; ?>" title="<?php echo $image_attributes[0]; ?>">
                                        
                                        </li>
                                 <?
                                    $wcqv_count++;

                                    }
                                 
                                 ?>

                             </ul>
                           
                        </div>
                        
                        <div class="glide__arrows" data-glide-el="controls">
                            
                            <button class="glide__arrow glide__arrow--left" data-glide-dir="<"> &#10094; </button>
                            <button class="glide__arrow glide__arrow--right" data-glide-dir=">"> &#10095; </button>
                           
                        </div>
                        
                        <div class="glide__bullets" data-glide-el="controls[nav]">
                    	
                    	<?php
                           //thumbnails for slider
                           $c2 = 0;
                           
                           foreach ($this->attachment_ids as $wcqv_gallery_key ) {
                              
                              $image_attributes = wp_get_attachment_image_src( $attachment_id = $wcqv_gallery_key );
                    	?>
                                
                                 <div class="glide__bullet" data-glide-dir="=<?php echo $c2 ?>">
                                   
                                    <img class="wcqv-thumbnail" src="<?php echo $image_attributes[0]; ?>" alt="<?php echo $image_attributes[0]; ?>" title="<?php echo $image_attributes[0]; ?>">
                                 
                                 </div>
                    	<?
                           $c2++;
                           
                           }
                    
                    	?>
                        
                        </div>
                        
                    </div>
                
                </div>

            <?

                } else {
                  
                  if(has_post_thumbnail($productID)) {
            
            ?>
            
                    <img  alt="<?php echo $image_attributes[0]; ?>" src="<?php echo $this->imgUrl; ?>"  />
            
            <?
                  }

               }

			?>
             	<noscript>

                	<style>.wcqvSliderWrap {display: none; }</style>
					<?php

               			$logger = wc_get_logger();
						$logger->debug( 'Error: no JavaScript for carousel to function', array( 'source' => 'product-quick-view-for-woocommerce' ) );

					?>
            	</noscript>

			<?

	}//wcqv_register_slider




	/**
	* 
	* Shortcode to embed slider
	* @since 1.0.0
	* @param array        $wcqv_atts   array of shortcode i.e product id
	* @param     array        $wcqv_atts              array of shortcode attributes passed in
	* @var       array        $wcqv_arr               retrieves array from @param $wcqv_atts
	* @var       arrayval     $wcqv_shortcode_p_id    retreves @var $wcqv_arr key value passed in from shortcode 
	*
	* @see  /public/class-product-quick-view-for-woocommerce.php => Plugin_Name_Public->wcqv_register_custom_query();
	* @link https://codex.wordpress.org/Function_Reference/add_shortcode
	* @link https://developer.wordpress.org/reference/functions/add_shortcode/
	* @link https://codex.wordpress.org/Shortcode_API
	* @example do_shortcode('[wcqv_insert_slider id="PRODUCT_ID_HERE" ]');
	*/
	public static function wcqv_register_slider_shortcode( $wcqv_atts ) {

		//if id passed in
		if ( !empty($wcqv_atts['id']) && $wcqv_atts['id'] != null ) {
			
			if(wc_get_product($wcqv_atts['id'] ) == true ) {

				$wcqv_id = $wcqv_atts['id'];
				
			}	else {

               	$logger = wc_get_logger();
				$logger->debug( 'Error: the ID passed in is not a product ID.', array( 'source' => 'product-quick-view-for-woocommerce' ) );

				die('Error: the ID passed in is not a product ID. please see the  <a target="_blank" href="https://gitlab.com/greatdane89/woocommerce-quick-view/wikis/WooCommerce-Quick-View-Shortcodes">Documentation</a>');
			}
	
		} else { //id not passed

			$wcqv_id = get_the_ID();

			if($wcqv_id !== false && wc_get_product($wcqv_id ) == true ) { //if post object is available and is a woocommerce id

				  $wcqv_id = get_the_ID(); 		
      					
			} else { //die

               	$logger = wc_get_logger();
				$logger->debug( 'A product ID is not available and must be passed in.', array( 'source' => 'product-quick-view-for-woocommerce' ) );

				die('A product ID is not available and must be passed in. please see the  <a target="_blank" href="https://gitlab.com/greatdane89/woocommerce-quick-view/wikis/WooCommerce-Quick-View-Shortcodes">Documentation</a>');
			} 
		}


		$wcqv_arr = shortcode_atts( array(
			'id' => array($wcqv_id)
		), $wcqv_atts );

		$wcqv_shortcode_p_id = $wcqv_id;

	 	do_action('wc_quick_view_slider', $wcqv_shortcode_p_id); 
	
	}

}// end Product_quick_view_for_woocommerce





	add_shortcode( 'wcqv_insert', array( 'Product_quick_view_for_woocommerce_public', 'wcqv_register_shortcode' ) );
	add_shortcode( 'wcqv_insert_slider', array( 'Product_quick_view_for_woocommerce_public', 'wcqv_register_slider_shortcode' ) );



	/**
	* include modal class
	* @see /includes/class--product-quick-view-for-woocommerce-modal.php
	*/
	require_once(dirname(plugin_dir_path(__FILE__)) . '/includes/class-product-quick-view-for-woocommerce-modal.php');






