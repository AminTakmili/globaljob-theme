<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

global $post;

// Ensure visibility.
if ( empty( $post ) ) {
    return;
}

do_action( 'jobzilla_single_company_start' );
do_action( 'jobzilla_single_company' );
do_action( 'jobzilla_single_company_after_end' );
