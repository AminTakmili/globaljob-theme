<?php 
$style = !empty($content_box_1_element_style) ? $content_box_1_element_style : 'style_1';
if($style == 'style_1'){
	$color = ($content_box_1_element_color == 'style_2') ? 'site-bg-white' : 'site-bg-gray';
?>
<!-- ABOUT SECTION START -->
<div class="section-full content-inner <?php echo esc_attr($color); ?> twm-about-1-area">            
    <div class="container">
        <div class="twm-about-1-section-wrap">
            <div class="row">  
            	<?php if (!empty($content_box_1_element_image['id'])) { ?>              
	                <div class="col-lg-6 col-md-6">
	                    <div class="twm-about-1-section">
	                        <div class="twm-media">
	                            <img src="<?php echo esc_url($content_box_1_element_image['url']); ?>" alt="<?php bloginfo('name');?>">
	                        </div>
	                    </div>
	                </div>
	            <?php } ?>
				
                <div class="col-lg-6 col-md-6">
                    <div class="twm-about-1-section-right">
                    	<?php if (!empty($content_box_1_element_title) || !empty($content_box_1_element_subtitle)) { ?>
                            <!-- TITLE START-->
                            <div class="section-head left wt-small-separator-outer">
                                <?php if (!empty($content_box_1_element_subtitle)) { ?>
                                	<div class="wt-small-separator site-text-primary">
	                                    <div>
	                                    	<?php echo wp_kses($content_box_1_element_subtitle,'string'); ?>
	                                    </div>
	                                </div>
                                <?php } ?>

                                <?php if (!empty($content_box_1_element_title)) { ?>
                                    <h2 class="wt-title">
                                        <?php echo wp_kses($content_box_1_element_title,'string'); ?>
                                    </h2>
                                <?php } ?>
                            </div>
                            <!-- TITLE END--> 
                        <?php } ?>
                       	
                       	<?php if (!empty($content_box_1_element_list)) { 
                       		$desc_list = explode(',', $content_box_1_element_list);
                       	?>
		                    <ul class="description-list">
		                        <?php foreach($desc_list as $list){ ?>
			                        <li>
			                            <i class="feather-check"></i>
			                            <?php echo esc_html($list); ?>
			                        </li>		                       
                        		<?php } ?>	
		                    </ul>                  
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>

        <?php  
            if(!empty($content_box_1_element_item)){
            $item_arr = $content_box_1_element_item;
        ?>
	        <div class="twm-about-1-bottom-wrap">
	            <div class="row">
	            	<?php 
                        foreach($item_arr as $itemKey => $itemValue) {
                     
						$gallery = $itemValue['content_box_1_element_item_gallery'];
						
						$color_class = 'twm-card-blocks';
						if($itemValue['content_box_1_element_item_image']['id']){
							$color_class = 'twm-card-blocks';
						}elseif($gallery){
							$color_class = 'twm-card-blocks-2';
						}
						$icon_bg_color = $itemValue['content_box_1_element_item_icon_bg_color'];
                    ?>
	                <div class="col-lg-4 col-md-4 col-sm-6">
	                    <!--icon-block-1-->
	                    <div class="<?php echo esc_attr($color_class); ?>">
	                    	<?php if (!empty($itemValue['content_box_1_element_item_image']['id'])) { ?>   
		                        <div class="twm-icon" <?php if(!empty($icon_bg_color)){ ?> style="background-color: <?php echo esc_attr($icon_bg_color); ?>;" <?php } ?>>
		                            <img src="<?php echo esc_url($itemValue['content_box_1_element_item_image']['url']); ?>" alt="<?php bloginfo('name');?>">
		                        </div>
		                    <?php }elseif(!empty($gallery)){ ?>
									 <div class="twm-pics">
										<?php foreach($gallery as $value){ ?>
                                        <span><img src="<?php echo esc_url($value['url']); ?>" alt="<?php echo esc_attr__('Image', 'jobzilla'); ?>"></span>
										<?php } ?>
                                    </div>
							<?php }
							if(!empty($itemValue['content_box_1_element_item_title']) || !empty($itemValue['content_box_1_element_item_number']) || !empty($itemValue['content_box_1_element_item_prefix'])){ ?>
								<div class="twm-content">
									<?php if(!empty($itemValue['content_box_1_element_item_number']) || !empty($itemValue['content_box_1_element_item_prefix'])){ ?>	
										<div class="tw-count-number" <?php if(!empty($icon_bg_color)){ ?> style="color: <?php echo esc_attr($icon_bg_color); ?>;" <?php } ?>>
											<span class="counter"><?php echo esc_html($itemValue['content_box_1_element_item_number']); ?></span> <?php echo esc_html($itemValue['content_box_1_element_item_prefix']); ?>
										</div>
									<?php } ?>
									
									<?php if(!empty($itemValue['content_box_1_element_item_title'])){ ?>
										<p class="icon-content-info">
											<?php echo esc_html($itemValue['content_box_1_element_item_title']); ?> 
										</p>
									<?php } ?>
								</div>
							<?php } ?>
	                    </div>
	                </div>
	            <?php  } ?>
	            </div>
	        </div>
	    <?php } ?>
    </div>
</div>   
<!-- ABOUT SECTION END -->
<?php }elseif($style == 'style_2'){ ?>
<!-- ABOUT SECTION START -->
<div class="section-full content-inner twm-about-8-area">
			
	<div class="container">
		<div class="twm-about-9-section-wrap">
			<div class="row">
				<div class="col-lg-6 col-md-12">
					<div class="twm-about-9-section">
						<?php if (!empty($content_box_1_element_image['id'])) { ?>    
						<div class="twm-media">
							 <img src="<?php echo esc_url($content_box_1_element_image['url']); ?>" alt="<?php bloginfo('name');?>">
						</div>
						<div class="img-bg-circle"></div>
						<?php } ?>
						<!--icon-block-2-->
						<?php if(!empty($content_box_1_element_job_title) || !empty($content_box_1_element_gallery) || !empty($content_box_1_element_number) || !empty($content_box_1_element_prefix)){ ?>
						<div class="twm-card-blocks-2 bounce2">
							<?php if(!empty($content_box_1_element_gallery)){ ?>
							<div class="twm-pics">
								<?php foreach($content_box_1_element_gallery as $value){ ?>
								<span><img src="<?php echo esc_url($value['url']); ?>" alt="<?php echo esc_attr__('Image', 'jobzilla'); ?>"></span>
								<?php } ?>
							</div>
							<?php } ?>
							<div class="twm-content">
								<?php if(!empty($content_box_1_element_number) && !empty($content_box_1_element_prefix)){ ?>
								<div class="tw-count-number text-clr-green">
									<span class="counter"><?php echo esc_html($content_box_1_element_number); ?></span><?php echo esc_html($content_box_1_element_prefix); ?>
								</div>
								<?php }
								if(!empty($content_box_1_element_job_title)){ ?>
								<p class="icon-content-info"><?php echo esc_html($content_box_1_element_job_title); ?></p>
								<?php } ?>
							</div>
						</div> 
						<?php } ?>
					</div>
				</div>

				<div class="col-lg-6 col-md-12">
					<div class="twm-about-9-section-right">
					
							<?php if (!empty($content_box_1_element_title) || !empty($content_box_1_element_subtitle)) { ?>
							<!-- TITLE START-->
									<div class="section-head left wt-small-separator-outer">
										<?php if (!empty($content_box_1_element_subtitle)) { ?>
											<div class="wt-small-separator site-text-primary">
												<div>
													<?php echo wp_kses($content_box_1_element_subtitle,'string'); ?>
												</div>
											</div>
										<?php } ?>

										<?php if (!empty($content_box_1_element_title)) { ?>
											<h2 class="wt-title">
												<?php echo wp_kses($content_box_1_element_title,'string'); ?>
											</h2>
										<?php } ?>
									</div>
							<!-- TITLE END--> 
							<?php } ?>
							<?php if (!empty($content_box_1_element_list)) { 
                       		$desc_list = explode(',', $content_box_1_element_list);
							?>
								<ul class="description-list">
									<?php foreach($desc_list as $list){ ?>
										<li>
											<i class="feather-check"></i>
											<?php echo esc_html($list); ?>
										</li>		                       
									<?php } ?>	
								</ul>                  
							<?php } ?>	
							 <?php  
								if(!empty($content_box_1_element_item)){
								$item_arr = $content_box_1_element_item;
							?>	
							<div class="twm-about-1-bottom-wrap">
								<div class="row">
									<?php 
											foreach($item_arr as $itemKey => $itemValue) {			
											$icon_bg_color = $itemValue['content_box_1_element_item_icon_bg_color'];
										?>
										<div class="col-lg-6 col-md-6">
											<!--icon-block-1-->
											<div class="twm-card-blocks">
												<?php if (!empty($itemValue['content_box_1_element_item_image']['id'])) { ?>   
													<div class="twm-icon" <?php if(!empty($icon_bg_color)){ ?> style="background-color: <?php echo esc_attr($icon_bg_color); ?>;" <?php } ?>>
														<img src="<?php echo esc_url($itemValue['content_box_1_element_item_image']['url']); ?>" alt="<?php bloginfo('name');?>">
													</div>
												<?php } ?>
												
												<?php if(!empty($itemValue['content_box_1_element_item_title']) || !empty($itemValue['content_box_1_element_item_number']) || !empty($itemValue['content_box_1_element_item_prefix'])){ ?>
													<div class="twm-content">
														<?php if(!empty($itemValue['content_box_1_element_item_number']) || !empty($itemValue['content_box_1_element_item_prefix'])){ ?>	
															<div class="tw-count-number" <?php if(!empty($icon_bg_color)){ ?> style="color: <?php echo esc_attr($icon_bg_color); ?>;" <?php } ?>>
																<span class="counter"><?php echo esc_html($itemValue['content_box_1_element_item_number']); ?></span> <?php echo esc_html($itemValue['content_box_1_element_item_prefix']); ?>
															</div>
														<?php } ?>
														
														<?php if(!empty($itemValue['content_box_1_element_item_title'])){ ?>
															<p class="icon-content-info">
																<?php echo esc_html($itemValue['content_box_1_element_item_title']); ?> 
															</p>
														<?php } ?>
													</div>
												<?php } ?>
											</div>
										</div>
									<?php  } ?>
								
								</div>
							</div>
							<?php } ?>
					</div>
				</div>

			</div>
		</div>
	</div>

</div>   
<!-- ABOUT SECTION END -->

<?php }