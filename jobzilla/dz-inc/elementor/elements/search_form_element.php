<?php
	$query_args = array(
		'post_type' 		=> 'product',
		'post_status' 		=> 'publish',
		'ignore_sticky_posts'=> true,
	);	
	$query = new WP_Query($query_args);
 
	if(!empty($query->have_posts())){
?>
	<!-- searching cars form -->
	<div class="car-searching text-white">
		<?php if(!empty($search_form_element_subtitle) || !empty($search_form_element_title)){ ?>
			<div class="container">
				<div class="row">
					<div class="col-xs-12">
						<div class="section-head style-1">
							<?php if(!empty($search_form_element_subtitle)){ ?>
								<div class="title-sm text-uppercase">
									<?php echo esc_html($search_form_element_subtitle); ?>
								</div>
							<?php } ?>
							
							<?php if(!empty($search_form_element_title)){ ?>
								<h3 class="h3 m-t10">
									<?php echo wp_kses($search_form_element_title, jobzilla_allowed_html_tag()); ?>
								</h3>
							<?php } ?>
							<div class="sep-line"></div>
						</div>
					</div>
				</div>
			</div>
		<?php } ?>
		
		<form class="searching-form" method="get" action="<?php echo home_url(); ?>">
			<div class="container">
				<div class="row search-row">				
					<div class="col-lg-3 col-md-6">
						<div class="form-group">
							<?php if(!empty($search_form_element_car_brand_text)){ ?>
								<label>
									<?php echo esc_html($search_form_element_car_brand_text); ?>
								</label>
							<?php } ?>
							
							<select class="form-control sm" name="brand">
								<option>
									<?php echo esc_html__('select car brand', 'jobzilla'); ?>
								</option>
								<?php 
									while($query->have_posts())
									{	
										$query->the_post();
										global $post;
										$cat_arr 		= get_the_terms( get_the_id(), 'product_cat');
										$cat_name_arr 	= array_column($cat_arr,'name');
										$cat_name 		= implode(' ',$cat_name_arr);
										
									if(!empty($cat_name)){ 
								?>
										<option value="<?php echo esc_attr($cat_name); ?>">
											<?php echo esc_html($cat_name); ?>
										</option>
								<?php }
								} ?>
							</select>
						</div>
					</div>
					
					<div class="col-lg-3 col-md-6">
						<div class="form-group">
							<?php if(!empty($search_form_element_car_type_text)){ ?>
								<label>
									<?php echo esc_html($search_form_element_car_type_text); ?>
								</label>
							<?php }	?>
							
							<select class="form-control sm" name="type">
								<option>
									<?php echo esc_html__('select car type', 'jobzilla'); ?>
								</option>
								<?php							
									while($query->have_posts())
									{	
										$query->the_post();
										global $post;
										$product = wc_get_product( $post->ID );
										$type = $product->get_meta( 'type' );
										
									if(!empty($type)){ 
								?>
										<option value="<?php echo esc_attr($type); ?>">
											<?php echo esc_html($type); ?>
										</option>
								<?php }
									} ?>
							</select>
						</div>
					</div>
					
					<div class="col-lg-3 col-md-6">
						<div class="form-group">
							<?php if(!empty($search_form_element_car_price_text)){ ?>
								<label>
									<?php echo esc_html($search_form_element_car_price_text); ?>
								</label>
							<?php } ?>
							
							<select class="form-control sm" name="orderby">
								<option>
									<?php echo esc_html__('select price', 'jobzilla'); ?>
								</option>
								
								<option  value="popularity">
									<?php echo esc_html__('Sort by popularity', 'jobzilla'); ?>
								</option>
								
								<option  value="rating">
									<?php echo esc_html__('Sort by average rating', 'jobzilla'); ?>
								</option>
								
								<option  value="date">
									<?php echo esc_html__('selected active', 'jobzilla'); ?>
								</option>
								
								<option  value="price">
									<?php echo esc_html__('Price low to high', 'jobzilla');?>
								</option>
								
								<option value="price-desc">
									<?php echo esc_html__('Price high to low', 'jobzilla'); ?>
								</option>
							</select>
						</div>
					</div>
				
					<div class="col-lg-3 col-md-6">
						<div class="form-group">
							<input type="hidden" name="post_type" value="<?php echo get_post_type(); ?>">
							<?php if(!empty($search_form_element_search_btn_text)){ ?>
								<button type="submit" class="btn d-block w-100 btn-primary btn-md">
									<?php echo esc_html($search_form_element_search_btn_text); ?>
								</button>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
	<!-- searching cars form end -->
 <?php } ?>