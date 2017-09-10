<?php
/**
 * Hemma Theme Customizer.
 *
 * @package Hemma
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function hemma_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	// Remove some core sections
	$wp_customize->remove_control( 'display_header_text' );
	$wp_customize->remove_section( 'colors' );
	$wp_customize->remove_section( 'header_image' );
	$wp_customize->remove_section( 'background_image' );
}
add_action( 'customize_register', 'hemma_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function hemma_customize_preview_js() {
	wp_enqueue_script( 'hemma_customizer', get_template_directory_uri() . '/inc/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'hemma_customize_preview_js' );

/**
 * Add the theme configuration
 */
hemma_Kirki::add_config( 'hemma_theme', array(
	'option_type' => 'theme_mod',
	'capability'  => 'edit_theme_options',
) );
/**
 * Add the typography section
 */
hemma_Kirki::add_section( 'typography', array(
	'title'      => esc_html__( 'Typography', 'hemma' ),
	'priority'   => 20,
	'capability' => 'edit_theme_options',
) );
/**
 * Add the Body typography control
 */
hemma_Kirki::add_field( 'hemma_theme', array(
	'type'        => 'typography',
	'settings'    => 'body_typography',
	'label'       => esc_html__( 'Body Typography', 'hemma' ),
	'description' => esc_html__( 'Select the main typography options for your site.', 'hemma' ),
	'help'        => esc_html__( 'The typography options you set here apply to all content on your site.', 'hemma' ),
	'section'     => 'typography',
	'priority'    => 10,
	'default'     => array(
		'font-family'    => 'Lato',
		'variant'        => 'regular',
	),
	'output' => array(
		'element' => array( 'body', 'button', 'input', 'select', 'textarea' ),
	),
) );
/**
 * Add the Headers typography control
 */
hemma_Kirki::add_field( 'hemma_theme', array(
	'type'        => 'typography',
	'settings'    => 'headers_typography',
	'label'       => esc_html__( 'Headers Typography', 'hemma' ),
	'description' => esc_html__( 'Select the typography options for your headers.', 'hemma' ),
	'help'        => esc_html__( 'The typography options you set here will override the Body Typography options for all headers on your site (post titles, widget titles etc).', 'hemma' ),
	'section'     => 'typography',
	'priority'    => 10,
	'default'     => array(
		'font-family'    => 'Playfair Display',
		'variant'        => '700',
		'text-transform' => 'none'
	),
	'output' => array(
		'element' => array( '.author-box-title', '.block-title', '.entry-title', '.hero-title', '.main-navigation', '.preloader-counter' ),
	),
) );
/**
 * Add the Subtitles typography control
 */
hemma_Kirki::add_field( 'hemma_theme', array(
	'type'        => 'typography',
	'settings'    => 'subtitles_typography',
	'label'       => esc_html__( 'Subtitles Typography', 'hemma' ),
	'description' => esc_html__( 'Select the typography options for your subtitles.', 'hemma' ),
	'help'        => esc_html__( 'The typography options you set here will override the Body Typography options for all subtitles on your site.', 'hemma' ),
	'section'     => 'typography',
	'priority'    => 10,
	'default'     => array(
		'font-family'    => 'Playfair Display',
		'variant'        => 'italic',
		'text-transform' => 'none'
	),
	'output' => array(
		'element' => array( '.block-subtitle', '.hero-subtitle' ),
	),
) );
/**
 * Add the Header Settings section
 */
hemma_Kirki::add_section( 'header_settings', array(
	'title'      => esc_html__( 'Header Settings', 'hemma' ),
	'priority'   => 20,
	'capability' => 'edit_theme_options',
) );
/**
 * Add the Header Layout control
 */
