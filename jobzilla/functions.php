<?php 
add_action('after_setup_theme', 'jobzilla_bunch_theme_setup');

function jobzilla_bunch_theme_setup() 
{
	
	global $wp_version;
	$theme = wp_get_theme();
	
	if(!defined('JOBZILLA_VERSION')) {define('JOBZILLA_VERSION', '1.8');}
	if( !defined( 'JOBZILLA_ROOT' ) ) {define('JOBZILLA_ROOT', get_template_directory().'/');}
	if( !defined( 'JOBZILLA_URL' ) ) {define('JOBZILLA_URL', get_template_directory_uri().'/');}

	if( !defined( 'JOBZILLA_COMINGSOON' ) ) {define('JOBZILLA_COMINGSOON', get_template_directory_uri().'/assets/images/bg1.jpg');}
	if( !defined( 'JOBZILLA_MAINTENANCE' ) ) {define('JOBZILLA_MAINTENANCE', get_template_directory_uri().'/assets/images/bg2.jpg');}
	if( !defined( 'JOBZILLA_MAINTENANCE_VLC' ) ) {define('JOBZILLA_MAINTENANCE_VLC', get_template_directory_uri().'/assets/images/vlc.png');}

	if( !defined( 'JOBZILLA_DEFAULT_LOGO' ) ) {define('JOBZILLA_DEFAULT_LOGO', get_template_directory_uri().'/assets/images/logo-dark.png');}
	if( !defined( 'JOBZILLA_DEFAULT_WHITE_LOGO' ) ) {define('JOBZILLA_DEFAULT_WHITE_LOGO', get_template_directory_uri().'/assets/images/logo-light.png');}
	if( !defined( 'JOBZILLA_BACKGROUND_IMAGE' ) ) {define('JOBZILLA_BACKGROUND_IMAGE', get_template_directory_uri().'/assets/images/f-bg.jpg');}
	if( !defined( 'JOBZILLA_DEFAULT_TEXT_LOGO' ) ) {define('JOBZILLA_DEFAULT_TEXT_LOGO', $theme->get('Name'));}

	if( !defined( 'JOBZILLA_DEFAULT_TAG' ) ) {define('JOBZILLA_DEFAULT_TAG', esc_html__('Personal Blog', 'jobzilla'));}

	if( !defined( 'JOBZILLA_BANNER' ) ) {define('JOBZILLA_BANNER', '');}
	if( !defined( 'JOBZILLA_COPYWRITE_TEXT' ) ) {define('JOBZILLA_COPYWRITE_TEXT', esc_html__('© 2024 All Rights Reserved.','jobzilla'));}
	
	if( !defined( 'JOBZILLA_FAVICON' ) ) {define('JOBZILLA_FAVICON', get_template_directory_uri().'/assets/images/favicon.png');}
	
	if( !defined( 'CANDIDATE_THEME' ) ) {define('CANDIDATE_THEME', false);}
	
	include_once get_template_directory() . '/dz-inc/loader.php';
	
	load_theme_textdomain('jobzilla', get_template_directory() . '/languages');
	
	/*	ADD THUMBNAIL SUPPORT	*/
	add_theme_support('post-thumbnails');
	add_theme_support('automatic-feed-links'); /* Enables post and comment RSS feed links to head. */
	add_theme_support('widgets'); /* Add widgets and sidebar support */
	add_theme_support( 'title-tag' );
	add_theme_support( 'custom-header' );
	add_theme_support( 'custom-background' );
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'editor-styles' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'woocommerce', array(
	'thumbnail_image_width' => 600*440,
	) ); /* Enable woo-commerce page template */
	add_theme_support( 'wc-product-gallery-lightbox' );
	
	/*
	 * Enabling Full Template Support for WP Job Manager
	 */
	add_theme_support( 'job-manager-templates' );
	
	add_theme_support( 'resume-manager-templates' );
	
	add_theme_support( 'mas-wp-job-manager-company-archive' );
	
	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );
	
	/** Register wp_nav_menus */
	if(function_exists('register_nav_menu')) {
		register_nav_menus(
			array(
				/** Register Main Menu location header */
				'main_menu' => esc_html__('Main Menu', 'jobzilla'),
			)
		);
	}
	
	if ( ! isset( $content_width ) ) { $content_width = 960;	}
		 
		 /** Image Size Setting For Jobzilla **/
		 
		/*** Post Images ***/
		add_image_size( 'jobzilla_470x550', 470, 550, true ); /* Team */
		add_image_size( 'jobzilla_600x550', 600, 550, true ); /* Blog Post */
		add_image_size( 'jobzilla_720x460', 720, 460, true ); /* Blog Post */
		add_image_size( 'jobzilla_500x800', 500, 800, true ); /* Post Box 1 */
		add_image_size( 'jobzilla_1000x815', 1000, 815, true ); /* Feature Listing 1 */
		
		/* Change default image thumbnail sizes in wordpress */
		/* Thumbnail */
		update_option('thumbnail_size_w', 150); /* Testimonial, Author Box */
		update_option('thumbnail_size_h', 150); 
		update_option('thumbnail_crop', 1);
		
		/* Medium */
		update_option('medium_size_w', 500); /* Team, Blog List, Blog Grid */
		update_option('medium_size_h', 400);
		update_option('medium_crop', 1);
		
		/* Large */
		update_option('large_size_w', 1000); /* Blog Large, Grid */
		update_option('large_size_h', 600);
		update_option('large_crop', 1);
		/** Image Size Setting For Jobzilla END **/
		
}




/**
 * Register sidebar
 */
function jobzilla_sidebar() 
{
	global $wp_registered_sidebars;
	
	register_sidebar(array(
        'name'          => esc_html__('Blog Sidebar', 'jobzilla'),
        'id'            => 'dz_blog_sidebar',
        'description'   => esc_html__( 'Widgets in this area will be shown on the right-hand side.', 'jobzilla' ),
        'before_widget'=>'<div id="%1$s" class="widget style-1 sidebar-widget %2$s substitute-class">',
		'after_widget'=>'</div>',
		'before_title' => '<h4 class="section-head-small mb-4  dz-widget-title">',
		'after_title' => '</h4>'
    ));
	
	register_sidebar(array(
	  'name' => esc_html__( 'Footer Sidebar', 'jobzilla' ),
	  'id' => 'dz_footer_sidebar',
	  'description' => esc_html__( 'Widgets in this area will be shown in Footer Area.', 'jobzilla' ),
	  'before_widget'=>'<div id="%1$s" class=" col-lg-3 col-md-6 col-sm-6 widget %2$s substitute-class footer-sidebar-1"><div class="  widget_about widget_services ftr-list-center">',
	  'after_widget'=>'</div></div>',
	  'before_title' => '<h3 class="widget-title">',
	  'after_title' => '</h3>'
	));

	register_sidebar(array(
	  'name' => esc_html__( 'Footer Sidebar 2', 'jobzilla' ),
	  'id' => 'dz_footer_sidebar2',
	  'description' => esc_html__( 'Widgets in this area will be shown in Footer Area.', 'jobzilla' ),
	  'before_widget'=>'<div id="%1$s" class="col-lg-3 col-md-6 col-sm-6 widget %2$s substitute-class footer-sidebar-1"><div class="widget_services  widget_about ftr-list-center">',
	  'after_widget'=>'</div></div>',
	  'before_title' => '<h3 class="widget-title">',
	  'after_title' => '</h3>'
	));
  
	if(jobzilla_is_woocommerce_active())
	{
		register_sidebar(array(
		  'name' => esc_html__( 'Shop Sidebar', 'jobzilla' ),
		  'id' => 'dz_shop_sidebar',
		  'description' => esc_html__( 'Widgets in this area will be shown on the right-hand side.', 'jobzilla' ),
		  'before_widget'=>'<div id="%1$s" class="widget shop-widget %2$s">',
		  'after_widget'=>'</div>',
		  'before_title' => '<div class="widget-title"><h4 class="title">',
		  'after_title' => '</h4></div>'
		));
		
		register_sidebar(array(
		  'name' => esc_html__( 'Header Shopping Cart', 'jobzilla' ),
		  'id' => 'shopping-cart',
		  'description' => esc_html__( 'Widgets in this area will be shown in Header Area.', 'jobzilla' ),
		  'before_widget'=>'<div id="%1$s" class="%2$s">',
		  'after_widget'=>'</div>',
		  'before_title' => '<h4 class="acod-title">',
		  'after_title' => '</h4>'
		));
		
	} 
	/* "substitute-class" using for replace required class dynamically. */
	
	if (class_exists('ReduxFramework')) {

        $sidebar_input_arr = jobzilla_get_opt( 'new_sidebar_input' );
        
		if(!empty( $sidebar_input_arr[0])) {
            foreach($sidebar_input_arr as $sidebar_input)
			{
				$sidebarId = str_replace(' ', '_', $sidebar_input);
            
				register_sidebar(array(
					'name'          => ucfirst($sidebar_input),
					'id'            => sanitize_title('dz_' . $sidebarId),
					'description'   => esc_html__( 'Widgets in this area will be shown on the right-hand side.', 'jobzilla' ),
					'before_widget'	=>'<div id="%1$s" class="widget service_menu_nav sidebar-widget substitute-class">',
					'after_widget'	=>'</div>',
					'before_title' 	=> '<h4 class="title">',
					'after_title' 	=> '</h4>'
				));	
			}
        }
    }
	
	update_option('wp_registered_sidebars' , $wp_registered_sidebars) ;
}
add_action('widgets_init', 'jobzilla_sidebar');



function jobzilla_load_head_scripts() {
	$options = jobzilla_dzbase()->option();
    if ( !is_admin() ) {
		$protocol = is_ssl() ? 'https://' : 'http://';
		$map_api_key = jobzilla_set($options, 'map_api_key');
		
		if(!empty($map_api_key)) {
		$map_path = '?key='.jobzilla_set($options, 'map_api_key');
			wp_enqueue_script( 'jobzilla-map-api', ''.$protocol.'maps.google.com/maps/api/js'.$map_path, array(), false, false );
		}
	
	}
}
add_action( 'wp_enqueue_scripts', 'jobzilla_load_head_scripts' );

/**
 * Check if Plugin is active
 **/
