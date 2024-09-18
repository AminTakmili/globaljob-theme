<?php
	global $post ;
	$jobzilla_option = getDZThemeReduxOption();
	
	$recruiter_widget_on         = !empty($jobzilla_option['recruiter_widget_on']) ? $jobzilla_option['recruiter_widget_on']: '';
	$recruiter_widget_image      = !empty($jobzilla_option['recruiter_widget_image']) ? $jobzilla_option['recruiter_widget_image']: '';
	$recruiter_widget_title      = !empty($jobzilla_option['recruiter_widget_title']) ? $jobzilla_option['recruiter_widget_title']: '';
	$recruiter_widget_content    = !empty($jobzilla_option['recruiter_widget_content']) ? $jobzilla_option['recruiter_widget_content']: '';
	$recruiter_widget_btn_url    = !empty($jobzilla_option['recruiter_widget_btn_url']) ? $jobzilla_option['recruiter_widget_btn_url']: '';
	$recruiter_widget_btn_text   = !empty($jobzilla_option['recruiter_widget_btn_text']) ? $jobzilla_option['recruiter_widget_btn_text']: '';
	$recruiter_widget_btn_target = !empty($jobzilla_option['recruiter_widget_btn_target']) ? $jobzilla_option['recruiter_widget_btn_target']: '';
	$detail_page_job_view        = !empty($jobzilla_option['detail_page_job_view']) ? $jobzilla_option['detail_page_job_view']: '';
	
	$user_login_id = get_current_user_id();
	$receiver_id = $post->post_author;
	$job_listing_tag = get_the_terms( $post->ID, 'job_listing_tag' );
	
	$short_description	= 	jobzilla_short_description(get_the_excerpt(), get_the_content(), 20);
	$post_id			= 	get_the_id();
	
	$types 				= 	wpjm_get_the_job_types( $post );

	$company_data = jobzilla_get_post_meta
	($post_id,
		array(
			'_company_website',
			'_company_name',
			'_job_salary',
			'_salary_max',
			'_job_salary_currency',
			'_job_salary_unit',
			'_job_expires',
			'_job_location',
			'_job_applications',
			'_job_qualification',
			'_job_experience',
			'_job_gender',
			'_show_sidebar'
		)
	);

	$job_applicant = !empty($company_data['_job_applications'])?$company_data['_job_applications'].' Applicant':'';
	
	
	$company_id = jobzilla_get_post_meta($post_id, '_company_id');
	$job_data = jobzilla_get_post_meta
	($company_id,
		array(
			'_company_phone',
			'_company_email',
			'_company_video',
			'_company_facebook',
			'_company_twitter',
			'_company_linkedin',
			'_company_whatsapp',
			'_company_pinterest',
			'_company_video_image',
			'_company_office_gallery',
			'_company_image',
			'_geolocation_lat',
			'_geolocation_long',
		)
	);
										
	$experience = !empty($company_data['_job_experience'])?$company_data['_job_experience'].' Year':'';

	$allowed_html_tags = jobzilla_allowed_html_tag(); 
	$views_arr = get_post_meta(get_the_id(),'_views_count');
    $views = (isset($views_arr[0]))?$views_arr[0]:0;
	$col_class = !empty($company_data['_show_sidebar']) ? 'col-lg-8 col-md-12' : 'col-lg-12 col-md-12';
?>