hemma_Kirki::add_field( 'hemma_theme', array(
	'type'        => 'radio-image',
	'settings'    => 'header_layout',
	'label'       => esc_html__( 'Header Layout', 'hemma' ),
	'description' => esc_html__( 'Select the header layout for your website.', 'hemma' ),
	'section'     => 'header_settings',
	'priority'    => 10,
	'default'     => 'header-1',
	'choices'     => array(
		'header-1' => get_template_directory_uri() . '/inc/images/header-layout-1.png',
		'header-2' => get_template_directory_uri() . '/inc/images/header-layout-2.png',
		'header-3' => get_template_directory_uri() . '/inc/images/header-layout-3.png',
		'header-4' => get_template_directory_uri() . '/inc/images/header-layout-4.png',
	),
) );
/**
 * Add the Header Position control
 */
hemma_Kirki::add_field( 'hemma_theme', array(
	'type'        => 'radio-image',
	'settings'    => 'header_position',
	'label'       => esc_html__( 'Header Position', 'hemma' ),
	'description' => esc_html__( 'Select the header position when the there is a hero.', 'hemma' ),
	'section'     => 'header_settings',
	'priority'    => 10,
	'default'     => 'header-position-1',
	'choices'     => array(
		'header-position-1' => get_template_directory_uri() . '/inc/images/header-hero-1.png',
		'header-position-2' => get_template_directory_uri() . '/inc/images/header-hero-2.png',
	),
) );
/**
 * Add the Logo Image control
 */
hemma_Kirki::add_field( 'hemma_theme', array(
	'type'        => 'image',
	'settings'    => 'logo_image_1',
	'label'       => esc_html__( 'Logo Image', 'hemma' ),
	'description' => esc_html__( 'Recommended image height: 60px', 'hemma' ),
	'help'        => esc_html__( 'This is the logo image at @1x resolution that shows up on the white header.', 'hemma' ),
	'section'     => 'header_settings',
	'priority'    => 10,
	'output'      => ( get_theme_mod( 'logo_image_1' ) != '' ) ? array(
		'element'  => '.is-logo-image .site-header .site-title',
		'property' => 'background-image',
	) : array(),
) );
hemma_Kirki::add_field( 'hemma_theme', array(
	'type'        => 'image',
	'settings'    => 'logo_image_2',
	'label'       => esc_html__( 'Logo Image Retina', 'hemma' ),
	'description' => esc_html__( 'Recommended image height: 120px', 'hemma' ),
	'help'        => esc_html__( 'This is the logo image at @2x resolution that shows up on the white header.', 'hemma' ),
	'section'     => 'header_settings',
	'priority'    => 10,
	'output'      => ( get_theme_mod( 'logo_image_2' ) != '' ) ? array(
		'element'     => '.is-logo-image .site-header .site-title',
		'property'    => 'background-image',
		'media_query' => '@media only screen and (-webkit-min-device-pixel-ratio: 1.3), only screen and (-o-min-device-pixel-ratio: 13/10), only screen and (min-resolution: 120dpi)',
	) : array(),
) );
hemma_Kirki::add_field( 'hemma_theme', array(
	'type'        => 'image',
	'settings'    => 'logo_image_3',
	'label'       => esc_html__( 'Logo Image (white version)', 'hemma' ),
	'description' => esc_html__( 'Recommended image height: 60px', 'hemma' ),
	'help'        => esc_html__( 'This is the logo image at @1x resolution that shows up on hero images.', 'hemma' ),
	'section'     => 'header_settings',
	'priority'    => 10,
	'output'      => ( get_theme_mod( 'logo_image_3' ) != '' ) ? array(
		'element'  => '.is-logo-image .site-header.is-hero-on .site-title',
		'property' => 'background-image',
	) : array(),
) );
hemma_Kirki::add_field( 'hemma_theme', array(
	'type'        => 'image',
	'settings'    => 'logo_image_4',
	'label'       => esc_html__( 'Logo Image Retina (white version)', 'hemma' ),
	'description' => esc_html__( 'Recommended image height: 120px', 'hemma' ),
	'help'        => esc_html__( 'This is the logo image at @2x resolution that shows up on hero images.', 'hemma' ),
	'section'     => 'header_settings',
	'priority'    => 10,
	'output'      => ( get_theme_mod( 'logo_image_4' ) != '' ) ? array(
		'element'     => '.is-logo-image .site-header.is-hero-on .site-title',
		'property'    => 'background-image',
		'media_query' => '@media only screen and (-webkit-min-device-pixel-ratio: 1.3), only screen and (-o-min-device-pixel-ratio: 13/10), only screen and (min-resolution: 120dpi)',
	) : array(),
) );
hemma_Kirki::add_field( 'hemma_theme', array(
	'type'        => 'dimension',
	'settings'    => 'logo_width',
	'label'       => esc_html__( 'Logo Image Width', 'hemma' ),
	'description' => esc_html__( 'Set the width of your logo at 1x resolution', 'hemma' ),
	'help'        => esc_html__( 'If you see a cropped version of your logo, adjust the width. Check out the width of the logo that you have uploaded and set the value in px there.', 'hemma' ),
	'section'     => 'header_settings',
	'default'     => '60px',
	'priority'    => 10,
	'output'      => array(
		'element'     => '.is-logo-image .site-header .site-title',
		'property'    => 'width',
	),
) );
/**
 * Add the Layout Settings section
 */
