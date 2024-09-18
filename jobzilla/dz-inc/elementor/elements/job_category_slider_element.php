<?php
    $category_arr = array();

    if(!empty($job_category_slider_element_posts_in_categories)){     
		$hide_empty_job_category = ($job_category_slider_element_hide_empty=='yes') ? true : false;

        $category_arr = get_terms( array(
          'taxonomy'    => 'job_listing_category',
          'include'     => $job_category_slider_element_posts_in_categories,
          'hide_empty'  => $hide_empty_job_category, /* Not return that didn't have any post in it's category */
          'orderby'     => 'include',
          'number'     => $job_category_slider_element_no_of_posts,
          'order'       => $job_category_slider_element_order, 
        ) ); 
    }

    $btn_link = $btn_text = $anchor_attribute = '';
    if (!empty($job_category_slider_element_link_title))
    {
        $btn_link = !empty($job_category_slider_element_link)?$job_category_slider_element_link:'';
        $btn_text = !empty($job_category_slider_element_link_title)?$job_category_slider_element_link_title:'';
        
        $anchor_attribute = jobzilla_elementor_get_anchor_attribute($btn_link);
    }
	$style = !empty($job_category_slider_element_style) ? $job_category_slider_element_style: 'style_1';
	$bg_img = $job_category_slider_element_image;
	$class = array(
				'1' => 'cat-bg-clr-1',
				'2' => 'cat-bg-clr-3',
				'3' => 'cat-bg-clr-2' ,
				'4' => 'cat-bg-clr-4',
			);
	$count = 1;
