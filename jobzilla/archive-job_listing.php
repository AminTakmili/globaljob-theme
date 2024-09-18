<?php 
	get_header(); 
	jobzilla_get_banner(); ?>
		<div class="container">
		
			<div class="col-lg-12 col-md-12">
				
				<!--Content Side-->	
				<?php 					
				echo do_shortcode('[jobs orderby="date" order="DESC" per_page="10" show_pagination="true"  show_filters="true"]'); 
				?>			
			
				<!-- End Content Side-->					
			</div>

		</div>
<?php get_footer(); ?>