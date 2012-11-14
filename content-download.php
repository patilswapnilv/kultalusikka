<?php 
/**
 * Download Content Template
 *
 * Template used to show the content of posts with the 'download' post type.
 *
 * @package    Kultalusikka
 * @subpackage Template
 * @author     Sami Keijonen <sami.keijonen@foxnet.fi>
 * @since      0.1.0
 */
 
do_atomic( 'before_entry' ); // kultalusikka_before_entry ?>

<article id="post-<?php the_ID(); ?>" class="<?php hybrid_entry_class(); ?>">

	<?php do_atomic( 'open_entry' ); // kultalusikka_open_entry ?>
	
	<header class="entry-header">
		<?php if ( is_singular() && is_main_query() ) {
			echo apply_atomic_shortcode( 'entry_title', the_title( '<h1 class="entry-title">', '</h1>', false ) );
		}
		else {
			echo apply_atomic_shortcode( 'entry_title', '[entry-title]' ); 
		} 
		?>
		
		<?php if( function_exists( 'edd_price' ) ) {
				if( !edd_has_variable_prices( get_the_ID() ) ) { // if not variable prices, echo price. ?>
					<div id="kultalusikka-download-price">		
						<?php edd_price( get_the_ID() ); // echo download price. ?>
					</div><!-- #kultalusikka-download-price --> 
		<?php
				} 
			} 
		?>
				
	</header><!-- .entry-header -->
		
	<div class="entry-content">
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<p class="page-links">' . __( 'Pages:', 'kultalusikka' ), 'after' => '</p>' ) ); ?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php echo apply_atomic_shortcode( 'entry_meta', '<div class="entry-meta">[entry-edit-link]</div>' ); ?>
	</footer><!-- .entry-footer -->

	<?php do_atomic( 'close_entry' ); // kultalusikka_close_entry ?>

</article><!-- .hentry -->
					
<?php do_atomic( 'after_entry' ); // kultalusikka_after_entry ?>