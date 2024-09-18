<?php
/**
 * Job listing in the loop.
 *
 * This template can be overridden by copying it to yourtheme/job_manager/content-job_listing.php.
 *
 * @see         https://wpjobmanager.com/document/template-overrides/
 * @author      Automattic
 * @package     wp-job-manager
 * @category    Template
 * @since       1.0.0
 * @version     1.34.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
global $post;
$post_id = $post->ID;
$company_data = jobzilla_get_post_meta
	($post_id,
		array(
			'_company_website',
			'_job_location',
			'_job_salary',
			'_salary_max',
			'_job_salary_currency',
			'_job_salary_unit',
			'_latitude',
			'_longitude',
			'_company_id',
		)
	);
$count = 1;
$type_color = array(
					1=>'twm-bg-green',
					2=>'twm-bg-brown',
					3=>'twm-bg-purple',
					4=>'twm-bg-sky',
					5=>'twm-bg-golden', 
					
				);
	$form_data = array();
	if(!empty($_POST['form_data'])){
		parse_str($_POST['form_data'], $form_data);
		if($form_data['job_filter_view'] == 'full-width'){
			$col_class = 'col-lg-4 col-md-12 m-b30';
		}else{
			$col_class = 'col-lg-6 col-md-12 m-b30';
		}
		if(!empty($form_data['list_layout'])){
			$list_layout = $form_data['list_layout'];
		}
	} else{
		$col_class = 'col-xl-4 col-lg-6 col-md-6 col-12 m-b50';
	}

if(!empty($_POST['list_layout'])){
	$list_layout = sanitize_text_field($_POST['list_layout']);
}
$job_type = '';
$types = wpjm_get_the_job_types( $post );
if(!empty($types[0])){ 
	$type = $types[0];
	$job_type = $type->name;
}
$attr_arr = array(
				'longitude'=>(!empty($company_data['_latitude'])) ? $company_data['_latitude'] : '',
				'latitude'=>(!empty($company_data['_longitude'])) ? $company_data['_longitude'] : '',
				'title'=> $post->post_title,
				'image'=> esc_url(get_the_company_logo()),
				'company'=> get_the_title($company_data['_company_id']),
				'job_type'=> $job_type,
				'job_link'=> get_the_title(),
			);

$item_attrs = '';
foreach($attr_arr as $key => $value){
	$item_attrs .= ' data-'.$key.'="'.$value.'" ';	
}
$allowed_html_tags = jobzilla_allowed_html_tag();
	


if(!empty($list_layout) && $list_layout == 'grid'){
?>
	
	<div class="<?php echo esc_attr($col_class); ?>">
		<div <?php job_listing_class(); ?> <?php echo wp_kses($item_attrs, $allowed_html_tags); ?>>
		<div class="twm-jobs-grid-style1">
				<div class="twm-media">
					<?php if(has_post_thumbnail($post->ID)) {
						the_company_logo(); 	
					 }else{ ?>
						<img class="company_logo" src="<?php echo esc_url(JOBZILLA_URL.'/assets/images/company.png'); ?>" alt="<?php wpjm_the_job_title(); ?>">
					 <?php } ?>
				</div>
				<?php if ( get_option( 'job_manager_enable_types' ) ) { ?>
						<?php $types = wpjm_get_the_job_types(); ?>
						<?php if ( ! empty( $types ) ) {
								if($count == 6){
							$count = 1;
						}
						$type_colors = $type_color[$count];
							?>
						<div class="twm-jobs-category green">
						<?php foreach ( $types as $type ) { ?>
							<span class="<?php echo esc_html($type_colors); ?>"> 
								<?php echo esc_html( $type->name ); ?>
							</span>
						<?php
						}  ?>
						</div>
						<?php } ?>
				<?php } ?>
				<div class="twm-mid-content">
					<a href="<?php the_job_permalink(); ?>" class="twm-job-title">
						<h6>
							<?php wpjm_the_job_title(); ?>
							
						</h6>
					</a>
				   <?php if(!empty($company_data['_job_location'])){ ?>
						<p class="twm-job-address">
							<?php echo esc_html($company_data['_job_location']);?>
						</p>
					<?php } ?>
					<?php if(!empty($company_data['_company_website'])){ ?>
						<a href="<?php echo esc_url($company_data['_company_website']);?>" class="twm-job-websites site-text-primary" target="_blank">
						<?php echo esc_html($company_data['_company_website']);?>
						</a>
					<?php } ?>
				</div>
				<div class="twm-right-content">
				
					<?php if(!empty($company_data['_job_salary_currency']) || !empty($company_data['_job_salary']) || !empty($company_data['_job_salary_unit']) || !empty($company_data['_salary_max'])){ ?>
						<div class="twm-jobs-amount">
							<?php echo jobzilla_get_job_salary($company_data); ?> 
						</div>
					<?php } ?>
					 <a href="<?php the_job_permalink(); ?>" class="twm-jobs-browse site-text-primary">
						<?php echo esc_html__('Browse Job' , 'jobzilla');?>
					 </a>
					 
					
					 
				</div>
			</div>
		</div>
	</div>
	<?php }else{ ?>
		<div <?php job_listing_class(); ?> <?php echo wp_kses($item_attrs, $allowed_html_tags); ?>>
		 <div class="twm-jobs-list-style1">
			<div class="twm-media">
			<?php if(has_post_thumbnail($post->ID)) {
					 the_company_logo(); 
			 }else{ ?>
				<img class="company_logo" src="<?php echo esc_url(JOBZILLA_URL.'/assets/images/company.png'); ?>" alt="<?php wpjm_the_job_title(); ?>">
			 <?php } ?>
			</div>
			 <div class="twm-mid-content">
				 <a href="<?php the_job_permalink(); ?>" class="twm-job-title">
					<h5 class="twm-job-title">
					<?php wpjm_the_job_title(); ?>
						
					</h5>
				 </a>
				 <?php if(!empty($company_data['_job_location'])){ ?>
					<p class="twm-job-address">
						<?php echo esc_html($company_data['_job_location']);?>
					</p>
				 <?php } ?>
				 <?php if(!empty($company_data['_company_website'])){ ?>
					<a href="<?php echo esc_url($company_data['_company_website']);?>" class="twm-job-websites site-text-primary" target="_blank">
					<?php echo esc_html($company_data['_company_website']);?>
					</a>
					 
				 <?php } ?>
			</div>
			 <div class="twm-right-content">
				<?php if ( get_option( 'job_manager_enable_types' ) ) { ?>
					<?php $types = wpjm_get_the_job_types(); ?>
					<?php if ( ! empty( $types ) ) {
							if(!empty($count == 6)){
						$count = 1;
					}
					$type_colors = $type_color[$count];
						?>
					<div class="twm-jobs-category green">
					<?php foreach ( $types as $type ) { ?>
						<span class="<?php echo esc_html($type_colors); ?>"> 
							<?php echo esc_html( $type->name ); ?>
						</span>
					<?php
					}  ?>
					</div>
					<?php } ?>
				<?php } ?>
				<?php if(!empty($company_data['_job_salary_currency']) || !empty($company_data['_job_salary']) || !empty($company_data['_job_salary_unit']) || !empty($company_data['_salary_max'])){ ?>
						<div class="twm-jobs-amount">
							<?php echo jobzilla_get_job_salary($company_data); ?> 
						</div>
					<?php } ?>
				<div>
					 <a href="<?php the_job_permalink(); ?>" class="twm-jobs-browse site-text-primary">
						<?php echo esc_html__('Browse Job' , 'jobzilla');?>
					 </a>
				</div>
			 </div>
		 </div>
	 </div>
	<?php 
	 }
$count++ ?>

