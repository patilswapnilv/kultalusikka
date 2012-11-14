<?php
/**
 * Front Page Sidebar Template
 *
 * Displays widgets for the Front Page dynamic sidebar if any have been added to the sidebar through the 
 * widgets screen in the admin by the user. Otherwise, nothing is displayed.
 *
 * @package    Kultalusikka
 * @subpackage Template
 * @author     Sami Keijonen <sami.keijonen@foxnet.fi>
 * @since      0.1.0
 */

if ( is_active_sidebar( 'front-page' ) ) : ?>

	<?php do_atomic( 'before_sidebar_front_page' ); // kultalusikka_before_sidebar_front_page ?>

	<div id="sidebar-front-page" class="sidebar">

		<?php do_atomic( 'open_sidebar_front_page' ); // kultalusikka_open_sidebar_front_page ?>
		
			<?php dynamic_sidebar( 'front-page' ); ?>

		<?php do_atomic( 'close_sidebar_front_page' ); // kultalusikka_close_sidebar_front_page ?>

	</div><!-- #sidebar-front-page .aside -->

	<?php do_atomic( 'after_sidebar_front_page' ); // kultalusikka_after_sidebar_front_page ?>

<?php endif; ?>