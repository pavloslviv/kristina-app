<?php
/**
 * Include and setup custom metaboxes and fields. (make sure you copy this file to outside the CMB2 directory)
 *
 * Be sure to replace all instances of 'opendept_' with your project's prefix.
 * http://nacin.com/2010/05/11/in-wordpress-prefix-everything/
 *
 * @category Hemma
 * @package  Hemma
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/WebDevStudios/CMB2
 */

/**
 * Helper function to get meta values
 */
function cmb2_get_meta( $type, $value ) {
    return isset( $type[ $value ] ) && ! empty( $type[ $value ] ) ? $type[ $value ] : false;
}

/**
 * Only return default value if we don't have a post ID (in the 'post' query variable)
 *
 * @param  bool  $default On/Off (true/false)
 * @return mixed          Returns true or '', the blank default
 */
function cmb2_set_checkbox_default_for_new_post( $default ) {
    return isset( $_GET['post'] ) ? '' : ( $default ? (string) $default : '' );
}

/**
 * Metabox for Page Template
 * @author Kenneth White
 * @link https://github.com/WebDevStudios/CMB2/wiki/Adding-your-own-show_on-filters
 *
 * @param bool $display
 * @param array $meta_box
 * @return bool display metabox
 */
function cmb2_metabox_show_on_template( $display, $meta_box ) {
    if ( ! isset( $meta_box['show_on']['key'], $meta_box['show_on']['value'] ) ) {
        return $display;
    }

    if ( 'cpt-template' !== $meta_box['show_on']['key'] ) {
        return $display;
    }

    $post_id = 0;

    // If we're showing it based on ID, get the current ID
    if ( isset( $_GET['post'] ) ) {
        $post_id = $_GET['post'];
    } elseif ( isset( $_POST['post_ID'] ) ) {
        $post_id = $_POST['post_ID'];
    }

    if ( ! $post_id ) {
        return false;
    }

    if ( get_post_type( $post_id ) == 'page' ) {

	    $template_name = get_page_template_slug( $post_id );
	    $template_name = ! empty( $template_name ) ? substr( $template_name, 0, -4 ) : '';

	    // See if there's a match
	    return in_array( $template_name, (array) $meta_box['show_on']['value'] );

	} else {

		return $display;

	}
}
add_filter( 'cmb2_show_on', 'cmb2_metabox_show_on_template', 10, 2 );

/**
 * Gets a number of posts and displays them as options
 * @param  array $query_args Optional. Overrides defaults.
 * @return array An array of options that matches the CMB2 options array
 */
function cmb2_get_post_options( $query_args ) {

    $args = wp_parse_args( $query_args, array(
        'post_type'   => 'post',
        'posts_per_page' => -1,
        // Following args: A-Z sorting
        'orderby' => 'title',
        'order' => 'ASC'
    ) );

    $posts = get_posts( $args );

    $post_options = array();
    if ( $posts ) {
        foreach ( $posts as $post ) {
         	$post_options[ $post->ID ] = $post->post_title . ' (' . ucfirst ( $post->post_type ) . ')';
        }
    }

    return $post_options;
}

/**
 * Gets 5 posts for your_post_type and displays them as options
 * @return array An array of options that matches the CMB2 options array
 */
function cmb2_get_posts_and_cpts() {
    return cmb2_get_post_options( array( 'post_type' => array ( 'post', 'room', 'event', 'food', 'deal' ) ) );
}


/**
 * Add Subtitle Meta Box in Room, Event, Food, Deal posts and Composer, Room, Event, Food, Deal pages
 */
add_action( 'cmb2_admin_init', 'opendept_register_subtitle_metabox' );
function opendept_register_subtitle_metabox() {
	$prefix = 'opendept_subtitle_';

	$cmb_subtitle = new_cmb2_box( array(
		'id'            => $prefix . 'metabox',
		'title'         => esc_html__( 'Add Subtitle', 'hemma' ),
		'object_types'  => array( 'page', 'room', 'event', 'food', 'deal' ),
		//'show_on'       => array( 'key' => 'cpt-template', 'value' => array( 'template-composer', 'template-room', 'template-event', 'template-food', 'template-deal', 'template-guestpost' ) ),
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => false,
	) );

	$cmb_subtitle->add_field( array(
		'name' => esc_html__( 'Add Subtitle', 'hemma' ),
		'desc' => esc_html__( 'Leave empty if you don\'t want to show a subtitle', 'hemma' ),
		'id'   => $prefix . 'subtitle',
		'type' => 'text',
	) );

}

/**
 * Add Hero Setting Meta Box in Room, Event, Food, Deal posts and Composer, Room, Event, Food, Deal pages
 */
