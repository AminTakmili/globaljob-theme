<?php 
add_action('jobzilla_recent_activities', 'jobzilla_all_recent_activities');
function jobzilla_all_recent_activities(){ 
	$items = array();
	if(class_exists('DZ_Recent_Activities')){
		$activityObj = new DZ_Recent_Activities();
		$items = $activityObj->dz_core_activity(20);
	}
?>
	<div class="col-lg-12 col-md-12">
		<div class="panel panel-default site-">
			<div class="panel-heading wt-panel-heading">
				<h5 class="panel-tittle m-a0">
					<i class="far fa-list-alt"></i>
					<?php echo esc_html__('Recent Activities', 'jobzilla'); ?>
				</h5>
			</div>
			<?php if(!empty($items)){ ?>
			<div class="panel-body wt-panel-body p-0">		
				<div class="dashboard-list-box list-box-with-icon">
					<ul>
					<?php
					
						foreach ($items as $item) {
							$post_title = get_the_title( $item->post_id );
							$post_url	= get_permalink( $item->post_id );
							$post_status = get_post_status($item->post_id );
							if($post_status != "publish") {
								$post_url = "#";
							}
							$class = ($post_status == 'expired')? 'text-danger' :'text-success';
							$nonce = wp_create_nonce( 'delete_activity-' . $item->post_id  );
							$end = '<span class="activity-time ">'.human_time_diff(strtotime($item->created), strtotime(date_i18n('Y-m-d H:i:s'))) .' '. esc_html__('ago','jobzilla').'</span>';
							$end .= '<a href="javascript:void(0)" class="close-list-item color-lebel clr-red"  data-id="'.$item->id.'"><i class="far fa-trash-alt"></i></a></li>';	
							switch ($item->activity) {
								case 'listing_updated':
									echo '<li class="delete-'.$item->id.'">
										<i class="fa fa-envelope  list-box-icon"></i> '.esc_html__('Listing','jobzilla').' <strong><a class="'.$class.'" href="'.esc_url($post_url).'">'.esc_html($post_title).'</a></strong> '.esc_html__('was updated','jobzilla').'.
									'.$end;
									break;
								case 'listing_created':
									echo '<li class="delete-'.$item->id.'">
									<i class="fa fa-envelope text-success list-box-icon"></i> '.esc_html__('Listing','jobzilla').' <strong><a class="'.$class.'" href="'.esc_url($post_url).'">'.esc_html($post_title).'</a></strong> '.esc_html__('was created. ','jobzilla').$end;
									break;
								case 'listing_approved':
									echo '<li class="delete-'.$item->id.'">
									<i class="fa fa-envelope text-success list-box-icon"></i> '.esc_html__('Your Listing','jobzilla').' <strong><a class="'.$class.'" href="'.esc_url($post_url).'">'.esc_html($post_title).'</a></strong> '.esc_html__('was approved','jobzilla').'
									'.$end;
									break;
								case 'listing_trashed':
									echo '<li class="delete-'.$item->id.'">
									<i class="fa fa-envelope text-success list-box-icon"></i> '.esc_html__('Listing','jobzilla').' <strong><a class="'.$class.'" href="'.esc_url($post_url).'">'.esc_html($post_title).'</a></strong> '.esc_html__('was removed','jobzilla').'
									'.$end;
									break;	
								case 'resume_updated':
									echo '<li class="delete-'.$item->id.'">
									<i class="fa fa-envelope text-success list-box-icon"></i> '.esc_html__('Resume','jobzilla').' <strong><a class="'.$class.'" href="'.esc_url($post_url).'">'.esc_html($post_title).'</a></strong> '.esc_html__('was updated','jobzilla').'.
									'.$end;
									break;
								case 'resume_created':
									echo '<li class="delete-'.$item->id.'">
									<i class="fa fa-envelope text-success list-box-icon"></i> '.esc_html__('Resume','jobzilla').' <strong><a class="'.$class.'" href="'.esc_url($post_url).'">'.esc_html($post_title).'</a></strong> '.esc_html__('was created.','jobzilla').$end;
									break;
								case 'resume_approved':
									echo '<li class="delete-'.$item->id.'">
									<i class="fa fa-envelope text-success list-box-icon"></i> '.esc_html__('Your Resume','jobzilla').' <strong><a class="'.$class.'" href="'.esc_url($post_url).'">'.esc_html($post_title).'</a></strong> '.esc_html__('was approved','jobzilla').'
									'.$end;
									break;
								case 'resume_trashed':
									echo '<li class="delete-'.$item->id.'">
									<i class="fa fa-envelope text-success list-box-icon"></i> '.esc_html__('Resume','jobzilla').' <strong><a class="'.$class.'" href="'.esc_url($post_url).'">'.esc_html($post_title).'</a></strong> '.esc_html__('was removed','jobzilla').'
									'.$end;
									break;

								case 'approved':
									echo '
									<li class="delete-'.$item->id.'">
									<i class="fa fa-envelope text-success list-box-icon"></i> '.esc_html__('Your Listing','jobzilla').' <strong><a class="'.$class.'" href="'.esc_url($post_url).'">'.esc_html($post_title).'</a></strong> '.esc_html__('has been approved!','jobzilla').'
										<a href="#" class="close-list-item"><i class="fa fa-close"></i></a>
									</li>';
									break;
								case 'added':
									echo '
									<li class="delete-'.$item->id.'">
									<i class="fa fa-envelope text-success list-box-icon"></i> '.esc_html__('You have added listing','jobzilla').' <strong><a class="'.$class.'" href="'.esc_url($post_url).'">'.esc_html($post_title).'</a></strong> 
										<a href="#" class="close-list-item"><i class="fa fa-close"></i></a>
									</li>';
									break;
								case 'applied':
									echo '
									<li class="delete-'.$item->id.'">
									<i class="fa fa-envelope text-success list-box-icon"></i> '.esc_html__('Someone applied to your job ','jobzilla').' <strong><a class="'.$class.'" href="'.esc_url($post_url).'">'.esc_html($post_title).'</a></strong> 
										<a href="#" class="close-list-item"><i class="fa fa-close"></i></a>
									</li>';
									break;						
								default:
									# code...
									break;
							} 
						}
						
					?>
					
					</ul>
				
				</div>
							
			</div>
			<?php }else{
				echo '<div class="no-record-found">' .esc_html__('No Record Found','jobzilla'). '</div>';
			} ?>
		</div>
	</div>
<?php } ?>