<?php
/**
 * Template Name: Front Page
 *
 * This is the Front Page template. It is used to show your latest downloads and it has own sidebar 'front-page'.
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

	<?php do_atomic( 'before_front_page_callout_sidebar' ); // kultalusikka_before_front_page_callout_sidebar ?>
	
	<?php get_sidebar( 'front-page-callout' ); // Loads the sidebar-front-page-callout.php template. ?>
	
	<?php do_atomic( 'before_front_page_sidebar' ); // kultalusikka_before_front_page_sidebar ?>

	<?php get_sidebar( 'front-page' ); // Loads the sidebar-front-page.php template. ?>

	<?php do_atomic( 'before_content' ); // kultalusikka_before_content ?>

	<div id="content" role="main">

		<?php do_atomic( 'open_content' ); // kultalusikka_open_content ?>

		<div class="hfeed">
		
			<?php
			/* Set custom query to show latest downloads. */
			$per_page = apply_filters( 'kultalusikka_front_page_downloads' , 6 );
			
			$download_args = apply_filters( 'kultalusikka_front_page_download_arguments', array(
				'post_type' => 'download',
				'posts_per_page' => $per_page,
			) );
			
			$downloads = new WP_Query( $download_args );
			?>
			
			<?php
			/* Get plural form in lowercase: default is 'downloads' */
			if ( function_exists( 'edd_get_label_plural' ) ) {
				$kultalusikka_download_url = edd_get_label_plural( true );
			}
			else {
				$kultalusikka_download_url = 'downloads';
			}
			?>
			
			<?php $kultalusikka_download_url = esc_url( apply_filters( 'kultalusikka_front_page_download_url', home_url( '/'. $kultalusikka_download_url ) ) ); ?>
			
			<?php $kultalusikka_download_latest = esc_attr( apply_filters( 'kultalusikka_front_page_latest', __( 'Latest downloads', 'kultalusikka' ) ) ); ?>
			
			<h2 id="kultalusikka-latest-downloads"><?php printf( __( '%1$s <a href="%2$s" class="kultalusikka-latest-downloads">View all &raquo;&raquo;</a>', 'kultalusikka' ), $kultalusikka_download_latest, $kultalusikka_download_url ); ?></h2>
			
			<div class="kultalusikka-all-downloads">

			<?php if ( $downloads->have_posts() ) : ?>

				<?php while ( $downloads->have_posts() ) : $downloads->the_post(); ?>
				
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
							<?php echo apply_atomic_shortcode( 'entry_title', '[entry-title tag="h2"]' ); ?>
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

			<?php endif; wp_reset_query(); // reset query. ?>

		</div><!-- .hfeed -->

		<?php do_atomic( 'close_content' ); // kultalusikka_close_content ?>

	</div><!-- #content -->

	<?php do_atomic( 'after_content' ); // kultalusikka_after_content ?>

<?php get_footer(); // Loads the footer.php template. ?>