add_action( 'cmb2_admin_init', 'opendept_register_hero_settings_metabox' );
function opendept_register_hero_settings_metabox() {
	$prefix = 'opendept_hero_';

	$cmb_hero = new_cmb2_box( array(
		'id'            => $prefix . 'metabox',
		'title'         => esc_html__( 'Hero Settings', 'hemma' ),
		'object_types'  => array( 'page', 'room', 'event', 'food', 'deal' ),
		//'show_on'       => array( 'key' => 'cpt-template', 'value' => array( 'template-composer', 'template-room', 'template-event', 'template-food', 'template-deal' ) ),
		'context'       => 'side',
		'priority'      => 'core',
		'show_names'    => false,
	) );

	$cmb_hero->add_field( array(
		'name'    => esc_html__( 'Fade color', 'hemma' ),
		'desc'    => esc_html__( 'Fade background image with an overlay color', 'hemma' ),
		'id'      => $prefix . 'color',
		'type'    => 'rgba_colorpicker',
		'default' => 'rgba(53,63,73,0)',
	) );

	$cmb_hero->add_field( array(
		'name'    => esc_html__( 'Titles alignment', 'hemma' ),
		'desc'    => esc_html__( 'Align the title and the subtitle to left or center', 'hemma' ),
		'id'      => $prefix . 'align',
		'type'    => 'radio',
		'default' => 'is-centered',
		'options' => array(
			'is-left'     => esc_html__( 'Align left', 'hemma' ),
			'is-centered' => esc_html__( 'Align center', 'hemma' ),
		),
	) );

	$cmb_hero->add_field( array(
		'name' => esc_html__( 'Hero Height', 'hemma' ),
		'desc' => esc_html__( 'The minimum height of the hero', 'hemma' ),
		'id'   => $prefix . 'height',
		'type' => 'select',
		'options' => array(
	        'is-contentheight' => esc_html__( 'Content Height', 'hemma' ),
	        'is-halfheight'    => esc_html__( 'Half browser height', 'hemma' ),
	        'is-fullheight'    => esc_html__( 'Full browser height', 'hemma' ),
	    ),
	    'default' => 'is-fullheight'
	) );

	$cmb_hero->add_field( array(
	    'name' => esc_html__( 'Hero Background Color', 'hemma' ),
	    'desc' => esc_html__( 'The background color of the hero (useful if there is no image)', 'hemma' ),
	    'id'   => $prefix . 'bg_color',
	    'type' => 'select',
	    'show_option_none' => true,
	    'options' => array(
	    	'is-red'        => esc_html__( 'Red', 'hemma' ),
	    	'is-orange'     => esc_html__( 'Orange', 'hemma' ),
	    	'is-yellow'     => esc_html__( 'Yellow', 'hemma' ),
	    	'is-green'      => esc_html__( 'Green', 'hemma' ),
	    	'is-light-blue' => esc_html__( 'Light Blue', 'hemma' ),
	    	'is-blue'       => esc_html__( 'Blue', 'hemma' ),
	    	'is-purple'     => esc_html__( 'Purple', 'hemma' ),
	    	'is-pink'       => esc_html__( 'Pink', 'hemma' ),
	    	'is-brown'      => esc_html__( 'Brown', 'hemma' ),
	    	'is-dark'       => esc_html__( 'Dark', 'hemma' ),
	    ),
	) );

}

/**
 * Add Edit Room Meta Box in Room posts
 */
add_action( 'cmb2_admin_init', 'opendept_register_room_metabox' );
function opendept_register_room_metabox() {
	$prefix = 'opendept_room_';

	$cmb_room = new_cmb2_box( array(
		'id'            => $prefix . 'metabox',
		'title'         => esc_html__( 'Edit Room', 'hemma' ),
		'object_types'  => array( 'room' ),
		'context'      => 'normal',
		'priority'     => 'high',
	) );

	$cmb_room->add_field( array(
		'name' => esc_html__( 'Guests per room', 'hemma' ),
		'desc' => esc_html__( 'Leave empty if you don\'t want to show the guests information', 'hemma' ),
		'id'   => $prefix . 'guests',
		'type' => 'text_small',
	) );

	$cmb_room->add_field( array(
		'name' => esc_html__( 'Beds per room', 'hemma' ),
		'desc' => esc_html__( 'Leave empty if you don\'t want to show the beds information', 'hemma' ),
		'id'   => $prefix . 'beds',
		'type' => 'text_small',
	) );

	$cmb_room->add_field( array(
		'name' => esc_html__( 'Room size', 'hemma' ),
		'desc' => esc_html__( 'Leave empty if you don\'t want to show the room size', 'hemma' ),
		'id'   => $prefix . 'size',
		'type' => 'text_small',
	) );

}

/**
 * Add Room Sidebar Meta Box in Room posts
 */
add_action( 'cmb2_admin_init', 'opendept_register_room_sidebar_metabox' );
function opendept_register_room_sidebar_metabox() {
	$prefix = 'opendept_room_sidebar_';

	$cmb_room_sidebar = new_cmb2_box( array(
		'id'            => $prefix . 'metabox',
		'title'         => esc_html__( 'Sidebar Settings', 'hemma' ),
		'object_types'  => array( 'room' ),
		'context'      => 'normal',
		'priority'     => 'high',
	) );

	$cmb_room_sidebar->add_field( array(
	    'name' => esc_html__( 'Enable room sidebar', 'hemma' ),
	    'desc' => esc_html__( 'Tick this to show the sidebar on this page', 'hemma' ),
	    'id'   => $prefix . 'enable_sidebar',
	    'type' => 'checkbox',
	) );


	$cmb_room_sidebar->add_field( array(
	    'name' => esc_html__( 'Show price box', 'hemma' ),
	    'desc' => esc_html__( 'That\'s the grey zone where you can set the room price and the call-to-action button', 'hemma' ),
	    'id'   => $prefix . 'enable_box',
	    'type' => 'checkbox',
	) );

	$cmb_room_sidebar->add_field( array(
	    'name'    => esc_html__( 'Price box title', 'hemma' ),
	    'desc'    => esc_html__( 'The first paragraph in the grey box (e.g. &ldquo;Rates from&rdquo;)', 'hemma' ),
	    'id'      => $prefix . 'box_title',
	    'type'    => 'text',
	    'default' => esc_html__( 'Rates from', 'hemma' ),
	) );

	$cmb_room_sidebar->add_field( array(
	    'name' => esc_html__( 'Room Price', 'hemma' ),
	    'desc' => esc_html__( 'Price of the room', 'hemma' ),
	    'id'   => $prefix . 'box_price',
	    'type' => 'text_small',
	) );

	$cmb_room_sidebar->add_field( array(
	    'name'    => esc_html__( 'Price details', 'hemma' ),
	    'desc'    => esc_html__( 'The paragraph below the price (e.g. &ldquo;per night&rdquo;)', 'hemma' ),
	    'id'      => $prefix . 'box_price_per',
	    'type'    => 'text',
	    'default' => esc_html__( 'per night', 'hemma' ),
	) );

	$cmb_room_sidebar->add_field( array(
	    'name'    => esc_html__( 'Button text', 'hemma' ),
	    'desc'    => esc_html__( 'Leave empty if you don\'t want to show the button', 'hemma' ),
	    'id'      => $prefix . 'box_button_text',
	    'type'    => 'text',
	) );

	$cmb_room_sidebar->add_field( array(
	    'name'    => esc_html__( 'Button link', 'hemma' ),
	    'desc'    => esc_html__( 'The button link (e.g. http://www.website.com)', 'hemma' ),
	    'id'      => $prefix . 'box_button_link',
	    'type'    => 'text_url',
	) );

	$cmb_room_sidebar->add_field( array(
	    'name' => esc_html__( 'Button color', 'hemma' ),
	    'id'   => $prefix . 'box_button_color',
	    'type' => 'select',
	    'show_option_none' => true,
	    'options' => array(
	    	'is-red'        => esc_html__( 'Red', 'hemma' ),
	    	'is-orange'     => esc_html__( 'Orange', 'hemma' ),
	    	'is-yellow'     => esc_html__( 'Yellow', 'hemma' ),
	    	'is-green'      => esc_html__( 'Green', 'hemma' ),
	    	'is-light-blue' => esc_html__( 'Light Blue', 'hemma' ),
	    	'is-blue'       => esc_html__( 'Blue', 'hemma' ),
	    	'is-purple'     => esc_html__( 'Purple', 'hemma' ),
	    	'is-pink'       => esc_html__( 'Pink', 'hemma' ),
	    	'is-brown'      => esc_html__( 'Brown', 'hemma' ),
	    	'is-dark'       => esc_html__( 'Dark', 'hemma' ),
	    	'is-white'      => esc_html__( 'White', 'hemma' ),
	    ),
	) );

	$cmb_room_sidebar->add_field( array(
	    'name' => esc_html__( 'Button link opens a new page?', 'hemma' ),
	    'desc' => esc_html__( 'Tick this if you want to open the link in a new page', 'hemma' ),
	    'id'   => $prefix . 'box_button_target',
	    'type' => 'checkbox',
	) );

	$cmb_room_sidebar->add_field( array(
	    'name'    => esc_html__( 'Extra notes', 'hemma' ),
	    'desc'    => esc_html__( 'Use this field to add extra notes to the grey box', 'hemma' ),
	    'id'      => $prefix . 'box_notes',
	    'type'    => 'textarea',
	) );

	$cmb_room_sidebar->add_field( array(
	    'name'    => esc_html__( 'Other sidebar informations', 'hemma' ),
	    'id'      => $prefix . 'content',
	    'type'    => 'wysiwyg',
	    'options' => array(
	    	'media_buttons' => false,
	    	'teeny'         => true,
	    	'wpautop'       => true,
	    ),
	) );

}

