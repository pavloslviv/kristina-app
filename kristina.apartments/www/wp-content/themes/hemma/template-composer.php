<?php
/**
 * Template Name: Composer page
 * The template for displaying Composer template pages.
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
	?>

	<div id="hero" class="hero is-bg-image is-text-light <?php echo sanitize_html_class( $page_titles_align ); ?> <?php echo sanitize_html_class( $page_hero_height ); ?> <?php echo sanitize_html_class( $page_hero_bg_color ); ?>"<?php if ( $page_image_attributes ) echo ' style="background-image: url(' . esc_url( $page_image_attributes[0] ) . ');"' ?>>
		<div class="hero-content" style="background-color: <?php echo $page_overlay_bg; ?>">
			<div class="container is-fluid">
				<div class="hero-text">
					 <?php the_title( '<h1 class="hero-title">', '</h1>' ); ?>
					<div class="hero-subtitle"><?php echo esc_html( $page_subtitle ); ?></div>
					<?php
					while ( have_posts() ) : the_post();
						the_content();
					endwhile;
					?>
				</div><!-- /.hero-text -->
			</div><!-- /.container -->
		</div><!-- /.hero-content -->
	</div><!-- /.hero -->

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
			$blocks = get_post_meta( get_the_ID(), 'opendept_composer_block', true );

			foreach ( (array) $blocks as $key => $entry ) :

				$block_type = cmb2_get_meta( $entry, 'opendept_composer_select' );
				$block_title = cmb2_get_meta( $entry, 'opendept_composer_title' );
				$block_subtitle = cmb2_get_meta( $entry, 'opendept_composer_subtitle' );
				$block_content = cmb2_get_meta( $entry, 'opendept_composer_content' );
				$block_button_text = cmb2_get_meta( $entry, 'opendept_composer_button_text' );
				$block_button_link = cmb2_get_meta( $entry, 'opendept_composer_button_link' );
				$block_button_color = cmb2_get_meta( $entry, 'opendept_composer_button_color' );
				$block_button_target = cmb2_get_meta( $entry, 'opendept_composer_button_target' );
				$block_image = cmb2_get_meta( $entry, 'opendept_composer_image' );
				$block_layout = cmb2_get_meta( $entry, 'opendept_composer_layout' );
				$block_height = cmb2_get_meta( $entry, 'opendept_composer_height' );
				$block_guestpost_nr = cmb2_get_meta( $entry, 'opendept_composer_guestposts_nr' );
				$map_latitude = cmb2_get_meta( $entry, 'opendept_composer_map_lat' );
				$map_longitude = cmb2_get_meta( $entry, 'opendept_composer_map_lon' );
				$map_zoom = cmb2_get_meta( $entry, 'opendept_composer_map_zoom' );
				$map_style = cmb2_get_meta( $entry, 'opendept_composer_map_style' );
				$map_marker = cmb2_get_meta( $entry, 'opendept_composer_map_marker_color' );
				$instagram_user = cmb2_get_meta( $entry, 'opendept_composer_instagram_user' );
				$instagram_images = cmb2_get_meta( $entry, 'opendept_composer_instagram_images' );

				if ( $map_latitude == '' ) {
				    $map_latitude = 40.714353;
				}
				if ( $map_longitude == '' ) {
				    $map_longitude = -74.005973;
				}
				if ( $map_zoom == '' ) {
				    $map_zoom = 7;
				}

				if ( $map_marker == '' ) {
				    $map_marker = 'invisible';
				}
			?>

				<?php if( $block_type == 'split-block' ) : ?>

					<div id="<?php if ( $block_title ) echo sanitize_title( $block_title ); ?>" class="block block-split-composer<?php if( $block_height ) echo ' ' . sanitize_html_class( $block_height ); ?><?php if( $block_layout == 'img-left' ) echo ' block-split-img-left'; ?>">
						<div class="block-content">
							<div class="block-figure"<?php if ( $block_image ) echo ' style="background-image: url(' . esc_url( $block_image ) . ');"' ?>>
							</div>
							<div class="container is-fluid">
								<div class="columns">
									<div class="column is-6-desktop">
										<div class="block-text">
											
											<?php if ( $block_title ) : ?>
												<h2 class="block-title"><?php echo esc_html( $block_title ); ?></h2>
											<?php endif; ?>

											<?php if ( $block_subtitle ) : ?>
												<div class="block-subtitle"><?php echo esc_html( $block_subtitle ); ?></div>
											<?php endif; ?>

											<?php echo wpautop( $block_content ); ?>

											<?php if( $block_button_text ) : ?>
											<a href="<?php echo esc_url( $block_button_link ); ?>" class="button <?php echo sanitize_html_class( $block_button_color ); ?>"<?php if( $block_button_target ) echo ' target=_blank'; ?>><?php echo esc_html( $block_button_text ); ?></a>
											<?php endif; ?>

										</div><!-- /.block-text -->
									</div><!-- /.column -->
								</div><!-- /.columns -->
							</div><!-- /.container -->
						</div><!-- /.block-content -->
					</div><!-- /.block -->

				<?php elseif ( $block_type == 'full-bg' ) : ?>

					<div id="<?php if ( $block_title ) echo sanitize_title( $block_title ); ?>" class="block is-bg-image is-text-light is-centered<?php if( $block_height ) echo ' ' . sanitize_html_class( $block_height ); ?>"<?php if ( $block_image ) echo ' style="background-image: url(' . esc_url( $block_image ) . ');"' ?>>
						<div class="block-content">
							<div class="container is-fluid">
								<div class="block-text">

									<?php if ( $block_title ) : ?>
										<h2 class="block-title"><?php echo esc_html( $block_title ); ?></h2>
									<?php endif; ?>
									
									<?php if ( $block_subtitle ) : ?>
										<div class="block-subtitle"><?php echo esc_html( $block_subtitle ); ?></div>
									<?php endif; ?>

									<?php echo wpautop( $block_content ); ?>

									<?php if( $block_button_text ) : ?>
									<a href="<?php echo esc_url( $block_button_link ); ?>" class="button <?php echo sanitize_html_class( $block_button_color ); ?>"<?php if( $block_button_target ) echo ' target=_blank'; ?>><?php echo esc_html( $block_button_text ); ?></a>
									<?php endif; ?>

								</div><!-- /.block-text -->
							</div><!-- /.container -->
						</div><!-- /.block-content -->
					</div><!-- /.block -->

				<?php elseif ( $block_type == 'blog-parse' ) : ?>

					<?php
					$args = array(
						'post_type' => 'post',
						'posts_per_page' => 3,
						'meta_query' => array( // Only posts with thumbnail images
						    array(
						        'key' => '_thumbnail_id'
						    ) 
						)
					);

					$the_query = new WP_Query( $args );
					?>

					<div id="<?php if ( $block_title ) echo sanitize_title( $block_title ); ?>" class="block block-strip block-blog">
						<div class="block-content">
							<div class="container is-fluid">
								<div class="columns is-gapless is-multiline">

					<?php if ( $the_query->have_posts() ) : ?>

						<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

									<div class="column block-strip-thumb is-3-desktop is-6-tablet">
										<a href="<?php esc_url( the_permalink() ); ?>" rel="bookmark">
											<?php the_post_thumbnail( 'medium-square' ); ?>
											<div class="block-strip-thumb-overlay">
												<div class="block-strip-thumb-title is-text-light">
													<?php the_title( '<h3>', '</h3>' ); ?>
												</div><!-- /.block-strip-thumb-title -->
											</div><!-- /.block-strip-thumb-overlay -->
										</a>
									</div><!-- /.column -->

						<?php endwhile; ?>

									<div class="column is-3-desktop is-6-tablet block-strip-title-column">
										<div class="block-strip-title-box">
											
											<?php if ( $block_title ) : ?>
												<h2 class="block-title"><?php echo esc_html( $block_title ); ?></h2>
											<?php endif; ?>

											<?php if ( $block_subtitle ) : ?>
												<div class="block-subtitle"><?php echo esc_html( $block_subtitle ); ?></div>
											<?php endif; ?>

											<?php if( $block_button_text ) : ?>
											<a href="<?php echo esc_url( $block_button_link ); ?>" class="button <?php echo sanitize_html_class( $block_button_color ); ?>"<?php if( $block_button_target ) echo ' target=_blank'; ?>><?php echo esc_html( $block_button_text ); ?></a>
											<?php endif; ?>

										</div><!-- /.block-strip-title-box -->
									</div><!-- /.column -->

						<?php wp_reset_postdata(); ?>

					<?php else: ?>

						<p><?php printf( wp_kses( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'hemma' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

					<?php endif; ?>

								</div><!-- /.columns -->
							</div><!-- /.container -->
						</div><!-- /.block-content -->
					</div><!-- /.block -->

				<?php elseif ( $block_type == 'guestpost-parse' ) : ?>

					<?php
					$post_nr = 10;
					if ( $block_guestpost_nr  ) :
						$post_nr = $block_guestpost_nr;
					endif;

					$args = array(
						'post_type' => 'guestpost',
						'posts_per_page' => $post_nr,
					);

					$the_query = new WP_Query( $args );
					?>

					<div id="<?php if ( $block_title ) echo sanitize_title( $block_title ); ?>" class="block block-guestpost is-centered<?php if( $block_height ) echo ' ' . sanitize_html_class( $block_height ); ?>">
						<div class="block-content">
							<div class="block-text">
								<div class="container is-fluid">

									<?php if ( $block_title ) : ?>
										<h2 class="block-title"><?php echo esc_html( $block_title ); ?></h2>
									<?php endif; ?>

									<?php if ( $block_subtitle ) : ?>
										<div class="block-subtitle"><?php echo esc_html( $block_subtitle ); ?></div>
									<?php endif; ?>

								</div><!-- /.container -->

					<?php if ( $the_query->have_posts() ) : ?>

						<div class="guest-posts is-carousel swiper-container">
							<div class="guest-post-container swiper-wrapper">				

						<?php
						while ( $the_query->have_posts() ) : $the_query->the_post();

							$guest_name = get_post_meta( get_the_ID(), 'opendept_guestpost_guest_name', true );
						?>

										<div class="guest-post swiper-slide">
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
															<?php
															$content = get_the_content();
															$trimmed_content = wp_trim_words( $content, 30);
															echo wpautop( $trimmed_content );
															?>
														</div><!-- /.guest-quote -->
														
														<?php if ( $guest_name ) : ?>
															<div class="guest-name"><?php echo esc_html( $guest_name ); ?></div>
														<?php endif; ?>
														
													</div><!-- /.is-10 -->
												</div><!-- /.columns -->
											</div><!-- /.container -->
										</div><!-- /.guest-post -->

						<?php endwhile; ?>

									</div><!-- /.guest-post-container -->
									<div class="swiper-pagination"></div>
								</div><!-- /.guest-posts -->
						<?php wp_reset_postdata(); ?>

					<?php else: ?>

						<p><?php printf( wp_kses( __( 'Ready to publish your first Guest Post? <a href="%1$s">Get started here</a>.', 'hemma' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( admin_url( 'post-new.php?post_type=guestpost' ) ) ); ?></p>

					<?php endif; ?>								

								<?php if( $block_button_text ) : ?>
								<a href="<?php echo esc_url( $block_button_link ); ?>" class="button <?php echo sanitize_html_class( $block_button_color ); ?>"<?php if( $block_button_target ) echo ' target=_blank'; ?>><?php echo esc_html( $block_button_text ); ?></a>
								<?php endif; ?>

							</div><!-- /.block-text -->
						</div><!-- /.block-content -->
					</div><!-- /.block -->

				<?php elseif( $block_type == 'instagram-parse' ) : ?>

					<div id="<?php if ( $block_title ) echo sanitize_title( $block_title ); ?>" class="block block-strip block-instagram">
						<div class="block-content">
							<div class="container is-fluid">
								<div class="columns is-gapless is-multiline">

									<?php hemma_get_instagram( $instagram_user, $instagram_images ); ?>

						 			<div class="column is-3-desktop is-6-tablet block-strip-title-column">
						 				<div class="block-strip-title-box">

						 					<?php if ( $block_title ) : ?>
						 						<h2 class="block-title"><?php echo esc_html( $block_title ); ?></h2>
						 					<?php endif; ?>

						 					<?php if ( $block_subtitle ) : ?>
						 						<div class="block-subtitle"><?php echo esc_html( $block_subtitle ); ?></div>
						 					<?php endif; ?>

						 					<?php if( $block_button_text ) : ?>
						 					<a href="<?php echo esc_url( $block_button_link ); ?>" class="button <?php echo sanitize_html_class( $block_button_color ); ?>"<?php if( $block_button_target ) echo ' target=_blank'; ?>><?php echo esc_html( $block_button_text ); ?></a>
						 					<?php endif; ?>

						 				</div><!-- /.block-strip-title-box -->
						 			</div><!-- /.column -->

		 						</div><!-- /.columns -->
		 					</div><!-- /.container -->
		 				</div><!-- /.block-content -->
		 			</div><!-- /.block -->

				<?php elseif( $block_type == 'split-block-map' ) : ?>

					<div id="<?php if ( $block_title ) echo sanitize_title( $block_title ); ?>" class="block block-split-composer<?php if( $block_height ) echo ' ' . sanitize_html_class( $block_height ); ?><?php if( $block_layout == 'img-left' ) echo ' block-split-img-left'; ?><?php echo ' marker-' . sanitize_html_class( $map_marker ); ?>">
						<div class="block-content">
							<div class="block-figure map" data-maplat="<?php echo $map_latitude ?>" data-maplon="<?php echo esc_attr( $map_longitude ) ?>" data-mapzoom="<?php echo esc_attr( $map_zoom ) ?>" data-color="<?php echo esc_attr( $map_style ) ?>">
							</div>
							<div class="container is-fluid">
								<div class="columns">
									<div class="column is-6-desktop">
										<div class="block-text">
											
											<?php if ( $block_title ) : ?>
												<h2 class="block-title"><?php echo esc_html( $block_title ); ?></h2>
											<?php endif; ?>

											<?php if ( $block_subtitle ) : ?>
												<div class="block-subtitle"><?php echo esc_html( $block_subtitle ); ?></div>
											<?php endif; ?>

											<?php echo wpautop( $block_content ); ?>

											<?php if( $block_button_text ) : ?>
											<a href="<?php echo esc_url( $block_button_link ); ?>" class="button <?php echo sanitize_html_class( $block_button_color ); ?>"<?php if( $block_button_target ) echo ' target=_blank'; ?>><?php echo esc_html( $block_button_text ); ?></a>
											<?php endif; ?>

										</div><!-- /.block-text -->
									</div><!-- /.column -->
								</div><!-- /.columns -->
							</div><!-- /.container -->
						</div><!-- /.block-content -->
					</div><!-- /.block -->

				<?php elseif( $block_type == 'full-map' ) : ?>

					<div id="<?php if ( $block_title ) echo sanitize_title( $block_title ); ?>" class="block is-full-map is-text-light is-centered<?php if( $block_height ) echo ' ' . sanitize_html_class( $block_height ); ?><?php if( $map_marker ) echo ' marker-' . sanitize_html_class( $map_marker ); ?>">
						<div class="block-content map" data-maplat="<?php echo $map_latitude ?>" data-maplon="<?php echo esc_attr( $map_longitude ) ?>" data-mapzoom="<?php echo esc_attr( $map_zoom ) ?>" data-color="<?php echo esc_attr( $map_style ) ?>" data-maplat="<?php echo $map_latitude ?>" data-maplon="<?php echo esc_attr( $map_longitude ) ?>" data-mapzoom="<?php echo esc_attr( $map_zoom ) ?>" data-color="<?php echo esc_attr( $map_style ) ?>">
						</div>
					</div><!-- /.block -->

				<?php endif; ?>

			<?php
			endforeach; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
