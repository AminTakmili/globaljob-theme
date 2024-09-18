<?php 

	function jobzilla_job_manager_job_company_dashboard_columns( $company_dashboard_columns ){
	
	  $company_dashboard_columns  = array( 
				'company-title'     => esc_html__( 'Name', 'jobzilla' ),
                'status'            => esc_html__( 'Status', 'jobzilla' ),
                'date'              => esc_html__( 'Date Posted', 'jobzilla' ),
				'action'  			=> esc_html__( 'Action', 'jobzilla'),
				 );
				
	  return $company_dashboard_columns;
	}
	add_action( 'mas_job_manager_company_dashboard_columns', 'jobzilla_job_manager_job_company_dashboard_columns');

	function jobzilla_submit_company_form_fields( $fields ){
	
	$field_priority = array(
						'company_logo' => 1,
					);
	
	
	if(!empty($fields['company_fields'])){
			foreach($field_priority as $field => $priority){
				if(!empty($fields['company_fields'][$field])){
					$fields['company_fields'][$field]['priority'] = $priority;
				}
			}
	}
	
	$extra_fields = array(
					'company_linkedin' => array(
		                'label'        => esc_html__( 'Linkedin', 'jobzilla' ),
						'type'         => esc_html__('text', 'jobzilla'),
		                'placeholder'  => esc_html__( 'company linkedin page link', 'jobzilla' ),
						'priority'     => 16, 
						'required'     => false,
		            ),
		            'company_whatsapp' => array(
		                'label'        => esc_html__( 'Whats App', 'jobzilla' ),
						'type'         => esc_html__('text', 'jobzilla'),
		                'placeholder'  => esc_html__( 'company whatsapp page link', 'jobzilla' ),
						'priority'     => 17, 
						'required'     => false,
		            ),
		            'company_pinterest' => array(
		                'label'         => esc_html__( 'Pinterest', 'jobzilla' ),
						'type'          => esc_html__('text', 'jobzilla'),
		                'placeholder'   => esc_html__( 'company pinterest page link', 'jobzilla' ),
						'priority'      => 18, 
						'required'      => false,
		            ),
		            'company_image'   => array(
		                'label'       => esc_html__( 'Company Image', 'jobzilla' ),
		                'placeholder' => esc_html__( 'URL to the company image', 'jobzilla' ),
		                'type'        => 'text',
						'priority'    => 19, 
						'required'    => true,
		            ),
		            'company_video_image' => array(
		                'label'           => esc_html__( 'Company Video Image', 'jobzilla' ),
		                'placeholder'     => esc_html__( 'URL to the video company image', 'jobzilla' ),
		                'type'            => 'text',
						'priority'        => 20, 
						'required'        => false,
		            ),
		            'company_offered_salary' => array(
		                'label'              => esc_html__( 'Offered Salary', 'jobzilla' ),
		                'placeholder'        => esc_html__( 'Company offered Salary', 'jobzilla' ),
		                'type'               => 'text',
						'priority'           => 21, 
						'required'           => true,
		            ),
		            'company_office_gallery' => array(
		                'label'              => esc_html__( 'Company Office Gallery', 'jobzilla' ),
		                'placeholder'        => esc_html__( 'URL to the company Office gallery', 'jobzilla' ),
		                'type'               => 'file',
						'priority'           => 75, 
						'required'           => false,
		                'multiple'	         => true,
		            ),
					'geolocation_lat' => array(
		                'label'              => esc_html__( 'Latitude ', 'jobzilla' ),
		                'type'               => 'text',
						'placeholder'        => esc_html__( 'Enter your latitude', 'jobzilla' ),
						'priority'           => 22, 
						'required'           => false,
		            ),
					'geolocation_long' => array(
		                'label'              => esc_html__( 'Longitude ', 'jobzilla' ),
		                'type'               => 'text',
						'placeholder'        => esc_html__( 'enter your longitude', 'jobzilla' ),
						'priority'           => 23, 
						'required'           => false,
		            ),
					'company_adderss' => array(
		                'label'              => esc_html__( 'Adderss ', 'jobzilla' ),
		                'type'               => 'text',
						'placeholder'        => esc_html__( 'enter your adderss', 'jobzilla' ),
						'priority'           => 24, 
						'required'           => false,
		            ),
					'employer_detail_layout' => [
		                'label'       => esc_html__( 'Employer Detail Layout', 'jobzilla' ),
		                'type'		  => 'select',
						'required'      => false,
						'priority'    => 24,
		                'options' 	  => [
							'standard'=> esc_html__('Standard', 'jobzilla'),
							'full_width'=>esc_html__('Full Width', 'jobzilla')
						]
		            ],	
				);

	$fields_merge  = array_merge($fields['company_fields'],$extra_fields);
	
	$fields['company_fields'] = $fields_merge ;
	return $fields;
	
	
	
	return $fields;
	
}
add_action( 'submit_company_form_fields','jobzilla_submit_company_form_fields');



