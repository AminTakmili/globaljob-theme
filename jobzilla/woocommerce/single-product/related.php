<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.9.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $related_products ) : ?>

	<div class="content-inner">
		<div class="col-md-12">
			<div class="related-product">
				<div class="section-head style-1 text-center">
					<h2 class="title">
						<?php esc_html_e( 'Related Products', 'jobzilla' ); ?>			
					</h2>
				</div>
				<div class="row">
				<?php woocommerce_product_loop_start(); ?>
					<?php foreach ( $related_products as $related_product ) : ?>
		
						<?php
							$post_object = get_post( $related_product->get_id() );
		
							setup_postdata( $GLOBALS['post'] =& $post_object );
		
							wc_get_template_part( 'content', 'product-related' ); ?>
		
					<?php endforeach; ?>
		
				<?php woocommerce_product_loop_end(); ?>
				</div>
			</div>
		</div>
	</div>

<?php endif;

wp_reset_postdata();