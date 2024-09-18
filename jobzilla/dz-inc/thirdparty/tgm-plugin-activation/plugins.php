<?php
/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @see http://tgmpluginactivation.com/configuration/ for detailed documentation.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.6.1 for parent theme jobzilla for publication on ThemeForest
 * @author     Thomas Griffin, Gary Jones, Juliette Reinders Folmer
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 */

/**
 * Include the TGM_Plugin_Activation class.
 *
 * Depending on your implementation, you may want to change the include call:
 *
 * Parent Theme:
 * require_once get_template_directory() . '/path/to/class-tgm-plugin-activation.php';
 *
 * Child Theme:
 * require_once get_stylesheet_directory() . '/path/to/class-tgm-plugin-activation.php';
 *
 * Plugin:
 */
require_once get_template_directory() . '/dz-inc/thirdparty/tgm-plugin-activation/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'jobzilla_register_required_plugins' );

/**
 * Register the required plugins for this theme.
 *
 * In this example, we register five plugins:
 * - one included with the TGMPA library
 * - two from an external source, one from an arbitrary source, one from a GitHub repository
 * - two from the .org repo, where one demonstrates the use of the `is_callable` argument
 *
 * The variables passed to the `tgmpa()` function should be:
 * - an array of plugin arrays;
 * - optionally a configuration array.
 * If you are not changing anything in the configuration array, you can remove the array and remove the
 * variable from the function call: `tgmpa( $plugins );`.
 * In that case, the TGMPA default settings will be used.
 *
 * This function is hooked into `tgmpa_register`, which is fired on the WP `init` action on priority 10.
 */
