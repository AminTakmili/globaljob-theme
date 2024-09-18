<?php
/**
 * Apply with Resume content that displays on single job listings.
 *
 * This template can be overridden by copying it to yourtheme/wp-job-manager-resumes/apply-with-resume.php.
 *
 * @see         https://wpjobmanager.com/document/template-overrides/
 * @author      Automattic
 * @package     wp-job-manager-resumes
 * @category    Template
 * @version     1.16.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post;

if ( ! get_option( 'resume_manager_force_application' ) ) {
	echo '<hr />';
}

if ( is_user_logged_in() && count( $resumes ) ) : ?>
	<form class="apply_with_resume" method="post">
		<div class="row">
		<p><?php _e( 'Apply using your online resume; just enter a short message to send your application.', 'jobzilla' ); ?></p>
		<div class="col-md-12">
			<div class="form-group">
			<label for="resume_id"><?php _e( 'Online resume', 'jobzilla' ); ?>:</label>
		  <div class="ls-inputicon-box">  
			<select class="wt-select-box selectpicker" data-live-search="true" data-bv-field="size" name="resume_id" id="resume_id" required>
				<?php
				foreach ( $resumes as $resume ) {
					echo '<option value="' . absint( $resume->ID ) . '">' . esc_html( get_resume_select_label( $resume ) ) . '</option>';
				}
				?>
			</select>
			</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group">
				<label><?php _e( 'Message', 'jobzilla' ); ?>:</label>
				<div class="ls-inputicon-box">
					<textarea name="application_message" class="form-control" cols="40" rows="6" required>
					<?php
					if ( isset( $_POST['application_message'] ) ) {
						echo esc_textarea( stripslashes( $_POST['application_message'] ) );
					} else {
						echo _x( 'To whom it may concern,', 'default cover letter', 'jobzilla' ) . "\n\n";

						printf( _x( 'I am very interested in the %1$s position at %2$s. I believe my skills and work experience make me an ideal candidate for this role. I look forward to speaking with you soon about this position.', 'default cover letter', 'jobzilla' ), $post->post_title, get_post_meta( $post->ID, '_company_name', true ) );

						echo "\n\n" . _x( 'Thank you for your consideration.', 'default cover letter', 'jobzilla' );
					}
					?>
					</textarea>
				</div>
			</div>
		</div>
		<p>
			<input type="submit" class="site-button" name="wp_job_manager_resumes_apply_with_resume" value="<?php esc_attr_e( 'Send Application', 'jobzilla' ); ?>" />
			<input type="hidden" name="job_id" value="<?php echo absint( $post->ID ); ?>" />
		</p>
		</div>
	</form>
<?php else : ?>
	<form class="apply_with_resume" method="post" action="<?php echo get_permalink( get_option( 'resume_manager_submit_resume_form_page_id' ) ); ?>">
		<p><?php _e( 'You can apply to this job and others using your online resume. Click the link below to submit your online resume and email your application to this employer.', 'jobzilla' ); ?></p>

		<p>
			<input type="submit" class="site-button" name="wp_job_manager_resumes_apply_with_resume_create" value="<?php esc_attr_e( 'Submit Resume &amp; Apply', 'jobzilla' ); ?>" />
			<input type="hidden" name="job_id" value="<?php echo absint( $post->ID ); ?>" />
		</p>
	</form>
<?php endif; ?>
