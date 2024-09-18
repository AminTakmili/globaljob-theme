<?php

	$theme = wp_get_theme();
	$theme_name 	= $theme->name;
	$theme_version = $theme->version;
 
	$max_execution_time = ini_get('max_execution_time');

	$max_input_vars = ini_get('max_input_vars');

	$post_max_size = ini_get('post_max_size');

	$php_version = phpversion();

	ob_start();

	phpinfo(INFO_MODULES);

	$info = ob_get_contents();

	ob_end_clean();

	$info = stristr($info, 'Client API version');

	preg_match('/[1-9].[0-9].[1-9][0-9]/', $info, $match);

	$mysql_version = $match[0]; 

	$post_max = str_replace("M","",$post_max_size);

	$wp_version = get_bloginfo('version');

	$wp_mem = str_replace("M","",WP_MEMORY_LIMIT);

	
	$system_arr = array(
				array(
					'section_name' => esc_html__('Theme Config','jobzilla'),
					'col_span'	   => 4,
					'rows'=>array(
						/* Table Rows */
						array(
							'cols'=>array(
								array(
									'td'		=>esc_html__('Theme Config','jobzilla'),
									'width'	=> '20%'
								),
								array(
									'td'		=>$theme_name,
								),
							),
						),
						array(
							'cols'=>array(
								array(
									'td'		=>esc_html__('Theme Version','jobzilla'),
								),
								array(
									'td'		=>$theme_version,
								),
							),
						),
					)
				),
				array(
					'section_name' => esc_html__('PHP Config','jobzilla'),
					'col_span'	   => 4,
					'rows'=>array(
						/* Table Rows */
						array(
							'cols'=>array(
								array(
									'td'=> esc_html__('Server Software','jobzilla'),
									'width'=>'20%'
								),
								array(
									'td'=> esc_html(wp_get_server_protocol()),
									'width'=>'30%'
								),
							)
						),
						array(
							'cols'=>array(
								array(
									'td'=> esc_html__('PHP','jobzilla'),
								),
								array(
									'td'=> $php_version,
								),
								array(
									'td'=> esc_html__('Required version 7.0 or greater.','jobzilla'),
									'width'=>'40%',
								),
								array(
									'td'=> ($php_version >= 5.6)?'success':'danger',
								),
							)
						),
						array(
							'cols'=>array(
								array(
									'td'=> esc_html__('MySQL','jobzilla'),
								),
								array(
									'td'=> esc_attr( $mysql_version ),
								),
								array(
									'td'=> esc_html__('Required version 5 or greater.','jobzilla'),
									'width'=>'40%',
								),
								array(
									'td'=> ($mysql_version >= 5)?'success':'danger',
								),
							)
						),
						array(
							'cols'=>array(
								array(
									'td'=> esc_html__('Max Execution Time','jobzilla'),
								),
								array(
									'td'=> esc_attr( $max_execution_time ),
								),
								array(
									'td'=> esc_html__('Required max_execution_time more than 300.','jobzilla'),
									'width'=>'40%',
								),
								array(
									'td'=> ($max_execution_time >= 300)?'success':'danger',
								),
							)
						),
						array(
							'cols'=>array(
								array(
									'td'=> esc_html__('Max Input Vars','jobzilla'),
								),
								array(
									'td'=> esc_attr( $max_input_vars ),
								),
								array(
									'td'=> esc_html__('Required max_input_vars more than 1000.','jobzilla'),
								),
								array(
									'td'=> ($max_input_vars >= 1000)?'success':'danger',
								),
							)
						),
						array(
							'cols'=>array(
								array(
									'td'=> esc_html__('Post Max Size','jobzilla'),
								),
								array(
									'td'=> esc_attr( $post_max_size ),
								),
								array(
									'td'=> esc_html__('Required post_max_size more than 32.','jobzilla'),
								),
								array(
									'td'=> ($post_max_size >= 32)?'success':'danger',
								),
							)
						),
					)
				),
				array(
					'section_name' => esc_html__('WordPress Config','jobzilla'),
					'col_span'	   => 4,
					'rows'=>array(
						/* Table Rows */
						array(
							'cols'=>array(
								array(
									'td'		=>esc_html__('Site URL','jobzilla'),
									'width'	 => '20%'
								),
								array(
									'td' =>esc_url( get_site_url() ),
								),
							),
						),
						array(
							'cols'=>array(
								array(
									'td'		=>esc_html__('Home URL','jobzilla'),
									'width'	    => '20%'
								),
								array(
									'td'		=>esc_url( get_home_url() ),
								),
							),
						),
						array(
							'cols'=>array(
								array(
									'td'		=>esc_html__('WP version','jobzilla'),
									'width'	    => '20%'
								),
								array(
									'td'		=>esc_attr( $wp_version ),
									'width'	    => '30%'
								),
								array(
									'td'		=>esc_html__('Required version 5.0 or greater','jobzilla'),
									'width'	    => '40%'
								),
								array(
									'td'		=>version_compare( $wp_version, '4.5', '>=') ? 'success' : ' danger',
								),
							),
						),
						array(
							'cols'=>array(
								array(
									'td'		=>esc_html__('WP Multisite Status','jobzilla'),
									'width'	    => '20%'
								),
								array(
									'td'		=>is_multisite() ? esc_html__('Yes', 'jobzilla') : esc_html__('No', 'jobzilla'),
								),
							),
						),
						array(
							'cols'=>array(
								array(
									'td'		=>esc_html__('WP Language','jobzilla'),
									'width'	    => '20%'
								),
								array(
									'td'		=>get_locale(),
								),
							),
						),
						array(
							'cols'=>array(
								array(
									'td'		=>esc_html__('WP Memory Limit','jobzilla'),
									'width'	    => '20%'
								),
								array(
									'td'		=>WP_MEMORY_LIMIT,
								),
								array(
									'td'		=>esc_html__('Required memory limit 64M.','jobzilla'),
								),
								array(
									'td'		=>$wp_mem >= 64 ? 'success' : 'danger',
								),
							),
						),
					)
				),
			); 
 
