<?php
    get_header();    
    if ( have_posts() ) {
        while ( have_posts() ) {
            the_post();
            $featured_image = null;
            if ( has_post_thumbnail() ) {
                $featured_image = arimolite_resize_image( get_post_thumbnail_id(), null, 1300, 750, true, false );
                $featured_image = $featured_image['url'];
            } ?>
        <div class="main-contaier">
            <div class="container">
                <div class="page-content">
                    <?php if ( get_the_title() ) : ?>
                        <div class="row justify-content-md-center">
                            <div class="col-md-11 col-lg-10">
                                <h1 class="page-title text-center"><?php the_title(); ?></h1>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if ( $featured_image ) { ?>                        
                    <div class="page-image">
                        <img src="<?php echo esc_url($featured_image); ?>" alt="<?php echo esc_attr__('Featured Image', 'arimolite'); ?>"/>
                    </div>
                    <?php } ?>
                    <div class="row justify-content-md-center">
                        <article <?php post_class('arimolite-page col-md-11 col-lg-10'); ?>>
                            <div class="page-excerpt">
                                <?php the_content(); ?>
                                <?php wp_link_pages(array('before'=>'<p class="page-nav">' . esc_html__( 'Pages:', 'arimolite' ), 'after' =>'</p>')); ?>
                            </div>
                            <?php comments_template( '', true );  ?>
                        </article>
                    </div>
                </div>
            </div>
        </div><?php
        }
    }
	get_footer();
	