<?php
    get_header();
    $col = ( !is_active_sidebar('sidebar') ) ? 'no-sidebar col-md-12' : 'has-sidebar col-md-12 col-lg-8';
?>
<div class="main-contaier">
    <div class="container">
        <?php if ( have_posts() ) { ?> 
            <div class="archive-box main-blog">
                <h1><span><?php esc_html_e( 'Search results for', 'arimolite' ); ?>:</span>&nbsp;<?php echo esc_html( get_search_query() ); ?></h1>                
            </div>
            <div class="row wrapper-main-content">
                <div class="<?php echo esc_attr( $col ); ?>">
                <?php
                    get_template_part( 'loop/blog');
                ?>
                </div>
                <?php if ( is_active_sidebar('sidebar') ) { ?>
                <div class="col-md-12 col-lg-4">
    				<aside id="sidebar" class="sidebar">
                        <?php dynamic_sidebar('sidebar'); ?>
                    </aside>
                </div>
                <?php } ?>
            </div>
        <?php } else {
            get_template_part('template-parts/post', 'none');
        } ?>        
    </div>       
</div>
<?php get_footer(); ?>