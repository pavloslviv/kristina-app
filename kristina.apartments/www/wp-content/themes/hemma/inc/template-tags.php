<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Hemma
 */

if ( ! function_exists( 'hemma_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function hemma_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( 'Posted on %s', 'post date', 'hemma' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		esc_html_x( 'by %s', 'post author', 'hemma' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

}
endif;

if ( ! function_exists( 'hemma_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function hemma_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'hemma' ) );
		if ( $categories_list && hemma_categorized_blog() ) {
			printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'hemma' ) . '</span>. ', $categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'hemma' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'hemma' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function hemma_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'hemma_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'hemma_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so hemma_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so hemma_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in hemma_categorized_blog.
 */
function hemma_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'hemma_categories' );
}
add_action( 'edit_category', 'hemma_category_transient_flusher' );
add_action( 'save_post',     'hemma_category_transient_flusher' );


/**
 * Echos the the author box and its contents.
 *
 * The title is filterable via hemma_author_box_title, and the gravatar size
 * is filterable via hemma_author_box_gravatar_size.
 *
 * The final output is filterable via hemma_author_box, which passes many
 * variables through.
 *
 * @global WP_User $authordata Author (user) object
 */
function hemma_author_box() {
	global $authordata;
	$authordata    = is_object( $authordata ) ? $authordata : get_userdata( get_query_var( 'author' ) );
	$gravatar_size = apply_filters( 'hemma_author_box_gravatar_size', 80 );
	$gravatar      = get_avatar( get_the_author_meta( 'email' ), $gravatar_size );
	$title         = apply_filters( 'hemma_author_box_title', sprintf( '%s <span itemprop="name">%s</span>', esc_html__( 'About', 'hemma' ), get_the_author() ) );
	$description   = wpautop( get_the_author_meta( 'description' ) );
	/** The author box markup */
	$pattern = '<section class="author-box" itemprop="author" itemscope itemtype="http://schema.org/Person">%s<h1 class="author-box-title">%s</h1><div class="author-box-content" itemprop="description">%s</div></section>';
	echo apply_filters( 'hemma_author_box', sprintf( $pattern, $gravatar, $title, $description ), $pattern, $gravatar, $title, $description );
}

function hemma_get_instagram( $username, $slice = 3 ) {

	if( class_exists( 'Hemma_Instagram' ) ) {

	    $getImages = new Hemma_Instagram;
	    $media_array = $getImages->get_instagram_feed( $username, $slice );

		if ( $username != '' ) {

	 		if ( is_wp_error( $media_array ) ) {

	 			echo '<div class="block-strip-error column is-9-desktop is-6-tablet vertical-center"><strong>Error type: ' . wp_kses_post( $media_array->get_error_message() ) . '</strong><em>' . esc_html__( 'Please double check that the username you are using exists. Or contact us if you are still having troubles.', 'hemma' ) . '</em></div>';

	 		} else {

				foreach ( $media_array as $item ) {
				?>

					<div class="column block-strip-thumb is-3-desktop is-6-tablet">
						<a href="<?php echo esc_url( $item['link'] ); ?>" target="_blank">
							<img src="<?php echo esc_url( $item['large'] ); ?>" alt="<?php echo esc_attr( $item['description'] ); ?>">
							<div class="block-strip-thumb-overlay">
								<div class="block-strip-thumb-title is-text-light">
									<p><?php echo esc_attr( $item['description'] ); ?></p>
								</div><!-- /.block-strip-thumb-title -->
							</div><!-- /.block-strip-thumb-overlay -->
						</a>
					</div><!-- /.column -->

	 			<?php
	 			}

	 		}

	 	}

	} else {

		echo '<div class="block-strip-error column is-9-desktop is-6-tablet vertical-center"><em>' . esc_html__( 'You are not seeing any image because you need to install the Hemma Instagram plugin that comes with the theme. Please refer to the documentation for more informations.', 'hemma' ) . '</em></div>';

	}
}