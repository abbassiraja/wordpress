<div class="post-footer">
	<?php if ( get_the_tags() ) { ?>
    <div class="post-tags">
        <i class="fas fa-tag"></i><?php the_tags('',', '); ?>
    </div>
    <?php } ?>
	<?php
		if ( function_exists( 'arimolite_core_post_share' ) ) {
			arimolite_core_post_share();
		}
	?>
</div>