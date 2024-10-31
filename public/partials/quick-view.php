<?php
/**
 * The Template for displaying quick view modal/popup content
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/quick-view/quick-view.php.
 *
 * @since     1.0.0 
 * @author 		David Baty    https://davebuildswebsites.com
 * @package 	public/partials
 * @see      /wp_content/plugins/quick-view/includes/class-plugin-name-modal.php
 * @link        https://codex.wordpress.org/Templates
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>
    <div class="wcqv-grid">
        <div class="wcqv-item">
            <?


            do_action('wc_quick_view_slider', $this->id ); 
?>

            </div><!--"wcqv-item"-->

            <div class="wcqv-item">

                <?php

                	//query single product
                	$params = array(
                    	'p' => $this->id, 
                    	'post_type' => 'product'
                  	);
                  
                  	$wc_query = new WP_Query($params); 

                  		if ($wc_query->have_posts()) : 
                    
                    		while ($wc_query->have_posts()) : $wc_query->the_post(); 

                      			do_action('woocommerce_single_product_summary');

                      			/*if(!isset($wcqvModal_productSummary)) {
                        		
                        			$wcqvModal_productSummary = get_the_content();
                        			_e('<p>'.$wcqvModal_productSummary.'</p>');
                    			
                    			}

                      				do_action('woocommerce_before_add_to_cart_form');
                      				do_action('woocommerce_before_add_to_cart_button');
                      				do_action('woocommerce_before_single_variation');
                      				do_action('woocommerce_single_variation');
                      				do_action('woocommerce_after_single_variation');
                      				do_action('woocommerce_after_add_to_cart_button');
                      				do_action('woocommerce_after_variations_form');
                      				do_action('woocommerce_after_add_to_cart_form');
                      				do_action('woocommerce_product_meta_end');
                      				do_action('woocommerce_share');
                 */
                    		endwhile;
                    
                    		wp_reset_postdata(); 
                  
                  		else: 
              	?> 

                			<p><?php _e( 'No Product' );  ?></p>

              <?php 

                  	endif; 
              
              ?>
            </div><!--"wcqv-item"-->

         </div><!--"wcqv-grid"-->



