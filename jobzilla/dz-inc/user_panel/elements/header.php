 <?php 
    $login_user = wp_get_current_user();
	$user_id = get_current_user_id();
    $login_menus = array();
	if(!empty($login_user)){
		$roles = $login_user->roles;
		$login_menus = jobzilla_get_user_menus($roles);
	}								
	$header_sticky_on = jobzilla_get_opt('header_sticky_on');
	$header_sticky_class = !empty($header_sticky_on) ? 'sticky-header is-fixed':'';
?>
<header id="header-admin-wrap" class="header-admin-fixed">
	<!-- Header Start -->
	<div id="header-admin" class="<?php echo esc_attr($header_sticky_class); ?>">
		<div class="container">
			
			<!-- Left Side Content -->
			  <div class="header-left">
				 <div class="nav-btn-wrap">
					<!--  <a class="nav-btn-admin" id="sidebarCollapse">
						 <span class="fa fa-angle-left"></span>
					 </a>   -->                        
				 </div>
			 </div> 
			<!-- Left Side Content End -->
			
			<!-- Right Side Content -->
			<div class="header-right">
				<ul class="header-widget-wrap">
					
					<li class="header-widget dashboard-noti-dropdown">
						<div class="dropdown">
							<a  href="javascript:;" class="dropdown-toggle jobzilla-admin-notification" id="ID-NOTI_dropdown" data-bs-toggle="dropdown">
								<i class="far fa-bell"></i>
							</a>
							<div class="dropdown-menu" aria-labelledby="ID-NOTI_dropdown">
								<div class="noti-list dashboard-widget-scroll">
									<ul>
									<?php
									$items = array();
									if(jobzilla_check_plugin_active('dzcore/dzcore.php')){
										
										if(class_exists('DZ_Recent_Activities')){
											$activityObj = new DZ_Recent_Activities();
											$items = $activityObj->dz_core_activity(5);
										}
										
										
										if(!empty($items)){
											foreach ($items as $item) { 
											
												$post_title = get_the_title( $item->post_id );
												$post_url	= get_permalink( $item->post_id );
												$post_status = get_post_status($item->post_id );
												if($post_status != "publish") {
													$post_url = "#";
												}
												$time = strtotime( $item->modified );
												$start = '<li>';
												$nonce = wp_create_nonce( 'delete_activity-' . $item->post_id  );
												$end = '<span class="activity-time">'.human_time_diff( $time, current_time('timestamp') ) . esc_html__(' ago','jobzilla').'</span>';
												$end .= '<a href="#" class="close-list-item color-lebel clr-red" data-nonce="'.$nonce.'" data-id="'.$item->id.'"><i class="far fa-trash-alt"></i></a></li>';
												
												switch ($item->activity) {
													case 'listing_updated':
														echo '
															<li>
																<a href="'.esc_url($post_url).'">
																	<span class="noti-icon"><i class="far fa-bell"></i></span>
																	<span class="noti-texting">'.esc_html__('Listing ','jobzilla').'<b>'.$post_title.'</b>'.esc_html__(' was updated','jobzilla').'.</span> 
																</a>
															</li>';
														break;
													case 'listing_created':
														echo '
															<li>
																<a href="'.esc_url($post_url).'">
																	<span class="noti-icon"><i class="far fa-bell"></i></span>
																	<span class="noti-texting">'.esc_html__('Listing ','jobzilla').'<b>'.$post_title.'</b>'.esc_html__(' was created.','jobzilla').'.</span> 
																</a>
															</li>';
														break;
													case 'listing_approved':
														echo '
															<li>
																<a href="'.esc_url($post_url).'">
																	<span class="noti-icon"><i class="far fa-bell"></i></span>
																	<span class="noti-texting">'.esc_html__('Listing ','jobzilla').'<b>'.$post_title.'</b>'.esc_html__(' was approved.','jobzilla').'.</span> 
																</a>
															</li>';
														break;
													case 'listing_trashed':
														echo '
															<li>
																<a href="'.esc_url($post_url).'">
																	<span class="noti-icon"><i class="far fa-bell"></i></span>
																	<span class="noti-texting">'.esc_html__('Listing ','jobzilla').'<b>'.$post_title.'</b>'.esc_html__(' was removed.','jobzilla').'.</span> 
																</a>
															</li>';
														break;	
													case 'resume_updated':
														echo '
															<li>
																<a href="'.esc_url($post_url).'">
																	<span class="noti-icon"><i class="far fa-bell"></i></span>
																	<span class="noti-texting">'.esc_html__('Resume ','jobzilla').'<b>'.$post_title.'</b>'.esc_html__(' was updated.','jobzilla').'.</span> 
																</a>
															</li>';
														break;
													case 'resume_created':
														echo '
															<li>
																<a href="'.esc_url($post_url).'">
																	<span class="noti-icon"><i class="far fa-bell"></i></span>
																	<span class="noti-texting">'.esc_html__('Resume ','jobzilla').'<b>'.$post_title.'</b>'.esc_html__(' was created.','jobzilla').'.</span> 
																</a>
															</li>';
														break;
													case 'resume_approved':
														echo '
															<li>
																<a href="'.esc_url($post_url).'">
																	<span class="noti-icon"><i class="far fa-bell"></i></span>
																	<span class="noti-texting">'.esc_html__('Resume ','jobzilla').'<b>'.$post_title.'</b>'.esc_html__(' was approved.','jobzilla').'.</span> 
																</a>
															</li>';
														break;
													case 'resume_trashed':
														echo '
															<li>
																<a href="'.esc_url($post_url).'">
																	<span class="noti-icon"><i class="far fa-bell"></i></span>
																	<span class="noti-texting">'.esc_html__('Resume ','jobzilla').'<b>'.$post_title.'</b>'.esc_html__(' was removed.','jobzilla').'.</span> 
																</a>
															</li>';
														break;
													case 'approved':
														echo '
															<li>
																<a href="'.esc_url($post_url).'">
																	<span class="noti-icon"><i class="far fa-bell"></i></span>
																	<span class="noti-texting">'.esc_html__('Your Listing ','jobzilla').'<b>'.$post_title.'</b>'.esc_html__(' has been approved!','jobzilla').'.</span> 
																</a>
															</li>';
														break;
													case 'added':
														echo '
															<li>
																<a href="'.esc_url($post_url).'">
																	<span class="noti-icon"><i class="far fa-bell"></i></span>
																	<span class="noti-texting">'.esc_html__('You have added listing ','jobzilla').'<b>'.$post_title.'</b></span> 
																</a>
															</li>';
														break;
													case 'applied':
														echo '
															<li>
																<a href="'.esc_url($post_url).'">
																	<span class="noti-icon"><i class="far fa-bell"></i></span>
																	<span class="noti-texting">'.esc_html__('Someone applied to your job ','jobzilla').'<b>'.$post_title.'</b></span> 
																</a>
															</li>';
														break;
													default:
														# code...
														break;
												} 
											}
										}	
									} ?>																
									</ul>
								</div>
							</div>
						</div>
					</li>
					<?php if(is_user_logged_in() && !empty($login_menus)) { ?>
					<!--Account-->
						<li class="header-widget">
							<div class="dashboard-user-section">
								<div class="listing-user">
									<div class="dropdown">
										
											
										<a href="javascript:;" class="dropdown-toggle" id="ID-ACCOUNT_dropdown" data-bs-toggle="dropdown">
											<div class="user-name text-black">
												<span>
													<?php echo get_avatar($user_id, 100,'','' );?>
												</span>
													<?php echo esc_html($login_user->data->display_name);?>
											</div> 
										</a>
									
										<div class="dropdown-menu" aria-labelledby="ID-ACCOUNT_dropdown">
											  
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
						   </div>
						</li>
					<?php } ?>
				</ul>
			</div>
			<!-- Right Side Content End -->

		</div>
	</div>
	<!-- Header End -->
</header>
