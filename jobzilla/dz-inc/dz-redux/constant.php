<?php

/* Single Pages Template */
function jobzilla_page_template_options(){
	
	$page_templates = array(
		'landing' => array(
			array(
				'title' => esc_html__('Jobzilla Home 1','jobzilla'),
				'id'   => 'landing_style_1',
				'img'   => get_template_directory_uri() . '/dz-inc/assets/images/page-template/landing_style_1.png',
				'param'  => array()
			),
			array(
				'title' => esc_html__('Jobzilla Home 2','jobzilla'),
				'id'   => 'landing_style_2',
				'img'   => get_template_directory_uri() . '/dz-inc/assets/images/page-template/landing_style_2.png',
				'param'  => array()
			),
			array(
				'title' => esc_html__('Jobzilla Home 3','jobzilla'),
				'id'   => 'landing_style_3',
				'img'   => get_template_directory_uri() . '/dz-inc/assets/images/page-template/landing_style_3.png',
				'param'  => array()
			),
			array(
				'title' => esc_html__('Jobzilla Home 4','jobzilla'),
				'id'   => 'landing_style_4',
				'img'   => get_template_directory_uri() . '/dz-inc/assets/images/page-template/landing_style_4.png',
				'param'  => array()
			),
			
		),
		'inner' => array(
			
		),
		'coming' => array(
			array(
				'title' => esc_html__('Comingsoon','jobzilla'),
				'id'   => 'coming_style_1',
				'img'   => get_template_directory_uri() . '/dz-inc/assets/images/page-template/coming-soon.png',
				'param'  => array()
			)
		),
		'maintenance' => array(
			array(
				'title' => esc_html__('Maintenance','jobzilla'),
				'id'   	=> 'maintenance_style_1',
				'img'   => get_template_directory_uri() . '/dz-inc/assets/images/page-template/site-down-for-maintain.png',
				'param'  => array()
			),
		),
		'error' => array(
			array(
				'title' => esc_html__('Error','jobzilla'),
				'id'   => 'error_style_1',
				'img'   => get_template_directory_uri() . '/dz-inc/assets/images/page-template/error-404.png',
				'param'  => array()
			)
		)
	);
	return $page_templates;
}

/* Single Post Layouts */
function jobzilla_post_layouts_options(){

	$post_layouts = array(
		array(
			'id'   => 'standard',
			'layout_param' => array(
		    	'title' => esc_html__('Standard','jobzilla'),
		    	'img' => get_template_directory_uri() . '/dz-inc/assets/images/post-layout/standard-post.png'
		    ),
			'param'  => array()
		),
		array(
			'id'   => 'gutenberg',
			'layout_param' => array(
		    	'title' => esc_html__('Gutenberg','jobzilla'),
		    	'img' => get_template_directory_uri() . '/dz-inc/assets/images/post-layout/gutenberg.png'
		    ),
			'param'  => array()
		),
		array(
			'id'   => 'corner_post',
			'layout_param' => array(
		    	'title' => esc_html__('Corner Post','jobzilla'),
		    	'img' => get_template_directory_uri() . '/dz-inc/assets/images/post-layout/corner-image-post.png'
		    ),
			'param'  => array()
		),
		array(
			'id'   => 'post_header_image',
			'layout_param' => array(
		    	'title' => esc_html__('Header Image','jobzilla'),
		    	'img' => get_template_directory_uri() . '/dz-inc/assets/images/post-layout/post-header-image.png'
		    ),
			'param'  => array()
		),
		array(
			'id'   => 'slider_post_2',
			'layout_param' => array(
		    	'title' => esc_html__('Slider Post 2','jobzilla'),
		    	'img' => get_template_directory_uri() . '/dz-inc/assets/images/post-layout/slider-post-2.png'
		    ),
			'param'  => array()
		),
		array(
			'id'   => 'link_post',
			'layout_param' => array(
		    	'title' => esc_html__('Link Post','jobzilla'),
		    	'img' => get_template_directory_uri() . '/dz-inc/assets/images/post-layout/link-post.png'
		    ),
			'param'  => array()
		),
		array(
			'id'   => 'video_post',
			'layout_param' => array(
		    	'title' => esc_html__('Video Post','jobzilla'),
		    	'img' => get_template_directory_uri() . '/dz-inc/assets/images/post-layout/video-post.png'
		    ),
			'param'  => array()
		),
		array(
			'id'   => 'audio_post',
			'layout_param' => array(
		    	'title' => esc_html__('Audio Post','jobzilla'),
		    	'img' => get_template_directory_uri() . '/dz-inc/assets/images/post-layout/audio-post.png'
		    ),
			'param'  => array()
		),
		array(
			'id'   => 'slider_post_1',
			'layout_param' => array(
		    	'title' => esc_html__('Slider Post 1','jobzilla'),
		    	'img' => get_template_directory_uri() . '/dz-inc/assets/images/post-layout/slider-post-1.png'
		    ),
			'param'  => array()
		),
	);

	return $post_layouts;
}

