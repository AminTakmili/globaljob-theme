<?php 

/**
 * jobzilla_job_manager_my_job_actions
 **/
function jobzilla_job_manager_my_job_actions($actions){
	
	foreach($actions as $action => $data){
		
		if($action == 'edit'){
			$actions[$action]['class'] = 'far fa-edit';
		}else if($action == 'mark_not_filled'){
			$actions[$action]['class'] = 'fa fa-times';
		}else if($action == 'duplicate'){
			$actions[$action]['class'] = 'fa fa-clone';
		}else if($action == 'delete'){
			$actions[$action]['class'] = 'far fa-trash-alt';
		}else if($action == 'continue'){
			$actions[$action]['class'] = 'fa fa-reply-all';
		}else if($action == 'mark_filled'){
			$actions[$action]['class'] = 'fa fa-check';
		}else if($action == 'relist'){
			$actions[$action]['class'] = 'fa fa-ban';
		}
		
		
	}
	
	return $actions;
	
}


add_action( 'job_manager_my_job_actions', 'jobzilla_job_manager_my_job_actions');



add_filter( 'job_manager_settings','jobzilla_job_manager_company_settings');
	function jobzilla_job_manager_company_settings( $settings ) {
				
			if($settings['job_listings'][1]){
				foreach($settings['job_listings'][1] as $key => $field){
					if($field['name'] == 'job_manager_enable_categories'){
						$settings['job_listings'][1][$key]['std'] = 1;	
					}
				}
				
			}

			$settings['mas_wpjmc_settings'][1][] = array(
				'name'      => 'jobzilla_list_layout_id',
				'std'       => '',
				'label'     => esc_html__( 'List Layout Page', 'jobzilla' ),
				'desc'      => esc_html__( 'Select the page for company listing. This lets the plugin know the location of the company listings page.', 'jobzilla' ),
				'type'      => 'select',
				'options' 	  => ['list'=>'list','grid'=>'grid'],
			);
		return $settings;
    }


/**
 * jobzilla_job_manager_my_job_actions
 **/

function jobzilla_job_manager_job_dashboard_columns($columns){
	
	 $columns = array(
				'job_title' 	=> esc_html__('Job Title','jobzilla'),
				'job_type' 		=> esc_html__('Job Type','jobzilla'),
				'filled' 		=> esc_html__('Filled?','jobzilla'),
				'date' 			=> esc_html__('Date Posted','jobzilla'),
				'closing_date'	=> esc_html__('Closing Date','jobzilla'),
				'expires'		=> esc_html__('Listing Expires','jobzilla'),
				'applications' 	=> esc_html__('Applications','jobzilla'),
				'action' 		=> esc_html__('Actions','jobzilla'),
			);
	return $columns; 
	
}
add_action( 'job_manager_job_dashboard_columns', 'jobzilla_job_manager_job_dashboard_columns');

function job_form_fields($fields){
	
	
	$priority_field = array(
			'remote_position' => 14,
			'job_description' => 15,
	);
	$company_priority_field = array(
		'company_logo' => 0,
	);
	
	if(!empty($fields['job']['remote_position']) || !empty($fields['job']['job_description']) || !empty($fields['company']['company_logo'])){
		
		foreach($priority_field as $field => $priority){
			if(!empty($fields['job'][$field])){
				$fields['job'][$field]['priority'] = $priority;
			}
		}
		
		foreach($company_priority_field as $field => $priority){
			if(!empty($fields['company'][$field])){
				$fields['company'][$field]['priority'] = $priority;	
			}
		}
		
	}
	
	$extra_fields = array(
					'job_qualification'    => [
						'label'       => esc_html__( 'Qualification', 'jobzilla' ),
						'placeholder' => esc_html__( 'Bachelor Degree', 'jobzilla' ),
						'description' => '',
						'type'        => 'text',
						'required'    => true,
						'priority'    => 11,
					],
					'job_experience' => [
		                'label'       => esc_html__( 'Experience', 'jobzilla' ),
		                'placeholder' => esc_html__( 'How many years of experience do you required', 'jobzilla' ),
						'type'        => 'text',
						'required'    => true,
						'priority'    => 12,
		            ],
		            'job_gender' => [
		                'label'       => esc_html__( 'Gender', 'jobzilla' ),
		                'type'		  => 'select',
		                'options' 	  => [
							'male'=> esc_html__('Male', 'jobzilla'),
							'female'=> esc_html__('Female', 'jobzilla'),
							'both'=> esc_html__('Both', 'jobzilla')
						],
						'required'    => false,
						'priority'    => 13,
		            ],	 
					'job_detail_layout' => [
		                'label'       => esc_html__( 'Job Detail Layout', 'jobzilla' ),
		                'type'		  => 'select',
		                'options' 	  => [
							'standard'=> esc_html__('Standard', 'jobzilla'),
							'full_width'=>esc_html__('Full Width', 'jobzilla')
						],
						'required'    => false,
						'priority'    => 14,
		            ],
					'longitude' => [
		                'label'       => esc_html__( 'Longitude', 'jobzilla' ),
		                'placeholder' => esc_html__( 'Location Longitude', 'jobzilla' ),
						'type'        => 'text',
						'required'    => false,
						'priority'    => 12,
		            ],
					'latitude' => [
		                'label'       => esc_html__( 'Latitude', 'jobzilla' ),
		                'placeholder' => esc_html__( 'Location Latitude', 'jobzilla' ),
						'type'        => 'text',
						'required'    => false,
						'priority'    => 20,
		            ],
					'show_sidebar' => [
		                'label'       => esc_html__( 'Sidebar(on/off)', 'jobzilla' ),
						'type'        => 'checkbox',
						'required'    => false,
						'priority'    => 21,
						'description' => esc_html__('Job Detail Sidebar (on/off)','jobzilla'),
		            ],			
					
				);
	if(!empty(get_option('job_manager_enable_salary'))){
		$fields['job']['salary_max'] = array(
			'label'       => esc_html__( 'Maximum Salary', 'jobzilla' ),
			'type'        => 'text',
			'required'    => false,
			'placeholder' => esc_html__( 'e.g. 50000', 'jobzilla' ),
			'priority'    => 10
		);
	}
	$fields['job']['job_salary']['label'] = 'Minimum Salary';
	$job_fields = array_merge($fields['job'],$extra_fields);
	$fields['job'] = $job_fields;
	
	return $fields;
}

