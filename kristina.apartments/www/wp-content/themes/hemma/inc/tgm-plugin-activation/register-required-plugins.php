<?php
/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @see http://tgmpluginactivation.com/configuration/ for detailed documentation.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.6.1 for parent theme Hemma for publication on ThemeForest
 * @author     Thomas Griffin, Gary Jones, Juliette Reinders Folmer
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 */

/**
 * Include the TGM_Plugin_Activation class.
 */
require_once get_template_directory() . '/inc/tgm-plugin-activation/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'hemma_register_required_plugins' );

/**
 * Register the required plugins for this theme.
 */
function hemma_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		// Hemma Custom Post Types
		array(
			'name'             => esc_html( 'Hemma Custom Post Types' ),
			'slug'             => esc_attr( 'hemma-custom-post-types' ),
			'source'           => esc_url( 'http://plugins.opendept.net/hemma/hemma-custom-post-types/1.0.0/hemma-custom-post-types.zip' ),
			'required'         => true,
			'version'          => '1.0.0',
			//'force_activation' => true,
		),

		// Hemma Instagram
		array(
			'name'             => esc_html( 'Hemma Instagram' ),
			'slug'             => esc_attr( 'hemma-instagram' ),
			'source'           => esc_url( 'http://plugins.opendept.net/hemma/hemma-instagram/1.0.0/hemma-instagram.zip' ),
			'required'         => true,
			'version'          => esc_html( '1.0.0' ),
			//'force_activation' => true,
		),

		// Hemma Shortcodes
		array(
			'name'             => esc_html( 'Hemma Shortcodes' ),
			'slug'             => esc_attr( 'hemma-shortcodes' ),
			'source'           => esc_url( 'http://plugins.opendept.net/hemma/hemma-shortcodes/1.0.0/hemma-shortcodes.zip' ),
			'required'         => true,
			'version'          => esc_html( '1.0.0' ),
			//'force_activation' => true,
		),

		// Kirki Toolkit
		array(
			'name'             => esc_html( 'Kirki Toolkit' ),
			'slug'             => esc_attr( 'kirki' ),
			'required'         => true,
			//'force_activation' => true,
		),

		// CMB2
		array(
			'name'             => esc_html( 'CMB2' ),
			'slug'             => esc_attr( 'cmb2' ),
			'required'         => true,
			//'force_activation' => true,
		),

		// CMB2 RGBa Colorpicker
		array(
			'name'             => esc_html( 'CMB2 RGBa Colorpicker' ),
			'slug'             => esc_attr( 'CMB2_RGBa_Picker' ),
			'source'           => esc_url( 'https://github.com/JayWood/CMB2_RGBa_Picker/archive/master.zip' ),
			'required'         => true,
			//'force_activation' => true,
			'external_url'     => esc_url( 'https://github.com/JayWood/CMB2_RGBa_Picker' ),
		),

		// Contact Form 7
		array(
			'name'      => esc_html( 'Contact Form 7' ),
			'slug'      => esc_attr( 'contact-form-7' ),
			'required'  => false,
		),

	);

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'           => 'hemma',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );
}
