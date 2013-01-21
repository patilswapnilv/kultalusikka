<?php
/**
 * Subsidiary Sidebar Template
 *
 * Displays widgets for the Subsidiary dynamic sidebar if any have been added to the sidebar through the 
 * widgets screen in the admin by the user.  Otherwise, nothing is displayed.
 *
 * @package    Kultalusikka
 * @subpackage Template
 * @author     Sami Keijonen <sami.keijonen@foxnet.fi>
 * @since      0.1.0
 */

if ( is_active_sidebar( 'subsidiary' ) ) : ?>

	<?php do_atomic( 'before_sidebar_subsidiary' ); // kultalusikka_before_sidebar_subsidiary ?>

	<aside id="sidebar-subsidiary" class="sidebar" role="complementary">

		<?php do_atomic( 'open_sidebar_subsidiary' ); // kultalusikka_open_sidebar_subsidiary ?>

		<div class="wrap">
		
			<?php dynamic_sidebar( 'subsidiary' ); ?>
		
		</div><!-- .wrap -->

		<?php do_atomic( 'close_sidebar_subsidiary' ); // kultalusikka_close_sidebar_subsidiary ?>

	</aside><!-- #sidebar-subsidiary .sidebar -->

	<?php do_atomic( 'after_sidebar_subsidiary' ); // kultalusikka_after_sidebar_subsidiary ?>

<?php endif; ?>