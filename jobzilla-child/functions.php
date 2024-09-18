<?php
function jobzilla_child_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'jobzilla_child_enqueue_styles' );



function add_recruiter_role() {
    // ایجاد نقش جدید Recruiter
    add_role(
        'recruiter',
        __('Recruiter'),
        array(
            'read' => true, // امکان خواندن
            'edit_posts' => false, // عدم دسترسی به ویرایش پست‌ها
            'delete_posts' => false, // عدم دسترسی به حذف پست‌ها
        )
    );
}
add_action('init', 'add_recruiter_role');

