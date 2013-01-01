<?php
/**
 * Primary Menu Mobile Template
 *
 * Displays the Primary Mobile Menu if it has active menu items.
 *
 * @package    Kultalusikka
 * @subpackage Template
 * @author     Sami Keijonen <sami.keijonen@foxnet.fi>
 * @since      0.1.0
 */

if ( has_nav_menu( 'primary' ) ) : ?>

	<?php do_atomic( 'before_menu_primary_mobile' ); // kultalusikka_before_menu_primary_mobile ?>

	<nav id="menu-primary-mobile" class="menu-container">
	
		<div class="assistive-text skip-link"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'kultalusikka' ); ?>"><?php _e( 'Skip to content', 'kultalusikka' ); ?></a></div>

		<div class="wrap">

			<?php do_atomic( 'open_menu_primary_mobile' ); // kultalusikka_open_menu_primary_mobile ?>
			
			<h3 class="menu-toggle"><?php _e( 'Menu', 'kultalusikka' ); ?></h3>

			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container_class' => 'menu-mobile', 'menu_class' => 'nav-menu', 'menu_id' => 'menu-primary-mobile-items', 'fallback_cb' => '' ) ); ?>

			<?php do_atomic( 'close_menu_primary_mobile' ); // kultalusikka_close_menu_primary_mobile ?>

		</div>

	</nav><!-- #menu-primary_mobile .menu-container -->

	<?php do_atomic( 'after_menu_primary_mobile' ); // kultalusikka_after_menu_primary_mobile ?>

<?php endif; ?>