<?php 
     $query_args = array(
        'post_type'         => 'resume',
        'post_status'       => 'publish',
        'posts_per_page'    => $company_listing_1_element_no_of_posts ,  
        'orderby'           =>$company_listing_1_element_orderby,
        'order'             =>$company_listing_1_element_order,
        'ignore_sticky_posts'=> true,
        );
        
    if($company_listing_1_element_cols == 'col_2'){
        $col_classes = 'col-xl-6 col-lg-4 col-md-6 col-sm-6';
    }elseif($company_listing_1_element_cols == 'col_3'){
        $col_classes = 'col-xl-4 col-lg-4 col-md-6 col-sm-6';
    }else{
        $col_classes = 'col-xl-3 col-lg-4 col-md-6 col-sm-6';
    }

   if(!empty($company_listing_1_element_posts_in_categories) && !empty($company_listing_1_element_posts_in_categories[0]))
    {           

        $company_listing_1_element_posts_in_categories1 = jobzilla_get_cat_id_by_slug($company_listing_1_element_posts_in_categories,'resume_category');
        
        $query_args['tax_query'][] = array(
        'taxonomy'      => 'resume_category',
        'field'         => 'id',
        'terms'         => $company_listing_1_element_posts_in_categories1,
        'operator'      => 'IN'
        ); 
    }
    $btn_link = $anchor_attribute = '';
    if (!empty($company_listing_1_element_link))
    {
        $btn_link = !empty($company_listing_1_element_link)?$company_listing_1_element_link:'';
      
        $anchor_attribute = jobzilla_elementor_get_anchor_attribute($btn_link);
    }
    if($company_listing_1_element_style == 'container'){
        $container = 'container';
    }else{
        $container = 'container-fluid';
    }
$query = new WP_Query($query_args);  
if(!empty($query->have_posts())){
?>
<!-- CANDIDATES START -->
<div class="section-full content-inner-2 site-bg-white twm-candidate-h-page7-wrap pos-relative ">
    <div class="container">
        <!-- TITLE START-->
        <div class="section-head center wt-small-separator-outer">
            <?php if(!empty($candidate_listing_1_element_subtitle)){ ?>
            <div class="wt-small-separator site-text-primary">
               <div><?php echo wp_kses($candidate_listing_1_element_subtitle,'string'); ?></div>                                
            </div>
            <?php }
            if(!empty($candidate_listing_1_element_title)){ ?>
            <h2 class="wt-title"><?php echo wp_kses($candidate_listing_1_element_title,'string'); ?></h2>
            <?php } ?>
        </div>                  
        <!-- TITLE END-->
    </div>
    <div class="<?php  echo esc_attr($container); ?>">
        <div class="section-content">
            <div class="twm-candidate-h-page7">
                
                <div class="row d-flex justify-content-center m-b30">
                    <?php $count=1;
                        while($query->have_posts())
                        { 
                            $query->the_post();
                            global $post ;    
                            $candidate_data = jobzilla_get_post_meta($post->ID,array('_candidate_title','_featured','_candidate_salary',));  
                    ?>
                    <div class="<?php echo esc_attr( $col_classes ); ?>">
                        <div class="twm-candidates-grid-h-page7 m-b30">
                            <div class="twm-top-section-content">
                              <?php  if(function_exists('the_candidate_photo')){
                              ?>
                                <div class="twm-media">
                                    <div class="twm-media-pic">
                                        <?php   the_candidate_photo('', '', $post);  ?>
                                    </div>
                                </div>
                               <?php 
                                } ?>
                                <div class="twm-mid-content">
                                    <?php if(!empty($candidate_data['_featured'])){ ?>
                                    <div class="twm-candidates-tag"><span><?php echo esc_html__('Featured', 'jobzilla'); ?></span></div>
                                <?php } ?>
                                    <a href="<?php the_permalink();  ?>" class="twm-job-title">
                                        <h6><?php the_title(); ?></h6>
                                    </a>
                                <?php if(!empty($candidate_data['_candidate_title'])){ ?>
                                    <p><?php echo esc_html($candidate_data['_candidate_title']); ?></p>
                                <?php } ?>
                                </div>
                            </div>
                            <div class="twm-fot-content">
                                <div class="twm-left-info">
                                    <?php if(function_exists('the_candidate_location')){ ?>
                                    <p class="twm-candidate-address"><i class="feather-map-pin"></i><?php the_candidate_location( false ); ?></p>
                                    <?php } ?>
                                    <?php if(!empty($candidate_data['_candidate_salary'])){ ?>
                                        <div class="twm-jobs-vacancies">
                                            <?php echo esc_html($candidate_data['_candidate_salary']); ?>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>                                                       
                <?php if(!empty($candidate_listing_1_element_link_title) && !empty($btn_link['url'])){ ?>
                <div class="text-center m-b30">
                    <a href="<?php echo esc_url($btn_link['url']); ?>"  <?php echo esc_attr($anchor_attribute); ?> class=" site-button"><?php echo esc_html($candidate_listing_1_element_link_title); ?></a>
               </div>
               <?php } ?>
            </div>
        </div>

    </div>
</div>
<?php }