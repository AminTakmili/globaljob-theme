<?php 


function jobzilla_job_manager_resumes_my_job_actions( $candidate_dashboard_columns ){
	
	$candidate_dashboard_columns = array(
			
				'resume-title'       => __( 'Name', 'jobzilla' ),
				'candidate-title'    => __( 'Title', 'jobzilla' ),
				'candidate-location' => __( 'Location', 'jobzilla' ),
				'resume-category'    => __( 'Category', 'jobzilla' ),
				'date'               => __( 'Date Posted', 'jobzilla' ),
				'action'             => __( 'Action', 'jobzilla' ),
		);

	
	return $candidate_dashboard_columns;
	
}


add_action( 'resume_manager_candidate_dashboard_columns', 'jobzilla_job_manager_resumes_my_job_actions');



function jobzilla_job_manager_resumes_fields( $fields ){
		

		/* Fields Priority Start */	
		$priority_field = array(
				'candidate_photo' => 0,
				'resume_content' => 10, 
				'resume_file'    => 9,
		);
		
		if(!empty($fields['resume_fields']['candidate_photo']) || !empty($fields['resume_fields']['candidate_photo'])){
			foreach($priority_field as $field => $priority){
				$fields['resume_fields'][$field]['priority'] = $priority;
			}
			
		}
		/* Fields Priority END */
		
		
		/* Add New Fields  Start */
		
		$extra_fields =  array( 
			'candidate_salary'    => [
				'label'       => esc_html__( 'Current Salary', 'jobzilla' ),
				'type'        => 'text',
				'placeholder' => esc_html__( 'Candidate Current Salary', 'jobzilla' ),
				'description' => '',
				'required'      => true,
				'priority'      => 8,
			],
			'candidate_phone'    => [
				'label'       => esc_html__( 'Contact Phone', 'jobzilla' ),
				'type'        => 'text',
				'placeholder' => esc_html__( '1234567890', 'jobzilla' ),
				'description' => '',
				'priority'      => 5,
				'required'      => true,
			],
			'candidate_qualification'    => [
					'label'       => esc_html__( 'Qualification', 'jobzilla' ),
					'placeholder' => esc_html__( 'Bachelor Degree', 'jobzilla' ),
					'description' => '',
					'type'        => 'text',
					'required'      => true,
					'priority'      => 7,
				],
			'candidate_job_experience' => [
				'label'       => esc_html__( 'Experience', 'jobzilla' ),
				'type'        => 'text',
				'placeholder' => esc_html__( 'How many years of experience do you have', 'jobzilla' ),
				'priority'      => 6,
				'required'      => true,
			],
			'candidate_gender' => [
				'label'       => esc_html__( 'Gender', 'jobzilla' ),
				'placeholder' => esc_html__( 'Select Gender', 'jobzilla' ),
				'type'		  => 'select',
				'options' 	  => [
					'male'=> esc_html__('Male', 'jobzilla'),
					'female'=> esc_html__('Female', 'jobzilla'),
					'both'=> esc_html__('Both', 'jobzilla')
				],
				'priority'      => 5,
				'required'      => true,
			],	 
			'candidate_detail_layout' => [
				'label'       => esc_html__( 'Candidate Detail Layout', 'jobzilla' ),
				'type'		  => 'select',
				'required'      => false,
				'priority'    => 9,
				'options' 	  => [
					'standard'=> esc_html__('Standard', 'jobzilla'),
					'full_width'=>esc_html__('Full Width', 'jobzilla')
				],
			],	
			'candidate_geolocation_lat' => [
				'label'       => esc_html__( 'Latitude ', 'jobzilla' ),
				'type'		  => 'text',
				'required'      => false,
				'priority'    => 10,
			],	
			'candidate_geolocation_long' => [
				'label'       => esc_html__( 'Longitude ', 'jobzilla' ),
				'type'		  => 'text',
				'required'      => false,
				'priority'    => 10,
			],	
			
		);
		
		$resume_fields = array_merge($fields['resume_fields'], $extra_fields);	
		$fields['resume_fields'] = $resume_fields;	

	
	return $fields;
		
	/* Add New Fields  END */
		
		
			
	
}


add_action('submit_resume_form_fields', 'jobzilla_job_manager_resumes_fields');




/* Add Resume From WP Admin Form Fields Filter */
function jobzilla_resume_manager_resume_fields( $fields ){
	$extra_fields = array(
					'_candidate_salary'    => [
						'label'       => esc_html__( 'Current Salary', 'jobzilla' ),
						'placeholder' => esc_html__( 'Candidate Current Salary', 'jobzilla' ),
						'description' => '',
					],
					'_candidate_phone'    => [
						'label'       => esc_html__( 'Contact Phone', 'jobzilla' ),
						'placeholder' => esc_html__( '1234567890', 'jobzilla' ),
						'description' => '',
					],
					'_candidate_qualification'    => [
						'label'       => esc_html__( 'Qualification', 'jobzilla' ),
						'placeholder' => esc_html__( 'Bachelor Degree', 'jobzilla' ),
						'description' => '',
					],
					'_candidate_job_experience' => [
		                'label'       => esc_html__( 'Experience', 'jobzilla' ),
		                'placeholder' => esc_html__( 'How many years of experience do you have', 'jobzilla' ),
		            ],
		            '_candidate_gender' => [
		                'label'       => esc_html__( 'Gender', 'jobzilla' ),
		                'placeholder' => esc_html__( 'Select Gender', 'jobzilla' ),
		                'type'		  => 'select',
		                'options' 	  => [
							'male'=> esc_html__('Male', 'jobzilla'),
							'female'=> esc_html__('Female', 'jobzilla'),
							'both'=> esc_html__('Both', 'jobzilla')
						]
		            ],	
					'_candidate_detail_layout' => [
						'label'       => esc_html__( 'Candidate Detail Layout', 'jobzilla' ),
						'type'		  => 'select',
						'options' 	  => [
							'standard'=> esc_html__('Standard', 'jobzilla'),
							'full_width'=>esc_html__('Full Width', 'jobzilla')
						]
					],	
					'_candidate_geolocation_lat' => [
						'label'       => esc_html__( 'Latitude ', 'jobzilla' ),
						'type'		  => 'text',
						'placeholder' => esc_html__( '26.9026609192594', 'jobzilla' ),
					],	
					'_candidate_geolocation_long' => [
						'label'       => esc_html__( 'Longitude ', 'jobzilla' ),
						'type'		  => 'text',
						'placeholder' => esc_html__( '75.80664793220636', 'jobzilla' ),
					],	
				);

	$fields = array_merge($fields,$extra_fields);
	
	
	return $fields;
	
}
add_action( 'resume_manager_resume_fields','jobzilla_resume_manager_resume_fields');


add_filter('resume_manager_settings', 'jobzilla_resume_visibility');
function jobzilla_resume_visibility($settings){
	if($settings['resume_listings'][1]){
		foreach($settings['resume_listings'][1] as $key => $field){
			if($field['name'] == 'resume_manager_enable_categories' || $field['name'] == 'resume_manager_enable_skills'){
				$settings['resume_listings'][1][$key]['std'] = 1;
			}
		}
	}
	
	if($settings['resume_visibility'][1]){
		foreach($settings['resume_visibility'][1] as $key => $field){
			if($field['name'] == 'resume_manager_view_name_capability' || $field['name'] == 'resume_manager_browse_resume_capability'){
				$settings['resume_visibility'][1][$key]['std'] = '';
			}
		}
	}
return $settings;
}