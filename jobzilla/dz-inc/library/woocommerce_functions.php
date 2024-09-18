<?php 
/**
 * Check if WooCommerce is active
 **/
function jobzilla_is_woocommerce_active(){
	if ( 
	  in_array( 
		'woocommerce/woocommerce.php', 
		apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) 
	  ) 
	) {
		return true;
	}else{
		return false;
	}
}


/**
 * Remove Woo-Commerce Filters
 */

function jobzilla_woo_remove_action()
{
	
	$show_related_product = jobzilla_get_opt('show_related_product');
	
	$remove_action_arr = array(
							'woocommerce_before_shop_loop' => array(
								 array('woocommerce_result_count', 20)
							),
							'woocommerce_after_shop_loop_item' => array(
								 array('woocommerce_template_loop_add_to_cart', 10),
							),
							'woocommerce_before_main_content' => array(
								 array('woocommerce_breadcrumb', 20),
								 array( 'woocommerce_output_content_wrapper', 10)
							),
							'woocommerce_after_main_content' => array(
								 array( 'woocommerce_output_content_wrapper_end', 10)
							),
							
							'woocommerce_before_shop_loop_item_title' => array(
								array( 'woocommerce_template_loop_product_thumbnail', 10 )
							),
							'woocommerce_after_shop_loop_item_title' => array(
								 array( 'woocommerce_template_loop_price', 10 ),
								 array('woocommerce_template_loop_rating', 5 )
							),
							'woocommerce_sidebar' => array(
								 array('woocommerce_get_sidebar', 10),
							),
						);
	
		
	if(!$show_related_product)
	{
		$remove_action_arr['woocommerce_after_single_product_summary'] = array(
								array('woocommerce_output_related_products', 20)
							);			
	}
	
	foreach( $remove_action_arr as $key => $value )
	{
		foreach( $value as $item )
		{
			remove_action( $key, $item[0], $item[1] );
		}
	}
}

add_action( 'init', 'jobzilla_woo_remove_action');

/* Replace text Onsale */
add_filter( 'woocommerce_sale_flash', 'jobzilla_replace_sale_text' );
function jobzilla_replace_sale_text( $html ) {

	$regular_price = get_post_meta( get_the_ID(), '_regular_price', true);
	$sale_price = get_post_meta( get_the_ID(), '_sale_price', true);

	$product_sale = '';
	if(!empty($sale_price)) {
		$product_sale = intval( ( (intval($regular_price) - intval($sale_price)) / intval($regular_price) ) * 100);
		return str_replace( 'Sale!', '<span class="onsale-inner"><span>' .$product_sale. '%</span></span>', $html );
	}
}
 
 
/**
 * Change number of products that are displayed per page (shop page)
 */
add_filter( 'loop_shop_per_page', 'jobzilla_loop_shop_per_page', 20 );

function jobzilla_loop_shop_per_page( $cols ) 
{
  // $cols contains the current number of products per page based on the value stored on Options –> Reading
  // Return the number of products you wanna show per page.
  $no_of_product_per_page = jobzilla_get_opt('no_of_product_per_page');
  $no_of_product_per_page = !empty($no_of_product_per_page)?$no_of_product_per_page:get_option('posts_per_page');
  $cols = $no_of_product_per_page;
  return $cols;
}

/**
 * Change number of related products output
 */ 
function jobzilla_related_products_limit() 
{
	$no_of_related_product = jobzilla_get_opt('no_of_related_product');
    $no_of_related_product = !empty($no_of_related_product)?$no_of_related_product:3;
  
	$args['posts_per_page'] = $no_of_related_product;
	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'jobzilla_related_products_limit', 20 );

/**
* Change Gallery Thumbnail Size
**/
function jobzilla_gallery_thumbnail_size($size)
{
	return array(
        'width' => 300,
        'height' => 300,
        'crop' => 0,
    );
}
add_filter( 'woocommerce_get_image_size_gallery_thumbnail','jobzilla_gallery_thumbnail_size');


function jobzilla_is_woo_catalog_shop_enable(){
	
	$is_enable = true;
	
	if(class_exists('YITH_WooCommerce_Catalog_Mode')){
		
		$obj = new YITH_WooCommerce_Catalog_Mode();
		$response = $obj->disable_shop();
		if($response){
			$is_enable = false;
		}
	}
	
	return $is_enable;
}


function jobzilla_woo_review_gravatar_size($a){
	return 100;
}

add_filter('woocommerce_review_gravatar_size','jobzilla_woo_review_gravatar_size',10,2);



// Add extra tab to woo-commerce product data in admin side 

add_filter( 'woocommerce_product_data_tabs', 'add_jobzilla_custom_product_data_tab');
function add_jobzilla_custom_product_data_tab( $tabs ) {

	$tabs['extra-custom-tab'] = array(
		'label'    => __( 'Extra', 'jobzilla' ),
		'target'   => 'jobzilla_product_data_panel',
		
	);
	return $tabs;

}

/**
 * Display the custom text field
 * @since 1.0.0
 */
 
