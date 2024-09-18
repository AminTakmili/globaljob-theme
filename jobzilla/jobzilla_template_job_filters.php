<?php 
/* Template Name: Jobzilla Template Job Filters */

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

?>



<?php jobzilla_get_banner(); ?>	

<div class="section-full bg-white content-inner">
	<div class="container">
		<div class="row">
			<!-- Left sidebar area -->
			<?php if( $layout == 'left' && is_active_sidebar( $sidebar ) && false) {  ?>
					<div class="col-xl-4 col-lg-4 m-b30">
						<div class="side-bar sticky-top">
							<?php dynamic_sidebar( $sidebar ); ?>
						</div>
					</div>
			<?php } ?>
				
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
				
				
			</div>
			
		</div>
	</div>
</div>
	
<?php get_footer() ; ?>