<?php
	$btn_link = $btn_text = $anchor_attribute = '';
    if (!empty($job_category_listing_element_link_title))
    {
        $btn_link = !empty($job_category_listing_element_link)?$job_category_listing_element_link:'';
        $btn_text = !empty($job_category_listing_element_link_title)?$job_category_listing_element_link_title:'';
        
        $anchor_attribute = jobzilla_elementor_get_anchor_attribute($btn_link);
    }
	$category_arr = array();
	
	if(!empty($job_category_listing_element_posts_in_categories)){     
		$hide_empty_job_category = ($job_category_listing_element_hide_empty=='yes')? true : false ;

		$category_arr = get_terms( array(
		  'taxonomy'    => 'job_listing_category',
		  'include'     => $job_category_listing_element_posts_in_categories,
		  'hide_empty'  => $hide_empty_job_category, /* Not return that didn't have any post in it's category */
		   'number' => $job_category_listing_element_no_of_posts,
		  'orderby'     => 'include',
		  'order'       => $job_category_listing_element_order, 
		) ); 
	}
						
	$allowed_html_tags = jobzilla_allowed_html_tag();
    if($job_category_listing_element_style == 'style_1'){
?>

<!-- JOBS CATEGORIES SECTION START -->
<div class="section-full content-inner site-bg-gray twm-job-categories-area2">
    <?php if (!empty($job_category_listing_element_title) || !empty($job_category_listing_element_subtitle)) { 
    ?>
        <!-- TITLE START-->
        <div class="section-head center wt-small-separator-outer">
            <?php if (!empty($job_category_listing_element_subtitle)) { ?>
                <div class="wt-small-separator site-text-primary">
                    <div>
                        <?php echo wp_kses($job_category_listing_element_subtitle,'string'); ?>
                    </div>                                
                </div>
            <?php } ?>

            <?php if (!empty($job_category_listing_element_title)) { ?>
                <h2 class="wt-title">
                    <?php echo wp_kses($job_category_listing_element_title,'string'); ?>
                </h2>
            <?php } ?>
        </div>                  
        <!-- TITLE END--> 
    <?php } 
	if(!empty($category_arr)){ ?>
    <div class="container">
        <div class="twm-job-categories-section-2">
            <div class="job-categories-style1 m-b30">
                <div class="row">                
                    <?php
                        foreach($category_arr as $key => $category_data){
                            $cat_id = $category_data->term_id;
                            $icon_id = get_term_meta ( $cat_id, 'job-category-icon', true );
                            $jobs_count = !empty($category_data->count)?$category_data->count.' Jobs':'';
                    ?> 
                        <div class="col-lg-3 col-sm-6">
                            <div class="job-categories-block-2 m-b30">
								<?php if(!empty($icon_id )){ ?>
                                <div class="twm-media">
                                   <div class="<?php echo esc_attr($icon_id); ?>"></div>
                                </div>   
                                <?php } ?>
                                <div class="twm-content">
									<?php if(!empty($jobs_count)){ ?>
                                    <div class="twm-jobs-available">
                                        <?php echo esc_html($jobs_count) ?>
                                    </div>
									<?php } ?>
                                    <a href="<?php echo esc_url(get_term_link($cat_id, 'job_listing_category')) ?>"><?php echo esc_html($category_data->name) ?></a>
                                </div>                               
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
			
            <?php if(!empty($btn_text)) { ?>
                <div class="text-center job-categories-btn">
                    <a href="<?php echo esc_url($btn_link['url']); ?>" <?php echo esc_attr($anchor_attribute); ?> class=" site-button"><?php echo esc_html($btn_text); ?></a>
                </div>
            <?php }  ?>
        </div>
    </div>
	<?php } ?>
</div>   
<!-- JOBS CATEGORIES SECTION END -->

<?php } elseif($job_category_listing_element_style=='style_2'){ ?>

    <div class="section-full content-inner site-bg-white twm-job-categories-area3">
        <div class="container">
            <div class="wt-separator-two-part">
                <div class="row wt-separator-two-part-row section-head">
                    <?php if (!empty($job_category_listing_element_title) || !empty($job_category_listing_element_subtitle)) {  ?>
                        <div class="col-xl-6 col-lg-6 col-md-12 wt-separator-two-part-left">
                            <!-- TITLE START-->
                            <div class="wt-small-separator-outer mb-3">
                                <?php if (!empty($job_category_listing_element_subtitle)) { ?>
                                    <div class="wt-small-separator site-text-primary">
                                        <div>
                                            <?php echo wp_kses($job_category_listing_element_subtitle,'string'); ?>
                                        </div>                                
                                    </div>
                                <?php } ?>

                                <?php if (!empty($job_category_listing_element_title)) { ?>
                                    <h2 class="wt-title">
                                        <?php echo wp_kses($job_category_listing_element_title,'string'); ?>
                                    </h2>
                                <?php } ?>
                            </div>                  
                            <!-- TITLE END-->
                        </div>
                    <?php } ?>

                    <?php if(!empty($btn_text)) { ?>
                        <div class="col-xl-6 col-lg-6 col-md-12 wt-separator-two-part-right text-right">
                            <a href="<?php echo esc_url($btn_link['url']); ?>" <?php echo esc_attr($anchor_attribute); ?> class=" site-button"><?php echo esc_html($btn_text); ?></a>
                        </div>
                    <?php } ?>
                </div>
            </div>
			<?php if(!empty($category_arr)){ ?>
            <div class="twm-job-categories-section-3">
                <div class="job-categories-style3">
                    <div class="row">
                        <?php
                            foreach($category_arr as $key => $category_data){
                                $cat_id = $category_data->term_id;
                                $icon_id = get_term_meta ( $cat_id, 'job-category-icon', true );
                                $jobs_count = !empty($category_data->count)? $category_data->count.' Jobs':'';
                        ?>
                            <div class="col-xl-2 col-lg-4 col-md-4 col-6 m-b30">
                                <div class="job-categories-3-wrap">
                                    <div class="job-categories-3">
                                       <?php if(!empty($icon_id )){ ?>
										<div class="twm-media">
										   <div class="<?php echo esc_attr($icon_id); ?>"></div>
										</div>   
										<?php } ?>  
                                        <div class="twm-content">
                                            <div class="twm-jobs-available">
												<?php echo esc_html($jobs_count); ?>
											</div>
											
                                            <a href="<?php echo esc_url(get_term_link($cat_id, 'job_listing_category')) ?>">
												<?php echo esc_html($category_data->name) ?>
											</a>
                                        </div>                               
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
			<?php } ?>
        </div>
    </div>
<?php }else if($job_category_listing_element_style=='style_3'){  ?>
<!-- JOBS CATEGORIES SECTION START -->
<div class="section-full content-inner site-bg-white twm-job-categories-hpage-6-area">
	<!-- TITLE START-->
	<div class="section-head center wt-small-separator-outer">
		<?php if (!empty($job_category_listing_element_title) || !empty($job_category_listing_element_subtitle)) {
		if(!empty($job_category_listing_element_subtitle)) {	?>
		<div class="wt-small-separator site-text-primary">
		   <div> <?php echo wp_kses($job_category_listing_element_subtitle,'string'); ?></div>                                
		</div>
		<?php } 
		if(!empty($job_category_listing_element_title)){ ?>
		<h2 class="wt-title"><?php echo wp_kses($job_category_listing_element_title,'string'); ?></h2>
		<?php } 
		} ?>
	</div>                  
	<!-- TITLE END--> 
	<?php if(!empty($category_arr)){ ?>
	<div class="container">
		<div class="twm-job-cat-hpage-6-wrap">
			<div class="job-cat-block-hpage-6-section">
				<div class="row">
				    <?php
						foreach($category_arr as $key => $category_data){
							$cat_id = $category_data->term_id;
							$icon_id = get_term_meta ( $cat_id, 'job-category-icon', true );
							$jobs_count = !empty($category_data->count)?'<span>'.$category_data->count.'</span>'.' Posted new jobs':'';
					?>
					<!-- COLUMNS 1 --> 
					<div class="col">
						<div class="job-cat-block-hpage-6 m-b30">
							<?php if(!empty($icon_id )){ ?>
							<div class="twm-media">
								<div class="<?php echo esc_attr($icon_id); ?>"></div>
							</div>                         
							<?php } ?>
							<div class="twm-content">
								<a href="<?php echo esc_url(get_term_link($cat_id, 'job_listing_category')) ?>"><?php echo esc_html($category_data->name) ?></a>
								<div class="twm-jobs-available"><?php echo wp_kses($jobs_count,$allowed_html_tags ); ?></div>
								<div class="circle-line-wrap">
									<a class="circle-line-btn" href="<?php echo esc_url(get_term_link($cat_id, 'job_listing_category')) ?>" ><i class="fa fa-arrow-right"></i></a>
								</div>
							</div>                               
						</div>
					</div>
					<?php } ?>
				</div>
			</div>
			<?php if(!empty($btn_text) && !empty($btn_link['url'])) { ?>
			<div class="text-center job-categories-btn">
				<a href="<?php echo esc_url($btn_link['url']); ?>" class=" site-button"><?php echo esc_html($btn_text); ?></a>
			</div>
			<?php } ?>
		</div>
	</div>
	<?php } ?>
</div>   
<!-- JOBS CATEGORIES SECTION END -->
<?php } ?>