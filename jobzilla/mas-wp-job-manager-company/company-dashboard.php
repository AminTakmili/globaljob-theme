<?php
/**
 * Template for the company dashboard (`[mas_company_dashboard]`) shortcode.
 *
 * This template can be overridden by copying it to yourtheme/mas-wp-job-manager-company/company-dashboard.php.
 *
 * @author      MadrasThemes
 * @package     MAS Companies For WP Job Manager
 * @category    Template
 * @version     1.0.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$submission_limit           = get_option( 'job_manager_company_submission_limit' );
$submit_company_form_page_id = get_option( 'job_manager_submit_company_form_page_id' );

?>
 <div class="panel panel-default">
	<div class="panel-heading wt-panel-heading ">
		<h5 class="panel-tittle m-a0"><i class="fa fa-suitcase"></i><?php echo esc_html__('Company Listing', 'jobzilla');?></h5>
	</div>
                   
		<div  class="panel-body wt-panel-body ">
		  <div class="twm-D_table table-responsive">
			<p class="d-flex justify-content-between"><?php echo _n( 'Your company can be viewed, edited or removed below.', 'Your companies can be viewed, edited or removed below.', mas_wpjmc_company_manager_count_user_companies(), 'jobzilla' ) ; ?>
				<?php if ( $submit_company_form_page_id && ( mas_wpjmc_company_manager_count_user_companies() < $submission_limit || ! $submission_limit ) ) : ?>
					<tfoot>
						<tr>
							<td colspan="<?php echo sizeof( $company_dashboard_columns ); ?>">
								<a href="<?php echo esc_url( get_permalink( $submit_company_form_page_id ) ); ?>" class="site-button m-r5 py-2">
									<?php _e( 'Add Company', 'jobzilla' ); ?>
								</a>
							</td>
						</tr>
					</tfoot>
				<?php endif; ?>
			</p>
			<table id="jobs_bookmark_table" class="job-manager-companies table table-bordered twm-bookmark-list-wrap">
				<thead>
					<tr>
						<?php foreach ( $company_dashboard_columns as $key => $column ) : ?>
							<th class="<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $column ); ?></th>
						<?php endforeach; ?>
					</tr>
				</thead>
				<tbody>
					<?php if ( ! $companies ) : ?>

						<tr class="text-center">
							<td colspan="<?php echo sizeof( $company_dashboard_columns ); ?>"><?php _e( 'No Record Found', 'jobzilla' ); ?></td>
						</tr>
					<?php else : ?>
						<?php foreach ( $companies as $company ) : ?>
						 <?php $company_logo = get_the_company_logo(  $company,  'thumbnail' );?>
							<tr>
							
								<?php foreach ( $company_dashboard_columns as $key => $column ) :
								
									
								?>
									<td class="<?php echo esc_attr( $key ); ?>">
										<div class="twm-bookmark-list">
										
										<?php if ( 'company-title' === $key ){  ?>
											<?php if ( $company->post_status == 'publish' ) {
													
													if(!empty($company_logo)){
													?>
													<div class="twm-media">
														<div class="twm-media-pic">
														 <img src="<?php echo esc_html($company_logo); ?>" alt="<?php echo esc_attr__('company-logo', 'jobzilla'); ?>">
														</div>
													</div>
													<?php }else{ ?>
													<div class="twm-media">
														<div class="twm-media-pic">
														<img src="<?php echo esc_url(JOBZILLA_URL.'assets/images/img.jpg'); ?>">
														</div>
													</div>
													<?php 	
													}
													?>
											<div class="twm-mid-content">
											
												<a href="<?php echo get_permalink( $company->ID ); ?>" class="twm-job-title">
													<h5><?php echo esc_html( $company->post_title ); ?></h5>
												</a>
											</div>
										<?php }else { ?>
												<div class="twm-mid-content">
												<div class="twm-job-title">
												<h5><?php echo esc_html( $company->post_title ); ?></h5>
												</div>
												</div>
										<?php }
										}?>
											
										</div>
											
										<?php if ( 'status' === $key ) { ?>
											<?php mas_wpjmc_the_company_status( $company ); ?>
										<?php }elseif ( 'date' === $key ) { ?>
											<div><?php echo date_i18n( get_option( 'date_format' ), strtotime( $company->post_date ) ); ?></div>
										<?php }else { ?>
											<div><?php do_action( 'mas_job_manager_company_dashboard_column_' . $key, $company ); ?></div>
										<?php } 
										if ( 'action' === $key ) { ?>
										 <div class="twm-table-controls">
											<ul class="twm-DT-controls-icon list-unstyled">
												<?php
													$actions = array();

													switch ( $company->post_status ) {
														case 'publish' :
															$actions['edit'] = array(
																'label' => esc_html__( 'Edit', 'jobzilla' ),
																'class' => 'far fa-edit',
																'nonce' => false
															);
															$actions['hide'] = array(
																'label' => esc_html__( 'Hide', 'jobzilla' ),
																'nonce' => true,
																'class' => 'fa fa-lock',
															);
														break;
														case 'private' :
															$actions['publish'] = array(
																'label' => esc_html__( 'Publish', 'jobzilla' ),
																'nonce' => true,
																'class' => 'fa fa-unlock',
															);
														break;
														case 'hidden' :
															$actions['edit'] = array(
																'label' => esc_html__( 'Edit', 'jobzilla' ),
																'nonce' => false
															);
															$actions['publish'] = array(
																'label' => esc_html__( 'Publish', 'jobzilla' ),
																'nonce' => true,
																
															);
														break;
														case 'pending' :
														case 'pending_review' :
															if ( get_option( 'job_manager_user_can_edit_pending_company_submissions' ) ) {
																$actions['edit'] = array(
																	'label' => esc_html__( 'Edit', 'jobzilla' ),
																	'nonce' => false,
																	'class' => 'far fa-edit',
																);
															}
														break;
														case 'expired' :
															if ( get_option( ' ' ) ) {
																$actions['relist'] = array(
																	'label' => esc_html__( 'Relist', 'jobzilla' ),
																	'class' => 'fa fa-ban', 
																	'nonce' => true
																);
															}
														break;
													}

													$actions['delete'] = array( 'label' => esc_html__( 'Delete', 'jobzilla' ),
													'nonce' => true,
													'class' => 'far fa-trash-alt',
													);

													$actions = apply_filters( 'mas_job_manager_company_my_company_actions', $actions, $company );

													foreach ( $actions as $action => $value ) {
														$action_url = add_query_arg( array( 'action' => $action, 'company_id' => $company->ID ) );
														if ( $value['nonce'] ){
															$action_url = wp_nonce_url( $action_url, 'mas_job_manager_company_my_company_actions' );
														}
														
														echo '<li><a title="'.$value['label'].'" href="' . $action_url . '" class="company-dashboard-action-' . $action . '"><span class="' . $value['class'] . '"></span></a></li>';
													}
												?>
											</ul>
											</div>
										<?php } ?>
									</td>
								<?php endforeach; ?>
							</tr>
						<?php endforeach; ?>
					<?php endif; ?>
				</tbody>
				
			</table>
			</div>
		</div>
</div>