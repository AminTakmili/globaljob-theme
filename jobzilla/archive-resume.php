<?php 
	get_header(); 
	jobzilla_get_banner(); ?>
		<div class="container">
			
				
				<div class="col-lg-12 col-md-12">
					
					<!--Content Side-->	
					<?php 					
						echo do_shortcode('[resumes show_filters="true" orderby="date" order="DESC" per_page="10" show_pagination="true"]');
					?>
		
					<!-- End Content Side-->					
				</div>
			
			</div>
		</div>
<?php get_footer(); ?>