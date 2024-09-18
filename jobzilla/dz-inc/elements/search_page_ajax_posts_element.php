<div class="loadmore-content" >					
	<?php 	
		$jobzilla_query_result = array();	
		$page_view = 'search';
		$page_no = 1;		
		$no_of_posts_per_page = get_option('posts_per_page');		
		$search_keyword = $queried_object_data->query_vars['s'];
		
		
		/* Post Sorting */
		$sorting_on = jobzilla_get_opt('search_page_sorting_on');	  
		$orderby = $order = '';
	  
		if($sorting_on){
			$sorting	= jobzilla_get_opt('search_page_sorting');
			  
			if($sorting	== 'most_visited')
			{
				$query_args['meta_key']	= '_views_count';
				$order 		= 'DESC';
				$orderby 	= '_views_count';
			}else{
				$sort_arr	= explode('_',$sorting);
				$orderby 	= !empty($sort_arr[0]) ? $sort_arr[0]:'date';
				$order 		= !empty($sort_arr[1]) ? $sort_arr[1]:'DESC';	
			  }
		}else{
		  $orderby = 'date';
		  $order = 'DESC';
		}
			
		if(!empty($orderby) && $orderby != '_views_count'){
			$query_args['orderby'] = $orderby;
		}
		
		$query_args['order'] = $order; 
		/* Post Sorting END */
	
		$query_args = array(	
			'post_type' 		=> 'post',
			'post_status' 		=> 'publish',		
			'posts_per_page'   	=> $no_of_posts_per_page ,	
			'paged' 			=> $page_no,	
			'orderby' 			=> $orderby,
			'order' 			=> $order,
			's'					=> $search_keyword,
		);									

		$query = new WP_Query($query_args);	

		$max_num_pages = $query->max_num_pages;		
		set_query_var('jobzilla_query_result', $query);
		
		get_template_part('dz-inc/ajax/search_ajax'); 
	?>
</div>

<?php if( 1 < $max_num_pages ) { ?>
	<!-- Pagination start -->
	<div class="reload-btn text-center mb-4">
		<a href="javascript:void(0);" class="btn loadmore-btn site-button btn-primary common-page-dz-load-more dz-load-more"  data-object-data = "<?php echo esc_js($search_keyword);?>" 
			data-common-page-view = "<?php echo esc_js($page_view);?>" 
			data-posts-per-page="<?php echo esc_js($no_of_posts_per_page);?>" 
			data-max-num-pages="<?php echo esc_js($max_num_pages);?>" 
			data-orderby="<?php echo esc_js($orderby);?>"
			data-order="<?php echo esc_js($order);?>"
		>
			<?php echo esc_html__('Load More', 'jobzilla'); ?> 
			<i class="fa fa-refresh fa-spin"></i>
		</a>
	</div>
	<!-- Pagination End -->
<?php } 
wp_reset_postdata();