<!-- OUR BLOG START -->
<div class="section-full content-inner bg-white">
	<div class="container">
		<!-- BLOG SECTION START -->
		
		<div class="section-content">
			<div class="row d-flex justify-content-center">			
				<div class="<?php echo esc_attr($col_class); ?>">
					<!-- Candidate detail START -->
					<?php if(class_exists( 'WP_Job_Manager_Applications' )) {
					if(!empty($_GET['application_success'])){ ?>
						<div class="job-manager-message">
							<?php _e( 'Your job application has been submitted successfully', 'jobzilla' ); ?>
						</div>
					<?php  } 
					}  ?>
					<div class="cabdidate-de-info details-style-1">
						<div class="twm-job-self-wrap">
							<div class="twm-job-self-info">
								<div class="twm-job-self-top">
									<div class="twm-media-bg">
										<?php if(!empty($job_data['_company_image'])){ ?>
											<img src="<?php echo esc_url($job_data['_company_image']); ?>" alt="<?php echo esc_attr__('Image','jobzilla') ?>">
										<?php } ?>
										
										<?php if(!empty($types)){ ?>
											<div class="twm-jobs-category green">
												<?php foreach($types as $type){ ?>
												<span class="twm-bg-green">
													<?php echo esc_html($type->name); ?>
												</span>
												<?php } ?>
											</div>
										<?php } ?>
										<div class="bookmark-icon">
										<?php
										if(!empty($user_login_id)){
											do_action('jobzilla_bookmark_hook');
										}else{ ?>
											<a class="bookmark-notice " href="#sign_up_popup2" data-bs-toggle="modal"  role="button" >
												<i class="far fa-bookmark"></i>
											</a>
										<?php } ?>
										</div>
										<?php
											if(jobzilla_check_plugin_active('dz-user-message/dz-user-message.php')){	
												jobzilla_user_messages_popup($post_id);
											}
										?>
									</div>
								
									
									
									<div class="twm-mid-content">
										<?php if(has_post_thumbnail()){ ?>
											<div class="twm-media">
												<?php the_post_thumbnail('thumbnail'); ?>
											</div>
										<?php } ?>	
										<h3 class="twm-job-title">
											<?php the_title(); ?> <span class="twm-job-post-duration"><?php  echo esc_html('/'). get_the_jobzilla_publish_date();?></span>
										</h3>
										
										<?php if(!empty($company_data['_job_location'])){ ?>
											<p class="twm-job-address">
												<i class="feather-map-pin"></i>
												<?php echo esc_html($company_data['_job_location']); ?>
											</p>
										<?php } ?>
										
										<div class="twm-job-self-mid">
											<div class="twm-job-self-mid-left">
												<?php if(!empty($company_data['_company_website'])){ ?>
													<a href="<?php echo esc_url($company_data['_company_website']); ?>" class="twm-job-websites site-text-primary">
														<?php echo esc_html($company_data['_company_website']); ?>
													</a>
												<?php } ?>	
												<?php if(!empty($company_data['_job_salary_currency']) || !empty($company_data['_job_salary']) || !empty($company_data['_job_salary_unit']) || !empty($company_data['_salary_max'])){ ?>
												<div class="twm-jobs-amount">
													<?php echo jobzilla_get_job_salary($company_data); ?> 
												</div>
												<?php } ?>	
											</div>
											
											<?php if(!empty($company_data['_job_expires'])){ ?>
												<div class="twm-job-apllication-area">
													<?php echo esc_html__('Application ends:','jobzilla'); ?>
													
													<span class="twm-job-apllication-date">
														<?php echo esc_html($company_data['_job_expires']); ?>
													</span>
												</div>
											<?php } ?>	
										</div>
									
										<?php 
											if(candidates_can_apply($post)){
												$apply = get_the_job_application_method();
												if(!empty($apply)){
													if ( $apply->type == 'url' ) {
														echo '<a class="site-button" target="_blank" href="'.esc_url($apply->url).'">'.esc_html__( 'Apply for job', 'jobzilla' ).'</a>';
													} else {
														get_job_manager_template( 'job-application.php' ); 
													}
												} else {
													$apply = get_post_meta($post->ID,'_apply_link',true);
													if(!empty($apply)){
														echo '<a class="site-button" target="_blank" href="'.esc_url($apply).'">'.esc_html__( 'Apply for job', 'jobzilla' ).'</a>';
													}
												}
											} 
											?>  										
									</div>
								</div>
							</div>								
						</div>
					<?php
						/**
						 * single_job_listing_end hook
						 */
						do_action( 'single_job_listing_end' );
					?>
					</div>	
					<div class="widget widget-description">
					<?php the_content(); ?>
					</div>
					<div class="widget">
						<?php if(!empty($job_data['_company_facebook']) || !empty($job_data['_company_twitter']) || !empty($job_data['_company_linkedin']) || !empty($job_data['_company_whatsapp']) || !empty($job_data['_company_pinterest'])){ ?>
							<h5 class="twm-s-title dz-widget-title">
								<?php echo esc_html__('Social Profile','jobzilla'); ?>
							</h5>
							<div class="twm-social-tags">
								<?php if(!empty($job_data['_company_facebook'])){ ?>
									<a href="<?php echo esc_url($job_data['_company_facebook']); ?>" class="fb-clr"><?php echo esc_html__('Facebook','jobzilla'); ?></a>
								<?php } ?>
								<?php if(!empty($job_data['_company_twitter'])){ ?>
									<a href="<?php echo esc_url($job_data['_company_twitter']); ?>" class="tw-clr"><?php echo esc_html__('Twitter','jobzilla'); ?></a>
								<?php } ?>

								<?php if(!empty($job_data['_company_linkedin'])){ ?>
									<a href="<?php echo esc_url($job_data['_company_linkedin']); ?>" class="link-clr"><?php echo esc_html__('Linkedin','jobzilla'); ?></a>
								<?php } ?>

								<?php if(!empty($job_data['_company_whatsapp'])){ ?>
									<a href="<?php echo esc_url($job_data['_company_whatsapp']); ?>" class="whats-clr"><?php echo esc_html__('Whats App','jobzilla'); ?></a>
								<?php } ?>

								<?php if(!empty($job_data['_company_pinterest'])){ ?>
									<a href="<?php echo esc_url($job_data['_company_pinterest']); ?>" class="pinte-clr"><?php echo esc_html__('Pinterest','jobzilla'); ?></a>
								<?php } ?>
							</div>
						<?php }?>
					</div>
					
					<?php 
					if(!empty($job_data['_geolocation_lat']) && !empty($job_data['_geolocation_long'])){ ?>
					<div class="widget">
					<h5 class="twm-s-title dz-widget-title">
						<?php echo esc_html__('Location','jobzilla'); ?>
					</h5>
					<div class="twm-m-map">
						<div class="twm-m-map-iframe">
							<iframe height="310" src="https://maps.google.com/maps?q=<?php echo esc_attr($job_data['_geolocation_lat']); ?>,<?php echo esc_attr($job_data['_geolocation_long']); ?>&hl=es&z=14&amp;output=embed"></iframe>
						</div>
					</div>
					</div>
					<?php } ?>
					<div class="twm-two-part-section">
						<div class="row">

							<?php 
							$all_images = !empty($job_data['_company_office_gallery']) ? maybe_unserialize($job_data['_company_office_gallery']) :'';
							if(!empty($job_data['_company_office_gallery']) && !empty($all_images)){ ?>
								<div class="col-lg-6 col-md-6">
									<div class="widget">
										<h5 class="twm-s-title dz-widget-title">
											<?php echo esc_html__('Office Photos','jobzilla'); ?>
										</h5>
										<div class="tw-sidebar-gallery">
											<ul>
												<?php 
												foreach($all_images as $gallery){ 
												?>
												<li>
													<div class="tw-service-gallery-thumb">
														<a class="elem" href="<?php echo esc_url($gallery); ?>" title="Title 1" data-lcl-author="" data-lcl-thumb="<?php echo esc_url($gallery); ?>">
															<img src="<?php echo esc_url($gallery); ?>" alt="<?php echo esc_attr__('Image','jobzilla') ?>">
															<i class="fa fa-eye"></i>     
														</a>
													</div>
												</li>
											<?php } ?>							
											</ul>		
										</div> 
									</div> 
								</div>
							<?php } ?>

							<?php if(!empty($job_data['_company_video']) && !empty($job_data['_company_video_image'])){ ?>
								<div class="col-lg-6 col-md-6">
									<div class="widget">
										<h5 class="twm-s-title dz-widget-title"><?php echo esc_html__('Video','jobzilla'); ?></h5>
										<?php if(!empty($job_data['_company_video_image'])){ ?>
											<div class="video-section-first" style="background-image: url(<?php echo esc_url($job_data['_company_video_image']); ?>);">
										<?php } ?>

										<?php if(!empty($job_data['_company_video'])){ ?>
											<a href="<?php echo esc_url($job_data['_company_video']); ?>" class="mfp-video play-now-video">
												<i class="fa fa-play icon"></i>
												<span class="ripple"></span>
											</a>
										<?php } ?>
										</div> 
									</div> 
								</div>
							<?php } ?>
						</div>
					</div>					
				</div>
				<?php if(!empty($company_data['_show_sidebar'])){ ?>
				<div class="col-lg-4 col-md-12 right">
					<div class=" sticky-top">
					<div class="side-bar mb-5">
						<div class="twm-s-info2-wrap widget">
							<div class="twm-s-info2">
								<h4 class="section-head-small dz-widget-title">
									<?php echo esc_html__('Job Information','jobzilla'); ?>
								</h4>
								<ul class="twm-job-hilites2">
									<?php if(!empty($job_applicant)){ ?>
									<li>
										<div class="twm-s-info-inner">
											<i class="fas fa-file-signature"></i>
											<span class="twm-title">
												<?php echo esc_html__('Applicants','jobzilla'); ?>
											</span>
											<div class="twm-s-info-discription">
												<?php echo esc_html($job_applicant); ?>
											</div>
										</div>
									</li>
									<?php } 
									if(!empty($detail_page_job_view)){ ?>
									<li>
										<div class="twm-s-info-inner">
											<i class="fas fa-eye"></i>
											<span class="twm-title">
												<?php echo esc_html__('Views','jobzilla'); ?>
											</span>
											<div class="twm-s-info-discription">
												<?php echo esc_html($views); ?>
											</div>
										</div>
									</li>
									<?php } ?>
									<li>
										<div class="twm-s-info-inner">
											<i class="fas fa-calendar-alt"></i>
											<span class="twm-title"><?php echo esc_html__('Date Posted','jobzilla'); ?></span>
											<div class="twm-s-info-discription"><?php echo esc_html(get_the_date()); ?></div>
										</div>
									</li>

									<?php if(!empty($company_data['_job_location'])){ ?>
										<li>
											<div class="twm-s-info-inner">
												<i class="fas fa-map-marker-alt"></i>
												<span class="twm-title">
													<?php echo esc_html__('Location','jobzilla'); ?>
												</span>
												
												<div class="twm-s-info-discription">
													<?php echo esc_html($company_data['_job_location']); ?>
												</div>
											</div>
										</li>
									<?php } ?>
									
									<li>
										<div class="twm-s-info-inner">
											<i class="fas fa-user-tie"></i>
											<span class="twm-title">
												<?php echo esc_html__('Job Title','jobzilla'); ?>
											</span>
											
											<div class="twm-s-info-discription">
												<?php echo esc_html(get_the_title()); ?>
											</div>
										</div>
									</li>

									<?php if(!empty($experience)){ ?>
										<li>
											<div class="twm-s-info-inner">
												<i class="fas fa-clock"></i>
												<span class="twm-title">
													<?php echo esc_html__('Experience','jobzilla'); ?>
												</span>
												
												<div class="twm-s-info-discription">
													<?php echo esc_html($experience); ?>
												</div>
											</div>
										</li>
									<?php } ?>

									<?php if(!empty($company_data['_job_qualification'])){ ?>
										<li>
											<div class="twm-s-info-inner">
												<i class="fas fa-suitcase"></i>
												<span class="twm-title">
													<?php echo esc_html__('Qualification','jobzilla'); ?>
												</span>
												
												<div class="twm-s-info-discription">
													<?php echo esc_html($company_data['_job_qualification']); ?> 
												</div>
											</div>
										</li>
									<?php } ?>

									<?php if(!empty($company_data['_job_gender'])){ ?>
										<li>
											<div class="twm-s-info-inner">
												<i class="fas fa-venus-mars"></i>
												<span class="twm-title">
													<?php echo esc_html__('Gender','jobzilla'); ?>
												</span>
												
												<div class="twm-s-info-discription">
													<?php echo esc_html(ucfirst($company_data['_job_gender'])); ?>
												</div>
											</div>
										</li>
									<?php } ?>

									<?php if(!empty($company_data['_job_salary']) 
										|| !empty($company_data['_job_salary_currency']) 
										|| !empty($company_data['_job_salary_unit'])
										|| !empty($company_data['_salary_max']))
										{ 
									?>
										<li>
											<div class="twm-s-info-inner">						
												<i class="fas fa-money-bill-wave"></i>
												<span class="twm-title">
													<?php echo esc_html__('Offered Salary','jobzilla'); ?>
												</span>
												
												<div class="twm-s-info-discription">
													<?php echo jobzilla_get_job_salary($company_data, '/'); ?> 
												</div>
											</div>
										</li>
									<?php } ?>
								</ul>								
							</div>
						</div>
						<?php if(!empty($job_listing_tag)){ ?>
							<div class="widget tw-sidebar-tags-wrap">
								<h4 class="section-head-small dz-widget-title">
									<?php echo esc_html__('Job Skills','jobzilla'); ?>
								</h4>		
								
								<div class="tagcloud">
									<?php foreach($job_listing_tag as $tag){ ?>
										<a href="<?php echo get_tag_link( $tag ) ?>"><?php echo esc_html($tag->name); ?></a>
									<?php } ?>
								</div>
							</div>
						<?php } ?>
					</div>

					<div class="twm-s-info3-wrap mb-4">
						<div class="twm-s-info3">
							<div class="twm-s-info-logo-section">
								<?php if(has_post_thumbnail()){ ?>
									<div class="twm-media">
										<?php the_post_thumbnail(); ?>
									</div>
								<?php } ?>
								
								<h5 class="twm-title mb-3">
									<?php the_title(); ?>
								</h5>
							</div>
							<ul>
								<?php if(!empty($company_data['_company_name'])){ ?>
									<li>
										<div class="twm-s-info-inner">
											<i class="fas fa-building"></i>
											<span class="twm-title">
												<?php echo esc_html__('Company','jobzilla'); ?>
											</span>
											
											<div class="twm-s-info-discription">
												<?php echo esc_html($company_data['_company_name']); ?>
											</div>
										</div>
									</li>
								<?php } ?>

								<?php if(!empty($job_data['_company_phone'])){ ?>
									<li>
										<div class="twm-s-info-inner">
											<i class="fas fa-mobile-alt"></i>
											<span class="twm-title">
												<?php echo esc_html__('Phone','jobzilla'); ?>
											</span>
											
											<div class="twm-s-info-discription">
												<?php echo esc_html($job_data['_company_phone']); ?>
											</div>
										</div>
									</li>
								<?php } ?>

								<?php if(!empty($job_data['_company_email'])){ ?>
									<li>
										<div class="twm-s-info-inner">
											<i class="fas fa-at"></i>
											<span class="twm-title">
												<?php echo esc_html__('Email','jobzilla'); ?>
											</span>
											
											<div class="twm-s-info-discription">
												<?php echo esc_html($job_data['_company_email']); ?>
											</div>
										</div>
									</li>
								<?php } ?>

								<?php if(!empty($company_data['_company_website'])){ ?>
									<li>
										<div class="twm-s-info-inner">
											<i class="fas fa-desktop"></i>
											<span class="twm-title">
												<?php echo esc_html__('Website','jobzilla'); ?>
											</span>
											
											<div class="twm-s-info-discription">
												<?php echo esc_html($company_data['_company_website']); ?>
											</div>
										</div>
									</li>
								<?php } ?>

								<?php if(!empty($company_data['_job_location'])){ ?>
									<li>
										<div class="twm-s-info-inner">
											<i class="fas fa-map-marker-alt"></i>
											<span class="twm-title">
												<?php echo esc_html__('Address','jobzilla'); ?>
											</span>
											
											<div class="twm-s-info-discription">
												<?php echo esc_html($company_data['_job_location']); ?>
											</div>
										</div>
									</li>
								<?php } ?>
							</ul>
							
							<a href="<?php the_permalink($company_id); ?>" class=" site-button">
								<?php echo esc_html__('Vew Profile','jobzilla'); ?>
							</a>
						</div>
					</div>
					<?php
					
					if(!empty($recruiter_widget_on)){ 
						$bg_image = !empty($recruiter_widget_image) ? $recruiter_widget_image : '';
					?>
						<div class="twm-advertisment" <?php if(!empty($bg_image)){ ?> style="background-image:url(<?php echo esc_url($bg_image); ?>);" <?php } ?>>
							<div class="overlay"></div>
							
							<?php if(!empty($recruiter_widget_title)){ ?>
								<h4 class="twm-title">
									<?php echo esc_html($recruiter_widget_title) ?>
								</h4>
							<?php } ?>
							
							<?php if(!empty($recruiter_widget_content)){ ?>
								<p>
									<?php echo wp_kses($recruiter_widget_content, $allowed_html_tags) ?>
								</p>
							<?php } ?>
							
							<?php if(!empty($recruiter_widget_btn_url) && !empty($recruiter_widget_btn_text) || !empty($recruiter_widget_btn_target)){ 
							$target	= !empty($recruiter_widget_btn_target)? 'target="'.$recruiter_widget_btn_target.'"' :'' ;
							?>
								<a href="<?php echo esc_url($recruiter_widget_btn_url); ?>" <?php echo esc_attr($target); ?> class="site-button white">
									<?php echo esc_html($recruiter_widget_btn_text); ?>
								</a>
							<?php } ?>
						 </div>
					<?php } ?>
					</div>
				</div>
				<?php } ?>
			</div>				
		</div>
	</div>
</div>
 

