<?php 
add_action('wp_ajax_jobzilla_candidate_send_message', 'jobzilla_candidate_send_message');
add_action('wp_ajax_nopriv_jobzilla_candidate_send_message', 'jobzilla_candidate_send_message');

function jobzilla_candidate_send_message(){
	
	global $wpdb;
	$response = array(
					'status'=>false, 
					'msg'=>esc_html__('Something went wrong, Please try again.','jobzilla')
				);
	
	$job_id       = !empty($_POST['job_id'])    ? sanitize_text_field($_POST['job_id']) 	 : '';
	$message      = !empty($_POST['message'])   ? sanitize_textarea_field($_POST['message'])  : '';
	
	if(!empty($job_id) && !empty($message)){
	
		if('publish' == get_post_status ( $job_id )){
			$receiver_id 	= get_post_field('post_author', $job_id );
			$login_user_id  = get_current_user_id();
			$sender_id		= $login_user_id;
			$receiver_id	=  $receiver_id ;
			$status			= 'sent';
			
			
			$converstation_id	= get_message_user_data($sender_id, $receiver_id);
			$parent_id = !empty($converstation_id) ? $converstation_id :0;
			
			$message_data = array(
					'parent_id'       =>  $parent_id,
					'receiver_id' 	  =>  $receiver_id,
					'sender_id' 	  =>  $sender_id,
					'message' 		  =>  $message,
					'object_id'       =>  $job_id,
					'status'          =>  $status,
					
			);	
			$table = $wpdb->prefix.'dz_messages';
			$sql = $wpdb->prepare(
				 "INSERT INTO `".$table."` 
				   (`parent_id`,`receiver_id`,`sender_id`,`message`,`object_id`,`status`) 
				   values (%d, %d, %d, %s, 
						 %d, %s)", $parent_id, $receiver_id, $sender_id, $message, $job_id,  $status
				 );
		
			$result = $wpdb->query($sql);
			if($result){
				$response['status'] = true;
				$response['msg']	= esc_html__('Message has sent successfully.','jobzilla');
			}else{
				$response['msg']	= esc_html__('Message could not be send, Please try after sometime.','jobzilla');
			}
		}
	
	}
	
	echo json_encode($response);
	exit;
}
add_action('jobzilla_user_messages', 'jobzilla_user_messages_popup');
function jobzilla_user_messages_popup($job_id){
	$title = get_the_title( $job_id );
	 
	if( get_current_user_id() ){ 
	?>
		<a class="messages" data-bs-toggle="modal" href="#message" role="button">
			<i class="fa fa-comments" aria-hidden="true"></i>
		</a>
	<?php }else{ ?>
		<a class="messages" data-bs-toggle="modal" href="#sign_up_popup2" role="button">
			<i class="fa fa-comments" aria-hidden="true"></i>
		</a>
	<?php } ?>
	<div class="modal fade twm-sign-up"  id="message" aria-hidden="true" aria-labelledby="message" tabindex="-1">
		<form method="post" id="DZMessageForm">
			<input type="hidden" name="job_id" value="<?php echo esc_attr($job_id); ?>">
			<input type="hidden" name="job_title" value="<?php echo esc_attr($title); ?>">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						 <h2 class="modal-title">
							<?php echo esc_html__('Messsges', 'jobzilla'); ?>
						 </h2>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="message_open">
						</div>
						<div class="twm-tabs-style-2">
							 <div class="col-md-12">
								<div class="form-group">
									<label>
										<?php echo esc_html__( 'Message:', 'jobzilla' ); ?>
									</label>
									<textarea rows="4" required class="form-control" name="message"  id="Messageid" placeholder="<?php echo esc_attr__('Enter your message', 'jobzilla'); ?>"></textarea>
								</div>
							</div>
							<p>
								<button type="submit"  class="site-button" ><?php echo esc_html__('submit', 'jobzilla'); ?></button>
							</p>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
<?php	
}

function dashboard_view(){
	$login_user = wp_get_current_user();
	$roles = $login_user->roles;
	ob_start();
		if(in_array('employer', $roles) || in_array('administrator', $roles)){
			get_template_part('dz-inc/user_panel/elements/employer_dashboard'); 	
		}else if(in_array('candidate', $roles)){
			get_template_part('dz-inc/user_panel/elements/candidate_dashboard');
		}else{
			echo '<div class="alert alert-warning  alert-dismissible fade show" role="alert">You are not allowed to access this page.</div>';
		}	
	return ob_get_clean();
}
function login_view(){
	ob_start();
	if ( !is_user_logged_in()) { 
		get_template_part('dz-inc/user_panel/login');
	}else{
		echo '<div class="content-inner"><div class="container"><div class="alert alert-warning  alert-dismissible fade show" role="alert">'.esc_html__('You are logged in.', 'jobzilla').'</div></div></div>';
	}	
	return ob_get_clean();
}
function lost_password_view(){
	ob_start();
	if ( !is_user_logged_in()) { 
		get_template_part('dz-inc/user_panel/lost-password');
	}else{
		echo '<div class="content-inner"><div class="container"><div class="alert alert-warning  alert-dismissible fade show" role="alert">'.esc_html__('You are logged in.', 'jobzilla').'</div></div></div>';
	}		
	return ob_get_clean();
}
function register_view(){
	ob_start();
	if ( !is_user_logged_in()) { 
		get_template_part('dz-inc/user_panel/register');
	}else{
		echo '<div class="content-inner"><div class="container"><div class="alert alert-warning  alert-dismissible fade show" role="alert">'.esc_html__('You are logged in.', 'jobzilla').'</div></div></div>';
	}	
	return ob_get_clean();
}
		