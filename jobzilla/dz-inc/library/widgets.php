<?php
/*About Us*/

class Jobzilla_DZ_About_Us extends WP_Widget
{
	/** constructor */
	function __construct()
	{
		parent::__construct( /* Base ID */'Jobzilla_DZ_About_Us', /* Name */esc_html__('Jobzilla About Us','jobzilla'), array( 'description' => esc_html__('Show the information about company', 'jobzilla' )) );
	}
	
	/** @see WP_Widget::widget */
	function widget($args, $instance)
	{
		extract( $args );
		$allowed_html_tags = jobzilla_allowed_html_tag();
		$title = apply_filters( 'widget_title', $instance['title'] );
		
		
		echo wp_kses($before_widget,$allowed_html_tags); 
		
		
		
		?>
			<?php if(!empty($title)){ ?>
				<?php echo wp_kses($before_title.$title.$after_title, $allowed_html_tags); ?>
			<?php } ?>
		
			<?php if(!empty($instance['logo_url'])){ ?>
				<div class="logo-footer clearfix">
					<a href="<?php echo esc_url(home_url('/')); ?>">
						<img src="<?php echo esc_url($instance['logo_url']); ?>" alt="<?php echo esc_attr__('Image','jobzilla'); ?>">
					</a>
				</div>
			<?php } ?>
			
			
			
			<p><?php echo wp_kses($instance['content'],'string'); ?></p>
			
			 <ul class="ftr-list">
				<li>
					<p>
						<span><?php echo wp_kses($instance['contect_title_1'],'string'); ?></span><?php echo wp_kses($instance['contect_value_1'],'string'); ?>
					</p>
				</li>
				<li>
					<p>
						<span><?php echo wp_kses($instance['contect_title_2'],'string'); ?></span>
						<?php echo wp_kses($instance['contect_value_2'],'string'); ?>
					</p>
				</li>
				<li>
					<p>
						<span><?php echo wp_kses($instance['contect_title_3'],'string'); ?></span>
						<?php echo wp_kses($instance['contect_value_3'],'string'); ?>
					</p>
				</li>
			</ul>
			
			
		<?php echo wp_kses($after_widget,$allowed_html_tags);
	}
	
