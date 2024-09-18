<?php 
    $bg_img = $content_box_5_element_bg_image;

   
    $allowed_html_tags = jobzilla_allowed_html_tag(); 

?>
<div class="container">
    <div class="twm-j-ofr-wrap">
        <div class="twm-j-ofr-content" <?php if(!empty($bg_img['id'])){ ?> style="background-image: url(<?php echo esc_url($bg_img['url']); ?>);" <?php } ?>>
            <div class="row">
                <div class="col-lg-7 col-md-12">

                    <div class="twm-j-ofr-map-content">
                        <!-- TITLE START-->
                        <?php if(!empty($content_box_5_element_title)){ ?>
                        <div class="section-head left wt-small-separator-outer">
                            <h2 class="wt-title"><?php echo wp_kses($content_box_5_element_title, $allowed_html_tags); ?></h2>
                        </div>   
                        <?php } ?>               
                        <!-- TITLE END-->
                        <?php if(!empty($content_box_5_element_item)){ 
                            $item_arr = $content_box_5_element_item;
                        ?>
                        <div class="twm-j-ofr-map-list">
                            <ul>
                                <?php foreach($item_arr as $item){ ?>
                                <li>
                                    <div class="flag-list">
                                        <?php 
                                        if(!empty($item['content_box_5_element_item_image']['id'])){ ?>
                                        <span><img src="<?php echo esc_url($item['content_box_5_element_item_image']['url']); ?>" alt="<?php echo esc_attr__('Image','jobzilla'); ?>"></span>
                                        <?php } ?>
                                        <?php if(!empty($item['content_box_5_element_item_title'])){ ?>
                                        <h4 class="flat-name">
                                            <?php echo esc_html($item['content_box_5_element_item_title']); ?>
                                        </h4>
                                    <?php } ?>
                                    </div>
                                </li>
                               <?php } ?>
                            </ul>
                        </div>
                    <?php } 
                        if(!empty($content_box_5_element_link) && !empty($content_box_5_element_btn_text)){ ?>
                        <div class="twm-read-more">
                            <a href="<?php esc_url($content_box_5_element_link); ?>" class="site-button"><?php echo esc_html($content_box_5_element_btn_text); ?></a>
                        </div>
                    <?php } ?>
                    </div>
                    
                </div>
                <div class="col-lg-5 col-md-12">
                    <?php if(!empty($content_box_5_element_image['id'])){ ?>
                    <div class="twm-j-ofr-map">
                        <div class="twm-media">
                            <img src="<?php echo esc_url($content_box_5_element_image['url']); ?>" alt="<?php echo esc_attr__('Image','jobzilla'); ?>">
                        </div>
                    </div>
                <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>