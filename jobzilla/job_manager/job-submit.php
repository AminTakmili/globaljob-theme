<?php
/**
 * Content for job submission (`[submit_job_form]`) shortcode.
 *
 * This template can be overridden by copying it to yourtheme/job_manager/job-submit.php.
 *
 * @see         https://wpjobmanager.com/document/template-overrides/
 * @author      Automattic
 * @package     wp-job-manager
 * @category    Template
 * @version     1.34.3
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

global $job_manager;
?>
 <div class="panel panel-default">
	 <div class="panel-heading wt-panel-heading ">
		<h5 class="panel-tittle m-a0"><i class="fa fa-suitcase"></i><?php echo esc_html__('Job Form', 'jobzilla'); ?></h5>
	</div>
	 <div class="panel-body wt-panel-body">
		<form action="<?php echo esc_url( $action ); ?>" method="post" id="submit-job-form" class="job-manager-form" enctype="multipart/form-data">
			<div class="row">
			<?php
			if ( isset( $resume_edit ) && $resume_edit ) {
				printf( '<p><strong>' . esc_html__( "You are editing an existing job. %s", 'jobzilla' ) . '</strong></p>', '<a href="?job_manager_form=submit-job&new=1&key=' . esc_attr( $resume_edit ) . '">' . esc_html__( 'Create A New Job', 'jobzilla' ) . '</a>' );
			}
			?>

				<?php do_action( 'submit_job_form_start' ); ?>

				<!-- Company Information Fields -->
				<?php if ( $company_fields ) { ?>
					<h3 class="dz-title"><?php esc_html_e( 'Company Details', 'jobzilla' ); ?></h3>
					
					<?php do_action( 'submit_job_form_company_fields_start' ); ?>
					<?php foreach ( $company_fields as $key => $field ){ 
					 $class = !empty($key == 'company_logo') ? 'col-xl-12 col-lg-12' : 'col-xl-4 col-lg-6'; ?>
						<div class=" <?php echo esc_attr($class); ?> col-md-12">
							<div class="form-group">
							<label class="label-title" for="<?php echo esc_attr( $key ); ?>"><?php echo wp_kses_post( $field['label'] ) . wp_kses_post( apply_filters( 'submit_job_form_required_label', $field['required'] ? '' : ' <small>' . __( '(optional)', 'jobzilla' ) . '</small>', $field ) ); ?></label>
							 <div class="ls-inputicon-box"> 
								<?php get_job_manager_template( 'form-fields/' . $field['type'] . '-field.php', [ 'key' => $key, 'field' => $field ] ); ?>
							</div>
							</div>
						</div>
					<?php } ?>
					
					<?php do_action( 'submit_job_form_company_fields_end' ); ?>
				<?php } ?>
					<?php if ( job_manager_user_can_post_job() || job_manager_user_can_edit_job( $job_id ) ) : ?>

				<!-- Job Information Fields -->
				<?php do_action( 'submit_job_form_job_fields_start' ); ?>
				  
				<?php 
					
				foreach ( $job_fields as $key => $field ){ 
					 $class = $key == 'job_description' ? 'col-xl-12 col-lg-12' : 'col-xl-4 col-lg-6'; ?>
				
					<div class="<?php echo esc_attr($class); ?> col-md-12">
						<div class="form-group">
						<label for="<?php echo esc_attr( $key ); ?>"><?php echo wp_kses_post( $field['label'] ) . wp_kses_post( apply_filters( 'submit_job_form_required_label', $field['required'] ? '' : ' <small>' . __( '(optional)', 'jobzilla' ) . '</small>', $field ) ); ?></label>
						 <div class="ls-inputicon-box"> 
							
							<?php 
							get_job_manager_template( 'form-fields/' . $field['type'] . '-field.php', [ 'key' => $key, 'field' => $field ] ); 
							 
							?>
							
						</div>
					</div>
					</div>
				<?php } ?>
					
				<?php do_action( 'submit_job_form_job_fields_end' ); ?>


				<?php do_action( 'submit_job_form_end' ); ?>

				<p>
					<input type="hidden" name="job_manager_form" value="<?php echo esc_attr( $form ); ?>" />
					<input type="hidden" name="job_id" value="<?php echo esc_attr( $job_id ); ?>" />
					<input type="hidden" name="step" value="<?php echo esc_attr( $step ); ?>" />
					 <div class="col-lg-12 col-md-12">                                   
						<div class="text-left">                
							<input type="submit" name="submit_job" class="site-button m-r5" value="<?php echo esc_attr( $submit_button_text ); ?>" />
							
						</div>
					</div>
					<span class="spinner" style="background-image: url(<?php echo esc_url( includes_url( 'images/spinner.gif' ) ); ?>);"></span>
				</p>

			<?php else : ?>

				<?php do_action( 'submit_job_form_disabled' ); ?>

			<?php endif; ?>
			</div>
		</form>
	</div>
</div>