function jobzilla_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		/* This is an example of how to include a plugin bundled with a theme. */
		array(
            'name'               => esc_html__('DZ Core (Required)', 'jobzilla'), /* The plugin name. */
            'slug'               => 'dzcore', /* The plugin slug (typically the folder name). */
            'source'             => 'https://jobzilla.wprdx.com/plugins/dzcore.zip', /* The plugin source. */
            'required'           => true, /* If false, the plugin is only 'recommended' instead of required. */
            'version'            => '1.0.0', /* E.g. 1.0.0. If set, the active plugin must be this version or higher. */
            'force_activation'   => false, /* If true, plugin is activated upon theme activation and cannot be deactivated until theme switch. */
            'force_deactivation' => false, /* If true, plugin is deactivated upon theme switch, useful for theme-specific plugins. */
            'external_url'       => '', /* If set, overrides default API URL and points to an external URL. */
        ),
		array(
			'name'     				=> esc_html__('DZ Import', 'jobzilla'),
			'slug'     				=> 'dzimport',
			'source'				=> 'https://jobzilla.wprdx.com/plugins/dzimport.zip',
			'required' 				=> true,
			'version' 				=> '1.0.0',
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
			'external_url' 			=> '',
		),	
		array(
			'name'     				=> esc_html__('WP Job Manager Applications', 'jobzilla'),
			'slug'     				=> 'wp-job-manager-applications',
			'source'				=> 'https://jobzilla.wprdx.com/plugins/wp-job-manager-applications.zip',
			'required' 				=> true,
			'version' 				=> '2.5.2',
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
			'external_url' 			=> '',
		),
		array(
			'name'     				=> esc_html__('WP Job Manager Bookmarks', 'jobzilla'),
			'slug'     				=> 'wp-job-manager-bookmarks',
			'source'				=> 'https://jobzilla.wprdx.com/plugins/wp-job-manager-bookmarks.zip',
			'required' 				=> true,
			'version' 				=> '1.4.2',
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
			'external_url' 			=> '',
		),
		array(
			'name'     				=> esc_html__('WP Job Manager Resumes', 'jobzilla'),
			'slug'     				=> 'wp-job-manager-resumes',
			'source'				=> 'https://jobzilla.wprdx.com/plugins/wp-job-manager-resumes.zip',
			'required' 				=> true,
			'version' 				=> '1.18.4',
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
			'external_url' 			=> '',
		),
		array(
			'name'     				=> esc_html__('WP Job Manager Tags', 'jobzilla'),
			'slug'     				=> 'wp-job-manager-tags',
			'source'				=> 'https://jobzilla.wprdx.com/plugins/wp-job-manager-tags.zip',
			'required' 				=> true,
			'version' 				=> '1.4.2',
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
			'external_url' 			=> '',
		),
		array(
			'name'     				=> esc_html__('MAS Wp Job Manager Company', 'jobzilla'),
			'slug'     				=> 'mas-wp-job-manager-company',
			'source'				=> 'https://jobzilla.wprdx.com/plugins/mas-wp-job-manager-company.zip',
			'required' 				=> true,
			'version' 				=> '1.0.6',
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
			'external_url' 			=> '',
		),
		array(
			'name'     				=> esc_html__('WP Job Manager Wc Paid Listings', 'jobzilla'),
			'slug'     				=> 'wp-job-manager-wc-paid-listings',
			'source'				=> 'https://jobzilla.wprdx.com/plugins/wp-job-manager-wc-paid-listings.zip',
			'required' 				=> true,
			'version' 				=> '2.9.4',
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
			'external_url' 			=> '',
		),
		
		array(
			'name'     				=> esc_html__(' WP Job Manager Application Deadline', 'jobzilla'),
			'slug'     				=> 'wp-job-manager-application-deadline',
			'source'				=> 'https://jobzilla.wprdx.com/plugins/wp-job-manager-application-deadline.zip',
			'required' 				=> true,
			'version' 				=> '1.2.5',
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
			'external_url' 			=> '',
		),
		array(
			'name'     				=> esc_html__(' DZ Mega Menu', 'jobzilla'),
			'slug'     				=> 'dz-mega-menu',
			'source'				=> 'https://jobzilla.wprdx.com/plugins/dz-mega-menu.zip',
			'required' 				=> true,
			'version' 				=> '1.0.0',
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
			'external_url' 			=> '',
		),
		array(
			'name'     				=> esc_html__(' DZ User Message', 'jobzilla'),
			'slug'     				=> 'dz-user-message',
			'source'				=> 'https://jobzilla.wprdx.com/plugins/dz-user-message.zip',
			'required' 				=> true,
			'version' 				=> '1.0.0',
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
			'external_url' 			=> '',
		),
		array(
			'name'     				=> esc_html__(' WP Job Manager Alerts', 'jobzilla'),
			'slug'     				=> 'wp-job-manager-alerts',
			'source'				=> 'https://jobzilla.wprdx.com/plugins/wp-job-manager-alerts.zip',
			'required' 				=> true,
			'version' 				=> '1.5.4',
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
			'external_url' 			=> '',
		),
		array(
			'name'     				=> esc_html__('MAS Wp Job Manager Company Reviews', 'jobzilla'),
			'slug'     				=> 'mas-wp-job-manager-company-reviews',
			'source'				=> 'https://jobzilla.wprdx.com/plugins/mas-wp-job-manager-company-reviews.zip',
			'required' 				=> true,
			
		),
		array(
			'name'     				=> esc_html__('MAS Wp Job Manager Company', 'jobzilla'),
			'slug'     				=> 'mas-wp-job-manager-company',
			'source'				=> 'https://jobzilla.wprdx.com/plugins/mas-wp-job-manager-company.zip',
			'required' 				=> true,
			
			
		),
		array(
			'name'     				=> esc_html__('WP Job Manager Locations', 'jobzilla'),
			'slug'     				=> 'wp-job-manager-locations',
			'source'				=> 'https://jobzilla.wprdx.com/plugins/wp-job-manager-locations.zip',
			'required' 				=> true,
			
		),
	
		array(
			'name'     				=> esc_html__('Elementor', 'jobzilla'),
			'slug'     				=> 'elementor',
			'required' 				=> true,
		),
		
        array(
		    'name'         			=> esc_html__('Redux-Framework', 'jobzilla'),
		    'slug'         			=> 'redux-framework',
		    'required'     			=> true,
		),
		
		array(
		    'name'         			=> esc_html__('Contact Form 7', 'jobzilla'),
		    'slug'         			=> 'contact-form-7',
		    'required'    			=> true,
		),		

		array(
			'name'     				=> esc_html__('Woocommerce', 'jobzilla'),
			'slug'     				=> 'woocommerce',
			'required' 				=> true,
		),
		array(
			'name'     				=> esc_html__('WP Job Manager', 'jobzilla'),
			'slug'     				=> 'wp-job-manager',
			'required' 				=> true,
		),
		
	);

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'           => 'jobzilla',                 /* Unique ID for hashing notices for multiple instances of TGMPA. */
		'default_path' => '',                      /* Default absolute path to bundled plugins. */
		'menu'         => 'tgmpa-install-plugins', /* Menu slug. */
		'has_notices'  => true,                    /* Show admin notices or not. */
		'dismissable'  => true,                    /* If false, a user cannot dismiss the nag message. */
		'dismiss_msg'  => '',                      /* If 'dismissable' is false, this message will be output at top of nag. */
		'is_automatic' => false,                   /* Automatically activate plugins after installation or not. */
		'message'      => '',                      /* Message to output right before the plugins table. */
	);

	tgmpa( $plugins, $config );
}