hemma_Kirki::add_section( 'layout_settings', array(
	'title'      => esc_html__( 'Layout Settings', 'hemma' ),
	'priority'   => 20,
	'capability' => 'edit_theme_options',
) );
/**
 * Add the Website Layout control
 */
hemma_Kirki::add_field( 'hemma_theme', array(
	'type'        => 'radio',
	'settings'    => 'site_layout',
	'label'       => esc_html__( 'Website Layout', 'hemma' ),
	'description' => esc_html__( 'Select the header layout for your website.', 'hemma' ),
	'section'     => 'layout_settings',
	'priority'    => 10,
	'default'     => 'layout-1',
	'choices'     => array(
		'layout-1' => esc_html__( 'Wide layout', 'hemma' ),
		'layout-2' => esc_html__( 'Framed layout', 'hemma' ),
	),
) );
/**
 * Add the Accent Color control
 */
hemma_Kirki::add_field( 'hemma_theme', array(
	'type'        => 'select',
	'settings'    => 'accent_color',
	'label'       => esc_html__( 'Accent Color', 'hemma' ),
	'description' => esc_html__( 'Choose the accent color from the theme palette for hyperlinks.', 'hemma' ),
	'section'     => 'layout_settings',
	'default'     => 'is-default',
	'choices'     => array(
		'is-default'	=> esc_html__( 'Default', 'hemma' ),
		'is-red'        => esc_html__( 'Red', 'hemma' ),
		'is-orange'     => esc_html__( 'Orange', 'hemma' ),
		'is-yellow'     => esc_html__( 'Yellow', 'hemma' ),
		'is-green'      => esc_html__( 'Green', 'hemma' ),
		'is-light-blue' => esc_html__( 'Light Blue', 'hemma' ),
		'is-blue'       => esc_html__( 'Blue', 'hemma' ),
		'is-purple'     => esc_html__( 'Purple', 'hemma' ),
		'is-pink'       => esc_html__( 'Pink', 'hemma' ),
		'is-brown'      => esc_html__( 'Brown', 'hemma' ),
	),
) );
/**
 * Add the Radius Settings control
 */
