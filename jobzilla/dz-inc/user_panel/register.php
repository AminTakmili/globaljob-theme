<?php	
	$register_page_image_url = jobzilla_get_opt('register_page_image_url');
	$login_page = jobzilla_get_opt('jobzilla_login_page');
	$terms_conditions = jobzilla_get_opt('jobzilla_job_terms_conditions_page');
?>

<!-- Register Section Start -->
<div class="section-full site-bg-white">
	
	<div class="container-fluid">
		<div class="row">
			<div class="col-xl-8 col-lg-6 col-md-5 twm-log-reg-media-wrap">
				<div class="twm-log-reg-media">
				<?php if(!empty($register_page_image_url)){ ?>
					<div class="twm-l-media">
						<img src="<?php echo esc_url($register_page_image_url['url']); ?>" alt="<?php echo esc_attr__('image', 'jobzilla'); ?>">
					</div>
				<?php } ?>
				</div>
			</div>
			<div class="col-xl-4 col-lg-6 col-md-7 page-loader">
				<div class="twm-log-reg-form-wrap">
					<div class="twm-log-reg-logo-head">
					   <?php do_action( 'jobzilla_get_logo','site_logo', 'logo'); ?>
					</div>
					<div id="registerid"></div>
					<div class="twm-log-reg-inner">
						<div class="twm-log-reg-head">
							<div class="twm-log-reg-logo">
								<span class="log-reg-form-title">
									<?php echo esc_html__('Register', 'jobzilla'); ?>
								</span>
							</div>
						</div>
						<div class="twm-tabs-style-2">
							<form id="UserRegisterForm" action="" method="post" data-redirect="1">
								<div class="nav nav-tabs align-items-center signup-candidate" id="myTab" role="tablist">
								<!--Signup Candidate-->  
								<div class="nav-item" role="presentation">
									<input type="radio" id="vehicle1" checked="checked" name="user_role" class="form-check-input me-3 mt-2 " value="candidate">
									<label class="nav-link" for="vehicle1"><i class="fas fa-user-tie"></i><?php echo esc_html__('Candidate', 'jobzilla'); ?> </label>
								</div>
								<!--Signup Employer-->
								<div class="nav-item" role="presentation">
									<input type="radio" id="vehicle2" class="form-check-input me-3 mt-2" name="user_role" value="employer">
									<label class="nav-link" for="vehicle2"><i class="fas fa-building"></i><?php echo esc_html__('Employer', 'jobzilla'); ?></label>
								</div>
							</div>
								<div class="tab-content"  id="myTabContent">
								<!--Candidate Signup Content-->  
									<div class="tab-pane fade show active" id="twm-candidate-Signup">
										<div class="row">
											<div class="col-lg-12">
												<div class="form-group mb-3">
													<input name="first_name" type="text" required="" class="form-control" placeholder="<?php echo esc_attr__('First Name','jobzilla'); ?>*" value="">
												</div>
											</div>
											<div class="col-lg-12">
												<div class="form-group mb-3">
													<input name="last_name" type="text" required="" class="form-control" placeholder="<?php echo esc_attr__('Last Name','jobzilla'); ?>*" value="">
												</div>
											</div>
											<div class="col-lg-12">
												<div class="form-group mb-3">
													<input name="username" type="text" required="" class="form-control" placeholder="<?php echo esc_attr__('Username','jobzilla'); ?>*" value="">
												</div>
											</div>
											
											<div class="col-lg-12">
												<div class="form-group mb-3">
													<input name="email" type="text" class="form-control" required="" placeholder="<?php echo esc_attr__('Email','jobzilla'); ?>*" value="">
												</div>
											</div>
											
											<div class="col-lg-12">
												<div class="form-group mb-3">
													<input name="password" type="Password" class="form-control" required="" placeholder="<?php echo esc_attr__('Password','jobzilla'); ?>*">
													<div class="password-strength"></div>
												</div>
											</div>

											<div class="col-lg-12">
												<div class="form-group mb-3">
													<input name="confirm_password" type="Password" class="form-control" required="" placeholder="<?php echo esc_attr__('Confirm Password','jobzilla'); ?>*">
												</div>
											</div>
											
											<div class="col-lg-12">
												<div class="form-group mb-3">
													<div class=" form-check">
														<label class="form-check-label" for="agree2">
														<input type="checkbox" name="terms_conditions" value="off" class="form-check-input" id="agree2">
														<?php echo esc_html__('I agree to the ', 'jobzilla'); 
														if(!empty($terms_conditions)){ 
														?>
														<a href="<?php echo esc_url(home_url($terms_conditions)); ?>" class="site-text-primary">
														<?php echo esc_html__('Terms and conditions', 'jobzilla'); ?>
														</a> <?php } ?>
														</label>
														<p>
														<?php echo esc_html__('Already registered?', 'jobzilla'); ?>
															<a href="<?php echo home_url($login_page)?>" class="twm-backto-login m-l5 site-text-primary">
															<?php echo esc_html__('Log in here', 'jobzilla'); ?>
															</a>
														</p>
													</div>
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group">
													<input type="hidden" required="" name="submit_registration" value="register" />
													<button type="submit"   class="site-button btn_disabled btn disabled">
													<?php echo esc_html__('Sign Up', 'jobzilla'); ?>
													</button>
												</div>
											</div>
											<div class="col-md-12 ">
												<div class="social-login">
													<span class="or-option"><?php echo esc_html__('Or', 'jobzilla'); ?></span>	
													<?php 	
													if(class_exists('W3SocialLogin')){	
														$dashboard_url = home_url(jobzilla_get_opt('jobzilla_dashboard_page'));	
														$settings = W3SocialLogin::$settings;
														if($settings->get('show_registration_form') == 'show'){ 
															echo do_shortcode('[w3_social_login login="1" link="1" unlink="1" redirect="'.$dashboard_url.'" align="center"]');	
														}
													} ?>
												</div>
											</div>
										</div>
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
<!-- Register Section End -->


	