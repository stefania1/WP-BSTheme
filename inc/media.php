<?php

// register new taxonomy which applies to attachments
function mybstheme_media_taxonomy() {
    $labels = array(
        'name'              => 'Category',
        'singular_name'     => 'Category',
        'search_items'      => 'Search Category',
        'all_items'         => 'All Categories',
        'parent_item'       => 'Parent Category',
        'parent_item_colon' => 'Parent Category:',
        'edit_item'         => 'Edit Category',
        'update_item'       => 'Update Category',
        'add_new_item'      => 'Add New Category',
        'new_item_name'     => 'New Category Name',
        'menu_name'         => 'Category',
    );
 
    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'query_var' => 'true',
        'rewrite' => 'true',
        'show_admin_column' => 'true',
    );
 
    register_taxonomy( 'mediacategory', 'attachment', $args );
}
add_action( 'init', 'mybstheme_media_taxonomy' );