function jobzilla_custom_field() {
	 global $woocommerce, $post;
	 
	echo '<div id="jobzilla_product_data_panel" class="panel woocommerce_options_panel show">';
		woocommerce_wp_text_input( 
			array(
				 'id' => 'attribute1_title',
				 'label' => __( 'Attribute1_title', 'jobzilla' ),
				 'desc_tip' => true,
				 'description' => __( 'Enter the title of your custom text .', 'jobzilla' ),
			)
		);
		woocommerce_wp_text_input( 
			array(
				 'id' => 'attribute1_value',
				 'label' => __( 'Attribute1_value', 'jobzilla' ),
				 'desc_tip' => true,
				 'description' => __( 'Enter the value of your custom text .', 'jobzilla' ),
			)
		);
		woocommerce_wp_text_input( 
			array(
				 'id' => 'attribute2_title',
				 'label' => __( 'Attribute2_title', 'jobzilla' ),
				 'desc_tip' => true,
				 'description' => __( 'Enter the title of your custom text .', 'jobzilla' ),
			)
		);
		woocommerce_wp_text_input( 
			array(
				 'id' => 'attribute2_value',
				 'label' => __( 'Attribute2_value', 'jobzilla' ),
				 'desc_tip' => true,
				 'description' => __( 'Enter the value of your custom text .', 'jobzilla' ),
			)
		);
		woocommerce_wp_text_input( 
			array(
				 'id' => 'attribute3_title',
				 'label' => __( 'Attribute3_title', 'jobzilla' ),
				 'desc_tip' => true,
				 'description' => __( 'Enter the title of your custom text .', 'jobzilla' ),
			)
		);
		woocommerce_wp_text_input( 
			array(
				 'id' => 'attribute3_value',
				 'label' => __( 'Attribute3_value', 'jobzilla' ),
				 'desc_tip' => true,
				 'description' => __( 'Enter the value of your custom text .', 'jobzilla' ),
			)
		);
		woocommerce_wp_text_input( 
			array(
				 'id' => 'model',
				 'label' => __( 'Model', 'jobzilla' ),
				 'desc_tip' => true,
				 'description' => __( 'Enter the car model of your custom text .', 'jobzilla' ),
			)
		);
		woocommerce_wp_select( 
			array(
				 'id' => 'type',
				 'label' => __( 'Type', 'jobzilla' ),
				  'selected' => true,
				 'desc_tip' => true,
				 'description' => __( 'Select your car type .', 'jobzilla' ),
				 
				'options' => array(
					''  =>  __('Choose Type', 'jobzilla'),
					'Hatchback'   => __( 'Hatchback', 'jobzilla' ),
					'Sedan'   => __( 'Sedan', 'jobzilla' ),
					'SUV' => __( 'SUV', 'jobzilla' ),
					'Crossover' => __( 'Crossover', 'jobzilla' ),
					'Coupe' => __( 'Coupe', 'jobzilla' ),
					'Convertible' => __( 'Convertible', 'jobzilla' )
				)
			)
		);
		
	echo '</div>';
}
add_action( 'woocommerce_product_data_panels', 'jobzilla_custom_field' ); 

function woocommerce_process_product_meta_fields_save( $post_id ){
    // This is the case to save custom field data of checkbox. You have to do it as per your custom fields
  
	$attribute1_title = sanitize_text_field($_POST['attribute1_title']);
	$attribute1_value = sanitize_text_field($_POST['attribute1_value']);
	$attribute2_title = sanitize_text_field($_POST['attribute2_title']);
	$attribute2_value = sanitize_text_field($_POST['attribute2_value']);
	$attribute3_title = sanitize_text_field($_POST['attribute3_title']);
	$attribute3_value = sanitize_text_field($_POST['attribute3_value']);
	$model = $_POST['model'];
	$type = $_POST['type'];
	
	
	if ( ! empty( $attribute1_title ) ) {
		update_post_meta( $post_id, 'attribute1_title', esc_html( $attribute1_title ) );
	}
	
	if ( ! empty( $attribute1_value ) ) {
		update_post_meta( $post_id, 'attribute1_value', esc_html( $attribute1_value ) );
	}

	if ( ! empty( $attribute2_title ) ) {
		update_post_meta( $post_id, 'attribute2_title', esc_html( $attribute2_title ) );
	}
	
	if ( ! empty( $attribute2_value ) ) {
		update_post_meta( $post_id, 'attribute2_value', esc_html( $attribute2_value ) );
	}
	
	if ( ! empty( $attribute3_title ) ) {
		update_post_meta( $post_id, 'attribute3_title', esc_html( $attribute3_title ) );
	}
	
	if ( ! empty( $attribute3_value ) ) {
		update_post_meta( $post_id, 'attribute3_value', esc_html( $attribute3_value ) );
	}
	
	if(!empty($model)){
		update_post_meta($post_id, 'model', esc_html($model));
	}
	if(!empty($type)){
		update_post_meta($post_id, 'type', esc_html($type));
	}

}

add_action( 'woocommerce_process_product_meta', 'woocommerce_process_product_meta_fields_save');

// Add extra tab to woo-commerce product data in admin side END 




function jobzilla_product_query( $query ) {
	$meta_query = $query->get( 'meta_query' ); 
	$tax_query = $query->get( 'tax_query' );
	$type =  ( isset($_GET['type']) ) ?  sanitize_text_field($_GET['type']) :'';
	$brand = (isset ($_GET['brand']) ) ? sanitize_text_field($_GET['brand']) :'';
	$price = (isset( $_GET['price']) ) ? sanitize_text_field($_GET['price']) : '';
	
	if (!empty($type)) { 
		$meta_query[] = array( 'key' => 'type', 'value' => $type,'compare' => 'EXISTS' );
		$query->set( 'meta_query', $meta_query );
	}

	if (!empty($brand)) { 
		$tax_query[] = array(
			'taxonomy' => 'product_cat',
			'field'    => 'slug',
			'terms'    => array('key' => 'brand', 'value' => $brand,'compare' => 'EXISTS'),
			'operator' => 'in',
		);
		$query->set( 'tax_query', $tax_query );
	}
}
add_action( 'woocommerce_product_query', 'jobzilla_product_query' );


