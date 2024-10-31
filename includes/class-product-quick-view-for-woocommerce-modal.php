<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
/**
 * 
 * Class that quries the product to display in the quick view modal
 * 
 *
 * @link       https://gitlab.com/greatdane89/woocommerce-quick-view
 * @since      1.0.0
 * @package    product-quick-view-for-woocommerce
 * @subpackage product-quick-view-for-woocommerce/includes
 */



if (!class_exists('wcqvModal') ){

  class wcqvModal {
 
  /**
  * contruct the class
  * @since    1.0.0
  * @param    $id       id pf product to query
  */
  public function __construct($id)
  {
      //global $product; 
      $productID = $id;
      $product =  wc_get_product( $id );
      $this->id = $productID;
      $this->name = $product->get_name();
      $this->expert = $product->get_short_description();
      $this->link = get_permalink( $product->get_id() );  
      $product->get_image_id();   
      $this->imgUrl = get_the_post_thumbnail_url( $product->get_id(), 'full' );
      $this->attachment_ids = $product->get_gallery_image_ids();
      $this->productDescription = $product->get_description();
      $this->sku = $product->get_sku();
      $this->title = get_the_title(); 
      $this->regPrice = $product->get_regular_price();  
      $this->salePrice = $product->get_sale_price();     
      
     /* if($product->product_type=='variable') {

      }*/        
  }
 


  /**
  * checks theme directory to see if custom template is being used, else uses product quick view for woocommerce template
  * @since    1.0.0
  * @see      /public/partials/quick-view.php
  * @see      /public/class-product-quick-view-for-woocommerce.php
  * @var      string        $wcqvCheckTheme       checks theme directory for overidable template  
  * @var      string        $wcqvGetTemplate      directory of content for quik view modal
  * @link https://codex.wordpress.org/Templates 
  */
  public function wcqcDisplayModal()
  {

    //check if overide template exists
    if (!isset($wcqvCheckTheme)) { 
      $wcqvCheckTheme = get_stylesheet_directory() . '/woocommerce/quick-view/quick-view.php';
    }

    if (!isset($wcqvGetTemplate)) { 
      $wcqvGetTemplate = dirname(plugin_dir_path(__FILE__)) . '/public/partials/quick-view.php';
    }

    ob_start();

      //overidable template in theme
      if( ! file_exists( $wcqvCheckTheme ) ) {

        include $wcqvGetTemplate;

      } else {

        include $wcqvCheckTheme;

      }


   $response = ob_get_contents();
   ob_end_clean();

   echo $response;
   
  }


  }//class wcqvModal {

}//if (!class_exists('wcqvModal') ){