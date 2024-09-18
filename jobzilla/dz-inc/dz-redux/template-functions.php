<?php
/**
 * Helper functions for the theme
 *
 * @package Jobzilla
 */
/**
 * Get theme option based on its id.
 *
 * @param  string $opt_id Required. the option id.
 * @param  mixed $default Optional. Default if the option is not found or not yet saved.
 *                         If not set, false will be used
 *
 * @return mixed
 */
function jobzilla_get_opt( $opt_id, $default = false ) {
	$opt_name = jobzilla_get_opt_name();
	if ( empty( $opt_name ) || !class_exists('ReduxFramework')) {
		return $default;
	}

	global ${$opt_name};
	if ( ! isset( ${$opt_name} ) || ! isset( ${$opt_name}[ $opt_id ] ) ) {
		$options = get_option( $opt_name );
	} else {
		$options = ${$opt_name};
	}
	if ( ! isset( $options ) || ! isset( $options[ $opt_id ] ) || $options[ $opt_id ] === '' ) {
		return $default;
	}
	if ( is_array( $options[ $opt_id ] ) && is_array( $default ) ) {
		foreach ( $options[ $opt_id ] as $key => $value ) {
			if ( isset( $default[ $key ] ) && $value === '' ) {
				$options[ $opt_id ][ $key ] = $default[ $key ];
			}
		}
	}

	return $options[ $opt_id ];
}

/**
 * Get theme option based on its id.
 *
 * @param  string $opt_id Required. the option id.
 * @param  mixed $default Optional. Default if the option is not found or not yet saved.
 *                         If not set, false will be used
 *
 * @return mixed
 */
function jobzilla_get_page_opt( $opt_id, $default = false ) {
	$page_opt_name = jobzilla_get_page_opt_name();
	if ( empty( $page_opt_name ) ) {
		return $default;
	}
	$id = get_the_ID();
	if ( ! is_archive() && is_home() ) {
		if ( ! is_front_page() ) {
			$page_for_posts = get_option( 'page_for_posts' );
			$id             = $page_for_posts;
		}
	}

	return $options = ! empty($id) ? get_post_meta( intval( $id ), $opt_id, true ) : $default;
}

/**
 * Get theme option based on its id.
 *
 * @param  string $opt_id Required. the option id.
 * @param  mixed $default Optional. Default if the option is not found or not yet saved.
 *                         If not set, false will be used
 *
 * @return mixed
 */
function jobzilla_get_post_opt( $opt_id, $default = false ) {
	$post_opt_name = jobzilla_get_post_opt_name();
	if ( empty( $post_opt_name ) ) {
		return $default;
	}
	$id = get_the_ID();
	if ( ! is_archive() && is_home() ) {
		if ( ! is_front_page() ) {
			$page_for_posts = get_option( 'page_for_posts' );
			$id             = $page_for_posts;
		}
	}
	return $options = ! empty($id) ? get_post_meta( intval( $id ), $opt_id, true ) : $default;
}


/**
 * Get opt_name for Redux Framework options instance args and for
 * getting option value.
 *
 * @return string
 */
function jobzilla_get_opt_name() {
	return apply_filters( 'jobzilla_opt_name', 'jobzilla_theme_options' );
}

/**
 * Get opt_name for Redux Framework options instance args and for
 * getting option value.
 *
 * @return string
 */
function jobzilla_get_page_opt_name() {
	return apply_filters( 'jobzilla_page_opt_name', 'jobzilla_page_options' );
}

/**
 * Get opt_name for Redux Framework options instance args and for
 * getting option value.
 *
 * @return string
 */
function jobzilla_get_post_opt_name() {
	return apply_filters( 'jobzilla_post_opt_name', 'jobzilla_post_options' );
}

/**
 * Get opt_name for Redux Framework options instance args and for
 * getting option value.
 *
 * @return string
 */
function jobzilla_get_cpt_opt_name() {

	$temp_cpt_data = jobzilla_get_opt('cpt_data');
	if(!empty($temp_cpt_data)){
		$temp_cpt_data2 = unserialize($temp_cpt_data);

		if ($temp_cpt_data2) {
		
			foreach ($temp_cpt_data2 as $cpt) {

				$cpt_id = $cpt['cpt_id'];
				$jobzilla_cpt_opt[] = 'cpt_'.$cpt_id.'_option';
			}

			return apply_filters( 'jobzilla_cpt_opt_name', $jobzilla_cpt_opt );
		}	
	}
}
/* Contact Function Start */
function jobzilla_get_contact_form_list() 
{
	
	$contact_form_options_arr = get_posts(
									array('post_type'     => 'wpcf7_contact_form',
									'numberposts'   => -1)
								);
	$contact_form_options = wp_list_pluck($contact_form_options_arr, 'post_name', 'post_title');
	$contact_form_options = array(esc_html__('Choose Contact Form', 'jobzilla')=>0) + $contact_form_options ;
	$contact_form_options = array_flip($contact_form_options);	
	return $contact_form_options;

}