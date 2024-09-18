<?php 

	get_header();
	jobzilla_get_post_banner();
	
	while( have_posts() )
	{ 
		the_post(); 
		the_content();
	}
			
	
	get_footer();
	
	wp_reset_postdata();