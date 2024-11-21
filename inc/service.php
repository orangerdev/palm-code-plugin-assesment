<?php

/**
 * Register custom SERVICE post type
 */
add_action( 'init', function () {

	$labels = array(
		'name' => _x( 'Services', 'Post Type General Name', 'palm-code-assesment-plugin' ),
		'singular_name' => _x( 'Service', 'Post Type Singular Name', 'palm-code-assesment-plugin' ),
		'menu_name' => __( 'Services', 'palm-code-assesment-plugin' ),
		'name_admin_bar' => __( 'Service', 'palm-code-assesment-plugin' ),
		'archives' => __( 'Service Archives', 'palm-code-assesment-plugin' ),
		'attributes' => __( 'Service Attributes', 'palm-code-assesment-plugin' ),
		'parent_item_colon' => __( 'Parent Service:', 'palm-code-assesment-plugin' ),
		'all_items' => __( 'All Services', 'palm-code-assesment-plugin' ),
		'add_new_item' => __( 'Add New Service', 'palm-code-assesment-plugin' ),
		'add_new' => __( 'Add New', 'palm-code-assesment-plugin' ),
		'new_item' => __( 'New Service', 'palm-code-assesment-plugin' ),
		'edit_item' => __( 'Edit Service', 'palm-code-assesment-plugin' ),
		'update_item' => __( 'Update Service', 'palm-code-assesment-plugin' ),
		'view_item' => __( 'View Service', 'palm-code-assesment-plugin' ),
		'view_items' => __( 'View Services', 'palm-code-assesment-plugin' ),
		'search_items' => __( 'Search Service', 'palm-code-assesment-plugin' ),
		'not_found' => __( 'Not found', 'palm-code-assesment-plugin' ),
		'not_found_in_trash' => __( 'Not found in Trash', 'palm-code-assesment-plugin' ),
		'featured_image' => __( 'Featured Image', 'palm-code-assesment-plugin' ),
		'set_featured_image' => __( 'Set featured image', 'palm-code-assesment-plugin' ),
		'remove_featured_image' => __( 'Remove featured image', 'palm-code-assesment-plugin' ),
		'use_featured_image' => __( 'Use as featured image', 'palm-code-assesment-plugin' ),
		'insert_into_item' => __( 'Insert into Service', 'palm-code-assesment-plugin' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Service', 'palm-code-assesment-plugin' ),
		'items_list' => __( 'Services list', 'palm-code-assesment-plugin' ),
		'items_list_navigation' => __( 'Services list navigation', 'palm-code-assesment-plugin' ),
		'filter_items_list' => __( 'Filter Services list', 'palm-code-assesment-plugin' ),
	);

	$args = array(
		'label' => __( 'Service', 'palm-code-assesment-plugin' ),
		'description' => __( 'Post Type Description', 'palm-code-assesment-plugin' ),
		'labels' => $labels,
		'supports' => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
		'taxonomies' => array( PALM_CODE_SERVICE_TAXONOMY ),
		'hierarchical' => true,
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'menu_position' => 5,
		'menu_icon' => 'dashicons-admin-tools',
		'show_in_admin_bar' => true,
		'show_in_nav_menus' => true,
		'can_export' => true,
		'has_archive' => true,
		'exclude_from_search' => false,
		'publicly_queryable' => true,
		'capability_type' => 'post',
	);

	register_post_type( PALM_CODE_SERVICE_POST_TYPE, $args );
} );

/**
 * Register custom SERVICE_CATEGORY taxonomy for SERVICE post type
 */
add_action( 'init', function () {

	$labels = array(
		'name' => _x( 'Service Categories', 'Taxonomy General', 'palm-code-assesment-plugin' ),
		'singular_name' => _x( 'Service Category', 'Taxonomy Singular', 'palm-code-assesment-plugin' ),
		'menu_name' => __( 'Service Categories', 'palm-code-assesment-plugin' ),
		'all_items' => __( 'All Items', 'palm-code-assesment-plugin' ),
		'edit_item' => __( 'Edit Item', 'palm-code-assesment-plugin' ),
		'view_item' => __( 'View Item', 'palm-code-assesment-plugin' ),
		'update_item' => __( 'Update Item', 'palm-code-assesment-plugin' ),
		'add_new_item' => __( 'Add New Item', 'palm-code-assesment-plugin' ),
		'new_item_name' => __( 'New Item Name', 'palm-code-assesment-plugin' ),
		'parent_item' => __( 'Parent Item', 'palm-code-assesment-plugin' ),
		'parent_item_colon' => __( 'Parent Item:', 'palm-code-assesment-plugin' ),
		'search_items' => __( 'Search Items', 'palm-code-assesment-plugin' ),
		'popular_items' => __( 'Popular Items', 'palm-code-assesment-plugin' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'palm-code-assesment-plugin' ),
		'add_or_remove_items' => __( 'Add or remove items', 'palm-code-assesment-plugin' ),
		'choose_from_most_used' => __( 'Choose from the most used', 'palm-code-assesment-plugin' ),
		'not_found' => __( 'Not Found', 'palm-code-assesment-plugin' ),
	);

	$args = array(
		'labels' => $labels,
		'hierarchical' => true,
		'public' => true,
		'show_ui' => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud' => true,
	);

	register_taxonomy( PALM_CODE_SERVICE_TAXONOMY, PALM_CODE_SERVICE_POST_TYPE, $args );

} );