hemma_Kirki::add_field( 'hemma_theme', array(
	'type'        => 'slider',
	'settings'    => 'radius',
	'label'       => esc_html__( 'Radius Setting', 'hemma' ),
	'description' => esc_html__( 'Add rounded borders to images, buttons and forms.', 'hemma' ),
	'section'     => 'layout_settings',
	'default'     => 0,
	'choices'     => array(
		'min'  => 0,
		'max'  => 10,
		'step' => 1,
	),
	'output' => array(
		array(
			'element'     => 'img, .map-shortcode, .button, input, textarea, .is-block-frame:not(.page-template) .site-content, .is-block-frame .block, .is-block-frame .hero, .pswp__img',
			'property'    => 'border-radius',
			'units'       => 'px',
		),
		array(
			'element'     => '.is-block-frame .site-footer',
			'property'    => 'border-top-left-radius',
			'units'       => 'px',
		),
		array(
			'element'     => '.is-block-frame .site-footer',
			'property'    => 'border-top-right-radius',
			'units'       => 'px',
		),
	),
) );
/**
 * Add the Preloader control
 */
hemma_Kirki::add_field( 'hemma_theme', array(
	'type'        => 'switch',
	'settings'    => 'preloader',
	'label'       => esc_html__( 'Preloader', 'hemma' ),
	'description' => esc_html__( 'Display the progress indicator screen during the page load.', 'hemma' ),
	'section'     => 'layout_settings',
	'priority'    => 10,
	'default'     => 'off',
	'choices'     => array(
		'on'  => esc_html__( 'On', 'hemma' ),
		'off' => esc_html__( 'Off', 'hemma' ),
	),
) );
/**
 * Add the Block Reveal Animations
 */
hemma_Kirki::add_field( 'hemma_theme', array(
	'type'        => 'switch',
	'settings'    => 'enable_block_animation',
	'label'       => esc_html__( 'Block Reveal Animations', 'hemma' ),
	'description' => esc_html__( 'Enable block reveal animations on scroll.', 'hemma' ),
	'section'     => 'layout_settings',
	'priority'    => 10,
	'default'     => 'off',
	'choices'     => array(
		'off' => esc_html__( 'Off', 'hemma' ),
		'on'  => esc_html__( 'On', 'hemma' ),
	),
) );
/**
 * Add the Enable Lightbox control
 */
hemma_Kirki::add_field( 'hemma_theme', array(
	'type'        => 'switch',
	'settings'    => 'enable_lightbox',
	'label'       => esc_html__( 'Enable Lightbox', 'hemma' ),
	'description' => esc_html__( 'Open post images in a lightbox gallery on click.', 'hemma' ),
	'section'     => 'layout_settings',
	'priority'    => 10,
	'default'     => '1',
	'choices'     => array(
		'on'  => esc_html__( 'On', 'hemma' ),
		'off' => esc_html__( 'Off', 'hemma' ),
	),
) );
/**
 * Add the First gallery image width control
 */
hemma_Kirki::add_field( 'hemma_theme', array(
	'type'        => 'switch',
	'settings'    => 'gallery_first_post',
	'label'       => esc_html__( 'First gallery image width', 'hemma' ),
	'description' => esc_html__( 'Control the width of the first image in a gallery.', 'hemma' ),
	'section'     => 'layout_settings',
	'priority'    => 10,
	'default'     => 'off',
	'choices'     => array(
		'on'  => esc_html__( 'Full width', 'hemma' ),
		'off' => esc_html__( 'Normal', 'hemma' ),
	),
) );
/**
 * Add the Custom CSS control
 */
hemma_Kirki::add_field( 'hemma_theme', array(
	'type'        => 'code',
	'settings'    => 'custom_css',
	'label'       => esc_html__( 'Custom CSS', 'hemma' ),
	'description' => esc_html__( 'Paste in the CSS editor your custom CSS code.<br>E.g.: <strong>body { background-color: #E7E7E7; }</strong>', 'hemma' ),
	'section'     => 'layout_settings',
	'priority'    => 10,
	'transport'   => 'postMessage',
	'default'     => '',
	'choices'     => array(
		'label'    => esc_html__( 'Open CSS editor', 'hemma' ),
		'language' => 'css',
		'theme'    => 'monokai',
	),
) );
/**
 * Add the Post Settings section
 */
hemma_Kirki::add_section( 'post_settings', array(
	'title'      => esc_html__( 'Post Settings', 'hemma' ),
	'priority'   => 20,
	'capability' => 'edit_theme_options',
) );
/**
 * Add the Enable Author Box control
 */
