<?php
    $query_args = array(
    'post_type' 		=> 'job_listing',
    'post_status' 		=> 'publish',
    'posts_per_page'    => $job_listing_1_element_no_of_posts ,  
    'orderby'			=>$job_listing_1_element_orderby,
    'order'				=>$job_listing_1_element_order,
    'ignore_sticky_posts'=> true,
    );
    
    if(!empty($job_listing_1_element_posts_in_categories) && !empty($job_listing_1_element_posts_in_categories[0]))
    {           

        $job_listing_1_element_posts_in_categories1 = jobzilla_get_cat_id_by_slug($job_listing_1_element_posts_in_categories,'job_listing_category');
        
        $query_args['tax_query'][] = array(
        'taxonomy' 		=> 'job_listing_category',
        'field' 		=> 'id',
        'terms' 		=> $job_listing_1_element_posts_in_categories1,
        'operator' 		=> 'IN'
        ); 
    }

    $btn_link = $btn_text = $anchor_attribute = '';
    if (!empty($job_listing_1_element_link_title))
    {
        $btn_link = !empty($job_listing_1_element_link)?$job_listing_1_element_link:'';
        $btn_text = !empty($job_listing_1_element_link_title)?$job_listing_1_element_link_title:'';
        
        $anchor_attribute = jobzilla_elementor_get_anchor_attribute($btn_link);
    }
    
	$section_class = '';
    $section_class .= 'clearfix';
    $section_class .= !empty($job_listing_1_element_section_background)?' '.$job_listing_1_element_section_background:'site-bg-white';
    
	$query = new WP_Query($query_args);

    $ring_class = ($job_listing_1_element_style=='style_2')?'twm-bg-ring-wrap2':'twm-bg-ring-wrap';

    if($job_listing_1_element_cols == 'col_2'){
        $col_classes = 'col-lg-6 col-md-6 ';
    }elseif($job_listing_1_element_cols == 'col_3'){
        $col_classes = 'col-lg-4 col-md-6 ';
    }else{
        $col_classes = 'col-lg-3 col-md-12 ';
    }

    if(!empty($query->have_posts())){
    
    ?>  
    <div class="section-full content-inner <?php echo esc_attr($ring_class.' '.$section_class); ?>">
        
		<?php if($job_listing_1_element_section_background=='site-bg-light-purple' || $job_listing_1_element_section_background=='site-bg-gray'){ ?>
            <div class="twm-bg-ring-right"></div>
            <div class="twm-bg-ring-left"></div>
        <?php } ?>
		
        <div class="container">
            <?php if($job_listing_1_element_style=='style_1'){ 
                if (!empty($job_listing_1_element_title) || !empty($job_listing_1_element_subtitle)) { 
			?>
                <!-- TITLE START-->
                <div class="section-head center wt-small-separator-outer">
                    <?php if (!empty($job_listing_1_element_subtitle)) { ?>
                        <div class="wt-small-separator site-text-primary">
                            <?php echo wp_kses($job_listing_1_element_subtitle,'string'); ?>
                        </div>
                    <?php } ?>
					
                    <?php if (!empty($job_listing_1_element_title)) { ?>
                        <h2 class="wt-title">
                            <?php echo wp_kses($job_listing_1_element_title,'string'); ?>
                        </h2>
                    <?php } ?>
                </div>                  
                <!-- TITLE END-->
				
            <?php } 
			} elseif($job_listing_1_element_style=='style_2' || $job_listing_1_element_style=='style_3'){ ?>
                <div class="wt-separator-two-part">
                    <div class="row wt-separator-two-part-row section-head">
                        <div class="col-xl-6 col-lg-6 col-md-12 wt-separator-two-part-left">
                            <!-- TITLE START-->
                            <div class=" left wt-small-separator-outer">
                                <?php if (!empty($job_listing_1_element_subtitle)) { ?>
                                    <div class="wt-small-separator site-text-primary">
                                       <div>
                                            <?php echo wp_kses($job_listing_1_element_subtitle,'string'); ?>
                                       </div>                                
                                    </div>
                                <?php } ?>

                                <?php if (!empty($job_listing_1_element_title)) { ?>
                                    <h2 class="wt-title">
                                        <?php echo wp_kses($job_listing_1_element_title,'string'); ?>
                                    </h2>
                                <?php } ?>
                            </div>                  
                            <!-- TITLE END-->
                        </div>
						
                        <?php if(!empty($btn_text)) { ?>                            
                            <div class="col-xl-6 col-lg-6 col-md-12 wt-separator-two-part-right text-right">
                                <a href="<?php echo esc_url($btn_link['url']); ?>" <?php echo esc_attr($anchor_attribute); ?> class="site-button">
									<?php echo esc_html($btn_text); ?>
								</a>
                            </div>
                        <?php } ?>
                    </div>
					  <!-- OUR BLOG END -->
					<?php if($job_listing_1_element_style=='style_2'){ ?>
					
						<div class="row grid-style-2">
							 <?php $count=1;
								while($query->have_posts())
								{ 
									$query->the_post();
									global $post ;    
									$types = wpjm_get_the_job_types( $post );
									$post_id = get_the_id();
									$company_data = jobzilla_get_post_meta($post_id,array('_company_website','_job_salary','_salary_max','_job_salary_currency','_job_salary_unit','_job_location'));

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
								<div class="<?php echo esc_attr($col_classes); ?> m-b30">
									<div class="twm-jobs-grid-style1">
										<div class="twm-media">
										<?php if(has_post_thumbnail($post->ID)) { ?>  
											 <?php the_company_logo(); ?>
										<?php }else{ ?>
											<img class="company_logo" src="<?php echo esc_url(JOBZILLA_URL.'/assets/images/company.png'); ?>" alt="<?php the_title(); ?>">
										<?php } ?>
										</div>
										
										<?php if(!empty($types)){ ?>
											<div class="twm-jobs-category green">
												<span class="<?php echo esc_attr($type_colors); ?>">
													<?php foreach($types as $type){ echo esc_html($type->name); } ?>
												</span>
											</div>
										<?php } ?>
										
										<div class="twm-mid-content">
											<a href="<?php the_permalink(); ?>" class="twm-job-title">
												 <h4><?php the_title(); ?></h4>
											</a>
											
											<?php if(!empty($company_data['_job_location'])){ ?>
												<p class="twm-job-address">
													<?php echo esc_html($company_data['_job_location']); ?>
												</p>
											<?php } ?>
											 
											<?php if(!empty($company_data['_company_website'])){ ?>
												<a href="<?php echo esc_url($company_data['_company_website']); ?>" class="twm-job-websites site-text-primary">
													<?php echo esc_html($company_data['_company_website']); ?>
												</a>
											<?php } ?>
										</div>
										
										<div class="twm-right-content">   
											<?php if(!empty($company_data['_job_salary_currency']) || !empty($company_data['_job_salary']) || !empty($company_data['_job_salary_unit']) || !empty($company_data['_salary_max'])){ ?>
												<div class="twm-jobs-amount">
													<?php echo jobzilla_get_job_salary($company_data); ?> 
												</div>
											<?php } ?>
											
											<a href="<?php the_permalink(); ?>" class="twm-jobs-browse site-text-primary"><?php echo esc_html__('Browse Jobs','jobzilla'); ?></a>
										</div>
									</div>
								</div>
							<?php $count++; 
							} ?>
						</div>
					
				<?php } elseif($job_listing_1_element_style == 'style_3'){ ?>
					<div class="section-content">
					   <div class="twm-jobs-grid-wrap">
							<div class="container">
								<div class="row">
									<?php $count=1;
										while($query->have_posts())
										{ 
											$query->the_post();
											global $post ;    
											$types = wpjm_get_the_job_types( $post );
											$content_text_limit = $job_listing_1_element_text_limit;
											$short_description = jobzilla_short_description(get_the_excerpt(), get_the_content(), $content_text_limit);

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
										<div class="<?php echo esc_attr($col_classes); ?>">
											<div class="twm-jobs-featured-style1 m-b30">
												<div class="twm-media">
													<?php if(has_post_thumbnail($post->ID)) { ?>  
														 <?php the_company_logo(); ?>
													<?php }else{ ?>
														<img class="company_logo" src="<?php echo esc_url(JOBZILLA_URL.'/assets/images/company.png'); ?>" alt="<?php the_title(); ?>">
													<?php } ?>												</div>
												
												<?php if(!empty($types)){ ?>
													<div class="twm-jobs-category green">
														<span class="<?php echo esc_attr($type_colors); ?>">
															<?php foreach($types as $type){ echo esc_html($type->name); } ?>
														</span>
													</div>
												<?php } ?>
												
												<div class="twm-mid-content">
													<a href="<?php the_permalink(); ?>" class="twm-job-title">
														 <h4>
															<?php the_title(); ?>
														</h4>
													</a>
												</div>
												<div class="twm-bot-content">
													<p class="twm-job-address"><i class="feather-map-pin"></i><?php echo esc_html($short_description); ?></p>
													<span class="twm-job-post-duration">
														<?php echo the_job_publish_date(); ?>
													</span>
												</div>                           
											</div>
										</div>
									<?php ++$count; } ?>
								</div>           
							</div>           
					   </div>
					</div>
				<?php }  ?>
                </div>
            <?php } ?>
			
			<!-- OUR BLOG START -->
            <div class="row">
				<div class="col-lg-2 col-md-12"></div>
				<div class="col-lg-8 col-md-12">
					<?php if($job_listing_1_element_style == 'style_1'){ ?>                       
					<div class="twm-jobs-list-wrap">
						<ul>
							<?php $count=1;
								while($query->have_posts())
								{ 
									$query->the_post();
									global $post ; 
									$post_id = get_the_id();
									
									$types = wpjm_get_the_job_types( $post );
									
									$company_data = jobzilla_get_post_meta($post_id,
																				array(
																					'_company_website',
																					'_job_salary',
																					'_salary_max',
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
								
								<li>
									 <div class="twm-jobs-list-style1 mb-5">
										<div class="twm-media">
											<?php if(has_post_thumbnail($post->ID)) { ?>  
												 <?php the_company_logo(); ?>
											<?php }else{ ?>
											<img class="company_logo" src="<?php echo esc_url(JOBZILLA_URL.'/assets/images/company.png'); ?>" alt="<?php the_title(); ?>">
											<?php } ?>
										</div>
										 
										 <div class="twm-mid-content">
											<a href="<?php the_permalink(); ?>" class="twm-job-title">
												 <h5>
													<?php the_title(); ?>
													
												</h5>
											</a>
											
											<?php if(!empty($company_data['_job_location'])){ ?>
												<p class="twm-job-address">
													<?php echo esc_html($company_data['_job_location']); ?>
												</p>
											<?php } ?>
											
											<?php if(!empty($company_data['_company_website'])){ ?>
												<a href="<?php echo esc_url($company_data['_company_website']); ?>" class="twm-job-websites site-text-primary">
													<?php echo esc_html($company_data['_company_website']); ?>
												</a>
											<?php } ?>
											
										 </div>
										 <div class="twm-right-content">
											<?php if(!empty($types)){ ?>
												<div class="twm-jobs-category green">
													<span class="<?php echo esc_attr($type_colors); ?>">
														<?php foreach($types as $type){ echo esc_html($type->name); } ?>
													</span>
												</div>
											<?php } ?>
											
											<?php if(!empty($company_data['_job_salary_currency']) || !empty($company_data['_job_salary']) || !empty($company_data['_job_salary_unit']) || !empty($company_data['_salary_max'])){ ?>
												<div class="twm-jobs-amount">
													<?php echo jobzilla_get_job_salary($company_data); ?> 
												</div>
											<?php } ?>
											<div>
											<a href="<?php the_permalink(); ?>" class="twm-jobs-browse site-text-primary"><?php echo esc_html__('Browse Jobs','jobzilla'); ?></a></div>
										 </div>
									 </div>
								 </li>
							<?php ++$count; } ?>
						</ul>
						
						<?php if(!empty($btn_text) && $job_listing_1_element_style=='style_1') { ?>    	
							<div class="text-center m-b30">
								<a href="<?php echo esc_url($btn_link['url']); ?>" <?php echo esc_attr($anchor_attribute); ?> class="site-button">
									<?php echo esc_html($btn_text); ?>
								</a>
							</div>
						<?php } ?>
					</div>
					<?php } ?>
				</div>
				<div class="col-lg-2 col-md-12"></div>
			</div>
		</div>
	</div>   
	<?php } ?>   