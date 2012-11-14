<?php
/**
 * 404 Template
 *
 * 404 template is used when an invalid url is visited.
 *
 * @package    Kultalusikka
 * @subpackage Template
 * @author     Sami Keijonen <sami.keijonen@foxnet.fi>
 * @since      0.1.0
 */

@header( 'HTTP/1.1 404 Not found', true, 404 );

get_header(); // Loads the header.php template. ?>

	<?php do_atomic( 'before_content' ); // kultalusikka_before_content ?>

	<div id="content" role="main">

		<?php do_atomic( 'open_content' ); // kultalusikka_open_content ?>

		<div class="hfeed">

			<article id="post-0" class="<?php hybrid_entry_class(); ?>">

				<header class="entry-header">
					<h1 class="error-404-title entry-title"><?php _e( 'What happened!?', 'kultalusikka' ); ?></h1>
				</header><!-- .entry-header -->

				<div class="entry-content">
					
					<p>
						<?php printf( __( "You tried going to %s, which doesn't exist. You can try navigate or search.", 'kultalusikka' ), '<code>' . home_url( esc_url( $_SERVER['REQUEST_URI'] ) ) . '</code>' ); ?>
					</p>
			
					<?php get_search_form(); // Loads the searchform.php template. ?>

				</div><!-- .entry-content -->

			</article><!-- .hentry -->

		</div><!-- .hfeed -->

		<?php do_atomic( 'close_content' ); // kultalusikka_close_content ?>

	</div><!-- #content -->

	<?php do_atomic( 'after_content' ); // kultalusikka_after_content ?>

<?php get_footer(); // Loads the footer.php template. ?>