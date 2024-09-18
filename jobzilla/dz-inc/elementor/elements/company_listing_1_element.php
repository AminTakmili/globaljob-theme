<?php
    $query_args = array(
    'post_type' 		=> 'company',
    'post_status' 		=> 'publish',
    'posts_per_page'    => $company_listing_1_element_no_of_posts ,  
    'orderby'			=>$company_listing_1_element_orderby,
    'order'				=>$company_listing_1_element_order,
    'ignore_sticky_posts'=> true,
    );
    
    if(!empty($company_listing_1_element_posts_in_categories) && !empty($company_listing_1_element_posts_in_categories[0]))
    {           

        $company_listing_1_element_posts_in_categories1 = jobzilla_get_cat_id_by_slug($company_listing_1_element_posts_in_categories,'company_category');
        
        $query_args['tax_query'][] = array(
        'taxonomy' 		=> 'company_category',
        'field' 		=> 'id',
        'terms' 		=> $company_listing_1_element_posts_in_categories1,
        'operator' 		=> 'IN'
        ); 
    }

    $btn_link  = $anchor_attribute = '';
    if (!empty($company_listing_1_element_link_title))
    {
        $btn_link = !empty($company_listing_1_element_link)?$company_listing_1_element_link:'';
       
        $anchor_attribute = jobzilla_elementor_get_anchor_attribute($btn_link);
    }
 
	$query = new WP_Query($query_args);
	
 
    if(!empty($query->have_posts())){
    
    ?>  
  
<!-- Recruiters START -->
<div class="section-full content-inner site-bg-white">
	<div class="container">
		<div class="section-head center wt-small-separator-outer">
			<?php if (!empty($company_listing_1_element_subtitle)) { ?>
				<div class="wt-small-separator site-text-primary">
					<?php echo wp_kses($company_listing_1_element_subtitle,'string'); ?>
				</div>
			<?php } ?>
			
			<?php if (!empty($company_listing_1_element_title)) { ?>
				<h2 class="wt-title">
					<?php echo wp_kses($company_listing_1_element_title,'string'); ?>
				</h2>
			<?php } ?>
		</div>            
		<div class="section-content">
			<div class="twm-recruiters5-wrap">
				<div class="twm-column-5 m-b30">
					<ul>
						<?php while($query->have_posts()){ 
							$query->the_post();
							global $post;
							$post_title = jobzilla_trim(get_the_title($post->ID), 5);
							$company_data = jobzilla_get_post_meta($post->ID,'_company_adderss');
							$star_count = '';
							if (function_exists( 'mas_wpjmcr_get_reviews_count' ) ) {
								$star_count = mas_wpjmcr_get_reviews_count( $post->ID  );
							}
							$company_logo = get_the_company_logo($post->ID,  'medium' );
							
						?>
						<li>
							<div class="twm-recruiters5-box">
								<div class="twm-rec-top">
									<div class="twm-rec-media">
										<?php if(!empty($company_logo)){ ?>
										<img src="<?php echo esc_url($company_logo); ?>" alt="<?php echo esc_attr__('company-logo', 'jobzilla'); ?>"> 
										<?php }else{ ?>
										<img class="company_logo" src="<?php echo esc_url(JOBZILLA_URL.'/assets/images/company.png'); ?>" alt="<?php echo esc_attr__('company-logo', 'jobzilla'); ?>">
										<?php } ?>
									</div>
									<?php
									$args = array(
									   'post_type' => 'job_listing',
									   'post_status' => 'publish',
									   'meta_query' => array(
										   array(
											   'key' => '_company_id',
											   'value' => $post->ID,
											   'compare' => 'LIKE',
										   )
									   )
									);
									$jobs = new WP_Query($args);
									$count = count($jobs->posts);
									if(!empty($count)){ 
									if($count > 1){
									?>
										<div class="twm-rec-jobs"><?php echo esc_html(count($jobs->posts).' Jobs'); ?></div>
									<?php }else{ ?>
										<div class="twm-rec-jobs"><?php echo esc_html(count($jobs->posts).' Job'); ?></div>
									<?php } 
									} ?>
								</div>
								<div class="twm-rec-content">
									<h6 class="twm-title">
										<a href="<?php the_permalink(); ?>">
											<?php echo esc_html($post_title ); ?>
										</a>
									</h6>
									<div class="twm-rec-rating-wrap">
										<?php if(function_exists('mas_wpjmcr_reviews_get_stars')){ ?>
										<div class="twm-rec-rating">
											<?php echo mas_wpjmcr_reviews_get_stars( $post->ID ); ?>
										</div>
										<?php }
										if(!empty($star_count)){ ?>
										<div class="twm-rec-rating-count">(<?php echo esc_html($star_count); ?>)</div>
										<?php } ?>
									</div>
									<?php if(!empty($company_data)){ ?>
									<div class="twm-job-address"><i class="feather-map-pin"></i><?php echo esc_html($company_data); ?></div>
									<?php } ?>
								</div>
							</div>
						</li>
						<?php } ?>
					</ul>
				</div>
				<?php if(!empty($company_listing_1_element_link_title) && !empty($btn_link['url'])){ ?>
					<div class="text-center m-b30">
						<a href="<?php echo esc_url($btn_link['url']); ?>" <?php echo esc_attr($anchor_attribute); ?> class=" site-button"><?php echo esc_html($company_listing_1_element_link_title); ?></a>
				    </div>
				<?php } ?>
			</div>
		</div>
	   
	</div>
</div>
<!-- Recruiters END -->				

<?php } ?>   