<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://#
 * @since             1.0.0
 * @package           Palm_Code_Assesment_Plugin
 *
 * @wordpress-plugin
 * Plugin Name:       Palm Code Assesment Plugin
 * Plugin URI:        https://#
 * Description:       This is a plugin for Palm Code Assesment
 * Version:           1.0.0
 * Author:            Ridwan Arifandi
 * Author URI:        https://#
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       palm-code-assesment-plugin
 * Domain Path:       /languages
 */

define( 'PALM_CODE_SERVICE_POST_TYPE', 'service' );
define( 'PALM_CODE_SERVICE_TAXONOMY', 'service_category' );
define( 'PALM_CODE_TESTIMONIAL_POST_TYPE', 'testimonial' );
define( 'PALM_CODE_CONTACT_DATA_POST_TYPE', 'contact_data' );

require_once( 'vendor/autoload.php' );

add_action( 'after_setup_theme', function () {
	\Carbon_Fields\Carbon_Fields::boot();
} );


require_once( 'inc/service.php' );
require_once( 'inc/testimonial.php' );
require_once( 'inc/contact-data.php' );