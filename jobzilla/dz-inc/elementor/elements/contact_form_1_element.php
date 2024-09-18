<!-- CONTACT FORM -->
<div class="section-full twm-contact-one">   
    <div class="section-content">
        <div class="container">                
            <!-- CONTACT FORM-->
            <div class="contact-one-inner content-inner">
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <div class="contact-form-outer cons-contact-form">
                            <?php if (!empty($contact_form_1_element_title) || !empty($contact_form_1_element_description)) { ?>
                                <!-- TITLE START-->
                                <div class="section-head left wt-small-separator-outer">
                                    <?php if (!empty($contact_form_1_element_title)) { ?>
                                        <h2 class="wt-title">
                                            <?php echo wp_kses($contact_form_1_element_title,'string'); ?>
                                        </h2>
                                    <?php } ?>

                                    <?php if (!empty($contact_form_1_element_description)) { ?>
                                        <p>
                                            <?php echo wp_kses($contact_form_1_element_description,'string'); ?>
                                        </p>
                                    <?php } ?>
                                </div>
                                <!-- TITLE END--> 
                            <?php } ?>

                            <?php if(!empty($contact_form_1_element_contact_form)){ 
                                $post = get_page_by_path($contact_form_1_element_contact_form,OBJECT,'wpcf7_contact_form');
                                    if(!empty($post->ID)){
                                        echo do_shortcode('[contact-form-7 id="'.$post->ID.'"]');
                                    }
                                } 
                            ?>
                        </div>
                    </div> 

                    <?php  
                        if(!empty($contact_form_1_element_item)){
                        $item_arr = $contact_form_1_element_item;
                    ?>
                        <div class="col-lg-6 col-md-12">
                            <div class="contact-info-wrap">
                                <div class="contact-info">
                                    <div class="contact-info-section ">  
                                        <?php $count=1;
                                            foreach($item_arr as $itemKey => $itemValue) {
                                            $icon = $itemValue['contact_form_1_element_item_icon']['value'];
                                            $extra_class = ($count % 2)?'custome-size':'';
                                        ?>
                                            <div class="c-info-column">
                                                <div class="c-info-icon <?php echo esc_attr($extra_class); ?>"><i class="<?php echo esc_attr($icon); ?>"></i></div>

                                                <?php if(!empty($itemValue['contact_form_1_element_item_title'])){  ?>
                                                    <h5 class="twm-title">
                                                        <?php echo esc_html($itemValue['contact_form_1_element_item_title']); ?>
                                                    </h5>
                                                <?php }  ?>

                                                <?php if(!empty($itemValue['contact_form_1_element_item_description'])){  ?>
                                                    <p>
                                                        <?php echo wp_kses($itemValue['contact_form_1_element_item_description'],jobzilla_allowed_html_tag()); ?>
                                                    </p>
                                                <?php }  ?>                                                
                                            </div>  
                                        <?php ++$count; } ?>        
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

<?php if(!empty($contact_form_1_element_map_iframe)){ ?>
    <div class="gmap-outline">
        <div class="google-map">
            <?php echo jobzilla_shortcode($contact_form_1_element_map_iframe);?>
        </div>
    </div>
<?php } ?>