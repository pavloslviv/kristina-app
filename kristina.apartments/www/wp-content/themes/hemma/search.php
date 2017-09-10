<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Hemma
 */

get_header(); ?>

	<div class="container">
		<div class="columns">
			<div class="column is-8">

				<section id="primary" class="content-area">
					<main id="main" class="site-main" role="main">

					<?php
					if ( have_posts() ) : ?>

						<header class="page-header">
							<h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'hemma' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
						</header><!-- .page-header -->

						<?php
						while ( have_posts() ) : the_post();

							get_template_part( 'template-parts/content', 'search' );

						endwhile;

						the_posts_navigation();

					else :

						get_template_part( 'template-parts/content', 'none' );

					endif; ?>

					</main><!-- #main -->
				</section><!-- #primary -->

			</div><!-- /.column is-8 -->

			<div class="column is-4">
				<?php get_sidebar(); ?>
			</div><!-- /.column is-4 -->

		</div><!-- /.columns -->
	</div><!-- /.container -->

<?php
get_footer();
