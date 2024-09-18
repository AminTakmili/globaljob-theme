<?php 
/**
 * This can either be done with a filter (below) or the field can be added directly to the job-filters.php template file!
 *
 * job-manager-filter class handling was added in v1.23.6
 */
 
add_action( 'job_manager_job_filters_salary_start', 'filter_by_salary_field');
function filter_by_salary_field() {
		$selected_salary = !empty($_GET['filter_by_salary']) ? $_GET['filter_by_salary'] :'';
	?>
	<div class="search_categories form-group mb-4">
		<label class="section-head-small">
			<?php _e( 'Salary', 'jobzilla' ); ?>
		</label>
		<select name="filter_by_salary" class="job-manager-filter wt-select-bar-large selectpicker">
			<option value=""><?php _e( 'Any Salary', 'jobzilla' ); ?></option>
			<option <?php if($selected_salary == 'upto20'){ echo 'selected'; } ?> value="upto20"><?php _e( 'Up to $20,000', 'jobzilla' ); ?></option>
			<option <?php if($selected_salary == '20000-40000'){ echo 'selected'; } ?> value="20000-40000"><?php _e( '$20,000 to $40,000', 'jobzilla' ); ?></option>
			<option <?php if($selected_salary == '40000-60000'){ echo 'selected'; } ?> value="40000-60000"><?php _e( '$40,000 to $60,000', 'jobzilla' ); ?></option>
			<option <?php if($selected_salary == 'over60'){ echo 'selected'; } ?> value="over60"><?php _e( '$60,000+', 'jobzilla' ); ?></option>
		</select>
	</div>
	<?php
}

/**
 * This code gets your posted field and modifies the job search query
 */
add_filter( 'job_manager_get_listings', 'filter_by_salary_field_query_args', 10, 2);

function filter_by_salary_field_query_args( $query_args, $args ) {
	if ( isset( $_POST['form_data'] ) ) {
		parse_str( $_POST['form_data'], $form_data );

		// If this is set, we are filtering by salary
		if ( ! empty( $form_data['filter_by_salary'] ) ) {
			$selected_range = sanitize_text_field( $form_data['filter_by_salary'] );
			switch ( $selected_range ) {
				case 'upto20' :
					$query_args['meta_query'][] = array(
						'key'     => '_job_salary',
						'value'   => '20000',
						'compare' => '<',
						'type'    => 'NUMERIC'
					);
				break;
				case 'over60' :
					$query_args['meta_query'][] = array(
						'key'     => '_job_salary',
						'value'   => '60000',
						'compare' => '>=',
						'type'    => 'NUMERIC'
					);
				break;
				default :
					$query_args['meta_query'][] = array(
						'key'     => '_job_salary',
						'value'   => array_map( 'absint', explode( '-', $selected_range ) ),
						'compare' => 'BETWEEN',
						'type'    => 'NUMERIC'
					);
				break;
			}

			// This will show the 'reset' link
			add_filter( 'job_manager_get_listings_custom_filter', '__return_true' );
		}
	}else if ( ! empty( $args['filter_by_salary'] ) ) {
			$selected_range = sanitize_text_field( $args['filter_by_salary'] );
			switch ( $selected_range ) {
				case 'upto20' :
					$query_args['meta_query'][] = array(
						'key'     => '_job_salary',
						'value'   => '20000',
						'compare' => '<',
						'type'    => 'NUMERIC'
					);
				break;
				case 'over60' :
					$query_args['meta_query'][] = array(
						'key'     => '_job_salary',
						'value'   => '60000',
						'compare' => '>=',
						'type'    => 'NUMERIC'
					);
				break;
				default :
					$query_args['meta_query'][] = array(
						'key'     => '_job_salary',
						'value'   => array_map( 'absint', explode( '-', $selected_range ) ),
						'compare' => 'BETWEEN',
						'type'    => 'NUMERIC'
					);
				break;
			}

			// This will show the 'reset' link
			add_filter( 'job_manager_get_listings_custom_filter', '__return_true' );
		}
	return $query_args;
}