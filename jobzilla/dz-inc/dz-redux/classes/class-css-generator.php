<?php
if ( ! class_exists( 'ReduxFrameworkInstances' ) )
{
    return;
}

/*
 * Convert HEX to GRBA
 */
if(!function_exists('jobzilla_rgba')){
    function jobzilla_rgba($hex,$opacity = 1) {
        $hex = str_replace("#",null, $hex);
        $color = array();
        if(strlen($hex) == 3) {
            $color['r'] = hexdec(substr($hex,0,1).substr($hex,0,1));
            $color['g'] = hexdec(substr($hex,1,1).substr($hex,1,1));
            $color['b'] = hexdec(substr($hex,2,1).substr($hex,2,1));
            $color['a'] = $opacity;
        }
        else if(strlen($hex) == 6) {
            $color['r'] = hexdec(substr($hex, 0, 2));
            $color['g'] = hexdec(substr($hex, 2, 2));
            $color['b'] = hexdec(substr($hex, 4, 2));
            $color['a'] = $opacity;
        }
        $color = "rgba(".implode(', ', $color).")";
        return $color;
    }
}

/*
 * Convert HEX to Dark & Lighten
 */
function jobzilla_lighten( $hex, $percent ) {
    
    /* validate hex string */
    
    $hex = preg_replace( '/[^0-9a-f]/i', '', $hex );
    $new_hex = '#';
    
    if ( strlen( $hex ) < 6 ) {
        $hex = $hex[0] + $hex[0] + $hex[1] + $hex[1] + $hex[2] + $hex[2];
    }
    
    /* convert to decimal and change luminosity */
    for ($i = 0; $i < 3; $i++) {
        $dec = hexdec( substr( $hex, $i*2, 2 ) );
        $dec = min( max( 0, $dec + $dec * $percent ), 255 ); 
        $new_hex .= str_pad( dechex( $dec ) , 2, 0, STR_PAD_LEFT );
    }       
    
    return $new_hex;
}

class CSS_Generator
{
    /**
     * scssc class instance
     *
     * @access protected
     * @var scssc
     */
    protected $scssc = null;

    /**
     * ReduxFramework class instance
     *
     * @access protected
     * @var ReduxFramework
     */
    protected $redux = null;

    /**
     * Debug mode is turn on or not
     *
     * @access protected
     * @var boolean
     */
    protected $dev_mode = true;

    /**
     * opt_name of ReduxFramework
     *
     * @access protected
     * @var string
     */
    protected $opt_name = '';