if($style == 'style_1'){ 
?>

<!-- JOBS CATEGORIES SECTION START -->
<div class="section-full content-inner site-bg-gray twm-job-categories-area">            
    <div class="container">
        <?php if (!empty($job_category_slider_element_title) || !empty($job_category_slider_element_subtitle) || !empty($job_category_slider_element_description)) { ?>
            <div class="wt-separator-two-part">
                <div class="row wt-separator-two-part-row section-head">
                        <?php if (!empty($job_category_slider_element_title) || !empty($job_category_slider_element_subtitle)) { ?>
                            <div class="col-xl-5 col-lg-5 col-md-12 wt-separator-two-part-left">
                                <!-- TITLE START-->
                                <div class="left wt-small-separator-outer">
                                    <?php if (!empty($job_category_slider_element_subtitle)) { ?>
                                        <div class="wt-small-separator site-text-primary">
                                            <div>
                                                <?php echo wp_kses($job_category_slider_element_subtitle,'string'); ?>
                                            </div>                                
                                        </div>
                                    <?php } ?>

                                    <?php if (!empty($job_category_slider_element_title)) { ?>
                                        <h2 class="wt-title">
                                            <?php echo wp_kses($job_category_slider_element_title,'string'); ?>
                                        </h2>
                                    <?php } ?>
                                </div>                  
                                <!-- TITLE END-->
                            </div>
                        <?php } ?>

                        <?php if (!empty($job_category_slider_element_description)) { ?>
                            <div class="col-xl-6 col-lg-6 col-md-12 wt-separator-two-part-right">
                                <p class="mb-0">
                                    <?php echo wp_kses($job_category_slider_element_description,'string'); ?>
                                </p>
                            </div>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>

        <div class="twm-job-categories-section"> 
			<?php if(!empty($category_arr)){ ?>
				<div class="job-categories-style1 m-b30">
					<div class="owl-carousel job-categories-carousel owl-btn-left-bottom ">
						<?php
							foreach($category_arr as $key => $category_data){
								$cat_id = $category_data->term_id;
								$icon_id = get_term_meta ( $cat_id, 'job-category-icon', true );
								$jobs_count = !empty($category_data->count)?$category_data->count.' Jobs':'';
						?>
							<a href="<?php echo esc_url(get_term_link($cat_id, 'job_listing_category')) ?>">
							<div class="item">
								<div class="job-categories-block">
									<?php if(!empty($icon_id)){ ?> 
										<div class="twm-media">
											<div class="<?php echo esc_attr($icon_id); ?>"></div>
										</div>   
									<?php } ?>
										
									<div class="twm-content">
										<h5 class="twm-title"><?php  echo esc_html($category_data->name); ?></h5>
										<?php if(!empty($jobs_count)){ ?> 
											<div class="twm-jobs-available">
												<?php echo esc_html($jobs_count) ?>
											</div>
										<?php } ?>
									</div>                               
								</div>
							</div> 
							</a>
						<?php } ?>
					</div>
				</div>
			<?php } ?>

            <?php if(!empty($btn_text)) { ?>
                <div class="text-right job-categories-btn"> 
                    <a href="<?php echo esc_url($btn_link['url']); ?>" <?php echo esc_attr($anchor_attribute); ?> class="site-button">
                        <?php echo esc_html($btn_text); ?> <i class="m-l10 fas fa-caret-right"></i>
                    </a>
                </div>
            <?php } ?>
        </div>
    </div>
</div>   
<!-- JOBS CATEGORIES SECTION END -->
<?php }elseif($style == 'style_2'){ ?>
<!-- Jobs Category START -->
<div class="section-full content-inner-1 site-bg-white job-categories-home-5-wrap twm-bdr-bottom-1">
	<div class="container">
		<?php if (!empty($job_category_slider_element_title) || !empty($job_category_slider_element_subtitle)) { ?>
			<div class="section-head center wt-small-separator-outer">
				<!-- TITLE START-->
					<?php if (!empty($job_category_slider_element_subtitle)) { ?>
						<div class="wt-small-separator site-text-primary">
							<div>
								<?php echo wp_kses($job_category_slider_element_subtitle,'string'); ?>
							</div>                                
						</div>
					<?php } ?>

					<?php if (!empty($job_category_slider_element_title)) { ?>
						<h2 class="wt-title">
							<?php echo wp_kses($job_category_slider_element_title,'string'); ?>
						</h2>
					<?php } ?>    
				<!-- TITLE END-->
			</div>
		<?php } ?>		
	</div>

	<div class="section-content twm-jobs-grid-h5-section-outer">
		<div class="twm-jobs-grid-h5-section overlay-wraper" <?php if(!empty($bg_img['id'])){ ?> style="background-image: url(<?php echo esc_url($bg_img['url']); ?>);" <?php } ?>>
			<div class="overlay-main site-bg-primary opacity-09"></div>
			
			<?php if(!empty($category_arr)){ ?>
			<div class="category-5-slider-area">
				<div class="swiper-container category-5-slider">
					<div class="swiper-wrapper">
						<?php
						foreach($category_arr as $key => $category_data){
							if($count == 5){
								$count = 1;
							}
							$cat_id = $category_data->term_id;
							$icon_id = get_term_meta ( $cat_id, 'job-category-icon', true );
							$jobs_count = !empty($category_data->count)?$category_data->count.' Jobs Available':'';
						?>
					  <div class="swiper-slide">
						<div class="job-categories-home-5">
							<?php if(!empty($icon_id)){ ?>
							<div class="twm-media <?php echo esc_attr($class[$count]); ?>">
								<div class="<?php echo esc_attr($icon_id); ?>"></div>
							</div> 
							<?php } ?>
							<div class="twm-content">
								<a href="<?php echo esc_url(get_term_link($cat_id, 'job_listing_category')) ?>"><?php  echo esc_html($category_data->name); ?></a>
								<?php if(!empty($jobs_count)){ ?>
								<div class="twm-jobs-available"><?php echo esc_html($jobs_count); ?></div>
								<?php } ?>
							</div>                               
						</div>
					  </div>
					<?php $count++;
					} ?>
					</div>
					<!-- Add Pagination -->
					
				</div>
				<div class="swiper-button-prev"><i class="fas fa-chevron-left"></i></div>
				<div class="swiper-button-next"><i class="fas fa-chevron-right"></i></div>
			</div>
			<?php } ?>
		</div>
	</div>
	
</div>
<!-- Recruiters END -->
<?php }elseif($style == 'style_3'){ ?>
 <!-- Popular category SECTION START -->
<div class="section-full content-inner-2 pb-2 site-bg-white twm-jobatglance-wrap8">
    <div class="container">

        <div class="wt-separator-two-part">
            <div class="row wt-separator-two-part-row section-head">
                <?php if (!empty($job_category_slider_element_title) || !empty($job_category_slider_element_subtitle)) { ?>
                    <div class="col-xl-6 col-lg-6 col-md-8 wt-separator-two-part-left">
                        <!-- TITLE START-->
                            <?php if (!empty($job_category_slider_element_subtitle)) { ?>
                                <div class="wt-small-separator site-text-primary">
                                    <div>
                                        <?php echo wp_kses($job_category_slider_element_subtitle,'string'); ?>
                                    </div>                                
                                </div>
                            <?php } ?>

                            <?php if (!empty($job_category_slider_element_title)) { ?>
                                <h2 class="wt-title">
                                    <?php echo wp_kses($job_category_slider_element_title,'string'); ?>
                                </h2>
                            <?php } ?>    
                        <!-- TITLE END-->
                    </div>
                <?php } ?>    
                <?php if(!empty($btn_text)) { ?>
                    <div class="col-xl-6 col-lg-6 col-md-4 wt-separator-two-part-right text-md-end"> 
                        <a href="<?php echo esc_url($btn_link['url']); ?>" <?php echo esc_attr($anchor_attribute); ?> class="site-button">
                            <?php echo esc_html($btn_text); ?>
                        </a>
                    </div>
                <?php } ?>   
            </div>
        </div>
        <?php if(!empty($category_arr)){ ?>
        <div class="twm-jobatglance-h8">
            <div class="owl-carousel h-page8-jobs-slider">
                <?php
                foreach($category_arr as $key => $category_data){
                    if($count == 5){
                        $count = 1;
                    }
                    $cat_id = $category_data->term_id;
                    $icon_id = get_term_meta ( $cat_id, 'job-category-icon', true );
                    $jobs_count = !empty($category_data->count)?$category_data->count.' Jobs':'';
                ?>
               <div class="item">
                    <div class="job-categories-home-8">
                                
                        <?php if(!empty($icon_id)){ ?>
                        <div class="twm-media cat-bg-clr-3">
                            <div class="<?php echo esc_attr($icon_id); ?>"></div>
                        </div> 
                        <?php } ?>
                        <a href="<?php echo esc_url(get_term_link($cat_id, 'job_listing_category')) ?>"><?php  echo esc_html($category_data->name); ?></a>
                        <div class="twm-content">
                            <?php if(!empty($jobs_count)){ ?>
                            <div class="twm-jobs-available"><?php echo esc_html($jobs_count); ?></div>
                            <?php } ?>
                        </div>                               
                    </div>
                </div>
            <?php } ?>     
            </div>
        </div>
        <?php } ?>
    </div>
    
</div>   
<!-- Popular category SECTION END -->		
<?php }