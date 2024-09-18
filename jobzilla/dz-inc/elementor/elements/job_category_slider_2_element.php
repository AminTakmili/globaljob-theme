<?php
    $category_arr = array();

    if(!empty($job_category_slider_2_element_posts_in_categories)){     
		$hide_empty_job_category = ($job_category_slider_2_element_hide_empty=='yes') ? true : false;

        $category_arr = get_terms( array(
          'taxonomy'    => 'job_listing_category',
          'include'     => $job_category_slider_2_element_posts_in_categories,
          'hide_empty'  => $hide_empty_job_category, /* Not return that didn't have any post in it's category */
          'orderby'     => 'include',
          'number'     => $job_category_slider_2_element_no_of_posts,
          'order'       => $job_category_slider_2_element_order, 
        ) ); 
    }

   

?>
 <!-- JOBS CATEGORIES SECTION START -->
<div class="section-full twm-job-categories-carousal-area-9">
	<div class="container">
		<?php if(!empty($category_arr)){ ?>
		<div class="twm-job-categories-carousal-section">
			<div class="owl-carousel twm-job-categories-carousal">
				<?php
				foreach($category_arr as $key => $category_data){
					$cat_id = $category_data->term_id;
					$icon_id = get_term_meta ( $cat_id, 'job-category-icon', true );
					$jobs_count = !empty($category_data->count)?$category_data->count.' Jobs':'';
			?>
			   
				<div class="item">
					<div class="job-categories-3-wrap">
						<div class="job-categories-3">
							<?php if(!empty($icon_id)){ ?> 
							<div class="twm-media">
								<div class="<?php echo esc_attr($icon_id); ?>"></div>
							</div>   
						<?php } ?>
							
						<div class="twm-content">
							<?php if(!empty($jobs_count)){ ?> 
								<div class="twm-jobs-available">
									<?php echo esc_html($jobs_count) ?>
								</div>
								<a href="<?php echo esc_url(get_term_link($cat_id, 'job_listing_category')); ?>"><?php  echo esc_html($category_data->name); ?></a>
							<?php } ?>
						</div>                                       
						</div>
					</div>
				</div>
				<?php } ?>
			   
				
			</div>
		</div>
		<?php } ?>
	</div>

</div>   
<!-- JOBS CATEGORIES SECTION END -->
