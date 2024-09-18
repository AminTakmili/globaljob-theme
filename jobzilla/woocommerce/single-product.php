<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$title = '';
$layout = 'full';
$sidebar = 'dz_shop_sidebar';
$classes = 'col-lg-12 col-md-12 col-sm-12 col-xs-12';
get_header( 'shop' ); 

?>
 <!--Start breadcrumb area-->     
<?php jobzilla_get_banner(); ?>
<!--End breadcrumb area-->

<!--Start shop area-->
<div class="section-full content-inner bg-white p-b0">
    <div class="container">
		<div class="row clearfix">
            <!-- sidebar area -->
			<?php if( $layout == 'left' ): ?>
				<?php if ( is_active_sidebar( $sidebar ) ) { ?>
					<div class="col-lg-3 col-md-4 col-sm-12 sticky-top filter-bar">
                        <div class="side-bar">
                            <?php dynamic_sidebar( $sidebar ); ?>
                            <?php do_action( 'woocommerce_sidebar' );?>
                        </div>
                    </div>
				<?php } ?>
			<?php endif; ?>
			
            <div class="<?php echo esc_attr($classes);?>">
            	
                <div class="shop-page product-details">
                	<?php
						/**
						 * woocommerce_before_main_content hook
						 *
						 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
						 * @hooked woocommerce_breadcrumb - 20
						 */
						do_action( 'woocommerce_before_main_content' );
					?>
						<?php while ( have_posts() ) : the_post(); ?>
							<?php wc_get_template_part( 'content', 'single-product' ); ?>
						<?php endwhile; // end of the loop. ?>
					<?php
						/**
						 * woocommerce_after_main_content hook
						 *
						 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
						 */
						do_action( 'woocommerce_after_main_content' );
					?>
                </div>
                
            </div>
		
        	<!-- sidebar area -->
			<?php if( $layout == 'right' ): ?>
				<?php if ( is_active_sidebar( $sidebar ) ) { ?>
					<div class="col-lg-4 col-md-5 col-sm-12 col-12">
                        <div class="side-bar shop-sidebar p-l20 m-b30 sticky-top">
                            <?php dynamic_sidebar( $sidebar ); ?>
                            <?php do_action( 'woocommerce_sidebar' );?>
                        </div>
                    </div>
				<?php } ?>
			<?php endif; ?>
    	</div>
    </div>
</div>
<?php get_footer( 'shop' ); ?>
