<?php 
jobzilla_bunch_global_variable();

$jobzilla_option = getDZThemeReduxOption();
$site_favicon   = !empty($jobzilla_option['site_favicon']) ? $jobzilla_option['site_favicon'] : '';

?>
<!DOCTYPE html>
<html <?php language_attributes(); theme_direction(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<?php if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ){ ?>
	<link rel="shortcut icon" href="<?php echo esc_url($site_favicon);?>" type="image/x-icon">
	<link rel="icon" href="<?php echo esc_url($site_favicon);?>" type="image/x-icon">
<?php } ?>

<!-- Responsive -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<!-- MOBILE SPECIFIC -->
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

<?php wp_head(); ?>
</head>
<body id="bg" <?php body_class(); ?>>
<?php wp_body_open(); 
	
	do_action( 'jobzilla_subscription'); 
	
	?>
	<div  class="page-wraper">
		<div class="page-content bg-white">	
<?php

do_action('jobzilla_website_status');

