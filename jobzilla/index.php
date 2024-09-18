<?php /* Default Page Settings managed by Theme Option */
get_header();	
	$jobzilla_option = getDZThemeReduxOption();
	$show_sidebar   		 = !empty($jobzilla_option['show_sidebar']) ? $jobzilla_option['show_sidebar'] : '';
	$page_title     		 = !empty($jobzilla_option['page_title']) ? $jobzilla_option['page_title'] : '';
	$sidebar	     		 = !empty($jobzilla_option['sidebar']) ? $jobzilla_option['sidebar'] : '';
	$layout		     		 = !empty($jobzilla_option['layout']) ? $jobzilla_option['layout'] : '';
	$disable_ajax_pagination = !empty($jobzilla_option['disable_ajax_pagination']) ? $jobzilla_option['disable_ajax_pagination'] : '';
	$website_status 		 = !empty($jobzilla_option['website_status']) ? $jobzilla_option['website_status'] : '';
	if(isWebsiteReadyForVisitor($website_status)){
	
		$layout = (!$show_sidebar)?'full':$layout;		
		if($layout == 'full' || !is_active_sidebar( $sidebar ) || !jobzilla_is_theme_sidebar_active() )
		{
			$layout_class = 'col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12';
		}else{
			$layout_class = 'col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12';
		}
		
		jobzilla_get_banner(); 
?>
	<div class="content-inner">
		<div class="container">
			<div class="row">
					<?php  if( $show_sidebar && $layout == 'left' && is_active_sidebar( $sidebar )  && jobzilla_is_theme_sidebar_active() ) {  ?>
						<!-- Left sidebar area -->
						<div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 dz-order-1">
							<div class="side-bar sticky-top">
								<?php dynamic_sidebar( $sidebar ); ?>
							</div>
						</div>
					<?php } ?>

					<!--Content Side-->	
					<div class="<?php echo esc_attr($layout_class);?>" >
						<?php 
							if( have_posts() )
							{ 
								if($disable_ajax_pagination == 'load_more')
								{
									get_template_part('dz-inc/elements/index_page_ajax_posts_element');
								}
								else
								{					
									get_template_part('dz-inc/elements/index_page_pagination_posts_element');
									
									/* Pagination start */
									jobzilla_the_pagination();
									/* Pagination END */
								}
							}
							else
							{
								get_template_part('dz-inc/elements/page_no_record_found_element');
							}
						?>
					</div>  
					<!-- End Content Side--> 
				
					<!-- Right sidebar area -->
					<?php  if( $show_sidebar && $layout == 'right' && is_active_sidebar( $sidebar )  && jobzilla_is_theme_sidebar_active() ) {  ?>
						<div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
							<div class="side-bar sticky-top">
								<?php dynamic_sidebar( $sidebar ); ?>
							</div>
						</div>
					<?php }  ?>
				</div>
			</div>
		</div>
<?php 
	}
	get_footer(); 
?>