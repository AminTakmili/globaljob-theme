<style>
	.bing_map {
		position:relative;
		width:100%;
		height:400px;
	}
</style>
<?php 
if( function_exists( 'get_job_listings' )){
	
	$map_type = jobzilla_get_opt('map_type');
	$google_map_api_key = jobzilla_get_opt('map_api_key');
	$map_class=	'';
	if($map_type == 'openstreetmap'){
		$map_class = 'leaflet-container';	
	}else{
		$map_class = 'bing_map jobs_map leaflet-container';
	}
	$title_selected = $cat_selected = $loc_selected = $region_selected = $color_class = $position_class = $fit_to_height = $position_left = $custom_height =  $search_region = $search_categories  = $show_class = '';
	
	$args_post = array(
		'post_type' 	=> 'job_listing',
		'post_status' 	=> 'publish',
		'orderby'		=>'title',
		'order'			=>'ASC',
		'posts_per_page'  => '',
		'ignore_sticky_posts' => true,
	);
	$job_listing_query = new WP_Query($args_post);
				
		$category_arr = array();
		$category_arr = get_terms( 
							array(
								'taxonomy' => 'job_listing_category',
								'hide_empty'  => false, /* Not return that didn't have any post in it's category */
							) 
						);
	$search_location  = isset($_GET['search_location']) ? $_GET['search_location']: '';				
	$search_keywords  = isset($_GET['search_keywords']) ? $_GET['search_keywords']: '';					
	$orderby  = isset($_GET['orderby']) ? $_GET['orderby']: 'date';					
	if(isset($_GET['search_category'])){
		$trim = get_term_by('slug',$_GET[ 'search_category' ], 'job_listing_category');
		$search_category = isset( $trim->term_id ) ?  absint($trim->term_id) : '';
		$search_categories  =  (array)$search_category;	
	}
	
	$posts = jobzilla_get_cpt_data('job_listing');
	$paged	= get_query_var('paged') ? get_query_var('paged') : 1 ;
	$per_page = !empty($job_listing_map_element_no_of_jobs) ? $job_listing_map_element_no_of_jobs : absint( get_option( 'job_manager_per_page' ) );
	$count = count($posts); 
	$total_pages = ceil( $count / $per_page );
	if($total_pages == $paged){
		$showing_job_count = $count;
	}else{
		$showing_job_count = $per_page * $paged;
	}
	if($paged == 1){
		$showing_data = 1;
	}else{
		$showing_data = $showing_job_count - $per_page;
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
	if(!empty($_GET[ 'search_region' ])){
		$trim = get_term_by('slug',$_GET[ 'search_region' ], 'job_listing_region');
		$search_region = isset( $trim->term_id ) ?  absint($trim->term_id) : '';
		$args['search_region'] =  $search_region;
	}
	if(isset($_GET['filter_by_salary'])){
		$args['filter_by_salary'] = $_GET['filter_by_salary'];
	}
	$jobs = get_job_listings( $args );
	$container = 'container';
	if(!empty($job_listing_map_element_map_style) && ($job_listing_map_element_map_style == 'dz-wide') ){
		$container =  $job_listing_map_element_sereen_width;
		$color_class =  $job_listing_map_element_map_filter_color;
		$position_class =  $job_listing_map_element_position;
		$style_class = ($container == 'container') ? '' : $job_listing_map_element_map_style;
		$fit_to_height =  $job_listing_map_element_fit_to_height;
		if(!empty($job_listing_map_element_fit_to_height) && ($job_listing_map_element_fit_to_height == 'custom')){		
			$custom_height = $job_listing_map_element_height.'px';
		}
	}else if(!empty($job_listing_map_element_map_style) && ($job_listing_map_element_map_style == 'column') ){
		$style_class = $job_listing_map_element_map_style;
		$fit_to_height =  $job_listing_map_element_fit_to_height;
		$show_class = 'show';
		$position_left = ($job_listing_map_element_position_left == 'right')? '' :$job_listing_map_element_position_left;
		if(!empty($job_listing_map_element_fit_to_height) && ($job_listing_map_element_fit_to_height == 'custom')){		
			$custom_height = $job_listing_map_element_height.'px';
		}
	}
	$sort_arr = array(
				'date'=>esc_html__('Date', 'jobzilla'),
				'title'=>esc_html__('Title', 'jobzilla'),
				'name'=>esc_html__('Name', 'jobzilla'),
				'author'=>esc_html__('Author', 'jobzilla'),
				'comment_count' =>esc_html__('Comment Count', 'jobzilla'),
				'meta_value_num' =>esc_html__('View Count', 'jobzilla'),
				'rand' =>esc_html__('Random', 'jobzilla') 
			);
		
?>



<div class="dz-listing-area <?php echo esc_attr($style_class.' '.$position_left ); ?>">
<section class="job_listing_map">
	
	<div class="twm-home3-inner-section <?php echo esc_attr($position_class.' '.$color_class); ?> ">
	  <div class="twm-bnr-mid-section">
		<div class="twm-bnr-search-bar">
			<form  method="get">
				<input type="hidden" id="order_id" name="orderby" value="<?php echo esc_attr($orderby); ?>">
				<div class="row">
						<div class="col-xl-3 col-lg-3 col-md-3">
							<div class="form-group">
								<label class="section-head-small">
									<?php esc_html_e( 'Keywords', 'jobzilla' ); ?>
								</label>
								<div class="input-group">
									<input type="text" class="form-control" name="search_keywords" id="search_keywords" placeholder="Keywords" value="<?php echo esc_attr($search_keywords); ?>">
								</div> 
							</div>
						</div> 
						<?php if(!empty($category_arr)){ ?>
							<div class="form-group col-xl-3 col-lg-3 col-md-3">
								<label>
									<?php echo esc_html__('Category','jobzilla') ?>
								</label>
								<select name="search_category" class=" wt-search-bar-select selectpicker"  data-live-search="true" id="j-All_Category" data-bv-field="size">
									<option disabled selected >
										<?php echo esc_html__('Select Category','jobzilla') ?>
									</option>
									
									<option><?php echo esc_html__('All Category','jobzilla'); ?></option>
									
									<?php foreach($category_arr as $type){
										$cat_selected = !empty($_GET['search_category']) && ($type->slug == $_GET['search_category']) ? 'selected' :'';
										?>
										<option <?php echo esc_attr($cat_selected ); ?>  value="<?php echo esc_attr($type->slug); ?>">
											<?php echo esc_html($type->name); ?>
										</option>                                                  
									<?php } ?>
								</select>
							</div>
						<?php } ?>

					<?php 
						 $region = get_terms( array(
						  'taxonomy'    => 'job_listing_region',
						  'include'     => '',
						  'hide_empty'  => true,
						  'orderby'     => 'include',
						  'order'       => 'ASC', 
						) ); 
						 if(!empty($region)){ ?>
							<!--Location-->
							<div class="form-group col-xl-3 col-lg-3 col-md-3">
								<label><?php echo esc_html__('Regions', 'jobzilla') ?></label>
								<select name="search_region" class="wt-search-bar-select selectpicker"  data-live-search="true" id="j-search_region" data-bv-field="size">
									<option disabled selected>
										<?php echo esc_html__('Select Regions', 'jobzilla') ?>
									</option>
									<option><?php echo esc_html__('All Regions', 'jobzilla'); ?></option>
									<?php foreach($region as $post){ 
										$region_selected = !empty($_GET['search_region']) && ($post->slug == $_GET['search_region']) ? 'selected' : '';
									?>
										<option <?php echo esc_attr($region_selected ); ?> value="<?php echo esc_attr($post->slug); ?>">
											<?php echo esc_html($post->name); ?>
										</option>                                                  
									<?php } ?>
								</select>
								
							</div>
					<?php }
					 if(!empty($job_listing_map_element_search_btn)){ ?>
						<!--Find job btn-->
						<div class="form-group col-xl-3 col-lg-3 col-md-3">
							<button type="submit" class="site-button">
								<?php echo esc_html($job_listing_map_element_search_btn); ?>
							</button>
						</div>
					<?php } ?>
				</div>
			</form>
		</div>
	  </div>
	</div>
	<div class="dz-map <?php  echo esc_attr($fit_to_height); ?>">
		<div id="dz_map"  data-map-scroll="true" style="position: relative; height:<?php echo esc_attr($custom_height); ?>" class="<?php echo esc_attr($map_class); ?>"></div>
	</div>
</section>
<section class="job_listing_area">
	<div class="dz-filter-bar">
		<div class="container">
			<div class="filter-wrapper">
				<div class="filter-left-area">	
					<a data-bs-toggle="collapse" href="#filterTopBtn" role="button" aria-expanded="false" aria-controls="filterTopBtn" class="filter-top-btn">
						<svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M19 3H2.33331L8.99998 10.8833V16.3333L12.3333 18V10.8833L19 3Z" stroke="var(--primary)" stroke-linecap="round" stroke-linejoin="round"/>
						</svg>
						<?php echo esc_html__('Filter', 'jobzilla'); ?>
					</a>
				</div>
				<div class="filter-right-area">
				
				<span><?php echo esc_html__('Showing', 'jobzilla'). esc_html(' '.$showing_data. ' - ' .' '.$showing_job_count. ' '). esc_html__('Of', 'jobzilla').' '.esc_html(' '.count($posts )).esc_html__(' Results', 'jobzilla'); ?></span>
				<div class="form-group" >
					<select class="default-select" id="orderby_id">
						<option><?php echo esc_html__('Default sorting', 'jobzilla'); ?></option>
						<?php foreach($sort_arr as $kye => $value){ 
							$orderby_selected = !empty($_GET['orderby']) && ($kye == $_GET['orderby']) ? 'selected' : '';
						?>
						<option <?php echo esc_attr($orderby_selected); ?> value="<?php  echo esc_attr($kye); ?>"><?php echo esc_html($value); ?></option>
						<?php } ?>
					</select>
				</div>
				<div class="shop-tab">
					<ul class="nav" role="tablist">
						<li class="nav-item ">
							<a class="nav-link active" id="nav-Grid-tab" data-bs-toggle="tab" data-bs-target="#Grid" role="tab" aria-selected="true">	
								<svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
								<rect x="7.93994" y="0.75" width="3.88" height="4" rx="1" stroke="var(--svg-tab-color)"/>
								<rect x="15.62" y="15.75" width="3.88" height="4" rx="1" stroke="var(--svg-tab-color)"/>
								<rect x="15.62" y="7.75" width="3.88" height="4" rx="1" stroke="var(--svg-tab-color)"/>
								<rect x="7.93994" y="8.75" width="3.88" height="4" rx="1" stroke="var(--svg-tab-color)"/>
								<rect x="7.93994" y="15.75" width="3.88" height="4" rx="1" stroke="var(--svg-tab-color)"/>
								<rect x="0.5" y="7.75" width="3.88" height="4" rx="1" stroke="var(--svg-tab-color)"/>
								<rect x="0.5" y="15.75" width="3.88" height="4" rx="1" stroke="var(--svg-tab-color)"/>
								<rect x="15.62" y="0.75" width="3.88" height="4" rx="1" stroke="var(--svg-tab-color)"/>
								<rect x="0.5" y="0.75" width="3.88" height="4" rx="1" stroke="var(--svg-tab-color)"/>
								</svg>

							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link " id="nav-Grid2-tab" data-bs-toggle="tab" data-bs-target="#Grid2" role="tab" aria-selected="true">	
								<svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
								<rect x="1.16663" y="12" width="8" height="8" rx="1" stroke="var(--svg-tab-color)"/>
								<rect x="12.0228" y="12" width="8" height="8" rx="1" stroke="var(--svg-tab-color)"/>
								<rect x="1.16663" y="1" width="8" height="8" rx="1" stroke="var(--svg-tab-color)"/>
								<rect x="12.0228" y="1" width="8" height="8" rx="1" stroke="var(--svg-tab-color)"/>
								</svg>

							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="nav-List-tab" data-bs-toggle="tab" data-bs-target="#List" role="tab" aria-selected="false">
								<svg width="21" height="19" viewBox="0 0 21 19" fill="none" xmlns="http://www.w3.org/2000/svg">
								<rect x="8.16663" y="14.5" width="12.0015" height="4" rx="1" stroke="var(--svg-tab-color)"/>
								<rect x="1.16663" y="14.5" width="4" height="4" rx="1" stroke="var(--svg-tab-color)"/>
								<rect x="8.16663" y="7.5" width="12.0015" height="4" rx="1" stroke="var(--svg-tab-color)"/>
								<rect x="1.16663" y="7.5" width="4" height="4" rx="1" stroke="var(--svg-tab-color)"/>
								<rect x="8.16663" y="0.5" width="12.0015" height="4" rx="1" stroke="var(--svg-tab-color)"/>
								<rect x="1.16663" y="0.5" width="4" height="4" rx="1" stroke="var(--svg-tab-color)"/>
								</svg>

							</a>
						</li>
					</ul>
				</div>
			</div>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="panel panel-default <?php echo esc_attr($show_class); ?>  collapse" id="filterTopBtn">
			<div class="panel-body wt-panel-body p-0 pt-4">
		
				<div class="search_jobs">
					<form method="get" id="FilterForm">
					<input type="hidden" id="sort_id" name="orderby" value="<?php echo esc_attr($orderby); ?>">
					<div class="row">
						<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
							<div class=" form-group">
								<label class="section-head-small">
									<?php esc_html_e( 'Keywords', 'jobzilla' ); ?>
								</label>
								<div class="input-group">
									<input type="text" class="form-control" name="search_keywords" id="search_keywords" placeholder="Keywords" value="<?php echo esc_attr($search_keywords); ?>">
								</div>
							</div>
						</div>
						<?php
						 $posts = get_terms( array(
						  'taxonomy'    => 'job_listing_region',
						  'include'     => '',
						  'hide_empty'  => true,
						  'orderby'     => 'include',
						  'order'       => 'ASC', 
						) ); 
						 if(!empty($posts)){ ?>
							<!--Location-->
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
								<div class="search_categories  form-group">
									<label class="section-head-small"><?php echo esc_html__('Regions', 'jobzilla') ?></label>
									<select name="search_region" class="wt-select-bar-large selectpicker"  data-live-search="true" id="j-search_region" data-bv-field="size">
										<option disabled selected>
											<?php echo esc_html__('Select Regions', 'jobzilla') ?>
										</option>
										<option><?php echo esc_html__('All Regions', 'jobzilla'); ?></option>
										<?php foreach($posts as $post){ 
											$region_selected = !empty($_GET['search_region']) && ($post->slug == $_GET['search_region']) ? 'selected' : '';
										?>
											<option <?php echo esc_attr($region_selected ); ?> value="<?php echo esc_attr($post->slug); ?>">
												<?php echo esc_html($post->name); ?>
											</option>                                                  
										<?php } ?>
									</select>
								</div>
							</div>
					<?php }
					if(!empty($category_arr)){ ?>
						<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
							<div class="search_categories  form-group">
								<label class="section-head-small">
									<?php echo esc_html__('Category','jobzilla') ?>
								</label>
								<select name="search_category" class=" wt-select-bar-large selectpicker"  data-live-search="true" id="j-All_Category" data-bv-field="size">
									<option disabled selected >
										<?php echo esc_html__('Select Category','jobzilla') ?>
									</option>
									
									<option><?php echo esc_html__('All Category','jobzilla'); ?></option>
									
									<?php foreach($category_arr as $type){
										$cat_selected = !empty($_GET['search_category']) && ($type->slug == $_GET['search_category']) ? 'selected' :'';
										?>
										<option <?php echo esc_attr($cat_selected ); ?>  value="<?php echo esc_attr($type->slug); ?>">
											<?php echo esc_html($type->name); ?>
										</option>                                                  
									<?php } ?>
								</select>
							</div>
						</div>
					<?php } ?>
						
						<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">	
							<?php do_action( 'job_manager_job_filters_salary_start' ); ?>
						</div>
					</div>
					<?php if(!empty($job_listing_map_element_search_btn)){ ?>
					 <div class="col-lg-12 col-md-12">                                   
						<div class="text-left">
							<button type="submit" class="site-button"><?php echo esc_html($job_listing_map_element_search_btn); ?></button>
						</div>
					</div> 
					<?php } ?>
				</form>
				</div>
			</div>
		</div>
	</div>
	<div id="AJAXDATA" class="content-inner py-5">
		
	<?php  
		$args_post = array(
			'jobs' => $jobs,
			'paged' => $paged,
		);
		do_action('jobzilla_job_map_listing', $args_post);
	?>
		
	</div>
</section>

</div>
<?php

/* Note: map api key empty condition is right because we load it in functions.php file */
if(empty($google_map_api_key) && $map_type == 'googlemap') {
	$map_path = '?key='.$google_map_api_key;
	wp_enqueue_script( 'jobzilla-map-api', 'https://maps.google.com/maps/api/js'.$map_path, array(), false, false );
}
if(is_admin()){
?>
<link rel="stylesheet" href="<?php echo esc_url(JOBZILLA_URL.'/assets/vendor/leaflet/leaflet.css') ?>" id="leaflet-css">
<?php
}
wp_enqueue_style( 'leaflet', get_template_directory_uri(). '/assets/vendor/leaflet/leaflet.css',array(),1.0  );

if($map_type == 'openstreetmap' || $map_type == 'googlemap'){
	wp_enqueue_script( 'leaflet',  get_template_directory_uri(). '/assets/vendor/leaflet/leaflet.js'); 
	if(is_admin()){
	?>
	<script src="<?php echo esc_url(JOBZILLA_URL.'/assets/vendor/leaflet/leaflet.js') ?>" id="leaflet-js"></script>
	<?php 
	}
	if($map_type == 'googlemap'){
		wp_enqueue_script( 'leaflet-googlemutant',  get_template_directory_uri(). '/assets/vendor/leaflet/leaflet-googlemutant.js');
	if(is_admin()){
	?>
	<script src="<?php echo esc_url(JOBZILLA_URL.'/assets/vendor/leaflet/leaflet-googlemutant.js') ?>" id="leaflet-googlemutant-js"></script>
	<?php }
	}
	
	wp_enqueue_script( 'leaflet-markercluster',  get_template_directory_uri(). '/assets/vendor/leaflet/leaflet.markercluster.js');
	if(is_admin()){
	?>
	<script src="<?php echo esc_url(JOBZILLA_URL.'/assets/vendor/leaflet/leaflet.markercluster.js') ?>" id="leaflet-markercluster-js"></script>
	<?php
	}
}else if($map_type == 'bingmap'){
		
} 
if(is_admin()){
?>
<script src="<?php echo esc_url(JOBZILLA_URL.'/assets/vendor/leaflet/jobzilla-map.js') ?>" id="map-script-js"></script>
<?php 
}
wp_enqueue_script( 'map-script',  get_template_directory_uri(). '/assets/vendor/leaflet/jobzilla-map.js');
?>


<?php 
	if($map_type == 'bingmap')
	{
?>	
		<script type="text/javascript">
			function GetMap(){
				MapScript.getBingMap();
			}

			
		</script>
<?php 
	} 
}