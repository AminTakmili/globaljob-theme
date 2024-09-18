<?php 
	global $post;
	$login_user = wp_get_current_user(); 
	$total_job	= jobzilla_count_posts_by_user($login_user->ID,'job_listing','publish' );
	$applications	= jobzilla_count_user_applications($login_user->ID);
	$count = 1;
	$type_color = array(
					1=>'twm-bg-green',
					2=>'twm-bg-brown',
					3=>'twm-bg-purple',
					4=>'twm-bg-sky',
					5=>'twm-bg-golden', 
				);
	if(jobzilla_check_plugin_active('dz-user-message/dz-user-message.php')){		
		$message = get_message_user_data('', '', 6);
		$counts =  get_message_user_data();
		$all_message_count = count($counts);
		$all_message_count = !empty($all_message_count) ? $all_message_count : 0;
	}
	if(jobzilla_check_plugin_active('dzcore/dzcore.php')){ 
		$recent_activities = new DZ_Recent_Activities();
		$recent_activities_count = count($recent_activities->dz_core_activity());
		$all_activities_count = !empty($recent_activities_count) ? $recent_activities_count : 0;	
	}
if(!empty($_GET['response']) && $_GET['response'] == 's'){
?>
<div class="alert alert-warning  alert-dismissible fade show" role="alert"><?php echo esc_html__('You are not authorize for this location.', 'jobzilla'); ?></div>
<?php } ?>
<div class="twm-dash-b-blocks">
	<div class="row">
		<div class="col-xl-3 col-lg-6 col-sm-6">
			<div class="panel panel-default">
				<div class="panel-body wt-panel-body gradi-1 dashboard-card ">
					<div class="wt-card-wrap">
						<div class="wt-card-icon"><i class="far fa-address-book"></i></div>
						<div class="wt-card-right wt-total-active-listing counter "><?php echo esc_html($total_job); ?> </div>
						<div class="wt-card-bottom ">
							<h5 class="m-b0"><?php echo esc_html__('Posted Jobs', 'jobzilla'); ?></h5>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-3 col-lg-6 col-sm-6">
			<div class="panel panel-default">
				<div class="panel-body wt-panel-body gradi-2 dashboard-card ">
					<div class="wt-card-wrap">
						<div class="wt-card-icon"><i class="far fa-file-alt"></i></div>
						<div class="wt-card-right  wt-total-listing-view counter "><?php echo esc_html($applications) ; ?></div>
						<div class="wt-card-bottom">
							<h5 class="m-b0"><?php echo esc_html__('Total Applications', 'jobzilla'); ?></h5> 
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php if(jobzilla_check_plugin_active('dz-user-message/dz-user-message.php')){ ?>
		<div class="col-xl-3 col-lg-6 col-sm-6">
			<div class="panel panel-default">
				<div class="panel-body wt-panel-body gradi-3 dashboard-card ">
					<div class="wt-card-wrap">
						<div class="wt-card-icon"><i class="far fa-envelope"></i></div>
						<div class="wt-card-right wt-total-listing-review counter "><?php echo esc_html($all_message_count) ; ?></div>
						<div class="wt-card-bottom">
							<h5 class="m-b0"><?php echo esc_html__('Messages', 'jobzilla'); ?></h5>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php } 
		if(jobzilla_check_plugin_active('dzcore/dzcore.php')){ ?>
		<div class="col-xl-3 col-lg-6 col-sm-6">
			<div class="panel panel-default">
				<div class="panel-body wt-panel-body gradi-4 dashboard-card ">
					<div class="wt-card-wrap">
						<div class="wt-card-icon"><i class="far fa-bell"></i></div>
						<div class="wt-card-right wt-total-listing-bookmarked counter "><?php echo esc_html($all_activities_count); ?></div>
						<div class="wt-card-bottom">
							<h5 class="m-b0"><?php echo esc_html__('Notifications', 'jobzilla'); ?></h5>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php } ?>
	</div>  
