<?php
/**
 * My Packages page template.
 *
 * This template can be overridden by copying it to yourtheme/wc-paid-listings/my-packages.php.
 *
 * @see         https://wpjobmanager.com/document/template-overrides/
 * @author      Automattic
 * @package     wp-job-manager-resumes
 * @category    Template
 * @since       1.0.0
 * @version     2.5.6
 */

 if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
 
?>

<h4><?php
if ( 'job_listing' === $type ) {
	echo apply_filters( 'woocommerce_my_account_wc_paid_listings_packages_title', __( 'My Job Packages', 'jobzilla' ), $type );
} else {
	echo apply_filters( 'woocommerce_my_account_wc_paid_listings_packages_title', __( 'My Resume Packages', 'jobzilla' ), $type );
}
?></h4>

<table class="shop_table my_account_job_packages my_account_wc_paid_listing_packages">
	<thead>
		<tr>
			<th scope="col"><?php _e( 'Package Name', 'jobzilla' ); ?></th>
			<th scope="col"><?php _e( 'Remaining', 'jobzilla' ); ?></th>
			<?php if ( 'job_listing' === $type ) : ?>
				<th scope="col"><?php _e( 'Listing Duration', 'jobzilla' ); ?></th>
			<?php endif; ?>
			<th scope="col"><?php _e( 'Featured?', 'jobzilla' ); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ( $packages as $package ) :
				
			$package = wc_paid_listings_get_package( $package );
			?>
			<tr>
				<td><?php echo esc_html($package->get_title()); ?></td>
				<td>
					<?php if($package->get_limit()){
						echo absint( $package->get_limit() - $package->get_count() );
					}else{
						echo esc_html__( 'Unlimited', 'jobzilla' );
					}
					?>
				</td>
				<?php if ( 'job_listing' === $type ) : ?>
					<td><?php if($package->get_duration()){ 
							echo sprintf( _n( '%d day', '%d days', $package->get_duration(), 'jobzilla' ), $package->get_duration() );
					}else{
						echo esc_html__('-', 'jobzilla'); 
					} ?>
					</td>
				<?php endif; ?>
				<td>
					<?php if($package->is_featured()){
						echo esc_html__( 'Yes', 'jobzilla' );
					}else{
					echo esc_html__( 'No', 'jobzilla' );
					} ?>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
