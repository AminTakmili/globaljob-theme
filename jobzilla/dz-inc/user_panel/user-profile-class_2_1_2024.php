<?php 

       add_action('wp_ajax_jobzilla_user_profile_data', 'jobzilla_user_profile_data');
	   add_action('wp_ajax_nopriv_jobzilla_user_profile_data', 'jobzilla_user_profile_data');
	 function jobzilla_user_profile_data(){
		$response = array(
			'status'=>false,
			'redirect_url'=> '',
			'msg'=>esc_html__('Something went wrong, Please try again.','jobzilla'),
		); 
		$error_obj = new WP_Error();
		if ( isset( $_POST['my-account-submission'] ) && '1' == $_POST['my-account-submission'] ) {
			$current_user = wp_get_current_user();
			$error = array();  

			if ( isset( $_POST['email'] ) ){

				if (!is_email(esc_attr( $_POST['email'] ))) {
					$error = 'error_1'; 
					
				} else {
					if(email_exists(esc_attr( $_POST['email'] ) ) ) {
						if(email_exists(esc_attr( $_POST['email'] ) ) != $current_user->ID) {
							$error = 'error_2';	
						}
						
					} else {
					$user_id = wp_update_user( 
						array (
							'ID' => $current_user->ID, 
							'user_email' => sanitize_text_field(  $_POST['email'] )
						)
					);
					}
				}
			}
			if ( isset( $_POST['url'] ) ) {
				wp_update_user( array ('ID' => $current_user->ID, 'user_url' => esc_url( $_POST['url'] )));
			}
			
			if ( isset( $_POST['first-name'] ) ) {
				update_user_meta( $current_user->ID, 'first_name', sanitize_text_field( $_POST['first-name'] ) );
			}
			
			if ( isset( $_POST['last-name'] ) ){
				update_user_meta($current_user->ID, 'last_name', sanitize_text_field( $_POST['last-name'] ) );
			}		    

			if ( isset( $_POST['phone'] ) ){
				update_user_meta($current_user->ID, 'phone', esc_html($_POST['phone'] ) );
			}		     				    
			if ( isset( $_POST['job_title'] ) ){
				update_user_meta($current_user->ID, 'job_title', sanitize_text_field( $_POST['job_title'] ) );
			}	
			if ( isset( $_POST['qualification'] ) ){
				update_user_meta($current_user->ID, 'qualification', sanitize_text_field( $_POST['qualification'] ) );
			}	
			if ( isset( $_POST['experience'] ) ){
				update_user_meta($current_user->ID, 'experience', sanitize_text_field( $_POST['experience'] ) );
			}
			if ( isset( $_POST['current_salary'] ) ){
				update_user_meta($current_user->ID, 'current_salary', sanitize_text_field( $_POST['current_salary'] ) );
			}	
			if ( isset( $_POST['display_name'] ) ) {
				wp_update_user(array('ID' => $current_user->ID, 'display_name' => sanitize_text_field( $_POST['display_name'] )));
				update_user_meta($current_user->ID, 'display_name' , sanitize_text_field( $_POST['display_name'] ));
			}
			if ( isset( $_POST['description'] ) ) {
				update_user_meta( $current_user->ID, 'description', sanitize_textarea_field( $_POST['description'] ) );
			}
			if(isset($_FILES)){ 
				foreach( $_FILES as $file ) {
					if( is_array( $file ) && !empty($file['name']) ) {
						
						include_once( ABSPATH . 'wp-admin/includes/image.php' );
						include_once( ABSPATH . 'wp-admin/includes/media.php' );
						
						$attachment_url = upload_file( $file );
						$upload_dir     = wp_upload_dir();
						$attachment_url = str_replace( array( $upload_dir['baseurl'], WP_CONTENT_URL, site_url( '/' ) ), array( $upload_dir['basedir'], WP_CONTENT_DIR, ABSPATH ), $attachment_url );

						if ( empty( $attachment_url ) || ! is_string( $attachment_url ) ) {
							return 0;
						}
						$attachment     = array(
							'post_title'   =>  wp_generate_password( 8, false ),
							'post_content' => '',
							'post_status'  => 'inherit',
							'guid'         => $attachment_url
						);
						if ( $info = wp_check_filetype( $attachment_url ) ) {
							$attachment['post_mime_type'] = $info['type'];
						}

						$attachment_id = wp_insert_attachment( $attachment, $attachment_url );
						
						if ( ! is_wp_error( $attachment_id ) ) {
							wp_update_attachment_metadata( $attachment_id, wp_generate_attachment_metadata( $attachment_id, $attachment_url ) );
							update_user_meta( $current_user->ID, 'jobzilla_avatar_id',$attachment_id );
						}
						
					}
				} 
			}
			$response['status'] = true;
			$response['msg'] = esc_html__('Profile has been successfully updated.', 'jobzilla');
		}
		echo json_encode($response);
		exit;
	}
	

		
	
?>