add_action('submit_job_form_fields', 'job_form_fields');

add_action( 'job_manager_job_listing_data_fields','jobzilla_job_manager_job_listing_data_fields');
/* Add Job Manager From WP Admin Form Fields Filter */
function jobzilla_job_manager_job_listing_data_fields( $fields ){
	 
	$extra_fields = array(
					'_job_qualification'    => [
						'label'       => esc_html__( 'Qualification', 'jobzilla' ),
						'placeholder' => esc_html__( 'Bachelor Degree', 'jobzilla' ),
						'description' => '',
					],
					'_job_experience' => [
		                'label'       => esc_html__( 'Experience', 'jobzilla' ),
		                'placeholder' => esc_html__( 'How many years of experience do you required', 'jobzilla' ),
		            ],
		            '_job_gender' => [
		                'label'       => esc_html__( 'Gender', 'jobzilla' ),
		                'type'		  => 'select',
		                'options' 	  => [
							'male'=> esc_html__('Male', 'jobzilla'),
							'female'=> esc_html__('Female', 'jobzilla'),
							'both'=> esc_html__('Both', 'jobzilla')
						]
		            ],	
					
					'_job_detail_layout' => [
		                'label'       => esc_html__( 'Job Detail Layout', 'jobzilla' ),
		                'type'		  => 'select',
		                'options' 	  => [
							'standard'=> esc_html__('Standard', 'jobzilla'),
							'full_width'=>esc_html__('Full Width', 'jobzilla')
						]
		            ],
					'_longitude' => [
		                'label'       => esc_html__( 'Longitude', 'jobzilla' ),
		                'placeholder' => esc_html__( 'Location Longitude', 'jobzilla' ),
						'type'        => 'text',
						'required'    => false,
						'priority'    => 19,
		            ],
					'_latitude' => [
		                'label'       => esc_html__( 'Latitude', 'jobzilla' ),
		                'placeholder' => esc_html__( 'Location Latitude', 'jobzilla' ),
						'type'        => 'text',
						'required'    => false,
						'priority'    => 20,
		            ],			
					'_show_sidebar' => [
		                'label'       => esc_html__( 'Sidebar(on/off)', 'jobzilla' ),
						'type'        => 'checkbox',
						'required'    => false,
						'description' => esc_html__('Job Detail Sidebar (on/off)','jobzilla'),
		            ],	
					
				);
	$fields['_job_salary']['label'] = 'Minimum Salary';
	if(!empty(get_option('job_manager_enable_salary'))){
		$fields['_salary_max'] = array(
			'label'       => esc_html__( 'Maximum Salary', 'jobzilla' ),
			'type'        => 'text',
			'placeholder' => esc_html__( 'e.g. 50000', 'jobzilla' ),
			'description' => esc_html__('Maximum of salary range you can offer - you can leave it empty and set only minimum salary ','jobzilla'),
		);
	}
	$fields = array_merge($fields,$extra_fields);
	
	return $fields;
	
}



function jobzilla_regions_class_add( $atts ){
	$atts['class'] .=' wt-select-bar-large selectpicker';
	return $atts; 	
}
add_action( 'job_manager_regions_dropdown_args', 'jobzilla_regions_class_add');  



/*remove bookmarks link*/
if ( class_exists( 'WP_Job_Manager_Bookmarks' ) ) {
	global $job_manager_bookmarks;
	remove_action( 'single_job_listing_meta_after', array( $job_manager_bookmarks, 'bookmark_form' ) );
	remove_action( 'single_resume_start', array( $job_manager_bookmarks, 'bookmark_form' ) );

	add_action( 'jobzilla_bookmark_hook', array( $job_manager_bookmarks, 'bookmark_form' ) );
	add_action( 'jobzilla_bookmark_hook', array( $job_manager_bookmarks, 'bookmark_form' ) );
}
/* global $job_manager;
remove_action( 'plugin_action_links',  array($job_manager, 'plugin_links')  ); */
/* Profile View Count: code_change */

