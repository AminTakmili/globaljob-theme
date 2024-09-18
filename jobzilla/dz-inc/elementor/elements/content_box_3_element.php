<?php 
	$btn_link1 = $anchor_attribute1 = '';
    if (!empty($content_box_3_element_link))
    {
        $btn_link1 = !empty($content_box_3_element_link)?$content_box_3_element_link:'';
        $anchor_attribute1 = jobzilla_elementor_get_anchor_attribute($btn_link1);
       
    }
	
	
	$allowed_html_tags = jobzilla_allowed_html_tag();
	
?>
<!-- ABOUT SECTION START -->
<div class="section-full content-inner-1 site-bg-white twm-millions-1-area pos-relative">
			
	<div class="container">
		<div class="twm-millions-section-wrap">
			<div class="row">
				
				<div class="col-lg-7 col-md-12">
					<div class="twm-millions-1-section">
						<?php if(!empty($content_box_3_element_image['id'])){ ?>
						<div class="twm-media">
							<img src="<?php echo esc_url($content_box_3_element_image['url']); ?>" alt="<?php echo esc_attr('Image', 'jobzilla'); ?>">
							
							<div class="twm-circle-jobs-wrap">
								<?php
								if(!empty($content_box_3_element_item)){
									
									$array_item = $content_box_3_element_item;
									foreach($array_item as $value){
									 	$margin = '';
										if(!empty($value['margin_top'])){
											$margin .= 'top:'.$value['margin_top'].'%; ';
										}
										if(!empty($value['margin_left'])){
											$margin .= 'left:'.$value['margin_left'].'%; ';
										}
										if(!empty($value['margin_right'])){
											$margin .= 'right:'.$value['margin_right'].'%; ';
										}
										if(!empty($value['margin_bottom'])){
											$margin .= 'bottom:'.$value['margin_bottom'].'%; ';
										} 
									if(!empty($value['content_box_3_element_item_image']['id'])){
									?>
                                    <div class="twm-circle-jobs-box six bounce2" <?php if(!empty($margin)){ ?>style="<?php echo esc_attr($margin); ?>"<?php } ?>>
										<div class="twm-circle-job-pics">
											<img src="<?php echo esc_url($value['content_box_3_element_item_image']['url']); ?>" alt="<?php echo esc_attr__('Image', 'jobzilla'); ?>">
										</div>
                                    </div>
								<?php }
									}
								} ?>
							</div>
						</div>
						<?php } ?>
						<div class="twm-bg-circle-pic">
							<img src="<?php echo esc_url(JOBZILLA_URL.'assets/images/slider/bg-circle.png'); ?>" alt="<?php echo esc_attr__('image', 'jobzilla'); ?>">
						</div>
						
					</div>
				</div>

				<div class="col-lg-5 col-md-12">
					<div class="twm-millions-1-section-right">
						<!-- TITLE START-->
						 <?php if (!empty($content_box_3_element_subtitle) || !empty($content_box_3_element_title) || !empty($content_box_3_element_description)) { ?>
							<!-- TITLE START-->
							<div class="section-head left wt-small-separator-outer">
								<?php if (!empty($content_box_3_element_subtitle)) { ?>
									<div class="wt-small-separator site-text-primary">
									   <div>
											<?php echo wp_kses($content_box_3_element_subtitle,$allowed_html_tags ); ?>
									   </div>                                
									</div>
								<?php } ?>

								<?php if (!empty($content_box_3_element_title)) { ?>
									<h2 class="wt-title">
										<?php echo wp_kses($content_box_3_element_title,$allowed_html_tags ); ?>
									</h2>
								<?php } ?>

								<?php if (!empty($content_box_3_element_description)) { ?>
									<p>
										<?php echo wp_kses($content_box_3_element_description,$allowed_html_tags ); ?>
									</p>
								<?php } ?>
							</div>
							<!-- TITLE END-->
						<?php } ?>
						<!-- TITLE END-->
						<?php if(!empty($content_box_3_element_jobs)){ ?>
						<div class="twm-avail-jobs">
							<?php echo wp_kses($content_box_3_element_jobs,$allowed_html_tags ); ?>
						</div>
						<?php } ?>
						<div class="twm-read-more cplumn-2">
							<?php if(!empty($content_box_3_element_link_title) && !empty($btn_link1['url'])) {
									
								?>
								<a href="<?php echo esc_url($btn_link1['url']); ?>" <?php echo esc_attr($anchor_attribute1); ?> class="site-button"><?php echo esc_html($content_box_3_element_link_title); ?>
								</a>
							<?php } ?>
							
						</div>               
						
					</div>
				</div>

			</div>
		</div>
	</div>

	<div class="twm-bg-shape5"></div>

</div>   
<!-- ABOUT SECTION END -->
