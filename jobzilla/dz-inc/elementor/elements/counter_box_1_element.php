<?php 
    $btn_link = $btn_text = $anchor_attribute = '';
    if (!empty($counter_box_1_element_link_title))
    {
        $btn_link = !empty($counter_box_1_element_link)?$counter_box_1_element_link:'';
        $btn_text = !empty($counter_box_1_element_link_title)?$counter_box_1_element_link_title:''; 
        
        $anchor_attribute = jobzilla_elementor_get_anchor_attribute($btn_link);
    }
	$style = !empty($counter_box_1_element_style) ? $counter_box_1_element_style : 'style_1';
	$color = !empty($counter_box_1_element_color) ? "style=background-color:$counter_box_1_element_color;" : '';
	$allowed_html_tags = jobzilla_allowed_html_tag(); 
	if($style == 'style_1'){ 
?>
<!-- EXPLORE NEW LIFE START -->
<div class="section-full content-inner-1 site-bg-white twm-explore-area2">
    <div class="container">
        <div class="section-content">
            <div class="twm-explore-content-2" <?php echo esc_attr($color); ?>>
                <div class="row">
                    <div class="col-lg-8 col-md-12">
                        <div class="twm-explore-content-outer2">
                            <div class="twm-explore-top-section">
                                <?php if(!empty($counter_box_1_element_subtitle)){ ?>
                                    <div class="twm-title-small">
                                        <?php echo wp_kses($counter_box_1_element_subtitle,'string'); ?>
                                    </div>
                                <?php } ?>
                                <div class="twm-title-large">
                                    <?php if(!empty($counter_box_1_element_title)){ ?>
                                        <h2>
                                            <?php echo wp_kses($counter_box_1_element_title,$allowed_html_tags); ?>
                                        </h2>
                                    <?php } ?>
                                    
                                    <?php if(!empty($counter_box_1_element_description)){ ?>
                                        <p>
                                            <?php echo wp_kses($counter_box_1_element_description,'string'); ?>
                                        </p>
                                    <?php } ?>
                                </div>
								
                                <?php if(!empty($btn_text)) { ?>
                                    <div class="twm-read-more"> 
                                        <a href="<?php echo esc_url($btn_link['url']); ?>" <?php echo esc_attr($anchor_attribute); ?>  class="site-button"><?php echo esc_html($btn_text); ?>
                                        </a>
                                    </div>  
                                <?php } ?>
                            </div>
							
                            <?php if(!empty($counter_box_1_element_item)){
                                $item_arr = $counter_box_1_element_item;
                            ?>
                                <div class="twm-explore-bottom-section">
                                    <div class="row">
                                        <?php 
                                            $count=1;
                                            foreach($item_arr as $itemKey => $itemValue) { 
                                            $text_color = 	array(
																1=>'text-clr-yellow-2', 
																2=>'text-clr-green', 
																3=>'text-clr-pink'
															);
                                        ?>
										
										<?php if(!empty($itemValue['counter_box_1_element_item_title']) || !empty($itemValue['counter_box_1_element_item_number']) || !empty($itemValue['counter_box_1_element_item_prefix'])){ ?>	
                                            <div class="col-lg-4 col-4 mb-3">
                                                <div class="counter-outer-two">
                                                    <div class="icon-content">
                                                        <div class="tw-count-number <?php echo esc_attr($text_color[$count]); ?>">
                                                            <span class="counter">
																<?php echo esc_html($itemValue['counter_box_1_element_item_number']); ?>
															</span><?php echo esc_html($itemValue['counter_box_1_element_item_prefix']); ?>
                                                        </div>
														
														<?php if(!empty($itemValue['counter_box_1_element_item_title'])){ ?>
															<p class="icon-content-info">
																<?php echo esc_html($itemValue['counter_box_1_element_item_title']); ?>
															</p>
														<?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } $count++; } ?>    
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>

                    <?php if (!empty($counter_box_1_element_image['id'])){ ?>
                        <div class="col-lg-4 col-md-12">
                            <div class="twm-explore-media-wrap2">
                                <div class="twm-media">
                                    <img src="<?php echo esc_url($counter_box_1_element_image['url']); ?>" alt="<?php echo esc_attr__('Image', 'jobzilla'); ?>">
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>       
    </div>
</div>
<!-- EXPLORE NEW LIFE END -->
<?php }elseif($style == 'style_2'){ ?>
<!-- Our Comunity SECTION START -->
<div class="section-full content-inner-2 site-bg-white twm-our-comu-hpage-6-area" <?php if (!empty($counter_box_1_element_image['id'])){ ?> style="background-image: url(<?php echo esc_url($counter_box_1_element_image['url']); ?>);"<?php } ?>>
	<div class="container">
		<!-- TITLE START-->
		<div class="wt-separator-two-part content-white">
			<div class="row wt-separator-two-part-row">
				<div class="col-xl-8 col-lg-8 col-md-12 wt-separator-two-part-left">
					<!-- TITLE START-->
					<div class="section-head left wt-small-separator-outer">
						<?php if(!empty($counter_box_1_element_subtitle)){ ?>
							<div class="wt-small-separator site-text-primary">
								<?php echo wp_kses($counter_box_1_element_subtitle,'string'); ?>
							</div>
                        <?php } 
						if(!empty($counter_box_1_element_title)){ ?>
							<h2 class="wt-title">
								<?php echo wp_kses($counter_box_1_element_title,'string'); ?>
							</h2>
						<?php } ?>
					</div>                  
					<!-- TITLE END-->
				</div>
			</div>
		</div>                 
		<!-- TITLE END-->
	</div>
	<?php if(!empty($counter_box_1_element_item)){ 
	$arr_items = $counter_box_1_element_item;
	?> 
	<div class="hpage-6-comunity-counter-wrap">
		<div class="container">
			<div class="twm-company-approch6-outer">
				<div class="twm-company-approch6">
					<div class="row">
						<?php foreach($arr_items as $item){ 
							$icon = $item['counter_box_1_element_item_icon']['value'];
						?>
						<div class="col-lg-3 col-md-6 col-sm-6 col-6">
							<div class="counter-outer-two">
								<?php if(!empty($icon)){ ?>
								<div class="icon-media-wrap">
									<div class="icon-media site-text-white">
										<i class="<?php echo esc_attr($icon); ?>"></i>
									</div>
								</div>
								<?php } ?>
								<div class="icon-content">
								
									<?php if(!empty($item['counter_box_1_element_item_number'])){ ?>
									<div class="tw-count-number site-text-white">
										<span class="counter" style="color:<?php echo esc_attr($item['counter_box_1_element_text_color']); ?>;"><?php echo esc_html($item['counter_box_1_element_item_number']); ?></span>
									</div>
									<?php } 
									if(!empty($item['counter_box_1_element_item_title'])){ ?>
									<p class="icon-content-info"><?php echo esc_html($item['counter_box_1_element_item_title']); ?></p>
									<?php } ?>
								</div>
							</div>
						</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php } ?>

</div>   
<!-- Our Comunity SECTION SECTION END -->

<?php }elseif($style == 'style_3'){ ?>
	
<!-- Counter SECTION START -->
<div class="section-full p-t0 p-b0 site-bg-white twm-counter-page-5-wrap">	   
	<div class="container">
		<div class="twm-company-approch5-outer">
			<div class="twm-company-approch5 content-inner" <?php if (!empty($counter_box_1_element_image['id'])){ ?> style="background-image: url(<?php echo esc_url($counter_box_1_element_image['url']); ?>);"<?php } ?>>
				<?php if(!empty($counter_box_1_element_item)){ 
				$arr_items = $counter_box_1_element_item;
				?> 
				<div class="row">
					<!--block 1-->
					<?php foreach($arr_items as $item){ 
					if(!empty($item['counter_box_1_element_item_title']) || !empty($item['counter_box_1_element_item_number']) || !empty($item['counter_box_1_element_item_prefix'])){ ?>
					<div class="col-lg-3 col-md-6 col-6">
						<div class="counter-outer-two">
							<div class="icon-content">
								<div class="tw-count-number site-text-white">
									<span class="counter">
										<?php echo esc_html($item['counter_box_1_element_item_number']); ?>
									</span><?php echo esc_html($item['counter_box_1_element_item_prefix']); ?>
								</div>
								<?php if(!empty($item['counter_box_1_element_item_title'])){ ?>
								<p class="icon-content-info"><?php echo esc_html($item['counter_box_1_element_item_title']); ?></p>
								<?php } ?>
							</div>
						</div>
					</div>
					<?php } 
					} ?>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>   
<!-- Counter SECTION END -->

<?php }
