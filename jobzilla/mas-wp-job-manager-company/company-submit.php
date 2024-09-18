<?php
/**
 * Template to show when submitting a company.
 *
 * This template can be overridden by copying it to yourtheme/wp-job-manager-company/company-submit.php.
 *
 * @author      MadrasThemes
 * @package     MAS Companies For WP Job Manager
 * @category    Template
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
wp_enqueue_script( 'mas-wp-job-manager-company-submission' );
?>
<div class="panel panel-default">
	<div class="panel-heading wt-panel-heading ">
		<h5 class="panel-tittle m-a0"><i class="fa fa-suitcase"></i><?php echo esc_html__('Company Form', 'jobzilla'); ?></h5>
	</div>
	<div class="panel-body wt-panel-body ">
		<form action="<?php echo esc_url( $action ); ?>" method="post" id="submit-company-form" class="company-manager-form" enctype="multipart/form-data">
			 <div class="row">
				<?php do_action( 'submit_company_form_start' ); ?>

				<?php if ( mas_wpjmc_company_manager_user_can_post_company() ) : ?>

					<!-- Company Fields -->
					<?php do_action( 'submit_company_form_company_fields_start' ); ?>

					<?php foreach ( $company_fields as $key => $field ) : ?>
					<?php
					
						if($key == 'company_logo' || $key == 'company_office_gallery'){ 
							$field_column_class = 'col-xl-12 col-lg-12';
						}else if($key == 'company_excerpt' ){ 
							$field_column_class = 'col-xl-12 col-lg-12';
						}else if($key == 'company_content' ){
							$field_column_class = 'col-xl-12 col-lg-12';
						}else{
							$field_column_class = 'col-xl-4 col-lg-6';
						}
					?>
					
						<div class="<?php echo esc_attr($field_column_class); ?>  col-md-12">
							<div class="form-group">
								<label class="label-title" for="<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $field['label'] ) . apply_filters( 'submit_company_form_required_label', $field['required'] ? '' : wp_kses_post( ' <small>' . esc_html__( '(optional)', 'jobzilla' ) . '</small>' ), $field ); ?></label>
								<div class="ls-inputicon-box"> 
									<?php $class->get_field_template( $key, $field ); ?>
								</div>
							</div>
						</div>
					<?php endforeach; ?>

					<?php do_action( 'submit_company_form_company_fields_end' ); ?>

					<p>
						<?php wp_nonce_field( 'submit_form_posted' ); ?>
						<input type="hidden" name="company_manager_form" value="<?php  echo esc_attr( $form ); ?>" />
						<input type="hidden" name="company_id" value="<?php echo esc_attr( $company_id ); ?>" />
						
						<input type="hidden" name="step" value="<?php echo esc_attr( $step ); ?>" />
						
						
							<input type="submit" name="submit_company" class="site-button m-r5 " value="<?php echo esc_attr( $submit_button_text ); ?>" />
						
						
					</p>

				<?php else : ?>

					<?php do_action( 'submit_company_form_disabled' ); ?>

				<?php endif; ?>

				<?php do_action( 'submit_company_form_end' ); ?>
			</div>
		</form>
	</div>
</div>