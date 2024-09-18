<?php 
	$btn_link = $btn_text = $anchor_attribute = '';
    if (!empty($content_box_2_element_link_title))
    {
        $btn_link = !empty($content_box_2_element_link)?$content_box_2_element_link:'';
        $btn_text = !empty($content_box_2_element_link_title)?$content_box_2_element_link_title:'';
        
        $anchor_attribute = jobzilla_elementor_get_anchor_attribute($btn_link);
    }
?>

<!-- EXPLORE NEW LIFE START -->
<div class="section-full content-inner pb-0 site-bg-light-purple twm-for-employee-4">
    <div class="container">
        <div class="section-content">
            <div class="twm-for-employee-content">
                <div class="row">
                    <div class="col-xl-5 col-lg-6 col-md-6">
                        <div class="twm-explore-content-outer2">
                            <div class="twm-explore-top-section">
                                <?php if (!empty($content_box_2_element_subtitle) || !empty($content_box_2_element_title)) { ?>
	                                <!-- TITLE START-->
	                                <div class="section-head left wt-small-separator-outer">
	                                    <?php if (!empty($content_box_2_element_subtitle)) { ?>
		                                    <div class="wt-small-separator site-text-primary">
		                                       <div>
		                                            <?php echo wp_kses($content_box_2_element_subtitle,'string'); ?>
		                                       </div>                                
		                                    </div>
		                                <?php } ?>

		                                <?php if (!empty($content_box_2_element_title)) { ?>
		                                    <h2 class="wt-title">
		                                        <?php echo wp_kses($content_box_2_element_title,'string'); ?>
		                                    </h2>
		                                <?php } ?>

	                                    <?php if (!empty($content_box_2_element_description)) { ?>
	                                    	<p>
												<?php echo wp_kses($content_box_2_element_description,'string'); ?>
											</p>
	                                    <?php } ?>
	                                </div>
	                                <!-- TITLE END-->
	                            <?php } ?>

                                <?php if(!empty($btn_text)) { ?>
	                                <div class="twm-read-more">
	                                    <a href="<?php echo esc_url($btn_link['url']); ?>" <?php echo esc_attr($anchor_attribute); ?> class="site-button"><?php echo esc_html($btn_text); ?>
	                                    </a>
	                                </div>
	                            <?php } ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-7 col-lg-6 col-md-6">
                        <div class="twm-explore-right-section">
                            <?php if (!empty($content_box_2_element_image['id'])) { ?>
								<div class="twm-media">
									<div class="twm-bg-circle"><img src="<?php echo esc_url(JOBZILLA_URL.'assets/images/home-4/bg-circle.png'); ?>" alt="<?php echo esc_attr__('Image','jobzilla'); ?>"></div>
									
									<div class="twm-employee-pic"><img src="<?php echo esc_url($content_box_2_element_image['url']); ?>" alt="<?php bloginfo('name');?>"></div>
									
									<div class="twm-shot-pic1  anm" data-speed-x="-4" data-speed-scale="-25"><img src="<?php echo esc_url(JOBZILLA_URL.'assets/images/home-4/sq-1.png'); ?>" alt="<?php echo esc_attr__('Image','jobzilla'); ?>"></div>
									
									<div class="twm-shot-pic2 anm" data-wow-delay="1000ms" data-speed-x="2" data-speed-y="2"><img src="<?php echo esc_url(JOBZILLA_URL.'assets/images/home-4/triangle.png'); ?>" alt="<?php echo esc_attr__('Image','jobzilla'); ?>"></div>
									
									<div class="twm-shot-pic3  anm" data-speed-x="-4" data-speed-scale="-25"><img src="<?php echo esc_url(JOBZILLA_URL.'assets/images/home-4/circle.png'); ?>" alt="<?php echo esc_attr__('Image','jobzilla'); ?>"></div>
								</div>
                        	<?php } ?>

                            <?php if(!empty($content_box_2_element_item)){
						        $item_arr = $content_box_2_element_item;
						        $count=1;
						        foreach($item_arr as $itemKey => $itemValue) {
						        	$type_color = 	array(
														1=>'text-clr-yellow-2',
														2=>'text-clr-green',
														3=>'text-clr-pink',
														4=>'text-clr-sky',
														5=>'text-clr-golden'
													);
													
									if($count == 6){
										$count = 1;
									}
									$type_colors = $type_color[$count];	
									
									$box_number = 	array(
														1=>'one',
														2=>'two',
														3=>'three',
													);
						    ?>	
								<?php if(!empty($itemValue['content_box_2_element_item_title']) || !empty($itemValue['content_box_2_element_item_number']) || !empty($itemValue['content_box_2_element_item_prefix'])){ ?>
	                                <div class="counter-outer-two <?php echo esc_attr($box_number[$count]); ?> anm" data-speed-y="-2" data-speed-scale="15" data-speed-opacity="1">
	                                    <div class="icon-content">
	                                        <div class="tw-count-number <?php echo esc_attr($type_colors); ?>">
	                                            <span class="counter"><?php echo esc_html($itemValue['content_box_2_element_item_number']); ?></span><?php echo esc_html($itemValue['content_box_2_element_item_prefix']); ?></div>
	                                        
											<?php if(!empty($itemValue['content_box_2_element_item_title'])){ ?>
												<p class="icon-content-info">
													<?php echo esc_html($itemValue['content_box_2_element_item_title']); ?>
												</p>
											<?php } ?>
	                                    </div>
	                                </div>
								<?php } ++$count; } } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>       
    </div>
</div>
<!-- EXPLORE NEW LIFE END -->