<?php
    $blog_view = "post_listing_4";
    $page_no = 1;
    
    $query_args = array(    
        'post_type'         => 'post',
        'post_status'       => 'publish',
        'posts_per_page'    => $post_listing_4_element_no_of_posts ,        
        'order'             => $post_listing_4_element_order,
        'ignore_sticky_posts' => true,
    );
    
    if($post_listing_4_element_orderby == 'views_count'){
        $query_args['meta_key'] = '_views_count';
    }
    else{
        $query_args['orderby']  = $post_listing_4_element_orderby;
    }
  
    $post_listing_4_element_image_preference = !empty($post_listing_4_element_image_preference)?$post_listing_4_element_image_preference:'all_posts';
    
    if($post_listing_4_element_image_preference == 'image_post_only')
    {
        $query_args['meta_query'] = array(
            array(
             'key' => '_thumbnail_id',
             'compare' => 'EXISTS'
            ),
        );
    }
    elseif($post_listing_4_element_image_preference == 'text_post_only')
    {
        $query_args['meta_query'] = array(
            array(
             'key' => '_thumbnail_id',
             'compare' => 'Not EXISTS'
            ),
        );
    }
    
    if(!empty($post_listing_4_element_posts_in_categories) && !empty($post_listing_4_element_posts_in_categories[0])) {
        
        $post_listing_4_element_posts_in_categories = implode(',', $post_listing_4_element_posts_in_categories);
        $query_args['category_name'] = $post_listing_4_element_posts_in_categories;
        
    }else{
        $post_listing_4_element_posts_in_categories = '';
    }
    
    if($post_listing_4_element_only_featured_posts == 'true') 
    {       
        $query_args['meta_key'] = 'featured_post';      
        $query_args['meta_value'] = 1;              
        $query_args['meta_compare'] = 'LIKE';       
    }
  
  
    $query = new WP_Query($query_args); 
    
	$btn_link = $anchor_attribute = '';
    if (!empty($post_listing_4_element_btn_link))
    {
        $btn_link = !empty($post_listing_4_element_btn_link)?$post_listing_4_element_btn_link:'';
        $anchor_attribute = jobzilla_elementor_get_anchor_attribute($btn_link);
    }
	
    
    $max_num_pages = $query->max_num_pages; 
    $strip = wp_kses_allowed_html('strip');
    if($query->have_posts()) {
?>

<!-- OUR BLOG START -->
<div class="section-full content-inner twm-blog-post-h-page6-wrap">
	<div class="container">

		<div class="wt-separator-two-part">
			<div class="row wt-separator-two-part-row section-head">
				<?php if(!empty($post_listing_4_element_title) || !empty($post_listing_4_element_subtitle )){ ?>
					<div class="col-xl-6 col-lg-6 col-md-12 wt-separator-two-part-left">
						<?php if(!empty($post_listing_4_element_subtitle )){ ?>
							<div class="wt-small-separator site-text-primary">
							   <div>
									<?php echo wp_kses($post_listing_4_element_subtitle, 'string'); ?>
							   </div>                                
							</div>
						<?php } ?>

						<?php if(!empty($post_listing_4_element_title)){ ?>
							<h2 class="wt-title">
								<?php echo wp_kses($post_listing_4_element_title, 'string'); ?>
							</h2>                
						<?php } ?>
					</div>
				<?php } ?>
				<?php if(!empty($post_listing_4_element_btn_text)) { ?>                            
					<div class="col-xl-6 col-lg-6 col-md-12 wt-separator-two-part-right text-right">
						<a href="<?php echo esc_url($btn_link); ?>" <?php echo esc_attr($anchor_attribute); ?> class="site-button">
							<?php echo esc_html($post_listing_4_element_btn_text); ?>
						</a>
					</div>
				<?php } ?>
			</div>
		</div>
	   
		<div class="section-content">
		    <div class="twm-jobs-grid-wrap">
				<div class="row d-flex justify-content-center">
				  <!-- Left part start -->
					<div class="'col-sm-12 col-12">
						<div  class="row">
							<?php
							$count = 1;
							while($query->have_posts())
							{ 
								$query->the_post();
								global $post ;   		
								
								if($count == 5){
									$count = 1;
								}
								if($count == 2 || $count == 3  ){
									$classes = 'col-lg-8 col-md-6 m-b30';
									$cla = 'with-content';
								}else{
									$classes = 'col-lg-4 col-md-6 m-b30';
									$cla = '';
								}
								$post_layout = jobzilla_dzbase()->get_meta('post_layout');		
								$post_id  = $post->ID; 
								$post_title =  jobzilla_trim( $post->post_title ,5);
								$excerpt = $post->post_excerpt;
								$content = $post->post_content;
								$short_description = jobzilla_short_description($excerpt, $content, $post_listing_4_element_text_limit);	
								/* implement post layout icons on listing post */
								$post_setting = get_post_meta($post_id, '_post_settings', true);		
								$author_name = get_the_author_meta('display_name', $post->post_author);
								
								$is_featured_post = isset($post_setting['is_featured_post']) ? $post_setting['is_featured_post'] : 0 ;
								
								
								$views_arr = get_post_meta($post_id,'_views_count');
								$views = (isset($views_arr[0]))?$views_arr[0]:0;
								
								$no_image_class = (!has_post_thumbnail()) ? 'no-image-box' : '';
								$media_class = ($post_layout == 'video_post')?'with-content video-bx style-2 overlay-black-light':'';
								$post_type_video	= jobzilla_dzbase()->get_meta('post_type_video');
							?>

							<div id="post-<?php the_ID(); ?>" <?php echo post_class($classes.' masonry-item'); ?> >		
								<div class="blog-post twm-blog-post-h-page6 <?php echo esc_attr($cla.' '.$post_layout); ?>" data-wow-delay=".2s" data-wow-duration="2s">	
									<?php if($count == 2 || $count == 3 ){ ?>
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
										</ul>
									</div>
									<?php if(!empty($post_title)){ ?>
									<div class="wt-post-title ">
											<h5 class="post-title">
												<a href="<?php echo esc_url(get_permalink()); ?>">
													<?php echo esc_html($post_title); ?>
												</a>
											</h5>
									</div>
									<?php } 
									if(!empty($short_description)){ ?>
									<div class="wt-post-text">
										<p>
										<?php echo esc_html($short_description); ?>
										</p>
									</div>
									<?php }
										$user_title = get_user_meta($post->post_author, 'job_title');
									?>
									<div class="post-author">
										<div class="post-author-pic">
											<div class="p-a-pic"><?php echo get_avatar($post->post_author, 100); ?></div>
											<div class="p-a-info">
												<a href="<?php echo esc_url(get_author_posts_url( $post->post_author )); ?>">
													<?php echo esc_html($author_name);?></a>
													<?php if(!empty($user_title)){ ?>
													<p><?php echo esc_html($user_title[0]); ?></p>
													<?php } ?>
											</div>
										</div>
									</div>
									</div>
									<?php } ?>
									<?php
										if($post_layout == 'slider_post_1')	{
											$post_type_gallery1	= jobzilla_dzbase()->get_meta('post_type_gallery1');					
										?>	
										<div class="wt-post-media">
											<?php 
												if(!empty($post_type_gallery1)) { 
												$post_type_gallery1 = explode(',',$post_type_gallery1);
											?>
												<div class="swiper-container post-swiper">
													<div class="swiper-wrapper">
														<?php foreach($post_type_gallery1 as $image_id) { ?>
															<div class="swiper-slide">
																<img class="rounded-sm" src="<?php echo esc_url(wp_get_attachment_image_url($image_id,'jobzilla_600x550')); ?>" alt="<?php echo esc_attr__('Image','jobzilla'); ?>">
															</div>
														<?php } ?>
													</div>
													<div class="prev-post-swiper-btn"><i class="fas fa-chevron-left"></i></div>
													<div class="next-post-swiper-btn"><i class="fas fa-chevron-right"></i></div>
													
												</div>
											<?php } ?>
										</div>
										<?php }else{ ?>
										
										<?php if(has_post_thumbnail()) { ?>
											<div class="wt-post-media <?php echo esc_attr($media_class); ?>">
												<?php the_post_thumbnail('jobzilla_600x550') ?>
												<?php if($post_layout == 'video_post'){ 
													if(!empty($post_type_video)) { 
														$video_id = jobzilla_get_youtube_video_id($post_type_video);
														$video_link = 'https://www.youtube.com/watch?v='.$video_id ;
												?>
													<div class="video-btn sm">
														<a href="<?php echo esc_url($video_link); ?>" class="video-play-icon popup-youtube"><span><i class="fa fa-play" aria-hidden="true"></i></span>	
														</a>
													</div>
												<?php }
												} ?>
											</div>
											<?php }
										}
									
								if($count == 1 || $count == 4){ 
									?>
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
											</ul>
										</div>
										<div class="wt-post-title ">
											<?php if(!empty($post_title)){ ?>
											<h4 class="post-title">
												<a href="<?php echo esc_url(get_permalink()); ?>">
													<?php echo esc_html($post_title); ?>
												</a>
											</h4>
											<?php } ?>
										</div>
									</div>
									<?php } ?>
									
								</div>
							</div>
							<?php $count++;
							} 
							wp_reset_postdata(); ?>
						</div>
					</div>
				</div>
			</div>
		</div>  
	</div>
</div>
<!-- OUR BLOG END -->
<?php } 