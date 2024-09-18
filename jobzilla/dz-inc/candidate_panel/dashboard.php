<!-- OUR BLOG START -->
<?php 
	global $post;
	$post_id    = $post->ID;
	$post_url   = get_permalink($post_id);
	$login_user = wp_get_current_user();
	$user_data  = $login_user->data;
	$user_name  = $user_data->display_name;
	$user_img   = get_avatar($user_data->ID, 150);
	$resumes = get_user_by_post($login_user->ID, 'resume', 1);
	if(!empty($resumes)){
		$candidate_title = jobzilla_get_post_meta($resumes[0], '_candidate_title');
	}
	$sidebar_menu = array();
	if(!empty($login_user)){
		$roles = $login_user->roles;
		$sidebar_menu = jobzilla_get_user_sidebar_menus($roles);
	}	
?>

<div class="section-full p-t120  p-b90 site-bg-white">
	<div class="container">
		<div class="row">
			
			<div class="col-xl-3 col-lg-4 col-md-12 rightSidebar m-b30">

				<div class="side-bar-st-1">  
					<?php if(!empty($user_img)){ ?>
						<div class="twm-candidate-profile-pic">
							<?php echo get_avatar($user_data->ID, 150); ?>
						</div>
					<?php } ?>
					<div class="twm-mid-content text-center">
						<?php if(!empty($user_name)){ ?>
						<a href="candidate-detail.html" class="twm-job-title">
							<h4><?php echo esc_html($user_name);?></h4>
						</a>
						<?php } 
						if(!empty($candidate_title)){
						?>
						<p><?php echo esc_html($candidate_title); ?></p>
						<?php } ?>
					</div>
				   
					<div class="twm-nav-list-1">
						<ul>
							<?php 
								foreach($sidebar_menu as $value){ 
							?>
							<li <?php if($value['url'] == $post_url){?> class="active" <?php }?>>
								<a href="<?php echo esc_url($value['url']); ?>">
									<i class="<?php echo esc_attr($value['class']); ?>"></i>
									<?php echo esc_html($value['label']); ?>
								</a>
							</li>
							<?php } ?>
							<li>
								<a href="<?php echo wp_logout_url(get_permalink()); ?>">
									<i class="fa fa-share-square"></i>
									<?php echo esc_html__('Logout', 'jobzilla');?>
								</a>
							</li>
						</ul>
					</div>
				</div>

			</div>
			
			<div class="col-xl-9 col-lg-8 col-md-12 m-b30">
				<!--Filter Short By-->
				<div class="twm-right-section-panel site-bg-gray">
					<?php 
						$dashboard_page_id = jobzilla_get_opt('jobzilla_dashboard_page');
					
						if( !empty( $post_id == $dashboard_page_id) ) { 
							if(in_array('candidate', $roles)){
								get_template_part('dz-inc/candidate_panel/candidate_dashboard');
							}
						}
					
						while( have_posts() )
							{ 
								the_post(); 							
								the_content();
							} 
					?>
				</div>
			</div>

		</div>
	</div>
</div>   
<!-- OUR BLOG END -->

