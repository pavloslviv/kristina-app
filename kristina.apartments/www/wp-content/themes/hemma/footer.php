<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Hemma
 */

?>

	<?php
	$footer_enable = get_theme_mod( 'footer_enable', true );
	$footer_one = get_theme_mod( 'footer_one', 'is-3' );
	$footer_two = get_theme_mod( 'footer_two', 'is-3' );
	$footer_three = get_theme_mod( 'footer_three', 'is-3' );
	$footer_four = get_theme_mod( 'footer_four', 'is-3' );
	$footer_array = array(
		'footer-1' => $footer_one,
		'footer-2' => $footer_two,
		'footer-3' => $footer_three,
		'footer-4' => $footer_four
	);
	$bottom_notes = get_theme_mod( 'bottom_notes', '' );
	$preloader = get_theme_mod( 'preloader', false );
	?>

	</div><!-- #content -->

	<?php if ( $footer_enable == true ) : ?>

		<footer id="colophon" class="site-footer" role="contentinfo">

			<div class="container is-fluid">
				<div class="columns">

					<?php foreach( $footer_array as $footer_area => $footer_widget ) : ?>

						<?php if ( $footer_widget != '' && $footer_widget != 'disable' ) : ?>

							<div class="column <?php echo sanitize_html_class( $footer_widget ); ?>">

								<?php if ( function_exists( 'dynamic_sidebar' ) ) : ?>

									<?php dynamic_sidebar( $footer_area ); ?>

								<?php endif; ?>

							</div><!-- /.column -->

						<?php endif; ?>
					 
					<?php endforeach; ?>

				</div><!-- /.columns -->
			</div><!-- /.container -->

			<?php if ( $bottom_notes ) : ?>

				<div class="site-info">
					<div class="container is-fluid">
						<?php
						if ( function_exists( 'pll_register_string' ) ) {
						  echo do_shortcode( pll__( wp_kses_post( get_theme_mod( 'bottom_notes', '' ) ), 'hemma' ) );
						} else {
						  echo do_shortcode( wp_kses_post( $bottom_notes ) );
						}
						?>
					</div><!-- /.container -->
				</div><!-- .site-info -->

			<?php endif; ?>

		</footer><!-- #colophon -->

	<?php endif; ?>

</div><!-- #page -->

<?php if ( $preloader == true ) : ?>
	
	<div class="preloader">
	    <div class="loading">
	        <div class="h1 preloader-counter"></div>
	        <div class="preloader-percentage"></div>
	        <p class="preloader-subtitle block-subtitle"><?php bloginfo( 'name' ); ?></p>
	    </div>
	</div>

<?php endif; ?>

<?php wp_footer(); ?>

</body>
</html>
