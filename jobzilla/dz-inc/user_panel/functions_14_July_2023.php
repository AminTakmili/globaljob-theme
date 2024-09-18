<?php

/** Login Redirect
 * Redirect user after successful login.
 *
 * @param string $redirect_to URL to redirect to.
 * @param string $request URL the user is coming from.
 * @param object $user Logged user's data.
 * @return string
 */
if(is_user_logged_in()){
	get_template_part('dz-inc/user_panel/user-profile-class');
	get_template_part('dz-inc/user_panel/recent-activities');
}
/*  Add new fields Start */
add_action( 'user_contactmethods',  'jobzilla_modify_contact_methods', 10 );
function jobzilla_modify_contact_methods($profile_fields) {

	// Add new fields
	$profile_fields['phone'] 		 = esc_html__('Phone','jobzilla');
	$profile_fields['job_title'] 	 = esc_html__('Job  Title','jobzilla');
	$profile_fields['qualification'] = esc_html__('Qualification','jobzilla');
	$profile_fields['experience']    = esc_html__('Experience','jobzilla');
	$profile_fields['current_salary']= esc_html__('Current Salary','jobzilla');
	

	return $profile_fields;
}
/*  Add new fields End */	

add_action('wp_ajax_jobzilla_user_login', 'jobzilla_user_login');
add_action('wp_ajax_nopriv_jobzilla_user_login', 'jobzilla_user_login');
add_action('wp_ajax_jobzilla_user_registration', 'jobzilla_user_registration');
add_action('wp_ajax_nopriv_jobzilla_user_registration', 'jobzilla_user_registration');
add_action('wp_ajax_jobzilla_user_activity', 'jobzilla_user_activity');
add_action('wp_ajax_nopriv_jobzilla_user_activity', 'jobzilla_user_activity');
add_action('wp_ajax_jobzilla_forgot_password', 'jobzilla_forgot_password');
add_action('wp_ajax_nopriv_jobzilla_forgot_password', 'jobzilla_forgot_password');
add_action('wp_logout','go_home');
add_action('wp_ajax_jobzilla_ajax', 'jobzilla_ajax');
add_action('wp_ajax_nopriv_jobzilla_ajax', 'jobzilla_ajax');
add_action('wp_ajax_jobzilla_change_password', 'jobzilla_change_password');
add_action('wp_ajax_nopriv_jobzilla_change_password', 'jobzilla_change_password');

function jobzilla_change_password(){
	$response = array(
		'status'=>false, 
		'msg'=>esc_html__('Something went wrong, Please try again.','jobzilla'),
	); 
	$user = wp_get_current_user(); 
	$userdata = $user->data;
	if(!empty($_POST)){
		$old_password	= !empty($_POST['old_password']) ? sanitize_text_field($_POST['old_password']) : '';
		$new_password	= !empty($_POST['new_password']) ? sanitize_text_field($_POST['new_password']) : '';
		$user_id		= !empty($_POST['user_id']) ? 			 sanitize_text_field($_POST['user_id']) : '';
		$confirm_new_password = !empty($_POST['confirm_new_password']) ? sanitize_text_field($_POST['confirm_new_password']) : '';
		$result = wp_check_password($old_password, $userdata->user_pass, $userdata->ID);
		$error_obj = new WP_Error();
		if(empty($old_password)){
			$error_obj->add( 'empty_old_password', jobzilla_get_error_messages( 'empty_old_password' ) );
		}else if(empty($result)){
			$error_obj->add( 'incorrect_password', jobzilla_get_error_messages( 'incorrect_password' ) );	
		}
		if(empty($new_password) || empty($confirm_new_password)){
			if(empty($new_password)){
				$error_obj->add( 'empty_new_password', jobzilla_get_error_messages( 'empty_new_password' ) );	
			}
			if(empty($confirm_new_password)){
				$error_obj->add( 'empty_confirm_new_password', jobzilla_get_error_messages( 'empty_confirm_new_password' ) );
			}
		}else if($new_password != $confirm_new_password){
			$error_obj->add( 'password_not_match', jobzilla_get_error_messages( 'password_not_match' ) );
		}
		$response['msg'] = 	 jobzilla_get_error_messages(null,$error_obj);
		$error_codes = $error_obj->get_error_codes();
		if(empty($error_codes)){
			$update = wp_set_password( $_POST['confirm_new_password'], $userdata->ID);
			wp_set_current_user($user_id );
			wp_set_auth_cookie($user_id );
			$response['status']= true;
			$response['msg'] = esc_html__('Change Password successful, redirecting...', 'jobzilla');
		}
		
	}
	echo json_encode($response);
	exit;
}
function jobzilla_ajax(){
	
	$search_location = !empty($_POST['search_location']) ? sanitize_text_field($_POST['search_location']) : '';
	$search_keywords = !empty($_POST['search_keywords']) ? sanitize_text_field($_POST['search_keywords']) : '';
	$args = array(
			'post_type'         => 'job_listing',
			'post_status'       => 'publish',
			'order'             => 'ASC',
		);
	if(!empty($_POST['search_location'])){
		
		$args['meta_query'][] = array(
					'key'     => '_job_location',
					'value'   => $search_location,
					'compare' => 'LIKE',
				);
				
	}else{
		$args['s'] = $search_keywords;
	}
		    $result = new WP_Query($args);
		 	foreach($result->posts as  $value){ 
		
				if($search_location){ 
					$Job_location = jobzilla_get_post_meta($value->ID, '_job_location'); ?>
					<option value="<?php echo esc_attr($Job_location); ?>"> <?php                  
						echo esc_html($Job_location); ?>
					</option>
				<?php
				}else{ ?>
					<option value="<?php echo esc_attr($value->post_title); ?>"> <?php                  
						echo esc_html($value->post_title); ?>
					</option>
				<?php
				} 
			 
			}
	exit; 
}