function jobzilla_plugin_active($plugin)
{
	$active_plugins = apply_filters( 'active_plugins', get_option( 'active_plugins' ) );
	if(!empty($plugin) && !empty($active_plugins) && in_array($plugin,$active_plugins)) 
	{
		return true;
	}else{
		return false;
	}
}

/* global variables */
function jobzilla_bunch_global_variable() 
{
	
    global $post;
	global $jobzilla_option;

	if(jobzilla_plugin_active('redux-framework/redux-framework.php'))
	{
		$options = jobzilla_dzbase()->option();
	}
	else{
		$options = array();
	}
	$dzRes = array();	
	$dzRes['allowed_html_tags'] = wp_kses_allowed_html('post');
	$dzRes['website_status'] = !empty($options['website_status']) ? $options['website_status'] : 'live_mode';
	$dzRes['theme_corner'] = !empty($options['theme_corner']) ? $options['theme_corner'] : 'sharped';
	$dzRes['theme_font_style'] = !empty($options['theme_font_style']) ? $options['theme_font_style'] : 'default';
	$dzRes['theme_corner_rounded'] = !empty($options['theme_corner_rounded']) ? $options['theme_corner_rounded'] : 'rounded';
	$dzRes['rtl_on'] = !empty($options['rtl_on']) ? $options['rtl_on'] : '';
	$dzRes['theme_date_format'] = !empty($options['theme_date_format']) ? $options['theme_date_format'] : ''; 
	if(function_exists('jobzilla_get_ws_data')){
		$extra_ws_data = jobzilla_get_ws_data($options);
		$dzRes = array_merge($dzRes,$extra_ws_data);
	}
	
	/* stuff : header.php  */
	$dzRes['site_favicon'] = isset($options['favicon']) ? (!empty($options['favicon']['url']) ? $options['favicon']['url'] : JOBZILLA_FAVICON) : JOBZILLA_FAVICON;
	
	/* preloading image */
	$dzRes['page_loading_on'] = isset($options['page_loading_on']) ? $options['page_loading_on'] : '';
	if(!empty($dzRes['page_loading_on'])){
		$dzRes['page_loader_type'] = !empty($options['page_loader_type']) ? $options['page_loader_type'] : '';
		$dzRes['page_loader_image'] = !empty($options['page_loader_image']) ? $options['page_loader_image'] : 'loading1';
		$dzRes['custom_page_loader_image'] = !empty($options['custom_page_loader_image']) ? $options['custom_page_loader_image'] : '';
	
		if ($dzRes['page_loader_type'] == 'loading_image') {
			$page_loader_image = !empty($options['custom_page_loader_image']['url']) ? $options['page_loader_image'] : 'loading1';
			$dzRes['preloader'] = get_template_directory_uri() . '/dz-inc/assets/images/loading-images/' . $page_loader_image . '.svg';
		} elseif ($dzRes['page_loader_type'] == 'advanced_loader') {
			$dzRes['preloader'] = !empty($options['advanced_page_loader_image']) ? $options['advanced_page_loader_image'] : '';
		}
	}
	
	/* header settings */
	$dzRes['header_style'] = !empty($options['header_style']) ? $options['header_style'] : 'header_3';/* return header style id */
	
	/*Page Header: necessary to get here */
	if(is_page()) 
	{
		$page_header_setting 	= 	jobzilla_dzbase()->get_meta('page_header_setting'); 
		$page_header_setting	=	!empty($page_header_setting)?$page_header_setting:'theme_default';
		if($page_header_setting == 'custom'){
			$page_header_style 	= jobzilla_dzbase()->get_meta('page_header_style'); 
			$dzRes['header_style']	= !empty($page_header_style)?$page_header_style:$dzRes['header_style'];
		}
	}
	/*Page Header: necessary to get here END */
	
	/*Job Page Layout: necessary to get here */

	if($dzRes['website_status'] == 'live_mode' ){
		$dzRes['header_login_on'] = isset($options['header_login_on']) ? $options['header_login_on'] : '';
		$dzRes['header_register_on'] = isset($options['header_register_on']) ? $options['header_register_on'] : '';
		$dzRes['header_sticky_on'] = isset($options['header_sticky_on']) ? $options['header_sticky_on'] : '';
		$dzRes['show_website_search'] = !empty($options['show_website_search']) ? $options['show_website_search'] : true;
		$dzRes['show_login_registration'] = isset($options['show_login_registration']) ? $options['show_login_registration'] : '';
		$dzRes['show_social_icon'] = isset($options['show_social_icon']) ? $options['show_social_icon'] : '';
		$dzRes['header_sticky_class'] = ($dzRes['header_sticky_on']) ? 'sticky-header is-fixed' : '';
		$dzRes['header_location_on'] = !empty($options[$dzRes['header_style'].'_location_on']) ? true : '';
		$dzRes['site_phone_number'] = !empty($options['site_phone_number']) ? $options['site_phone_number'] : '';
		$dzRes['site_address'] = !empty($options['site_address']) ? $options['site_address'] : '';
		$dzRes['site_skype'] = !empty($options['site_skype']) ? $options['site_skype'] : '';
		$dzRes['site_email'] = !empty($options['site_email']) ? $options['site_email'] : '';
	}
	
	$dzRes['header_search_on'] = isset($options[$dzRes['header_style'].'_search_on']) ? $options[$dzRes['header_style'].'_search_on'] : false;
	$dzRes['header_search_button_title'] = !empty($options[$dzRes['header_style'].'_search_button_title']) ? $options[$dzRes['header_style'].'_search_button_title'] : esc_html__('Search', 'jobzilla');
	$dzRes['header_social_link_on'] = !empty($options[$dzRes['header_style'].'_social_link_on']) ? $options[$dzRes['header_style'].'_social_link_on'] : '';
	$dzRes['header_social_links'] = !empty($options[$dzRes['header_style'].'_social_links']) ? $options[$dzRes['header_style'].'_social_links'] : '';
	$dzRes['header_top_bar_on'] = !empty($options[$dzRes['header_style'].'_top_bar_on']) ? $options[$dzRes['header_style'].'_top_bar_on'] : '';
	$dzRes['header_author_banner_on'] = !empty($options[$dzRes['header_style'].'_author_banner_on']) ? $options[$dzRes['header_style'].'_author_banner_on'] : '';
	$dzRes['header_banner_bg_image'] = !empty($options[$dzRes['header_style'].'_banner_bg_image']['url']) ? $options[$dzRes['header_style'].'_banner_bg_image']['url'] : '';
	$dzRes['header_about_on'] = !empty($options[$dzRes['header_style'].'_about_on']) ? $options[$dzRes['header_style'].'_about_on'] : '';

	if(!empty($dzRes['header_about_on'])){
		$dzRes['header_about_title'] = !empty($options[$dzRes['header_style'].'_about_title']) ? $options[$dzRes['header_style'].'_about_title'] : '';
		$dzRes['header_about_description'] = !empty($options[$dzRes['header_style'].'_about_description']) ? $options[$dzRes['header_style'].'_about_description'] : '';
		$dzRes['header_about_link_title'] = !empty($options[$dzRes['header_style'].'_about_link_title']) ? $options[$dzRes['header_style'].'_about_link_title'] : '';
		$dzRes['header_about_link'] = !empty($options[$dzRes['header_style'].'_about_link']) ? $options[$dzRes['header_style'].'_about_link'] : '';

	}
	$dzRes['header_help_title'] = !empty($options[$dzRes['header_style'].'_help_title']) ? $options[$dzRes['header_style'].'_help_title'] : '';
	$dzRes['header_help_description'] = !empty($options[$dzRes['header_style'].'_help_description']) ? $options[$dzRes['header_style'].'_help_description'] : '';
	
	/* Manage header Subscription Form */
	$dzRes['header_subscribe_on'] = !empty($options['header_subscribe_on']) ? $options['header_subscribe_on'] : '';
	
	/* End Manage Subscription Form */
	
	/* Recruiter Widget Start */
	$dzRes['register_popup_text'] = !empty($options['register_popup_text']) ? $options['register_popup_text'] : '';
	$dzRes['login_popup_text'] = !empty($options['login_popup_text']) ? $options['login_popup_text'] : '';
	
	$dzRes['job_alert_subcrible'] = !empty($options['job_alert_subcrible']) ? $options['job_alert_subcrible'] : '';
	if (!empty($dzRes['job_alert_subcrible'])) {
		$dzRes['close_interval'] = !empty($options['job_alert_cookie_after_close_interval']) ? $options['job_alert_cookie_after_close_interval'] : 1;
		$dzRes['subscription_interval'] = !empty($options['job_alert_cookie_after_subscription_interval']) ? $options['job_alert_cookie_after_subscription_interval'] : 720;
		$dzRes['job_alert_title'] = !empty($options['job_alert_title']) ? $options['job_alert_title'] : '';
		$dzRes['job_alert_content'] = !empty($options['job_alert_content']) ? $options['job_alert_content'] : '';
		$dzRes['job_alert_btn_text'] = !empty($options['job_alert_btn_text']) ? $options['job_alert_btn_text'] : '';
	}
		
	/* Recruiter Widget End */
	
	
	/* Manage Sidebar About */
	
	/* Booking Page Url */
	$dzRes['booking_page_url'] = !empty($options['booking_page_url']) ? $options['booking_page_url'] : '';
	/* Booking Page Url */
	
	$header_style_options = jobzilla_header_style_options();
	foreach($header_style_options as $header)
	{
		if($header['id'] == $dzRes['header_style']){ 
			$call_to_action_button = !empty($header['param']['call_to_action_button']) ? $header['param']['call_to_action_button'] : 0;
			$info_fields_header = !empty($header['param']['informative_fields_header']) ? $header['param']['informative_fields_header'] : 0;

			if($call_to_action_button > 0 )
			{					
				for($i = 1; $i <= $call_to_action_button; $i++ )
				{
					$dzRes['header_button_'.$i.'_text'] = !empty($options[$dzRes['header_style'].'_button_'.$i.'_text']) ? $options[$dzRes['header_style'].'_button_'.$i.'_text'] : '';

					$dzRes['header_button_'.$i.'_url'] = !empty($options[$dzRes['header_style'].'_button_'.$i.'_url']) ? $options[$dzRes['header_style'].'_button_'.$i.'_url'] : '';

					$dzRes['header_button_'.$i.'_target'] = !empty($options[$dzRes['header_style'].'_button_'.$i.'_target']) ? $options[$dzRes['header_style'].'_button_'.$i.'_target'] : '';

				}
			}
		
			if($info_fields_header > 0 )
			{					
				for($i = 1; $i <= $info_fields_header; $i++ )
				{
					$dzRes['header_info_'.$i.'_icon_class'] = !empty($options[$dzRes['header_style'].'_info_field_'.$i.'_icon_class']) ? $options[$dzRes['header_style'].'_info_field_'.$i.'_icon_class'] : '';
					$dzRes['header_info_'.$i.'_contact'] = !empty($options[$dzRes['header_style'].'_info_field_'.$i.'_contact']) ? $options[$dzRes['header_style'].'_info_field_'.$i.'_contact'] : '';
					$dzRes['header_info_'.$i.'_address'] = !empty($options[$dzRes['header_style'].'_info_field_'.$i.'_address']) ? $options[$dzRes['header_style'].'_info_field_'.$i.'_address'] : '';

				}
			}
		}
	}

	$dzRes['mobile_header_login_on'] = isset($options['mobile_header_login_on']) ? $options['mobile_header_login_on'] : '';
	$dzRes['mobile_header_register_on'] = isset($options['mobile_header_register_on']) ? $options['mobile_header_register_on'] : '';
	$dzRes['mobile_header_social_link_on'] = isset($options[$dzRes['header_style'].'_mobile_social_link_on']) ? $options[$dzRes['header_style'].'_mobile_social_link_on'] : '';
	$dzRes['mobile_search_on'] = isset($options[$dzRes['header_style'].'_mobile_search_on']) ? $options[$dzRes['header_style'].'_mobile_search_on'] : '';
	
	$dzRes['social_link_target'] = !empty($options['social_link_target']) ? $options['social_link_target'] : '';
	/* header settings END */
	
	/* Footer Settings Starts */
	$dzRes['footer_on'] = isset($options['footer_on']) ? $options['footer_on'] : true;
	$dzRes['footer_top_on'] = isset($options['footer_top_on']) ? $options['footer_top_on'] : true;
	$dzRes['footer_bottom_on'] = isset($options['footer_bottom_on']) ? $options['footer_bottom_on'] : true;
	$dzRes['footer_subscribe_on'] = isset($options['footer_subscribe_on']) ? $options['footer_subscribe_on'] : false;
	
	
	if(isset($dzRes['footer_on'])){
		$dzRes['footer_style'] = !empty($options['footer_style']) ? $options['footer_style'] : 'footer_template_1';
		$dzRes['footer_video_bg_image'] = !empty($options['footer_video_bg_image']) ? $options['footer_video_bg_image'] : true;
		$dzRes['footer_video_link'] = !empty($options['footer_video_link']) ? $options['footer_video_link'] : '';
		$dzRes['footer_email_icon'] = !empty($options['footer_email_icon']) ? $options['footer_email_icon'] : '';
		$dzRes['footer_email_title'] = !empty($options['footer_email_title']) ? $options['footer_email_title'] : '';
		$dzRes['footer_email_value'] = !empty($options['footer_email_value']) ? $options['footer_email_value'] : '';
		$dzRes['footer_timing_icon'] = !empty($options['footer_timing_icon']) ? $options['footer_timing_icon'] : '';
		$dzRes['footer_timing_title'] = !empty($options['footer_timing_title']) ? $options['footer_timing_title'] : '';
		$dzRes['footer_timing_value'] = !empty($options['footer_timing_value']) ? $options['footer_timing_value'] : '';
		$dzRes['footer_location_icon'] = !empty($options['footer_location_icon']) ? $options['footer_location_icon'] : '';
		$dzRes['footer_location_title'] = !empty($options['footer_location_title']) ? $options['footer_location_title'] : '';
		$dzRes['footer_location_value'] = !empty($options['footer_location_value']) ? $options['footer_location_value'] : '';
		$dzRes['footer_btn_title'] = !empty($options['footer_btn_title']) ? $options['footer_btn_title'] : '';
		$dzRes['footer_btn_link'] = !empty($options['footer_btn_link']) ? $options['footer_btn_link'] : '';
		$dzRes['footer_about_description'] = !empty($options['footer_about_description']) ? $options['footer_about_description'] : '';
		$dzRes['footer_subscribe_title'] = !empty($options['footer_subscribe_title']) ? $options['footer_subscribe_title'] : '';
		$dzRes['footer_subscribe_text'] = !empty($options['footer_subscribe_text']) ? $options['footer_subscribe_text'] : '';

	}
	
	/*Footer Header: necessary to get here */
	if(is_page()) 
	{
		$page_footer_setting 	= jobzilla_dzbase()->get_meta('page_footer_setting');
		$page_footer_setting	=	!empty($page_footer_setting) ? $page_footer_setting:'theme_default';
		if($page_footer_setting == 'custom'){
			$page_footer_style 		= jobzilla_dzbase()->get_meta('page_footer_style'); 
			$dzRes['footer_on'] 	= jobzilla_dzbase()->get_meta('page_footer_on');
			$dzRes['footer_style']	= !empty($page_footer_style)?$page_footer_style:$dzRes['footer_style'];
		}
	}
	/*Footer Header: necessary to get here END */
	
	$dzRes['subscription_section_image'] = !empty($options['subscription_section_image']) ? $options['subscription_section_image'] : '';
	$default_desc = esc_html__('Sed laoreet orci id pretium sodales. Nunc ac est dolor. Donec placerat dolor et mi elementum, in suscipit libero tincidunt. Ut at tempor ex, vel auctor tortor. Sed finibus vitae mi et imperdiet.', 'jobzilla');
	$dzRes['subscription_section_desc'] = !empty($options['subscription_section_desc']) ? $options['subscription_section_desc'] : $default_desc;

	$default_email = esc_html__('info@dexignzone.com', 'jobzilla');
	$dzRes['subscription_section_email'] = !empty($options['subscription_section_email']) ? $options['subscription_section_email'] : $default_email;

	$dzRes['footer_top'] = !empty($options['footer_top']) ? $options['footer_top'] : false;
	
	
	$bg_img['url'] = JOBZILLA_BACKGROUND_IMAGE;
	$dzRes['footer_bg_image'] = isset($options['footer_style']) ? (!empty($options[$dzRes['footer_style'].'_bg_image']) ? $options[$dzRes['footer_style'].'_bg_image'] : $bg_img) : $bg_img;

	$dzRes['footer_social_on'] = !empty($options[$dzRes['footer_style'].'_social_on']) ? $options[$dzRes['footer_style'].'_social_on'] : '';

	$default_copyright_text = JOBZILLA_COPYWRITE_TEXT;
	$dzRes['footer_copyright_text'] = isset($options['footer_copyright_text']) ? $options['footer_copyright_text'] : $default_copyright_text;
	
	/* Footer Params Actions */
	$footer_style_options = jobzilla_footer_style_options();
	foreach($footer_style_options as $footer)
	{
		if($dzRes['footer_style'] == $footer['id']){
			$call_to_action_button = !empty($footer['param']['call_to_action_button']) ? $footer['param']['call_to_action_button'] : 0;
			$bg_image = !empty($footer['param']['bg_image']) ? $footer['param']['bg_image'] : 0;
			$informative_field = !empty($footer['param']['informative_field']) ? $footer['param']['informative_field'] : 0;

		
			if($call_to_action_button > 0 )
				{					
					for($i = 1; $i <= $call_to_action_button; $i++ )
					{
						$dzRes['footer_button_'.$i.'_text'] = !empty($options[$dzRes['footer_style'].'_button_'.$i.'_text']) ? $options[$dzRes['footer_style'].'_button_'.$i.'_text'] : '';
						$dzRes['footer_button_'.$i.'_url'] = !empty($options[$dzRes['footer_style'].'_button_'.$i.'_url']) ? $options[$dzRes['footer_style'].'_button_'.$i.'_url'] : '';
						$dzRes['footer_button_'.$i.'_target'] = !empty($options[$dzRes['footer_style'].'_button_'.$i.'_target']) ? $options[$dzRes['footer_style'].'_button_'.$i.'_target'] : '';

					}
				}
		}
	}
	/* Footer Params Actions END */
	
	/* Footer Instagram Settings */
	$dzRes['footer_top_feeds'] = !empty($options['footer_top_feeds']) ? $options['footer_top_feeds'] : 'normal_feeds';
	if($dzRes['footer_top_feeds'] == 'instagram_feeds')
	{
		$dzRes['instagram_shortcode'] = !empty($options['instagram_shortcode']) ? $options['instagram_shortcode'] : '';
		$dzRes['footer_instagram_title'] = !empty($options['footer_instagram_title']) ? $options['footer_instagram_title'] : '';
		$dzRes['footer_instagram_link'] = !empty($options['footer_instagram_link']) ? $options['footer_instagram_link'] : '';
		$dzRes['footer_instagram_btn_text'] = !empty($options['footer_instagram_btn_text']) ? $options['footer_instagram_btn_text'] : '';

	}
	$dzRes['scroll_menu_pages'] = !empty($options['scroll_menu_pages']) ? $options['scroll_menu_pages'] : '';
	
	/* Footer Instagram Settings END */
	
	/* Footer Settings Starts END */

	/* logo setting , adition logo settings for 'site_other_logo' for jobzilla theme */
	$dzRes['logo_type'] = !empty($options['logo_type']) ? $options['logo_type'] : '';
	$dzRes['logo_title'] = !empty($options['logo_title']) ? $options['logo_title'] : JOBZILLA_DEFAULT_TEXT_LOGO;
	$dzRes['tag_line'] = !empty($options['tag_line']) ? $options['tag_line'] : JOBZILLA_DEFAULT_TAG;
	$dzRes['logo_alt'] = !empty($options['logo_alt']) ? $options['logo_alt'] : JOBZILLA_DEFAULT_TEXT_LOGO;
	
	if(isset($options['logo_type']) && $options['logo_type'] == 'image_logo')
	{
		$dzRes['logo'] = ($dzRes['header_style'] == 'header_2') ? (!empty($options['site_other_logo']['url']) ? $options['site_other_logo']['url'] : JOBZILLA_DEFAULT_WHITE_LOGO) : (!empty($options['site_logo']['url']) ? $options['site_logo']['url'] : JOBZILLA_DEFAULT_LOGO);
	}
	elseif(isset($options['logo_type']) && $options['logo_type'] == 'text_logo') {
		$dzRes['logo_text'] = !empty($dzRes['logo_text']) ? $dzRes['logo_text'] : JOBZILLA_DEFAULT_TEXT_LOGO;
		$dzRes['logo_title'] = !empty($options['logo_title']) ? $options['logo_title'] : JOBZILLA_DEFAULT_TEXT_LOGO;
	}
	else {
		$dzRes['logo'] = JOBZILLA_DEFAULT_LOGO;
	}
	
	$dzRes['site_logo_icon'] = isset($options['site_logo_icon']) ? (!empty($options['site_logo_icon']['url']) ? $options['site_logo_icon']['url'] : get_template_directory_uri() . '/assets/images/logo-icon.png') : '';

	$dzRes['site_logo'] = isset($options['site_logo']) ? (!empty($options['site_logo']['url']) ? $options['site_logo']['url'] : JOBZILLA_DEFAULT_LOGO) : JOBZILLA_DEFAULT_LOGO;

	$dzRes['site_other_logo'] = isset($options['site_other_logo']) ? (!empty($options['site_other_logo']['url']) ? $options['site_other_logo']['url'] : JOBZILLA_DEFAULT_WHITE_LOGO) : JOBZILLA_DEFAULT_WHITE_LOGO;

	$dzRes['ratina_logo'] = isset($options['ratina_logo']) ? (!empty($options['ratina_logo']['url']) ? $options['ratina_logo']['url'] : '') : '';

	$dzRes['mobile_logo'] = isset($options['mobile_logo']) ? (!empty($options['mobile_logo']['url']) ? $options['mobile_logo']['url'] : '') : '';

	$dzRes['ratina_mobile_logo'] = isset($options['ratina_mobile_logo']) ? (!empty($options['ratina_mobile_logo']['url']) ? $options['ratina_mobile_logo']['url'] : '') : '';
	/* End logo setting  */

	/*************************************************************************************************/
	$dzRes['show_search_button'] = !empty($dzRes['header_search_on']) ? $dzRes['header_search_on'] : '';
	$dzRes['search_button_title'] = !empty($dzRes['header_search_button_title']) ? $dzRes['header_search_button_title'] : '';
	$dzRes['hide_social_icons_mobile'] = !empty($dzRes['mobile_header_social_link_on']) ? $dzRes['mobile_header_social_link_on'] : '';

	/* Post general setting */
	$dzRes['post_layout'] = !empty($options['post_general_layout']) ? $options['post_general_layout'] : 'standard';
	$dzRes['post_view_on'] = isset($options['post_view_on']) ? $options['post_view_on'] : '';
	$dzRes['post_start_view'] = !empty($options['post_start_view']) ? $options['post_start_view'] : 1;
	$dzRes['pre_next_post_on'] = isset($options['pre_next_post_on']) ? $options['pre_next_post_on'] : '';
	$dzRes['comment_view_on'] = isset($options['comment_view_on']) ? $options['comment_view_on'] : '';
	$dzRes['featured_img_on'] = isset($options['featured_img_on']) ? $options['featured_img_on'] : '';
	/* Post general setting end */
	
	/* Page banner setting */
	$dzRes['show_banner'] = isset($options['page_general_banner_on']) ? $options['page_general_banner_on'] : true;
	if (!empty($dzRes['show_banner'])) {
		$dzRes['banner_type'] = 'image';
		$dzRes['banner_height'] = !empty($options['page_general_banner_height']) ? $options['page_general_banner_height'] : 'page_banner_big';
		$dzRes['banner_custom_height'] = !empty($options['post_general_banner_custom_height']) ? $options['post_general_banner_custom_height'] : '100';
		$dzRes['post_general_banner_style'] = !empty($options['post_general_banner_style']) ? $options['post_general_banner_style'] : '';
		$dzRes['page_general_banner_style'] = !empty($options['page_general_banner_style']) ? $options['page_general_banner_style'] : '';
		$dzRes['banner_image'] = isset($options['page_general_banner']['url']) ? $options['page_general_banner']['url'] : JOBZILLA_BANNER;
	}
	/* End Page banner setting */

	/* Sidebar and their layout */
	$dzRes['layout'] = 'right';
	$dzRes['sidebar'] = 'dz_blog_sidebar';
	$dzRes['show_sidebar'] = !empty($options['page_general_show_sidebar']) ? $options['page_general_show_sidebar'] : true;
	if ($dzRes['show_sidebar']) {
		$dzRes['layout'] = !empty($options['page_general_sidebar_layout']) ? $options['page_general_sidebar_layout'] : 'right';
		$dzRes['sidebar'] = !empty($options['page_general_sidebar']) ? $options['page_general_sidebar'] : 'dz_blog_sidebar';
	}
	/* End Sidebar and their layout */

	$pagination = !empty($options['page_general_paging']) ? $options['page_general_paging'] : 'default';
	$dzRes['disable_ajax_pagination'] = ($pagination == 'load_more') ? $pagination : '';
	/*************************************************************************************************/

	
	
	$HomePagetemp = $dzRes;
	
	/* page.php */
	if(is_page()) { 
		
		$page_level_keys = array(
			'page_header_setting',
			'page_header_style',
			'page_banner_height',
			'page_banner_on',
			'page_banner_hide',
			'page_banner',
			'page_banner_title',
			'banner_image',
			'page_show_sidebar',
			'page_sidebar_layout',
			'page_sidebar',
			'page_footer_setting',
			'page_footer_style',
		);

		foreach($page_level_keys as $value)
		{
			$page_settings[$value] =  jobzilla_dzbase($page_level_keys)->get_meta($value);
		}
		
		/* Header & Logo Setting */
		
		$page_header_setting	=	!empty($page_settings['page_header_setting'])?$page_settings['page_header_setting']:'theme_default';
		if($page_header_setting == 'custom'){
			$dzRes['header_style'] = !empty($page_settings['page_header_style'])?$page_settings['page_header_style']:$dzRes['header_style'];
		}		
		$dzRes['header_top_bar_on'] = !empty($options[$dzRes['header_style'].'_top_bar_on']) ? $options[$dzRes['header_style'].'_top_bar_on'] : '';
		$dzRes['header_search_on'] = !empty($options[$dzRes['header_style'].'_search_on']) ? $options[$dzRes['header_style'].'_search_on'] : false;        
		if ($dzRes['header_style'] == 'header_2') {
			$dzRes['logo'] = !empty($options['site_other_logo']) ? $options['site_other_logo'] : JOBZILLA_DEFAULT_WHITE_LOGO;
			$dzRes['logo'] = !empty($dzRes['logo']['url']) ? $dzRes['logo']['url'] : JOBZILLA_DEFAULT_WHITE_LOGO;
		} else {
			$dzRes['logo'] = !empty($options['site_logo']) ? $options['site_logo'] : JOBZILLA_DEFAULT_LOGO;
			$dzRes['logo'] = !empty($dzRes['logo']['url']) ? $dzRes['logo']['url'] : JOBZILLA_DEFAULT_LOGO;
		}       
		/* End Header & Logo Setting */
		
		/* Page banner setting */
		
		$dzRes['show_banner'] = isset($page_settings['page_banner_on']) ? $page_settings['page_banner_on'] : $dzRes['show_banner'];		
		
		$dzRes['page_banner_title'] = !empty($page_settings['page_banner_title']) ? $page_settings['page_banner_title'] : false;
		
		$dzRes['banner_height'] = !empty($page_settings['page_banner_height'])?$page_settings['page_banner_height']:$dzRes['banner_height'];		
		$dzRes['banner_custom_height'] = !empty($page_settings['page_banner_custom_height'])?$page_settings['page_banner_custom_height']:$dzRes['banner_custom_height'];		
		$dzRes['dont_use_banner_image'] = jobzilla_set($page_settings,'page_banner_hide', 0);		
		if($dzRes['dont_use_banner_image'] == 0){
			$dzRes['banner_image'] = isset($page_settings['page_general_banner']) ? jobzilla_set($page_settings['page_general_banner'], 'url', $dzRes['banner_image']) : $dzRes['banner_image']; 
		}else{
			$dzRes['banner_image'] = '';
		}
		/* End page banner setting */		
		
		/* Sidebar and there layout */
		$dzRes['show_sidebar'] = isset($page_settings['page_show_sidebar']) ? $page_settings['page_show_sidebar'] : $dzRes['show_sidebar'];
		if($dzRes['show_sidebar']) {
			$dzRes['layout'] = !empty($page_settings['page_sidebar_layout']) ? $page_settings['page_sidebar_layout'] : $dzRes['layout'];
			$dzRes['sidebar'] = !empty($page_settings['page_sidebar']) ? $page_settings['page_sidebar'] : $dzRes['sidebar'];
		}
		/* End Sidebar and there layout */

		$page_footer_setting	=	!empty($page_settings['page_footer_setting'])?$page_settings['page_footer_setting']:'theme_default';
		if($page_footer_setting == 'custom'){
			$dzRes['footer_style'] = !empty($page_settings['page_footer_style'])?$page_settings['page_footer_style']:$dzRes['footer_style'];
		}
		
		if(!empty($options['jobzilla_login_page']) && ($options['jobzilla_login_page'] == $post->ID) || !empty($options['jobzilla_forgot_password_page'])){
			$dzRes['login_page_image_url'] = !empty($options['login_page_image_url']) ? $options['login_page_image_url'] : '';
		}elseif(!empty($options['jobzilla_register_page']) && ($options['jobzilla_register_page'] == $post->ID)){
			$dzRes['register_page_image_url'] = !empty($options['register_page_image_url']) ? $options['register_page_image_url'] : '';
		}
		
	}	

	/* single.php */
	if(is_single())	{

		$page_level_keys = array(
			'featured_post',
			'post_layout',
			'post_type_gallery1',
			'post_type_gallery2',
			'post_type_link',
			'post_type_video',
			'post_type_audio',
			'post_show_sidebar',
			'post_sidebar_layout',
			'post_sidebar'
		);
		foreach($page_level_keys as $value)
		{
			$page_settings[$value] =  jobzilla_dzbase($page_level_keys)->get_meta($value);
		}
		
		$dzRes['is_featured_post'] = jobzilla_dzbase()->get_meta( 'featured_post' );
		$post_layout = jobzilla_dzbase()->get_meta( 'post_layout' );
		$dzRes['post_layout'] = (isset($post_layout)) ? $post_layout : $dzRes['post_layout'];

		if($dzRes['post_layout'] == 'slider_post_1') {
			$dzRes['post_gallary_setting'] = jobzilla_dzbase()->get_meta('post_type_gallery1');
		}
		if($dzRes['post_layout'] == 'slider_post_2') {
			$dzRes['post_gallary_setting'] = jobzilla_dzbase()->get_meta('post_type_gallery2');
		}
		$dzRes['external_link'] = jobzilla_dzbase()->get_meta('post_type_link');
		$dzRes['youtube_link'] = jobzilla_dzbase()->get_meta('post_type_video');
		$dzRes['audio_link'] = jobzilla_dzbase()->get_meta('post_type_audio');
		
		/* Single post sidebar settings from post level. */
		if($dzRes['post_layout'] == 'gutenberg') {
			$dzRes['sidebar'] = '';
			$dzRes['layout'] = 'full';
		}else {
			/* Sidebar and there layout */
			$dzRes['show_sidebar'] = !empty($page_settings['post_show_sidebar']) ? $page_settings['post_show_sidebar'] : $dzRes['show_sidebar'];
			if ($dzRes['show_sidebar'] == true) {
				$dzRes['layout'] = !empty($page_settings['post_sidebar_layout']) ? $page_settings['post_sidebar_layout'] : $dzRes['layout'];
				$dzRes['sidebar'] = !empty($page_settings['post_sidebar']) ? $page_settings['post_sidebar'] : $dzRes['sidebar'];
			}
			/* End Sidebar and there layout */
		}
		/* Single post sidebar settings from post level end. */
		$dzRes['related_post_title'] = !empty($options['related_post_title']) ? $options['related_post_title'] : '';
		$dzRes['layout_class'] = (!is_active_sidebar($dzRes['sidebar']) || $dzRes['layout'] == 'full' || $dzRes['show_sidebar'] != true || !jobzilla_is_theme_sidebar_active()) ? ' col-lg-12 col-md-12 ' : ' col-lg-8 col-md-7 sidebar ';
		
		if(is_singular('job_listing')){
			$dzRes['recruiter_widget_on'] = !empty($options['recruiter_widget_on']) ? $options['recruiter_widget_on'] : '';
			if(!empty($dzRes['recruiter_widget_on'])){
				$dzRes['recruiter_widget_title'] = !empty($options['recruiter_widget_title']) ? $options['recruiter_widget_title'] : '';
				$dzRes['recruiter_widget_image'] = !empty($options['recruiter_widget_image']['url']) ? $options['recruiter_widget_image']['url'] : '';
				$dzRes['recruiter_widget_content'] = !empty($options['recruiter_widget_content']) ? $options['recruiter_widget_content'] : '';
				$dzRes['recruiter_widget_btn_url'] = !empty($options['recruiter_widget_btn_url']) ? $options['recruiter_widget_btn_url'] : '';
				$dzRes['recruiter_widget_btn_text'] = !empty($options['recruiter_widget_btn_text']) ? $options['recruiter_widget_btn_text'] : '';
				$dzRes['recruiter_widget_btn_target'] = !empty($options['recruiter_widget_btn_target']) ? $options['recruiter_widget_btn_target'] : '';
				$dzRes['detail_page_job_view'] = !empty($options['detail_page_job_view']) ? $options['detail_page_job_view'] : '';
			}
		}else if(is_singular('company') || is_singular('resume')){
			$dzRes['company_mail_send'] = !empty($options['company_mail_send']) ? $options['company_mail_send'] : '';
		}
	}
	
	/* archive.php */
	if(is_archive()) {	
		$options['archive_page_banner'] = '';
		$dzRes['page_title'] = !empty($options['archive_page_title']) ? $options['archive_page_title'] : esc_html__('Archive : ', 'jobzilla');
		
		/* Page banner setting */
		$dzRes['show_banner'] = isset($options['archive_page_banner_on']) ? $options['archive_page_banner_on'] : $dzRes['show_banner'];
		$dzRes['archive_page_banner_style'] = isset($options['archive_page_banner_style']) ? $options['archive_page_banner_style'] : $dzRes['page_general_banner_style'];
		$dzRes['banner_height'] = !empty($options['archive_page_banner_height']) ? $options['archive_page_banner_height'] : $dzRes['banner_height'];
		$dzRes['dont_use_banner_image'] = !empty($options['archive_page_banner_hide']) ? $options['archive_page_banner_hide'] : '0';

		$dzRes['banner_custom_height'] = !empty($options['archive_page_banner_custom_height']) ? $options['archive_page_banner_custom_height'] : $dzRes['banner_custom_height'];
		
		if ($dzRes['dont_use_banner_image'] == 0) {
			$dzRes['banner_image'] = !empty($options['archive_page_banner']['url']) ? $options['archive_page_banner']['url'] : $dzRes['banner_image'];
		} else {
			$dzRes['banner_image'] = '';
		}
		/* End Page banner setting */
		/* Sidebar and their layout */
		$dzRes['show_sidebar'] = isset($options['archive_page_show_sidebar']) ? $options['archive_page_show_sidebar'] : true;
		if ($dzRes['show_sidebar']) {
			$dzRes['layout'] = !empty($options['archive_page_sidebar_layout']) ? $options['archive_page_sidebar_layout'] : $dzRes['layout'];
			$dzRes['sidebar'] = !empty($options['archive_page_sidebar']) ? $options['archive_page_sidebar'] : $dzRes['sidebar'];
		}
		/* End Sidebar and their layout */

		$pagination = !empty($options['archive_page_paging']) ? $options['archive_page_paging'] : $dzRes['disable_ajax_pagination'];
		$dzRes['disable_ajax_pagination'] = ($pagination == 'load_more') ? $pagination : '';
	}

	/* tag.php */
	if(is_tag()) {
		$options['tag_page_banner'] = '';
		$dzRes['page_title'] = !empty($options['tag_page_title']) ? $options['tag_page_title'] : esc_html__('Tag : ', 'jobzilla');

		/* Tag banner setting */
		$dzRes['show_banner'] = isset($options['tag_page_banner_on']) ? $options['tag_page_banner_on'] : $dzRes['show_banner'];
		$dzRes['banner_height'] = !empty($options['tag_page_banner_height']) ? $options['tag_page_banner_height'] : $dzRes['banner_height'];
		$dzRes['dont_use_banner_image'] = !empty($options['tag_page_banner_hide']) ? $options['tag_page_banner_hide'] : '0';
		$dzRes['tag_page_banner_style'] = !empty($options['tag_page_banner_style']) ? $options['tag_page_banner_style'] : $dzRes['page_general_banner_style'];
		$dzRes['banner_custom_height'] = !empty($options['tag_page_banner_custom_height']) ? $options['tag_page_banner_custom_height'] : $dzRes['banner_custom_height'];

		if ($dzRes['dont_use_banner_image'] == 0) {
			$dzRes['banner_image'] = !empty($options['tag_page_banner']['url']) ? $options['tag_page_banner']['url'] : $dzRes['banner_image'];
		} else {
			$dzRes['banner_image'] = '';
		}
		/* End Tag banner setting */

		/* Sidebar and their layout */
		$dzRes['show_sidebar'] = isset($options['tag_page_show_sidebar']) ? $options['tag_page_show_sidebar'] : true;
		if ($dzRes['show_sidebar']) {
			$dzRes['layout'] = !empty($options['tag_page_sidebar_layout']) ? $options['tag_page_sidebar_layout'] : $dzRes['layout'];
			$dzRes['sidebar'] = !empty($options['tag_page_sidebar']) ? $options['tag_page_sidebar'] : $dzRes['sidebar'];
		}
		/* End Sidebar and their layout */

		$pagination = !empty($options['tag_page_paging']) ? $options['tag_page_paging'] : $dzRes['disable_ajax_pagination'];
		$dzRes['disable_ajax_pagination'] = ($pagination == 'load_more') ? $pagination : '';
	}
	
	/* author.php */
	if(is_author() ) {
		$options['author_page_banner'] = '';
		$authorDisplayName = get_the_author_meta('display_name');
		$dzRes['page_title'] = !empty($options['author_page_title']) ? $options['author_page_title'] . esc_html__('Author : ', 'jobzilla') . $authorDisplayName : esc_html__('Author : ', 'jobzilla') . $authorDisplayName;
		$dzRes['author_page_banner_style'] = !empty($options['author_page_banner_style']) ? $options['author_page_banner_style'] : $dzRes['page_general_banner_style'];

		/* Tag banner setting */
		$dzRes['show_banner'] = !empty($options['author_page_banner_on']) ? $options['author_page_banner_on'] : $dzRes['show_banner'];
		$dzRes['banner_height'] = !empty($options['author_page_banner_height']) ? $options['author_page_banner_height'] : $dzRes['banner_height'];
		$dzRes['dont_use_banner_image'] = !empty($options['author_page_banner_hide']) ? $options['author_page_banner_hide'] : '0';
		$dzRes['banner_custom_height'] = !empty($options['author_page_banner_custom_height']) ? $options['author_page_banner_custom_height'] : $dzRes['banner_custom_height'];

		if ($dzRes['dont_use_banner_image'] == 0) {
			$dzRes['banner_image'] = isset($options['author_page_banner']['url']) ? $options['author_page_banner']['url'] : $dzRes['banner_image'];
		} else {
			$dzRes['banner_image'] = '';
		}
		/* End Tag banner setting */

		$dzRes['show_banner'] = !empty($options['author_page_banner_on']) ? $options['author_page_banner_on'] : $dzRes['show_banner'];
		if ($dzRes['show_banner'] == true) {
			$dzRes['banner_height'] = !empty($options['author_page_banner_height']) ? $options['author_page_banner_height'] : $dzRes['banner_height'];
			$dzRes['banner_image'] = !empty($options['author_page_banner']['url']) ? $options['author_page_banner']['url'] : $dzRes['banner_image'];
			$dzRes['dont_use_banner_image'] = !empty($options['author_page_banner_hide']) ? $options['author_page_banner_hide'] : '0';
		}

		/* Sidebar and their layout */
		$dzRes['show_sidebar'] = isset($options['author_page_show_sidebar']) ? $options['author_page_show_sidebar'] : true;
		if ($dzRes['show_sidebar']) {
			$dzRes['layout'] = !empty($options['author_page_sidebar_layout']) ? $options['author_page_sidebar_layout'] : $dzRes['layout'];
			$dzRes['sidebar'] = !empty($options['author_page_sidebar']) ? $options['author_page_sidebar'] : $dzRes['sidebar'];
		}
		/* End Sidebar and their layout */

		$pagination = !empty($options['author_page_paging']) ? $options['author_page_paging'] : $dzRes['disable_ajax_pagination'];
		$dzRes['disable_ajax_pagination'] = ($pagination == 'load_more') ? $pagination : '';
	}	
	
	/* index.php */
	if(is_home()) {
		$dzRes['page_title'] = !empty($options['blog_page_title']) ? $options['blog_page_title'] : esc_html__('Jobzilla Personal Blog', 'jobzilla');
	}
	
	/* search.php */
	if(is_search()) {
		$options['search_page_banner'] = '';
		$dzRes['page_title'] = !empty($options['search_page_title']) ? $options['search_page_title'] : esc_html__('Search : ', 'jobzilla');

		/* Search banner setting */
		$dzRes['show_banner'] = isset($options['search_page_banner_on']) ? $options['search_page_banner_on'] : $dzRes['show_banner'];
		$dzRes['banner_height'] = !empty($options['search_page_banner_height']) ? $options['search_page_banner_height'] : $dzRes['banner_height'];
		$dzRes['dont_use_banner_image'] = !empty($options['search_page_banner_hide']) ? $options['search_page_banner_hide'] : '0';
		$dzRes['search_page_banner_style'] = isset($options['search_page_banner_style']) ? $options['search_page_banner_style'] : $dzRes['page_general_banner_style'];
		$dzRes['banner_custom_height'] = !empty($options['search_page_banner_custom_height']) ? $options['search_page_banner_custom_height'] : $dzRes['banner_custom_height'];

		if ($dzRes['dont_use_banner_image'] == 0) {
			$dzRes['banner_image'] = !empty($options['search_page_banner']) ? $options['search_page_banner']['url'] : $dzRes['banner_image'];
		} else {
			$dzRes['banner_image'] = '';
		}
		/* End Search banner setting */

		/* Sidebar and there layout */
		$dzRes['show_sidebar'] = isset($options['search_page_show_sidebar']) ? $options['search_page_show_sidebar'] : true;
		if ($dzRes['show_sidebar']) {
			$dzRes['layout'] = !empty($options['search_page_sidebar_layout']) ? $options['search_page_sidebar_layout'] : $dzRes['layout'];
			$dzRes['sidebar'] = !empty($options['search_page_sidebar']) ? $options['search_page_sidebar'] : $dzRes['sidebar'];
		}
		/* End Sidebar and there layout */

		$pagination = !empty($options['search_page_paging']) ? $options['search_page_paging'] : $dzRes['disable_ajax_pagination'];
		$dzRes['disable_ajax_pagination'] = ($pagination == 'load_more') ? $pagination : '';
	}
	
	if(is_page() || is_archive() || is_tag() || is_author() || is_home() || is_search() || is_404()) {

		$dzRes['banner_class'] = '';
		if($dzRes['header_style'] == 'header_2')
		{
			$dzRes['banner_class'] .= ' tp-banner';
		}
		
		if(isset($dzRes['banner_height']) && $dzRes['banner_height'] == 'page_banner_big') {
			$dzRes['banner_class'] .= 'dlab-bnr-inr-lg';
		}elseif(isset($dzRes['banner_height']) && $dzRes['banner_height'] == 'page_banner_medium'){
			$dzRes['banner_class'] .= 'dlab-bnr-inr-md';
		}
		
		$dzRes['page_banner_style_attr'] = !empty($dzRes['banner_image']) ? 'background-image:url('.esc_url($dzRes['banner_image']).')' : '';
	
		$dzRes['container_class'] = (!is_active_sidebar($dzRes['sidebar']) || $dzRes['layout'] == 'full' || $dzRes['show_sidebar'] != true) ? 'min-container' : 'container';
		$dzRes['layout_class'] = (!is_active_sidebar($dzRes['sidebar']) || $dzRes['layout'] == 'full' || $dzRes['show_sidebar'] != true || !jobzilla_is_theme_sidebar_active()) ? ' col-lg-12 col-md-12 ' : ' col-lg-8 col-md-7 sidebar ';
		
	}
	
	/* category.php */
	if(is_category()) {
		 $options['category_page_banner'] = '';
		$dzRes['banner_height'] = '';
		$dzRes['dont_use_banner_image'] = 0;
		$dzRes['page_title'] = !empty($options['category_page_title']) ? esc_html__('Category : ', 'jobzilla') . $options['category_page_title'] : esc_html__('Category : ', 'jobzilla');
		$dzRes['category_page_banner_style'] = !empty($options['category_page_banner_style']) ? $options['category_page_banner_style'] : $dzRes['page_general_banner_style'];
		/* Search banner setting */
		$dzRes['show_banner'] = !empty($options['category_page_banner_on']) ? $options['category_page_banner_on'] : $dzRes['show_banner'];
		$dzRes['banner_height'] = !empty($options['category_page_banner_height']) ? $options['category_page_banner_height'] : $dzRes['banner_height'];
		$dzRes['dont_use_banner_image'] = !empty($options['category_page_banner_hide']) ? $options['category_page_banner_hide'] : '0';

		$dzRes['banner_custom_height'] = !empty($options['category_page_banner_custom_height']) ? $options['category_page_banner_custom_height'] : $dzRes['banner_custom_height'];

		if ($dzRes['dont_use_banner_image'] == 0) {
			$dzRes['banner_image'] = !empty($options['category_page_banner']) ? $options['category_page_banner']['url'] : $dzRes['banner_image'];
		} else {
			$dzRes['banner_image'] = '';
		}
		/* End Search banner setting */

		/* Sidebar and their layout */
		$dzRes['show_sidebar'] = isset($options['category_page_show_sidebar']) ? $options['category_page_show_sidebar'] : true;
		if ($dzRes['show_sidebar']) {
			$dzRes['layout'] = !empty($options['category_page_sidebar_layout']) ? $options['category_page_sidebar_layout'] : $dzRes['layout'];
			$dzRes['sidebar'] = !empty($options['category_page_sidebar']) ? $options['category_page_sidebar'] : $dzRes['sidebar'];
		}
		/* End Sidebar and their layout */

		/* To manage Category Page banner and layout settings */
		$dzRes['banner_class'] = '';
		if ($dzRes['header_style'] == 'header_2') {
			$dzRes['banner_class'] .= ' tp-banner';
		}

		if (!empty($dzRes['banner_height']) && $dzRes['banner_height'] == 'page_banner_big') {
			$dzRes['banner_class'] .= 'dlab-bnr-inr-lg';
		} elseif (!empty($dzRes['banner_height']) && $dzRes['banner_height'] == 'page_banner_medium') {
			$dzRes['banner_class'] .= 'dlab-bnr-inr-md';
		}

		$dzRes['page_banner_style_attr'] = !empty($dzRes['banner_image']) ? 'background-image:url(' . esc_url($dzRes['banner_image']) . ')' : '';

		$dzRes['container_class'] = (!is_active_sidebar($dzRes['sidebar']) || $dzRes['layout'] == 'full' || $dzRes['show_sidebar'] != true) ? 'min-container' : 'container';
		$dzRes['layout_class'] = (!is_active_sidebar($dzRes['sidebar']) || $dzRes['layout'] == 'full' || $dzRes['show_sidebar'] != true || !jobzilla_is_theme_sidebar_active()) ? ' col-lg-12 col-md-12 ' : ' col-lg-8 col-md-7 sidebar ';
		/* End To manage Category Page banner and layout settings */

		$pagination = !empty($options['category_page_paging']) ? $options['category_page_paging'] : $dzRes['disable_ajax_pagination'];
		$dzRes['disable_ajax_pagination'] = ($pagination == 'load_more') ? $pagination : '';
		/* all other variable will manage on category page from db. */
	}

	if(is_404()){
    $dzRes['error_404_bg'] = !empty($options['error_404_bg']['url']) ? $options['error_404_bg']['url'] : get_template_directory_uri() . '/assets/images/error-404.png';
		$dzRes['error_404_bg'] = !empty($dzRes['error_404_bg']['url']) ? $dzRes['error_404_bg']['url'] : get_template_directory_uri() . '/assets/images/error-404.png';
			$dzRes['error_page_title'] = !empty($options['error_page_title']) ? $options['error_page_title'] : esc_html__('404', 'jobzilla');
			$dzRes['error_page_subtitle'] = !empty($options['error_page_subtitle']) ? $options['error_page_subtitle'] : esc_html__('Something went wrong !', 'jobzilla');
			$dzRes['error_page_search_on'] = !empty($options['error_page_search_on']) ? $options['error_page_search_on'] : '';
			$dzRes['error_page_text'] = !empty($options['error_page_text']) ? $options['error_page_text'] : esc_html__('We Are Sorry, Page Not Found', 'jobzilla');
			$dzRes['error_page_text2'] = !empty($options['error_page_text2']) ? $options['error_page_text2'] : esc_html__('The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.', 'jobzilla');
			$dzRes['error_page_button_text'] = !empty($options['error_page_button_text']) ? $options['error_page_button_text'] : esc_html__('Back to Home', 'jobzilla');
	}
	
	/* Logo Setting According To Theme Color and Header */
	
	
	/* Remove from package */
	$dzRes['predefined_color_skin'] = isset($options['predefined_color_skin']) ? (!empty($options['predefined_color_skin']) ? $options['predefined_color_skin'] : '') : '';
	/* Remove from package */
	
	
	/* Set All Option Values to Global Variable */
	$jobzilla_option = $dzRes;
	

	
	if($jobzilla_option['website_status'] != 'live_mode' && !is_home() && !is_front_page() && !is_user_logged_in())
	{
		wp_redirect(home_url( '/' ));
	}

}
function jobzilla_enqueue_scripts() {
	$options = jobzilla_dzbase()->option();
	$skin = !empty($options['predefined_color_skin']) ? $options['predefined_color_skin'] : 'orange';
	$color_skin_setting = !empty($options['color_skin_setting']) ? $options['color_skin_setting'] : 'predefined_color_skin';
	


	/* style */
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap-min.css' );
	wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/assets/css/font-awesome-min.css' );
	wp_enqueue_style( 'flaticon', get_template_directory_uri() . '/assets/css/flaticon.css' );
	wp_enqueue_style( 'line-awesome-min', get_template_directory_uri() . '/assets/css/line-awesome-min.css' );
	wp_enqueue_style( 'feather', get_template_directory_uri() . '/assets/css/feather.css' );
	
	wp_enqueue_style( 'owl-carousel', get_template_directory_uri() . '/assets/css/owl-carousel-min.css' );
	
	wp_enqueue_style( 'magnific-popup', get_template_directory_uri() . '/assets/css/magnific-popup-min.css' );
	wp_enqueue_style( 'lc-lightbox', get_template_directory_uri() . '/assets/css/lc-lightbox.css' );
	
	
	wp_enqueue_style( 'bootstrap-select', get_template_directory_uri() . '/assets/css/bootstrap-select-min.css' );
	
	wp_enqueue_style( 'dataTables-bootstrap5', get_template_directory_uri() . '/assets/css/dataTables-bootstrap5-min.css' );
	
	wp_enqueue_style( 'select-bootstrap5', get_template_directory_uri() . '/assets/css/select-bootstrap5-min.css' );
	
	wp_enqueue_style( 'dropzone', get_template_directory_uri() . '/assets/css/dropzone.css' );
	
	wp_enqueue_style( 'scrollbar', get_template_directory_uri() . '/assets/css/scrollbar.css' );
	
	wp_enqueue_style( 'datepicker', get_template_directory_uri() . '/assets/css/datepicker.css' );
	
	wp_enqueue_style( 'swiper', get_template_directory_uri().'/assets/css/swiper-bundle-min.css'); 
	
	
	if(is_child_theme()){
	   	wp_enqueue_style( 'jobzilla-parent-style', get_template_directory_uri() . '/style.css' );
	    wp_enqueue_style( 'jobzilla-main-style', get_stylesheet_uri() );
	}else{
	    wp_enqueue_style( 'jobzilla-main-style', get_stylesheet_uri() );    
	}
	
	wp_enqueue_style( 'jobzilla-style', get_template_directory_uri() . '/assets/css/style-min.css' );
	
	wp_enqueue_style( 'jobzilla-woocommerce', get_template_directory_uri() . '/assets/css/woocommerce-min.css' );
	wp_enqueue_style( 'blog', get_template_directory_uri() . '/assets/css/blog.css' );
	wp_enqueue_style( 'jobzilla-custom', get_template_directory_uri() . '/assets/css/custom-min.css' );
	
  
    /* scripts */
	wp_enqueue_script( 'jquery-ui-core');
	
	
	 wp_enqueue_script( 'popper', get_template_directory_uri().'/assets/js/popper-min.js', array( 'jquery' ), '2.9.2', true );
	
	wp_enqueue_script( 'bootstrap', get_template_directory_uri().'/assets/js/bootstrap-min.js', array( 'jquery' ), '5.1.3', true );
	
	wp_enqueue_script( 'magnific-popup', get_template_directory_uri().'/assets/js/magnific-popup-min.js', array( 'jquery' ), '1.1.0', true );
	
	wp_enqueue_script( 'waypoints', get_template_directory_uri().'/assets/js/waypoints-min.js', array( 'jquery' ), '4.0.1', true );
	wp_enqueue_script( 'swiper', get_template_directory_uri().'/assets/js/swiper-bundle-min.js', array( 'jquery' ), '9.1.0', true );
	
	wp_enqueue_script( 'counterup', get_template_directory_uri().'/assets/js/counterup-min.js', array( 'jquery' ), '1.0', true );
	
	wp_enqueue_script( 'owl-carousel', get_template_directory_uri().'/assets/js/owl-carousel-min.js', array( 'jquery' ), '2.3.4', true );
	wp_enqueue_script( 'waypoints-sticky', get_template_directory_uri().'/assets/js/waypoints-sticky-min.js', array( 'jquery' ), '4.0.1', true );
	
	wp_enqueue_script( 'isotope-pkgd', get_template_directory_uri().'/assets/js/isotope-pkgd-min.js', array( 'jquery' ), '3.0.6', true );
	
	wp_enqueue_script( 'imagesloaded-pkgd', get_template_directory_uri().'/assets/js/imagesloaded-pkgd-min.js', array( 'jquery' ), '4.1.4', true );
	
	
	wp_enqueue_script( 'theia-sticky-sidebar', get_template_directory_uri().'/assets/js/theia-sticky-sidebar.js', array( 'jquery' ), '1.7.0', true );
	
	wp_enqueue_script( 'lc-lightbox-lite', get_template_directory_uri().'/assets/js/lc-lightbox-lite.js', array( 'jquery' ), '1.2.9', true );
	
	wp_enqueue_script( 'bootstrap-select', get_template_directory_uri().'/assets/js/bootstrap-select-min.js', array( 'jquery' ), '1.14.0', true );

	wp_enqueue_script( 'bootstrap-slider', get_template_directory_uri().'/assets/js/bootstrap-slider-min.js', array( 'jquery' ), '11.0.2', true );

	wp_enqueue_script( 'bjquery-owl-filter', get_template_directory_uri().'/assets/js/jquery-owl-filter.js', array( 'jquery' ), '1.0.0', true );
	
	wp_enqueue_script( 'dropzone', get_template_directory_uri().'/assets/js/dropzone.js', array( 'jquery' ), '4.3.0', true );
	
	wp_enqueue_script( 'jquery-scrollbar', get_template_directory_uri().'/assets/js/jquery-scrollbar.js', array( 'jquery' ), '0.2.10', true );
	
	wp_enqueue_script( 'bootstrap-datepicker', get_template_directory_uri().'/assets/js/bootstrap-datepicker.js', array( 'jquery' ), '2.0', true );
	
	wp_enqueue_script( 'jquery-dataTables', get_template_directory_uri().'/assets/js/jquery-dataTables-min.js', array( 'jquery' ), '1.12.1', true );
	
	wp_enqueue_script( 'dataTables-bootstrap5', get_template_directory_uri().'/assets/js/dataTables-bootstrap5-min.js', array( 'jquery' ), '1.12.1', true );
	wp_enqueue_script( 'chart', get_template_directory_uri().'/assets/js/chart.js', array( 'jquery' ), '3.8.0', true );
	wp_enqueue_script( 'anm', get_template_directory_uri().'/assets/js/anm.js', array( 'jquery' ), '1.0', true ); 
	
	wp_enqueue_script( 'jobzilla-custom', get_template_directory_uri().'/assets/js/custom-min.js', array( 'jquery' ), '1.0', true );
	wp_enqueue_script( 'jobzilla-dz-wpjm-script', get_template_directory_uri().'/assets/js/dz-wpjm-script-min.js', array(), '1.0', true );
	wp_enqueue_script( 'jobzilla-wp-script', get_template_directory_uri().'/assets/js/wp-script-min.js', array('jquery'), '1.0', true );
	wp_enqueue_script( 'jobzilla-dz-carousel', get_template_directory_uri().'/assets/js/dz-carousel-min.js', array( 'jquery' ), '1.0', true );
	
	if( is_singular() ) wp_enqueue_script('comment-reply');	
	
}

