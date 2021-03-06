<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Hemma
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function hemma_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	$header_position = get_theme_mod( 'header_position', 'header-position-1'  );

	// Add hero class
	if  ( is_singular( array( 'room', 'event', 'food', 'deal' ) ) || is_page_template( 'template-composer.php' ) || is_page_template( 'template-room.php' ) || is_page_template( 'template-event.php' ) || is_page_template( 'template-food.php' ) || is_page_template( 'template-deal.php' ) || is_page_template( 'template-guestpost.php' ) || is_page_template( 'template-hero.php' ) ) {
		$classes[] = 'is-hero';

		if ( $header_position == 'header-position-2' ) {
			$classes[] = 'is-header-static';
		}
	}

	// Handle body classes based on Customizer options
	$logo_center_class = 'is-logo-centered';
	$logo_image_class = 'is-logo-image';
	$hamburger_left_class = 'is-hamburger-left';
	$frame_layout_class = 'is-block-frame';
	$menu_desktop_class = 'is-menu-desktop';
	$preloader_class = 'is-loader';
	$gallery_class = 'gallery-first-big';
	$lightbox_class = "is-lightbox-enabled";
	$block_animation_class = 'is-block-animation';

	$header_layout = get_theme_mod( 'header_layout', 'header-1'  );
	$logo_img_1x_regul = get_theme_mod( 'logo_image_1', '' );
	$logo_img_2x_regul = get_theme_mod( 'logo_image_2', '' );
	$site_layout = get_theme_mod( 'site_layout', '' );
	$accent_color = get_theme_mod( 'accent_color', '' );
	$preloader = get_theme_mod( 'preloader', false );
	$gallery_first_post = get_theme_mod( 'gallery_first_post', false );
	$enable_lightbox = get_theme_mod( 'enable_lightbox', false );
	$enable_block_animation = get_theme_mod( 'enable_block_animation', false );

	switch ( $header_layout ) {
	    case 'header-1' :
	        $classes[] = '';
	        break;
	    case 'header-2' :
	        $classes[] = join( ' ', array( $menu_desktop_class ) );
	        break;
	    case 'header-3' :
	        $classes[] = join( ' ', array( $hamburger_left_class, $logo_center_class ) );
	        break;
	    case 'header-4' :
	        $classes[] = join( ' ', array( $logo_center_class ) );
	        break;
	}

	if ( $logo_img_1x_regul !== '' || $logo_img_2x_regul !== '' ) {
		$classes[] = $logo_image_class;
	}

	if ( $site_layout == 'layout-2' ) {
		$classes[] = $frame_layout_class;
	}

	if ( $accent_color && $accent_color != 'is-default' ) {
		$classes[] = 'accent-' . $accent_color;
	}

	if ( $preloader == true ) {
		$classes[] = $preloader_class;
	}

	if ( $gallery_first_post == true ) {
		$classes[] = $gallery_class;
	}

	if ( $enable_lightbox == true ) {
		$classes[] = $lightbox_class;
	}

	if ( $enable_block_animation == true ) {
		$classes[] = $block_animation_class;
	}

	return $classes;
}
add_filter( 'body_class', 'hemma_body_classes' );

/**
 * Enqueue the Custom CSS code.
 */
function hemma_enqueue_custom_css() {

	$custom_css = get_theme_mod( 'custom_css', '' );

	if ( $custom_css ) {
    	wp_add_inline_style( 'hemma-style', $custom_css );
    }

}
add_action( 'wp_enqueue_scripts', 'hemma_enqueue_custom_css', 999 );

/*
 * Add class to links generated by next_posts_link and previous_posts_link
 * https://css-tricks.com/snippets/wordpress/add-class-to-links-generated-by-next_posts_link-and-previous_posts_link/
 */
function hemma_next_posts_link_attributes() {
    return 'class="prev-button button"';
}
function hemma_prev_posts_link_attributes() {
    return 'class="next-button button"';
}
add_filter( 'next_posts_link_attributes', 'hemma_next_posts_link_attributes' );
add_filter( 'previous_posts_link_attributes', 'hemma_prev_posts_link_attributes' );

/**
 * Wrap the inserted image html with <figure>.
 * If the theme supports html5 and the current image has no caption:
 */
function hemma_wrap_editor_images( $html, $id, $caption, $title, $align, $url, $size, $alt ) {
	if( current_theme_supports( 'html5' )  && ! $caption ) {
    	$html = sprintf( '<figure id="attachment_' . $id . '" class="wp-content-image">%s</figure>', $html );
	}
    return $html;
}
add_filter( 'image_send_to_editor', 'hemma_wrap_editor_images', 10, 8 );

/**
 * Wrap the embedded videos in a special <div>.
 */
function hemma_wrap_oembed_videos( $html, $url, $attr, $post_ID ) {
    $return = '<div class="video-wrapper">'.$html.'</div>';
    return $return;
}
add_filter( 'embed_oembed_html', 'hemma_wrap_oembed_videos', 10, 4 ) ;

/**
 * Add string in the translation panel to allow users to tarnslate the bottom footer notes.
 *
 *  @link https://polylang.wordpress.com/documentation/documentation-for-developers/functions-reference/
 */
if ( function_exists('pll_register_string') ) {
	$bottom_notes = get_theme_mod( 'bottom_notes', '' );
	pll_register_string( 'Bottom Footer Notes', $bottom_notes, OPENDEPT_THEME_NAME, true );
}

