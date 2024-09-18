<?php
/**
 *  /!\ This is a copy of Walker_Nav_Menu_Edit class in core
 * 
 * Create HTML list of nav menu input items.
 *
 * @package WordPress
 * @since 3.0.0
 * @uses Walker_Nav_Menu
 */
class Jobzilla_Walker_Nav_Mega_Menu_Edit extends Walker_Nav_Menu  {
	/**
	 * @see Walker_Nav_Menu::start_lvl()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference.
	 */
	public function start_lvl( &$output, $depth = 0, $args = array() ) {}	
	
	/**
	 * @see Walker_Nav_Menu::end_lvl()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference.
	 */
	public function end_lvl( &$output, $depth = 0, $args = array() ) {} 
	
	/**
	 * @see Walker::start_el()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item Menu item data object.
	 * @param int $depth Depth of menu item. Used for padding.
	 * @param object $args
	 */
	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
	    global $_wp_nav_menu_max_depth;	   
	    $_wp_nav_menu_max_depth = $depth > $_wp_nav_menu_max_depth ? $depth : $_wp_nav_menu_max_depth;	
	    $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';	
	    ob_start();
	    $item_id = esc_attr( $item->ID );
	    $removed_args = array(
	        'action',
	        'customlink-tab',
	        'edit-menu-item',
	        'menu-item',
	        'page-tab',
	        '_wpnonce',
	    );
		
	    $original_title = '';
	    if ( 'taxonomy' == $item->type ) {
	        $original_title = get_term_field( 'name', $item->object_id, $item->object, 'raw' );
	        if ( is_wp_error( $original_title ) )
	            $original_title = false;
	    } elseif ( 'post_type' == $item->type ) {
	        $original_object = get_post( $item->object_id );
	        $original_title = $original_object->post_title;
	    }
		
		$menu_status_class = ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? 'active' : 'inactive';
	    $classes = array(
	        'menu-item menu-item-depth-' . $depth,
	        'menu-item-' . esc_attr( $item->object ),
	        'menu-item-edit-' . esc_attr($menu_status_class),
	    );
	
	    $title = $item->title;
	
	    if ( ! empty( $item->_invalid ) ) {
	        $classes[] = 'menu-item-invalid';
	        /* translators: %s: title of menu item which is invalid */
	        $title = sprintf( esc_attr_e( '%s (Invalid)', 'jobzilla' ), $item->title );
	    } elseif ( isset( $item->post_status ) && 'draft' == $item->post_status ) {
	        $classes[] = 'pending';
	        /* translators: %s: title of menu item in draft status */
	        $title = sprintf('%s (Pending)', $item->title );
	    }
	
