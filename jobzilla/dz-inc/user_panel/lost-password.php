<?php 
	$login_page_image_url = jobzilla_get_opt('login_page_image_url');
	$login_page = jobzilla_get_opt('jobzilla_login_page');
	$header_login_on = jobzilla_get_opt('header_login_on');
	$show_login_registration = jobzilla_get_opt('show_login_registration');
	$header_register_on = jobzilla_get_opt('header_register_on');
?>
<!-- Login Section Start -->
<div class="section-full site-bg-white">
	<div class="container-fluid">	
		<div class="row">
			<div class="col-xl-8 col-lg-6 col-md-5 twm-log-reg-media-wrap">
				<div class="twm-log-reg-media">
					<?php if(!empty($login_page_image_url)){ ?>	
					<div class="twm-l-media">
						<img src="<?php echo esc_url($login_page_image_url['url']); ?>" alt="<?php echo esc_attr__('Image', 'jobzilla'); ?>">
					</div>
					<?php } ?>
				</div>
			</div>
			<div class="col-xl-4 col-lg-6 col-md-7 page-loader">
				<div class="twm-log-reg-form-wrap">
					<div class="twm-log-reg-logo-head">
						<?php do_action( 'jobzilla_get_logo','site_logo', 'logo'); ?>
					</div>
					<div class="twm-log-reg-inner">
						<div class="twm-log-reg-head">
							<div class="twm-log-reg-logo">
								<span class="log-reg-form-title">
									<?php echo esc_html__('Reset Password', 'jobzilla');?>
								</span>
							</div>
						</div>
						<div id="fesetmsg"></div>
						<div class="twm-tabs-style-2">
							<div class="tab-content" id="myTab2Content">
								<!--Login Candidate Content-->  
								<div class="tab-pane fade show active" id="twm-login-candidate">
									<div class="row">
										<form id="ResetPassword">
											<div class="col-lg-12">
												<div class="form-group mb-3">
												<input name="email" type="text" required="" class="form-control" placeholder="<?php echo esc_attr__('Email', 'jobzilla');?>">
												</div>
											</div>
											<div class="col-lg-12">
												<div class="twm-forgot-wrap">
													<div class="form-group mb-3">
														<a class="site-text-primary" href="<?php echo  home_url($login_page); ?>" title="<?php esc_attr_e('Back To Login','jobzilla'); ?>">
														<?php esc_html_e('Back To Login','jobzilla'); ?></a>
													</div>
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group">
													<button type="submit" class="site-button"><?php echo esc_html__('Reset Password', 'jobzilla') ;?></button>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>   
<!-- Login Section End -->
