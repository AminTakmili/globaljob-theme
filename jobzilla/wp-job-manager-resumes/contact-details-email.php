<?php
/**
 * Content to show when a candidate has selected email as their preferred contact method.
 *
 * This template can be overridden by copying it to yourtheme/wp-job-manager-resumes/contact-details-email.php.
 *
 * @see         https://wpjobmanager.com/document/template-overrides/
 * @author      Automattic
 * @package     wp-job-manager-resumes
 * @category    Template
 * @version     1.4.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<p><?php printf( __( 'To contact this candidate email <a class="job_application_email" href="mailto:%1$s%2$s">%1$s</a>', 'jobzilla' ), $email, '?subject=' . rawurlencode( $subject ) ); ?></p>

<p>
	<?php _e( 'Contact using webmail: ', 'jobzilla' ); ?>

	<a href="https://mail.google.com/mail/?view=cm&fs=1&to=<?php echo esc_attr($email); ?>&su=<?php echo urlencode( $subject ); ?>" target="_blank" class="job_application_email"><?php echo esc_html__('Gmail', 'jobzilla'); ?></a> /

	<a href="http://webmail.aol.com/Mail/ComposeMessage.aspx?to=<?php echo esc_attr($email); ?>&subject=<?php echo urlencode( $subject ); ?>" target="_blank" class="job_application_email"><?php echo esc_html__('AOL', 'jobzilla'); ?></a> /

	<a href="http://compose.mail.yahoo.com/?to=<?php echo esc_attr($email); ?>&subject=<?php echo urlencode( $subject ); ?>" target="_blank" class="job_application_email"><?php echo esc_html__('Yahoo', 'jobzilla'); ?></a> /

	<a href="http://mail.live.com/mail/EditMessageLight.aspx?n=&to=<?php echo esc_attr($email); ?>&subject=<?php echo urlencode( $subject ); ?>" target="_blank" class="job_application_email"><?php echo esc_html__('Outlook', 'jobzilla'); ?></a>
</p>
