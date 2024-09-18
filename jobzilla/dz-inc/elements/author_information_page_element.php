<?php 
$author_box_on = jobzilla_get_opt('author_box_on',false); 
$description = nl2br(get_the_author_meta('description'));
$short_description = jobzilla_short_description($description, '', 20);
$email = get_the_author_meta('user_email', $post->post_author);
$avatar = get_avatar( $email, 200 );
if($author_box_on) {
?>

	<div class="author-box blog-user m-b60">
		<div class="author-profile-info">
			<div class="author-profile-pic">
				<img src="<?php echo esc_url( get_avatar_url(get_the_author_meta('email'),array('size'=>100)) ); ?>" alt="<?php esc_attr_e('Profile Pic', 'jobzilla');?>" />
			</div>
			<div class="author-profile-content">
				<h6><?php echo ucwords(get_the_author_meta('display_name'));?></h6>
				<p><?php echo wp_kses($short_description, jobzilla_allowed_html_tag());?></p>
				
				<div class="dz-social-icon primary-light">
					<ul>
						<?php
						$author_social_arr = jobzilla_author_social_arr();
						
						foreach($author_social_arr as $social_key => $social_value)
							{ 
								$social_url = jobzilla_get_super_user_data($social_key);
								if(!empty($social_url))
								{
								?>
							<li>
								<a href="<?php echo esc_url($social_url);?>" target="_blank" class="<?php echo esc_attr($social_value['icon']); ?>">
								</a>
							</li>
						<?php 	} 
							}
						?>
					</ul>
				</div>
			</div>
		</div>
	</div>

<?php } ?>