<?php
    $query_args = array(
    'post_type' 		 => 'job_listing',
    'post_status' 		 => 'publish',
    'posts_per_page'     => $job_listing_2_element_no_of_posts ,  
    'orderby'			 => $job_listing_2_element_orderby,
    'order'				 => $job_listing_2_element_order,
    'ignore_sticky_posts'=> true,
    );
    
    if(!empty($job_listing_2_element_posts_in_categories) && !empty($job_listing_2_element_posts_in_categories[0]))
    {           

        $job_listing_2_element_posts_in_categories1 = jobzilla_get_cat_id_by_slug($job_listing_2_element_posts_in_categories,'job_listing_category');
        
        $query_args['tax_query'][] = array(
        'taxonomy' 		=> 'job_listing_category',
        'field' 		=> 'id',
        'terms' 		=> $job_listing_2_element_posts_in_categories1,
        'operator' 		=> 'IN'
        ); 
    }

   
    $btn_link = !empty($job_listing_2_element_link)? $job_listing_2_element_link:'';
       
     if($job_listing_2_element_cols == 'col_2'){
        $col_classes = 'col-lg-6 col-md-6 ';
    }elseif($job_listing_2_element_cols == 'col_3'){
        $col_classes = 'col-lg-4 col-md-6 ';
    }else{
        $col_classes = 'col-lg-3 col-md-12 ';
    }

	$query = new WP_Query($query_args);