function jobzilla_user_login(){
	$response = array(
		'status'=>false, 
		'msg'=>esc_html__('Something went wrong, Please try again.','jobzilla'),
	); 
	
	$info = array();
    $info['user_login']	   = !empty($_POST['username']) ? sanitize_text_field($_POST['username']) :'';
    $info['user_password'] = !empty($_POST['password']) ? sanitize_text_field($_POST['password']) : '';
    $info['rememberme']    = !empty($_POST['rememberme']) ? true : false;
	
	if(empty($_POST['username']) || empty($_POST['password'])){
		if(empty($_POST['username'])){
			$response['msg'] =  esc_html__( 'Please fill username.', 'jobzilla');	
		}else{
			$response['msg'] =  esc_html__( 'Please fill password.', 'jobzilla');
		}
		
		$response['status'] = false; 
		echo json_encode($response);
		exit;
	}
    $user_signon = wp_signon( $info, $info['rememberme']);

    if( is_wp_error($user_signon) ){
			$response['status'] = false; 
			$response['msg'] = esc_html__('Wrong username or password.', 'jobzilla');
    }else{
		wp_set_current_user($user_signon->ID);
		wp_set_auth_cookie($user_signon->ID);
		$login_user		= wp_get_current_user();
		$roles 			= $login_user->roles;
		$redirect_url	= jobzilla_redirect_url($roles);
		$response['status']			= true;
		$response['redirect_url']	= $redirect_url;
		$response['msg']			= esc_html__('Login successful, redirecting...', 'jobzilla');
    }
	echo json_encode($response);
	exit;
}

function go_home(){
 $login_page = jobzilla_get_opt('jobzilla_login_page');
 $url = home_url($login_page);
 header("Location: ".$url."");
  exit();
}

