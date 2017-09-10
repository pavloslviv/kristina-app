<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Hemma
 */

get_header(); ?>

	<div class="container">
		<div class="columns">
			<div class="column is-8">

				<div id="primary" class="content-area">
					<main id="main" class="site-main" role="main">

					<?php
					while ( have_posts() ) : the_post();

						get_template_part( 'template-parts/content', 'single' );

						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;

					endwhile; // End of the loop.
					?>

					</main><!-- #main -->
				</div><!-- #primary -->

			</div><!-- /.column is-8 -->

			<div class="column is-4">
				<?php get_sidebar(); ?>
			</div><!-- /.column is-4 -->

		</div><!-- /.columns -->
	</div><!-- /.container -->

<?php
get_footer();
