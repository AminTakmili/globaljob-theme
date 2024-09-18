<?php
/**
 ReduxFramework Theme Option File
 For full documentation, please visit: https://github.com/ReduxFramework/ReduxFramework/wiki
 *
 */

if (!class_exists('ReduxFramework'))
{
    return;
}

if (!class_exists('Jobzilla_Redux_Framework_config'))
{
    class Jobzilla_Redux_Framework_config
    {

        public $args = array();
        public $sections = array();
        public $theme;
        public $ReduxFramework;
        public $page_template_options;
        public $coming_template_options;
        public $maintenance_template_options;
        public $error_template_options;
        public $header_style_options;
        public $footer_style_options;
        public $post_layouts_options;
        public $sidebar_layout_options;
        public $page_banner_options;
        public $post_banner_options;
        public $theme_layout_options;
        public $theme_color_background_options;
        public $theme_image_background_options;
        public $theme_pattern_background_options;
        public $theme_color_options;
        public $page_loader_options;
		public $page_banner_layout_options;
        public $post_related_layout_options;
        public $sort_by_options;
        public $link_target_options;
        public $social_link_options;
        public $social_share_options;
        public $bingmap_culture_options;
        public $job_map_options;
        public $banner_type;
		public $page_list;
		public $banner_style;
		public $jobzilla_fontawesome_icon;
     

        function __construct() 
        {
            /** Option Variable assigning values **/
            $this->page_template_options = jobzilla_get_page_template_options();
            $this->coming_template_options = jobzilla_get_coming_template_options();
            $this->maintenance_template_options = jobzilla_get_maintenance_template_options();
            $this->error_template_options = jobzilla_get_error_template_options();
            $this->header_style_options = jobzilla_get_header_style_options();
            $this->footer_style_options = jobzilla_get_footer_style_options();
            $this->post_layouts_options = jobzilla_get_post_layouts_options();
            $this->sidebar_layout_options = jobzilla_get_sidebar_layout_options();
            $this->page_banner_options = jobzilla_get_page_banner_options();
            $this->page_banner_layout_options = jobzilla_get_page_banner_layout_options();
            $this->post_banner_options = jobzilla_get_post_banner_options();
            $this->theme_layout_options = jobzilla_get_theme_layout_options();
            $this->theme_color_background_options = jobzilla_get_theme_color_background_options();
            $this->theme_image_background_options = jobzilla_get_theme_image_background_options();
            $this->theme_pattern_background_options = jobzilla_get_theme_pattern_background_options();
            $this->theme_color_options = jobzilla_get_theme_color_options();
            $this->page_loader_options = jobzilla_get_page_loader_options();
            $this->sort_by_options = jobzilla_get_sort_by_options();
            $this->link_target_options = jobzilla_get_link_target_options();
            $this->social_link_options = jobzilla_get_social_link_options();
            $this->post_related_layout_options = jobzilla_get_post_related_layout_options();
            $this->social_share_options = jobzilla_get_social_share_options();
            $this->banner_type = jobzilla_banner_type();
            $this->jobzilla_fontawesome_icon = jobzilla_get_fontawesome_icon();
            $this->page_list = jobzilla_get_pages_list();
			$this->bingmap_culture_options = jobzilla_get_bingmap_culture();
			$this->job_map_options = jobzilla_job_map_options();
			$this->banner_style = jobzilla_get_page_banner_style_options();
			
            /** End Option Variable assigning values **/

            /* Just for demo purposes. Not needed per say. */
            $this->theme = wp_get_theme();

            /* Set the default arguments */
            $this->setArguments();

            /*  array of widgets */
            $this->jobzilla_get_wp_widgets();

            /* Create the sections and fields */
            $this->setSections();

            /* default theme options */
            if (!isset($this->args['opt_name']))
            { /* No errors please */
                return;
            }
            $this->ReduxFramework = new ReduxFramework($this->sections, $this->args);
        }

        /**
			* All the possible arguments for Redux.
         * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
         *
         */

        function setArguments()
        {
		

            $theme = wp_get_theme(); /* For use with some settings. Not necessary. */
            $opt_name = jobzilla_get_opt_name();
			

            $this->args = array(

                /* TYPICAL -> Change these values as you need/desire */
                'opt_name' => $opt_name,
                /* This is where your data is stored in the database and also becomes your global variable name. */
                'display_name' => $theme->get('Name') ,
                /* Name that appears at the top of your panel */
                'display_version' => $theme->get('Version') ,
                /* Version that appears at the top of your panel */
                'menu_type' => class_exists('Jobzilla_Menu_Handle') ? 'submenu' : 'menu',
                /* Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only) */
                'allow_sub_menu' => false,
                /* Show the sections below the admin menu item or not */
                'menu_title' => esc_html__('Theme Options', 'jobzilla') ,
                'page_title' => esc_html__('Theme Options', 'jobzilla') ,
                /* You will need to generate a Google API key to use this feature. */
                /* Please visit: https://developers.google.com/fonts/docs/developer_api#Auth */
                'google_api_key' => '',
                /* Set it you want google fonts to update weekly. A google_api_key value is required. */
                'google_update_weekly' => false,
                /* Must be defined to add google fonts to the typography module */
                'async_typography' => false,
                /* Use a asynchronous font on the front end or font string */
                /* 'disable_google_fonts_link' => true,  */                   /* Disable this in case you want to create your own google fonts loader */
                'admin_bar' => false,
                /* Show the panel pages on the admin bar */
                'admin_bar_icon' => 'dashicons-admin-generic',
                /*  Choose an icon for the admin bar menu */
                'admin_bar_priority' => 50,
                /* Choose an priority for the admin bar menu */
                'global_variable' => '',
                /* Set a different name for your global variable other than the opt_name */
                'dev_mode' => true,
                /* Show the time the page took to load, etc */
                'update_notice' => true,
                /* If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo */
                'customizer' => false,
                /* Enable basic customizer support */
                /* 'open_expanded'     => true,  */                   /* Allow you to start the panel in an expanded way initially. */
                /* 'disable_save_warn' => true,  */                   /* Disable the save warning when a user changes a field */
                'show_options_object' => false,
                /*  OPTIONAL -> Give you extra features */
                'page_priority' => null,
                /*  Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning. */
                'page_parent' => class_exists('Jobzilla_Menu_Handle') ? $theme->get('TextDomain') : '',
                /*  For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters */
                'page_permissions' => 'manage_options',
                /*  Permissions needed to access the options panel. */
                'menu_icon' => '',
                /*  Specify a custom URL to an icon */
                'last_tab' => '',
                /*  Force your panel to always open to a specific tab (by id) */
                'page_icon' => 'icon-themes',
                /*  Icon displayed in the admin panel next to your menu_title */
                'page_slug' => 'theme-options',
                /*  Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided */
                'save_defaults' => true,
                /*  On load save the defaults to DB before user clicks save or not */
                'default_show' => false,
                /*  If true, shows the default value next to each field that is not the default value. */
                'default_mark' => '',
                /*  What to print by the field's title if the value shown is default. Suggested: * */
                'show_import_export' => true,
                /*  Shows the Import/Export panel when not used as a field. */
                /*  CAREFUL -> These options are for advanced use only */
                'transient_time' => 60 * MINUTE_IN_SECONDS,
                'output' => false,
                /*  Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output */
                'output_tag' => true,
                /*  Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head */
                /* 'footer_credit'     => '', */                   /* Disable the footer credit of Redux. Please leave if you can help it. */
                /* FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk. */
                'database' => '',
                /* possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning! */
                'use_cdn' => true,
				
                /* If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code. */
                /*  HINTS */
                'hints' => array(
                    'icon' 			=> 'el el-question-sign',
                    'icon_position' => 'right',
                    'icon_color' 	=> '#1085e4',
                    'icon_size' 	=> '10',
                    'tip_style' 	=> array(
                        'color' 	=> '#1085e4',
                        'shadow' 	=> true,
                        'rounded' 	=> false,
                        'style' 	=> '',
                    ) ,
                    'tip_position' => array(
                        'my' 	=> 'top left',
                        'at' 	=> 'bottom right',
                    ) ,
                    'tip_effect' => array(
                        'show' 	 => array(
                            'effect' 	=> 'slide',
                            'duration' 	=> '500',
                            'event' 	=> 'mouseover',
                        ) ,
                        'hide' 	=> array(
                            'effect' 	=> 'slide',
                            'duration' 	=> '500',
                            'event' 	=> 'click mouseleave',
                        ) ,
                    ) ,
                ) ,
                'templates_path' => class_exists('DZCore') ? dzcore()
                    ->path('APP_DIR') . '/templates/redux/' : '',
            );
        }

        /**
         * Custom query for widget list array
         *
         * @param  array $all_widgets
         */
        function jobzilla_get_wp_widgets_in_progress()
        {

            global $wpdb;
            $table = $wpdb->prefix . 'options';
            $attrPrefix = 'widget_';

			$query = "SELECT `option_id`, `option_name` FROM $table WHERE `option_name` LIKE '%$attrPrefix%' AND `option_name` != 'sidebars_widgets' ORDER BY `option_id` ASC";
			$prepare = $wpdb->prepare($query);
            $result = $wpdb->get_row($prepare);
			
			$all_widgets = array();

            foreach ($result as $widget)
            {
                $all_widgets[$widget->option_name] = ucwords(str_replace("_", " ", $widget->option_name));
            }

            return $all_widgets;
        }
		
		
		function jobzilla_get_wp_widgets()
        {

            global $wpdb;
            $table = $wpdb->prefix . 'options';
            $attrPrefix = 'widget_';

            $result = $wpdb->get_results("SELECT `option_id`, `option_name` FROM $table WHERE `option_name` LIKE '%$attrPrefix%' AND `option_name` != 'sidebars_widgets' ORDER BY `option_id` ASC");

			

            $all_widgets = array();

            foreach ($result as $widget)
            {
                $all_widgets[$widget->option_name] = ucwords(str_replace("_", " ", $widget->option_name));
            }

            return $all_widgets;
        }

        /**
         * All the possible sections for Redux.
         *
         */
        function setSections()
        {

            /*--------------------------------------------------------------
            # 1. General Settings
            --------------------------------------------------------------*/
            $this->sections[] = array(
                'title' 	=> esc_html__('General Settings', 'jobzilla') ,
                'desc' 		=> esc_html__('General Settings is a global setting that will affects all the pages of you website. From here you can make changes globaly. The setting will apply if there is no individual settings.', 'jobzilla') ,
                'icon' 		=> 'el-icon-home',
                'fields' 	=> array(
                    array(
                        'id' 		=> 'website_status',
                        'type' 		=> 'button_set',
                        'title' 	=> esc_html__('Website Status', 'jobzilla') ,
                        'subtitle' 	=> esc_html__('Click on the option tabs to change the status of your website.', 'jobzilla') ,
                        'desc' 		=> esc_html__('Select option tabs to change the status.', 'jobzilla') ,
                        'options' 	=> array(
                            'live_mode' 		=> esc_html__('Live', 'jobzilla') ,
                            'comingsoon_mode' 	=> esc_html__('Coming Soon', 'jobzilla') ,
                            'maintenance_mode' 	=> esc_html__('Site Down For Maintenance', 'jobzilla')
                        ) ,
                        'default' 		=> 'live_mode',
                        'hint' 			=> array(
                            'title' 	=> esc_html__('Status', 'jobzilla'),
                            'content' 	=> esc_html__('1. Live status indicate that your website is available and operational.', 'jobzilla') . '<br><br>' . esc_html__('2. Coming Soon status show your website visitors that you are working on your website for making it better.', 'jobzilla') . '<br><br>' . esc_html__('3. Maintenance mode show your website visitors that you are working on your website for making it better.', 'jobzilla') . '<br><br> <strong>Note : </strong> ' . esc_html__(' Coming soon template and maintenance template will not show when user login.', 'jobzilla')
                        )
                    ),
                    array(
                        'id' 		=> 'coming_soon_template',
                        'type' 		=> 'image_select',
                        'title' 	=> esc_html__('Coming Soon Template', 'jobzilla') ,
                        'subtitle' 	=> esc_html__('Choose the template for Coming Soon page. (Default : 1).', 'jobzilla') ,
                        'desc' 		=> esc_html__('Click on the icon to change the template.', 'jobzilla') ,
                        'options' 	=> $this->coming_template_options,
                        'default' 	=> 'coming_style_1',
                        'required' 	=> array( 0 => 'website_status', 1 => 'equals', 2 => 'comingsoon_mode' ) ,
                        'hint' 		=> array(
                            'title'	  => esc_html__('Hint Title', 'jobzilla') ,
                            'content' => esc_html__('Choose the coming soon template design as you want to show.', 'jobzilla')
                        )
                    ) ,
					array(
                        'id'		=> 'comingsoon_launch_date',
                        'type' 		=> 'date',
                        'title' 	=> esc_html__('Coming soon Date', 'jobzilla') ,
                        'required'	=> array( 0 => 'website_status', 1 => 'equals', 2 => 'comingsoon_mode' ) ,
                    ) ,
                    array(
                        'id' 		=> 'comingsoon_bg',
                        'type' 		=> 'media',
                        'url' 		=> true,
                        'title' 	=> esc_html__('Coming Soon Page Background', 'jobzilla') ,
                        'required' 	=> array( 0 => 'website_status', 1 => 'equals', 2 => 'comingsoon_mode' ) ,
                        'default' 	=> array(
                            'url' 	=> get_template_directory_uri() . '/assets/images/bg-3.jpg'
                        ) ,
                    ) ,
					array(
                        'id' 		=> 'comingsoon_page_title',
                        'type' 		=> 'text',
                        'title' 	=> esc_html__('Comingsoon Soon Page Title', 'jobzilla') ,
                        'desc' 		=> esc_html__('Default Comingsoon Soon page title.', 'jobzilla') ,
                        'default' 	=> '<span class="site-text-primary">'.esc_html__('Coming Soon!', 'jobzilla'). '</span>'. esc_html__('Were doing something amazingalmost done....', 'jobzilla'),
						'required' 	=> array( 0 => 'website_status', 1 => 'equals', 2 => 'comingsoon_mode' ) ,
                    ) ,
					array(
                        'id' 		=> 'comingsoon_page_description',
                        'type' 		=> 'text',
                        'title' 	=> esc_html__('Comingsoon Soon Page Description', 'jobzilla') ,
                        'desc' 		=> esc_html__('Default Comingsoon Soon page description.', 'jobzilla') ,
                        'default' 	=> esc_html__('Type Your Email To Get Notified', 'jobzilla'),
						'required' 	=> array( 0 => 'website_status', 1 => 'equals', 2 => 'comingsoon_mode' ) ,
                    ) ,
                    array(
                        'id' 		=> 'maintenance_template',
                        'type' 		=> 'image_select',
                        'title' 	=> esc_html__('Maintenance Template', 'jobzilla') ,
                        'subtitle' 	=> esc_html__('Choose the template for Maintenance page.', 'jobzilla') ,
                        'desc' 		=> esc_html__('Click on the icon to change the template.', 'jobzilla') ,
                        'options' 	=> $this->maintenance_template_options,
                        'default' 	=> 'maintenance_style_1',
                        'required' 	=> array( 0 => 'website_status', 1 => 'equals', 2 => 'maintenance_mode' ) ,
                        'hint' 		=> array(
                            'title' => esc_html__('Hint Title', 'jobzilla') ,
                            'content'=> esc_html__('Choose the maintenance template design as you want to show.', 'jobzilla')
                        )
                    ),					
                    array(
                        'id' 		=> 'maintenance_title',
                        'type' 		=> 'text',
                        'title' 	=> esc_html__('Maintenance Page Title', 'jobzilla') ,
                        'required' 	=> array( 0 => 'website_status', 1 => 'equals', 2 => 'maintenance_mode' ) ,
                        'default' 	=> esc_html__('Website is under ', 'jobzilla') . ' <span class="site-text-primary">' . esc_html__('Maintenance', 'jobzilla').'</span>' ,
                    ),  
                    array(
                        'id'        => 'maintenance_desc',
                        'type'      => 'text',
                        'title'     => esc_html__('Maintenance Page Description', 'jobzilla') ,
                        'desc'      => esc_html__('Default Maintenance page description.', 'jobzilla') ,
                        'default'   => esc_html__("We apologize for any Inconvenience caused. We've almost done.", 'jobzilla'),
                        'required'  => array( 0 => 'website_status', 1 => 'equals', 2 => 'maintenance_mode' ) ,
                    ) ,  
                    array(
                        'id'        => 'maintenance_bg',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => esc_html__('Maintenance Page Image', 'jobzilla') ,
                        'required'  => array( 0 => 'website_status', 1 => 'equals', 2 => 'maintenance_mode' ) ,
                        'default'   => array(
                            'url'   => get_template_directory_uri() . '/assets/images/bg-1.jpg'
                        ) ,
                    ) ,     
					array(
                        'id'        => 'maintenance_img',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => esc_html__('Maintenance Page Image', 'jobzilla') ,
                        'required'  => array( 0 => 'website_status', 1 => 'equals', 2 => 'maintenance_mode' ) ,
                        'default'   => array(
                            'url'   => get_template_directory_uri() . '/assets/images/under-m.png'
                        ) ,
                    ) ,      
                    array(
                        'id' 		=> 'logo_type',
                        'type' 		=> 'button_set',
                        'title' 	=> esc_html__('Logo Type', 'jobzilla') ,
                        'subtitle' 	=> esc_html__('Choose the logo type', 'jobzilla') ,
                        'desc' 		=> esc_html__('Click o the tab to change the logo type.', 'jobzilla') ,
                        'options' 	=> array(
                            'image_logo'=> esc_html__('Image Logo', 'jobzilla') ,
                            'text_logo' => esc_html__('Text Logo', 'jobzilla')
                        ) ,
                        'default' 	=> 'image_logo',
                        'hint' => array(
                            'title' 	=> esc_html__('Choose Logo Type:', 'jobzilla') ,
                            'content' 	=> esc_html__('1. Image Logo will be the .pmg / .jpg type. This setting affects all the site pages.', 'jobzilla') . '<br><br>' . esc_html__('2. Text Logo will the text type. This setting affects all the site pages.', 'jobzilla')
                        ),
						'required' 	=> array( 0 => 'website_status', 1 => 'equals', 2 => 'live_mode' ) ,
                    ) ,
                    array(
                        'id' 		=> 'blog_page_title',
                        'type' 		=> 'text',
                        'title' 	=> esc_html__('Blog Page Title', 'jobzilla') ,
                        'desc' 		=> esc_html__('Default blog page title.', 'jobzilla') ,
                        'default' 	=> esc_html__('Blog', 'jobzilla'),
						'required' 	=> array( 0 => 'website_status', 1 => 'equals', 2 => 'live_mode' ) ,
                    ) ,
                    array(
                        'id' 		=> 'page_loading_on',
                        'type' 		=> 'switch',
                        'title' 	=> esc_html__('Page Loading', 'jobzilla') ,
                        'subtitle' 	=> esc_html__('Click on the tab to Enable / Disable the page loading setting.', 'jobzilla') ,
                        'desc' 		=> esc_html__('Once you click on disable, This setting affects all the site pages.', 'jobzilla') ,
                        'on' 		=> esc_html__('Enabled', 'jobzilla') ,
                        'off' 		=> esc_html__('Disabled', 'jobzilla') ,
                        'default' 	=> false,
						'required' 	=> array( 0 => 'website_status', 1 => 'equals', 2 => 'live_mode' ) ,
                    ) ,

                    array(
                        'id' 		=> 'show_social_icon',
                        'type' 		=> 'switch',
                        'title' 	=> esc_html__('Social Icon', 'jobzilla') ,
                        'subtitle' 	=> esc_html__('Click on the tab to Enable / Disable the social icon setting.', 'jobzilla') ,
                        'desc' 		=> esc_html__('Once you click on disable, This setting affects all the site pages.', 'jobzilla') ,
                        'on' 		=> esc_html__('Enabled', 'jobzilla') ,
                        'off' 		=> esc_html__('Disabled', 'jobzilla') ,
                        'default' 	=> false,
						'required' 	=> array( 0 => 'website_status', 1 => 'equals', 2 => 'live_mode' ) ,
                    ) ,
                    array(
                        'id' 		=> 'show_breadcrumb',
                        'type' 		=> 'switch',
                        'title' 	=> esc_html__('Breadcrumb Area', 'jobzilla') ,
                        'subtitle' 	=> esc_html__('Click on the tab to Enable / Disable the website breadcrumb.', 'jobzilla') ,
                        'desc' 		=> esc_html__('Once you click on disable, This setting affects all the site pages.', 'jobzilla') ,
                        'on' 		=> esc_html__('Enabled', 'jobzilla') ,
                        'off' 		=> esc_html__('Disabled', 'jobzilla') ,
                        'default' 	=> true,
						'required' 	=> array( 0 => 'website_status', 1 => 'equals', 2 => 'live_mode' ) ,
						'hint' 		=> array(
                            'title' 	=> esc_html__('Select Breadcrumb Area:', 'jobzilla') ,
                            'content' 	=> esc_html__('This breadcrumb option only works when page level banner Theme Settings option selected. This option will not work when custom settings selected.', 'jobzilla'),
                        )
                    ) ,
                    array(
                        'id' 		=> 'show_login_registration',
                        'type' 		=> 'switch',
                        'title' 	=> esc_html__('Login / Register', 'jobzilla') ,
                        'subtitle' 	=> esc_html__('Click on the tab to Enable / Disable the login / register button / likns.', 'jobzilla') ,
                        'desc' 		=> esc_html__('Once you click on disable, This setting affects all the site pages.', 'jobzilla') ,
                        'on' 		=> esc_html__('Enabled', 'jobzilla') ,
                        'off' 		=> esc_html__('Disabled', 'jobzilla') ,
                        'default'	=> false,
						'required' 	=> array( 0 => 'website_status', 1 => 'equals', 2 => 'live_mode' ) ,
                        'hint' 		=> array(
                            'title' 	=> esc_html__('Login/Register Visible', 'jobzilla') ,
                            'content' 	=> esc_html__('This is show in top bar.', 'jobzilla')
                        )
                    ) ,
                    array(
                        'id' 		=> 'show_sidebar',
                        'type' 		=> 'switch',
                        'title' 	=> esc_html__('Sidebar', 'jobzilla') ,
                        'subtitle' 	=> esc_html__('Click on the tab to Enable / Disable the sidebar.', 'jobzilla') ,
                        'desc' 		=> esc_html__('Once you click on disable, This setting affects all the site pages.', 'jobzilla') ,
                        'on' 		=> esc_html__('Enabled', 'jobzilla') ,
                        'off' 		=> esc_html__('Disabled', 'jobzilla') ,
                        'default' 	=> true,
						'required' 	=> array( 0 => 'website_status', 1 => 'equals', 2 => 'live_mode' ) ,
                    ) ,
		
                  
                    array(
                        'id' 		=> 'mailchimp',
                        'type' 		=> 'switch',
                        'title' 	=> esc_html__('Mailchimp', 'jobzilla') ,
                        'subtitle' 	=> esc_html__('Click on the tab to Enable / Disable mailchimp subscription.', 'jobzilla') ,
                        'on' 		=> esc_html__('Enabled', 'jobzilla') ,
                        'off' 		=> esc_html__('Disabled', 'jobzilla') ,
                        'default' 	=> true,
						'required' 	=> array( 0 => 'website_status', 1 => 'equals', 2 => 'live_mode' ) ,
                    ) ,
                    array(
                        'id' 		=> 'mailchimp_api_key',
                        'type' 		=> 'text',
                        'title' 	=> esc_html__('MailChimp Api Key', 'jobzilla') ,
                        'desc' 		=> esc_html__('Input an API key to enable MailChimp.', 'jobzilla') ,
                        'default' 	=> '',
                        'required' 	=> array( 0 => 'mailchimp', 1 => 'equals', 2 => 1) ,
                    ) ,
                    array(
                        'id' 		=> 'mailchimp_list_id',
                        'type' 		=> 'text',
                        'title' 	=> esc_html__('MailChimp List ID', 'jobzilla') ,
                        'desc' 		=> esc_html__('Input an List ID to enable MailChimp.', 'jobzilla') ,
                        'default' 	=> '',
                        'required' 	=> array( 0 => 'mailchimp', 1 => 'equals', 2 => 1) ,
                    ) ,	
					 array(
                        'id' 		=> 'preload_image',
                        'type' 		=> 'media',
                        'url' 		=> true,
                        'title' 	=> esc_html__('Preload Image', 'jobzilla') ,
                        'required' 	=> array( 0 => 'website_status', 1 => 'equals', 2 => 'live_mode' ) ,
                        
                    ) ,
                )
            );

            /*--------------------------------------------------------------
            # 2. Logo Settings
            --------------------------------------------------------------*/
            $this->sections[] = array(
                'title' => esc_html__('Logo Settings', 'jobzilla') ,
                'icon' 	=> 'el el-cog-alt',
                'fields'=> array(
                    array(
                        'id' 		=> 'favicon',
                        'type' 		=> 'media',
                        'url' 		=> true,
                        'title' 	=> esc_html__('Favicon', 'jobzilla') ,
                        'subtitle' 	=> esc_html__('Select favicon image.', 'jobzilla') ,
                        'desc' 		=> esc_html__('Upload favicon image.', 'jobzilla') ,
                        'default' 	=> array(
                            'url' 	=> get_template_directory_uri() . '/assets/images/favicon.png'
                        ) ,
                        'hint' 		=> array(
                            'title' 	=> esc_html__('Favicon', 'jobzilla') ,
                            'content' 	=> esc_html__('From here you can upload an image. This setting affects all the site pages.', 'jobzilla')
                        )
                    ) ,
                    array(
                        'id' 		=> 'logo_text',
                        'type' 		=> 'text',
                        'title' 	=> esc_html__('Logo Text', 'jobzilla') ,
                        'subtitle' 	=> esc_html__('Name your text logo.', 'jobzilla') ,
                        'default' 	=> get_bloginfo('name') ,
                    ) ,
                    array(
                        'id' 		=> 'tag_line',
                        'type' 		=> 'text',
                        'title' 	=> esc_html__('Tag Line', 'jobzilla') ,
                        'subtitle' 	=> esc_html__('Name a tagline for the text logo.', 'jobzilla') ,
                        'default' 	=> get_bloginfo('description') ,
                    ) ,
                    array(
                        'id' 		=> 'logo_title',
                        'type' 		=> 'text',
                        'title' 	=> esc_html__('Logo Title', 'jobzilla') ,
                        'subtitle' 	=> esc_html__('Title attribute for the logo. This attribute specifies extra information about the logo. Most browsers will show a tooltip with this text on logo hover.', 'jobzilla') ,
                        'default' 	=> get_bloginfo('name') ,

                    ) ,
                    array(
                        'id' 		=> 'logo_alt',
                        'type' 		=> 'text',
                        'title' 	=> esc_html__('Logo Alt', 'jobzilla') ,
                        'subtitle' 	=> esc_html__('Alt attribute for the logo. This is the alternative text if the logo cannot be displayed. It`s useful for SEO and generally is the name of the site.', 'jobzilla') ,
                        'default' 	=> get_bloginfo('name') ,
                    ) ,
                    array(
                        'id' 		=> 'logo-section-start',
                        'type' 		=> 'section',
                        'title' 	=> esc_html__('Site Logo Setting', 'jobzilla') ,
                        'indent' 	=> true
                    ) ,
				
                    array(
                        'id' 		=> 'site_logo',
                        'type' 		=> 'media',
                        'url' 		=> true,
                        'title' 	=> esc_html__('Logo', 'jobzilla') ,
                        'subtitle' 	=> esc_html__('Upload your logo (272 x 90px) .png or .jpg', 'jobzilla') ,
                        'default' 	=> array(
                            'url' 	=> get_template_directory_uri() . '/assets/images/logo-dark.png'
                        )
                    ) ,
                    array(
                        'id' 		=> 'site_other_logo',
                        'type' 		=> 'media',
                        'url' 		=> true,
                        'title' 	=> esc_html__('Other Logo', 'jobzilla') ,
                        'subtitle' 	=> esc_html__('Upload your logo (272 x 90px) .png or .jpg', 'jobzilla') ,
                        'default' 	=> array(
                            'url' 	=> get_template_directory_uri() . '/assets/images/logo-light.png'
                        )
                    ),
                    array(
                        'id' 		=> 'logo-section-end',
                        'type' 		=> 'section',
                        'indent'	=> false,
                    ) ,
                )
            );

            /*--------------------------------------------------------------
            # 3. Header Settings
            --------------------------------------------------------------*/
            $header_social_links = $header_social_defaults = array();

            foreach ($this->social_link_options as $social_link)
            {

                $link_value = jobzilla_get_opt('social_' . $social_link['id'] . '_url');

                if (!empty($link_value))
                {
                    $header_social_links[$social_link['id']] = $social_link['title'];
                    $header_social_defaults[$social_link['id']] = false;
                }
            }
			
			
			

            $header_style_options = jobzilla_header_style_options();
            $header_aditional_array = array();
            $mobile_header_aditional_array = array();
            foreach ($header_style_options as $header)
            {
                $header_id = $header['id'];

                $header_social_defaults_1 = $header_social_defaults;

                $header_search_on = jobzilla_set($header['param'], 'search', false);
                $social_link = jobzilla_set($header['param'], 'social_link', false);
                $header_top_bar = jobzilla_set($header['param'], 'top_bar', false);
                $header_location_on = jobzilla_set($header['param'], 'location', false);				
                $call_to_action_button = jobzilla_set($header['param'], 'call_to_action_button', 0);
				$informative_fields = jobzilla_set($header['param'], 'informative_fields_header', 0);
				
                $total_links = jobzilla_set($header['param'], 'social_links', 0);
                if ($total_links > 0)
                {
                    $i = 1;
                    foreach ($header_social_links as $key => $value)
                    {
                        if ($i <= $total_links)
                        {
                            $header_social_defaults_1[$key] = 1;
                        }
                        else
                        {
                            $header_social_defaults_1[$key] = 0;
                        }
                        $i++;
                    }
                }
				
				
				if ($informative_fields > 0)
                {
                    for ($i = 1;$i <= $informative_fields;$i++)
                    {
                        $header_aditional_array[] = array(
                            'id' 		=> $header_id . '_info_field_' . $i . '_icon_class',
                            'type' 		=> 'text',
                            'title' 	=> esc_html__('Icon Class ', 'jobzilla'),
                            'default' 	=> '',
                            'required' 	=> array(0 => 'header_style', 1 => 'equals', 2 => $header_id),
                        );
                     
                        $header_aditional_array[] = array(
                            'id' 		=> $header_id . '_info_field_' . $i . '_address',
                            'type' 		=> 'text',
                            'title' 	=> esc_html__('Value ', 'jobzilla'),
                            'default' 	=> '',
                            'required' 	=> array(0 => 'header_style', 1 => 'equals', 2 => $header_id),
                        );
                    }
                }              
				
				$header_aditional_array[] = array(
					'id'    => $header_id . '_information',
					'type'  => 'info',
					'style' => 'success',
					'title' => esc_html__('Header Information!', 'jobzilla'),
					'icon'  => 'el-icon-info-sign',
					'desc'  => $header_id.' '.esc_html__( 'header settings display here.', 'jobzilla'),
					'required' => array(
                        0 => 'header_style',
                        1 => 'equals',
                        2 => $header_id
                    )
				);	               
				
				 /******Header Related Fields *****/
				$header_aditional_array[] = array(
					'id' 		=> $header_id . '_search_on',
					'type' 		=> 'switch',
					'title' 	=> esc_html__('Search', 'jobzilla') ,
					'subtitle' 	=> esc_html__('Show or hide the website search option.', 'jobzilla') ,
					'on' 		=> esc_html__('Enabled', 'jobzilla') ,
					'off' 		=> esc_html__('Disabled', 'jobzilla') ,
					'default' 	=> $header_search_on,
					'required' 	=> array(0 => 'header_style', 1 => 'equals', 2 => $header_id)
				);
				
				if ($call_to_action_button > 0)
				{
					for ($i = 1;$i <= $call_to_action_button;$i++)
					{
						$header_aditional_array[] = array(
							'id' 		=> $header_id . '_button_' . $i . '_text',
							'type' 		=> 'text',
							'title' 	=> esc_html__('Button ', 'jobzilla') . $i . esc_html__(' Text', 'jobzilla') ,
							'default' 	=> '',
							'required' 	=> array(0 => 'header_style', 1 => 'equals', 2 => $header_id)
						);
						$header_aditional_array[] = array(
							'id' 		=> $header_id . '_button_' . $i . '_url',
							'type' 		=> 'text',
							'title' 	=> esc_html__('Button ', 'jobzilla') . $i . esc_html__(' URL', 'jobzilla') ,
							'default' 	=> '',
							'required' 	=> array(0 => 'header_style', 1 => 'equals', 2 => $header_id)

						);
						$header_aditional_array[] = array(
							'id' 		=> $header_id . '_button_' . $i . '_target',
							'type' 		=> 'select',
							'title' 	=> esc_html__('Choose Button ', 'jobzilla') . $i . esc_html__(' Target', 'jobzilla') ,
							'options' 	=> $this->link_target_options,
							'default' 	=> '_self',
							'required' 	=> array(0 => 'header_style', 1 => 'equals', 2 => $header_id)
						);
					}
				}

                $mobile_header_aditional_array[] = array(
                    'id' 			=> $header_id . '_mobile_social_link_on',
                    'type' 			=> 'switch',
                    'title' 		=> esc_html__('Header Social Link', 'jobzilla') ,
                    'subtitle' 		=> esc_html__('Show or hide the hader social link option.', 'jobzilla') ,
                    'on' 			=> esc_html__('Enabled', 'jobzilla') ,
                    'off' 			=> esc_html__('Disabled', 'jobzilla') ,
                    'default' 		=> $social_link,
                    'required' 		=> array(0 => 'header_style', 1 => 'equals', 2 => $header_id)
                );

                /******Header Related Fields *****/
            }

            $headerDefaultOption = array(
                'title' 	=> esc_html__('Header Settings', 'jobzilla') ,
                'icon' 		=> 'fa fa-header',
                'fields' 	=> array(
                    array(
                        'id' 		=> 'header_style',
                        'type' 		=> 'image_select',
                        'title' 	=> esc_html__('Header Style', 'jobzilla') ,
                        'subtitle' 	=> esc_html__('Choose header style. White header is set as default header for all theme.', 'jobzilla') ,
                        'options' 	=> $this->header_style_options,
                        'default' 	=> 'header_3',
                        'hint' 		=> array(
                            array(
                                'title' 	=> 'Hint Title',
                                'content' 	=> esc_html__('This is the content of the tool-tip', 'jobzilla')
                            )
                        )
                    ),	
                        array(
                        'id'        => 'header_login_on',
                        'type'      => 'switch',
                        'title'     => esc_html__('Login', 'jobzilla') ,
                        'subtitle'  => esc_html__('Show or hide the header login option.', 'jobzilla') ,
                        'on'        => esc_html__('Enabled', 'jobzilla') ,
                        'off'       => esc_html__('Disabled', 'jobzilla') ,
                        'default'   => false
                    ) ,
                    array(
                        'id'        => 'header_register_on',
                        'type'      => 'switch',
                        'title'     => esc_html__('Register', 'jobzilla') ,
                        'subtitle'  => esc_html__('Show or hide the header register option.', 'jobzilla') ,
                        'on'        => esc_html__('Enabled', 'jobzilla') ,
                        'off'       => esc_html__('Disabled', 'jobzilla') ,
                        'default'   => false,
                    ) ,
                    array(
                        'id' 		=> 'header_sticky_on',
                        'type' 		=> 'switch',
                        'title' 	=> esc_html__('Sticky Header', 'jobzilla') ,
                        'subtitle' 	=> esc_html__('Header will be sticked when applicable.', 'jobzilla') ,
                        'on' 		=> esc_html__('Enabled', 'jobzilla') ,
                        'off' 		=> esc_html__('Disabled', 'jobzilla') ,
                        'default' 	=> false
                    ) ,
                    array(
                        'id' 		=> 'mobile_section_start',
                        'type' 		=> 'section',
                        'title' 	=> esc_html__('Mobile Device Options', 'jobzilla') ,
                        'indent' 	=> false
                    ) ,
                    array(
                        'id' 		=> 'mobile_header_login_on',
                        'type' 		=> 'switch',
                        'title' 	=> esc_html__('Login', 'jobzilla') ,
                        'subtitle' 	=> esc_html__('Show or hide the header login option.', 'jobzilla') ,
                        'on' 		=> esc_html__('Enabled', 'jobzilla') ,
                        'off' 		=> esc_html__('Disabled', 'jobzilla') ,
                        'default' 	=> false
                    ) ,
                    array(
                        'id' 		=> 'mobile_header_register_on',
                        'type' 		=> 'switch',
                        'title' 	=> esc_html__('Register', 'jobzilla') ,
                        'subtitle' 	=> esc_html__('Show or hide the header register option.', 'jobzilla') ,
                        'on' 		=> esc_html__('Enabled', 'jobzilla') ,
                        'off' 		=> esc_html__('Disabled', 'jobzilla') ,
                        'default' 	=> false
                    ) ,
                )
            );

            array_splice($headerDefaultOption['fields'], 1, 0, $header_aditional_array);
            $mobileFieldPosition = count($headerDefaultOption['fields']);
            array_splice($headerDefaultOption['fields'], $mobileFieldPosition, 0, $mobile_header_aditional_array);

            $this->sections[] = $headerDefaultOption;
			
			
			/*--------------------------------------------------------------
            # 4. Footer
            --------------------------------------------------------------*/
            $all_widgets = $this->jobzilla_get_wp_widgets();

            $footer_setting_fields[] = array(
                'id' 		=> 'footer_on',
                'type' 		=> 'switch',
                'title' 	=> esc_html__('Footer', 'jobzilla') ,
                'on' 		=> esc_html__('Enabled', 'jobzilla') ,
                'off' 		=> esc_html__('Disabled', 'jobzilla') ,
                'default' 	=> true
            );
			
			

            $footer_setting_fields[] = array(
                'id' 		=> 'footer_style',
                'type' 		=> 'image_select',
                'title' 	=> esc_html__('Footer Template', 'jobzilla') ,
                'subtitle' 	=> esc_html__('Choose a template for footer.', 'jobzilla') ,
                'options' 	=> $this->footer_style_options,
                'default' 	=> 'footer_template_1',
                'required' 	=> array(0 => 'footer_on', 1 => 'equals', 2 => '1')
            );
            $footer_setting_fields[] = array(
                'id'        => 'footer_subscribe_on',
                'type'      => 'switch',
                'title'     => esc_html__('Footer Subscribe On', 'jobzilla') ,
                'on'        => esc_html__('Enabled', 'jobzilla') ,
                'off'       => esc_html__('Disabled', 'jobzilla') ,
                'default'   => false,
                
            );
            $footer_setting_fields[] = array(
                'id'        => 'footer_subscribe_text',
                'type'      => 'textarea',
                'title'     => esc_html__('Subscribe Text', 'jobzilla') ,
                'subtitle'  => esc_html__('Write footer subscribe text here.', 'jobzilla') ,
                'default'   => esc_html__('Join our email subscription now to get updates on new jobs and notifications.', 'jobzilla'),
                'required'  => array(0 => 'footer_on', 1 => 'equals', 2 => '1')
            );
			
			 $footer_setting_fields[] = array(
                'id' 		=> 'footer_top_on',
                'type' 		=> 'switch',
                'title' 	=> esc_html__('Footer Top On', 'jobzilla') ,
                'on' 		=> esc_html__('Enabled', 'jobzilla') ,
                'off' 		=> esc_html__('Disabled', 'jobzilla') ,
                'default' 	=> false,
                
            );
            $footer_setting_fields[] = array(
                'id' 		=> 'footer_bottom_on',
                'type' 		=> 'switch',
                'title' 	=> esc_html__('Footer Bottom On', 'jobzilla') ,
                'on' 		=> esc_html__('Enabled', 'jobzilla') ,
                'off' 		=> esc_html__('Disabled', 'jobzilla') ,
                'default' 	=> false,
                
            );
          
		
            $footer_style_options 	= jobzilla_footer_style_options();
            $total_footer 			= count($this->footer_style_options);

            $footer_block = array();
            $footer_block['All Widgets'] = $all_widgets;

            
            foreach ($footer_style_options as $key => $footer)
            {
                $footer_id 				= $footer['id'];
                $informative_fields 	= jobzilla_set($footer['param'], 'informative_field', 0);
				$call_to_action_button	= jobzilla_set($footer['param'], 'call_to_action_button', 0);
                $bg_image 				= jobzilla_set($footer['param'], 'bg_image', 0);
                if ($bg_image > 0)
                {
                    $footer_setting_fields[] = array(
                        'id' => $footer_id . '_bg_image',
                        'type' => 'media',
                        'url' => true,
                        'title' => esc_html__('Footer Image', 'jobzilla') ,
                        'subtitle' => esc_html__('Show or hide the image.', 'jobzilla') ,
                        'required' => array(
                            array(
                                0 => 'footer_style',
                                1 => 'equals',
                                2 => $footer_id
                            ) ,
                        )
                    );
                }

                if ($footer['param']['copyright'] == 1){}
                if ($footer['param']['powered_by'] == 1){}

				if ($call_to_action_button > 0)
                {
                    for ($i = 1;$i <= $call_to_action_button;$i++)
                    {

                        $footer_setting_fields[] = array(
                            'id' 		=> $footer_id . '_button_' . $i . '_text',
                            'type' 		=> 'text',
                            'title' 	=> esc_html__('Button ', 'jobzilla') . $i . esc_html__(' Text', 'jobzilla') ,
                            'default' 	=> '',
                            'required' 	=> array(0 => 'footer_style', 1 => 'equals', 2 => $footer_id) ,
                        );
                        $footer_setting_fields[] = array(
                            'id' 		=> $footer_id . '_button_' . $i . '_url',
                            'type' 		=> 'text',
                            'title' 	=> esc_html__('Button ', 'jobzilla') . $i . esc_html__(' URL', 'jobzilla') ,
                            'default' 	=> '',
                            'required' 	=> array(0 => 'footer_style', 1 => 'equals', 2 => $footer_id) ,

                        );
                        $footer_setting_fields[] = array(
                            'id' 		=> $footer_id . '_button_' . $i . '_target',
                            'type' 		=> 'select',
                            'title' 	=> esc_html__('Choose Button ', 'jobzilla') . $i . esc_html__(' Target', 'jobzilla') ,
                            'options' 	=> $this->link_target_options,
                            'default' 	=> '_blank',
                            'required' 	=> array(0 => 'footer_style', 1 => 'equals', 2 => $footer_id) ,
                        );
                    }
                }

                if ($informative_fields > 0)
                {
                    for ($i = 1;$i <= $informative_fields;$i++)
                    {						
                       $footer_setting_fields[] = array(
                            'id' 		=> $footer_id . '_info_field_' . $i . '_text',
                            'type' 		=> 'text',
                            'title' 	=> esc_html__('Field ', 'jobzilla') . $i . esc_html__(' Title', 'jobzilla') ,
                            'default' 	=> '',
                            'required' 	=> array(0 => 'footer_style', 1 => 'equals', 2 => $footer_id) ,
                        );
                        $footer_setting_fields[] = array(
                            'id' 		=> $footer_id . '_info_field_' . $i . '_content',
                            'type' 		=> 'textarea',
                            'title' 	=> esc_html__('Field ', 'jobzilla') . $i . esc_html__(' Content', 'jobzilla') ,
                            'default' 	=> '',
                            'required' 	=> array(0 => 'footer_style', 1 => 'equals', 2 => $footer_id) ,
                        );
                    }
                }

            }

            $footer_setting_fields[] = array(
                'id' 		=> 'footer_copyright_text',
                'type' 		=> 'textarea',
                'title' 	=> esc_html__('Copyright Text', 'jobzilla') ,
                'subtitle' 	=> esc_html__('Write footer copyright text here.', 'jobzilla') ,
                'default' 	=> esc_html__('Copyright © 2022', 'jobzilla'). ' <a href="https://dexignzone.com/" class="text-primary" target="_blank">'.esc_html__('DexignZone', 'jobzilla').'</a> '. esc_html__('All rights reserved.', 'jobzilla'),
                'required' 	=> array(0 => 'footer_on', 1 => 'equals', 2 => '1')
            );

            $this->sections[] = array(
                'title' 	=> esc_html__('Footer Settings', 'jobzilla') ,
                'desc' 		=> esc_html__('Footer blocks are change according to footer templates.', 'jobzilla') ,
                'icon' 		=> 'fa fa-home',
                'fields' 	=> $footer_setting_fields
            );
			
			 /*--------------------------------------------------------------
            # 1 Jobs Pages Settings
            --------------------------------------------------------------*/
			$this->sections[] = array(
                'title' => esc_html__('Job Settings', 'jobzilla') ,
                'icon' => 'el el-cogs'
            );
			
			$this->sections[] = array(
                'title' => esc_html__('General Settings', 'jobzilla') ,
                'icon'	=> 'el el-cog',
				'subsection'=> true,
				'fields' 	=> array(
					 array(
                        'id' 		=> 'recruiter_widget_on',
                        'type' 		=> 'switch',
                        'title' 	=> esc_html__('Recruiter Widget', 'jobzilla') ,
                        'subtitle' 	=> esc_html__('Click on the tab to Enable / Disable Recruiter Widget functionality.', 'jobzilla') ,
                        'on' 		=> esc_html__('Enabled', 'jobzilla') ,
                        'off' 		=> esc_html__('Disabled', 'jobzilla') ,
                        'default' 	=> false,
						'hint' 		=> array(
                            'title'	  => esc_html__('Hint Title', 'jobzilla') ,
                            'content' => esc_html__('  Recruiter widget show on job detail page side bar.', 'jobzilla')
                        )
					),
					
					
					array(
                        'id' 		=> 'recruiter_widget_title',
                        'type' 		=> 'text',
                        'placeholder' 	=> esc_html__('Enter your title', 'jobzilla'),
						'title' 	=> esc_html__('Title', 'jobzilla') ,
						'required' 	=> array( 0 => 'recruiter_widget_on', 1 => 'equals', 2 => 1 ) ,
                    ),
					array(
                        'id' 		=> 'recruiter_widget_image',
                        'type' 		=> 'media',
						'url' => true,
                        'placeholder' 	=> esc_html__('Enter your image url', 'jobzilla'),
						'title' 	=> esc_html__('Image Url', 'jobzilla') ,
						'required' 	=> array( 0 => 'recruiter_widget_on', 1 => 'equals', 2 => 1 ) ,
                    ),
					array(
                        'id' 		=> 'recruiter_widget_content',
                        'type' 		=> 'textarea',
                        'placeholder' 	=> esc_html__('Enter your description', 'jobzilla'),
						'title' 	=> esc_html__('Description', 'jobzilla') ,
						'required' 	=> array( 0 => 'recruiter_widget_on', 1 => 'equals', 2 => 1 ) ,
                       
                    ),
					array(
                        'id' 		=> 'recruiter_widget_btn_text',
                        'type' 		=> 'text',
                        'placeholder' 	=> esc_html__('Enter your button text', 'jobzilla'),
						'title' 	=> esc_html__('Button Text', 'jobzilla') ,
						'required' 	=> array( 0 => 'recruiter_widget_on', 1 => 'equals', 2 => 1 ) ,
                    ),
					array(
                        'id' 		=> 'recruiter_widget_btn_url',
                        'type' 		=> 'text',
                        'placeholder' 	=> esc_html__('Enter your button link', 'jobzilla'),
						'title' 	=> esc_html__('Button Link', 'jobzilla') ,
						'required' 	=> array( 0 => 'recruiter_widget_on', 1 => 'equals', 2 => 1 ) ,
                    ),
					array(
                        'id' 		=> 'recruiter_widget_btn_target',
                        'type' 		=> 'text',
                        'placeholder' 	=> esc_html__('Enter your button target', 'jobzilla'),
						'title' 	=> esc_html__('Button Target', 'jobzilla') ,
						'required' 	=> array( 0 => 'recruiter_widget_on', 1 => 'equals', 2 => 1 ) ,
                    ),
					array(
                        'id' 		=> 'post_a_job_on',
                        'type' 		=> 'switch',
                        'title' 	=> esc_html__('Post A Job On', 'jobzilla') ,
                        'subtitle' 	=> esc_html__('Click on the tab to Enable / Disable post a job button functionality.', 'jobzilla') ,
                        'on' 		=> esc_html__('Enabled', 'jobzilla') ,
                        'off' 		=> esc_html__('Disabled', 'jobzilla') ,
                        'default' 	=> true,
						
					),

					array(
                        'id' 		=> 'detail_page_job_view',
                        'type' 		=> 'switch',
                        'title' 	=> esc_html__('Job View', 'jobzilla') ,
                        'on' 		=> esc_html__('Enabled', 'jobzilla') ,
                        'off' 		=> esc_html__('Disabled', 'jobzilla') ,
                        'default' 	=> true,
						
					),
					
					array(
                        'id' 		=> 'job_alert_subcrible',
                        'type' 		=> 'switch',
                        'title' 	=> esc_html__('Job Alert Subscribe', 'jobzilla') ,
						'on' 		=> esc_html__('Enabled', 'jobzilla') ,
						'off' 		=> esc_html__('Disabled', 'jobzilla') ,
                        'default' 	=> false,
						
					),
					array(
						'id'       		=> 'job_alert_cookie_after_close_interval',
						'type'     		=> 'spinner',
						'title'    		=> esc_html__('After Close Interval', 'jobzilla'),
						'desc' 			=> esc_html__('Interval to show modal box  after save subscriber', 'jobzilla') ,
						'min'       	=> 1,
						'step'      	=> 1,
						'max'       	=> 100,
						'display_value' => 'label',
						'required' 	=> array( 0 => 'job_alert_subcrible', 1 => 'equals', 2 => 1 ) ,
					),
					array(
						'id'       		=> 'job_alert_cookie_after_subscription_interval',
						'type'     		=> 'spinner',
						'title'    		=> esc_html__('After Subscription Interval', 'jobzilla'),
						'desc' 		    => esc_html__('Interval to show modal box  after save subscriber', 'jobzilla') ,
						'min'       	=> 1,
						'step'      	=> 1,
						'max'       	=> 100,
						'display_value' => 'label',
						'required' 	=> array( 0 => 'job_alert_subcrible', 1 => 'equals', 2 => 1 ) ,
					),
					array(
                        'id' 		=> 'job_alert_title',
                        'type' 		=> 'text',
                        'placeholder' 	=> esc_html__('Enter your title', 'jobzilla'),
						'title' 	=> esc_html__('Title', 'jobzilla') ,
						'required' 	=> array( 0 => 'job_alert_subcrible', 1 => 'equals', 2 => 1 ) ,
						'default' 	=>  esc_html__('Job Alert','jobzilla'),
                    ),
					array(
                        'id' 		=> 'job_alert_content',
                        'type' 		=> 'textarea',
                        'placeholder' 	=> esc_html__('Enter your description', 'jobzilla'),
						'title' 	=> esc_html__('Description', 'jobzilla') ,
						'required' 	=> array( 0 => 'job_alert_subcrible', 1 => 'equals', 2 => 1 ) ,
                        'default' 	=> esc_html__('Subscribe to receive instant alerts of new relevant jobs directly to your email inbox.','jobzilla'),
                    ),
					array(
                        'id' 		=> 'job_alert_btn_text',
                        'type' 		=> 'text',
                        'placeholder' 	=> esc_html__('Enter your button text', 'jobzilla'),
						'title' 	=> esc_html__('Button Text', 'jobzilla') ,
						'required' 	=> array( 0 => 'job_alert_subcrible', 1 => 'equals', 2 => 1 ) ,
						'default' 	=> esc_html__('Subcrible','jobzilla'),
                    ),
					
					array(
                        'id' 		=> 'login_page_image_url',
                        'type' 		=> 'media',
						'url' => true,
                        'placeholder' 	=> esc_html__('Login page background image url', 'jobzilla'),
						'title' 	=> esc_html__('Login page background Image Url', 'jobzilla'),
                    ),
					array(
                        'id' 		=> 'register_page_image_url',
                        'type' 		=> 'media',
						 'url' => true,
                        'placeholder' 	=> esc_html__('Register page background image url', 'jobzilla'),
						'title' 	=> esc_html__('Register page background Image Url', 'jobzilla') ,
                    ),
					array(
                        'id' 		=> 'register_popup_text',
                        'type' 		=> 'text',
                        'placeholder' 	=> esc_html__('Enter your text', 'jobzilla'),
						'title' 	=> esc_html__('Sign Up Popup Text', 'jobzilla') ,
						'default' 	=> esc_html__('Sign Up and get access to all the features of Jobzilla', 'jobzilla'),
                    ),
					array(
                        'id' 		=> 'login_popup_text',
                        'type' 		=> 'text',
                        'placeholder' 	=> esc_html__('Enter your text', 'jobzilla'),
						'title' 	=> esc_html__('Sign In Popup Text', 'jobzilla') ,
						'default' 	=> esc_html__('Login and get access to all the features of Jobzilla', 'jobzilla'),
                    ),
					array(
						'id'     => 'company_mail_send',
						'type' 	 => 'select',
						'options'	 => jobzilla_get_contact_form_list(),
						'title'  => esc_html__('Company Mail Send', 'jobzilla'),
						'placeholder' 	=> esc_html__('Choose Contact Form', 'jobzilla'),
					),
				),
            );
			
			$this->sections[] = array(
                'title' 	=> esc_html__('Job Pages Settings', 'jobzilla') ,
                'icon' 		=> 'el el-cog',
				'subsection'=> true,
                'fields' 	=> array(
                    array(
                        'id' 		=> 'jobzilla_enable_autologin',
                        'type' 		=> 'switch',
                        'title' 	=> esc_html__('Auto Login', 'jobzilla') ,
                        'subtitle' 	=> esc_html__('Click on the tab to Enable / Disable autologin functionality.', 'jobzilla') ,
                        'on' 		=> esc_html__('Enabled', 'jobzilla') ,
                        'off' 		=> esc_html__('Disabled', 'jobzilla') ,
                        'default' 	=> false,
					) ,
					
					array(
                        'id' 		=> 'jobzilla_dashboard_page',
                        'type' 		=> 'select',
                        'options'	=> $this->page_list,
						'placeholder' 	=> esc_html__('Choose Dashboard Page', 'jobzilla'),
						'title' 	=> esc_html__('Dashboard Page', 'jobzilla') ,
                        'subtitle' 	=> esc_html__('It will show dashboard page on user panel.', 'jobzilla') ,
                    ),
					 array(
                        'id' 		=> 'jobzilla_company_profile_page',
                        'type' 		=> 'select',
                        'options'	=> $this->page_list,
                        'placeholder' 	=> esc_html__('Choose Company Profile Page', 'jobzilla'),
						'title' 	=> esc_html__('Company Profile Page', 'jobzilla') ,
                        'subtitle' 	=> esc_html__('It will show company profile page on user panel.', 'jobzilla') ,
                    ),
					 array(
                        'id' 		=> 'jobzilla_company_add_page',
                        'type' 		=> 'select',
                        'options'	=> $this->page_list,
                        'placeholder' 	=> esc_html__('Choose Add Company Page', 'jobzilla'),
						'title' 	=> esc_html__('Add Company Page', 'jobzilla') ,
                        'subtitle' 	=> esc_html__('It will show add company page on user panel.', 'jobzilla') ,
                    ),
					 array(
                        'id' 		=> 'jobzilla_job_page',
                        'type' 		=> 'select',
                        'options'	=> $this->page_list,
                        'placeholder' 	=> esc_html__('Choose Job Page', 'jobzilla'),
						'title' 	=> esc_html__('Job Page', 'jobzilla') ,
                        'subtitle' 	=> esc_html__('It will show job page on user panel.', 'jobzilla') ,
                    ),
					 array(
                        'id' 		=> 'jobzilla_job_list_page',
                        'type' 		=> 'select',
                        'options'	=> $this->page_list,
                        'placeholder' 	=> esc_html__('Choose Job List Page', 'jobzilla'),
						'title' 	=> esc_html__('Job List Page', 'jobzilla') ,
                        'subtitle' 	=> esc_html__('It will show job list page on user panel.', 'jobzilla') ,
                    ),
					 array(
                        'id' 		=> 'jobzilla_messages_page',
                        'type' 		=> 'select',
                        'options'	=> $this->page_list,
                        'placeholder' 	=> esc_html__('Choose Messages Page', 'jobzilla'),
						'title' 	=> esc_html__('Messages Page', 'jobzilla') ,
                        'subtitle' 	=> esc_html__('It will show messages page on user panel.', 'jobzilla') ,
                    ),
					
					array(
                        'id' 		=> 'jobzilla_my_profile_page',
                        'type' 		=> 'select',
                        'options'	=> $this->page_list,
                        'placeholder' 	=> esc_html__('Choose My Profile Page', 'jobzilla'),
						'title' 	=> esc_html__('My Profile Page', 'jobzilla') ,
                        'subtitle' 	=> esc_html__('It will show my profile page on user panel.', 'jobzilla') ,
                    ),
					array(
                        'id' 		=> 'jobzilla_candidate_page',
                        'type' 		=> 'select',
                        'options'	=> $this->page_list,
                        'placeholder' 	=> esc_html__('Choose Candidate Page', 'jobzilla'),
						'title' 	=> esc_html__('Candidate Page', 'jobzilla') ,
                        'subtitle' 	=> esc_html__('It will show candidate page on user panel.', 'jobzilla') ,
                    ),
					array(
                        'id' 		=> 'jobzilla_bookmark_resumes_page',
                        'type' 		=> 'select',
                        'options'	=> $this->page_list,
                        'placeholder' 	=> esc_html__('Choose Bookmark Resumes Page', 'jobzilla'),
						'title' 	=> esc_html__('Bookmark Resumes Page', 'jobzilla') ,
                        'subtitle' 	=> esc_html__('It will show bookmark resumes page on user panel.', 'jobzilla') ,
                    ),
					array(
                        'id' 		=> 'jobzilla_add_resumes_page',
                        'type' 		=> 'select',
                        'options'	=> $this->page_list,
                        'placeholder' 	=> esc_html__('Choose Add Resume Page', 'jobzilla'),
						'title' 	=> esc_html__('Add Resume Page', 'jobzilla') ,
                        'subtitle' 	=> esc_html__('It will show add resumes page on user panel.', 'jobzilla') ,
                    ),
					array(
                        'id' 		=> 'jobzilla_past_applications_page',
                        'type' 		=> 'select',
                        'options'	=> $this->page_list,
                        'placeholder' 	=> esc_html__('Choose Past Applications  Page', 'jobzilla'),
						'title' 	=> esc_html__('Past Applications', 'jobzilla') ,
                        'subtitle' 	=> esc_html__('It will show past applications page on user panel.', 'jobzilla') ,
                    ),
					 array(
                        'id' 		=> 'jobzilla_resume_alerts_page',
                        'type' 		=> 'select',
                        'options'	=> $this->page_list,
                        'placeholder' 	=> esc_html__('Choose Resume Alerts Page', 'jobzilla'),
						'title' 	=> esc_html__('Resume Alerts Page', 'jobzilla') ,
                        'subtitle' 	=> esc_html__('It will show resume alerts page on user panel.', 'jobzilla') ,
                    ),
					 array(
                        'id' 		=> 'jobzilla_change_password_page',
                        'type' 		=> 'select',
                        'options'	=> $this->page_list,
                        'placeholder' 	=> esc_html__('Choose Change Password Page', 'jobzilla'),
						'title' 	=> esc_html__('Change Password', 'jobzilla') ,
                        'subtitle' 	=> esc_html__('It will show change password page on user panel.', 'jobzilla') ,
                    ),
					array(
                        'id' 		=> 'jobzilla_login_page',
                        'type' 		=> 'select',
                        'options'	=> $this->page_list,
                        'placeholder' 	=> esc_html__('Choose Login Page', 'jobzilla'),
						'title' 	=> esc_html__('Login', 'jobzilla') ,
                        'subtitle' 	=> esc_html__('It will show login page on user panel.', 'jobzilla') ,
                    ),
					array(
                        'id' 		=> 'jobzilla_register_page',
                        'type' 		=> 'select',
                        'options'	=> $this->page_list,
                        'placeholder' 	=> esc_html__('Choose Register Page', 'jobzilla'),
						'title' 	=> esc_html__('Register', 'jobzilla') ,
                        'subtitle' 	=> esc_html__('It will show register page on user panel.', 'jobzilla') ,
                    ),
					array(
                        'id' 		=> 'jobzilla_forgot_password_page',
                        'type' 		=> 'select',
                        'options'	=> $this->page_list,
                        'placeholder' 	=> esc_html__('Choose Forgot Password Page', 'jobzilla'),
						'title' 	=> esc_html__('Forgot Password', 'jobzilla') ,
                        'subtitle' 	=> esc_html__('It will show forgot password page on user panel.', 'jobzilla') ,
                    ),
					 array(
                        'id' 		=> 'jobzilla_job_filter_page',
                        'type' 		=> 'select',
                        'options'	=> $this->page_list,
                        'placeholder' 	=> esc_html__('Choose Job Filter Page', 'jobzilla'),
						'title' 	=> esc_html__('Job Filter', 'jobzilla') ,
                        'subtitle' 	=> esc_html__('It will show job filter page on user panel.', 'jobzilla') ,
                    ),
					 array(
                        'id' 		=> 'jobzilla_job_filter_map_page',
                        'type' 		=> 'select',
                        'options'	=> $this->page_list,
                        'placeholder' 	=> esc_html__('Choose Job Filter Map Page', 'jobzilla'),
						'title' 	=> esc_html__('Job Filter Map', 'jobzilla') ,
                        'subtitle' 	=> esc_html__('It will show job filter map page on user panel.', 'jobzilla') ,
                    ),
					 array(
                        'id' 		=> 'jobzilla_job_terms_conditions_page',
                        'type' 		=> 'select',
                        'options'	=> $this->page_list,
                        'placeholder' 	=> esc_html__('Choose Terms and conditions', 'jobzilla'),
						'title' 	=> esc_html__('Terms and conditions', 'jobzilla') ,
                        'subtitle' 	=> esc_html__('It will show Terms and conditions page on user panel.', 'jobzilla') ,
                    ),
					
                )
            );
			$this->sections[] = array(
                'title' 	=> esc_html__('User Role Settings', 'jobzilla') ,
                'icon' 		=> 'el el-cog',
				'subsection'=> true,
                'fields' 	=> array(
					array(
                        'id' 			=> 'jobzilla_employer_pages',
                        'type' 			=> 'select',
                        'options'	=> $this->page_list,
						'multi'  	=> true,
                        'placeholder' 	=> esc_html__('Choose  Employer Pages', 'jobzilla'),
						'title' 		=> esc_html__('Select Employer Pages', 'jobzilla') ,
                        'subtitle' 		=> esc_html__('It will show employer pages on user panel.', 'jobzilla') ,
                    ),
					array(
                        'id' 			=> 'jobzilla_candidate_pages',
                        'type' 			=> 'select',
                        'options'	=> $this->page_list,
						'multi'  	=> true,
                        'placeholder' 	=> esc_html__('Choose  Candidate Pages', 'jobzilla'),
						'title' 		=> esc_html__('Select Candidate Pages', 'jobzilla') ,
                        'subtitle' 		=> esc_html__('It will show candidate pages on user panel.', 'jobzilla') ,
                    ),
					
				)
			);
			/*--------------------------------------------------------------
            # 6. Map Settings
            --------------------------------------------------------------*/
            $this->sections[] = array(
                'title' => esc_html__('Map Settings', 'jobzilla') ,
                'icon' 	=> 'el el-map-marker',
                'fields'=> array(
                    array(
                        'id' 		=> 'map_type',
                        'type' 		=> 'button_set',
                        'title' 	=> esc_html__('Map Type', 'jobzilla') ,
                        'desc' 		=> esc_html__('You have two option Open Street Map and Bing Map.', 'jobzilla').'<br>
						
											'.esc_html__('Bing Map: It is required Map API key. Go to bing map portal and generate API key.', 'jobzilla').' <a href="https://www.bingmapsportal.com/" target="_blank">bingmapsportal</a> '.esc_html__('Bing map is microsoft based you can read microsoft bing map documentation', 'jobzilla').' <a href="https://learn.microsoft.com/en-us/bingmaps/getting-started/?redirectedfrom=MSDN">'.esc_html__('Click Here', 'jobzilla').'</a> <br>
						
											'.esc_html__('OpenstreetMap: In this is map you no need API Key.', 'jobzilla').' <a href="https://www.openstreetmap.org/">OpenStreetMap</a><br>
												
											'.esc_html__('Google Map: Click here to generate google map api key. Google Map key field available in general settings.', 'jobzilla').' <a href="https://developers.google.com/maps/documentation/javascript/get-api-key">Google Map</a>',
                        'options' 	=> array(
							'openstreetmap'	=> esc_html__('Open Street Map', 'jobzilla') ,
                            'googlemap'	=> esc_html__('Google Map', 'jobzilla') ,
                            'bingmap' 	=> esc_html__('Bing Map', 'jobzilla') ,
                        ) ,
                        'default' 	=> 'openstreetmap',
                    ),
					
					array(
						'id' 		=> 'map_center_lat',
						'type' 		=> 'text',
						'title' 	=> esc_html__('Center Location Latitude', 'jobzilla') ,
						'desc' 		=> esc_html__('Please enter center location latitude of map.', 'jobzilla'),
						'default'	=> '42.4275101924038'
					),
					array(
						'id' 		=> 'map_center_lon',
						'type' 		=> 'text',
						'title' 	=> esc_html__('Center Location Longitude', 'jobzilla') ,
						'desc' 		=> esc_html__('Please enter center location latitude of map.', 'jobzilla') ,
						'default'	=> '12.102446455928826'
					),
					
					array(
						'id' 		=> 'bing_mapkey',
						'type' 		=> 'text',
						'title' 	=> esc_html__('Bing Map Key', 'jobzilla') ,
						'desc' 		=> esc_html__('Generate bing map API Key', 'jobzilla'). '<a href="https://www.bingmapsportal.com/" target="_blank">click here</a>' ,
						'required' 	=> array(0 => 'map_type',1 => 'equals',2 => 'bingmap')
					),
					array(
						'id' 		=> 'map_loc_icon',
						'type' 		=> 'media',
						 'url' => true,
						'title' 	=> esc_html__('Map Icon', 'jobzilla') ,
						'required' 	=> array(0 => 'map_type',1 => 'equals',2 => 'bingmap')
									
					),	
					array(
						'id' 		=> 'loc_icon_color',
						'type' 		=> 'color',
						'title' 	=> esc_html__('Map Icon Color', 'jobzilla') ,
						'required' 	=> array(0 => 'map_type',1 => 'equals',2 => 'bingmap')
									
					),	
					array(
						'id' 		=> 'bing_maptypeid',
						'type' 		=> 'select',
						'title' 	=> esc_html__('Map Type ID', 'jobzilla') ,
						'options'   =>  array(
							'road'=>  esc_html__('Road (Default)', 'jobzilla'),
							'aerial'=>  esc_html__('Aerial', 'jobzilla'),
							'canvasDark'	=>  esc_html__('CanvasDark', 'jobzilla'),
							'canvasLight'	=>  esc_html__('CanvasLight', 'jobzilla'),
						),
						'default' 	=> 'road',
						'required' 	=> array(0 => 'map_type',1 => 'equals',2 => 'bingmap')
					),
					
					array(
						'id' 		=> 'bing_map_style',
						'type' 		=> 'image_select',
						'title' 	=> esc_html__('Map Style (Optional)', 'jobzilla') ,
						'desc' 		=> esc_html__('You can choose map style.', 'jobzilla'),
						'options' 	=> $this->job_map_options,
						'default'	=> 'default',
						'required' 	=> array(0 => 'map_type',1 => 'equals',2 => 'bingmap')
									
					),
								
					array(
						'id' 		=> 'bing_map_customstyle',
						'type' 		=> 'ace_editor',
						'title' 	=> esc_html__('Custom Style', 'jobzilla') ,
						'desc' 		=> esc_html__('You can drop here map style json format', 'jobzilla').' <a href="https://learn.microsoft.com/en-us/bingmaps/articles/custom-map-styles-in-bing-maps">Click here to show</a>' ,
						'mode' 		=> 'json',
						'theme' 	=> 'chrome',
						'required' 	=> array(0 => 'bing_map_style',1 => 'equals',2 => 'custom')
					),
				)
            );
            /*--------------------------------------------------------------
            # 5. Post Setting
            --------------------------------------------------------------*/
            $this->sections[] = array(
                'title' => esc_html__('Post Settings', 'jobzilla') ,
                'icon'	=> 'fa fa-newspaper-o'
            );

            $this->sections[] = array(
                'title' 	=> esc_html__('General Settings', 'jobzilla') ,
                'desc' 		=> esc_html__('This option will work on all new post and edit post sections. On new post page we will display only Post Layout Selection , all other settings will be applicable from here.', 'jobzilla') ,
                'subsection'=> true,
                'icon' 		=> 'fa fa-gear',
                'fields' 	=> array(
                    array(
                        'id' 		=> 'post_general_layout',
                        'type' 		=> 'image_select',
                        'height' 	=> '100',
                        'title' 	=> esc_html__('Single Post Layout', 'jobzilla') ,
                        'subtitle' 	=> esc_html__('Select a layout for post page.', 'jobzilla') ,
                        'desc' 		=> esc_html__('Click on the template icon to select.', 'jobzilla') ,
                        'options' 	=> $this->post_layouts_options,
                        'default' 	=> 'standard',
                        'hint' 		=> array(
                            'title' 	=> esc_html__('How it Works?', 'jobzilla') ,
                            'content' 	=> esc_html__('Once you select the template from here the template will apply for default post page.', 'jobzilla')
                        )
                    ) ,                    
                    array(
                        'id' 		=> 'date_on',
                        'type' 		=> 'switch',
                        'title' 	=> esc_html__('Date', 'jobzilla') ,
                        'on' 		=> esc_html__('Enabled', 'jobzilla') ,
                        'off' 		=> esc_html__('Disabled', 'jobzilla') ,
                        'default' 	=> true
                    ) ,
                    array(
                        'id' 		=> 'comment_count_on',
                        'type' 		=> 'switch',
                        'title' 	=> esc_html__('Comment Count', 'jobzilla') ,
                        'on' 		=> esc_html__('Enabled', 'jobzilla') ,
                        'off' 		=> esc_html__('Disabled', 'jobzilla') ,
                        'default' 	=> true
                    ) ,
                    array(
                        'id' 		=> 'comment_view_on',
                        'type' 		=> 'switch',
                        'title' 	=> esc_html__('Comment View', 'jobzilla') ,
                        'on' 		=> esc_html__('Enabled', 'jobzilla') ,
                        'off' 		=> esc_html__('Disabled', 'jobzilla') ,
                        'default' 	=> true
                    ) ,					
					array(
			            'id'       => 'post_view_on',
			            'type'     => 'switch',
			            'title'    => esc_html__('Post View', 'jobzilla'),
			            'on'       => esc_html__('Enabled', 'jobzilla'),
			            'off'      => esc_html__('Disabled', 'jobzilla'),
			            'default'  => false
			        ), 
                    array(
                        'id' 		=> 'post_start_view',
                        'type' 		=> 'text',
                        'title' 	=> esc_html__('Post Start View', 'jobzilla') ,
                        'default' 	=> '',
                        'desc' 		=> esc_html__('Enter only number.', 'jobzilla') ,
                        'hint' 		=> array(
                            'title' 	=> esc_html__('Post Views', 'jobzilla') ,
                            'content' 	=> esc_html__('We will display view count by adding this number in original post views. It will help to build post reputation on blog.', 'jobzilla')
                        )
                    ) ,
                    array(
                        'id' 		=> 'author_box_on',
                        'type' 		=> 'switch',
                        'title' 	=> esc_html__('Author Box', 'jobzilla') ,
                        'on' 		=> esc_html__('Enabled', 'jobzilla') ,
                        'off' 		=> esc_html__('Disabled', 'jobzilla') ,
                        'default' 	=> false
                    ) ,
                    array(
                        'id' 		=> 'category_on',
                        'type' 		=> 'switch',
                        'title' 	=> esc_html__('Category', 'jobzilla') ,
                        'on' 		=> esc_html__('Enabled', 'jobzilla') ,
                        'off' 		=> esc_html__('Disabled', 'jobzilla') ,
                        'default' 	=> true
                    ) ,

                    array(
                        'id' 		=> 'pre_next_post_on',
                        'type' 		=> 'switch',
                        'title' 	=> esc_html__('Previous & Next Post', 'jobzilla') ,
                        'on' 		=> esc_html__('Enabled', 'jobzilla') ,
                        'off' 		=> esc_html__('Disabled', 'jobzilla') ,
                        'default' 	=> true
                    ) ,
                    array(
                        'id' 		=> 'featured_img_on',
                        'type' 		=> 'switch',
                        'title' 	=> esc_html__('Featured Image', 'jobzilla') ,
                        'on' 		=> esc_html__('Enabled', 'jobzilla') ,
                        'off' 		=> esc_html__('Disabled', 'jobzilla') ,
                        'default' 	=> true
                    ) ,
                    
                    array(
                        'id' 		=> 'related_post_on',
                        'type' 		=> 'switch',
                        'title' 	=> esc_html__('Related Post', 'jobzilla') ,
                        'on' 		=> esc_html__('Enabled', 'jobzilla') ,
                        'off' 		=> esc_html__('Disabled', 'jobzilla') ,
                        'default' 	=> false
                    ) ,
					
                    array(
                        'id' 		=> 'show_image_on_post_list',
                        'type' 		=> 'switch',
                        'title' 	=> esc_html__('Show Image On Post List', 'jobzilla') ,
                        'subtitle' 	=> esc_html__('Show feature image on post listing in admin panel.', 'jobzilla') ,
                        'on' 		=> esc_html__('Enabled', 'jobzilla') ,
                        'off' 		=> esc_html__('Disabled', 'jobzilla') ,
                        'default' 	=> false
                    ) ,
                    array(
                        'id' 		=> 'post_general_banner_on',
                        'type' 		=> 'switch',
                        'title' 	=> esc_html__('Post Banner', 'jobzilla') ,
                        'on' 		=> esc_html__('Enabled', 'jobzilla') ,
                        'off' 		=> esc_html__('Disabled', 'jobzilla') ,
                        'default' 	=> false
                    ) ,					
					array(
                        'id' 		=> 'post_general_banner_type',
                        'type' 		=> 'button_set',
                        'title' 	=> esc_html__('Post Banner Type', 'jobzilla') ,
                        'options' 	=> $this->banner_type,
                        'default' 	=> 'image',
                        'required' 	=> array(0 => 'post_general_banner_on', 1 => 'equals', 2 => '1')
                    ),	
                    array(
                        'id' 		=> 'post-general-img-banner-section-start',
                        'type' 		=> 'section',
                        'title' 	=> esc_html__('Banner Setting', 'jobzilla') ,
                        'indent' 	=> true,
						'required' 	=> array(0 => 'post_general_banner_on', 1 => 'equals', 2 => 1)

                    ) ,
					array(
						'id' => 'post_general_banner_style',
						'type' => 'image_select',
						'title' => esc_html__('Post Banner Layout', 'jobzilla') ,
						'options' 	=> $this->banner_style,
						'default' => 'style1' ,
						'required' => array(
							0 => 'post_general_banner_on',
							1 => 'equals',
							2 => 1
						)
					) ,		
                    array(
                        'id' 		=> 'post_general_banner_height',
                        'type' 		=> 'image_select',
                        'title' 	=> esc_html__('Post Banner Height', 'jobzilla') ,
                        'subtitle' 	=> esc_html__('Choose the height for all tag page banner. Default : Small Banner', 'jobzilla') ,
                        'height' 	=> '40',
                        'options' 	=> $this->page_banner_options,
                        'default' 	=> 'page_banner_small',
                    ) ,
					array(
                        'id' 			=>  'post_general_banner_custom_height',
                        'type' 			=> 'slider',
                        'title' 		=> esc_html__('Page Banner Custom Height', 'jobzilla') ,
                        'desc' 			=> esc_html__('Hight description. Min: 100, max: 800', 'jobzilla') ,
                        'default' 		=> '',
                        'min' 			=> 100,
                        'max' 			=> 800,
                        'display_value' => 'text',
                        'required' 		=> array(0 => 'post_general_banner_height', 1 => 'equals', 2 => 'page_banner_custom'
                        )
                    ) ,
                    array(
                        'id' 		=> 'post_general_banner',
                        'type' 		=> 'media',
                        'url' 		=> true,
                        'title' 	=> esc_html__('Post Banner Image', 'jobzilla') ,
                        'subtitle' 	=> esc_html__('Enter page banner image. It will work as default banner image for all pages', 'jobzilla') ,
                        'desc' 		=> esc_html__('Upload banner image.', 'jobzilla') ,
                        'default' 	=> '',
                    ) ,
                    array(
                        'id' 		=> 'post-general-img-banner-section-end',
                        'type' 		=> 'section',
                        'indent' 	=> false,
						'required' 	=> array(0 => 'post_general_banner_on', 1 => 'equals', 2 => 1)
                    ),
					
                    array(
                        'id' 		=> 'post_bg_image_custom',
                        'type' 		=> 'media',
                        'url' 		=> true,
                        'title' 	=> esc_html__('Custom Post Background Image', 'jobzilla') ,
                        'subtitle' 	=> esc_html__('Choose custom background image for post single page.', 'jobzilla') ,
                        'desc' 		=> esc_html__('Upload background image.', 'jobzilla') ,
                        'default' 	=> array('url' => '') ,
                        'required' 	=> array(0 => 'post_background_type', 1 => 'equals', 2 => 'custom')
                    ) ,
                )
            );

            /*--------------------------------------------------------------
            # 6. Page Setting
            --------------------------------------------------------------*/

            $this->sections[] = array(
                'title' => esc_html__('Page Settings', 'jobzilla') ,
                'icon' 	=> 'fa fa-file'
            );

            $this->sections[] = array(
                'title' 	=> esc_html__('General Settings', 'jobzilla') ,
                'icon' 		=> 'fa fa-gear',
                'desc' 		=> '',
                'subsection'=> true,
                'fields'	=> array(
                    array(
                        'id' 		=> 'page_general_banner_on',
                        'type' 		=> 'switch',
                        'title' 	=> esc_html__('Page Banner', 'jobzilla') ,
                        'on' 		=> esc_html__('Enabled', 'jobzilla') ,
                        'off' 		=> esc_html__('Disabled', 'jobzilla') ,
                        'default' 	=> true
                    ) ,
                    array(
                        'id' 		=> 'page_general_banner_type',
                        'type' 		=> 'button_set',
                        'title' 	=> esc_html__('Page Banner Type', 'jobzilla') ,
                        'options' 	=> $this->banner_type,
                        'default' 	=> 'image',
                        'required' 	=> array(0 => 'page_general_banner_on', 1 => 'equals', 2 => '1')
                    ),
                    array(
                        'id' 		=> 'general-img-banner-section-start',
                        'type' 		=> 'section',
                        'title' 	=> esc_html__('Image Banner Setting', 'jobzilla') ,
                        'indent' 	=> true,
                        'required' 	=> array(0 => 'page_general_banner_type', 1 => 'equals', 2 => 'image')
                    ) ,
					array(
						'id' => 'page_general_banner_style',
						'type' => 'image_select',
						'title' => esc_html__('Page Banner Layout', 'jobzilla') ,
						 'options' 	=> $this->banner_style,
						'default' => 'style1' ,
						'required' => array(
							0 => 'page_general_banner_type',
							1 => 'equals',
							2 => 'image'
						)
					) ,
                    array(
                        'id' 		=> 'page_general_banner_height',
                        'type' 		=> 'image_select',
                        'title' 	=> esc_html__('Page Banner Height', 'jobzilla') ,
                        'subtitle' 	=> esc_html__('Choose the height for all tag page banner. Default : Medium Banner', 'jobzilla') ,
                        'height' 	=> '40',
                        'options' 	=> $this->page_banner_options,
                        'default' 	=> 'page_banner_small',
                        'required' 	=> array(0 => 'page_general_banner_type', 1 => 'equals', 2 => 'image')
                    ) ,
					array(
                        'id' 			=>  'page_general_banner_custom_height',
                        'type' 			=> 'slider',
                        'title' 		=> esc_html__('Page Banner Custom Height', 'jobzilla') ,
                        'desc' 			=> esc_html__('Hight description. Min: 100, max: 800', 'jobzilla') ,
                        'default' 		=> '',
                        'min' 			=> 100,
                        'max' 			=> 800,
                        'display_value' => 'text',
                        'required' 		=> array(0 => 'page_general_banner_height', 1 => 'equals', 2 => 'page_banner_custom'
                        )
                    ) ,
                    array(
                        'id' 		=> 'page_general_banner',
                        'type' 		=> 'media',
                        'url' 		=> true,
                        'title' 	=> esc_html__('Page Banner Image', 'jobzilla') ,
                        'subtitle' 	=> esc_html__('Enter page banner image. It will work as default banner image for all pages', 'jobzilla') ,
                        'desc' 		=> esc_html__('Upload banner image.', 'jobzilla') ,
						'default' 	=> array(
                            'url' 	=> get_template_directory_uri() . '/assets/images/bnr1.jpg'
                        ) ,
                        'required' 	=> array(0 => 'page_general_banner_type', 1 => 'equals', 2 => 'image')
                    ) ,
                    array(
                        'id' 		=> 'general-img-banner-section-end',
                        'type' 		=> 'section',
                        'indent' 	=> false,
                    ) ,
                    array(
                        'id' 		=> 'general-post-banner-section-start',
                        'type' 		=> 'section',
                        'title' 	=> esc_html__('Post Banner Setting', 'jobzilla') ,
                        'indent' 	=> true,
                        'required' 	=> array(0 => 'page_general_banner_type', 1 => 'equals', 2 => 'post')
                    ) ,
                    array(
                        'id' 		=> 'page_general_no_of_post',
                        'type' 		=> 'text',
                        'title' 	=> esc_html__('Number of Posts', 'jobzilla') ,
                        'subtitle' 	=> esc_html__('Enter number of post. Default : 3', 'jobzilla') ,
                        'default' 	=> '3',
                        'required' 	=> array(0 => 'page_general_banner_type', 1 => 'equals', 2 => 'post')
                    ) ,
                    array(
                        'id' 		=> 'general_post_banner_layout',
                        'type' 		=> 'image_select',
                        'title' 	=> esc_html__('Post Banner Layout', 'jobzilla') ,
                        'subtitle' 	=> esc_html__('Select banner layout. Default : Full Banner', 'jobzilla') ,
                        'options' 	=> $this->post_banner_options,
                        'default' 	=> 'post_banner_v1',
                        'required' 	=> array(0 => 'page_general_banner_type', 1 => 'equals', 2 => 'post')
                    ) ,
                    array(
                        'id' 		=> 'page_general_banner_cat',
                        'type' 		=> 'select',
                        'multi' 	=> true,
                        'data' 		=> 'terms',
                        'args' 		=> array('taxonomies' => 'category') ,
                        'title' 	=> esc_html__('Post Category', 'jobzilla') ,
                        'subtitle' 	=> esc_html__('Select post category. It will work as default banner for all pages', 'jobzilla') ,
                        'desc' 		=> esc_html__('Allow you to select multiple categories.', 'jobzilla') ,
                        'default' 	=> '',
                        'required' 	=> array(0 => 'page_general_banner_type', 1 => 'equals', 2 => 'post')
                    ) ,
                    array(
                        'id' 		=> 'page_general_post_type',
                        'type' 		=> 'button_set',
                        'title' 	=> esc_html__('Post Type', 'jobzilla') ,
                        'options' 	=> array(
                            'all' 	=> esc_html__('All', 'jobzilla') ,
                            'featured'=> esc_html__('Featured', 'jobzilla')
                        ) ,
                        'default' 	=> 'all',
                        'force_output'=> true,
                        'required' 	=> array(0 => 'page_general_banner_type', 1 => 'equals', 2 => 'post')
                    ) ,
                    array(
                        'id' 		=> 'page_general_items_with',
                        'type' 		=> 'button_set',
                        'title' 	=> esc_html__('Items With', 'jobzilla') ,
                        'options' 	=> array(
                            'with_any_type' 		=> esc_html__('Any Type', 'jobzilla') ,
                            'with_featured_image' 	=> esc_html__('With Featured Image', 'jobzilla') ,
                            'without_featured_image'=> esc_html__('Without Featured Iimage', 'jobzilla')
                        ) ,
                        'default' 	=> 'with_any_type',
                        'required' 	=> array(0 => 'page_general_banner_type', 1 => 'equals', 2 => 'post')
                    ) ,
                    array(
                        'id' 		=> 'general-post-banner-section-end',
                        'type' 		=> 'section',
                        'indent' 	=> false,
                    ) ,
                    array(
                        'id' 		=> 'general-sidebar-section-start',
                        'type' 		=> 'section',
                        'title' 	=> esc_html__('Sidebar Setting', 'jobzilla') ,
                        'indent' 	=> true
                    ) ,
                    array(
                        'id' 		=> 'page_general_show_sidebar',
                        'type' 		=> 'switch',
                        'title' 	=> esc_html__('Sidebar', 'jobzilla') ,
                        'on' 		=> esc_html__('Enabled', 'jobzilla') ,
                        'off' 		=> esc_html__('Disabled', 'jobzilla') ,
                        'default' 	=> true
                    ) ,
                    array(
                        'id' 		=> 'page_general_sidebar_layout',
                        'type' 		=> 'image_select',
                        'title' 	=> esc_html__('Sidebar Layout', 'jobzilla') ,
                        'subtitle' 	=> esc_html__('Choose the layout for page. (Default : Right Side).', 'jobzilla') ,
                        'options' 	=> $this->sidebar_layout_options,
                        'default' 	=> 'right',
                        'required' 	=> array(0 => 'page_general_show_sidebar', 1 => 'equals', 2 => '1')
                    ) ,
                    array(
                        'id' 		=> 'page_general_sidebar',
                        'type' 		=> 'select',
                        'data' 		=> 'sidebars',
                        'title' 	=> esc_html__('Sidebar', 'jobzilla') ,
                        'subtitle' 	=> esc_html__('Select sidebar for all pages', 'jobzilla') ,
                        'default' 	=> 'dz_blog_sidebar',
                        'required' 	=> array(0 => 'page_general_sidebar_layout', 1 => 'equals', 2 => array('right', 'left')
                        )
                    ) ,
                    array(
                        'id' 		=> 'general-sidebar-section-end',
                        'type' 		=> 'section',
                        'indent' 	=> false,
                    ) ,
                    array(
                        'id' 		=> 'page_general_paging',
                        'type' 		=> 'button_set',
                        'title' 	=> esc_html__('Pagination', 'jobzilla') ,
                        'options' 	=> array(
                            'default' 	=> esc_html__('Default', 'jobzilla') ,
                            'load_more' => esc_html__('Load More', 'jobzilla') ,
                            
                        ) ,
                        'default' 		=> 'default',
                        'force_output' 	=> true
                    ) ,
                )
            );

            $default_pages_data = array(
                'page_author' 	=> array(
                    'top_desc' 	=> esc_html__('The author template is shown when a user clicks on the author in the front end of the site.', 'jobzilla'),
                    'id' 		=> 'author',
                    'title' 	=> esc_html__('Author','jobzilla'),
                    'icon' 		=> 'fa fa-user'
                ) ,
                'page_category' => array(
                    'top_desc' 	=> esc_html__('The category template is shown when a user clicks on the category in the front end of the site.', 'jobzilla'),
                    'id' 		=> 'category',
                    'title' 	=> esc_html__('Category','jobzilla'),
                    'icon' 		=> 'fa fa-list-alt'
                ) ,
                'page_search' 	=> array(
                    'top_desc' 	=> esc_html__('Set the default layout for all the search page.', 'jobzilla'),
                    'id' 		=> 'search',
                    'title' 	=> esc_html__('Search','jobzilla'),
                    'icon' 		=> 'fa fa-search'
                ) ,
                'page_archive' 	=> array(
					'top_desc' 	=> esc_html__('This template is used by WordPress to generate the archives. By default WordPress generates daily, monthly and yearly archives.', 'jobzilla'),
                    'id' 		=> 'archive',
                    'title' 	=> esc_html__('Archive','jobzilla'),
                    'icon' 		=> 'fa fa-archive'
                ) ,
                'page_tag' 		=> array(
                    'top_desc' 	=> esc_html__('Set the default layout for all the tag page.', 'jobzilla'),
                    'id' 		=> 'tag',
                    'title' 	=> esc_html__('Tag','jobzilla'),
                    'icon' 		=> 'fa fa-tags'
                ) ,

            );
			
            foreach ($default_pages_data as $key => $page_data)
            {

                $pg_desc = $page_data['top_desc'];
                $pg_id = $page_data['id'];
                $pg_name = $page_data['title'];
                $pg_icon = $page_data['icon'];
                $pg_sidebar = !empty($page_data['sidebar']) ? $page_data['sidebar'] : 'dz_blog_sidebar';

                if ($key == 'page_cmsoon')
                {
                    $page_templates = $this->coming_template_options;
                }
                elseif ($key == 'page_maintenance')
                {
                    $page_templates = $this->maintenance_template_options;
                }
                else
                {
                    $page_templates = $this->page_template_options;
                }

                $page_default_settings = $page_sorting = $page_pagination = array();

                $page_default_settings = array(
                    array(
                        'id' 			=> $pg_id . '_page_title',
                        'type' 			=> 'text',
                        'title' 		=> esc_html__('Page Title', 'jobzilla') ,
                        'default' 		=> $pg_name .' : ',
                        'force_output'	=> true
                    ) ,
                    array(
                        'id' 			=> $pg_id . '_page_banner_on',
                        'type' 			=> 'switch',
                        'title' 		=> esc_html__('Page Banner', 'jobzilla') ,
                        'on' 			=> esc_html__('Enabled', 'jobzilla') ,
                        'off' 			=> esc_html__('Disabled', 'jobzilla') ,
                        'default' 		=> true
                    ) ,

                    array(
                        'id' 			=> $pg_id . '_page_banner_type',
                        'type' 			=> 'button_set',
                        'title' 		=> esc_html__('Page Banner Type', 'jobzilla') ,
                        'options' 		=> $this->banner_type,
                        'default' 		=> 'image',
                        'required' 		=> array(0 => $pg_id . '_page_banner_on', 1 => 'equals', 2 => '1')
                    ) ,
                    array(
                        'id' 			=> $pg_id . '-img-banner-section-start',
                        'type' 			=> 'section',
                        'title' 		=> esc_html__('Image Banner Setting', 'jobzilla') ,
                        'indent' 		=> true,
                        'required' 		=> array(0 => $pg_id . '_page_banner_type', 1 => 'equals', 2 => 'image')
                    ) ,
					array(
						'id' => $pg_id .'_page_banner_style',
						'type' => 'image_select',
						'title' => esc_html__('Page Banner Layout', 'jobzilla') ,
						'options' 	=> $this->banner_style,
						'default' => 'style1' ,
						'required' => array(
							0 => $pg_id . '_page_banner_type',
							1 => 'equals',
							2 => 'image'
						)
					) ,
                    array(
                        'id' 			=> $pg_id . '_page_banner_height',
                        'type' 			=> 'image_select',
                        'title' 		=> esc_html__('Page Banner Height', 'jobzilla') ,
                        'subtitle' 		=> esc_html__('Choose the height for page banner. Default : Medium Banner', 'jobzilla') ,
                        'height' 		=> '40',
                        'options' 		=> $this->page_banner_options,
                        'default' 		=> 'page_banner_small',
                        'required' 		=> array(0 => $pg_id . '_page_banner_type', 1 => 'equals', 2 => 'image')
                    ) ,
					
                    array(
                        'id' 			=> $pg_id . '_page_banner_custom_height',
                        'type' 			=> 'slider',
                        'title' 		=> esc_html__('Page Banner Custom Height', 'jobzilla') ,
                        'desc' 			=> esc_html__('Hight description. Min: 100, max: 800', 'jobzilla') ,
                        'default' 		=> '',
                        'min' 			=> 100,
                        'max' 			=> 800,
                        'display_value' => 'text',
                        'required' 		=> array(0 => $pg_id . '_page_banner_height', 1 => 'equals', 2 => 'page_banner_custom'
                        )
                    ) ,
                    array(
                        'id' 			=> $pg_id . '_page_banner',
                        'type' 			=> 'media',
                        'url' 			=> true,
                        'title' 		=> esc_html__('Page Banner Image', 'jobzilla') ,
                        'subtitle' 		=> esc_html__('Enter page banner image. It will work as default banner image for the page.', 'jobzilla') ,
                        'desc' 			=> esc_html__('Upload banner image.', 'jobzilla') ,
                        'default' 		=> array(
                            'url' 		=> get_template_directory_uri() . '/assets/images/bnr1.jpg'
                        ) ,
                        'required' 		=> array(0 => $pg_id . '_page_banner_type', 1 => 'equals', 2 => 'image')
                    ) ,
                    array(
                        'id' 			=> $pg_id . '_page_banner_hide',
                        'type' 			=> 'checkbox',
                        'title' 		=> esc_html__('Don`t use banner image for this page', 'jobzilla') ,
                        'default' 		=> '0',
                        'desc' 			=> esc_html__('Check if you don`t want to use banner image', 'jobzilla') ,
                        'required' 		=> array(0 => $pg_id . '_page_banner_type', 1 => 'equals', 2 => 'image') ,
                        'hint' 			=> array(
                            'content' 	=> esc_html__('If we don`t have suitable image then we can hide current or default banner images and show only banner container with theme default color.', 'jobzilla')
                        )
                    ) ,
                    array(
                        'id' 			=> $pg_id . '-img-banner-section-end',
                        'type' 			=> 'section',
                        'indent' 		=> false,
                    ) ,
                    array(
                        'id' 			=> $pg_id . '-post-banner-section-start',
                        'type' 			=> 'section',
                        'title' 		=> esc_html__('Post Banner Setting', 'jobzilla') ,
                        'indent' 		=> true,
                        'required' 		=> array(0 => $pg_id . '_page_banner_type', 1 => 'equals', 2 => 'post')
                    ) ,
                    array(
                        'id' 			=> $pg_id . '_page_no_of_post',
                        'type' 			=> 'text',
                        'title' 		=> esc_html__('Number of Posts', 'jobzilla') ,
                        'subtitle' 		=> esc_html__('Enter number of post. Default : 3', 'jobzilla') ,
                        'default' 		=> '3',
                        'required' 		=> array(0 => $pg_id . '_page_banner_type', 1 => 'equals', 2 => 'post')
                    ) ,
                    
                    array(
                        'id' 			=> $pg_id . '_page_banner_cat',
                        'type' 			=> 'select',
                        'multi' 		=> true,
                        'data' 			=> 'terms',
                        'args' 			=> array('taxonomies' => 'category') ,
                        'title' 		=> esc_html__('Post Category', 'jobzilla') ,
                        'subtitle' 		=> esc_html__('Select post category. It will work as default banner for the page.', 'jobzilla') ,
                        'desc' 			=> esc_html__('Allow you to select multiple categories.', 'jobzilla') ,
                        'default' 		=> '',
                        'required' 		=> array(0 => $pg_id . '_page_banner_type', 1 => 'equals', 2 => 'post')
                    ) ,
                    array(
                        'id' 			=> $pg_id . '_page_post_type',
                        'type' 			=> 'button_set',
                        'title' 		=> esc_html__('Post Type', 'jobzilla') ,
                        'options' 		=> array(
                            'all' 		=> esc_html__('All', 'jobzilla') ,
                            'featured' 	=> esc_html__('Featured', 'jobzilla')
                        ) ,
                        'default' 		=> 'all',
                        'force_output' 	=> true,
                        'required' 		=> array(0 => $pg_id . '_page_banner_type', 1 => 'equals', 2 => 'post')
                    ) ,
                    array(
                        'id' 			=> $pg_id . '_page_items_with',
                        'type' 			=> 'button_set',
                        'title' 		=> esc_html__('Items With', 'jobzilla') ,
                        'options' 		=> array(
                            'with_any_type' 		=> esc_html__('Any Type', 'jobzilla') ,
                            'with_featured_image' 	=> esc_html__('With Featured Image', 'jobzilla') ,
                            'without_featured_image'=> esc_html__('Without Featured Iimage', 'jobzilla')
                        ) ,
                        'default' 		=> 'with_any_type',
                        'required' 		=> array(0 => $pg_id . '_page_banner_type', 1 => 'equals', 2 => 'post')
                    ) ,
                    array(
                        'id' 			=> $pg_id . '-post-banner-section-end',
                        'type' 			=> 'section',
                        'indent' 		=> false,
                    ) ,
                );

                $page_sorting = array(
                    array(
                        'id' 			=> $pg_id . '-sidebar-section-start',
                        'type' 			=> 'section',
                        'title' 		=> esc_html__('Sidebar Setting', 'jobzilla') ,
                        'indent' 		=> true
                    ) ,
                    array(
                        'id' 			=> $pg_id . '_page_show_sidebar',
                        'type' 			=> 'switch',
                        'title' 		=> esc_html__('Sidebar', 'jobzilla') ,
                        'on' 			=> esc_html__('Enabled', 'jobzilla') ,
                        'off' 			=> esc_html__('Disabled', 'jobzilla') ,
                        'default' 		=> true
                    ) ,
                    array(
                        'id' 			=> $pg_id . '_page_sidebar_layout',
                        'type' 			=> 'image_select',
                        'title' 		=> esc_html__('Sidebar Layout', 'jobzilla') ,
                        'subtitle' 		=> esc_html__('Choose the layout for the page. (Default : Right Side).', 'jobzilla') ,
                        'options' 		=> $this->sidebar_layout_options,
                        'default' 		=> 'right',
                        'required' 		=> array(0 => $pg_id . '_page_show_sidebar', 1 => 'equals', 2 => '1')
                    ) ,
                    array(
                        'id' 			=> $pg_id . '_page_sidebar',
                        'type' 			=> 'select',
                        'data' 			=> 'sidebars',
                        'title' 		=> esc_html__('Sidebar', 'jobzilla') ,
                        'subtitle' 		=> esc_html__('Select sidebar for the page.', 'jobzilla') ,
                        'default' 		=> $pg_sidebar,
                        'required' 		=> array(0 => $pg_id . '_page_sidebar_layout', 1 => 'equals', 2 => array(     'right','left')
                        )
                    ) ,
                    array(
                        'id' 			=> $pg_id . '-sidebar-section-end',
                        'type' 			=> 'section',
                        'indent' 		=> false,
                    ) ,
                );

                $final_page_options = array_merge($page_default_settings, $page_sorting, $page_pagination);

                $this->sections[] = array(
                    'title' 	=> $pg_name . esc_html__(' Page', 'jobzilla') ,
                    'icon' 		=> $pg_icon,
                    'desc' 		=> '',
                    'subsection'=> true,
                    'fields' 	=> $final_page_options,
                );

            }

            $this->sections[] = array(
                'title'		=> esc_html__('404 Page', 'jobzilla') ,
                'icon' 		=> 'fa fa-warning',
                'desc' 		=> '',
                'subsection'=> true,
                'fields' => array(
                    array(
                        'id' 			=> 'error_page_title',
                        'type' 			=> 'text',
                        'title' 		=> esc_html__('Page Title', 'jobzilla') ,
                        'default' 		=> esc_html__('404', 'jobzilla') ,
                        'force_output' 	=> true
                    ) ,

                    array(
                        'id' 			=> 'error_page_template',
                        'type' 			=> 'image_select',
                        'height' 		=> '80',
                        'title' 		=> esc_html__('404 Template', 'jobzilla') ,
                        'subtitle' 		=> esc_html__('Select a template for the page.', 'jobzilla') ,
                        'options' 		=> array(
                            'error_style_1' => get_template_directory_uri() . '/dz-inc/assets/images/page-template/error-404.png',
                        ) ,
                        'default' 		=> 'error_style_1'
                    ) ,
					array(
						'id'       	=> 'error_404_bg',
						'type'     	=> 'media',
						'url'      	=> true,
						'title'    	=> esc_html__('404 Page Image', 'jobzilla'),
						'default'  	=> array(
							'url'  	=> get_template_directory_uri() . '/assets/images/error-404.png'
						),
					),
					
                    array(
                        'id'        => 'error_page_text',
                        'type'      => 'text',
                        'title'     => esc_html__('404 Page Text', 'jobzilla') ,
                        'default'   => esc_html__('We Are Sorry, Page Not Found.', 'jobzilla')
                    ) ,

                    array(
                        'id' 		=> 'error_page_text2',
                        'type' 		=> 'textarea',
                        'title' 	=> esc_html__('404 Page Text 2', 'jobzilla') ,
                        'default' 	=> esc_html__('The page you are looking for might have been removed had its name changed or is temporarily unavailable.', 'jobzilla')
                    ) ,
                  
                    array(
                        'id' 		=> 'error_page_button_text',
                        'type' 		=> 'text',
                        'title' 	=> esc_html__('404 Page Button Text', 'jobzilla') ,
                        'default' 	=> esc_html__('BACK TO HOME PAGE', 'jobzilla')
                    ) ,
                    

                )
            );

			

            /*--------------------------------------------------------------
            # 10. Theme Setting
            --------------------------------------------------------------*/
            $this->sections[] = array(
                'title' => esc_html__('Theme Settings', 'jobzilla') ,
                'icon' => 'el el-cogs'
            );

            $this->sections[] = array(
                'title' 	=> esc_html__('Page Loader Setting', 'jobzilla') ,
                'icon' 		=> 'fa fa-pencil',
                'subsection'=> true,
                'fields' 	=> array(
                    array(
                        'id' 		=> 'page_loader_type',
                        'type' 		=> 'button_set',
                        'title' 	=> esc_html__('Page Loader Type', 'jobzilla') ,
                        'subtitle' 	=> esc_html__('Select Loader Type.', 'jobzilla') ,
                        'desc' 		=> esc_html__('Choose Loading Image', 'jobzilla') ,
                        'options' 	=> array(
                            'loading_image' 	=> esc_html__('Loading Image', 'jobzilla') ,
                            'advanced_loader' 	=> esc_html__('Advanced Page Loader', 'jobzilla')
                        ) ,
                        'default' 	=> 'loading_image',
                        'hint' 		=> array(
                            'title' 	=> esc_html__('Write title text here', 'jobzilla') ,
                            'content' 	=> esc_html__('Write content text here.', 'jobzilla')
                        )
                    ) ,
                    array(
                        'id' 		=> 'page_loader_image',
                        'type' 		=> 'image_select',
                        'title' 	=> esc_html__('Loding Image (Gif)', 'jobzilla') ,
                        'subtitle' 	=> esc_html__('Select Gif Image.', 'jobzilla') ,
                        'desc' 		=> esc_html__('Choose Gif Image.', 'jobzilla') ,
                        'options' 	=> $this->page_loader_options,
                        'default' 	=> 'loading1',
                        'height' 	=> '35',
                        'hint' 		=> array(
                            'title' => esc_html__('Loding Image (Gif)', 'jobzilla') ,
                            'content'=> esc_html__('Choose Gif Image.', 'jobzilla')
                        ) ,
                        'required' 	=> array(0 => 'page_loader_type', 1 => 'equals', 2 => 'loading_image')
                    ) ,
                    array(
                        'id' 		=> 'custom_page_loader_image',
                        'type' 		=> 'media',
                        'url' 		=> true,
                        'title' 	=> esc_html__('Custom Loding Image (Gif)', 'jobzilla') ,
                        'subtitle' 	=> esc_html__('Select Custom Loding Gif Image.', 'jobzilla') ,
                        'desc' 		=> esc_html__('Choose Gif Image', 'jobzilla') ,
                        'hint' 		=> array(
                            'title' => esc_html__('Custom Loding Image (Gif)', 'jobzilla') ,
                            'content'=> esc_html__('Choose Gif Image.', 'jobzilla')
                        ) ,
                        'required' 	=> array(0 => 'page_loader_type', 1 => 'equals', 2 => 'loading_image')
                    ) ,
                    array(
                        'id' 		=> 'advanced_page_loader_image',
                        'type' 		=> 'image_select',
                        'title' 	=> esc_html__('Advanced Loding Image', 'jobzilla') ,
                        'subtitle' 	=> esc_html__('Select Advance Loding Image (Gif)', 'jobzilla') ,
                        'desc' 		=> esc_html__('Choose Advance Loding Image', 'jobzilla') ,
                        'options' 	=> array(
                            'loading1' 	=> get_template_directory_uri() . '/dz-inc/assets/images/advanced-loading-images/loading1.gif',
                            'loading2' 	=> get_template_directory_uri() . '/dz-inc/assets/images/advanced-loading-images/loading2.gif',
                        ) ,
                        'default' 	=> 'loading1',
                        'height' 	=> '60',
                        'hint' 		=> array(
                            'title' => esc_html__('Advance Loding Image (Gif)', 'jobzilla') ,
                            'content'=> esc_html__('Choose Advance Loding Image', 'jobzilla')
                        ) ,
                        'required' => array(0 => 'page_loader_type', 1 => 'equals', 2 => 'advanced_loader')
                    ) ,
                )
            );


            $theme_fonts = array(
                'Font & Sizes' 	=> array(
                    'id' 		=> 'general',
                    'title' 	=> 'General Fonts',
                    'heading' 	=> 'General Settings',
                    'desc' 		=> 'When a user requests a page or post that doesn`t exists, WordPress will use this template.'
                ) ,
            );

            foreach ($theme_fonts as $key => $font)
            {

                $font_id = $font['id'];
                $font_title = $font['title'];
                $font_heading = $font['heading'];
                $font_desc = $font['desc'];

                $this->sections[] = array(
                    'title' 		=> $key,
                    'heading' 		=> $font_heading,
                    'desc' 			=> $font_desc,
                    'icon' 			=> 'el-icon-text-width',
                    'subsection' 	=> true,
                    'fields' 		=> array(
                        array(
                            'id' 			=> $font_id . '_font',
                            'type' 			=> 'button_set',
                            'title' 		=> $font_title,
                            'options' 		=> array(
                                'Open-Sans' 	=> esc_html__('Default', 'jobzilla') ,
                                'Google-Font' 	=> esc_html__('Google Fonts', 'jobzilla') ,
                            ) ,
                            'default' 		=> 'Open-Sans',
                        ) ,
                        array(
                            'id' 			=> $font_id . '_font_body',
                            'type' 			=> 'typography',
                            'title' 		=> esc_html__('Body', 'jobzilla') ,
                            'subtitle' 		=> esc_html__('This will be the default font for body tag of your website.', 'jobzilla') ,
                            'google' 		=> true,
                            'font-backup'	=> true,
                            'all_styles' 	=> true,
                            'text-align' 	=> false,
                            'color' 		=> true,
                            'output' 		=> array('body') ,
                            'units' 		=> 'px',
                            'required' 		=> array(0 => $font_id . '_font', 1 => 'equals', 2 => 'Google-Font') ,
                            'force_output' 	=> true,

                        ) ,
                        array(
                            'id' 			=> $font_id . '_font_h1',
                            'type' 			=> 'typography',
                            'title' 		=> esc_html__('H1', 'jobzilla') ,
                            'subtitle' 		=> esc_html__('This will be the default font for all H1 tags of your website.', 'jobzilla') ,
                            'google' 		=> true,
                            'font-backup' 	=> true,
                            'all_styles' 	=> true,
                            'text-align' 	=> false,
                            'color' 		=> true,
                            'output' 		=> array('h1') ,
                            'units' 		=> 'px',
                            'required' 		=> array(0 => $font_id . '_font', 1 => 'equals', 2 => 'Google-Font') ,
                            'force_output' 	=> true
                        ) ,
                        array(
                            'id' 			=> $font_id . '_font_h2',
                            'type' 			=> 'typography',
                            'title' 		=> esc_html__('H2', 'jobzilla') ,
                            'subtitle' 		=> esc_html__('This will be the default font for all H2 tags of your website.', 'jobzilla') ,
                            'google' 		=> true,
                            'font-backup' 	=> true,
                            'all_styles' 	=> true,
                            'text-align' 	=> false,
                            'color' 		=> true,
                            'output' 		=> array('h2') ,
                            'units' 		=> 'px',
                            'required' 		=> array(0 => $font_id . '_font', 1 => 'equals', 2 => 'Google-Font') ,
                            'force_output' 	=> true
                        ) ,
                        array(
                            'id' 			=> $font_id . '_font_h3',
                            'type' 			=> 'typography',
                            'title' 		=> esc_html__('H3', 'jobzilla') ,
                            'subtitle' 		=> esc_html__('This will be the default font for all H3 tags of your website.', 'jobzilla') ,
                            'google' 		=> true,
                            'font-backup' 	=> true,
                            'all_styles' 	=> true,
                            'text-align' 	=> false,
                            'color' 		=> true,
                            'output' 		=> array('h3') ,
                            'units' 		=> 'px',
                            'required' 		=> array(0 => $font_id . '_font', 1 => 'equals', 2 => 'Google-Font') ,
                            'force_output' 	=> true
                        ) ,
                        array(
                            'id' 			=> $font_id . '_font_h4',
                            'type' 			=> 'typography',
                            'title' 		=> esc_html__('H4', 'jobzilla') ,
                            'subtitle' 		=> esc_html__('This will be the default font for all H4 tags of your website.', 'jobzilla') ,
                            'google' 		=> true,
                            'font-backup' 	=> true,
                            'all_styles' 	=> true,
                            'text-align' 	=> false,
                            'color' 		=> true,
                            'output' 		=> array('h4') ,
                            'units' 		=> 'px',
                            'required' 		=> array(0 => $font_id . '_font', 1 => 'equals', 2 => 'Google-Font') ,
                            'force_output' 	=> true
                        ) ,
                        array(
                            'id' 			=> $font_id . '_font_h5',
                            'type' 			=> 'typography',
                            'title' 		=> esc_html__('H5', 'jobzilla') ,
                            'subtitle' 		=> esc_html__('This will be the default font for all H5 tags of your website.', 'jobzilla') ,
                            'google' 		=> true,
                            'font-backup' 	=> true,
                            'all_styles' 	=> true,
                            'text-align' 	=> false,
                            'color' 		=> true,
                            'output' 		=> array('h5') ,
                            'units' 		=> 'px',
                            'required' 		=> array(0 => $font_id . '_font', 1 => 'equals', 2 => 'Google-Font') ,
                            'force_output' 	=> true
                        ) ,
                        array(
                            'id' 			=> $font_id . '_font_h6',
                            'type' 			=> 'typography',
                            'title' 		=> esc_html__('H6', 'jobzilla') ,
                            'subtitle' 		=> esc_html__('This will be the default font for all H6 tags of your website.', 'jobzilla') ,
                            'google' 		=> true,
                            'font-backup' 	=> true,
                            'all_styles' 	=> true,
                            'text-align' 	=> false,
                            'color' 		=> true,
                            'output' 		=> array('h6') ,
                            'units' 		=> 'px',
                            'required' 		=> array(0 => $font_id . '_font', 1 => 'equals', 2 => 'Google-Font') ,
                            'force_output' 	=> true
                        ) ,
                        array(
                            'id' 			=> $font_id . '_font_p_tag',
                            'type' 			=> 'typography',
                            'title' 		=> esc_html__('P (Paragraph Text)', 'jobzilla') ,
                            'subtitle' 		=> esc_html__('This will be the default font for all P tags of your website.', 'jobzilla') ,
                            'google' 		=> true,
                            'font-backup' 	=> true,
                            'all_styles' 	=> true,
                            'text-align' 	=> false,
                            'color' 		=> true,
                            'output' 		=> array('p') ,
                            'units' 		=> 'px',
                            'required' 		=> array(0 => $font_id . '_font', 1 => 'equals', 2 => 'Google-Font') ,
                            'force_output' 	=> true
                        )
                    )
                );
            }

            /*--------------------------------------------------------------
            # 11. Social Setting
            --------------------------------------------------------------*/
            $this->sections[] = array(
                'title' => esc_html__('Social Setting', 'jobzilla') ,
                'icon' 	=> 'el el-twitter',
            );

            $socialLinkFiels[] = array(
                'id' 		=> 'social_link_target',
                'type' 		=> 'select',
                'title' 	=> esc_html__('Choose Social Link Target', 'jobzilla') ,
                'options' 	=> $this->link_target_options,
                'default' 	=> '_blank'
            );

            foreach ($this->social_link_options as $social_link)
            {

                $sl_id 		= $social_link['id'];
                $sl_title 	= $social_link['title'];

                $socialLinkFiels[] = array(
                    'id' 		=> 'social_' . $sl_id . '_url',
                    'type' 		=> 'text',
                    'title' 	=> $sl_title . esc_html__(' URL', 'jobzilla') ,
                    'subtitle' 	=> esc_html__('Link to : ', 'jobzilla') . $sl_title,
                    'default' 	=> '',
                );
            }

            $this->sections[] = array(
                'title' 		=> esc_html__('Social Link', 'jobzilla') ,
                'icon' 			=> 'el-icon-facebook',
                'subsection' 	=> true,
                'fields' 		=> $socialLinkFiels
            );

            $social_share_list = $social_share_default = array();
            $i = 1;
            foreach ($this->social_share_options as $social_link)
            {

                $social_share_list[$social_link['id']] = $social_link['title'];

                if ($i <= 3)
                {
                    $social_share_default[$social_link['id']] = true;
                }
                else
                {
                    $social_share_default[$social_link['id']] = false;
                }
                $i++;
            }

            $this->sections[] = array(
                'title' 	=> esc_html__('Social Sharing', 'jobzilla') ,
                'icon' 		=> 'el-icon-facebook',
                'subsection'=> true,
                'fields' => array(
                    array(
                        'id' 		=> 'social_shaing_on_post',
                        'type' 		=> 'switch',
                        'title' 	=> esc_html__('Enable Social Shaing On Post', 'jobzilla') ,
                        'on' 		=> esc_html__('Enabled', 'jobzilla') ,
                        'off' 		=> esc_html__('Disabled', 'jobzilla') ,
                        'default' 	=> false
                    ) ,
                    array(
                        'id' 		=> 'social_shaing_on_page',
                        'type' 		=> 'switch',
                        'title' 	=> esc_html__('Enable Social Shaing On Page', 'jobzilla') ,
                        'on' 		=> esc_html__('Enabled', 'jobzilla') ,
                        'off' 		=> esc_html__('Disabled', 'jobzilla') ,
                        'default' 	=> false
                    ) ,
                    array(
                        'id' 		=> 'share_sort_link',
                        'type' 		=> 'sortable',
                        'title' 	=> esc_html__('Social Sharing', 'jobzilla') ,
                        'subtitle' 	=> esc_html__('Select active social share links and sort them with drag and drop.', 'jobzilla') ,
                        'mode' 		=> 'checkbox',
                        'options' 	=> $social_share_list,
                        /* For checkbox mode */
                        'default' 	=> $social_share_default
                    )
                )
            );

            /*--------------------------------------------------------------
            # 12. Custom Script Setting
            --------------------------------------------------------------*/
            $this->sections[] = array(
                'title' => esc_html__('Custom Script', 'jobzilla') ,
                'icon' 	=> 'el el-list-alt'
            );

            $this->sections[] = array(
                'title' 	=> esc_html__('Custom Script', 'jobzilla') ,
                'icon' 		=> 'el el-list-alt',
                'subsection'=> true,
                'fields' 	=> array(
                    array(
                        'id' 		=> 'body_class',
                        'type' 		=> 'text',
                        'title' 	=> esc_html__('Body Class(s)', 'jobzilla') ,
                        'subtitle' 	=> esc_html__('You can add one or more classes on theme body element. If you need more then one class, add them with a space between them.', 'jobzilla') ,
                        'desc' 		=> esc_html__('Ex: body-class-1 body-class-2', 'jobzilla')
                    ) ,
                    array(
                        'id' 		=> 'css_editor',
                        'type' 		=> 'ace_editor',
                        'title' 	=> esc_html__('CSS Code', 'jobzilla') ,
                        'subtitle' 	=> esc_html__('Paste your CSS code here.', 'jobzilla') ,
                        'mode' 		=> 'css',
                        'theme' 	=> 'monokai'
                    ) ,
                    array(
                        'id' 		=> 'js_editor',
                        'type' 		=> 'ace_editor',
                        'title' 	=> esc_html__('Javascript Code', 'jobzilla') ,
                        'subtitle' 	=> esc_html__('Paste your JS code here.', 'jobzilla') ,
                        'mode' 		=> 'javascript',
                        'theme' 	=> 'chrome'
                    ) ,
                    array(
                        'id' 		=> 'html_editor',
                        'type' 		=> 'ace_editor',
                        'title' 	=> esc_html__('HTML Code', 'jobzilla') ,
                        'subtitle' 	=> esc_html__('Paste your HTML code here.', 'jobzilla') ,
                        'mode' 		=> 'html',
                        'theme' 	=> 'chrome'
                    )
                )
            );

            $this->sections[] = array(
                'title' 	=> esc_html__('Analytic Code', 'jobzilla') ,
                'icon' 		=> 'el-icon-edit',
                'subsection'=> true,
                'fields' 	=> array(

                    array(
                        'id' 		=> 'site_header_code',
                        'type' 		=> 'textarea',
                        'theme' 	=> 'chrome',
                        'title' 	=> esc_html__('Header Custom Codes', 'jobzilla') ,
                        'subtitle' 	=> esc_html__('It will insert the code to wp_head hook.', 'jobzilla') ,
                    ) ,
                    array(
                        'id' 		=> 'site_footer_code',
                        'type' 		=> 'textarea',
                        'theme' 	=> 'chrome',
                        'title' 	=> esc_html__('Footer Custom Codes', 'jobzilla') ,
                        'subtitle' 	=> esc_html__('It will insert the code to wp_footer hook.', 'jobzilla') ,
                    )
                )
            );

            /*--------------------------------------------------------------
            # 15. Advance Settings
            --------------------------------------------------------------*/
            $this->sections[] = array(
                'title' => esc_html__('Advance Options', 'jobzilla') ,
                'icon' 	=> 'el el-cogs'
            );

            $advanceSettingSidebarFields[] = array(
                'id' 			=> 'new_sidebar_input',
                'type' 			=> 'multi_text',
                'title' 		=> esc_html__('Sidebar Name', 'jobzilla') ,
                'subtitle' 		=> esc_html__('Name your sidebar!', 'jobzilla') ,
                'desc' 			=> esc_html__('Enter the text only. ', 'jobzilla') . '<a href="' . admin_url('widgets.php') . '" target="_blank">' . esc_html__('Click Here.', 'jobzilla') . '</a>' . esc_html__(' to check your sidebars', 'jobzilla') ,
                'hint' 			=> array(
                    'title' 	=> esc_html__('What to Do?', 'jobzilla') ,
                    'content' 	=> esc_html__('1. Once you named your sidebar click on the Save Changes button @ the top of the panel.', 'jobzilla') . '<br><br>' . esc_html__('2. After save changes please just refresh the page, you will see the sidebar listed below.', 'jobzilla')
                ) ,
            );

            $sidebars_widgets = get_option('sidebars_widgets');

            if (!empty($sidebars_widgets))
            {
                $i = 1;
                foreach ($sidebars_widgets as $key => $value)
                {
                    $keyExt 	= substr($key, 3);
                    $keyRep1 	= str_replace('-', ' ', $keyExt);
                    $keyRep2 	= str_replace('-', '_', $keyExt);
                    $dzWidget 	= ucfirst($keyRep1);

                    if (strpos($key, 'dz-') === 0)
                    {
                        $advanceSettingSidebarFields[] = array(
                            'id' 	=> 'avail_sidebar_' . $keyRep2 . '_' . $i,
                            'type' 	=> 'info',
                            'style' => 'info',
                            'desc' 	=> esc_html($dzWidget, 'jobzilla')
                        );
                    }
                    $i++;
                }
            }

            $this->sections[] = array(
                'title' 	=> esc_html__('Create Sidebar', 'jobzilla') ,
                'icon' 		=> 'el el-pencil',
                'desc' 		=> esc_html__('Dexignlab gives you the functionality to create your own Sidebars. Default there are three Sidebars as display below.', 'jobzilla') ,
                'subsection'=> true,
                'fields' 	=> $advanceSettingSidebarFields
            );
        }

        /**
         * Get default theme oiptions
         *
         * @param $key
         * @param $default
         * @return $value
         */
        function jobzilla_get_default_option($key, $default = '')
        {
            if (empty($key))
            {
                return '';
            }
            $options = get_option(jobzilla_get_opt_name() , array());
            $value = isset($options[$key]) ? $options[$key] : $default;

            return $value;
        }

    }

    global $jobzillathemeoption;

    $jobzillathemeoption = new Jobzilla_Redux_Framework_config();
}

