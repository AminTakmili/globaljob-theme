<?php 
    jobzilla_bunch_global_variable();
    $jobzilla_option = getDZThemeReduxOption();
    $site_favicon   = !empty($jobzilla_option['site_favicon']) ? $jobzilla_option['site_favicon'] : '';
?>

<!DOCTYPE html>
	<html <?php language_attributes(); theme_direction(); ?>>
		<head>
			<!-- META -->
			<meta charset="<?php bloginfo( 'charset' ); ?>">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">   
			<!-- MOBILE SPECIFIC -->
			<meta name="viewport" content="width=device-width, initial-scale=1">
    
			<!-- FAVICONS ICON -->
			<?php if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ){ ?>
				<link rel="shortcut icon" href="<?php echo esc_url($site_favicon);?>" type="image/x-icon">
				<link rel="icon" href="<?php echo esc_url($site_favicon);?>" type="image/x-icon">
			<?php } ?>  
 
			<?php wp_head(); ?>
		</head>

		<body id="bg" <?php body_class('user-login');  jobzilla_body_layout_style(); ?> >

		    
		
		<div class="page-wraper">
		