/**
 * Add Edit Event Meta Box in Event posts
 */
add_action( 'cmb2_admin_init', 'opendept_register_event_metabox' );
function opendept_register_event_metabox() {
	$prefix = 'opendept_event_';

	$cmb_event = new_cmb2_box( array(
		'id'            => $prefix . 'metabox',
		'title'         => esc_html__( 'Edit Event', 'hemma' ),
		'object_types'  => array( 'event' ),
	) );

	$cmb_event->add_field( array(
		'name'       => esc_html__( 'Event Date', 'hemma' ),
		'desc'       => esc_html__( 'Leave empty if you don\'t want to show a date', 'hemma' ),
		'id'         => $prefix . 'date',
		'type'       => 'text',
	) );

	$cmb_event->add_field( array(
		'name'       => esc_html__( 'Event Place', 'hemma' ),
		'desc'       => esc_html__( 'Leave empty if you don\'t want to show a place', 'hemma' ),
		'id'         => $prefix . 'place',
		'type'       => 'text',
	) );

}

/**
 * Add Event Sidebar Meta Box in Event posts
 */
add_action( 'cmb2_admin_init', 'opendept_register_event_sidebar_metabox' );
function opendept_register_event_sidebar_metabox() {
	$prefix = 'opendept_event_sidebar_';

	$cmb_event_sidebar = new_cmb2_box( array(
		'id'            => $prefix . 'metabox',
		'title'         => esc_html__( 'Sidebar Settings', 'hemma' ),
		'object_types'  => array( 'event' ),
		'context'      => 'normal',
		'priority'     => 'high',
	) );

	$cmb_event_sidebar->add_field( array(
	    'name' => esc_html__( 'Enable event sidebar', 'hemma' ),
	    'desc' => esc_html__( 'Tick this to show the sidebar on this page', 'hemma' ),
	    'id'   => $prefix . 'enable_sidebar',
	    'type' => 'checkbox',
	) );


	$cmb_event_sidebar->add_field( array(
	    'name' => esc_html__( 'Show calendar box', 'hemma' ),
	    'desc' => esc_html__( 'That\'s the grey zone where you can set the event calendar and the call-to-action button', 'hemma' ),
	    'id'   => $prefix . 'enable_box',
	    'type' => 'checkbox',
	) );

	$cmb_event_sidebar->add_field( array(
	    'name'    => esc_html__( 'Calendar box title', 'hemma' ),
	    'desc'    => esc_html__( 'The first paragraph in the grey box (e.g. &ldquo;Event start&rdquo;)', 'hemma' ),
	    'id'      => $prefix . 'box_title',
	    'type'    => 'text',
	    'default' => esc_html__( 'Event start', 'hemma' ),
	) );

	$cmb_event_sidebar->add_field( array(
	    'name' => esc_html__( 'Event day', 'hemma' ),
	    'desc' => esc_html__( 'The day you want to display', 'hemma' ),
	    'id'   => $prefix . 'box_day',
	    'type' => 'text_small',
	) );

	$cmb_event_sidebar->add_field( array(
	    'name'    => esc_html__( 'Event month/year', 'hemma' ),
	    'desc'    => esc_html__( 'The paragraph below the day (you can use it to show the month and the year. E.g. &ldquo;September 2016&rdquo;)', 'hemma' ),
	    'id'      => $prefix . 'box_m_y',
	    'type'    => 'text',
	) );

	$cmb_event_sidebar->add_field( array(
	    'name'    => esc_html__( 'Button text', 'hemma' ),
	    'desc'    => esc_html__( 'Leave empty if you don\'t want to show the button', 'hemma' ),
	    'id'      => $prefix . 'box_button_text',
	    'type'    => 'text',
	) );

	$cmb_event_sidebar->add_field( array(
	    'name'    => esc_html__( 'Button link', 'hemma' ),
	    'desc'    => esc_html__( 'The button link (e.g. http://www.website.com)', 'hemma' ),
	    'id'      => $prefix . 'box_button_link',
	    'type'    => 'text_url',
	) );

	$cmb_event_sidebar->add_field( array(
	    'name' => esc_html__( 'Button color', 'hemma' ),
	    'id'   => $prefix . 'box_button_color',
	    'type' => 'select',
	    'show_option_none' => true,
	    'options' => array(
	    	'is-red'        => esc_html__( 'Red', 'hemma' ),
	    	'is-orange'     => esc_html__( 'Orange', 'hemma' ),
	    	'is-yellow'     => esc_html__( 'Yellow', 'hemma' ),
	    	'is-green'      => esc_html__( 'Green', 'hemma' ),
	    	'is-light-blue' => esc_html__( 'Light Blue', 'hemma' ),
	    	'is-blue'       => esc_html__( 'Blue', 'hemma' ),
	    	'is-purple'     => esc_html__( 'Purple', 'hemma' ),
	    	'is-pink'       => esc_html__( 'Pink', 'hemma' ),
	    	'is-brown'      => esc_html__( 'Brown', 'hemma' ),
	    	'is-dark'       => esc_html__( 'Dark', 'hemma' ),
	    	'is-white'      => esc_html__( 'White', 'hemma' ),
	    ),
	) );

	$cmb_event_sidebar->add_field( array(
	    'name' => esc_html__( 'Button link opens a new page?', 'hemma' ),
	    'desc' => esc_html__( 'Tick this if you want to open the link in a new page', 'hemma' ),
	    'id'   => $prefix . 'box_button_target',
	    'type' => 'checkbox',
	) );

	$cmb_event_sidebar->add_field( array(
	    'name'    => esc_html__( 'Extra notes', 'hemma' ),
	    'desc'    => esc_html__( 'Use this field to add extra notes to the grey box', 'hemma' ),
	    'id'      => $prefix . 'box_notes',
	    'type'    => 'textarea',
	) );

	$cmb_event_sidebar->add_field( array(
	    'name'    => esc_html__( 'Other sidebar informations', 'hemma' ),
	    'id'      => $prefix . 'content',
	    'type'    => 'wysiwyg',
	    'options' => array(
	    	'media_buttons' => false,
	    	'teeny'         => true,
	    	'wpautop'       => true,
	    ),
	) );

}