hemma_Kirki::add_field( 'hemma_theme', array(
	'type'        => 'switch',
	'settings'    => 'enable_author',
	'label'       => esc_html__( 'Enable Author Box', 'hemma' ),
	'description' => esc_html__( 'Enable the author box on blog posts.', 'hemma' ),
	'section'     => 'post_settings',
	'priority'    => 10,
	'default'     => '1',
	'choices'     => array(
		'on'  => esc_html__( 'On', 'hemma' ),
		'off' => esc_html__( 'Off', 'hemma' ),
	),
) );
/**
 * Add the Enable comments on room single posts control
 */
hemma_Kirki::add_field( 'hemma_theme', array(
	'type'        => 'switch',
	'settings'    => 'enable_room_comments',
	'label'       => esc_html__( 'Comments on room posts', 'hemma' ),
	'description' => esc_html__( 'Enable comments on room single posts.', 'hemma' ),
	'section'     => 'post_settings',
	'priority'    => 10,
	'default'     => 'off',
	'choices'     => array(
		'on'  => esc_html__( 'On', 'hemma' ),
		'off' => esc_html__( 'Off', 'hemma' ),
	),
) );
/**
 * Add the Enable comments on event single posts control
 */
hemma_Kirki::add_field( 'hemma_theme', array(
	'type'        => 'switch',
	'settings'    => 'enable_event_comments',
	'label'       => esc_html__( 'Comments on event posts', 'hemma' ),
	'description' => esc_html__( 'Enable comments on event single posts.', 'hemma' ),
	'section'     => 'post_settings',
	'priority'    => 10,
	'default'     => 'off',
	'choices'     => array(
		'on'  => esc_html__( 'On', 'hemma' ),
		'off' => esc_html__( 'Off', 'hemma' ),
	),
) );
/**
 * Add the Enable comments on food single posts control
 */
hemma_Kirki::add_field( 'hemma_theme', array(
	'type'        => 'switch',
	'settings'    => 'enable_food_comments',
	'label'       => esc_html__( 'Comments on food posts', 'hemma' ),
	'description' => esc_html__( 'Enable comments on food single posts.', 'hemma' ),
	'section'     => 'post_settings',
	'priority'    => 10,
	'default'     => 'off',
	'choices'     => array(
		'on'  => esc_html__( 'On', 'hemma' ),
		'off' => esc_html__( 'Off', 'hemma' ),
	),
) );
/**
 * Add the Enable comments on deal single posts control
 */
hemma_Kirki::add_field( 'hemma_theme', array(
	'type'        => 'switch',
	'settings'    => 'enable_deal_comments',
	'label'       => esc_html__( 'Comments on deal posts', 'hemma' ),
	'description' => esc_html__( 'Enable comments on deal single posts.', 'hemma' ),
	'section'     => 'post_settings',
	'priority'    => 10,
	'default'     => 'off',
	'choices'     => array(
		'on'  => esc_html__( 'On', 'hemma' ),
		'off' => esc_html__( 'Off', 'hemma' ),
	),
) );
/**
 * Add the Room pages show at most control
 */
hemma_Kirki::add_field( 'hemma_theme', array(
	'type'        => 'number',
	'settings'    => 'room_posts_per_page',
	'label'       => esc_html__( 'Room posts per page.', 'hemma' ),
	'description' => esc_html__( 'Set the value to -1 if to show all posts.', 'hemma' ),
	'section'     => 'post_settings',
	'priority'    => 10,
	'default'     => 5,
) );
/**
 * Add the Event pages show at most control
 */
hemma_Kirki::add_field( 'hemma_theme', array(
	'type'        => 'number',
	'settings'    => 'event_posts_per_page',
	'label'       => esc_html__( 'Event posts per page', 'hemma' ),
	'description' => esc_html__( 'Set the value to -1 if to show all posts.', 'hemma' ),
	'section'     => 'post_settings',
	'priority'    => 10,
	'default'     => 5,
) );
/**
 * Add the Food pages show at most control
 */
