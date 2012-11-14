<?php
/**
 * Footer Template
 *
 * The footer template is generally used on every page of your site. Nearly all other
 * templates call it somewhere near the bottom of the file. It is used mostly as a closing
 * wrapper, which is opened with the header.php file. It also executes key functions needed
 * by the theme, child themes, and plugins. 
 *
 * @package    Kultalusikka
 * @subpackage Template
 * @author     Sami Keijonen <sami.keijonen@foxnet.fi>
 * @since      0.1.0
 */
?>
				<?php get_sidebar( 'primary' ); // Loads the sidebar-primary.php template. ?>

				<?php do_atomic( 'close_main' ); // kultalusikka_close_main ?>

			</div><!-- .wrap -->

		</div><!-- #main -->

		<?php do_atomic( 'after_main' ); // kultalusikka_after_main ?>

		<?php get_sidebar( 'subsidiary' ); // Loads the sidebar-subsidiary.php template. ?>

		<?php do_atomic( 'before_footer' ); // kultalusikka_before_footer ?>

		<footer id="footer" role="contentinfo">

			<?php do_atomic( 'open_footer' ); // kultalusikka_open_footer ?>

			<div class="wrap">

				<div class="footer-content">
					<?php hybrid_footer_content(); ?>
				</div>

				<?php do_atomic( 'footer' ); // kultalusikka_footer ?>

			</div><!-- .wrap -->

			<?php do_atomic( 'close_footer' ); // kultalusikka_close_footer ?>

		</footer><!-- #footer -->

		<?php do_atomic( 'after_footer' ); // kultalusikka_after_footer ?>
		
		<?php get_template_part( 'menu', 'subsidiary' ); // Loads the menu-subsidiary.php template. ?>

	</div><!-- #container -->

	<?php do_atomic( 'close_body' ); // kultalusikka_close_body ?>

	<?php wp_footer(); // wp_footer ?>

</body>
</html>