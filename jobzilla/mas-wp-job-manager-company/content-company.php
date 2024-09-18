<?php
/**
 * company in the loop.
 *
 * This template can be overridden by copying it to yourtheme/mas-wp-job-manager-company/content-company.php.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

global $post;

// Ensure visibility.
if ( empty( $post ) ) {
    return;
}

?>

<li <?php mas_wpjmc_company_class(); ?>>
    <?php
        do_action( 'jobzilla_company_start' );

        do_action( 'jobzilla_company');

        do_action( 'jobzilla_company_end' );
    ?>
</li>
