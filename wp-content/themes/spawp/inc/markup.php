<?php
// Adding new body classes
function spawp_body_classes( $classes ) {

	$content_layout = spawp_get_option('content_layout_setting');
    $layout = spawp_get_option('layout');

	$classes[] = ( $content_layout ) ? $content_layout : 'separate-containers';

    if(is_single()){
       $classes[] = 'pagination-single-disable';
    }

    if($layout=='boxed'){
        $classes[] = 'boxed';
    }

	return $classes;
}
add_filter( 'body_class', 'spawp_body_classes' );

// Excerpt length
if ( ! function_exists( 'spawp_excerpt_length' ) ) {
    add_filter( 'excerpt_length', 'spawp_excerpt_length', 15 );
    function spawp_excerpt_length( $length ) {
        $excerpt_length = spawp_get_option('archive_excerpt_length');
        return absint( apply_filters( 'spawp_excerpt_length', $excerpt_length ) );
    }
}

// Excerpt Read More
if ( ! function_exists( 'spawp_blog_excerpt_more' ) ) {
    add_filter( 'excerpt_more', 'spawp_blog_excerpt_more', 15 );
    function spawp_blog_excerpt_more( $more ) {
        $excerpt_readmore = spawp_get_option('archive_readmore_label');

        // If empty, return
        if ( '' == $excerpt_readmore ) {
            return '';
        }

        return apply_filters( 'spawp_excerpt_more_output', sprintf( ' ... <a title="%1$s" class="more-link" href="%2$s">%3$s <i class="fa fa-angle-double-right"></i></a>',
            the_title_attribute( 'echo=0' ),
            esc_url( get_permalink( get_the_ID() ) ),
            wp_kses_post( $excerpt_readmore )
        ) );
    }
}

// Content Read More
if ( ! function_exists( 'spawp_blog_content_more' ) ) {
    add_filter( 'the_content_more_link', 'spawp_blog_content_more', 15 );
    function spawp_blog_content_more( $more ) {
        $excerpt_readmore = spawp_get_option('archive_readmore_label');

        // If empty, return
        if ( '' == $excerpt_readmore ) {
            return '';
        }

        return apply_filters( 'spawp_content_more_link_output', sprintf( '<p class="more-link-container"><a title="%1$s" class="more-link content-more-link" href="%2$s">%3$s%4$s <i class="fa fa-angle-double-right"></i></a></p>',
            the_title_attribute( 'echo=0' ),
            esc_url( get_permalink( get_the_ID() ) . apply_filters( 'spawp_more_jump','#more-' . get_the_ID() ) ),
            wp_kses_post( $excerpt_readmore ),
            '<span class="screen-reader-text">' . get_the_title() . '</span>'
        ) );
    }
}

add_filter( 'spawp_excerpt_more_output', 'spawp_blog_read_more_button' );
add_filter( 'spawp_content_more_link_output', 'spawp_blog_read_more_button' );
function spawp_blog_read_more_button( $output ) {
	$archive_readmore_button = spawp_get_option('archive_readmore_label');
	$excerpt_readmore = spawp_get_option('archive_readmore_label');
    $archive_readmore_button = spawp_get_option('archive_readmore_button');

    $class='';
    if($archive_readmore_button){
        $class = 'button';
    }


	if ( !$archive_readmore_button ) {
		return $output;
	}

	return sprintf( '%5$s<p class="more-link-container"><a title="%1$s" class="more-link %6$s" href="%2$s">%3$s%4$s <i class="fa fa-angle-double-right"></i></a></p>',
		the_title_attribute( 'echo=0' ),
		esc_url( get_permalink( get_the_ID() ) . apply_filters( 'spawp_more_jump','#more-' . get_the_ID() ) ),
		wp_kses_post( $excerpt_readmore ),
		'<span class="screen-reader-text">' . get_the_title() . '</span>',
		'spawp_excerpt_more_output' == current_filter() ? ' ... ' : '',
        esc_attr($class)
	);
}

if ( ! function_exists( 'spawp_show_excerpt' ) ) {
    function spawp_show_excerpt() {
        global $post;

        // If the more tag is used.
        $more_tag = apply_filters( 'spawp_more_tag', strpos( $post->post_content, '<!--more-->' ) );
        $postformat = ( false !== get_post_format() ) ? get_post_format() : 'standard';

        $show_excerpt = ( 'excerpt' === spawp_get_option('archive_content_type') ) ? true : false;
        $show_excerpt = ( 'standard' !== $postformat ) ? false : $show_excerpt;
        $show_excerpt = ( $more_tag ) ? false : $show_excerpt;
        $show_excerpt = ( is_search() ) ? true : $show_excerpt;

        return apply_filters( 'spawp_show_excerpt', $show_excerpt );
    }
}