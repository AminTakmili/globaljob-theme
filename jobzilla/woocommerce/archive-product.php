<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.6.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$show_sidebar	= jobzilla_dzbase()->get_meta('page_show_sidebar', get_option( 'woocommerce_shop_page_id' ));
$layout			= jobzilla_dzbase()->get_meta('page_sidebar_layout', get_option( 'woocommerce_shop_page_id' ));
$sidebar		= jobzilla_dzbase()->get_meta('page_sidebar', get_option( 'woocommerce_shop_page_id' ));

$title = jobzilla_get_opt('woocommerce_page_title');

$layout = (!$show_sidebar)?'full':$layout;

if(isset($_GET['layout'])){
	$layout = sanitize_text_field($_GET['layout']);
}

if($layout == 'full' || !is_active_sidebar( $sidebar ) )
{
	$classes = 'col-lg-12 col-md-12 col-sm-12 col-12';
}else{
	$classes = 'col-lg-8 col-md-12 col-sm-12 col-12';
}

get_header( 'shop' );
 ?>
 <!--Start breadcrumb area-->     
<?php jobzilla_get_banner(); ?>
<!--End breadcrumb area-->
<!--Start Shop area-->
<div class="section-full content-inner bg-white">
    <div class="container">
        <div class="row">
            <!-- sidebar area -->
            <?php if( $layout == 'left' ){ ?>
                <?php if ( is_active_sidebar( $sidebar ) ) { ?>
                    <div class="col-lg-4 col-md-12 col-sm-12 sticky-top filter-bar dz-order-1">
                        <div class="side-bar sticky-top">
                            <?php dynamic_sidebar( $sidebar ); ?>
                            <?php do_action( 'woocommerce_sidebar' );?>
                        </div>
                    </div>
                <?php } ?>
            <?php } ?>
            <!-- sidebar area -->
            
            <div class="<?php echo esc_attr($classes);?>">
                <div class="row">
                    <div class="col-12">
                        <div class="row sort-space">
                            
                            <?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
                            <div class="col-lg-4 col-md-5 col-sm-6 col-7">
                                <?php do_action( 'woocommerce_before_shop_loop' );?>
                            </div>
                            <?php endif;?>
                            
                        </div>
                    </div>
                    
                    <div class="col-12 tab-content">
                        <?php do_action( 'woocommerce_before_main_content' );?>
                        <?php do_action( 'woocommerce_archive_description' );?>
                        
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
							
							} else if ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) { ?>
							
							<?php wc_get_template( 'loop/no-products-found.php' ); ?>
							
					
							<?php } ?>
                        </div>
                        
                        <div class="tab-pane fade" id="List" role="tabpanel">
                             <?php if ( have_posts() ) { ?>
                              <div class="row m-0">
                                <?php woocommerce_product_loop_start(); ?>
                            
                                  <?php woocommerce_product_subcategories(); ?>
                          
                                  <?php while ( have_posts() ) { the_post(); ?>
                          
                                    <?php wc_get_template_part( 'list', 'product' ); ?>
                          
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
								<div class="row m-0">
									<?php wc_get_template( 'loop/no-products-found.php' ); ?>
								</div>
					
							<?php } ?>
							
                        </div>
                        
                        <?php do_action( 'woocommerce_after_main_content' );?>
                    </div>
                    
                </div><!--End of Row-->
            </div>
            
            <!-- sidebar area -->
            <?php if( $layout == 'right' ){ ?>
                <?php if ( is_active_sidebar( $sidebar ) ) { ?>
                    <div class="col-lg-4 col-md-12 col-sm-12 sticky-top filter-bar dz-order-1">
                        <div class="side-bar shop-sidebar p-l20 m-b30 sticky-top">
                            <?php dynamic_sidebar( $sidebar ); ?>
                            <?php do_action( 'woocommerce_sidebar' );?>
                        </div>
                    </div>
                <?php } ?>
            <?php } ?>
            <!--Sidebar-->
            
        </div> <!--End of Row-->
            
	</div>
</div>
<?php get_footer( 'shop' ); ?>

