<?php
/**
 * Afer Singular Download Sidebar Template
 *
 * Displays widgets for the Afer Singular Download dynamic sidebar if any have been added to the sidebar through the 
 * widgets screen in the admin by the user. Otherwise, nothing is displayed.
 *
 * @package    Kultalusikka
 * @subpackage Template
 * @author     Sami Keijonen <sami.keijonen@foxnet.fi>
 * @since      0.1.0
 */

if ( is_active_sidebar( 'after-singular-download' ) ) : ?>

	<?php do_atomic( 'before_sidebar_after_singular_download' ); // kultalusikka_before_sidebar_after_singular_download ?>

	<div id="sidebar-after-singular-download" class="sidebar">

		<?php do_atomic( 'open_sidebar_after_singular_download' ); // kultalusikka_open_sidebar_after_singular_download ?>
		
			<?php dynamic_sidebar( 'after-singular-download' ); ?>

		<?php do_atomic( 'close_sidebar_after_singular_download' ); // kultalusikka_close_sidebar_after_singular_download ?>

	</div><!-- #sidebar-after-singular-download .aside -->

	<?php do_atomic( 'after_sidebar_after_singular_download' ); // kultalusikka_after_sidebar_after_singular_download ?>

<?php endif; ?>