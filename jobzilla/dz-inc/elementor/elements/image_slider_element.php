<?php if($image_slider_element_style=='style_1'){ ?>

<!-- TOP COMPANIES START -->
<div class="section-full content-inner-2 site-bg-white twm-companies-wrap">      
    <?php if(!empty($image_slider_element_title) || !empty($image_slider_element_subtitle)){ ?>
        <!-- TITLE START-->
        <div class="section-head center wt-small-separator-outer">
            <?php if(!empty($image_slider_element_subtitle)){ ?>
                <div class="wt-small-separator site-text-primary">
                   <div>
                        <?php echo wp_kses($image_slider_element_subtitle, 'string'); ?>
                   </div>                                
                </div>
            <?php } ?>

            <?php if(!empty($image_slider_element_title)){ ?>
                <h2 class="wt-title">
                    <?php echo wp_kses($image_slider_element_title, 'string'); ?>
                </h2>
            <?php } ?>
        </div>                  
        <!-- TITLE END--> 
    <?php } ?>

    <?php if(!empty($image_slider_element_slider)){
        $item_arr = $image_slider_element_slider;
    ?>
        <div class="container">
            <div class="section-content  mb-5">
                <div class="owl-carousel home-client-carousel2 owl-btn-vertical-center">
                    <?php foreach($item_arr as $itemKey => $itemValue) { 
                         $btn_link = $anchor_attribute = '';
                        if (!empty($itemValue['image_slider_element_slider_item_link']))
                        {
                            $btn_link = !empty($itemValue['image_slider_element_slider_item_link'])?$itemValue['image_slider_element_slider_item_link']:'';
                            $anchor_attribute = jobzilla_elementor_get_anchor_attribute($btn_link);
                        }

                        ?>
                        <div class="item">
                            <div class="ow-client-logo">
                                <div class="client-logo client-logo-media">
                                    <?php if($image_slider_element_disable_link=='yes'){ ?>
                                        <img src="<?php echo esc_url($itemValue['image_slider_element_slider_item_image']['url']) ?>" alt="<?php echo esc_attr__('image', 'jobzilla'); ?>">
                                    <?php } else { ?>
                                        <a href="<?php echo esc_url($btn_link['url']); ?>" <?php echo esc_html($anchor_attribute); ?>><img src="<?php echo esc_url($itemValue['image_slider_element_slider_item_image']['url']) ?>" alt="<?php echo esc_attr__('image', 'jobzilla'); ?>"></a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    <?php } ?>

    <?php if(!empty($image_slider_counter_element_item)){
        $item_arr = $image_slider_counter_element_item;
    ?>
        <div class="twm-company-approch-outer">
            <div class="twm-company-approch">
                <div class="row">
                    <?php $count=1;
						foreach($item_arr as $itemKey => $itemValue) { 
						if(!empty($itemValue['image_slider_counter_element_item_title']) || !empty($itemValue['image_slider_counter_element_item_number']) || !empty($itemValue['image_slider_counter_element_item_prefix'])){
							
						$text_color = 	array(
											1=>'text-clr-sky', 
											2=>'text-clr-pink', 
											3=>'text-clr-green'
										);
					?>
                        <div class="col-lg-4 col-4">
                            <div class="counter-outer-two">
                                <div class="icon-content">
                                    <div class="tw-count-number <?php echo esc_attr($text_color[$count]); ?>">
                                        <span class="counter"><?php echo esc_html($itemValue['image_slider_counter_element_item_number']); ?></span><?php echo esc_html($itemValue['image_slider_counter_element_item_prefix']); ?>
                                    </div>
									
									<?php if(!empty($itemValue['image_slider_counter_element_item_title'])){ ?>
										<p class="icon-content-info">
											<?php echo esc_html($itemValue['image_slider_counter_element_item_title']); ?>
										</p>
									<?php } ?>
                                </div>
                            </div>
                        </div>
					<?php } ++$count; } ?>
                </div>
            </div>
        </div> 
    <?php } ?>   
</div>
<!-- TOP COMPANIES END -->
<?php } elseif($image_slider_element_style=='style_2'){ ?>
    <!-- TOP COMPANIES START -->
    <div class="section-full p-t120 p-b90 site-bg-white twm-companies-wrap">
          
        <?php if(!empty($image_slider_element_title) || !empty($image_slider_element_subtitle)){ ?>
            <!-- TITLE START-->
            <div class="section-head center wt-small-separator-outer">
                <?php if(!empty($image_slider_element_subtitle)){ ?>
                    <div class="wt-small-separator site-text-primary">
                       <div>
                            <?php echo wp_kses($image_slider_element_subtitle, 'string'); ?>
                       </div>                                
                    </div>
                <?php } ?>

                <?php if(!empty($image_slider_element_title)){ ?>
                    <h2 class="wt-title">
                        <?php echo wp_kses($image_slider_element_title, 'string'); ?>
                    </h2>
                <?php } ?>
            </div>                  
            <!-- TITLE END--> 
        <?php } ?>

        <div class="container">
            <?php if(!empty($image_slider_element_slider)){
                $item_arr = $image_slider_element_slider;
            ?>
                <div class="section-content ">
                    <div class="owl-carousel home-client-carousel3 owl-btn-vertical-center">
                        <?php foreach($item_arr as $itemKey => $itemValue) { 
                            $btn_link = $anchor_attribute = '';
                            if (!empty($itemValue['image_slider_element_slider_item_link']))
                            {
                                $btn_link = !empty($itemValue['image_slider_element_slider_item_link'])?$itemValue['image_slider_element_slider_item_link']:'';
                                $anchor_attribute = jobzilla_elementor_get_anchor_attribute($btn_link);
                            }
                            ?>
                            <div class="item">
                                <div class="ow-client-logo">
                                    <div class="client-logo client-logo-media">
                                        <?php if($image_slider_element_disable_link=='yes'){ ?>
                                            <img src="<?php echo esc_url($itemValue['image_slider_element_slider_item_image']['url']) ?>" alt="<?php echo esc_attr__('image', 'jobzilla'); ?>">
                                        <?php } else { ?>
                                            <a href="<?php echo esc_url($btn_link['url']); ?>" <?php echo esc_html($anchor_attribute); ?>><img src="<?php echo esc_url($itemValue['image_slider_element_slider_item_image']['url']) ?>" alt="<?php echo esc_attr__('image', 'jobzilla'); ?>"></a>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>                        
                    </div>
                </div>
            <?php } ?>

            <?php if(!empty($image_slider_counter_element_item)){
                $item_arr = $image_slider_counter_element_item;
            ?>
                <div class="twm-company-approch2-outer">
                    <div class="twm-company-approch2">
                        <div class="row">
                            <?php 
								foreach($item_arr as $itemKey => $itemValue) { 
								if(!empty($itemValue['image_slider_counter_element_item_title']) || !empty($itemValue['image_slider_counter_element_item_number']) || !empty($itemValue['image_slider_counter_element_item_prefix'])){
							?>
                                <!--block 1-->
                                <div class="col-lg-4 col-4">
                                    <div class="counter-outer-two">
                                        <div class="icon-content">
                                            <div class="tw-count-number site-text-primary">
                                                <span class="counter"><?php echo esc_html($itemValue['image_slider_counter_element_item_number']); ?></span><?php echo esc_html($itemValue['image_slider_counter_element_item_prefix']); ?></div>
                                            <p class="icon-content-info"><?php echo esc_html($itemValue['image_slider_counter_element_item_title']); ?></p>
                                        </div>
                                    </div>
                                </div>
							<?php } } ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <!-- TOP COMPANIES END -->
<?php } ?>