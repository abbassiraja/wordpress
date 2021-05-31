<?php 
    if ( has_post_thumbnail() )
    {          
        if ( is_single() ){
            $featured_image = arimolite_resize_image( get_post_thumbnail_id(), null, 1270, 675, true, true );
            ?>
            <div class="post-format">
                <img class="pinit" src="<?php echo esc_url($featured_image['url']); ?>" alt="<?php the_title_attribute(); ?>" />
            </div>
        <?php }else{ 
            $featured_image = wp_get_attachment_url( get_post_thumbnail_id() );
            ?>
            <div class="post-format">
                 <a class="post-image" style="background-image: url('<?php echo esc_url($featured_image);?>');" href="<?php the_permalink()?>"></a>
            </div>
        <?php }
    }
?>