/* Header Layouts Options */
function jobzilla_header_style_options(){
	$header_styles = array(
		array(
			'id'   => 'header_1',
			'img_param' => array(
				'title' => esc_html__('Style - Transparent','jobzilla'),
				'img'   => get_template_directory_uri() . '/dz-inc/assets/images/header/header-1.png'
			),
			'param'  => array(
				'class' => '',
				'social_link' => 1,
				'search' => 1,
				'call_to_action_button' => 0,
				'social_links' => 6,
				'top_bar' => 0,
				'informative_fields_header'	=> 0
			)
		),
		array(
			'id'   => 'header_2',
			'img_param' => array(
				'title' => esc_html__('Style - Transparent Header','jobzilla'),
				'img'   => get_template_directory_uri() . '/dz-inc/assets/images/header/header-2.png'
			),
			'param'  => array(
				'class' => '',
				'social_link' => 0,
				'search' => 1,
				'call_to_action_button' => 0,
				'social_links' => 6,
				'top_bar' => 0,
				'informative_fields_header'	=> 0
			)
		),
		array(
			'id'   => 'header_3',
			'img_param' => array(
				'title' => esc_html__('Style - Normal','jobzilla'),
				'img'   => get_template_directory_uri() . '/dz-inc/assets/images/header/header-3.png'
			),
			'param'  => array(
				'class' => '',
				'social_link' => 1,
				'search' => 1,
				'call_to_action_button' => 0,
				'social_links' => 6,
				'top_bar' => 0,
				'informative_fields_header'	=> 0
			)
		),
		array(
			'id'   => 'header_4',
			'img_param' => array(
				'title' => esc_html__('Style - Transparent For Container','jobzilla'),
				'img'   => get_template_directory_uri() . '/dz-inc/assets/images/header/header-4.png'
			),
			'param'  => array(
				'class' => '',
				'social_link' => 1,
				'search' => 1,
				'call_to_action_button' => 0,
				'social_links' => 6,
				'top_bar' => 0,
				'informative_fields_header'	=> 0
			)
		),

		array(
			'id'   => 'header_5',
			'img_param' => array(
				'title' => esc_html__('Style - Normal For Container','jobzilla'),
				'img'   => get_template_directory_uri() . '/dz-inc/assets/images/header/header-5.png'
			),
			'param'  => array(
				'class' => '',
				'social_link' => 1,
				'search' => 1,
				'call_to_action_button' => 0,
				'social_links' => 6,
				'top_bar' => 0,
				'informative_fields_header'	=> 0
			)
		),
		array(
			'id'   => 'header_6',
			'img_param' => array(
				'title' => esc_html__('Side Header','jobzilla'),
				'img'   => get_template_directory_uri() . '/dz-inc/assets/images/header/header-6.png'
			),
			'param'  => array(
				'class' => '',
				'social_link' => 1,
				'search' => 1,
				'call_to_action_button' => 0,
				'social_links' => 6,
				'top_bar' => 0,
				'informative_fields_header'	=> 0
			)
		),
		
	);

	return $header_styles;
}
/* Footer Layouts Options */
function jobzilla_footer_style_options(){
	$footer_styles = array(
		array(
			'id'   => 'footer_template_1',
			'img_param' => array(
				'title' => esc_html__('Footer 1','jobzilla'),
				'img'   => get_template_directory_uri() . '/dz-inc/assets/images/footer/footer-1.png',
			),
			'param'  => array(
				'social_link' => 1,
				'copyright'	=> 1,
				'powered_by'	=> 0,
				'sections'	=> 1,
				'bg_image'	=> 1,
				'informative_field'	=> 0,
			)
		),
		array(
			'id'   => 'footer_template_2',
			'img_param' => array(
				'title' => esc_html__('Footer 2','jobzilla'),
				'img'   => get_template_directory_uri() . '/dz-inc/assets/images/footer/footer-2.png',
			),
			'param'  => array(
				'social_link' => 1,
				'copyright'	=> 1,
				'powered_by'	=> 0,
				'sections'	=> 1,
				'bg_image'	=> 1,
				'informative_field'	=> 0,
			)
		),

		array(
			'id'   => 'footer_template_3',
			'img_param' => array(
				'title' => esc_html__('Footer 3','jobzilla'),
				'img'   => get_template_directory_uri() . '/dz-inc/assets/images/footer/footer-3.png',
			),
			
			'param'  => array(
				'social_link' => 1,
				'copyright'	=> 1,
				'powered_by'	=> 0,
				'sections'	=> 1,
				'bg_image'	=> 1,
				'informative_field'	=> 0,
			)
		),
		
		array(
			
			'id'   => 'footer_template_4',
			'img_param' => array(
				'title' => esc_html__('Dark Footer','jobzilla'),
				'img'   => get_template_directory_uri() . '/dz-inc/assets/images/footer/footer-4.png',
			),
			'param'  => array(
				'social_link' => 1,
				'copyright'	=> 1,
				'powered_by'	=> 0,
				'sections'	=> 1,
				'bg_image'	=> 1,
				'informative_field'	=> 0,
			)
		),
		
	);

	return $footer_styles;
}

/* Sidebar Layouts Options*/
function jobzilla_sidebar_layout_options(){

	$sidebar_layout = array(
		array(
			'id' => 'full',
			'sidebar_param' => array(
				'title' => esc_html__('Full Width','jobzilla'),
				'img' 	=> get_template_directory_uri() . '/dz-inc/assets/images/sidebar/sidebar-full.png'),
			'param'  => array()
		),
		array(
			'id' => 'left',
			'sidebar_param' => array(
				'title' => esc_html__('Left Side','jobzilla'),
				'img' 	=> get_template_directory_uri() . '/dz-inc/assets/images/sidebar/sidebar-left.png'),
			'param'  => array()
		),
		array(
			'id' => 'right',
			'sidebar_param' => array(
				'title' => esc_html__('Right Side','jobzilla'),
				'img' 	=> get_template_directory_uri() . '/dz-inc/assets/images/sidebar/sidebar-right.png'),
			'param'  => array()
		)
	);

	return $sidebar_layout;
}