/*
 * Add markup to make Photoswipe work (Crafted on PhotoSwipe plugin for WordPress: https://wordpress.org/plugins/photo-swipe/)
 */
function hemma_photoswipe_footer() {
	echo <<<EOF
<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="pswp__bg"></div>
    <div class="pswp__scroll-wrap">
        <div class="pswp__container">
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
        </div>
        <div class="pswp__ui pswp__ui--hidden">
            <div class="pswp__top-bar">
                <div class="pswp__counter"></div>
                <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
                <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
                <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>
                <div class="pswp__preloader">
                    <div class="pswp__preloader__icn">
                      <div class="pswp__preloader__cut">
                        <div class="pswp__preloader__donut"></div>
                      </div>
                    </div>
                </div>
            </div>
            <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
            </button>
            <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
            </button>
            <div class="pswp__caption">
                <div class="pswp__caption__center"></div>
            </div>
        </div>
    </div>
</div>
EOF;
}
add_action( 'wp_footer', 'hemma_photoswipe_footer' );

function hemma_photoswipe_get_attachment_link( $link, $id, $size, $permalink, $icon, $text ) {
	if( $permalink === false && !$text && 'none' != $size ) {
		$_post = get_post( $id );

		$image_attributes = wp_get_attachment_image_src( $_post->ID, 'original' );

		if( $image_attributes ) {
			$link = str_replace( '<a ', '<a data-size="' . $image_attributes[1] . 'x' . $image_attributes[2] . '" ', $link );
		}
	}

	return $link;
}
add_filter( 'wp_get_attachment_link', 'hemma_photoswipe_get_attachment_link', 10, 6 );


function hemma_photoswipe_save_post( $post_id, $post, $update ) {
	$post_content = $post->post_content;

	$new_content = preg_replace_callback( '/(<a((?!data\-size)[^>])+href=["\'])([^"\']*)(["\']((?!data\-size)[^>])*><img)/i', 'hemma_photoswipe_save_post_callback', $post_content );

	if( !!$new_content && $new_content !== $post_content ) {
		remove_action( 'save_post', 'hemma_photoswipe_save_post', 10, 3 );

		wp_update_post( array( 'ID' => $post_id, 'post_content' => $new_content ) );

		add_action( 'save_post', 'hemma_photoswipe_save_post', 10, 3 );
	}
}
add_action( 'save_post', 'hemma_photoswipe_save_post', 10, 3 );

if ( ! function_exists( 'hemma_photoswipe_save_post_callback' ) ) :
	function hemma_photoswipe_save_post_callback( $matches ) {
		$before = $matches[1];
		$image_url = $matches[3];
		$after = $matches[4];

		$id = hemma_fjarrett_get_attachment_id_by_url($image_url);

		if( $id ) {
			$image_attributes = wp_get_attachment_image_src( $id, 'original' );
			if( $image_attributes ) {
				$before = str_replace('<a ', '<a data-size="' . $image_attributes[1] . 'x' . $image_attributes[2] . '" ', $before);
			}
		}

		return $before . $image_url . $after;
	}
endif;

function hemma_photoswipe_kses_allow_attributes() {
	global $allowedposttags;
	$allowedposttags['a']['data-size'] = array();
}
add_action( 'init', 'hemma_photoswipe_kses_allow_attributes' );

if( !function_exists( 'hemma_fjarrett_get_attachment_id_by_url' ) ) :
	/**
	 * Return an ID of an attachment by searching the database with the file URL.
	 *
	 * First checks to see if the $url is pointing to a file that exists in
	 * the wp-content directory. If so, then we search the database for a
	 * partial match consisting of the remaining path AFTER the wp-content
	 * directory. Finally, if a match is found the attachment ID will be
	 * returned.
	 *
	 * @param string $url The URL of the image (ex: http://mysite.com/wp-content/uploads/2013/05/test-image.jpg)
	 *
	 * @return int|null $attachment Returns an attachment ID, or null if no attachment is found
	 */
	function hemma_fjarrett_get_attachment_id_by_url( $url ) {
		// Split the $url into two parts with the wp-content directory as the separator
		$parsed_url  = explode( parse_url( WP_CONTENT_URL, PHP_URL_PATH ), $url );

		// Get the host of the current site and the host of the $url, ignoring www
		$this_host = str_ireplace( 'www.', '', parse_url( home_url(), PHP_URL_HOST ) );
		$file_host = str_ireplace( 'www.', '', parse_url( $url, PHP_URL_HOST ) );

		// Return nothing if there aren't any $url parts or if the current host and $url host do not match
		if ( ! isset( $parsed_url[1] ) || empty( $parsed_url[1] ) || ( $this_host != $file_host ) ) {
			return;
		}

		// Now we're going to quickly search the DB for any attachment GUID with a partial path match
		// Example: /uploads/2013/05/test-image.jpg
		global $wpdb;
		$prefix = is_multisite() ? $wpdb->base_prefix : $wpdb->prefix;

		$attachment = $wpdb->get_col( $wpdb->prepare( "SELECT ID FROM {$prefix}posts WHERE guid RLIKE %s;", $parsed_url[1] ) );

		// Returns null if no attachment is found
		return $attachment[0];
	}
endif;