add_action( 'wp_enqueue_scripts', 'jobzilla_enqueue_scripts' );

/*--------------------------------------------------------------*/


/**
 * Enqueue Scripts on plugin
 */
add_action('admin_enqueue_scripts', 'jobzilla_admin_script');

/**
 * Function register admin on plugin
 */
function jobzilla_admin_script()
{
	if(is_admin()) {
		wp_enqueue_style('admin-style', get_template_directory_uri() . '/dz-inc/admin/css/admin.css', array(), '1.0.0');
		wp_enqueue_style('admin-font-awesome', get_template_directory_uri() . '/dz-inc/admin/css/font-awesome-min.css', array(), '4.7.0');
		
	}

}

function jobzilla_theme_slug_fonts_url() {
    $fonts_url = '';
    /* Translators: If there are characters in your language that are not
    * supported by Lora, translate this to 'off'. Do not translate
    * into your own language.
    */
	$Montserrat = _x( 'on', 'Montserrat font: on or off', 'jobzilla' );
	$Poppins = _x( 'on', 'Poppins font: on or off', 'jobzilla' );
	$Noto_Sans = _x( 'on', 'Noto Sans font: on or off', 'jobzilla' );
	$Oswald = _x( 'on', 'Oswald font: on or off', 'jobzilla' );
	$Rubik = _x( 'on', 'Rubik font: on or off', 'jobzilla' );
   
	$font_families = array();
	
     if ( 'off' !== $Montserrat ) {
 	$font_families[] = 'Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900';
	}	
	if ( 'off' !== $Poppins ) {
	 	$font_families[] = '&family=Poppins:wght@100;200;300;400;500;600;700;800;900';
	}
	if ( 'off' !== $Noto_Sans ) {
		$font_families[] = '&family=Noto+Sans:wght@400;700';
	}
	if ( 'off' !== $Oswald ) {
		$font_families[] = '&family=Oswald:wght@200;300;400;500;600;700';
	}
	if ( 'off' !== $Rubik ) {
		$font_families[] = '&family=Rubik:wght@200;300;400;500;600;700;800;900';
	}
	
	$font_families = array_unique( $font_families);
    
	$font_url_string = '';
	foreach($font_families as $font_family){
		$font_url_string .= $font_family;
	}
	
	$query_args = array(
	  'family' =>$font_url_string,
	  'display' => 'swap',
	);

    $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css2');
	
    return esc_url_raw( $fonts_url );
}

