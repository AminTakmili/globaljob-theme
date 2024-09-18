<?php 
     $query_args = array(
    'post_type'          => 'job_listing',
    'post_status'        => 'publish',
    'posts_per_page'     => $job_slider_1_element_no_of_posts ,  
    'orderby'            => $job_slider_1_element_orderby,
    'order'              => $job_slider_1_element_order,
    'ignore_sticky_posts'=> true,
    );
    
    if(!empty($job_slider_1_element_posts_in_categories) && !empty($job_slider_1_element_posts_in_categories[0]))
    {           

        $job_slider_1_element_posts_in_categories1 = jobzilla_get_cat_id_by_slug($job_slider_1_element_posts_in_categories,'job_listing_type');
        
        $query_args['tax_query'][] = array(
        'taxonomy'      => 'job_listing_type',
        'field'         => 'id',
        'terms'         => $job_slider_1_element_posts_in_categories1,
        'operator'      => 'IN'
        ); 
    }

   $category_arr = array();
    if(!empty($job_slider_1_element_posts_in_categories)) 
    {       
        $cat_ids = jobzilla_get_cat_id_by_slug($job_slider_1_element_posts_in_categories,'job_listing_type');
    
        $cat_ids_comma_seperated = implode(',',$cat_ids);
        
        $category_arr = get_terms( array(
        'taxonomy'    => 'job_listing_type',
        'include'     => $cat_ids_comma_seperated,
        'hide_empty'  => false, /* Not return that didn't have any post in it's category */
        'orderby'     => 'include', 
        'order'       => $job_slider_1_element_order, 
        ) ); 
    }

    $query = new WP_Query($query_args);

    if(!empty($query->have_posts())){
?>
<!-- Recommended Jobs SECTION START -->
<div class="section-full content-inner site-bg-white twm-recommended-Jobs-wrap7">
    <div class="container">

        <div class="wt-separator-two-part">
            <div class="row wt-separator-two-part-row section-head">
                <div class="col-xl-6 col-lg-8 col-md-8 wt-separator-two-part-left">
                    <!-- TITLE START-->
                    <div class="wt-small-separator-outer">
                    <?php if(!empty($job_slider_1_element_subtitle)){ ?>
                        <div class="wt-small-separator site-text-primary">
                        <div><?php echo wp_kses($job_slider_1_element_subtitle, 'string'); ?></div>                                
                        </div>
                    <?php } 
                    if(!empty($job_slider_1_element_title)){ ?>
                        <h2 class="wt-title"><?php echo wp_kses($job_slider_1_element_title, 'string'); ?></h2>
                    <?php } ?>
                    </div>                  
                    <!-- TITLE END-->
                </div>
                <?php if(!empty($job_slider_1_element_link_title) && !empty($job_slider_1_element_link)){ ?>
                    <div class="col-xl-6 col-lg-4 col-md-4 text-md-end">
                        <a href="<?php echo esc_url($job_slider_1_element_link); ?>" class="site-button"><?php  echo esc_html($job_slider_1_element_link_title); ?></a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="twm-recommended-Jobs-mid-wrap">
        <div class="twm-recommended-Jobs-mid">
            <div class="container">
                <div class="filter-carousal">
                    <!-- Filter Menu -->
                    <div class="twm-jobs-filter">
                        <ul class="btn-filter-wrap">
                            <li class="btn-filter btn-active" data-filter="*"><?php echo esc_html__('All','jobzilla'); ?></li>
                            <?php if(!empty($category_arr)){ 
                                foreach($category_arr as $type){
                                ?>
                                   <li class="btn-filter" data-filter="<?php echo esc_attr('.'.$type->slug); ?>">
                                        <?php  echo esc_html($type->name);  ?>
                                    </li>
                                <?php } 
                             } ?>
                        </ul>
                    </div>
                    <!-- Filter Menu -->
                
                    <!-- IMAGE CAROUSEL START -->
                    <div class="section-content ">
                        <div class="owl-carousel owl-carousel-filter mfp-gallery owl-btn-vertical-center">
                        <?php
                        while($query->have_posts()){
                            $query->the_post();
                            global $post ;      
                            $post_id = $post->ID;
                            $company_id = jobzilla_get_post_meta($post->ID, '_company_id');
                            $adderss = jobzilla_get_post_meta($company_id, '_company_adderss');
                            $company_logo = get_the_company_logo($company_id,  'medium' ); 
                            $company_title = jobzilla_trim(get_the_title($company_id), 5);
                            $post_title = jobzilla_trim(get_the_title($post_id), 5);
                            $types = wpjm_get_the_job_types( $post );
                            $type = $types[0];
                            $company_data = jobzilla_get_post_meta($post_id,
                                array('_company_website',
                                '_job_salary',
                                '_salary_max',
                                '_job_salary_currency',
                                '_job_salary_unit',
                                )
                            );
                         ?>
                        <div class="item  <?php echo esc_attr($type->slug); ?>">										
                            <div class="hpage-7-featured-block">
                                <div class="inner-content">
                                    <div class="top-content-wrap">
                                        <div class="top-content">
                                            <?php 
                                            if(!empty($type)){ ?>
                                                <span class="job-time">
                                                    <?php  echo esc_html($type->name);  ?>
                                                </span>
                                            <?php } ?>
                                            <span class="job-post-time"><?php echo get_the_jobzilla_publish_date($post); ?></span>
                                        </div>
                                        <div class="mid-content">
                                            <?php if(!empty($company_logo)) { ?>  
                                                <div class="company-logo">
                                                    <img src="<?php echo esc_url($company_logo); ?>" alt="<?php echo esc_attr__('company-logo', 'jobzilla'); ?>">
                                                </div>
                                            <?php } ?>
                                            <div class="company-info">
                                                <a href="<?php the_permalink($company_id); ?>" class="company-name"><?php echo esc_html($company_title); ?></a>
                                                <?php if(!empty($adderss)){ ?>
                                                    <p class="company-address">
                                                        <?php echo esc_html($adderss); ?>
                                                    </p>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bottom-content">
                                        <h4 class="job-name-title"> 
                                        <a href="<?php the_permalink(); ?>">
                                           <?php echo esc_html($post_title); ?>
                                        </a>
                                        </h4>
                                       <?php if(!empty($company_data['_job_salary_currency']) || !empty($company_data['_job_salary']) || !empty($company_data['_job_salary_unit']) || !empty($company_data['_salary_max'])){ ?>
                                            <div class="job-payment">
                                            <?php 
                                            if ( !empty($company_data['_job_salary']) ) { 
                                                echo '<span>';  
                                                if ( !empty($company_data['_job_salary_currency']) ) { echo esc_html($company_data['_job_salary_currency']); 
                                                } 
                                                echo esc_html(number_format_i18n($company_data['_job_salary']) ); 
                                                echo '</span>'; 
                                            } 
                                            if(!empty($company_data['_salary_max'])) { if ( !empty($company_data['_job_salary']) ) { echo ' - '; } 
                                            echo '<span>';  
                                            if ( !empty($company_data['_job_salary_currency']) ) { echo esc_html($company_data['_job_salary_currency']); } 
                                                
                                                echo esc_html(number_format_i18n($company_data['_salary_max']));
                                            } 
                                            echo '</span>';
                                            if(!empty($company_data['_job_salary_unit'])){
                                                echo esc_html('/ '.ucfirst($company_data['_job_salary_unit'])); 
                                            } ?>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    <div class="aply-btn-area">
                                        <a href="<?php the_permalink(); ?>" class="aplybtn">
                                            <i class="fa fa-check"></i>
                                        </a>
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
    </div>
</div>   
<!-- Recommended Jobs SECTION END -->
<?php } 