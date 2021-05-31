<?php
if( is_page() && !is_page_template()  ){
	return;
}
?>

<?php do_action( 'spawp_before_blog_entry_meta' ); ?>

<?php 
$is_meta = false;
$date = spawp_get_option('archive_date_show');
$author = spawp_get_option('archive_author_show');
$category = spawp_get_option('archive_categories_show');
$post_tag = spawp_get_option('archive_tags_show');
$post_comment = spawp_get_option('archive_comment_count_show');

if(is_single()){
	$date = spawp_get_option('single_date_show');
	$author = spawp_get_option('single_author_show');
	$category = spawp_get_option('single_categories_show');
	$post_tag = spawp_get_option('single_tags_show');
	$post_comment = false;
}

if($date){ $is_meta = true; }
if($author){ $is_meta = true; }
if($category){ $is_meta = true; }
if($post_tag){ $is_meta = true; }
if($post_comment){ $is_meta = true; }

if($is_meta){
?>
<div class="entry-meta">
	<?php if($author){ ?>
	<span class="author"><i class="fa fa-user"></i> <?php the_author_posts_link(); ?></span>
	<?php } ?>

	<?php if($date){ ?>
	<span class="post-date"><i class="fa fa-clock-o"></i> <a href="<?php echo esc_url( get_day_link(get_post_time('Y'), get_post_time('m'), get_post_time('j')));  ?>"><?php the_time( get_option('date_format') ); ?></a></span>
	<?php } ?>

	<?php if( has_category() && $category ) { ?>
	<span class="post-category"><i class="fa fa-list-alt"></i> <?php the_category( ' <span class="swp-sep">,</span> ', get_the_ID() ); ?></span>
	<?php } ?>
	<?php if( has_tag() && $post_tag ) { ?>
	<span class="post-tags"><i class="fa fa-tags"></i> <?php the_tags( ' <span class="swp-sep">,</span> ', get_the_ID() ); ?></span>
	<?php } ?>

	<?php if($post_comment){ ?>
	<span class="comment-links"><i class="fa fa-comment-o"></i> <a href="<?php the_permalink(); ?>#respond"><?php echo esc_html(get_comments_number());?></a>
	</span>
	<?php } ?>
</div>
<?php } ?>

<?php do_action( 'spawp_after_blog_entry_meta' ); ?>