function jobzilla_get_error_messages( $code = '', $error_obj = ''){
	
	$errors = $error_codes =  array();
	
	$error_msgs = array(
		'empty_username'	=> esc_html__( 'Please fill username.', 'jobzilla'),
		'invalid_username'	=> esc_html__( 'Please enter valid username.', 'jobzilla'),
		'username_exists'	=> esc_html__( 'The username already exists.', 'jobzilla'),
		'empty_user_login'  => esc_html__( 'Please provide your user login.', 'jobzilla'),
		
		'empty_email'	=> esc_html__( 'Please enter email.', 'jobzilla'),
		'email'			=> esc_html__( 'The email address is not valid.', 'jobzilla'),
		'email_exists'	=> esc_html__( 'The email address already exists', 'jobzilla'),
		
		'empty_password'	=> esc_html__( 'Please fill password.', 'jobzilla'),
		'password_not_match'=> esc_html__( 'Password did not matched.', 'jobzilla'),
		'incorrect_password'=> esc_html__( 'Your password is incorrect.', 'jobzilla'),
		'password-no'		=> esc_html__( 'You have forgot about the password.', 'jobzilla'),
		
		'empty_first_name'	=> esc_html__( 'Please fill first name.', 'jobzilla'),
		'empty_last_name'	=> esc_html__( 'Please fill last name.', 'jobzilla'),
		
		'closed'		=> esc_html__( 'New user registration is currently not allowed.', 'jobzilla'),
		'captcha-no'	=> esc_html__( 'Please check the reCaptcha checkbox.', 'jobzilla'),
		'captcha-fail'	=> esc_html__( 'ReCaptcha validation is failed.', 'jobzilla'),
		'policy-fail'	=> esc_html__( 'Please accept the privacy policy to register account.', 'jobzilla'),
		
		'empty_old_password' => esc_html__('Please fill old password.', 'jobzilla'),
		'empty_new_password' => esc_html__('Please fill new password.', 'jobzilla'),	
		'empty_confirm_new_password' => esc_html__('Please fill confirm new password.', 'jobzilla'),
	);
	
	if(!empty($code)){
		return isset($error_msgs[$code]) ? $error_msgs[$code] : esc_html__('Something Went Wrong, Please try again.','jobzilla');
	}
	

	if ( isset( $_REQUEST['login_errors'] ) ) {
		$error_codes = explode( ',', sanitize_text_field($_REQUEST['login_errors']) );
	
	} else if ( isset( $_REQUEST['register_errors'] ) ) {
		$error_codes = explode( ',', sanitize_text_field($_REQUEST['register_errors']) );
	
	}else if(!empty($error_obj)){
		
		$error_codes = $error_obj->get_error_codes();
	}
	
	if(!empty($error_codes)){
	
		foreach ( $error_codes as $key => $ecode ) {
				
			if(isset($error_msgs[$ecode])){
				$errors[$key] = $error_msgs[$ecode];
			}
		}
	}


	return $errors;	
}

function jobzilla_user_registration(){
 
	$email = $first_name = $last_name = $username = '';

	if(isset($_POST['submit_registration']) && $_POST['submit_registration'] == 'register'){
		
		$query_arg = array('action'=>'register');	
		$redirect_url = '';
		$response = array(
			'status'=>false,
			'redirect_url'=> '',
			'msg'=>esc_html__('Something went wrong, Please try again.','jobzilla'),
		); 	
			$email		= isset($_POST['email'])		? sanitize_text_field( $_POST['email'] ) : '';
			$first_name = isset($_POST['first_name'])	? sanitize_text_field( $_POST['first_name'] ) : '';
			$last_name	= isset($_POST['last_name'])	? sanitize_text_field( $_POST['last_name'] ) : '';
			$username	= isset($_POST['username'])		? sanitize_text_field( $_POST['username'] ) : '';
			
			$role		= isset($_POST['user_role'])	? sanitize_text_field( $_POST['user_role'] ) : get_option('default_role');
			
			if($role != 'employer' && $role != 'candidate'){
				$role = 'candidate';
			}
			
			$password	= isset($_POST['password'])		? sanitize_text_field( $_POST['password'] ) : '';
			$confirm_password= isset($_POST['confirm_password']) ? sanitize_text_field( $_POST['confirm_password'] ) : '';
			
			
			
			$error_obj = new WP_Error();
 
			// Email address is used as both username and email. It is also the only
			// parameter we need to validate
			
			if(empty($username)){
				 $error_obj->add( 'empty_username', jobzilla_get_error_messages( 'empty_username' ) );
			}
			
			if(empty($email)){
				 $error_obj->add( 'empty_email', jobzilla_get_error_messages( 'email' ) );
				
			}else if ( ! is_email( $email ) ) {
				  $error_obj->add( 'email', jobzilla_get_error_messages( 'email' ) );
			}
		 
			if ( email_exists( $email ) ) {
				 $error_obj->add( 'email_exists', jobzilla_get_error_messages( 'email_exists') );
			}

			if ( username_exists( $username ) ) {
				 $error_obj->add( 'username_exists', jobzilla_get_error_messages( 'username_exists') );
			}
			
			if ( empty( $password ) ) {
				 $error_obj->add( 'empty_password', jobzilla_get_error_messages( 'empty_password') );
			}else if ( $password != $confirm_password ) {
				 $error_obj->add( 'password_not_match', jobzilla_get_error_messages( 'password_not_match') );
			}
			
			if(empty($first_name)){
				 $error_obj->add( 'empty_first_name', jobzilla_get_error_messages( 'empty_first_name' ) );
			}else if(empty($last_name)){
				 $error_obj->add( 'empty_last_name', jobzilla_get_error_messages( 'empty_last_name' ) );
			}
			
			
			$response['status'] = false;
			$response['msg'] = 	 jobzilla_get_error_messages(null,$error_obj);
			$error_codes = $error_obj->get_error_codes();
			if(empty($error_codes)){
				$user_data = array(
					'user_login'    => $username,
					'user_email'    => $email,
					'user_pass'     => $password,
					'first_name'    => $first_name,
					'last_name'     => $last_name,
					'nickname'      => $first_name,
					'role'			=> $role
				);
				$user_id = wp_insert_user( $user_data );
				if(!empty($user_id)){
					$autologin = get_option('jobzilla_enable_autologin');
					if(!empty($autologin)){
						wp_set_current_user($user_id); // set the current wp user
						wp_set_auth_cookie($user_id);
						$login_user = wp_get_current_user();
						$roles = $login_user->roles;
						$redirect_url = jobzilla_redirect_url($roles);
						$response['status'] = true;
						$response['redirect_url'] = $redirect_url;
						$response['msg'] = esc_html__('Login successful, redirecting...', 'jobzilla');
					}else{
						if(jobzilla_get_opt('jobzilla_login_page')){
							$redirect_url = home_url(jobzilla_get_opt('jobzilla_login_page'));
						}
						$response['status'] = true;
						$response['redirect_url'] = $redirect_url;
						$response['msg'] = esc_html__('You have successfully applied to the job, redirecting ...', 'jobzilla');
						
					} 
				}	
			}
			echo json_encode($response);
			exit;	
	}	
}


