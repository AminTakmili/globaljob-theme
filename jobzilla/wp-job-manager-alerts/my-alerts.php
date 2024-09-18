<?php
/**
 * Lists job listing alerts for the `[job_alerts]` shortcode.
 *
 * This template can be overridden by copying it to yourtheme/wp-job-manager-alerts/my-alerts.php.
 *
 * @see         https://wpjobmanager.com/document/template-overrides/
 * @author      Automattic
 * @package     WP Job Manager - Alerts
 * @category    Template
 * @version     1.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
 <div class="panel panel-default">
	<div class="panel-heading wt-panel-heading">
		<h5 class="panel-tittle m-a0"><i class="far fa-bell"></i>
		<?php echo esc_html('Alerts', 'jobzilla');?></h5>
	</div>
	<div class="panel-body wt-panel-body">
		 <div class="twm-D_table table-responsive">
			<p class="d-sm-flex justify-content-between"> <?php  printf( __( 'Your job alerts are shown in the table below and will be emailed to %s.', 'jobzilla' ), $user->user_email );  ?> 
						
				<a class="site-button m-r5 py-2" href="<?php echo remove_query_arg( 'updated', add_query_arg( 'action', 'add_alert' ) ); ?>"> <?php _e( 'Add alert', 'jobzilla' ); ?> </a>
					
			
			</p>
			<table id="jobs_bookmark_table" class="table table-bordered twm-bookmark-list-wrap">
				<thead>
					<tr>
						<th><?php _e( 'Alert Name', 'jobzilla' ); ?></th>
						<th><?php _e( 'Keywords', 'jobzilla' ); ?></th>
						<?php if ( get_option( 'job_manager_enable_categories' ) && wp_count_terms( 'job_listing_category' ) > 0 ) : ?>
							<th><?php _e( 'Categories', 'jobzilla' ); ?></th>
						<?php endif; ?>
						<?php if ( taxonomy_exists( 'job_listing_tag' ) ) : ?>
							<th><?php _e( 'Tags', 'jobzilla' ); ?></th>
						<?php endif; ?>
						<th><?php _e( 'Location', 'jobzilla' ); ?></th>
						<th><?php _e( 'Frequency', 'jobzilla' ); ?></th>
						<th><?php _e( 'Action', 'jobzilla' ); ?></th>
					</tr>
				</thead>
				
				<tbody>
				<?php if ( ! $alerts ) { ?>
						<tr class="text-center"> 
							<td colspan="7"><?php _e( 'No Record Found', 'jobzilla' ); ?></td>
						</tr>
				<?php }else { ?>
					<?php foreach ( $alerts as $alert ) : ?>
						<?php
						$search_terms = WP_Job_Manager_Alerts_Post_Types::get_alert_search_terms( $alert->ID );
						$alert_class = $alert->post_status === 'draft' ? 'disabled' : 'enabled';
						?>
						<tr class="alert-<?php echo esc_html($alert_class); ?>">
							<td>
								<?php echo esc_html( $alert->post_title ); ?>
								
							</td>
							<td><?php
								if ( $value = get_post_meta( $alert->ID, 'alert_keyword', true ) )
									echo esc_html( $value );
								else
									echo '&ndash;';
							?></td>
							<?php if ( get_option( 'job_manager_enable_categories' ) && wp_count_terms( 'job_listing_category' ) > 0 ) : ?>
								<td><?php
									$term_ids = ! empty( $search_terms['categories'] ) ? $search_terms['categories'] : array();
									$terms = array();
									if ( ! empty( $term_ids ) ) {
										$terms = get_terms( array(
											'taxonomy'         => 'job_listing_category',
											'fields'           => 'names',
											'include'          => $term_ids,
											'hide_empty'       => false,
										) );
									}
									$terms = $terms ? esc_html( implode( ', ', $terms ) ) : '&ndash;';
									echo esc_html($terms);
								?></td>
							<?php endif; ?>
							<?php if ( taxonomy_exists( 'job_listing_tag' ) ) : ?>
								<td><?php
									$term_ids = ! empty( $search_terms['tags'] ) ? $search_terms['tags'] : array();
									$terms = array();
									if ( ! empty( $term_ids ) ) {
										$terms = get_terms( array(
											'taxonomy'         => 'job_listing_tag',
											'fields'           => 'names',
											'include'          => $term_ids,
											'hide_empty'       => false,
										) );
									}
									$terms = $terms ? esc_html( implode( ', ', $terms ) ) : '&ndash;';
									echo esc_html($terms);
								?></td>
							<?php endif; ?>
							<td ><?php
								if ( taxonomy_exists( 'job_listing_region' ) && wp_count_terms( 'job_listing_region' ) > 0 ) {
									$term_ids = ! empty( $search_terms['regions'] ) ? $search_terms['regions'] : array();
									$terms = array();
									if ( ! empty( $term_ids ) ) {
										$terms = get_terms( array(
											'taxonomy'         => 'job_listing_region',
											'fields'           => 'names',
											'include'          => $term_ids,
											'hide_empty'       => false,
										) );
									}
									$terms = $terms ? esc_html( implode( ', ', $terms ) ) : '&ndash;';
									echo esc_html($terms);
								} else {
									$value = get_post_meta( $alert->ID, 'alert_location', true );
									$value = $value ? esc_html( $value ) : '&ndash;';
									echo esc_html($value);
								}
							?></td>
							<td><?php
								$schedules = WP_Job_Manager_Alerts_Notifier::get_alert_schedules();
								$freq      = get_post_meta( $alert->ID, 'alert_frequency', true );

								if ( ! empty( $schedules[ $freq ] ) ) {
									echo esc_html( $schedules[ $freq ]['display'] );
								}

								echo '<small>' . sprintf( __( 'Next: %s at %s', 'jobzilla' ), date_i18n( get_option( 'date_format' ), wp_next_scheduled( 'job-manager-alert', array( $alert->ID ) ) ),  date_i18n( get_option( 'time_format' ), wp_next_scheduled( 'job-manager-alert', array( $alert->ID ) ) ) ) . '</small>';
							?></td>
							<td>
									<?php
										$actions = apply_filters( 'job_manager_alert_actions', array(
											'view' => array(
												'label' => __( 'Results', 'jobzilla' ),
												'class' => __('fa fa-eye', 'jobzilla'),
												'nonce' => false
											),
											'email' => array(
												'label' => __( 'Send&nbsp;Now', 'jobzilla' ),
												'class' => __('fa fa-envelope', 'jobzilla'),
												'nonce' => true
											),
											'edit' => array(
												'label' => __( 'Edit', 'jobzilla' ),
												'class' => __('far fa-edit', 'jobzilla'),
												'nonce' => false
											),
											'toggle_status' => array(
												'label' => $alert->post_status == 'draft' ? __( 'Enable', 'jobzilla' ) : __( 'Disable', 'jobzilla' ),
												
												'nonce' => true
											),
											'delete' => array(
												'label' => __( 'Delete', 'jobzilla' ),
												'class' => __('fa fa-trash-alt', 'jobzilla'),
												'nonce' => true
											)
										), $alert ); ?>
										<div class="twm-table-controls">	
											<ul class="twm-DT-controls-icon list-unstyled">
										<?php 
										foreach ( $actions as $action => $value ) {
											$action_url = remove_query_arg( 'updated', add_query_arg( array( 'action' => $action, 'alert_id' => $alert->ID ) ) );
											if(	!empty($value['label'] == 'Enable')){ 
												$value['class'] = 'fa fa-check';
											}else if(!empty($value['label'] == 'Disable')){
												$value['class'] = 'fa fa-times';
											}
											if ( $value['nonce'] ){
												$action_url = wp_nonce_url( $action_url, 'job_manager_alert_actions' );
											}
											
											echo '<li><a title="'. $value['label'] .'" href="' . $action_url . '" class="job-alerts-action-' . $action . '"><i class="' . $value['class'] . '"></i></a></li>';
										}
									?>
									</ul>
								</div>
							</td>
						</tr>
					<?php endforeach;
				}
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>