hemma_Kirki::add_field( 'hemma_theme', array(
	'type'        => 'number',
	'settings'    => 'food_posts_per_page',
	'label'       => esc_html__( 'Food posts per page', 'hemma' ),
	'description' => esc_html__( 'Set the value to -1 if to show all posts.', 'hemma' ),
	'section'     => 'post_settings',
	'priority'    => 10,
	'default'     => 5,
) );
/**
 * Add the Deal pages show at most control
 */
hemma_Kirki::add_field( 'hemma_theme', array(
	'type'        => 'number',
	'settings'    => 'deal_posts_per_page',
	'label'       => esc_html__( 'Deal posts per page', 'hemma' ),
	'description' => esc_html__( 'Set the value to -1 if to show all posts.', 'hemma' ),
	'section'     => 'post_settings',
	'priority'    => 10,
	'default'     => 5,
) );
/**
 * Add the Guest Post pages show at most control
 */
hemma_Kirki::add_field( 'hemma_theme', array(
	'type'        => 'number',
	'settings'    => 'guestpost_posts_per_page',
	'label'       => esc_html__( 'Guest Post posts per page', 'hemma' ),
	'description' => esc_html__( 'Set the value to -1 if to show all posts.', 'hemma' ),
	'section'     => 'post_settings',
	'priority'    => 10,
	'default'     => 10,
) );
/**
 * Add the Social Links section
 */
hemma_Kirki::add_section( 'social_links', array(
	'title'      => esc_html__( 'Social Links', 'hemma' ),
	'priority'   => 20,
	'capability' => 'edit_theme_options',
) );
/**
 * Add the Facebook Link control
 */
hemma_Kirki::add_field( 'hemma_theme', array(
	'type'        => 'text',
	'settings'    => 'facebook_link',
	'label'       => esc_html__( 'Facebook link', 'hemma' ),
	'description' => esc_html__( 'Type the URL of your Facebook page', 'hemma' ),
	'section'     => 'social_links',
	'priority'    => 10,
) );
/**
 * Add the Twitter Link control
 */
hemma_Kirki::add_field( 'hemma_theme', array(
	'type'        => 'text',
	'settings'    => 'twitter_link',
	'label'       => esc_html__( 'Twitter link', 'hemma' ),
	'description' => esc_html__( 'Type the URL of your Twitter page', 'hemma' ),
	'section'     => 'social_links',
	'priority'    => 10,
) );
/**
 * Add the Google+ Link control
 */
hemma_Kirki::add_field( 'hemma_theme', array(
	'type'        => 'text',
	'settings'    => 'google_link',
	'label'       => esc_html__( 'Google+ link', 'hemma' ),
	'description' => esc_html__( 'Type the URL of your Google+ page', 'hemma' ),
	'section'     => 'social_links',
	'priority'    => 10,
) );
/**
 * Add the Instagram Link control
 */
hemma_Kirki::add_field( 'hemma_theme', array(
	'type'        => 'text',
	'settings'    => 'instagram_link',
	'label'       => esc_html__( 'Instagram link', 'hemma' ),
	'description' => esc_html__( 'Type the URL of your Instagram page', 'hemma' ),
	'section'     => 'social_links',
	'priority'    => 10,
) );
/**
 * Add the Skype Link control
 */
hemma_Kirki::add_field( 'hemma_theme', array(
	'type'        => 'text',
	'settings'    => 'skype_link',
	'label'       => esc_html__( 'Skype link', 'hemma' ),
	'description' => esc_html__( 'Type your Skype URI (e.g. skype:username?call)', 'hemma' ),
	'section'     => 'social_links',
	'priority'    => 10,
) );
/**
 * Add the Youtube Link control
 */
