<?php
    /**
     * Template Name: Right Sidebar Template
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
            	<div class="page-content has-sidebar">
                    <?php if ( $featured_image ) { ?>                        
                    <div class="page-image">
                        <img src="<?php echo esc_url($featured_image); ?>" alt="<?php echo esc_attr__('Featured Image', 'arimolite'); ?>"/>
                    </div>
                    <?php } ?>
                    <div class="row">
                        <div class="col-md-8 main-page-content">
                            <?php if ( get_the_title() ) : ?>
                                <h1 class="page-title  text-center"><?php the_title(); ?></h1>
                            <?php endif; ?>
                            <div class="page-excerpt">
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
                        <div class="col-md-4 sidebar-right">
                            <?php if ( is_active_sidebar('sidebar') ) { ?>
                            <aside id="sidebar" class="sidebar">
                                <?php dynamic_sidebar('sidebar'); ?>
                            </aside>
                            <?php } ?>
                        </div>
                    </div>
				</div>
            </div>
        </div>
    <?php 
	endwhile;
?>
<?php get_footer(); ?>page-right-sidebar.php