/* Add Company From WP Admin Form Fields Filter */
function jobzilla_company_manager_company_fields( $fields ){
	 
	

	$extra_fields = array(
					'_company_adderss' => array(
		                'label'       => esc_html__( 'Adderss', 'jobzilla' ),
		                'placeholder' => esc_html__( 'Enter your adderss', 'jobzilla' ),
		            ),
					'_company_linkedin' => array(
		                'label'       => esc_html__( 'Linkedin', 'jobzilla' ),
		                'placeholder' => esc_html__( 'company linkedin page link', 'jobzilla' ),
		            ),
		            '_company_whatsapp' => array(
		                'label'       => esc_html__( 'Whats App', 'jobzilla' ),
		                'placeholder' => esc_html__( 'company whatsapp page link', 'jobzilla' ),
		            ),
		            '_company_pinterest' => array(
		                'label'       => esc_html__( 'Pinterest', 'jobzilla' ),
		                'placeholder' => esc_html__( 'company pinterest page link', 'jobzilla' ),
		            ),
		            '_company_image' => array(
		                'label'       => esc_html__( 'Company Image', 'jobzilla' ),
		                'placeholder' => esc_html__( 'URL to the company image', 'jobzilla' ),
		                'type'        => 'file',
		            ),
		            '_company_video_image' => array(
		                'label'       => esc_html__( 'Company Video Image', 'jobzilla' ),
		                'placeholder' => esc_html__( 'URL to the video company image', 'jobzilla' ),
		                'type'        => 'file'
		            ),
		            '_company_office_gallery' => array(
		                'label'       => esc_html__( 'Company Office Gallery', 'jobzilla' ),
		                'placeholder' => esc_html__( 'URL to the company Office gallery', 'jobzilla' ),
		                'type'        => 'file',
		                'multiple'		  => true
		            ),
		            '_company_offered_salary' => array(
		                'label'       => esc_html__( 'Offered Salary', 'jobzilla' ),
		                'placeholder' => esc_html__( 'Company offered Salary', 'jobzilla' ),
		                'type'        => 'text',
		            ),
					'_geolocation_lat' => array(
		                'label'              => esc_html__( 'Latitude ', 'jobzilla' ),
		                'type'               => 'text',
						'placeholder' => esc_html__( '26.9026609192594', 'jobzilla' ),
		            ),
					'_geolocation_long' => array(
		                'label'              => esc_html__( 'Longitude ', 'jobzilla' ),
		                'type'               => 'text',
						'placeholder' => esc_html__( '75.80664793220636', 'jobzilla' ),
		            ),
					'_employer_detail_layout' => [
		                'label'       => esc_html__( 'Employer Detail Layout', 'jobzilla' ),
		                'type'		  => 'select',
		               'options' 	  => [
							'standard'=> esc_html__('Standard', 'jobzilla'),
							'full_width'=>esc_html__('Full Width', 'jobzilla')
						]
		            ],	
				);

	$fields = array_merge($fields,$extra_fields);
	
	return $fields;
	
}
add_action( 'company_manager_company_fields','jobzilla_company_manager_company_fields');