	/** @see WP_Widget::update */
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['logo_url'] = $new_instance['logo_url'];
		$instance['content'] = $new_instance['content'];
		$instance['contect_title_1'] = $new_instance['contect_title_1'];
		$instance['contect_value_1'] = $new_instance['contect_value_1'];
		$instance['contect_title_2'] = $new_instance['contect_title_2'];
		$instance['contect_value_2'] = $new_instance['contect_value_2'];
		$instance['contect_title_3'] = $new_instance['contect_title_3'];
		$instance['contect_value_3'] = $new_instance['contect_value_3'];
		return $instance;
	}
	
	/** @see WP_Widget::form */
	function form($instance)
	{
		$title = ($instance) ? esc_attr($instance['title']) : '';
		$logo_url = !empty($instance['logo_url']) ? $instance['logo_url'] : get_template_directory_uri().'/assets/images/logo-light.png';
		$content = !empty($instance['content']) ? $instance['content'] : esc_html__('Many desktop publishing packages and web page editors now.', 'jobzilla');
		
		$contect_title_1 = !empty($instance['contect_title_1']) ? $instance['contect_title_1'] : esc_html__('Address', 'jobzilla');
		$contect_value_1 = !empty($instance['contect_value_1']) ? $instance['contect_value_1'] : esc_html__('65 Sunset CA 90026, USA', 'jobzilla');
		
		$contect_title_2   = !empty($instance['contect_title_2']) ? $instance['contect_title_2'] : esc_html__('Email', 'jobzilla');
		$contect_value_2   = !empty($instance['contect_value_2']) ? $instance['contect_value_2'] : esc_html__('example@domain.com', 'jobzilla');
		
		$contect_title_3  = !empty($instance['contect_title_3']) ? $instance['contect_title_3'] : esc_html__('Call', 'jobzilla') ;
		$contect_value_3    = !empty($instance['contect_value_3']) ? $instance['contect_value_3'] : esc_html__('555-555-1234', 'jobzilla') ;
		
		$social_icon = isset($instance['social_icon']) ? esc_attr($instance['social_icon']) : '';
		?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('logo_url')); ?>"><?php esc_html_e('Logo url here:', 'jobzilla'); ?></label>
            <input placeholder="<?php esc_attr_e('Logo url', 'jobzilla'); ?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('logo_url')); ?>" name="<?php echo esc_attr($this->get_field_name('logo_url')); ?>" type="text" value="<?php echo esc_attr($logo_url); ?>" />
        </p>
		
		<p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'jobzilla'); ?></label>
            <input placeholder="<?php esc_html_e('About us', 'jobzilla');?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
		<p>
            <label for="<?php echo esc_attr($this->get_field_id('content')); ?>"><?php esc_html_e('Content :', 'jobzilla'); ?></label>
            <input placeholder="<?php esc_html_e('Content', 'jobzilla');?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('content')); ?>" name="<?php echo esc_attr($this->get_field_name('content')); ?>" type="text" value="<?php echo esc_attr($content); ?>" />
        </p>
		
		<p>
            <label for="<?php echo esc_attr($this->get_field_id('contect_title_1')); ?>"><?php esc_html_e('Contect Title 1:', 'jobzilla'); ?></label>
            <input placeholder="<?php esc_html_e('Contect Title 1', 'jobzilla');?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('contect_title_1')); ?>" name="<?php echo esc_attr($this->get_field_name('contect_title_1')); ?>" type="text" value="<?php echo esc_attr($contect_title_1); ?>" />
        </p>
		
		<p>
            <label for="<?php echo esc_attr($this->get_field_id('contect_value_1')); ?>"><?php esc_html_e('Contect Value 1:', 'jobzilla'); ?></label>
            <input placeholder="<?php esc_html_e('Contect Value 1', 'jobzilla');?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('contect_value_1')); ?>" name="<?php echo esc_attr($this->get_field_name('contect_value_1')); ?>" type="text" value="<?php echo esc_attr($contect_value_1); ?>" />
        </p>
		
		<p>
            <label for="<?php echo esc_attr($this->get_field_id('contect_title_2')); ?>"><?php esc_html_e('Contect Title 2:', 'jobzilla'); ?></label>
            <input placeholder="<?php esc_html_e('Contect Title 2', 'jobzilla');?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('contect_title_2')); ?>" name="<?php echo esc_attr($this->get_field_name('contect_title_2')); ?>" type="text" value="<?php echo esc_attr($contect_title_2); ?>" />
        </p>
		
		<p>
            <label for="<?php echo esc_attr($this->get_field_id('contect_value_2')); ?>"><?php esc_html_e('Contect Value 2:', 'jobzilla'); ?></label>
            <input placeholder="<?php esc_html_e('Contect Value 2', 'jobzilla');?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('contect_value_2')); ?>" name="<?php echo esc_attr($this->get_field_name('contect_value_2')); ?>" type="text" value="<?php echo esc_attr($contect_value_2); ?>" />
        </p>
		<p>
            <label for="<?php echo esc_attr($this->get_field_id('contect_title_3')); ?>"><?php esc_html_e('Contect title 3:', 'jobzilla'); ?></label>
            <input placeholder="<?php esc_html_e('Contect title 3', 'jobzilla');?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('contect_title_3')); ?>" name="<?php echo esc_attr($this->get_field_name('contect_title_3')); ?>" type="text" value="<?php echo esc_attr($contect_title_3); ?>" />
        </p>
		<p>
            <label for="<?php echo esc_attr($this->get_field_id('contect_value_3')); ?>"><?php esc_html_e('Contect Value 3:', 'jobzilla'); ?></label>
            <input placeholder="<?php esc_html_e('Contect Value 3', 'jobzilla');?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('contect_value_3')); ?>" name="<?php echo esc_attr($this->get_field_name('contect_value_3')); ?>" type="text" value="<?php echo esc_attr($contect_value_3); ?>" />
        </p>
	<?php 
	}
}