function jobzilla_theme_slug_scripts_styles() {
    wp_enqueue_style( 'jobzilla-theme-slug-fonts', jobzilla_theme_slug_fonts_url(), array(), null );
}
add_action( 'wp_enqueue_scripts', 'jobzilla_theme_slug_scripts_styles' );

function jobzilla_add_editor_styles() {
    add_editor_style( 'custom-editor-style.css' );
}
add_action( 'admin_init', 'jobzilla_add_editor_styles' );


function jobzilla_setup_theme_supported_features() {
    add_theme_support( 'editor-color-palette', array(
        array(
            'name' => esc_html__( 'strong magenta', 'jobzilla' ),
            'slug' => 'strong-magenta',
            'color' => '#a156b4',
        ),
        array(
            'name' => esc_html__( 'light grayish magenta', 'jobzilla' ),
            'slug' => 'light-grayish-magenta',
            'color' => '#d0a5db',
        ),
        array(
            'name' => esc_html__( 'very light gray', 'jobzilla' ),
            'slug' => 'very-light-gray',
            'color' => '#eee',
        ),
        array(
            'name' => esc_html__( 'very dark gray', 'jobzilla' ),
            'slug' => 'very-dark-gray',
            'color' => '#444',
        ),
    ) );
}

add_action( 'after_setup_theme', 'jobzilla_setup_theme_supported_features' );

