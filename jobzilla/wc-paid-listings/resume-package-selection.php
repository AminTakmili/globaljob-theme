<?php
/**
 * Template for choosing a package during the Resume submission.
 *
 * This template can be overridden by copying it to yourtheme/wc-paid-listings/resume-package-selection.php.
 *
 * @see         https://wpjobmanager.com/document/template-overrides/
 * @author      Automattic
 * @package     wp-job-manager-resumes
 * @category    Template
 * @since       1.0.0
 * @version     2.7.3
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( $packages ){
	$checked = 1;
	$color = array(1 =>'pricing-table-1',2=> 'pricing-table-1 circle-yellow',3 => 'pricing-table-1 circle-pink');
$count = 1;
	?>
	
<div class="twm-tabs-style-1">		
	<div class="tab-content" id="myTab3Content">
		<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="Monthly">
			<div class="pricing-block-outer">
				<div class="row justify-content-center">		
					<?php if ( $packages ) { ?>
			
						<?php foreach ( $packages as $key => $package ) {
							if($count == 4){
								$count = 1;
							}
							$product = wc_get_product( $package );
							if ( ! $product->is_type( array( 'resume_package', 'resume_package_subscription' ) ) ) {
								continue;
							}
							
							/* @var $product WC_Product_Resume_Package|WC_Product_Resume_Package_Subscription */
							if ( $product->is_type( 'variation' ) ) {
								$post = get_post( $product->get_parent_id() );
							} else {
								$post = get_post( $product->get_id() );
							}
							$class_product = $product->is_resume_featured() ? 'job-package-featured' : '';
							?>
								<div class="col-lg-4 col-md-6 m-b30 <?php echo esc_attr($class_product); ?>">
									<div class="<?php echo esc_html($color[$count]); ?>">
										<?php if($product->is_featured()){ ?>
											<div class="p-table-recommended">
												<?php echo esc_html__('Recommended', 'jobzilla'); ?>
											</div>
										<?php } ?>
										<div class="p-table-title">
											<input type="radio" <?php checked( $checked, 1 ); ?> name="resume_package" value="<?php echo esc_html($product->get_id()); ?>" id="package-<?php echo esc_html($product->get_id()); ?>" />
											<h4 class="wt-title">
											<label for="package-<?php echo esc_html($product->get_id()); ?>"><?php echo esc_html($product->get_title()); ?></label></h4>
										</div>
										<br/>
										<div class="p-table-inner">
											<div class="p-table-price">
											<?php echo wp_kses($product->get_price_html(), jobzilla_allowed_html_tag()); ?>
																						
											</div>
											<div class="p-table-list">
												
												<?php
												if ( ! empty( $post->post_excerpt ) ) {
													echo apply_filters( 'woocommerce_short_description', $post->post_excerpt );
												} else {
													printf( _n( '%1$s to post %2$d resume', '%1$s to post %2$s resumes', $product->get_limit(), 'jobzilla' ) . ' ', $product->get_price_html(), $product->get_limit() ? $product->get_limit() : __( 'unlimited', 'jobzilla' ) );

													if ( $product->get_duration() ) {
														printf( ' ' . _n( 'listed for %s day', 'listed for %s days', $product->get_duration(), 'jobzilla' ), $product->get_duration() );
													}
												}
												$checked = 0;
												?>

											</div>
										</div>
									</div>
								</div>
						<?php $count++; 
						} 
					} ?>
				</div>
			</div>
		</div>		
	</div>
</div>
		
<?php }else{ ?>

	<p><?php _e( 'No packages found', 'jobzilla' ); ?></p>

<?php } ?>
