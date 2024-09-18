<?php
	global $post;
	$jobzilla_option = getDZThemeReduxOption();
	$header_sticky_class = !empty($jobzilla_option['header_sticky_class']) ? $jobzilla_option['header_sticky_class']: '';
	$header_search_on = !empty($jobzilla_option['header_search_on']) ? $jobzilla_option['header_search_on']: '';
	$show_login_registration = !empty($jobzilla_option['show_login_registration']) ? $jobzilla_option['show_login_registration']: '';
	$header_register_on = !empty($jobzilla_option['header_register_on']) ? $jobzilla_option['header_register_on']: '';
	$header_login_on = !empty($jobzilla_option['header_login_on']) ? $jobzilla_option['header_login_on']: '';
	$mobile_header_social_link_on = !empty($jobzilla_option['mobile_header_social_link_on']) ? $jobzilla_option['mobile_header_social_link_on']: '';
	$show_social_icon = !empty($jobzilla_option['show_social_icon']) ? $jobzilla_option['show_social_icon']: '';
	
	$login_user = wp_get_current_user();
	$user_id = get_current_user_id();
	if(!empty($post->post_author)){
		$email = get_the_author_meta('user_email', $post->post_author);
		$avatar = get_avatar( $user_id, 50 ); 
	}
	$login_menus = array();
	if(!empty($login_user)){
		$roles = $login_user->roles;
		
		$login_menus = jobzilla_get_user_menus($roles);
	}
	
?>