/*js Template Path */
function jobzilla_set_js_var() {
   
   global $jobzilla_option;
   
   
	$theme_options = jobzilla_get_theme_option();

   $mobile_header_social_link_on = !empty($jobzilla_option['mobile_header_social_link_on']) ? $jobzilla_option['mobile_header_social_link_on'] : '';
   
   $cart_on_mobile = !empty($theme_options['cart_on_mobile']) ? $theme_options['cart_on_mobile'] : '';
   $mobile_header_login_on = !empty($theme_options['mobile_header_login_on']) ? $theme_options['mobile_header_login_on'] : '';
   $mobile_header_register_on = !empty($theme_options['mobile_header_register_on']) ? $theme_options['mobile_header_register_on'] : '';
	
	
	$cart_on_mobile					= ($cart_on_mobile)?'Yes':'No';
    $mobile_header_login_on			= ($mobile_header_login_on)?'Yes':'No';
    $mobile_header_register_on		= ($mobile_header_register_on)?'Yes':'No';
    $mobile_header_social_link_on	= ($mobile_header_social_link_on)?'Yes':'No';
	$header_style = $footer_style = $page_banner_layout = $skin = '';
	
	$map_type		= !empty($theme_options['map_type']) ? $theme_options['map_type'] : 'bing';
	$bing_mapkey	= !empty($theme_options['bing_mapkey']) ? $theme_options['bing_mapkey'] : '';
	$map_center_lat	= !empty($theme_options['map_center_lat']) ? $theme_options['map_center_lat'] : '52.2296756';
	$map_center_lon	= !empty($theme_options['map_center_lon']) ? $theme_options['map_center_lon'] : '21.012228700000037';
	$bing_maptypeid	= !empty($theme_options['bing_maptypeid']) ? $theme_options['bing_maptypeid'] : 'road';
	$bing_map_lang	= !empty($theme_options['bing_map_lang']) ? $theme_options['bing_map_lang'] : '';
	$bing_map_style	= !empty($theme_options['bing_map_style']) ? $theme_options['bing_map_style'] : '';
	$bing_map_customstyle	= !empty($theme_options['bing_map_customstyle']) ? $theme_options['bing_map_customstyle'] : '';
	$loc_icon		= !empty($theme_options['map_loc_icon']['id']) ? $theme_options['map_loc_icon']['url'] : '';
	$loc_icon_color	= !empty($theme_options['loc_icon_color']) ? $theme_options['loc_icon_color'] : '';
	
	
	
	
	$js_data_array = array(	'template_directory_uri' => get_template_directory_uri(),
							'admin_ajax_url' => admin_url( 'admin-ajax.php' ),								
							'ajax_security_nonce' => wp_create_nonce('ajax_security_key'),
							'cart_on_mobile'=>$cart_on_mobile,	
							'login_on_mobile'=>$mobile_header_login_on,	
							'register_on_mobile'=>$mobile_header_register_on,	
							'header_social_link_on_mobile'=>$mobile_header_social_link_on,
							'header_style'=>$header_style,
							'footer_style'=>$footer_style,
							'page_banner_layout'=>$page_banner_layout,
							'skin'=>$skin,
							'map_settings'=>array(
									'map_type'=>$map_type,
									'map_center_lat'=>$map_center_lat,
									'map_center_lon'=>$map_center_lon,
									'bing_mapkey'=>$bing_mapkey,
									'bing_maptypeid'=>$bing_maptypeid,
									'bing_map_lang'=>$bing_map_lang,
									'bing_map_style'=>$bing_map_style,
									'bing_map_customstyle'=>$bing_map_customstyle,
									'loc_icon'=>$loc_icon,
									'loc_icon_color'=>$loc_icon_color,
							)
						);						
	wp_localize_script( 'jquery', 'jobzilla_js_data', $js_data_array );
   
   if(class_exists('WP_Job_Manager_Ajax')){
		$ajax_url  = WP_Job_Manager_Ajax::get_endpoint();
		
		
		$wpjm_js_data = array(	
							'ajax_url' => $ajax_url,
						);

		wp_localize_script( 'jquery', 'jobzilla_wpjm_js_data', $wpjm_js_data );					
		
   }
   
   
}
add_action('wp_enqueue_scripts','jobzilla_set_js_var');

