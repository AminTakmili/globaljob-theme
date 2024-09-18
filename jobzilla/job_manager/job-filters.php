<?php
/**
 * Filters in `[jobs]` shortcode.
 *
 * This template can be overridden by copying it to yourtheme/job_manager/job-filters.php.
 *
 * @see         https://wpjobmanager.com/document/template-overrides/
 * @author      Automattic
 * @package     wp-job-manager
 * @category    Template
 * @version     1.33.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
wp_enqueue_script( 'jobzilla-wp-job-manager-ajax-filters' );
do_action( 'job_manager_job_filters_before', $atts );
$col_class = $atts['job_filter_view'] == 'full-width' ? '' :'col-lg-4 col-md-12 left';
?>
		
	<div class="<?php echo esc_attr($col_class); ?>">
		<div class="sticky-top ">
		<button class="site-button btn-fillter d-block d-lg-none">
			<?php echo esc_html__('Fillter', 'jobzilla'); ?> </button>
		<div class="sidebar-close">
			<div class="sb-close-btn">&times;</div>
		</div>
		<div class="side-bar  fillter-sidebar">
			<div class="sidebar-elements search-bx">
				<form class="job_filters">
					<input type="hidden" name="list_layout" value="<?php echo esc_attr($atts['list_layout']); ?>">
					<input type="hidden" name="job_filter_view" value="<?php echo esc_attr($atts['job_filter_view']); ?>">
					<?php do_action( 'job_manager_job_filters_start', $atts ); ?>

					<div class="search_jobs">
						<?php do_action( 'job_manager_job_filters_search_jobs_start', $atts ); ?>
						<div class="widget">
							<div class="search_keywords form-group">
								<label class="section-head-small">
									<?php esc_html_e( 'Keywords', 'jobzilla' ); ?>
								</label>
								<div class="input-group">
									<input type="text" class="form-control" name="search_keywords" id="search_keywords" placeholder="<?php esc_attr_e( 'Keywords', 'jobzilla' ); ?>" value="<?php echo esc_attr( $keywords ); ?>" />
								</div>
							</div>
						<?php if ( class_exists('Astoundify_Job_Manager_Regions') &&  ( get_option( 'job_manager_regions_filter' ) || is_tax( 'job_listing_region' ) ) ) {  ?>
							
							<div class="widget search_region job-widget-regions" <?php if( is_tax( 'job_listing_region' ) ) : echo ' style="display:none;" '; endif; ?>>
							<label class="section-head-small"><?php esc_html_e('Region','jobzilla'); ?></label>
								
									<?php
									$selected = '';
									if(is_tax('job_listing_region')){
										
										$region = get_query_var('job_listing_region');
										$term = get_term_by('slug', $region, 'job_listing_region');
										$selected = $term->term_id;
										
									} else {	
										if(isset($_GET[ 'search_region' ])){
											$trim = get_term_by('slug',$_GET[ 'search_region' ], 'job_listing_region');
											$selected = isset( $trim->term_id ) ?  absint($trim->term_id) : '';
										}
									}
									wp_dropdown_categories( array(
										'show_option_all'           => __( 'All Regions', 'jobzilla' ),
										'orderby'                   => 'name',
										'taxonomy'                  => 'job_listing_region',
										'selected'                  => $selected,
										'hierarchical'              => 1,
										'name'                      => 'search_region',
										'id'                        => 'search_region',
										'hide_empty'                => true,
										'class'                     => 'wt-select-bar-large selectpicker',
									)  );	
								
								?>

							</div>
							<?php } else { ?>
								<div class="search_location form-group">
									<label class="section-head-small"><?php esc_html_e( 'Location', 'jobzilla' ); ?></label>
									<div class="input-group">
										<input type="text" class="form-control" name="search_location" id="search_location" placeholder="<?php esc_attr_e( 'Location', 'jobzilla' ); ?>" value="<?php echo esc_attr( $location ); ?>" />
									</div>
								</div>
							<?php } 
							 if ( $categories ) { ?>
								<?php foreach ( $categories as $category ) { ?>
									<input type="hidden" name="search_categories[]" value="<?php echo esc_attr( sanitize_title( $category ) ); ?>" />
								<?php } ?>
							<?php }elseif ( $show_categories && ! is_tax( 'job_listing_category' ) && get_terms( [ 'taxonomy' => 'job_listing_category' ] ) ) { ?>
								<div class="search_categories form-group">
									<label class="section-head-small"><?php esc_html_e( 'Category', 'jobzilla' ); ?></label>
									<?php if ( $show_category_multiselect ) { ?>
										<?php job_manager_dropdown_categories( 
										[ 
											'taxonomy' => 'job_listing_category',
											'hierarchical' => 1,
											'name' => 'search_categories',
											'orderby' => 'name',
											'selected' => $selected_category,
											'hide_empty' => true,
											'class'   => 'wt-select-bar-large selectpicker',
										] ); ?>
									<?php }else { ?>
										<?php job_manager_dropdown_categories( 
										[ 
											'taxonomy' => 'job_listing_category',
											'hierarchical' => 1, 
											'show_option_all' => __( 'Any category','jobzilla' ), 
											'name' => 'search_categories',
											'orderby' => 'name', 
											'selected' => $selected_category,
											'multiple' => false, 
											'hide_empty' => true ,
											'class'   => 'wt-select-bar-large selectpicker',
										] ); ?>
									<?php } ?>
									
								</div>
							<?php } ?>

							<?php
							do_action( 'job_manager_job_filters_salary_start', $atts ); 
							/**
							 * Show the submit button on the job filters form.
							 *
							 * @since 1.33.0
							 *
							 * @param bool $show_submit_button Whether to show the button. Defaults to true.
							 * @return bool
							 */
							if ( apply_filters( 'job_manager_job_filters_show_submit_button', true ) ) {
							?>
								<div class="search_submit">
									<input type="submit" class="site-button" value="<?php esc_attr_e( 'Search Jobs', 'jobzilla' ); ?>">
								</div>
						</div>
						<div class="widget">		
							<?php } 
							do_action( 'job_manager_job_filters_search_jobs_tag_end', $atts ); 
							?>
						</div>
						<?php 
							do_action( 'job_manager_job_filters_end', $atts );
							
						 ?>
					</div>

					
					
				</form>
			</div>
		</div>
	</div>
	</div>


	
<?php do_action( 'job_manager_job_filters_after', $atts ); ?>

<noscript><?php esc_html_e( 'Your browser does not support JavaScript, or it is disabled. JavaScript must be enabled in order to view listings.', 'jobzilla' ); ?></noscript>