?>

<div class="wrap welcome-wrap dz-wrap">
	<h1 class="hide" style="display:none;"></h1>
	<div class="dz-welcome-inner">
		<nav class="dz-nav-tab-wrapper nav-tab-wrapper">
			<a class="nav-tab" href="<?php echo admin_url( 'admin.php?page=jobzilla' ) ?>">
				<?php echo esc_html__( 'Introduction', 'jobzilla' ); ?>
			</a>
			<a class="nav-tab" href="<?php echo admin_url( 'admin.php?page=dz-plugins' ) ?>">
				<?php echo esc_html__( 'Plugins', 'jobzilla' ); ?>
			</a>
			<a class="nav-tab nav-tab-active" href="#">
				<?php echo esc_html__( 'System Status', 'jobzilla' ); ?>
			</a>
		</nav>
	</div>
	
	<div class="system-status-wrapper">
		<h3><?php echo esc_html($theme->Name).' '.esc_html__('System Status', 'jobzilla'); ?></h3>
		
		<?php foreach($system_arr as $data){ ?>
		
			<table class="widefat" cellspacing="0">
			
				<thead>
					<tr>
						<th colspan="<?php echo esc_attr($data['col_span']); ?>">
							<b><?php echo esc_attr($data['section_name']); ?></b>
						</th>
					</tr>
				</thead>
				
				<tbody>
				<?php foreach($data['rows'] as $row) { ?>
					<tr>
						<?php foreach($row['cols'] as $col) { ?>
								<td <?php echo (!empty($col['width']))?'width="'.$col['width'].'"':''; ?> >
									<?php 
										if($col['td'] == 'success'){
											echo '<i aria-hidden="true" class="fa fa-check success"></i>';	
										}else if($col['td'] == 'danger'){
											echo '<i aria-hidden="true" class="fa fa-times danger"></i>';
										}else{
											echo esc_html($col['td']);
										}
									?>
								</td>
						<?php } ?>
					</tr>
				<?php } ?>
				</tbody>
			</table>
		<?php } ?>
	</div>
</div>