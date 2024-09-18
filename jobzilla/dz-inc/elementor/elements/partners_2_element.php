<?php $allowed_html_tags = jobzilla_allowed_html_tag();  ?>
<!-- GET JOBS SECTION START -->
<div class="section-full site-bg-white h-page6-getjobs-wrap ">
	<?php if(!empty($partners_2_element_item_slider)){ ?>
	<div class="h-page6-client-slider-outer">
		<div class="container">
			<div class="h-page6-client-slider">
				<div class="row">
					<div class="col-xl-4 col-lg-12">
					<?php if(!empty($partners_2_element_item_title)){ ?>
						<div class="h-page-6-client-slide-title">
							<?php echo wp_kses($partners_2_element_item_title, $allowed_html_tags); ?>
						</div>
					<?php } ?>
					</div>
					<?php if(!empty($partners_2_element_item)){ 
						$arr_item = $partners_2_element_item;
					?>
					<div class="col-xl-8 col-lg-12">
						<div class="owl-carousel home-client-carousel6 owl-btn-vertical-center">
							<?php 
							foreach($arr_item as $item){ 
							if(!empty($item['partners_2_element_item_link']) && !empty($item['partners_2_element_item_image']['id'])){
							?>
							<div class="item">
								<div class="ow-client-logo">
									<div class="client-logo client-logo-media">
									<a href="<?php echo esc_url($item['partners_2_element_item_link']); ?>"><img src="<?php echo esc_url($item['partners_2_element_item_image']['url']); ?>" alt="Image"></a></div>
								</div>
							</div>
							<?php }
							} ?>
						</div>
					</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
	<?php } ?>
	<div class="container">
		<div class="h-page-6-getjobs-wrap content-inner">
			<div class="row">
				
				<div class="col-lg-7 col-md-12">
					<div class="h-page-6-getjobs-left">
					<div class="twm-media">
						<img src="<?php echo esc_url($partners_2_element_image['url']); ?>" alt="Image">
						<div class="twm-media-bg-circle"></div>
						<div class="twm-media-bg-circle2"></div>
						<div class="twm-media-bg-circle3">
							<div class="rotate-center">
								<span class="ring1"></span>
								<span class="ring2"></span>
								<span class="ring3"></span>
							</div>
						</div>
					</div>
					</div> 
				</div>
				<div class="col-lg-5 col-md-12">
					<div class="h-page-6-getjobs-right">
						<!-- TITLE START-->
						<div class="section-head left wt-small-separator-outer">
							<?php if(!empty($partners_2_element_subtitle)){ ?>
							<div class="wt-small-separator site-text-primary">
								<?php echo wp_kses($partners_2_element_subtitle, $allowed_html_tags); ?>
							</div>
							<?php } 
							if(!empty($partners_2_element_title)){ ?>
							<h2 class="wt-title">
								<?php echo wp_kses($partners_2_element_title, $allowed_html_tags); ?>
							</h2>
							<?php }
							if(!empty($partners_2_element_description)){ 
								echo wp_kses($partners_2_element_description, $allowed_html_tags); 
							} ?>
						</div>
						<!-- TITLE END-->
						<?php if(!empty($partners_2_element_btn_text) && !empty($partners_2_element_btn_link)){ ?>
						<div class="twm-read-more">
							<a href="<?php echo esc_url($partners_2_element_btn_link); ?>" class="site-button"><?php echo esc_html($partners_2_element_btn_text); ?></a>
						</div>               
						<?php } ?>
					</div>
				</div>

			</div>
		</div>
	</div>
	
</div>   
<!-- GET JOBS SECTION SECTION END -->
