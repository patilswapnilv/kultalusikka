<?php
/**
 * Archive Downloads
 *
 * This template is for downloads archive.
 *
 * @package    Kultalusikka
 * @subpackage Template
 * @author     Sami Keijonen <sami.keijonen@foxnet.fi>
 * @since      0.1.0
 */

/* Set up default column count (2 and 3). */
$kultalusikka_archive_download_columns_three = apply_atomic( 'kultalusikka_archive_download_columns_three', 3 );
$kultalusikka_archive_download_columns_two = apply_atomic( 'kultalusikka_archive_download_columns_two', 2 );
$archive_iterator = 0;
 
get_header(); // Loads the header.php template. ?>

	<?php do_atomic( 'before_content' ); // kultalusikka_before_content ?>

	<div id="content" role="main">

		<?php do_atomic( 'open_content' ); // kultalusikka_open_content ?>

		<div class="hfeed">

			<?php get_template_part( 'loop-meta' ); // Loads the loop-meta.php template. ?>
			
			<div class="kultalusikka-all-downloads">

			<?php if ( have_posts() ) : ?>

				<?php while ( have_posts() ) : the_post(); ?>
				
				<?php do_atomic( 'before_entry' ); // kultalusikka_before_entry ?>
				
				<?php 
				/* Decide extra class for two and three columns layout. */
				if ( $kultalusikka_archive_download_columns_two > 0 && $archive_iterator > 0 && $archive_iterator % $kultalusikka_archive_download_columns_two == 0 ) {
					$kultalusikka_archive_clear_two = ' kultalusikka-archive-clear-two';
				}
				else {
					$kultalusikka_archive_clear_two = '';
				}
				
				if ( $kultalusikka_archive_download_columns_three > 0 && $archive_iterator > 0 && $archive_iterator % $kultalusikka_archive_download_columns_three == 0 ) {
					$kultalusikka_archive_clear_three = ' kultalusikka-archive-clear-three';
				}
				else {
					$kultalusikka_archive_clear_three = '';
				}
				?>

				<div class="kultalusikka-download<?php if ( !empty( $kultalusikka_archive_clear_three ) ) echo $kultalusikka_archive_clear_three; if ( !empty( $kultalusikka_archive_clear_two ) ) echo $kultalusikka_archive_clear_two; // Add class to downloads ?>">
					
					<article id="post-<?php the_ID(); ?>" class="<?php hybrid_entry_class(); ?>">

					<?php do_atomic( 'open_entry' ); // kultalusikka_open_entry ?>
	
						<header class="entry-header">
							<?php if ( current_theme_supports( 'get-the-image' ) ) get_the_image( array( 'meta_key' => 'Thumbnail', 'size' => 'kultalusikka-thumbnail-download', 'image_class' => 'kultalusikka-thumbnail-download', 'width' => 428, 'height' => 265 ) ); ?>
						</header><!-- .entry-header -->
		
						<div class="entry-summary">
							<?php echo apply_atomic_shortcode( 'entry_title', '[entry-title]' ); ?>
							<?php the_excerpt(); ?>
							<?php wp_link_pages( array( 'before' => '<p class="page-links">' . __( 'Pages:', 'kultalusikka' ), 'after' => '</p>' ) ); ?>
						</div><!-- .entry-summary -->

						<footer class="entry-footer">
							<?php if( function_exists( 'edd_price' ) ) { ?>
								<div class="kultalusikka-download-price">
									<?php if( edd_has_variable_prices( get_the_ID() ) ) {
											echo __( 'Starting at: ', 'kultalusikka' ); edd_price(get_the_ID()); // echo download price.
										} 
										else {
											edd_price( get_the_ID() ); // echo download price.
										} ?>
								</div><!-- .kultalusikka-download-price -->
							<?php } //?>
						</footer><!-- .entry-footer -->

					<?php do_atomic( 'close_entry' ); // kultalusikka_close_entry ?>

					</article><!-- .hentry -->
					
				</div><!-- .kultalusikka-download -->
					
				<?php do_atomic( 'after_entry' ); // kultalusikka_after_entry ?>

				<?php $archive_iterator++; // Add +1 after every loop. ?>
				
				<?php endwhile; ?>
				
			</div><!-- .kultalusikka-all-downloads -->

			<?php else : ?>

				<?php get_template_part( 'loop-error' ); // Loads the loop-error.php template. ?>

			<?php endif; ?>

		</div><!-- .hfeed -->

		<?php do_atomic( 'close_content' ); // kultalusikka_close_content ?>

		<?php get_template_part( 'loop-nav' ); // Loads the loop-nav.php template. ?>

	</div><!-- #content -->

	<?php do_atomic( 'after_content' ); // kultalusikka_after_content ?>

<?php get_footer(); // Loads the footer.php template. ?>