<?php


if (class_exists('WP_Job_Manager')) {
	/* WP Job Manager Plugin Hooks */
	include_once get_template_directory() . '/dz-inc/library/wp-job-manager/job_manager.php';
	include_once get_template_directory() . '/dz-inc/library/wp-job-manager/job-salary-filter.php';
	include_once get_template_directory() . '/dz-inc/library/wp-job-manager/functions.php';
}

if (class_exists('MAS_WPJMC_Shortcode')) {
	/* WP Job Manager company Plugin Hooks */
	include_once get_template_directory() . '/dz-inc/library/wp-job-manager/mas-wp-job-manager-company.php';
}

if (class_exists('WP_Resume_Manager_Shortcodes')) {
	/* WP Job Manager company Plugin Hooks */
	include_once get_template_directory() . '/dz-inc/library/wp-job-manager/wp-job-manager-resumes.php';
}
if (function_exists('get_job_application_default_form_fields')) {
	/* WP Job Manager company Plugin Hooks */
	include_once get_template_directory() . '/dz-inc/library/wp-job-manager/wp-job-manager-applications.php';
}