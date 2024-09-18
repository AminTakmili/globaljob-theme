<?php 
	$login_page_image_url = jobzilla_get_opt('login_page_image_url');
	$forgot_password = jobzilla_get_opt('jobzilla_forgot_password_page');
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
					<div class="loginid">
					</div>
					<div class="twm-log-reg-inner">
						<div class="twm-log-reg-head">
							<div class="twm-log-reg-logo">
								<span class="log-reg-form-title"><?php echo esc_html__('Log In', 'jobzilla');?></span>
							</div>
						</div>
						<div class="twm-tabs-style-2">
							<div class="tab-content" id="myTab2Content">
								<!--Login Candidate Content-->  
								<div class="tab-pane fade show active" id="twm-login-candidate">
									<div class="row">
										<form class="userloginform" data-redirect="1">
											<div class="col-lg-12">
												<div class="form-group mb-3">
												<input name="username" type="text" required="" class="form-control" id="Username" placeholder="<?php echo esc_attr__('Usearname', 'jobzilla');?>">
												</div>
											</div>
											
											<div class="col-lg-12">
												<div class="form-group mb-3">
													<input name="password" id="Password" type="password" required=""   class="form-control" placeholder="<?php echo esc_html__('Password','jobzilla'); ?>">
												</div>
											</div>
											
											<div class="col-lg-12">
												<div class="twm-forgot-wrap">
													<div class="form-group mb-3">
														<div class="form-check">
															<label class="form-check-label rem-forgot"><?php esc_html_e( 'Remember Me', 'jobzilla' ); ?> 
															<input type="checkbox" name="rememberme" class="form-check-input" value="true">
															<a class="site-text-primary" href="<?php echo home_url($forgot_password); ?>" title="<?php esc_attr_e('Forgot Password?','jobzilla'); ?>">
															<?php esc_html_e('Forgot Password?','jobzilla'); ?></a></label>
														</div>
													</div>
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group">
													<button type="submit" class="site-button"><?php echo esc_html__('Log in', 'jobzilla') ;?></button>
												</div>
											</div>
										<div class="col-md-12">
											<div class="social-login"> 
												<span class="or-option"><?php echo esc_html__('Or', 'jobzilla'); ?></span>	
												<?php 	
												if(class_exists('W3SocialLogin')){	
													$dashboard_url = home_url(jobzilla_get_opt('jobzilla_dashboard_page'));	
													$settings = W3SocialLogin::$settings;
													if($settings->get('show_login_form') == 'show'){ 
														echo do_shortcode('[w3_social_login login="1" link="1" unlink="1" redirect="'.$dashboard_url.'" align="center"]');	
													}
												} ?>
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
