<?php
/**
 * Content for a single resume.
 *
 * This template can be overridden by copying it to yourtheme/wp-job-manager-resumes/content-single-resume.php.
 *
 * @see         https://wpjobmanager.com/document/template-overrides/
 * @author      Automattic
 * @package     wp-job-manager-resumes
 * @category    Template
 * @version     1.7.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$allowed_html_tags = jobzilla_allowed_html_tag();
if ( resume_manager_user_can_view_resume( $post->ID ) ) : 

    $post_id = $post->ID;
    $candidate_data = jobzilla_get_post_meta($post_id, array('_candidate_salary', '_resume_file'));
?>
  
<div class="panel-body wt-panel-body">
	<div class="section-content">
		<div class="col-md-12">
			<!-- Candidate detail START -->
			<div class="cabdidate-de-info">
				<div class="twm-candi-self-wrap overlay-wraper" style="background-image:url(<?php echo esc_url(JOBZILLA_URL.'/assets/images/candidate-bg.jpg'); ?>);">
					<div class="overlay-main site-bg-primary opacity-01"></div>
					<div class="twm-candi-self-info">
						<div class="twm-candi-self-top">
							<?php if(!empty($candidate_data['_candidate_salary'])){ ?>
							<div class="twm-candi-fee">
								<?php echo esc_html($candidate_data['_candidate_salary']);?>
							</div>
							<?php } ?>
							<div class="twm-media">
							   <?php the_candidate_photo(); ?>
							</div>
							<div class="twm-mid-content">
								<h4 class="twm-job-title"><?php echo the_title(); ?> </h4>
								<p><?php the_candidate_title(); ?></p>
								<p class="twm-candidate-address">
									<i class="feather-map-pin"></i>
									<?php the_candidate_location(); ?>
								</p>
							</div>
						</div>
						<div class="twm-candi-self-bottom">
							<?php if(!empty($candidate_data['_resume_file'])){ ?>
								<a href="<?php echo esc_url($candidate_data['_resume_file']); ?>" class="site-button secondry" download><?php echo esc_html__('Download CV','jobzilla') ?></a>
							<?php } ?>
						</div>
					</div>
				</div>
				<div class="widget widget-description"><?php echo apply_filters( 'the_resume_description', get_the_content() ); ?> </div>
				<div class="widget">	
				<?php if ( ( $skills = wp_get_object_terms( $post->ID, 'resume_skill', [ 'fields' => 'names' ] ) ) && is_array( $skills ) ) { ?>
						<h5 class="twm-s-title dz-widget-title">
							<?php echo esc_html__('Skills','jobzilla'); ?>
						</h5>
						
						<div class="tw-sidebar-tags-wrap">
							<div class="tagcloud">
								<?php echo '<a>'. implode( '</a><a>', $skills ) . '</a>'; ?>
							</div>
						</div>
					<?php } ?>
				</div>
				<?php 
				$items = get_post_meta( $post->ID, '_candidate_education', true );
				if (!empty($items)) { ?>
				<div class="widget">	
				<h5 class="twm-s-title dz-widget-title">
					<?php echo esc_html__( 'Education & Training', 'jobzilla' ); ?>
				</h5>
				<div class="twm-timing-list-wrap">
				<?php
					foreach ( $items as $item ) {
				?>
				 <div class="twm-timing-list">
						<div class="twm-time-list-date">
						<?php echo esc_html( $item['date'] ); ?>
						</div>
						<div class="twm-time-list-title">
						<?php echo esc_html( $item['qualification'] ); ?>
						</div>
						<div class="twm-time-list-position">
						<?php echo esc_html( $item['location'] ); ?>
						</div>
						<div class="twm-time-list-discription">
							<p>
								<?php echo wp_kses(wpautop( wptexturize( $item['notes'] ) ), $allowed_html_tags); ?>
							</p>
						</div>
					</div>
					
				<?php } ?>
				</div>
				</div>
				<?php } ?>
				<?php
				 $items = get_post_meta( $post->ID, '_candidate_experience', true );
				if (!empty( $items)) { ?>
				<div class="widget">
				<h5 class="twm-s-title dz-widget-title">
					<?php echo esc_html__( 'Work Experience', 'jobzilla' ); ?>
				</h5>
				<div class="twm-timing-list-wrap">
					<?php
						foreach ( $items as $item ) {
					?>
				   <div class="twm-timing-list">
						<div class="twm-time-list-date">
							<?php echo esc_html( $item['date'] ); ?>
						</div>
						<div class="twm-time-list-title">
							<?php echo esc_html( $item['job_title'] ) ; ?>
						</div>
						<div class="twm-time-list-position">
							<?php echo esc_html( $item['employer'] ) ; ?>
						</div>
						<div class="twm-time-list-discription">
							<p>
								<?php echo wp_kses(wpautop( wptexturize( $item['notes'] ) ), $allowed_html_tags); ?>
							</p>
						</div>
					</div>
						<?php } ?>
				</div>
				</div>
				<?php } ?>
				<?php get_job_manager_template( 'contact-details.php', [ 'post' => $post ], 'jobzilla', RESUME_MANAGER_PLUGIN_DIR . '/templates/' ); ?>

				<?php do_action( 'single_resume_end' ); ?>	
			</div>
		</div>  
	</div>
</div>

<?php else : ?>

	<?php get_job_manager_template_part( 'access-denied', 'single-resume', 'jobzilla', RESUME_MANAGER_PLUGIN_DIR . '/templates/' ); ?>

<?php endif; ?>