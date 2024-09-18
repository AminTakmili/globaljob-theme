<?php 
	if($home_banner_4_element_job_tags=='yes'){ 
		$job_listing_tag = array();
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
	$allowed_html_tags = jobzilla_allowed_html_tag(); 
?>
<div class="twm-home4-banner-section site-bg-light-purple" >
	<div class="row">        
		<!--Left Section-->
		<div class="col-xl-6 col-lg-6 col-md-12">
			<div class="twm-bnr-left-section">
				<?php if (!empty($home_banner_4_element_title)) { ?>
					<div class="twm-bnr-title-large">
						<?php echo wp_kses($home_banner_4_element_title,$allowed_html_tags); ?>
					</div>
				<?php } ?>

				<?php if (!empty($home_banner_4_element_description)) { ?>
					<div class="twm-bnr-discription">
						<?php echo wp_kses($home_banner_4_element_description,'string'); ?>
					</div>
				<?php } ?>

				<div class="twm-bnr-search-bar">
				<form method="get" id="KeywordsForm" action="<?php echo home_url(jobzilla_get_opt('jobzilla_job_filter_page')); ?>">
                        <div class="row">
                            <?php if($home_banner_4_element_search_job_title == 'yes' ){ ?>
                                <!--Title-->
								<div class="form-group col-xl-8 col-lg-8 col-md-8">
									<label><?php echo esc_html__('What','jobzilla') ?></label>
									<select required name="search_keywords" class="wt-search-bar-select selectpicker"  data-live-search="true" id="j-search_keywords" data-bv-field="size">								
										<option disabled selected>
											<?php echo esc_html__('Select Title','jobzilla') ?>
										</option>
										<?php 
										if( !empty($posts)){
										foreach($posts as $post){
											?>
                                            <option value="<?php echo esc_attr($post->post_title); ?>">
                                                <?php echo esc_html($post->post_title); ?>
                                            </option>                                                  
                                        <?php }
										} ?>
									</select>
                                      
								</div>
                            <?php } 
							if(!empty($home_banner_4_element_search_btn)){ ?>
								<!--Find job btn-->
								<div class="form-group col-xl-4 col-lg-4 col-md-4">
									<button type="submit" class="site-button">
										<?php echo esc_html($home_banner_4_element_search_btn); ?>
									</button>
								</div>
							<?php } ?>
                        </div>
                    </form>
                </div>

				<?php 
					if($home_banner_4_element_job_tags=='yes' && (!empty($job_listing_tag) && taxonomy_exists( 'job_listing_tag' ))){ ?>
						<div class="twm-bnr-popular-search">
							<?php if(!empty($home_banner_4_element_job_tags_title)){ ?>
								<span class="twm-title">
									<?php echo wp_kses($home_banner_4_element_job_tags_title,'string'); ?>
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
		<div class="col-xl-6 col-lg-6 col-md-12">
			<div class="twm-bnr-right-section anm" data-wow-delay="1000ms" data-speed-x="2" data-speed-y="2">
				<div class="twm-graphics-h3 twm-bg-line">
					<img src="<?php echo esc_url(JOBZILLA_URL.'assets/images/home-4/banner/bg-line.png'); ?>" alt="<?php echo esc_attr__('Image','jobzilla'); ?>">
				</div>

				<div class="twm-graphics-user twm-user">
					<img src="<?php echo esc_url(JOBZILLA_URL.'assets/images/home-4/banner/user.png'); ?>" alt="<?php echo esc_attr__('Image','jobzilla'); ?>">
				</div>

				<div class="twm-graphics-h3 twm-bg-plate">
					<img src="<?php echo esc_url(JOBZILLA_URL.'assets/images/home-4/banner/bg-plate.png'); ?>" alt="<?php echo esc_attr__('Image','jobzilla'); ?>">
				</div>

				<div class="twm-graphics-h3 twm-checked-plate">
					<img src="<?php echo esc_url(JOBZILLA_URL.'assets/images/home-4/banner/checked-plate.png'); ?>" alt="<?php echo esc_attr__('Image','jobzilla'); ?>">
				</div>

				<div class="twm-graphics-h3 twm-blue-block">
					<img src="<?php echo esc_url(JOBZILLA_URL.'assets/images/home-4/banner/blue-block.png'); ?>" alt="<?php echo esc_attr__('Image','jobzilla'); ?>">
				</div>

				<div class="twm-graphics-h3 twm-color-dotts">
					<img src="<?php echo esc_url(JOBZILLA_URL.'assets/images/home-4/banner/color-dotts.png'); ?>" alt="<?php echo esc_attr__('Image','jobzilla'); ?>">
				</div>

				<div class="twm-graphics-h3 twm-card-large anm" data-speed-y="-2" data-speed-scale="-15" data-speed-opacity="50">
					<img src="<?php echo esc_url(JOBZILLA_URL.'assets/images/home-4/banner/card.png'); ?>" alt="<?php echo esc_attr__('Image','jobzilla'); ?>">
				</div>

				<div class="twm-graphics-h3 twm-card-s1 anm" data-speed-y="2" data-speed-scale="15" data-speed-opacity="50">
					<img src="<?php echo esc_url(JOBZILLA_URL.'assets/images/home-4/banner/card-s1.png'); ?>" alt="<?php echo esc_attr__('Image','jobzilla'); ?>">
				</div>

				<div class="twm-graphics-h3 twm-card-s2 anm" data-speed-x="-4" data-speed-scale="-25" data-speed-opacity="50">
					<img src="<?php echo esc_url(JOBZILLA_URL.'assets/images/home-4/banner/card-s2.png'); ?>" alt="<?php echo esc_attr__('Image','jobzilla'); ?>">
				</div>

				<div class="twm-graphics-h3 twm-white-dotts">
					<img src="<?php echo esc_url(JOBZILLA_URL.'assets/images/home-4/banner/white-dotts.png'); ?>" alt="<?php echo esc_attr__('Image','jobzilla'); ?>">
				</div>

				<div class="twm-graphics-h3 twm-top-shadow anm" data-speed-x="-16" data-speed-y="2" data-speed-scale="50" data-speed-rotate="25">
					<img src="<?php echo esc_url(JOBZILLA_URL.'assets/images/home-4/banner/top-shadow.png'); ?>" alt="<?php echo esc_attr__('Image','jobzilla'); ?>">
				</div>

				<div class="twm-graphics-h3 twm-bottom-shadow anm" data-speed-x="16" data-speed-y="2" data-speed-scale="20" data-speed-rotate="25">
					<img src="<?php echo esc_url(JOBZILLA_URL.'assets/images/home-4/banner/bottom-shadow.png'); ?>" alt="<?php echo esc_attr__('Image','jobzilla'); ?>">
				</div> 
			</div>
		</div>
	</div>
</div>