hemma_Kirki::add_field( 'hemma_theme', array(
	'type'        => 'text',
	'settings'    => 'youtube_link',
	'label'       => esc_html__( 'Youtube link', 'hemma' ),
	'description' => esc_html__( 'Type the URL of your Youtube page', 'hemma' ),
	'section'     => 'social_links',
	'priority'    => 10,
) );
/**
 * Add the Vimeo Link control
 */
hemma_Kirki::add_field( 'hemma_theme', array(
	'type'        => 'text',
	'settings'    => 'vimeo_link',
	'label'       => esc_html__( 'Vimeo link', 'hemma' ),
	'description' => esc_html__( 'Type the URL of your Vimeo page', 'hemma' ),
	'section'     => 'social_links',
	'priority'    => 10,
) );
hemma_Kirki::add_field( 'hemma_theme', array(
	'type'        => 'sortable',
	'settings'    => 'social_order',
	'label'       => esc_html__( 'Social Links Order', 'hemma' ),
	'description' => esc_html__( 'Choose what social icons you want to display on your website and in which order', 'hemma' ),
	'section'     => 'social_links',
	'priority'    => 10,
	'default'     => array(
		'facebook',
		'twitter',
		'google'
	),
	'choices'     => array(
		'facebook'  => esc_html__( 'Facebook', 'hemma' ),
		'twitter'   => esc_html__( 'Twitter', 'hemma' ),
		'google'    => esc_html__( 'Google+', 'hemma' ),
		'instagram' => esc_html__( 'Instagram', 'hemma' ),
		'skype'     => esc_html__( 'Skype', 'hemma' ),
		'youtube'   => esc_html__( 'Youtube', 'hemma' ),
		'vimeo'     => esc_html__( 'Vimeo', 'hemma' ),
	),
) );
/**
 * Add the Google Maps API section
 */
hemma_Kirki::add_section( 'google_maps', array(
	'title'      => esc_html__( 'Google Maps', 'hemma' ),
	'priority'   => 20,
	'capability' => 'edit_theme_options',
) );
/**
 * Add the Google Maps API key control
 */
