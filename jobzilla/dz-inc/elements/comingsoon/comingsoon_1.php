<?php 
$jobzilla_option = getDZThemeReduxOption();
$comingsoon_bg = !empty($jobzilla_option['comingsoon_bg']) ? $jobzilla_option['comingsoon_bg'] : '';
$comingsoon_page_title = !empty($jobzilla_option['comingsoon_page_title']) ? $jobzilla_option['comingsoon_page_title'] : '';
$comingsoon_page_description = !empty($jobzilla_option['comingsoon_page_description']) ? $jobzilla_option['comingsoon_page_description'] : '';
$comingsoon_launch_date = jobzilla_get_opt('comingsoon_launch_date');
$social_link_target = jobzilla_get_opt('social_link_target');
$allowed_html_tags = jobzilla_allowed_html_tag();

$date = '';
if(!empty($comingsoon_launch_date))
{
	$date = date("d F Y", strtotime($comingsoon_launch_date));
}
?>

<div class="section-full site-bg-gray twm-c-soon-area" <?php if(!empty($comingsoon_bg)){ ?> style="background-image:url(<?php echo esc_url($comingsoon_bg); ?>)" <?php } ?>>       
    <div class="twm-c-soon-wrap">
        <div class="row">            
            <div class="col-lg-12 col-md-12">
                <div class="twm-c-soon-content">
                    <?php if(!empty($comingsoon_page_title)){ ?>
	                    <h2 class="twm-c-soon-title">
	                    	<?php echo wp_kses($comingsoon_page_title, $allowed_html_tags); ?>
	                    </h2>
	                <?php } ?>

	                <?php if(!empty($comingsoon_page_description)){ ?>
                    	<p class="twm-c-soon-title2">
                    		<?php echo wp_kses($comingsoon_page_description, 'string'); ?>
                    	</p>
                    <?php } ?>
					
					<form class="dzSubscribe dz-subscription" action="#" method="post">
						<div class="cs-nw-form input-group">
						   <input name="dzEmail" required="required" type="email" class="form-control shadow" placeholder="<?php echo esc_attr__('Enter Your Email Address...','jobzilla'); ?>">
							<button class="cs-subcribe-btn">
								<?php echo esc_html__('Subscribe','jobzilla') ?>
							</button>
						</div>
						<div class="dzSubscribeMsg dz-subscription-msg text-white"></div>
					</form>
					
					<ul class="social-icons">
						<?php 
							$social_arr = jobzilla_author_social_arr(); 
							foreach($social_arr as $social_key => $social)
							{
								$social_link = jobzilla_get_super_user_data($social_key);
									
								if(!empty($social_link))
								{
									echo '<li class="wow fadeInRight" data-wow-duration="1.5s" data-wow-delay="1.0s"><a href="'.esc_url($social_link).'" target="'.$social_link_target.'" class="'.esc_attr($social['icon']).'"></a></li>';
								}							
							}
						?>
					</ul>
					
					<div class="twm-countdown-wrap">
						<div id="countdown-timer" data-endtime="<?php echo esc_attr($date); ?>"></div>
					</div>                
				</div>
            </div>
        </div>
    </div>
</div>  