/* Post Box/Wrapper Style Options */
function jobzilla_post_wrapper_options(){
	
	$post_wrapper_layout = array(
		array(
			'id'   => 'post_box_1',
			'img_param' =>  array(
				'title' => esc_html__('Post Box 1','jobzilla'),
				'img'   => get_template_directory_uri() . '/dz-inc/assets/images/post-box/box-1.png'
			),
			'param'  => array()
		),
		array(
			'id'   => 'post_box_2',
			'img_param' =>  array(
				'title' => esc_html__('Post Box 2','jobzilla'),
				'img'   => get_template_directory_uri() . '/dz-inc/assets/images/post-box/box-2.png'
			),
			'param'  => array()
		),
		array(
			'id'   => 'post_box_3',
			'img_param' =>  array(
				'title' => esc_html__('Post Box 3','jobzilla'),
				'img'   => get_template_directory_uri() . '/dz-inc/assets/images/post-box/box-3.png'
			),
			'param'  => array()
		),
		array(
			'id'   => 'post_box_4',
			'img_param' =>  array(
				'title' => esc_html__('Post Box 4','jobzilla'),
				'img'   => get_template_directory_uri() . '/dz-inc/assets/images/post-box/box-4.png'
			),
			'param'  => array()
		),
		array(
			'id'   => 'post_box_5',
			'img_param' =>  array(
				'title' => esc_html__('Post Box 5','jobzilla'),
				'img'   => get_template_directory_uri() . '/dz-inc/assets/images/post-box/box-5.png'
			),
			'param'  => array()
		),
		array(
			'id'   => 'post_box_6',
			'img_param' =>  array(
				'title' => esc_html__('Post Box 6','jobzilla'),
				'img'   => get_template_directory_uri() . '/dz-inc/assets/images/post-box/box-6.png'
			),
			'param'  => array()
		),
		array(
			'id'   => 'post_box_7',
			'img_param' =>  array(
				'title' => esc_html__('Post Box 7','jobzilla'),
				'img'   => get_template_directory_uri() . '/dz-inc/assets/images/post-box/box-7.png'
			),
			'param'  => array()
		),
		array(
			'id'   => 'post_box_8',
			'img_param' =>  array(
				'title' => esc_html__('Post Box 8','jobzilla'),
				'img'   => get_template_directory_uri() . '/dz-inc/assets/images/post-box/box-8.png'
			),
			'param'  => array()
		),
		array(
			'id'   => 'post_box_9',
			'img_param' =>  array(
				'title' => esc_html__('Post Box 9','jobzilla'),
				'img'   => get_template_directory_uri() . '/dz-inc/assets/images/post-box/box-9.png'
			),
			'param'  => array()
		),
		array(
			'id'   => 'post_box_10',
			'img_param' =>  array(
				'title' => esc_html__('Post Box 10','jobzilla'),
				'img'   => get_template_directory_uri() . '/dz-inc/assets/images/post-box/box-10.png'
			),
			'param'  => array()
		)
	);

	return $post_wrapper_layout;
}

/* Post Listing Style Options */
function jobzilla_post_listing_options(){
	// post listing/collage style
	$post_listing_layout = array(
		array(
			'id'   => 'post_listing_1',
			'listing_param' =>  array(
				'title' => esc_html__('Post Listing 1','jobzilla'),
				'img'   => get_template_directory_uri() . '/dz-inc/assets/images/post-listing/layout-1.png'),
			'param'  => array()
		),
		array(
			'id'   => 'post_listing_2',
			'listing_param' => array(
				'title' => esc_html__('Post Listing 2','jobzilla'),
				'img'   => get_template_directory_uri() . '/dz-inc/assets/images/post-listing/layout-2.png'),
			'param'  => array()
		),
		array(
			'id'   => 'team_listing_1',
			'listing_param' =>  array(
				'title' => esc_html__('Team Listing 1','jobzilla'),
				'img'   => get_template_directory_uri() . '/dz-inc/assets/images/post-listing/layout-3.png'),
			'param'  => array()
		),
		array(
			'id'   => 'portfolio_listing_1',
			'listing_param' =>  array(
				'title' => esc_html__('Portfolio Listing 1','jobzilla'),
				'img'   => get_template_directory_uri() . '/dz-inc/assets/images/post-listing/layout-4.png'),
			'param'  => array()
		),

		array(
			'id'   => 'service_listing_1',
			'listing_param' =>  array(
				'title' => esc_html__('Service Listing 1','jobzilla'),
				'img'   => get_template_directory_uri() . '/dz-inc/assets/images/post-listing/layout-5.png'),
			'param'  => array()
		)
	);

	return $post_listing_layout;
}

/* Post Tiles Style Options */
function jobzilla_post_tiles_options(){

	$post_tile_layout = array(
		array(
			'id'   => 'post_tile_1',
			'img_param' =>  array(
				'title' => esc_html__('Post Tile 1','jobzilla'),
				'img'   => get_template_directory_uri() . '/dz-inc/assets/images/post-tiles/post_tile-1.png'
			),
			'param'  => array()
		),
		array(
			'id'   => 'post_tile_2',
			'img_param' => array(
				'title' => esc_html__('Post Tile 2','jobzilla'),
				'img'   => get_template_directory_uri() . '/dz-inc/assets/images/post-tiles/post_tile-2.png'
			),
			'param'  => array()
		)
	);

	return $post_tile_layout;
}

/* Page Banner Style Options */
function jobzilla_page_banner_options(){
	$page_banner_style = array(
		array(
			'id'   => 'page_banner_big',
			'banner_param' => array(
		    	'title' => esc_html__('Fit to Screen','jobzilla'),
		    	'img' => get_template_directory_uri() . '/dz-inc/assets/images/page-banner/page-banner-big.png'
		    ),
			'param'  => array()
		),
		array(
			'id'   => 'page_banner_medium',
			'banner_param' => array(
		    	'title' => esc_html__('Banner Medium','jobzilla'),
		    	'img' => get_template_directory_uri() . '/dz-inc/assets/images/page-banner/page-banner-medium.png'
		    ),
			'param'  => array()
		),
		array(
			'id'   => 'page_banner_small',
			'banner_param' => array(
		    	'title' => esc_html__('Banner Small','jobzilla'),
		    	'img' => get_template_directory_uri() . '/dz-inc/assets/images/page-banner/page-banner-small.png'
		    ),
			'param'  => array()
		),
		array(
			'id'   => 'page_banner_custom',
			'banner_param' => array(
		    	'title' => esc_html__('Custom Height', 'jobzilla'),
		    	'img' => get_template_directory_uri() . '/dz-inc/assets/images/page-banner/page-banner-small.png'
		    ),
			'param'  => array()
		)
	);

	return $page_banner_style;
}

/* Post Tiles Style Options */

