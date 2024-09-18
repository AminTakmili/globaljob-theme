<?php 
	get_header(); 
	jobzilla_get_banner(); 
?>
														   
		<div class="container">
			
			<div class="col-lg-12 col-md-12">					
				<?php echo do_shortcode('[jobs selected_region="'. get_query_var('job_listing_region') .'" per_page="10" show_pagination="true"  show_filters="false"]'); ?>
			</div>
			
		</div>
<?php get_footer(); ?>