function jobzilla_load_admin_things() {
    wp_enqueue_script('media-upload');
    wp_enqueue_script('thickbox');
    wp_enqueue_style('thickbox');	
}
add_action( 'admin_enqueue_scripts', 'jobzilla_load_admin_things' );


function jobzilla_get_attachment( $attachment_id ) {
    $attachment = get_post( $attachment_id );
    return array(
        'alt' => get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
        'caption' => $attachment->post_excerpt,
        'description' => $attachment->post_content,
        'href' => get_permalink( $attachment->ID ),
        'src' => $attachment->guid,
        'title' => $attachment->post_title
    );
}

function jobzilla_website_status()
{
	$website_status   = jobzilla_get_opt('website_status');
	if($website_status == 'comingsoon_mode' && !is_user_logged_in()) {
		get_template_part('dz-inc/elements/comingsoon/comingsoon_1');
	}
	elseif($website_status == 'maintenance_mode' && !is_user_logged_in()) {
		get_template_part('dz-inc/elements/maintinance/maintinance_1');
	}
}
add_action('jobzilla_website_status', 'jobzilla_website_status');


/* Ensure cart contents update when products are added to the cart via AJAX (place the following in main functions.php) */
add_filter( 'woocommerce_add_to_cart_fragments', 'jobzilla_header_add_to_cart_fragment' );
function jobzilla_header_add_to_cart_fragment( $fragments ) 
{
	ob_start();
	?>
	<a class="btn btn-primary" href="<?php echo esc_url(wc_get_cart_url()); ?>" title="<?php echo esc_attr__( 'View your shopping cart','jobzilla'); ?>"><div class="cart-btn"><span class="badge cart-count"><?php echo sprintf (_n( '%d', '%d', WC()->cart->get_cart_contents_count(), 'jobzilla' ), WC()->cart->get_cart_contents_count() ); ?></span></div></a> 
	<?php
	
	$fragments['a.cart-btn'] = ob_get_clean();
	
	return $fragments;
}

