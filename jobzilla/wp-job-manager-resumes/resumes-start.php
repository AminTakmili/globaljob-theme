<?php
/**
 * Content that is shown at the beginning of a resume list.
 *
 * This template can be overridden by copying it to yourtheme/wp-job-manager-resumes/resumes-start.php.
 *
 * @see         https://wpjobmanager.com/document/template-overrides/
 * @author      Automattic
 * @package     wp-job-manager-resumes
 * @category    Template
 * @version     1.8.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if($list_layout == 'grid'){
	$layout_class = "twm-candidates-grid-wrap";
}else{
	$layout_class = "twm-candidates-list-wrap";
}

if(!empty($resume_filter_view) && $resume_filter_view == 'sidebar'){
	$col_class =  'col-lg-8 col-md-12';  
}else{
	$col_class = 'col-lg-12 col-md-12';
}

?>

        <div class="<?php echo esc_attr($col_class); ?>"> 
			<div class="<?php echo esc_attr($layout_class); ?>">		
				<div class="row resumes">
