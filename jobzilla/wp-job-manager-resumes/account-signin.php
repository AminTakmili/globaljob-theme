<?php
/**
 * Account sign-in template to display above submit resume form.
 *
 * This template can be overridden by copying it to yourtheme/wp-job-manager-resumes/account-signin.php.
 *
 * @see         https://wpjobmanager.com/document/template-overrides/
 * @author      Automattic
 * @package     wp-job-manager-resumes
 * @category    Template
 * @version     1.15.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( is_user_logged_in() ) : ?>

	<fieldset>
		<label><?php _e( 'Your account', 'jobzilla' ); ?></label>
		<div class="field account-sign-in">
			<?php
				$user = wp_get_current_user();
				printf( __( 'You are currently signed in as <strong>%s</strong>.', 'jobzilla' ), $user->user_login );
			?>

			<a class="button" href="<?php echo apply_filters( 'submit_resume_form_logout_url', wp_logout_url( get_permalink() ) ); ?>"><?php _e( 'Sign out', 'jobzilla' ); ?></a>
		</div>
	</fieldset>

	<?php
else :

	$account_required     = resume_manager_user_requires_account();
	$registration_enabled = resume_manager_enable_registration();
	$registration_fields  = resume_manager_get_registration_fields();
	
	?>
	<fieldset>
		<label><?php echo esc_html__( 'Have an account?', 'jobzilla' ); ?></label>
		<div class="field account-sign-in">
			<a class="button" href="<?php echo apply_filters( 'submit_resume_form_login_url', wp_login_url( add_query_arg( [ 'job_id' => $class->get_job_id() ], get_permalink() ) ) ); ?>"><?php _e( 'Sign in', 'jobzilla' ); ?></a>

			<?php if ( $registration_enabled ) : ?>

				<?php _e( 'If you don&rsquo;t have an account you can create one below by entering your email address. Your account details will be confirmed via email.', 'jobzilla' ); ?>

			<?php elseif ( $account_required ) : ?>

				<?php echo apply_filters( 'submit_resume_form_login_required_message', __( 'You must sign in to submit a resume.', 'jobzilla' ) ); ?>

			<?php endif; ?>
		</div>
	</fieldset>
	<?php
	if ( ! empty( $registration_fields ) ) {
		foreach ( $registration_fields as $key => $field ) {
				$required = $field['required'] ? 'required-field' : '';
				$label = $field['label']  . wp_kses_post( apply_filters( 'submit_resume_form_required_label', $field['required'] ? '' : ' <small>' . __( '(optional)', 'jobzilla' ) . '</small>', $field ) );
			?>
			<fieldset class="fieldset-<?php echo esc_attr( $key ); ?>">
				<label
					for="<?php echo esc_attr( $key ); ?>"><?php echo esc_html($label); ?></label>
				<div class="field <?php echo esc_attr($required); ?>">
					<?php
					get_job_manager_template(
						'form-fields/' . $field['type'] . '-field.php',
						[
							'key'   => $key,
							'field' => $field,
						]
					);
					?>
				</div>
			</fieldset>
			<?php
		}
		do_action( 'resume_manager_register_form' );
	}
	?>

<?php endif; ?>
