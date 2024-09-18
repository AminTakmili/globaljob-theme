<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

// Ensure visibility
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}

$classes = 'col-lg-12 col-md-12 col-sm-6 col-12'; 
?>
<div <?php post_class( $classes ); ?>>
	<div class="dlab-box product product-pro">
        <div class="row">
			<?php
            /**
             * woocommerce_before_shop_loop_item hook.
             *
             * @hooked woocommerce_template_loop_product_link_open - 10
             */
           
        
            /**
             * woocommerce_before_shop_loop_item_title hook.
             *
             * @hooked woocommerce_show_product_loop_sale_flash - 10
             * @hooked woocommerce_template_loop_product_thumbnail - 10
             */
             
             $post_thumbnail_id = get_post_thumbnail_id($post->ID);
             $post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );
             
             ?>
             <div class="col-xl-4 col-lg-5">
                <div class="dlab-thum-bx">
                    <?php woocommerce_template_loop_product_thumbnail();?>
                </div>
             </div>
             <?php do_action( 'woocommerce_before_shop_loop_item_title' );
        
            /**
             * woocommerce_shop_loop_item_title hook.
             *
             * @hooked woocommerce_template_loop_product_title - 10
             */
           
        
            /**
             * woocommerce_after_shop_loop_item_title hook.
             *
             * @hooked woocommerce_template_loop_rating - 5
             * @hooked woocommerce_template_loop_price - 10
             */
            do_action( 'woocommerce_after_shop_loop_item_title' );
            ?>
                
                <div class="col-xl-8 col-lg-7">
                    <div class="dlab-info">
                        <h5 class="dlab-title m-t0 m-b5"><a href="<?php echo esc_url(get_the_permalink(get_the_id()));?>"><?php the_title();?></a></h5>
                        <h6 class=""><?php woocommerce_template_loop_price();?></h6>
                        <?php the_excerpt();?>
                    </div>
                    <div class="">
                        <div class="overlay-icon"> 
                            <a href="<?php echo esc_url(get_the_permalink(get_the_id()));?>"> <i class="fa fa-cart-plus icon-bx-xs radius"></i> </a>  
                            <a href="javascript:void(0)"> <i class="fa fa-heart icon-bx-xs radius"></i> </a> 
                        </div>
                    </div>
                </div>
        </div>
	</div>
</div>
