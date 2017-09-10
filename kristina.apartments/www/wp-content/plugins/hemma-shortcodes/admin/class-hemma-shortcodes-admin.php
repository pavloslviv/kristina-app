<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://pasqualevitiello.com
 * @since      1.0.0
 *
 * @package    Hemma_Shortcodes
 * @subpackage Hemma_Shortcodes/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Hemma_Shortcodes
 * @subpackage Hemma_Shortcodes/admin
 * @author     Pasquale Vitiello <pasqualevitiello@gmail.com>
 */
class Hemma_Shortcodes_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/hemma-shortcodes-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register TinyMCE button
	 *
	 * @since    1.0.0
	 */
	public function hemma_register_mce_button( $buttons ) {
		array_push( $buttons, 'hemma_mce_button', 'hemma_mce_map' );
		return $buttons;
	}

	/**
	 * xxx
	 *
	 * @since    1.0.0
	 */
	public function hemma_add_mce_plugin( $plugin_array ) {
		$plugin_array['hemma_button_script'] = plugin_dir_url( __FILE__ ) . 'js/hemma-shortcodes-admin.js';
		return $plugin_array;
	}

	/**
	 * xxx
	 *
	 * @since    1.0.0
	 */
	public function hemma_refresh_tinymce( $ver ) {
		$ver += 3;
		return $ver;
	}

	/**
	 * This filter allows you to add translations for your Tinymce plugin
	 *
	 * @since    1.0.0
	 */
	public function hemma_mce_plugin_add_locale( $locales ) {
	    $locales['hemma_button_script'] = plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-hemma-shortcodes-lang.php';
	    return $locales;
	}

}
