<?php

/**
 * Plugin Name:       Hemma Instagram
 * Plugin URI:        http://themes.opendept.net/hemma/
 * Description:       A plugin for Hemma WordPress theme to show Instagram feeds. Crafted on WP Instagram Widget 1.9.5 (https://github.com/scottsweb/wp-instagram-widget)
 * Version:           1.0.0
 * Author:            Pasquale Vitiello
 * Author URI:        http://pasqualevitiello.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       hemma-instagram
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
require plugin_dir_path( __FILE__ ) . 'includes/class-hemma-instagram.php';