hemma_Kirki::add_field( 'hemma_theme', array(
	'type'        => 'text',
	'settings'    => 'google-maps-api-key',
	'label'       => esc_html__( 'Google Maps API key', 'hemma' ),
	'description' => sprintf( wp_kses( __( 'Google Maps may not work without an API key. <a href="%1$s" target="_blank">Get your key</a> and paste it here.', 'hemma' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( "https://developers.google.com/maps/documentation/javascript/get-api-key" ) ),
	'section'     => 'google_maps',
	'priority'    => 10,
) );
/**
 * Add the Footer Settings section
 */
hemma_Kirki::add_section( 'footer_settings', array(
	'title'      => esc_html__( 'Footer Settings', 'hemma' ),
	'priority'   => 20,
	'capability' => 'edit_theme_options',
) );
/**
 * Add the Enable Footer control
 */
hemma_Kirki::add_field( 'hemma_theme', array(
	'type'        => 'switch',
	'settings'    => 'footer_enable',
	'label'       => esc_html__( 'Enable Footer', 'hemma' ),
	'description' => esc_html__( 'Choose whether to show or not the footer.', 'hemma' ),
	'section'     => 'footer_settings',
	'priority'    => 10,
	'default'     => '1',
	'choices'     => array(
		'on'  => esc_html__( 'On', 'hemma' ),
		'off' => esc_html__( 'Off', 'hemma' ),
	),
) );
/**
 * Add the Footer One control
 */
hemma_Kirki::add_field( 'hemma_theme', array(
	'type'        => 'select',
	'settings'    => 'footer_one',
	'label'       => esc_html__( 'Footer One Settings', 'hemma' ),
	'description' => esc_html__( 'Set the width of Footer One widget area or just disable it.', 'hemma' ),
	'section'     => 'footer_settings',
	'priority'    => 10,
	'default'     => 'is-3',
	'choices'     => array(
		'disable' => esc_html__( 'Disable', 'hemma' ),
		'is-3'    => esc_html__( '1/4', 'hemma' ),
		'is-4'    => esc_html__( '1/3', 'hemma' ),
		'is-6'    => esc_html__( '1/2', 'hemma' ),
		'is-8'    => esc_html__( '2/3', 'hemma' ),
		'is-9'    => esc_html__( '3/4', 'hemma' ),
		'is-12'   => esc_html__( '4/4', 'hemma' ),
	),
) );
/**
 * Add the Footer Two control
 */
hemma_Kirki::add_field( 'hemma_theme', array(
	'type'        => 'select',
	'settings'    => 'footer_two',
	'label'       => esc_html__( 'Footer Two Settings', 'hemma' ),
	'description' => esc_html__( 'Set the width of Footer Two widget area or just disable it.', 'hemma' ),
	'section'     => 'footer_settings',
	'priority'    => 10,
	'default'     => 'is-3',
	'choices'     => array(
		'disable' => esc_html__( 'Disable', 'hemma' ),
		'is-3'    => esc_html__( '1/4', 'hemma' ),
		'is-4'    => esc_html__( '1/3', 'hemma' ),
		'is-6'    => esc_html__( '1/2', 'hemma' ),
		'is-8'    => esc_html__( '2/3', 'hemma' ),
		'is-9'    => esc_html__( '3/4', 'hemma' ),
		'is-12'   => esc_html__( '4/4', 'hemma' ),
	),
) );
/**
 * Add the Footer Three control
 */
hemma_Kirki::add_field( 'hemma_theme', array(
	'type'        => 'select',
	'settings'    => 'footer_three',
	'label'       => esc_html__( 'Footer Three Settings', 'hemma' ),
	'description' => esc_html__( 'Set the width of Footer Three widget area or just disable it.', 'hemma' ),
	'section'     => 'footer_settings',
	'priority'    => 10,
	'default'     => 'is-3',
	'choices'     => array(
		'disable' => esc_html__( 'Disable', 'hemma' ),
		'is-3'    => esc_html__( '1/4', 'hemma' ),
		'is-4'    => esc_html__( '1/3', 'hemma' ),
		'is-6'    => esc_html__( '1/2', 'hemma' ),
		'is-8'    => esc_html__( '2/3', 'hemma' ),
		'is-9'    => esc_html__( '3/4', 'hemma' ),
		'is-12'   => esc_html__( '4/4', 'hemma' ),
	),
) );
/**
 * Add the Footer Four control
 */
hemma_Kirki::add_field( 'hemma_theme', array(
	'type'        => 'select',
	'settings'    => 'footer_four',
	'label'       => esc_html__( 'Footer Four Settings', 'hemma' ),
	'description' => esc_html__( 'Set the width of Footer Four widget area or just disable it.', 'hemma' ),
	'section'     => 'footer_settings',
	'priority'    => 10,
	'default'     => 'is-3',
	'choices'     => array(
		'disable' => esc_html__( 'Disable', 'hemma' ),
		'is-3'    => esc_html__( '1/4', 'hemma' ),
		'is-4'    => esc_html__( '1/3', 'hemma' ),
		'is-6'    => esc_html__( '1/2', 'hemma' ),
		'is-8'    => esc_html__( '2/3', 'hemma' ),
		'is-9'    => esc_html__( '3/4', 'hemma' ),
		'is-12'   => esc_html__( '4/4', 'hemma' ),
	),
) );
/**
 * Add the Bottom Notes control
 */
hemma_Kirki::add_field( 'hemma_theme', array(
	'type'        => 'textarea',
	'settings'    => 'bottom_notes',
	'label'       => esc_html__( 'Bottom Notes', 'hemma' ),
	'description' => esc_html__( 'Use this textarea to add some extra notes (e.g. copyright informations).', 'hemma' ),
	'section'     => 'footer_settings',
	'priority'    => 10,
) );
