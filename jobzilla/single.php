<?php 
	get_header();
	$jobzilla_option = getDZThemeReduxOption();
	$post_layout = !empty($jobzilla_option['post_layout']) ? $jobzilla_option['post_layout'] : 'standard';
	global $post;
	
	/* Manage post views count */
	$meta_views_count = get_post_meta(get_the_id(), '_views_count', true); /* count meta views */
	update_post_meta(get_the_id(), '_views_count', ++$meta_views_count);	
	/* End manage post views count */
	
	/* post banner Start */
	jobzilla_get_post_banner();
	/* post banner END */
 
	if($post_layout == 'gutenberg'){
		get_template_part('dz-inc/elements/post_template/post_gutenberg'); 
	}elseif($post_layout == 'standard'){
		get_template_part('dz-inc/elements/post_template/post_standard');	
	}elseif($post_layout == 'corner_post'){		
		get_template_part('dz-inc/elements/post_template/post_cornerimage');	
	}elseif($post_layout == 'post_gallery'){		
		get_template_part('dz-inc/elements/post_template/post_gallery');	
	}elseif($post_layout == 'video_post'){		
		get_template_part('dz-inc/elements/post_template/post_video');	
	}elseif($post_layout == 'link_post'){		
		get_template_part('dz-inc/elements/post_template/post_link');	
	}elseif($post_layout == 'audio_post'){		
		get_template_part('dz-inc/elements/post_template/post_audio');	
	}elseif($post_layout == 'slider_post_1'){						
		get_template_part('dz-inc/elements/post_template/post_slider_1');	
	}elseif($post_layout == 'slider_post_2'){						
		get_template_part('dz-inc/elements/post_template/post_slider_2');	
	}elseif($post_layout == 'post_header_image'){		
		get_template_part('dz-inc/elements/post_template/post_header_image');	
	}else{
		get_template_part('dz-inc/elements/post_template/post_standard');	
	}
		
	wp_reset_postdata();
	get_footer();