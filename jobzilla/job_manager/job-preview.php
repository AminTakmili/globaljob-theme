<?php
/**
 * Job listing preview when submitting job listings.
 *
 * This template can be overridden by copying it to yourtheme/job_manager/job-preview.php.
 *
 * @see         https://wpjobmanager.com/document/template-overrides/
 * @author      Automattic
 * @package     wp-job-manager
 * @category    Template
 * @version     1.32.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<form method="post" id="job_preview" action="<?php echo esc_url( $form->get_action() ); ?>">
	<?php
	/**
	 * Fires at the top of the preview job form.
	 *
	 * @since 1.32.2
	 */
	do_action( 'preview_job_form_start' );
	?>
	
	<div class="preview panel panel-default">
			<div class="panel-heading wt-panel-heading modal-footer  justify-content-between">
					<h5><?php esc_html_e( 'Preview', 'jobzilla' ); ?></h5>
				<div>	
					<input type="submit" name="edit_job" class="site-button outline-primary my-1" value="<?php esc_attr_e( 'Edit', 'jobzilla' ); ?>" />
					<input type="submit" name="continue" id="job_preview_submit_button site-button" class="site-button my-1" value="<?php esc_attr_e( 'Submit', 'jobzilla' ); ?>" />
				</div>
			</div>


		<?php get_job_manager_template_part( 'content-single', 'job_listing' ); ?>

		<input type="hidden" name="job_id" value="<?php echo esc_attr( $form->get_job_id() ); ?>" />
		<input type="hidden" name="step" value="<?php echo esc_attr( $form->get_step() ); ?>" />
		<input type="hidden" name="job_manager_form" value="<?php echo esc_attr( $form->get_form_name() ); ?>" />
	</div>
	<?php
	/**
	 * Fires at the bottom of the preview job form.
	 *
	 * @since 1.32.2
	 */
	do_action( 'preview_job_form_end' );
	?>
</form>
