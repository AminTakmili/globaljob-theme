<?php get_header(); 
	$jobzilla_option = getDZThemeReduxOption();
	$show_sidebar   		 = !empty($jobzilla_option['show_sidebar']) ? $jobzilla_option['show_sidebar'] : '';
	$page_title     		 = !empty($jobzilla_option['page_title']) ? $jobzilla_option['page_title'] : '';
	$sidebar	     		 = !empty($jobzilla_option['sidebar']) ? $jobzilla_option['sidebar'] : '';
	$layout		     		 = !empty($jobzilla_option['layout']) ? $jobzilla_option['layout'] : '';
	$disable_ajax_pagination = !empty($jobzilla_option['disable_ajax_pagination']) ? $jobzilla_option['disable_ajax_pagination'] : '';
	$queried_object_data = $wp_query->get_queried_object();	
	
	$tag_name = $queried_object_data->name;		
	$total_post_count = $wp_query->found_posts;
	
	$page_title = (!empty($queried_object_data->name)) ? $page_title .'<span>'. $queried_object_data->name .'</span>' : $page_title; 
	
	$layout = (!$show_sidebar)?'full':$layout;	
	if($layout == 'full' || !is_active_sidebar( $sidebar ) || !jobzilla_is_theme_sidebar_active() )
	{
		$layout_class = 'col-lg-12 col-md-12';
	}else{
		$layout_class = 'col-lg-8 col-md-12';
	}
	
	set_query_var( 'queried_object_data', $queried_object_data );
	
	jobzilla_get_banner(); 
?>			  
	<div class="section-full p-t120 p-b90 site-bg-white">
		<div class="container">
			<div class="row">
				<?php  if( $show_sidebar && $layout == 'left' && is_active_sidebar( $sidebar )  && jobzilla_is_theme_sidebar_active() ) {  ?>
					<div class="col-lg-4 col-md-12 rightSidebar">
						<div class="side-bar">
							<?php dynamic_sidebar( $sidebar ); ?>
						</div>
					</div>
				<?php } ?>
			
				<div class="<?php echo esc_attr($layout_class);?>">
					<?php 
						if( have_posts() ) 
						{ 
							if($disable_ajax_pagination)
							{
								get_template_part('dz-inc/elements/tag_page_ajax_posts_element');
							}
							else
							{					
								get_template_part('dz-inc/elements/tag_page_pagination_posts_element');
							}
						}
						else
						{
							get_template_part('dz-inc/elements/page_no_record_found_element');
						}
					?>	
				</div>
				<?php  if( $show_sidebar && $layout == 'right' && is_active_sidebar( $sidebar )  && jobzilla_is_theme_sidebar_active() ) {  ?>	
					<div class="col-lg-4 col-md-12 rightSidebar">
						<div class="side-bar sticky-top">
							<?php dynamic_sidebar( $sidebar ); ?>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
<?php get_footer(); ?>