function jobzilla_post_banner_options(){
	$post_banners = array(
		array(
			'id'   => 'post_banner_v1',
			'post_banner_param' => array(
				'title' => esc_html__('Post Banner 1','jobzilla'),
				'img'   => get_template_directory_uri() . '/dz-inc/assets/images/post-banner/post-slider-v1.png'
			),
			'param'  => array(
				'limit' => array(2,5),
				'category' => true,
				'type' => array('all','featured', 'most-visited', 'most-liked'),
				'post_with' => array('all', 'images-only','without')
				)
		),
		array(
			'id'   => 'post_banner_v2',
			'post_banner_param' => array(
				'title' => esc_html__('Post Banner 2','jobzilla'),
				'img'   => get_template_directory_uri() . '/dz-inc/assets/images/post-banner/post-slider-v2.png'
			),
			'param'  => array(
				'limit' => array(3,12),
				'category' => true,
				'type' => array('all','featured', 'most-visited', 'most-liked'),
				'post_with' => array('all', 'images-only','without')
				)
		),
		array(
			'id'   => 'post_banner_v3',
			'post_banner_param' => array(
				'title' => esc_html__('Post Banner 3','jobzilla'),
				'img'   => get_template_directory_uri() . '/dz-inc/assets/images/post-banner/post-slider-v3.png'
			),
			'param'  => array(
				'limit' => array(3,12),
				'category' => true,
				'type' => array('all','featured', 'most-visited', 'most-liked'),
				'post_with' => array('all', 'images-only','without')
			)    
		)
	);

	return $post_banners;
}

/* Theme Layout Options */
function jobzilla_theme_layout_options(){
	$theme_layouts = array(
		array(
			'id'   => 'theme_layout_1',
			'img_param' => array(
				'title' => esc_html__('Full','jobzilla'),
				'img'   => get_template_directory_uri() . '/dz-inc/assets/images/theme-layout/full-width.png'
			),
			'param'  => array()
		),
		array(
			'id'   => 'theme_layout_2',
			'img_param' => array(
				'title' => esc_html__('Box','jobzilla'),
				'img'   => get_template_directory_uri() . '/dz-inc/assets/images/theme-layout/boxed.png'
			),
			'param'  => array()
		),
		array(
			'id'   => 'theme_layout_3',
			'img_param' => array(
				'title' => esc_html__('Frame','jobzilla'),
				'img'   => get_template_directory_uri() . '/dz-inc/assets/images/theme-layout/frame.png'
			),
			'param'  => array()
		)
	);

	return $theme_layouts;
}

/* Theme Color Background Options */
function jobzilla_theme_color_background_options(){
	$theme_color_background = array(
		array(
			'id'   => '#d37b46',
			'img_param' => array(
				'title' => esc_html__('Brown','jobzilla'),
				'img'   => get_template_directory_uri() . '/dz-inc/assets/images/bg-color/brown.png'
			),
			'param'  => array()      
		),
		array(
			'id'   => '#76c381',
			'img_param' => array(
				'title' => esc_html__('Green','jobzilla'),
				'img'   => get_template_directory_uri() . '/dz-inc/assets/images/bg-color/green.png'
			),
			'param'  => array()      
		),
		array(
			'id'   => '#e281ef',
			'img_param' => array(
				'title' => esc_html__('Pink','jobzilla'),
				'img'   => get_template_directory_uri() . '/dz-inc/assets/images/bg-color/pink.png'
			),
			'param'  => array()      
		),
		array(
			'id'   => '#fb4848',
			'img_param' => array(
				'title' => esc_html__('Red','jobzilla'),
				'img'   => get_template_directory_uri() . '/dz-inc/assets/images/bg-color/red.png'
			),
			'param'  => array()      
		),
		array(
			'id'   => '#008080',
			'img_param' => array(
				'title' => esc_html__('Cyan','jobzilla'),
				'img'   => get_template_directory_uri() . '/dz-inc/assets/images/bg-color/cyan.png'
			),
			'param'  => array()      
		),
		array(
			'id'   => '#f8ca00',
			'img_param' => array(
				'title' => esc_html__('Yellow','jobzilla'),
				'img'   => get_template_directory_uri() . '/dz-inc/assets/images/bg-color/yellow.png'
			),
			'param'  => array()      
		)
	);

	return $theme_color_background;
}

/* Theme Image Background Options */
function jobzilla_theme_image_background_options(){
	$theme_image_background = array(
		array(
			'id'   => 'bg_img_1',
			'img'   => get_template_directory_uri() . '/dz-inc/assets/images/bg-image/bg_img_1.jpg',
			'param'  => array()
		),
		array(
			'id'   => 'bg_img_2',
			'img'   => get_template_directory_uri() . '/dz-inc/assets/images/bg-image/bg_img_2.jpg',
			'param'  => array()
		),
		array(
			'id'   => 'bg_img_3',
			'img'   => get_template_directory_uri() . '/dz-inc/assets/images/bg-image/bg_img_3.jpg',
			'param'  => array()
		),
		array(
			'id'   => 'bg_img_4',
			'img'   => get_template_directory_uri() . '/dz-inc/assets/images/bg-image/bg_img_4.jpg',
			'param'  => array()
		),
		array(
			'id'   => 'bg_img_5',
			'img'   => get_template_directory_uri() . '/dz-inc/assets/images/bg-image/bg_img_5.jpg',
			'param'  => array()
		),
		array(
			'id'   => 'bg_img_6',
			'img'   => get_template_directory_uri() . '/dz-inc/assets/images/bg-image/bg_img_6.jpg',
			'param'  => array()
		),
		array(
			'id'   => 'bg_img_7',
			'img'   => get_template_directory_uri() . '/dz-inc/assets/images/bg-image/bg_img_7.jpg',
			'param'  => array()
		),
		array(
			'id'   => 'bg_img_8',
			'img'   => get_template_directory_uri() . '/dz-inc/assets/images/bg-image/bg_img_8.jpg',
			'param'  => array()
		),
	);

	return $theme_image_background;
}

