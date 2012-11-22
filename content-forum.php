<?php 
/**
 * Content Forum Template
 *
 * Template used to show post content for 'forum' post type.
 *
 * @package    Kultalusikka
 * @subpackage Template
 * @author     Sami Keijonen <sami.keijonen@foxnet.fi>
 * @since      0.1.0
 */
 
do_atomic( 'before_entry' ); // kultalusikka_before_entry ?>

<article id="post-<?php the_ID(); ?>" class="<?php hybrid_entry_class(); ?>">

	<?php do_atomic( 'open_entry' ); // kultalusikka_open_entry ?>
	
	<header class="entry-header">
		<?php if ( is_singular() && is_main_query() ) {
			echo apply_atomic_shortcode( 'entry_title', the_title( '<h1 class="entry-title">', '</h1>', false ) );
		}
		else {
			echo apply_atomic_shortcode( 'entry_title', '[entry-title]' ); 
		} 
		?>
	</header><!-- .entry-header -->
		
	<div class="entry-content">
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'kultalusikka' ) ); ?>
		<?php wp_link_pages( array( 'before' => '<p class="page-links">' . __( 'Pages:', 'kultalusikka' ), 'after' => '</p>' ) ); ?>
	</div><!-- .entry-content -->
	
	<?php if ( is_post_type_archive( 'forum' ) ) { // Display extra info only on 'forum' archive page. ?>
	
		<?php
		/* Get forum topic count. */
		$kultalusikka_bbp_forum_topic_count = bbp_get_forum_topic_count( get_the_ID() );
		$kultalusikka_forum_topic_count = sprintf( _n( '%d topic', '%d topics', $kultalusikka_bbp_forum_topic_count , 'kultalusikka' ), $kultalusikka_bbp_forum_topic_count );
	
		/* Get forum post/reply count. */
		$kultalusikka_bbp_forum_post_count = bbp_get_forum_post_count( get_the_ID() );
		$kultalusikka_bbp_forum_reply_count = bbp_get_forum_reply_count( get_the_ID() );
		
		if ( bbp_show_lead_topic() ) {
			$kultalusikka_forum_post_count = sprintf( _n( '%d post', '%d posts', $kultalusikka_bbp_forum_reply_count , 'kultalusikka' ), $kultalusikka_bbp_forum_reply_count );
		}
		else {
			$kultalusikka_forum_post_count = sprintf( _n( '%d post', '%d posts', $kultalusikka_bbp_forum_post_count , 'kultalusikka' ), $kultalusikka_bbp_forum_post_count );
		}
			
		/* Get forum freshness link. */
		$kultalusikka_bbp_get_forum_freshness_link = bbp_get_forum_freshness_link( get_the_ID() );
		$kultalusikka_forum_freshness_link = sprintf( __( 'Last post %s', 'kultalusikka' ), $kultalusikka_bbp_get_forum_freshness_link );
		?>
	
		<footer class="entry-footer">
			<ul class="forum-info">
				<li><?php echo $kultalusikka_forum_topic_count; ?></li>
				<li><?php echo $kultalusikka_forum_post_count; ?></li>
				<li><?php echo $kultalusikka_forum_freshness_link; ?></li>
			</ul>
		</footer><!-- .entry-footer -->
	
	<?php } // end if ?>

	<?php do_atomic( 'close_entry' ); // kultalusikka_close_entry ?>

</article><!-- .hentry -->
					
<?php do_atomic( 'after_entry' ); // kultalusikka_after_entry ?>