<?php
/**
 * Template Name: Guest Post page
 * The template for displaying Guest Post template pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Hemma
 */

get_header(); ?>

	<?php
	$page_id = get_the_ID();
	$page_subtitle = get_post_meta( $page_id, 'opendept_subtitle_subtitle', true );
	$page_overlay_bg = get_post_meta( $page_id, 'opendept_hero_color', true );
	$page_titles_align = get_post_meta( $page_id, 'opendept_hero_align', true );
	$page_hero_height = get_post_meta( $page_id, 'opendept_hero_height', true );
	$page_hero_bg_color = get_post_meta( $page_id, 'opendept_hero_bg_color', true );
	$page_image_attributes = wp_get_attachment_image_src( get_post_thumbnail_id( $page_id ), 'full' );
	$listed_posts_enable_subtitle = get_post_meta( $page_id, 'opendept_listed_posts_enable_subtitle', true );
	$posts_per_page = get_theme_mod( 'guestpost_posts_per_page', 10 );
	?>

	<div id="hero" class="hero is-bg-image is-text-light <?php echo sanitize_html_class( $page_titles_align ); ?> <?php echo sanitize_html_class( $page_hero_height ); ?> <?php echo sanitize_html_class( $page_hero_bg_color ); ?>"<?php if ( $page_image_attributes ) echo ' style="background-image: url(' . esc_url( $page_image_attributes[0] ) . ');"' ?>>
		<div class="hero-content" style="background-color: <?php echo $page_overlay_bg; ?>">
			<div class="container is-fluid">
				<div class="hero-text">
					<?php the_title( '<h1 class="hero-title">', '</h1>' ); ?>
					<div class="hero-subtitle"><?php echo esc_html( $page_subtitle ); ?></div>
				</div><!-- /.hero-text -->
			</div><!-- /.container -->
		</div><!-- /.hero-content -->
	</div><!-- /.hero -->

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
			$args = array(
				'post_type' => 'guestpost',
				'posts_per_page' => $posts_per_page,
				'paged' => ( $paged = get_query_var('paged') ) ? $paged : 1,
			);

			$the_query = new WP_Query( $args );

			while ( $the_query->have_posts() ) : $the_query->the_post();

				$the_id = get_the_ID();
				$guest_name = get_post_meta( $the_id, 'opendept_guestpost_guest_name', true );
				?>

				<div id="post-<?php the_ID(); ?>" <?php post_class( 'block block-guestpost is-centered' ); ?>>
					<div class="block-content">
						<div class="block-text">
							<div class="guest-posts">
								<div class="guest-post-container">
									<div class="guest-post">
										<div class="container is-fluid">
											<div class="columns">
												<div class="column is-10-desktop is-offset-1">

													<div class="guest-avatar">
														<?php
														if ( has_post_thumbnail() ) :
															the_post_thumbnail( 'thumbnail' );
														else :
														?>
															<svg class="hemma-icon hemma-icon-user"><use xlink:href="#hemma-icon-user"></use></svg>
														<?php endif; ?>
													</div>

													<div class="guest-quote">
														<?php the_content(); ?>
													</div>

													<?php if ( $guest_name ) : ?>
														<div class="guest-name"><?php echo esc_html( $guest_name ); ?></div>
													<?php endif; ?>

												</div><!-- /.is-10 -->
											</div><!-- /.columns -->
										</div><!-- /.container -->
									</div><!-- /.guest-post -->
								</div><!-- /.guest-post-container -->
							</div><!-- /.guest-posts -->
						</div><!-- /.block-text -->
					</div><!-- /.block-content -->
				</div><!-- /.block -->

			<?php
			endwhile; ?>

			<?php if ( get_next_posts_link( false, $the_query->max_num_pages ) || get_previous_posts_link() ) : ?>
			
				<div class="nav-links">
					<div class="container is-fluid">
						<?php next_posts_link( esc_html__( 'Prev Rooms', 'hemma' ), $the_query->max_num_pages ); ?>
						<?php previous_posts_link( esc_html__( 'Next Rooms', 'hemma' ) ); ?>
					</div>
				</div>

			<?php endif; ?>

			<?php
			wp_reset_postdata(); ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
