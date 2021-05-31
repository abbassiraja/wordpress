<?php
$blog_config = arimolite_blog_configs();
$blog_layout = $blog_config['layout'];

global $arimolite_blog_layout, $blog_title_limited, $blog_is_widget;
if ( $blog_is_widget && !empty($arimolite_blog_layout) ) {
	$blog_layout = $arimolite_blog_layout;
}

$featured_image = arimolite_resize_image( get_post_thumbnail_id(), null, 585, 390, true, false );
?>

<div class="post-inner">
	<?php if ( has_post_thumbnail() ) { ?>
		<?php if (( $blog_layout == '3cols_grid') || ( $blog_layout == '2cols_grid') || ( $blog_layout == 'grid2') || ( $blog_layout == 'grid3') ) { ?>
			<div class="post-format">
				<a href="<?php the_permalink(); ?>">
		        	<figure><img src="<?php echo esc_url( $featured_image['url'] ); ?>" alt="<?php the_title_attribute(); ?>"/></figure>
		        </a>
		    </div>			
		<?php } else { ?>
			<div class="post-format">
				<a href="<?php the_permalink() ?>" style="background-image: url('<?php echo wp_get_attachment_url( get_post_thumbnail_id() ); ?>');"></a>
		    </div>
		<?php } ?>
    <?php } ?>
    <div class="post-info">
    	<div class="post-cats"><?php the_category(' ') ?></div>
    	<?php
            $post_title = (int)$blog_title_limited > 0 ? substr( get_the_title(), 0, $blog_title_limited) . '...' : get_the_title();
            $post_title = get_the_title() ? $post_title : get_the_date();
        ?>
        <h3 class="post-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php echo wp_kses_post( $post_title ); ?></a></h3>
        <?php get_template_part('template-parts/post', 'meta'); ?>
        <div class="post-excerpt"><?php the_excerpt(); ?></div>
    </div>
</div>
