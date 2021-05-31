<?php
/**
 * The template for displaying home page.
 * @package royal-magazine
 */

get_header();
if ( 'posts' == get_option( 'show_on_front' ) ) {
    include( get_home_template() );
    } else {

	/**
	 * royal_magazine_action_sidebar_section hook
	 * @since Royal Magazine 0.0.1
	 *
	 * @hooked royal_magazine_action_sidebar_section -  20
	 * @sub_hooked royal_magazine_action_sidebar_section -  20
	 */
    do_action('royal_magazine_action_sidebar_section');
    
		if (royal_magazine_get_option('home_page_content_status') == 1) {
			?>
			<section class="section-block recent-blog">
				<div class="container container-bg">
					<div class="row">
						<div class="col-left">
						<?php
						while ( have_posts() ) : the_post();
							the_title('<h2 class="widget-title secondary-font mt-0 mb-20 clearfix">', '</h2>');
							get_template_part( 'template-parts/content', 'page' );

						endwhile; // End of the loop.
						?>
						</div><!-- #primary -->
						<div class="col-right">
							<?php get_sidebar(); ?>
						</div>
					</div>
				</div>
			</section>
	<?php }
	}
get_footer();