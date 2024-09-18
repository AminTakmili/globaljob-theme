<?php
	$title_selected = $cat_selected = $loc_selected = $region_selected = '';
	
	if($job_search_form_2_element_search_job_title == 'yes'){ 
		$args = array(
			'post_type' 	=> 'job_listing',
			'post_status' 	=> 'publish',
			'orderby'		=>'title',
			'order'			=>'ASC',
			'ignore_sticky_posts' => true,
		);
		$job_listing_query = new WP_Query($args);
	} 

	if($job_search_form_2_element_search_job_type=='yes'){ 
										
		$category_arr = array();
		$category_arr = get_terms( 
							array(
								'taxonomy' => 'job_listing_category',
								'hide_empty'  => false, /* Not return that didn't have any post in it's category */
							) 
						);
	}

	$bg_img = $job_search_form_2_element_bg_img;
	$posts = jobzilla_get_cpt_data('job_listing');
	
	
?>

<!--Banner Start-->
<div class="twm-home3-banner-section site-bg-white bg-cover " <?php if(!empty($bg_img['id'])){ ?> style=" background-image:url(<?php echo esc_url($bg_img['url']); ?>)" <?php } ?>>
    <div class="twm-home3-inner-section">
        <div class="twm-bnr-mid-section">
            <?php if (!empty($job_search_form_2_element_title)) { ?>
                <div class=" twm-bnr-title-light">
                    <?php echo wp_kses($job_search_form_2_element_title,'string'); ?>
                </div>
            <?php } ?>
            <div class="twm-bnr-search-bar">
                <form  method="get">
                    <div class="row">
                         <?php if($job_search_form_2_element_search_job_title=='yes'){ ?>
                               <div class="form-group col-xl-3 col-lg-3 col-md-3">
									<label><?php echo esc_html__('What','jobzilla') ?></label>
									<select name="search_keywords" class="wt-search-bar-select selectpicker "  data-live-search="true" id="j-search_keywords" data-bv-field="size">								
										<option disabled selected>
											<?php echo esc_html__('Select Title','jobzilla') ?>
										</option>
										<?php 
										if(!empty($posts)){
										foreach($posts as $post){
											 
											$title_selected = !empty($_GET['search_keywords']) && ($post->post_title == $_GET['search_keywords']) ? 'selected' : '';
											?>
                                            <option <?php echo esc_attr($title_selected ); ?> value="<?php echo esc_attr($post->post_title); ?>">
                                                <?php echo esc_html($post->post_title); ?>
                                            </option>                                                  
                                        <?php } 
										} ?>
									</select>
                                      
								</div>
                            <?php } ?>

                            <?php if($job_search_form_2_element_search_job_type=='yes'){ ?>
								<div class="form-group col-xl-3 col-lg-3 col-md-3">
									<label>
										<?php echo esc_html__('Category','jobzilla') ?>
									</label>
									<select name="search_category" class=" wt-search-bar-select selectpicker"  data-live-search="true" id="j-All_Category" data-bv-field="size">
										<option disabled selected >
											<?php echo esc_html__('Select Category','jobzilla') ?>
										</option>
										<?php if(!empty($category_arr)){ ?>
										<option><?php echo esc_html__('All Category','jobzilla'); ?></option>
										
										<?php foreach($category_arr as $type){
											$cat_selected = !empty($_GET['search_category']) && ($type->slug == $_GET['search_category']) ? 'selected' :'';
											?>
                                            <option <?php echo esc_attr($cat_selected ); ?>  value="<?php echo esc_attr($type->slug); ?>">
                                                <?php echo esc_html($type->name); ?>
                                            </option>                                                  
                                        <?php } 
										} ?>
									</select>
								</div>
                            <?php } ?>

                        <?php 
						if(get_option( 'job_manager_regions_filter')){
								 $posts = get_terms( array(
								  'taxonomy'    => 'job_listing_region',
								  'include'     => '',
								  'hide_empty'  => true,
								  'orderby'     => 'include',
								  'order'       => 'ASC', 
								) ); 
							 if($job_search_form_2_element_search_job_location == 'yes'){ ?>
                                <!--Location-->
                                <div class="form-group col-xl-3 col-lg-3 col-md-3">
                                    <label><?php echo esc_html__('Regions', 'jobzilla') ?></label>
									<select name="search_region" class="wt-search-bar-select selectpicker"  data-live-search="true" id="j-search_region" data-bv-field="size">
										<option disabled selected>
											<?php echo esc_html__('Select Regions', 'jobzilla') ?>
										</option>
										<?php if(!empty($posts)){ ?>
										<option><?php echo esc_html__('All Regions', 'jobzilla'); ?></option>
										<?php foreach($posts as $post){ 
											$region_selected = !empty($_GET['search_region']) && ($post->slug == $_GET['search_region']) ? 'selected' : '';
										?>
                                            <option <?php echo esc_attr($region_selected ); ?> value="<?php echo esc_attr($post->slug); ?>">
                                                <?php echo esc_html($post->name); ?>
                                            </option>                                                  
                                        <?php } 
										} ?>
									</select>
                                    
                                </div>
						<?php }
						}else{ 	
							if($job_search_form_2_element_search_job_location == 'yes'){ 
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
						}?>
						
						<?php if(!empty($job_search_form_2_element_search_btn)){ ?>
							<!--Find job btn-->
							<div class="form-group col-xl-3 col-lg-3 col-md-3">
								<button type="submit" class="site-button">
									<?php echo esc_html($job_search_form_2_element_search_btn); ?>
								</button>
							</div>
						<?php } ?>
                    </div>
                </form>
            </div>

        </div>
    </div>    
</div>
<!--Banner End-->