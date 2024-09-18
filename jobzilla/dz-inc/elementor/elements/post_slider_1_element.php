<?php
    
   
    $query_args = array(    
        'post_type'         => 'post',
        'post_status'       => 'publish',
        'posts_per_page'    => $post_slider_1_element_no_of_posts , 
		'orderby'           => $post_slider_1_element_orderby,		
        'order'             => $post_slider_1_element_order,
        'ignore_sticky_posts' => true,
    );
    
    $post_slider_1_element_image_preference = !empty($post_slider_1_element_image_preference)?$post_slider_1_element_image_preference:'all_posts';
    
    if($post_slider_1_element_image_preference == 'image_post_only')
    {
        $query_args['meta_query'] = array(
            array(
             'key' => '_thumbnail_id',
             'compare' => 'EXISTS'
            ),
        );
    }
    elseif($post_slider_1_element_image_preference == 'text_post_only')
    {
        $query_args['meta_query'] = array(
            array(
             'key' => '_thumbnail_id',
             'compare' => 'Not EXISTS'
            ),
        );
    }
    
    if($post_slider_1_element_only_featured_posts == 'true') 
    {       
        $query_args['meta_key'] = 'featured_post';      
        $query_args['meta_value'] = 1;              
        $query_args['meta_compare'] = 'LIKE';       
    }
	if(!empty($post_slider_1_element_posts_in_categories) && !empty($post_slider_1_element_posts_in_categories[0]))
    {           
        
        $post_slider_1_element_posts_in_categories1 = jobzilla_get_cat_id_by_slug($post_slider_1_element_posts_in_categories,'category');
        
        $query_args['tax_query'][] = array(
        'taxonomy' => 'category',
        'field' => 'id',
        'terms' => $post_slider_1_element_posts_in_categories1,
        'operator' => 'IN'
        ); 
    }   
  
    $query = new WP_Query($query_args); 
    $strip = wp_kses_allowed_html('strip');
	
	$post_slider_1_element_style = !empty($post_slider_1_element_style)?$post_slider_1_element_style:'style_1';
	
	$class = $post_slider_1_element_style == 'style_1' ? 'site-bg-gray':'site-bg-white';
	 
    if($query->have_posts()) {
?>
<div class="section-full content-inner-1 <?php echo esc_attr($class); ?>">
	<div class="container">
		<div class="section-head center wt-small-separator-outer">
			<?php if(!empty($post_slider_1_element_subtitle)){ ?>
				<div class="wt-small-separator site-text-primary">
				   <div><?php echo esc_html($post_slider_1_element_subtitle); ?></div>
			   </div>
			<?php }
			if( !empty($post_slider_1_element_title) ){ 
			?>
				<h2 class="wt-title">
					<?php echo esc_html($post_slider_1_element_title); ?>
				</h2>
			<?php } ?>
		</div>  
		<?php if($post_slider_1_element_style == 'style_1'){ ?>
		<div class="section-content">
			<div class="twm-blog-post-1-outer-wrap">
				<div class="owl-carousel twm-la-home-blog owl-btn-bottom-center">
					<?php while($query->have_posts()){ 
								$query->the_post();
								global $post ; 
								 $content_text_limit = $post_slider_1_element_text_limit;
								$short_description = jobzilla_short_description(get_the_excerpt(), get_the_content(), $content_text_limit);
								$author_name = get_the_author_meta('display_name', $post->post_author);
					?>
					<div class="item">
						<div class="blog-post twm-blog-post-1-outer">
							<?php if(has_post_thumbnail()){ ?>
							<div class="wt-post-media">
								<?php the_post_thumbnail('jobzilla_600x550') ?>
							</div>   
							<?php } ?>
							<div class="wt-post-info">
								<div class="wt-post-meta ">
									<ul>
										<?php
											$date_on = jobzilla_get_opt('date_on');
											if(!empty($date_on)){
											?>
											<li class="post-date">
												<?php echo esc_html(get_the_date()); ?>
											</li>
										<?php } ?>
										<li class="post-author">
											<?php echo esc_html('By', 'jobzilla'); ?> 
											<a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )); ?>">
												<?php echo esc_html($author_name);?>
											</a>
										</li>
									</ul>
								</div>
								<div class="wt-post-title ">
									<h5 class="post-title">
										<a href="<?php echo esc_url(get_permalink()); ?>">
											<?php 
											
											$short_title = wp_trim_words(  get_the_title($post->ID), 8, ''); 
											echo esc_html($short_title); ?>
										</a>
									</h5>
								</div>
								<div class="wt-post-text ">
									<p>
										<?php echo esc_html($short_description); ?>
									</p>
								</div>
								<div class="wt-post-readmore ">
									<a href="<?php echo esc_url(get_permalink()); ?>" class="site-button-link site-text-primary">
									<?php echo esc_html__('Read More', 'jobzilla'); ?>
									</a>
								</div>                                        
							</div>                                
						</div>
					</div>
					<?php } ?>
				</div>
			</div>
		</div>
	<?php }else{ ?>	
		<div class="section-content">
			<div class="twm-blog-post-3-outer-wrap">
				<div class="owl-carousel twm-la-home-blog2 owl-btn-bottom-center">
					<?php 
					while($query->have_posts()){ 
						$query->the_post();
						global $post ; 
						 $content_text_limit = $post_slider_1_element_text_limit;
						$short_description = jobzilla_short_description(get_the_excerpt(), get_the_content(), $content_text_limit);
						$author_name = get_the_author_meta('display_name', $post->post_author);
					?>
					
					<div class="item">
						<!--Block one-->
						<div class="blog-post twm-blog-post-3-outer">
							<?php if(has_post_thumbnail()){ ?>
								<div class="wt-post-media">
									<?php the_post_thumbnail('jobzilla_600x550') ?>
								</div>   
							<?php } ?>                            
							<div class="wt-post-info">
								<div class="wt-post-meta ">
									<ul>
										<?php
										$date_on = jobzilla_get_opt('date_on');
										if(!empty($date_on)){
										?>
										<li class="post-date">
											<?php echo esc_html(get_the_date()); ?>
										</li>
										<?php } ?>
										<li class="post-author"><?php esc_html_e('By', 'jobzilla'); ?> <a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )); ?>">
											<?php echo esc_html($author_name);?></a></li>
									</ul>
								</div>
								<div class="wt-post-title ">
									<h5 class="post-title">
										<a href="<?php echo esc_url(get_permalink()); ?>">
											<?php 
											
											$short_title = wp_trim_words(  get_the_title($post->ID), 8, ''); 
											echo esc_html($short_title); ?>
										</a>
									</h5>
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
<?php } ?>

 