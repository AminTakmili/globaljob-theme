<?php
    $category_arr = array();

    if(!empty($job_region_element_posts_in_categories)){     
        $hide_empty_job_city = ($job_region_element_hide_empty=='yes')?true:false;

        $category_arr = get_terms( array(
          'taxonomy'    => 'job_listing_region',
          'include'     => $job_region_element_posts_in_categories,
          'hide_empty'  => $hide_empty_job_city, /* Not return that didn't have any post in it's category */
          'orderby'     => 'include',
          'order'       => $job_region_element_order, 
          'number'       => $job_region_element_no_of_posts, 
        ) ); 
    }
	$btn_link = $anchor_attribute = '';
    if (!empty($job_region_element_btn_link))
    {
        $btn_link = !empty($job_region_element_btn_link)?$job_region_element_btn_link:'';
        $anchor_attribute = jobzilla_elementor_get_anchor_attribute($btn_link);
    }
	
	$style = !empty($job_region_element_style)? $job_region_element_style: 'style_1';
	if($style == 'style_1'){ 
?> 
<!-- FEATURED SECTION START -->
<div class="section-full content-inner site-bg-white twm-featured-city-area">            
    <div class="container">
        <?php if (!empty($job_region_element_title) || !empty($job_region_element_subtitle)) { ?>
            <!-- TITLE START-->
            <div class="section-head center wt-small-separator-outer">
                <?php if (!empty($job_region_element_subtitle)) { ?>
                    <div class="wt-small-separator site-text-primary">
                        <?php echo wp_kses($job_region_element_subtitle,'string'); ?>
                    </div>
                <?php } ?>   

                <?php if (!empty($job_region_element_title)) { ?>
                    <h2 class="wt-title">
                        <?php echo wp_kses($job_region_element_title,'string'); ?>
                    </h2> 
                <?php } ?>           
            </div>                  
            <!-- TITLE END-->
        <?php } ?>
		
		<?php if(!empty($category_arr)){ ?>
			<div class="twm-featured-city-section">
				<div class="row">
					<?php
						$count = 1;
						$output='';
						foreach($category_arr as $key => $category_data){
							$cat_id = $category_data->term_id;
							$image_id = get_term_meta ( $cat_id, 'job-category-image-id', true );
							$jobs_count = !empty($category_data->count)?$category_data->count.' Jobs':'';
							if($count == 1){

							$output .= '<div class="col-xl-8 col-lg-8 col-md-12">
											<div class="twm-featured-city twm-large-block">
												<div class="twm-media">
													' . wp_get_attachment_image ( $image_id, 'jobzilla_1000x815' ) . '
													<div class="twm-city-info">
													<div class="twm-city-jobs">'.esc_html($jobs_count).'</div>
														<h4 class="twm-title">
															<a href="'.esc_url(get_term_link($cat_id, 'job_listing_region')).'">'.esc_html($category_data->name).'</a>
														</h4>
													</div>
												</div>                                           
											</div>
										</div>';
						}else if($count == 2) {
							$output .= '<div class="col-xl-4 col-lg-4 col-md-12">
											<div class="row">
												<div class="col-lg-12 col-sm-6">                                           
													<div class="twm-featured-city">
														<div class="twm-media">
															' . wp_get_attachment_image ( $image_id, 'medium' ) . '
															<div class="twm-city-info">
															<div class="twm-city-jobs">'.esc_html($jobs_count).'</div>
																<h4 class="twm-title">
																	<a href="'.esc_url(get_term_link($cat_id, 'job_listing_region')).'">'.esc_html($category_data->name).'</a>
																</h4>
															</div>
														</div>                                           
													</div>
												</div>';
							
						}else {							
							if($count == 3){
								$output .='<div class="col-lg-12 col-sm-6">                                           
										<div class="twm-featured-city">
											<div class="twm-media">
												' . wp_get_attachment_image ( $image_id, 'medium' ) . '
												<div class="twm-city-info">
												<div class="twm-city-jobs">'.esc_html($jobs_count).'</div>
													<h4 class="twm-title">
														<a href="'.esc_url(get_term_link($cat_id, 'job_listing_region')).'">'.esc_html($category_data->name).'</a>
													</h4>
												</div>
											</div>                                           
										</div>
									</div>
								</div>
							</div>';
											
						   } elseif($count >= 4){
								$output .='<div class="col-lg-4 col-md-12">                                           
										<div class="twm-featured-city">
											<div class="twm-media">
												' . wp_get_attachment_image ( $image_id, 'medium' ) . '
												<div class="twm-city-info">
												<div class="twm-city-jobs">'.esc_html($jobs_count).'</div>
													<h4 class="twm-title">
														<a href="'.esc_url(get_term_link($cat_id, 'job_listing_region')).'">'.esc_html($category_data->name).'</a>
													</h4>
												</div>
											</div>                                           
										</div>
									</div>';
						   }                       
										
						} 

					?> 
					<?php                   
						++$count;                    
					} 
					echo wp_kses($output,jobzilla_allowed_html_tag());
					
					?> 
				</div>
			</div>
		<?php } ?>
    </div>
</div>   
<!-- FEATURED SECTION END -->
<?php }elseif($style == 'style_2'){ 
	$col = array(
	      1 => 'col-xl-4 col-lg-4 col-md-6 col-sm-6',
	      2 => 'col-xl-3 col-lg-4 col-md-6 col-sm-6',
	      3 => 'col-xl-5 col-lg-4 col-md-6 col-sm-6',
	      4 => 'col-xl-4 col-lg-4 col-md-6 col-sm-6',
	      5 => 'col-xl-5 col-lg-4 col-md-6 col-sm-6',
	      6 => 'col-xl-3 col-lg-4 col-md-6 col-sm-6',
	);

?>
 <!-- FEATURED Cities SECTION START -->
<div class="section-full content-inner-2 pos-relative site-bg-white twm-featured-city-area">
	<div class="twm-bg-section-box"></div>
	<div class="container">

		<!-- TITLE START-->
		<div class="wt-separator-two-part content-white">
			<div class="row wt-separator-two-part-row section-head">
				<div class="col-xl-7 col-lg-7 col-md-12 wt-separator-two-part-left">
					<!-- TITLE START-->
					 <?php if (!empty($job_region_element_title) || !empty($job_region_element_subtitle)) { ?>
						<!-- TITLE START-->
						<div class="mb-4 mb-lg-0 left wt-small-separator-outer">
							<?php if (!empty($job_region_element_subtitle)) { ?>
								<div class="wt-small-separator site-text-primary">
									<?php echo wp_kses($job_region_element_subtitle,'string'); ?>
								</div>
							<?php } ?>   

							<?php if (!empty($job_region_element_title)) { ?>
								<h2 class="wt-title">
									<?php echo wp_kses($job_region_element_title,'string'); ?>
								</h2> 
							<?php } ?>           
						</div>                  
						<!-- TITLE END-->
					<?php } ?>
					
				</div>
				<div class="col-xl-5 col-lg-5 col-md-12 wt-separator-two-part-right text-right">
					<?php if(!empty($job_region_element_btn_text) && !empty($btn_link)){ ?>
					<a href="<?php echo esc_url($btn_link); ?>" <?php echo esc_attr($anchor_attribute); ?> class=" site-button white"><?php echo esc_html($job_region_element_btn_text); ?></a>
					<?php } ?>
				</div>
			</div>
		</div>                
		<!-- TITLE END-->

		<div class="twm-featured-city2-section">
			<div class="row">
			<?php 
				$count = 1;
				foreach($category_arr as $key => $category_data){
					if($count == 7){
						$count = 1;
					}
					$cat_id = $category_data->term_id;
					$image_id = get_term_meta ( $cat_id, 'job-category-image-id', true );
					$jobs_count = !empty($category_data->count)?$category_data->count.' Jobs':'';
				?>
				<div class="<?php echo esc_attr($col[$count]); ?>">
					<div class="twm-featured-city2">
							
						<div class="twm-media" style="background-image:url(<?php echo wp_get_attachment_image_url ( $image_id, 'jobzilla_1000x815' ); ?> );">
						</div>
						<div class="twm-city-info">
							<h6 class="twm-title"><a href="<?php echo esc_url(get_term_link($cat_id, 'job_listing_region')); ?>"><?php echo esc_html(esc_html($category_data->name)); ?></a></h6>
							<div class="twm-city-jobs"><?php echo esc_html($jobs_count); ?></div>
						</div>
					</div>
				</div>
				<?php $count++;
				} ?>
			</div>
		</div>                  
	</div>
</div>   
<!-- FEATURED SECTION END -->
<?php }