<!-- Header -->
	<header class="site-header  mo-left header style-1 dz-mega-menu-fullwidth ">		
		<!-- Main Header -->
		<div class="<?php echo esc_attr($header_sticky_class); ?> main-bar-wraper navbar-expand-xl">
			<div class="main-bar clearfix">
				<div class="container-fluid clearfix">
					<!-- Website Logo -->
					<div class="logo-header logo-dark">
						<?php do_action( 'jobzilla_get_logo','site_logo'); ?>
					</div>
					
					<!-- Nav Toggle Button -->
					<button class="navbar-toggler collapsed navicon justify-content-end" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
						<span></span>
						<span></span>
						<span></span>
					</button>
					
					<!-- EXTRA NAV -->
					<div class="extra-nav">
						<div class="extra-cell">
							<div class="extra-nav header-2-nav">
								<?php if($header_search_on){ ?> 
									<div class="header-search">
										<a href="#search" class="header-search-icon"><i class="feather-search"></i></a>
									</div>                                
								<?php } ?>
								<div class="header-nav-btn-section">
									<?php 
									if(!is_user_logged_in() && !empty($show_login_registration)){ 
										if(!empty($header_register_on)){
										?>
										<div class="twm-nav-btn-left">
											<a class="twm-nav-sign-up site-button light" data-bs-toggle="modal" href="#sign_up_popup" role="button">
												<i class="feather-log-in"></i> 
												<?php echo esc_html__('Sign Up','jobzilla'); ?>
											</a>
										</div>
									<?php }else if(!empty($header_login_on)){ ?>
										<div class="twm-nav-btn-left">
											<a class="twm-nav-sign-up site-button light" data-bs-toggle="modal" href="#sign_up_popup2" role="button">
												<i class="feather-log-in"></i> 
												<?php echo esc_html__('Sign In','jobzilla'); ?>
											</a>
										</div>	
								<?php } 

								} ?>
									<?php 			
										$post_a_job = jobzilla_get_opt('post_a_job_on');
										$job_page_id = jobzilla_get_opt('jobzilla_job_page'); 
										if(!empty($job_page_id) && !empty($post_a_job))
										{
											if(!is_user_logged_in() || (is_user_logged_in() && in_array('employer', $roles))) 
											{
									?>
										<div class="twm-nav-btn-right">
											<a href="<?php echo esc_url(home_url($job_page_id)); ?>"  class="twm-nav-post-a-job site-button ">
												<i class="feather-briefcase"></i> 
												<?php echo esc_html__('Post a Job', 'jobzilla')?>
											</a>
										</div>
									<?php 	} 
										}
									?>
								</div>
								<?php if(is_user_logged_in() && !empty($login_menus)) { ?>
								<div class="twm-login-user-menu">
									<div class="dropdown">
										<?php if(!empty($login_user->data->display_name) && !empty($avatar)){ ?>
										<a href="javascript:;" class="dropdown-toggle" id="ID-ACCOUNT_dropdown" data-bs-toggle="dropdown">
											<div class="user-name text-black">
												<span>
													<?php echo wp_kses($avatar,jobzilla_allowed_html_tag());?>
												</span>
											</div> 
										</a>
										<?php } ?>
										<div class="dropdown-menu dropdown-menu-end" aria-labelledby="ID-ACCOUNT_dropdown">
											<ul>
												<?php 
													foreach($login_menus as $value){
												?>
													<li>
														<a href="<?php echo esc_url($value['url']); ?>">
														<i class="<?php echo esc_attr($value['class']); ?>"></i>
															<?php echo esc_html($value['label']);?>
														</a>
													</li>
												<?php } ?>
												<li>
													<a href="<?php echo wp_logout_url(get_permalink()); ?>">
														<i class="fa fa-share-square"></i>
														<?php echo esc_html__('Logout', 'jobzilla');?>
													</a>
												</li>
											</ul>
										</div>
									</div>
								</div>                                 
								<?php } ?>		
							</div> 
						</div>
					</div>	

					<!-- SITE Search -->
					<?php if($header_search_on){ ?>
		                <div id="search"> 
		                    <span class="close"></span>
		                    <form method="get" action="<?php echo esc_url(home_url('/')); ?>" class="radius-xl">
		                        <input class="form-control" value="" name="s" type="text" placeholder="<?php echo esc_attr__('Enter Your Search ...', 'jobzilla'); ?>"/>
		                        <span class="input-group-append">
		                            <button type="submit" class="search-btn">
		                                <i class="fa fa-paper-plane"></i>
		                            </button>
		                        </span>
		                    </form>
		                </div> 
					<?php } ?>				
					
					<!-- Main Nav -->
					<div class="header-nav navbar-collapse collapse justify-content-end" id="navbarNavDropdown">
						<div class="logo-header logo-dark">
							<?php do_action( 'jobzilla_get_logo','site_logo'); ?>
						</div>
						<?php
							
							if(jobzilla_check_plugin_active('dz-mega-menu/dz-mega-menu.php') && class_exists('Dz_Nav_Menu')){ ?>
								<ul class="nav navbar-nav d-none dz-mega-menu-mobile">	
									<?php 								
										wp_nav_menu( array( 'theme_location' => 'mobile_menu', 
										'container_id' => 'navbar-collapse-1',
										'container_class'=>'',
										'menu_class'=>'nav navbar-nav',
										'fallback_cb'=>false, 
										'items_wrap' => '%3$s',
										'container'=>false,
										'depth'=>'4',
										'walker'=> new Dz_Mobile_Menu(),  
										) );					
									?>
								</ul>
							<?php 
								$nav_menu = new Dz_Nav_Menu();
							}else{
								$nav_menu = new Bootstrap_walker();
							}	
						$class = (jobzilla_check_plugin_active('dz-mega-menu/dz-mega-menu.php')) ? 'dz-mega-menu' : '';
						?>	
							<ul class="<?php echo esc_attr($class); ?> nav navbar-nav">	
								<?php 								
									wp_nav_menu( array( 'theme_location' => 'main_menu', 
									'container_id' => 'navbar-collapse-1',
									'container_class'=>'',
									'menu_class'=>'nav navbar-nav',
									'fallback_cb'=>false, 
									'items_wrap' => '%3$s',
									'container'=>false,
									'depth'=>'4',
									'walker'=> $nav_menu,  
									) ); 								
								?>
							</ul>
						<div class="sidebar-footer">
							<?php  
								if(!is_user_logged_in() && $show_login_registration) { 
							?>
								<div class="dz-login-register">
									<?php 
									$login_on = jobzilla_get_opt('jobzilla_login_page'); 
									$register_on = jobzilla_get_opt('jobzilla_register_page'); 	
									if( $mobile_header_login_on ) {?>
											<a class="dz-login-btn btn btn-primary btn-sm" href="<?php echo esc_url(home_url($login_on));?>"><?php echo esc_html__('Sign In', 'jobzilla'); ?></a> 
									<?php } ?>	
									
									<?php if( $mobile_header_register_on ) {?>
										<a class="dz-register-btn btn btn-primary btn-sm" href="<?php echo esc_url(home_url($register_on));?>"><?php echo esc_html__('Sign Up', 'jobzilla'); ?></a>
									<?php } ?>									
								</div>
							<?php }elseif(is_user_logged_in()){ 
								$profile = jobzilla_get_opt('jobzilla_my_profile_page'); 
							?>
								<a class="dz-login-btn btn btn-primary btn-sm" href="<?php echo esc_url(home_url($profile));?>"><?php echo esc_html__('Profile ', 'jobzilla'); ?></a> 
							<?php } ?>	
							<?php if($mobile_header_social_link_on && $show_social_icon){ ?>
								<div class="dz-social-icon">
									<ul>
										<?php echo jobzilla_get_social_icons() ;?>
									</ul>
								</div>		
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Main Header End -->
		
	</header>
	<!-- Header End -->