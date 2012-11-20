<?php
/**
 * bbPress Template
 *
 * This is the default bbPress template.
 *
 * @package    Kultalusikka
 * @subpackage Template
 * @author     Sami Keijonen <sami.keijonen@foxnet.fi>
 * @since      0.1.0
 */

get_header(); // Loads the header.php template. ?>

	<?php do_atomic( 'before_content' ); // kultalusikka_before_content ?>

	<div id="content" role="main">

		<?php do_atomic( 'open_content' ); // kultalusikka_open_content ?>

		<div class="hfeed">

			<?php if ( have_posts() ) : ?>

				<?php while ( have_posts() ) : the_post(); ?>
				
				<?php get_template_part( 'content', get_post_type() ); ?>

					<?php if ( is_singular() ) { ?>

						<?php do_atomic( 'after_singular' ); // kultalusikka_after_singular ?>

					<?php } ?>

				<?php endwhile; ?>

			<?php else : ?>

				<?php get_template_part( 'loop-error' ); // Loads the loop-error.php template. ?>

			<?php endif; ?>

		</div><!-- .hfeed -->

		<?php do_atomic( 'close_content' ); // kultalusikka_close_content ?>

	</div><!-- #content -->

	<?php do_atomic( 'after_content' ); // kultalusikka_after_content ?>

<?php get_footer(); // Loads the footer.php template. ?>