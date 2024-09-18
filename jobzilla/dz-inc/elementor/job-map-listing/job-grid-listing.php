<?php
function jobzilla_map_listing($args){ 
if(!empty($args)){
extract($args);
}
$allowed_html_tags = jobzilla_allowed_html_tag();
?>
<div  class="container  tab-content">
	
	
	<div class="tab-pane  dz-main-grid-3 show active" id="Grid" role="tabpanel">
		<div class="row grid-style-2 job_listings">
			<?php
			while ( $jobs->have_posts() ) {
			$jobs->the_post(); 
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
							
							
			$item_attrs = '';
			
			
			$job_type = '';
			$types = wpjm_get_the_job_types( $post );
			if(!empty($types[0])){ 
				$type = $types[0];
				$job_type = $type->name;
			}
			
			$attr_arr = array(
				'longitude'=>(!empty($company_data['_latitude'])) ? $company_data['_latitude'] : '',
				'latitude'=>(!empty($company_data['_longitude'])) ? $company_data['_longitude'] : '',
				'title'=>$post->post_title,
				'image'=>esc_url(get_the_company_logo()),
				'job_type'=>$job_type,
				'job_link'=>get_the_title(),
			);
			if(!empty($company_data['_company_id'])){
				$attr_arr['company'] = get_the_title($company_data['_company_id']);
			}
			foreach($attr_arr as $key => $value){
				$item_attrs .= ' data-'.$key.'="'.$value.'" ';	
			} 

			?>
			<div class="col-lg-4 col-md-6 m-b30">
			
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
				<div class="job_listing" <?php echo wp_kses($item_attrs, $allowed_html_tags); ?>></div>
			</div>
			<?php } ?>
		</div>
	</div>	
	<div class="tab-pane  dz-main-grid-2  " id="Grid2" role="tabpanel">
		<div class="row grid-style-2 job_listings">
			<?php
			while ( $jobs->have_posts() ) {
			$jobs->the_post(); 
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
							
							
			$item_attrs = '';
			
			
			$job_type = '';
			$types = wpjm_get_the_job_types( $post );
			if(!empty($types[0])){ 
				$type = $types[0];
				$job_type = $type->name;
			}
			
			$attr_arr = array(
				'longitude'=>(!empty($company_data['_latitude'])) ? $company_data['_latitude'] : '',
				'latitude'=>(!empty($company_data['_longitude'])) ? $company_data['_longitude'] : '',
				'title'=>$post->post_title,
				'image'=>esc_url(get_the_company_logo()),
				'job_type'=>$job_type,
				'job_link'=>get_the_title(),
			);
			if(!empty($company_data['_company_id'])){
				$attr_arr['company'] = get_the_title($company_data['_company_id']);
			}
			foreach($attr_arr as $key => $value){
				$item_attrs .= ' data-'.$key.'="'.$value.'" ';	
			} 

			?>
			<div class="col-lg-6 col-md-6 m-b30">
			
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
				<div class="job_listing" <?php echo wp_kses($item_attrs, $allowed_html_tags); ?>></div>
			</div>
			<?php } ?>
		</div>
	</div>	
	<!--- List  --->
	<div class="tab-pane fade dz-main-list" id="List" role="tabpanel">		
		<div class="twm-jobs-list-wrap">
			<div class="row ">
				<?php
				while ( $jobs->have_posts() ) {
				$jobs->the_post(); 
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
								
								
				$item_attrs = '';
				
				
				$job_type = '';
				$types = wpjm_get_the_job_types( $post );
				if(!empty($types[0])){ 
					$type = $types[0];
					$job_type = $type->name;
				}
				
				$attr_arr = array(
					'longitude'=>(!empty($company_data['_latitude'])) ? $company_data['_latitude'] : '',
					'latitude'=>(!empty($company_data['_longitude'])) ? $company_data['_longitude'] : '',
					'title'=>$post->post_title,
					'image'=>esc_url(get_the_company_logo()),
					'job_type'=>$job_type,
					'job_link'=>get_the_title(),
				);
				if(!empty($company_data['_company_id'])){
					$attr_arr['company'] = get_the_title($company_data['_company_id']);
				}
				foreach($attr_arr as $key => $value){
					$item_attrs .= ' data-'.$key.'="'.$value.'" ';	
				} 

				?>
				<div class="job_listing" <?php echo wp_kses($item_attrs, $allowed_html_tags); ?>>
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
				<?php } ?>
			</div>
		</div>
	</div>
</div>
<?php
	
	global $wp_query;
	$paginate_links =   paginate_links( array(
		'base' => str_replace( 99999, '%#%', esc_url( get_pagenum_link( 99999 ) ) ), 
		'format' => '?paged=%#%', 
		'current' => max( 1, $paged ),
		'total' => $jobs->max_num_pages, 
		'prev_text' =>'<i class="fas fa-chevron-left"></i>', 
		'next_text' =>'<i class="fas fa-chevron-right"></i>',
		'type'=>'list',
		'add_args' => false,			
	));
	$pagination = str_replace("<ul class='page-numbers'", '<ul class="clearfix"', $paginate_links );  
?>
<div class="pagination-outer job-manager-pagination text-center">
	<div class="pagination-style1">
		<?php echo wp_kses($pagination, jobzilla_allowed_html_tag()); ?>
	</div>
</div>
<?php 
}

add_action('jobzilla_job_map_listing','jobzilla_map_listing');