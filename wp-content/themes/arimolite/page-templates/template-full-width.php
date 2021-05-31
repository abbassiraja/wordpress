<?php
    /**
     * Template Name: Layout: Full width
     *
     * @package ArimoLite
     */
    get_header();


	while ( have_posts() ) : the_post();
        $featured_image = null;
        if ( has_post_thumbnail() ) {
            $featured_image = arimolite_resize_image( get_post_thumbnail_id(), null, 1300, 750, true, false );
            $featured_image = $featured_image['url'];
        }

    ?>
		<div class="main-contaier">
            <div class="container">
            	<div class="page-content">
                <?php if ( get_the_title() ) : ?>
                    <h1 class="page-title text-center"><?php the_title(); ?></h1>
                <?php endif; ?>
                <?php if ( $featured_image ) { ?>                        
                <div class="page-image">
                    <img src="<?php echo esc_url($featured_image); ?>" alt="<?php echo esc_attr__('Featured Image', 'arimolite'); ?>"/>
                </div>
                <?php } ?>
                
            	<?php 
            		the_content();
					wp_link_pages( array(
						'before'      => '',
						'after'       => '',
						'link_before' => '',
						'link_after'  => '',
					));
				?>
				</div>
            </div>
        </div>
    <?php 
	endwhile;
?>
<?php get_footer(); ?>