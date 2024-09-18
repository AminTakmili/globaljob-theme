<?php
/**
 * Single job listing.
 *
 * This template can be overridden by copying it to yourtheme/job_manager/content-single-job_listing.php.
 *
 * @see         https://wpjobmanager.com/document/template-overrides/
 * @author      Automattic
 * @package     wp-job-manager
 * @category    Template
 * @since       1.0.0
 * @version     1.28.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
global$post;


 $post_id			= 	get_the_id();
$company_data = jobzilla_get_post_meta
	($post_id,
		array(
			'_company_website',
			'_job_salary',
			'_job_salary_currency',
			'_job_salary_unit',
		)
	);
	
	$company_id = jobzilla_get_post_meta($post_id, '_company_id');
	$job_data = jobzilla_get_post_meta
	($company_id,
		array(
			'_company_video',
			'_company_facebook',
			'_company_twitter',
			'_company_linkedin',
			'_company_whatsapp',
			'_company_pinterest',
			'_company_video_image',
			'_company_office_gallery',
			'_company_image'
		)
	);

 if ( get_option( 'job_manager_hide_expired_content', 1 ) && 'expired' === $post->post_status ) {
	 

?>
<div class="job-manager-info">
	<?php _e( 'This listing has expired.', 'jobzilla' ); ?>
</div>
 <?php }else { ?>
	<div class="panel-body wt-panel-body">
		<div class="cabdidate-de-info">
			<div class="twm-job-self-wrap">
				<div class="twm-job-self-info">
					<div class="twm-job-self-top">
						<div class="twm-media-bg">
							<?php if(!empty($job_data['_company_image'])){ ?>
								<img src="<?php echo esc_url($job_data['_company_image']); ?>" alt="<?php echo esc_attr__('Image','jobzilla') ?>">
							<?php } ?>
							<div class="twm-jobs-category green">
							<?php if ( get_option( 'job_manager_enable_types' ) ) { ?>
				
									<?php $types = wpjm_get_the_job_types(); ?>
									<?php if ( ! empty( $types ) ) {
										foreach ( $types as $type ) { ?>
											<a href="<?php echo esc_attr( sanitize_title( $type->slug ) ); ?>"><span class="twm-bg-green"> <?php echo esc_html( $type->name ); ?></span></a>
										<?php }; 
									} ?>
			
							<?php } ?>
								
							</div>
						</div>
						<div class="twm-media">
							<?php the_company_logo(); ?>
						</div>
						<div class="twm-mid-content">
							<h4 class="twm-job-title">
								<?php wpjm_the_job_title(); ?>
								<span class="twm-job-post-duration"><?php echo esc_html('/').the_job_publish_date(); ?></span>
							</h4>
							<p class="twm-job-address"><i class="feather-map-pin"></i><?php the_job_location(); ?></p>
							<div class="twm-job-self-mid">
								<div class="twm-job-self-mid-left">
									<?php if(!empty($company_data['_company_website'])){ ?>
										<a href="<?php echo esc_url($company_data['_company_website']); ?>" class="twm-job-websites site-text-primary">
											<?php echo esc_html($company_data['_company_website']); ?>
										</a>
									<?php } ?>			
									<?php if(!empty($company_data['_job_salary_currency']) && !empty($company_data['_job_salary']) && !empty($company_data['_job_salary_unit'])){ ?>
										<div class="twm-jobs-amount">
											<?php echo esc_html($company_data['_job_salary_currency'].$company_data['_job_salary']); ?> <span>/ <?php echo esc_html(ucfirst($company_data['_job_salary_unit'])); ?></span>
										</div>
									<?php } ?>	
								</div>
								<?php if ( is_position_filled() ) { ?>
										<li class="position-filled"><?php _e( 'This position has been filled', 'jobzilla' ); ?></li>
								<?php }elseif ( ! candidates_can_apply() && 'preview' !== $post->post_status ) { ?>
										<li class="listing-expired"><?php _e( 'Applications have closed', 'jobzilla' ); ?></li>
								<?php } ?>
								<div class="twm-job-apllication-area">
									<ul>
									<?php do_action( 'single_job_listing_meta_end' ); ?>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="widget widget-description">
			<p>
				<?php wpjm_the_job_description(); ?>
			</p>
			</div>
			<?php if(!empty($job_data['_company_facebook']) || !empty($job_data['_company_twitter']) || !empty($job_data['_company_linkedin']) || !empty($job_data['_company_whatsapp']) || !empty($job_data['_company_pinterest'])){ ?>
			<div class="widget"> 
			<h5 class="twm-s-title dz-widget-title">
				<?php echo esc_html__('Social Profile','jobzilla'); ?>
			</h5>
			<div class="twm-social-tags">
				<?php if(!empty($job_data['_company_facebook'])){ ?>
					<a href="<?php echo esc_url($job_data['_company_facebook']); ?>" class="fb-clr"><?php echo esc_html__('Facebook','jobzilla'); ?></a>
				<?php } ?>
				<?php if(!empty($job_data['_company_twitter'])){ ?>
					<a href="<?php echo esc_url($job_data['_company_twitter']); ?>" class="tw-clr"><?php echo esc_html__('Twitter','jobzilla'); ?></a>
				<?php } ?>

				<?php if(!empty($job_data['_company_linkedin'])){ ?>
					<a href="<?php echo esc_url($job_data['_company_linkedin']); ?>" class="link-clr"><?php echo esc_html__('Linkedin','jobzilla'); ?></a>
				<?php } ?>

				<?php if(!empty($job_data['_company_whatsapp'])){ ?>
					<a href="<?php echo esc_url($job_data['_company_whatsapp']); ?>" class="whats-clr"><?php echo esc_html__('Whats App','jobzilla'); ?></a>
				<?php } ?>

				<?php if(!empty($job_data['_company_pinterest'])){ ?>
					<a href="<?php echo esc_url($job_data['_company_pinterest']); ?>" class="pinte-clr"><?php echo esc_html__('Pinterest','jobzilla'); ?></a>
				<?php } ?>
			</div>
			</div>
			<?php } ?>
			<div class="twm-two-part-section">
				<div class="row">
					<?php
					$all_images = !empty($job_data['_company_office_gallery']) ? maybe_unserialize($job_data['_company_office_gallery']) :'';
					if(!empty($job_data['_company_office_gallery']) && !empty($all_images)){ ?>
						<div class="col-lg-6 col-md-6">
							<div class="widget">
								<h5 class="twm-s-title dz-widget-title"><?php echo esc_html__('Office Photos','jobzilla'); ?></h5>
								<div class="tw-sidebar-gallery">
									<ul>
										<?php 
										
										foreach($all_images as $gallery){ 
										?>
										<li>
											<div class="tw-service-gallery-thumb">
												<a class="elem" href="<?php echo esc_url($gallery); ?>" title="Title 1" data-lcl-author="" data-lcl-thumb="<?php echo esc_url($gallery); ?>">
													<img src="<?php echo esc_url($gallery); ?>" alt="<?php echo esc_attr__('Image','jobzilla') ?>">
													<i class="fa fa-file-image"></i>     
												</a>
											</div>
										</li>
									<?php } ?>							
									</ul>		
								</div> 
							</div>
						</div>
					<?php } ?>

					<?php if(!empty($job_data['_company_video']) && !empty($job_data['_company_video_image'])){ ?>
						<div class="col-lg-6 col-md-6">
							<div class="widget">
								<h5 class="twm-s-title dz-widget-title"><?php echo esc_html__('Video','jobzilla'); ?></h5>
								<?php if(!empty($job_data['_company_video_image'])){ ?>
									<div class="video-section-first" style="background-image: url(<?php echo esc_url($job_data['_company_video_image']); ?>);">
								<?php } ?>

								<?php if(!empty($job_data['_company_video'])){ ?>
									<a href="<?php echo esc_url($job_data['_company_video']); ?>" class="mfp-video play-now-video">
										<i class="fa fa-play icon"></i>
										<span class="ripple"></span>
									</a>
								<?php } ?>
								</div> 
							</div>
						</div>
					<?php } ?>
				</div>
			</div>	
		</div>
	</div>
			
<?php
	/**
	 * single_job_listing_end hook
	 */
	do_action( 'single_job_listing_end' );
  } 
?>
<!-- OUR BLOG END -->       