/**
 * Add Food Sidebar Meta Box in Food posts
 */
add_action( 'cmb2_admin_init', 'opendept_register_food_sidebar_metabox' );
function opendept_register_food_sidebar_metabox() {
	$prefix = 'opendept_food_sidebar_';

	$cmb_food_sidebar = new_cmb2_box( array(
		'id'            => $prefix . 'metabox',
		'title'         => esc_html__( 'Sidebar Settings', 'hemma' ),
		'object_types'  => array( 'food' ),
		'context'      => 'normal',
		'priority'     => 'high',
	) );

	$cmb_food_sidebar->add_field( array(
	    'name' => esc_html__( 'Enable food sidebar', 'hemma' ),
	    'desc' => esc_html__( 'Tick this to show the sidebar on this page', 'hemma' ),
	    'id'   => $prefix . 'enable_sidebar',
	    'type' => 'checkbox',
	) );


	$cmb_food_sidebar->add_field( array(
	    'name' => esc_html__( 'Show price box', 'hemma' ),
	    'desc' => esc_html__( 'That\'s the grey zone where you can set the dish price and the call-to-action button', 'hemma' ),
	    'id'   => $prefix . 'enable_box',
	    'type' => 'checkbox',
	) );

	$cmb_food_sidebar->add_field( array(
	    'name'    => esc_html__( 'Price box title', 'hemma' ),
	    'desc'    => esc_html__( 'The first paragraph in the grey box (e.g. &ldquo;Dish price&rdquo;)', 'hemma' ),
	    'id'      => $prefix . 'box_title',
	    'type'    => 'text',
	    'default' => esc_html__( 'Dish price', 'hemma' ),
	) );

	$cmb_food_sidebar->add_field( array(
	    'name' => esc_html__( 'Dish Price', 'hemma' ),
	    'desc' => esc_html__( 'Price of the dish', 'hemma' ),
	    'id'   => $prefix . 'box_price',
	    'type' => 'text_small',
	) );

	$cmb_food_sidebar->add_field( array(
	    'name'    => esc_html__( 'Price details', 'hemma' ),
	    'desc'    => esc_html__( 'The paragraph below the price (e.g. &ldquo;per night&rdquo;)', 'hemma' ),
	    'id'      => $prefix . 'box_price_per',
	    'type'    => 'text',
	    'default' => esc_html__( 'per portion', 'hemma' ),
	) );

	$cmb_food_sidebar->add_field( array(
	    'name'    => esc_html__( 'Button text', 'hemma' ),
	    'desc'    => esc_html__( 'Leave empty if you don\'t want to show the button', 'hemma' ),
	    'id'      => $prefix . 'box_button_text',
	    'type'    => 'text',
	) );

	$cmb_food_sidebar->add_field( array(
	    'name'    => esc_html__( 'Button link', 'hemma' ),
	    'desc'    => esc_html__( 'The button link (e.g. http://www.website.com)', 'hemma' ),
	    'id'      => $prefix . 'box_button_link',
	    'type'    => 'text_url',
	) );

	$cmb_food_sidebar->add_field( array(
	    'name' => esc_html__( 'Button color', 'hemma' ),
	    'id'   => $prefix . 'box_button_color',
	    'type' => 'select',
	    'show_option_none' => true,
	    'options' => array(
	    	'is-red'        => esc_html__( 'Red', 'hemma' ),
	    	'is-orange'     => esc_html__( 'Orange', 'hemma' ),
	    	'is-yellow'     => esc_html__( 'Yellow', 'hemma' ),
	    	'is-green'      => esc_html__( 'Green', 'hemma' ),
	    	'is-light-blue' => esc_html__( 'Light Blue', 'hemma' ),
	    	'is-blue'       => esc_html__( 'Blue', 'hemma' ),
	    	'is-purple'     => esc_html__( 'Purple', 'hemma' ),
	    	'is-pink'       => esc_html__( 'Pink', 'hemma' ),
	    	'is-brown'      => esc_html__( 'Brown', 'hemma' ),
	    	'is-dark'       => esc_html__( 'Dark', 'hemma' ),
	    	'is-white'      => esc_html__( 'White', 'hemma' ),
	    ),
	) );

	$cmb_food_sidebar->add_field( array(
	    'name' => esc_html__( 'Button link opens a new page?', 'hemma' ),
	    'desc' => esc_html__( 'Tick this if you want to open the link in a new page', 'hemma' ),
	    'id'   => $prefix . 'box_button_target',
	    'type' => 'checkbox',
	) );

	$cmb_food_sidebar->add_field( array(
	    'name'    => esc_html__( 'Extra notes', 'hemma' ),
	    'desc'    => esc_html__( 'Use this field to add extra notes to the grey box', 'hemma' ),
	    'id'      => $prefix . 'box_notes',
	    'type'    => 'textarea',
	) );

	$cmb_food_sidebar->add_field( array(
	    'name'    => esc_html__( 'Other sidebar informations', 'hemma' ),
	    'id'      => $prefix . 'content',
	    'type'    => 'wysiwyg',
	    'options' => array(
	    	'media_buttons' => false,
	    	'teeny'         => true,
	    	'wpautop'       => true,
	    ),
	) );

}

