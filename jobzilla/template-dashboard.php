<?php /* Template Name: Jobzilla Dashboard */	
	
		/* Login User Check Page Permission */
		$login_user = wp_get_current_user();
		$roles = $login_user->roles;
		$value = '';
	
		
		/* Get Dashboard URL */
		$dashboard_page_title = jobzilla_get_opt('jobzilla_dashboard_page');
		$url = home_url( $dashboard_page_title );
		$current_page_title = $post->post_name;
		if(in_array('employer', $roles)){
			$role_based_page_list = jobzilla_get_opt('jobzilla_employer_pages');
		
		}else if(in_array('candidate', $roles)){
			$role_based_page_list = jobzilla_get_opt('jobzilla_candidate_pages');
		
		}else if(in_array('administrator', $roles)){
			$admin_url = admin_url();
			header("Location: ".$admin_url."");
		} 
		
		if(!empty($role_based_page_list)){
			if(!in_array($current_page_title, $role_based_page_list)){
				header("Location: ".$url."?msg=&response=s");
				exit;
			}
		}
		
		/* Login User Check Page Permission END*/ 
		
		if(function_exists('jobzilla_hide_admin_bar') && (in_array('employer', $roles) || in_array('candidate', $roles))){
			jobzilla_hide_admin_bar();
		}
		
		$login_user = wp_get_current_user();
		$roles = $login_user->roles;
		$dashboard_page_title = jobzilla_get_opt('jobzilla_dashboard_page');
		$url = home_url( $dashboard_page_title );
	
		if( CANDIDATE_THEME && in_array('candidate', $roles)){
			
			get_header();		
			jobzilla_get_banner();
			
			get_template_part('dz-inc/candidate_panel/dashboard');
			
			get_footer();	
			
		}else{
		
		if(is_user_logged_in()){
			get_header('dashboard');
			get_template_part('dz-inc/user_panel/elements/sidebar');	
	
		?>
				 <div id="content">
					<div class="content-admin-main">
						<?php
						
							$message_title = jobzilla_get_opt('jobzilla_messages_page');
							if($message_title != $post->post_name){ ?>
							<div class="wt-admin-right-page-header clearfix">
								<h2><?php echo jobzilla_get_page_title(); ?></h2>
								<div class="breadcrumbs"><a href="<?php echo esc_url($url); ?>"><?php echo esc_html__('Home', 'jobzilla'); ?></a><span><?php echo jobzilla_get_page_title(); ?></span></div>
							</div>
							<?php 	
							}
							while( have_posts() )
							{ 
								the_post(); 							
								the_content();
							} 
						?>
					</div>
				</div>
			<?php 
			
			
			get_footer('dashboard');	
		}else{
			$lonin_id = jobzilla_get_opt('jobzilla_login_page');
			$lonin_url = home_url();
			if(!empty($lonin_id)){
				$lonin_url = home_url($lonin_id);
			}
			header("Location: ".$lonin_url."");
		}
		
		}
	/* Not login - If Close */

