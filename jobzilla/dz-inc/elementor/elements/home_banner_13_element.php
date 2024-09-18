<?php

	
	$job_listing_tag = array();
	$category_arr = array();
	if($home_banner_13_element_search_job_category=='yes'){ 
										
		$category_arr = get_terms( 
							array(
								'taxonomy' => 'job_listing_category',
								'hide_empty'  => false, /* Not return that didn't have any post in it's category */
							) 
						);
	}


	if($home_banner_13_element_job_tags=='yes'){ 
		
		$job_listing_tag = get_terms(
								array(
									'taxonomy' => 'job_listing_tag',
									'posts_per_page'    => 5 ,
									'hide_empty'  => false, /* Not return that didn't have any post in it's category */
									'orderby'   => 'DESC'
								) 
							);
							
						
	}
	$allowed_html_tags = jobzilla_allowed_html_tag(); 
	$posts = jobzilla_get_cpt_data('job_listing');
	
	$query_args = array(
    'post_type' 		 => 'job_listing',
    'post_status' 		 => 'publish',
    'posts_per_page'     => $home_banner_13_element_no_of_posts ,  
    'orderby'			 => $home_banner_13_element_orderby,
    'order'				 => $home_banner_13_element_order,
    'ignore_sticky_posts'=> true,
    );
    
    if(!empty($home_banner_13_element_posts_in_categories) && !empty($home_banner_13_element_posts_in_categories[0]))
    {           

        $home_banner_13_element_posts_in_categories1 = jobzilla_get_cat_id_by_slug($home_banner_13_element_posts_in_categories,'job_listing_category');
        
        $query_args['tax_query'][] = array(
        'taxonomy' 		=> 'job_listing_category',
        'field' 		=> 'id',
        'terms' 		=> $home_banner_13_element_posts_in_categories1,
        'operator' 		=> 'IN'
        ); 
    }
