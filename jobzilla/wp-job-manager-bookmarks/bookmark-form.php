<?php
/**
 * Form for adding and removing a bookmark.
 *
 * This template can be overridden by copying it to yourtheme/wp-job-manager-bookmarks/bookmark-form.php.
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

global $wp;
$bookmark = $is_bookmarked ?  'Update Bookmark' :  'Add Bookmark';
 
	if( $is_bookmarked ){ ?>
		<a class="remove-bookmark" title="<?php echo esc_attr( 'Remove Bookmark', 'jobzilla' ); ?>" href="<?php echo wp_nonce_url( add_query_arg( 'remove_bookmark', absint( $post->ID ), get_permalink() ), 'remove_bookmark' ); ?>">
			<i class="fa fa-bookmark" aria-hidden="true"></i>
		</a>
	<?php }else{ ?>
			<a class="bookmark-notice" title="<?php printf( __( 'Bookmark This %s', 'jobzilla' ), ucwords( $post_type->labels->singular_name ) ); ?>" href="#bookmarks" data-bs-toggle="modal"  role="button" >
				<i class="far fa-bookmark"></i>
			</a>
	<?php } ?>
	<div class="modal fade twm-sign-up"  id="bookmarks" aria-hidden="true" aria-labelledby="bookmarks" tabindex="-1">
		<form method="post" id="form" action="<?php echo defined( 'DOING_AJAX' ) ? '' : esc_url( remove_query_arg( array( 'page', 'paged' ), add_query_arg( $wp->query_string, '', home_url( $wp->request ) ) ) ); ?>" class="job-manager-form wp-job-manager-bookmarks-form">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						 <h2 class="modal-title">
							<?php echo esc_html__('Bookmark Details', 'jobzilla'); ?>
						 </h2>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="twm-tabs-style-2">
							
							 <div class="col-md-12">
								<div class="form-group">
									<label for="bookmark_notes">
										<?php _e( 'Notes:', 'jobzilla' ); ?>
									</label>
									<textarea cols="40" rows="6" class="form-control" name="bookmark_notes" id="bookmark_notes"   placeholder="<?php echo esc_attr('Greetings! We are Galaxy Software Development Company. We hope you enjoy our services and quality.', 'jobzilla'); ?>"><?php echo esc_textarea( $note ); ?></textarea>
								</div>
							</div>
							<p class="mb-0">
								<?php wp_nonce_field( 'update_bookmark' ); ?>
								<input type="hidden" name="bookmark_post_id" value="<?php echo absint( $post->ID ); ?>" />
								<input type="submit" id="bookmark" class="submit-bookmark-button site-button" name="submit_bookmark" value="<?php echo esc_attr($bookmark); ?>" />
								<span class="spinner" style="background-image: url(<?php echo includes_url( 'images/spinner.gif' ); ?>);"></span>
							</p>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>

	