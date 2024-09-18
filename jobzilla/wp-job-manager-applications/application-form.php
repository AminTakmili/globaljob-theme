<?php
/**
 * Application form shown on job listing page.
 *
 * This template can be overridden by copying it to yourtheme/wp-job-manager-applications/application-form.php.
 *
 * @see         https://wpjobmanager.com/document/template-overrides/
 * @author      Automattic
 * @package     wp-job-manager-applications
 * @category    Template
 * @version     2.5.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post;
$allowed_html_tags = jobzilla_allowed_html_tag();
$class_col = '';
?>
<form class="job-manager-application-form job-manager-form" method="post" enctype="multipart/form-data" action="<?php echo esc_url( get_permalink() ); ?>">
	 <div class="row">
		<?php do_action( 'job_application_form_fields_start' ); ?>
		<?php foreach ( $application_fields as $key => $field ) : ?>
			
			<?php 
		
			if ( 'output-content' === $field['type'] ) : ?>
				<div class="form-content">
					<h3><?php esc_html( wp_unslash( $field['label'] ) ); ?></h3>
					<?php
					if ( ! empty( $field['description'] ) ) :
						?>
						<?php echo wp_kses(wpautop( wp_kses_post( $field['description'] ) ), $allowed_html_tags ); ?>
					<?php endif; ?>
				</div>
			<?php else : ?>
				<?php 
				if(!empty($key == 'application_message')){
					$class_col = 'col-md-12';
				}else{
					$class_col = 'col-md-6';
				}
			?>	
				<div class="<?php echo esc_attr($class_col); ?>">
					<div class="form-group">
						<label for="<?php echo esc_attr( $key ); ?>"><?php echo wp_unslash( $field['label'] ) . apply_filters( 'submit_job_form_required_label', $field['required'] ? '' : ' <small>' . __( '(optional)', 'jobzilla' ) . '</small>', $field ); ?></label>
						<?php $fields = $field['required'] ? 'required-field' : ''; ?>
						<div class="ls-inputicon-box <?php echo esc_html($fields); ?>">
							<?php $class->get_field_template( $key, $field ); ?>
						</div>
					</div>
				</div>
			<?php endif; ?>
		<?php endforeach; ?>

		<?php do_action( 'job_application_form_fields_end' ); ?>

		<p>
			<input type="submit" class="button site-button wp_job_manager_send_application_button" value="<?php esc_attr_e( 'Send application', 'jobzilla' ); ?>" />
			<input type="hidden" name="wp_job_manager_send_application" value="1" />
			<input type="hidden" name="job_id" value="<?php echo absint( $post->ID ); ?>" />
		</p>
	</div>
</form>