</div>
<div class="twm-pro-view-chart-wrap">
	<div class="row">
		<div class="col-xl-6 col-lg-12 col-md-12">
			<div class="panel panel-default site-">
				<div class="panel-heading wt-panel-heading profile_viewe">
					<h5 class="panel-tittle m-a0"><i class="far fa-chart-bar"></i>
						<?php echo esc_html__('Your Profile Views', 'jobzilla'); ?>
					</h5>
					<?php 
					$jobs = get_user_by_post($login_user->ID, 'job_listing');
					$current_year = date('Y', time());
					?>	
				</div>
				
				<?php if(!empty($jobs)){ ?>
				<div class="panel-body wt-panel-body twm-pro-view-chart">
					<div class="row">
						<div class="col-lg-6 col-sm-6 mb-2">
							<select class="wt-select-bar-large selectpicker " id="ProfileViewPost"  name="Views"  data-live-search="true" data-bv-field="size">
								<?php foreach($jobs as $job_id){?> 
								<option value="<?php echo esc_attr($job_id); ?>"><?php echo esc_html(get_the_title($job_id)); ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="col-lg-6 col-sm-6 mb-2">
							<select class="wt-select-bar-large selectpicker " id="ProfileViewYear"  name="year"  data-live-search="true" data-bv-field="size">
								<?php for($i = 5; $i >= 1; $i--){ ?> 
								<option value="<?php echo esc_attr($current_year); ?>"><?php echo esc_html($current_year); ?></option>
								<?php --$current_year; } ?>
							</select>
						</div>
					</div>
				<?php if(!empty($job_id)){ ?>
					<?php
						$job_View_data = jobzilla_get_views_by_date($job_id);
					if(!empty($job_View_data)){ ?>
					<div class="profile-View-Chart">
						<canvas id="profileViewChart" data-labels="<?php echo esc_attr(json_encode($job_View_data['labels'])); ?>" data-values="<?php echo esc_attr(json_encode($job_View_data['values'])); ?>"></canvas>
					</div>
					<?php } 
					} ?>
				</div>
				<?php }else{
					echo '<div class="no-record-found">' .esc_html__('No Record Found','jobzilla'). '</div>';
				}?>
			</div>
		
		</div>
	
		
		<div class="col-xl-6 col-lg-12 col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading wt-panel-heading p-a20">
					<h5 class="panel-tittle m-a0">
						<?php echo esc_html__('Inbox', 'jobzilla'); ?>
					</h5>
				</div>
				<?php 
				if(jobzilla_check_plugin_active('dz-user-message/dz-user-message.php')){ 
					if($message){ ?>
						<div class="panel-body wt-panel-body ">
							<div class="dashboard-messages-box-scroll scrollbar-macosx">
								<?php foreach($message as $value){ 
									
									$message_user_id =  ($value->receiver_id == $login_user->ID) ? $value->sender_id : $value->receiver_id;
									$date = human_time_diff(strtotime($value->created), strtotime(date_i18n('Y-m-d H:i:s')));
									$user_data = get_userdata($message_user_id);
									if(!empty($user_data->data->display_name)){
										$user_name = $user_data->data->display_name;
									}else{
										$user_name = esc_html__('User','jobzilla');
									}
									
									
									$message = dz_max_message($value->id, 'message');
								?>
								<div class="dashboard-messages-box">
									<div class="dashboard-message-avtar">
										<?php echo get_avatar($message_user_id, 100); ?>
									</div>
									<div class="dashboard-message-area">
										<h5><?php echo esc_html($user_name); ?><span><?php echo esc_html($date); ?></span></h5>
										<p><?php echo esc_html($message); ?></p>
									</div>
								</div>                    
								<?php } ?>
							</div>                        				 
						</div>
					<?php 
					} 
				 }else{
					echo '<div class="no-record-found">' .esc_html__('No Record Found','jobzilla'). '</div>';
				}?>
			</div>
		</div>
		<?php 
		if(jobzilla_check_plugin_active('dzcore/dzcore.php')){
			do_action('jobzilla_recent_activities'); 
		} ?>
		<div class="col-lg-12 col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading wt-panel-heading p-a20">
					<h5 class="panel-tittle m-a0"><?php echo esc_html__('Recent Jobs', 'jobzilla'); ?></h5>
				</div>
				<?php 
				$jobs = get_user_by_post($login_user->ID, 'job_listing', 6);
				if ( !empty($jobs) ) { ?>
				<div class="panel-body wt-panel-body ">
					<div class="twm-dashboard-candidates-wrap">
						<div class="row">
							<?php
							foreach($jobs as $job_id){
								$company_data = jobzilla_get_post_meta
									($job_id,
										array(
											'_company_website',
											'_job_location',
											'_job_salary',
											'_job_salary_currency',
											'_job_salary_unit',
										)
									);
								?>
							<div class="col-lg-4 col-md-6 col-12 m-b30">
								<div class="twm-jobs-grid-style1">
									
									<div class="twm-media">
									    <?php echo get_the_post_thumbnail( $job_id, 'thumbnail'); ?> 
									</div>
									
									<?php  
										$types = wpjm_get_the_job_types($job_id);
										if(!empty($types )){	 
											
											if($count == 6){
												$count = 1;
											}
											$type_colors = $type_color[$count];
											?>
											<div class="twm-jobs-category green">
											<?php foreach ( $types as $type ) { ?>
												<span class="<?php echo esc_html($type_colors); ?>"> 
													<?php echo esc_html( $type->name ); ?>
												</span>
											<?php
											}  ?>
											</div>
									<?php } ?>
									<div class="twm-mid-content">
										<a href="<?php echo the_job_permalink($job_id); ?>" class="twm-job-title">
											<h5><?php echo esc_html(get_the_title($job_id)); ?>
												<span class="twm-job-post-duration">/
													<?php echo get_the_jobzilla_publish_date();?>
												</span>
											</h5>
											
										</a>
									   <?php if(!empty($company_data['_job_location'])){ ?>
											<p class="twm-job-address">
												<?php echo esc_html($company_data['_job_location']);?>
											</p>
										<?php } ?>
										<?php if(!empty($company_data['_company_website'])){ ?>
											<a href="<?php echo esc_url($company_data['_company_website']);?>" class="twm-job-websites site-text-primary">
											<?php echo esc_html($company_data['_company_website']);?>
											</a>
										<?php } ?>
									</div>
									<div class="twm-right-content">
										
										<?php if(!empty($company_data['_job_salary_currency']) && !empty($company_data['_job_salary']) && !empty($company_data['_job_salary_unit'])){ ?>
											<div class="twm-jobs-amount">
												<?php echo esc_html($company_data['_job_salary_currency'].$company_data['_job_salary']); ?> <span>/ <?php echo esc_html(ucfirst($company_data['_job_salary_unit'])); ?></span>
											</div>
										<?php } ?>
										 <a href="<?php the_job_permalink(); ?>" class="twm-jobs-browse site-text-primary">
											<?php echo esc_html__('Browse Job' , 'jobzilla');?>
										 </a>
									</div>
								</div>
							</div>
							<?php 
							$count++;
							} ?>
						</div>
					</div>              
				</div>
				<?php }else{
					echo '<div class="no-record-found">' .esc_html__('No Record Found','jobzilla'). '</div>';
				}?>
			</div>
		</div>
	</div>
</div>				
