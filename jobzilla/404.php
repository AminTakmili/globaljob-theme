<?php 
	get_header(); 	
	$jobzilla_option        = getDZThemeReduxOption();
	$error_404_bg           = !empty($jobzilla_option['error_404_bg']) ? $jobzilla_option['error_404_bg'] : '';
	$error_page_title       = !empty($jobzilla_option['error_page_title']) ? $jobzilla_option['error_page_title'] : '';
	$error_page_text        = !empty($jobzilla_option['error_page_text']) ? $jobzilla_option['error_page_text'] : '';
	$error_page_text2       = !empty($jobzilla_option['error_page_text2']) ? $jobzilla_option['error_page_text2'] : '';
	$error_page_button_text = !empty($jobzilla_option['error_page_button_text']) ? $jobzilla_option['error_page_button_text'] : '';
?>
    <!-- Error Page -->
    <div class="section-full content-inner site-bg-white">
        <div class="container">
            <div class="twm-error-wrap">
                <div class="row">    
                	<?php if(!empty($error_404_bg)){ ?>                
	                    <div class="col-lg-6 col-md-12">
	                        <div class="twm-error-image">
	                            <img src="<?php echo esc_url($error_404_bg); ?>" alt="<?php echo esc_attr__('Image','jobzilla'); ?>">
	                        </div>
	                    </div>
	                <?php } ?>

                    <div class="col-lg-6 col-md-12">
                        <div class="twm-error-content">
                            <h2 class="twm-error-title">
								<?php echo wp_kses($error_page_title,'string'); ?>
							</h2>
							
                            <h4 class="twm-error-title2 site-text-primary">
								<?php echo wp_kses($error_page_text,'string'); ?>
							</h4>
							
                            <p>
								<?php echo wp_kses($error_page_text2,'string'); ?>
							</p>
							
                            <a href="<?php echo esc_url(home_url('/')); ?>" class="site-button">
								<?php echo wp_kses($error_page_button_text,'string'); ?>
							</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>   
	<!-- Error Page END-->
<?php get_footer(); ?>