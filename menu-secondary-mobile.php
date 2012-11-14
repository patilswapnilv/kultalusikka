<?php
/**
 * Secondary Menu Mobile Template
 *
 * Displays the Secondary Mobile Menu if it has active menu items.
 *
 * @package    Kultalusikka
 * @subpackage Template
 * @author     Sami Keijonen <sami.keijonen@foxnet.fi>
 * @since      0.1.0
 */

if ( has_nav_menu( 'secondary' ) ) : ?>

	<?php do_atomic( 'before_menu_secondary_mobile' ); // kultalusikka_before_menu_secondary_mobile ?>

	<nav id="menu-secondary-mobile" class="menu-container">

		<div class="wrap">

			<?php do_atomic( 'open_menu_secondary_mobile' ); // kultalusikka_open_menu_secondary_mobile ?>
			
			<h3 class="menu-toggle"><?php _e( 'Menu', 'kultalusikka' ); ?></h3>

			<?php wp_nav_menu( array( 'theme_location' => 'secondary', 'container_class' => 'menu-mobile', 'menu_class' => 'nav-menu', 'menu_id' => 'menu-secondary-mobile-items', 'fallback_cb' => '' ) ); ?>

			<?php do_atomic( 'close_menu_secondary_mobile' ); // kultalusikka_close_menu_secondary_mobile ?>

		</div>

	</nav><!-- #menu-secondary_mobile .menu-container -->

	<?php do_atomic( 'after_menu_secondary_mobile' ); // kultalusikka_after_menu_secondary_mobile ?>

<?php endif; ?>