<?php 
	get_header();
	global $post;
	/* Manage post views count */
	$meta_views_count = get_post_meta(get_the_id(), '_views_count', true); /* count meta views */
	update_post_meta(get_the_id(), '_views_count', ++$meta_views_count);
	/* End manage post views count */
	$candidate_detail_layout = jobzilla_get_post_meta(get_the_id(), '_candidate_detail_layout');
	if(function_exists('jobzilla_wpjm_view')){
		jobzilla_wpjm_view();
	}
	
	jobzilla_get_post_banner(); 
	if($candidate_detail_layout == 'full_width'){
		get_template_part('dz-inc/elements/resume_template/standard_2'); 
	}else{
		get_template_part('dz-inc/elements/resume_template/standard');
	}
	wp_reset_postdata();
	get_footer();