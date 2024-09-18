<?php 	
	$category_on = jobzilla_get_opt('category_on',true);
	$date_on 	 = jobzilla_get_opt('date_on',true);
	$featured_img_on 	 = jobzilla_get_opt('featured_img_on',true); /* From Theme Options */
	
	$page_options = jobzilla_dzbase()->get_meta();
	
	$post_show_sidebar	= jobzilla_dzbase()->get_meta('post_show_sidebar');
	$post_sidebar_layout	= jobzilla_dzbase()->get_meta('post_sidebar_layout');
	$post_sidebar			= jobzilla_dzbase()->get_meta('post_sidebar');
	$post_type_audio		= jobzilla_dzbase()->get_meta('post_type_audio');
	$featured_image			= (isset($page_options['featured_image']))?jobzilla_dzbase()->get_meta('featured_image'):true;
	
	if( !$post_show_sidebar || empty($post_sidebar) || !is_active_sidebar( $post_sidebar) || $post_sidebar_layout == 'full' || !jobzilla_is_theme_sidebar_active())
	{
		$is_sidebar = false;
		$classes = 'col-xl-12 col-lg-12';
		$blog_classes = 'dz-blog blog-single style-1 ';
		
    }else{
		$is_sidebar = true;
		$classes = 'col-xl-8 col-lg-8';
		$blog_classes = 'dz-blog blog-single style-1 sidebar';
	}
	$social_shaing = jobzilla_get_opt('social_shaing_on_post');
	$views_arr = get_post_meta(get_the_id(),'_views_count');
	$views = (isset($views_arr[0]))?$views_arr[0]:0;
	?>

<!-- About Us -->
<div class="section-full content-inner bg-white">
	<div class="<?php echo esc_attr(jobzilla_get_container($is_sidebar)); ?>">
		<div class="row">
			<?php if ($post_sidebar_layout == 'left' && $is_sidebar) { ?>
				<!-- Side bar start -->
				<div class="col-xl-4 col-lg-4 dz-order-1">
					<aside class="side-bar sticky-top">
						<?php dynamic_sidebar( $post_sidebar ); ?>
					</aside>
				</div>
				<!-- Side bar END -->
			<?php } ?>
			
			<div class="<?php echo esc_attr($classes); ?>">
				<?php while( have_posts() ){ the_post();  ?>
					<div class="<?php echo esc_attr($blog_classes); ?>">          
						<?php if(!empty($post_type_audio)) { 
						$post_type_audio = 'https://w.soundcloud.com/player/?visual=true&amp;url='.$post_type_audio.'&amp;show_artwork=true&amp;maxwidth=750&amp;maxheight=1000&amp;dnt=1';
						?>
							<div class="dz-media rounded-md post-audio">
								<iframe src="<?php echo esc_url($post_type_audio) ?>"></iframe>
							</div>
						<?php } ?>
						
						<div class="dz-info">
							<div class="dz-meta  border-0 py-0 mb-2">
								<ul class="border-0 pt-0">
									<?php if(!empty($date_on)) { ?>
										<li class="post-date">
											<i class="far fa-calendar fa-fw m-r10"></i>
											<?php echo the_date(); ?>
										</li>
									<?php } ?>
									
									<li class="post-author">
										<i class="far fa-user fa-fw m-r10"></i>
										<?php esc_html_e('By', 'jobzilla'); ?> 
										<a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )); ?>">
											<?php the_author(); ?> 
										</a>
									</li>
								
									<?php echo jobzilla_show_post_view_count_view($views); ?>
									
									<?php if(has_category() && $category_on) { ?>
										<li class="post-category">
											<i class="fa fa-tag" aria-hidden="true"></i>
											<?php echo  get_the_category_list(', '); ?>
										</li>
									<?php } ?>
								</ul>
							</div>
							<?php if(!jobzilla_is_post_banner_enable()){ ?>
								<h1 class="dz-title">
								  <?php the_title(); ?>
								</h1>
							<?php } ?>
							
							<div class="dz-post-text">
								<?php the_content(); ?>
							</div>
							
							<?php if(has_tag() || $social_shaing) { ?>
								<div class="dz-meta meta-bottom border-top">
									<?php if(has_tag()) { ?>
										<div class="post-tags">
											<?php jobzilla_get_post_tags(get_the_id()); ?>
										</div>
									<?php } ?>	
										
									<div class="dz-social-icon primary-light">
										<?php echo jobzilla_share_us(get_the_id(),get_the_title()); ?>
									</div>
								</div>
							<?php } ?>	
						</div>
					</div>
				<?php } ?>
        
				<?php get_template_part('dz-inc/elements/author_block_element');  ?>
				<?php get_template_part('dz-inc/elements/pagination_element'); ?>    
				<?php wp_link_pages(array('before'=>'<div class="paginate-links">'.esc_html__('Pages: ', 'jobzilla'), 'after' => '</div>', 'link_before'=>'<span>', 'link_after'=>'</span>')); ?>
				<?php get_template_part('dz-inc/elements/related_element');  ?>	
				<!-- blog END --> 
				<?php comments_template(); ?>					
          
        
			</div>
			<?php if ($post_sidebar_layout == 'right' && $is_sidebar) { ?>
				<!-- Side bar start -->
				<div class="col-xl-4 col-lg-4 dz-order-1">
					<aside class="side-bar sticky-top">
						<?php dynamic_sidebar( $post_sidebar ); ?>
					</aside>
				</div>
				<!-- Side bar END -->
			<?php } ?>
		</div>
	</div>
</div>
<!-- About Us End -->
