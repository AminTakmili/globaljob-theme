<?php 
$tag_on = jobzilla_get_opt('tag_on',true); 
if($tag_on && has_tag()) {  ?>
<span class="title"><?php echo esc_html__('Tags','jobzilla') ?> : &nbsp;</span>
<ul class="tag-list">
	<?php  
		$tags = '';
		$tag_list = wp_list_pluck(get_the_tags(),'name','term_id');
		foreach($tag_list as $tag_id => $tag_name)
		{
			$tags .='<li class="post-tag">
						<a href="'.get_tag_link($tag_id).'">#'.$tag_name.'</a>
					</li>'; 
		}
		echo wp_kses($tags, jobzilla_allowed_html_tag());
	?>
</ul>
<?php } ?>