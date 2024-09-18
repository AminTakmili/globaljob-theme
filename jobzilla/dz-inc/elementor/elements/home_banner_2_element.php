 <?php 
    $btn_link = $btn_text = $anchor_attribute = '';
    if (!empty($home_banner_2_element_link_title))
    {
        $btn_link = !empty($home_banner_2_element_link)?$home_banner_2_element_link:'';
        $btn_text = !empty($home_banner_2_element_link_title)?$home_banner_2_element_link_title:'';
        
        $anchor_attribute = jobzilla_elementor_get_anchor_attribute($btn_link);
    }
    $allowed_html_tags = jobzilla_allowed_html_tag();
?>

 <div class="twm-home2-banner-section site-bg-gray bg-cover" style="background-image:url(<?php echo esc_url(JOBZILLA_URL.'assets/images/slider2_bg1.jpg'); ?>)">
    <div class="row">        
        <!--Left Section-->
        <div class="col-xl-6 col-lg-6 col-sm-6">
            <div class="twm-bnr-left-section">
                <?php if (!empty($home_banner_2_element_subtitle)) { ?>
                    <div class="twm-bnr-title-small">
                        <?php echo wp_kses($home_banner_2_element_subtitle,$allowed_html_tags); ?>
                    </div>
                <?php } ?>

                <?php if (!empty($home_banner_2_element_title)) { ?>
                    <div class="twm-bnr-title-large">
                        <?php echo wp_kses($home_banner_2_element_title,$allowed_html_tags); ?>
                    </div>
                <?php } ?>

                <?php if (!empty($home_banner_2_element_description)) { ?>
                    <div class="twm-bnr-discription">
                        <?php echo wp_kses($home_banner_2_element_description,'string'); ?>
                    </div>
                <?php } ?>

                <?php if(!empty($btn_text)) { ?>
                    <a href="<?php echo esc_url($btn_link['url']); ?>" <?php echo esc_attr($anchor_attribute); ?> class="site-button"><?php echo esc_html($btn_text); ?></a>
                <?php } ?>
            </div>
        </div>

        <!--right Section-->
        <div class="col-xl-6 col-lg-6 col-sm-6 twm-bnr-right-section">
            <div class="twm-bnr2-right-content">
                <div class="twm-img-bg-circle-area2">
                    <div class="twm-outline-ring-wrap">
                        <div class="twm-outline-ring-dott-wrap">
                           <span class="outline-dot-1"></span>
                           <span class="outline-dot-2"></span>
                           <span class="outline-dot-3"></span>
                           <!--Samll Ring Left-->
                           <div class="twm-small-ring-l scale-up-center"></div>
                        </div>
                    </div>
                </div>

                <?php if (!empty($home_banner_2_element_image1['id']) || !empty($home_banner_2_element_image2['id'])) { ?>
                    <div class="twm-home-2-bnr-images">
                        <?php if (!empty($home_banner_2_element_image1['id'])) { ?>
                            <div class="bnr-image-1">
                                <img src="<?php echo esc_url($home_banner_2_element_image1['url']); ?>" alt="<?php bloginfo('name');?>">
                            </div>
                        <?php } ?>

                        <?php if (!empty($home_banner_2_element_image2['id'])) { ?>
                            <div class="bnr-image-2">
                                <img src="<?php echo esc_url($home_banner_2_element_image2['url']); ?>" alt="<?php bloginfo('name');?>">
                            </div>
                        <?php } ?>
                        <div class="twm-small-ring-2 scale-up-center"></div>
                    </div>
                <?php } ?>

                <?php  
                    if(!empty($home_banner_2_element_item)){
						$item_arr = $home_banner_2_element_item;
						$count=1;
						
						foreach($item_arr as $itemKey => $itemValue) {
						$text_color = 	array(
											1=>'text-clr-sky', 
											2=>'text-clr-green', 
											3=>'text-clr-pink'
										);
										
						$bg_color = $itemValue['home_banner_2_element_item_icon_bg_color'];
                ?>
                    <!--icon-block-1-->
                    <div class="twm-bnr-blocks twm-bnr-blocks-position-<?php echo esc_attr($count); ?>">
                        <?php if (!empty($itemValue['home_banner_2_element_item_image']['id'])){ ?>
                            <div class="twm-icon" 
								<?php if(!empty($bg_color)){ ?> 
									style="background-color: <?php echo esc_attr($bg_color); ?>;" 
								<?php } ?>
							>
                                <img src="<?php echo esc_url($itemValue['home_banner_2_element_item_image']['url']); ?>" alt="<?php bloginfo('name');?>">
                            </div>
                        <?php } ?>
						
						<?php if(!empty($itemValue['home_banner_2_element_item_title']) || !empty($itemValue['home_banner_2_element_item_number']) || !empty($itemValue['home_banner_2_element_item_prefix'])){ ?>
							<div class="twm-content">
								<?php if(!empty($itemValue['home_banner_2_element_item_number'])){ ?>
									<div class="tw-count-number <?php echo esc_attr($text_color[$count]); ?>">
										<span class="counter">
											<?php echo esc_html($itemValue['home_banner_2_element_item_number']); ?>
										</span> <?php echo esc_html($itemValue['home_banner_2_element_item_prefix']); ?>
									</div>
								<?php } ?>
								
								<?php if(!empty($itemValue['home_banner_2_element_item_title'])){ ?>
									<p class="icon-content-info">
										<?php echo esc_html($itemValue['home_banner_2_element_item_title']); ?> 
									</p>
								<?php } ?>
							</div>
						<?php } ?>
                    </div>
                <?php ++$count; } } ?>
            </div>
        </div>
    </div>
</div> 