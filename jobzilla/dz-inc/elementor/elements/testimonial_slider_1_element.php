<?php
	$btn_link = $anchor_attribute = '';
	
    if (!empty($testimonial_slider_1_element_link))
    {
        $btn_link = !empty($testimonial_slider_1_element_link)?$testimonial_slider_1_element_link:'';
        $anchor_attribute = jobzilla_elementor_get_anchor_attribute($btn_link);
    }


    $query_args = array(
    'post_type' => 'dz_testimonial',
    'post_status' => 'publish',
    'posts_per_page'    => $testimonial_slider_1_element_no_of_posts ,  
    'orderby'=>$testimonial_slider_1_element_orderby,
    'order'=>$testimonial_slider_1_element_order,
    'ignore_sticky_posts' => true,
    );
    
    $testimonial_slider_1_element_image_preference = !empty($testimonial_slider_1_element_image_preference)?$testimonial_slider_1_element_image_preference:'all_posts';
    
    if($testimonial_slider_1_element_image_preference == 'image_post_only')
    {
        $query_args['meta_query'] = array(
            array(
             'key' => '_thumbnail_id',
             'compare' => 'EXISTS'
            ),
        );
    }
    elseif($testimonial_slider_1_element_image_preference == 'text_post_only')
    {
        $query_args['meta_query'] = array(
            array(
             'key' => '_thumbnail_id',
             'compare' => 'Not EXISTS'
            ),
        );
    }
    
    if($testimonial_slider_1_element_only_featured_posts == 'true') 
    {       
        $query_args['meta_key'] = 'featured_post';      
        $query_args['meta_value'] = 1;              
        $query_args['meta_compare'] = 'LIKE';       
    }
    
    if(!empty($testimonial_slider_1_element_posts_in_categories) && !empty($testimonial_slider_1_element_posts_in_categories[0]))
    {           
        
        $testimonial_slider_1_element_posts_in_categories1 = jobzilla_get_cat_id_by_slug($testimonial_slider_1_element_posts_in_categories,'testimonial_category');
        
        $query_args['tax_query'][] = array(
        'taxonomy' => 'testimonial_category',
        'field' => 'id',
        'terms' => $testimonial_slider_1_element_posts_in_categories1,
        'operator' => 'IN'
        ); 
    }   
    $style = !empty($testimonial_slider_1_element_style)?$testimonial_slider_1_element_style:'style_1';
	$allowed_html_tags = jobzilla_allowed_html_tag();
    $query = new WP_Query($query_args);
    $strip = wp_kses_allowed_html('strip');
    if(!empty($query->have_posts())){
    if($style =='style_1'){
    ?>  
    <!-- TESTIMONIAL SECTION START -->
    <div class="section-full content-inner site-bg-white twm-testimonial-1-area">    
        <div class="container">
            <?php if(!empty($testimonial_slider_1_element_title) || !empty($testimonial_slider_1_element_subtitle)){ ?>
                <div class="wt-separator-two-part">
                    <div class="row wt-separator-two-part-row">
                        <div class="col-xl-12 col-lg-12 col-md-12 wt-separator-two-part-left">
                            <!-- TITLE START-->
                            <div class="section-head center wt-small-separator-outer">
                                <?php if(!empty($testimonial_slider_1_element_subtitle)){ ?>
                                    <div class="wt-small-separator site-text-primary">
                                        <div>
                                            <?php echo wp_kses($testimonial_slider_1_element_subtitle, 'string'); ?>
                                        </div> 
                                    </div>
                                <?php } ?>

                                <?php if(!empty($testimonial_slider_1_element_title)){ ?>
                                    <h2 class="wt-title">
                                        <?php echo wp_kses($testimonial_slider_1_element_title, 'string'); ?>
                                    </h2>
                                <?php } ?>
                            </div>                  
                            <!-- TITLE END-->
                        </div>                
                    </div>
                </div>
            <?php } ?>

            <div class="section-content">             
                <div class="owl-carousel twm-testimonial-1-carousel owl-btn-bottom-center ">            
                    <!-- COLUMNS 1 --> 
                    <?php
				
                        while($query->have_posts())
                        { 
                            $query->the_post();
                            global $post ;                          
                            $designation = jobzilla_get_post_meta(get_the_id(),'testimonial_designation');
                            $content_text_limit = $testimonial_slider_1_element_text_limit;
                            $short_description = jobzilla_short_description(get_the_excerpt(), get_the_content(), $content_text_limit);
                            
                    ?>
                        <div class="item ">
                            <div class="twm-testimonial-1">
                                <div class="twm-testimonial-1-content">
                                    <?php if(has_post_thumbnail()) { ?>  
                                        <div class="twm-testi-media">
                                            <?php the_post_thumbnail('medium'); ?> 
                                        </div>
                                    <?php } ?>
                                    <div class="twm-testi-content">
                                        <div class="twm-quote">
                                            <img src="<?php echo esc_url(JOBZILLA_URL.'assets/images/quote-dark.png'); ?>" alt="<?php echo esc_attr__('Image','jobzilla'); ?>">
                                        </div>
                                        <div class="twm-testi-info">
                                            <?php echo esc_html($short_description); ?>
                                        </div>
                                        <div class="twm-testi-detail">
                                            <div class="twm-testi-name">
                                                <?php echo the_title();?>
                                            </div>
                                            <div class="twm-testi-position">
                                                <?php echo esc_html($designation); ?>
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
    </div>
<!-- TESTIMONIAL SECTION END -->

<?php } elseif($style =='style_2'){ ?>
    <!-- TESTIMONIAL SECTION START -->
    <div class="section-full content-inner site-bg-gray twm-testimonial-2-area">
        <?php if(!empty($testimonial_slider_1_element_title) || !empty($testimonial_slider_1_element_subtitle)){ ?>
            <!-- TITLE START-->
            <div class="section-head center wt-small-separator-outer">
                <?php if(!empty($testimonial_slider_1_element_subtitle)){ ?>
                    <div class="wt-small-separator site-text-primary">
                       <div>
                            <?php echo wp_kses($testimonial_slider_1_element_subtitle, 'string'); ?>
                       </div>                                
                    </div>
                <?php } ?>

                <?php if(!empty($testimonial_slider_1_element_title)){ ?>
                    <h2 class="wt-title">
                        <?php echo wp_kses($testimonial_slider_1_element_title, 'string'); ?>
                    </h2>
                <?php } ?>
            </div>                  
            <!-- TITLE END--> 
        <?php } ?>

        <div class="container">
            <div class="section-content">                 
                <div class="owl-carousel twm-testimonial-2-carousel owl-btn-bottom-center ">
                    <?php
                        while($query->have_posts())
                        { 
                            $query->the_post();
                            global $post ;     
							
                            $designation = jobzilla_get_post_meta(get_the_id(),'testimonial_designation');
                            $content_text_limit = $testimonial_slider_1_element_text_limit;
                            $short_description = jobzilla_short_description(get_the_excerpt(), get_the_content(), $content_text_limit);                            
                    ?>
                        <div class="item">
                            <div class="twm-testimonial-2">
                                <div class="twm-testimonial-2-content">
                                    <?php if(has_post_thumbnail()) { ?>  
                                        <div class="twm-testi-media">
                                            <?php the_post_thumbnail('medium'); ?> 
                                        </div>
                                    <?php } ?>
                                    <div class="twm-testi-content">
                                        <div class="twm-quote">
											<img src="<?php echo esc_url(JOBZILLA_URL.'assets/images/quote-dark.png'); ?>" alt="<?php echo esc_attr__('Image','jobzilla'); ?>">
                                        </div>
										
                                        <div class="twm-testi-info">
                                            <?php echo esc_html($short_description); ?>
                                        </div>
										
                                        <div class="twm-testi-detail">
                                            <div class="twm-testi-name">
                                                <?php echo the_title();?>
                                            </div>
											
                                            <div class="twm-testi-position">
                                                <?php echo esc_html($designation); ?>
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
    </div>
    <!-- TESTIMONIAL SECTION END -->
<?php }elseif($style == 'style_3'){?>

	<!-- TESTIMONIAL SECTION START -->
	<div class="section-full content-inner-1 site-bg-white twm-testimonial-v-area">
		
		<div class="container">

			<div class="section-content"> 
				<div class="twm-testimonial-v-section">
					<div class="row">

						<div class="col-xl-5 col-lg-12 col-md-12">
							<div class="twm-explore-content-outer2">
								<div class="twm-explore-top-section">
									
									<!-- TITLE START-->
									<?php if(!empty($testimonial_slider_1_element_subtitle) || !empty($testimonial_slider_1_element_title) ||!empty($testimonial_slider_1_element_desc)){ ?> 
									<div class="section-head left wt-small-separator-outer">
										<?php if(!empty($testimonial_slider_1_element_subtitle)){ ?>
											<div class="wt-small-separator site-text-primary">
											   <div>
													<?php echo wp_kses($testimonial_slider_1_element_subtitle, 'string'); ?>
											   </div>                                
											</div>
										<?php } 
										if(!empty($testimonial_slider_1_element_title)){ ?>
											<h2>
												<?php echo wp_kses($testimonial_slider_1_element_title, 'string'); ?>
											</h2>
										<?php } 
										if(!empty($testimonial_slider_1_element_desc)){ ?>
										<p><?php echo wp_kses($testimonial_slider_1_element_desc,$allowed_html_tags ); ?></p>
										<?php  } ?>
									</div>
									<?php } ?>
									<!-- TITLE END-->
									<?php if(!empty($testimonial_slider_1_element_btn) && !empty($btn_link)){ ?>
									<div class="twm-read-more">
										<a href="<?php echo esc_url($btn_link['url']); ?>" <?php echo esc_attr($anchor_attribute); ?> class="site-button">
											<?php echo esc_html($testimonial_slider_1_element_btn); ?>
										</a>
									</div>
									<?php } ?>
								</div>

								
							</div>
						</div>

						<div class="col-xl-7 col-lg-12 col-md-12">
							<div class="v-testimonial-wrap">
								<div class="v-testi-dotted-pic">
									<img src="<?php echo esc_url(JOBZILLA_URL.'assets/images/slider/dotted-block.png'); ?>" alt="<?php echo esc_attr__('image', 'jobzilla'); ?>">
								</div>
								<!-- Swiper -->
								<div class="swiper-container v-testimonial-slider">
									<div class="swiper-wrapper">
									 <?php
										while($query->have_posts())
										{ 
											$query->the_post();
											global $post ;
											
											$testimonial_rating = jobzilla_get_post_meta($post->ID,'testimonial_rating');
											$client_name = jobzilla_get_post_meta($post->ID,'testimonial_client_name');
											$designation = jobzilla_get_post_meta(get_the_id(),'testimonial_designation');
											$content_text_limit = $testimonial_slider_1_element_text_limit;
											$short_description = jobzilla_short_description(get_the_excerpt(), get_the_content(), $content_text_limit);                            
									?>
										<!--block 1-->
										<div class="swiper-slide">
											<div class="testimonials-v">
												<?php if(has_post_thumbnail()) { ?>  
													<div class="twm-testi-media">
														<?php the_post_thumbnail('medium'); ?> 
													</div>
												<?php } ?>
												<div class="testimonial-v-content">
													<div class="t-testimonial-top">
														<div class="t-quote"><i class="fa fa-quote-left"></i></div>
														<div class="t-rating">
														<?php $star_count = $testimonial_rating;
															for($star=1;$star<=5;$star++){ 
															  if($star <= $star_count){
																echo "<span><i class='fa fa-star'></i></span>";
															  }
															  else{
																  echo "<span><i class='fa text-secondary fa-star'></i></span>";
															  }
															}
														?>	
														</div>
													</div>
													
													<div class="t-discription"> 
														<?php echo esc_html($short_description); ?>
													</div>

													<div class="twm-testi-detail">
														<?php if(!empty($client_name)){ ?>
														<div class="twm-testi-name"><?php echo esc_html($client_name); ?></div>
														<?php }
														if(!empty($designation)){ ?>
														<div class="twm-testi-position"><?php echo esc_html($designation); ?></div>
														<?php } ?>
													</div>
												</div>   
											</div>
										</div>
										<?php } ?>	
									</div>
									<!-- Add Pagination -->
									<div class="swiper-pagination"></div>
								</div>
							</div>
							
						</div>

					</div>
				</div>
			</div>                              
		</div>
		
	</div>
	<!-- TESTIMONIAL SECTION END -->
<?php }elseif($style == 'style_4'){ ?>
		  <!-- TESTIMONIAL SECTION START -->
            <div class="section-full content-inner-1  site-bg-light twm-testimonial-8-area">
                
                <div class="container">

                    <!-- TITLE START-->
                    <div class="section-head left wt-small-separator-outer">
                        <div class="section-head center wt-small-separator-outer">
							<?php if(!empty($testimonial_slider_1_element_subtitle)){ ?>
								<div class="wt-small-separator site-text-primary">
								   <div>
										<?php echo wp_kses($testimonial_slider_1_element_subtitle, 'string'); ?>
								   </div>                                
								</div>
							<?php } 
							if(!empty($testimonial_slider_1_element_title)){ ?>
								<h2 class="wt-title">
									<?php echo wp_kses($testimonial_slider_1_element_title, 'string'); ?>
								</h2>
							<?php } ?>
                        </div>
                    </div>                  
                    <!-- TITLE END-->

                    <div class="section-content"> 
                        
                        <div class="owl-carousel twm-testimonial-8-carousel owl-btn-bottom-center ">
                        
							<?php
								while($query->have_posts())
								{ 
									$query->the_post();
									global $post ;
									
									$testimonial_rating = jobzilla_get_post_meta($post->ID,'testimonial_rating');
									$client_name = jobzilla_get_post_meta($post->ID,'testimonial_client_name');
									$designation = jobzilla_get_post_meta(get_the_id(),'testimonial_designation');
									$content_text_limit = $testimonial_slider_1_element_text_limit;
									$short_description = jobzilla_short_description(get_the_excerpt(), get_the_content(), $content_text_limit);                            
							?>
                            <div class="item ">
                                <div class="testimonials-v site-bg-white">
									<?php if(has_post_thumbnail()) { ?>  
										<div class="twm-testi-media">
											<?php the_post_thumbnail('medium'); ?> 
										</div>
									<?php } ?>
                                   
                                    <div class="testimonial-v-content">
                                        <div class="t-testimonial-top">
                                            <div class="t-quote"><i class="fa fa-quote-left"></i></div>
                                            <div class="t-rating">
                                               <?php $star_count = $testimonial_rating;
													for($star=1;$star<=5;$star++){ 
													  if($star <= $star_count){
														echo "<span><i class='fa fa-star'></i></span>";
													  }
													  else{
														  echo "<span><i class='fa text-secondary fa-star'></i></span>";
													  }
													}
												?>	
                                            </div>
                                        </div>
                                        <?php if(!empty($short_description)){ ?>
                                        <div class="t-discription">
											<?php echo esc_html($short_description); ?>
                                        </div>
										<?php } ?>
                                        <div class="twm-testi-detail">
											<?php if(!empty($client_name)){ ?>
											<div class="twm-testi-name"><?php echo esc_html($client_name); ?></div>
											<?php }
											if(!empty($designation)){ ?>
											<div class="twm-testi-position"><?php echo esc_html($designation); ?></div>
											<?php } ?>
                                           
                                        </div>
                                    </div>   
                                </div>
                            </div>
							<?php } ?>
                        </div>
                        
                    </div>                              
                </div>
                
            </div>
            <!-- TESTIMONIAL SECTION END -->
	
<?php }
}