/**
 * Add Edit Deal Meta Box in Deal posts
 */
add_action( 'cmb2_admin_init', 'opendept_register_deal_metabox' );
function opendept_register_deal_metabox() {
	$prefix = 'opendept_deal_';

	$cmb_deal = new_cmb2_box( array(
		'id'            => $prefix . 'metabox',
		'title'         => esc_html__( 'Edit Deal', 'hemma' ),
		'object_types'  => array( 'deal' ),
		'context'      => 'normal',
		'priority'     => 'high',
	) );

	$cmb_deal->add_field( array(
		'name'       => esc_html__( 'Deal Date', 'hemma' ),
		'desc'       => esc_html__( 'Leave empty if you don\'t want to show a date', 'hemma' ),
		'id'         => $prefix . 'date',
		'type'       => 'text',
	) );

	$cmb_deal->add_field( array(
		'name' => esc_html__( 'Guests', 'hemma' ),
		'desc' => esc_html__( 'Leave empty if you don\'t want to show the guests information', 'hemma' ),
		'id'   => $prefix . 'guests',
		'type' => 'text_small',
	) );

	$cmb_deal->add_field( array(
		'name' => esc_html__( 'Beds', 'hemma' ),
		'desc' => esc_html__( 'Leave empty if you don\'t want to show the beds information', 'hemma' ),
		'id'   => $prefix . 'beds',
		'type' => 'text_small',
	) );

	$cmb_deal->add_field( array(
		'name' => esc_html__( 'Meals', 'hemma' ),
		'desc' => esc_html__( 'Leave empty if you don\'t want to show the meals information', 'hemma' ),
		'id'   => $prefix . 'meals',
		'type' => 'text_small',
	) );

}

/**
 * Add Deal Sidebar Meta Box in Deal posts
 */
add_action( 'cmb2_admin_init', 'opendept_register_deal_sidebar_metabox' );
function opendept_register_deal_sidebar_metabox() {
	$prefix = 'opendept_deal_sidebar_';

	$cmb_deal_sidebar = new_cmb2_box( array(
		'id'            => $prefix . 'metabox',
		'title'         => esc_html__( 'Sidebar Settings', 'hemma' ),
		'object_types'  => array( 'deal' ),
		'context'      => 'normal',
		'priority'     => 'high',
	) );

	$cmb_deal_sidebar->add_field( array(
	    'name' => esc_html__( 'Enable deal sidebar', 'hemma' ),
	    'desc' => esc_html__( 'Tick this to show the sidebar on this page', 'hemma' ),
	    'id'   => $prefix . 'enable_sidebar',
	    'type' => 'checkbox',
	) );


	$cmb_deal_sidebar->add_field( array(
	    'name' => esc_html__( 'Show price/date box', 'hemma' ),
	    'desc' => esc_html__( 'That\'s the grey zone where you can set the deal price or date and the call-to-action button', 'hemma' ),
	    'id'   => $prefix . 'enable_box',
	    'type' => 'checkbox',
	) );

	$cmb_deal_sidebar->add_field( array(
	    'name'    => esc_html__( 'Price/date box title', 'hemma' ),
	    'desc'    => esc_html__( 'The first paragraph in the grey box (e.g. &ldquo;Book it now&rdquo; or &ldquo;Deal ends&rdquo;)', 'hemma' ),
	    'id'      => $prefix . 'box_title',
	    'type'    => 'text',
	    'default' => esc_html__( 'Book it now', 'hemma' ),
	) );

	$cmb_deal_sidebar->add_field( array(
	    'name' => esc_html__( 'Deal Price/Day', 'hemma' ),
	    'desc' => esc_html__( 'Price or day of the deal', 'hemma' ),
	    'id'   => $prefix . 'box_price_date',
	    'type' => 'text_small',
	) );

	$cmb_deal_sidebar->add_field( array(
	    'name'    => esc_html__( 'Price details', 'hemma' ),
	    'desc'    => esc_html__( 'The paragraph below the price (e.g. &ldquo;per two nights&rdquo;)', 'hemma' ),
	    'id'      => $prefix . 'box_price_per_m_y',
	    'type'    => 'text',
	    'default' => esc_html__( 'per two nights', 'hemma' ),
	) );

	$cmb_deal_sidebar->add_field( array(
	    'name'    => esc_html__( 'Button text', 'hemma' ),
	    'desc'    => esc_html__( 'Leave empty if you don\'t want to show the button', 'hemma' ),
	    'id'      => $prefix . 'box_button_text',
	    'type'    => 'text',
	) );

	$cmb_deal_sidebar->add_field( array(
	    'name'    => esc_html__( 'Button link', 'hemma' ),
	    'desc'    => esc_html__( 'The button link (e.g. http://www.website.com)', 'hemma' ),
	    'id'      => $prefix . 'box_button_link',
	    'type'    => 'text_url',
	) );

	$cmb_deal_sidebar->add_field( array(
	    'name' => esc_html__( 'Button color', 'hemma' ),
	    'id'   => $prefix . 'box_button_color',
	    'type' => 'select',
	    'show_option_none' => true,
	    'options' => array(
	    	'is-red'        => esc_html__( 'Red', 'hemma' ),
	    	'is-orange'     => esc_html__( 'Orange', 'hemma' ),
	    	'is-yellow'     => esc_html__( 'Yellow', 'hemma' ),
	    	'is-green'      => esc_html__( 'Green', 'hemma' ),
	    	'is-light-blue' => esc_html__( 'Light Blue', 'hemma' ),
	    	'is-blue'       => esc_html__( 'Blue', 'hemma' ),
	    	'is-purple'     => esc_html__( 'Purple', 'hemma' ),
	    	'is-pink'       => esc_html__( 'Pink', 'hemma' ),
	    	'is-brown'      => esc_html__( 'Brown', 'hemma' ),
	    	'is-dark'       => esc_html__( 'Dark', 'hemma' ),
	    	'is-white'      => esc_html__( 'White', 'hemma' ),
	    ),
	) );

	$cmb_deal_sidebar->add_field( array(
	    'name' => esc_html__( 'Button link opens a new page?', 'hemma' ),
	    'desc' => esc_html__( 'Tick this if you want to open the link in a new page', 'hemma' ),
	    'id'   => $prefix . 'box_button_target',
	    'type' => 'checkbox',
	) );

	$cmb_deal_sidebar->add_field( array(
	    'name'    => esc_html__( 'Extra notes', 'hemma' ),
	    'desc'    => esc_html__( 'Use this field to add extra notes to the grey box', 'hemma' ),
	    'id'      => $prefix . 'box_notes',
	    'type'    => 'textarea',
	) );

	$cmb_deal_sidebar->add_field( array(
	    'name'    => esc_html__( 'Other sidebar informations', 'hemma' ),
	    'id'      => $prefix . 'content',
	    'type'    => 'wysiwyg',
	    'options' => array(
	    	'media_buttons' => false,
	    	'teeny'         => true,
	    	'wpautop'       => true,
	    ),
	) );

}

