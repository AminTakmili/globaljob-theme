<?php
$category_arr = array();
$job_listing_tag = array();
if($job_search_form_element_title == 'yes'){ 
	$args = array(
		'post_type' 	=> 'job_listing',
		'post_status' 	=> 'publish',
		'orderby'		=>'title',
		'order'			=>'ASC',
		'ignore_sticky_posts' => true,
	);
	$job_listing_query = new WP_Query($args);
}
 

if($job_search_form_element_type=='yes'){ 
                                    
	$category_arr = get_terms( 
						array(
							'taxonomy' => 'job_listing_category',
							'hide_empty'  => false, /* Not return that didn't have any post in it's category */
						) 
					);
}


if($job_search_form_element_job_tags=='yes'){ 
	$job_listing_tag = get_terms(
							array(
								'taxonomy' => 'job_listing_tag',
								'posts_per_page'    => 5 ,
								'hide_empty'  => false, /* Not return that didn't have any post in it's category */
								'orderby'   => 'DESC'
							) 
						);
}
$form_col_classes = !empty($job_search_form_element_partners_item) ? 'col-lg-8 col-md-12':'col-lg-12 col-md-12';
$posts = jobzilla_get_cpt_data('job_listing');
?>

<!--Search Bar-->
<div class="twm-search-bar-2-wrap">
    <div class="container">
        <div class="twm-search-bar-2-inner">
            <div class="row">
                <div class="<?php echo esc_attr($form_col_classes); ?>">
                    <div class="twm-bnr-search-bar">
                        <form method="get" action="<?php echo home_url(jobzilla_get_opt('jobzilla_job_filter_page')); ?>">
                            <div class="row">							
								<?php if($job_search_form_element_title=='yes'){ ?>
									<div class="form-group col-xl-3 col-lg-6 col-md-3">
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

								<?php if($job_search_form_element_type=='yes'){ ?>
									<!--All Category-->
									<div class="form-group col-xl-3 col-lg-6 col-md-6">
										<label>
											<?php echo esc_html__('Type','jobzilla') ?>
										</label>
										<select name="search_category" class="wt-search-bar-select selectpicker"  data-live-search="true" id="j-All_Category" data-bv-field="size">
											<option disabled selected>
												<?php echo esc_html__('Select Category','jobzilla') ?>
											</option>
											<?php if(!empty($category_arr)){ ?>
											<option >
												<?php echo esc_html__('All Category','jobzilla'); ?>
											</option>
											
											<?php foreach($category_arr as $type){ ?>
												<option value="<?php echo esc_attr($type->slug); ?>">
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
							 if($job_search_form_element_location == 'yes'){ ?>
                                <!--Location-->
                                <div class="form-group col-xl-3 col-lg-6 col-md-3">
                                    <label><?php echo esc_html__('Regions', 'jobzilla') ?></label>
									<select name="search_region" class="wt-search-bar-select selectpicker"  data-live-search="true" id="j-search_region" data-bv-field="size">
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
								if($job_search_form_element_location=='yes'){ 
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
							} ?>

                                <!--Find job btn-->
                                <div class="form-group col-lg-3 col-md-6">
                                    <button type="submit" class="site-button">
                                        <?php echo esc_html__('Find Job','jobzilla'); ?>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                
				<?php  
                    if(!empty($job_search_form_element_partners_item)){
                    $item_arr = $job_search_form_element_partners_item;
                ?>  
                    <div class="col-lg-4 col-md-12">
                        <div class="twm-trusted-by-wrap">
                            <div class="twm-trusted-by-title">
                                <?php echo esc_html__('Trusted By :','jobzilla'); ?>
                            </div>
							
                            <div class="owl-carousel trusted-logo owl-btn-vertical-center">
                                <?php foreach($item_arr as $itemKey => $itemValue) {  ?>
                                    <div class="item">
                                        <div class="twm-trusted-logo">
                                            <?php if($job_search_form_element_partners_disable_link == 'yes'){?>
                                                <a href="javascript:void(0);">
                                                    <img src="<?php echo esc_url($itemValue['job_search_form_element_partners_item_image']['url']); ?>" alt="<?php bloginfo('name');?>">
                                                </a>
                                            <?php }else{ ?>
                                                <a href="<?php echo esc_url($itemValue['job_search_form_element_partners_item_link']); ?>">
                                                    <img src="<?php echo esc_url($itemValue['job_search_form_element_partners_item_image']['url']); ?>" alt="<?php bloginfo('name');?>">
                                                </a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                <?php } ?>  
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>

            <?php if($job_search_form_element_job_tags == 'yes' && (!empty($job_listing_tag) && taxonomy_exists( 'job_listing_tag' ))){ ?>
                <div class="twm-bnr-popular-search">
                    <?php if(!empty($job_search_form_element_job_tags_title)){ ?>
                        <span class="twm-title">
                            <?php echo wp_kses($job_search_form_element_job_tags_title,'string'); ?>
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
</div>