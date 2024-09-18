<?php 
	$job_listing_tag = array();
	if($home_banner_9_element_job_tags=='yes'){ 
		$job_listing_tag = get_terms(
								array(
									'taxonomy' 		=> 'job_listing_tag',
									'posts_per_page'=> 5 ,
									'hide_empty'  	=> false, /* Not return that didn't have any post in it's category */
									'orderby'  	 	=> 'DESC'
								) 
							);
	}
	$posts = jobzilla_get_cpt_data('job_listing');
	$bg_img = $home_banner_9_element_bg_img;
	$allowed_html_tags = jobzilla_allowed_html_tag(); 
?>
<!--Banner Start-->
<div class="twm-home-9-banner-section" <?php if(!empty($bg_img['id'])){ ?> style="background-image: url(<?php echo esc_url($bg_img['url']); ?>);" <?php } ?>>
	<div class="container">
		<div class="row">
			<!--Left Section-->
			<div class="col-xl-7 col-lg-12 col-md-12">
				<div class="twm-bnr-left-section">
					<div class="twm-bnr-title-large">
						<?php if(!empty($home_banner_9_element_titlesub)){ ?>
							<?php echo wp_kses($home_banner_9_element_titlesub, $allowed_html_tags); ?>
							<?php } 
							if(!empty($home_banner_9_element_title)){ ?>
							<div><span><?php echo wp_kses($home_banner_9_element_title, 'string'); ?></span> </div>
						<?php } ?>      
					</div> 
					<div class="twm-bnr-search-bar">
						<form method="get" action="<?php echo get_permalink(jobzilla_get_opt('jobzilla_job_filter_page')); ?>">
							<div class="row">
								<?php if($home_banner_9_element_search_job_title == 'yes'){ ?>
									<!--Title-->
									<div class="form-group col-xl-8 col-lg-8 col-md-8">
										<label><?php echo esc_html__('What','jobzilla') ?></label>
										<select name="search_keywords" class="wt-search-bar-select selectpicker"  data-live-search="true" id="j-search_keywords" data-bv-field="size">								
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
								
								<!--Find job btn-->
								<div class="form-group col-xl-4 col-lg-4 col-md-4">
									<button type="submit" class="site-button">
										<?php echo esc_html($home_banner_9_element_search_btn); ?>
									</button>
								</div>
							</div>
						</form>
					</div>
					<?php 
					if($home_banner_9_element_job_tags=='yes' && (!empty($job_listing_tag) && taxonomy_exists( 'job_listing_tag' ))){ ?>
						<div class="twm-bnr-popular-search">
							<?php if(!empty($home_banner_9_element_job_tags_title)){ ?>
								<span class="twm-title">
									<?php echo wp_kses($home_banner_9_element_job_tags_title,'string'); ?>
								</span>
							<?php } ?>

							<?php 
								$count = 1;
								$array_count = count($job_listing_tag);
								foreach($job_listing_tag as $tag){ 
									$tag_name = ($array_count>$count)?$tag->name.' , ':$tag->name;
							?>
									<a href="<?php echo get_tag_link( $tag ) ?>">
										<?php echo esc_html($tag_name); ?>
									</a>
							<?php $count++; } ?>
						</div>
					<?php } ?>
				</div>
			</div>

			<!--right Section-->
			<div class="col-xl-5 col-lg-12 col-md-12 twm-bnr-right-section">
				<div class="twm-bnr-right-content">
				<?php if(!empty($home_banner_9_element_img['id'])){ ?>
					<div class="bnr-media">
					   <img src="<?php echo esc_url($home_banner_9_element_img['url']); ?>" alt="<?php echo esc_attr__('Image', 'jobzilla'); ?>">
					</div>
					<div class="slider-thumb-wrap">
						<div class="slider-thumb"></div>
					</div>
				<?php } ?>   
				</div>
			</div>

		</div>
	</div>
</div>
<!--Banner End-->

