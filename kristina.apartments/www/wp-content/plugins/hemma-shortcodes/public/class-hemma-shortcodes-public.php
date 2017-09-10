<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://pasqualevitiello.com
 * @since      1.0.0
 *
 * @package    Hemma_Shortcodes
 * @subpackage Hemma_Shortcodes/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Hemma_Shortcodes
 * @subpackage Hemma_Shortcodes/public
 * @author     Pasquale Vitiello <pasqualevitiello@gmail.com>
 */
class Hemma_Shortcodes_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Process the Button shortcode.
	 *
	 * @since    1.0.0
	 */
	public function hemma_button_shortcode( $atts ) {
		extract( shortcode_atts( array(
			'text'         => '',
			'url'          => '',
			'color'        => '',
			'open_new_tab' => '',
		), $atts) );

		$output = $target_data = $color_data = null;

		if ( $text ) {
			
			if ( $open_new_tab == 'true' ) {
				$target_data = ' target="_blank"';
			}

			if ( $color && $color != 'none' ) {
				$color_data = ' is-' . $color;
			}
			
			$output = '<a class="button' . $color_data . '" href="' . $url . '"' . $target_data . '>' . $text . '</a>';
			
		}	

		return $output;

	}

	/**
	 * Process the Social shortcode.
	 *
	 * @since    1.0.0
	 */
	public function hemma_social_shortcode() {

		$output = '<div class="social-links">';

		$active_networks = get_theme_mod( 'social_order', array() );
		if ( ! empty( $active_networks ) && is_array( $active_networks ) ) :
		    foreach ( $active_networks as $social_network ) :

		    	$social_link = get_theme_mod( $social_network . '_link', '' );

				$output .= '<a href="' . esc_url( $social_link ) . '"><svg class="hemma-icon hemma-icon-social"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#hemma-icon-' . esc_attr( $social_network ) . '"></use></svg></a>';

		    endforeach;
		endif;

		$output .= '</div>';

		return $output;

	}

	/**
	 * Process the Map shortcode.
	 *
	 * @since    1.0.0
	 */
	public function hemma_map_shortcode( $atts ) {
		extract( shortcode_atts( array(
			'latitude'  => '',
			'longitude' => '',
			'zoom'      => '',
			'height'    => '',
			'style'     => '',
			'marker'    => ''
		), $atts) );

		$output = null;

		if ( $latitude && $longitude ) {

			$zoom_data = 7;
			if ( $zoom ) {
				$zoom_data = $zoom; 
			}

			$style_data = 'none';
			if ( $style ) {
				$style_data = $style; 
			}

			$height_data = 200;
			if ( $height ) {
				$height_data = $height; 
			}

			$marker_data = ' marker-invisible';
			if ( $marker ) {
				$marker_data = ' marker-is-' .$marker;
			}

			$output .= '
			<div class="map map-shortcode' . $marker_data . '" data-maplat="' . $latitude . '" data-maplon="' . $longitude . '" data-mapzoom="' . $zoom_data . '" data-color="' . $style_data . '" data-height="' . $height_data . '"></div>';
		
		}
		
		return $output;

	}

	/**
	 * Process the Year shortcode.
	 *
	 * @since    1.0.0
	 */
	public function hemma_year_shortcode() {

		$year = date('Y');

		return $year;

	}

}
