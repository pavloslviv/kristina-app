<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Hemma
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<?php if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php hemma_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php
		endif; ?>
	</header><!-- .entry-header -->

	<?php
	if ( has_post_thumbnail() ) : ?>
		<div class="single-thumbnail">
	  		<?php the_post_thumbnail(); ?>
		</div><!-- .single-thumbnail -->
	<?php
	endif; ?> 

	<div class="entry-content">
		<?php

			the_content();

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'hemma' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php hemma_entry_footer(); ?>
	</footer><!-- .entry-footer -->

	<?php
	if ( true == get_theme_mod( 'enable_author', true ) ) :
		hemma_author_box();
	endif;
	?>

</article><!-- #post-## -->