function jobzilla_forgot_password(){
		$response = array(
			'status'=>false, 
			'msg'=>esc_html__('Something went wrong, Please try again.','jobzilla'),
		); 
		
		$email = trim($_POST['email']);
		
		if(empty($email)){
			$response['msg'] = esc_html__('Enter your e-mail address', 'jobzilla');
			$response['status'] = false;
		}else{
			$random_password = wp_generate_password();
			$user = get_user_by( 'email', $email );
			if(empty($user)){
				$response['status'] = false;
				$response['msg'] = esc_html__('Invalid e-mail address.', 'jobzilla');	
			}else{
				reset_password( $user, $random_password );
				$from = get_option('admin_email');
				$user_name = $user->display_name;
				$email_to = $user->user_email;
				$subject =  get_bloginfo('name').' '.esc_html('Reset Password');
				$args = array(
					'new_password' => $random_password,
					'user_name' => $user_name,
					'user_email' => $email_to,
					'email'     => $from,
				);
				$message = jobzilla_load_template_part('dz-inc/user_panel/mail-send-template', '',$args);
				
				$attachments = $args;
				$headers = sprintf( "From: %s <%s>\r\n Content-type: text/html", get_bloginfo('name'), $from );
				
				$mail = false;
				if(function_exists('jobzilla_send_mail')){
					$mail = jobzilla_send_mail($email_to, $subject, $message, $headers, $attachments);
				}
				
				if( $mail ){
					$response['status'] = true;
					$response['msg'] =  esc_html__( 'Check your email address for you new password.', 'jobzilla' );
				}else{
					$response['status'] = false;
					$response['msg'] =  esc_html__( 'System is unable to send you mail containg your new password.', 'jobzilla' );
				}
			}
		}
		echo json_encode($response);
		exit;
}



function jobzilla_user_activity(){
	global $wpdb;
	$response = array(
			'status'=>false, 
			'msg'=>esc_html__('Something went wrong, Please try again.','jobzilla'),
		); 
	$id = !empty($_POST['id']) ? sanitize_text_field($_POST['id']) : '';
	if(!empty($id)){
		
		$sql = 'DELETE FROM `'. $wpdb->prefix .'dz_core_activity_log` WHERE `id` = %d;';
        $result = $wpdb->query($wpdb->prepare($sql, $id));
		if($result){
			$response['status'] = true;
			$response['msg'] =  esc_html__( 'activitie remove successful', 'jobzilla' );
		}			
	}
	echo json_encode($response);
	exit;
}

function jobzilla_get_page_title(){
	$jobzilla_option = getDZThemeReduxOption();

	$title = jobzilla_set($jobzilla_option, 'page_banner_title');
	if(!empty($title)){
		$page_title = $title;
	}else{
		$page_title = wp_title('', false);
	}
	return $page_title;
}
function jobzilla_redirect_url($roles){

	if(in_array('administrator', $roles)){	
		$redirect_url = admin_url();
	}else{
		$dashboard_page_title = jobzilla_get_opt('jobzilla_dashboard_page');
		if(!empty($dashboard_page_title)){
			$redirect_url = home_url($dashboard_page_title);
		}else{
			$redirect_url = home_url();
		}
	}
	return $redirect_url;
}