/*Footer Nevigation*/
class Jobzilla_DZ_Navigation extends WP_Widget
  {
    
    /** constructor */
    function __construct()
    {
      parent::__construct( /* Base ID */'Jobzilla_DZ_Navigation', /* Name */esc_html__('Jobzilla Navigation','jobzilla'), array( 'description' => esc_html__('Show the Navigation', 'jobzilla' )) );
    }
    
    /** @see WP_Widget::widget */
    function widget($args, $instance)
    {
		
		
      extract( $args );
      
		$title = apply_filters( 'widget_title', $instance['title'] );
		
		$allowed_html_tags = jobzilla_allowed_html_tag();
	  
		echo wp_kses($before_widget, $allowed_html_tags);		
		
		if(!empty($title)){
			echo wp_kses($before_title.$title.$after_title, $allowed_html_tags); 
		}			
				  
		$menu_items = wp_get_nav_menu_items($instance['selected_menu']);  
		
		$menu_class = ($instance['menu_style']=='style_2') ? 'list-2' : '';	
		
		?>
		<ul class="<?php echo esc_attr($menu_class); ?>">
			<?php 
			foreach($menu_items as $menu_item){ 
				$title = '';
				if(!empty($menu_item->post_title)){
					$title = $menu_item->post_title; 
				}else if(!empty($menu_item->title)){
					$title = $menu_item->title;
				}
			?>
			<li>
			  <a href="<?php echo esc_url($menu_item->url); ?>"><?php echo esc_html($title); ?></a>
			</li>
			<?php } ?>
		</ul>
		<?php
		
		 echo wp_kses($after_widget, $allowed_html_tags);
      
    }
    
    
    /** @see WP_Widget::update */
    function update($new_instance, $old_instance)
    {
      $instance = $old_instance;
      
      $instance['title'] = strip_tags($new_instance['title']);
      $instance['menu_style'] = strip_tags($new_instance['menu_style']);
      $instance['selected_menu'] = strip_tags($new_instance['selected_menu']);
      
      
      
      return $instance;
    }
    
    /** @see WP_Widget::form */
    function form($instance)
    {
      $title = ($instance) ? esc_attr($instance['title']) : esc_html__('Navigation', 'jobzilla');
      $selected_menu = ! empty( $instance['selected_menu'] ) ? $instance['selected_menu'] : "";
      $menu_style = ! empty( $instance['menu_style'] ) ? $instance['menu_style'] : "";
    ?>
    
    <p>
      <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'jobzilla'); ?></label>
      <input placeholder="<?php esc_attr_e('Menu', 'jobzilla');?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
    </p>
    <p>
      <label for="<?php echo esc_attr( $this->get_field_id( 'Select Menu' ) ); ?>"><?php esc_html_e( 'Select Menu:', 'jobzilla' ); ?></label> 
      <select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'selected_menu' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'selected_menu' ) ); ?>">
				<?php 
					
					$all_menus = get_terms( 'nav_menu', array( 'hide_empty' => true ) );
					foreach (  $all_menus as $menu ) {
						
					
					$selected = ($selected_menu == $menu->slug )?  ' selected="selected" ':'';
				?>
					<option value="<?php echo esc_attr($menu->slug);?>" <?php echo esc_attr($selected); ?> ><?php echo  esc_html($menu->name); ?></option>
          <?php 
          }
          
        ?>
      </select>
    </p>
    <p>
      <label for="<?php echo esc_attr( $this->get_field_id( 'Select Menu Style' ) ); ?>"><?php esc_html_e( 'Select Menu Style:', 'jobzilla' ); ?></label> 
	  <?php
		$style_arr = array(
						'style_1'=>esc_html__('Style 1','jobzilla'),
						'style_2'=>esc_html__('Style 2','jobzilla')
					);
	  ?>
      <select data="<?php echo esc_attr($menu_style) ?>"
	  class="widefat" 
	  id="<?php echo esc_attr( $this->get_field_id( 'menu_style' ) ); ?>" 
	  name="<?php echo esc_attr( $this->get_field_name( 'menu_style' ) ); ?>"
	  >
        <option value=""><?php echo esc_html__('Choose Style','jobzilla'); ?></option>
        <?php foreach($style_arr as $style_key => $style_value ){ 
			$style_selected = ($style_key == $menu_style)?'selected="selected"':'';
		?>
		<option value="<?php echo sanitize_title($style_key); ?>" <?php echo esc_attr($style_selected); ?> ><?php echo esc_html($style_value); ?></option>
		<?php } ?>
      </select>
    </p>  
    
    
    
		<?php 
    }
    
  }

  
