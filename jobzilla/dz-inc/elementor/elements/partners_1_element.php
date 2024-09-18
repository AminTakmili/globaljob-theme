<?php 
if($partners_1_element_style=='style_1'){ ?>

	<!-- TOP COMPANIES START -->
	<div class="section-full content-inner-1 site-bg-white">
		<?php if(!empty($partners_1_element_title) || !empty($partners_1_element_subtitle)){ ?>
			<!-- TITLE START-->
			<div class="section-head center wt-small-separator-outer">
				<?php if(!empty($partners_1_element_subtitle)){ ?>
					<div class="wt-small-separator site-text-primary">
					   <div>
							<?php echo wp_kses($partners_1_element_subtitle, 'string'); ?>
					   </div>                                
					</div>
				<?php } ?>

				<?php if(!empty($partners_1_element_title)){ ?>
					<h2 class="wt-title">
						<?php echo wp_kses($partners_1_element_title, 'string'); ?>
					</h2>
				<?php } ?>
			</div>                  
			<!-- TITLE END--> 
		<?php } ?>

		<?php if(!empty($partners_1_element_item)){
			$item_arr = $partners_1_element_item;

		?>  
			<div class="container">
				<div class="section-content">
					<div class="owl-carousel home-client-carousel2 owl-btn-vertical-center">
						<?php foreach($item_arr as $itemKey => $itemValue) { ?>
							<div class="item">
								<div class="ow-client-logo">
									<div class="client-logo client-logo-media">
										<?php if($partners_1_element_disable_link=='yes'){ ?>
											<img src="<?php echo esc_url($itemValue['partners_1_element_item_image']['url']) ?>" alt="<?php echo esc_attr__('image', 'jobzilla'); ?>">
										<?php } else { ?>
											<a href="<?php echo esc_url($itemValue['partners_1_element_item_link']); ?>"><img src="<?php echo esc_url($itemValue['partners_1_element_item_image']['url']) ?>" alt="<?php echo esc_attr__('image', 'jobzilla'); ?>"></a>
										<?php } ?>
									</div>
								</div>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
		<?php } ?>
	</div>
	<!-- TOP COMPANIES END -->
<?php } elseif($partners_1_element_style=='style_2'){ ?>
	<!-- TOP COMPANIES START -->
	<div class="section-full content-inner site-bg-gray">
		<?php if(!empty($partners_1_element_title) || !empty($partners_1_element_subtitle)){ ?>
			<!-- TITLE START-->
			<div class="section-head center wt-small-separator-outer">
				<?php if(!empty($partners_1_element_subtitle)){ ?>
					<div class="wt-small-separator site-text-primary">
					   <div>
							<?php echo wp_kses($partners_1_element_subtitle, 'string'); ?>
					   </div>                                
					</div>
				<?php } ?>

				<?php if(!empty($partners_1_element_title)){ ?>
					<h2 class="wt-title">
						<?php echo wp_kses($partners_1_element_title, 'string'); ?>
					</h2>
				<?php } ?>
			</div>                  
			<!-- TITLE END--> 
		<?php } ?>

		<?php if(!empty($partners_1_element_item)){
			$item_arr = $partners_1_element_item;
		?>  
			<div class="container">
				<div class="section-content">
					<div class="owl-carousel home-client-carousel4 owl-btn-vertical-center">
						<?php foreach($item_arr as $itemKey => $itemValue) { ?>
							<div class="item">
								<div class="ow-client-logo">
									<div class="client-logo client-logo-media">
										<?php if($partners_1_element_disable_link=='yes'){ ?>
											<img src="<?php echo esc_url($itemValue['partners_1_element_item_image']['url']) ?>" alt="<?php echo esc_attr__('image', 'jobzilla'); ?>">
										<?php } else { ?>
											<a href="<?php echo esc_url($itemValue['partners_1_element_item_link']); ?>"><img src="<?php echo esc_url($itemValue['partners_1_element_item_image']['url']) ?>" alt="<?php echo esc_attr__('image', 'jobzilla'); ?>"></a>
										<?php } ?>
									</div>
								</div>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
		<?php } ?>
	</div>
	<!-- TOP COMPANIES END -->
<?php } ?>