/* Remove Paragraph from contact form 7 plugin fields */
add_filter('wpcf7_autop_or_not', '__return_false');






/*
 * Return Current Page ID
 */
function jobzilla_get_current_page_id() {
	$current_page = -1;
	
	if ( is_front_page() && is_home() ) {
		$page_for_posts = get_option( 'page_for_posts' );
		if( ! empty( $page_for_posts ) && $page_for_posts != -1 ) {
			$current_page = $page_for_posts;
		}
	} elseif ( is_front_page() ) {
		$page_id = get_option('page_on_front');
		if( ! empty( $page_id ) && $page_id != -1 ) {
			$current_page = $page_id;
		}
	} elseif ( is_home() ) {
		/* Blog page */
		$page_for_posts = get_option( 'page_for_posts' );
		if( ! empty( $page_for_posts ) && $page_for_posts != -1 ) {
			$current_page = $page_for_posts;
		}
	} elseif ( ( function_exists('is_projects_archive') && is_projects_archive() ) || ( function_exists('is_project_category') && is_project_category() ) ) {
		$projects_page_id = projects_get_page_id( 'projects' );
		if( ! empty( $projects_page_id ) && $projects_page_id != -1 ) {
			$current_page = projects_get_page_id( 'projects' );
		}
	} elseif( is_post_type_archive( 'team-member' ) ) {
		$team_member  = -1;
	} elseif( function_exists('is_shop') && is_shop() ) {
		$current_page = get_option( 'woocommerce_shop_page_id' );
	} elseif( function_exists('is_product_category') && is_product_category() ) {
		$current_page = get_option( 'woocommerce_shop_page_id' );
	} elseif( function_exists('is_product_tag') && is_product_tag() ) {
		$current_page = get_option( 'woocommerce_shop_page_id' );
	} elseif( function_exists( 'is_project' ) && is_project() ) {
		$current_page = get_the_ID();
	} elseif( is_404() ) {
		$current_page = -2;
	} elseif( is_page() ) {
		$current_page = get_the_ID();
	} elseif ( is_post_type_archive('post') ) {
		$page_for_posts = get_option( 'page_for_posts' );
		if( ! empty( $page_for_posts ) && $page_for_posts != -1 ) {
			$current_page = $page_for_posts;
		}
	}	
	return $current_page;
}
//Remove Gutenberg Block Library CSS from loading on the frontend
function jobzilla_remove_wp_block_library_css(){
 wp_dequeue_style( 'wp-block-library-theme' );
} 
add_action( 'wp_enqueue_scripts', 'jobzilla_remove_wp_block_library_css', 100 );

