<?php

 $theme = wp_get_theme();
 $theme_name = $theme->name;

?>

<div class="wrap welcome-wrap dz-wrap">
	<h1 class="hide" style="display:none;"></h1>
	<div class="dz-welcome-inner">
		<nav class="dz-nav-tab-wrapper nav-tab-wrapper">
			<a class="nav-tab nav-tab-active" href="#">
				<?php echo esc_html__( 'Introduction', 'jobzilla' ); ?>
			</a>
			<a class="nav-tab" href="<?php echo admin_url( 'admin.php?page=dz-plugins' ) ?>">
				<?php echo esc_html__( 'Plugins', 'jobzilla' ); ?>
			</a>
			<a class="nav-tab" href="<?php echo admin_url( 'admin.php?page=dz-system-status' ) ?>">
				<?php echo esc_html__( 'System Status', 'jobzilla' ); ?>
			</a>
		</nav>
	</div>
	
	
	<h2 class="dsx-main-title"><?php echo esc_html($theme_name); ?></h2>
	<div class="dsx-dashboard-start">
		<div class="dsx-media-bx">		
			<div class="dsx-demo-img" style="background-image:url(<?php echo esc_url(get_template_directory_uri().'/dz-inc/admin/images/full-screenshot.png'); ?>);"></div>			
		</div>
		<div class="dsx-dashboard">
			<div class="dsx-dashboard-inner clearfix">
				<div class="dsx-dashboard-item">
					<div class="dsx-dashboard-item-inner">
						<div class="dsx-media">
							<img src="<?php echo esc_url(get_template_directory_uri().'/dz-inc/admin/images/call-center-agent.png'); ?>" alt="<?php echo esc_attr__('Image','jobzilla'); ?>"/>
						</div>
						<div class="dsx-info">
							<h3><?php echo esc_html__('Support', 'jobzilla'); ?></h3>
							<p><?php echo esc_html__('We would happy to help you solve any issues. If you have any question then contact us on our support panel.', 'jobzilla'); ?></p>
							<a href="<?php echo esc_url($support_link) ?>" target="_blank"><?php echo esc_html__('Go To Support', 'jobzilla'); ?><i class="dashicons-before dashicons-arrow-right-alt2"></i></a>
						</div>
					</div>
				</div>
				<div class="dsx-dashboard-item">
					<div class="dsx-dashboard-item-inner">
						<div class="dsx-media">
							<img src="<?php echo esc_url(get_template_directory_uri().'/dz-inc/admin/images/documents.png'); ?>" alt="<?php echo esc_attr__('Image','jobzilla'); ?>"/>
						</div>
						<div class="dsx-info">
							<h3><?php echo esc_html__('Documentation', 'jobzilla'); ?></h3>
							<p><?php echo esc_html__('Our online documentation helps you to learn how to setup and customize the theme.', 'jobzilla'); ?></p>
							<a href="<?php echo esc_url($documentation_link) ?>" target="_blank"><?php echo esc_html__('Read Docs', 'jobzilla'); ?><i class="dashicons-before dashicons-arrow-right-alt2"></i></a>
						</div>
					</div>
				</div>
				<div class="dsx-dashboard-item video-tutorial">
					<div class="dsx-dashboard-item-inner">
						<div class="dsx-media">
							<img src="<?php echo esc_url(get_template_directory_uri().'/dz-inc/admin/images/online-meeting.png'); ?>" alt="<?php echo esc_attr__('Image','jobzilla'); ?>"/>
						</div>
						<div class="dsx-info">
							<h3><?php echo esc_html__('Video Tutorials', 'jobzilla'); ?></h3>
							<p><?php echo esc_html__('The video tutorial will help you do the learn easily the theme.', 'jobzilla'); ?> <?php echo esc_html($this->theme_name) ?>.</p>
							<a href="<?php echo esc_url($video_link) ?>" target="_blank"><?php echo esc_html__('Watch Now', 'jobzilla'); 
							
							?><i class="dashicons-before dashicons-arrow-right-alt2"></i></a>
							<div class="dash-deactivate"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="dsx-text">
		<p><?php echo esc_html($theme->Description) ?></p>
	</div>
</div>