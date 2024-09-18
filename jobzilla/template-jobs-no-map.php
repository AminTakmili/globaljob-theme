<?php
	/**
	 * Template Name: Jobzilla Page with Jobs Filters No Map
	 */
	get_header(); 
	$jobzilla_option = getDZThemeReduxOption();
	$show_sidebar   		 = !empty($jobzilla_option['show_sidebar']) ? $jobzilla_option['show_sidebar'] : '';
	$sidebar	     		 = !empty($jobzilla_option['sidebar']) ? $jobzilla_option['sidebar'] : '';
	$layout		     		 = !empty($jobzilla_option['layout']) ? $jobzilla_option['layout'] : '';
	
	$layout = (!$show_sidebar)?'full':$layout;

	if($layout == 'full' || !is_active_sidebar( $sidebar ) )
	{
		$classes = 'col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12';
		$content_class = '';
	}else{
		$classes = 'col-lg-8 col-md-12 m-b10 ';
		$content_class = 'sidebar';
	}
	
	jobzilla_get_banner(); 
	
	
	wp_dequeue_script('wp-job-manager-ajax-filters' );
	wp_enqueue_script( 'jobzilla-wp-job-manager-ajax-filters' );
	
?>	

	<div class="section-full p-t120  p-b90 site-bg-white">
		<div class="container">
			<div class="row">
				<!-- Left sidebar area -->
				<?php 
					if( $layout == 'left' && is_active_sidebar( $sidebar )) {  
						get_sidebar('jobs');
					} 
				?>
					
				<div class="<?php echo esc_attr($classes); ?>">
					<?php 
						while( have_posts() )
						{ 
						the_post();
					?>
						<div class="dz-page-text <?php echo esc_attr($content_class); ?>">
							<?php the_content(); ?>
							<div class="clearfix"></div>
						</div>
					<?php } ?>
					
					<?php comments_template(); ?>
					
					<?php wp_link_pages(array('before'=>'<div class="paginate-links">'.esc_html__('Pages: ', 'jobzilla'), 'after' => '</div>', 'link_before'=>'<span>', 'link_after'=>'</span>')); ?>	
				</div>
				
				<!-- Right sidebar area -->
				<?php 
					if( $layout == 'right' && is_active_sidebar( $sidebar ) ) { 
						get_sidebar('jobs');
					} 
				?>
				<!-- Right sidebar area -->
			</div>
		</div>
	</div>
	
<?php get_footer() ; ?>