function jobzilla_wpjm_view() {
	
	if ( ! is_singular( 'resume' ) && ! is_singular( 'job_listing' )  ) {	
		return;
	}
	
	

	global $post;

	// view days
	$today = date('Y-m-d', time());
	$current_month = date('M', time());
	$current_year = date('Y', time());
	$view_by_month_key = '_views_by_'.$current_year.'_month';
	$views_by_date  = get_post_meta($post->ID, '_views_by_date', true);
	$views_by_month = get_post_meta($post->ID, $view_by_month_key, true);
	if( $views_by_date != '' || is_array($views_by_date) ) {
				
		if (!isset($views_by_date[$today])) {
			if ( count($views_by_date) > 60 ) {
				array_shift($views_by_date);
			}
			$views_by_date[$today] = 1;
		} else {
			$views_by_date[$today] = intval($views_by_date[$today]) + 1;
		}
	} else {
		$views_by_date = array();
		$views_by_date[$today] = 1;
	}
	
	
	
	if( $views_by_month != '' || is_array($views_by_month) ) {
				
		if (!isset($views_by_month[$current_month])) {
			if ( count($views_by_month) > 60 ) {
				array_shift($views_by_month);
			}
			$views_by_month[$current_month] = 1;
		} else {
			$views_by_month[$current_month] = intval($views_by_month[$current_month]) + 1;
		}
	} else {
		$views_by_month = array();
		$views_by_month[$current_month] = 1;
	}
	
	update_post_meta($post->ID, '_views_by_date', $views_by_date);
	update_post_meta($post->ID, $view_by_month_key, $views_by_month);
}

add_action('wp_ajax_jobzilla_ajax_get_views_by_date', 'jobzilla_get_views_by_date');
add_action('wp_ajax_nopriv_jobzilla_ajax_get_views_by_date','jobzilla_get_views_by_date');

function jobzilla_get_views_by_date($post_id){
				$number_days = 11;
				$response = array();
				if(!empty($_POST)){
					$post_id = sanitize_text_field($_POST['post_id']);
				}
				if(!empty($_POST['year'])){
					$current_year = sanitize_text_field($_POST['year']);								
				}else{
					$current_year = date('Y', time());
				}
				
				$array_labels = array(
									'0' => 'Jan',
								    '1' => 'Feb',
									'2' => 'Mar',
									'3' => 'Apr',
									'4' => 'May',
									'5' => 'Jun',
									'6' => 'Jul',
									'7' => 'Aug',
									'8' => 'Sep',
									'9' => 'Oct',
									'10' => 'Nov',
									'11' => 'Dec'
								);
				
				
				$views_by_month = get_post_meta( $post_id, '_views_by_'.$current_year.'_month', true );
				
				/* Show Company and Job singular view using drop down (list of company or list of jobs of employer)
				*/
				if ( !is_array( $views_by_month ) ) {
					$views_by_month = array();
				}

				$array_values = array();
				for ($i=0; $i <= $number_days; $i++) { 
					$date = $array_labels[$i];
					if ( isset($views_by_month[$date]) ) {
						$array_values[$i] = $views_by_month[$date];
					} else {
						$array_values[] = 0;
					}
				}  
			$array_data = array(
							'labels' => $array_labels,
							'values' => $array_values,
						);
			if(!empty($_POST)){
				$response['dataSerieslabel'] = $array_labels;
				$response['dataSeries'] = $array_values;
				echo json_encode($response);
				exit;
			}				
						
	return $array_data;
}
if(jobzilla_check_plugin_active('dz-user-message/dz-user-message.php')){
	function get_message_user_data($sender_id = '', $receiver_id= '', $limit = ''){
		$user_id = get_current_user_id();
		$limit = !empty($limit) ? $limit:''; 
		$message_obj = new Jobzilla_Messages();
		if(!empty($sender_id) && !empty($receiver_id)){
			$output = $message_obj->_getParentId($sender_id, $receiver_id);
		}else{
			$output = $message_obj->get_conversations($user_id,$limit);
		}
		
		return $output;
	}
}

add_action('job_manager_job_filters_search_jobs_tag_end', 'jobzilla_show_tag_filter');

	function jobzilla_show_tag_filter( $shortcode_atts ) {
		if ( isset( $shortcode_atts['show_tags'] ) && ( $shortcode_atts['show_tags'] === false || (string) $shortcode_atts['show_tags'] == 'false' ) ) {
			return;
		}

		if ( wp_count_terms( 'job_listing_tag' ) == 0 ) {
			return;
		}

		wp_enqueue_script( 'wp-job-manager-ajax-tag-filters', JOB_MANAGER_TAGS_PLUGIN_URL . '/assets/dist/js/tag-filter.js', array( 'jquery' ), JOB_MANAGER_TAGS_VERSION, true );

		echo '<div class="filter_wide filter_by_tag"><label class="section-head-small">' .  __( 'Filter by tag:', 'jobzilla' ) . '</label> <span class="filter_by_tag_cloud"></span></div>';
	}
