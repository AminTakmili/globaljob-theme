<?php
/**
 * Template for the candidate dashboard (`[candidate_dashboard]`) shortcode.
 *
 * This template can be overridden by copying it to yourtheme/wp-job-manager-resumes/candidate-dashboard.php.
 *
 * @see         https://wpjobmanager.com/document/template-overrides/
 * @author      Automattic
 * @package     wp-job-manager-resumes
 * @category    Template
 * @version     1.13.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
global $post;
$submission_limit           = get_option( 'resume_manager_submission_limit' );
$submit_resume_form_page_id = get_option( 'resume_manager_submit_resume_form_page_id' );


?>
  <div class="twm-pro-view-chart-wrap">
	<div class="col-lg-12 col-md-12">
		<div class="panel panel-default site-bg-white">
			<div class="panel-heading wt-panel-heading">
				<h5 class="panel-tittle m-a0"><i class="far fa-list-alt"></i><?php echo esc_html__('All Candidates', 'jobzilla'); ?></h5>
			</div>
			<div class="panel-body wt-panel-body">
				<div class="twm-D_table table-responsive">
					<div id="resume-manager-candidate-dashboard">
						<p class="d-sm-flex justify-content-between"><?php  echo _n( 'Your resume can be viewed, edited or removed below.', 'Your resume(s) can be viewed, edited or removed below.', resume_manager_count_user_resumes(), 'jobzilla' );  ?>
							<?php if ( $submit_resume_form_page_id && ( resume_manager_count_user_resumes() < $submission_limit || ! $submission_limit ) ){ ?>
								<tfoot>
									<tr>
										<td colspan="<?php echo count( $candidate_dashboard_columns ); ?>">
											<a class="site-button m-r5 py-2" href="<?php echo esc_url( get_permalink( $submit_resume_form_page_id ) ); ?>"><?php _e( 'Add Resume', 'jobzilla' ); ?></a>
										</td>
									</tr>
								</tfoot>
							<?php } ?>
						</p>
						  <table id="candidate_data_table" class="table table-bordered">
							<thead>
								<tr>
									<?php foreach ( $candidate_dashboard_columns as $key => $column ) : ?>
										<th class="<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $column ); ?></th>
									<?php endforeach; ?>
								</tr>
							</thead>
							<tbody>
								<?php if ( ! $resumes ) : ?>
									<tr class="text-center"> 
										<td colspan="<?php echo count( $candidate_dashboard_columns ); ?>"><?php _e( 'No Record Found', 'jobzilla' ); ?></td>
									</tr>
								<?php else : ?>
									<?php foreach ( $resumes as $resume ) : ?>
										<tr>
											<?php foreach ( $candidate_dashboard_columns as $key => $column ) : ?>
												<td class="<?php echo esc_attr( $key ); ?>">
													<div class="twm-DT-candidates-list">
														<?php if ( 'resume-title' === $key ) { ?>
															<?php $post_type = get_post_type( $resume->ID );
															if ( function_exists( 'the_candidate_photo' ) && 'resume' === $post_type ) {	?>
															<div class="twm-media">
																<div class="twm-media-pic">
																	<?php the_candidate_photo( 'thumbnail', null, $resume->ID); ?>
																</div>
															</div>
															<?php }elseif ( function_exists( 'the_company_logo' ) && 'job_listing' === $post_type ) {
																the_company_logo( 'thumbnail', null, $resume->ID );
															}
															?>
															<div class="twm-mid-content">
															<?php 
															if ( $resume->post_status == 'publish' ) { 						
															?>
																<a class="twm-job-title" href="<?php echo get_permalink( $resume->ID ); ?>">
																<h5><?php echo esc_html( $resume->post_title ); ?></h5>
																
															<?php }else { ?>
																<div class="twm-job-title">
																	<h5><?php echo esc_html( $resume->post_title ); ?> </h5>
																</div>
																<?php if($resume->post_status == 'expired'){ ?>
																	<small class="badge bg-danger">
																		<?php the_resume_status( $resume ); ?>
																	</small>
																<?php } else if($resume->post_status === 'preview'){?>
																	<small class="badge bg-secondary">
																		<?php the_resume_status( $resume ); ?>
																	</small>
																<?php } ?>
																</div>
																
															<?php } ?>
														</div>
														<?php } ?>
															
													</div>
													<div class="twm-DT-candidates-list">
														<div class="twm-mid-content">
															<?php if ( 'candidate-title' === $key ) { ?>
																<a class="twm-job-title" href="<?php echo get_permalink( $resume->ID ); ?>">
																	<h4><?php the_candidate_title( '', '', true, $resume ); ?></h4>
																</a>
															<?php } ?>
														</div>
													</div>
													<?php if ( 'candidate-location' === $key ) { ?>
														 <p class="twm-candidate-address">
														<i class="feather-map-pin"></i>
														<?php the_candidate_location( false, $resume ); ?>
														</p>
													<?php }elseif ( 'resume-category' === $key ) { ?>
																<?php the_resume_category( $resume ); ?>
														</div>
													<?php }elseif ( 'status' === $key ) { ?>
														
															<?php  the_resume_status( $resume ); ?>
														
													<?php }elseif ( 'date' === $key ) { ?>
														<?php
														if ( ! empty( $resume->_resume_expires ) && strtotime( $resume->_resume_expires ) > current_time( 'timestamp' ) ) {
															printf( __( 'Expires %s', 'jobzilla' ), date_i18n( get_option( 'date_format' ), strtotime( $resume->_resume_expires ) ) );
														} else {
															echo date_i18n( get_option( 'date_format' ), strtotime( $resume->post_date ) );
														}
														?>
													<?php }else{ ?>
														<?php do_action( 'resume_manager_candidate_dashboard_column_' . $key, $resume ); ?>
													<?php } ?>
													<?php if ( 'action' === $key ) { ?>
													 <div class="twm-table-controls">
                                                        <ul class="twm-DT-controls-icon list-unstyled">
															<?php
																$actions = [];

															switch ( $resume->post_status ) {
																case 'publish':
																	if ( resume_manager_user_can_edit_published_submissions() ) {
																		$actions['edit'] = [
																			'label' => __( 'Edit', 'jobzilla' ),
																			'nonce' => false,
																			'class' => 'far fa-edit',
																		];
																	}
																	$actions['hide'] = [
																		'label' => __( 'Hide', 'jobzilla' ),
																		'nonce' => true,
																		'class' => 'fa fa-lock',
																	];
																	break;
																case 'hidden':
																	if ( resume_manager_user_can_edit_published_submissions() ) {
																		$actions['edit'] = [
																			'label' => __( 'Edit', 'jobzilla' ),
																			'nonce' => false,
																			'class' => 'far fa-edit',
																		];
																	}
																	$actions['publish'] = [
																		'label' => __( 'Publish', 'jobzilla' ),
																		'nonce' => true,
																		'class' => 'fa fa-unlock',
																	];
																	break;
																case 'pending_payment' :
																case 'pending' :
																	if ( resume_manager_user_can_edit_pending_submissions() ) {
																		$actions['edit'] = [
																			'label' => __( 'Edit', 'jobzilla' ),
																			'nonce' => false,
																			'class' => 'far fa-edit',
																		];
																	}
																	break;
																case 'expired':
																	if ( get_option( 'resume_manager_submit_resume_form_page_id' ) ) {
																		$actions['relist'] = [
																			'label' => __( 'Relist', 'jobzilla' ),
																			'nonce' => true,
																			'class' => 'fa fa-ban',
																		];
																	}
																	break;
															}

																$actions['delete'] = [
																	'label' => __( 'Delete', 'jobzilla' ),
																	'nonce' => true,
																	'class' => 'far fa-trash-alt',
																];

																$actions = apply_filters( 'resume_manager_my_resume_actions', $actions, $resume );

																foreach ( $actions as $action => $value ) {
																	$action_url = add_query_arg(
																		[
																			'action' => $action,
																			'resume_id' => $resume->ID,
																		]
																	);
																	if ( $value['nonce'] ) {
																		$action_url = wp_nonce_url( $action_url, 'resume_manager_my_resume_actions' );
																	}
																	
																	echo '<li><a title="'. $value['label'] .'" href="' . $action_url . '" class="candidate-dashboard-action-' . $action . '"><i class="' . $value['class'] . '"></i></a></li>';
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
		</div>
	</div>
</div>