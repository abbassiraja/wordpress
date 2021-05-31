<?php
$arimolite_post_class_3cols = ( is_active_sidebar('sidebar') ) ? 'col-md-6 col-lg-6' : 'col-md-6 col-lg-4';
$arimolite_word = 30;
$arimolite_post_class = $arimolite_post_class_3cols;

?>
<div class="arimolite-blogs blog-grid">
    <div class="row">
    <?php if ( have_posts() ) { ?>
        <?php while ( have_posts() ) { ?>
            <?php
               the_post(); ?>
                <article <?php post_class($arimolite_post_class); ?>>
                    <div class="post-inner">
                        <div class="post-header">
                            <?php get_template_part('template-parts/post', 'format'); ?>
                            <?php if ( get_the_title() == ''){ ?>
                                <div class="date-post">
                                    <a href="<?php the_permalink()?>">
                                        <span class="month"><?php echo get_the_date( 'M'); ?></span>
                                        <span class="day"><?php echo get_the_date( 'd'); ?></span>
                                        <span class="year"><?php echo get_the_date( 'Y'); ?></span>
                                    </a>
                                </div>
                            <?php }else { ?>
                                <div class="date-post">
                                    <span class="month"><?php echo get_the_date( 'M'); ?></span>
                                    <span class="day"><?php echo get_the_date( 'd'); ?></span>
                                    <span class="year"><?php echo get_the_date( 'Y'); ?></span>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="post-info">
                            <div class="post-cats"><i class="far fa-bookmark"></i><?php the_category(', '); ?></div>
                            <h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <?php get_template_part('template-parts/post', 'meta'); ?>                      
                            <div class="post-content"><?php echo esc_html( wp_trim_words( get_the_excerpt(), $arimolite_word , '...' ) ) ?></div>
                            <?php get_template_part('template-parts/post', 'footer'); ?>
                        </div>
                    </div>
                </article>
        <?php } ?>
    <?php } ?>
    </div>
    <?php arimolite_pagination(); ?>
</div>