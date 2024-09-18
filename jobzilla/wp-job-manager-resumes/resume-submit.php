<?php
/**
 * Template to show when submitting a resume.
 *
 * This template can be overridden by copying it to yourtheme/wp-job-manager-resumes/resume-submit.php.
 *
 * @see         https://wpjobmanager.com/document/template-overrides/
 * @author      Automattic
 * @package     wp-job-manager-resumes
 * @category    Template
 * @version     1.18.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
wp_enqueue_script( 'wp-resume-manager-resume-submission' );
?>
 <div class="panel panel-default">
	<div class="panel-heading wt-panel-heading">
		<h5 class="panel-tittle m-a0"><i class="fa fa-suitcase"></i><?php echo esc_html__('Resume Form', 'jobzilla'); ?></h5>
	</div>
	<div class="panel-body wt-panel-body">
		<form action="<?php echo esc_attr($action); ?>" method="post" id="submit-resume-form" class="job-manager-form" enctype="multipart/form-data">
			 <div class="row">
				<?php do_action( 'submit_resume_form_start' ); ?>

				<?php if ( apply_filters( 'submit_resume_form_show_signin', true ) ) : ?>

					<?php //get_job_manager_template( 'account-signin.php', [ 'class' => $class ], 'jobzilla', RESUME_MANAGER_PLUGIN_DIR . '/templates/' ); ?>

				<?php endif; ?>

				<?php if ( resume_manager_user_can_post_resume() ) : ?>


					<!-- Resume Fields -->
				
					<?php foreach ( $resume_fields as $key => $field ) { 
					
				 	if(!empty($field['add_row']) || !empty($key == 'resume_content') || !empty($key == 'candidate_photo')){
						$field_column_class = 'col-md-12';
					}else{
						$field_column_class = 'col-md-6';
					} 
					
					?>
						
							<div class="<?php echo esc_attr($field_column_class); ?>">
								<div class="form-group">
									<?php if(!empty($field['label'])){ 
										$label = $field['label'] . apply_filters( 'submit_resume_form_required_label', $field['required'] ? '' : ' <small>' . __( '(optional)', 'jobzilla' ) . '</small>', $field );
									?>
								<label for="<?php  echo esc_attr( $key ); ?>"><?php echo wp_kses($label, jobzilla_allowed_html_tag()); ?></label> 
									<?php } ?>
									 <div class="ls-inputicon-box"> 
										<?php $class->get_field_template( $key, $field ); ?>
									</div>
								</div>
							</div>
							
						
					<?php } ?>

					<?php do_action( 'submit_resume_form_resume_fields_end' ); ?>

					<p>
						<input type="hidden" name="resume_manager_form" value="<?php echo esc_attr($form); ?>" />
						<input type="hidden" name="resume_id" value="<?php echo esc_attr( $resume_id ); ?>" />
						<input type="hidden" name="job_id" value="<?php echo esc_attr( $job_id ); ?>" />
						<input type="hidden" name="step" value="<?php echo esc_attr( $step ); ?>" />
						<input type="submit" name="submit_resume" class="site-button" value="<?php echo esc_attr( $submit_button_text ); ?>" />
					</p>

				<?php else : ?>

					<?php do_action( 'submit_resume_form_disabled' ); ?>

				<?php endif; ?>

				<?php do_action( 'submit_resume_form_end' ); ?>
			</div>
		</form>
	</div>
</div>
