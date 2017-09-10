<?php

/**
 * Fired during plugin deactivation
 *
 * @link       http://pasqualevitiello.com
 * @since      1.0.0
 *
 * @package    Hemma_Custom_Post_Types
 * @subpackage Hemma_Custom_Post_Types/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Hemma_Custom_Post_Types
 * @subpackage Hemma_Custom_Post_Types/includes
 * @author     Pasquale Vitiello <pasqualevitiello@gmail.com>
 */
class Hemma_Custom_Post_Types_Deactivator {

	/**
	 * Flush rewrite rules on deactivation.
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
		flush_rewrite_rules();
	}

}
