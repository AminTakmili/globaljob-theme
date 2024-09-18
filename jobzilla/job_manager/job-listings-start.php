<?php
/**
 * Content shown before job listings in `[jobs]` shortcode.
 *
 * This template can be overridden by copying it to yourtheme/job_manager/job-listings-start.php.
 *
 * @see         https://wpjobmanager.com/document/template-overrides/
 * @author      Automattic
 * @package     wp-job-manager
 * @category    Template
 * @version     1.15.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if(!empty($job_filter_view) && $job_filter_view == 'sidebar'){
	$col_lg_class = 'col-lg-8 col-md-12';
	
}else{
	$col_lg_class = 'col-lg-12 col-md-12';
}
$job_grids = $list_layout == 'grid' ? 'job_grids': '';
?>	
	<div class="<?php echo esc_attr($col_lg_class); ?>">
		<div class="twm-jobs-list-wrap">
			<div class="row job_listings <?php echo esc_attr($job_grids); ?>">
				
		