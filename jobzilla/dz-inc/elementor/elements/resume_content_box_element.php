<?php 
    $btn_link = $btn_text = $anchor_attribute = '';
    if (!empty($resume_content_box_element_link_title))
    {
        $btn_link = !empty($resume_content_box_element_link)?$resume_content_box_element_link:'';
        $btn_text = !empty($resume_content_box_element_link_title)?$resume_content_box_element_link_title:'';
        
        $anchor_attribute = jobzilla_elementor_get_anchor_attribute($btn_link);
    }
    if($resume_content_box_element_style=='style_1'){ 
    $col_class = !empty($resume_content_box_element_image['id'])?'col-lg-8 col-md-12':'col-lg-12 col-md-12';
?>

<!-- EXPLORE NEW LIFE START -->
<div class="section-full content-inner-1 twm-explore-area bg-cover " <?php if(!empty($resume_content_box_element_bg_img['id'])){ ?> style="background-image: url(<?php echo esc_url($resume_content_box_element_bg_img['url']); ?>);" <?php } ?>>
    <div class="container">

        <div class="section-content">
            <div class="row">
                <?php if(!empty($resume_content_box_element_image['id'])){ ?>
                    <div class="col-lg-4 col-md-12">
                        <div class="twm-explore-media-wrap">
                            <div class="twm-media">
                                <img src="<?php echo esc_url($resume_content_box_element_image['url']); ?>" alt="<?php echo esc_attr__('image','jobzilla'); ?>">
                            </div>
                        </div>
                    </div>
                <?php } ?>

                <div class="<?php echo esc_attr($col_class); ?>">
                    <div class="twm-explore-content-outer">
                        <div class="twm-explore-content">
                            <div class="twm-l-line-1"></div>
                            <div class="twm-l-line-2"></div>
                            <div class="twm-r-circle-1"></div>
                            <div class="twm-r-circle-2"></div>
							
                            <?php if (!empty($resume_content_box_element_subtitle)) { ?>
                                <div class="wt-small-separator text-light">
                                    <?php echo wp_kses($resume_content_box_element_subtitle,'string'); ?>
                                </div>
                            <?php } ?>

                            <?php if (!empty($resume_content_box_element_title) || !empty($resume_content_box_element_description)) { ?>
                                <div class="twm-title-large">
                                    <?php if (!empty($resume_content_box_element_title)) { ?>
                                        <h2 class="wt-title">
                                            <?php echo wp_kses($resume_content_box_element_title,'string'); ?>
                                        </h2>
                                    <?php } ?>  

                                    <?php if (!empty($resume_content_box_element_description)) { ?>
                                        <p>
                                            <?php echo wp_kses($resume_content_box_element_description,'string'); ?>
                                        </p>
                                    <?php } ?>  
                                </div>
                            <?php } ?>

                            
                            <?php if(!empty($btn_text)) { ?>
                                <div class="twm-upload-file">
                                    <a href="<?php echo esc_url($btn_link['url']); ?>" <?php echo esc_attr($anchor_attribute); ?> class="site-button">
                                        <?php echo esc_html($btn_text); ?> <i class="feather-upload"></i>
                                    </a>
                                </div>
                            <?php } ?>                                                      
                        </div>
                        <div class="twm-bold-circle-right"></div>
                        <div class="twm-bold-circle-left"></div>
                    </div>
                </div>
            </div>
        </div>       
    </div>
</div>
<!-- EXPLORE NEW LIFE END -->
<?php } elseif($resume_content_box_element_style=='style_2'){ 
$col_class = !empty($resume_content_box_element_image['id'])?'col-lg-7 col-md-6':'col-lg-12 col-md-12';
    ?>
    <!-- FOR EMPLOYEE START -->
    <div class="section-full content-inner-1 twm-for-employee-area site-bg-white">
        <div class="container">
            <div class="section-content">
                <div class="row">
                    <?php if(!empty($resume_content_box_element_image['id'])){ ?>
                        <div class="col-lg-5 col-md-6">
                            <div class="twm-explore-media-wrap">
                                <div class="twm-media">
                                    <img src="<?php echo esc_url($resume_content_box_element_image['url']); ?>" alt="<?php echo esc_attr__('image','jobzilla'); ?>">
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                    <div class="<?php echo esc_attr($col_class); ?>">
                        <div class="twm-explore-content-outer-3">
                            <div class="twm-explore-content-3">
                                

                                <?php if (!empty($resume_content_box_element_title) || !empty($resume_content_box_element_description)) { ?>
                                    <div class="twm-title-large">
										<?php if (!empty($resume_content_box_element_subtitle)) { ?>
											<div class="twm-title-small text-primary">
												<?php echo wp_kses($resume_content_box_element_subtitle,'string'); ?>
											</div>
										<?php } ?>
                                        <?php if (!empty($resume_content_box_element_title)) { ?>
                                            <h2>
                                                <?php echo wp_kses($resume_content_box_element_title,'string'); ?>
                                            </h2>
                                        <?php } ?>  

                                        <?php if (!empty($resume_content_box_element_description)) { ?>
                                            <p>
                                                <?php echo wp_kses($resume_content_box_element_description,'string'); ?>
                                            </p>
                                        <?php } ?>  
                                    </div>
                                <?php } ?>

                                <?php if(!empty($btn_text)) { ?>
                                    <div class="twm-upload-file">
                                        <a href="<?php echo esc_url($btn_link['url']); ?>" <?php echo esc_attr($anchor_attribute); ?> class="site-button">
                                            <?php echo esc_html($btn_text); ?> <i class="feather-upload"></i>
                                        </a>
                                    </div>
                                <?php } ?>                               
                            </div>
                            <div class="twm-l-line-1"></div>
                            <div class="twm-l-line-2"></div>
                        </div>
                    </div>
                </div>
            </div>           
        </div>
    </div>
    <!-- FOR EMPLOYEE END -->
<?php }elseif($resume_content_box_element_style=='style_3'){ ?>
	 <!-- FOR EMPLOYEE START -->
    <div class="section-full content-inner-1 twm-for-employee-area site-bg-white">
        <div class="container">
            <div class="section-content">
				<div class="twm-for-employee-9">
                <div class="row">
                    <?php if(!empty($resume_content_box_element_image['id'])){ ?>
                        <div class="col-lg-5 col-md-6">
                            <div class="twm-explore-9-media-wrap">
                                <div class="twm-media">
                                    <img src="<?php echo esc_url($resume_content_box_element_image['url']); ?>" alt="<?php echo esc_attr__('image','jobzilla'); ?>">
									<div class="rectangle1-wrap">
										<div class="rectangle1 rotate-center"></div>
									</div>
									<div class="rectangle2-wrap">
										<div class="rectangle2"></div>
									</div>
								</div>
                            </div>
                        </div>
                    <?php } ?>

                    <div class="col-lg-7 col-md-6">
                        <div class="twm-explore-content-outer-3">
                            <div class="twm-explore-content-3">
                                

                                <?php if (!empty($resume_content_box_element_title) || !empty($resume_content_box_element_description)) { ?>
                                    <div class="twm-title-large">
										<?php if (!empty($resume_content_box_element_subtitle)) { ?>
											<div class="twm-title-small text-primary">
												<?php echo wp_kses($resume_content_box_element_subtitle,'string'); ?>
											</div>
										<?php } ?>
                                        <?php if (!empty($resume_content_box_element_title)) { ?>
                                            <h2>
                                                <?php echo wp_kses($resume_content_box_element_title,'string'); ?>
                                            </h2>
                                        <?php } ?>  

                                        <?php if (!empty($resume_content_box_element_description)) { ?>
                                            <p>
                                                <?php echo wp_kses($resume_content_box_element_description,'string'); ?>
                                            </p>
                                        <?php } ?>  
                                    </div>
                                <?php } ?>

                                <?php if(!empty($btn_text)) { ?>
                                    <div class="twm-upload-file">
                                        <a href="<?php echo esc_url($btn_link['url']); ?>" <?php echo esc_attr($anchor_attribute); ?> class="site-button">
                                            <?php echo esc_html($btn_text); ?> <i class="feather-upload"></i>
                                        </a>
                                    </div>
                                <?php } ?>                               
                            </div>
                           
                        </div>
                    </div>
                </div>
                </div>
            </div>           
        </div>
    </div>
    <!-- FOR EMPLOYEE END -->
<?php }