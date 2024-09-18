<?php 
	get_header();
	
	/* Manage post views count */
	$meta_views_count = get_post_meta(get_the_id(), '_views_count', true); /* count meta views */
	update_post_meta(get_the_id(), '_views_count', ++$meta_views_count);
	/* End manage post views count */
	$job_detail_layout = jobzilla_get_post_meta(get_the_id(), '_job_detail_layout');
	
	if(function_exists('jobzilla_wpjm_view')){
		jobzilla_wpjm_view();
	}
	if($job_detail_layout == 'full_width'){
		get_template_part('dz-inc/elements/job_template/standard_2'); 	
	}else{
		jobzilla_get_post_banner();	
		get_template_part('dz-inc/elements/job_template/standard'); 	
	}
		
	wp_reset_postdata();
	get_footer();