<?php
$secondary_nav_position = '';
if( class_exists('Spawp_Premium_Theme_Setup') ){
	$secondary_nav_position = spawp_get_option('secondary_nav_position');
}
$main_nav_priority = 20;
$secondary_nav_priority = 10;
if($secondary_nav_position=='above'){
	$main_nav_priority = 20;
	$secondary_nav_priority = 10;
}else if($secondary_nav_position=='below'){
	$main_nav_priority = 10;
	$secondary_nav_priority = 20;
}

// header top
if ( ! function_exists( 'spawp_header_topbar_template' ) ) {

	function spawp_header_topbar_template() {

		get_template_part( 'partials/header/header','top');

	}

	add_action( 'spawp_header_topbar', 'spawp_header_topbar_template' );

}

// header navigation primary
if ( ! function_exists( 'spawp_header_nav_template' ) ) {

	function spawp_header_nav_template() {

		get_template_part( 'partials/header/header','nav');

	}

	add_action( 'spawp_header_nav', 'spawp_header_nav_template', $main_nav_priority );

}

// header navigation secondary
if ( ! function_exists( 'spawp_header_secondary_nav_template' ) ) {

	function spawp_header_secondary_nav_template() {

		get_template_part( 'partials/header/header','secondary');

	}

	if($secondary_nav_position!=false){

		add_action( 'spawp_header_nav', 'spawp_header_secondary_nav_template', $secondary_nav_priority );

	}

}

// footer widget
if ( ! function_exists( 'spawp_footer_template' ) ) {

	function spawp_footer_template() {

		get_template_part( 'partials/footer/widget');

	}

	add_action( 'spawp_footer', 'spawp_footer_template' );

}

// footer copyright
if ( ! function_exists( 'spawp_footer_copyright_template' ) ) {

	function spawp_footer_copyright_template() {

		get_template_part( 'partials/footer/copyright');

	}

	add_action( 'spawp_footer', 'spawp_footer_copyright_template' );

}

// post class
if ( ! function_exists( 'spawp_post_entry_classes' ) ) {

	function spawp_post_entry_classes() {

		$classes = array();

		// Core classes
		$classes[] = 'post';
		
		$classes[] = 'wow zoomIn';

		// No Featured Image Class, don't add if oembed or self hosted meta are defined
		if ( ! has_post_thumbnail() ) {
			$classes[] = 'no-featured-image';
		}

		// Apply filters to entry post class for child theming
		$classes = apply_filters( 'spawp_blog_entry_classes', $classes );

		// Rturn classes array
		return $classes;
		
	}

}

if ( ! function_exists( 'spawp_blog_entry_elements_positioning' ) ) {

	function spawp_blog_entry_elements_positioning() {

		// Default sections
		$sections = array( 'featured_image', 'title', 'meta', 'content', 'read_more' );

		// convert string into an array
		if ( $sections && ! is_array( $sections ) ) {
			$sections = explode( ',', $sections );
		}

		// Apply filters for simple modification
		$sections = apply_filters( 'spawp_blog_entry_elements_positioning', $sections );

		return $sections;

	}

}

if ( ! function_exists( 'spawp_excerpt' ) ) {

	function spawp_excerpt( $length = 30 ) {
		global $post;

		// custom excerpt
		if ( has_excerpt( $post->ID ) ) {
			$output = $post->post_excerpt;
		}else {

			// Check for more tag
			if ( strpos( $post->post_content, '<!--more-->' ) ) {
				$output = apply_filters( 'the_content', get_the_content() );
			} else {
				$output = wp_trim_words( strip_shortcodes( $post->post_content ), $length );
			}

		}

		$output = apply_filters('spawp_excerpt', $output);

		return $output;

	}

}

function spawp_blog_entry_elements_positioning_output($sections){

	$featured_image_position = spawp_get_option('archive_feature_image_position');

	if(is_single()){
		$featured_image_position = spawp_get_option('single_feature_image_position');
	}

	$image_key = array_search ('featured_image', $sections);
	$title_key = array_search ('title', $sections);

	if($featured_image_position=='below'){
		$sections[$title_key] = 'featured_image';
		$sections[$image_key] = 'title';
	}

	return $sections;
}
add_filter('spawp_blog_entry_elements_positioning','spawp_blog_entry_elements_positioning_output');