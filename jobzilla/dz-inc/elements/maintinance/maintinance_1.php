<?php 	
	$jobzilla_option = getDZThemeReduxOption();
	$maintenance_img = jobzilla_get_opt('maintenance_img');
	$maintenance_bg = jobzilla_set($jobzilla_option, 'maintenance_bg');
	$maintenance_title = jobzilla_set($jobzilla_option, 'maintenance_title');
	$maintenance_desc = jobzilla_set($jobzilla_option, 'maintenance_desc');
	$social_link_target = jobzilla_set($jobzilla_option, 'social_link_target');
	$allowed_html_tags = jobzilla_allowed_html_tag();
?>
 <div class="section-full site-bg-gray twm-u-maintenance-area" <?php if(!empty($maintenance_bg)){ ?> style="background-image:url(<?php echo esc_url($maintenance_bg); ?>)" <?php } ?>>
    <div class="twm-u-maintenance-wrap">
        <div class="row">
            <div class="col-lg-5 col-md-12">
                <div class="twm-u-maintenance-content">
                    <div class="media">
                        <?php do_action( 'jobzilla_get_logo','site_logo'); ?>
                    </div>
					
                    <?php if(!empty($maintenance_title)){ ?>
						<h2 class="twm-u-maintenance-title">
							<?php echo wp_kses($maintenance_title,$allowed_html_tags); ?>
						</h2>
					<?php } ?>
					
					<?php if(!empty($maintenance_desc)){ ?>
						<p class="twm-u-maintenance-title2">
							<?php echo wp_kses($maintenance_desc,$allowed_html_tags); ?> 
						</p>
					<?php } ?>

                    <ul class="social-icons">
                        <?php 
							$social_arr = jobzilla_author_social_arr(); 
							foreach($social_arr as $social_key => $social)
							{
								$social_link = jobzilla_get_opt('social_'.$social_key.'_url');
									
								if(!empty($social_link))
								{
									echo '<li class="wow fadeInRight" data-wow-duration="1.5s" data-wow-delay="1.0s"><a href="'.esc_url($social_link).'" target="'.$social_link_target.'" class="'.esc_attr($social['icon']).'"></a></li>';
								}							
							}
						?>
                    </ul>
                </div>
            </div>
			
            <?php if(!empty($maintenance_img['url'])){ ?>
	            <div class="col-lg-7 col-md-12">
	                <div class="twm-u-maintenance-image">
	                    <img src="<?php echo esc_url($maintenance_img['url']); ?>" alt="<?php echo esc_attr__('Image','jobzilla'); ?>">
	                </div>
	            </div>
	        <?php } ?>
        </div>
    </div>
</div> 