/**
 * Add Post Summary Meta Box in Room, Event, Food and Deal posts
 */
add_action( 'cmb2_admin_init', 'opendept_register_summary_metabox' );
function opendept_register_summary_metabox() {
	$prefix = 'opendept_summary_';

	$cmb_summary = new_cmb2_box( array(
		'id'            => $prefix . 'metabox',
		'title'         => esc_html__( 'Post Summary', 'hemma' ),
		'object_types'  => array( 'room', 'event', 'food', 'deal' ),
		'context'      => 'normal',
		'priority'     => 'high',
	) );

	$cmb_summary->add_field( array(
	    'name'    => esc_html__( 'Post Summary Content', 'hemma' ),
	    'show_names'    => false,
	    'desc'    => esc_html__( 'Type here the summary that you want to display on the parent page.', 'hemma' ),
	    'id'      => $prefix . 'content',
	    'type'    => 'wysiwyg',
	    'options' => array(
	    	'media_buttons' => false,
	    	'teeny'         => true,
	    	'wpautop'       => true,
	    ),
	) );

}

/**
 * Add Post Summary Settings Meta Box in Room, Event, Food and Deal pages
 */
add_action( 'cmb2_admin_init', 'opendept_register_listed_posts_metabox' );
function opendept_register_listed_posts_metabox() {
	$prefix = 'opendept_listed_posts_';

	$cmb_listed_posts = new_cmb2_box( array(
		'id'            => $prefix . 'metabox',
		'title'         => esc_html__( 'Post Summary Settings', 'hemma' ),
		'object_types'  => array( 'page' ),
		'show_on'       => array( 'key' => 'cpt-template', 'value' => array( 'template-room', 'template-event', 'template-food', 'template-deal' ) ),
		'context'      => 'normal',
		'priority'     => 'high',
	) );

	$cmb_listed_posts->add_field( array(
	    'name'    => esc_html__( 'Show Subtitle', 'hemma' ),
	    'desc'    => esc_html__( 'Tick this to display the subtitle in the post summary', 'hemma' ),
	    'id'      => $prefix . 'enable_subtitle',
	    'type'    => 'checkbox',
	) );

	$cmb_listed_posts->add_field( array(
	    'name'    => esc_html__( 'Show Meta Informations', 'hemma' ),
	    'desc'    => esc_html__( 'Tick this to display the meta informations (i.e. the icons with labels) in the post summary', 'hemma' ),
	    'id'      => $prefix . 'enable_meta_info',
	    'type'    => 'checkbox',
	) );

	$cmb_listed_posts->add_field( array(
	    'name'    => esc_html__( 'Show Button', 'hemma' ),
	    'desc'    => esc_html__( 'Tick this to display the button in the post summary', 'hemma' ),
	    'id'      => $prefix . 'enable_button',
	    'type'    => 'checkbox',
	) );

	$cmb_listed_posts->add_field( array(
	    'name'    => esc_html__( 'Button text', 'hemma' ),
	    'id'      => $prefix . 'button_text',
	    'type'    => 'text',
	    'default' => esc_html__( 'Read More', 'hemma' ),
	) );

	$cmb_listed_posts->add_field( array(
	    'name' => esc_html__( 'Button color', 'hemma' ),
	    'id'   => $prefix . 'button_color',
	    'type' => 'select',
	    'show_option_none' => true,
	    'options' => array(
	    	'is-red'        => esc_html__( 'Red', 'hemma' ),
	    	'is-orange'     => esc_html__( 'Orange', 'hemma' ),
	    	'is-yellow'     => esc_html__( 'Yellow', 'hemma' ),
	    	'is-green'      => esc_html__( 'Green', 'hemma' ),
	    	'is-light-blue' => esc_html__( 'Light Blue', 'hemma' ),
	    	'is-blue'       => esc_html__( 'Blue', 'hemma' ),
	    	'is-purple'     => esc_html__( 'Purple', 'hemma' ),
	    	'is-pink'       => esc_html__( 'Pink', 'hemma' ),
	    	'is-brown'      => esc_html__( 'Brown', 'hemma' ),
	    	'is-dark'       => esc_html__( 'Dark', 'hemma' ),
	    	'is-white'      => esc_html__( 'White', 'hemma' ),
	    ),
	) );

	$cmb_listed_posts->add_field( array(
	    'name'    => esc_html__( 'Strip link from the title', 'hemma' ),
	    'desc'    => esc_html__( 'Tick this if you want to strip the link frome the title', 'hemma' ),
	    'id'      => $prefix . 'strip_title_link',
	    'type'    => 'checkbox',
	) );

	$cmb_listed_posts->add_field( array(
		'name' => esc_html__( 'Blocks Height', 'hemma' ),
		'desc' => esc_html__( 'The minimum height of the blocks', 'hemma' ),
		'id'   => $prefix . 'height',
		'type' => 'select',
		'options' => array(
	        'is-contentheight' => esc_html__( 'Content Height', 'hemma' ),
	        'is-halfheight'    => esc_html__( 'Half browser height', 'hemma' ),
	        'is-fullheight'    => esc_html__( 'Full browser height', 'hemma' ),
	    ),
	    'default' => 'is-contentheight'
	) );

}

