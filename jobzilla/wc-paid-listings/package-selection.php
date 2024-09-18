<?php
/**
 * Template for choosing a package during the Job Listing submission.
 *
 * This template can be overridden by copying it to yourtheme/wc-paid-listings/package-selection.php.
 *
 * @see         https://wpjobmanager.com/document/template-overrides/
 * @author      Automattic
 * @package     wp-job-manager-resumes
 * @category    Template
 * @since       1.0.0
 * @version     2.9.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( $packages ) {
	$checked = 1;
	
$count = 1;
$color = array(1 =>'pricing-table-1',2=> 'pricing-table-1 circle-yellow',3 => 'pricing-table-1 circle-pink');
	
	?>

<div class="twm-tabs-style-1">		
	<div class="tab-content" id="myTab3Content">
		<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="Monthly">
			<div class="pricing-block-outer">
				<div class="row justify-content-center">
					<?php
					if ( $packages ){ ?>
						<?php 
						 foreach ( $packages as $key => $package ){
							if($count == 4){
								$count = 1;
							}
							$product = wc_get_product( $package );
							if ( ! $product->is_type( array( 'job_package', 'job_package_subscription' ) ) || ! $product->is_purchasable() ) {
								continue;
							}
							/* @var $product WC_Product_Job_Package|WC_Product_Job_Package_Subscription */
							if ( $product->is_type( 'variation' ) ) {
								$post = get_post( $product->get_parent_id() );
							} else {
								$post = get_post( $product->get_id() );
							}
							?>
							<div class="col-lg-4 col-md-6 m-b30">
								<div class="<?php echo esc_attr($color[$count]); ?>">
									<?php if($product->is_featured()){ ?>
										<div class="p-table-recommended">
											<?php echo esc_html__('Recommended', 'jobzilla'); ?>
										</div>
									<?php } ?>
									<div class="p-table-title">
										<input type="radio" <?php checked( $checked, 1 );
										$checked = 0; ?> name="job_package" value="<?php echo esc_html($product->get_id()); ?>" id="package-<?php echo esc_html($product->get_id()); ?>" />
										<h4 class="wt-title">
										<label for="package-<?php echo esc_html($product->get_id()); ?>"><?php echo esc_html($product->get_title()); ?></label></h4>
									</div>
									<div class="p-table-inner">
										<div class="p-table-price">
											<?php echo wp_kses($product->get_price_html(), jobzilla_allowed_html_tag()); ?>
																					
										</div>
										<div class="p-table-list">
											<?php if ( ! empty( $post->post_excerpt ) ) : ?>
												<?php echo apply_filters( 'woocommerce_short_description', $post->post_excerpt ) ?>
											<?php else :
												$limit_marking = $product->get_limit() ? $product->get_limit() : __( 'unlimited', 'jobzilla' );
												$featured_marking = $product->is_job_listing_featured() ? __( 'featured', 'jobzilla' ) : '';
												// translators: 1: Price. 2: Limit marking (days number or unlimited). 3: Featured marking.
												$product_description = _n( '%1$s for %2$s %3$s job', '%1$s for %2$s %3$s jobs', $product->get_limit(), 'jobzilla' );
												printf( $product_description . ' ', $product->get_price_html(), $limit_marking, $featured_marking );

												if($product->get_duration()) {
													echo sprintf( _n( 'listed for %s day', 'listed for %s days', $product->get_duration(), 'jobzilla' ), $product->get_duration() );
												}
											endif; ?>
										</div>
									</div>
								</div>
							</div>
						<?php $count++; 
						 } ?>
					<?php								
					} ?>
				</div>	
			</div>
		</div>
	</div>
</div>		
				
<?php }else{ ?>

	<p><?php _e( 'No packages found', 'jobzilla' ); ?></p>

<?php } ?>
