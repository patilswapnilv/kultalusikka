<?php 
/**
 * Topic Content Template
 *
 * Template used to show the content of posts with the 'topic' post type. Used in bbPress plugin.
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
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<p class="page-links">' . __( 'Pages:', 'kultalusikka' ), 'after' => '</p>' ) ); ?>
	</div><!-- .entry-content -->

	<?php if ( is_post_type_archive( 'topic' ) ) { // Display extra info only on 'topic' archive page. ?>
	
		<?php
		/* Get topic voice count. */
		$kultalusikka_bbp_topic_voice_count = bbp_get_topic_voice_count( get_the_ID() );
		$kultalusikka_topic_voice_count = sprintf( _n( '%d voice', '%d voices', $kultalusikka_bbp_topic_voice_count , 'kultalusikka' ), $kultalusikka_bbp_topic_voice_count );
	
		/* Get topic post/reply count. */
		$kultalusikka_bbp_topic_post_count = bbp_get_topic_post_count( get_the_ID() );
		$kultalusikka_bbp_topic_reply_count = bbp_get_topic_reply_count( get_the_ID() );
		
		if ( bbp_show_lead_topic() ) {
			$kultalusikka_topic_post_count = sprintf( _n( '%d post', '%d posts', $kultalusikka_bbp_topic_reply_count , 'kultalusikka' ), $kultalusikka_bbp_topic_reply_count );
		}
		else {
			$kultalusikka_topic_post_count = sprintf( _n( '%d post', '%d posts', $kultalusikka_bbp_topic_post_count , 'kultalusikka' ), $kultalusikka_bbp_topic_post_count );
		}
	
		/* Get topic freshness link. */
		$kultalusikka_bbp_get_topic_freshness_link = bbp_get_topic_freshness_link( get_the_ID() );
		$kultalusikka_topic_freshness_link = sprintf( __( 'Last post %s', 'kultalusikka' ), $kultalusikka_bbp_get_topic_freshness_link );
		?>
	
		<footer class="entry-footer">
			<ul class="topic-info">
				<li><?php echo $kultalusikka_topic_voice_count; ?></li>
				<li><?php echo $kultalusikka_topic_post_count; ?></li>
				<li><?php echo $kultalusikka_topic_freshness_link; ?> <?php _e( 'by', 'kultalusikka' ); ?> <span class="bbp-topic-freshness-author"><?php bbp_author_link( array( 'post_id' => bbp_get_topic_last_active_id( get_the_ID() ), 'type' => 'name' ) ); ?></span></li>
			</ul>
		</footer><!-- .entry-footer -->
	
	<?php } // end if ?>

	<?php do_atomic( 'close_entry' ); // kultalusikka_close_entry ?>

</article><!-- .hentry -->
					
<?php do_atomic( 'after_entry' ); // kultalusikka_after_entry ?>