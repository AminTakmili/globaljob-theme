<?php 
  $post_id = get_the_ID();
  $categories = get_the_category($post_id);
  $related_post_on = jobzilla_get_opt('related_post_on',false);
  
  if ($categories) {
    
    $category_ids = array();
    
    foreach($categories as $individual_category){ 
      $category_ids[] = $individual_category->term_id;
	  
    }
    
    $args = array(
		'category__in'     => $category_ids,
		'post__not_in'     => array($post_id),
		'posts_per_page'   => 2,
		'ignore_sticky_posts' => 1,
		'orderby' => 'rand',		
    );
    $args['meta_query'] = array(
		array(
    'key' => '_thumbnail_id',
    'compare' => 'EXISTS'
		),
    );
    
    $related_query = new wp_query( $args );
    if( $related_query->have_posts() ) { 
      
     
    if($related_post_on){
    ?>
		<div class="row extra-blog style-1">
			<div class="col-lg-12">
				<h4 class="blog-title">
					<?php echo esc_html__('Related Blogs','jobzilla');?>
				</h4>
			</div>
		
			<?php 
			  $count=1;
			  while( $related_query->have_posts() ) {
				$related_query->the_post();
				$post_title = jobzilla_trim(get_the_title(), 8);
				
				$excerpt = get_the_excerpt();
				$content = get_the_content();
				$post_desc = jobzilla_short_description($excerpt, $content, 19);
				
				$author_name = get_the_author_meta('display_name', $post->post_author);
				$author_name = explode(" ",$author_name);
				$no_image_class = '';
				$class = ($count==1)?'m-sm-b30':'';
				if(!has_post_thumbnail())
				{
				  $no_image_class = 'no-image-box';	
				}	
			?>
				<div class="col-lg-6 col-md-6">
					<div class="dz-blog style-1 bg-white m-b30">
						<?php if(has_post_thumbnail()) { ?>
							<div class="dz-media <?php echo esc_attr($no_image_class); ?>">					
								<?php the_post_thumbnail('jobzilla_555x450'); ?>
							</div>
						<?php } ?>
						
						<div class="dz-info">
							<h6 class="dz-title">
								<a href="<?php echo esc_url(get_permalink()); ?>">
									<?php echo esc_html($post_title); ?>
								</a>
							</h6>
							
							<p class="m-b0">
								<?php echo esc_html($post_desc); ?>
							</p>
							<div class="dz-meta meta-bottom">
								<ul>
									<li class="post-date">
										<i class="far fa-calendar fa-fw m-r10"></i>
										<?php echo esc_html(get_the_date()); ?>
									</li>
									
									<li class="post-author">
										<i class="far fa-user fa-fw m-r10"></i>
										<?php echo esc_html__('By', 'jobzilla'); ?> 
										<a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )); ?>">
											<?php echo esc_html($author_name[0]); ?>
										</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			<?php ++$count; } ?>
		</div>
		<?php
    } }
  }
wp_reset_postdata();?>