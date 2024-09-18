<?php
	$jobzilla_option = getDZThemeReduxOption();
	$footer_bg_image = !empty($jobzilla_option['footer_bg_image']) ? $jobzilla_option['footer_bg_image'] : '';
	$footer_top_on = !empty($jobzilla_option['footer_top_on']) ? $jobzilla_option['footer_top_on'] : '';
	$show_social_icon = !empty($jobzilla_option['show_social_icon']) ? $jobzilla_option['show_social_icon'] : '';
	$footer_copyright_text = !empty($jobzilla_option['footer_copyright_text']) ? $jobzilla_option['footer_copyright_text'] : '';
	$footer_bottom_on = !empty($jobzilla_option['footer_bottom_on']) ? $jobzilla_option['footer_bottom_on'] : '';
?>
 <!-- NEWS LETTER SECTION START -->

<!-- NEWS LETTER SECTION END -->
  <footer class="dz-footer footer-light site-bg-cover" <?php if(!empty($footer_bg_image['url'])){ ?> style="background-image: url(<?php echo esc_url($footer_bg_image['url']); ?>);" <?php } ?>>
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
       