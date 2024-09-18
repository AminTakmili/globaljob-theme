<?php 
	jobzilla_bunch_global_variable();
	$jobzilla_option = getDZThemeReduxOption();
	$website_status = !empty($jobzilla_option['website_status']) ? $jobzilla_option['website_status'] : '';
	$site_favicon   = !empty($jobzilla_option['site_favicon']) ? $jobzilla_option['site_favicon'] : '';
	$header_style   = !empty($jobzilla_option['header_style']) ? $jobzilla_option['header_style'] : '';
	$preload   		= jobzilla_get_opt('preload_image');
	
	
	$animation_class = '';
	if(is_page('home4')){
		$animation_class = 'data-anm=.anm';
	}else if(is_page('home6')){
		$animation_class = 'data-anm=.anm';
	}
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
			<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
			<?php if(!empty($preload['url'])){ ?>
			<link rel="preload" href="<?php echo esc_url($preload['url']); ?>" as="image" type="text/css">
			<?php }
			wp_head(); ?>
		</head>

		<body id="bg"  <?php echo esc_attr($animation_class.' '); 
		body_class();  jobzilla_body_layout_style(); ?> >
		
		<?php 
			wp_body_open(); 		
			do_action( 'jobzilla_subscription'); 
		?>
		
			<div  class="page-wraper">		
				<?php 
					if(isWebsiteReadyForVisitor($website_status)){
						/* Pre-loader */
						jobzilla_get_loader();
						/* Pre-loader END */
						
						if(!empty($header_style)) 
						{
							get_template_part('dz-inc/elements/header/'.$header_style);
						}
					}
				?>

				<div class="page-content bg-white">

				<?php
					do_action('jobzilla_website_status');