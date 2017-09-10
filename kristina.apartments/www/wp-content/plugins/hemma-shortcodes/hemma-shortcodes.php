<?php

/**
 * Plugin Name:       Hemma Shortcodes
 * Plugin URI:        http://themes.opendept.net/hemma/
 * Description:       A plugin for Hemma WordPress theme to add some extra shortcodes.
 * Version:           1.0.0
 * Author:            Pasquale Vitiello
 * Author URI:        http://pasqualevitiello.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       hemma-shortcodes
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-hemma-shortcodes.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_hemma_shortcodes() {

	$plugin = new Hemma_Shortcodes();
	$plugin->run();

}
run_hemma_shortcodes();
