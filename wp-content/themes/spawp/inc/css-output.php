<?php
function spawp_get_dynamic_css() {
	$option = wp_parse_args(  get_option( 'spawp_option', array() ), spawp_theme_default_data() );

	// Primary Color 
	$primary_color = spawp_get_option('primary_color')?spawp_get_option('primary_color'):'#f78fa6';
	list($r, $g, $b) = sscanf($primary_color, "#%02x%02x%02x");

	require_once SPAWP_INC_DIR . 'classes/class-frontend-css.php';
	$css = new Spawp_Pro_CSS;

	// root 
	$css->set_selector( ':root' );
	$css->add_property( '--body-color', '#545454' );
	$css->add_property( '--border-color', '#00000020' );
	$css->add_property( '--primary-color', esc_attr( $primary_color ) );
	$css->add_property( '--primary-r-color', esc_attr( $r ) );
	$css->add_property( '--primary-g-color', esc_attr( $g ) );
	$css->add_property( '--primary-b-color', esc_attr( $b ) );

	// Mobile query start
	/* Primary Menu */
	$css->start_media_query( apply_filters( 'spawp_mobile_menu_media_query', '(min-width:'.absint($option['nav_mobilebtn_breakpoint']).'px)' ) );
		$css->set_selector( '.theme_mobile_menu' );
		$css->add_property( 'display', 'none' );
	$css->stop_media_query();
	$css->start_media_query( apply_filters( 'spawp_mobile_menu_media_query', '(max-width:'.absint($option['nav_mobilebtn_breakpoint']).'px)' ) );
		$css->set_selector( '.theme_mobile_menu li .fa-caret-down,.primary_menu .collapse' );
		$css->add_property( 'display', 'none  !important' );
	$css->stop_media_query();
	// Mobile query end

	$css->set_selector( 'body' );
	$css->add_property( 'background-color', esc_attr( isset($option['body_bg_color'])?$option['body_bg_color']:'' ) );
	$css->add_property( 'color', esc_attr( isset($option['body_text_color'])?$option['body_text_color']:'' ) );
	$css->set_selector( 'body a' );
	$css->add_property( 'color', esc_attr( isset($option['body_link_color'])?$option['body_link_color']:'' ) );
	$css->set_selector( 'body a:hover,body a:focus' );
	$css->add_property( 'color', esc_attr( isset($option['body_link_hover_color'])?$option['body_link_hover_color']:'' ) );

	$css->set_selector( '.top_header__wrap' );
	$css->add_property( 'background-color', esc_attr( $option['tb_bg_color'] ) );
	$css->add_property( 'color', esc_attr( $option['tb_text_color'] ) );
	$css->set_selector( '.top_header__wrap i' );
	$css->add_property( 'color', esc_attr( $option['tb_text_color'] ) );
	$css->set_selector( '.top_header__wrap a' );
	$css->add_property( 'color', esc_attr( $option['tb_link_color'] ) );
	$css->set_selector( '.top_header__wrap a:hover,.top_header__wrap a:focus' );
	$css->add_property( 'color', esc_attr( $option['tb_link_hover_color'] ) );

	$css->set_selector( '#site-navigation.primary_menu' );
	$css->add_property( 'background-color', esc_attr( $option['p_nav_bg_color'] ) );
	$css->add_property( 'color', esc_attr( $option['p_nav_text_color'] ) );
	$css->set_selector( '#site-navigation .primary-menu > a' );
	$css->add_property( 'color', esc_attr( $option['p_nav_text_color'] ) );
	$css->set_selector( '#site-navigation .primary-menu > li > a:not(.custom-menu-button):hover,#site-navigation .primary-menu > li > a:not(.custom-menu-button):focus' );
	$css->add_property( 'background-color', esc_attr( $option['p_nav_bg_hover_color'] ) );
	$css->add_property( 'color', esc_attr( $option['p_nav_text_hover_color'] ) );
	$css->set_selector( '#site-navigation .primary-menu > li > a:not(.custom-menu-button):hover + .fa,#site-navigation .primary-menu > li > a:not(.custom-menu-button):focus + .fa' );
	$css->add_property( 'background-color', esc_attr( $option['p_nav_bg_hover_color'] ) );
	$css->add_property( 'color', esc_attr( $option['p_nav_text_hover_color'] ) );
	$css->set_selector( '#site-navigation .primary-menu li.current-menu-ancestor > a,#site-navigation .primary-menu li.current-menu-item > a,#site-navigation .primary-menu li.current-menu-item > .link-icon-wrapper > a' );
	$css->add_property( 'background-color', esc_attr( $option['p_nav_bg_current_color'] ) );
	$css->add_property( 'color', esc_attr( $option['p_nav_text_current_color']?$option['p_nav_text_current_color']:$option['primary_color'] ) );
	$css->set_selector( '#site-navigation .primary-menu li.current-menu-ancestor > a + .fa,#site-navigation .primary-menu li.current-menu-item > a + .fa,#site-navigation .primary-menu li.current-menu-item > .link-icon-wrapper > a + .fa' );
	$css->add_property( 'background-color', esc_attr( $option['p_nav_bg_current_color'] ) );
	$css->add_property( 'color', esc_attr( $option['p_nav_text_current_color']?$option['p_nav_text_current_color']:$option['primary_color'] ) );

	return apply_filters( 'spawp_dynamic_css', $css );
}

/**
 * Enqueue CSS styling.
 */
function spawp_enqueue_dynamic_css() {
	$css = spawp_get_dynamic_css();
	wp_register_style( 'spawp-custom-style', false );
	wp_enqueue_style( 'spawp-custom-style' );

	wp_add_inline_style( 'spawp-custom-style', $css->css_output() );
}
add_action( 'wp_enqueue_scripts', 'spawp_enqueue_dynamic_css', 50 );