	    $title = empty( $item->label ) ? $title : $item->label;
		$menu_item_classes = implode(' ', $classes );
	    ?>
	    <li id="menu-item-<?php echo esc_attr($item_id); ?>" class="<?php echo esc_attr($menu_item_classes); ?>">
	        <dl class="menu-item-bar">
	            <dt class="menu-item-handle">
	                <span class="item-title"><?php echo esc_html( $title ); ?></span>
	                <span class="item-controls">
	                    <span class="item-type"><?php echo esc_html( $item->type_label ); ?></span>
	                    <span class="item-order hide-if-js">
	                        <a href="<?php
	                            echo wp_nonce_url(
	                                add_query_arg(
	                                    array(
	                                        'action' => 'move-up-menu-item',
	                                        'menu-item' => $item_id,
	                                    ),
	                                    remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
	                                ),
	                                'move-menu_item'
	                            );
	                        ?>" class="item-move-up"><abbr title="<?php esc_attr_e('Move up', 'jobzilla'); ?>">&#8593;</abbr></a>
	                        |
	                        <a href="<?php
	                            echo wp_nonce_url(
	                                add_query_arg(
	                                    array(
	                                        'action' => 'move-down-menu-item',
	                                        'menu-item' => $item_id,
	                                    ),
	                                    remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
	                                ),
	                                'move-menu_item'
	                            );
	                        ?>" class="item-move-down"><abbr title="<?php esc_attr_e('Move down', 'jobzilla'); ?>">&#8595;</abbr></a>
	                    </span>
	                    <a class="item-edit" id="edit-<?php echo esc_attr($item_id); ?>" title="<?php esc_attr_e('Edit Menu Item', 'jobzilla'); ?>" href="<?php
	                        echo esc_url(( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? admin_url( 'nav-menus.php' ) : add_query_arg( 'edit-menu-item', $item_id, remove_query_arg( $removed_args, admin_url( 'nav-menus.php#menu-item-settings-' . $item_id ) ) ));
	                    ?>"></a>
	                </span>
	            </dt>
	        </dl>
	
	        <div class="menu-item-settings wp-clearfix" id="menu-item-settings-<?php echo esc_attr($item_id); ?>">
	            <?php if( 'custom' == $item->type ) : ?>
	                <p class="field-url description description-wide">
	                    <label for="edit-menu-item-url-<?php echo esc_attr($item_id); ?>">
	                        <?php esc_html_e( 'URL', 'jobzilla' ); ?><br />
	                        <input type="text" id="edit-menu-item-url-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-url" name="menu-item-url[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->url ); ?>" />
	                    </label>
	                </p>
	            <?php endif; ?>
	            <p class="description description-thin">
	                <label for="edit-menu-item-title-<?php echo esc_attr($item_id); ?>">
	                    <?php esc_html_e( 'Navigation Label', 'jobzilla' );?><br />
	                    <input type="text" id="edit-menu-item-title-<?php echo esc_attr($item_id); ?>" class="widefat edit-menu-item-title" name="menu-item-title[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->title ); ?>" />
	                </label>
	            </p>
	            <p class="description description-thin">
	                <label for="edit-menu-item-attr-title-<?php echo esc_attr($item_id); ?>">
	                    <?php esc_html_e( 'Title Attribute', 'jobzilla' );?><br />
	                    <input type="text" id="edit-menu-item-attr-title-<?php echo esc_attr($item_id); ?>" class="widefat edit-menu-item-attr-title" name="menu-item-attr-title[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->post_excerpt ); ?>" />
	                </label>
	            </p>
	            <p class="field-link-target description">
	                <label for="edit-menu-item-target-<?php echo esc_attr($item_id); ?>">
	                    <input type="checkbox" id="edit-menu-item-target-<?php echo esc_attr($item_id); ?>" value="_blank" name="menu-item-target[<?php echo esc_attr($item_id); ?>]"<?php checked( $item->target, '_blank' ); ?> />
	                    <?php esc_html_e( 'Open link in a new window/tab', 'jobzilla' );?>
	                </label>
	            </p>
	            <p class="field-css-classes description description-thin">
	                <label for="edit-menu-item-classes-<?php echo esc_attr($item_id); ?>">
	                    <?php esc_html_e( 'CSS Classes (optional)', 'jobzilla' );?><br />
	                    <input type="text" id="edit-menu-item-classes-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-classes" name="menu-item-classes[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( implode(' ', $item->classes ) ); ?>" />
	                </label>
	            </p>
	            <p class="field-xfn description description-thin">
	                <label for="edit-menu-item-xfn-<?php echo esc_attr($item_id); ?>">
	                    <?php esc_html_e( 'Link Relationship (XFN)', 'jobzilla' );?><br />
	                    <input type="text" id="edit-menu-item-xfn-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-xfn" name="menu-item-xfn[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->xfn ); ?>" />
	                </label>
	            </p>
	            <p class="field-description description description-wide">
	                <label for="edit-menu-item-description-<?php echo esc_attr($item_id); ?>">
	                    <?php esc_html_e( 'Description', 'jobzilla' );?><br />
	                    <textarea id="edit-menu-item-description-<?php echo esc_attr($item_id); ?>" class="widefat edit-menu-item-description" rows="3" cols="20" name="menu-item-description[<?php echo esc_attr($item_id); ?>]"><?php echo esc_html( $item->description ); ?></textarea>
	                    <span class="description"><?php esc_html_e( 'The description will be displayed in the menu if the current theme supports it.', 'jobzilla' );?></span>
	                </label>
	            </p>        
<?php
/* Read the menu setting from post meta (menu id, key, single) */
$mega_menu_cat = get_post_meta($item->ID, 'mega_menu_cat', true);
$mega_menu_no_of_post = get_post_meta($item->ID, 'mega_menu_no_of_post', true);
$mega_menu_images_only = get_post_meta($item->ID, 'mega_menu_images_only', true);
$mega_menu_no_of_post = !empty($mega_menu_no_of_post) ? $mega_menu_no_of_post : 6;
$mega_menu_images_only = !empty($mega_menu_images_only) ? $mega_menu_images_only : "no";
$mega_menu_cat = explode(',',$mega_menu_cat);

/* Make the tree */
$category_tree = array_merge (array(' - Not mega menu - ' => '0'), mega_menu_util::
get_category_to_id_array(false));
/* New fields insertion starts here */
?>
				<p class="description description-wide"><br><br>
					<label><?php esc_html_e('Make this a category mega menu', 'jobzilla');?></label>
					<select name="mega_menu_cat_<?php echo esc_attr($item->ID) ;?>[]" size="8" multiple="multiple" class="widefat code edit-menu-item-url">
				<?php 
					foreach ($category_tree as $category => $category_id) { ?>
						<option value="<?php echo esc_attr($category_id);?>"
						<?php
						if(in_array($category_id,$mega_menu_cat)){ ?>
						 selected="selected" 
						 <?php
						}
						?> ><?php echo wp_kses($category, 'string'); ?>
						</option>
						
					<?php	
					}
					?></select>
				</p>					
				<p class="field-no-of-post description description-wide">
					<label><?php esc_html_e('No. of post per category (Default 6)', 'jobzilla');?><br/>
					<input type="text" name="mega_menu_no_of_post_<?php echo esc_attr($item->ID) ;?>" value="<?php echo esc_attr($mega_menu_no_of_post);?>" >
					</label>									
				</p>
				<?php
					$is_mega_menu_images_only = ($mega_menu_images_only == "yes") ? 'checked="checked"' : '';
				?>
				<p class="field-no-of-post description description-wide">
					<label><?php esc_html_e('Posts With Images Only: (Default No)', 'jobzilla');?><br/>
					<input type="checkbox" <?php echo esc_attr($is_mega_menu_images_only) ;?> name="mega_menu_images_only_<?php echo esc_attr($item->ID) ;?>" value="yes" >
					</label>									
				</p>
<?php
/* New fields insertion ends here */
?>
	            <div class="menu-item-actions description-wide submitbox">
	                <?php if( 'custom' != $item->type && $original_title !== false ) : ?>
	                    <p class="link-to-original">
	                        <?php printf( esc_html_e('Original: %s', 'jobzilla'), '<a href="' . esc_attr( $item->url ) . '">' . esc_html( $original_title ) . '</a>' ); ?>
	                    </p>
	                <?php endif; ?>
	                <a class="item-delete submitdelete deletion" id="delete-<?php echo esc_attr($item_id); ?>" href="<?php
	                echo wp_nonce_url(
	                    add_query_arg(
	                        array(
	                            'action' => 'delete-menu-item',
	                            'menu-item' => $item_id,
	                        ),
	                        remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
	                    ),
	                    'delete-menu_item_' . $item_id
	                ); ?>"><?php esc_html_e( 'Remove', 'jobzilla' );?></a> <span class="meta-sep"> | </span> <a class="item-cancel submitcancel" id="cancel-<?php echo esc_attr($item_id); ?>" href="<?php echo esc_url( add_query_arg( array('edit-menu-item' => $item_id, 'cancel' => time()), remove_query_arg( $removed_args, admin_url( 'nav-menus.php' ) ) ) );
	                    ?>#menu-item-settings-<?php echo esc_attr($item_id); ?>"><?php esc_html_e( 'Cancel', 'jobzilla' );?></a>
	            </div>
	
	            <input class="menu-item-data-db-id" type="hidden" name="menu-item-db-id[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr($item_id); ?>" />
	            <input class="menu-item-data-object-id" type="hidden" name="menu-item-object-id[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr($item->object_id); ?>" />
	            <input class="menu-item-data-object" type="hidden" name="menu-item-object[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr($item->object); ?>" />
	            <input class="menu-item-data-parent-id" type="hidden" name="menu-item-parent-id[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr($item->menu_item_parent) ; ?>" />
	            <input class="menu-item-data-position" type="hidden" name="menu-item-position[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr($item->menu_order) ; ?>" />
	            <input class="menu-item-data-type" type="hidden" name="menu-item-type[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr($item->type) ; ?>" />
	        </div><!-- .menu-item-settings-->
	        <ul class="menu-item-transport"></ul>
	    <?php	    
	    $output .= ob_get_clean();
	    }
}

