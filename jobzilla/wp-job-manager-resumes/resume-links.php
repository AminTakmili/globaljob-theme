<?php
/**
 * Displays all links associated with a resume inside a resume list.
 *
 * This template can be overridden by copying it to yourtheme/wp-job-manager-resumes/resume-links.php.
 *
 * @see         https://wpjobmanager.com/document/template-overrides/
 * @author      Automattic
 * @package     wp-job-manager-resumes
 * @category    Template
 * @version     1.2.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( resume_has_links() || resume_has_file() ) : ?>
	<ul class="resume-links">
		<?php foreach ( get_resume_links() as $link ) : ?>
			<?php
			get_job_manager_template(
				'content-resume-link.php',
				[
					'post' => $post,
					'link' => $link,
				],
				'jobzilla',
				RESUME_MANAGER_PLUGIN_DIR . '/templates/'
			);
			?>
		<?php endforeach; ?>
		<?php if ( resume_has_file() ) : ?>
			<?php get_job_manager_template( 'content-resume-file.php', [ 'post' => $post ], 'jobzilla', RESUME_MANAGER_PLUGIN_DIR . '/templates/' ); ?>
		<?php endif; ?>
	</ul>
<?php endif; ?>
