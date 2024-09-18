<?php /* Template Name: Jobzilla Template No Header-Only-Footer */
	get_header('login');
	
		while( have_posts() )
		{ 
			the_post(); 
			the_content();
		}
	

	get_footer();
?>