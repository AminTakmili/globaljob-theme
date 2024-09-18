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
 <div class="wt-listing-full-width">
	<form class="job_filters">
		<input type="hidden" name="list_layout" value="<?php echo esc_attr($atts['list_layout']); ?>">
		<input type="hidden" name="job_filter_view" value="<?php echo esc_attr($atts['job_filter_view']); ?>">
		 <div class="panel panel-default">
		  <div class="panel-body wt-panel-body p-a20 m-b30 ">
	<?php do_action( 'job_manager_job_filters_start', $atts ); ?>

	<div class="search_jobs">
       <div class="row">
		<?php do_action( 'job_manager_job_filters_search_jobs_start', $atts ); ?>
		<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
		<div class=" form-group">
			<label class="section-head-small">
				<?php esc_html_e( 'Keywords', 'jobzilla' ); ?>
			</label>
			<div class="input-group">
				<input type="text" class="form-control" name="search_keywords" id="search_keywords" placeholder="<?php esc_attr_e( 'Keywords', 'jobzilla' ); ?>" value="<?php echo esc_attr( $keywords ); ?>" />
			</div>
		</div>
		</div>
		<?php if ( class_exists('Astoundify_Job_Manager_Regions') &&  ( get_option( 'job_manager_regions_filter' ) || is_tax( 'job_listing_region' ) ) ) {  ?>
							
		<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
		<div class="widget search_region job-widget-regions " <?php if( is_tax( 'job_listing_region' ) ) : echo ' style="display:none;" '; endif; ?>>
		<label class="section-head-small"><?php esc_html_e('Region','jobzilla'); ?></label>
			
				<?php
				
				if(is_tax('job_listing_region')){
					
					$region = get_query_var('job_listing_region');
					$term = get_term_by('slug', $region, 'job_listing_region');
					$selected = $term->term_id;
					
				} else {
				
					$selected = isset( $_GET[ 'search_region' ] ) ? absint($_GET[ 'search_region' ]) : '';
					
				}
				wp_dropdown_categories( array(
					'show_option_all'           => __( 'All Regions', 'jobzilla' ),
					'hierarchical'              => 1,
					'orderby'                   => 'name',
					'taxonomy'                  => 'job_listing_region',
					'selected'                  => $selected,
					'name'                      => 'search_region',
					'id'                        => 'search_region',
					'class'                     => 'wt-select-bar-large selectpicker',
					'hide_empty'                => true,
				)  );	
			
			?>
			</div>
		</div>
		<?php } else { ?>
			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
			<div class="form-group">
				<label class="section-head-small"><?php esc_html_e( 'Location', 'jobzilla' ); ?></label>
				<div class="input-group">
					<input type="text" class="form-control" name="search_location" id="search_location" placeholder="<?php esc_attr_e( 'Location', 'jobzilla' ); ?>" value="<?php echo esc_attr( $location ); ?>" />
				</div>
			</div>
			</div>
		<?php } 
		
		 if ( $categories ) { ?>
			<?php foreach ( $categories as $category ) { ?>
				<input type="hidden" name="search_categories[]" value="<?php echo esc_attr( sanitize_title( $category ) ); ?>" />
			<?php } ?>
		<?php }elseif ( $show_categories && ! is_tax( 'job_listing_category' ) && get_terms( [ 'taxonomy' => 'job_listing_category' ] ) ) { ?>
			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
			<div class="search_categories  form-group">
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
						'class'   => 'wt-select-bar-large selectpicker ',
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
			</div>
		<?php }  ?>
		<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
			<?php
			do_action( 'job_manager_job_filters_salary_start', $atts ); 
			?>
		</div>
		<?php
		/**
		 * Show the submit button on the job filters form.
		 *
		 * @since 1.33.0
		 *
		 * @param bool $show_submit_button Whether to show the button. Defaults to true.
		 * @return bool
		 */

		if ( apply_filters( 'job_manager_job_filters_show_submit_button', true ) ) :
		?>
			 <div class="col-lg-12 col-md-12">                                   
				<div class="text-left">
					<button type="submit" class="site-button"><?php echo esc_html__('Search Job', 'jobzilla'); ?></button>
				</div>
			</div> 
			
		<?php endif; ?>
		</div>
	</div>
	</div>
	</div>
</form>
</div>
				
<?php do_action( 'job_manager_job_filters_after', $atts ); ?>

<noscript><?php esc_html_e( 'Your browser does not support JavaScript, or it is disabled. JavaScript must be enabled in order to view listings.', 'jobzilla' ); ?></noscript>



