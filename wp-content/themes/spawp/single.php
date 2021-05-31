<?php 
/**
 * The template for displaying single posts and pages.
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package sapwp
 */

get_header();
spawp_breadcrumbs();

$sidebar_layout = spawp_get_sidebar_layout();
$rightsidebar = array( 'right-sidebar', 'both-sidebars', 'both-right', 'both-left' );
$leftsidebar = array( 'left-sidebar', 'both-sidebars', 'both-right', 'both-left' );
$class = spawp_get_content_area_classes();

$content_container_setting = spawp_get_content_container_layout();
if($content_container_setting == 'contained'){
	$container_class = 'container';
}else{
	$container_class = 'container-fluid';
}
?>

<?php do_action( 'spawp_before_main_content' ); ?>

<main id="content" class="main_content">
	<div class="<?php echo esc_attr( $container_class ); ?>">
		<div class="row">

			<?php 
			if ( in_array( $sidebar_layout, $leftsidebar ) ) {
				get_sidebar('left');
			}
			?>
			
			<div class="<?php echo esc_attr($class); ?> primary">

				<?php do_action( 'spawp_before_content' ); ?>

				<div class="site-content">

					<?php do_action( 'spawp_before_content_inner' ); ?>

					<?php

					// Check if posts exist
					if ( have_posts() ) :

						// loop
						while ( have_posts() ) : the_post();

							get_template_part( 'partials/entry/layout', get_post_type() );

						endwhile;

						// If comments are open or we have at least one comment, load up the comment template.
                        if ( comments_open() || get_comments_number() ) :
                            comments_template();
                        endif;

						the_posts_pagination( array(
                                    'prev_text' => '<i class="fa fa-angle-double-left"></i>',
                                    'next_text' => '<i class="fa fa-angle-double-right"></i>',
                                ) );

					else:

						get_template_part( 'partials/none' );

					endif;
					?>

					<?php do_action( 'spawp_after_content_inner' ); ?>

				</div>

				<?php do_action( 'spawp_after_content' ); ?>

			</div>

			<?php 
			if ( in_array( $sidebar_layout, $rightsidebar ) ) {
				get_sidebar();
			}
			?>
			      
		</div><!-- .row -->
	</div><!-- .container -->
</main><!-- .main_content -->

<?php do_action( 'spawp_after_main_content' ); ?>

<?php get_footer(); ?>