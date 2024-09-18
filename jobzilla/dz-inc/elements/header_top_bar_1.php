<?php
	$jobzilla_option = getDZThemeReduxOption();
	$header_top_bar_on = !empty($jobzilla_option['header_top_bar_on']) ? $jobzilla_option['header_top_bar_on'] : '';
	$site_email = !empty($jobzilla_option['site_email']) ? $jobzilla_option['site_email'] : '';
	$site_address = !empty($jobzilla_option['site_address']) ? $jobzilla_option['site_address'] : '';
	$header_social_link_on = !empty($jobzilla_option['header_social_link_on']) ? $jobzilla_option['header_social_link_on'] : '';
	$show_social_icon = !empty($jobzilla_option['show_social_icon']) ? $jobzilla_option['show_social_icon'] : '';
	$show_login_registration = !empty($jobzilla_option['show_login_registration']) ? $jobzilla_option['show_login_registration'] : '';
	$header_login_on = !empty($jobzilla_option['header_login_on']) ? $jobzilla_option['header_login_on'] : '';
	$header_register_on = !empty($jobzilla_option['header_register_on']) ? $jobzilla_option['header_register_on'] : '';
?>
<?php if($header_top_bar_on) { ?>
    <div class="top-bar">
        <div class="container">
            <div class="dz-topbar-inner d-flex justify-content-between align-items-center">
                <div class="dz-topbar-left">
                    <?php if(!empty($site_email) || !empty($site_address)) {?>
                    <ul>
                        <?php if(!empty($site_address)) { ?>
                            <li><i class="fas fa-map-marker-alt"></i> <?php echo wp_kses($site_address, 'string');?></li>
                        <?php }?>
                        <?php if(!empty($site_email)) { ?>
                            <li><i class="fas fa-envelope"></i> <?php echo wp_kses($site_email, 'string');?></li>
                        <?php }?>
                    </ul>
                    <?php }?>
                </div>

                <div class="dz-topbar-right">
                    <?php if($header_social_link_on && $show_social_icon){ ?>
                        <ul class="dz-social">
                            <?php echo jobzilla_get_social_icons('header') ;?>
                        </ul>
                    <?php } ?>  

					<?php if(!is_user_logged_in() && get_option( 'users_can_register' ) && $show_login_registration) { ?>
    					<ul>
    						<?php if( $header_login_on ) { ?>
    							<li><a class="" href="<?php echo esc_url(wp_login_url());?>"><?php echo esc_html__('Sign In', 'jobzilla'); ?></a> </li>
    						<?php } ?>	
                            
    						<?php if( $header_register_on ) { ?>
    							<li><a class="" href="<?php echo esc_url(home_url('/wp-login.php?action=register'));?>"><?php echo esc_html__('Sign Up', 'jobzilla'); ?></a></li>
    						<?php } ?>		
    					</ul>
					<?php } ?>	
                </div>
            </div>
        </div>
    </div>
<?php } ?>