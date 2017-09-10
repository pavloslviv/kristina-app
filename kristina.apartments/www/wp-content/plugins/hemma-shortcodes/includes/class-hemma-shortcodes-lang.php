<?php

/**
 * Generates the javascript for translatable TinyMCE editor buttons.
 *
 * @link       http://pasqualevitiello.com
 * @since      1.0.0
 *
 * @package    Hemma_Shortcodes
 * @subpackage Hemma_Shortcodes/admin
 * @author     Pasquale Vitiello <pasqualevitiello@gmail.com>
 */
class Hemma_Shortcodes_Lang {

    public function hemma_mce_plugin_translation() {

        if ( ! defined( 'ABSPATH' ) )
            exit;

        if ( ! class_exists( '_WP_Editors' ) )
            require( ABSPATH . WPINC . '/class-wp-editor.php' );

        $strings = array(
            'shortcode_button_title' => esc_js( __( 'Insert Button', 'hemma-shortcodes') ),
            'modal_button_label_1' => esc_js( __( 'Button text', 'hemma-shortcodes') ),
            'modal_button_label_2' => esc_js( __( 'Destination URL', 'hemma-shortcodes') ),
            'modal_button_label_3' => esc_js( __( 'Open link in a new tab?', 'hemma-shortcodes') ),
            'modal_button_label_4' => esc_js( __( 'Button color', 'hemma-shortcodes') ),
            'modal_color_val_1' => esc_js( __( 'None', 'hemma-shortcodes') ),
            'modal_color_val_2' => esc_js( __( 'Red', 'hemma-shortcodes') ),
            'modal_color_val_3' => esc_js( __( 'Orange', 'hemma-shortcodes') ),
            'modal_color_val_4' => esc_js( __( 'Yellow', 'hemma-shortcodes') ),
            'modal_color_val_5' => esc_js( __( 'Green', 'hemma-shortcodes') ),
            'modal_color_val_6' => esc_js( __( 'Light Blue', 'hemma-shortcodes') ),
            'modal_color_val_7' => esc_js( __( 'Blue', 'hemma-shortcodes') ),
            'modal_color_val_8' => esc_js( __( 'Purple', 'hemma-shortcodes') ),
            'modal_color_val_9' => esc_js( __( 'Pink', 'hemma-shortcodes') ),
            'modal_color_val_10' => esc_js( __( 'Brown', 'hemma-shortcodes') ),
            'modal_color_val_11' => esc_js( __( 'Dark', 'hemma-shortcodes') ),
            'modal_color_val_12' => esc_js( __( 'White', 'hemma-shortcodes') ),
            'shortcode_map_title' => esc_js( __( 'Insert Map', 'hemma-shortcodes') ),
            'modal_map_label_1' => esc_js( __( 'Map Latitude', 'hemma-shortcodes') ),
            'modal_map_label_2' => esc_js( __( 'Map Longitude', 'hemma-shortcodes') ),
            'modal_map_label_3' => esc_js( __( 'Map Zoom Level', 'hemma-shortcodes') ),
            'modal_map_label_4' => esc_js( __( 'Map Height', 'hemma-shortcodes') ),
            'modal_map_label_5' => esc_js( __( 'Map Style', 'hemma-shortcodes') ),
            'modal_map_label_5_val_1' => esc_js( __( 'Default', 'hemma-shortcodes') ),
            'modal_map_label_5_val_2' => esc_js( __( 'Light', 'hemma-shortcodes') ),
            'modal_map_label_5_val_3' => esc_js( __( 'Dark', 'hemma-shortcodes') ),
            'modal_map_label_6' => esc_js( __( 'Marker Color', 'hemma-shortcodes') ),
        );

        $locale = _WP_Editors::$mce_locale;
        $translated = 'tinyMCE.addI18n("' . $locale . '.hemma_mce_plugin", ' . json_encode( $strings ) . ");\n";

        return $translated;
    }

}

$langObj = new Hemma_Shortcodes_Lang;
$strings = $langObj->hemma_mce_plugin_translation();