/* Theme Pattern Background Options */
function jobzilla_theme_pattern_background_options(){
	$theme_pattern_background = array(
		array(
			'id'   => 'bg_pattern_1',
			'title' => esc_html__('Pattern Name 1','jobzilla'),
			'img'   => get_template_directory_uri() . '/dz-inc/assets/images/bg-pattern/bg_pattern_1.jpg',
			'param' => array()
		),
		array(
			'id'   => 'bg_pattern_2',
			'title' => esc_html__('Pattern Name 2','jobzilla'),
			'img'   => get_template_directory_uri() . '/dz-inc/assets/images/bg-pattern/bg_pattern_2.jpg',
			'param' => array()
		),
		array(
			'id'   => 'bg_pattern_3',
			'title' => esc_html__('Pattern Name 3','jobzilla'),
			'img'   => get_template_directory_uri() . '/dz-inc/assets/images/bg-pattern/bg_pattern_3.jpg',
			'param' => array()
		),
		array(
			'id'   => 'bg_pattern_4',
			'title' => esc_html__('Pattern Name 4','jobzilla'),
			'img'   => get_template_directory_uri() . '/dz-inc/assets/images/bg-pattern/bg_pattern_4.jpg',
			'param' => array()
		),
		array(
			'id'   => 'bg_pattern_5',
			'title' => esc_html__('Pattern Name 5','jobzilla'),
			'img'   => get_template_directory_uri() . '/dz-inc/assets/images/bg-pattern/bg_pattern_5.jpg',
			'param' => array()
		),
		array(
			'id'   => 'bg_pattern_6',
			'title' => esc_html__('Pattern Name 6','jobzilla'),
			'img'   => get_template_directory_uri() . '/dz-inc/assets/images/bg-pattern/bg_pattern_6.jpg',
			'param' => array()
		),
		array(
			'id'   => 'bg_pattern_7',
			'title' => esc_html__('Pattern Name 7','jobzilla'),
			'img'   => get_template_directory_uri() . '/dz-inc/assets/images/bg-pattern/bg_pattern_7.jpg',
			'param' => array()
		),
		array(
			'id'   => 'bg_pattern_8',
			'title' => esc_html__('Pattern Name 8','jobzilla'),
			'img'   => get_template_directory_uri() . '/dz-inc/assets/images/bg-pattern/bg_pattern_8.jpg',
			'param' => array()
		),
		array(
			'id'   => 'bg_pattern_9',
			'title' => esc_html__('Pattern Name 9','jobzilla'),
			'img'   => get_template_directory_uri() . '/dz-inc/assets/images/bg-pattern/bg_pattern_9.jpg',
			'param' => array()
		),
		array(
			'id'   => 'bg_pattern_10',
			'title' => esc_html__('Pattern Name 10','jobzilla'),
			'img'   => get_template_directory_uri() . '/dz-inc/assets/images/bg-pattern/bg_pattern_10.jpg',
			'param' => array()
		),
		array(
			'id'   => 'bg_pattern_11',
			'title' => esc_html__('Pattern Name 11','jobzilla'),
			'img'   => get_template_directory_uri() . '/dz-inc/assets/images/bg-pattern/bg_pattern_11.jpg',
			'param' => array()
		),
		array(
			'id'   => 'bg_pattern_12',
			'title' => esc_html__('Pattern Name 12','jobzilla'),
			'img'   => get_template_directory_uri() . '/dz-inc/assets/images/bg-pattern/bg_pattern_12.jpg',
			'param' => array()
		)
	);

	return $theme_pattern_background;
}

/* Page Loader Options */
function jobzilla_theme_color_options(){
	$theme_color = array(
		array(
			'id'   => 'orange',
			'layout_param'=>array(
				'title' => esc_html__('Standard Orange','jobzilla'),
				'img'   => get_template_directory_uri() . '/dz-inc/assets/images/skins/orange.png',
			),
			'color' => array( '#5f0ee1', '#decaff', '#ffffff', '#3f3f3f', '#666666' ),
			'param'  => array()
		),
		array(
			'id'   => 'green',
			'layout_param'=>array(
				'title' => esc_html__('Green','jobzilla'),
				'img'   => get_template_directory_uri() . '/dz-inc/assets/images/skins/green.png',
			),
			'color' => array( '#5f0ee1', '#decaff', '#ffffff', '#3f3f3f', '#666666' ),
			'param'  => array()
		),	
		array(
			'id'   => 'chocolate',
			'layout_param'=>array(
				'title' => esc_html__('Chocolate','jobzilla'),
				'img'   => get_template_directory_uri() . '/dz-inc/assets/images/skins/chocolate.png',
			),
			'color' => array( '#5f0ee1', '#decaff', '#ffffff', '#3f3f3f', '#666666' ),
			'param'  => array()
		),
		array(
			'id'   => 'yellow',
			'layout_param'=>array(
				'title' => esc_html__('Yellow','jobzilla'),
				'img'   => get_template_directory_uri() . '/dz-inc/assets/images/skins/yellow.png',
			),
			'color' => array( '#5f0ee1', '#decaff', '#ffffff', '#3f3f3f', '#666666' ),
			'param'  => array()
		),
		array(
			'id'   => 'red',
			'layout_param'=>array(
				'title' => esc_html__('Red','jobzilla'),
				'img'   => get_template_directory_uri() . '/dz-inc/assets/images/skins/red.png',
			),
			'color' => array( '#5f0ee1', '#decaff', '#ffffff', '#3f3f3f', '#666666' ),
			'param'  => array()
		),
		array(
			'id'   => 'sky-blue',
			'layout_param'=>array(
				'title' => esc_html__('Sky Blue','jobzilla'),
				'img'   => get_template_directory_uri() . '/dz-inc/assets/images/skins/sky-blue.png',
			),
			'color' => array( '#5f0ee1', '#decaff', '#ffffff', '#3f3f3f', '#666666' ),
			'param'  => array()
		),
		array(
			'id'   => 'dark-yellow',
			'layout_param'=>array(
				'title' => esc_html__('Dark Yellow','jobzilla'),
				'img'   => get_template_directory_uri() . '/dz-inc/assets/images/skins/dark-yellow.png',
			),
			'color' => array( '#5f0ee1', '#decaff', '#ffffff', '#3f3f3f', '#666666' ),
			'param'  => array()
		),
		array(
			'id'   => 'dark-green',
			'layout_param'=>array(
				'title' => esc_html__('Dark Green','jobzilla'),
				'img'   => get_template_directory_uri() . '/dz-inc/assets/images/skins/dark-green.png',
			),
			'color' => array( '#5f0ee1', '#decaff', '#ffffff', '#3f3f3f', '#666666' ),
			'param'  => array()
		),
		array(
			'id'   => 'brown',
			'layout_param'=>array(
				'title' => esc_html__('Brown','jobzilla'),
				'img'   => get_template_directory_uri() . '/dz-inc/assets/images/skins/brown.png',
			),
			'color' => array( '#5f0ee1', '#decaff', '#ffffff', '#3f3f3f', '#666666' ),
			'param'  => array()
		),
	);

	return $theme_color;
}

