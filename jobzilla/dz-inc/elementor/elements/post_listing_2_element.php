<?php
    $blog_view = "post_listing_2";
    $page_no = 1;
    
    $query_args = array(    
        'post_type'         => 'post',
        'post_status'       => 'publish',
        'posts_per_page'    => $post_listing_2_element_no_of_posts ,        
        'order'             => $post_listing_2_element_order,
        'ignore_sticky_posts' => true,
    );
    
    if($post_listing_2_element_orderby == 'views_count'){
        $query_args['meta_key'] = '_views_count';
    }
    else{
        $query_args['orderby']  = $post_listing_2_element_orderby;
    }
  
    $post_listing_2_element_image_preference = !empty($post_listing_2_element_image_preference)?$post_listing_2_element_image_preference:'all_posts';
    
    if($post_listing_2_element_image_preference == 'image_post_only')
    {
        $query_args['meta_query'] = array(
            array(
             'key' => '_thumbnail_id',
             'compare' => 'EXISTS'
            ),
        );
    }
    elseif($post_listing_2_element_image_preference == 'text_post_only')
    {
        $query_args['meta_query'] = array(
            array(
             'key' => '_thumbnail_id',
             'compare' => 'Not EXISTS'
            ),
        );
    }
    
    if(!empty($post_listing_2_element_posts_in_categories) && !empty($post_listing_2_element_posts_in_categories[0])) {
        
        $post_listing_2_element_posts_in_categories = implode(',', $post_listing_2_element_posts_in_categories);
        $query_args['category_name'] = $post_listing_2_element_posts_in_categories;
        
    }else{
        $post_listing_2_element_posts_in_categories = '';
    }
    
    if($post_listing_2_element_only_featured_posts == 'true') 
    {       
        $query_args['meta_key'] = 'featured_post';      
        $query_args['meta_value'] = 1;              
        $query_args['meta_compare'] = 'LIKE';       
    }
  
    if($post_listing_2_element_selected_sidebar == 'No_Sidebar' || !is_active_sidebar( $post_listing_2_element_selected_sidebar ) || !jobzilla_is_theme_sidebar_active())
    {
        $col_classes = 'col-sm-12 col-12';
        
    }else{
        $col_classes = 'col-lg-8 col-md-12 m-b10 ';
    }
    
    $query = new WP_Query($query_args); 
    
    $blog_view_container = '';
    if($post_listing_2_element_pagination_style == 'load_more')
    {
        $blog_view_container = $blog_view."_LoadMoreContainer";
    }
    
    global $jobzilla_query_result;
    $jobzilla_query_result['posts'] = $query->posts;  
    $jobzilla_query_result['posts_per_page'] = $post_listing_2_element_no_of_posts;   
    $jobzilla_query_result['current_page'] = $page_no;
    $jobzilla_query_result['side_bar'] = $post_listing_2_element_selected_sidebar;
    $jobzilla_query_result['title_text_limit'] = $post_listing_2_element_text_limit;    
    $jobzilla_query_result['show_column'] = $post_listing_2_element_cols;
    
	$jobzilla_query_result['blog_view_container'] = $blog_view_container;   
    $max_num_pages = $query->max_num_pages; 
    $strip = wp_kses_allowed_html('strip');
	$bg_img = $post_listing_2_element_bg_img;
    if($query->have_posts()) {
?>
<!-- Blog -->
    <div class="section-full content-inner-1" <?php if(!empty($bg_img['id'])){ ?> style="background-image:url(<?php echo esc_url($bg_img['url']); ?>)" <?php } ?>>
        <div class="container">
            <?php if(!empty($post_listing_2_element_title) || !empty($post_listing_2_element_subtitle )){ ?>
                <div class="section-head center wt-small-separator-outer">
                    <?php if(!empty($post_listing_2_element_subtitle )){ ?>
                        <div class="wt-small-separator site-text-primary">
                           <div>
                                <?php echo wp_kses($post_listing_2_element_subtitle, 'string'); ?>
                           </div>                                
                        </div>
                    <?php } ?>

                    <?php if(!empty($post_listing_2_element_title)){ ?>
                        <h2 class="wt-title <?php if(!empty($bg_img['id'])){  echo esc_attr__('site-text-white','jobzilla');  } ?>">
                            <?php echo wp_kses($post_listing_2_element_title, 'string'); ?>
                        </h2>                
                    <?php } ?>
                </div>    
            <?php } ?>

            <div class="section-content">
                <div class="twm-blog-post-1-outer-wrap">
                    <div class="row d-flex justify-content-center">
                        <?php 
                            if ($post_listing_2_element_sidebar_layout == 'left' && 
                            is_active_sidebar( $post_listing_2_element_selected_sidebar ) && 
                            jobzilla_is_theme_sidebar_active() ){ 
                        ?>
                            <div class="col-lg-4 col-md-12 rightSidebar">
                                <div class="side-bar">
                                    <?php dynamic_sidebar( $post_listing_2_element_selected_sidebar ); ?>
                                </div>
                            </div>
                      <?php } ?>
                      <!-- Side bar END -->

                      <!-- Left part start -->
                        <div class="<?php echo esc_attr($col_classes); ?>">
                            <div <?php if(!empty($blog_view_container)){ ?> id="<?php echo esc_attr($blog_view_container) ?>" <?php } ?> class="row">
                                <?php get_template_part('dz-inc/elementor/ajax/post_listing_2_ajax'); ?>
                            </div>
                            <?php
                                if($post_listing_2_element_pagination_style == 'load_more')
                                {   
                                    $blog_view_btn = $blog_view."_LoadMoreBtn";
                                    $blog_view_container = $blog_view."_LoadMoreContainer";
                                    
                                    if( 1 < $max_num_pages ) 
                                    { 
                                    ?>
                                    <!-- Pagination start -->
                                    <div class="reload-btn text-center">
                                    <a href="javascript:void(0);" class="btn wow fadeInUp  site-button loadmore-btn dz-load-more " id="<?php echo esc_attr($blog_view_btn); ?>"   
                                        data-ajax-container = "<?php echo esc_js($blog_view_container); ?>"                 
                                        data-blog-view = "<?php echo esc_js($blog_view);?>" 
                                        data-max-num-pages="<?php echo esc_js($max_num_pages);?>" 
                                        data-posts-per-page="<?php echo esc_js($post_listing_2_element_no_of_posts);?>"
                                        data-image-preference="<?php echo esc_js($post_listing_2_element_image_preference); ?>"
                                        data-only-featured-post="<?php echo esc_js($post_listing_2_element_only_featured_posts)?>" 
                                        data-post-order="<?php echo esc_js($post_listing_2_element_order)?>"    
                                        data-post-order-by="<?php echo esc_js($post_listing_2_element_orderby)?>"   
                                        data-posts-in-categories="<?php echo esc_js($post_listing_2_element_posts_in_categories);?>"
                                        data-side-bar="<?php echo esc_js($post_listing_2_element_selected_sidebar);?>"
                                        data-show-column="<?php echo esc_js($post_listing_2_element_cols);?>"
                                        data-title-text-limit="<?php echo esc_js($post_listing_2_element_text_limit);?>" 
                                        >
                                    <span><?php echo esc_html__('Load More', 'jobzilla'); ?></span> <i class="fa fa-refresh fas fa-spinner fa-spin"></i></a>
                                    </div>
                                    <!-- Pagination End -->
                                    <?php 
                                    }
                                }
                            ?>
                        </div>
                        <?php 
                            if ($post_listing_2_element_sidebar_layout == 'right' && 
                                is_active_sidebar( $post_listing_2_element_selected_sidebar ) && 
                                jobzilla_is_theme_sidebar_active() ){ 
                        ?>
                            <div class="col-lg-4 col-md-12 rightSidebar">
                                <div class="side-bar">
                                    <?php dynamic_sidebar( $post_listing_2_element_selected_sidebar ); ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>