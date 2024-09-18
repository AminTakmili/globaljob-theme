<div class="header-blog-carousel owl-carousel owl-btn-center-lr">
<?php 
$jobzilla_options = jobzilla_dzbase()->option();
while($query->have_posts()){
		$query->the_post();
		
		$post_title = (has_post_thumbnail()) ? jobzilla_trim(get_the_title(), 4) : get_the_title();
		
		$no_image_class = '';
		if(!has_post_thumbnail())
		{
			$no_image_class = 'no-image-box';	
		}	
?>
		<div class="item <?php echo esc_attr($no_image_class); ?>">
			<div class="blog-post blog-sm">
			<?php if(has_post_thumbnail()) { ?>
				<div class="dlab-post-media">
					<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('medium'); ?> </a>
				</div>					
			<?php } ?>
				<div class="dlab-post-info">
					<div class="dlab-post-title">
						<h5 class="post-title"><a href="<?php the_permalink(); ?>"><?php echo esc_html($post_title); ?></a></h5>
					</div>
					<div class="date"><?php echo esc_html(get_the_date()); ?></div>
				</div>
			</div>
		</div>
		
	<?php	} ?>
</div>	