/* Page Loader Options */
function jobzilla_page_loader_options(){
	$page_loader = array(
		array(
			'title' => esc_html__('Loading 1','jobzilla'),
			'id'   => 'loading1',
			'img'   => get_template_directory_uri() . '/dz-inc/assets/images/loading-images/loading1.gif',
			'param'  => array()
		),
		array(
			'title' => esc_html__('Loading 2','jobzilla'),
			'id'   => 'loading2',
			'img'   => get_template_directory_uri() . '/dz-inc/assets/images/loading-images/loading2.svg',
			'param'  => array()
		),
		array(
			'title' => esc_html__('Loading 3','jobzilla'),
			'id'   => 'loading3',
			'img'   => get_template_directory_uri() . '/dz-inc/assets/images/loading-images/loading3.svg',
			'param'  => array()
		),
		array(
			'title' => esc_html__('Loading 4','jobzilla'),
			'id'   => 'loading4',
			'img'   => get_template_directory_uri() . '/dz-inc/assets/images/loading-images/loading4.svg',
			'param'  => array()
		),
		array(
			'title' => esc_html__('Loading 5','jobzilla'),
			'id'   => 'loading5',
			'img'   => get_template_directory_uri() . '/dz-inc/assets/images/loading-images/loading5.svg',
			'param'  => array()
		),
		array(
			'title' => esc_html__('Loading 6','jobzilla'),
			'id'   => 'loading6',
			'img'   => get_template_directory_uri() . '/dz-inc/assets/images/loading-images/loading6.svg',
			'param'  => array()
		)
	);

	return $page_loader;
}


/* Sorting Options */
function jobzilla_sort_by_options(){
	$sort_by = array(
		'date_asc'  => esc_html__('Date ASC', 'jobzilla'),
		'date_desc'  => esc_html__('Date DESC', 'jobzilla'),
		'title_asc'  => esc_html__('Title ASC', 'jobzilla'),
		'title_desc'  => esc_html__('Title DESC', 'jobzilla'),
		'most_visited'  => esc_html__('Most Visited', 'jobzilla'),
	);

	return $sort_by;
}

/* Button Link Target Options */
function jobzilla_link_target_options(){
	$link_target = array(
		'_blank' 	=>	esc_html__('Opens the link in a new tab.','jobzilla'),
		'_parent' 	=> 	esc_html__('Opens the link in the parent frame.','jobzilla'),
		'_self'		=>	esc_html__('Open the link in the current frame.','jobzilla'),
		'_top'		=>	esc_html__('Opens the link in the top-most frame.','jobzilla')
	);
	
	return $link_target;
}

/* Advertisement Banner Size Options */
function jobzilla_adsence_size_options(){
	$adsence_size = array(
		'auto' => esc_html__('Auto', 'jobzilla' ),
		'120 x 90' => esc_html__('120 x 90', 'jobzilla'),
		'120 x 240' => esc_html__('120 x 240', 'jobzilla'),
		'120 x 600' => esc_html__('120 x 600', 'jobzilla'),
		'125 x 125' => esc_html__('125 x 125', 'jobzilla'),
		'160 x 90' => esc_html__('160 x 90', 'jobzilla'),
		'160 x 600' => esc_html__('160 x 600', 'jobzilla'),
		'180 x 90' => esc_html__('180 x 90', 'jobzilla'),
		'180 x 150' => esc_html__('180 x 150', 'jobzilla'),
		'200 x 90' => esc_html__('200 x 90', 'jobzilla'),
		'200 x 200' => esc_html__('200 x 200', 'jobzilla'),
		'234 x 60' => esc_html__('234 x 60', 'jobzilla'),
		'250 x 250' => esc_html__('250 x 250', 'jobzilla'),
		'320 x 100' => esc_html__('320 x 100', 'jobzilla'),
		'300 x 250' => esc_html__('300 x 250', 'jobzilla'),
		'300 x 600' => esc_html__('300 x 600', 'jobzilla'),
		'300 x 1050' => esc_html__('300 x 1050', 'jobzilla'),
		'320 x 50' => esc_html__('320 x 50', 'jobzilla'),
		'336 x 280' => esc_html__('336 x 280', 'jobzilla'),
		'360 x 300' => esc_html__('360 x 300', 'jobzilla'),
		'435 x 300' => esc_html__('435 x 300', 'jobzilla'),
		'468 x 15' => esc_html__('468 x 15', 'jobzilla'),
		'468 x 60' => esc_html__('468 x 60', 'jobzilla'),
		'640 x 165' => esc_html__('640 x 165', 'jobzilla'),
		'640 x 190' => esc_html__('640 x 190', 'jobzilla'),
		'640 x 300' => esc_html__('640 x 300', 'jobzilla'),
		'728 x 15' => esc_html__('728 x 15', 'jobzilla'),
		'728 x 90' => esc_html__('728 x 90', 'jobzilla'),
		'970 x 90' => esc_html__('970 x 90', 'jobzilla'),
		'970 x 250' => esc_html__('970 x 250', 'jobzilla'),
		'240 x 400' => esc_html__('240 x 400 - Regional ad sizes', 'jobzilla'),
		'250 x 360' => esc_html__('250 x 360 - Regional ad sizes', 'jobzilla'),
		'580 x 400' => esc_html__('580 x 400 - Regional ad sizes', 'jobzilla'),
		'750 x 100' => esc_html__('750 x 100 - Regional ad sizes', 'jobzilla'),
		'750 x 200' => esc_html__('750 x 200 - Regional ad sizes', 'jobzilla'),
		'750 x 300' => esc_html__('750 x 300 - Regional ad sizes', 'jobzilla'),
		'980 x 120' => esc_html__('980 x 120 - Regional ad sizes', 'jobzilla'),
		'930 x 180' => esc_html__('930 x 180 - Regional ad sizes', 'jobzilla')
	);

	return $adsence_size;
}