class mega_menu_util {
    private static $is_no_header = false;
    private static $is_template_header = false;
    private static $header_template_id = null;
    private static $header_template_content = array(
        'tdc_header_mobile',
        'tdc_header_mobile_sticky',
        'tdc_header_desktop',
        'tdc_header_desktop_sticky',
    );

    private static $authors_array_cache = ''; /* Cache the results from  create_array_authors */
	private static $shortcodes_with_icons = null; /* Shortcodes with icon type params */
	private static $check_installed_plugins = false;
    public static $e_keys = array('dGRfMDEx' => '', 'dGRfMDExXw==' => 2);
 /**
     * generates a category tree, only on /wp_admin/, uses a buffer
     * @param bool $add_all_category = if true ads - All categories - at the begining of the list (used for dropdowns)
     * @return array
     */
    private static $category_to_id_array_walker_buffer = array();
    static function get_category_to_id_array($add_all_category = true) {
        if (is_admin() === false) {
            return array();
        }

        if (empty(self::$category_to_id_array_walker_buffer)) {
            $categories = get_categories(array(
                'hide_empty' => 0,                
            ));

            $category_to_id_array_walker = new category_to_id_array_walker;
            $category_to_id_array_walker->walk($categories, 4);
            self::$category_to_id_array_walker_buffer = $category_to_id_array_walker->array_buffer;
        }
		
        if ($add_all_category === true) {
            $categories_buffer['- All categories -'] = '';
            return array_merge(
                $categories_buffer,
                self::$category_to_id_array_walker_buffer
            );
        } else {
            return self::$category_to_id_array_walker_buffer;
        }
    }
}	

class category_to_id_array_walker extends Walker {
    var $tree_type = 'category';
    var $db_fields = array ('parent' => 'parent', 'id' => 'term_id');
    var $array_buffer = array();

    function start_lvl( &$output, $depth = 0, $args = array() ) {}

    function end_lvl( &$output, $depth = 0, $args = array() ) {}

    function start_el( &$output, $category, $depth = 0, $args = array(), $id = 0 ) {
        $this->array_buffer[str_repeat(' - ', $depth) .  $category->name . ' - [ id: ' . $category->term_id . ' ]' ] = $category->term_id;
    }
	
    function end_el( &$output, $page, $depth = 0, $args = array() ) {}
}