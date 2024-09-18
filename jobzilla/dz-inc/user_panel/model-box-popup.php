<?php 
function jobzilla_user_registration_popup(){
$job_alert_content = jobzilla_get_opt('job_alert_content');
$job_alert_title = jobzilla_get_opt('job_alert_title');
$login_popup_text = jobzilla_get_opt('login_popup_text');
$register_popup_text = jobzilla_get_opt('register_popup_text');
$terms_conditions = jobzilla_get_opt('jobzilla_job_terms_conditions_page');
?>	
	
	<!--Model Popup Section Start-->
	<!--Signup popup -->
	<div class="modal fade twm-sign-up" id="sign_up_popup" aria-hidden="true" tabindex="-1">
		<div class="modal-dialog modal-md modal-dialog-centered">
			<div class="modal-content page-loader">
				<div class="modal-header">
					<h2 class="modal-title">
						<?php echo esc_html__('Sign Up', 'jobzilla'); ?>
					</h2>
					<?php if(!empty($args['register_popup_text'])){ ?>
					<p><?php  echo esc_html($args['register_popup_text']); ?></p>
					<?php } ?>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>

				<div class="modal-body">
					<div class="twm-tabs-style-2">
						<div id="registerid"></div>
						<form id="UserRegisterForm">
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
							<div class="tab-content" id="myTabContent">
							<!--Signup Candidate Content-->  
							<div class="tab-pane fade show active" id="sign-candidate">
								
									<div class="row">
											<div class="col-lg-6">
												<div class="form-group mb-3">
													<input name="first_name" type="text" required="" class="form-control" placeholder="<?php echo esc_attr__('First Name','jobzilla'); ?>*" value="">
												</div>
											</div>
											<div class="col-lg-6">
												<div class="form-group mb-3">
													<input name="last_name" type="text" required="" class="form-control" placeholder="<?php echo esc_attr__('Last Name','jobzilla'); ?>*" value="">
												</div>
											</div>
											<div class="col-lg-6">
												<div class="form-group mb-3">
													<input name="username" type="text" required="" class="form-control" placeholder="<?php echo esc_attr__('Username','jobzilla'); ?>*" value="">
												</div>
											</div>
											
											<div class="col-lg-6">
												<div class="form-group mb-3">
													<input name="email" type="text" class="form-control" required="" placeholder="<?php echo esc_attr__('Email','jobzilla'); ?>*" value="">
												</div>
											</div>
											
											<div class="col-lg-6">
												<div class="form-group mb-3">
													<input name="password" type="Password" class="form-control" required="" placeholder="<?php echo esc_attr__('Password','jobzilla'); ?>*">
													<div class="password-strength"></div>
												</div>
											</div>

											<div class="col-lg-6">
												<div class="form-group mb-3">
													<input name="confirm_password" type="Password" class="form-control" required="" placeholder="<?php echo esc_attr__('Confirm Password','jobzilla'); ?>*">
												</div>
											</div>
										
										<div class="col-lg-12">
											<div class="form-group mb-3">
												<div class=" form-check">
													<input type="checkbox" name="terms_conditions" value="off" class="form-check-input" id="agree2">
													<label class="form-check-label" for="agree2">
														<?php echo esc_html__('I agree to the', 'jobzilla');
														
														if(!empty($terms_conditions)){ 
														?> 
														<a href="<?php echo esc_url(home_url($terms_conditions)); ?>">
															<?php echo esc_html__('Terms and conditions', 'jobzilla');?>
														</a>
														<?php } ?>
													</label>
													
													<p class="m-t5">
														<?php echo esc_html__('Already registered?', 'jobzilla'); ?>
														<a href="javascript:void(0);" class="twm-backto-login" data-bs-target="#sign_up_popup2" data-bs-toggle="modal" data-bs-dismiss="modal">
															<?php echo esc_html__('Log in here', 'jobzilla'); ?>
														</a>
													</p>
												
												</div>
											</div>
										</div>
										<div class="col-md-12">
											<input type="hidden" name="submit_registration" value="register" />
											<button type="submit" class="site-button btn_disabled btn disabled">
												<?php echo esc_html__('Sign Up', 'jobzilla'); ?>
											</button>
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
	<!--Login popup -->
	<div class="modal fade twm-sign-up" id="sign_up_popup2" aria-hidden="true" tabindex="-1">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content page-loader">
				<form id="" class="userloginform">
					<div class="modal-header">
						<h2 class="modal-title">
							<?php echo esc_html__('Login', 'jobzilla'); ?>
						</h2>
						<?php if(!empty($args['login_popup_text'])){ ?>
						<p>
						<?php echo esc_html($args['login_popup_text']); ?>
						</p>
						<?php } ?>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="loginid">
						</div>
						<div class="twm-tabs-style-2">
							<div class="tab-content">
								<!--Login Candidate Content-->  
								<div class="tab-pane fade show active">
									<div class="row">

										<div class="col-lg-12">
											<div class="form-group mb-3">
												<input name="username" id="Username" type="text" required="" class="form-control" placeholder="Username*">
											</div>
										</div>
										
										<div class="col-lg-12">
											<div class="form-group mb-3">
												<input name="password" id="Password" type="password" class="form-control" required="" placeholder="Password*">
											</div>
										</div>
										
										
										<div class="col-lg-12">
											<div class="form-group mb-3">
												<div class=" form-check">
													
													<label class="form-check-label" >
													<input type="checkbox" class="form-check-input" name="rememberme" value="true">
													<?php echo esc_html__('Remember me', 'jobzilla');?>
													<a href="javascript:void(0);" class="twm-backto-login" data-bs-target="#reset_password" data-bs-toggle="modal" data-bs-dismiss="modal">
													<?php echo esc_html__('Forgot Password', 'jobzilla');?>
													</a>
													</label>
													
												</div>
											</div>
										</div>
										<div class="col-md-12">
											<button type="submit" class="site-button">
											<?php echo esc_html__('Log in', 'jobzilla');?>
											</button>
											<div class="mt-3 mb-3">
											
											<?php echo esc_html__("Don 't have an account ?", 'jobzilla');?>
												<a href="javascript:void(0);" class="twm-backto-login" data-bs-target="#sign_up_popup" data-bs-toggle="modal" data-bs-dismiss="modal">
													<?php echo esc_html__('Sign Up', 'jobzilla');?>
												</a>
											
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
										
									</div>
								</div>
							</div>
						</div> 
					</div>
				</form>
			</div>
		</div>
	</div>
	<!--Model Popup Section End-->
	
	<div class="modal fade twm-sign-up" id="reset_password" aria-hidden="true" aria-labelledby="reset_password" tabindex="-1">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content page-loader">
				<form id="ResetPassword">
					<div class="modal-header">
						<h2 class="modal-title">
							<?php echo esc_html__('Reset Password', 'jobzilla'); ?>
						</h2>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div id="fesetmsg"></div>
						<div class="twm-tabs-style-2">
							<div class="tab-content">
								<!--Login Candidate Content-->  
								<div class="tab-pane fade show active">
									<div class="row">
										<div class="col-lg-12">
											<div class="form-group mb-3">
												<input name="email" type="text" required="" class="form-control" placeholder="<?php echo esc_attr__('Email*', 'jobzilla');?>">
											</div>
										</div>
										
										<div class="col-lg-12">
											<div class="form-group mb-3">
												<a href="javascript:void(0);" class="site-text-primary"   data-bs-target="#sign_up_popup2" data-bs-toggle="modal" data-bs-dismiss="modal" >
												<?php esc_html_e('Back To Login','jobzilla'); ?></a>
											</div>
										</div>
										
										<div class="col-md-12">
											<button type="submit" class="site-button">
											<?php echo esc_html__('Reset Password', 'jobzilla');?>
											</button>
										</div>
									</div>
								</div>
							</div>
						</div> 
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<div class="modal fade twm-sign-up" id="job_alert" aria-hidden="true" aria-labelledby="job_alert" tabindex="-1">
		<div class="modal-dialog modal-md modal-dialog-centered">
			<div class="modal-content page-loader">
				<form id="JobAlertSubscription">
					<div class="modal-header">
						<?php if(!empty($args['job_alert_title'])){ ?>
						<h2 class="modal-title">
							<?php echo esc_html($args['job_alert_title']); ?>
						</h2>
						<?php }
						if(!empty($args['job_alert_content'])){ ?>
						<p><?php echo esc_html($args['job_alert_content']); ?></p>
						<?php } ?>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div id="JobMsg"></div>
						<div class="twm-tabs-style-2">
							<div class="tab-content">
								<!--Login Candidate Content-->  
								<div class="tab-pane fade show active">
									<div class="row">
										<div class="col-lg-6">
											<div class="form-group mb-3">
												<label for="alert_name"><?php echo esc_html__('Alert Name', 'jobzilla'); ?></label>
												<input name="alert_name" type="text" required="" class="form-control" placeholder="<?php echo esc_attr__('Alert Name', 'jobzilla');?>">
											</div>
										</div>	
										<div class="col-lg-6">
											<div class="form-group mb-3">
												<label for=""><?php echo esc_html__('Email;', 'jobzilla'); ?></label>
												<input name="dzEmail" type="email" required="" class="form-control" placeholder="<?php echo esc_attr__('Enter your email', 'jobzilla');?>">
											</div>
										</div>											
										<div class="col-lg-6">
											<div class="form-group mb-3">
												<label for="alert_keyword"><?php echo esc_html__('Keyword', 'jobzilla'); ?></label>
												<input name="alert_keyword" type="text" required="" class="form-control" placeholder="<?php echo esc_attr__('Keyword*', 'jobzilla');?>">
											</div>
										</div>	
										<?php if ( taxonomy_exists( 'job_listing_region' ) && wp_count_terms( 'job_listing_region' ) > 0 ) { ?>
										<div class="col-lg-6">
											<div class="form-group mb-3">
												<label for="alert_regions"><?php echo esc_html__('Job Region', 'jobzilla'); ?></label>
												<select name="alert_regions" data-placeholder="<?php _e( 'Any job Regions', 'jobzilla' ); ?>" id="alert_tags"  class="wt-select-box selectpicker">
													<?php
														$terms = get_categories(array( 'taxonomy' => 'job_listing_region'));
														foreach ( $terms as $term )
															echo '<option value="' . esc_attr( $term->name ) . '">' . esc_html( $term->name ) . '</option>';
													?>
												</select>
											</div>
										</div>										
									<?php } 
										if ( taxonomy_exists( 'job_listing_category' ) && wp_count_terms( 'job_listing_category' ) > 0 ){ 
									?>
										<div class="col-lg-6">
											<div class="form-group mb-3">
												<label for="alert_cats"><?php echo esc_html__('Categories', 'jobzilla'); ?></label>
												<select name="alert_cats" data-placeholder="<?php _e( 'Any job Categories', 'jobzilla' ); ?>" id="alert_tags"  class="wt-select-box selectpicker">
													<?php
														$terms = get_categories(array( 'taxonomy' => 'job_listing_category'));
														foreach ( $terms as $term )
															echo '<option value="' . esc_attr( $term->name ) . '">' . esc_html( $term->name ) . '</option>';
													?>
												</select>
											</div>
										</div>	
										<?php } 
										if ( taxonomy_exists( 'job_listing_tag' ) && wp_count_terms( 'job_listing_tag' ) > 0 ){ ?>
										<div class="col-lg-6">
											<div class="form-group mb-3">
												<label for="alert_tags"><?php echo esc_html__('Tags', 'jobzilla'); ?></label>
												<select name="alert_tags" data-placeholder="<?php _e( 'Any job Tags', 'jobzilla' ); ?>" id="alert_tags"  class="wt-select-box selectpicker">
													<?php
														$terms = get_tags(array( 'taxonomy' => 'job_listing_tag'));
														foreach ( $terms as $term )
															echo '<option value="' . esc_attr( $term->name ) . '" >' . esc_html( $term->name ) . '</option>';
													?>
												</select>
											</div>
										</div>	
										<?php } 
										if ( taxonomy_exists( 'job_listing_type' ) && wp_count_terms( 'job_listing_type' ) > 0 ){ 
										?>
										<div class="col-lg-6">
											<div class="form-group mb-3">
												<label for="alert_regions"><?php echo esc_html__('Job Type', 'jobzilla'); ?></label>
												<select name="alert_job_type" data-placeholder="<?php _e( 'Any job type', 'jobzilla' ); ?>" id="alert_job_type"  class="wt-select-box selectpicker">
													<?php
														$terms = get_tags(array( 'taxonomy' => 'job_listing_type'));
														foreach ( $terms as $term )
															echo '<option value="' . esc_attr( $term->name ) . '">' . esc_html( $term->name ) . '</option>';
													?>
												</select>
											</div>
										</div>	
										<?php } 
										if(class_exists('WP_Job_Manager_Alerts_Notifier')){ 
											$job_al = new WP_Job_Manager_Alerts_Notifier();
											
										?>
										<div class="col-lg-6">
											<div class="form-group mb-3">
												<label for="alert_frequency"><?php echo esc_html__('Frequency', 'jobzilla'); ?></label>
												<select name="alert_frequency" id="alert_frequency" class="wt-select-box selectpicker">
													<?php foreach ( $job_al->get_alert_schedules() as $key => $schedule ) : ?>
														<option value="<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $schedule['display'] ); ?></option>
													<?php endforeach; ?>
												</select>
											</div>
										</div>	
										<?php } ?>
										<div class="col-md-12">
											<button type="submit" class="site-button btn">
											<?php echo esc_html__('Job Alert', 'jobzilla');?>
											</button>
										</div>
									</div>
								</div>
							</div>
						</div> 
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<?php 
}

add_action('jobzilla_wp_user_registration_popup', 'jobzilla_user_registration_popup');
