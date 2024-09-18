<?php 
	if( !class_exists( 'Jobzilla_DZ_Base' ) ){ 
		include_once get_template_directory() . '/dz-inc/base.php';
	}	
	
	if( !function_exists( 'jobzilla_set' ) ) {
		function jobzilla_set( $var, $key = '', $def = '' )
		{
			if( is_object( $var ) && isset( $var->$key )){ 
				return $var->$key;
			}elseif( is_array( $var ) && isset( $var[$key] )){
				return $var[$key];
			}
			// variable handling with blank key
			elseif( !is_array( $var ) && !empty( $var ) &&  empty($key) ) {
 				return $var;
			}
			elseif( $def ){
				return $def;
			}	
			else{
				return false;
			}
		}
	}
	
	
	add_action( 'admin_init', 'jobzilla_admin_page_init' );
	
	function jobzilla_admin_page_init(){
		if ( current_user_can( 'edit_theme_options' ) ) {
			
			if( isset( $_GET['dz-deactivate'] ) && $_GET['dz-deactivate'] == 'deactivate-plugin' ) {
				check_admin_referer( 'dz-deactivate', 'dz-deactivate-nonce' );
				$plugins = TGM_Plugin_Activation::$instance->plugins;
				foreach( $plugins as $plugin ) {
					if( $plugin['slug'] == $_GET['plugin'] ) {
						deactivate_plugins($plugin['file_path']);
					}
				}
				
				wp_redirect('admin.php?page=dz-plugins');
			} 
			
			if( isset( $_GET['dz-activate'] ) && $_GET['dz-activate'] == 'activate-plugin' ) {
				check_admin_referer( 'dz-activate', 'dz-activate-nonce' );
				$plugins = TGM_Plugin_Activation::$instance->plugins;
				foreach( $plugins as $plugin ) {
					if( $plugin['slug'] == $_GET['plugin'] ) {
						activate_plugin( $plugin['file_path'] );
					
					}else if(in_array($plugin['slug'], array('kingcomposer','js_composer','elementor')))
					{
						deactivate_plugins( $plugin['file_path'] );
					}
				}
				
				wp_redirect('admin.php?page=dz-plugins');
			}
			
			
		}
	}		

	function jobzilla_plugin_link( $item ) {
			$installed_plugins = get_plugins();
			$item['sanitized_plugin'] = $item['name'];
			 $is_plug_act = 'is_plugin_active';
			if ( ! isset( $installed_plugins[$item['file_path']] ) ) {
				$actions = array(
					'install' => sprintf(
						'<a href="%1$s" class="button button-primary" title="Install %2$s">Install</a>',
						esc_url( wp_nonce_url(
							add_query_arg(
								array(
									'page'		  	=> urlencode( TGM_Plugin_Activation::$instance->menu ),
									'plugin'		=> urlencode( $item['slug'] ),
									'plugin_name'   => urlencode( $item['sanitized_plugin'] ),
									'plugin_source' => urlencode( $item['source'] ),
									'tgmpa-install' => 'install-plugin',
									'return_url' 	=> 'dz-plugins'
								),
								admin_url( TGM_Plugin_Activation::$instance->parent_slug )
								
							),
							'tgmpa-install',
							'tgmpa-nonce'
						) ),
						$item['sanitized_plugin']
					),
				);
			}
			
			elseif ( is_plugin_inactive( $item['file_path'] ) ) {
				if ( version_compare( $item['version'], $installed_plugins[$item['file_path']]['Version'], '>' ) ) {
					$actions = array(
						'update' => sprintf(
							'<a href="%1$s" class="button button-primary" title="Update %2$s">Update</a>',
							wp_nonce_url(
								add_query_arg(
									array(
										'page'		  	=> urlencode( TGM_Plugin_Activation::$instance->menu ),
										'plugin'		=> urlencode( $item['slug'] ),
										'plugin_name'   => urlencode( $item['sanitized_plugin'] ),
										'plugin_source' => urlencode( $item['source'] ),
										'tgmpa-update' 	=> 'update-plugin',
										'version' 		=> urlencode( $item['version'] ),
										'return_url' 	=> 'dz-plugins'
									),
									admin_url( TGM_Plugin_Activation::$instance->parent_slug )
								),
								'tgmpa-update',
								'tgmpa-nonce'
							),
							$item['sanitized_plugin']
						),
					);
				} else {
					
					$actions = array(
						'activate' => sprintf(
							'<a href="%1$s" class="button button-primary" title="Activate %2$s">Activate</a>',
							esc_url( add_query_arg(
								array(
									'plugin'			   	=> urlencode( $item['slug'] ),
									'plugin_name'		  	=> urlencode( $item['sanitized_plugin'] ),
									'plugin_source'			=> urlencode( $item['source'] ),
									'dz-activate'	   		=> 'activate-plugin',
									'dz-activate-nonce' 	=> wp_create_nonce( 'dz-activate' ),
								),
								admin_url( 'admin.php?page=dz-plugins' )
							) ),
							$item['sanitized_plugin']
						),
					);
				}
			}
			
			elseif ( version_compare( $item['version'], $installed_plugins[$item['file_path']]['Version'], '>' ) ) {
			
				$actions = array(
					'update' => sprintf(
						'<a href="%1$s" class="button button-primary" title="Update %2$s">Update</a>',
						wp_nonce_url(
							add_query_arg(
								array(
									'page'		  	=> urlencode( TGM_Plugin_Activation::$instance->menu ),
									'plugin'		=> urlencode( $item['slug'] ),
									'plugin_name'   => urlencode( $item['sanitized_plugin'] ),
									'plugin_source' => urlencode( $item['source'] ),
									'tgmpa-update' 	=> 'update-plugin',
									'version' 		=> urlencode( $item['version'] ),
									'return_url' 	=> 'dz-plugins'
								),
								admin_url( TGM_Plugin_Activation::$instance->parent_slug )
							),
							'tgmpa-update',
							'tgmpa-nonce'
						),
						$item['sanitized_plugin']
					),
				);
			}
			elseif ( $is_plug_act( $item['file_path'] ) ) {
				
				 $actions = array(
					'deactivate' => sprintf(
						'<a href="%1$s" class="button button-primary" title="Deactivate %2$s">Deactivate</a>',
						esc_url( add_query_arg(
							array(
								'plugin'					=> urlencode( $item['slug'] ),
								'plugin_name'		  		=> urlencode( $item['sanitized_plugin'] ),
								'plugin_source'				=> urlencode( $item['source'] ),
								'dz-deactivate'	   		=> 'deactivate-plugin',
								'dz-deactivate-nonce' 	=> wp_create_nonce( 'dz-deactivate' ),
							),
							admin_url( 'admin.php?page=dz-plugins' )
						) ),
						$item['sanitized_plugin']
					),
				); 
				
				
				
			}
			return $actions;
	}

	include_once get_template_directory() . '/dz-inc/library/functions.php';
	include_once get_template_directory() . '/dz-inc/library/widgets.php';
	
	include_once get_template_directory() . '/dz-inc/library/woocommerce_functions.php';
	
	include_once get_template_directory() . '/dz-inc/helpers/bootstrap_walker.php';
	
	if (!class_exists('Jobzilla_Menu_Handle')) {
        require_once get_template_directory().'/dz-inc/library/class-menu-handle.php';
    }
	
	include_once get_template_directory() . '/dz-inc/dz-redux/functions.php';
	require_once get_template_directory() . '/dz-inc/dz-redux/template-functions.php';
	include_once get_template_directory() . '/dz-inc/dz-redux/theme-options.php';
	
	include_once get_template_directory() . '/dz-inc/dz-redux/page-options.php';
	
	
	/* User Panel Settings */
	include_once get_template_directory() . '/dz-inc/user_panel/functions.php';
	include_once get_template_directory() . '/dz-inc/user_panel/model-box-popup.php';
	
	if (class_exists('WP_Job_Manager')) {
		include_once get_template_directory() . '/dz-inc/library/wp-job-manager/loader.php';
	}
	
	
	if (!class_exists('CSS_Generator')) {
		require_once get_template_directory() . '/dz-inc/dz-redux/classes/class-css-generator.php';
	}

	$bootstrap_walker = new Bootstrap_walker;		

	if( is_admin() ){
		/** Plugin Activation */
		include_once get_template_directory() . '/dz-inc/thirdparty/tgm-plugin-activation/plugins.php';
	}
	
	
	