/**
 * Add Guest Name Meta Box in Guest Post posts
 */
add_action( 'cmb2_admin_init', 'opendept_register_guestpost_metabox' );
function opendept_register_guestpost_metabox() {
	$prefix = 'opendept_guestpost_';

	$cmb_subtitle = new_cmb2_box( array(
		'id'            => $prefix . 'metabox',
		'title'         => esc_html__( 'Guest Name', 'hemma' ),
		'object_types'  => array( 'guestpost' ),
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => false,
	) );

	$cmb_subtitle->add_field( array(
		'name' => esc_html__( 'Guest Name', 'hemma' ),
		'desc' => esc_html__( 'Leave empty if you don\'t want to show a name', 'hemma' ),
		'id'   => $prefix . 'guest_name',
		'type' => 'text',
	) );

}

/**
 * Add Block Builder Meta Box in Composer pages
 */
add_action( 'cmb2_admin_init', 'opendept_register_block_builder_metabox' );
function opendept_register_block_builder_metabox() {
	$prefix = 'opendept_composer_';

	$cmb_composer = new_cmb2_box( array(
		'id'            => $prefix . 'metabox',
		'title'         => esc_html__( 'Block Builder', 'hemma' ),
		'object_types'  => array( 'page' ),
		'show_on'       => array( 'key' => 'cpt-template', 'value' => 'template-composer' ),
		'context'      => 'normal',
		'priority'     => 'high',
	) );

	// $group_field_id is the field id string, so in this case: $prefix . 'demo'
	$block_id = $cmb_composer->add_field( array(
		'id'          => $prefix . 'block',
		'type'        => 'group',
		'options'     => array(
			'group_title'   => esc_html__( 'Block {#}', 'hemma' ),
			'add_button'    => esc_html__( 'Add Another Block', 'hemma' ),
			'remove_button' => esc_html__( 'Remove Block', 'hemma' ),
			'sortable'      => true,
		),
	) );

	$cmb_composer->add_group_field( $block_id, array(
		'name'             => esc_html__( 'Block Type', 'hemma' ),
		'desc'             => esc_html__( 'Select the type of block you want to display', 'hemma' ),
		'id'               => $prefix . 'select',
		'type'             => 'select',
		'default'          => 'none',
		'options'          => array(
			'none'             => esc_html__( 'None', 'hemma' ),
			'split-block'      => esc_html__( 'Custom split block', 'hemma' ),
			'full-bg'          => esc_html__( 'Custom full background block ', 'hemma' ),
			'blog-parse'       => esc_html__( 'Blog feed', 'hemma' ),
			'instagram-parse'  => esc_html__( 'Instagram feed', 'hemma' ),
			'guestpost-parse'  => esc_html__( 'Guest Posts carousel', 'hemma' ),
			'split-block-map'  => esc_html__( 'Map - Split block', 'hemma' ),
			'full-map'         => esc_html__( 'Map - Full width', 'hemma' ),
			//'post-parse'       => esc_html__( 'Single Post, Room, Event, Food or Deal ', 'hemma' ),
		),
	) );

	$cmb_composer->add_group_field( $block_id, array(
		'name'       => esc_html__( 'Block Title', 'hemma' ),
		'id'         => $prefix . 'title',
		'type'       => 'text',
	) );

	$cmb_composer->add_group_field( $block_id, array(
		'name'       => esc_html__( 'Block Subtitle', 'hemma' ),
		'id'         => $prefix . 'subtitle',
		'type'       => 'text',
	) );

	$cmb_composer->add_group_field( $block_id, array(
		'name'        => esc_html__( 'Block Content', 'hemma' ),
		'description' => esc_html__( 'HTML is allowed', 'hemma' ),
		'id'          => $prefix . 'content',
		'type'        => 'textarea_small',
	) );

	$cmb_composer->add_group_field( $block_id, array(
	    'name'    => esc_html__( 'Button text', 'hemma' ),
	    'desc'    => esc_html__( 'Leave empty if you don\'t want to show the button', 'hemma' ),
	    'id'      => $prefix . 'button_text',
	    'type'    => 'text',
	) );

	$cmb_composer->add_group_field( $block_id, array(
	    'name'    => esc_html__( 'Button link', 'hemma' ),
	    'desc'    => esc_html__( 'The button link (e.g. http://www.website.com)', 'hemma' ),
	    'id'      => $prefix . 'button_link',
	    'type'    => 'text_url',
	) );

	$cmb_composer->add_group_field( $block_id, array(
	    'name' => esc_html__( 'Button color', 'hemma' ),
	    'id'   => $prefix . 'button_color',
	    'type' => 'select',
	    'show_option_none' => true,
	    'options' => array(
	    	'is-red'        => esc_html__( 'Red', 'hemma' ),
	    	'is-orange'     => esc_html__( 'Orange', 'hemma' ),
	    	'is-yellow'     => esc_html__( 'Yellow', 'hemma' ),
	    	'is-green'      => esc_html__( 'Green', 'hemma' ),
	    	'is-light-blue' => esc_html__( 'Light Blue', 'hemma' ),
	    	'is-blue'       => esc_html__( 'Blue', 'hemma' ),
	    	'is-purple'     => esc_html__( 'Purple', 'hemma' ),
	    	'is-pink'       => esc_html__( 'Pink', 'hemma' ),
	    	'is-brown'      => esc_html__( 'Brown', 'hemma' ),
	    	'is-dark'       => esc_html__( 'Dark', 'hemma' ),
	    	'is-white'      => esc_html__( 'White', 'hemma' ),
	    ),
	) );

	$cmb_composer->add_group_field( $block_id, array(
	    'name' => esc_html__( 'Button link opens a new page?', 'hemma' ),
	    'desc' => esc_html__( 'Tick this if you want to open the link in a new page', 'hemma' ),
	    'id'   => $prefix . 'button_target',
	    'type' => 'checkbox',
	) );

	$cmb_composer->add_group_field( $block_id, array(
		'name' => esc_html__( 'Block Image', 'hemma' ),
		'id'   => $prefix . 'image',
		'type' => 'file',
	) );

	$cmb_composer->add_group_field( $block_id, array(
		'name' => esc_html__( 'Map Latitude', 'hemma' ),
		'desc' => sprintf( wp_kses( __( 'Specify the latitude for the pin. Find it out <a href="%1$s" target="_blank">here</a>', 'hemma' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( 'http://itouchmap.com/latlong.html' ) ),
		'id'   => $prefix . 'map_lat',
		'type' => 'text_small',
	) );

	$cmb_composer->add_group_field( $block_id, array(
		'name' => esc_html__( 'Map Longitude', 'hemma' ),
		'desc' => sprintf( wp_kses( __( 'Specify the latitude for the pin. Find it out <a href="%1$s" target="_blank">here</a>', 'hemma' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( 'http://itouchmap.com/latlong.html' ) ),
		'id'   => $prefix . 'map_lon',
		'type' => 'text_small',
	) );

	$cmb_composer->add_group_field( $block_id, array(
		'name'    => esc_html__( 'Map Zoom Level', 'hemma' ),
		'desc'    => esc_html__( 'The initial resolution at which to display the map', 'hemma' ),
		'id'      => $prefix . 'map_zoom',
		'type'    => 'text_small',
		'default' => '7'
	) );

	$cmb_composer->add_group_field( $block_id, array(
		'name' => esc_html__( 'Map Style', 'hemma' ),
		'id'   => $prefix . 'map_style',
		'type' => 'select',
		'options' => array(
	        'none'   => esc_html__( 'Default', 'hemma' ),
	        'light'  => esc_html__( 'Light', 'hemma' ),
	        'dark'   => esc_html__( 'Dark', 'hemma' ),
	    ),
	    'default' => 'none'
	) );

	$cmb_composer->add_group_field( $block_id, array(
	    'name' => esc_html__( 'Marker Color', 'hemma' ),
	    'id'   => $prefix . 'map_marker_color',
	    'type' => 'select',
	    'show_option_none' => true,
	    'options' => array(
	    	'is-red'        => esc_html__( 'Red', 'hemma' ),
	    	'is-orange'     => esc_html__( 'Orange', 'hemma' ),
	    	'is-yellow'     => esc_html__( 'Yellow', 'hemma' ),
	    	'is-green'      => esc_html__( 'Green', 'hemma' ),
	    	'is-light-blue' => esc_html__( 'Light Blue', 'hemma' ),
	    	'is-blue'       => esc_html__( 'Blue', 'hemma' ),
	    	'is-purple'     => esc_html__( 'Purple', 'hemma' ),
	    	'is-pink'       => esc_html__( 'Pink', 'hemma' ),
	    	'is-brown'      => esc_html__( 'Brown', 'hemma' ),
	    	'is-dark'       => esc_html__( 'Dark', 'hemma' ),
	    	'is-white'      => esc_html__( 'White', 'hemma' ),
	    ),
	) );

	$cmb_composer->add_group_field( $block_id, array(
		'name' => esc_html__( 'Block Layout', 'hemma' ),
		'id'   => $prefix . 'layout',
		'type' => 'select',
		'options' => array(
	        'img-right' => esc_html__( 'Figure on the Right', 'hemma' ),
	        'img-left'  => esc_html__( 'Figure on the Left', 'hemma' ),
	    ),
	    'default' => 'img-right'
	) );

	$cmb_composer->add_group_field( $block_id, array(
		'name' => esc_html__( 'Block Height', 'hemma' ),
		'desc' => esc_html__( 'The minimum height of the block', 'hemma' ),
		'id'   => $prefix . 'height',
		'type' => 'select',
		'options' => array(
	        'is-contentheight' => esc_html__( 'Content Height', 'hemma' ),
	        'is-halfheight'    => esc_html__( 'Half browser height', 'hemma' ),
	        'is-fullheight'    => esc_html__( 'Full browser height', 'hemma' ),
	    ),
	    'default' => 'is-contentheight'
	) );

	$cmb_composer->add_group_field( $block_id, array(
	    'name'    => esc_html__( 'Instagram Username', 'hemma' ),
	    'id'      => $prefix . 'instagram_user',
	    'type'    => 'text',
	) );

	$cmb_composer->add_group_field( $block_id, array(
	    'name'    => esc_html__( 'Number of images to display', 'hemma' ),
	    'id'      => $prefix . 'instagram_images',
	    'type' => 'select',
    	'options' => array(
            '3'   => '3',
            '7'   => '7',
            '11'  => '11',
        ),
        'default' => '3'
	) );

	$cmb_composer->add_group_field( $block_id, array(
	    'name'    => esc_html__( 'Guest posts to show in the carousel', 'hemma' ),
	    'id'      => $prefix . 'guestposts_nr',
	    'type' => 'select',
    	'options' => array(
            '1'  => '1',
            '2'  => '2',
            '3'  => '3',
            '4'  => '4',
            '5'  => '5',
            '6'  => '6',
            '7'  => '7',
            '8'  => '8',
            '9'  => '9',
            '10' => '10',
        ),
        'default' => '10'
	) );

	$cmb_composer->add_group_field( $block_id, array(
	    'name'    => wp_kses( __( '<span class="more-trigger">[+] Show more options</span>', 'hemma' ), array( 'span' => array( 'class' => array() ) ) ),
	    'id'      => $prefix . 'more_trigger',
	    'type'    => 'title',
	) );

}