/* Social Link Options */
function jobzilla_social_link_options(){
	
	$social_links = array(
	    'facebook' => array(
	        'id' => 'facebook',
	        'title' => esc_html__('Facebook', 'jobzilla'),
	    ),
	    'twitter' => array(
	        'id' => 'twitter',
	        'title' => esc_html__('Twitter', 'jobzilla'),
	    ),
	    'linkedin' => array(
	        'id' => 'linkedin',
	        'title' => esc_html__('Linkedin', 'jobzilla'),
	    ),
	     'instagram' => array(
	        'id' => 'instagram',
	        'title' => esc_html__('Instagram','jobzilla'),
	    ),
	    'behance' => array(
	        'id' => 'behance',
	        'title' => esc_html__('Behance','jobzilla'),
	    ), 
	    'skype' => array(
	        'id' => 'skype',
	        'title' => esc_html__('Skype','jobzilla'),
	    ), 
	    'pinterest' => array(
	        'id' => 'pinterest',
	        'title' => esc_html__('Pinterest','jobzilla'),
	    ),
	    'vimeo' => array(
	        'id' => 'vimeo',
	        'title' => esc_html__('Vimeo','jobzilla'),
	    ),
	    'youtube' => array(
	        'id' => 'youtube',
	        'title' => esc_html__('Youtube','jobzilla'),
	    ), 
	    'tumblr' => array(
	        'id' => 'tumblr',
	        'title' => esc_html__('Tumblr','jobzilla'),
	    ),
	     'rss' => array(
	        'id' => 'rss',
	        'title' => esc_html__('Rss','jobzilla'),
	    ), 
	    'yelp' => array(
	        'id' => 'yelp',
	        'title' => esc_html__('Yelp','jobzilla'),
	    ),
	    'tripadvisor' => array(
	        'id' => 'tripadvisor',
	        'title' => esc_html__('Tripadvisor','jobzilla'),
	    ),
	    'blogger' => array(
	        'id' => 'blogger',
	        'title' => esc_html__('Blogger','jobzilla'),
	    ),
	    'delicious' => array(
	        'id' => 'delicious',
	        'title' => esc_html__('Delicious','jobzilla'),
	    ), 
	    'digg' => array(
	        'id' => 'digg',
	        'title' => esc_html__('Digg','jobzilla'),
	    ),
	    'dribbble' => array(
	        'id' => 'dribbble',
	        'title' => esc_html__('Dribbble','jobzilla'),
	    ),
	    'flickr' => array(
	        'id' => 'flickr',
	        'title' => esc_html__('Flickr','jobzilla'),
	    ),
	    'lastfm' => array(
	        'id' => 'lastfm',
	        'title' => esc_html__('Lastfm','jobzilla'),
	    ),
	    'paypal' => array(
	        'id' => 'paypal',
	        'title' => esc_html__('Paypal','jobzilla'),
	    ), 
	    'reddit' => array(
	        'id' => 'reddit',
	        'title' => esc_html__('Reddit','jobzilla'),
	    ),
	    'share' => array(
	        'id' => 'share',
	        'title' => esc_html__('Share','jobzilla'),
	    ),
	    'soundcloud' => array(
	        'id' => 'soundcloud',
	        'title' => esc_html__('Soundcloud','jobzilla'),
	    ),
	    'spotify' => array(
	        'id' => 'spotify',
	        'title' => esc_html__('Spotify','jobzilla'),
	    ),
	    'stack-overflow' => array(
	        'id' => 'stack-overflow',
	        'title' => esc_html__('Stack Overflow','jobzilla'),
	    ), 
	     'steam' => array(
	        'id' => 'steam',
	        'title' => esc_html__('Steam','jobzilla'),
	    ),
	    'stumbleupon' => array(
	        'id' => 'stumbleupon',
	        'title' => esc_html__('Stumbleupon','jobzilla'),
	    ),
	    'telegram' => array(
	        'id' => 'telegram',
	        'title' => esc_html__('Telegram','jobzilla'),
	    ),
	    'twitch' => array(
	        'id' => 'twitch',
	        'title' => esc_html__('Twitch','jobzilla'),
	    ),
	    'vk' => array(
	        'id' => 'vk',
	        'title' => esc_html__('VKontakte','jobzilla'),
	    ),
	    'windows' => array(
	        'id' => 'windows',
	        'title' => esc_html__('Windows','jobzilla'),
	    ), 
	     'wordpress' => array(
	        'id' => 'wordpress',
	        'title' => esc_html__('WordPress','jobzilla'),
	    ),
	    'yahoo' => array(
	        'id' => 'yahoo',
	        'title' => esc_html__('Yahoo','jobzilla'),
	    ) 

	);

	return $social_links;
}

/* Social Share Options */
function jobzilla_social_share_options(){
	
	$social_share = array(
	    'facebook' => array(
	        'id' => 'facebook',
	        'title' => esc_html__('Facebook','jobzilla'),
	    ),
	    'twitter' => array(
	        'id' => 'twitter',
	        'title' => esc_html__('Twitter','jobzilla'),
	    ),
	    'linkedin' => array(
	        'id' => 'linkedin',
	        'title' => esc_html__('Linkedin','jobzilla'),
	    ),
	   'pinterest' => array(
	        'id' => 'pinterest',
	        'title' => esc_html__('Pinterest','jobzilla'),
	    ),
	   'tumblr' => array(
	        'id' => 'tumblr',
	        'title' => esc_html__('Tumblr','jobzilla'),
	    ),
	   'digg' => array(
	        'id' => 'digg',
	        'title' => esc_html__('Digg','jobzilla'),
	    ),
	    'reddit' => array(
	        'id' => 'reddit',
	        'title' => esc_html__('Reddit','jobzilla'),
	    ),

	);

	return $social_share;
}

