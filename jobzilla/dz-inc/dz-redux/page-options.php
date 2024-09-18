<?php
/**
 * Register metabox for posts based on Redux Framework. Supported methods:
 *     isset_args( $post_type )
 *     set_args( $post_type, $redux_args, $metabox_args )
 *     add_section( $post_type, $sections )
 * Each post type can contains only one metabox. Pease note that each field id
 * leads by an underscore sign ( _ ) in order to not show that into Custom Field
 * Metabox from WordPress core feature.
 *
 * @param  jobzilla_Post_Metabox $metabox
 */
 
/**
 * Get list menu.
 * @return array
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

function jobzilla_page_options_register($metabox)
{

    $post_layouts_options = jobzilla_get_post_layouts_options();
    $sidebar_layout_options = jobzilla_get_sidebar_layout_options();
    $header_style_options = jobzilla_get_header_style_options();
    $page_banner_options = jobzilla_get_page_banner_options();
    $post_banner_options = jobzilla_get_post_banner_options();
    $footer_style_options = jobzilla_get_footer_style_options();
    $banner_type = jobzilla_banner_type();
	$banner_style = jobzilla_get_page_banner_style_options();
    /**
     * Option for single posts.
     *
     */
    if (!$metabox->isset_args('post'))
    {
        $metabox->set_args('post', array(
            'opt_name' => jobzilla_get_post_opt_name() ,
            'display_name' => esc_html__('Post Settings', 'jobzilla') ,
            'show_options_object' => false,
            'hints' => array(
                'icon' => 'el el-question-sign',
                'icon_position' => 'right',
                'icon_color' => '#1085e4',
                'icon_size' => '10',
                'tip_style' => array(
                    'color' => '#1085e4',
                    'shadow' => true,
                    'rounded' => false,
                    'style' => '',
                ) ,
                'tip_position' => array(
                    'my' => 'top left',
                    'at' => 'bottom right',
                ) ,
                'tip_effect' => array(
                    'show' => array(
                        'effect' => 'slide',
                        'duration' => '500',
                        'event' => 'mouseover',
                    ) ,
                    'hide' => array(
                        'effect' => 'slide',
                        'duration' => '500',
                        'event' => 'click mouseleave',
                    )
                )
            )
        ) , array(
            'context' => 'advanced',
            'priority' => 'default'
        ));
    }
 
    $metabox->add_section('post', array(
        'title' => esc_html__('General', 'jobzilla') ,
        'icon' => 'fa fa-newspaper-o',
        'fields' => array(
            array(
                'id' => 'featured_post',
                'type' => 'checkbox',
                'title' => esc_html__('Featured Post?', 'jobzilla') ,
                'desc' => esc_html__('Check if you want to make this post as featured post', 'jobzilla') ,
                'default' => ''
            ) ,
        )
    ));
	
    $metabox->add_section('post', array(
        'title' => esc_html__('Post Layout', 'jobzilla') ,
        'icon' => 'fa fa-file-text-o',
        'fields' => array(
            array(
                'id' => 'post_layout',
                'type' => 'image_select',
                'height' => '55',
                'title' => esc_html__('Layout', 'jobzilla') ,
                'subtitle' => esc_html__('Select a template.', 'jobzilla') ,
                'desc' => esc_html__('Click on the template icon to select.', 'jobzilla') ,
                'options' => $post_layouts_options,
                'default' => jobzilla_get_opt('post_general_layout') ,
                'hint' => array(
                    'title' => esc_html__('How it Works?', 'jobzilla') ,
                    'content' => esc_html__('Once you select the template from here, the template will apply for this page only.', 'jobzilla')
                )
            ) ,
            array(
                'id' => 'post_type_gallery1',
                'type' => 'gallery',
                'title' => esc_html__('Gallery', 'jobzilla') ,
                'subtitle' => esc_html__('Select the gallery images', 'jobzilla') ,
				'desc' => esc_html__('For better layout, Image size width greater than 1000 and height greater than 600', 'jobzilla') ,
                'default' => '',
                'required' => array(
                    0 => 'post_layout',
                    1 => 'equals',
                    2 => 'slider_post_1'
                )
            ) ,
            array(
                'id' => 'post_type_gallery2',
                'type' => 'gallery',
                'title' => esc_html__('Gallery', 'jobzilla') ,
                'subtitle' => esc_html__('Select the gallery images', 'jobzilla') ,
				'desc' => esc_html__('For better layout, Image size width greater than 1000 and height greater than 600', 'jobzilla') ,
                'default' => '',
                'required' => array(
                    0 => 'post_layout',
                    1 => 'equals',
                    2 => 'slider_post_2'
                )
            ) ,
            array(
                'id' => 'post_type_gallery3',
                'type' => 'gallery',
                'title' => esc_html__('Gallery', 'jobzilla') ,
                'subtitle' => esc_html__('Select the gallery images', 'jobzilla') ,
				'desc' => esc_html__('For better layout, Image size width greater than 1000 and height greater than 600', 'jobzilla') ,
                'default' => '',
                'required' => array(
				0 => 'post_layout',
                    1 => 'equals',
                    2 => 'slider_post_3'
                )
            ) ,
            array(
                'id' => 'post_type_link',
                'type' => 'text',
                'title' => esc_html__('External Link', 'jobzilla') ,
                'default' => '',
                'validate' => 'url',
                'required' => array(
                    0 => 'post_layout',
                    1 => 'equals',
                    2 => 'link_post'
                )
            ) ,
            array(
                'id' => 'post_type_quote_author',
                'type' => 'text',
                'title' => esc_html__('Author Name', 'jobzilla') ,
                'default' => esc_html__('Author Name', 'jobzilla') ,
                'required' => array(
                    0 => 'post_layout',
                    1 => 'equals',
                    2 => 'quote_post'
                )
            ) ,
            array(
                'id' => 'post_type_quote_text',
                'type' => 'textarea',
                'title' => esc_html__('Quote Text', 'jobzilla') ,
                'default' => esc_html__('Quote Text', 'jobzilla') ,
                'required' => array(
                    0 => 'post_layout',
                    1 => 'equals',
                    2 => 'quote_post'
                )
            ) ,
            array(
                'id' => 'post_type_audio',
                'type' => 'text',
                'title' => esc_html__('Sound Cloud Link', 'jobzilla') ,
                'default' => '',
                'validate' => 'url',
                'required' => array(
                    0 => 'post_layout',
                    1 => 'equals',
                    2 => 'audio_post'
                )
            ) ,
            array(
                'id' => 'post_type_video',
                'type' => 'text',
                'title' => esc_html__('Video Link', 'jobzilla') ,
                'default' => '',
                'validate' => 'url',
                'required' => array(
                    0 => 'post_layout',
                    1 => 'equals',
                    2 => 'video_post'
                )
            ) ,
            array(
                'id' => 'post_show_sidebar',
                'type' => 'switch',
                'title' => esc_html__('Sidebar', 'jobzilla') ,
                'desc' => esc_html__('Show / hide sidebar from this posts detail page.', 'jobzilla') ,
                'on' => esc_html__('Enabled', 'jobzilla') ,
                'off' => esc_html__('Disabled', 'jobzilla') ,
                'default' => jobzilla_get_opt('show_sidebar') ,
                'required' => array(
                    array(
                        0 => 'post_layout',
                        1 => '!=',
                        2 => 'gutenberg'
                    ) ,
                )
            ) ,
            array(
                'id' => 'post_sidebar_layout',
                'type' => 'image_select',
                'title' => esc_html__('Sidebar Layout', 'jobzilla') ,
                'subtitle' => esc_html__('Choose the layout for page. (Default : Right Side).', 'jobzilla') ,
                'options' => $sidebar_layout_options,
                'default' => 'right',
                'required' => array(
                    0 => 'post_show_sidebar',
                    1 => 'equals',
                    2 => '1'
                )
            ) ,
            array(
                'id' => 'post_sidebar',
                'type' => 'select',
                'data' => 'sidebars',
                'title' => esc_html__('Sidebar', 'jobzilla') ,
                'subtitle' => esc_html__('Select sidebar.', 'jobzilla') ,
                'default' => 'dz_blog_sidebar',
                'required' => array(
                    0 => 'post_sidebar_layout',
                    1 => 'equals',
                    2 => array(
                        'right',
                        'left'
                    )
                )
            ) ,
            array(
                'id' => 'featured_image',
                'type' => 'switch',
                'title' => esc_html__('Show Feature Image', 'jobzilla') ,
                'on' => esc_html__('Enabled', 'jobzilla') ,
                'off' => esc_html__('Disabled', 'jobzilla') ,
                'default' => 1
            ) ,
            array(
                'id' => 'post_pagination',
                'type' => 'switch',
                'title' => esc_html__('Show Post Pagination', 'jobzilla') ,
                'on' => esc_html__('Enabled', 'jobzilla') ,
                'off' => esc_html__('Disabled', 'jobzilla') ,
                'default' => 0
            ) ,
        )
    ));
    $metabox->add_section('post', array(
        'title' => esc_html__('Post Banner', 'jobzilla') ,
        'desc' => esc_html__('Settings for post banner.', 'jobzilla') ,
        'icon' => 'fa fa-television',
        'fields' => array(
            array(
                'id' => 'post_banner_setting',
                'type' => 'button_set',
                'title' => esc_html__('Post Banner Settings', 'jobzilla') ,
                'options' => array(
                    'theme_default' => esc_html__('Theme Default', 'jobzilla') ,
                    'custom' => esc_html__('Custom Setting', 'jobzilla')
                ) ,
                'default' => 'theme_default',
            ) ,
            array(
                'id' => 'post_banner_on',
                'type' => 'switch',
                'title' => esc_html__('Post Banner', 'jobzilla') ,
                'on' => esc_html__('Enabled', 'jobzilla') ,
                'off' => esc_html__('Disabled', 'jobzilla') ,
                'default' => jobzilla_get_opt('post_general_banner_on') ,
                'required' => array(
                    0 => 'post_banner_setting',
                    1 => 'equals',
                    2 => 'custom'
                )
            ) ,
			
			array(
                'id' => 'post_banner_type',
                'type' => 'button_set',
                'title' => esc_html__('Post Banner Type', 'jobzilla') ,
                'options' => $banner_type,
                'default' => jobzilla_get_opt('post_general_banner_type') ,
                'required' => array(
                    0 => 'post_banner_on',
                    1 => 'equals',
                    2 => '1'
                )
            ) ,
			array(
				'id' => 'post_banner_style',
				'type' => 'image_select',
				'title' => esc_html__('Post Banner Layout', 'jobzilla') ,
				 'options' 	=> $banner_style,
				'default' => 'style1' ,
				'required' => array(
					0 => 'post_banner_on',
					1 => 'equals',
					2 => 1
				)
			) ,
            array(
                'id' => 'post_banner_height',
                'type' => 'image_select',
                'title' => esc_html__('Post Banner Height', 'jobzilla') ,
                'subtitle' => esc_html__('Choose the height for all tag page banner. Default : Medium Banner', 'jobzilla') ,
                'options' => $page_banner_options,
                'height' => '20',
                'default' => jobzilla_get_opt('post_general_banner_height') ,
                'required' => array(
                    0 => 'post_banner_on',
                    1 => 'equals',
                    2 => 1
                ) ,
            ) ,
			
			array(
                'id' => 'post_banner_custom_height',
                'type' => 'slider',
                'title' => esc_html__('Post Banner Custom Height', 'jobzilla') ,
                'desc' => esc_html__('Hight description. Min: 100, max: 800', 'jobzilla') ,
                'default' => jobzilla_get_opt('post_general_banner_custom_height') ,
                'min' => 100,
                'max' => 800,
                'display_value' => 'text',
                'required' => array(
                    0 => 'post_banner_height',
                    1 => 'equals',
                    2 => 'page_banner_custom'
                )
            ) ,
			
            array(
                'id' => 'post_banner',
                'type' => 'media',
                'url' => true,
                'title' => esc_html__('Post Banner Image', 'jobzilla') ,
                'subtitle' => esc_html__('Enter page banner image. It will work as default banner image for all pages', 'jobzilla') ,
                'desc' => esc_html__('Upload banner image.', 'jobzilla') ,
                'default' => jobzilla_get_opt('post_general_banner') ,
                'required' => array(
                    0 => 'post_banner_on',
                    1 => 'equals',
                    2 => 1
                ) ,
            ) ,
            array(
                'id' => 'post_breadcrumb',
                'type' => 'switch',
                'title' => esc_html__('Breadcrumb Area', 'jobzilla') ,
                'subtitle' => esc_html__('Click on the tab to Enable / Disable the website breadcrumb.', 'jobzilla') ,
                'desc' => esc_html__('This setting affects only on this page.', 'jobzilla') ,
                'on' => esc_html__('Enabled', 'jobzilla') ,
                'off' => esc_html__('Disabled', 'jobzilla') ,
                'default' => jobzilla_get_opt('show_breadcrumb') ,
                'required' => array(
                    0 => 'post_banner_on',
                    1 => 'equals',
                    2 => 1
                ) ,
            ) ,
        )
    ));

    /**
     * Option for single pages.
     *
     */
    if (!$metabox->isset_args('page'))
    {
        $metabox->set_args('page', array(
            'opt_name' => jobzilla_get_page_opt_name() ,
            'display_name' => esc_html__('Page Settings', 'jobzilla') ,
            'show_options_object' => false,
            'hints' => array(
                'icon' => 'el el-question-sign',
                'icon_position' => 'right',
                'icon_color' => '#1085e4',
                'icon_size' => '10',
                'tip_style' => array(
                    'color' => '#1085e4',
                    'shadow' => true,
                    'rounded' => false,
                    'style' => '',
                ) ,
                'tip_position' => array(
                    'my' => 'top left',
                    'at' => 'bottom right',
                ) ,
                'tip_effect' => array(
                    'show' => array(
                        'effect' => 'slide',
                        'duration' => '500',
                        'event' => 'mouseover',
                    ) ,
                    'hide' => array(
                        'effect' => 'slide',
                        'duration' => '500',
                        'event' => 'click mouseleave',
                    )
                )
            )
        ) , array(
            'context' => 'advanced',
            'priority' => 'default'
        ));
    }
	
    $metabox->add_section('page', array(
        'title' => esc_html__('Page Header', 'jobzilla') ,
        'desc' => esc_html__('Header settings for the page.', 'jobzilla') ,
        'icon' => 'fa fa-window-maximize',
        'fields' => array(
			array(
                'id' => 'page_header_setting',
                'type' => 'button_set',
                'title' => esc_html__('Page Header Settings', 'jobzilla') ,
                'options' => array(
                    'theme_default' => esc_html__('Theme Default', 'jobzilla') ,
                    'custom' => esc_html__('Custom Setting', 'jobzilla')
                ) ,
                'default' => 'theme_default',
            ),
            array(
                'id' => 'page_header_style',
                'type' => 'image_select',
                'title' => esc_html__('Header Style', 'jobzilla') ,
                'subtitle' => esc_html__('Choose header style. White header is set as default header for this page.', 'jobzilla') ,
                'options' => $header_style_options,
                'default' => jobzilla_get_opt('header_style') ,
                'force_output' => true,
				'required' => array(
                    0 => 'page_header_setting',
                    1 => 'equals',
                    2 => 'custom'
                )
            ) ,
			array(
                'id' => 'page_header_theme',
                'type' => 'button_set',
                'title' => esc_html__('Header Theme', 'jobzilla') ,
                'options' => array('light' => 'Light','dark' => 'Dark'),
                'default' => 'light',
                'required' => array(
                    0 => 'page_header_style',
                    1 => 'equals',
                    2 => 'header_6'
                )
            ) ,
        )
    ));
	
	$metabox->add_section('page', array(
        'title' => esc_html__('Page Banner', 'jobzilla') ,
        'desc' => esc_html__('Settings for page banner.', 'jobzilla') ,
        'icon' => 'fa fa-television',
        'fields' => array(
            array(
                'id' => 'page_banner_setting',
                'type' => 'button_set',
                'title' => esc_html__('Page Banner Settings', 'jobzilla') ,
                'options' => array(
                    'theme_default' => esc_html__('Theme Default', 'jobzilla') ,
                    'custom' => esc_html__('Custom Setting', 'jobzilla')
                ) ,
                'default' => 'theme_default',
            ),
            array(
                'id' => 'page_banner_on',
                'type' => 'switch',
                'title' => esc_html__('Page Banner', 'jobzilla') ,
                'on' => esc_html__('Enabled', 'jobzilla') ,
                'off' => esc_html__('Disabled', 'jobzilla') ,
                'default' => jobzilla_get_opt('page_general_banner_on') ,
                'required' => array(
                    0 => 'page_banner_setting',
                    1 => 'equals',
                    2 => 'custom'
                )
            ) ,
            array(
                'id' => 'page_banner_type',
                'type' => 'button_set',
                'title' => esc_html__('Page Banner Type', 'jobzilla') ,
                'options' => $banner_type,
                'default' => jobzilla_get_opt('page_general_banner_type') ,
                'required' => array(
                    0 => 'page_banner_on',
                    1 => 'equals',
                    2 => '1'
                )
            ) ,
            array(
                'id' => 'page_banner_height',
                'type' => 'image_select',
                'title' => esc_html__('Page Banner Height', 'jobzilla') ,
                'subtitle' => esc_html__('Choose the height for all tag page banner. Default : Medium Banner', 'jobzilla') ,
                'options' => $page_banner_options,
                'height' => '20',
                'default' => jobzilla_get_opt('page_general_banner_height') ,
                'required' => array(
                    0 => 'page_banner_type',
                    1 => 'equals',
                    2 => 'image'
                )
            ) ,
			
			array(
                'id' => 'page_banner_custom_height',
                'type' => 'slider',
                'title' => esc_html__('Page Banner Custom Height', 'jobzilla') ,
                'desc' => esc_html__('Hight description. Min: 100, max: 800', 'jobzilla') ,
                'default' => jobzilla_get_opt('page_general_banner_custom_height') ,
                'min' => 100,
                'max' => 800,
                'display_value' => 'text',
                'required' => array(
                    0 => 'page_banner_height',
                    1 => 'equals',
                    2 => 'page_banner_custom'
                )
            ) ,
           array(
				'id' => 'page_banner_style',
				'type' => 'image_select',
				'title' => esc_html__('Page Banner Style', 'jobzilla') ,
				'options' 	=> $banner_style,
				'default' => 'style1',
				'required' => array(
					0 => 'page_banner_on',
					1 => 'equals',
					2 => '1'
				)
			) ,
            array(
                'id' => 'page_banner',
                'type' => 'media',
                'url' => true,
                'title' => esc_html__('Page Banner Image', 'jobzilla') ,
                'subtitle' => esc_html__('Enter page banner image. It will work as default banner image for all pages', 'jobzilla') ,
                'desc' => esc_html__('Upload banner image.', 'jobzilla') ,
                'default' => jobzilla_get_opt('page_general_banner') ,
                'required' => array(
                    0 => 'page_banner_type',
                    1 => 'equals',
                    2 => 'image'
                )
            ) ,

            array(
                'id' => 'page_banner_title',
                'type' => 'text',
                'url' => true,
                'title' => esc_html__('Page Banner Title', 'jobzilla') ,
                'subtitle' => esc_html__('Enter page banner title.', 'jobzilla') ,
                'default' => '',
            ) ,

       
            array(
                'id' => 'page_breadcrumb',
                'type' => 'switch',
                'title' => esc_html__('Breadcrumb Area', 'jobzilla') ,
                'subtitle' => esc_html__('Click on the tab to Enable / Disable the website breadcrumb.', 'jobzilla') ,
                'desc' => esc_html__('This setting affects only on this page.', 'jobzilla') ,
                'on' => esc_html__('Enabled', 'jobzilla') ,
                'off' => esc_html__('Disabled', 'jobzilla') ,
                'default' => jobzilla_get_opt('show_breadcrumb') ,
                'required' => array(
                    0 => 'page_banner_type',
                    1 => 'equals',
                    2 => 'image'
                )
            ),
            array(
                'id' => 'page_banner_hide',
                'type' => 'checkbox',
                'title' => esc_html__('Don`t use banner image for this page', 'jobzilla') ,
                'default' => jobzilla_get_opt('page_general_banner_hide') ,
                'desc' => esc_html__('Check if you don`t want to use banner image', 'jobzilla') ,
                'required' => array(
                    0 => 'page_banner_type',
                    1 => 'equals',
                    2 => 'image'
                ) ,
                'hint' => array(
                    'content' => esc_html__('If we don`t have suitable image then we can hide current or default banner images and show only banner container with theme default color.', 'jobzilla')
                ),
            ),
            array(
                'id' => 'page_no_of_post',
                'type' => 'text',
                'title' => esc_html__('Number of Posts', 'jobzilla') ,
                'subtitle' => esc_html__('Enter number of post. Default : 3', 'jobzilla') ,
                'default' => jobzilla_get_opt('page_general_no_of_post') ,
                'required' => array(
                    0 => 'page_banner_type',
                    1 => 'equals',
                    2 => 'post'
                )
			
            ),
           
            array(
                'id' => 'page_banner_cat',
                'type' => 'select',
                'multi' => true,
                'data' => 'terms',
                'args' => array(
                    'taxonomies' => 'category'
                ) ,
                'title' => esc_html__('Post Category', 'jobzilla') ,
                'subtitle' => esc_html__('Select post category. It will work as default banner for all pages', 'jobzilla') ,
                'default' => jobzilla_get_opt('page_general_banner_cat') ,
                'required' => array(
                    0 => 'page_banner_type',
                    1 => 'equals',
                    2 => 'post'
                )
            ) ,
            array(
                'id' => 'page_post_type',
                'type' => 'button_set',
                'title' => esc_html__('Post Type', 'jobzilla') ,
                'options' => array(
                    'all' => esc_html__('All', 'jobzilla') ,
                    'featured' => esc_html__('Featured', 'jobzilla')
                ) ,
                'default' => jobzilla_get_opt('page_general_post_type') ,
                'force_output' => true,
                'required' => array(
                    0 => 'page_banner_type',
                    1 => 'equals',
                    2 => 'post'
                )
            ) ,
            array(
                'id' => 'page_items_with',
                'type' => 'button_set',
                'title' => esc_html__('Items With', 'jobzilla') ,
                'options' => array(
                    'with_any_type' => esc_html__('Any Type', 'jobzilla') ,
                    'with_featured_image' => esc_html__('With Featured Image', 'jobzilla') ,
                    'without_featured_image' => esc_html__('Without Featured Iimage', 'jobzilla')
                ) ,
                'default' => jobzilla_get_opt('page_general_items_with') ,
                'required' => array(
                    0 => 'page_banner_type',
                    1 => 'equals',
                    2 => 'post'
                )
            )
        )
    ));

    $metabox->add_section('page', array(
        'title' => esc_html__('Page Sidebar', 'jobzilla') ,
        'desc' => esc_html__('Settings for sidebar area.', 'jobzilla') ,
        'icon' => 'fa fa-server',
        'fields' => array(
			array(
                'id' => 'page_show_sidebar_information',
                'type'  => 'info',
				'style' => 'warning',
				'title' => esc_html__('Sidebar Information!', 'jobzilla'),
				'icon'  => 'el-icon-info-sign',
				'desc'  => esc_html__( 'These settings only working with default template in page attribute.', 'jobzilla'),
                'default' => jobzilla_get_opt('page_general_show_sidebar')
            ) ,
            array(
                'id' => 'page_show_sidebar',
                'type' => 'switch',
                'title' => esc_html__('Sidebar', 'jobzilla') ,
                'on' => esc_html__('Enabled', 'jobzilla') ,
                'off' => esc_html__('Disabled', 'jobzilla') ,
                'default' => jobzilla_get_opt('page_general_show_sidebar')
            ) ,
            array(
                'id' => 'page_sidebar_layout',
                'type' => 'image_select',
                'title' => esc_html__('Sidebar Layout', 'jobzilla') ,
                'subtitle' => esc_html__('Choose the layout for page. (Default : Right Side).', 'jobzilla') ,
                'options' => $sidebar_layout_options,
                'default' => jobzilla_get_opt('page_general_sidebar_layout') ,
                'required' => array(
                    0 => 'page_show_sidebar',
                    1 => 'equals',
                    2 => '1'
                )
            ) ,
            array(
                'id' => 'page_sidebar',
                'type' => 'select',
                'data' => 'sidebars',
                'title' => esc_html__('Sidebar', 'jobzilla') ,
                'subtitle' => esc_html__('Select sidebar for the page', 'jobzilla') ,
                'default' => jobzilla_get_opt('page_general_sidebar') ,
                'required' => array(
                    0 => 'page_sidebar_layout',
                    1 => 'equals',
                    2 => array(
                        'left',
                        'right'
                    )
                )
            )
        )
    ));

    $metabox->add_section('page', array(
        'title' => esc_html__('Page Footer', 'jobzilla') ,
        'desc' => esc_html__('Settings for footer area.', 'jobzilla') ,
        'icon' => 'fa fa-home',
        'fields' => array(
			array(
                'id' => 'page_footer_setting',
                'type' => 'button_set',
                'title' => esc_html__('Page Footer Settings', 'jobzilla') ,
                'options' => array(
                    'theme_default' => esc_html__('Theme Default', 'jobzilla') ,
                    'custom' => esc_html__('Custom Setting', 'jobzilla')
                ) ,
                'default' => 'theme_default',
			),
			array(
		        'id'      => 'page_footer_on',
	            'type'    => 'switch',
	            'title'   => esc_html__('Footer', 'jobzilla'),
	            'on'      => esc_html__('Enabled', 'jobzilla'),
	            'off'     => esc_html__('Disabled', 'jobzilla'),
				'default' => jobzilla_get_opt( 'footer_on' ),
	            'required' => array(
                    0 => 'page_footer_setting',
                    1 => 'equals',
                    2 => 'custom'
                )
		    ),
    		array(
	            'id'       => 'page_footer_style',
	            'type'     => 'image_select',
	            'height'   => '80',
	            'title'    => esc_html__('Footer Template', 'jobzilla'),
	            'subtitle' => esc_html__('Choose a template for footer.', 'jobzilla'),
	            'options'  => $footer_style_options,
	            'default'  => jobzilla_get_opt( 'footer_style' ),
				'required' => array(
					array(
						0 => 'page_footer_setting',
						1 => 'equals',
						2 => 'custom'
					),
					array(
						0 => 'page_footer_on',
						1 => 'equals',
						2 => 1
					),
                )
	        )
        )
    ));
	
    /**
     * Option for Testimonial single posts.
     *
     */
    if (!$metabox->isset_args('dz_testimonial'))
    {
        $metabox->set_args('dz_testimonial', array(
            'opt_name' => jobzilla_get_post_opt_name() ,
            'display_name' => esc_html__('Customer Data', 'jobzilla') ,
            'show_options_object' => false,
            'hints' => array(
                'icon' => 'el el-question-sign',
                'icon_position' => 'right',
                'icon_color' => '#1085e4',
                'icon_size' => '10',
                'tip_style' => array(
                    'color' => '#1085e4',
                    'shadow' => true,
                    'rounded' => false,
                    'style' => '',
                ) ,
                'tip_position' => array(
                    'my' => 'top left',
                    'at' => 'bottom right',
                ) ,
                'tip_effect' => array(
                    'show' => array(
                        'effect' => 'slide',
                        'duration' => '500',
                        'event' => 'mouseover',
                    ) ,
                    'hide' => array(
                        'effect' => 'slide',
                        'duration' => '500',
                        'event' => 'click mouseleave',
                    )
                )
            )
        ) , array(
            'context' => 'advanced',
            'priority' => 'default'
        ));
    }
	
	$metabox->add_section('dz_testimonial', array(
        'title' => esc_html__('Feature Post', 'jobzilla') ,
        'icon' => 'fa fa-newspaper-o',
        'fields' => array(
            array(
                'id' => 'featured_post',
                'type' => 'checkbox',
                'title' => esc_html__('Featured Post?', 'jobzilla') ,
                'desc' => esc_html__('Check if you want to make this post as featured post', 'jobzilla') ,
                'default' => ''
            ) ,
        )
    ));
	
    $metabox->add_section('dz_testimonial', array(
        'title' => esc_html__('General', 'jobzilla') ,
        'icon' => 'fa fa-newspaper-o',
        'fields' => array(
            array(
                'id' => 'testimonial_designation',
                'type' => 'text',
                'title' => esc_html__('Designation', 'jobzilla') ,
                'desc' => esc_html__('Enter client designation', 'jobzilla') ,
                'default' => 'CEO & Founder'
            ) ,
			 array(
                'id' => 'testimonial_client_name',
                'type' => 'text',
                'title' => esc_html__('Client Name', 'jobzilla') ,
                'desc' => esc_html__('Enter client name', 'jobzilla') ,
                'default' => esc_html__('Guy Hawkins', 'jobzilla')
            ) ,
			array(
				'id'       => 'testimonial_rating',
				'type'     => 'select',
				'title'    => esc_html__('Rating', 'jobzilla'), 
				'desc'     => esc_html__('Select Rating.', 'jobzilla'),
				/* Must provide key => value pairs for select options */
				'options'  => array(
					'1' => esc_html__('1 Star', 'jobzilla'),
					'2' => esc_html__('2 Star', 'jobzilla'),
					'3' => esc_html__('3 Star', 'jobzilla'),
					'4' => esc_html__('4 Star', 'jobzilla'),
					'5' => esc_html__('5 Star', 'jobzilla')
				),
				'default'  => '5',
			),
        )
    ));

   
}

add_action('dsx_post_metabox_register', 'jobzilla_page_options_register');

