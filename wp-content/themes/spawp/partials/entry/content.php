<?php do_action( 'spawp_before_blog_entry_content' ); ?>

<div class="entry-content">
	
	<?php

    $archive_content_type = spawp_get_option('archive_content_type');

    if('excerpt' == $archive_content_type && is_archive() || is_home() || is_search() || is_page_template() ){
        if(get_post_type(get_the_ID())=='portfolio'){
            $meta = get_post_meta($post->ID,'portfolio_meta',TRUE);
            $desc = '';  if(!empty($meta['desc'])){  $desc = $meta['desc']; }
            echo wp_kses_post($desc);
        }else{
            the_excerpt();
        }
    }else{
        if(get_post_type(get_the_ID())=='portfolio'){
            $meta = get_post_meta($post->ID,'portfolio_meta',TRUE);
            $desc = '';  if(!empty($meta['desc'])){  $desc = $meta['desc']; }
            echo wp_kses_post($desc);
        }else{
           the_content();
        }
    }

    wp_link_pages( array(
        'before'      => '<div class="page-links">' . __( 'Pages:', 'spawp' ),
        'after'       => '</div>',
        'link_before' => '<span class="page-number">',
        'link_after'  => '</span>',
    ) );
    ?>

</div>

<?php do_action( 'spawp_after_blog_entry_content' ); ?>