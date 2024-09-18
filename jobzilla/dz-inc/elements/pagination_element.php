<?php	
	$post_pagination	= jobzilla_dzbase()->get_meta('post_pagination');
	$pre_next_post_on = jobzilla_get_opt('pre_next_post_on',false);
	
	$post_pagination_view = 'With_Image';
	
	if($post_pagination && $pre_next_post_on) {
		
		$prev_post 		= get_previous_post();
		$next_post 		= get_next_post();
		
		if($post_pagination_view == 'With_Image')
		{
		?>
		<?php if (!empty( $prev_post ) || !empty( $next_post )) { ?>
		<div class="post-btn">
			<?php if (!empty( $prev_post )) { 
			
					$post_title = (has_post_thumbnail()) ? jobzilla_trim($prev_post->post_title, 5) : $prev_post->post_title;
			?>
			<div class="prev-post">
				<?php
					if(has_post_thumbnail($prev_post->ID))
					{ 
						echo get_the_post_thumbnail($prev_post->ID, 'jobzilla_100x100'); 
					}
				?>
				
				<h6 class="title">
					<a href="<?php echo esc_url(get_permalink($prev_post->ID)); ?>"><?php echo esc_html($post_title); ?></a><span class="post-date"><?php echo esc_html(get_the_date('',$prev_post->ID)); ?></span>
				</h6>
			</div>
			<?php }
				else
				{
					?>
					<div class="prev-post">
						<h6 class="start"><?php echo esc_html__('Start', 'jobzilla'); ?></h6>
					</div>
					<?php
				}
			?>
			
			<?php if (!empty( $next_post )) { 
					$post_title = (has_post_thumbnail()) ? jobzilla_trim($next_post->post_title, 5) : $next_post->post_title;	
			?>
				<div class="next-post">
					<h6 class="title">
						<a href="<?php echo esc_url(get_permalink($next_post->ID)); ?>"><?php echo esc_html($post_title); ?></a> <span class="post-date"><?php echo esc_html(get_the_date('',$next_post->ID)); ?></span>
					</h6>
					<?php
						if(has_post_thumbnail($next_post->ID)) 
						{ 
							echo get_the_post_thumbnail($next_post->ID, 'jobzilla_100x100'); 
						}
					?>
				</div>
			<?php } ?>
		</div>
		<?php } ?>
		<?php	
		}else{
			
			$total_post 	= wp_count_posts('post','readable');
?>

			<div class="pagination-bx d-flex align-items-center justify-content-between m-b50">
				<ul class="pagination-number"></ul>
				<div class="pagination-number">
					<?php if(!empty($prev_post)) { ?>
					<a href="<?php echo esc_url(get_permalink( $prev_post->ID )); ?>" class="prev-page"><i class="fa fa-long-arrow-left"></i> <?php echo esc_html__('Prev Post','jobzilla'); ?></a>
					<?php }else{ ?>
					<span  class="prev-page disabled"><i class="fa fa-long-arrow-left"></i> <?php echo esc_html__('Prev Post','jobzilla'); ?></span>
					<?php } ?>
					<?php if(!empty($next_post)) { ?>
					<a href="<?php echo esc_url(get_permalink( $next_post->ID) ); ?>" class="next-page"><?php echo esc_html__('Next Post','jobzilla'); ?> <i class="fa fa-long-arrow-right"></i></a>
					<?php }else{ ?>
					<span  class="next-page disabled"><i class="fa fa-long-arrow-right"></i> <?php echo esc_html__('Next Post','jobzilla'); ?></span>
					<?php } ?>
				</div>
			</div>
<?php 	} 
	}
?>