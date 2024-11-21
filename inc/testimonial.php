<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

/**
 * Register custom TESTIMONIAL post type
 */

add_action( 'init', function () {

	$labels = array(
		'name' => _x( 'Testimonials', 'Post Type General Name', 'palm-code-assesment-plugin' ),
		'singular_name' => _x( 'Testimonial', 'Post Type Singular', 'palm-code-assesment-plugin' ),
		'menu_name' => _x( 'Testimonials', 'Admin Menu', 'palm-code-assesment-plugin' ),
		'name_admin_bar' => _x( 'Testimonial', 'Add New on Toolbar', 'palm-code-assesment-plugin' ),
		'add_new' => _x( 'Add New', 'Testimonial', 'palm-code-assesment-plugin' ),
		'add_new_item' => __( 'Add New Testimonial', 'palm-code-assesment-plugin' ),
		'new_item' => __( 'New Testimonial', 'palm-code-assesment-plugin' ),
		'edit_item' => __( 'Edit Testimonial', 'palm-code-assesment-plugin' ),
		'view_item' => __( 'View Testimonial', 'palm-code-assesment-plugin' ),
		'all_items' => __( 'All Testimonials', 'palm-code-assesment-plugin' ),
		'search_items' => __( 'Search Testimonials', 'palm-code-assesment-plugin' ),
		'parent_item_colon' => __( 'Parent Testimonials:', 'palm-code-assesment-plugin' ),
		'not_found' => __( 'No testimonials found.', 'palm-code-assesment-plugin' ),
		'not_found_in_trash' => __( 'No testimonials found in Trash.', 'palm-code-assesment-plugin' ),
	);

	$args = array(
		'labels' => $labels,
		'description' => __( 'Description.', 'palm-code-assesment-plugin' ),
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'testimonial' ),
		'capability_type' => 'post',
		'has_archive' => true,
		'hierarchical' => false,
		'menu_position' => 5,
		'supports' => array( 'title', 'editor' ),
		'menu_icon' => 'dashicons-format-quote',
	);

	register_post_type( PALM_CODE_TESTIMONIAL_POST_TYPE, $args );
} );

/**
 * Register custom fields for TESTIMONIAL post type
 */
add_action( 'carbon_fields_register_fields', function () {

	Container::make( 'post_meta', 'Testimonial Details' )
		->where( 'post_type', '=', PALM_CODE_TESTIMONIAL_POST_TYPE )
		->add_fields( array(
			Field::make( 'text', 'rating', 'Rating' )
				->set_attribute( 'type', 'number' )
				->set_attribute( 'min', 1 )
				->set_attribute( 'max', 5 )
				->set_default_value( 5 )
				->set_required( true ),

		) );
} );