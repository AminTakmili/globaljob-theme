<?php
/**
 * xxxx
 *
 * This template can be overridden by copying it to yourtheme/wp-job-manager-applications/past-applications.php.
 *
 * @see         https://wpjobmanager.com/document/template-overrides/
 * @author      Automattic
 * @package     wp-job-manager-applications
 * @category    Template
 * @version     2.1.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$allowed_html_tags = jobzilla_allowed_html_tag();
?>
 <div class="twm-pro-view-chart-wrap">
	<div class="col-lg-12 col-md-12 ">
		<div class="panel panel-default site-bg-white ">
			<div class="panel-heading wt-panel-heading ">
				<h5 class="panel-tittle m-a0"><i class="far fa-file-alt"></i><?php echo esc_html__('Applications Listing', 'jobzilla'); ?></h5>
			</div>
			<div class="panel-body wt-panel-body">
				<div class="twm-D_table  table-responsive">
					<table id="candidate_data_table"  class="job-manager-past-applications table table-bordered">
					    <thead>
							<tr>
								<th><?php _e( 'Job', 'jobzilla' ); ?></th>
								<th><?php _e( 'Date Applied', 'jobzilla' ); ?></th>
								<th><?php _e( 'Status', 'jobzilla' ); ?></th>
								<th><?php _e( 'Application Message', 'jobzilla' ); ?></th>
							</tr>
					    </thead>
						<tbody>
						<?php
						
						foreach ( $applications as $application ) {
							global $wp_post_statuses;

							$application_id = $application->ID;
							$author_img		= $application->post_author;
							$job_id         = wp_get_post_parent_id( $application_id );
							$job            = get_post( $job_id );
							$job_title      = get_post_meta( $application_id, '_job_applied_for', true );
							?>
						   
							<tr>
								 <td>
									 <div class="twm-DT-candidates-list">
										<div class="twm-media">
											<div class="twm-media-pic">
											<img src="<?php echo esc_url( get_avatar_url($author_img, array('size'=>100)) ); ?>" alt="<?php esc_attr_e('image', 'jobzilla');?>">
											</div>
										</div>
										<div class="twm-mid-content">
											<?php if ( $job && $job->post_status == 'publish' ) { ?>
												 <a class="twm-job-title" href="<?php echo esc_url( get_permalink( $job_id ) ); ?>">
													<h4><?php echo esc_html( $job_title ); ?></h4>
												 </a>
												<?php
											} else {
												echo esc_html( $job_title );
											}
											?>
										</div>
									</div>
								 </td>
								  <td>
									<?php echo esc_html( get_the_date( get_option( 'date_format' ), $application_id ) ); ?>
								 </td>
								 <td>
									<?php echo esc_html( $wp_post_statuses[ get_post_status( $application_id ) ]->label ); ?>
								 </td>
								 <td class="application-message">
									<?php echo wp_kses(wpautop(wp_kses_post( $application->post_content ) ), $allowed_html_tags); ?>
								 </td>
							</tr>
						<?php } ?>
						</tbody>
					</table>
					<?php wp_reset_postdata(); ?>
				</div>
			</div>
		</div>			
	</div>
</div>
