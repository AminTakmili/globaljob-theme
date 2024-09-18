<?php 
	get_header(); 
	
	jobzilla_get_banner(); 
?>
		<div class="container">
			<div class="col-lg-12 col-md-12">					
			
				<?php echo do_shortcode('[resumes  categories='.get_query_var('resume_category').' show_filters="true" per_page="10" show_pagination="false"]')?>
			
			</div>
		</div>
<?php get_footer(); ?>