add_action( 'jobzilla_single_company_start', 'jobzilla_mas_wpjmc_single_company_content_open', 10 );
add_action( 'jobzilla_single_company', 'jobzilla_mas_wpjmc_single_company_header', 10 );
add_action( 'jobzilla_single_company', 'jobzilla_mas_wpjmc_single_company_video', 40 );
add_action( 'jobzilla_single_company_end', 'jobzilla_mas_wpjmc_single_company_content_close', 10 );



	if ( ! function_exists( 'jobzilla_mas_wpjmc_single_company_content_open' ) ) {
		function jobzilla_mas_wpjmc_single_company_content_open() {
			?>
			
			<div class="panel panel-default ">
			<div class="panel-body wt-panel-body">
			<div class="cabdidate-de-info">
			
			<?php
		}
	}

	if ( ! function_exists( 'jobzilla_mas_wpjmc_single_company_header' ) ) {
		function jobzilla_mas_wpjmc_single_company_header() {
			?>         
			
				<div class="twm-employer-self-wrap">
					<div class="twm-employer-self-info">
						<div class="twm-employer-self-top">
							<?php if(!empty(mas_wpjmc_get_the_meta_data( '_company_image' ))){ 
								$bg_img = mas_wpjmc_get_the_meta_data( '_company_image' );
							?>
							<div class="twm-media-bg">
								<img src="<?php echo esc_url($bg_img); ?>" alt="<?php bloginfo('name');?>">
							</div>
							<?php } ?>
							<?php $logo =  get_the_company_logo( null, 'thumbnail' ) ? get_the_company_logo( null, 'thumbnail' ) : apply_filters( 'job_manager_default_company_logo', JOB_MANAGER_PLUGIN_URL . '/assets/images/company.png' ); ?>
							
							<div class="twm-mid-content">
								<div class="twm-media">
									<img src="<?php echo esc_url( $logo ) ?>" alt="<?php the_title(); ?>">
								</div>
								<?php 
									the_title( ' <h4 class="twm-job-title">', '</h4>' ); 
									 if(!empty(mas_wpjmc_get_the_meta_data('_company_location'))){ 
										$location =  mas_wpjmc_get_the_meta_data('_company_location');
									 ?>
										<p class="twm-employer-address">
											<i class="feather-map-pin"></i>
											<?php echo esc_html($location); ?>
										</p>
								<?php }
									if(!empty(mas_wpjmc_get_the_meta_data('_company_website'))){ 
									
										$website = mas_wpjmc_get_the_meta_data('_company_website');
								?>
									<a href="<?php echo esc_url($website); ?>" class="twm-employer-websites site-text-primary">
										<?php echo esc_html($website); ?>
									</a>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
				<?php 
					if( ! empty( get_the_content() ) ) {
						?>
						<div class="widget widget-description">
							<p>
								<?php the_content();?>
							</p>
						</div>
						<?php
					}
		
					if( ! empty ( mas_wpjmc_get_the_meta_data( '_company_facebook' ) || ! empty ( mas_wpjmc_get_the_meta_data( '_company_twitter' ) ) ) || ! empty ( mas_wpjmc_get_the_meta_data( '_company_linkedin' ) ) || ! empty ( mas_wpjmc_get_the_meta_data( '_company_whatsapp' ) )  || ! empty ( mas_wpjmc_get_the_meta_data( '_company_pinterest' ) ) ) {
						?>
					<div class="widget"> 	
						<h5 class="twm-s-title dz-widget-title"><?php echo esc_html__('Share Profile', 'jobzilla'); ?></h5>
						<div class="twm-social-tags">
							<?php if( ! empty ( $company_facebook = mas_wpjmc_get_the_meta_data( '_company_facebook' ) ) ) { ?>
									<a href="<?php echo esc_url($company_facebook);?>" class="fb-clr">
										<?php echo esc_html__('Facebook', 'jobzilla'); ?>
									</a>
							<?php } ?>
							
							<?php if( ! empty ( $company_twitter = mas_wpjmc_get_the_meta_data( '_company_twitter' ) ) ) { ?>
								<a href="<?php echo esc_url( $company_twitter ); ?>" class="tw-clr">
										<?php echo esc_html__('Twitter', 'jobzilla'); ?>
									</a>
								
							<?php } ?>
							
							<?php if( ! empty ( $company_linkedin = mas_wpjmc_get_the_meta_data( '_company_linkedin' ) ) ) { ?>
									<a href="<?php echo esc_url( $company_linkedin ); ?>" class="link-clr">
										<?php echo esc_html__('Linkedin', 'jobzilla'); ?>
									</a>
							<?php } ?>
								<?php if( ! empty ( $company_whatsapp = mas_wpjmc_get_the_meta_data( '_company_whatsapp' ) ) ) { ?>
										<a href="<?php echo esc_url( $company_whatsapp ); ?>" class="whats-clr">
											<?php echo esc_html__('Whatsapp', 'jobzilla'); ?>
										</a>
								<?php } ?>
								<?php if( ! empty ( $company_pinterest = mas_wpjmc_get_the_meta_data( '_company_pinterest' ) ) ) { ?>
									<span class="company-data__content--list-item">
										<a href="tel:<?php echo esc_url( $company_pinterest ); ?>" class="pinte-clr">
											<?php echo esc_html__('Pinterest', 'jobzilla'); ?>
										</a>
									</span>
								<?php } ?>
						</div>
					</div>
					<?php
						}
					?>
			
			<?php
		}
	}
	
	if ( ! function_exists( 'jobzilla_mas_wpjmc_single_company_video' ) ) {
		function jobzilla_mas_wpjmc_single_company_video( $post = null ) {
			$video_embed = false;
			$video       = mas_wpjmc_get_the_meta_data( '_company_video' );
			
			$filetype    = wp_check_filetype( $video );

		 ?>
		<div class="twm-two-part-section">
			<div class="row">
				<?php
				 if(!empty(mas_wpjmc_get_the_meta_data('_company_office_gallery'))){
					$gallery = mas_wpjmc_get_the_meta_data('_company_office_gallery');
				?>
				<div class="col-lg-6 col-md-6">
					<div class="widget">
						<h5 class="twm-s-title dz-widget-title">
							<?php echo esc_html__('Office Photos','jobzilla') ?>
						</h5>
						<div class="tw-sidebar-gallery">
							<ul>
								<?php 
								foreach($gallery as $key => $image){ 
								?>
									<li>
										<div class="tw-service-gallery-thumb">
											<a class="elem" href="<?php echo esc_url($image); ?>" title="Title 1" data-lcl-author="" data-lcl-thumb="<?php echo esc_url($image); ?>">
												<img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr__('Image','jobzilla') ?>">
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
				<div class="col-lg-6 col-md-6">
					<?php 
					if ( ! empty( $video ) ) {
						// FV WordPress Flowplayer Support for advanced video formats.
						if ( shortcode_exists( 'flowplayer' ) ) {
							$video_embed = '[flowplayer src="' . esc_url( $video ) . '"]';
						} elseif ( ! empty( $filetype['ext'] ) ) {
							$video_embed = wp_video_shortcode( array( 'src' => $video ) );
						} else {
							$video_embed = wp_oembed_get( $video );
						}
					}
					$video_embed = apply_filters( 'the_company_video_embed', $video_embed, $post );
					
					$video_img = mas_wpjmc_get_the_meta_data('_company_video_image');
					
					if ( !empty($video) && !empty($video_img)) { ?>
					<div class="widget">
						<h5 class="twm-s-title dz-widget-title"><?php echo esc_html__('Video', 'jobzilla'); ?></h4>
						<div class="video-section-first" <?php if(!empty($video_img)){ ?> style="background-image: url(<?php echo esc_url($video_img); ?>);<?php } ?>">
							<a href="<?php echo esc_url( $video ); ?>" class="mfp-video play-now-video">
								<i class="fa fa-play icon"></i>
								<span class="ripple"></span>
							</a>
						</div> 
					</div>
					 <?php  
					} ?>
				</div>
			</div>
		</div>
	<?php 
		}
	} 
	
	
	if ( ! function_exists( 'jobzilla_mas_wpjmc_single_company_content_close' ) ) {
		function jobzilla_mas_wpjmc_single_company_content_close() {
			?>  	                               
			</div></div></div>
			<?php
		}
	}




add_action( 'jobzilla_company', 'jobzilla_mas_wpjmc_company_loop_content', 10 );
add_action( 'jobzilla_company_before_loop', 'jobzilla_mas_wpjmc_setup_loop' );
add_action( 'jobzilla_company_after_loop', 'jobzilla_mas_wpjmc_pagination', 100 );
add_action( 'jobzilla_company_after_loop', 'jobzilla_mas_wpjmc_reset_loop', 999 );
if ( ! function_exists( 'jobzilla_mas_wpjmc_company_loop_content' ) ) {
    function jobzilla_mas_wpjmc_company_loop_content() {
		
		if(!empty($_GET['list_layout'])){
			$list_layout = sanitize_text_field($_GET['list_layout']);
		}else{	
			$list_layout = get_option('jobzilla_list_layout_id');
		}
		if(!empty($list_layout) && $list_layout == 'grid'){
        ?>
		 <div class="twm-employer-grid-style1 mb-5">
			 <div class="twm-media">
				<?php $logo =  get_the_company_logo(null, 'thumbnail' ) ? get_the_company_logo(null,  'thumbnail' ) : apply_filters( 'job_manager_default_company_logo', JOB_MANAGER_PLUGIN_URL . '/assets/images/company.png' ); ?>
				<img src="<?php echo esc_url( $logo ) ?>" class="" alt="<?php the_title(); ?>">
			 </div>
			 <div class="twm-mid-content">
				<a href="<?php the_permalink(); ?>" class="twm-job-title">
					<h4>
						<?php the_title(); ?>
					</h4>
				</a>
				<p>
					<?php echo jobzilla_short_description(get_the_excerpt(), '', 20); ?>
				</p>
				<?php echo mas_wpjmc_get_taxomony_data('company_category','',true,'twm-job-websites site-text-primary');?>
			</div>
			 <div class="twm-right-content">
				<div class="twm-jobs-vacancies">
					<?php 
					$count_vacancy = mas_wpjmc_get_taxomony_data('company_category','',true);
					$count = count(explode(",",$count_vacancy));?>
					<span>
						<?php echo esc_html($count); ?>
					</span><?php if(!empty($count)){ echo esc_html__('Vacancies','jobzilla'); } ?>
				</div>
			</div>
		 </div>
		<?php }else{ ?>
		<div class="twm-employer-list-style1 mb-5">
			<div class="twm-media">
				<?php $logo =  get_the_company_logo(null,  'thumbnail' )? get_the_company_logo(null, 'thumbnail' ) : apply_filters( 'job_manager_default_company_logo', JOB_MANAGER_PLUGIN_URL . '/assets/images/company.png' ); ?>
				<img src="<?php echo esc_url( $logo ) ?>" class="" alt="<?php the_title(); ?>">
			</div>
		
			<div class="twm-mid-content">
				<a href="<?php the_permalink(); ?>" class="twm-job-title">
					<h4>
						<?php the_title(); ?>
					</h4>
				</a>
				<p>
					<?php echo jobzilla_short_description(get_the_excerpt(), '', 20); ?>
				</p>
				<?php echo mas_wpjmc_get_taxomony_data('company_category','',true,'twm-job-websites site-text-primary');?>
			</div>
			 <div class="twm-right-content">
				<div class="twm-jobs-vacancies">
					<?php 
					$count_vacancy = mas_wpjmc_get_taxomony_data('company_category','',true);
					$count = count(explode(",",$count_vacancy));?>
					<span>
						<?php echo esc_html($count); ?>
					</span><?php if(!empty($count)){ echo esc_html__('Vacancies','jobzilla'); } ?>
				</div>
			</div>
		</div>
        <?php
		}
    }
}
if ( ! function_exists( 'jobzilla_mas_wpjmc_pagination' ) ) {
    function jobzilla_mas_wpjmc_pagination($total = '', $current = '') {
        global $wp_query;
        $total   = isset( $total ) ? $total : mas_wpjmc_get_loop_prop( 'total_pages' );
        $current = isset( $current ) ? $current : mas_wpjmc_get_loop_prop( 'current_page' );
        $base    = isset( $base ) ? $base : esc_url_raw( str_replace( 999999999, '%#%', remove_query_arg( '', get_pagenum_link( 999999999, false ) ) ) );
        $format  = isset( $format ) ? $format : '';
        if ( $total <= 1 ) {
            return;
        }
        ?>
		<nav class="pagination-outer ">
			<div class="pagination-style1">
				
					<?php
						$paginate_links =  paginate_links( apply_filters( 'mas_wpjmc_pagination_args', array( // WPCS: XSS ok.
							'base'         => $base,
							'format'       => $format,
							'add_args'     => false,
							'current'      => max( 1, $current ),
							'total'        => $total,
							'prev_text'    => is_rtl() ? '<span> <i class="fa fa-angle-right"></i> </span>' : '<span> <i class="fa fa-angle-left"></i> </span>',
							'next_text'    => is_rtl() ? '<span> <i class="fa fa-angle-left"></i> </span>' : '<span> <i class="fa fa-angle-right"></i> </span>',
							'type'         => 'list',
							'end_size'     => 2,
							'mid_size'     => 2,
						) ) );
						$pagination = str_replace("<ul class='page-numbers'", '<ul class="clearfix"', $paginate_links );
						echo wp_kses($pagination, jobzilla_allowed_html_tag());
						
					?>
			</div>
		</nav><?php
    }
}
add_filter('submit_company_step_preview_submit_text', 'jobzilla_form_submit_button_text');

function jobzilla_form_submit_button_text($output){
	$output = 'Submit';
	return $output;
}