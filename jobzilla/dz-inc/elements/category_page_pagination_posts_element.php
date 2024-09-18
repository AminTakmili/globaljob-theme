<!--Blog Post-->
<div id="masonry">
<?php 
	$category_on = jobzilla_get_opt('category_on',true);
	$date_on 	 	= jobzilla_get_opt('date_on',true);
	$comment_count_on 	 = jobzilla_get_opt('comment_count_on',true);
while( have_posts() )
	{ 
	the_post();
	
	$post_id = get_the_ID();
	
	$post_title = jobzilla_trim(get_the_title(), 7);
	
	$excerpt = get_the_excerpt();
	$content = get_the_content();
	$short_description = jobzilla_short_description($excerpt, $content, 25, '...');
	
	$featured = get_post_meta(get_the_ID(), 'featured_post');
	$featured_class = (!empty($featured) && $featured[0] == 1) ? ' featured ' : '';
    
    $author_name = get_the_author_meta('display_name', $post->post_author);
    
	$no_image_class = (!has_post_thumbnail())?'no-image':'';
?>
	<!-- blog post item -->
	<div id="post-<?php the_ID(); ?>" <?php echo post_class('dz-blog style-1 bg-white m-b30 blog-half '.$featured_class.' '.$no_image_class); ?>>
		<?php if(has_post_thumbnail()) { ?>
			<div class="dz-media dz-img-effect zoom">
				<a href="<?php echo esc_url(get_permalink()); ?>">
					<?php the_post_thumbnail('jobzilla_750x450'); ?>
				</a>
			</div>
		<?php } ?>  
			
		<div class="dz-info">
			<h3 class="dz-title">
				<a href="<?php echo esc_url(get_permalink()); ?>">
					<?php echo wp_kses($post_title, jobzilla_allowed_html_tag()); ?>
				</a>
			</h3>
			
			<p class="m-b0">
				<?php echo esc_html( $short_description );?>
			</p>
			
			<div class="dz-meta meta-bottom">
				<ul class="border-0 pt-0">
					<?php if(!empty($date_on )){ ?>
					<li class="post-date">
						<i class="far fa-calendar fa-fw m-r10"></i>
						<?php echo esc_html(get_the_date()); ?>
					</li>
					<?php } ?>
					<li class="post-author">
						<i class="far fa-user fa-fw m-r10"></i>
						<?php echo esc_html__('By', 'jobzilla'); ?> 
						<a href="<?php echo esc_url(get_author_posts_url( $post->post_author )); ?>">	
							<?php echo esc_html($author_name);?>
						</a>
					</li>
					<?php if($comment_count_on){ ?>
					<li class="post-comment">
						<a href="<?php echo esc_url(get_the_permalink(get_the_id()).'#comments');?>">
							<i class="far fa-comment-alt fa-fw"></i>
							<span>
								<?php comments_number( '0', '1', '%' ); ?>
							</span>
						</a>
					</li>
					<?php } ?>
				</ul>
				
				<?php if(empty($post_title)){ ?>
					<a href="<?php echo esc_url(get_permalink()); ?>" class="btn site-button btn-primary btnhover">
						<?php echo esc_html__('Read More','jobzilla'); ?>
					</a>
				<?php } ?>
			</div>
		</div>
		<?php
			if(is_sticky())
			{
				echo '<span class="sticky-icon"><i class="fa fa-thumbtack"></i></span>';
			}
		?>
	</div>
	<!-- End Post -->
	<?php } wp_reset_postdata(); ?>
</div>
<!-- Pagination start -->
<?php jobzilla_the_pagination(); ?>
<!-- Pagination END -->