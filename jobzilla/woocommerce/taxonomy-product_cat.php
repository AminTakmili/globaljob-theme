<?php
/**
 * The Template for displaying products in a product category. Simply includes the archive template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/taxonomy-product_cat.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @package 	WooCommerce/Templates
 * @version     4.7.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}


$show_sidebar	= jobzilla_get_opt('woocommerce_page_show_sidebar');
$layout			= jobzilla_get_opt('woocommerce_page_sidebar_layout');
$sidebar		= jobzilla_get_opt('woocommerce_page_sidebar');

$title = jobzilla_get_opt('woocommerce_page_title');

$layout = (!$show_sidebar)?'full':$layout;

if($layout == 'full' || !is_active_sidebar( $sidebar ) )
{
	$classes = 'col-lg-12 col-md-12 col-sm-12 col-12';
}else{
	$classes = 'col-lg-9 col-md-7 col-sm-12 col-12';
}

get_header( 'shop' ); ?>

<!--Start breadcrumb area-->     
<?php jobzilla_get_banner(); ?>
<!--End breadcrumb area-->

<!--Start Shop area-->
<section id="shop-area" class="main-shop-area section-full content-inner bg-white">
    <div class="container">
        <div class="row clearfix">
			
			<!-- sidebar area -->
			<?php if( $layout == 'left' ){ ?>
				<?php if ( is_active_sidebar( $sidebar ) ) { ?>
					<div class="col-xl-3 col-lg-8 col-md-7 col-sm-12">
                        <div class="sidebar-wrapper">
							<?php dynamic_sidebar( $sidebar ); ?>
                            <?php
                                /**
                                 * woocommerce_sidebar hook
                                 *
                                 * @hooked woocommerce_get_sidebar - 10
                                 */
                                do_action( 'woocommerce_sidebar' );
                            ?>
                        </div>
                    </div>
				<?php } ?>
			<?php } ?>

			<!-- sidebar area -->
			
			<div class="<?php echo esc_attr($classes);?> content-side">
            	<div class="row">
					<div class="col-12">
					
						<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) { ?>
							<div class="items-sorting">
								<div class="row clearfix">
									<div class="results-column col-lg-8 col-md-6 col-sm-6 col-xs-12">
										<h4> <?php woocommerce_result_count();?></h4>
									</div>
									<div class="select-column pull-right col-lg-4 col-md-6 col-sm-6 col-xs-12">
										<div class="form-group">
											<?php
												/**
												 * woocommerce_before_shop_loop hook
												 *
												 * @hooked woocommerce_result_count - 20
												 * @hooked woocommerce_catalog_ordering - 30
												 */
												do_action( 'woocommerce_before_shop_loop' );
											?>
										</div>
									</div>
								</div>
							</div>
						<?php } ?>
					</div>
                </div>
					<?php
						/**
						 * woocommerce_before_main_content hook
						 *
						 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
						 * @hooked woocommerce_breadcrumb - 20
						 */
						do_action( 'woocommerce_before_main_content' );
					?>
					
					<?php
						/**
						 * woocommerce_archive_description hook
						 *
						 * @hooked woocommerce_taxonomy_archive_description - 10
						 * @hooked woocommerce_product_archive_description - 10
						 */
						do_action( 'woocommerce_archive_description' );
					?>

					<div class="tab-pane active" id="Grid" role="tabpanel">
								<?php if ( have_posts() ) { ?>
								<div class="row">
									<?php woocommerce_product_loop_start(); ?>
						
										<?php woocommerce_product_subcategories(); ?>
						
										<?php while ( have_posts() ) { the_post(); ?>
						
											<?php wc_get_template_part( 'content', 'product' ); ?>
						
										<?php } // end of the loop. ?>
						
									<?php woocommerce_product_loop_end(); ?>
								</div>
			
						<?php
							/**
							 * woocommerce_after_shop_loop hook
							 *
							 * @hooked woocommerce_pagination - 10
							 */
							do_action( 'woocommerce_after_shop_loop' );
						?>
			
					<?php } else if ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) { ?>
			
						<?php wc_get_template( 'loop/no-products-found.php' ); ?>
			
					<?php } ?>

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
            <?php if( $layout == 'right' ){ ?>
            	<?php if ( is_active_sidebar( $sidebar ) ) { ?>
            		<div class="col-xl-3 col-lg-8 col-md-7 col-sm-12">
                        <div class="sidebar-wrapper">
							<?php dynamic_sidebar( $sidebar ); ?>
                            <?php
                                /**
                                 * woocommerce_sidebar hook
                                 *
                                 * @hooked woocommerce_get_sidebar - 10
                                 */
                                do_action( 'woocommerce_sidebar' );
                            ?>
                        </div>
                    </div>
            	<?php } ?>
            <?php } ?>
    		<!--Sidebar-->
	</div>
</section>
<?php get_footer( 'shop' ); ?>
