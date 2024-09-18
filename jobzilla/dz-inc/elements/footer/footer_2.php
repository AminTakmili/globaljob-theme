<?php
	$jobzilla_option = getDZThemeReduxOption();
	$footer_bg_image = !empty($jobzilla_option['footer_bg_image']) ? $jobzilla_option['footer_bg_image'] : '';
	$footer_subscribe_on = !empty($jobzilla_option['footer_subscribe_on']) ? $jobzilla_option['footer_subscribe_on'] : '';
	$footer_subscribe_text = !empty($jobzilla_option['footer_subscribe_text']) ? $jobzilla_option['footer_subscribe_text'] : '';
	$footer_top_on = !empty($jobzilla_option['footer_top_on']) ? $jobzilla_option['footer_top_on'] : '';
	$show_social_icon = !empty($jobzilla_option['show_social_icon']) ? $jobzilla_option['show_social_icon'] : '';
	$footer_copyright_text = !empty($jobzilla_option['footer_copyright_text']) ? $jobzilla_option['footer_copyright_text'] : '';
	$footer_bottom_on = !empty($jobzilla_option['footer_bottom_on']) ? $jobzilla_option['footer_bottom_on'] : '';
?>
 <!-- NEWS LETTER SECTION START -->

<!-- NEWS LETTER SECTION END -->
  <footer class="dz-footer footer-light site-bg-cover" <?php if(!empty($footer_bg_image['url'])){ ?> style="background-image: url(<?php echo esc_url($footer_bg_image['url']); ?>);" <?php } ?>>
<?php if(!empty($footer_subscribe_on)){ ?>
				<div class="ftr-nw-content  ">
				
					<div class="container">
						<div class="row align-items-center">
							<div class="col-md-5">
								<div class="ftr-nw-title my-md-0 mb-sm-4">
									<?php echo esc_html($footer_subscribe_text); ?>
								</div>
							</div>
							<div class="col-md-7">
								<form class="dzSubscribe dz-subscription" action="#" method="post">	
									<div class="ftr-nw-form input-group">
										<input name="dzEmail" required="required"  class="form-control" placeholder="<?php echo esc_attr__('Enter Your Email Address...','jobzilla'); ?>" type="email">
										<button class="ftr-nw-subcribe-btn site-button"><?php echo esc_html__('Subscribe Now','jobzilla') ?></button>
									</div>
									<div class="dzSubscribeMsg dz-subscription-msg"></div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<?php } ?>
            <div class="container">
                <!-- FOOTER BLOCKES START --> 
				<?php if ( is_active_sidebar( 'dz_footer_sidebar2' ) && !empty($footer_top_on)) { ?>				
                <div class="footer-top">
				 
                    <div class="row">
							<?php dynamic_sidebar( 'dz_footer_sidebar2' );  ?>	
					</div> 
				
				</div>
				<?php } 
				$class = empty($show_social_icon)? 'justify-content-center':'';
				?>
			<div class="footer-bottom">
				<div class="footer-bottom-info <?php echo esc_attr($class); ?>">
					<?php if(!empty($footer_bottom_on)){ ?>
						<div class="footer-copy-right">
							<span class="copyrights-text">
								<?php echo wp_kses($footer_copyright_text, jobzilla_allowed_html_tag());?>
							</span>
						</div>
					<?php } ?>
					<?php if($show_social_icon){ ?>
					<ul class="social-icons">
						<?php echo jobzilla_get_social_icons() ;?>
					</ul>  
					<?php } ?>
				</div> 
		
			</div>
	</div>	

</footer>
       