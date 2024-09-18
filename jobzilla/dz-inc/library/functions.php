<?php	
	function jobzilla_dzbase()
	{
		return $GLOBALS['_dz_base'];
	}
	
	/** A function to fetch the categories from wordpress */
	function jobzilla_get_categories($arg = false)
	{	
		global $wp_taxonomies;		

		$jobzilla_categories_default_args = array(	
				'orderby'            => 'ID',
				'order'              => 'ASC',				
				'hide_empty'         => 1,				
				'hierarchical'       => true,				
		  );
		
		if( ! empty($arg['taxonomy']) && isset($wp_taxonomies[$arg['taxonomy']]) )
		{
			$jobzilla_categories_default_args['taxonomy'] = $arg['taxonomy'];
		}
		
		$categories = get_categories($jobzilla_categories_default_args);		
		$cats = array();
		
		if( !is_wp_error( $categories ) ) {
			foreach($categories as $category)
			{
				$cats[$category->slug] = wp_kses($category->name,'string');				
			}
		}
		return $cats;
	}
	
	function jobzilla_get_the_breadcrumb()
	{	
		global $wp_query;
		
		$queried_object = get_queried_object();		
		$breadcrumb = '';
		$delimiter = ' ';
		$before = '<li>';
		$after = '</li>';
		if( ! is_home())
		{
			$breadcrumb .= '<li class="breadcrumb-item"><a href="'.esc_url(home_url('/')).'"> '.esc_html__('Home', 'jobzilla').'</a></li>';
			
			/** If category or single post */
			if(is_category())
			{
				$cat_obj = $wp_query->get_queried_object();
				$this_category = get_category( $cat_obj->term_id );
		
				if ( $this_category->parent != 0 ) {
					$parent_category = get_category( $this_category->parent );
					$parent_string = get_category_parents($parent_category, TRUE, '@');			
					$parent_tree = explode('@',$parent_string);
					$parent_tree = array_filter($parent_tree);
					foreach($parent_tree as $cat_link)
					{
						$breadcrumb .= '<li class="breadcrumb-item">'. wp_kses($cat_link, jobzilla_allowed_html_tag()) .'</li>';	
					}	
				}				
				$single_cat_title = single_cat_title('', FALSE);				
				$breadcrumb .= '<li class="breadcrumb-item">'. wp_kses($single_cat_title, jobzilla_allowed_html_tag()).'</li>';
			}
			elseif(is_tax())
			{
				$term_link = !empty($queried_object)?get_term_link($queried_object):'';
				$term_name = !empty($queried_object->name)?$queried_object->name:'';				
				$breadcrumb .= '<li class="breadcrumb-item"><a href="'.esc_url($term_link).'">'.wp_kses($term_name, jobzilla_allowed_html_tag()) .'</a></li>';
			}
			elseif(is_page()) /** If WP pages */
			{
				global $post;
				
				if($post->post_parent)
				{
					$anc = get_post_ancestors($post->ID);
					foreach($anc as $ancestor)
					{
						$perma_link = get_permalink($ancestor);
						$ancestor_title = get_the_title($ancestor);
						$post_title = get_the_title($post->ID);						
						$breadcrumb .= '<li class="breadcrumb-item"><a href="'.esc_url($perma_link).'">'. wp_kses($ancestor_title, jobzilla_allowed_html_tag()) .'</a></li>';
					}
					$breadcrumb .= '<li class="breadcrumb-item">'. wp_kses($post_title,'string') .'</li>';
					
				}else{
					$post_title = get_the_title();
					$breadcrumb .= '<li class="breadcrumb-item">'. wp_kses($post_title,'string') .'</li>';
				}
			}
			elseif (is_singular())
			{
				
				if($category = wp_get_object_terms(get_the_ID(), 'category'))
				{
					if( !is_wp_error($category) )
					{
						$term_link = get_term_link(jobzilla_set($category, '0'));
						$name = jobzilla_set( jobzilla_set($category, '0'), 'name');
						$title = get_the_title();						
						$breadcrumb .= '<li class="breadcrumb-item"><a href="'.esc_url($term_link).'">'. wp_kses($name, jobzilla_allowed_html_tag()) .'</a></li>';
						$breadcrumb .= '<li class="breadcrumb-item">'. wp_kses($title,'string') .'</li>';					
						} else{
						$title = get_the_title();
						$breadcrumb .= '<li class="breadcrumb-item">'. wp_kses($title,'string') .'</li>';
					}
				}else{
					$title = wp_title('',false);
					$breadcrumb .= '<li class="breadcrumb-item">'. wp_kses($title,'string') .'</li>';
				}
			}
			elseif(is_tag()){
				$term_link = get_term_link($queried_object);
				$title = single_tag_title('', FALSE);				
				$breadcrumb .= '<li class="breadcrumb-item"><a href="'.esc_url($term_link).'">'. wp_kses($title,'string') .'</a></li>'; /**If tag template*/
			}
			elseif(is_day()){
				$time = get_the_time('F jS, Y');				
				$breadcrumb .= '<li class="breadcrumb-item"><a href="#">'.esc_html__('Archive for ', 'jobzilla').wp_kses($time,'string').'</a></li>'; /** If daily Archives */
			}
			elseif(is_month()){
				$link = get_month_link(get_the_time('Y'), get_the_time('m'));
				$time = get_the_time('F, Y');				
				$breadcrumb .= '<li class="breadcrumb-item"><a href="' .esc_url($link) .'">'.esc_html__('Archive for ', 'jobzilla'). wp_kses($time,'string') .'</a></li>'; /** If montly Archives */
			}
			elseif(is_year()){
				$link = get_year_link(get_the_time('Y'));
				$time = get_the_time('Y');	
				$breadcrumb .= '<li class="breadcrumb-item"><a href="'.esc_url($link).'">'.esc_html__('Archive for ', 'jobzilla'). wp_kses($time,'string') .'</a></li>'; /** If year Archives */
			}
			elseif(is_author()){
				$link = get_author_posts_url( get_the_author_meta( "ID" ) );
				$author = get_the_author();
				$breadcrumb .= '<li class="breadcrumb-item"><a href="'. esc_url( $link ) .'">'.esc_html__('Archive for ', 'jobzilla'). wp_kses($author,'string') .'</a></li>'; /** If author Archives */
			}
			elseif(is_search()){
				$search_query = get_search_query();
				$breadcrumb .= '<li class="breadcrumb-item">'.esc_html__('Search Results for ', 'jobzilla'). wp_kses($search_query, jobzilla_allowed_html_tag()) .'</li>'; /** if search template */
			}
			elseif(is_404()){
				$breadcrumb .= '<li class="breadcrumb-item">'.esc_html__('404 - Not Found', 'jobzilla').'</li>'; /** if search template */			
			}elseif(is_shop()){
				$term_name = !empty(jobzilla_get_opt('woocommerce_page_title'))?jobzilla_get_opt('woocommerce_page_title'):get_the_title(wc_get_page_id( 'shop' ));
				$breadcrumb .= '<li class="breadcrumb-item"><a href="javascript:void(0)">'.wp_kses($term_name,'string') .'</a></li>'; /** if search template */			
			}
			elseif(is_archive()){
				$breadcrumb .= '<li class="breadcrumb-item"><a href="javascript:void(0)">'.  wp_title('',false) .'</a></li>';
			}else{
			
				$link = get_permalink();
				$title = get_the_title();
				if(!empty($title))
				{	
					$breadcrumb .= '<li class="breadcrumb-item"><a href="'.esc_url($link).'">'. esc_html($title) .'</a></li>'; /** Default value */
				}
			}
			
			/* To hide if only one li is available */
			if(substr_count($breadcrumb,'<li class="breadcrumb-item">') <= 1)
			{
				$breadcrumb = '';
			}
		}
		
		if(!empty($breadcrumb)){
			$breadcrumb = '<ul class="breadcrumb shadow-lg">'.$breadcrumb.'</ul>';
		}
		
		return $breadcrumb;
	}

	function jobzilla_bunch_list_comments($comment, $args, $depth)
	{
		$GLOBALS['comment'] = $comment; 
		$email = jobzilla_set( $comment, 'comment_author_email' );		
		$avatar = get_avatar( $email, 130 );
		$comment_id = get_comment_ID();
		$author_link = get_comment_author($comment_id);
		$comment_date_link = get_month_link(get_the_date('Y'), get_the_date('m'));
		$comment_date = get_comment_date('F j, Y', $comment_id);				
		?>		
		<li <?php comment_class('comment');?> id="comment-<?php comment_ID(); ?>">
		<div class="comment-body" id="div-comment-<?php comment_ID(); ?>">
			<div class="comment-author vcard">
				<?php echo wp_kses($avatar, jobzilla_allowed_html_tag()); ?>
			
				<cite class="fn">
					<?php echo wp_kses($author_link, jobzilla_allowed_html_tag()); ?>
				</cite> 
				
				<span class="says">
					<?php esc_html_e('says:', 'jobzilla');?>
				</span> 
			</div>
			
			<div class="comment-content dz-page-text">
				<?php comment_text();?>
			</div>	
			
			<div class="reply"> 
				<?php 
					comment_reply_link(
							array_merge(
								$args,
								array(
								'depth' => $depth,
								'max_depth' => $args['max_depth'],
								'reply_text' => '<i class="fa fa-reply"></i>' .esc_html__('Reply', 'jobzilla'),
								'add_below' => 'div-comment',
							)
						)
					); 
				?>
			</div>
		</div>				
		<?php	
	}
	
	add_filter( 'comment_form_defaults', 'jobzilla_move_comment_field' );	
	function jobzilla_move_comment_field( $input )
	{
		if ( 'comment_form_defaults' === current_filter() && !is_user_logged_in())
		{
			// Copy the field to our internal variable …
			$textarea = $input['comment_field'];
			$input['comment_field'] = '';
			// … and remove it from the defaults array.
			$input['fields']['comment_field'] = $textarea;
			
			
		}
		
		return $input;
	} 
	
	/**
	 * returns the formatted form of the comments
	 *
	 * @param	array	$args		an array of arguments to be filtered
	 * @param	int		$post_id	if form is called within the loop then post_id is optional
	 *
	 * @return	string	Return the comment form
	 */
	function jobzilla_comment_form( $args = array(), $post_id = null, $review = false )
	{
		if ( null === $post_id )
		{$post_id = get_the_ID();}
		else
		{$id = $post_id;}
		$commenter = wp_get_current_commenter();
		$user = wp_get_current_user();
		$user_identity = $user->exists() ? $user->display_name : '';
		$args = wp_parse_args( $args );
		if ( ! isset( $args['format'] ) ){
			$args['format'] = current_theme_supports( 'html5', 'comment-form' ) ? 'html5' : 'xhtml';
		}
		$req      = get_option( 'require_name_email' );
		$aria_req = ( $req ? " aria-required='true'" : '' );
		$html5    = 'html5' === $args['format'];
		$fields   =  array(
			'author' => '<p class="comment-form-author"><input id="name" placeholder="'. esc_attr__( 'Author', 'jobzilla' ).'"  name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" ' . $aria_req . ' /></p>',
			'email'  => ' <p class="comment-form-email"><input id="email" required placeholder="'. esc_attr__( 'Email', 'jobzilla' ).'" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" ' . $aria_req . ' /></p>',
		);
		$required_text = sprintf( ' ' . esc_html__('Required fields are marked %s', 'jobzilla'), '<span class="required">*</span>' );
		/**
		 * Filter the default comment form fields.
		 *
		 * @since 3.0.0
		 *
		 * @param array $fields The default comment fields.
		 */
		$jobzilla_col = (is_user_logged_in()) ? 'col-md-12': ''; 
		$fields = apply_filters( 'comment_form_default_fields', $fields );
		$defaults = array(
			'fields'               => $fields,
			'comment_field'        => '<p class="comment-form-comment"><textarea id="comments" placeholder="'. esc_attr__( 'Type Comment Here', 'jobzilla' ).'" class="form-control4" name="comment" cols="45" rows="3" aria-required="true" required="required"></textarea></p>',
			'must_log_in'          => '<p class="col-md-12 col-sm-12">' . sprintf(__( 'You must be <a href="%s">logged in</a> to post a comment.', 'jobzilla' ), esc_url(wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) ) . '</p>',
			'logged_in_as'         => '<p class="col-md-12 col-sm-12">' . sprintf(__( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="'.esc_attr__('Log out of this account','jobzilla').'">'.esc_html__('Log out?','jobzilla').'</a>', 'jobzilla' ), get_edit_user_link(), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
			'comment_notes_before' => '',
			'comment_notes_after'  => '',
			'id_form'              => 'comments_form',
			'id_submit'            => 'submit',
			'class_submit'         => esc_attr__('site-button', 'jobzilla' ),
			'title_reply'          => esc_html__( 'Leave Comment', 'jobzilla' ),
			'title_reply_to'       => esc_html__( 'Leave a Reply to %s', 'jobzilla' ),
			'cancel_reply_link'    => esc_html__( 'Cancel reply', 'jobzilla' ),
			'label_submit'         => esc_html__( 'Submit Now ', 'jobzilla' ),
			'title_reply_before'   => '<h4 class="comment-reply-title">',
        	'title_reply_after'    => '</h4>',
			'format'               => 'xhtml',
		);
		/**
		 * Filter the comment form default arguments.
		 *
		 * Use 'comment_form_default_fields' to filter the comment fields.
		 *
		 * @since 3.0.0
		 *
		 * @param array $defaults The default comment form arguments.
		 */
		$args = wp_parse_args( $args, apply_filters( 'comment_form_defaults', $defaults ) );
			
			if ( comments_open( $post_id ) ) : ?>
				<?php
				/**
				 * Fires before the comment form.
				 *
				 * @since 3.0.0
				 */
				do_action( 'comment_form_before' );
				?>					
				<div id="respond" class="default-form comment-respond style-1 m-b30">
					<?php if ( get_option( 'comment_registration' ) && !is_user_logged_in() ) : ?>
						<?php echo wp_kses($args['must_log_in'], jobzilla_allowed_html_tag()); ?>
						<?php
						/**
						 * Fires after the HTML-formatted 'must log in after' message in the comment form.
						 *
						 * @since 3.0.0
						 */
						do_action( 'comment_form_must_log_in_after' );
						?>
					<?php else : ?>
          				<div class="clearfix">
							<?php 
								echo comment_form($args, $post_id); 
							?>
						</div>
					<?php endif; ?>
				</div><!-- #respond -->
				<?php
				/**
				 * Fires after the comment form.
				 *
				 * @since 3.0.0
				 */
				do_action( 'comment_form_after' );
			else :
				/**
				 * Fires after the comment form if comments are closed.
				 *
				 * @since 3.0.0
				 */
				do_action( 'comment_form_comments_closed' );
			endif;
	}

	function jobzilla_the_pagination($query = array(), $args = array(), $echo = 1)
	{
		global $wp_query;
		
		
		if(!empty($query))
		{ 
			$temp_query = $wp_query;
			$wp_query   = NULL;
			$wp_query   = $query;
		}
		
		$paged = get_query_var('paged');
		
		$default =  array(
			'base' => str_replace( 99999, '%#%', esc_url( get_pagenum_link( 99999 ) ) ), 
			'format' => '?paged=%#%', 
			'current' => max( 1, $paged ),
			'total' => $wp_query->max_num_pages, 
			'prev_text' =>'<i class="fas fa-chevron-left"></i>', 
			'next_text' =>'<i class="fas fa-chevron-right"></i>',
			'type'=>'list',
			'add_args' => false,			
		);

		$args = wp_parse_args($args, $default);	
		$pagination_link = !empty(paginate_links($args))?paginate_links($args):'';
		$pagination = str_replace("<ul class='page-numbers'", '<ul class="pagination text-center p-t20 style-1 m-b30"', $pagination_link );		
	    $pagination = $pagination;		
	
		echo wp_kses($pagination, jobzilla_allowed_html_tag());
	}			
	
	function jobzilla_trim( $text, $len, $more = null )
	{	
		$text = apply_filters( 'the_content', $text ); //strip_shortcodes( $text );	
		$text = str_replace(']]>', ']]&gt;', $text);	
		$excerpt_length = apply_filters( 'excerpt_length', $len );	/* Issue Remaining */
		$excerpt_more = apply_filters( 'excerpt_more', ' ' . '[&hellip;]' );	
		$excerpt_more = ( $more ) ? $more : '.';	
		$text = wp_trim_words( $text, $len, $excerpt_more );
		
		return $text;	
	}
	
	/**
	*
	* Excerpt More Settings
	*
	*/
	function jobzilla_excerpt_more()
	{
		return ' ';
	}
	add_filter('excerpt_more', 'jobzilla_excerpt_more');
  
	/* Used on footer and header area */
	/* Used on footer and header area */
	function jobzilla_get_social_icons($show_position = 'all',$default_class='')
	{	
		$options = jobzilla_dzbase()->option();
		
		$output = '';			
		$target = $options['social_link_target'];
		$social_link_options = jobzilla_social_link_options();
		
		if($show_position == 'header')
		{
			
			/*reCheck function and rebuild it for fast performance */
			
			global $jobzilla_option;
			$header_social_links = jobzilla_set($jobzilla_option,'header_social_links');
			
			
			$header_show_links = []; 
			$updated_social_links = array();
			if(!empty($header_social_links)){
				foreach($header_social_links as $key => $value){
					
					if($value == 1){
						$header_show_links[] = $key; 
					}
				
				}
			}
			if(!empty($social_link_options)){
				foreach($social_link_options as $social_key => $social_link){
					if(in_array($social_link['id'], $header_show_links)){
						$updated_social_links[$social_key] = $social_link;
					}
				}
			}
			
			$social_link_options = $updated_social_links;
			
		}
		
		if(!empty($social_link_options)){
			foreach ($social_link_options as $social_link) {
				
					
					$id = $social_link['id'];
					$sl_id = 'social_' . $id . '_url';
					
					$sl_title = $social_link['title'];

					if(!empty($options[$sl_id]))
					{
						$id = ($id == 'facebook')?'facebook-f':$id;
						$output .= '<li><a target="'. esc_attr($target).'" href="'.esc_url( $options[$sl_id] ).'"  class="'.esc_attr($default_class.' fab fa-'.$id).'"></a></li>'."\n";	
					}
			}
		}
		return $output;
	}

	function jobzilla_short_description($excerpt = '', $content = '', $limit = 250, $more = null){
		
		if(empty($excerpt) && empty($content)){return false;}
		
		$short_description = '';
		
		if(!empty($excerpt)){
			$short_description = $excerpt;
		}
		else
		{	
			if ( has_blocks( $content ) ) {	
				$blocks = parse_blocks( $content );
				
				foreach($blocks as $k ){
					if ( $k['blockName'] === 'core/paragraph' ) {
						if(!empty($k['innerHTML'])){
							$short_description = $k['innerHTML'];
							break;
						}
					}
				}
			}else{
				$short_description = $content;
			}
		}	
		$short_description = jobzilla_trim($short_description, $limit, $more);
		
		return $short_description;
	}
	/*
		Ajax - Home pages listing
	*/
	
	
	function jobzilla_load_posts_by_ajax_callback() {	
		check_ajax_referer('ajax_security_key', 'security');   
		global $jobzilla_query_result;
	
		$post_type = !empty($_POST['post_type'])? sanitize_text_field($_POST['post_type']) : 'post';
		
		$query_args = array(	
			'post_type' 		=> $post_type,
			'post_status' 		=> 'publish',
			'posts_per_page'   	=> sanitize_text_field($_POST['posts_per_page']),	
			'paged' 			=> sanitize_text_field($_POST['page']),	
			'order' 			=> sanitize_text_field($_POST['post_order']),
			'ignore_sticky_posts' => true,
		);		
	

		if($_POST['posts_image_preference'] == 'image_post_only')
		{
			$query_args['meta_query'] = array(
				array(
				 'key' => '_thumbnail_id',
				 'compare' => 'EXISTS'
				),
			);
		}
		elseif($_POST['posts_image_preference'] == 'text_post_only')
		{
			$query_args['meta_query'] = array(
				array(
				 'key' => '_thumbnail_id',
				 'compare' => 'Not EXISTS'
				),
			);
		}			
			
		if($_POST['posts_in_categories']) 
		{ 
			
			if(!empty($_POST['post_type']) && $_POST['post_type'] != 'post')
			{
				/* This is category searching only for custom post type */
				$cat_arr = explode(',',sanitize_text_field($_POST['posts_in_categories']));
			
				
				if($post_type == 'product'){
					
					$taxonomy = 'product_cat';
				
				}else{
						
					$taxonomy = get_object_taxonomies($post_type);
					$taxonomy = !empty($taxonomy[0])?$taxonomy[0]:'category';	
					
				}
				
			
				$query_args['tax_query'][] = array(
											'taxonomy' => $taxonomy,
											'field' => 'slug',
											'terms' => $cat_arr,
											'operator' => 'IN'
											);
											
			}else{
				$query_args['category_name'] = sanitize_text_field($_POST['posts_in_categories']);
				
			}								
		}
		
		if($_POST['post_by_label'] == 'sticky_only')
		{
			$query_args['post__in']	= get_option( 'sticky_posts' );	
			$query_args['ignore_sticky_posts']	= true;
		}
		
		if($_POST['only_featured_post'] == 'yes') { 		
			$query_args['meta_key'] = 'featured_post';		
			$query_args['meta_value'] = 1;				
			$query_args['meta_compare'] = 'LIKE';		
		}
		
		if($_POST['post_order_by'] == 'views_count'){
			$query_args['meta_key']	= '_views_count';
		}
		else{
			$query_args['orderby']	= sanitize_text_field($_POST['post_order_by']);
		}
		
	
		
		$query = new WP_Query( $query_args );	
		$jobzilla_query_result['posts'] = $query->posts;		
		$jobzilla_query_result['posts_per_page'] = sanitize_text_field($_POST['posts_per_page']);
		$jobzilla_query_result['current_page'] = sanitize_text_field($_POST['page']);
		$jobzilla_query_result['side_bar'] = sanitize_text_field($_POST['side_bar']);
		$jobzilla_query_result['title_text_limit'] = sanitize_text_field($_POST['title_text_limit']);
		$jobzilla_query_result['description_text_limit'] = sanitize_text_field($_POST['description_text_limit']);
		
		$jobzilla_query_result['show_date'] = !empty($_POST['show_date'])?			sanitize_text_field($_POST['show_date']):'';
		$jobzilla_query_result['show_author'] = !empty($_POST['show_author'])?		sanitize_text_field($_POST['show_author']):'';
		$jobzilla_query_result['show_comment'] = !empty($_POST['show_comment'])?	sanitize_text_field($_POST['show_comment']):'';
		$jobzilla_query_result['show_share'] = !empty($_POST['show_share'])?		sanitize_text_field($_POST['show_share']):'';
		$jobzilla_query_result['show_column'] = !empty($_POST['show_column'])?		sanitize_text_field($_POST['show_column']):'column_2';
		$jobzilla_query_result['element_style'] = !empty($_POST['element_style'])?	sanitize_text_field($_POST['element_style']):'style_1';
		$jobzilla_query_result['total_post'] = !empty($_POST['total_post'])?		sanitize_text_field($_POST['total_post']):'';
		
		switch ($_POST['blog_view']) {
			case "post_listing_1": 			
				get_template_part('dz-inc/elementor/ajax/post_listing_1_ajax');
				break;
			case "post_listing_2": 			
				get_template_part('dz-inc/elementor/ajax/post_listing_2_ajax');
				break;
			case "post_listing_3": 			
				get_template_part('dz-inc/elementor/ajax/post_listing_3_ajax');
				break;		
			case "post_listing_5": 			
				get_template_part('dz-inc/elementor/ajax/post_listing_5_ajax');
				break;	

		}			
		unset($GLOBALS['jobzilla_query_result']);	
		wp_reset_postdata();
		wp_die();
	}
	
	add_action('wp_ajax_load_posts_by_ajax', 'jobzilla_load_posts_by_ajax_callback');
	add_action('wp_ajax_nopriv_load_posts_by_ajax', 'jobzilla_load_posts_by_ajax_callback');
	
	/*
		AJAX - Mega menu
	*/
	function jobzilla_load_mega_menu_posts_ajax_callback() {
		check_ajax_referer('ajax_security_key', 'security');   
		global $jobzilla_query_result;		
		$query_args = array(	
			'post_type' 		=> 'post',
			'post_status' 		=> 'publish',
			'posts_per_page'   	=> sanitize_text_field($_POST['posts_per_page']),	
			'paged' 			=> sanitize_text_field($_POST['page']),	
			'ignore_sticky_posts' => true,
			'orderby' 			=> 'date',
			'order' 			=> 'DESC',			
		);
		
		if($_POST['posts_in_categories']) { 
			$query_args['cat'] = sanitize_text_field($_POST['posts_in_categories']);		
		}
		
		if($_POST['mega_menu_images_only'] == 'yes')
		{		
			$query_args['meta_query'] = array(
				array(
				 'key' => '_thumbnail_id',
				 'compare' => 'EXISTS'
				),
			);
		}
		
		$query = new WP_Query( $query_args ); 		
		set_query_var( 'query', $query );	
		get_template_part('dz-inc/ajax/mega_menu_ajax');		
		wp_reset_postdata();
		wp_die();
	}
	
	add_action('wp_ajax_load_mega_menu_posts_by_ajax', 'jobzilla_load_mega_menu_posts_ajax_callback');
	add_action('wp_ajax_nopriv_load_mega_menu_posts_by_ajax', 'jobzilla_load_mega_menu_posts_ajax_callback');

	/*
		AJAX - Categories, Search, Tags, Archive, Author
	*/
	function jobzilla_load_common_page_posts_ajax_callback() {
		check_ajax_referer('ajax_security_key', 'security'); 		
		$jobzilla_query_result = array();	
		
		$query_args = array(	
			'post_type' 		=> 'post',
			'post_status' 		=> 'publish',
			'posts_per_page'   	=> sanitize_text_field($_POST['posts_per_page']),	
			'paged' 			=> sanitize_text_field($_POST['page']),
			'ignore_sticky_posts' => true,			
		);
		
		$orderby = isset($_POST['orderby'])?	sanitize_text_field($_POST['orderby']) :'date';
		$order   = isset($_POST['order'])?		sanitize_text_field($_POST['order'])   :'DESC';
			
		if($orderby == '_views_count')
		{
		  $query_args['meta_key']	= '_views_count';
		  $query_args['order'] = 'DESC';
		  $query_args['orderby'] = '_views_count';
		}else{
		  $query_args['orderby']	= $orderby;
		}
		
		$query_args['order'] = $order;
		
		$template = '';
		
		if( $_POST['page_view'] == 'author' ) { 		
			$query_args['author'] = $_POST['object_data'];				
			$template = 'author_ajax';
		}		
		if($_POST['page_view'] == 'category') { 
			$query_args['cat'] = $_POST['object_data'];	
			$template = 'category_ajax';	
		}		
		if($_POST['page_view'] == 'search') { 
			$query_args['s'] = $_POST['object_data'];	
			$template = 'search_ajax';
		}		
		if($_POST['page_view'] == 'tag') { 
			$query_args['tag_id'] = $_POST['object_data'];	
			$template = 'tag_ajax';
		}		
		if($_POST['page_view'] == 'archive') { 
			$object_data = explode('/', $_POST['object_data']);
			$query_args['year'] = $object_data[0];	
			
			if( isset($object_data[1]) && !empty($object_data[1]) ){
				$query_args['monthnum'] = $object_data[1];
			}
			
			$template = 'archive_ajax';
		}	
		
		$query = new WP_Query( $query_args );		
		set_query_var( 'jobzilla_query_result', $query );		
		get_template_part('dz-inc/ajax/'. $template);
		wp_reset_postdata();
		wp_die();
	}
	add_action('wp_ajax_load_common_page_posts_ajax', 'jobzilla_load_common_page_posts_ajax_callback');
	add_action('wp_ajax_nopriv_load_common_page_posts_ajax', 'jobzilla_load_common_page_posts_ajax_callback');

	
	/*
		AJAX - index page :-
	*/
	function jobzilla_load_latest_posts_ajax_callback() {
		check_ajax_referer('ajax_security_key', 'security');		
		$jobzilla_query_result = array();
		$query_args = array(	
			'post_type' 		=> 'post',
			'post_status' 		=> 'publish',
			'posts_per_page'   	=> sanitize_text_field($_POST['posts_per_page']),	
			'paged' 			=> sanitize_text_field($_POST['page']),	
			'orderby' 			=> 'post_date',
			'ignore_sticky_posts' => true,
			'order' 			=> 'DESC',
		);			
		
		$query = new WP_Query( $query_args );			
		set_query_var( 'jobzilla_query_result', $query );		
		get_template_part('dz-inc/ajax/index_ajax');
		wp_reset_postdata();
		wp_die();
	}
	add_action('wp_ajax_load_latest_posts_ajax', 'jobzilla_load_latest_posts_ajax_callback');
	add_action('wp_ajax_nopriv_load_latest_posts_ajax', 'jobzilla_load_latest_posts_ajax_callback');
	
	
	/*
		AJAX - Theme status changed :-
		-- change website mode from coming to live mode
	*/
	function jobzilla_change_theme_status_ajax() {
		check_ajax_referer('ajax_security_key', 'security');		 
		
		if(class_exists('Redux')){
			Redux::set_option( jobzilla_get_opt_name(), 'website_status', 'live_mode' );
		}
		
		return true;
		
		wp_reset_postdata();
		wp_die();
	}
	add_action('wp_ajax_change_theme_status_ajax', 'jobzilla_change_theme_status_ajax');
	add_action('wp_ajax_nopriv_change_theme_status_ajax', 'jobzilla_change_theme_status_ajax');
	
	/* Run Code */
	if( !function_exists( 'jobzilla_shortcode' ) ) {
		function jobzilla_shortcode($output) {
			return $output;
		}
	}
	/* Run Code END */
	
if(!function_exists('jobzilla_share_us'))
{

	function jobzilla_share_us($post_id = '', $post_title = '', $share_on = '')
	{
  
		$social_shaing = jobzilla_get_opt('social_shaing_on_post');
		
		/* Control Post Sharing */
			if(!$social_shaing)
			{ return false; }
		/* Control Post Sharing END */
		
		$response 			= '';
		$options			= get_option('jobzilla_theme_options');
		$share_sort_links	= jobzilla_set($options, 'share_sort_link');
		$social_share_link	= array(
			'facebook'=>'http://www.facebook.com/sharer.php?u='.esc_url(get_permalink($post_id)),
			'twitter'=>'https://twitter.com/share?url='.esc_url(get_permalink($post_id)).'&text='.esc_attr($post_title),
			'google-plus'=>'https://plus.google.com/share?url='.esc_url(get_permalink($post_id)),
			'linkedin'=>'http://www.linkedin.com/shareArticle?url='.esc_url(get_permalink($post_id)).'&title='.esc_attr($post_title),
			'pinterest'=>'http://pinterest.com/pin/create/button/?url='.esc_url(get_permalink($post_id)).'&media='.esc_url(get_the_post_thumbnail_url($post_id)).'&description='.esc_attr($post_title),
			'reddit'=>'http://reddit.com/submit?url='.esc_url(get_permalink($post_id)).'&title='.esc_attr($post_title),
			'tumblr'=>'http://www.tumblr.com/share/link?url='.esc_url(get_permalink($post_id)).'&name='.esc_attr($post_title),
			'digg'=>'http://digg.com/submit?url='.esc_url(get_permalink($post_id)).'&title='.esc_attr($post_title),
		);
		
		if($share_on == 'PostSingle')
		{
			$response = '<div class="post-social-icons-wrap"><ul class="post-social-icons">';
		}elseif($share_on == 'Jobs')
		{
			$response = '<h4 class="twm-s-title">'.esc_html__('Share Profile','jobzilla').'</h4><div class="twm-social-tags">';
		}else{
			$response = '<div class="post-social-icons-wrap"><ul class="post-social-icons">';
			
		}
		
		if(!empty($share_sort_links))
		{
			foreach($share_sort_links as $icon_key => $icon_value)
			{
			
				$anchor_class = '';
				if($share_on == 'PostSingle')
				{ 
					$icon_key_name = ($icon_key == 'facebook')?'facebook-f':$icon_key;
					$anchor_class = 'fab fa-'.$icon_key_name; 
					
				}else{
					if($icon_key == 'facebook'){
						$icon_key_name = 'facebook-f';
					}elseif($icon_key == 'linkedin'){
						$icon_key_name = 'linkedin-in';
					}else{
						$icon_key_name = $icon_key;
					}
					$anchor_class = 'fab fa-'.$icon_key_name; 
				}
				if($icon_value){
					if($share_on == 'Jobs')
					{
						switch ($icon_key) {
						  case "facebook":
						    $link_clr = 'fb-clr';
						    break;
						  case "twitter":
						    $link_clr = 'tw-clr';
						    break;
						  case "linkedin":
						    $link_clr = 'link-clr';
						    break;
						  case "pinterest":
						    $link_clr = 'pinte-clr';
						    break;
						  case "google-plus":
						    $link_clr = 'whats-clr';
						    break;
						  default:
						    $link_clr = 'fb-clr';
						}
						$response .= '<a class="'.$link_clr.'" href="'.esc_url($social_share_link[$icon_key]).'" target="_blank" >'.esc_html($icon_key_name).'</a> ';
					}else{
						$response .= '<li><a class="'.$anchor_class.'" href="'.esc_url($social_share_link[$icon_key]).'" target="_blank" ></a></li> ';
					}
					
				}
			}
		}
		if($share_on == 'PostSingle')
		{
			$response .= '</ul></div>';
		}elseif($share_on == 'Jobs')
		{
			$response .= '</div>';
		}else{
			$response .= '</ul></div>';
		}
		
		return $response;
	}
}

if(!function_exists('jobzilla_author_social_link'))
{

	function jobzilla_author_social_arr()
	{
		$author_social_arr = array(
								'url'=>array('icon'=>'fas fa-globe','text'=>'Globe'),
								'facebook'=>array('icon'=>'fab fa-facebook-f','text'=>'Facebook'),
								'twitter'=>array('icon'=>'fab fa-twitter','text'=>'Twitter'),
								'linkedin'=>array('icon'=>'fab fa-linkedin-in','text'=>'Linkedin'),
								'dribbble'=>array('icon'=>'fab fa-dribbble','text'=>'Dribble'),
								'github'=>array('icon'=>'fab fa-github','text'=>'Github'),
								'flickr'=>array('icon'=>'fab fa-flickr','text'=>'Flickr'),
								'google-plus'=>array('icon'=>'fab fa-google-plus','text'=>'Google Plus'),
								'youtube'=>array('icon'=>'fab fa-youtube','text'=>'Youtube'),
								);
								
		return $author_social_arr;
	}
}


function jobzilla_get_website_logo($logo_key = 'site_logo', $logoclass = '') 
{
	$jobzilla_option = getDZThemeReduxOption();
	$allowed_html_tags = jobzilla_allowed_html_tag();
	$page_logo_setting = $output = '';
	// Logo Class 
	$class = '';
	$logo_type = !empty($jobzilla_option['logo_type']) ? $jobzilla_option['logo_type'] : '';
	
	if($logoclass != 'none' && $logo_key == 'site_other_logo'){
		$class = 'text-logo logo-white';
	}else if($logoclass != 'none' && $logo_key == 'site_logo'){
		$class = 'text-logo logo-dark';
	
	}
	$class = !empty($class)?'class="'.$class.'"':'';
	// Logo URL
	
	$logo_url = !empty($jobzilla_option[$logo_key]) ? $jobzilla_option[$logo_key] : 'site_logo';
	$logo_title = !empty($jobzilla_option['logo_title']) ? $jobzilla_option['logo_title'] : '';
	$logo_alt = !empty($jobzilla_option['logo_alt']) ? $jobzilla_option['logo_alt'] : '';
	
	if($logo_type == 'text_logo') 
	{
		$logo_text 	= 	jobzilla_get_opt('logo_text',esc_html__('Jobzilla','jobzilla'));
		$logo_tag 	= 	jobzilla_get_opt('tag_line',esc_html__('Architecture Theme','jobzilla'));

		$output .= '<div '.$class.'>';
		if(!empty($logo_text)) {
			$output .= '<h1 class="site-title">';
			$output .= '<a href="'.esc_url( home_url( '/' ) ).'" title="'.esc_attr($logo_title).'">';
			$output .= esc_html($logo_text);
			$output .= '</a>';
			$output .= '</h1>';
		}
		if(!empty($logo_tag)) {
			$output .= '<p class="site-description">';
			$output .= esc_html($logo_tag);
			$output .= '</p>';
		}
		$output .= '</div>';
	}
	else {
		$output .= '<a href="'.esc_url( home_url( '/' ) ).'" '.$class.' title="'.esc_attr($logo_title).'">';
		$output .= '<img src="'.esc_url($logo_url).'" alt="'.esc_attr($logo_alt).'" class="'.esc_attr($logoclass).'"/>';
		$output .= '</a>';
	}

	echo wp_kses($output, $allowed_html_tags);
}
add_action('jobzilla_get_logo', 'jobzilla_get_website_logo',10,4);


function jobzilla_get_super_user_data($userMeta='') {
	
	$admin_email = get_option('admin_email');
	$adminDetail = get_user_by('email',$admin_email);
	if(isset($adminDetail->data->ID)){
		$userMetaValue = get_the_author_meta($userMeta,$adminDetail->data->ID);
		return $userMetaValue;
	}
}

function jobzilla_get_super_user_displayname($userMeta="") {
	
	$admin_email = get_option('admin_email');
	$adminDetail = get_user_by('email',$admin_email);

	return $adminDetail->data->display_name;
}

function jobzilla_get_super_user_description() {
	
	$admin_email = get_option('admin_email');
	$adminDetail = get_user_by('email',$admin_email);
	$meta = get_user_meta($adminDetail->data->ID);
	$description = !empty($meta['description'][0])?$meta['description'][0]:''; 
	return $description;
}

function jobzilla_get_domain($url)
{
    $pieces = parse_url($url);
    $domain = isset($pieces['host']) ? $pieces['host'] : '';
    if(preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $regs)){
        return $regs['domain'];
    }
    return false;
}
function jobzilla_get_youtube_video_id($video_url){
	$res = 0;
	if(preg_match("/(youtube.com|youtu.be)\/(watch)?(\?v=)?(\S+)?/", $video_url, $res)){
		return $res[4];
	}else{
		return 0;
	}
}

/* Show Only One Category : only for demo */
function jobzilla_get_the_category_list($cat_list,$b)
{
	$category = array();
	$category[] = $cat_list[0]; 
	return $category;
}


/* Show Only One Category : only for demo END */

/* Hide Some Category From Widget : only for demo */
function jobzilla_exclude_widget_categories($args)
{
	$hide_selected_cat 	= jobzilla_get_opt('hide_selected_cat');
    if(!empty($hide_selected_cat))
	{
			$hide_selected_cat = implode(',',$hide_selected_cat);
			$args['exclude'] = $hide_selected_cat;
			return $args;
	}
}

/* Hide Some Category From Widget : only for demo END */

/* Show Feature Image In Post Listing */
function jobzilla_custom_columns( $columns ) 
{
    $columns = array(
        'cb' => '<input type="checkbox" />',
        'featured_image' => 'Image',
        'title' => 'Title',
        'comments' => '<span class="vers"><div title="Comments" class="comment-grey-bubble"></div></span>',
        'author' => 'Author',
        'categories' => 'Cateogies',
        'tags' => 'Tags',
		'date' => 'Date',
     );
    return $columns;
}


function jobzilla_custom_columns_data( $column, $post_id )
{
    switch ( $column ) {
    case 'featured_image':
        the_post_thumbnail( 'thumbnail' );
        break;
    }
}
/* Show Feature Image In Post Listing END */


function jobzilla_ext_options()
{
	$show_only_one_cat 			= jobzilla_get_opt('show_only_one_cat');
	$hide_cat_from_widget 		= jobzilla_get_opt('hide_cat_from_widget');
	$show_image_on_post_list 	= jobzilla_get_opt('show_image_on_post_list');
	
	if($show_only_one_cat){
		add_action( 'the_category_list' , 'jobzilla_get_the_category_list', 10, 2 );
	}
	
	if($hide_cat_from_widget){
		add_filter('widget_categories_args','jobzilla_exclude_widget_categories');
	}
	if($show_image_on_post_list)
	{
		add_filter('manage_post_posts_columns' , 'jobzilla_custom_columns');
		add_action( 'manage_post_posts_custom_column' , 'jobzilla_custom_columns_data', 10, 2 );
	}
}

add_action( 'init' , 'jobzilla_ext_options');


function jobzilla_is_theme_sidebar_active(){
	return jobzilla_get_opt('show_sidebar',true);
}

function jobzilla_show_post_view_count_view($views)
{
	$post_view_on = jobzilla_get_opt('post_view_on',false);
	$view_html = '';
	if($post_view_on)
	{
		$post_start_view = jobzilla_get_opt('post_start_view',0);
		$views	= $views + $post_start_view;
		
		$view_html = '<li class="post-view"> <a href="javascript:void(0);"><i class="far fa-eye fa-fw" ></i><span>'.wp_kses($views,'string').'</span></a></li>';
	}
	
	return $view_html;
}

function jobzilla_get_banner()
{
	global $jobzilla_option;
	
	$header_style = isset($jobzilla_option['header_style'])?$jobzilla_option['header_style']:'header_1';
	
	$theme_options = jobzilla_get_theme_option();
	
	$template_name = 'page_general';
	if(is_page())
	{ 
		$template_name 			= 'page_general';
		$page_banner_setting	= jobzilla_dzbase()->get_meta('page_banner_setting'); 
		
	}
	
	$page_banner_setting	= !empty($page_banner_setting)?$page_banner_setting:'theme_default';
	$title_prefix			= '';
	
	if(is_author()){
		$template_name	= 'author_page';
		$title_prefix	= esc_html__('Author :', 'jobzilla');
	}else if(is_search()){
		$template_name	= 'search_page';
		$title_prefix	= esc_html__('Search :', 'jobzilla');
	}else if(is_category()){
		$template_name	= 'category_page';
		$title_prefix	= esc_html__('Category :', 'jobzilla');
	}else if( jobzilla_is_woocommerce_active() && ((function_exists('is_shop') && is_shop()) || (function_exists('is_product_category') && is_product_category()))){
		$template_name	= 'woocommerce_page';
		$title_prefix	= esc_html__('Product :', 'jobzilla');
	}else if(is_tag()){
		$template_name	= 'tag_page';
		$title_prefix	= esc_html__('Tag :', 'jobzilla');
	}else if(function_exists('tribe_is_event') && tribe_is_event()){
			
		$template_name	= 'archive_page';
		$title_prefix	= '';
	}else if(is_archive() && get_post_type() != 'company'){
		
		$template_name	= 'archive_page';
		$title_prefix	= esc_html__('Archive :', 'jobzilla');
	}

	$page_banner_title = $page_banner_sub_title = '';

if($page_banner_setting == 'custom')
	{
		$show_banner			= jobzilla_dzbase()->get_meta('page_banner_on');
		$banner_type			= jobzilla_dzbase()->get_meta('page_banner_type');
		
		$banner_height			= jobzilla_dzbase()->get_meta('page_banner_height');
		$custom_height			= jobzilla_dzbase()->get_meta('page_banner_custom_height');
		$banner_image			= jobzilla_dzbase()->get_meta('page_banner');
		$banner_hide			= jobzilla_dzbase()->get_meta('page_banner_hide');
		
		$page_banner_sub_title	= jobzilla_dzbase()->get_meta('page_banner_sub_title');		
		$show_breadcrumb 		= jobzilla_dzbase()->get_meta('page_breadcrumb');
		$banner_style 		    = jobzilla_dzbase()->get_meta('page_banner_style');
		$banner_image			= jobzilla_set($banner_image,'url');
	}
	else
	{
		$title_prefix   		= jobzilla_set($theme_options,$template_name.'_title',$title_prefix);
		$show_banner   			= jobzilla_set($theme_options,$template_name.'_banner_on',true);
		$banner_type   			= jobzilla_set($theme_options,$template_name.'_banner_type','image');
		
		$banner_height  		= jobzilla_set($theme_options,$template_name.'_banner_height','page_banner_small');
		$custom_height  		= jobzilla_set($theme_options,$template_name.'_banner_custom_height','100');	
		$banner_image   		= jobzilla_set($theme_options,$template_name.'_banner');
		$banner_image   		= !empty(jobzilla_set($banner_image,'url'))?jobzilla_set($banner_image,'url'):JOBZILLA_BANNER;
		$page_banner_title		= jobzilla_dzbase()->get_meta('page_banner_title');
		$show_breadcrumb 		= jobzilla_set($theme_options,'show_breadcrumb',true);
		$banner_style 		    = jobzilla_set($theme_options,$template_name.'_banner_style','style1');
		$banner_hide   			= jobzilla_set($theme_options,$template_name.'_banner_hide');
	}
	
	$page_heading_classes = 'dz-bnr-inr-entry';
	$banner_class = 'dz-bnr-inr overlay-secondary-dark  '.$banner_style ;
	$banner_custom_height = '';
	
	if($banner_height == 'page_banner_big') {
		$banner_class .= ' dz-bnr-inr-lg ';
		$page_heading_classes = ' dz-bnr-inr-entry';
	}else if($banner_height == 'page_banner_medium'){
		$banner_class .= ' dz-bnr-inr-md ';
	}else if($banner_height == 'page_banner_small'){
		$banner_class .= ' dz-bnr-inr-sm ';
	}else if($banner_height == 'page_banner_custom'){
		//but you can't add height attribute here as per themeforest requirement
		$banner_custom_height = '--dz-banner-height:'.$custom_height.'px;';
		$banner_class .= ' dz-bnr-inr-sm ';
	}
	
	$bnr_style = "style=";
	
	if(empty($banner_hide)) {
		if(!empty($banner_image)) {
			$bnr_style .= 'background-image:url('.esc_url($banner_image).');';
		}
		
		if($banner_height == 'page_banner_custom'){
			$bnr_style .= $banner_custom_height;
		}
	}

	if($show_banner)
		{
			if($banner_type == 'image' ){
		
			?>
      <!-- Banner  -->
	
		<div class="<?php echo esc_attr($banner_class); ?> " <?php echo esc_attr($bnr_style); ?>>
			
            <div class="container">
            
				<div class="<?php echo esc_attr($page_heading_classes); ?>">
					<h1>
							<?php 
							
							if(is_page() || is_single()){
								global $post;
								$title = isset($post->post_title)?sanitize_text_field($post->post_title):'';
							}else{
								$title = wp_title('',0); 
								
							}
							
							if($title)
							{
								if(
									jobzilla_is_woocommerce_active() &&
									(is_shop() || is_product_category())
								  )
								{
									$title_prefix = ''; /* To remove extra product word from title */
                  
									$page_banner_title = jobzilla_set($theme_options,'woocommerce_page_title');
								}
								
								if(!empty($page_banner_title))
								{
									$title = $page_banner_title;
								}else{
									$title = $title_prefix.' '.$title;	
								}
								
								echo wp_kses($title,'string');
							}else{
								echo jobzilla_set($theme_options,'blog_page_title',esc_html__('Blog','jobzilla'));
							}
                            

							?>
						</h1>
						<!-- Breadcrumb row -->
						<?php if($show_breadcrumb && !is_front_page()) { ?>
							<nav aria-label="breadcrumb" class="<?php echo esc_attr('breadcrumb-row'); ?>">
								<?php echo jobzilla_get_the_breadcrumb(); ?>
							</nav>
						<?php } ?>
						<!-- Breadcrumb row END -->
					</div>
				</div>
			</div>
		
			<?php	
			}		
		}
	
}

function jobzilla_get_post_banner()
{
	if(!is_single()){ return false; }
	
	global $jobzilla_option;
	
	$theme_options = jobzilla_get_theme_option();
	
	$post_key = 'post';
	
	if(is_singular('dz_service')){
		
		$post_key = 'service_post';
		$post_banner_setting	= jobzilla_dzbase()->get_meta('service_post_banner_setting'); 
		$post_banner_setting	= !empty($post_banner_setting)?$post_banner_setting:'theme_default';
		
	}elseif(is_singular('dz_portfolio')){
		
		$post_key = 'portfolio_post';
		$post_banner_setting	= jobzilla_dzbase()->get_meta('portfolio_post_banner_setting'); 
		$post_banner_setting	= !empty($post_banner_setting)?$post_banner_setting:'theme_default';
		
	}else{
		$post_banner_setting	= jobzilla_dzbase()->get_meta('post_banner_setting'); 
		$post_banner_setting	= !empty($post_banner_setting)?$post_banner_setting:'theme_default';
	}
	
if($post_banner_setting == 'custom')
	{
		$show_banner	 		= jobzilla_dzbase()->get_meta($post_key.'_banner_on');
		$banner_layout			= jobzilla_dzbase()->get_meta($post_key.'_banner_layout');
		$banner_image	 		= jobzilla_dzbase()->get_meta($post_key.'_banner');
		$banner_height	 		= jobzilla_dzbase()->get_meta($post_key.'_banner_height');
		$custom_height	 		= jobzilla_dzbase()->get_meta($post_key.'_banner_custom_height');
		$banner_style	 		= jobzilla_dzbase()->get_meta('post_banner_style');
		$banner_image	 		= jobzilla_set($banner_image,'url');
		$show_breadcrumb 		= jobzilla_dzbase()->get_meta($post_key.'_breadcrumb');
	}
	else
	{
		$show_banner   		 	= jobzilla_set($theme_options,'post_general_banner_on');
		$banner_height  		= jobzilla_set($theme_options,'post_general_banner_height','page_banner_medium');
		$custom_height   		= jobzilla_set($theme_options,'post_general_banner_custom_height','100');
		$banner_layout  		= jobzilla_set($theme_options,'post_banner_layout','banner_layout_1');
		$banner_image    		= jobzilla_set($theme_options,'post_general_banner');
		$banner_style    		= jobzilla_set($theme_options,'post_general_banner_style');
		$banner_image   		= !empty(jobzilla_set($banner_image,'url'))?jobzilla_set($banner_image,'url'):JOBZILLA_BANNER;
		$show_breadcrumb 		= jobzilla_set($theme_options,'show_breadcrumb',true);
	}
		
	
	$page_heading_classes = 'dz-bnr-inr-entry';
	$banner_class = 'dz-bnr-inr overlay-secondary-dark '.$banner_style ;
	$banner_custom_height = '';
	if($banner_height == 'page_banner_big') {
		$banner_class .= '  dz-bnr-inr-lg ';
		$page_heading_classes = 'dz-bnr-inr-entry';
	}else if($banner_height == 'page_banner_medium'){
		$banner_class .= '  dz-bnr-inr-md ';
	}else if($banner_height == 'page_banner_small'){
		$banner_class .= '  dz-bnr-inr-sm ';
	}else if($banner_height == 'page_banner_custom'){
		//but you can't add height attribute here as per themeforest requirement
		//$banner_class .= ' dz-bnr-inr overlay-secondary-dark';
		$banner_custom_height = '--dz-banner-height:'.$custom_height.'px;';
	}
	
	
	$bnr_style = "style=";
	
	
	if(!empty($banner_image)) {
		$bnr_style .= 'background-image:url('.esc_url($banner_image).');';
	}
	
	if($banner_height == 'page_banner_custom'){
		$bnr_style .= $banner_custom_height;
	}
	
	
	if($show_banner){				
			?>
			
      <!-- Banner  -->
	 
		<div class="<?php echo esc_attr($banner_class); ?>" <?php echo esc_attr($bnr_style); ?>>
			<div class="container">
				<div class="<?php echo esc_attr($page_heading_classes); ?>">
					<h1>							
							<?php 
							
							if(is_page() || is_single()){
								global $post;
								$title = isset($post->post_title)?sanitize_text_field($post->post_title):'';
							}else{
								$title = wp_title('',0); 
							}
							
							if($title)
							{
								echo wp_kses($title,'string');
							}else{
								echo jobzilla_set($theme_options,'blog_page_title',esc_html__('Blog','jobzilla'));
							}
							?>
					</h1>

						<!-- Breadcrumb row -->
						<?php if($show_breadcrumb && !is_front_page()) { ?>
							<nav aria-label="breadcrumb" class="<?php echo esc_attr('breadcrumb-row'); ?>">
								<?php echo jobzilla_get_the_breadcrumb(); ?>
							</nav>
						<?php } ?>
						<!-- Breadcrumb row END -->
				</div>
			</div>
		</div>
			<?php	
					
		}
	
}



function jobzilla_is_post_banner_enable()
{
	if(!is_single()){ return false; }
	
	$post_banner_setting	= jobzilla_dzbase()->get_meta('post_banner_setting'); 
	$post_banner_setting	= !empty($post_banner_setting)?$post_banner_setting:'theme_default';
	
	if($post_banner_setting == 'custom'){
		$show_banner = jobzilla_dzbase()->get_meta('post_banner_on');
	}else{
		$show_banner = jobzilla_get_opt('post_general_banner_on');
	}
	
	return $show_banner;
}



function jobzilla_get_loader()
{
	
	$theme_options 	= jobzilla_get_theme_option();
	$page_loading_on	= jobzilla_set($theme_options,'page_loading_on');
	$page_loader_image = '';
	if($page_loading_on == 1)
		{
			$page_loader_type	= jobzilla_set($theme_options,'page_loader_type','loading_image');
			if($page_loader_type == 'loading_image')
			{
				$custom_preloader = !empty($theme_options['custom_page_loader_image'])?jobzilla_set($theme_options['custom_page_loader_image'],'url'):'';
			
				if($custom_preloader) 
				{
					
					$preloader = $custom_preloader;
				
				}else{
					$page_loader_image = jobzilla_set($theme_options, 'page_loader_image', 'loading1');
					$preloader 	= get_template_directory_uri().'/dz-inc/assets/images/loading-images/'.$page_loader_image.'.svg';
				}
			}	
			elseif($page_loader_type == 'advanced_loader')
			{
				$page_loader = jobzilla_set($theme_options, 'advanced_page_loader_image', 'loading1');
			}	
		}
	?>


	<?php if($page_loading_on == 1) {
	
		if($page_loader_type == 'loading_image') { 
    
		  $loading_class = '';
		  if($page_loader_image == 'loader_1'){
			$loading_class = 'loading-01';
		  }elseif($page_loader_image == 'loader_2'){
			$loading_class = 'loading-02';
		  }else{
			$loading_class = 'loading-03';
		  }
    
    ?>
	
	<?php if($page_loader_image=='loading1'){ ?>
		<!-- LOADING AREA START ===== -->
			<div class="loading-area" id="loading-area">
				<div class="loading-box"></div>
				<div class="loading-pic">
					<div class="wrapper">
						<div class="cssload-loader"></div>
					</div>
				</div>
			</div>
		<!-- LOADING AREA  END ====== -->
	<?php } else { ?>		
	<!-- Preloader -->
		<div id="loading-area" class="<?php echo esc_attr($loading_class); ?>"  style="background-image: url(<?php echo esc_url($preloader);?>);background-repeat: no-repeat; background-position: center;"></div>
	<?php } } ?>
	
	<?php 
	if($page_loader_type == 'advanced_loader' && $page_loader == 'loading1') {
		wp_enqueue_style( 'jobzilla-loading1', get_template_directory_uri() . '/assets/css/loader/loading1.css' );
	?>
	<div id="loading-area" class="loader2">
		<div class="box-load">
			<div class="load-logo"><?php do_action( 'jobzilla_get_logo','site_other_logo'); ?></div>
			<h1 class="ml12"><?php echo esc_html__('Your Wait Is Going To Finish','jobzilla'); ?></h1>
		</div>	
	</div>
	<?php 
		wp_enqueue_script( 'jobzilla-anime', get_template_directory_uri().'/assets/js/loading/anime.js', array( 'jquery' ), '1.0', true );
		wp_enqueue_script( 'jobzilla-anime-app3', get_template_directory_uri().'/assets/js/loading/anime-app3.js', array( 'jquery' ), '1.0', true );
	}elseif($page_loader_type == 'advanced_loader' && $page_loader == 'loading2') {
		wp_enqueue_style( 'jobzilla-loading2', get_template_directory_uri() . '/assets/css/loader/loading2.css' );
	?>
	<div id="loading-area" class="line-loader">
		<svg viewBox="0 0 960 300">
			<symbol id="s-text">
				<text text-anchor="middle" x="50%" y="80%"><?php echo get_bloginfo('name'); ?></text>
			</symbol>
			<g class = "g-ants">
				<use xlink:href="#s-text" class="text-copy"></use>
				<use xlink:href="#s-text" class="text-copy"></use>
				<use xlink:href="#s-text" class="text-copy"></use>
				<use xlink:href="#s-text" class="text-copy"></use>
				<use xlink:href="#s-text" class="text-copy"></use>
			</g>
		</svg>
	</div>
	<?php 
		}  
	} 
}


function jobzilla_isAMultipleOf4($n) 
{ 
    // if true, then 'n' is a multiple of 4 
    if (($n & 3) == 0) 
        return true; 
  
    // else 'n' is not a multiple of 4 
    return false; 
} 

/* Change Default WordPress Pages Sorting */
function jobzilla_change_default_pages_post_order( $query ) 
{
	$template_name = '';
	
	if($query->is_author() && $query->is_main_query() ){
		$template_name	= 'author_page';
	}else if($query->is_search() && $query->is_main_query() ){
		$template_name	= 'search_page';
	}else if( $query->is_category() && $query->is_main_query() ){
		$template_name	= 'category_page';
	}else if($query->is_tag() && $query->is_main_query() ){
		$template_name	= 'tag_page';
	}else if($query->is_archive() && $query->is_main_query() ){
		$template_name	= 'archive_page';
	}
	
	if(!empty($template_name) && !is_admin() && function_exists('is_shop') && !is_shop())
	{
		$sorting_on = jobzilla_get_opt($template_name.'_sorting_on');
		if($sorting_on)
		{
			$sorting	= jobzilla_get_opt($template_name.'_sorting');
			
			if($sorting	== 'most_visited')
			{
				$order	=	'desc';
				$query->set('meta_key', '_views_count');
				$query->set('orderby', 'meta_value_num');	
				
			}else{
				$sort_arr	= explode('_',$sorting);
				$orderby 	= !empty($sort_arr[0]) ? $sort_arr[0]:'date';
				$order 		= !empty($sort_arr[1]) ? $sort_arr[1]:'DESC';	
				
				$query->set('orderby', $orderby);	
			}
			
			$query->set('order', $order);	
		}
	}
}

add_action( 'pre_get_posts', 'jobzilla_change_default_pages_post_order' );
/* Change Default WordPress Pages Sorting END */

/* Change Body Layout */
function jobzilla_body_layout_class( $classes ) 
{
	global $jobzilla_option;
	
	$theme_layout = jobzilla_get_opt('theme_layout','theme_layout_1');
	$theme_corner = jobzilla_set($jobzilla_option, 'theme_corner', 'sharped');
	$theme_font_style = jobzilla_set($jobzilla_option, 'theme_font_style', 'default');
	if(!empty($theme_layout))
	{
		$class = '';
		if($theme_layout == 'theme_layout_2') 
		{
			/* Boxed Layout */
			$class .= 'boxed';	
		}else if($theme_layout == 'theme_layout_3')
		{
			/* Frame Layout */
			$class .= 'frame';
		}
		
		
		if($theme_corner == 'rounded'){
		$class .= ' theme-rounded';
		}else if($theme_corner == 'sharped'){
			$class .= ' theme-sharped';
		}else{
			$class .= ' theme-rounded';
		}
        
        
        if($theme_font_style == 'oswald_style'){
            $class .= ' font-style-1';
		}else if($theme_font_style == 'montserrat_style'){
			$class .= ' font-style-2';
		}else{
			$class .= '';
		}
		
		return array_merge( $classes, array( $class ) );
	}
    
    
	
	return $classes;
	
}
add_filter( 'body_class', 'jobzilla_body_layout_class');

function jobzilla_body_layout_class_not_in_use( $classes ) 
{
	$class = '';
	
	$theme_layout = jobzilla_get_opt('theme_layout');
	$theme_mode = jobzilla_get_opt('theme_mode');
	
	// Theme Layout
	if(!empty($theme_layout))
	{
		
		if($theme_layout == 'theme_layout_2') 
		{
			/* Boxed Layout */
			$class .= ' boxed';	
		}else if($theme_layout == 'theme_layout_3')
		{
			/* Frame Layout */
			$class .= ' frame';
		}
		
	}
	
	//Theme Mode
	if(!empty($theme_mode) && $theme_mode == 'dark')
	{
		$class .= ' layout-dark';	
	}
	
	if(!empty($_GET['theme_mode']) && $_GET['theme_mode'] == 'dark'){
		$class .= ' layout-dark';
	}else{
		$class .= ' layout-light';
	}
	
	return array_merge( $classes, array( $class ) );
	
}
/* Change Body Layout END */

/* Change Body Layout Style */
function jobzilla_body_layout_style() 
{
	$theme_options = jobzilla_get_theme_option();
	$theme_layout  = jobzilla_set($theme_options,'theme_layout','theme_layout_1');
	$style = '';
	if(!empty($theme_layout) && $theme_layout != 'theme_layout_1')
	{
		$output   = '';
		$bg_type  = jobzilla_set($theme_options,'body_boxed_bg_type');
		if($bg_type == 'bg_type_color')
		{
			$bg_color  = jobzilla_set($theme_options,'boxed_layout_bg_color');
			$custom_bg_color  = jobzilla_set($theme_options,'boxed_layout_custom_bg_color');
			
			if(!empty($custom_bg_color['color']))
			{
				$output = 'background-color:'.$custom_bg_color['color'].';';
			}else if(!empty($bg_color))
			{
				$output = 'background-color:'.$bg_color.';';
			}
		}else if($bg_type == 'bg_type_image')
		{
			$bg_image  = jobzilla_set($theme_options,'boxed_layout_bg_image');
			$custom_bg_image  = jobzilla_set($theme_options,'boxed_layout_custom_bg_image');
			
			if(!empty($custom_bg_image['url']))
			{
				$output = 'background-image:url('.$custom_bg_image['url'].'); background-size: auto;';
			}else if(!empty($bg_image))
			{
				$bg_image = get_template_directory_uri().'/assets/images/switcher/background/'.$bg_image.'.jpg';
				$output = 'background-image:url('.$bg_image.'); background-size: auto;';
			} 
			
		}else if($bg_type == 'bg_type_pattern')
		{
			$bg_pattern  = jobzilla_set($theme_options,'boxed_layout_bg_pattern');
			$custom_bg_pattern  = jobzilla_set($theme_options,'boxed_layout_custom_bg_pattern');
			
			$custom_bg_pattern_padding  = jobzilla_set($theme_options,'boxed_layout_bg_pattern_padding');
			
			if(!empty($custom_bg_pattern['url']))
			{
				$output = 'background-image:url('.$custom_bg_pattern['url'].'); background-size: auto;';
			}else if(!empty($bg_pattern))
			{
				$bg_pattern = get_template_directory_uri().'/assets/images/switcher/pattern/'.$bg_pattern.'.jpg';
				$output = 'background-image:url('.$bg_pattern.'); background-size: auto;';
			}			
		}
		
		if($theme_layout == 'theme_layout_3' && !empty($custom_bg_pattern_padding)){
			$output .= 'padding:'.$custom_bg_pattern_padding.'px;';
		}
		$style = 'style="'.$output.'"';	
				
		
	}
	
	echo wp_kses($style, jobzilla_allowed_html_tag());
}
/* Change Body Layout Style END */


/* Get Post Meta Data */
 function jobzilla_get_post_meta( $post_id, $meta_key ) 
{
	if(is_array($meta_key)){
		$post_meta_data = array();
		$meta_data = get_post_meta($post_id);
		
		foreach($meta_key as $field_key){
			if(!empty($meta_data[$field_key])){
				if(count($meta_data[$field_key]) == 1){
					$post_meta_data[$field_key] = $meta_data[$field_key][0];	
				}else{
					$post_meta_data[$field_key] = $meta_data[$field_key];
				}
				
			}	
		}
		
		return $post_meta_data;
	}else{
		$value = get_post_meta($post_id,$meta_key);
		$value = !empty($value[0])?$value[0]:'';
		return $value;	
	}
	
}
/* Get Post Meta Data END */


function jobzilla_get_category_by_post_id($post_id)
    {
       $cats = '';
       $cat_list = get_the_category($post_id);
        if(!empty($cat_list))
        {
          foreach($cat_list as $cat)
          {
              $cats .= '<a href="'.esc_url(get_category_link($cat->term_id)).'" class="post-link-in">'.esc_html($cat->name).'</a>';
          }
        }
        
        return $cats;
    }
	
function jobzilla_get_cpt_category($cat_list, $seprator=' ')
    {
       $cats = '';
       if(!empty($cat_list))
        {
          foreach($cat_list as $cat)
          {
			$cats .= '<a href="'.esc_url(get_category_link($cat->term_id)).'">'.esc_html($cat->name).'</a>'.$seprator;
		  }
		  $cats = rtrim($cats,$seprator);
        }
        return $cats;
    }	
	

function jobzilla_filtered_output($output) {
    return apply_filters('jobzilla_filtered_output', $output);
}

function jobzilla_generate_uniq_id($atts)
{
    $atts = (gettype($atts) == 'object') ? json_decode(json_encode($atts), true) : $atts;
    return 'a' . md5(implode($atts));
}

if( !function_exists( 'jobzilla_generate_rand_number' ) )
{
	function jobzilla_generate_rand_number($digit=6)
	{
	  $no = substr(strtoupper(md5(uniqid(rand()))),0,$digit);
	  return $no;
	}
}

if( !function_exists( 'jobzilla_get_container' ) )
{
	function jobzilla_get_container($is_sidebar)
	{
	  $container = ($is_sidebar)?'container':'min-container';
	  return $container;
	}
}

if(!function_exists( 'jobzilla_get_post_tags' ) )
{
	function jobzilla_get_post_tags($post_id)
	{
		 $tag_arr = get_the_tags($post_id);
		 
		$output = '';
		if(!empty($tag_arr))
		{
			 $tag_count = count($tag_arr);
			 
			 foreach($tag_arr as $tag_index => $tag)
			 {
				$tag_name = ($tag_index+1 == $tag_count) ? $tag->name : $tag->name; 
				$output .= '<a href="'.esc_url(get_tag_link($tag->term_id)).'">#'.esc_html($tag_name).'</a>';
			 }
			 $output .= '';
		}
		
		echo wp_kses($output, jobzilla_allowed_html_tag());
	}
}

if(!function_exists( 'jobzilla_get_cat_id_by_slug' ) )
{
	/* Slugs may be array or comma seperated string */
	function jobzilla_get_cat_id_by_slug($slugs,$taxonomy='category')
	{	
		$cat_id = array();
		if(!is_array($slugs)){
			$slugs = explode(',',$slugs);
		}
		
		if(!empty($slugs)){
			foreach($slugs as $slug){
				$category	= get_term_by('slug',$slug,$taxonomy);
				if(!empty($category->term_id)){
					$cat_id[]	= $category->term_id;
				}
			}
		}
		
		return $cat_id;
	}
}

/* Deafault Search Filter: remove pages from search */

add_filter('register_post_type_args', 'jobzilla_filter_search_result', 10, 2);

if(!function_exists( 'jobzilla_filter_search_result' ) )
{
	function jobzilla_filter_search_result($args, $post_type) 
	{
		if (!is_admin() && $post_type == 'page') 
		{
			$args['exclude_from_search'] = true;
		}
		return $args;
	}
}


if(!function_exists( 'jobzilla_allowed_html_tag' ) )
{
	function jobzilla_allowed_html_tag() 
	{
		global $jobzilla_option;
		
		if(!empty($jobzilla_option)){
		    $allowed_html_tags = jobzilla_set($jobzilla_option,'allowed_html_tags');
		}else{
		    $allowed_html_tags = wp_kses_allowed_html('post');
		}
		$allowed_html_tags = !empty($allowed_html_tags)?$allowed_html_tags:'string';
		return $allowed_html_tags;
	}
}

/* Elementor Function */
function jobzilla_elementor_get_anchor_attribute($btn_link)
{
	$anchor_attribute = '';
	
	if(isset($btn_link['is_external']) && $btn_link['is_external']=='on'){
		$anchor_attribute .= ' target=_blank ';
	}
	
	if(isset($btn_link['nofollow']) && $btn_link['nofollow']=='on'){
		$anchor_attribute .= ' rel=nofollow';
	}
	
	if(!empty($btn_link['custom_attributes'])){
		$attr_arr = explode(',',$btn_link['custom_attributes']);
		
		if(!empty($attr_arr)){
			foreach($attr_arr as $key => $value){
				$attr_data = explode('|',$value);
				$anchor_attribute .= ' '.$attr_data[0].'='.$attr_data[1].'';
			}
		}
	}
	
	return $anchor_attribute;
}


/* CPT Team Social Links */
function jobzilla_get_team_social_link($post_id){
	$team_social_data = array(
							'any_fill'=>false,
							'data'=>array()
						);
	
	$team_socials	= array(
		'facebook'=>array(
			'key'  => 'team_social_facebook',	
			'class'=> 'fab fa-facebook-f',
			'url'=> ''
		),
		'twitter'=>array(
			'key'=>'team_social_twitter',	
			'class'=>'fab fa-twitter',
			'url'=> ''
		),
		'instagram'=>array(
			'key'=>'team_social_instagram',
			'class'=>'fab fa-instagram',
			'url'=> ''
		),
		'youtube'=>array(
			'key'=>'team_social_youtube',	
			'class'=>'fab fa-youtube',
			'url'=> ''
		)
	);
					
	
	foreach($team_socials as $key => $value){
		$team_socials[$key]['url'] = jobzilla_get_post_meta($post_id,$value['key']);
		
		if(!empty($team_socials[$key]['url'])){
			$team_social_data['any_fill'] = true;
		}
	}
	
	$team_social_data['data'] = $team_socials;
	
	return $team_social_data;
	
}


/* Change Theme Direction LTR - RTL */
function theme_direction(){
	global $jobzilla_option;
	
	$rtl = jobzilla_set($jobzilla_option, 'rtl_on');
	
	if($rtl){
		echo 'dir="rtl"';
	}
	
	return false;
}

/**
 * Check if plugin is active
 **/
function jobzilla_check_plugin_active($plugin){
	if ( in_array( $plugin, apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
		return true;
	}else{
		return false;
	}
}

function isWebsiteReadyForVisitor($website_status)
{
	if($website_status == 'live_mode'  
		|| (in_array($website_status, array('comingsoon_mode','maintenance_mode')) && is_user_logged_in())
	) 
	{
		return true;
	}else{
		return false;
	}
}

	/* Global variable must be in function or class */
	function getDZThemeReduxOption(){
		global $jobzilla_option;
		
		return $jobzilla_option;
	} 

	/* Get Post Creation Date */
	function get_creation_date( $entry_id = '' ) {
		$post_id  = $entry_id ? $entry_id : get_the_ID();
		$old_date = get_post_meta( $post_id, '_wp_old_date', true );
		return $old_date ? // If the old date exists
		date_i18n( get_option( 'date_format' ), // Retrieve the date in localized format
		strtotime( $old_date ) ) : // and use the display format set on WordPress options
		get_the_date('Y'); // else, use get_the_date()
	}

	function jobzilla_count_posts_by_user($post_author=null,$post_type=array(),$post_status=array()) {
        global $wpdb;

        if(empty($post_author))
            return 0;

        $post_status = (array) $post_status;
        $post_type = (array) $post_type;

        $sql = $wpdb->prepare( "SELECT COUNT(*) FROM $wpdb->posts WHERE post_author = %d AND ", $post_author
		);
		

        //Post status
        if(!empty($post_status)){
            $argtype = array_fill(0, count($post_status), '%s');
            $where = "(post_status=".implode( " OR post_status=", $argtype).') AND ';
            $sql .= $wpdb->prepare($where,$post_status);
			
        }
		
        //Post type
        if(!empty($post_type)){
            $argtype = array_fill(0, count($post_type), '%s');
            $where = "(post_type=".implode( " OR post_type=", $argtype).') AND ';
            $sql .= $wpdb->prepare($where,$post_type);
        }
		
        $sql .='1=1';

        $count = $wpdb->get_var($sql);
        return $count;
    }  
	
	
	
	function jobzilla_count_user_applications($user_id){
    
    global $wpdb;
    
    
    $sql = $wpdb->prepare( "SELECT COUNT(*) FROM {$wpdb->prefix}postmeta WHERE (meta_key = '_candidate_user_id' AND meta_value = %d)",$user_id);
   
    
    $count = $wpdb->get_var($sql);
    if(empty($count)){
        $count = 0;
    }
    return $count;
}

function jobzilla_get_user_menus($roles){
	
	$user_pages = '';
	if(in_array('employer', $roles))
	{		
		$user_pages = array(
			array(
				'label' => esc_html__('Dashboard','jobzilla'),
				'url' 	=> home_url(jobzilla_get_opt('jobzilla_dashboard_page')),
				'class' => 'fa fa-home',
			),
			array(
				'label' => esc_html__('Profile', 'jobzilla'),
				'url' 	=> home_url(jobzilla_get_opt('jobzilla_my_profile_page')),
				'class' => 'fa fa-user',
			),
			array(
				'label' => esc_html__('Manage Jobs','jobzilla'),
				'url' 	=> home_url(jobzilla_get_opt('jobzilla_job_list_page')),
				'class' => 'fa fa-suitcase',
			),
			array(
				'label' => esc_html__('Messages','jobzilla'),
				'url' 	=> home_url(jobzilla_get_opt('jobzilla_messages_page')),
				'class' => 'fa fa-envelope',
			),
			array(
				'label' => esc_html__('Add Jobs','jobzilla'),
				'url' 	=> home_url(jobzilla_get_opt('jobzilla_job_page')),
				'class' => 'fa fa-receipt',
			),
		);
	}else if(in_array('candidate', $roles))
	{
		$user_pages = array(
			array(
				'label' => esc_html__('Dashboard', 'jobzilla'),
				'url' 	=> home_url(jobzilla_get_opt('jobzilla_dashboard_page')),
				'class' => 'fa fa-home',
			),
			
			array(
				'label' => esc_html__('Profile', 'jobzilla'),
				'url' 	=> home_url(jobzilla_get_opt('jobzilla_my_profile_page')),
				'class' => 'fa fa-user',
			),
			array(
				'label' => esc_html__('Bookmark', 'jobzilla'),
				'url' 	=> home_url(jobzilla_get_opt('jobzilla_bookmark_resumes_page')),
				'class' => 'fa fa-bookmark',
			),
			array(
				'label' => esc_html__('Job Alerts', 'jobzilla'),
				'url' 	=> home_url(jobzilla_get_opt('jobzilla_resume_alerts_page')),
				'class' => 'fa fa-bell',
			),
			array(
				'label' => esc_html__('Add Resumes', 'jobzilla'),
				'url' 	=> home_url(jobzilla_get_opt('jobzilla_add_resumes_page')),
				'class' => 'fa fa-receipt',
			),
		);
	}
	
	return $user_pages;
}
 
function jobzilla_get_user_sidebar_menus($roles){
	$user_pages = array();
	if(in_array('employer', $roles))
	{
		$user_pages = array(
			array(
				'label' => esc_html__('Dashboard','jobzilla'),
				'url' 	=> home_url(jobzilla_get_opt('jobzilla_dashboard_page')),
				'class' => 'fa fa-home',
			),
			array(
				'label' => esc_html__('Manage Companies', 'jobzilla'),
				'url' 	=> home_url(jobzilla_get_opt('jobzilla_company_profile_page')),
				'class' => 'fa fa-user-tie',
			),
			array(
				'label' => esc_html__('Add Company', 'jobzilla'),
				'url' 	=> home_url(jobzilla_get_opt('jobzilla_company_add_page')),
				'class' => 'fa fa-receipt',
			),
			array(
				'label' => esc_html__('Profile', 'jobzilla'),
				'url' 	=> home_url(jobzilla_get_opt('jobzilla_my_profile_page')),
				'class' => 'fa fa-user',
			),
			array(
				'label' => esc_html__('Change Password', 'jobzilla'),
				'url' 	=> home_url(jobzilla_get_opt('jobzilla_change_password_page')),
				'class' => 'fa fa-fingerprint',
			),
			array(
				'label' => esc_html__('Manage Jobs','jobzilla'),
				'url' 	=> home_url(jobzilla_get_opt('jobzilla_job_list_page')),
				'class' => 'fa fa-suitcase',
			),
			array(
				'label' => esc_html__('Add Jobs','jobzilla'),
				'url' 	=> home_url(jobzilla_get_opt('jobzilla_job_page')),
				'class' => 'fa fa-receipt',
			),
			array(
				'label' => esc_html__('Bookmark', 'jobzilla'),
				'url' 	=> home_url(jobzilla_get_opt('jobzilla_bookmark_resumes_page')),
				'class' => 'fa fa-bookmark',
			),
			array(
				'label' => esc_html__('Applications', 'jobzilla'),
				'url' 	=> home_url(jobzilla_get_opt('jobzilla_past_applications_page')),
				'class' => 'far fa-file-alt',
			),
			array(
				'label' => esc_html__('Job Alerts', 'jobzilla'),
				'url' 	=> home_url(jobzilla_get_opt('jobzilla_resume_alerts_page')),
				'class' => 'fa fa-bell',
			),
			array(
				'label' => esc_html__('Messages','jobzilla'),
				'url' 	=> home_url(jobzilla_get_opt('jobzilla_messages_page')),
				'class' => 'fa fa-envelope',
			),
			
		);
	}else if(in_array('candidate', $roles))
	{
		$user_pages = array(
			array(
				'label' => esc_html__('Dashboard', 'jobzilla'),
				'url' 	=> home_url(jobzilla_get_opt('jobzilla_dashboard_page')),
				'class' => 'fa fa-home',
			),
			array(
				'label' => esc_html__('Manage Resumes', 'jobzilla'),
				'url' 	=> home_url(jobzilla_get_opt('jobzilla_candidate_page')),
				'class' => 'fa fa-user',
			),
			array(
				'label' => esc_html__('Add Resumes', 'jobzilla'),
				'url' 	=> home_url(jobzilla_get_opt('jobzilla_add_resumes_page')),
				'class' => 'fa fa-receipt',
			),
			array(
				'label' => esc_html__('Profile', 'jobzilla'),
				'url' 	=> home_url(jobzilla_get_opt('jobzilla_my_profile_page')),
				'class' => 'fa fa-user',
			),
			array(
				'label' => esc_html__('Change Password', 'jobzilla'),
				'url' 	=> home_url(jobzilla_get_opt('jobzilla_change_password_page')),
				'class' => 'fa fa-fingerprint',
			),
			array(
				'label' => esc_html__('Bookmark', 'jobzilla'),
				'url' 	=> home_url(jobzilla_get_opt('jobzilla_bookmark_resumes_page')),
				'class' => 'fa fa-bookmark',
			),
			array(
				'label' => esc_html__('Applications', 'jobzilla'),
				'url' 	=> home_url(jobzilla_get_opt('jobzilla_past_applications_page')),
				'class' => 'far fa-file-alt',
			),
			array(
				'label' => esc_html__('Job Alerts', 'jobzilla'),
				'url' 	=> home_url(jobzilla_get_opt('jobzilla_resume_alerts_page')),
				'class' => 'fa fa-bell',
			),
			array(
				'label' => esc_html__('Messages','jobzilla'),
				'url' 	=> home_url(jobzilla_get_opt('jobzilla_messages_page')),
				'class' => 'fa fa-envelope',
			),
		);
	}else if(in_array('administrator', $roles))
	{
		$user_pages = array(
			array(
				'label' => esc_html__('Dashboard','jobzilla'),
				'url' 	=> home_url(jobzilla_get_opt('jobzilla_dashboard_page')),
				'class' => 'fa fa-home',
			),
			array(
				'label' => esc_html__('Manage Companies', 'jobzilla'),
				'url' 	=> home_url(jobzilla_get_opt('jobzilla_company_profile_page')),
				'class' => 'fa fa-user-tie',
			),
			array(
				'label' => esc_html__('Add Company', 'jobzilla'),
				'url' 	=> home_url(jobzilla_get_opt('jobzilla_company_add_page')),
				'class' => 'fa fa-receipt',
			),
			array(
				'label' => esc_html__('Profile', 'jobzilla'),
				'url' 	=> home_url(jobzilla_get_opt('jobzilla_my_profile_page')),
				'class' => 'fa fa-user',
			),
			array(
				'label' => esc_html__('Change Password', 'jobzilla'),
				'url' 	=> home_url(jobzilla_get_opt('jobzilla_change_password_page')),
				'class' => 'fa fa-fingerprint',
			),
			array(
				'label' => esc_html__('Manage Jobs','jobzilla'),
				'url' 	=> home_url(jobzilla_get_opt('jobzilla_job_list_page')),
				'class' => 'fa fa-suitcase',
			),
			array(
				'label' => esc_html__('Add Jobs','jobzilla'),
				'url' 	=> home_url(jobzilla_get_opt('jobzilla_job_page')),
				'class' => 'fa fa-receipt',
			),
			array(
				'label' => esc_html__('Bookmark', 'jobzilla'),
				'url' 	=> home_url(jobzilla_get_opt('jobzilla_bookmark_resumes_page')),
				'class' => 'fa fa-bookmark',
			),
			array(
				'label' => esc_html__('Applications', 'jobzilla'),
				'url' 	=> home_url(jobzilla_get_opt('jobzilla_past_applications_page')),
				'class' => 'far fa-file-alt',
			),
			array(
				'label' => esc_html__('Job Alerts', 'jobzilla'),
				'url' 	=> home_url(jobzilla_get_opt('jobzilla_resume_alerts_page')),
				'class' => 'fa fa-bell',
			),
			array(
				'label' => esc_html__('Messages','jobzilla'),
				'url' 	=> home_url(jobzilla_get_opt('jobzilla_messages_page')),
				'class' => 'fa fa-envelope',
			),
			
			
			array(
				'label' => esc_html__('Manage Resumes', 'jobzilla'),
				'url' 	=> home_url(jobzilla_get_opt('jobzilla_candidate_page')),
				'class' => 'fa fa-user',
			),
			array(
				'label' => esc_html__('Add Resumes', 'jobzilla'),
				'url' 	=> home_url(jobzilla_get_opt('jobzilla_add_resumes_page')),
				'class' => 'fa fa-receipt',
			),
		);
	}
	return $user_pages;
		
} 
 
function get_the_jobzilla_publish_date( $post = null ) {
	$date_format = get_option( 'job_manager_date_format' );

	if ( 'default' === $date_format ) {
		return wp_date( get_option( 'date_format' ), get_post_datetime()->getTimestamp() );
	} else {
		// translators: Placeholder %s is the relative, human readable time since the job listing was posted.
		return sprintf( __( ' %s ago', 'jobzilla' ), human_time_diff( get_post_timestamp(), time() ) );
	}
}

function get_user_by_post($user_id, $post_type, $limit = null){
	$posts_per_page = !empty($limit) ? $limit : '';	
	$query_vars = array(
					'post_type'     => $post_type,
					'post_status'   => 'publish',
					'paged'         => 1,
					'posts_per_page' =>  $posts_per_page,
					'author'        => $user_id,
					'orderby'		=> 'date',
					'order'			=> 'DESC',
					'fields'		=> 'ids',
				);
				$jobs = new WP_Query($query_vars);
				$post = $jobs->posts; 
	return $post;
}

function jobzilla_company_filter(){
	  $taxonomies_args = apply_filters( 'mas_company_taxonomies_list', array(
            'company_category'  => array(
                'singular'                  => esc_html__( 'Industry', 'jobzilla' ),
                'plural'                    => esc_html__( 'Industries', 'jobzilla' ),
                'slug'                      => esc_html_x( 'company-category', 'Company category permalink - resave permalinks after changing this', 'jobzilla' ),
                'enable'                    => get_option('job_manager_company_enable_company_category', true)
            ),
            'company_strength' => array(
                'singular'                  => esc_html__( 'Employee Strength', 'jobzilla' ),
                'plural'                    => esc_html__( 'Employees Strength', 'jobzilla' ),
                'slug'                      => esc_html_x( 'company-employees-strength', 'Company employees strength permalink - resave permalinks after changing this', 'jobzilla' ),
                'enable'                    => get_option('job_manager_company_enable_company_strength', true)
            ),
            'company_average_salary'    => array(
                'singular'                  => esc_html__( 'Avg. Salary', 'jobzilla' ),
                'plural'                    => esc_html__( 'Avg. Salary', 'jobzilla' ),
                'slug'                      => esc_html_x( 'company-average-salary', 'Company avarage salary permalink - resave permalinks after changing this', 'jobzilla' ),
                'enable'                    => get_option('job_manager_company_enable_average_salary', true)
            ),
            'company_revenue'    => array(
                'singular'                  => esc_html__( 'Revenue', 'jobzilla' ),
                'plural'                    => esc_html__( 'Revenue', 'jobzilla' ),
                'slug'                      => esc_html_x( 'company-revenue', 'Company revenue permalink - resave permalinks after changing this', 'jobzilla' ),
                'enable'                    => get_option('job_manager_company_enable_company_revenue', true)
            ),
        ) ); 
	
	return $taxonomies_args;
}

function jobzilla_company_dropdown_categories($taxonomy_name, $singular, $selected){ ?>
		<div class="form-group">
			<label class="section-head-small"><?php echo esc_html($singular); ?></label>
			<?php
			$dropdown = wp_dropdown_categories( array(
				'show_option_all'           => $singular,
				'hierarchical'              => true,
				'orderby'                   => 'name',
				'taxonomy'                  => $taxonomy_name,
				'name'                      => 'filter_'.$taxonomy_name,
				'id'                        => $taxonomy_name,
				'class'                     => 'wt-select-bar-large selectpicker',
				'hide_empty'                => 1,
				'value_field'               => 'slug',
				'selected'                  => $selected,
			)  );?>
		</div>
	<?php
	return $dropdown;
}

/* Comments Extra Field */
add_filter('mas_wpjmcr_rating_field', 'jobzilla_mas_wpjmcr_rating');
function jobzilla_mas_wpjmcr_rating($output){
	?>
	<div id='mas-wpjmcr-submit-ratings' class='review-form-stars'>
        <div class='star-ratings ratings list-inline'>
			<?php 
			foreach ( mas_wpjmcr_get_categories() as $index => $category ){ ?>
				<div class="rating-row list-inline-item mb-3">
					<label class="form-label"><?php echo apply_filters( 'mas_wpjmcr_category_label', $category ); ?></label>
					<div class='stars choose-rating' data-rating-category='<?php echo esc_html($index); ?>'>
						<?php for ( $i = mas_wpjmcr_get_max_stars(); $i > 0 ; $i-- ){ ?>
							<span data-star-rating='<?php echo esc_html($i); ?>' class="star dashicons dashicons-star-empty"></span>
						<?php } ?>
						<input type='hidden' class='required' name='star-rating-<?php echo esc_html($index); ?>' value=''>
					</div>
				</div><!-- .rating-row -->
			<?php } ?>
		</div>
	</div>

<?php if ( get_option( 'mas_wpjmcr_allow_images', false ) ){?>
	<div id="mas-wpjmcr-submit-gallery" class="review-form-gallery mb-6">
		<div class="btn btn-sm btn-primary transition-3d-hover file-attachment-btn" for="mas-wpjmcr-gallery-input">
			<?php $label_text = apply_filters( 'mas_wpjmcr_upload_button_text', esc_html__( 'Photo Gallery', 'jobzilla' ) ); ?>
			<label class="sr-only"><?php echo esc_html( $label_text ) ?></label>
			<span><?php echo esc_html( $label_text ) ?></span>
			<?php ; ?>
			<input id="mas-wpjmcr-gallery-input" name="mas-wpjmcr-gallery[]" type="file" multiple="multiple" accept="image/*" class="file-attachment-btn__label">
		</div>
	</div>
<?php } 

	if ( get_option( 'mas_wpjmcr_enable_title', false ) ){ ?>
		<p id="mas-wpjmcr-review-title" class="review-form-title js-form-message mb-6">
			<label class="form-label" for="mas-wpjmcr-title-input">
				<?php esc_html_e( 'Comment Title', 'jobzilla' ); ?>
			</label>
			<input type="text" class="form-control" id="mas-wpjmcr-title-input" placeholder="<?php echo esc_html__('Comment Title', 'jobzilla'); ?>" name="mas-wpjmcr-title">
		</p><!-- #mas-wpjmcr-comment-form-title -->
	<?php } 	
}

function jobzilla_alpha_remove_class($wp_classes){
  unset( $wp_classes[ array_search( "single-company", $wp_classes ) ] );
  unset( $wp_classes[ array_search( "single-job_listing", $wp_classes ) ] );
  unset( $wp_classes[ array_search( "single-resume", $wp_classes ) ] );

  return $wp_classes;
}
add_filter( 'body_class', 'jobzilla_alpha_remove_class' );

function jobzilla_load_template_part($template_name, $part_name=null, $args=array()) {
    ob_start();
    get_template_part($template_name, $part_name, $args);
    $var = ob_get_contents();
    ob_end_clean();
    return $var;
}

function jobzilla_get_cpt_data($post_type){
	$args = array(
			'post_type'         => $post_type,
			'post_status'       => 'publish',
			'order'             => 'ASC',
			'posts_per_page'    => -1,
		);
	$result = new WP_Query($args);
	
	
	$posts = $result->posts;
	return $posts;
}
function jonzilla_get_unique_location(){
	$posts = jobzilla_get_cpt_data('job_listing');
	$count = 0;
	$array = array();
	if(!$posts){ return false ;}
	foreach($posts as $post){
		$array[$count] = jobzilla_get_post_meta($post->ID, '_job_location');
		$count++; 
	}
	return array_unique($array);
}

function jobzilla_get_job_salary($data, $symbol = ''){
	if ( !empty($data['_job_salary']) ) { 
		if ( !empty($data['_job_salary_currency'] )) { echo esc_html($data['_job_salary_currency']); } 
		echo esc_html($data['_job_salary']); 
	} 
	if(!empty($data['_salary_max'])) { if ( !empty($data['_job_salary'] )) { echo ' - '; } 
	if ( !empty($data['_job_salary_currency']) ) { echo esc_html($data['_job_salary_currency']); } 
		
		echo esc_html($data['_salary_max']);
	} 
	if($symbol && !empty($data['_job_salary_unit'])){
		echo esc_html('/ '.ucfirst($data['_job_salary_unit'])); 
	}elseif ( !empty($data['_job_salary_unit']) && (!empty($data['_job_salary']) || !empty($data['_salary_max'])) ) { 
	?>
	<span><?php echo esc_html('/ '.ucfirst($data['_job_salary_unit'])); ?></span>	
<?php }	
}
get_template_part('dz-inc/elementor/job-map-listing/job-grid-listing');
