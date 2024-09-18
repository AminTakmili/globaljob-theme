<?php
    $category_arr = array();
    if( $faq_1_element_posts_in_categories ) 
    {
        $faq_1_element_posts_in_categories = jobzilla_get_cat_id_by_slug($faq_1_element_posts_in_categories, 'faq_category');
        
    }else{
		$faq_1_element_posts_in_categories = '';
	}
        $category_arr = get_terms( array(
            'taxonomy' 		=> 'faq_category',
            'include' 		=> $faq_1_element_posts_in_categories,
            'hide_empty'  	=> false, 
            'orderby'  		=> 'include', 
            'order'  		=> 'ASC', 
        ) ); 
    
    $rand_number = jobzilla_generate_rand_number();
    $accordian_id = 'accordion'.$rand_number;

    if(!empty($category_arr)){ 
?>
    <!-- FAQ START -->
    <div class="section-full p-t120  p-b90 site-bg-white">    
        <div class="container">
            <?php if (!empty($faq_1_element_title) || !empty($faq_1_element_subtitle)) { ?>
                <!-- TITLE START-->
                <div class="section-head left wt-small-separator-outer">
                    <?php if (!empty($faq_1_element_element_subtitle)) { ?>
                        <div class="wt-small-separator site-text-primary">
                            <div>
                                <?php echo wp_kses($faq_1_element_subtitle,'string'); ?>
                            </div>
                        </div>
                    <?php } ?>

                    <?php if (!empty($faq_1_element_title)) { ?>
                        <h2 class="wt-title">
                            <?php echo wp_kses($faq_1_element_title,'string'); ?>
                        </h2>
                    <?php } ?>
                </div>
                <!-- TITLE END--> 
            <?php } ?>
            <div class="section-content">
                <div class="twm-tabs-style-1 center">
                    <ul class="nav nav-tabs" id="myTab<?php echo esc_attr($rand_number); ?>" role="tablist">
                        <?php 
                            $count=1;
                            foreach($category_arr as $key => $category_data){ 
                                $active_class = ($count==1)?'active':'';
                        ?>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link <?php echo esc_attr($active_class); ?>" data-bs-toggle="tab" data-bs-target="#<?php echo sanitize_title($category_data->name); ?>" type="button" role="tab" ><?php echo ucwords(sanitize_title($category_data->name)); ?></button>
                            </li>
                        <?php ++$count;} ?>                        
                    </ul>
                    <div class="tab-content" id="myTabContent<?php echo esc_attr($rand_number); ?>">
                        <?php $faq_count = 1; 
                            foreach($category_arr as $key => $category_data){
                                $query_args = array('post_type' => 'dz_faq', 
                                'showposts'=>$faq_1_element_no_of_posts, 
                                'orderby'=>$faq_1_element_orderby,
                                'order'=>$faq_1_element_order,
                                );
                                
                                $query_args['tax_query'][] = array(
                                'taxonomy' => 'faq_category',
                                'field' => 'id',
                                'terms' => array(0=>$category_data->term_id),
                                'operator' => 'IN'); 
                                
                                $query = new WP_Query($query_args) ;
                                if($category_data->count > 0) {
                                $active_class = ($faq_count==1)?'active':'';


                        ?>
                        <!--Tabs content one-->
                        <div class="tab-pane fade show <?php echo esc_attr($active_class); ?>" id="<?php echo sanitize_title($category_data->name); ?>" role="tabpanel">
                            <div class="tw-faq-section">
                                <div class="accordion tw-faq" id="sf-faq-accordion<?php echo esc_attr($category_data->term_id); ?>">
                                    <?php 
                                        $acc_count = 1;
                                        $assign_value = 0;
                                        while($query->have_posts()){ 
                                            $query->the_post();
                                            global $post ;
                                            $cat_id = $category_data->term_id;
                                            if($acc_count==1){
                                                $classes = 'show';
                                            }else{
                                                $classes = '';
											} 

                                            $expended_classes = ($acc_count == 1) ? 'true' : 'false';
                                            $heading_class = ($acc_count == 1) ? '' : 'collapsed';
                                            $content_text_limit = $faq_1_element_text_limit;
                                            $short_description = jobzilla_short_description(get_the_excerpt(), get_the_content(), $content_text_limit);
                                    ?>
                                        <div class="accordion-item">
                                            <button class="accordion-button <?php echo esc_attr($heading_class); ?>" type="button" data-bs-toggle="collapse" aria-expanded="<?php echo esc_attr($expended_classes); ?>" data-bs-target="#<?php echo esc_attr($accordian_id.$acc_count.$cat_id); ?>">
                                                <?php echo jobzilla_trim(get_the_title(), 10); ?>
                                            </button>

                                            <div id="<?php echo esc_attr($accordian_id.$acc_count.$cat_id); ?>" class="accordion-collapse collapse <?php echo esc_attr($classes); ?>" data-bs-parent="#sf-faq-accordion<?php echo esc_attr($category_data->term_id); ?>">
                                                <div class="accordion-body">
                                                    <?php echo esc_html($short_description); ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php ++$acc_count; } ?>    
                                </div>
                            </div>
                        </div>
                        <?php } ++$faq_count; } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>   
    <!-- FAQ END -->
<?php } ?>