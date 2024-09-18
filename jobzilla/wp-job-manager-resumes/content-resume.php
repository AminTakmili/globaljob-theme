<?php
/**
 * Template for resume content inside a list of resumes.
 *
 * This template can be overridden by copying it to yourtheme/wp-job-manager-resumes/content-resume.php.
 *
 * @see         https://wpjobmanager.com/document/template-overrides/
 * @author      Automattic
 * @package     wp-job-manager-resumes
 * @category    Template
 * @version     1.18.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
	global $post;
	$post_id = $post->ID;
    $candidate_data = jobzilla_get_post_meta($post_id,array('_candidate_title','_featured','_candidate_salary',));	
	$form_data = array();
	 if(!empty($_POST['form_data'])){
		parse_str($_POST['form_data'], $form_data);
		if($form_data['resume_filter_view'] == 'full-width'){
			$col_class = 'col-lg-4 col-md-6 m-b30';
		}else{
			$col_class = 'col-lg-6 col-md-6 m-b30';
		}
		
		if(!empty($form_data['list_layout'])){
			$list_layout = $form_data['list_layout'];
		}
	}else{
		$col_class = 'col-lg-4 col-md-6';
	}
	
	if(!empty($_POST['list_layout'])){
		$list_layout = sanitize_text_field($_POST['list_layout']);
	}	
	
	if(!empty($list_layout) && $list_layout == 'grid'){
?>
		<div class="<?php echo esc_attr($col_class); ?>">
			<div <?php resume_class(); ?>>
				 <div class="twm-candidates-grid-style1">
					 <div class="twm-media">
						 <div class="twm-media-pic">
							<?php 
							 the_candidate_photo('', '', $post); 
							 ?>
							
						 </div>
						 <?php if(!empty($candidate_data['_featured'])){ ?>
							 <div class="twm-candidates-tag">
								<span><?php echo esc_html__('Featured', 'jobzilla'); ?></span>
							 </div>
						 <?php } ?>
					 </div>
					<div class="twm-mid-content">
						<a href="<?php the_resume_permalink(); ?>" class="twm-job-title">
							<h5><?php the_title(); ?></h5>
						</a>
						<?php if(!empty($candidate_data['_candidate_title'])){ ?>
							<p>
								<?php echo esc_html($candidate_data['_candidate_title']); ?>
							</p>
						<?php } ?>
						<a href="<?php the_resume_permalink(); ?>" class="twm-view-prifile site-text-primary">
							<?php echo esc_html__('View Profile', 'jobzilla'); ?>
						</a>
					</div>
					<div class="twm-fot-content">
						<div class="twm-left-info">
							<p class="twm-candidate-address"><i class="feather-map-pin"></i><?php the_candidate_location( false ); ?></p>
							<?php if(!empty($candidate_data['_candidate_salary'])){ ?>
								<div class="twm-jobs-vacancies">
									<?php echo esc_html($candidate_data['_candidate_salary']); ?>
								</div>
							<?php } ?>
						</div>
					</div>
				 </div>
			</div>
		</div>
<?php }else{  ?>
		<div <?php resume_class(); ?>>
			<div class="twm-candidates-list-style1">
				<div class="twm-media">
					 <div class="twm-media-pic">
						<?php  the_candidate_photo('', '', $post);  ?>
					 </div>
					 <?php if(!empty($candidate_data['_featured'])){ ?>
					 <div class="twm-candidates-tag">
						<span><?php echo esc_html__('Featured', 'jobzilla'); ?></span>
					 </div>
					 <?php } ?>
				</div>
				<div class="twm-mid-content">
					 <a href="<?php the_resume_permalink(); ?>" class="twm-job-title">
						 <h5><?php the_title(); ?></h5>
					 </a>
					<?php if(!empty($candidate_data['_candidate_title'])){ ?>
						<p>
							<?php echo esc_html($candidate_data['_candidate_title']); ?>
						</p>
					<?php } ?>
					<div class="twm-fot-content">
						 <div class="twm-left-info">
							<p class="twm-candidate-address"><i class="feather-map-pin"></i><?php the_candidate_location( false ); ?></p>
							<?php if(!empty($candidate_data['_candidate_salary'])){ ?>
							<div class="twm-jobs-vacancies">
								<?php echo esc_html($candidate_data['_candidate_salary']); ?>
							</div>
							<?php } ?>
						 </div>
						 <div class="twm-right-btn">
							 <a href="<?php the_resume_permalink(); ?>" class="twm-view-prifile site-text-primary">
								<?php echo esc_html__('View Profile', 'jobzilla'); ?>
							 </a>
						 </div>
					</div>
				</div>
			</div>
		</div>
<?php }?>