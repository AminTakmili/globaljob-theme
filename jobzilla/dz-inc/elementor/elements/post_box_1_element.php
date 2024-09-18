<?php
    $query_args = array(    
        'post_type'         => 'post',
        'post_status'       => 'publish',
        'posts_per_page'    => 4 ,     
        'order'             => $post_box_1_element_order,
        'ignore_sticky_posts' => true,
    );
    $title_text_limit = $post_box_1_element_text_limit;
    if($post_box_1_element_orderby == 'views_count'){
        $query_args['meta_key'] = '_views_count';
    }
    else{
        $query_args['orderby']  = $post_box_1_element_orderby;
    }
    if($post_box_1_element_image_preference == 'image_post_only')
    {
        $query_args['meta_query'] = array(
            array(
             'key' => '_thumbnail_id',
             'compare' => 'EXISTS'
            ),
        );
    }
    elseif($post_box_1_element_image_preference == 'text_post_only')
    {
        $query_args['meta_query'] = array(
            array(
             'key' => '_thumbnail_id',
             'compare' => 'Not EXISTS'
            ),
        );
    }
    if($post_box_1_element_posts_in_categories && !empty($post_box_1_element_posts_in_categories[0])) {
        
        $post_box_1_element_posts_in_categories1 = jobzilla_get_cat_id_by_slug($post_box_1_element_posts_in_categories,'category');
        
        $query_args['tax_query'][] = array(
        'taxonomy' => 'category',
        'field' => 'id',
        'terms' => $post_box_1_element_posts_in_categories1,
        'operator' => 'IN'
        ); 
        $post_box_1_element_posts_in_categories = implode(',',$post_box_1_element_posts_in_categories);
    }
    if($post_box_1_element_only_featured_posts == 'true') 
    {       
        $query_args['meta_key'] = 'featured_post';      
        $query_args['meta_value'] = 1;              
        $query_args['meta_compare'] = 'LIKE';       
    }
    $query = new WP_Query($query_args); 
    if($query->have_posts()) {
?>

<!-- OUR BLOG START -->
<div class="section-full content-inner site-bg-gray bg-cover overlay-wraper" <?php if(!empty($post_box_1_element_bg_img['id'])){ ?> style="background-image:url(<?php echo esc_url($post_box_1_element_bg_img['url']) ?>)" <?php } ?>>
    <div class="overlay-main site-bg-primary opacity-01"></div>
        <div class="container">
           <?php if (!empty($post_box_1_element_title) || !empty($post_box_1_element_subtitle)) { ?>
                <!-- TITLE START-->
                <div class="section-head center wt-small-separator-outer">
                    <?php if (!empty($post_box_1_element_subtitle)) { ?>
                        <div class="wt-small-separator site-text-primary">
                            <div>
                                <?php echo wp_kses($post_box_1_element_subtitle,'string'); ?>
                            </div>                                
                        </div>
                    <?php } ?>   

                    <?php if (!empty($post_box_1_element_title)) { ?>
                        <h2 class="wt-title site-text-white">
                            <?php echo wp_kses($post_box_1_element_title,'string'); ?>
                        </h2> 
                    <?php } ?>           
                </div>                  
                <!-- TITLE END-->
            <?php } ?> 

            <div class="section-content">
                <div class="row d-flex justify-content-center">
                    <?php 
                        $count=1;
                        $output='';
                        while($query->have_posts())
                        { 
                            $query->the_post();
                            global $post ;                        
                            $author_name = get_the_author_meta('display_name', $post->post_author);
                            $post_title =  jobzilla_trim(get_the_title(),10); 
                            $short_description =  !empty($title_text_limit) ? jobzilla_trim(get_the_content() , $title_text_limit) : get_the_content();
                        if($count == 1){

                        $output .= '<div class="col-lg-5 col-md-12 m-b30">
                        <div class="blog-post twm-blog-post-2-outer">
                            <div class="wt-post-media">
                                <a href="'.esc_url(get_permalink()).'">
                                    <img src="' . get_the_post_thumbnail_url($post->ID , 'jobzilla_470x550') . '" alt="'.esc_attr__('Image','jobzilla').'">
                                </a>
                            </div>
                            <div class="wt-post-info">
                                <div class="wt-post-meta ">
                                    <ul>
                                        <li class="post-date">'.esc_html(get_the_date('M j, Y')).'</li>
                                    </ul>
                                </div>
                                <div class="wt-post-title">
                                    <h5 class="post-title"><a href="'.esc_url(get_permalink()).'">'.esc_html($post_title).'</a></h5>
                                </div>

                                <div class="wt-post-readmore ">
                                    <a class="site-button-link site-text-secondry" href="'.esc_url(get_permalink()).'">'.esc_html__( 'Read More','jobzilla' ).'</a>
                                </div>
                            </div>
                        </div>
                    </div>';
                    }else {
                        
                        if($count == 2){
                             
                            $output .= '<div class="col-lg-7 col-md-12 ">
                                            <div class="twm-blog-post-wrap-right">';
                        }
                        
                        
                            $output .='<div class="blog-post twm-blog-post-1-outer shadow-none m-b30">                                            
                                            <div class="wt-post-info">
                                                <div class="wt-post-meta ">
                                                    <ul>
                                                        <li class="post-date">'.esc_html(get_the_date('M j, Y')).'</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="wt-post-title ">
                                                <h5 class="post-title"><a href="'.esc_url(get_permalink()).'">'.esc_html($post_title).'</a></h5>
                                            </div>
                                            <div class="dz-post-text text">
                                                <p>'.esc_html( $short_description ).'</p>
                                            </div>
                                            <div class="wt-post-readmore ">
                                                <a class="site-button-link site-text-primary" href="'.esc_url(get_permalink()).'">'.esc_html__( 'Read More','jobzilla' ).'</a>
                                            </div>
                                        </div>';
                        
                         
                        if($count == 4){ 
                            $output .= '        </div>
                                            </div>
                                        </div>';
                                    
                        }
                                    
                                    
                    }
                  
                ?>  
                
                    
                    
                
                <?php   
                
                    ++$count;
                    
                } 
                echo wp_kses($output,jobzilla_allowed_html_tag());
                
                ?>                                       
                </div>
            </div>
        </div>
<!-- OUR BLOG END -->
<?php } ?>   