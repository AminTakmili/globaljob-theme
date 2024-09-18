<?php
$jobzilla_options = jobzilla_dzbase()->option();

$jobzilla_query_result = get_query_var('jobzilla_query_result');

foreach ($jobzilla_query_result->posts as $post)
{

    /* implement post layout icons on listing post */
    $post_id = get_the_ID();
    $post_setting = get_post_meta($post_id, '_post_settings', true);
    $post_layout = isset($post_setting['post_layout']) ? $post_setting['post_layout'] : '';

    $excerpt = $post->post_excerpt;
    $content = $post->post_content;
    $short_description = jobzilla_short_description($excerpt, $content, 25);

    $post_layout_class = '';
    if ($post_layout == 'link_post')
    {
        $post_layout_class = 'fa-link';
    }

    if ($post_layout == 'audio_post')
    {
        $post_layout_class = 'fa-soundcloud';
    }

    if ($post_layout == 'video_post')
    {
        $post_layout_class = 'fa-play';
    }

    if ($post_layout == 'slider_post_1' || $post_layout == 'slider_post_2')
    {
        $post_layout_class = 'fa-picture-o';
    }

    $post_title = jobzilla_trim(get_the_title() , 7);

    $featured = get_post_meta(get_the_ID() , 'featured_post');
    $featured_class = (!empty($featured) && $featured[0] == 1) ? ' featured ' : '';
    
    $author_name = get_the_author_meta('display_name', $post->post_author);
    
    $no_image_class = (!has_post_thumbnail()) ? 'no-image' : '';
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
					<li class="post-date">
						<i class="far fa-calendar fa-fw m-r10"></i>
						<?php echo esc_html(get_the_date()); ?>
					</li>
					
					<li class="post-author">
						<i class="far fa-user fa-fw m-r10"></i>
						<?php echo esc_html__('By', 'jobzilla'); ?> 
						<a href="<?php echo esc_url(get_author_posts_url( $post->post_author )); ?>">	
							<?php echo esc_html($author_name);?>
						</a>
					</li>
					
					<li class="post-comment">
						<a href="<?php echo esc_url(get_the_permalink($post_id).'#comments');?>">
							<i class="far fa-comment-alt fa-fw"></i>
							<span>
								<?php comments_number( '0', '1', '%' ); ?>
							</span>
						</a>
					</li>
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
	<?php
}
wp_reset_postdata();
?>
