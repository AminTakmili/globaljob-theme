<?php
/**
* Form used when creating a new job listing alert.
*
* This template can be overridden by copying it to yourtheme/wp-job-manager-alerts/alert-form.php.
*
* @see         https://wpjobmanager.com/document/template-overrides/
* @author      Automattic
* @package     WP Job Manager - Alerts
* @category    Template
* @version     1.5.2
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="panel panel-default">
	<div class="panel-heading wt-panel-heading">
			<h5 class="panel-tittle m-a0">
				<i class="fa fa-suitcase"></i>
				<?php echo esc_html__('Alerts Form', 'jobzilla'); ?>
			</h5>
		</div>
	<div class="panel-body wt-panel-body">
		<form method="post" class="job-manager-form">
			<div class="row">
				 <div class="col-md-6">
					<div class="form-group">
						<label for="alert_name"><?php _e( 'Alert Name', 'jobzilla' ); ?></label>
						<div class="ls-inputicon-box"> 
							<input type="text" name="alert_name" value="<?php echo esc_attr( $alert_name ); ?>" id="alert_name" class="form-control" placeholder="<?php _e( 'Enter a name for your alert', 'jobzilla' ); ?>" />
						</div>
					</div>
				</div>
				 <div class="col-md-6">
					<div class="form-group">
						<label for="alert_keyword"><?php _e( 'Keyword', 'jobzilla' ); ?></label>
						<div class="ls-inputicon-box"> 
							<input type="text" name="alert_keyword" value="<?php echo esc_attr( $alert_keyword ); ?>" id="alert_keyword" class="form-control " placeholder="<?php _e( 'Optionally add a keyword to match jobs against', 'jobzilla' ); ?>" />
						</div>
					</div>
				</div>
				<?php if ( taxonomy_exists( 'job_listing_region' ) && wp_count_terms( 'job_listing_region' ) > 0 ) : ?>
					 <div class="col-md-6">
					<div class="form-group">
						<label for="alert_regions"><?php _e( 'Job Region', 'jobzilla' ); ?></label>
						<div class="ls-inputicon-box">  
							<?php
								job_manager_dropdown_categories( array(
									'show_option_all' => false,
									'hierarchical'    => true,
									'orderby'         => 'name',
									'taxonomy'        => 'job_listing_region',
									'name'            => 'alert_regions',
									'class'           => 'alert_regions job-manager-enhanced-select ',
									'class'        => 'wt-select-box selectpicker',
									'hide_empty'      => 0,
									'selected'        => $alert_regions,
									'placeholder'     => __( 'Any region', 'jobzilla' )
								) );
							?>
						</div>
						</div>
					</div>
				<?php else : ?>
					<fieldset>
						<label for="alert_location"><?php _e( 'Location', 'jobzilla' ); ?></label>
						<div class="field">
							<input type="text" name="alert_location" value="<?php echo esc_attr( $alert_location ); ?>" id="alert_location" class="input-text" placeholder="<?php _e( 'Optionally define a location to search against', 'jobzilla' ); ?>" />
						</div>
					</fieldset>
				<?php endif; ?>
				<?php if ( get_option( 'job_manager_enable_categories' ) && wp_count_terms( 'job_listing_category' ) > 0 ) : ?>
					<div class="col-md-6">
					<div class="form-group">
						<label for="alert_cats"><?php _e( 'Categories', 'jobzilla' ); ?></label>
						  <div class="ls-inputicon-box">  
							<?php
								wp_enqueue_script( 'wp-job-manager-term-multiselect' );

								job_manager_dropdown_categories( array(
									'taxonomy'     => 'job_listing_category',
									'hierarchical' => 1,
									'name'         => 'alert_cats',
									'class'        => 'wt-select-box selectpicker',
									'orderby'      => 'name',
									'selected'     => $alert_cats,
									'hide_empty'   => false,
									'placeholder'  => __( 'Any category', 'jobzilla' )
								) );
							?>
						</div>
					</div>
					</div>
				<?php endif; ?>
				<?php if ( taxonomy_exists( 'job_listing_tag' ) && wp_count_terms( 'job_listing_tag' ) > 0 ) : ?>
					<div class="col-md-6">
					<div class="form-group">
						<label for="alert_tags"><?php _e( 'Tags', 'jobzilla' ); ?></label>
						 <div class="ls-inputicon-box">
							<?php
								wp_enqueue_script( 'wp-job-manager-term-multiselect' );

								job_manager_dropdown_categories( array(
									'taxonomy'     => 'job_listing_tag',
									'hierarchical' => 0,
									'name'         => 'alert_tags',
									'class'        => 'wt-select-box selectpicker',
									'orderby'      => 'name',
									'selected'     => $alert_tags,
									'hide_empty'   => false,
									'placeholder'  => __( 'Any tag', 'jobzilla' )
								) );
							?>
						</div>
						</div>
					</div>
				<?php endif; ?>
				<div class="col-md-6">
					<div class="form-group">
					<label for="alert_job_type"><?php _e( 'Job Type', 'jobzilla' ); ?></label>
					<div class="ls-inputicon-box">
						<select name="alert_job_type[]" data-placeholder="<?php _e( 'Any job type', 'jobzilla' ); ?>" id="alert_job_type" multiple="multiple" class="wt-select-box selectpicker">
							<?php
								$terms = get_job_listing_types();
								foreach ( $terms as $term )
									echo '<option value="' . esc_attr( $term->term_id ) . '" ' . selected( in_array( $term->term_id, $alert_job_type ), true, false ) . '>' . esc_html( $term->name ) . '</option>';
							?>
						</select>
					</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
					<label for="alert_frequency"><?php _e( 'Email Frequency', 'jobzilla' ); ?></label>
					<div class="ls-inputicon-box">
						<select name="alert_frequency" id="alert_frequency" class="wt-select-box selectpicker">
							<?php foreach ( WP_Job_Manager_Alerts_Notifier::get_alert_schedules() as $key => $schedule ) : ?>
								<option value="<?php echo esc_attr( $key ); ?>" <?php selected( $alert_frequency, $key ); ?>><?php echo esc_html( $schedule['display'] ); ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					</div>
				</div>
				<p>
					<?php wp_nonce_field( 'job_manager_alert_actions' ); ?>
					<input type="hidden" name="alert_id" value="<?php echo absint( $alert_id ); ?>" />
					<input type="submit" name="submit-job-alert" class="site-button m-r5" value="<?php _e( 'Save alert', 'jobzilla' ); ?>" />
				</p>
			</div>	
		</form>
	</div>
</div>