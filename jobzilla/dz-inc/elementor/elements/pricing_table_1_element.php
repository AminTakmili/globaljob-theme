<?php 
	$post_type = 'product';
	$query_args = array(	
		'post_type' 		=> $post_type,
		'post_status' 		=> 'publish',
		'posts_per_page'   	=> $pricing_table_1_element_no_of_posts ,
		'orderby'           => $pricing_table_1_element_orderby,		
		'order' 			=> $pricing_table_1_element_order,
		'ignore_sticky_posts' => true,
	);
	
	if($pricing_table_1_element_column =='col_2'){
		$class = 'col-lg-6 col-md-6 m-b30 ';
	}else if($pricing_table_1_element_column =='col_4'){
		$class = 'col-lg-3 col-md-6 m-b30';
	}else{
		$class = 'col-lg-4 col-md-6 m-b30 ';
	}
	
	$query = new WP_Query($query_args);
	$count = 1;
	$color = 	array(
					1=>'pricing-table-1', 
					2=> 'pricing-table-1 circle-yellow', 
					3=>'pricing-table-1 circle-pink'
				);
	
 $color_bg = $pricing_table_1_element_text_color;
?>
<!-- PRICING TABLE SECTION START -->
<div class="section-full content-inner  tw-pricing-area" <?php if(!empty($color_bg)){ ?> style="background-color:<?php echo esc_attr($color_bg); ?>; "<?php } ?>>
    <div class="container">
    	<?php if(!empty($pricing_table_1_element_sub_title) || !empty($pricing_table_1_element_title )){ ?>
	        <!-- TITLE START-->
	        <div class="section-head left wt-small-separator-outer">
	        	<?php if(!empty($pricing_table_1_element_sub_title)){ ?>
		            <div class="wt-small-separator site-text-primary">
		                <div><?php echo esc_html($pricing_table_1_element_sub_title); ?></div>                     
		            </div>
		        <?php } ?>

		        <?php if(!empty($pricing_table_1_element_title )){ ?>
	            	<h2 class="wt-title"> <?php echo esc_html($pricing_table_1_element_title); ?> </h2>
	            <?php } ?>
	        </div> 
        <?php } ?>                 
        <!-- TITLE END-->   
        <div class="section-content">
            <div class="twm-tabs-style-1">
              <div class="tab-content" id="myTab3Content">
                <div class="tab-pane fade show active" id="home" role="tabpanel">
                    <div class="pricing-block-outer">
                        <div class="row justify-content-center">
						  <?php while ( $query->have_posts()) { 
								$query->the_post();
								$post = wc_get_product(get_post()->ID);
								

						if (!$post->is_type(array('job_package', 'job_package_subscription')) || !$post->is_purchasable()) {
							continue;	
							}
						  ?>
						  
                            <div class="<?php echo esc_attr($class);  ?>">
                                <div class="<?php echo esc_attr($color[$count]); ?> ">
									<?php if($post->is_featured()){ ?>
										<div class="p-table-recommended">
											<?php echo esc_html__('Recommended', 'jobzilla'); ?>
										</div>
									<?php } ?>
									
                                    <div class="p-table-title">
                                        <h4 class="wt-title">
                                           <?php echo esc_html($post->get_title()); ?>
                                        </h4>
                                    </div>
									
                                    <div class="p-table-inner">
                                        <div class="p-table-price">
												<?php echo wp_kses($post->get_price_html(), jobzilla_allowed_html_tag()); ?>												
                                            <p>
												<?php echo esc_html__('Monthly','jobzilla'); ?>
											</p>											
                                        </div>
										
                                        <div class="p-table-list">
											<?php 
											the_excerpt();
											?>
                                        </div>
										
                                        <div class="p-table-btn">
											<?php $link  = $post->add_to_cart_url(); 
												if(!empty($pricing_table_1_element_btn_text) && !empty($link)){ 
											?>
												<a href="<?php echo esc_url($link); ?>" class="site-button">
												<i class="fa fa-shopping-cart"></i>
												<?php echo esc_html($pricing_table_1_element_btn_text); ?></a>
											<?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
							<?php $count++;} ?>
                        </div>
                    </div>
                </div>                
              </div>
            </div> 
        </div> 
    </div>
</div>   
<!-- PRICING TABLE SECTION END --> 