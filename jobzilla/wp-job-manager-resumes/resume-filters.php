<?php
/**
 * Filter form to display above `[resumes]` shortcode.
 *
 * This template can be overridden by copying it to yourtheme/wp-job-manager-resumes/resume-filters.php.
 *
 * @see         https://wpjobmanager.com/document/template-overrides/
 * @author      Automattic
 * @package     wp-job-manager-resumes
 * @category    Template
 * @version     1.13.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

wp_enqueue_script( 'jobzilla-wp-resume-manager-ajax-filters' );
do_action( 'resume_manager_resume_filters_before', $atts );
$col_class = $atts['resume_filter_view'] == 'full-width' ? '' :'col-lg-4 col-md-12 left';

$jobzilla_option = getDZThemeReduxOption();
$recruiter_widget_on	=	jobzilla_set($jobzilla_option, 'recruiter_widget_on');
$recruiter_widget_image	=	jobzilla_set($jobzilla_option, 'recruiter_widget_image');
$recruiter_widget_title	=	jobzilla_set($jobzilla_option, 'recruiter_widget_title');
$recruiter_widget_content	=	jobzilla_set($jobzilla_option, 'recruiter_widget_content');
$recruiter_widget_btn_url	=	jobzilla_set($jobzilla_option, 'recruiter_widget_btn_url');
$recruiter_widget_btn_text	=	jobzilla_set($jobzilla_option, 'recruiter_widget_btn_text');
$recruiter_widget_btn_target=	jobzilla_set($jobzilla_option, 'recruiter_widget_btn_target');
?>
	<div class="<?php echo esc_attr($col_class); ?>">
		<div class="sticky-top">
		<button class="site-button mb-4 btn-fillter d-block d-lg-none">
			<?php echo esc_html__('Fillter', 'jobzilla'); ?> </button>
		<div class="sidebar-close">
			<div class="sb-close-btn">&times;</div>
		</div>
			<div class="side-bar fillter-sidebar">
				<div class="sidebar-elements search-bx">										
					<form class="resume_filters job_filters">
						<input type="hidden" name="list_layout" value="<?php echo esc_attr($atts['list_layout']); ?>">
						<input type="hidden" name="resume_filter_view" value="<?php echo esc_attr($atts['resume_filter_view']); ?>">
						<div class="search_resumes search_jobs">
							<div class="widget">
								<?php do_action( 'resume_manager_resume_filters_search_resumes_start', $atts ); ?>

								<div class="search_keywords form-group">
									<label class="section-head-small" for="search_keywords"><?php _e( 'Keywords', 'jobzilla' ); ?></label>
									<div class="input-group">
										<input type="text" class="form-control" name="search_keywords" id="search_keywords" placeholder="<?php _e( 'All Resumes', 'jobzilla' ); ?>" value="<?php echo esc_attr( $keywords ); ?>" />
									</div>
								</div>

								<div class="search_location form-group">
									<label class="section-head-small" for="search_location"><?php _e( 'Location', 'jobzilla' ); ?></label>
									<div class="input-group">
										<input type="text" class="form-control" name="search_location" id="search_location" placeholder="<?php _e( 'Any Location', 'jobzilla' ); ?>" value="<?php echo esc_attr( $location ); ?>" />
									</div>
								</div>

								<?php if ( $categories ){ ?>
									<?php foreach ( $categories as $category ){ ?>
										<input type="hidden" name="search_categories[]" value="<?php echo sanitize_title( $category ); ?>" />
									<?php } 
									}else if ( $show_categories && get_option( 'resume_manager_enable_categories' ) && ! is_tax( 'resume_category' ) && get_terms( 'resume_category' ) ){ ?>
									<div class="search_categories form-group">
										<label class="section-head-small" for="search_categories"><?php _e( 'Category', 'jobzilla' ); ?></label>
										<?php if ( $show_category_multiselect ){ ?>
											<?php
											job_manager_dropdown_categories(
												[
													'taxonomy'     => 'resume_category',
													'hierarchical' => 1,
													'name'         => 'search_categories',
													'orderby'      => 'name',
													'class'        => 'wt-select-bar-large selectpicker',
													'selected'     => $selected_category,
													'hide_empty'   => false,
												]
											);
										  }else{ 
											wp_dropdown_categories(
												[
													'taxonomy'        => 'resume_category',
													'hierarchical'    => 1,
													'show_option_all' => __( 'Any category', 'jobzilla' ),
													'name'            => 'search_categories',
													'orderby'         => 'name',
													'class'           => 'wt-select-bar-large selectpicker',
													'selected'        => $selected_category,
												]
											);
										 } ?>
									</div>
								<?php } ?>

								<?php do_action( 'resume_manager_resume_filters_search_resumes_end', $atts ); ?>
							</div>
						</div>
						
					</form>
				</div>
			
		</div>	
			<?php
			
			if(!empty($recruiter_widget_on)){ 
				$bg_image = !empty($recruiter_widget_image) ? $recruiter_widget_image : '';
			?>
				<div class="twm-advertisment m-b0" <?php if(!empty($bg_image)){ ?> style="background-image:url(<?php echo esc_url($bg_image); ?>);" <?php } ?>>
					<div class="overlay"></div>
					
					<?php if(!empty($recruiter_widget_title)){ ?>
						<h4 class="twm-title">
							<?php echo esc_html($recruiter_widget_title) ?>
						</h4>
					<?php } ?>
					
					<?php if(!empty($recruiter_widget_content)){ ?>
						<p>
							<?php echo wp_kses($recruiter_widget_content, jobzilla_allowed_html_tag()) ?>
						</p>
					<?php } ?>
					
					<?php 
						if(!empty($recruiter_widget_btn_url) && !empty($recruiter_widget_btn_text))
						{ 
							$recruiter = !empty($recruiter_widget_btn_target) ? 'target="'.$recruiter_widget_btn_target.'"': '';
					?>
						<a href="<?php echo esc_url($recruiter_widget_btn_url); ?>" <?php echo esc_attr($recruiter); ?> class="site-button white">
							<?php echo esc_html($recruiter_widget_btn_text); ?>
						</a>
					<?php 
						} ?>
				 </div>
			<?php } ?>
	</div>
	</div>
<?php do_action( 'resume_manager_resume_filters_after', $atts ); ?>
