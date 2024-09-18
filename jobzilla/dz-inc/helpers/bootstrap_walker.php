<?php
/**
 * Class Name: wp_bootstrap_navwalker * 
 * Description: A custom WordPress nav walker class to implement the Bootstrap 3 navigation style in a custom theme using the WordPress built in menu manager.
 * Version: 2.0.4
 * Author: DexignZone
 * License: GPL-2.0+
 */
class Bootstrap_walker extends Walker_Nav_Menu {
	/**
	 * @see Walker::start_lvl()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int $depth Depth of page. Used for padding.
	 */
	
	public function start_lvl( &$output, $depth = 0, $args = array() ) {		
			$indent = str_repeat( "\t", $depth );
			$output .= "\n$indent<ul role=\"menu\" class=\"sub-menu\">\n";		
	}
	/**
	 * @see Walker::start_el()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item Menu item data object.
	 * @param int $depth Depth of menu item. Used for padding.
	 * @param int $current_page Menu item ID.
	 * @param object $args
	 */
	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {		
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';		
		
		/**
		 * Dividers, Headers or Disabled
		 * =============================
		 * Determine whether the item is a Divider, Header, Disabled or regular
		 * menu item. To prevent errors we use the strcasecmp() function to so a
		 * comparison that is not case sensitive. The strcasecmp() function returns
		 * a 0 if the strings are equal.
		 */		

		if ( strcasecmp( $item->attr_title, 'divider' ) == 0 && $depth === 1 ) {	
			$output .= $indent . '<li role="presentation" class="divider">';
		} else if ( strcasecmp( $item->title, 'divider') == 0 && $depth === 1 ) {
			$output .= $indent . '<li role="presentation" class="divider">';
		} else if ( strcasecmp( $item->attr_title, 'dropdown-header') == 0 && $depth === 1 ) {
			$output .= $indent . '<li role="presentation" class="dropdown-header">' . esc_html( $item->title );
		} else if ( strcasecmp($item->attr_title, 'disabled' ) == 0 ) {
			$output .= $indent . '<li role="presentation" class="disabled"><a href="javascrip:void(0);">' . esc_html( $item->title ) . '</a>';
		} 
		else 
		{			
			$mega_menu_cat = get_post_meta($item->ID, 'mega_menu_cat', true);
			$mega_menu_no_of_post = get_post_meta($item->ID, 'mega_menu_no_of_post', true);		
			$mega_menu_images_only = get_post_meta($item->ID, 'mega_menu_images_only', true);
			$class_names = $value = '';
			$classes = empty( $item->classes ) ? array() : (array) $item->classes;
			$classes[] = 'menu-item-' . $item->ID;
			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
			
			if ( $args->has_children ){
				$class_names .= ' dropdown sub-menu-down';			
			}
			if ( in_array( 'current-menu-ancestor', $classes ) ){
				$class_names .= ' active';
			}
			if ( in_array( 'current_page_item', $classes ) ){
				$class_names .= ' active';
			}
			if ( $mega_menu_cat ) {			
				$class_names .= ' has-mega-menu post-slider life-style menu-item-has-children dropdown ';					
			}
			
			$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
			$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
			$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';			
			
			 if ( !empty($mega_menu_cat) ) {	
				$output .= $indent . '<li' . $id . $value . $class_names .'><a href="#">' . esc_html( $item->title ) . '</a>';				
				
				$jobzilla_categories_default_args = array(						
						'orderby'            => 'name',
						'order'              => 'ASC',						
						'hide_empty'         => 1,						
						'include'            => $mega_menu_cat, 					
						'taxonomy'           => 'category',
				  );
				$categories = get_categories($jobzilla_categories_default_args);				
				$page_no = 1;	
				$no_of_posts = $mega_menu_no_of_post;	
				$query_args = array(	
					'post_type' 		=> 'post',
					'post_status' 		=> 'publish',		
					'posts_per_page'   	=> $no_of_posts, /* posts_per_page = -1 shows all posts */
					'paged' 			=> $page_no,	
					'cat' 				=> $mega_menu_cat,
					'ignore_sticky_posts' => true,
					'orderby' 			=> 'date',
					'order' 			=> 'DESC',					
				);		
				
				if($mega_menu_images_only == 'yes')
				{		
					$query_args['meta_query'] = array(
						array(
						 'key' => '_thumbnail_id',
						 'compare' => 'EXISTS'
						),
					);
				}	
				
				$query = new WP_Query($query_args);	

				if($query->have_posts()){						
					$mm_nonce = $item->ID;	

					$output .= '<div class="mega-menu mega-menu_'. $mm_nonce .'">
									<div class="life-style-bx">
										<div class="life-style-tabs">
											<ul>
												<li><a href="javascript:void(0);" id="st_all_'. $mm_nonce .'" class="post-tabs_'. $mm_nonce .' post-tabs active" data-category-slug="all" data-posts-per-page="'.$no_of_posts.'" data-cat-id="'.$query_args['cat'].'" data-images-only="'.$mega_menu_images_only.'" >All</a></li>';
												foreach($categories as $category){
												
												
												$output .= '<li><a href="javascript:void(0);" rel="'. esc_url(get_category_link( $category->term_id )) .'" id="st_'. $category->slug . '_' . $mm_nonce .'" class="relTohref post-tabs_'. $mm_nonce .' post-tabs"  data-posts-per-page="'.$no_of_posts.'" data-cat-id="'.  esc_attr($category->term_id).'" data-images-only="'.$mega_menu_images_only.'">'. wp_kses_post($category->name) .'</a></li>';
												
												
												}								
										
					$output .= 				'</ul>
										</div>';								
					$output .= 			'<div class="life-style-post text-center">
											<div id="all_'. $mm_nonce .'" class="life-style-post-bx life-style-post-bx_'. $mm_nonce .' show">';
												
													set_query_var( 'query', $query );	
													ob_start();		
													get_template_part('dz-inc/ajax/mega_menu_ajax');		
													$output .= ob_get_clean();
					$output .= 	'			</div>';
											
								foreach($categories as $category){
								$output .=	'<div id="'. $category->slug . '_' . $mm_nonce .'" class="life-style-post-bx life-style-post-bx_'. $mm_nonce .'"></div>';
								}		
		
						$output .= 		'</div>
									</div>
								</div>';						
				}
				wp_reset_postdata();	
			}
			else{	
				$output .= $indent . '<li' . $id . $value . $class_names .'>';			
			}	
			$atts = array();
			$atts['title']  = ! empty( $item->attr_title )	? $item->attr_title	: '';
			$atts['target'] = ! empty( $item->target )	? $item->target	: '';
			$atts['rel']    = ! empty( $item->xfn )		? $item->xfn	: '';
			/* If item has_children add atts to a. */
			if ( $args->has_children && $depth === 0 ) {
				$atts['href']   		= ! empty( $item->url ) ? $item->url : '';
				$atts['data-toggle']	= 'dropdown1';
				$atts['class']			= '';
				$atts['aria-expanded']	= 'false';
			} else {
				$atts['href'] = ! empty( $item->url ) ? $item->url : '';				
			}
			if ( $depth == 0 ){
					$atts['class'] = 'hvr-underline-from-left1';
					$atts['data-scroll data-options'] = 'easing: easeOutQuart';
			
			}
			$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );
			$attributes = '';
			foreach ( $atts as $attr => $value ) {
				if ( ! empty( $value ) ) {
					$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
					$attributes .= ' ' . $attr . '="' . $value . '"';
				}
			}
			$item_output = $args->before;
			/*
			 * Glyphicons
			 * ===========
			 * Since the the menu item is NOT a Divider or Header we check the see
			 * if there is a value in the attr_title property. If the attr_title
			 * property is NOT null we apply it as the class name for the glyphicon.
			 */
			
			if(!$mega_menu_cat){	
				if ( $args->has_children && 0 === $depth ){
					$item_output .= '<a'. $attributes .'>'.$args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . '' . $args->link_after.'</a>';
				}elseif ( $args->has_children && 1 === $depth ){
					$item_output .= '<a'. $attributes .'>'.$args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . '' . $args->link_after.'</a>';
				}
				else{
					$item_output .= '<a'. $attributes .'>'.$args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after.'</a>';
				}
			}

			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );			
		}
	}
	/**
	 * Traverse elements to create list from elements.
	 *
	 * Display one element if the element doesn't have any children otherwise,
	 * display the element and its children. Will only traverse up to the max
	 * depth and no ignore elements under that depth.
	 *
	 * This method shouldn't be called directly, use the walk() method instead.
	 *
	 * @see Walker::start_el()
	 * @since 2.5.0
	 *
	 * @param object $element Data object
	 * @param array $children_elements List of elements to continue traversing.
	 * @param int $max_depth Max depth to traverse.
	 * @param int $depth Depth of current element.
	 * @param array $args
	 * @param string $output Passed by reference. Used to append additional content.
	 * @return null Null on failure with no changes to parameters.
	 */
	public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
        if ( ! $element ){
            return;
		}
        $id_field = $this->db_fields['id'];
        
        if ( is_object( $args[0] ) ){
           $args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] );
		}
        parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
    }
	/**
	 * Menu Fallback
	 * =============
	 * If this function is assigned to the wp_nav_menu's fallback_cb variable
	 * and a manu has not been assigned to the theme location in the WordPress
	 * menu manager the function with display nothing to a non-logged in user,
	 * and will add a link to the WordPress menu manager if logged in as an admin.
	 *
	 * @param array $args passed from the wp_nav_menu function.
	 *
	 */
	public static function fallback( $args ) {
		if ( current_user_can( 'manage_options' ) ) {
			$a = current_user_can( 'manage_options' );
			
			extract( $args );
			$fb_output = null;
			if ( $container ) {
				$fb_output = '<' . $container;
				if ( $container_id ){
					$fb_output .= ' id="' . $container_id . '"';
				}	
				if ( $container_class ){
					$fb_output .= ' class="' . $container_class . '"';
				}	
				$fb_output .= '>';
			}
			$fb_output .= '<ul';
			if ( $menu_id ){
				$fb_output .= ' id="' . $menu_id . '"';
			}
			if ( $menu_class ){
				$fb_output .= ' class="' . $menu_class . '"';
			}
			$fb_output .= '>';
			
			$fb_output .= '<li><a href="' . esc_url(admin_url( 'nav-menus.php' )) . '">Add a menu</a></li>';
			$fb_output .= '</ul>';
			if ( $container ){
				$fb_output .= '</' . $container . '>';
			}
			echo  wp_kses_post($fb_output);
		}
	}
}