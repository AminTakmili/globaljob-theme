<?php 
	global $post ; 
	
	$post_id = $post->ID;
    $candidate_data = jobzilla_get_post_meta($post_id,array('_candidate_title','_candidate_photo','_featured','_candidate_location','_candidate_email','location','_candidate_gender','_candidate_salary','_candidate_phone','_candidate_job_experience','_candidate_qualification','_resume_file', '_candidate_geolocation_lat','_candidate_geolocation_long'));	
    
	$experience = !empty($candidate_data['_candidate_job_experience'])?$candidate_data['_candidate_job_experience'].' Year':'';
	$allowed_html_tags = jobzilla_allowed_html_tag();
?>

<div class="section-full content-inner bg-white">
	<div class="container">
		<!-- BLOG SECTION START -->
		<div class="section-content">
			<div class="row d-flex justify-content-center">			
				<div class="col-lg-8 col-md-12">
					<!-- Candidate detail START -->
					<div class="cabdidate-de-info">
						<div class="twm-candi-self-wrap overlay-wraper" style="background-image:url(<?php echo esc_url(JOBZILLA_URL.'/assets/images/candidate-bg.jpg'); ?>);">
							<div class="overlay-main site-bg-primary opacity-01"></div>
							<div class="twm-candi-self-info text-center">
								<div class="twm-candi-self-top">
									<?php if(!empty($candidate_data['_candidate_salary'])){ ?>
										<div class="twm-candi-fee">
											<?php echo esc_html($candidate_data['_candidate_salary']); ?>
										</div>
									<?php } ?>

								 	<?php if(!empty($candidate_data['_candidate_photo'])) { ?>
										<div class="twm-media">
											<img src="<?php echo esc_url($candidate_data['_candidate_photo']); ?>" alt="<?php echo esc_attr__('Image','jobzilla'); ?>"> 
										</div>
									<?php } ?>
									
									<div class="twm-mid-content">									
										<h4 class="twm-job-title ">
											<?php the_title(); ?> 
										</h4>
										
										<?php if(!empty($candidate_data['_candidate_title'])){ ?>
											<p>
												<?php echo esc_html($candidate_data['_candidate_title']); ?>
											</p>
										<?php } ?>
										
										<?php if (function_exists('the_candidate_location')){ ?>
											<p class="twm-candidate-address">
												<i class="feather-map-pin"></i>
												<?php the_candidate_location( false, $post ); ?>
											</p>
										<?php } ?>
									</div>
								</div>
								
								<div class="twm-candi-self-bottom">
									<?php if(!empty($candidate_data['_resume_file'])){ ?>
										<a href="<?php echo esc_url($candidate_data['_resume_file']); ?>" class="site-button secondry" download><?php echo esc_html__('Download CV','jobzilla') ?></a>
									<?php } ?>
								</div>
							</div>
						</div>
						<div class="widget widget-description">
							<?php the_content(); ?>
						</div>	
						<div class="widget">
							<?php if ( ( $skills = wp_get_object_terms( $post->ID, 'resume_skill', [ 'fields' => 'names' ] ) ) && is_array( $skills ) ) { ?>
								<h5 class="twm-s-title dz-widget-title">
									<?php echo esc_html__('Skills','jobzilla'); ?>
								</h5>
								
								<div class="tw-sidebar-tags-wrap">
									<div class="tagcloud">
										<?php echo '<a>'. implode( '</a><a>', $skills ) . '</a>'; ?>
									</div>
								</div>
							<?php } ?>
						</div>	
						<div class="widget">
						<?php if ( $items = get_post_meta( $post->ID, '_candidate_experience', true ) ) { ?>
							<h5 class="twm-s-title dz-widget-title">
								<?php echo esc_html__('Work Experience','jobzilla'); ?>
							</h5>
							
							<div class="twm-timing-list-wrap">
								<?php foreach( $items as $item ) {	?>
									<div class="twm-timing-list">
										<?php if(!empty($item['date'])){ ?>
											<div class="twm-time-list-date">
												<?php echo esc_html( $item['date'] ); ?>
											</div>
										<?php } ?>
										
										<?php if(!empty($item['notes'])){
											printf( __( '%1$s %2$s', 'jobzilla' ), '<div class="twm-time-list-title">' . esc_html( $item['job_title'] ) . '</div>', '<div class="twm-time-list-position">' . esc_html( $item['employer'] ) . '</div>' ); ?>
												<div class="twm-time-list-discription">
													<?php echo wp_kses(wpautop( wptexturize( $item['notes'] ) ), $allowed_html_tags); ?>
												</div>
										<?php } ?>
									</div>
								<?php } ?>
							</div>
						<?php } ?>
						</div>	
						<div class="widget">
						<?php if ( $items = get_post_meta( $post->ID, '_candidate_education', true ) ) { ?>
							<h5 class="twm-s-title dz-widget-title">
								<?php echo esc_html__('Education & Training','jobzilla'); ?>
							</h5>
							
							<div class="twm-timing-list-wrap">
								<?php foreach ( $items  as $item ) {	?>
									<div class="twm-timing-list">
										<?php if(!empty($item['date'])){ ?>
											<div class="twm-time-list-date">
												<?php echo esc_html( $item['date'] ); ?>		
											</div>
										<?php } ?>

										<?php 
											if(!empty($item['qualification']) || !empty($item['location'])){
												printf( __( '%1$s %2$s', 'jobzilla' ), '<div class="twm-time-list-title">' . esc_html( $item['qualification'] ) . '</div>', '<div class="twm-time-list-position">' . esc_html( $item['location'] ) . '</div>' ); 
											}
										?>

										<?php if(!empty($item['notes'])){ ?>
											<div class="twm-time-list-discription khelesh">
												<?php echo wp_kses(wpautop( wptexturize( $item['notes'] ) ), $allowed_html_tags  ); ?>
											</div>
										<?php } ?>
									</div>
								<?php } ?>	
							</div>
						<?php } ?>
						</div>	
					</div>											   
				</div>
				
				<div class="col-lg-4 col-md-12 rightSidebar right">
					<div class="side-bar-2">
						<?php if(!empty($candidate_data['_candidate_geolocation_lat']) && !empty($candidate_data['_candidate_geolocation_long'])){ ?>
							<div class="twm-s-map mb-5">
								<h4 class="section-head-small mb-4"><?php echo esc_html__('Location','jobzilla'); ?></h4> 
								<div class="twm-s-map-iframe">
									<iframe height="270" src="https://maps.google.com/maps?q=<?php echo esc_attr($candidate_data['_candidate_geolocation_lat']); ?>,<?php echo esc_attr($candidate_data['_candidate_geolocation_long']); ?>&hl=es&z=14&amp;output=embed"></iframe>
								</div>
							</div>
						<?php } ?>
						<div class="twm-s-info-wrap widget">
							<h5 class="section-head-small dz-widget-title">
								<?php echo esc_html__('General','jobzilla'); ?>
							</h5> 
							
							<div class="twm-s-info">
								<ul>
									<?php if(!empty($candidate_data['_candidate_salary'])){ ?>
										<li>
											<div class="twm-s-info-inner">
												<i class="fas fa-money-bill-wave"></i>
												<span class="twm-title">
													<?php echo esc_html__('Current Salary','jobzilla'); ?>
												</span>
												
												<div class="twm-s-info-discription"><?php echo esc_html($candidate_data['_candidate_salary']); ?></div>
											</div>
										</li>
									<?php } ?>

									<?php if(!empty($candidate_data['_candidate_job_experience'])){ ?>
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

									<?php if(!empty($candidate_data['_candidate_gender'])){ ?>
										<li>
											<div class="twm-s-info-inner">
												<i class="fas fa-venus-mars"></i>
												<span class="twm-title">
													<?php echo esc_html__('Gender','jobzilla'); ?>
												</span>
												
												<div class="twm-s-info-discription">
													<?php echo esc_html(ucfirst($candidate_data['_candidate_gender'])); ?>
												</div>
											</div>
										</li>
									<?php } ?>

									<?php if(!empty($candidate_data['_candidate_phone'])){ ?>
										<li>
											<div class="twm-s-info-inner">
												<i class="fas fa-mobile-alt"></i>
												<span class="twm-title">
													<?php echo esc_html__('Phone','jobzilla'); ?>
												</span>
												
												<div class="twm-s-info-discription">
													<?php echo esc_html($candidate_data['_candidate_phone']); ?>
												</div>
											</div>
										</li>
									<?php } ?>

									<?php if(!empty($candidate_data['_candidate_email'])){ ?>
										<li>
											<div class="twm-s-info-inner">
												<i class="fas fa-at"></i>
												<span class="twm-title">
													<?php echo esc_html__('Email','jobzilla'); ?>
												</span>
												
												<div class="twm-s-info-discription">
													<?php echo esc_html($candidate_data['_candidate_email']); ?>
												</div>
											</div>
										</li>
									<?php } ?>

									<?php if(!empty($candidate_data['_candidate_qualification'])){ ?>
										<li>
											<div class="twm-s-info-inner">
												<i class="fas fa-book-reader"></i>
												<span class="twm-title">
													<?php echo esc_html__('Qualification','jobzilla'); ?>
												</span>
												
												<div class="twm-s-info-discription">
													<?php echo esc_html($candidate_data['_candidate_qualification']); ?>
												</div>
											</div>
										</li>
									<?php } ?>

									<?php if(!empty($candidate_data['_candidate_location'])){ ?>
										<li>
											<div class="twm-s-info-inner">												
												<i class="fas fa-map-marker-alt"></i>
												<span class="twm-title">
													<?php echo esc_html__('Address','jobzilla'); ?>
												</span>
												
												<div class="twm-s-info-discription">
													<?php echo esc_html($candidate_data['_candidate_location']); ?> 
												</div>
											</div>
										</li>
									<?php } ?>
								</ul>								
							</div>
						</div>

						<div class="twm-s-contact-wrap widget mb-5">
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