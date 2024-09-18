<?php 
	get_header(); 
	
	jobzilla_get_banner(); 
?>
											   
<div class="container">

	<div class="col-lg-12 col-md-12">					
		<?php echo do_shortcode('[resumes  categories='. get_query_var('resume_region') .' show_filters="false" per_page="10" show_pagination="true"]')?>
	</div>

</div>
<?php get_footer(); ?>