/* Button Link Target Options */
function jobzilla_banner_type(){
	$banner_type = array(
		'image'  => esc_html__('Image Type Banner', 'jobzilla'),
	);
	
	return $banner_type;
}

/* Page Banner Layout Style Options */
function jobzilla_page_banner_layout_options(){
	// post listing/collage style
	$page_banner_layout = array(
		array(
			'id'   => 'banner_layout_1',
			'listing_param' =>  array(
				'title' => esc_html__('Banner Layout 1','jobzilla'),
				'img'   => get_template_directory_uri() . '/dz-inc/assets/images/banner-layout/banner-layout-1.png'),
			'param'  => array()
		),
		array(
			'id'   => 'banner_layout_2',
			'listing_param' => array(
				'title' => esc_html__('Banner Layout 2','jobzilla'),
				'img'   => get_template_directory_uri() . '/dz-inc/assets/images/banner-layout/banner-layout-2.png'),
			'param'  => array()
		),
		
		array(
			'id'   => 'banner_layout_3',
			'listing_param' =>  array(
				'title' => esc_html__('Banner Layout 3','jobzilla'),
				'img'   => get_template_directory_uri() . '/dz-inc/assets/images/banner-layout/banner-layout-3.png'),
			'param'  => array()
		),
		
		array(
			'id'   => 'banner_layout_4',
			'listing_param' =>  array(
				'title' => esc_html__('Banner Layout 4','jobzilla'),
				'img'   => get_template_directory_uri() . '/dz-inc/assets/images/banner-layout/banner-layout-4.png'),
			'param'  => array()
		),
		
		array(
			'id'   => 'banner_layout_5',
			'listing_param' =>  array(
				'title' => esc_html__('Banner Layout 5','jobzilla'),
				'img'   => get_template_directory_uri() . '/dz-inc/assets/images/banner-layout/banner-layout-5.png'),
			'param'  => array()
		),
		
	);

	return $page_banner_layout;
}

/* Page Banner Layout Style Options */
function jobzilla_post_related_layout_options(){
	// post listing/collage style
	$post_related_layout = array(
		array(
			'id'   => 'post_related_1',
			'listing_param' =>  array(
				'title' => esc_html__('Post Related 1','jobzilla'),
				'img'   => get_template_directory_uri() . '/dz-inc/assets/images/related-post/related-post-1.png'),
			'param'  => array()
		),
		array(
			'id'   => 'post_related_2',
			'listing_param' => array(
				'title' => esc_html__('Post Related 2','jobzilla'),
				'img'   => get_template_directory_uri() . '/dz-inc/assets/images/related-post/related-post-2.png'),
			'param'  => array()
		),
		array(
			'id'   => 'post_related_3',
			'listing_param' => array(
				'title' => esc_html__('Post Related 3','jobzilla'),
				'img'   => get_template_directory_uri() . '/dz-inc/assets/images/related-post/related-post-3.png'),
			'param'  => array()
		),
		array(
			'id'   => 'post_related_4',
			'listing_param' => array(
				'title' => esc_html__('Post Related 4','jobzilla'),
				'img'   => get_template_directory_uri() . '/dz-inc/assets/images/related-post/related-post-4.png'),
			'param'  => array()
		),
	);

	return $post_related_layout;
}


/* Theme Layout Options */
function jobzilla_job_map_layout_options(){
	$theme_layouts = array(
		array(
			'id'   => 'default',
			'img_param' => array(
				'title' => esc_html__('Default','jobzilla'),
				'img'   => get_template_directory_uri() . '/dz-inc/assets/images/job-map/default.png'
			),
			'param'  => array()
		),
		array(
			'id'   => 'style1',
			'img_param' => array(
				'title' => esc_html__('Style 1','jobzilla'),
				'img'   => get_template_directory_uri() . '/dz-inc/assets/images/job-map/style_1.png'
			),
			'param'  => array()
		),
		array(
			'id'   => 'style2',
			'img_param' => array(
				'title' => esc_html__('Style 2','jobzilla'),
				'img'   => get_template_directory_uri() . '/dz-inc/assets/images/job-map/style_2.png'
			),
			'param'  => array()
		),
		array(
			'id'   => 'style3',
			'img_param' => array(
				'title' => esc_html__('Style 3','jobzilla'),
				'img'   => get_template_directory_uri() . '/dz-inc/assets/images/job-map/style_3.png'
			),
			'param'  => array()
		),
		array(
			'id'   => 'style4',
			'img_param' => array(
				'title' => esc_html__('Style 4','jobzilla'),
				'img'   => get_template_directory_uri() . '/dz-inc/assets/images/job-map/style_4.png'
			),
			'param'  => array()
		),
		array(
			'id'   => 'custom',
			'img_param' => array(
				'title' => esc_html__('Custom','jobzilla'),
				'img'   => get_template_directory_uri() . '/dz-inc/assets/images/job-map/custom.png'
			),
			'param'  => array()
		)
	);

	return $theme_layouts;
}

function jobzilla_page_banner_style_options(){

	$banner_style = array(
		array(
			'id'   => 'style1',
			'img_param' =>  array(
				'title' => esc_html__('Banner Style 1','jobzilla'),
				'img'   => get_template_directory_uri() . '/dz-inc/assets/images/page-banner/style_1.png'
			),
			'param'  => array()
		),
		array(
			'id'   => 'style2',
			'img_param' => array(
				'title' => esc_html__('Banner Style 2','jobzilla'),
				'img'   => get_template_directory_uri() . '/dz-inc/assets/images/page-banner/style_2.png'
			),
			'param'  => array()
		)
	);

	return $banner_style;
}