    /**
     * Constructor
     */
    function __construct() {
        $this->opt_name = jobzilla_get_opt_name();
			
        if ( empty( $this->opt_name ) ) {
            return;
        }
		$this->dev_mode = jobzilla_get_opt( 'dev_mode', '0' ) === '1' ? true : false;
			
		add_action( 'init', array( $this, 'init' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue' ), 20 );
		
		
    }

    /**
     * init hook - 10
     */
    function init() {
	
        if ( ! class_exists( 'DZscssc' ) ) {
            return;
        }
        $this->redux = ReduxFrameworkInstances::get_instance( $this->opt_name );

        if ( empty( $this->redux ) || ! $this->redux instanceof ReduxFramework ) {
            return;
        }		
        add_action( 'wp', array( $this, 'generate_with_dev_mode' ) );
        add_action( "redux/options/{$this->opt_name}/saved", function () {
            $this->generate_file();
        } );		
    }			

    function generate_with_dev_mode() {
        if ( $this->dev_mode === true ) {
            $this->generate_file();
        }
    }

    /**
     * Generate options and css files
     */
    function generate_file() {
	
        $scss_dir = get_template_directory() . '/assets/css/skin/scss/';
        $css_dir  = get_template_directory() . '/assets/css/skin/';
		
        $this->scssc = new DZscssc();
        $this->scssc->setImportPaths( $scss_dir );
	
        $_options = $scss_dir . 'variable.scss';
		
		
        $this->redux->filesystem->execute( 'put_contents', $_options, array(
            'content' => preg_replace( "/(?<=[^\r]|^)\n/", "\r\n", $this->options_output() )
        ) );
        $css_file = $css_dir . 'theme.css';	
		
        $this->scssc->setFormatter( 'DZscss_formatter' );
        $this->redux->filesystem->execute( 'put_contents', $css_file, array(
            'content' => preg_replace( "/(?<=[^\r]|^)\n/", "\r\n", $this->scssc->compile( '@import "theme.scss"' ) )
			
        ) );
    }
    /**
     * Output options to _variables.scss
     *
     * @access protected
     * @return string
     */
    protected function options_output()
    {
		
        ob_start();		
        $primary_color = jobzilla_get_opt( 'primary_color', '#ff5ea5' );
		
        if ( ! jobzilla_is_valid_color( $primary_color ) ){
            $primary_color = '#ff5ea5';
        }
        printf( '$primary_color: %s;', esc_attr( $primary_color ) );

        $secondary_color = jobzilla_get_opt( 'secondary_color', '#00becf' );
        if ( ! jobzilla_is_valid_color( $secondary_color ) ){
            $secondary_color = '#00becf';
        }
        printf( '$secondary_color: %s;', esc_attr( $secondary_color ) );

        $link_color = jobzilla_get_opt( 'link_color', '#ff5ea5' );
        if ( !empty($link_color['regular']) && isset($link_color['regular']) ){
            printf( '$link_color: %s;', esc_attr( $link_color['regular'] ) );
        }else {
            echo '$link_color: #ff5ea5;';
        }

        $link_color_hover = jobzilla_get_opt( 'link_color', '#e54d90' );
        if ( !empty($link_color['hover']) && isset($link_color['hover']) ){
            printf( '$link_color_hover: %s;', esc_attr( $link_color['hover'] ) );
        }else {
            echo '$link_color_hover: #e54d90;';
        }

        $link_color_active = jobzilla_get_opt( 'link_color', '#e54d90' );
        if ( !empty($link_color['active']) && isset($link_color['active']) ){
            printf( '$link_color_active: %s;', esc_attr( $link_color['active'] ) );
        } else {
            echo '$link_color_active: #e54d90;';
        }

        /* Font */
        $body_default_font = jobzilla_get_opt( 'body_default_font', 'Lato' );
        if (isset($body_default_font)) {
            echo '
                $body_default_font: '.esc_attr( $body_default_font ).';
            ';
        }

        $heading_default_font = jobzilla_get_opt( 'heading_default_font', 'Nunito' );
        if (isset($heading_default_font)){
            echo '
                $heading_default_font: '.esc_attr( $heading_default_font ).';
            ';
        }
		
		$rounded_corner = jobzilla_get_opt( 'theme_corner_rounded', 10 );
        if (isset($rounded_corner)){
            echo '
                $rounded_corner: '.esc_attr( $rounded_corner ).'px;
            ';
        }
        return ob_get_clean();		
    }

    /**
     * Hooked wp_enqueue_scripts - 20
     * Make sure that the handle is enqueued from earlier wp_enqueue_scripts hook.
     */
    function enqueue(){
        $css = $this->inline_css();
        if ( !empty($css) ){
            wp_add_inline_style( 'jobzilla-theme', $this->dev_mode ? $css : jobzilla_css_minifier( $css ) );
        }
    }

    /**
     * Generate inline css based on theme options
     */
    protected function inline_css(){
        ob_start();
        /* BG Body */
        $body_background = jobzilla_get_opt( 'body_background' );
        $layout_boxed = jobzilla_get_opt( 'layout_boxed', false );
        $layout_boxed_page = jobzilla_get_page_opt( 'layout_boxed', false );
        if($layout_boxed_page) {
            $layout_boxed = $layout_boxed_page;
        }
        if($layout_boxed && isset($body_background)) {
            echo 'body {
                background-color: '.esc_attr( $body_background['background-color'] ).';
                background-size: '.esc_attr( $body_background['background-size'] ).';
                background-attachment: '.esc_attr( $body_background['background-attachment'] ).';
                background-repeat: '.esc_attr( $body_background['background-repeat'] ).';
                background-position: '.esc_attr( $body_background['background-position'] ).';
                background-image: url('.esc_attr( $body_background['background-image'] ).');
            }';
        }

        /* Header */
        $custom_header = jobzilla_get_page_opt( 'custom_header', false );
        $h_bg_color = jobzilla_get_opt( 'h_bg_color' );
        $h_bg_top_color = jobzilla_get_opt( 'h_bg_top_color' );
        $h_text_top_color = jobzilla_get_opt( 'h_text_top_color' );
        $h_link_top_color = jobzilla_get_opt( 'h_link_top_color' );
        if(!empty($h_bg_top_color)) {
            echo '#header-wrap #header-top-bar {
                background-color: '.esc_attr( $h_bg_top_color ).' !important;
            }';
        }
        if(!empty($h_text_top_color)) {
            echo '#header-wrap #header-top-bar, #header-wrap .top-bar-contact li a, #header-wrap .top-bar-social a, #header-top-bar .site-menu-right .h-btn-cart {
                color: '.esc_attr( $h_text_top_color ).' !important;
            }';
        }
        if(!empty($h_link_top_color)) {
            echo '#header-wrap #header-topbar a {
                color: '.esc_attr( $h_link_top_color ).' !important;
            }';
        }
        if(!empty($h_bg_color)) {
            echo '#header-wrap #header-main.header-main {
                background-color: '.esc_attr( $h_bg_color ).';
            }';
        }

        /* Logo */
        $logo_maxh = jobzilla_get_opt( 'logo_maxh' );
        $logo_maxh_page = jobzilla_get_page_opt( 'logo_maxh' );
        if($custom_header && !empty($logo_maxh_page['height'])) {
            $logo_maxh['height'] = $logo_maxh_page['height'];
        }
        if (!empty($logo_maxh['height']) && $logo_maxh['height'] != 'px'){
            printf( '#header-wrap .header-branding a img { max-height: %s; }', esc_attr($logo_maxh['height']) );
        }

        /* Menu */
        $menu_text_transform = jobzilla_get_opt( 'menu_text_transform' );
        if ( !empty( $menu_text_transform ) ) {
            printf( '.primary-menu > li > a { text-transform: %s !important; }', esc_attr($menu_text_transform) );
        }
        $menu_font_size = jobzilla_get_opt( 'menu_font_size' );
        if ( !empty( $menu_font_size ) ) {
            printf( '.primary-menu > li > a { font-size: %s'.'px !important; }', esc_attr($menu_font_size) );
        }
        $main_menu_color = jobzilla_get_opt( 'main_menu_color' );
        if ( !empty( $main_menu_color['regular'] ) ) {
            printf( '.primary-menu > li > a { color: %s !important; }', esc_attr($main_menu_color['regular']) );
        }
        if ( !empty( $main_menu_color['hover'] ) ) {
            printf( '.primary-menu > li > a:hover { color: %s !important; }', esc_attr($main_menu_color['hover']) );
        }
        if ( !empty( $main_menu_color['active'] ) ) {
            printf( '.primary-menu > li > a.current, .primary-menu > li.current_page_item > a, .primary-menu > li.current-menu-item > a, .primary-menu > li.current_page_ancestor > a, .primary-menu > li.current-menu-ancestor > a { color: %s !important; }', esc_attr($main_menu_color['active']) );
        }
        $header_layout = jobzilla_get_opt( 'header_layout', '1' );
        $main_menu_bgcolor = jobzilla_get_opt( 'main_menu_bgcolor' );
        if($header_layout == '8' && !empty( $main_menu_bgcolor['hover'] ) ) {
            printf( '.header-layout8 .primary-menu > li > a:hover { background-color: %s !important; }', esc_attr($main_menu_bgcolor['hover']) );
        }
        if($header_layout == '8' && !empty( $main_menu_bgcolor['active'] ) ) {
            printf( '.header-layout8 .primary-menu > li > a.current, .header-layout8 .primary-menu > li.current_page_item > a, .header-layout8 .primary-menu > li.current-menu-item > a, .header-layout8 .primary-menu > li.current_page_ancestor > a, .header-layout8 .primary-menu > li.current-menu-ancestor > a { background-color: %s !important; }', esc_attr($main_menu_bgcolor['active']) );
        }

        /* Footer */
        $footer_bg = jobzilla_get_opt( 'footer_bg' );
        $footer_bg_color_top = jobzilla_get_opt( 'footer_bg_color_top' );
        $footer_top_heading_color = jobzilla_get_opt( 'footer_top_heading_color' );
        $footer_top_heading_fs = jobzilla_get_opt( 'footer_top_heading_fs' );
        $footer_top_paddings = jobzilla_get_opt( 'footer_top_paddings' );
        if(!empty($footer_bg['background-color'])) {
            echo '.site-layout-default .site-footer {
                margin-top: 0px;
            }';
            echo '.site-layout-default .site-footer:before {
                display: none;
            }';
        }
        if(!empty($footer_bg_color_top)) {
            echo '.site-footer:before {
                background-color: '.esc_attr( $footer_bg_color_top['rgba'] ).' !important;
            }';
        }
        if(!empty($footer_top_heading_color)) {
            echo '.top-footer .footer-widget-title {
                color: '.esc_attr( $footer_top_heading_color ).' !important;
            }';
        }
        if(!empty($footer_top_heading_fs)) {
            echo '.top-footer .footer-widget-title {
                font-size: '.esc_attr( $footer_top_heading_fs ).'px !important;
            }';
        }
        if ( isset($footer_top_paddings) && !empty($footer_top_paddings) ) {
            if(!empty($footer_top_paddings['padding-top'])) {
                echo ".site-footer {
                    padding-top:" .esc_attr($footer_top_paddings['padding-top']). " !important;
                }";
            }
            if(!empty($footer_top_paddings['padding-bottom'])) {
                echo ".site-footer .top-footer {
                    padding-bottom:" .esc_attr($footer_top_paddings['padding-bottom']). " !important;
                }";
            }
        }

        /* Content */
        $post_text_align = jobzilla_get_opt( 'post_text_align', 'inherit' );
        if($post_text_align == 'justify') {
            echo '.single-post .content-area .entry-content p {
                text-align: justify;
            }';
        }

        /* Footer */
        $footer_top_link_color = jobzilla_get_page_opt( 'footer_top_link_color' );
        if(!empty($footer_top_link_color['hover'])) {

            echo '.contact-info ul li i, .site-footer .top-footer ul.menu li a::before,
            .site-footer .bottom-footer .footer-social a:hover,
            .site-footer .top-footer #ctf.ctf .ctf-author-name::before,
            .site-footer .top-footer #ctf.ctf .ctf-author-name:hover {
                color: '.esc_attr( $footer_top_link_color['hover'] ).';
            }';
        }

        /* Custom Css */
        $custom_css = jobzilla_get_opt( 'site_css' );
        if(!empty($custom_css)) { echo esc_attr($custom_css); }

        return ob_get_clean();
    }
}

new CSS_Generator();