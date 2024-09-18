<?php
add_action('wp_ajax_jobzilla_job_listing_filter', 'jobzilla_job_listing_filter');
add_action('wp_ajax_nopriv_jobzilla_job_listing_filter', 'jobzilla_job_listing_filter');
function jobzilla_job_listing_filter(){

	$title_selected = $cat_selected = $loc_selected = $region_selected = $color_class = $position_class = $fit_to_height = $position_left = $custom_height =  $search_region = $search_categories  = $show_class = '';
	
	$search_location  = isset($_POST['search_location']) ? $_POST['search_location']: '';				
	$search_keywords  = isset($_POST['search_keywords']) ? $_POST['search_keywords']: '';					
	$orderby  = isset($_POST['orderby']) ? $_POST['orderby']: 'date';					
	if(isset($_POST['search_category'])){
		$trim = get_term_by('slug',$_POST[ 'search_category' ], 'job_listing_category');
		$search_category = isset( $trim->term_id ) ?  absint($trim->term_id) : '';
		$search_categories  =  (array)$search_category;	
	}
	$paged	= get_query_var('paged') ? get_query_var('paged') : 1 ;
	$per_page = !empty($job_listing_map_element_no_of_jobs) ? $job_listing_map_element_no_of_jobs : absint( get_option( 'job_manager_per_page' ) );
	$showing_job_count = $per_page * $paged;
	if($paged == 1){
		$test = 1;
	}else{
		$test = $showing_job_count - $per_page;
	}
	$args = array(
			'search_location'   => $search_location,
			'search_keywords'   => $search_keywords,
			'search_categories' => $search_categories,
			'post_status'       => 'publish',
			'orderby'           => $orderby,
			'order'             => $job_listing_map_element_order,
			'offset'            => ( $paged - 1 ) * $per_page,
			'posts_per_page'    => max( 1, $per_page ),
		);
	if(!empty($_POST[ 'search_region' ])){
		$trim = get_term_by('slug',$_POST[ 'search_region' ], 'job_listing_region');
		$search_region = isset( $trim->term_id ) ?  absint($trim->term_id) : '';
		$args['search_region'] =  $search_region;
	}
	if(isset($_POST['filter_by_salary'])){
		$args['filter_by_salary'] = $_POST['filter_by_salary'];
	}

	$jobs = get_job_listings( $args );
	$args_post = array(
			'jobs' => $jobs,
			'paged' => $paged,
		);
	
}