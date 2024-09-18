<?php
if (!defined('ABSPATH')) {
    die();
}
if (!class_exists('Jobzilla_Menu_Handle')) {
    class Jobzilla_Menu_Handle
    {
		
		public $profile_name		= 'DexignZone';
		
		public $documentation_link	= 'https://assets.wprdx.com/products/docs/jobzilla/';
		
		public $support_link		= 'https://support.w3itexperts.com/';
		
		public $video_link			= 'https://www.youtube.com/watch?v=kbXZdenrGpk';
		
		
        /**
         * Jobzilla_Menu_Handle->theme_name
         * private
         * @var string
         */
        protected $theme_name = '';

        /**
         * Jobzilla_Menu_Handle->theme_text_domain
         * private
         * @var string
         */
        protected $theme_text_domain = '';

        public function __construct()
        {
            $current_theme = wp_get_theme();
            $this->theme_name = $current_theme->get('Name');
            $this->theme_text_domain = $current_theme->get('TextDomain');
			
			add_action('admin_menu', array($this, 'jobzilla_add_menu'));
        }
		
		public function jobzilla_add_menu()
        {
			add_menu_page($this->profile_name, $this->profile_name, 
						'manage_options', 
						$this->theme_text_domain, 
						array($this, 'jobzilla_create_theme_dashboard'), 
						get_template_directory_uri().'/dz-inc/admin/images/logo.png',
						3
			);
			
            add_submenu_page($this->theme_text_domain, $this->theme_name, esc_html__('Dashboard', 'jobzilla'), 'manage_options', $this->theme_text_domain, array($this, 'jobzilla_create_theme_dashboard'));
			
			
			/* DZ Plugins */
			add_submenu_page(
						$this->theme_text_domain,
						esc_html__( 'DZ Plugins', 'jobzilla' ),
						esc_html__( 'DZ Plugins', 'jobzilla' ),
						'administrator',
						'dz-plugins',
						array( $this, 'jobzilla_themes_plugins_tab' ) ); 
			
			/* System Status */
			add_submenu_page(
						$this->theme_text_domain,
						esc_html__( 'System Status', 'jobzilla' ),
						esc_html__( 'System Status', 'jobzilla' ),
						'administrator',
						'dz-system-status',
						array( $this, 'jobzilla_themes_system_status_tab' ) );			

        }

        public function jobzilla_create_theme_dashboard()
        {
            $documentation_link		= $this->documentation_link;
            $support_link			= $this->support_link;
            $video_link				= $this->video_link;
			
			require_once get_template_directory() . '/dz-inc/admin/templates/dashboard.php';
		}
		
		function jobzilla_themes_plugins_tab() {
			require_once get_template_directory() . '/dz-inc/admin/templates/plugins.php';
		}
		
		function jobzilla_themes_system_status_tab() {
			require_once get_template_directory() . '/dz-inc/admin/templates/system_status.php';
		}

        function jobzilla_add_admin_bar($wp_admin_bar)
        {
            $theme = wp_get_theme();
            /**
             * Add "Theme Name" parent node
             */
           /*  $args = array(
                'id'    => $theme->get("TextDomain"),
                'title' => '<span class="ab-icon dashicons-smiley"></span>' . $theme->get("Name"),
                'href'  => admin_url('admin.php?page=theme-options'),
                'meta'  => array(
                    'class' => 'dashicons dashicons-admin-generic',
                    'title' => $theme->get("TextDomain"),
                )
            );
            $wp_admin_bar->add_node($args); */
			
			/**
             * Add Dashboard children node
             */
            $args = array(
                'id'     => 'dashboard',
                'title'  => esc_html__('Dashboard', 'jobzilla'),
                'href'   => admin_url('admin.php?page=' . $theme->get("TextDomain")),
                'parent' => $theme->get("TextDomain"),
                'meta'   => array(
                    'class' => '',
                    'title' => esc_html__('Dashboard', 'jobzilla'),
                )
            );
            $wp_admin_bar->add_node($args);

            /**
             * Add Import Export children node
             */
            if (class_exists('DZ_Import')) {
                $args = array(
                    'id'     => 'dz-import',
                    'title'  => esc_html__('Import Demo', 'jobzilla'),
                    'href'   => admin_url('admin.php?page=dz-import'),
                    'parent' => $theme->get("TextDomain"),
                    'meta'   => array(
                        'class' => '',
                        'title' => esc_html__('Import Demo', 'jobzilla'),
                    )
                );
                $wp_admin_bar->add_node($args);
            }
            
			/**
             * Add Theme options children node
             */
             if (class_exists('ReduxFramework')) {
                $args = array(
                    'id'     => 'theme-options',
                    'title'  => esc_html__('Theme Options', 'jobzilla'),
                    'href'   => admin_url('admin.php?page=theme-options'),
                    'parent' => $theme->get("TextDomain"),
                    'meta'   => array(
                        'class' => '',
                        'title' => esc_html__('Import Demos', 'jobzilla'),
                    )
                );
                $wp_admin_bar->add_node($args);
            } 
			
			
			
			
        }
    }
}
new Jobzilla_Menu_Handle();