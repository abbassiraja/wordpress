<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package royal-magazine
 */

?>
	<div class="entry-content">
		<?php
			$image_values = get_post_meta( $post->ID, 'royal-magazine-meta-image-layout', true );
			if ( empty( $image_values ) || $image_values == 'global' ) {
				$values = esc_attr( royal_magazine_get_option('single_post_image_layout') );
			} else{
				$values = esc_attr($image_values);
			}
			if( 'no-image' != $values ){
				if( 'left' == $values ){
					echo "<div class='image-left'>";
					the_post_thumbnail('medium');
				}
				elseif( 'right' == $values ){
					echo "<div class='image-right'>";
					the_post_thumbnail('medium');
				}
				else{
					echo "<div class='image-full'>";
					the_post_thumbnail('full');
				}
				echo "</div>";/*div end */
			}
		?>
		<?php the_content();
		
		if( !class_exists( 'Booster_Extension_Class' ) ){

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'royal-magazine' ),
				'after'  => '</div>',
			) );

		}
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer primary-font">
		<?php royal_magazine_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->

