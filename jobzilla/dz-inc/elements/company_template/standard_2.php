<?php 
	global $post ; 
	$company_mail_send = jobzilla_get_opt('company_mail_send');
	$job_listing_category = get_the_terms( $post->ID, 'job_listing_category' );
    $post_id = $post->ID;
    $company_data = jobzilla_get_post_meta($post_id,array('_company_location','_company_email','_company_phone','_company_video','_company_website','_company_facebook','_company_twitter','_company_linkedin','_company_whatsapp','_company_pinterest','_company_image','_company_since','_company_offered_salary','_company_video_image','_company_office_gallery','_geolocation_lat','_geolocation_long'));
    $current_year = get_the_date('Y');
	
	$company_id = jobzilla_get_post_meta($post_id, '_company_id');
	$company_logo = get_the_company_logo(  $post,  'medium' );
?>
<!-- Employer Detail START -->

	<div class="section-full  p-t0 p-b90 bg-white">
		<!--Top Wide banner Start-->
		<div class="twm-top-wide-banner overlay-wraper" <?php if(!empty($company_data['_company_image'])){ ?> style="background-image:url(<?php echo esc_url($company_data['_company_image']); ?>);" <?php } ?>>
			<div class="overlay-main site-bg-primary opacity-09"></div>
			
			<div class="twm-top-wide-banner-content container ">

				<div class="twm-mid-content">
					<div class="twm-employer-self-top">
						<?php if(!empty($company_logo)) { ?>  
							<div class="twm-media">
							
								<img src="<?php echo esc_url($company_logo); ?>" alt="<?php echo esc_attr__('company-logo', 'jobzilla'); ?>"> 
							</div>
						<?php } ?>
						<h3 class="twm-job-title"><?php the_title(); ?></h3>
						<?php if(!empty($company_data['_company_location'])){ ?>
							<p class="twm-employer-address">
								<i class="feather-map-pin"></i>
								<?php echo esc_html($company_data['_company_location']); ?>
							</p>
						<?php } ?>
						<?php if(!empty($company_data['_company_website'])){ ?>
							<a href="<?php echo esc_url($company_data['_company_website']); ?>" class="twm-employer-websites">
								<?php echo esc_html($company_data['_company_website']); ?>
							</a>
						<?php } ?>
					</div>

					<div class="twm-employer-self-bottom">
						<?php if(!empty($company_data['_company_facebook']) || !empty($company_data['_company_twitter']) || !empty($company_data['_company_linkedin']) || !empty($company_data['_company_whatsapp']) || !empty($company_data['_company_pinterest'])){ ?>
						<div class="twm-social-btns">
							<?php if(!empty($company_data['_company_facebook'])){ ?>
								<a href="<?php echo esc_url($company_data['_company_facebook']); ?>" class="btn facebook">
									<i class="fab fa-facebook-f"></i>
								</a>
							<?php } ?>
							<?php if(!empty($company_data['_company_twitter'])){ ?>
								<a href="<?php echo esc_url($company_data['_company_twitter']); ?>" class="btn twitter">
									<i class="fab fa-twitter"></i>
								</a>
							<?php } ?>
							<?php if(!empty($company_data['_company_linkedin'])){ ?>
									<a href="<?php echo esc_url($company_data['_company_linkedin']); ?>" class="btn linkedin">
										<i class="fab fa-linkedin-in"></i>
									</a>
							<?php } ?>

							<?php if(!empty($company_data['_company_whatsapp'])){ ?>
								<a href="<?php echo esc_url($company_data['_company_whatsapp']); ?>" class="btn linkedin">
									<i class="fab fa-whatsapp"></i>
								</a>
							<?php } ?>

							<?php if(!empty($company_data['_company_pinterest'])){ ?>
								<a href="<?php echo esc_url($company_data['_company_pinterest']); ?>" class="btn google">
									<i class="fab fa-pinterest"></i>
								</a>
							<?php } ?>
						</div>
						<?php } ?>
						<div class="twm-employer-btn-controls">
							<a href="#comments" class="site-button outline-white"><?php echo esc_html__('Add Review','jobzilla'); ?></a>
						</div>
					</div>

				</div>

			</div>

			<div class="ani-circle-1 rotate-center"></div>
			<div class="ani-circle-2 rotate-center"></div>
				
		</div>
		
		<!--Top Wide banner End-->
		<div class="container">
			<div class="section-content">
				<div class="row d-flex justify-content-center">

					<div class="col-lg-4 col-md-12 rightSidebar">

						<div class="side-bar-2">
							<div class="twm-s-info-wrap widget">
								<h5 class="section-head-small dz-widget-title">
									<?php echo esc_html__('Profile Info','jobzilla'); ?>
								</h5> 
								<div class="twm-s-info-3">
									<ul>
										<?php if(!empty($company_data['_company_offered_salary'])){ ?>
										<li>
											<div class="twm-s-info-inner">
												<i class="fas fa-money-bill-wave"></i>
												<span class="twm-title"><?php echo esc_html__('Offered Salary','jobzilla'); ?></span>
												<div class="twm-s-info-discription"><?php echo esc_html($company_data['_company_offered_salary']); ?></div>
											</div>
										</li>
										<?php } 
										if(!empty($company_data['_company_phone'])){ ?>
										<li>
											<div class="twm-s-info-inner">
												<i class="fas fa-mobile-alt"></i>
												<span class="twm-title"><?php echo esc_html__('Phone','jobzilla'); ?></span>
												<div class="twm-s-info-discription">
													<?php echo esc_html($company_data['_company_phone']); ?>
												</div>
											</div>
										</li>
										<?php }
										if(!empty($company_data['_company_email'])){ ?>
										<li>
											<div class="twm-s-info-inner">
												<i class="fas fa-at"></i>
												<span class="twm-title"><?php echo esc_html__('Email','jobzilla'); ?></span>
												<div class="twm-s-info-discription">
													<?php echo esc_html($company_data['_company_email']); ?>
												</div>
											</div>
										</li>
										<?php }
										if(!empty($company_data['_company_location'])){ ?>
										<li>
											<div class="twm-s-info-inner">
												<i class="fas fa-map-marker-alt"></i>
												<span class="twm-title"><?php echo esc_html__('Address','jobzilla'); ?></span>
												<div class="twm-s-info-discription"><?php echo esc_html($company_data['_company_location']); ?></div>
											</div>
										</li>
										<?php } ?>
									</ul>
									
								</div>
							</div>
							<?php if(!empty($company_data['_geolocation_lat']) && !empty($company_data['_geolocation_long'])){ ?>
							<div class="twm-s-map widget">
								<h5 class="section-head-small dz-widget-title"><?php echo esc_html('Location', 'jobzilla'); ?></h5> 
								<div class="twm-s-map-iframe twm-s-map-iframe-2">
									<iframe height="270" src="https://maps.google.com/maps?q=<?php echo esc_attr($company_data['_geolocation_lat']); ?>,<?php echo esc_attr($company_data['_geolocation_long']); ?>&hl=es&z=14&amp;output=embed"></iframe>
								</div>
							</div>
							<?php } ?>
							<div class="twm-s-contact-wrap widget">
								<h5 class="section-head-small dz-widget-title"><?php echo esc_html__('Contact us','jobzilla'); ?></h5> 
								<div class="twm-s-contact twm-s-contact-2">
									<div class="row">
										<?php  if(!empty($company_mail_send)){ 
										$company = get_page_by_path($company_mail_send,OBJECT,'wpcf7_contact_form');
										
											if(!empty($company->ID)){
												echo do_shortcode('[contact-form-7 id="'.$company->ID.'"]');
											}
										}  
										?>
										
									</div>
									
								</div>
							</div>
							
						</div>

					</div>
				
					<div class="col-lg-8 col-md-12">
						<!-- Candidate detail START -->
						<div class="cabdidate-de-info">
							<?php echo the_content(); ?>
							<div class="twm-two-part-section">
								<div class="row">
									<?php if(!empty($company_data['_company_video_image'])){ ?>
										<div class="col-lg-12 col-md-12 widget">
											<h5 class="section-head-small dz-widget-title">
												<?php echo esc_html__('Video','jobzilla'); ?>
											</h5>
											
											<div class="video-section-first" style="background-image: url(<?php echo esc_url($company_data['_company_video_image']); ?>);">
												<a href="<?php echo esc_url($company_data['_company_video']); ?>" class="mfp-video play-now-video">
													<i class="fa fa-play icon"></i>
													<span class="ripple"></span>
												</a>
											</div> 
										</div>
									<?php } 
									$all_images =  !empty($company_data['_company_office_gallery']) ? maybe_unserialize($company_data['_company_office_gallery']) : '';
									if(!empty($company_data['_company_office_gallery']) && !empty($all_images)){ ?>
									<div class="col-lg-12 col-md-12 widget">
										<h5 class="section-head-small dz-widget-title"><?php echo esc_html__('Office Photos','jobzilla') ?></h5>
										<div class="tw-sidebar-gallery-2">
											<div class="row">
										
												<?php 
												foreach($all_images as $gallery){ 
												?>
													<div class="col-lg-3 col-md-3 col-sm-4 col-6 mb-4">
														<div class="tw-service-gallery-thumb">
															<a class="elem" href="<?php echo esc_url($gallery); ?>" title="Title 1" data-lcl-author="" data-lcl-thumb="<?php echo esc_url($gallery); ?>">
																<img src="<?php echo esc_url( $gallery); ?>" alt="<?php echo esc_attr__('Image','jobzilla') ?>">
																<i class="fa fa-file-image"></i>     
															</a>
														</div>
													</div>
												<?php } 
												 ?>							
											</div>
										</div> 
									</div>
									<?php } ?>
								</div>
							</div>
							<?php do_action( 'single_company_content_end' );?>
							<div >
								<?php 
									$query_args = array(
									'post_type'=> 'job_listing',
									'orderby'    => 'ID',
									'post_status' => 'publish',
									'order'    => 'ASC',
									);							 
									$query = new WP_Query($query_args);
									if(!empty($query->have_posts())){
								?>
									<h5 class="section-head-small dz-widget-title">
										<?php echo esc_html__('Available Jobs','jobzilla') ?>
									</h5>
									
									<div class="twm-jobs-list-wrap pt-4 h-full">
										<div class="row">
										
											<?php $count=1;
												while($query->have_posts())
												{ 
													$query->the_post();
													global $post ; 
													$post_id = get_the_id();
													$types = wpjm_get_the_job_types( $post );
													$company_avail_data = 
														  jobzilla_get_post_meta($post_id,
																					array(
																						'_company_website',
																						'_job_salary',
																						'_job_salary_currency',
																						'_job_salary_unit',
																						'_job_location'
																					)
																				);
													
													$type_color = 	array(
																		1=>'twm-bg-green',
																		2=>'twm-bg-brown',
																		3=>'twm-bg-purple',
																		4=>'twm-bg-sky',
																		5=>'twm-bg-golden'
																	);
													
													if($count == 6){
														$count = 1;
													}
													$type_colors = $type_color[$count];
											?>
											<div class="col-lg-6 col-md-6 m-b50">
												<div class="twm-jobs-grid-style1">
													 <?php if(has_post_thumbnail()) { ?>  
														<div class="twm-media">
															<?php the_post_thumbnail('medium'); ?> 
														</div>
													<?php } ?>
													
													 <div class="twm-mid-content">
														 <a href="<?php the_permalink(); ?>" class="twm-job-title">
															<h6>
																<?php the_title(); ?>
															</h6>
														</a>
														<?php if(!empty($company_avail_data['_job_location'])){ ?>
															<p class="twm-job-address">
																<?php echo esc_html($company_avail_data['_job_location']); ?>
															</p>
														<?php } ?>

														<?php if(!empty($company_avail_data['_company_website'])){ ?>
															<a href="<?php echo esc_url($company_avail_data['_company_website']); ?>" class="twm-job-websites site-text-primary">
																<?php echo esc_html($company_avail_data['_company_website']); ?>
															</a>
														<?php } ?>
													 </div>
													 
													 <div class="twm-right-content">
														<?php if(!empty($types)){ ?>
															<div class="twm-jobs-category green">
															<?php foreach($types as $type){   ?>
																<span class="<?php echo esc_attr($type_colors); ?>">
																<?php echo esc_html($type->name); ?>
																</span>
															<?php }?>
															</div>
														<?php } ?>

														<?php if(!empty($company_avail_data['_job_salary_currency']) || !empty($company_avail_data['_job_salary']) || !empty($company_avail_data['_job_salary_unit'])){ ?>
															<div class="twm-jobs-amount">
																<?php
															if(!empty($company_avail_data['_job_salary_currency'])){
																echo esc_html($company_avail_data['_job_salary_currency']);
															}
															if(!empty($company_avail_data['_job_salary'])){
																echo esc_html($company_avail_data['_job_salary']);
															}
															if(!empty($company_avail_data['_job_salary_unit'])){ 
																?> 
																<span>/ <?php echo esc_html(ucfirst($company_avail_data['_job_salary_unit'])); ?></span>
																
															<?php } ?>
															</div>
														<?php } ?>

														<a href="<?php the_permalink(); ?>" class="twm-jobs-browse site-text-primary">
															<?php echo esc_html__('Browse Jobs','jobzilla'); ?>
														</a>
													 </div>
												 </div>
											 </div>
											<?php ++$count; } ?>
										</div>
									</div>
								<?php } ?>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
		
	</div>  
	
<!-- Employer Detail END -->    
