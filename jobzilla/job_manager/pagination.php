<?php
/**
 * Pagination - Show numbered pagination for catalog pages.
 *
 * This template can be overridden by copying it to yourtheme/job_manager/pagination.php.
 *
 * @see         https://wpjobmanager.com/document/template-overrides/
 * @author      Automattic
 * @package     wp-job-manager
 * @category    Template
 * @version     1.20.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( $max_num_pages <= 1 ) {
	return;
}
?>
<nav class="pagination-outer job-manager-pagination">
	<div class="pagination-style1">
	<?php
		/**
	 	 * Filter the paginated link for WP Job Manager catalog pages.
	 	 * 
	 	 * @see https://codex.wordpress.org/Function_Reference/paginate_links
	 	 *
	 	 * @since 1.4.0
	 	 *
	 	 * @param array $args The pagination arguments.
	 	 */
		 
		$paginate_links =  paginate_links( apply_filters( 'job_manager_pagination_args', [
			'base'      => esc_url_raw( str_replace( 999999999, '%#%', get_pagenum_link( 999999999, false ) ) ),
			'format'    => '',
			'current'   => max( 1, get_query_var('paged') ),
			'total'     => $max_num_pages,
			'prev_text' => '<span><i class="fa fa-angle-left"></i> </span>',
			'next_text' => '<span><i class="fa fa-angle-right"></i> </span></a>',
			'type'      => 'list',
			'end_size'  => 3,
			'mid_size'  => 3,
		] ) );
		
		
		$pagination = str_replace("<ul class='page-numbers'", '<ul class="clearfix"', $paginate_links );
		
		echo wp_kses($pagination, jobzilla_allowed_html_tag());
	?>
	</div>
</nav>
