<?php 
function job_application_form_fields($application_fields){
	
		
				$field_priority = array(
						'application_message' => 10,
					);
	if(!empty($application_fields['application_message'])){
		
		foreach($field_priority as $key => $value){
			$application_fields['application_message']['priority'] = $value;
		}
	}
	return $application_fields;
}
 
add_action( 'job_application_form_fields', 'job_application_form_fields' );