/*Latest Post*/
  class Jobzilla_DZ_Recent_Post extends WP_Widget
  {
    /** constructor */
    function __construct()
    {
      parent::__construct( /* Base ID */'Jobzilla_DZ_Recent_Post', /* Name */esc_html__('Jobzilla Recent Post','jobzilla'), array( 'description' => esc_html__('Show the footer recent posts sidebar', 'jobzilla' )) );
    }
    
    /** @see WP_Widget::widget */
    function widget($args, $instance)
    {
      extract( $args );
      $title = apply_filters( 'widget_title', $instance['title'] );
	  
	  $allowed_html_tags = jobzilla_allowed_html_tag();
	  
    echo wp_kses($before_widget,  $allowed_html_tags); ?>
		<div class="recent-posts-entry">
			<?php echo wp_kses($before_title.$title.$after_title,  $allowed_html_tags); ?>			
			<?php 
				$query_string = 'posts_per_page='.$instance['number'];
				if( $instance['cat'] ) $query_string .= '&cat='.$instance['cat'];					  
				$this->posts($query_string);  
			?>				
		</div>
    
		<?php echo wp_kses($after_widget,  $allowed_html_tags);
    }
    
    /** @see WP_Widget::update */
    function update($new_instance, $old_instance)
    {
      $instance = $old_instance;
      
      $instance['title'] = strip_tags($new_instance['title']);
      $instance['number'] = $new_instance['number'];
      $instance['cat'] = $new_instance['cat'];
      
      return $instance;
    }
    
    /** @see WP_Widget::form */
    function form($instance)
    {
      $title = ( $instance ) ? esc_attr($instance['title']) : esc_html__('LATEST NEWS', 'jobzilla');
      $number = ( $instance ) ? esc_attr($instance['number']) : 3;
    $cat = ( $instance ) ? esc_attr($instance['cat']) : ''; ?>
		
    <p>
      <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title: ', 'jobzilla'); ?></label>
      <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
    </p>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id('number')); ?>"><?php esc_html_e('No. of Posts:', 'jobzilla'); ?></label>
      <input class="widefat" id="<?php echo esc_attr($this->get_field_id('number')); ?>" name="<?php echo esc_attr($this->get_field_name('number')); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" />
    </p>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id('cat')); ?>"><?php esc_html_e('Category', 'jobzilla'); ?></label>
      <?php wp_dropdown_categories( array('show_option_all'=>esc_html__('All Categories', 'jobzilla'), 'selected'=>$cat, 'class'=>'widefat', 'name'=>$this->get_field_name('cat')) ); ?>
    </p>
    
		<?php 
    }
    
    function posts($query_string)
    {
      $query = new WP_Query($query_string);
    if( $query->have_posts() ):?>
    <!-- Title -->
	<div class="widget-post-bx">
    <?php while( $query->have_posts() ): $query->the_post(); ?>
    <!-- Widget Post -->
		<div class="widget-post clearfix">
			<div class="dz-media"> 
				<?php the_post_thumbnail('thumbnail'); ?> 
			</div>
				<div class="dz-info">
					<h6 class="title"> 
						<a href="<?php echo esc_url( the_permalink( get_the_id() ) );?>"><?php echo jobzilla_trim(get_the_title(),6); ?></a>
					</h6>
					<div class="dz-meta">
						<ul>
							<li class="post-date"> <i class="las la-calendar"></i>
								<?php echo esc_html(get_the_date()); ?>
							</li>
						</ul>
					</div>
				</div>
			</div>
    <?php endwhile; ?>
    </div>

    <?php  endif;
      wp_reset_postdata();
    }
  }

 