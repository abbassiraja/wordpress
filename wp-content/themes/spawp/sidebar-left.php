<?php 
/**
 * Left sidebar
 *
 *
 */
 
if ( ! is_active_sidebar( 'sidebar-2' ) ) {
	return;
}

$class = spawp_get_left_sidebar_classes();
?>
<div class="<?php echo esc_attr($class); ?> secondary">
	<div class="sidebar">
		<?php dynamic_sidebar( 'sidebar-2' ); ?>
	</div>
</div><!-- .secondary -->