<?php  /* file not confirm where to use */
	$locreg_widget = $job_types_widget = $job_categories_widget = $salary_widget = $rate_widget = $job_tags_widget = 'on';

	if(is_page()) {
		$locreg_widget 			= true; 
		$job_types_widget 		= true; 
		$job_tags_widget 		= true; 
		$job_categories_widget 	= true; 
		$salary_widget 			= true; 
		$rate_widget 			= true; 
	} 

	if ( ! empty( $_GET['search_keywords'] ) ) {
		$keywords = sanitize_text_field( $_GET['search_keywords'] );
	} else {
		$keywords = '';
	}

	if ( ! empty( $_GET['search_location'] ) ) {
		$location = sanitize_text_field( $_GET['search_location'] );
	} else {
		$location = '';
	}

	if ( !empty( $_GET['search_categories'] ) ) {
		$selected_category = sanitize_text_field( $_GET['search_categories'] );
	} else {
		$selected_category = "";
	}
	
	$show_category_multiselect = get_option( 'job_manager_enable_default_category_multiselect', false );
?>
	<!-- Widgets -->
	<div class="col-lg-4 col-md-12 rightSidebar">
		<div class="side-bar">
			<div class="sidebar-elements search-bx">                                                    
				<form class="job-filters" method="post" action="">

				
					<?php 
					if ( ! is_tax( 'job_listing_category' ) && get_terms( 'job_listing_category' ) ) {
						$show_category_multiselect = get_option( 'job_manager_enable_default_category_multiselect', false ); 

						if ( !empty( $_GET['search_category'] ) ) {
							$selected_category = sanitize_text_field( $_GET['search_category'] );
						} else {
							$selected_category = "";
						}
						
						
						?>
						<div class="form-group mb-4">
							<h4 class="section-head-small mb-4"><?php esc_html_e('Category','jobzilla'); ?></h4>
								<?php if ( $show_category_multiselect ) { 
									
									echo job_manager_dropdown_categories( 
											array( 
												'taxonomy' => 'job_listing_category', 
												'hierarchical' => 1,
												'depth' => -1, 
												'class' =>  'wt-select-bar-large dz-wjm-cat-dropdown ' . ( is_rtl() ? 'chosen-rtl' : '' ),
												'name' => 'search_categories', 
												'orderby' => 'name', 
												'selected' => $selected_category, 
												'hide_empty' => false,
												'echo' => false 
											) 
										); 
									
									} else{
										
									
									$dropdown = job_manager_dropdown_categories( array( 
									'taxonomy' => 'job_listing_category', 
									'hierarchical' => 1, 
									'class' =>  'wt-select-bar-large dz-wjm-cat-dropdown ' . ( is_rtl() ? 'chosen-rtl' : '' ),
									'show_option_all' => esc_html__( 'Any category', 'jobzilla' ), 
									'name' => 'search_categories', 
									'orderby' => 'name', 
									'selected' => $selected_category, 
									'multiple' => false,
									'echo' => false,
									'hide_empty' => false ) );
										$fixed_dropdown = str_replace( '&nbsp;&nbsp;&nbsp;', '- ', $dropdown); echo esc_html($fixed_dropdown); 
								
								} 
								
								?>
								
							
						</div>
					<?php }else{ ?>
						<input type="hidden" name="search_categories[]" value="<?php echo sanitize_title( get_query_var('job_listing_category') ); ?>" />
					<?php } ?>

					<?php if(get_query_var( 'company')) {?>
						<input type="hidden" name="company_field" value="<?php echo urldecode( get_query_var( 'company') ) ?>">
					<?php } ?>

					<?php 
					
						if ( !empty( $_GET['search_keywords'] ) ) {
							$search_keyword_value = sanitize_text_field( $_GET['search_keywords'] );
						} else {
							$search_keyword_value = '';
						}
					
					?>
					<div class="form-group mb-4">
						<h4 class="section-head-small mb-4"><?php echo esc_html__('Keyword','jobzilla'); ?></h4>
						<div class="input-group">
							<input type="text" name="search_keywords" value="<?php echo esc_attr($search_keyword_value); ?>" class="form-control dz-wjm-keyword-filter search_keywords" placeholder="<?php echo esc_attr('Job Title or Keyword', 'jobzilla'); ?>">
							<button class="btn" type="button"><i class="feather-search"></i></button>
						</div>
					</div>
					
					<?php 
					
						if ( !empty( $_GET['search_location'] ) ) {
							$search_location_value = sanitize_text_field( $_GET['search_location'] );
						} else {
							$search_location_value = '';
						}
					
					?>
					
					<div class="form-group mb-4">
						<h4 class="section-head-small mb-4"><?php echo esc_html__('Location','jobzilla'); ?></h4>
						<div class="input-group">
							<input type="text" name="search_location" value="<?php echo esc_attr($search_location_value); ?>" class="form-control dz-wjm-location-filter search_location" placeholder="<?php echo esc_attr('Search location', 'jobzilla'); ?>">
							<button class="btn" type="button"><i class="feather-map-pin"></i></button>
						</div>
					</div>
					
					
					
					<?php if ( class_exists('Astoundify_Job_Manager_Regions') && get_option( 'job_manager_regions_filter' ) ) 
						{  ?>
					<div class="form-group mb-4">
						<h4 class="section-head-small mb-4"><?php echo esc_html__('Regions','jobzilla'); ?></h4>
						<div class="input-group">
							<?php
							
								$selected = isset( $_GET[ 'search_region' ] ) ? absint($_GET[ 'search_region' ]) : '';
							
								echo wp_dropdown_categories( array(
									'show_option_all'           => esc_html__( 'All Regions', 'jobzilla' ),
									'hierarchical'              => true,
									'orderby'                   => 'name',
									'taxonomy'                  => 'job_listing_region',
									'name'                      => 'search_region',
									'id'                        => 'search_region',
									'class'                     => 'wt-select-bar-large selectpicker dz-wjm-region-dropdown search_region',
									'multiple' 					=> true,
									'selected'                  => $selected,
									'echo'                      => false,
								)  ); 
							
							?>
							
						</div>
					</div>
					<?php } ?>

					<?php if ( get_option( 'job_manager_enable_types' ) ) { ?>
					<div class="twm-sidebar-ele-filter">
						<h4 class="section-head-small mb-4"><?php echo esc_html__('Job Types','jobzilla'); ?></h4>
						
						<?php get_job_manager_template( 'job-filter-job-types.php', array( 'job_types' => '', 'atts' => array('orderby' => 'rand'), 'selected_job_types' => [] ) ); ?>
					
					</div>
					<?php } ?>
					
					<?php if (true) { /* pending */ ?>
					<div class="twm-sidebar-ele-filter" id="DZTagFilter">
						<h4 class="section-head-small mb-4"><?php echo esc_html__('Job Tags','jobzilla'); ?></h4>
						<div class="dz-filter-by-tag-cloud"></div>
					</div>
					<?php } ?>

					<div class="twm-sidebar-ele-filter">
						<h4 class="section-head-small mb-4">Date Posts</h4>
						<ul>
							<li>
								<div class="form-check">
									<input type="radio" class="form-check-input" id="exampleradio1">
									<label class="form-check-label" for="exampleradio1">Last hour</label>
								</div>
							</li>
							<li>
								<div class="form-check">
									<input type="radio" class="form-check-input" id="exampleradio2">
									<label class="form-check-label" for="exampleradio2">Last 24 hours</label>
								</div>
							</li>

							<li>
								<div class="form-check">
									<input type="radio" class="form-check-input" id="exampleradio3">
									<label class="form-check-label" for="exampleradio3">Last 7 days</label>
								</div>
							</li>

							<li>
								<div class="form-check">
									<input type="radio" class="form-check-input" id="exampleradio4">
									<label class="form-check-label" for="exampleradio4">Last 14 days</label>
								</div>
							</li>

							<li>
								<div class="form-check">
									<input type="radio" class="form-check-input" id="exampleradio5">
									<label class="form-check-label" for="exampleradio5">Last 30 days</label>
								</div>
							</li>

							<li>
								<div class="form-check">
									<input type="radio" class="form-check-input" id="exampleradio6">
									<label class="form-check-label" for="exampleradio6">All</label>
								</div>
							</li>
		 
						</ul>
					</div>

					<div class="twm-sidebar-ele-filter">
						<h4 class="section-head-small mb-4">Type of employment</h4>
						<ul>
							<li>
								<div class="form-check">
									<input type="radio" class="form-check-input" id="Freelance1">
									<label class="form-check-label" for="Freelance1">Freelance</label>
								</div>
							</li>
							<li>
								<div class="form-check">
									<input type="radio" class="form-check-input" id="FullTime1">
									<label class="form-check-label" for="FullTime1">Full Time</label>
								</div>
							</li>

							<li>
								<div class="form-check">
									<input type="radio" class="form-check-input" id="Intership1">
									<label class="form-check-label" for="Intership1">Intership</label>
								</div>
							</li>

							<li>
								<div class="form-check">
									<input type="radio" class="form-check-input" id="Part-Time1">
									<label class="form-check-label" for="Part-Time1">Part Time</label>
								</div>
							</li>
		 
						</ul>
					</div>
					
				</form>
                                    
			</div>
			<?php dynamic_sidebar( 'sidebar-jobs' ); ?>
		</div>
		
	</div><!-- #secondary -->
