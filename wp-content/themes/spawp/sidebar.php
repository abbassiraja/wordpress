<?php 
/**
 * Right sidebar
 *
 *
 */
 
if ( ! is_active_sidebar( 'sidebar' ) ) {
	return;
}

$class = spawp_get_right_sidebar_classes();
?>
<div class="<?php echo esc_attr($class); ?> secondary">
	<div class="sidebar">
		<?php dynamic_sidebar( 'sidebar' ); ?>
	</div>
</div><!-- .secondary -->