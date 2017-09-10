<?php
/**
 * The template for displaying all single guestpost posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Hemma
 */

get_header(); ?>

	<?php
	while ( have_posts() ) : the_post();

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
											<?php if ( has_post_thumbnail() ) : ?>
												<div class="single-thumbnail">
											  		<?php the_post_thumbnail( 'thumbnail' ); ?>
												</div><!-- .single-thumbnail -->
											<?php endif; ?>
										</div><!-- /.guest-avatar -->
										<div class="guest-quote">
											<?php the_content(); ?>
										</div><!-- /.guest-quote -->
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
	</div><!-- #post-## -->

	<?php
	endwhile; // End of the loop.
	?>

<?php
get_footer();