if(!empty($query->have_posts())){
	$style = !empty($job_listing_2_element_style) ? $job_listing_2_element_style :'style_1';
	if($style == 'style_1'){
		$count = 1;
?>  
<!-- Featured Jobs SECTION START -->
<div class="section-full content-inner site-bg-white twm-hpage-6-featured-outer">
	<!-- TITLE START-->
	<div class="section-head center wt-small-separator-outer">
		<?php if(!empty($job_listing_2_element_subtitle)){ ?>
			<div class="wt-small-separator site-text-primary">
			   <div><?php echo wp_kses($job_listing_2_element_subtitle, 'string'); ?></div>                                
			</div>
		<?php } 
		if(!empty($job_listing_2_element_title)){ ?>
			<h2 class="wt-title">
				<?php echo wp_kses($job_listing_2_element_title, 'string'); ?>
			</h2>
		<?php } ?>
	</div>  
	<!-- TITLE END--> 


	<div class="twm-hpage-6-featured-area">
		<?php if(!empty($job_listing_2_element_image['id'])){ ?>
			<div class="twm-hpage-6-featured-bg-warp">
				<div class="twm-media">
					<img src="<?php echo esc_url($job_listing_2_element_image['url']); ?>" alt="Image">
				</div>
			</div>
		<?php } ?>
		
		<div class="container">

			<div class="twm-hpage-6-featured-content-warp m-b30">
				<div class="row">
						<?php
							while($query->have_posts()){
								$query->the_post();
								global $post ; 		
								$post_id = $post->ID;
								$company_id = jobzilla_get_post_meta($post->ID, '_company_id');
								$adderss = jobzilla_get_post_meta($company_id, '_company_adderss');
								$company_logo = get_the_company_logo($company_id,  'medium' ); 
								$company_title = jobzilla_trim(get_the_title($company_id), 5);
								$post_title = jobzilla_trim(get_the_title($post_id), 5);
								$types = wpjm_get_the_job_types( $post );
								$company_data = jobzilla_get_post_meta($post_id,
									array('_company_website',
									'_job_salary',
									'_salary_max',
									'_job_salary_currency',
									'_job_salary_unit',
									)
								);
								if($count == 3){
									echo '<div class="col-lg-4 col-md-12 m-b30"></div>';
								}
							?>
							<div class="col-lg-4 col-md-6 m-b30">
								<div class="hpage-6-featured-block">
									<div class="inner-content">
										<div class="top-content">
											<?php $type = $types[0];
											if(!empty($type)){ ?>
												<span class="job-time">
													<?php  echo esc_html($type->name);  ?>
												</span>
											<?php } ?>
											<span class="job-post-time"><?php echo get_the_jobzilla_publish_date($post); ?></span>
										</div>
										<div class="mid-content">
												<div class="company-logo">
												<?php if(!empty($company_logo)) { ?>  
													<img src="<?php echo esc_url($company_logo); ?>" alt="<?php echo esc_attr__('company-logo', 'jobzilla'); ?>">
												<?php }else{ ?>
													<img class="company_logo" src="<?php echo esc_url(JOBZILLA_URL.'/assets/images/company.png'); ?>" alt="<?php echo esc_attr__('company-logo', 'jobzilla'); ?>">
												<?php } ?>
												</div>
											
											<div class="company-info">
												<a href="<?php the_permalink($company_id); ?>" class="company-name"><?php echo esc_html($company_title); ?></a>
												<?php if(!empty($adderss)){ ?>
													<p class="company-address">
														<?php echo esc_html($adderss); ?>
													</p>
												<?php } ?>
												
											</div>
										</div>
										<div class="bottom-content">
											<h4 class="job-name-title">
												<a href="<?php the_permalink(); ?>">
													<?php echo esc_html($post_title); ?>
												</a>
											</h4>
											<?php if(!empty($company_data['_job_salary_currency']) || !empty($company_data['_job_salary']) || !empty($company_data['_job_salary_unit']) || !empty($company_data['_salary_max'])){ ?>
											<div class="job-payment">
											<?php 
											if ( !empty($company_data['_job_salary']) ) { 
												echo '<span>';	
												if ( !empty($company_data['_job_salary_currency']) ) { echo esc_html($company_data['_job_salary_currency']); 
												} 
												echo esc_html(number_format_i18n($company_data['_job_salary']) ); 
												echo '</span>';	
											} 
											if(!empty($company_data['_salary_max'])) { if ( !empty($company_data['_job_salary']) ) { echo ' - '; } 
											echo '<span>';	
											if ( !empty($company_data['_job_salary_currency']) ) { echo esc_html($company_data['_job_salary_currency']); } 
												
												echo esc_html(number_format_i18n($company_data['_salary_max']));
											} 
											echo '</span>';
											if(!empty($company_data['_job_salary_unit'])){
												echo esc_html('/ '.ucfirst($company_data['_job_salary_unit'])); 
											} ?>
											</div>
											<?php } ?>
										</div>
										<div class="aply-btn-area">
											<a href="<?php the_permalink(); ?>" class="aplybtn">
												<i class="fa fa-check"></i>
											</a>
										</div>
									</div>
								</div>
							</div>
							<?php $count++;
							 } ?>
				</div>
				<?php if(!empty($job_listing_2_element_link_title) && !empty($btn_link)){ ?>
					<div class="text-center job-categories-btn">
						<a href="<?php echo esc_url($btn_link); ?>" class=" site-button"> <?php  echo esc_html($job_listing_2_element_link_title); ?></a>
					</div>
				<?php } ?>
			</div>

		</div>
	</div>

</div>   
<!-- Featured Jobs SECTION END -->
<?php }elseif($style == 'style_2'){ 
$count = 1;
	?>
<!-- Jobs START -->
<div class="section-full content-inner site-bg-white pos-relative twm-bdr-bottom-1">
	<div class="container">
		<!-- TITLE START-->
		<div class="section-head center wt-small-separator-outer">
			<?php if(!empty($job_listing_2_element_subtitle)){ ?>
				<div class="wt-small-separator site-text-primary">
				   <div><?php echo wp_kses($job_listing_2_element_subtitle, 'string'); ?></div>                                
				</div>
			<?php } 
			if(!empty($job_listing_2_element_title)){ ?>
				<h2 class="wt-title">
					<?php echo wp_kses($job_listing_2_element_title, 'string'); ?>
				</h2>
			<?php } ?>
		</div>  
		<!-- TITLE END--> 

		<div class="section-content">
			<div class="twm-jobs-grid-h5-wrap">
				<div class="row">
					<?php
					while($query->have_posts()){
						$query->the_post();
						global $post ; 		
						$post_id = $post->ID;
						$types = wpjm_get_the_job_types( $post );
						$company_data = jobzilla_get_post_meta($post_id,
							array('_company_website',
							'_job_salary',
							'_salary_max',
							'_job_salary_currency',
							'_job_salary_unit',
							)
						);
						$company_id = jobzilla_get_post_meta($post->ID, '_company_id');
						$adderss = jobzilla_get_post_meta($company_id, '_company_adderss');
						$company_logo = get_the_company_logo($company_id,  'medium' ); 	
						$company_title = jobzilla_trim(get_the_title($company_id), 5);
						$post_title = jobzilla_trim(get_the_title($post_id), 5);
						
						$excerpt = get_the_excerpt();
						$content = get_the_content();
						$short_description = jobzilla_short_description($excerpt, $content, 8, '...');
						$types = wpjm_get_the_job_types( $post );
						$category = get_the_terms( $post_id, 'job_listing_category' );
					?>
					<div class="<?php echo esc_attr($col_classes); ?>">
						<div class="twm-jobs-st5  m-b30">
							<?php if(!empty($company_data['_job_salary_currency']) || !empty($company_data['_job_salary']) || !empty($company_data['_job_salary_unit']) || !empty($company_data['_salary_max'])){ ?>
								<div class="twm-jobs-amount">
									<?php echo jobzilla_get_job_salary($company_data); ?> 
								</div>
							<?php } ?>
							<div class="twm-job-st5-top">
								<div class="twm-media">
									<?php if(!empty($company_logo)) { ?>  
											<img src="<?php echo esc_url($company_logo); ?>" alt="<?php echo esc_attr__('company-logo', 'jobzilla'); ?>">
									<?php }else{ ?>
										<img class="company_logo" src="<?php echo esc_url(JOBZILLA_URL.'/assets/images/company.png'); ?>" alt="<?php echo esc_attr__('company-logo', 'jobzilla'); ?>">
									<?php } ?>
								</div>
								<div class="twm-com-info">
									<?php if(!empty($adderss)){ ?>
										<p class="twm-job-address">
											<?php echo esc_html($adderss); ?>
										</p>
									<?php } ?>
									<a href="<?php the_permalink($company_id); ?>" class="twm-job-com-name site-text-primary"><?php echo esc_html($company_title); ?></a>
									
								</div>
							</div>

							<div class="twm-mid-content">
								<a class="twm-job-title" href="<?php the_permalink(); ?>">
									<h6 ><?php echo esc_html($post_title); ?></h6>
								</a>
								
								<div class="twm-job-duration">
									<ul>
										<?php 
										$type = $types[0];
										if(!empty($type)){ ?>
										<li>
											<span class="twm-job-post-duration"><i class="fa fa-calendar-alt"></i><?php echo esc_html($type->name); ?></span>
										</li>
										<?php } ?>
										<li>
											<span class="twm-job-post-duration"><i class="far fa-clock"></i><?php echo get_the_jobzilla_publish_date($post); ?></span>
										</li>
									</ul>
								</div>
								<p>
									<?php echo esc_html($short_description); ?>
								</p>
							</div>
							<div class="twm-right-content">
							   <a href="<?php the_permalink(); ?>" class="twm-jobs-browse site-text-primary"><?php echo esc_html('Apply Job', 'jobzilla'); ?></a>
							</div>
							<?php if(!empty($category)){ 
								$count = 1;
								?>
							<div class="twm-jobs-category outline">
								<?php foreach($category as $term){ ?>
								<a href="<?php echo esc_url(get_term_link($term->slug, 'job_listing_category')); ?>"><?php echo esc_html($term->name); ?></a>
								<?php if($count == 4){
										 break;		
										}
										$count++;
									} ?>
							</div>
							<?php  
						} ?>
						</div>
					</div>
					<?php } ?>
			   </div>
			   <?php if(!empty($job_listing_2_element_link_title) && !empty($btn_link)){ ?>
					<div class="text-center m-b30">
						<a href="<?php echo esc_url($btn_link); ?>" class=" site-button"> <?php  echo esc_html($job_listing_2_element_link_title); ?></a>
					</div>
				<?php } ?>
			</div>
		</div>
	   
	</div>
	<?php if(!empty($job_listing_2_element_image['id'])){ ?>
		<div class="twm-bg-shape5-left" style="background-image: url(<?php echo esc_url($job_listing_2_element_image['url']); ?>);"></div>
	<?php } ?>
</div>
<!-- Recruiters END -->
<?php } 
}
