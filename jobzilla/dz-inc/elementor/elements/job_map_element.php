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
	
	
	$posts = jobzilla_get_cpt_data('job_listing');
	$container = 'container';
	
	$filter_map = jobzilla_get_opt('jobzilla_job_filter_map_page');
	$color_class =  $job_map_element_map_filter_color;
	$position_class =  $job_map_element_position;
	$fit_to_height =  $job_map_element_fit_to_height;
	if(!empty($job_map_element_fit_to_height) && ($job_map_element_fit_to_height == 'custom')){		
		$custom_height = $job_map_element_height.'px';
	}
	
		
?>



<div class="dz-listing-area dz-wide">
<section class="job_listing_map">
	
	<div class="twm-home3-inner-section <?php echo esc_attr($position_class.' '.$color_class); ?> ">
	  <div class="twm-bnr-mid-section">
		<div class="twm-bnr-search-bar">
			<form  method="get" action="<?php echo home_url( $filter_map ); ?>">
				<div class="row">
						<div class="col-xl-3 col-lg-3 col-md-3">
							<div class="form-group">
								<label class="section-head-small">
									<?php esc_html_e( 'Keywords', 'jobzilla' ); ?>
								</label>
								<div class="input-group">
									<input type="text" class="form-control" name="search_keywords" id="search_keywords" placeholder="Keywords" value="">
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
										
										?>
										<option  value="<?php echo esc_attr($type->slug); ?>">
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
										
									?>
										<option value="<?php echo esc_attr($post->slug); ?>">
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
		<div id="dz_map"  data-map-scroll="true" style="position: relative; <?php  if(!empty($custom_height)){ ?> height:<?php echo esc_attr($custom_height); ?>" <?php } ?> class="<?php echo esc_attr($map_class); ?>"></div>
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