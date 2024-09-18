<?php
/**
 * Lists a users bookmarks.
 *
 * This template can be overridden by copying it to yourtheme/wp-job-manager-bookmarks/my-bookmarks.php.
 *
 * @see         https://wpjobmanager.com/document/template-overrides/
 * @author      Automattic
 * @package     WP Job Manager - Bookmarks
 * @category    Template
 * @version     1.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$allowed_html_tags = jobzilla_allowed_html_tag();
?>
<div class="twm-pro-view-chart-wrap">
	<div class="col-lg-12 col-md-12 ">
		<div class="panel panel-default site-bg-white ">
			<div class="panel-heading wt-panel-heading ">
				<h5 class="panel-tittle m-a0"><i class="far fa-bookmark"></i> <?php echo esc_html__('Bookmarked Jobs', 'jobzilla');?></h5>
			</div>
			 <div class="panel-body wt-panel-body">
				
					<div id="job-manager-bookmarks" class="twm-D_table table-responsive">
						<table id="candidate_data_table" class="table table-bordered">
							<thead>
								<tr>
									<th><?php _e( 'Bookmark', 'jobzilla' ); ?></th>
									<th><?php _e( 'Notes', 'jobzilla' ); ?></th>
									<th><?php _e( 'Action', 'jobzilla' ); ?></th>
								</tr>
							</thead>
							<tbody>
							<?php if ( ! $bookmarks ) { ?>
									<tr class="text-center"> 
										<td colspan="3"><?php _e( 'No Record Found', 'jobzilla' ); ?></td>
									</tr>
							<?php }else { ?>
								<?php foreach ( $bookmarks as $bookmark ) { ?>
									<tr>
										<td>
											 <div class="twm-DT-candidates-list">
												<div class="twm-media">	
													<div class="twm-media-pic">
														<a href="<?php the_permalink( $bookmark->post_id ); ?>">
															<?php
															$post_type = get_post_type( $bookmark->post_id );
															if ( function_exists( 'the_candidate_photo' ) && 'resume' === $post_type ) {?>
																<?php the_candidate_photo( 'thumbnail', null, $bookmark->post_id ); ?>
															
															 <?php 
															} elseif ( function_exists( 'the_company_logo' ) && 'job_listing' === $post_type ) { ?>
															
															<?php 
																the_company_logo( 'thumbnail', null, $bookmark->post_id ); ?>
																
															
														<?php 	}
															?>
														</a>
													</div>
												</div>	
													<div class="twm-mid-content">
														<a class="twm-job-title" href="<?php the_permalink( $bookmark->post_id ); ?>">
															<h5><?php echo get_the_title( $bookmark->post_id ); ?></h5>
														</a>
													</div>
											</div>
										</td>
										<td>	
											<?php  echo wp_kses(wpautop(wp_kses_post( $bookmark->bookmark_note ) ), $allowed_html_tags); ?>
										</td>
										<td>
											<div class="twm-table-controls">
												<ul class="twm-DT-controls-icon list-unstyled">
												<?php
													$actions = apply_filters( 'job_manager_bookmark_actions', array(
														'delete' => array(
															'label' => __( 'Delete', 'jobzilla' ),
															'url'   =>  wp_nonce_url( add_query_arg( 'remove_bookmark', $bookmark->post_id ), 'remove_bookmark' ),
															'class' => 'far fa-trash-alt',
														)
													), $bookmark );

													foreach ( $actions as $action => $value ) {
														
														echo '<li><a title="' . $value['label']  . '"  href="' .  $value['url']  . '" class="job-manager-bookmark-action-' . $action . '"><i class="' . $value['class'] . '"></i></a></li>';
													}
												?>
												</ul>
											</div>
										</td>
									</tr>
								<?php }
								}
									?>
								
							</tbody>
						</table>
					</div>
				
			</div>
		</div>
	</div>
</div>
