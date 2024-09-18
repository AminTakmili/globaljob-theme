<?php 
	
	$job_listing_tag = array();
	$category_arr = array();
	if($home_banner_15_element_search_job_type=='yes'){ 
										
		$category_arr = get_terms( 
							array(
								'taxonomy' => 'job_listing_category',
								'hide_empty'  => false, /* Not return that didn't have any post in it's category */
							) 
						);
	}


	if($home_banner_15_element_job_tags=='yes'){ 
		
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
?>
<!--Banner Start-->
<div class="twm-home1-banner-section twm-bnr-hpage-15 site-bg-white">
	<div class="row">
		
		<!--Left Section-->
		<div class="col-xl-6 col-lg-12 col-md-12">

			<div class="twm-bnr-15-carousal">
				<?php if(!empty($home_banner_15_element_images)){
					$img_arr = $home_banner_15_element_images;
					
					?>
				<div class="owl-carousel h-page-15-bnr-carousal  owl-btn-left-bottom">
					<?php foreach($img_arr as $value){
					if(!empty($value['id'])){
					?>
					<div class="item">
						<div class="twm-bnr-15-carousal-section">
							<img src="<?php echo esc_url($value['url']); ?>" alt="<?php echo esc_attr('Banner image'); ?>">
						</div>
					</div>
					<?php }
					} ?>
				</div>
				<?php } ?>
				<div class="bnr-15-left-pic1 bounce2"><img src="<?php echo esc_url(JOBZILLA_URL.'/assets/images/slider/block-left.png'); ?>" alt="<?php echo esc_attr('Image'); ?>"></div>
				<div class="bnr-15-left-pic2 bounce"><img src="<?php echo esc_url(JOBZILLA_URL.'/assets/images/slider/block-right.png'); ?>" alt="<?php echo esc_attr('Image'); ?>"></div>
				<div class="bnr-15-left-pic3 scale-up-center"></div>
			</div>

		</div>

		<!--right Section-->
		<div class="col-xl-6 col-lg-12 col-md-12">
			<div class="twm-bnr-left-section">
				 <?php if (!empty($home_banner_15_element_title)) { ?>
                    <div class="twm-bnr-title-large">
                        <?php echo wp_kses($home_banner_15_element_title,'string'); ?>
                    </div>
                <?php } 
				if (!empty($home_banner_15_element_description)) { ?>
                    <div class="twm-bnr-discription">
                        <?php echo wp_kses($home_banner_15_element_description,'string'); ?>
                    </div>
                <?php } ?>
				
				 <div class="twm-bnr-search-bar">
                    <form method="get" id="KeywordsForm" action="<?php echo home_url(jobzilla_get_opt('jobzilla_job_filter_page')); ?>">
                        <div class="row">
                            <?php if($home_banner_15_element_search_job_title == 'yes' && !empty($posts)){ ?>
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

                            <?php if($home_banner_15_element_search_job_type =='yes'){ ?>
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
							 if($home_banner_15_element_search_job_location=='yes'){ ?>
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
								if($home_banner_15_element_search_job_location == 'yes'){ 
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
							if(!empty($home_banner_15_element_search_btn)){ ?>
								<!--Find job btn-->
								<div class="form-group col-xl-3 col-lg-6 col-md-3">
									<button type="submit" class="site-button">
										<?php echo esc_html($home_banner_15_element_search_btn); ?>
									</button>
								</div>
							<?php } ?>
                        </div>
                    </form>
                </div>
				 <?php 
                    if($home_banner_15_element_job_tags=='yes' && (!empty($job_listing_tag) && taxonomy_exists( 'job_listing_tag' ))){ ?>
                    <div class="twm-bnr-popular-search">
                        <?php if(!empty($home_banner_15_element_job_tags_title)){ ?>
                            <span class="twm-title">
                                <?php echo wp_kses($home_banner_15_element_job_tags_title,'string'); ?>
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
			    
				if(!empty($home_banner_15_element_item)){
					$item_arr = $home_banner_15_element_item;
				?>
				<div class=" twm-bnr-hpage-15-counter">
					<div class="row d-flex justify-content-center">
					<?php foreach($item_arr as $itemKey => $itemValue) { 
						$color = $itemValue['home_banner_15_element_item_icon_bg_color'];
					?>
						
						<div class="col-lg-4 col-md-4 mt-3">
							<div class="counter-outer-two">
								<?php if(!empty($itemValue['home_banner_15_element_item_icon']['value'])){ ?>
								<div class="twm-media" <?php if(!empty($color)){ ?> style=" background-color:<?php echo esc_attr($color); ?>;" <?php } ?>>
									<div class="<?php echo esc_attr($itemValue['home_banner_15_element_item_icon']['value']); ?>"></div>
								</div>
								<?php }
								if(!empty($itemValue['home_banner_15_element_item_title']) || !empty($itemValue['home_banner_15_element_item_number']) || !empty($itemValue['home_banner_15_element_item_prefix'])){ ?>
								<div class="icon-content">
									<?php if(!empty($itemValue['home_banner_15_element_item_prefix']) ||!empty($itemValue['home_banner_15_element_item_number'])){ ?>
									<div class="tw-count-number">
										<span class="counter">
										<?php echo esc_html($itemValue['home_banner_15_element_item_number']); ?>
											</span><?php echo esc_html($itemValue['home_banner_15_element_item_prefix']); ?>
									</div>
									<?php } 
									 if(!empty($itemValue['home_banner_15_element_item_title'])){ ?>	
										<p class="icon-content-info">
											<?php echo esc_html($itemValue['home_banner_15_element_item_title']); ?> 
										</p>
									<?php } ?>
								</div>
								<?php } ?>
							</div>
						</div>
					<?php } ?>
					
				</div>
				<?php } ?>


			</div>
		</div>

	</div>
</div>
<!--Banner End-->