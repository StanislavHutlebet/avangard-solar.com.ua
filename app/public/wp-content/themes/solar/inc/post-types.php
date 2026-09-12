<?php
function register_cases_post_type() {

    $labels = [
        'name'               => 'Cases',
        'singular_name'      => 'Case',
        'menu_name'          => 'Cases',
        'name_admin_bar'     => 'Case',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New Case',
        'new_item'           => 'New Case',
        'edit_item'          => 'Edit Case',
        'view_item'          => 'View Case',
        'all_items'          => 'All Cases',
        'search_items'       => 'Search Cases',
        'not_found'          => 'No cases found',
        'not_found_in_trash' => 'No cases found in Trash',
    ];

    $args = [
        'labels'             => $labels,
        'public'             => true,
        'has_archive'        => 'cases',
        'rewrite'            => ['slug' => 'cases'],
        'show_in_rest'       => true,
        'supports'           => ['title', 'editor', 'thumbnail', 'excerpt'],
        'menu_icon'          => 'dashicons-portfolio',
    ];

    register_post_type('case', $args);
}
add_action('init', 'register_cases_post_type');


function register_case_categories() {

    $labels = [
        'name'              => 'Case Categories',
        'singular_name'     => 'Case Category',
        'search_items'      => 'Search Categories',
        'all_items'         => 'All Categories',
        'parent_item'       => 'Parent Category',
        'parent_item_colon' => 'Parent Category:',
        'edit_item'         => 'Edit Category',
        'update_item'       => 'Update Category',
        'add_new_item'      => 'Add New Category',
        'new_item_name'     => 'New Category Name',
        'menu_name'         => 'Categories',
    ];

    $args = [
        'labels'            => $labels,
        'hierarchical'      => true, 
        'public'            => true,
        'show_admin_column' => true,
        'show_in_rest'      => true,
        'rewrite'           => [
            'slug' => 'case-category',
        ],
    ];

    register_taxonomy('case_category', ['case'], $args);
}
add_action('init', 'register_case_categories');