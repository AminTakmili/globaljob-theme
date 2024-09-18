<?php 
	get_header(); 
	$jobzilla_option = getDZThemeReduxOption();
	
	if(!empty($_GET['list_layout'])){
		$list_layout	= sanitize_text_field($_GET['list_layout']);
		$col_class		= $list_layout ? 'col-lg-6 col-md-6' : '';
	}else{	
		$list_layout = get_option('jobzilla_list_layout_id');
		$col_class = $list_layout == 'grid' ? 'col-lg-6 col-md-6' : '';
	}
?>
<?php jobzilla_get_banner(); ?>
	<div class="section-full content-inner-1 site-bg-white">
		<div class="container">
			<div class="row">
				<div class="col-lg-4 col-md-12 left">
					<div class=" sticky-top">
					<button class="site-button mb-4 btn-fillter d-block d-lg-none">
						<?php echo esc_html__('Fillter', 'jobzilla'); ?> </button>
					<div class="sidebar-close">
						<div class="sb-close-btn">&times;</div>
					</div>
					<div class="side-bar fillter-sidebar">
						<div class="sidebar-elements search-bx">
							<form method="get" class="mas-wpjmc-search job_filters"> 
								<input type="hidden" name="post_type" value="company" /> 
								<?php if(!empty($_GET['list_layout'])){ ?>
								<input type="hidden" name="list_layout" value="<?php echo esc_html($_GET['list_layout'] ); ?>"/>
								<?php }
								  $query_vars = MAS_WPJMC::get_current_page_query_args();
									if(!empty( $query_vars)){
										foreach( $query_vars as $key => $value ) {
											if( $key !== 's' ) {
												echo '<input type="hidden" name="' . esc_attr( $key ) . '" value="' . esc_attr( $value ) . '"/>';
											}
										} 							
									}
								if ( ! empty( $_GET['search_keywords'] ) ) {
									$keywords = sanitize_text_field( $_GET['search_keywords'] );
								} else {
									$keywords = '';
								} ?>
								<div class="search_jobs">
									<div class="widget">
										<div class="form-group">
											 <label class="section-head-small">
												<?php esc_html_e('Search keywords','jobzilla') ?>
											 </label>
											 <div class="input-group">
												<input type="text" id="search_keywords" name="s" class="search-field form-control" placeholder="<?php echo esc_attr__( 'Company title or keywords', 'jobzilla' ); ?>" value="<?php echo get_search_query(); ?>" >
											 </div>
										</div>
										<?php 
										$taxonomies_args = jobzilla_company_filter();
										if(!empty($taxonomies_args)){ 
											foreach ( $taxonomies_args as $taxonomy_name => $taxonomy_args ) {
												if( $taxonomy_args['enable'] ) {
													$singular  = $taxonomy_args['singular'];
													$plural    = $taxonomy_args['plural'];
													$slug      = $taxonomy_args['slug']; 

													if ( !empty( $_GET['filter_'.$taxonomy_name] ) ) {
														$selected = sanitize_text_field( $_GET['filter_'.$taxonomy_name] );
													} else {
														$selected = "";
													}
													 jobzilla_company_dropdown_categories($taxonomy_name,$singular, $selected);
												}
											}
										}
										?>
										<div class="search_submit">
											 <input type="submit" class="site-button" value="<?php echo esc_attr__('Search','jobzilla') ?>">
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
				</div>
				<div class="col-lg-8 col-md-12" id="post-<?php the_ID();?>">	
					<!--Content Side-->	
					<?php 					
						if( have_posts() ) 
						{ ?> 
						<div class="twm-employer-list-wrap">
							<div class="row">
							 <?php 
							  while ( have_posts() ){ 
							  global $post;
							  the_post(); ?>
								<div class="<?php echo esc_attr($col_class); ?> m-b30">
								<?php
											if(!empty($list_layout) && $list_layout == 'grid'){
											?>
											 <div class="twm-employer-grid-style1">
												<div class="twm-media">
													<?php $logo =  get_the_company_logo($post, 'thumbnail' ) ? get_the_company_logo($post,  'thumbnail' ) : apply_filters( 'job_manager_default_company_logo', JOB_MANAGER_PLUGIN_URL . '/assets/images/company.png' ); ?>
													<img src="<?php echo esc_url( $logo ) ?>" class="" alt="<?php the_title(); ?>">
												</div>
												<div class="twm-mid-content">
													<a href="<?php the_permalink(); ?>" class="twm-job-title">
														<h5>
															<?php the_title(); ?>
														</h5>
													</a>
													<p>
														<?php echo jobzilla_short_description(get_the_excerpt(), '', 10); ?>
													</p>
												</div>
												<div class="twm-tags">
													<?php echo mas_wpjmc_get_taxomony_data('company_category',$post,true,'twm-job-websites site-text-primary',' ');?>
												</div>
												<div class="twm-right-content">
													<div class="twm-jobs-vacancies">
														<?php 
														$count_vacancy = mas_wpjmc_get_taxomony_data('company_category','',true);
														if(!empty($count_vacancy)){
														$count = count(explode(",",$count_vacancy));?>
														<span>
															<?php echo esc_html($count); ?>
														</span><?php if(!empty($count)){ echo esc_html__('Vacancies','jobzilla'); } 
														} ?>
													</div>
												</div>
											 </div>
											<?php }else{ ?>
											<div class="twm-employer-list-style1">
												<div class="twm-media">
													<?php $logo =  get_the_company_logo($post,  'thumbnail' )? get_the_company_logo($post, 'thumbnail' ) : apply_filters( 'job_manager_default_company_logo', JOB_MANAGER_PLUGIN_URL . '/assets/images/company.png' ); ?>
													<img src="<?php echo esc_url( $logo ) ?>" class="" alt="<?php the_title(); ?>">
												</div>
											
												<div class="twm-mid-content">
													<a href="<?php the_permalink(); ?>" class="twm-job-title">
														<h5>
															<?php the_title(); ?>
														</h5>
													</a>
													<p>
														<?php echo jobzilla_short_description(get_the_excerpt(), '', 10); ?>
													</p>
													<div class="twm-tags">
													    <?php echo mas_wpjmc_get_taxomony_data('company_category',$post,true,'twm-job-websites site-text-primary', ' ');?>
													</div>
												</div>
												 <div class="twm-right-content">
													<div class="twm-jobs-vacancies">
														<?php 
														$count_vacancy = mas_wpjmc_get_taxomony_data('company_category','',true);
														if(!empty($count_vacancy)){
														$count = count(explode(',',$count_vacancy));?>
														<span>
															<?php echo esc_html($count); ?>
														</span><?php if(!empty($count)){ echo esc_html__('Vacancies','jobzilla'); } 
														} ?>
													</div>
												</div>
											</div>
									<?php } ?>
								</div>
							  <?php }
							 
							  ?>
							</div>
						</div>
						  <?php
						 jobzilla_mas_wpjmc_pagination(); 
						}else{ ?>
							<div class="twm-jobs-list-wrap">
								<ul class="row job_listings">	
									<li class="no_job_listings_found">
										<?php echo esc_html__('There are currently no vacancies.', 'jobzilla'); ?>
									</li>
								</ul>
							</div>
						<?php
						}
					?>			
				
			
					<!-- End Content Side-->					
				</div>
				
			</div>
		</div>
	</div>
<?php get_footer(); ?>