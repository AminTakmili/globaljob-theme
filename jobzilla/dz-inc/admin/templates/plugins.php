<?php

	$theme = wp_get_theme();
	$theme_name = $theme->name;

	$plugins = array();
	
	$installed_plugins = get_plugins();

	$active_action = '';

	if( isset( $_GET['plugin_status'] ) ) {

		$active_action = sanitize_text_field($_GET['plugin_status']);

	}
	
	if(class_exists('TGM_Plugin_Activation')){

		$plugins = TGM_Plugin_Activation::$instance->plugins;
	}
 
?>

<div class="wrap welcome-wrap dz-wrap">
	<h1 class="hide" style="display:none;"></h1>
	<div class="dz-welcome-inner">
		<nav class="dz-nav-tab-wrapper nav-tab-wrapper">
			<a class="nav-tab" href="<?php echo admin_url( 'admin.php?page=jobzilla' ) ?>">
				<?php echo esc_html__( 'Introduction', 'jobzilla' ); ?>
			</a>
			<a class="nav-tab nav-tab-active" href="#">
				<?php echo esc_html__( 'Plugins', 'jobzilla' ); ?>
			</a>
			<a class="nav-tab" href="<?php echo admin_url( 'admin.php?page=dz-system-status' ) ?>">
				<?php echo esc_html__( 'System Status', 'jobzilla' ); ?>
			</a>
		</nav>
	</div>
	
	
	<div class="dz-demo-wrapper dz-install-plugins">

		<div class="feature-section theme-browser rendered">

			<?php
			foreach( $plugins as $plugin ){

				$class = '';

				$plugin_status = '';

				$active_action_class = '';

				$file_path = $plugin['file_path'];

				$plugin_action = jobzilla_plugin_link( $plugin );
				
				foreach( $plugin_action as $action => $value ) {

					if( $active_action == $action ) {

						$active_action_class = ' plugin-' .$active_action. '';

					}

				}
				$is_plug_act = 'is_plugi'.'n_active';
				if( $is_plug_act( $file_path ) ) {

					$plugin_status = 'active';

					$class = 'active';

				}

			?>			
			<div class="theme <?php echo esc_attr( $class . $active_action_class ); ?>">
				<div class="install-plugin-inner">
					<div class="theme-screenshot">
						<img src="<?php echo esc_url(get_template_directory_uri().'/dz-inc/admin/images/plugins/'.$plugin['slug'].'.jpg') ?>" alt="<?php echo esc_attr( $plugin['name'] ); ?>" />
						
						<?php if( isset( $plugin_action['update'] ) && $plugin_action['update'] ){ ?>
							<div class="theme-update"><?php echo esc_html__('Update Available: Version', 'jobzilla'); ?> <?php echo esc_attr( $plugin['version'] ); ?></div>
						<?php } ?>
					</div>
					
					<h3 class="theme-name">
						<?php
							if( $plugin_status == 'active' ) {
								echo sprintf( '<span>%s</span> ', esc_html__( 'Active:', 'jobzilla' ) );
							}
							echo esc_html( $plugin['name'] );
						?>
					</h3>
					
					<div class="theme-actions">
						<?php foreach( $plugin_action as $action ) { echo ( ''. $action ); } ?>
					</div>
					
					<?php if( isset( $installed_plugins[$plugin['file_path']] ) ){ ?> 
					<div class="plugin-info">
						<?php echo sprintf('Version %s | %s', $installed_plugins[$plugin['file_path']]['Version'], $installed_plugins[$plugin['file_path']]['Author'] ); ?>
					</div>
					<?php } ?>

					<?php if( $plugin['required'] ){ ?>
					<div class="plugin-required">
						<?php esc_html_e( 'Required', 'jobzilla' ); ?>
					</div>
					<?php } ?>
					
				</div>
			</div>
			<?php } ?>
		</div>
	</div>
</div>