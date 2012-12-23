<?php
/**
 * Template Name: Account Page
 *
 * This is the Account Page template. It is used to show your account page and user needs to be logged in to see content.
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

			<?php get_template_part( 'loop-meta' ); // Loads the loop-meta.php template. ?>

			<?php if ( have_posts() ) : ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php do_atomic( 'before_entry' ); // kultalusikka_before_entry ?>

					<article id="post-<?php the_ID(); ?>" class="<?php hybrid_entry_class(); ?>">

						<?php do_atomic( 'open_entry' ); // kultalusikka_open_entry ?>

						<header class="entry-header">
							<?php echo apply_atomic_shortcode( 'entry_title', '[entry-title]' ); ?>
						</header><!-- .entry-header -->

						<div class="entry-content">

							<?php if ( is_user_logged_in() ) { ?>

								<?php the_content(); ?>

							<?php } else { ?>

								<p>
									<?php _e( 'You must be logged in to view the content of this page.', 'kultalusikka' ); ?>
								</p>
								<p>
									<?php wp_login_form(); ?>
								</p>
								<p>
									<a href="<?php echo wp_lostpassword_url( get_permalink() ); ?>" title="<?php _e( 'Lost password?', 'kultalusikka' ); ?>"><?php _e( 'Lost password?', 'kultalusikka' ); ?></a>
								</p>

							<?php } ?>

							<?php wp_link_pages( array( 'before' => '<p class="page-links">' . __( 'Pages:', 'kultalusikka' ), 'after' => '</p>' ) ); ?>
						</div><!-- .entry-content -->

						<footer class="entry-footer">
							<?php echo apply_atomic_shortcode( 'entry_meta', '<div class="entry-meta">[entry-edit-link]</div>' ); ?>
						</footer><!-- .entry-footer -->

						<?php do_atomic( 'close_entry' ); // kultalusikka_close_entry ?>

					</article><!-- .hentry -->

					<?php do_atomic( 'after_entry' ); // kultalusikka_after_entry ?>

					<?php do_atomic( 'after_singular' ); // kultalusikka_after_singular ?>

					<?php if ( is_user_logged_in() ) comments_template( '/comments.php', true ); // Loads the comments.php template. ?>

				<?php endwhile; ?>

			<?php else : ?>

				<?php get_template_part( 'loop-error' ); // Loads the loop-error.php template. ?>

			<?php endif; ?>

		</div><!-- .hfeed -->

		<?php do_atomic( 'close_content' ); // kultalusikka_close_content ?>

	</div><!-- #content -->

	<?php do_atomic( 'after_content' ); // kultalusikka_after_content ?>

<?php get_footer(); // Loads the footer.php template. ?>