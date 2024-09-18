<?php 
	$allowed_html_tags = jobzilla_allowed_html_tag();
	if($process_flow_element_style=='style_1'){ 
?>
	<!-- HOW IT WORK SECTION START -->
	<div class="section-full content-inner site-bg-white twm-how-it-work-area">            
		<div class="container">
			<?php if (!empty($process_flow_element_title) || !empty($process_flow_element_subtitle)) { ?>
				<!-- TITLE START-->
				<div class="section-head center wt-small-separator-outer">
					<?php if (!empty($process_flow_element_subtitle)) { ?>
						<div class="wt-small-separator site-text-primary">
							<div>
								<?php echo wp_kses($process_flow_element_subtitle,'string'); ?>
							</div>                                
						</div>
					<?php } ?>   

					<?php if (!empty($process_flow_element_title)) { ?>
						<h2 class="wt-title">
							<?php echo wp_kses($process_flow_element_title,'string'); ?>
						</h2> 
					<?php } ?>           
				</div>                  
				<!-- TITLE END-->
			<?php } ?>           

			<?php if(!empty($process_flow_element_item)){
				$item_arr = $process_flow_element_item;
			?>
				<div class="twm-how-it-work-section">
					<div class="row">
						<?php 
							$count=1;
							$num = 1;
							foreach($item_arr as $itemKey => $itemValue) { 
								if($count == 4){ 
									$count = 1;
								}
								$bg_color = array(
												1=>'bg-clr-sky', 
												2=>'bg-clr-pink', 
												3=>'bg-clr-green'
											);
						?>
							<div class="col-xl-4 col-lg-6 col-md-6">
								<div class="twm-w-process-steps <?php echo esc_attr($bg_color[$count]); ?>">
									<span class="twm-large-number">
										<?php echo sprintf("%02d", $num);?>
									</span>
									
									<div class="twm-w-pro-top">
										<?php if (!empty($itemValue['process_flow_element_item_image']['id'])) { ?>
											<div class="twm-media">
												<span>
													<img src="<?php echo esc_url($itemValue['process_flow_element_item_image']['url']); ?>" alt="<?php bloginfo('name');?>">
												</span>
											</div>
										<?php } ?>

										<?php if(!empty($itemValue['process_flow_element_item_title'])){  ?>
											<h4 class="twm-title">
												<?php echo wp_kses($itemValue['process_flow_element_item_title'], $allowed_html_tags); ?>
											</h4>
										<?php } ?>
										<?php if(!empty($itemValue['process_flow_element_item_description'])){  ?>
											<p>
												<?php echo wp_kses($itemValue['process_flow_element_item_description'], 'string'); ?>
											</p>
										<?php } ?>  
									</div>									
								</div>
							</div>
						<?php ++$num;
						$count++; } ?>
					</div>
				</div>  
			<?php } ?>                
		</div>
	</div>   
	<!-- HOW IT WORK SECTION END -->
	
<?php } elseif($process_flow_element_style=='style_2'){ ?>

    <!-- HOW IT WORK SECTION START -->
    <div class="section-full content-inner site-bg-white twm-how-it-work-area2">                
        <div class="container">
            <div class="row">
                <?php if (!empty($process_flow_element_title) || !empty($process_flow_element_subtitle) || !empty($process_flow_element_description_list)) { ?>
                    <div class="col-lg-4 col-md-12">
                        <!-- TITLE START-->
                        <div class="section-head left wt-small-separator-outer">
                            <?php if (!empty($process_flow_element_subtitle)) { ?>
                                <div class="wt-small-separator site-text-primary">
                                    <div>
                                        <?php echo wp_kses($process_flow_element_subtitle,'string'); ?>
                                    </div>                                
                                </div>
                            <?php } ?>   

                            <?php if (!empty($process_flow_element_title)) { ?>
                                <h2 class="wt-title">
                                    <?php echo wp_kses($process_flow_element_title,'string'); ?>
                                </h2> 
                            <?php } ?>           
                        </div>                  
                        <!-- TITLE END-->
						
                        <?php if(!empty($process_flow_element_description_list)){
								$detail = explode(',', $process_flow_element_description_list);
                         ?>
                            <ul class="description-list">
                                <?php foreach($detail as $list){ ?>
                                    <li>
                                        <i class="feather-check"></i>
                                        <?php echo esc_html($list); ?> 
                                    </li>
                                <?php } ?>
                            </ul>           
                        <?php } ?>
                    </div>
                <?php } ?>
                
                
                <?php if(!empty($process_flow_element_item)){
                    $item_arr = $process_flow_element_item;
                ?>
                    <div class="col-lg-8 col-md-12">
                        <div class="twm-w-process-steps-2-wrap">
                            <div class="row">
                                <?php   
									$count=1;
									$num = 1;
									foreach($item_arr as $itemKey => $itemValue) { 
									if($count == 5){ 
										$count = 1;
									}
									
									$bg_color 	= array(
													1=>'bg-clr-sky-light bg-sky-light-shadow', 
													2=>'bg-clr-yellow-light bg-yellow-light-shadow', 
													3=>'bg-clr-pink-light bg-pink-light-shadow', 
													4=>'bg-clr-green-light bg-clr-light-shadow'
												);    
									
									$text_color = array(
														1=>'text-clr-sky', 
														2=>'text-clr-yellow', 
														3=>'text-clr-pink', 
														4=>'text-clr-green'
													); 
                                ?>
                                    <div class="col-xl-6 col-lg-6 col-md-6">
                                        <div class="twm-w-process-steps-2">
                                            <div class="twm-w-pro-top <?php echo esc_attr($bg_color[$count]); ?>">
                                                <span class="twm-large-number <?php echo esc_attr($text_color[$count]); ?>">
													<?php echo sprintf("%02d", $num);?>
												</span>

                                                <?php if (!empty($itemValue['process_flow_element_item_image']['id'])) { ?>
                                                    <div class="twm-media">
                                                        <span>
															<img src="<?php echo esc_url($itemValue['process_flow_element_item_image']['url']); ?>" alt="<?php bloginfo('name');?>">
														</span>
                                                    </div>
                                                <?php } ?>

                                                <?php if(!empty($itemValue['process_flow_element_item_title'])){  ?>
                                                    <h5 class="twm-title">
                                                        <?php echo wp_kses($itemValue['process_flow_element_item_title'], $allowed_html_tags); ?>
                                                    </h5>
                                                <?php } ?>

                                                <?php if(!empty($itemValue['process_flow_element_item_description'])){  ?>
                                                    <p>
                                                        <?php echo wp_kses($itemValue['process_flow_element_item_description'], 'string'); ?>
                                                    </p>
                                                <?php } ?>
                                            </div>                                            
                                        </div>
                                    </div>
                                <?php ++$num;
								++$count; } ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="twm-how-it-work-section"></div>                  
        </div>
    </div>   
    <!-- HOW IT WORK SECTION END -->
	
<?php } else if($process_flow_element_style == 'style_3'){ ?>

    <!-- HOW IT WORK SECTION START -->
    <div class="section-full content-inner site-bg-gray twm-how-it-work-area">                
        <div class="container">
            <?php if (!empty($process_flow_element_title) || !empty($process_flow_element_subtitle)) { ?>
                <!-- TITLE START-->
                <div class="section-head center wt-small-separator-outer">
                    <?php if (!empty($process_flow_element_subtitle)) { ?>
                        <div class="wt-small-separator site-text-primary">
                            <div>
                                <?php echo wp_kses($process_flow_element_subtitle,'string'); ?>
                            </div>                                
                        </div>
                    <?php } ?>   

                    <?php if (!empty($process_flow_element_title)) { ?>
                        <h2 class="wt-title">
                            <?php echo wp_kses($process_flow_element_title,'string'); ?>
                        </h2> 
                    <?php } ?>           
                </div>                  
                <!-- TITLE END-->
            <?php } ?>           

            <?php if(!empty($process_flow_element_item)){
                $item_arr = $process_flow_element_item;
            ?>
                <div class="twm-how-it-work-section3">
                    <div class="row">
                        <?php 
                            $count=1;
							$num = 1;
                            foreach($item_arr as $itemKey => $itemValue) { 
							if($count == 4){ 
								$count = 1;
							}
                            $bg_color 	= array(
											1=>'bg-clr-sky', 
											2=>'bg-clr-pink', 
											3=>'bg-clr-green'
										);
                            $text_color = array(
											1=>'text-clr-sky', 
											2=>'text-clr-pink', 
											3=>'text-clr-green'
										);
                        ?>
                            <div class="col-xl-4 col-lg-6 col-md-6">
                                <div class="twm-w-process-steps3">
                                    <?php if (!empty($itemValue['process_flow_element_item_image']['id'])) { ?>
                                        <div class="twm-w-pro-top">
                                            <div class="twm-media <?php echo esc_attr($bg_color[$count]); ?>">
                                                <span>
													<img src="<?php echo esc_url($itemValue['process_flow_element_item_image']['url']); ?>" alt="<?php bloginfo('name');?>">
												</span>
                                            </div>
                                            <span class="twm-large-number <?php echo esc_attr($text_color[$count]); ?>">
												<?php echo sprintf("%02d", $num);?>
											</span>
                                        </div>
                                    <?php } ?>

                                    <?php if(!empty($itemValue['process_flow_element_item_title'])){  ?>
                                        <h4 class="twm-title">
                                            <?php echo wp_kses($itemValue['process_flow_element_item_title'], $allowed_html_tags); ?>
                                        </h4>
                                    <?php } ?>

                                    <?php if(!empty($itemValue['process_flow_element_item_description'])){  ?>
                                        <p>
                                            <?php echo wp_kses($itemValue['process_flow_element_item_description'], 'string'); ?>
                                        </p>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php  ++$num;
						$count++; } ?>
                    </div>
                </div>  
            <?php } ?>                
        </div>
    </div>   
    <!-- HOW IT WORK SECTION END -->
	
<?php } else if($process_flow_element_style == 'style_4'){ ?>

    <!-- How It Work START -->
    <div class="section-full content-inner site-bg-primary twm-how-it-work-1-area" data-anm=".anm">
        <div class="container">
            <div class="section-content">
                <div class="twm-how-it-work-1-content">
                    <div class="row">
                        <div class="col-xl-5 col-lg-6 col-md-6">
                            <div class="twm-how-it-work-1-left">
                                <div class="twm-how-it-work-1-section">
                                    <?php if (!empty($process_flow_element_title) || !empty($process_flow_element_subtitle)) { ?>
                                        <!-- TITLE START-->
                                        <div class="section-head left wt-small-separator-outer">
                                            <?php if (!empty($process_flow_element_subtitle)) { ?>
                                                <div class="wt-small-separator">
                                                    <div>
                                                        <?php echo wp_kses($process_flow_element_subtitle,'string'); ?>
                                                    </div>                                
                                                </div>
                                            <?php } ?>   

                                            <?php if (!empty($process_flow_element_title)) { ?>
                                                <h2 class="wt-title">
                                                    <?php echo wp_kses($process_flow_element_title,'string'); ?>
                                                </h2> 
                                            <?php } ?>           
                                        </div>                  
                                        <!-- TITLE END-->
                                    <?php } ?>

                                    <?php if(!empty($process_flow_element_item)){
                                        $item_arr = $process_flow_element_item;
                                    ?>
                                        <div class="twm-step-section-4">
                                            <ul>
                                                <?php 
                                                    $count=1;
													$num = 1;
                                                    foreach($item_arr as $itemKey => $itemValue) { 
													if($count == 5){ 
														$count = 1;
													}
                                                    $bg_color = array(
																	1=>'bg-clr-sky-light', 
																	2=>'bg-clr-yellow-light', 
																	3=>'bg-clr-pink-light', 
																	4=>'bg-clr-green-light'
																);
                                                ?>
                                                    <li>
                                                        <div class="twm-step-count <?php echo esc_attr($bg_color[$count]); ?>">
															<?php echo sprintf("%02d", $num);?>
														</div>
														
                                                        <div class="twm-step-content">
                                                            <?php if(!empty($itemValue['process_flow_element_item_title'])){  ?>
                                                                <h4 class="twm-title">
                                                                    <?php echo wp_kses($itemValue['process_flow_element_item_title'], $allowed_html_tags); ?>
                                                                </h4>
                                                            <?php } ?>

                                                            <?php if(!empty($itemValue['process_flow_element_item_description'])){  ?>
                                                                <p>
                                                                    <?php echo wp_kses($itemValue['process_flow_element_item_description'], 'string'); ?>
                                                                </p>
                                                            <?php } ?>
                                                        </div>
                                                    </li>
                                                <?php  ++$num;
												++$count; } ?>
                                            </ul>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>

                        <?php if (!empty($process_flow_element_image['id'])) { ?>
                            <div class="col-xl-7 col-lg-6 col-md-6">                            
                                <div class="twm-how-it-right-section">
                                    <div class="twm-media">
                                        <div class="twm-bg-circle">
											<img src="<?php echo esc_url(JOBZILLA_URL.'assets/images/home-4/how-it-work/bg-circle-large.png'); ?>" alt="<?php bloginfo('name');?>">
										</div>
										
                                        <div class="twm-block-left anm" data-speed-x="-4" data-speed-scale="-25">
											<img src="<?php echo esc_url(JOBZILLA_URL.'assets/images/home-4/how-it-work/block-left.png'); ?>" alt="<?php bloginfo('name');?>">
										</div>
										
                                        <div class="twm-block-right anm" data-speed-x="-4" data-speed-scale="-25">
											<img src="<?php echo esc_url(JOBZILLA_URL.'assets/images/home-4/how-it-work/block-right.png'); ?>" alt="<?php bloginfo('name');?>">
										</div>
                                        
                                        <div class="twm-main-bg anm" data-wow-delay="1000ms" data-speed-x="2" data-speed-y="2">
											<img src="<?php echo esc_url($process_flow_element_image['url']); ?>" alt="<?php bloginfo('name');?>">
										</div>
                                    </div>                                    
                                </div>                            
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>           
        </div>
    </div>
    <!-- How It Work END -->
<?php } else if($process_flow_element_style == 'style_5'){ ?>
	
            <!-- HOW IT WORK SECTION START -->
            <div class="section-full content-inner twm-how-it-work-area" style="background-image: url(<?php echo esc_url(JOBZILLA_URL.'assets/img/home-7/hiw-bg.jpg'); ?>);">
                        
                <div class="container">

                    <!-- TITLE START-->
                    <div class="section-head center wt-small-separator-outer  content-white">
                        <?php if (!empty($process_flow_element_subtitle)) { ?>
                            <div class="wt-small-separator">
                                <div>
                                    <?php echo wp_kses($process_flow_element_subtitle,'string'); ?>
                                </div>                                
                            </div>
                        <?php } ?>   
                        <?php if (!empty($process_flow_element_title)) { ?>
                            <h2 class="wt-title">
                                <?php echo wp_kses($process_flow_element_title,'string'); ?>
                            </h2> 
                        <?php } ?>    
                       
                    </div>                  
                    <!-- TITLE END-->
                    <?php  $count = 1;
                    if(!empty($process_flow_element_item)){
                        $item_arr = $process_flow_element_item;
                       
                    ?>
                    <div class="twm-how-it-work-section3">
                        <div class="row">
                           <?php foreach($item_arr as $itemValue){ 
                                 $count = ($count <= 9) ? '0'.$count : $count;
                            ?>
                            <div class="col-xl-4 col-lg-4 col-md-6">
                                <div class="twm-w-process-steps-h-page-7">
                                    <?php if(!empty($itemValue['process_flow_element_item_image']['id'])){ ?>
                                    <div class="twm-w-pro-top">
                                        <div class="twm-media">
                                            <span><img src="<?php echo esc_url($itemValue['process_flow_element_item_image']['url']); ?>" alt="<?php echo esc_attr__('Image', 'jobzilla'); ?>"></span>
                                        </div>
                                        <span class="twm-large-number  text-clr-sky"><?php echo esc_html($count); ?></span>
                                    </div>
                                     <?php } ?>
                                    <?php if(!empty($itemValue['process_flow_element_item_title'])){  ?>
                                        <h6 class="twm-title">
                                            <?php echo wp_kses($itemValue['process_flow_element_item_title'], $allowed_html_tags); ?>
                                        </h6>
                                    <?php } ?>

                                    <?php if(!empty($itemValue['process_flow_element_item_description'])){  ?>
                                        <p>
                                            <?php echo wp_kses($itemValue['process_flow_element_item_description'], 'string'); ?>
                                        </p>
                                    <?php } ?>
                                </div>
                            </div>
                            <?php ++$count; 
                        } ?>
                        </div>
                    </div> 
                    <?php } ?>                 
                </div>

            </div>   
            <!-- HOW IT WORK SECTION END -->
<?php } ?>