<?php 
	get_header(); 
	$jobzilla_option = getDZThemeReduxOption();
	$show_sidebar   		 = !empty($jobzilla_option['show_sidebar']) ? $jobzilla_option['show_sidebar'] : '';
	$page_title     		 = !empty($jobzilla_option['page_title']) ? $jobzilla_option['page_title'] : '';
	$sidebar	     		 = !empty($jobzilla_option['sidebar']) ? $jobzilla_option['sidebar'] : '';
	$layout		     		 = !empty($jobzilla_option['layout']) ? $jobzilla_option['layout'] : '';
	$disable_ajax_pagination = !empty($jobzilla_option['disable_ajax_pagination']) ? $jobzilla_option['disable_ajax_pagination'] : '';
	$search_value = (!empty($_GET['s']))? sanitize_text_field($_GET['s']) : '';
	$queried_object_data = $wp_query; 
		
	$total_post_count = $wp_query->found_posts;
	$page_title = (!empty($queried_object_data->query_vars['s'])) ? $page_title .'<span>'. $queried_object_data->query_vars['s'] .'</span>' : $page_title;

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
					<div class="col-lg-4 col-md-12 leftSidebar">
						<div class="side-bar sticky-top">
							<?php dynamic_sidebar( $sidebar ); ?>
						</div>
					</div>
				<?php } ?>
				
				<div class="<?php echo esc_attr($layout_class);?>">
					<div class="row">
						<div class="col-lg-12 wow fadeInUp" data-wow-duration="2s" data-wow-delay="0.4s">
							<div class="search-bx m-b50">
								<?php if(!have_posts() ) { ?>
									<div class="section-head text-center style-1">
										<h3 class="dz-title">
											<?php esc_html_e('Nothing Found', 'jobzilla');?>
										</h3>
										
										<p>
											<?php esc_html_e('If you are not happy with the results, please do another search.', 'jobzilla');?>
										</p>
									</div>
								<?php } ?>
								
								<form role="search" action="<?php echo esc_url(home_url('/')); ?>" method="post">
									<div class="input-group">
										<input name="s" value="<?php echo esc_attr($search_value) ;?>"   placeholder="<?php esc_attr_e('Write your text', 'jobzilla');?>" type="text" class="form-control" >
										<span class="input-group-append search-btn">
											<button type="submit" class="btn">
												<i class="feather-search"></i>
											</button>
										</span>
									</div>
								</form>
							</div>
						</div>
					</div>
					
					<?php 
						if( have_posts() ) 
						{ 
							if($disable_ajax_pagination)
							{
								get_template_part('dz-inc/elements/search_page_ajax_posts_element');
							}
							else
							{					
								get_template_part('dz-inc/elements/search_page_pagination_posts_element');
							}
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
<?php 
	wp_reset_postdata(); 
	get_footer(); 
?>