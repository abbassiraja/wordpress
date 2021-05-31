<?php do_action( 'spawp_before_blog_entry_title' ); ?>

<header class="entry-header">
	<h3 class="entry-title">

		<?php if( !is_single() && !is_page() || is_page_template() ){ ?>

		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark">
			<?php the_title(); ?>
		</a>

		<?php } else { ?>

			<?php the_title(); ?>

		<?php } ?>
		
	</h3>
	<div class="blog-seprator"></div>
</header>

<?php do_action( 'spawp_after_blog_entry_title' ); ?>