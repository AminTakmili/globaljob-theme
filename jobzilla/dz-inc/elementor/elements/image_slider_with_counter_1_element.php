<!-- TOP COMPANIES START -->
<?php 

    if($image_slider_with_counter_1_element_style == 'twm-companies-wrap-bg-block2'){ 
        $class = 'twm-companies-wrap-bg-block2';
        $content = 'content-inner-1';
    }else{
        $class = 'twm-companies-wrap-bg-block';
        $content = 'content-inner-2'; 
    }
?>
<div class="section-full <?php echo esc_attr($content); ?> site-bg-white twm-companies-wrap twm-companies-wrap-h-page-7 pos-relative">
     <div class="<?php echo esc_attr($class); ?>"></div> 
    <!-- TITLE START-->
    <div class="section-head center wt-small-separator-outer content-white">
        <?php if(!empty($image_slider_with_counter_1_element_subtitle)){ ?>
        <div class="wt-small-separator site-text-primary">
           <div><?php echo wp_kses($image_slider_with_counter_1_element_subtitle, 'string'); ?></div>                                
        </div>
        <?php } 
        if(!empty($image_slider_with_counter_1_element_title)){ ?>
        <h2 class="wt-title"><?php echo wp_kses($image_slider_with_counter_1_element_title, 'string'); ?></h2>
    <?php } ?>
    </div>                  
    <!-- TITLE END-->

    <div class="container ">
        <div class="twm-companies-h-page-7">
            <?php if(!empty($image_slider_with_counter_1_element_image)){ 
                $item_arr = $image_slider_with_counter_1_element_image;
            ?>
            <div class="section-content">
                <div class="owl-carousel home-client-carousel3 owl-btn-vertical-center">
                    <?php foreach($item_arr as $item){ 
                   if($item['id']){
                    ?>
                    <div class="item">
                        <div class="ow-client-logo">
                            <div class="client-logo client-logo-media">
                                <img src="<?php echo esc_url($item['url']); ?>" alt="<?php echo esc_attr('company-logo', 'jobzilla'); ?>">
                            </div>
                        </div>
                    </div>
                 <?php }
                } ?>
                </div>
            </div>
          <?php } 
          if(!empty($image_slider_with_counter_1_element_item)){ 
                $items_arr = $image_slider_with_counter_1_element_item
            ?>
            <div class="twm-company-approch2-outer">
                <div class="twm-company-approch2">
                    <div class="row mx-0">
                        <?php foreach($items_arr as $item){ ?>
                        <div class="col-lg-4 col-4">
                            <div class="counter-outer-two">
                                <div class="icon-content">
                                    <?php if(!empty($item['image_slider_with_counter_1_element_item_number'])){ ?>
                                    <div class="tw-count-number site-text-primary">
                                        <span class="counter"><?php echo esc_html($item['image_slider_with_counter_1_element_item_number']); ?></span><?php if(!empty($item['image_slider_with_counter_1_element_item_prefix'])){ echo esc_html($item['image_slider_with_counter_1_element_item_prefix']);} ?>
                                       
                                    </div>
                                    <?php } 
                                    if(!empty($item['image_slider_with_counter_1_element_item_title'])){ ?>
                                    <p class="icon-content-info"><?php echo esc_html($item['image_slider_with_counter_1_element_item_title']); ?></p>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php } ?>
        </div>
    </div>

</div>
<!-- TOP COMPANIES END -->
