<?php 
$img = $subscribe_element_image;
$form_img = $subscribe_element_subscribe_img;
$allowed_html_tags = jobzilla_allowed_html_tag();
$style = !empty($subscribe_element_style) ? $subscribe_element_style : 'style_1';
if($style == 'style_1'){ 
 ?>
<!-- SUBSCRIBE SECTION START -->
<div class="section-full twm-hpage-6-subs-wrap bg-cover " <?php if(!empty($img['id'])){ ?> style="background-image: url(<?php  echo esc_url($img['url']); ?>)" <?php } ?>>
	<div class="container">

		<div class="section-content">
			<div class="row">

				<div class="col-lg-7 col-md-12">
					<div class="twm-hpage-6-getintouch">
						<div class="callus-bg-box">
							<div class="callus-bg-box-shadow"></div>
						</div>
						<?php if(!empty($subscribe_element_title) || !empty($subscribe_element_subtitle)){ ?>
						<div class="twm-hpage-6-getintouch-title">
							<?php if(!empty($subscribe_element_subtitle)){ ?>
							<div class="wt-title-small"><?php echo wp_kses($subscribe_element_subtitle, $allowed_html_tags); ?></div>
							<?php } 
							if(!empty($subscribe_element_title)){ ?>
							<h2 class="wt-title">
							   <?php echo wp_kses($subscribe_element_title, $allowed_html_tags); ?>
							</h2>
							<?php } ?>
						</div>
						<?php } 
						if(!empty($subscribe_element_phone_number) || !empty($subscribe_element_email)|| !empty($subscribe_element_icon)){ ?>
						<div class="twm-hpage-6-callus">
							<?php if(!empty($subscribe_element_icon)){ ?> 
							<div class="callus-icon">
								<i class="<?php echo esc_attr($subscribe_element_icon['value']); ?>"></i>
							</div>
							<?php } ?>
							<div class="callus-content">
								<?php if(!empty($subscribe_element_phone_number)){ ?>
								<div class="callus-number"><?php echo esc_html($subscribe_element_phone_number); ?></div> 
								<?php }
								if(!empty($subscribe_element_email)){ ?>
								<div class="callus-email"><?php echo esc_html($subscribe_element_email); ?></div>
								<?php } ?>
							</div>
						</div>
						<?php } ?>
					</div>
				</div>

				<div class="col-lg-5 col-md-12">
				   <div class="twm-hpage-6-subscribe-wrap">
					   <div class="hpage-6-nw-form-corner-wrap">
							<div class="twm-hpage-6-subscribe">
								<?php if(!empty($subscribe_element_subscribe_subtitle)){ ?>
								<h3 class="twm-sub-title"><?php echo esc_html($subscribe_element_subscribe_subtitle); ?></h3>
								<?php }
								if(!empty($subscribe_element_subscribe_title)){ 
								?>
								<div class="twm-sub-discription">
									<?php echo wp_kses($subscribe_element_subscribe_title, $allowed_html_tags); ?>
								</div>
								<?php } ?>
								<form class="dzSubscribe dz-subscription" action="#" method="post">
									<div class="hpage-6-nw-form input-group">
										<input name="dzEmail" required="required" class="form-control" placeholder="<?php echo esc_attr__('Enter Your Email Address', 'jobzilla'); ?>" type="text">
										<button class="hpage-6-nw-form-btn"><i class="fa fa-paper-plane"></i></button>
									</div>
									<div class="dzSubscribeMsg dz-subscription-msg"></div>
								</form>
							</div>
							<div class="hpage-6-nw-form-corner"></div>
						</div>
				   </div>
				</div>

			</div>
		</div>
	   
	</div>
</div>
<!-- SUBSCRIBE SECTION END -->
<?php }elseif($style == 'style_2'){  ?>
<!-- Newsletter Subscriber SECTION START -->
<div class="section-full  p-t60 site-bg-white twm-new-sub-section-wrap site-bg-cover" <?php if(!empty($img['id'])){ ?> style="background-image: url(<?php  echo esc_url($img['url']); ?>)" <?php } ?>>
	
	<div class="container">
				
		<div class="section-content">
			<div class="row">
				<div class="col-lg-3 col-md-12">	
				</div>
				<div class="col-lg-6 col-md-12">
					<div class="twm-sub-2-section  site-bg-cover" <?php if(!empty($form_img['id'])){ ?> style="background-image: url(<?php  echo esc_url($form_img['url']); ?>)" <?php } ?>>
						<?php if(!empty($subscribe_element_subscribe_subtitle)){ ?>
						<h3 class="twm-sub-title"><?php echo esc_html($subscribe_element_subscribe_subtitle); ?></h3>
						<?php }
						if(!empty($subscribe_element_subscribe_title)){ 
						?>
						<div class="twm-sub-discription">
							<?php echo wp_kses($subscribe_element_subscribe_title, $allowed_html_tags); ?>
						</div>
						<?php } ?>
						<form class="dzSubscribe dz-subscription" action="#" method="post">
							<div class="form-group input-group">
								<input name="dzEmail" required="required" class="form-control" placeholder="<?php echo esc_attr__('Enter Your Email Address', 'jobzilla'); ?>" type="text">
							</div>
							<?php if(!empty($subscribe_element_subscribe_btn)){ ?>
							<button class="site-button twm-sub-btn white"><?php echo esc_html($subscribe_element_subscribe_btn); ?></button>
							<?php } ?>
							<div class="dzSubscribeMsg dz-subscription-msg"></div>
						</form> 
						<?php if(!empty($subscribe_element_item)){ 
							$count = 1
							?>
						<div class="twm-nl-map-media-wrap">
							<div class="twm-nl-map-pointer">
								<?php 
								$item_arr = $subscribe_element_item;
								foreach($item_arr as $item){
									if($count == 8){
										$count = 1;
									}
									$margin = '';
									if(!empty($item['margin_top'])){
										$margin .= 'top:'.$item['margin_top'].'%; ';
									}
									if(!empty($item['margin_left'])){
										$margin .= 'left:'.$item['margin_left'].'%; ';
									}
									if(!empty($item['margin_right'])){
										$margin .= 'right:'.$item['margin_right'].'%; ';
									}
									if(!empty($item['margin_bottom'])){
										$margin .= 'bottom:'.$item['margin_bottom'].'%; ';
									} 
									if(!empty($item['subscribe_element_item_image']['id'])){
								?>
									<div class="twm-nl-map-pic nw-pic<?php echo esc_attr($count) ?> bounce" <?php if(!empty($margin)){ ?>style="<?php echo esc_attr($margin); ?>"<?php } ?>>
										<img src="<?php echo esc_url($item['subscribe_element_item_image']['url']); ?>" alt="<?php echo esc_attr__('Image','jobzilla'); ?>"> 
									</div>
							<?php } 
								$count++;
							} ?>
							</div>
						</div>
					<?php } ?>
					</div>
				</div>
				<div class="col-lg-3 col-md-12">	
				</div>
			</div>
		</div>      
			
	</div>
</div>   
<!-- Newsletter Subscriber TABLE SECTION END -->
<?php }