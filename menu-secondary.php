<?php
/**
 * Secondary Menu Template
 *
 * Displays the Secondary Menu if it has active menu items.
 *
 * @package    Kultalusikka
 * @subpackage Template
 * @author     Sami Keijonen <sami.keijonen@foxnet.fi>
 * @since      0.1.0
 */

if ( has_nav_menu( 'secondary' ) ) : ?>

	<?php do_atomic( 'before_menu_secondary' ); // kultalusikka_before_menu_secondary ?>

	<nav id="menu-secondary" class="menu-container">

		<div class="wrap">

			<?php do_atomic( 'open_menu_secondary' ); // kultalusikka_open_menu_secondary ?>

			<?php wp_nav_menu( array( 'theme_location' => 'secondary', 'container_class' => 'menu', 'menu_class' => '', 'menu_id' => 'menu-secondary-items', 'fallback_cb' => '' ) ); ?>

			<?php do_atomic( 'close_menu_secondary' ); // kultalusikka_close_menu_secondary ?>

		</div>

	</nav><!-- #menu-secondary .menu-container -->

	<?php do_atomic( 'after_menu_secondary' ); // kultalusikka_after_menu_secondary ?>

<?php endif; ?>