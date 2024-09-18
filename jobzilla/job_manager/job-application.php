<?php
/**
 * Show job application when viewing a single job listing.
 *
 * This template can be overridden by copying it to yourtheme/job_manager/job-application.php.
 *
 * @see         https://wpjobmanager.com/document/template-overrides/
 * @author      Automattic
 * @package     wp-job-manager
 * @category    Template
 * @version     1.31.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<?php if ( $apply = get_the_job_application_method() ) :
	wp_enqueue_script( 'wp-job-manager-job-application' );
	?>
	<div class="twm-job-self-bottom">
		<a href="#application" data-bs-toggle="modal" class="site-button application_button button">
			<?php echo esc_html__( 'Apply for job', 'jobzilla' ); ?>
		</a>
	</div>
	<div class="job_application application">
		<?php do_action( 'job_application_start', $apply ); ?>
		<div class="modal fade twm-sign-up"  id="application" aria-hidden="true" aria-labelledby="application" tabindex="-1">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
				
					<div class="modal-header">
						 <h2 class="modal-title">
							<?php echo esc_html__('Apply for job', 'jobzilla'); ?>
						 </h2>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					
					</div>
					<div class="modal-body">
						<div class="twm-tabs-style-2">
							<?php
							
								/**
								 * job_manager_application_details_email or job_manager_application_details_url hook
								 */
								do_action( 'job_manager_application_details_' . $apply->type, $apply );
							?>
						</div>
					</div>
					
				</div>
			</div>
		</div>
		<?php do_action( 'job_application_end', $apply ); ?>
	</div>
<?php endif; ?>
