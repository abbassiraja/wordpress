<?php
// Blog =============================
if( !function_exists('spawp_blog_section') ){
	function spawp_blog_section(){
		get_template_part('inc/sections/spawp-section','blog');
	}
}
if( function_exists('spawp_blog_section') ){
	$section_priority = apply_filters( 'spawp_section_priority', 50, 'spawp_blog_section' );
	add_action('spawp_sections','spawp_blog_section', absint($section_priority));
}