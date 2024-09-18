<?php

	global $post; 
	$job_listing_category = get_the_terms( $post->ID, 'job_listing_category' );
    $post_id = $post->ID;
    $company_data = jobzilla_get_post_meta($post_id,array('_company_location','_company_email','_company_phone','_company_video','_company_website','_company_facebook','_company_twitter','_company_linkedin','_company_whatsapp','_company_pinterest','_company_image','_company_since','_company_offered_salary','_company_video_image','_company_office_gallery','_geolocation_lat','_geolocation_long'));
	$company_id = jobzilla_get_post_meta($post_id, '_company_id');
	$current_year = get_the_date('Y');

?>
<div class="section-full content-inner-1 bg-white">
	<div class="container">	
		<!-- BLOG SECTION START -->
		<div class="section-content">
			<div class="row d-flex justify-content-center">			
				<div class="col-lg-8 col-md-12">
					<!-- Candidate detail START -->
					<div class="cabdidate-de-info">
						<div class="twm-employer-self-wrap">
							<div class="twm-employer-self-info">
								<div class="twm-employer-self-top">
									<div class="twm-media-bg">
										<?php if(!empty($company_data['_company_image'])){ ?>
											<img src="<?php echo esc_html($company_data['_company_image']); ?>" alt="<?php echo esc_attr__('Image','jobzilla'); ?>">
										<?php } ?>
									</div>
									<div class="twm-mid-content">
										<?php $company_logo = get_the_company_logo($post,  'medium' ); ?>
										<?php if(!empty($company_logo)) { ?>  
											<div class="twm-media">
												<img src="<?php echo esc_url($company_logo); ?>" alt="<?php echo esc_attr__('company-logo', 'jobzilla'); ?>"> 
											</div>
										<?php } ?>
										<h3 class="twm-job-title">
											<?php the_title(); ?>
										</h3>
										
										<?php if(!empty($company_data['_company_location'])){ ?>
											<p class="twm-employer-address">
												<i class="feather-map-pin"></i>
												<?php echo esc_html($company_data['_company_location']); ?>
											</p>
										<?php } ?>

										<?php if(!empty($company_data['_company_website'])){ ?>
											<a href="<?php echo esc_url($company_data['_company_website']); ?>" class="twm-employer-websites site-text-primary">
												<?php echo esc_html($company_data['_company_website']); ?>
											</a>
										<?php } ?>
										
										<div class="twm-employer-self-bottom">
											<a href="#comments" class="site-button outline-primary">
												<?php echo esc_html__('Add Review','jobzilla'); ?>
											</a>
										</div>
									</div>
								</div>								
							</div>
						</div>
						<div class="widget widget-description">
							<?php the_content(); ?>
						</div>
						<div class="widget">
						<?php if(!empty($company_data['_company_facebook']) || !empty($company_data['_company_twitter']) || !empty($company_data['_company_linkedin']) || !empty($company_data['_company_whatsapp']) || !empty($company_data['_company_pinterest'])){ ?>
							<h5 class="twm-s-title dz-widget-title"><?php echo esc_html__('Social Profile','jobzilla'); ?></h5>
							<div class="twm-social-tags">
								<?php if(!empty($company_data['_company_facebook'])){ ?>
									<a href="<?php echo esc_url($company_data['_company_facebook']); ?>" class="fb-clr">
										<?php echo esc_html__('Facebook','jobzilla'); ?>
									</a>
								<?php } ?>

								<?php if(!empty($company_data['_company_twitter'])){ ?>
									<a href="<?php echo esc_url($company_data['_company_twitter']); ?>" class="tw-clr">
										<?php echo esc_html__('Twitter','jobzilla'); ?>
									</a>
								<?php } ?>

								<?php if(!empty($company_data['_company_linkedin'])){ ?>
									<a href="<?php echo esc_url($company_data['_company_linkedin']); ?>" class="link-clr">
										<?php echo esc_html__('Linkedin','jobzilla'); ?>
									</a>
								<?php } ?>

								<?php if(!empty($company_data['_company_whatsapp'])){ ?>
									<a href="<?php echo esc_url($company_data['_company_whatsapp']); ?>" class="whats-clr">
										<?php echo esc_html__('Whats App','jobzilla'); ?>
									</a>
								<?php } ?>

								<?php if(!empty($company_data['_company_pinterest'])){ ?>
									<a href="<?php echo esc_url($company_data['_company_pinterest']); ?>" class="pinte-clr">
										<?php echo esc_html__('Pinterest','jobzilla'); ?>
									</a>
								<?php } ?>
							</div>
						<?php } ?>
						</div>
						
							<div class="twm-two-part-section">
								<div class="row">
									<?php 
									$all_images =  !empty($company_data['_company_office_gallery']) ? maybe_unserialize($company_data['_company_office_gallery']) : '';
									if(!empty($company_data['_company_office_gallery']) && !empty($all_images)){ ?>
										<div class="col-lg-6 col-md-6">
											<div class="widget">
												<h5 class="twm-s-title dz-widget-title">
													<?php echo esc_html__('Office Photos','jobzilla') ?>
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
																		<i class="fa fa-file-image"></i>     
																	</a>
																</div>
															</li>
														<?php } ?>							
													</ul>		
												</div> 
											</div>
										</div>
									<?php } ?>

									<?php if(!empty($company_data['_company_video_image'])){ ?>
										<div class="col-lg-6 col-md-6">
											<div class="widget">
												<h5 class="twm-s-title dz-widget-title">
													<?php echo esc_html__('Video','jobzilla'); ?>
												</h5>
												<div class="video-section-first" style="background-image: url(<?php echo esc_url($company_data['_company_video_image']); ?>);">
													<a href="<?php echo esc_url($company_data['_company_video']); ?>" class="mfp-video play-now-video">
														<i class="fa fa-play icon"></i>
														<span class="ripple"></span>
													</a>
												</div> 
											</div>
										</div>
									<?php } ?>
								</div>
						</div>
						<div class="mb-4">
							<?php do_action( 'single_company_content_end' );?>
						</div>
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
							<h5 class="twm-s-title dz-widget-title">
								<?php echo esc_html__('Available Jobs','jobzilla') ?>
							</h5>
							
							<div class="twm-jobs-list-wrap">
								<ul>
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
																				'_job_location',
																				
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
									 <li>
										 <div class="twm-jobs-list-style1 mb-5">
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
												<div>
												<a href="<?php the_permalink(); ?>" class="twm-jobs-browse site-text-primary">
													<?php echo esc_html__('Browse Jobs','jobzilla'); ?>
												</a></div>
											 </div>
										 </div>
									 </li>
	 								<?php ++$count; } ?>
								</ul>
							</div>
						<?php } ?>
					</div>
				</div>
				
				<div class="col-lg-4 col-md-12 rightSidebar right">
					<div class="side-bar-2">
							<?php if(!empty( $company_data['_geolocation_lat']) && !empty( $company_data['_geolocation_long'])){ ?>
						
							<div class="twm-s-map widget">
								<h5 class="section-head-small"><?php echo esc_html__('Location','jobzilla'); ?></h5> 
								<div class="twm-s-map-iframe">
									<iframe height="270" src="https://maps.google.com/maps?q=<?php echo esc_attr($company_data['_geolocation_lat']); ?>,<?php echo esc_attr($company_data['_geolocation_long']); ?>&hl=es&z=14&amp;output=embed"></iframe>
								</div>
							</div>
						<?php } ?>
						<div class="twm-s-info-wrap widget">
							<h5 class="section-head-small dz-widget-title">
								<?php echo esc_html__('Profile Info','jobzilla'); ?>
							</h5> 
							<div class="twm-s-info">
								<ul>
									<?php if(!empty($company_data['_company_offered_salary'])){ ?>
										<li>
											<div class="twm-s-info-inner">
												<i class="fas fa-money-bill-wave"></i>
												<span class="twm-title">
													<?php echo esc_html__('Offered Salary','jobzilla'); ?>
												</span>
												
												<div class="twm-s-info-discription">
													<?php echo esc_html($company_data['_company_offered_salary']); ?>
												</div>
											</div>
										</li>
									<?php } ?>
									<?php if(!empty($company_data['_company_phone'])){ ?>
										<li>
											<div class="twm-s-info-inner">
												<i class="fas fa-mobile-alt"></i>
												<span class="twm-title">
													<?php echo esc_html__('Phone','jobzilla'); ?>
												</span>
												
												<div class="twm-s-info-discription">
													<?php echo esc_html($company_data['_company_phone']); ?>
												</div>
											</div>
										</li>
									<?php } ?>

									<?php if(!empty($company_data['_company_email'])){ ?>
										<li>
											<div class="twm-s-info-inner">
												<i class="fas fa-at"></i>
												<span class="twm-title">
													<?php echo esc_html__('Email','jobzilla'); ?>
												</span>
												
												<div class="twm-s-info-discription">
													<?php echo esc_html($company_data['_company_email']); ?>
												</div>
											</div>
										</li>
									<?php } ?>

									<?php if(!empty($company_data['_company_location'])){ ?>
										<li>
											<div class="twm-s-info-inner">
												<i class="fas fa-map-marker-alt"></i>
												<span class="twm-title">
													<?php echo esc_html__('Address','jobzilla'); ?>
												</span>
												
												<div class="twm-s-info-discription">
													<?php echo esc_html($company_data['_company_location']); ?>
												</div>
											</div>
										</li>
									<?php } ?>
								</ul>								
							</div>
						</div>

						<div class="twm-s-contact-wrap widget">
							<h5 class="section-head-small dz-widget-title">
								<?php echo esc_html__('Contact us','jobzilla'); ?>
							</h5> 
								<div class="twm-s-contact">
									<?php
									$company_mail_send = jobzilla_get_opt('company_mail_send');
									if(!empty($company_mail_send)){ 
									$post = get_page_by_path($company_mail_send,OBJECT,'wpcf7_contact_form');
										if(!empty($post->ID)){
											echo do_shortcode('[contact-form-7 id="'.$post->ID.'"]');
										}
									}  
									?>
								</div>
							
						</div>						
					</div>
				</div>			
			</div>									
		</div>		
	</div>	
</div> 
						