$query = new WP_Query($query_args);
$bg_img = $home_banner_13_element_bg_image;
?>

 <!--Banner Start-->
            <div class="twm-home3-banner-section twm-bnr-hpage-13">
                <div class="container">
                    <div class="twm-home3-inner-section">
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-12 twm-hpage-12-v-bnr-left-content">
                                <div class="twm-bnr-mid-section">
									<?php if (!empty($home_banner_13_element_subtitle)) { ?>
										<div class="twm-bnr-title-large">
											<?php echo wp_kses($home_banner_13_element_subtitle,'string'); ?>
										</div>
									<?php } ?>

									<?php if (!empty($home_banner_13_element_title)) { ?>
										<div class="twm-bnr-title-light">
											<?php echo wp_kses($home_banner_13_element_title,'string'); ?>
										</div>
									<?php } ?>

									<?php if (!empty($home_banner_13_element_description)) { ?>
										<div class="twm-bnr-discription">
											<?php echo wp_kses($home_banner_13_element_description,'string'); ?>
										</div>
									<?php } ?>
                                  
                                     <div class="twm-bnr-search-bar">
										<form method="get" id="KeywordsForm" action="<?php echo home_url(jobzilla_get_opt('jobzilla_job_filter_page')); ?>">
											<div class="row">
												<?php if($home_banner_13_element_search_job_title == 'yes'){ ?>
													<!--Title-->
													<div class="form-group col-xl-3 col-lg-6 col-md-3">
														<label><?php echo esc_html__('What','jobzilla') ?></label>
														<select required name="search_keywords" class="wt-search-bar-select selectpicker"  data-live-search="true" id="j-search_keywords" data-bv-field="size">								
															<option disabled selected>
																<?php echo esc_html__('Select Title','jobzilla') ?>
															</option>
															<?php 
															if(!empty($posts)){
															foreach($posts as $post){
																?>
																<option value="<?php echo esc_attr($post->post_title); ?>">
																	<?php echo esc_html($post->post_title); ?>
																</option>                                                  
															<?php }
															} ?>
														</select>
														  
													</div>
												<?php } ?>

												<?php if($home_banner_13_element_search_job_category =='yes'){ ?>
													<!--All Category-->
													<div class="form-group col-xl-3 col-lg-6 col-md-3">
														<label>
															<?php echo esc_html__('Category','jobzilla') ?>
														</label>
														<select required name="search_category" class="wt-search-bar-select selectpicker"  data-live-search="true" id="j-All_Category" data-bv-field="size">
															<option disabled selected>
																<?php echo esc_html__('Select Category','jobzilla') ?>
															</option>
															<?php if(!empty($category_arr)){ ?>
															<option><?php echo esc_html__('All Category','jobzilla'); ?></option>
															
															<?php foreach($category_arr as $type){ ?>
																<option value="<?php echo esc_attr($type->slug); ?>">
																	<?php echo esc_html($type->name); ?>
																</option>                                                  
															<?php }
															} ?>
														</select>
													</div>
												<?php } 
												if(get_option( 'job_manager_regions_filter')){
													 $posts = get_terms( array(
													  'taxonomy'    => 'job_listing_region',
													  'include'     => '',
													  'hide_empty'  => true,
													  'orderby'     => 'include',
													  'order'       => 'ASC', 
													) ); 
												 if($home_banner_13_element_search_job_location=='yes'){ ?>
													<!--Location-->
													<div class="form-group col-xl-3 col-lg-6 col-md-3">
														<label><?php echo esc_html__('Regions', 'jobzilla') ?></label>
														<select required name="search_region" class="wt-search-bar-select selectpicker"  data-live-search="true" id="j-search_region" data-bv-field="size">
															<option disabled selected>
																<?php echo esc_html__('Select Regions', 'jobzilla') ?>
															</option>
															<?php if(!empty($posts)){ ?>
															<option><?php echo esc_html__('All Regions', 'jobzilla'); ?></option>
															<?php foreach($posts as $post){ ?>
																<option value="<?php echo esc_attr($post->slug); ?>">
																	<?php echo esc_html($post->name); ?>
																</option>                                                  
															<?php }
															} ?>
														</select>
														
													</div>
												<?php }
												}else{ 	
													if($home_banner_13_element_search_job_location=='yes'){ 
													$get_location = jonzilla_get_unique_location();
													?>
													<!--Location-->
													<div class="form-group col-xl-3 col-lg-6 col-md-3">
														<label><?php echo esc_html__('Location', 'jobzilla') ?></label>
														
														<select name="search_location" class="wt-search-bar-select selectpicker"  data-live-search="true" id="j-search_location" data-bv-field="size">
															<option disabled selected>
																<?php echo esc_html__('Select Location', 'jobzilla') ?>
															</option>
															<?php if(!empty($get_location)){ ?>
															<option><?php echo esc_html__('All Location', 'jobzilla'); ?></option>
															<?php 
															foreach($get_location as $location){
																?>
																<option value="<?php echo esc_attr($location); ?>">
																	<?php echo esc_html($location); ?>
																</option>                                                  
															<?php	}
															} 
															 ?>
														</select>
														
													</div>
												<?php }
												}
												if(!empty($home_banner_13_element_search_btn)){ ?>
													<!--Find job btn-->
													<div class="form-group col-xl-3 col-lg-6 col-md-3">
														<button type="submit" class="site-button">
															<?php echo esc_html($home_banner_13_element_search_btn); ?>
														</button>
													</div>
												<?php } ?>
											</div>
										</form>
									</div>

									<?php 
										if($home_banner_13_element_job_tags=='yes' && (!empty($job_listing_tag) && taxonomy_exists( 'job_listing_tag' ))){ ?>
										<div class="twm-bnr-popular-search">
											<?php if(!empty($home_banner_13_element_job_tags_title)){ ?>
												<span class="twm-title">
													<?php echo wp_kses($home_banner_13_element_job_tags_title,'string'); ?>
												</span>
											<?php } ?>

											<?php 
												$count = 1;
												$array_count = count($job_listing_tag);
												foreach($job_listing_tag as $tag){ 
												$tag_name = ($array_count > $count)? $tag->name.' , ': $tag->name;
											?>
												<a href="<?php echo get_tag_link( $tag ) ?>">
													<?php echo esc_html($tag_name); ?>
												</a>
											<?php $count++; } ?>
										</div>
									<?php }
									if(!empty($home_banner_13_element_placeholder_text)){ 
									?>
									<div class="twm-browse-jobs"><?php echo esc_html($home_banner_13_element_placeholder_text); ?></div>
									<?php } ?>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12 twm-hpage-12-v-bnr-right-content">
                                <div class="twm-hpage-13-v-bnr" <?php if(!empty($bg_img['id'])){ ?>style="background-image:url(<?php echo esc_url($bg_img['url']); ?>)" <?php } ?>>
								<?php if(!empty($query->have_posts())){	?>
								   <div class="v-hpage-13-bnr-wrap">
                                        <!-- Swiper -->
                                        <div class="v-easy-ticker">
                                            <div class="swiper v-jobSwiper v-easy-ticker-content">
                                                <div class="swiper-wrapper">
													<?php
													$count = 1;
													while($query->have_posts()){
														$query->the_post();
														global $post ; 		
														$post_id = $post->ID;
														$company_id = jobzilla_get_post_meta($post->ID, '_company_id');
														$company_logo = get_the_company_logo($company_id,  'medium' ); 
														$company_title = jobzilla_trim(get_the_title($company_id), 5);
														$post_title = jobzilla_trim(get_the_title($post_id), 3);
														if($count == 3){ 
															$count = 1;
														}
														$class = ($count == 2) ? 'odd' : '';
													?>
                                                    <div class="swiper-slide">
                                                        <div class="v-jobs-list <?php echo esc_attr($class); ?>">
															<?php if(!empty($company_logo)) { ?>  
                                                            <div class="v-jobs-list-icon">
                                                               <img src="<?php echo esc_url($company_logo); ?>" alt="<?php echo esc_attr__('company-logo', 'jobzilla'); ?>">
                                                            </div>
															<?php } ?>
                                                            <div class="v-jobs-list-info">
																<?php if(!empty($company_title)){ ?>
                                                                <h3 class="twm-title"><?php echo esc_html($post_title); ?></h3>
																<?php }
																if(!empty($company_title)){ ?>
                                                                <p><?php echo esc_html($company_title);  ?></p>
																<?php } ?>
                                                            </div>
															<?php if(!empty($company_id)){ ?>
                                                            <a href="<?php the_permalink($company_id); ?>" class="v-jobs-list-link"></a>
															<?php } ?>
                                                        </div>
                                                    </div>
													<?php $count++;
													} ?>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
								<?php } ?>
                                </div>
                            </div>
                        </div>
                        
                    </div>

                </div>
                
            </div>
            <!--Banner End-->