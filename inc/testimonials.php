<?php
// Register Custom Post Type
function mybstheme_testimonials() {

	$labels = array(
		'name'                => _x( 'Testimonials', 'Post Type General Name', 'mybstheme' ),
		'singular_name'       => _x( 'Testimonial', 'Post Type Singular Name', 'mybstheme' ),
		'menu_name'           => __( 'Testimonials', 'mybstheme' ),
		'parent_item_colon'   => __( 'Parent Testimonial:', 'mybstheme' ),
		'all_items'           => __( 'All Testimonials', 'mybstheme' ),
		'view_item'           => __( 'View Testimonial', 'mybstheme' ),
		'add_new_item'        => __( 'Add New Testimonial', 'mybstheme' ),
		'add_new'             => __( 'Add New', 'mybstheme' ),
		'edit_item'           => __( 'Edit Testimonial', 'mybstheme' ),
		'update_item'         => __( 'Update Testimonial', 'mybstheme' ),
		'search_items'        => __( 'Search Testimonial', 'mybstheme' ),
		'not_found'           => __( 'Not found', 'mybstheme' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'mybstheme' ),
	);
	$args = array(
		'label'               => __( 'testimonials', 'mybstheme' ),
		'description'         => __( 'Testimonials', 'mybstheme' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'thumbnail', ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => false,
		'exclude_from_search' => true,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	register_post_type( 'testimonials', $args );

}

// Hook into the 'init' action
add_action( 'init', 'mybstheme_testimonials', 0 );