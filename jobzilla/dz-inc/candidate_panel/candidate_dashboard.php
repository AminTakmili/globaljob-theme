<?php 
	global $post;
	$login_user = wp_get_current_user(); 
	$total_resume	= jobzilla_count_posts_by_user($login_user->ID,'resume','publish' );
	$applications	= jobzilla_count_user_applications($login_user->ID);
	if(jobzilla_check_plugin_active('dz-user-message/dz-user-message.php')){
		$message = get_message_user_data('', '', 6);
		$counts =  get_message_user_data();
		$all_message_count = count($counts);
		$all_message_count = !empty($all_message_count) ? $all_message_count : 0 ;
	}
	$args = array(
				'post_type'           => 'job_application',
				'post_status'         => 'new',
				'ignore_sticky_posts' => 1,
				'meta_key'            => '_candidate_user_id',
				'meta_value'          => get_current_user_id(),
			);
	$job_applications = new WP_Query( $args );
	$resumes = get_user_by_post($login_user->ID, 'resume', 1);
	if(!empty($resumes)){
		$candidate_title = jobzilla_get_post_meta($resumes[0], '_candidate_title');
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
<div class="wt-admin-right-page-header">
	<h2><?php echo esc_html($login_user->data->display_name);?></h2>
	<?php if(!empty($candidate_title)){ ?>
	<p><?php echo esc_html($candidate_title); ?></p>
	<?php } ?>
</div>
<div class="twm-dash-b-blocks mb-5">
	<div class="row">
		<div class="col-xl-6 col-lg-6 col-md-12 mb-3">
			<div class="panel panel-default">
				<div class="panel-body wt-panel-body dashboard-card-2 block-gradient">
					<div class="wt-card-wrap-2">
						<div class="wt-card-icon-2"><i class="flaticon-job"></i></div>
						<div class="wt-card-right wt-total-active-listing counter "><?php echo esc_html($total_resume); ?></div>
						<div class="wt-card-bottom-2 ">
							<h4 class="m-b0"><?php echo esc_html__('Posted Resumes', 'jobzilla'); ?></h4>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-6 col-lg-6 col-md-12 mb-3">
			<div class="panel panel-default">
				<div class="panel-body wt-panel-body dashboard-card-2 block-gradient-2">
					<div class="wt-card-wrap-2">
						<div class="wt-card-icon-2"><i class="flaticon-resume"></i></div>
						<div class="wt-card-right  wt-total-listing-view counter "><?php echo esc_html($applications) ; ?></div>
						<div class="wt-card-bottom-2">
							<h4 class="m-b0"><?php echo esc_html__('Total Applications', 'jobzilla'); ?></h4> 
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php if(jobzilla_check_plugin_active('dz-user-message/dz-user-message.php')){ ?>
		<div class="col-xl-6 col-lg-6 col-md-12 mb-3">
			<div class="panel panel-default">
				<div class="panel-body wt-panel-body dashboard-card-2 block-gradient-3">
					<div class="wt-card-wrap-2">
						<div class="wt-card-icon-2"><i class="flaticon-envelope"></i></div>
						<div class="wt-card-right wt-total-listing-review counter "><?php echo esc_html($all_message_count); ?></div>
						<div class="wt-card-bottom-2">
							<h4 class="m-b0"><?php echo esc_html__('Messages', 'jobzilla'); ?></h4>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php } 
		if(jobzilla_check_plugin_active('dzcore/dzcore.php')){ ?>
		<div class="col-xl-6 col-lg-6 col-md-12 mb-3">
			<div class="panel panel-default">
				<div class="panel-body wt-panel-body dashboard-card-2 block-gradient-4">
					<div class="wt-card-wrap-2">
						<div class="wt-card-icon-2"><i class="flaticon-bell"></i></div>
						<div class="wt-card-right wt-total-listing-bookmarked counter "><?php echo esc_html($all_activities_count); ?></div>
						<div class="wt-card-bottom-2">
							<h4 class="m-b0"><?php echo esc_html__('Notifications', 'jobzilla'); ?></h4>
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
		<div class="col-xl-12 col-lg-12 col-md-12 mb-4">

			<div class="panel panel-default site-bg-white">
				<div class="panel-heading wt-panel-heading px-3 pt-2 pb-1 p profile_viewe">
					<h4 class="panel-tittle m-a0"><i class="far fa-chart-bar"></i>
						<?php echo esc_html__('Your Resumes Views', 'jobzilla'); ?>
					</h4>
					<?php 
					$resumes = get_user_by_post($login_user->ID, 'resume');
					$current_year = date('Y', time());
					if(!empty($resumes)){
					?>
					<div class="col-lg-4 col-md-12">
						<select class="wt-select-bar-large selectpicker " id="ProfileViewPost"  name="Views"  data-live-search="true" data-bv-field="size">
							<?php foreach($resumes as $resume_id){?> 
							<option value="<?php echo esc_attr($resume_id); ?>"><?php echo esc_html(get_the_title($resume_id)); ?></option>
							<?php } ?>
						</select>
					</div>
					<?php } ?>
					<div class="col-lg-4 col-md-12">
						<select class="wt-select-bar-large selectpicker " id="ProfileViewYear"  name="year"  data-live-search="true" data-bv-field="size">
							<?php for($i = 5; $i >= 1; $i--){ ?> 
							<option value="<?php echo esc_attr($current_year); ?>"><?php echo esc_html($current_year); ?></option>
							<?php --$current_year; } ?>
						</select>
					</div>
				</div>
				<?php if(!empty($resume_id)){ ?>
				<div class="panel-body wt-panel-body twm-pro-view-chart">
					<?php
						$resume_View_data = jobzilla_get_views_by_date($resume_id);
						if(!empty($resume_View_data)){
						?>
						<canvas id="profileViewChart" data-labels="<?php echo esc_attr(json_encode($resume_View_data['labels'])); ?>" data-values="<?php echo esc_attr(json_encode($resume_View_data['values'])); ?>"></canvas>
					<?php } ?>
				</div>
				<?php } ?>
			</div>
		
		</div>

		<div class="col-xl-12 col-lg-12 col-md-12 mb-4">
			<div class="panel panel-default">
				<div class="panel-heading wt-panel-heading p-a20">
					<h4 class="panel-tittle m-a0"><?php echo esc_html__('Inbox', 'jobzilla'); ?></h4>
				</div>
				<?php
				if(jobzilla_check_plugin_active('dz-user-message/dz-user-message.php')){ 
					if($message){ ?>
					<div class="panel-body wt-panel-body bg-white">
						<div class="dashboard-messages-box-scroll scrollbar-macosx">
							<?php foreach($message as $value){ 
									$message_user_id =  ($value->receiver_id == $login_user->ID) ? $value->sender_id : $value->receiver_id;
									$date = human_time_diff(strtotime($value->created), strtotime(date_i18n('Y-m-d H:i:s')));
									$message = dz_max_message($value->id, 'message');
									$user_data = get_userdata($message_user_id);
									$user_name = $user_data->data->display_name;
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
				} ?>
			</div>
		</div>
		<?php 
		if(jobzilla_check_plugin_active('dzcore/dzcore.php')){ 
			do_action('jobzilla_recent_activities');
		}
		?>
		<div class="col-lg-12 col-md-12 mb-4">
			<div class="panel panel-default">
				<div class="panel-heading wt-panel-heading p-a20">
					<h4 class="panel-tittle m-a0"><?php echo esc_html__('Jobs Applied Recently', 'jobzilla'); ?></h4>
				</div>
				<?php 
				if ( !empty($job_applications) ) { 
				?>
				<div class="panel-body wt-panel-body bg-white">
					<div class="twm-dashboard-candidates-wrap">
						<div class="row">
							<?php foreach($job_applications->posts as $applications_id){
									$post_author_name = get_the_author_meta('display_name', $applications_id->post_author);
									$candidate_data = jobzilla_get_post_meta( $applications_id->post_parent,'_job_location'  );
								?>
							 <div class="col-xl-12 col-lg-12 col-md-12">
								<div class="twm-dash-candidates-list">														
									<?php $post_type = get_post_type( $applications_id->post_parent);
										if ( !empty($applications_id->post_parent) ) {	?>
										<div class="twm-media">
											<div class="twm-media-pic">
												<?php echo get_the_post_thumbnail($applications_id->post_parent,100); ?>
											</div>
										</div>
										<?php } ?>
										<div class="twm-mid-content">
											<a  href="<?php echo get_permalink( $applications_id->post_parent ); ?>">
												<h4><?php echo esc_html(get_the_title($applications_id->post_parent)); ?></h4>
											</a>
											<?php if(!empty($post_author_name)){ ?>
											<p>
												<?php echo esc_html($post_author_name); ?>
											</p>
											<?php } ?>
											<div class="twm-fot-content">		
												<div class="twm-left-info">
													<?php if(!empty($candidate_data)){ ?>
													<p class="twm-candidate-address">
														<i class="feather-map-pin"></i>
														<?php echo esc_html($candidate_data); ?>
													</p> 
													<?php } ?>
													<div class="twm-jobs-vacancies">
														<?php 
														echo get_the_date( get_option( 'date_format' ), $applications_id->ID ); ?>
													</div>
												</div>
												 
											</div>
										</div>
								</div>
							</div>
							<?php } ?>
						</div>
					</div>              
				</div>
				<?php } ?>
			</div>
		</div>

	</div>
</div>
