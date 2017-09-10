<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://pasqualevitiello.com
 * @since      1.0.0
 *
 * @package    Hemma_Custom_Post_Types
 * @subpackage Hemma_Custom_Post_Types/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Hemma_Custom_Post_Types
 * @subpackage Hemma_Custom_Post_Types/includes
 * @author     Pasquale Vitiello <pasqualevitiello@gmail.com>
 */
class Hemma_Custom_Post_Types_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'hemma-custom-post-types',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
