<?php

$is_featured_image = spawp_get_option('archive_feature_image_show');
$featured_image_align = spawp_get_option('archive_feature_image_alignment');

if(is_single()){
	$is_featured_image = spawp_get_option('single_feature_image_show');
	$featured_image_align = spawp_get_option('single_feature_image_alignment');
}

if( has_post_thumbnail() && $is_featured_image ):
?>
<div class="post-thumbnail post-thumbnail-<?php echo esc_attr( $featured_image_align ); ?>">


	<?php if( !is_single() ){ ?>

	<a href="<?php the_permalink(); ?>">
		<?php the_post_thumbnail('full'); ?>
	</a>

	<?php } else { ?>

		<?php the_post_thumbnail('full'); ?>

	<?php } ?>

</div>
<?php endif; ?>