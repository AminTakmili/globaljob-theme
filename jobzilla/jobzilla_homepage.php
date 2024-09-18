<?php /* Template Name: Jobzilla Home Page */
	
	get_header() ;
	$jobzilla_option = getDZThemeReduxOption();
	$website_status 		 = !empty($jobzilla_option['website_status']) ? $jobzilla_option['website_status'] : '';

    wp_dequeue_script( 'wp-job-manager-ajax-filters'  );
	wp_enqueue_script( 'jobzilla-wp-job-manager-ajax-filters' );

	wp_dequeue_script('wp-resume-manager-ajax-filters' );
	wp_enqueue_script('jobzilla-wp-resume-manager-ajax-filters' );

	if(isWebsiteReadyForVisitor($website_status)){	
		jobzilla_get_banner();
		while( have_posts() )
		{ 
			the_post(); 
			the_content();
		}
		
	}

	get_footer(); 
?>