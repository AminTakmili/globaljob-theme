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

$product_column = jobzilla_get_opt('no_of_related_product');


if($product_column == 2)
{
	$classes = 'col-lg-6 col-md-6 col-sm-6'; 
}else if($product_column == 3)
{
	$classes = 'col-lg-4 col-md-6 col-sm-6'; 	
}else if($product_column == 4)
{
	$classes = 'col-lg-3 col-md-6 col-sm-6'; 
}else{
	$classes = 'col-lg-4 col-md-6 col-sm-6'; 	
}
 
?>
<div <?php post_class( $classes ); ?>>
	<div class="dz-box product">
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
            <div class="item-box">
              <div class="item-img">
                <?php woocommerce_template_loop_product_thumbnail();?>
                <div class="item-info-in">
                  <ul>
                  <li>
                    <?php
                      echo sprintf( '<a rel="nofollow" href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="%s product_type_simple ">%s</a>',
                                  esc_url( $product->add_to_cart_url() ),
                                  esc_attr( !empty( $quantity ) ? $quantity : 1 ),
                                  esc_attr( $product->get_id() ),
                                  esc_attr( $product->get_sku() ),
                                  esc_attr( !empty( $class ) ? $class : 'add_to_cart_button ajax_add_to_cart' ),
                                  '<i class="fas fa-shopping-cart"></i>' 
                                  );
                    ?>
                  </li>
                  <li>
                    <?php if (class_exists('YITH_WCQV')) { ?>
                    <div class="woocommerce-quick-view">
                      <a href="#" class="yith-wcqv-button" data-product_id="<?php echo esc_attr( $product->get_id() ); ?>"><i class="far fa-eye"></i></a>
                    </div>
                  <?php } ?>
                  </li>
                 <li>
                    <div class="woocommerce-wishlist">
                      <?php if (class_exists('YITH_WCWL')) {
                          echo do_shortcode('[yith_wcwl_add_to_wishlist link_classes="add_to_wishlist" label="" product_added_text="" browse_wishlist_text="" already_in_wishslist_text="" icon="fa-heart"]');
                      } ?>
                    </div>
                  </li>
                  </ul>
                </div>
              </div>
              <div class="item-info">
                <?php 
                  do_action( 'woocommerce_before_shop_loop_item_title' );
                  /**
                   * woocommerce_shop_loop_item_title hook.
                   *
                   * @hooked woocommerce_template_loop_product_title - 10
                   */
                 ?>
                <h6 class="item-title"><a href="<?php echo esc_url(get_the_permalink(get_the_id()));?>"><?php the_title();?></a></h6>
                <?php 
                    
                        /**
                         * woocommerce_after_shop_loop_item_title hook.
                         *
                         * @hooked woocommerce_template_loop_rating - 5
                         * @hooked woocommerce_template_loop_price - 10
                         */
                        do_action( 'woocommerce_after_shop_loop_item_title' );
                 ?>
                <div class="item-review">
                  <?php woocommerce_template_single_rating();?>
                </div>
                <h4 class="item-price"><?php woocommerce_template_loop_price();?></h4>
              </div>
            </div>
	<?php /**
	 * woocommerce_after_shop_loop_item hook.
	 *
	 * @hooked woocommerce_template_loop_product_link_close - 5
	 * @hooked woocommerce_template_loop_add_to_cart - 10
	 */
	
	?>
	</div>
</div>
