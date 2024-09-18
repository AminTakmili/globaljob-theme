<?php
	$current_page = $GLOBALS['jobzilla_query_result']['current_page'];
	$posts_per_page = $GLOBALS['jobzilla_query_result']['posts_per_page'];
	$side_bar = $GLOBALS['jobzilla_query_result']['side_bar'];
	$show_column = $GLOBALS['jobzilla_query_result']['show_column'];
	
	$title_text_limit = $GLOBALS['jobzilla_query_result']['title_text_limit'];
	$current_post_number =  (($current_page * $posts_per_page ) - $posts_per_page ) + 1;
	$blog_view_container = !empty($GLOBALS['jobzilla_query_result']['blog_view_container']) && $GLOBALS['jobzilla_query_result']['blog_view_container'];
	$posts = $GLOBALS['jobzilla_query_result']['posts']; /*NOTE - DO NOT PUT THIS LINE ABOVE OTHERWISE IT WILL GIVE NOTICE */
	
	if($show_column == 'col_2'){
		$col_classes = 'col-lg-6 col-md-6 ';
	}elseif($show_column == 'col_3'){
		$col_classes = 'col-lg-4 col-md-6 ';
	}else{
		$col_classes = 'col-lg-3 col-md-6 ';
	}
	
	foreach ( $posts as $post ){ 		
		
		$post_layout = jobzilla_dzbase()->get_meta('post_layout');		
		$post_id  = $post->ID; 
		$post_title =  jobzilla_trim( $post->post_title , 4 );
		$excerpt = $post->post_excerpt;
		$content = $post->post_content;
		$short_description = jobzilla_short_description($excerpt, $content, $title_text_limit);	
		
		/* implement post layout icons on listing post */
		$post_setting = get_post_meta($post_id, '_post_settings', true);		
		$author_name = get_the_author_meta('display_name', $post->post_author);
		
		$is_featured_post = isset($post_setting['is_featured_post']) ? $post_setting['is_featured_post'] : 0 ;
		
		
		$views_arr = get_post_meta($post_id,'_views_count');
		$views = (isset($views_arr[0]))?$views_arr[0]:0;
		
		$no_image_class = (!has_post_thumbnail()) ? 'no-image-box' : '';
		$media_class = ($post_layout == 'video_post')?'video-bx style-2 overlay-black-light':'';
		$post_type_video	= jobzilla_dzbase()->get_meta('post_type_video');
	?>

	<div id="post-<?php the_ID(); ?>" <?php echo post_class($col_classes.' masonry-item'); ?> >		
		<div class="blog-post twm-blog-post-1-outer <?php echo esc_attr($post_layout); ?>" data-wow-delay=".2s" data-wow-duration="2s">			
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
						<?php } } ?>
					</div>
					<?php }
				}
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
                        <li class="post-author"><?php esc_html_e('By', 'jobzilla'); ?> <a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )); ?>">
                            <?php echo esc_html($author_name);?></a></li>
                    </ul>
                </div>
                <div class="wt-post-title ">
                    <h4 class="post-title">
						<a href="<?php echo esc_url(get_permalink()); ?>">
							<?php echo esc_html($post_title); ?>
						</a>
					</h4>
                </div>
				<div class="wt-post-text ">
                    <p>
                        <?php echo esc_html($short_description); ?>
                    </p>
                </div>
                <div class="wt-post-readmore ">
                    <a href="<?php echo esc_url(get_permalink()); ?>" class="site-button-link site-text-primary"><?php echo esc_html__('Read More','jobzilla'); ?></a>
                </div>  
			</div>
		</div>
	</div>
	<?php 
	} 
	wp_reset_postdata();
?>