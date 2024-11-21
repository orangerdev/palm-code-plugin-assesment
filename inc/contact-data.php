<?php

use \Carbon_Fields\Container;
use \Carbon_Fields\Field;

/**
 * Register custom CONTACT DATA post type
 */
add_action( 'init', function () {

	$labels = array(
		'name' => _x( 'Contact Data', 'Post Type General Name', 'palm-code-assesment-plugin' ),
		'singular_name' => _x( 'Contact Data', 'Post Type Singular', 'palm-code-assesment-plugin' ),
		'menu_name' => _x( 'Contact Data', 'Admin Menu', 'palm-code-assesment-plugin' ),
		'name_admin_bar' => _x( 'Contact Data', 'Add New on Toolbar', 'palm-code-assesment-plugin' ),
		'add_new' => _x( 'Add New', 'Contact Data', 'palm-code-assesment-plugin' ),
		'add_new_item' => __( 'Add New Contact Data', 'palm-code-assesment-plugin' ),
		'new_item' => __( 'New Contact Data', 'palm-code-assesment-plugin' ),
		'edit_item' => __( 'Edit Contact Data', 'palm-code-assesment-plugin' ),
		'view_item' => __( 'View Contact Data', 'palm-code-assesment-plugin' ),
		'all_items' => __( 'All Contact Data', 'palm-code-assesment-plugin' ),
		'search_items' => __( 'Search Contact Data', 'palm-code-assesment-plugin' ),
		'parent_item_colon' => __( 'Parent Contact Data:', 'palm-code-assesment-plugin' ),
		'not_found' => __( 'No Contact Data found.', 'palm-code-assesment-plugin' ),
		'not_found_in_trash' => __( 'No Contact Data found in Trash.', 'palm-code-assesment-plugin' ),
	);

	$args = array(
		'labels' => $labels,
		'description' => __( 'Description.', 'palm-code-assesment-plugin' ),
		'public' => true,
		'publicly_queryable' => false,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menu' => false,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'Contact Data' ),
		'capability_type' => 'post',
		'has_archive' => false,
		'hierarchical' => false,
		'menu_position' => 5,
		'supports' => array( 'title', 'editor' ),
		'menu_icon' => 'dashicons-email-alt',
	);

	register_post_type( PALM_CODE_CONTACT_DATA_POST_TYPE, $args );

} );

add_action( 'carbon_fields_register_fields', function () {
	Container::make( 'post_meta', 'Contact Data' )
		->where( 'post_type', '=', PALM_CODE_CONTACT_DATA_POST_TYPE )
		->add_fields( array(
			Field::make( 'text', 'email', 'Email' ),
			Field::make( 'text', 'phone', 'Phone' ),
			Field::make( 'text', 'service', 'Service' ),
			Field::make( 'text', 'file_url', 'File URL' ),
		) );
} );

/**
 * Register custom endpoint to save contact data
 */
add_action( 'rest_api_init', function () {
	register_rest_route( 'palm-code/v1', '/contact-data', array(
		'methods' => 'POST',
		'callback' => 'palm_code_save_contact_data',
		'permission_callback' => '__return_true'
	) );
} );

/**
 * Save contact data from the contact form, via endpoin /wp-json/palm-code/v1/contact-data
 * @param WP_REST_Request $request
 * @return WP_REST_Response
 */
function palm_code_save_contact_data( WP_REST_Request $request ) {
	$name = $request->get_param( 'name' );
	$email = $request->get_param( 'email' );
	$phone = $request->get_param( 'phone' );
	$service = $request->get_param( 'service' );
	$message = $request->get_param( 'message' );
	$file_url = $request->get_param( 'file-url' );

	try {

		// filter all the fields
		$name = sanitize_text_field( $name );
		$email = sanitize_email( $email );
		$phone = sanitize_text_field( $phone );
		$service = sanitize_text_field( $service );
		$message = sanitize_text_field( $message );
		$file_url = esc_url( $file_url );

		// validate all the fields
		if ( ! $name || ! is_email( $email ) || ! $phone || ! $service ) {
			return new WP_REST_Response( array( 'message' => 'Name, Email, Phone and Service are required' ), 400 );
		}

		$post_id = wp_insert_post( array(
			'post_title' => $name,
			'post_content' => $message,
			'post_type' => PALM_CODE_CONTACT_DATA_POST_TYPE,
			'post_status' => 'publish'
		) );

		if ( $post_id ) {
			update_post_meta( $post_id, '_email', $email );
			update_post_meta( $post_id, '_phone', $phone );
			update_post_meta( $post_id, '_service', $service );
			update_post_meta( $post_id, '_file_url', $file_url );
		}

		return new WP_REST_Response( array( 'message' => 'Contact data saved successfully' ), 200 );
	} catch (Exception $e) {
		return new WP_REST_Response( array( 'message' => 'Error saving contact data' ), 500 );
	}
}

add_action( 'wp_ajax_upload-image', 'palm_code_upload_image' );
add_action( 'wp_ajax_nopriv_upload-image', 'palm_code_upload_image' );

/**
 * Upload image via plupload
 */

function palm_code_upload_image() {
	$nonce = $_POST['plupload_nonce'];

	try {
		if ( ! wp_verify_nonce( $nonce, 'plupload_nonce' ) ) {
			throw new Exception( 'Security check' );
		}

		// make sure the file type is an image
		$file = $_FILES['file']['name'];

		$file_parts = pathinfo( $file );

		if ( ! in_array( $file_parts['extension'], array( 'jpg', 'jpeg', 'png', 'gif' ) ) ) {
			throw new Exception( 'Invalid file type' );
		}

		$upload = wp_upload_bits( $_FILES['file']['name'], null, file_get_contents( $_FILES['file']['tmp_name'] ) );

		if ( ! $upload['error'] ) {
			echo json_encode( array(
				'success' => true,
				'url' => $upload['url']
			) );
		} else {
			echo json_encode( array(
				'success' => false,
				'message' => 'Error uploading file'
			) );
		}

	} catch (Exception $e) {
		echo json_encode( array(
			'success' => false,
			'message' => $e->getMessage()
		) );
	}

	die();
}