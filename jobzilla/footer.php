<?php 
	$jobzilla_option = getDZThemeReduxOption();
	$job_alert_subcrible = !empty($jobzilla_option['job_alert_subcrible']) ? $jobzilla_option['job_alert_subcrible'] : '';
	$job_alert_title = !empty($jobzilla_option['job_alert_title']) ? $jobzilla_option['job_alert_title'] : '';
	$subscription_interval = !empty($jobzilla_option['subscription_interval']) ? $jobzilla_option['subscription_interval'] : '';
	$close_interval = !empty($jobzilla_option['close_interval']) ? $jobzilla_option['close_interval'] : '';
	$job_alert_content = !empty($jobzilla_option['job_alert_content']) ? $jobzilla_option['job_alert_content'] : '';
	$job_alert_btn_text = !empty($jobzilla_option['job_alert_btn_text']) ? $jobzilla_option['job_alert_btn_text'] : '';
	$website_status = !empty($jobzilla_option['website_status']) ? $jobzilla_option['website_status'] : '';
	$footer_on = !empty($jobzilla_option['footer_on']) ? $jobzilla_option['footer_on'] : '';
	$footer_style = !empty($jobzilla_option['footer_style']) ? $jobzilla_option['footer_style'] : '';
	
	if(!empty($job_alert_subcrible)){
?>
	<div class="subscription-alert-bx " id="JobAlert" data-subscription_interval="<?php echo esc_attr($subscription_interval); ?>" data-close_interval="<?php echo esc_attr($close_interval); ?>" >
		<a href="javascript:void(0);" class="close"><i class="fas fa-times"></i></a>
		<?php if(!empty($job_alert_title)){ ?>
		<div class="top-head">
			<span><i class="fa fa-bell" aria-hidden="true"></i></span>
			<h4 class="mb-0"><?php echo esc_html($job_alert_title) ?></h4>
		</div>
		<?php } ?>
		<div class="content">
			<?php if(!empty($job_alert_content)){ ?>
			<p><?php echo esc_html($job_alert_content); ?></p>
			<?php }
			if(!empty($job_alert_btn_text)){ 
			?>
			<div class="twm-nav-btn-left">
				<a class="twm-nav-sign-up site-button light" data-bs-toggle="modal" href="#job_alert" role="button">
					<?php echo esc_html($job_alert_btn_text); ?>
				</a>
			</div>
			<?php } ?>
		</div>		
	</div> 
	<?php	
	}
		if(isWebsiteReadyForVisitor($website_status)){
			if($footer_on) {
				
				if($footer_style == 'footer_template_1') {
					get_template_part('dz-inc/elements/footer/footer_1');
				}else if($footer_style == 'footer_template_2') {
					get_template_part('dz-inc/elements/footer/footer_2');
				}else if($footer_style == 'footer_template_3') {
					get_template_part('dz-inc/elements/footer/footer_3');
				}else if($footer_style == 'footer_template_4') {
					get_template_part('dz-inc/elements/footer/footer_4');
				}
			}
		}
	?>
		
		<button class="scroltop fa fa-arrow-up" ></button>
	</div>
	
	<!-- page-wraper End -->
	<?php 
	
	do_action('jobzilla_wp_user_registration_popup');
	wp_footer(); 
	
	?>
	</body>
</html>