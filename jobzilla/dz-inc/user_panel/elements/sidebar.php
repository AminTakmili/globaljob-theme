<?php 
	global $post;
	$post_id    = $post->ID;
	$post_url   = get_permalink($post_id);
	$login_user = wp_get_current_user();
	$sidebar_menu = array();
	if(!empty($login_user)){
		$roles = $login_user->roles;
		$sidebar_menu = jobzilla_get_user_sidebar_menus($roles);
	}
	
?>

<!-- Sidebar Holder -->
<nav id="sidebar-admin-wraper">
	<div class="nav-open-btn">
		<div class="menu-icon-in">
			<span></span>
			<span></span>
			<span></span>
		</div>
	</div>
	<?php if(is_user_logged_in() && !empty($sidebar_menu)) { ?>
	<div class="page-logo">
	   <?php do_action( 'jobzilla_get_logo','site_other_logo'); ?>
	</div>
	 
	<div class="admin-nav scrollbar-macosx">
		<ul>
			<?php 
				foreach($sidebar_menu as $value){ 
			?>
			<li <?php if($value['url'] == $post_url){?> class="active" <?php }?>>
				<a href="<?php echo esc_url($value['url']); ?>">
					<i class="<?php echo esc_attr($value['class']); ?>"></i>
					<span class="admin-nav-text"> 
						<?php echo esc_html($value['label']); ?>
					</span>
				</a>
			</li>
			<?php } ?>			   
			<li>
				<a href="<?php echo wp_logout_url(get_permalink()); ?>" >
					<i class="fa fa-share-square"></i>
					<span class="admin-nav-text">
						<?php echo esc_html__('Logout', 'jobzilla');?>
					</span>
				</a>
			</li>                    
			
		</ul>
	</div>   
	<?php
	} ?>
</nav>

						