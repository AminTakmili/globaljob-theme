<?php /* Template Name: Jobzilla Template */
	get_header() ;
	$jobzilla_option = getDZThemeReduxOption();
	$website_status 		 = !empty($jobzilla_option['website_status']) ? $jobzilla_option['website_status'] : '';
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