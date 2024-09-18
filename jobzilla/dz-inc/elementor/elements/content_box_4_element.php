<?php 
    $btn_link = $anchor_attribute = '';
    if (!empty($content_box_4_element_link))
    {
        $btn_link = !empty($content_box_4_element_link)?$content_box_4_element_link:'';
        $anchor_attribute = jobzilla_elementor_get_anchor_attribute($btn_link);
       
    }
 ?>
<!-- HOW TO GET YOUR JOB SECTION START -->
<div class="section-full content-inner site-bg-gray twm-how-t-get-wrap7">
            
    <div class="container">

        <div class="twm-how-t-get-section">
            <div class="row">

                <div class="col-xl-5 col-lg-5 col-md-12">
                    <div class="twm-how-t-get-section-left">
                        <div class="section-head left wt-small-separator-outer">
                            <?php if(!empty($content_box_4_element_subtitle)){ ?>
                            <div class="wt-small-separator site-text-primary">
                                <div><?php echo wp_kses($content_box_4_element_subtitle, 'string'); ?></div>                                
                            </div>
                        <?php } 
                        if(!empty($content_box_4_element_title)){ ?>
                             <h2 class="wt-title"><?php echo wp_kses($content_box_4_element_title, 'string'); ?></h2>
                         <?php } 
                       if(!empty($content_box_4_element_description)){ ?>
                        <p><?php echo wp_kses($content_box_4_element_description, 'string'); ?></p>
                        <?php } ?>
                        </div>
                        <div class="twm-how-t-get-bottom">
                            <?php if(!empty($content_box_4_element_link_title) && !empty($btn_link['url'])){ ?>
                            <a href="<?php echo esc_url($btn_link['url']); ?>" <?php echo esc_attr( $anchor_attribute); ?> class="site-button"><?php echo esc_html($content_box_4_element_link_title); ?></a>
                        <?php } ?>
                            <div class="twm-left-icon-bx">
                                <?php if(!empty($content_box_4_element_icon)){  ?>
                                <div class="twm-left-icon-media site-bg-primary">
                                    <i class="<?php echo esc_attr($content_box_4_element_icon['value']); ?> site-text-white"></i>
                                </div>
                            <?php } 
                            if(!empty($content_box_4_element_icon_title) || !empty($content_box_4_element_icon_text)){ ?>
                                <div class="twm-left-icon-content">
                                    <?php if(!empty($content_box_4_element_icon_title)){ ?>
                                   <h4 class="icon-title"><?php echo esc_html($content_box_4_element_icon_title); ?></h4>
                               <?php } 
                                if(!empty($content_box_4_element_icon_text)){ ?>
                                   <p><?php echo esc_html($content_box_4_element_icon_text); ?></p>
                                <?php } ?>
                                </div>
                            <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-7 col-lg-7 col-md-12">
                    <div class="twm-how-t-get-section-right">
                        <?php if(!empty($content_box_4_element_image['id'])){ ?>
                        <div class="twm-media">
                            <img src="<?php echo esc_url($content_box_4_element_image['url'] ); ?>" alt="<?php echo esc_attr__('Image', 'jobzilla'); ?>">
                        </div>
                    <?php } ?>
                        <div class="twm-left-img-bx bounce">
                            <?php if(!empty($content_box_4_element_item_image1['id'])){ ?>
                            <div class="twm-left-img-media">
                                <img src="<?php echo esc_url($content_box_4_element_item_image1['url']); ?>" alt="<?php echo esc_attr__('Image', 'jobzilla'); ?>"">
                            </div>
                            <?php } 
                            if(!empty($content_box_4_element_item_title1) || !empty($content_box_4_element_item_text1)){ ?>
                            <div class="twm-left-img-content">
                                <?php if(!empty($content_box_4_element_item_title1)){ ?>
                                <h4 class="icon-title"><?php echo esc_html($content_box_4_element_item_title1); ?></h4>
                            <?php } 
                                if(!empty($content_box_4_element_item_text1)){ ?>
                                <p><?php echo esc_html($content_box_4_element_item_text1); ?></p>
                            <?php } ?>
                            </div>
                        <?php } ?>
                        </div>
                        <div class="twm-profile-card bounce2">
                            <?php if(!empty($content_box_4_element_item_image2['id'])){ ?>
                              <div class="twm-profile-pic">
                                <img src="<?php echo esc_url($content_box_4_element_item_image2['url'] );  ?>" alt="<?php echo esc_attr__('Image', 'jobzilla'); ?>">
                            </div>
                            <?php } 
                              if(!empty($content_box_4_element_item_title2) || !empty($content_box_4_element_item_text2) || !empty($content_box_4_element_item_user_name)){ ?>
                            <div class="twm-profile-info">
                                <?php if(!empty($content_box_4_element_item_user_name)){ ?>
                                <h4 class="twm-profile-name">
                                   <?php echo esc_html($content_box_4_element_item_user_name); ?>
                                </h4>
                            <?php }  
                                if(!empty($content_box_4_element_item_text2)){ ?>
                                <div class="twm-profile-position"><?php echo esc_html($content_box_4_element_item_text2); ?></div>
                            <?php } 
                                if(!empty($content_box_4_element_item_title2)){ ?>
                                <a class="site-button-link underline"><?php echo esc_html($content_box_4_element_item_title2); ?></a>
                            <?php } ?>
                            </div>
                        <?php } ?>
                        </div>
                    </div>
                </div>


            </div>
        </div>                  
    </div>

</div>   
<!-- HOW TO GET YOUR JOB SECTION END -->
