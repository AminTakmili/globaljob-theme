<?php
    $query_args = array(
    'post_type' => 'dz_testimonial',
    'post_status' => 'publish',
    'posts_per_page'    => $testimonial_slider_2_element_no_of_posts ,  
    'orderby'=>$testimonial_slider_2_element_orderby,
    'order'=>$testimonial_slider_2_element_order,
    'ignore_sticky_posts' => true,
    );
    
    $testimonial_slider_2_element_image_preference = !empty($testimonial_slider_2_element_image_preference)?$testimonial_slider_2_element_image_preference:'all_posts';
    
    if($testimonial_slider_2_element_image_preference == 'image_post_only')
    {
        $query_args['meta_query'] = array(
            array(
             'key' => '_thumbnail_id',
             'compare' => 'EXISTS'
            ),
        );
    }
    elseif($testimonial_slider_2_element_image_preference == 'text_post_only')
    {
        $query_args['meta_query'] = array(
            array(
             'key' => '_thumbnail_id',
             'compare' => 'Not EXISTS'
            ),
        );
    }
    
    if($testimonial_slider_2_element_only_featured_posts == 'true') 
    {       
        $query_args['meta_key'] = 'featured_post';      
        $query_args['meta_value'] = 1;              
        $query_args['meta_compare'] = 'LIKE';       
    }
    
    if(!empty($testimonial_slider_2_element_posts_in_categories) && !empty($testimonial_slider_2_element_posts_in_categories[0]))
    {           
        
        $testimonial_slider_2_element_posts_in_categories1 = jobzilla_get_cat_id_by_slug($testimonial_slider_2_element_posts_in_categories,'testimonial_category');
        
        $query_args['tax_query'][] = array(
        'taxonomy' => 'testimonial_category',
        'field' => 'id',
        'terms' => $testimonial_slider_2_element_posts_in_categories1,
        'operator' => 'IN'
        ); 
    }   
    $allowed_html_tags = jobzilla_allowed_html_tag();
    $query = new WP_Query($query_args);
    $style = !empty($testimonial_slider_2_element_style) ? $testimonial_slider_2_element_style : 'style_1';
 if(!empty($query->have_posts())){
 if($testimonial_slider_2_element_style == 'style_1'){ ?>  
  <!-- Testimonial START -->
            <div class="section-full content-inner site-bg-white twm-testimonial-page7-wrap">
                <div class="container">

                    <div class="twm-testimonial-page7-section">
                        <div class="row">
                            <div class="col-lg-6 col-md-12">
                                <div class="twm-testimonial-page7-left">
                                    <!-- TITLE START-->
                                    <div class="section-head left wt-small-separator-outer">
                                        <?php if(!empty($testimonial_slider_2_element_subtitle)){ ?>
                                            <div class="wt-small-separator site-text-primary">
                                                <div>
                                                    <?php echo wp_kses($testimonial_slider_2_element_subtitle, 'string'); ?>
                                                </div> 
                                            </div>
                                        <?php } ?>
                                        <?php if(!empty($testimonial_slider_2_element_title)){ ?>
                                            <h2 class="wt-title">
                                                <?php echo wp_kses($testimonial_slider_2_element_title, $allowed_html_tags); ?>
                                            </h2>
                                        <?php } ?>
                                    </div>                  
                                    <!-- TITLE END-->
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="twm-testimonial-page7-right">
                                    <div class="testimonial-thumb-1-wrap">
                                        <div class="swiper testimonial-thumb-1">
                                            <div class="swiper-wrapper">
                                            <!--1-->
                                             <?php
                
                                                while($query->have_posts())
                                                { 
                                                    $query->the_post();
                                                    global $post ;   
                                                    $client_name = jobzilla_get_post_meta($post->ID,'testimonial_client_name');                     
                                                    $designation = jobzilla_get_post_meta(get_the_id(),'testimonial_designation');
                                                    $content_text_limit = $testimonial_slider_2_element_text_limit;
                                                    $short_description = jobzilla_short_description(get_the_excerpt(), get_the_content(), $content_text_limit);
                                                    
                                            ?>
                                            <div class="swiper-slide">
                                                <div class="twm-testi-content">
                                                    <div class="t-testimonial-top">
                                                        <div class="t-quote"><i class="fa fa-quote-left"></i></div>
                                                    </div>
                                                    <div class="t-discription"><?php echo esc_html($short_description); ?></div>
                                                    <div class="twm-testi-detail">
                                                        <div class="twm-testi-name"><?php echo esc_html( $client_name );?></div>
                                                        <div class="twm-testi-position"><?php echo esc_html($designation); ?></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php } ?>
                                            </div>

                                        </div>
                                        <div thumbsSlider="" class="swiper testimonial-thumbpic-1">
                                            <div class="swiper-wrapper">
                                                <!--thumb-1-->
                                                <?php 
                                                 while($query->have_posts())
                                                { 
                                                    $query->the_post();
                                                    global $post ;   ?>
                                                <div class="swiper-slide">
                                                <?php if(has_post_thumbnail()) { ?>  
                                                    <div class="twm-testi-media">
                                                        <?php the_post_thumbnail('medium'); ?> 
                                                    </div>
                                                <?php } ?>
                                                </div>
                                            <?php } ?>
                                            </div>
                                        </div>
                                     </div>

                                </div>
                            </div>
                        </div>
                        <?php if(!empty($testimonial_slider_2_element_placeholder_test)){ ?>
                        <div class="testimonial-outline-text">
                            <span><?php echo esc_html($testimonial_slider_2_element_placeholder_test); ?></span>
                        </div>
                    <?php } ?>
                    </div>

                </div>

            </div>
            <!-- Testimonial END -->
 <?php }else if($style == 'style_2'){ ?>
 
            <!-- Testimonial START -->
            <div class="section-full p-t120 p-b90 site-bg-white twm-testimonial-page8-wrap">
                <div class="container">
                    <!-- TITLE START-->
                    <div class="section-head center wt-small-separator-outer">
                        <?php if(!empty($testimonial_slider_2_element_subtitle)){ ?>
                            <div class="wt-small-separator site-text-primary">
                                <div>
                                    <?php echo wp_kses($testimonial_slider_2_element_subtitle, 'string'); ?>
                                </div> 
                            </div>
                        <?php } ?>
                        <?php if(!empty($testimonial_slider_2_element_title)){ ?>
                            <h2 class="wt-title">
                                <?php echo wp_kses($testimonial_slider_2_element_title, $allowed_html_tags); ?>
                            </h2>
                        <?php } ?>
                    </div>                  
                    <!-- TITLE END-->
                    <div class="twm-testimonial-page8-section">
                        <div class="row">
                            <div class="col-lg-5 col-md-12">
                                <div class="twm-testimonial-page8-left">
                                    <?php if(!empty($testimonial_slider_2_element_image['id'])){ ?>
                                    <div class="twm-media bounce2">
                                        <img src="<?php echo esc_url($testimonial_slider_2_element_image['url']); ?>" alt="<?php echo esc_attr__('Image', 'jobzilla'); ?>">
                                    </div>
                                     <?php } ?>
                                      <?php if(!empty($testimonial_slider_2_element_placeholder_test)){ ?>
                                        <div class="testimonial-outline-text-small">
                                            <span><?php echo esc_html($testimonial_slider_2_element_placeholder_test); ?></span>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="col-lg-7 col-md-12">
                                <div class="twm-testimonial-page8-right">
                                    <div class="testimonial-thumb-1-wrap">
                                        <div class="swiper testimonial-thumb-1">
                                            <div class="swiper-wrapper">
                                            <?php
                
                                                while($query->have_posts())
                                                { 
                                                    $query->the_post();
                                                    global $post ;   
                                                    $client_name = jobzilla_get_post_meta($post->ID,'testimonial_client_name');                     
                                                    $designation = jobzilla_get_post_meta(get_the_id(),'testimonial_designation');
                                                    $content_text_limit = $testimonial_slider_2_element_text_limit;
                                                    $short_description = jobzilla_short_description(get_the_excerpt(), get_the_content(), $content_text_limit);
                                                    
                                            ?>
                                            <div class="swiper-slide">
                                                <div class="twm-testi-content">
                                                    <div class="t-testimonial-top">
                                                        <div class="t-quote"><i class="fa fa-quote-left"></i></div>
                                                    </div>
                                                    <div class="t-discription"><?php echo esc_html($short_description); ?></div>
                                                    <div class="twm-testi-detail">
                                                        <div class="twm-testi-name"><?php echo esc_html( $client_name );?></div>
                                                        <div class="twm-testi-position"><?php echo esc_html($designation); ?></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php } ?>
                                          
                                            </div>

                                        </div>
                                        <div thumbsSlider="" class="swiper testimonial-thumbpic-1">
                                            <div class="swiper-wrapper">
                                                <!--thumb-1-->
                                                 <?php 
                                                 while($query->have_posts())
                                                { 
                                                    $query->the_post();
                                                    global $post ;   ?>
                                                <div class="swiper-slide">
                                                <?php if(has_post_thumbnail()) { ?>  
                                                    <div class="twm-testi-media">
                                                        <?php the_post_thumbnail('medium'); ?> 
                                                    </div>
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

                </div>

            </div>
            <!-- Testimonial END -->
 <?php }
}