<?php 

	$category_arr = array();
	if($home_banner_17_element_search_job_type=='yes'){ 
										
		$category_arr = get_terms( 
							array(
								'taxonomy' => 'job_listing_category',
								'hide_empty'  => false, /* Not return that didn't have any post in it's category */
							) 
						);
	}
$posts = jobzilla_get_cpt_data('job_listing');
$allowed_html_tags = jobzilla_allowed_html_tag(); ?>
 <div class="twm-home-17-banner-section">
	<div class="container">
		<div class="row">
			
			<!--Left Section-->
			<?php if(!empty($home_banner_17_element_image['id'])){ ?>
				<div class="col-xl-6 col-lg-6 col-md-12 twm-bnr-left-section">
					<div class="twm-bnr-left-content">
						<div class="bnr-media">
							<img src="<?php echo esc_url($home_banner_17_element_image['url']); ?>" alt="<?php echo esc_attr__('Image','jobzilla'); ?>">
						</div>
						<div class="bnr-bg-circle">
							<span></span>	
						</div>
					</div>
				</div>
			<?php } ?>

			<!--right Section-->
			<div class="col-xl-6 col-lg-6 col-md-12">
				<div class="twm-bnr-right-section">
					<div class="twm-bnr-title-small">
						<div class="bnr-title-bedge">
							<i class="fa fa-check"></i>
						</div>
						<?php if(!empty($home_banner_17_element_subtitle)){ 
							echo wp_kses($home_banner_17_element_subtitle, $allowed_html_tags);
						} ?>
					</div>
					<?php if(!empty($home_banner_17_element_title)){ ?>
					<div class="twm-bnr-title-large">
					   <?php echo wp_kses($home_banner_17_element_title, $allowed_html_tags); ?>
					</div>
					<?php }
						if(!empty($home_banner_17_element_description)){
					?>
					<div class="twm-bnr-discription">
						<?php echo wp_kses($home_banner_17_element_description, $allowed_html_tags); ?>
					</div>
					<?php } ?>
					<div class="twm-bnr-search-bar">
						<form method="get" id="KeywordsForm" action="<?php echo home_url(jobzilla_get_opt('jobzilla_job_filter_page')); ?>">
							<div class="row">
								<!--Title-->

								<!--All Category-->
								 <?php if($home_banner_17_element_search_job_type == 'yes'){ ?>
								<div class="form-group col-xl-4 col-md-4">
									<label><?php echo esc_html__('Category','jobzilla') ?></label>
									<select class="wt-search-bar-select selectpicker"  data-live-search="true" id="j-All_Category" data-bv-field="size">
										<option disabled selected>
											<?php echo esc_html__('Select Category','jobzilla') ?>
										</option>
										<?php 
										if(!empty($category_arr)){ ?>
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
									 if($home_banner_17_element_search_job_location=='yes'){ ?>
										<!--Location-->
										<div class="form-group col-xl-4 col-md-4">
											<label><?php echo esc_html__('Regions', 'jobzilla') ?></label>
											<select name="search_region" class="wt-search-bar-select selectpicker"  data-live-search="true" id="j-search_region" data-bv-field="size">
												<option disabled selected>
													<?php echo esc_html__('Select Regions', 'jobzilla') ?>
												</option>
												<?php 
											if(!empty($posts)){ ?>
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
										if($home_banner_17_element_search_job_location=='yes'){ 
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
									if(!empty($home_banner_17_element_search_btn)){ ?>
									<!--Find job btn-->
									<div class="form-group col-xl-4 col-md-4">
										<button type="submit" class="site-button">
											<?php echo esc_html($home_banner_17_element_search_btn); ?>
										</button>
									</div>
								<?php } ?>
								
							</div>
						</form>
					</div>
				
				</div>
			</div>

		</div>
	</div>
	<!--right verticle text-->
	<?php if(!empty($home_banner_17_element_placeholder_text)){ ?>
	<div class="twm-home-17-v-text-wrap">
		<div class="twm-17-v-text">
			<span><?php echo esc_html($home_banner_17_element_placeholder_text); ?></span>
		</div>
	</div>
	<?php } ?>
</div>