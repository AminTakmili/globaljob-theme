<?php
    $region_arr = array();

    if(!empty($job_region_slider_element_posts_in_categories)){     
		$hide_empty_job_category = ($job_region_slider_element_hide_empty=='yes') ? true : false;

        $region_arr = get_terms( array(
          'taxonomy'    => 'job_listing_region',
          'include'     => $job_region_slider_element_posts_in_categories,
          'hide_empty'  => $hide_empty_job_category, /* Not return that didn't have any post in it's category */
          'orderby'     => 'include',
          'number'     => $job_region_slider_element_no_of_posts,
          'order'       => $job_region_slider_element_order, 
        ) ); 
    }

    $btn_link = $btn_text = $anchor_attribute = '';
    if (!empty($job_region_slider_element_link_title))
    {
        $btn_link = !empty($job_region_slider_element_link)?$job_region_slider_element_link:'';
        $btn_text = !empty($job_region_slider_element_link_title)?$job_region_slider_element_link_title:'';
        
        $anchor_attribute = jobzilla_elementor_get_anchor_attribute($btn_link);
    }
	
?>
 <!-- FEATURED Cities SECTION START -->
<div class="section-full content-inner-2 site-bg-white twm-featured-city-carousal-area">
	<div class="container">

		<!-- TITLE START-->
		<div class="wt-separator-two-part ">
			<div class="row section-head  wt-separator-two-part-row">
				<div class="col-xl-5 col-lg-5 col-md-12 wt-separator-two-part-left">
					<!-- TITLE START-->
					 <?php if (!empty($job_region_slider_element_title) || !empty($job_region_slider_element_subtitle)) { ?>
					<div class="left wt-small-separator-outer">
						 <?php if (!empty($job_region_slider_element_subtitle)) { ?>
							<div class="wt-small-separator site-text-primary">
								<div>
									<?php echo wp_kses($job_region_slider_element_subtitle,'string'); ?>
								</div>                                
							</div>
						<?php } ?>

						<?php if (!empty($job_region_slider_element_title)) { ?>
							<h2 class="wt-title">
								<?php echo wp_kses($job_region_slider_element_title,'string'); ?>
							</h2>
						<?php } ?>

					</div>       
					 <?php } ?>
					<!-- TITLE END-->
				</div>
				<?php if(!empty($btn_text)) { ?>
				<div class="col-xl-7 col-lg-7 col-md-12 wt-separator-two-part-right text-right">
					<a href="<?php echo esc_url($btn_link['url']); ?>" <?php echo esc_attr($anchor_attribute); ?> class="site-button">
						<?php echo esc_html($btn_text); ?> <i class="m-l10 fas fa-caret-right"></i>
					</a>
				</div>
				<?php } ?>
			</div>
		</div>                
		<!-- TITLE END-->
  
	</div>

	<?php if(!empty($region_arr)){ ?>
	<div class="twm-featured-city-carousal-wrap">
		<div class="owl-carousel twm-featured-city-carousal">
			<?php
				foreach($region_arr as $key => $region_data){
					$cat_id = $region_data->term_id;
					$img_id = get_term_meta ( $cat_id, 'job-category-image-id', true );
					$jobs_count = !empty($region_data->count)?$region_data->count.' Jobs':'';
			?>
			  <div class="item">
				<div class="twm-featured-city2">
					<?php if(!empty($img_id)){ ?>
					<div class="twm-media" style="background-image:url(<?php echo esc_url(wp_get_attachment_url ( $img_id )); ?>);">
					</div> <?php } ?>
					<div class="twm-city-info">
						<h4 class="twm-title"><a href="<?php echo esc_url(get_term_link($cat_id, 'job_listing_region')) ?>"><?php  echo esc_html($region_data->name); ?></a></h4>
						<?php if(!empty($jobs_count)){ ?> 
							<div class="twm-city-jobs">
								<?php echo esc_html($jobs_count) ?>
							</div>
						<?php } ?>
					</div>
				</div>
			  </div>
			<?php } ?>
		</div>
	</div>
	<?php } ?>
</div>   
<!-- FEATURED SECTION END -->


