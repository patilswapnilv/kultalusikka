<?php 
/**
 * Gallery Content Template
 *
 * Template used for 'gallery' post format.
 *
 * @package    Kultalusikka
 * @subpackage Template
 * @author     Sami Keijonen <sami.keijonen@foxnet.fi>
 * @since      0.1.0
 */
 
do_atomic( 'before_entry' ); // kultalusikka_before_entry ?>

<article id="post-<?php the_ID(); ?>" class="<?php hybrid_entry_class(); ?>">

	<?php do_atomic( 'open_entry' ); // kultalusikka_open_entry ?>
	
	<?php if ( is_singular() ) { ?>

		<header class="entry-header">	
			<?php echo apply_atomic_shortcode( 'entry_title', '[entry-title]' ); ?>
			<?php echo apply_atomic_shortcode( 'byline', '<div class="byline">' . __( '[post-format-link] published on [entry-published] [entry-comments-link before=" | "] [entry-edit-link before=" | "]', 'kultalusikka' ) . '</div>' ); ?>
		</header><!-- .entry-header -->
	
		<div class="entry-content">
			<?php the_content(); ?>
			<?php wp_link_pages( array( 'before' => '<p class="page-links">' . __( 'Pages:', 'kultalusikka' ), 'after' => '</p>' ) ); ?>
		</div><!-- .entry-content -->

		<footer class="entry-footer">
			<?php echo apply_atomic_shortcode( 'entry_meta', '<div class="entry-meta">' . __( '[entry-terms taxonomy="category" before="Posted in "] [entry-terms before="Tagged "]', 'kultalusikka' ) . '</div>' ); ?>
		</footer><!-- .entry-footer -->
		
	<?php } else { ?>
	
		<div class="kultalusikka-gallery">
			<?php echo do_shortcode( '[gallery numberposts="3" orderby="rand" size="kultalusikka-thumbnail-gallery"]' ); ?>
		</div><!-- .kultalusikka-gallery -->

		<header class="entry-header">	
			<?php echo apply_atomic_shortcode( 'entry_title', '[entry-title]' ); ?>
		</header><!-- .entry-header -->

		<div class="entry-summary">
			<?php the_excerpt(); ?>
			<?php wp_link_pages( array( 'before' => '<p class="page-links">' . __( 'Pages:', 'kultalusikka' ), 'after' => '</p>' ) ); ?>
		
			<?php $kultalisikka_image_count = post_format_tools_get_image_attachment_count(); ?>
			<p class="image-count"><?php printf( _n( 'This gallery contains %s image.', 'This gallery contains %s images.', $kultalisikka_image_count, 'kultalusikka' ), $kultalisikka_image_count ); ?></p>
		
		</div><!-- .entry-summary -->

		<footer class="entry-footer">
			<?php echo apply_atomic_shortcode( 'entry_meta', '<div class="entry-meta">' . __( '[post-format-link] published on [entry-published] [entry-permalink before="| "] [entry-comments-link before="| "] [entry-edit-link before="| "]', 'kultalusikka' ) . '</div>' ); ?>
		</footer><!-- .entry-footer -->
		
	<?php } ?>

	<?php do_atomic( 'close_entry' ); // kultalusikka_close_entry ?>

</article><!-- .hentry -->
					
<?php do_atomic( 'after_entry' ); // kultalusikka_after_entry ?>