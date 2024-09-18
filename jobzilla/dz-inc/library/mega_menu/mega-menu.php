<?php
class Jobzilla_Custom_Mega_Menu {
	/**
	 * Initializes the plugin by setting localization, filters, and administration functions.
	 */
	function __construct() {			
		/* add custom menu fields to menu */
		add_filter( 'wp_setup_nav_menu_item', array( $this, 'mega_menu_add_custom_nav_fields' ) );
		
		/* save menu custom fields */
		add_action( 'wp_update_nav_menu_item', array( $this, 'mega_menu_update_custom_nav_fields'), 10, 3 );
		
		/* edit menu walker */
		add_filter( 'wp_edit_nav_menu_walker', array( $this, 'mega_menu_edit_walker'), 10, 2 );
	} 
	
	/**
	 * Add custom fields to $item nav object
	 * in order to be used in custom Walker
	 *
	 * @access      public
	 * @since       1.0 
	 * @return      void
	*/
	function mega_menu_add_custom_nav_fields( $menu_item ) {	
	    $menu_item->mega_menu_cat = get_post_meta( $menu_item->ID, 'mega_menu_cat', true );
	    return $menu_item;	    
	}
	
	/**
	 * Save menu custom fields
	 *
	 * @access      public
	 * @since       1.0 
	 * @return      void
	*/
	function mega_menu_update_custom_nav_fields( $menu_id, $menu_item_db_id, $args ) {	
		if( isset($_REQUEST['mega_menu_cat_'. $menu_item_db_id]) )	{
			if ( is_array($_REQUEST['mega_menu_cat_'. $menu_item_db_id]) ){			
				$mega_menu_cat_array = array_filter($_REQUEST['mega_menu_cat_'. $menu_item_db_id]);
				$mega_menu_no_of_post = sanitize_text_field($_REQUEST['mega_menu_no_of_post_'. $menu_item_db_id]);
				$mega_menu_images_only = isset($_REQUEST['mega_menu_images_only_'. $menu_item_db_id]) ? sanitize_text_field($_REQUEST['mega_menu_images_only_'. $menu_item_db_id]) : 'no';
				
				if(count( $mega_menu_cat_array) > 0){
					$mega_menu_cat_value = implode(",", $mega_menu_cat_array);
					$mega_menu_cat_value = wp_kses($mega_menu_cat_value,'string');
					$mega_menu_no_of_post = wp_kses($mega_menu_no_of_post,'string');
					$mega_menu_images_only = wp_kses($mega_menu_images_only,'string');
					update_post_meta( $menu_item_db_id, 'mega_menu_cat', $mega_menu_cat_value );
					update_post_meta( $menu_item_db_id, 'mega_menu_no_of_post', $mega_menu_no_of_post );
					update_post_meta( $menu_item_db_id, 'mega_menu_images_only', $mega_menu_images_only );
				}	
				else
				{
					delete_post_meta($menu_item_db_id, 'mega_menu_cat');
					delete_post_meta($menu_item_db_id, 'mega_menu_no_of_post');
					delete_post_meta($menu_item_db_id, 'mega_menu_images_only');
				}
			}	
		}		    
	}
	
	/**
	 * Define new Walker edit
	 *
	 * @access      public
	 * @since       1.0 
	 * @return      void
	*/
	function mega_menu_edit_walker($walker,$menu_id) {	
	    return 'Jobzilla_Walker_Nav_Mega_Menu_Edit';	    
	}
}

new Jobzilla_Custom_Mega_Menu();

include_once( 'edit_mega_menu_walker.php' );
include_once( 'mega_menu_walker.php' );