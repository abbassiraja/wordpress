<?php

/**************************************************
**** Layout Sections
***************************************************/
$wp_customize->add_section( new SPAWP_Custom_Section( $wp_customize, 
	'preloader_section', 
		array(
			'title'    => esc_html__( 'Preloader', 'spawp' ),
			'panel'    => 'layout',
			'priority' => 1,
		)
 ) );

$wp_customize->add_section( new SPAWP_Custom_Section( $wp_customize, 
	'container_section', 
		array(
			'title'    => esc_html__( 'Container', 'spawp' ),
			'panel'    => 'layout',
			'priority' => 1,
		)
 ) );

$wp_customize->add_section( new SPAWP_Custom_Section( $wp_customize, 
	'layout_section', 
		array(
			'title'    => esc_html__( 'Layout', 'spawp' ),
			'panel'    => 'layout',
			'priority' => 1,
		)
 ) );

$wp_customize->add_section( new SPAWP_Custom_Section( $wp_customize, 
	'topbar_section', 
		array(
			'title'    => esc_html__( 'Top Bar', 'spawp' ),
			'panel'    => 'layout',
			'priority' => 2,
		)
 ) );

$wp_customize->add_section( new SPAWP_Custom_Section( $wp_customize, 
	'header_section', 
		array(
			'title'    => esc_html__( 'Header', 'spawp' ),
			'panel'    => 'layout',
			'priority' => 3,
		)
 ) );

$wp_customize->add_section( new SPAWP_Custom_Section( $wp_customize, 
	'primary_section', 
		array(
			'title'    => esc_html__( 'Primary Navigation', 'spawp' ),
			'panel'    => 'layout',
			'priority' => 4,
		)
 ) );

$wp_customize->add_section( new SPAWP_Custom_Section( $wp_customize, 
	'secondary_section', 
		array(
			'title'    => esc_html__( 'Secondary Navigation', 'spawp' ),
			'panel'    => 'layout',
			'priority' => 5,
		)
 ) );

$wp_customize->add_section( new SPAWP_Custom_Section( $wp_customize, 
	'sticky_section', 
		array(
			'title'    => esc_html__( 'Sticky Navigation', 'spawp' ),
			'panel'    => 'layout',
			'priority' => 6,
		)
 ) );

$wp_customize->add_section( new SPAWP_Custom_Section( $wp_customize, 
	'canvas_section', 
		array(
			'title'    => esc_html__( 'Off Canvas Navigation', 'spawp' ),
			'panel'    => 'layout',
			'priority' => 7,
		)
 ) );

$wp_customize->add_section( new SPAWP_Custom_Section( $wp_customize, 
	'sidebar_section', 
		array(
			'title'    => esc_html__( 'Sidebars', 'spawp' ),
			'panel'    => 'layout',
			'priority' => 7,
		)
 ) );

$wp_customize->add_section( new SPAWP_Custom_Section( $wp_customize, 
	'blog_section', 
		array(
			'title'    => esc_html__( 'Blog', 'spawp' ),
			'panel'    => 'layout',
			'priority' => 8,
		)
 ) );

$wp_customize->add_section( new SPAWP_Custom_Section( $wp_customize, 
	'footer_section', 
		array(
			'title'    => esc_html__( 'Footer', 'spawp' ),
			'panel'    => 'layout',
			'priority' => 9,
		)
 ) );


/**************************************************
**** Front Page Sections
***************************************************/

$wp_customize->add_section( new SPAWP_Custom_Section( $wp_customize, 
	'spawp_slider_section', 
		array(
			'title'    => esc_html__( 'Slider', 'spawp' ),
			'panel'    => 'frontpage_panel',
			'priority' => apply_filters( 'spawp_section_priority', 5, 'spawp_slider_section' ),
		)
 ) );

$wp_customize->add_section( new SPAWP_Custom_Section( $wp_customize, 
	'spawp_service_section', 
		array(
			'title'    => esc_html__( 'Service', 'spawp' ),
			'panel'    => 'frontpage_panel',
			'priority' => apply_filters( 'spawp_section_priority', 10, 'spawp_service_section' ),
		)
 ) );

$wp_customize->add_section( new SPAWP_Custom_Section( $wp_customize, 
	'spawp_feature_section', 
		array(
			'title'    => esc_html__( 'Feature', 'spawp' ),
			'panel'    => 'frontpage_panel',
			'priority' => apply_filters( 'spawp_feature_section', 15, 'spawp_feature_section' ),
		)
 ) );

$wp_customize->add_section( new SPAWP_Custom_Section( $wp_customize, 
	'spawp_counter_section', 
		array(
			'title'    => esc_html__( 'Funfect', 'spawp' ),
			'panel'    => 'frontpage_panel',
			'priority' => apply_filters( 'spawp_section_priority', 20, 'spawp_counter_section' ),
		)
 ) );

$wp_customize->add_section( new SPAWP_Custom_Section( $wp_customize, 
	'spawp_portfolio_section', 
		array(
			'title'    => esc_html__( 'Portfolio', 'spawp' ),
			'panel'    => 'frontpage_panel',
			'priority' => apply_filters( 'spawp_section_priority', 21, 'spawp_portfolio_section' ),
		)
 ) );

$wp_customize->add_section( new SPAWP_Custom_Section( $wp_customize, 
	'spawp_callout_section', 
		array(
			'title'    => esc_html__( 'Call To Action', 'spawp' ),
			'panel'    => 'frontpage_panel',
			'priority' => apply_filters( 'spawp_section_priority', 22, 'spawp_callout_section' ),
		)
 ) );

$wp_customize->add_section( new SPAWP_Custom_Section( $wp_customize, 
	'spawp_pricing_section', 
		array(
			'title'    => esc_html__( 'Pricing', 'spawp' ),
			'panel'    => 'frontpage_panel',
			'priority' => apply_filters( 'spawp_section_priority', 35, 'spawp_pricing_section' ),
		)
 ) );

$wp_customize->add_section( new SPAWP_Custom_Section( $wp_customize, 
	'spawp_testimonial_section', 
		array(
			'title'    => esc_html__( 'Testimonial', 'spawp' ),
			'panel'    => 'frontpage_panel',
			'priority' => apply_filters( 'spawp_section_priority', 40, 'spawp_testimonial_section' ),
		)
 ) );

$wp_customize->add_section( new SPAWP_Custom_Section( $wp_customize, 
	'spawp_team_section', 
		array(
			'title'    => esc_html__( 'Team', 'spawp' ),
			'panel'    => 'frontpage_panel',
			'priority' => apply_filters( 'spawp_section_priority', 45, 'spawp_team_section' ),
		)
 ) );

$wp_customize->add_section( new SPAWP_Custom_Section( $wp_customize, 
	'spawp_blog_section', 
		array(
			'title'    => esc_html__( 'Blog', 'spawp' ),
			'panel'    => 'frontpage_panel',
			'priority' => apply_filters( 'spawp_section_priority', 46, 'spawp_blog_section' ),
		)
 ) );

$wp_customize->add_section( new SPAWP_Custom_Section( $wp_customize, 
	'spawp_client_section', 
		array(
			'title'    => esc_html__( 'Client', 'spawp' ),
			'panel'    => 'frontpage_panel',
			'priority' => apply_filters( 'spawp_section_priority', 55, 'spawp_client_section' ),
		)
 ) );

/**************************************************
**** Theme Templates Section
***************************************************/

$wp_customize->add_section( new SPAWP_Custom_Section( $wp_customize, 
	'aboutus_page_sections', 
		array(
			'title'    => esc_html__( 'About Us Template', 'spawp' ),
			'panel'    => 'theme_templates_panel',
			'priority' => 1,
		)
 ) );

$wp_customize->add_section( new SPAWP_Custom_Section( $wp_customize, 
	'services_page_sections', 
		array(
			'title'    => esc_html__( 'Services Template', 'spawp' ),
			'panel'    => 'theme_templates_panel',
			'priority' => 2,
		)
 ) );

$wp_customize->add_section( new SPAWP_Custom_Section( $wp_customize, 
	'contactus_page_sections', 
		array(
			'title'    => esc_html__( 'Contact Us Template', 'spawp' ),
			'panel'    => 'theme_templates_panel',
			'priority' => 3,
		)
 ) );

/**************************************************
**** Theme Colors Section
***************************************************/

$wp_customize->add_section( new SPAWP_Custom_Section( $wp_customize, 
	'primary_colors', 
		array(
			'title'    => esc_html__( 'Primary Color', 'spawp' ),
			'panel'    => 'theme_color_panel',
			'priority' => 1,
		)
 ) );

$wp_customize->add_section( new SPAWP_Custom_Section( $wp_customize, 
	'body_colors', 
		array(
			'title'    => esc_html__( 'Body', 'spawp' ),
			'panel'    => 'theme_color_panel',
			'priority' => 1,
		)
 ) );

$wp_customize->add_section( new SPAWP_Custom_Section( $wp_customize, 
	'tb_colors', 
		array(
			'title'    => esc_html__( 'Top Bar', 'spawp' ),
			'panel'    => 'theme_color_panel',
			'priority' => 2,
		)
 ) );

$wp_customize->add_section( new SPAWP_Custom_Section( $wp_customize, 
	'header_colors', 
		array(
			'title'    => esc_html__( 'Header', 'spawp' ),
			'panel'    => 'theme_color_panel',
			'priority' => 3,
		)
 ) );

$wp_customize->add_section( new SPAWP_Custom_Section( $wp_customize, 
	'p_nav_colors', 
		array(
			'title'    => esc_html__( 'Primary Navigation', 'spawp' ),
			'panel'    => 'theme_color_panel',
			'priority' => 4,
		)
 ) );

$wp_customize->add_section( new SPAWP_Custom_Section( $wp_customize, 
	's_nav_colors', 
		array(
			'title'    => esc_html__( 'Secondary Navigation', 'spawp' ),
			'panel'    => 'theme_color_panel',
			'priority' => 5,
		)
 ) );

$wp_customize->add_section( new SPAWP_Custom_Section( $wp_customize, 
	'c_nav_colors', 
		array(
			'title'    => esc_html__( 'Off Canvas Navigation', 'spawp' ),
			'panel'    => 'theme_color_panel',
			'priority' => 6,
		)
 ) );

$wp_customize->add_section( new SPAWP_Custom_Section( $wp_customize, 
	'button_colors', 
		array(
			'title'    => esc_html__( 'Button', 'spawp' ),
			'panel'    => 'theme_color_panel',
			'priority' => 7,
		)
 ) );

$wp_customize->add_section( new SPAWP_Custom_Section( $wp_customize, 
	'content_colors', 
		array(
			'title'    => esc_html__( 'Content', 'spawp' ),
			'panel'    => 'theme_color_panel',
			'priority' => 8,
		)
 ) );

$wp_customize->add_section( new SPAWP_Custom_Section( $wp_customize, 
	'sidebar_colors', 
		array(
			'title'    => esc_html__( 'Sidebar Widgets', 'spawp' ),
			'panel'    => 'theme_color_panel',
			'priority' => 9,
		)
 ) );

$wp_customize->add_section( new SPAWP_Custom_Section( $wp_customize, 
	'form_colors', 
		array(
			'title'    => esc_html__( 'Form', 'spawp' ),
			'panel'    => 'theme_color_panel',
			'priority' => 10,
		)
 ) );

$wp_customize->add_section( new SPAWP_Custom_Section( $wp_customize, 
	'footer_colors', 
		array(
			'title'    => esc_html__( 'Footer', 'spawp' ),
			'panel'    => 'theme_color_panel',
			'priority' => 11,
		)
 ) );

/**************************************************
**** Background Images Section
***************************************************/

$wp_customize->add_section( new SPAWP_Custom_Section( $wp_customize, 
	'body_image', 
		array(
			'title'    => esc_html__( 'Body', 'spawp' ),
			'panel'    => 'background_images_panel',
			'priority' => 1,
		)
 ) );

$wp_customize->add_section( new SPAWP_Custom_Section( $wp_customize, 
	'content_image', 
		array(
			'title'    => esc_html__( 'Content', 'spawp' ),
			'panel'    => 'background_images_panel',
			'priority' => 2,
		)
 ) );

$wp_customize->add_section( new SPAWP_Custom_Section( $wp_customize, 
	'sidebar_image', 
		array(
			'title'    => esc_html__( 'Sidebar', 'spawp' ),
			'panel'    => 'background_images_panel',
			'priority' => 3,
		)
 ) );

$wp_customize->add_section( new SPAWP_Custom_Section( $wp_customize, 
	'footer_widget_image', 
		array(
			'title'    => esc_html__( 'Footer Widget', 'spawp' ),
			'panel'    => 'background_images_panel',
			'priority' => 4,
		)
 ) );

$wp_customize->add_section( new SPAWP_Custom_Section( $wp_customize, 
	'footer_image', 
		array(
			'title'    => esc_html__( 'Footer', 'spawp' ),
			'panel'    => 'background_images_panel',
			'priority' => 5,
		)
 ) );

/**************************************************
**** Typography Section
***************************************************/

$wp_customize->add_section( new SPAWP_Custom_Section( $wp_customize, 
	'body_typography', 
		array(
			'title'    => esc_html__( 'Body', 'spawp' ),
			'panel'    => 'typography_panel',
			'priority' => 1,
		)
 ) );

$wp_customize->add_section( new SPAWP_Custom_Section( $wp_customize, 
	'topbar_typography', 
		array(
			'title'    => esc_html__( 'Top Bar', 'spawp' ),
			'panel'    => 'typography_panel',
			'priority' => 2,
		)
 ) );

$wp_customize->add_section( new SPAWP_Custom_Section( $wp_customize, 
	'header_typography', 
		array(
			'title'    => esc_html__( 'Header', 'spawp' ),
			'panel'    => 'typography_panel',
			'priority' => 3,
		)
 ) );

$wp_customize->add_section( new SPAWP_Custom_Section( $wp_customize, 
	'primary_nav_typography', 
		array(
			'title'    => esc_html__( 'Primary Navigation', 'spawp' ),
			'panel'    => 'typography_panel',
			'priority' => 4,
		)
 ) );

$wp_customize->add_section( new SPAWP_Custom_Section( $wp_customize, 
	'secondary_nav_typography', 
		array(
			'title'    => esc_html__( 'Secondary Navigation', 'spawp' ),
			'panel'    => 'typography_panel',
			'priority' => 5,
		)
 ) );

$wp_customize->add_section( new SPAWP_Custom_Section( $wp_customize, 
	'canvas_nav_typography', 
		array(
			'title'    => esc_html__( 'Off Canvas Navigation', 'spawp' ),
			'panel'    => 'typography_panel',
			'priority' => 6,
		)
 ) );

$wp_customize->add_section( new SPAWP_Custom_Section( $wp_customize, 
	'button_typography', 
		array(
			'title'    => esc_html__( 'Button', 'spawp' ),
			'panel'    => 'typography_panel',
			'priority' => 7,
		)
 ) );

$wp_customize->add_section( new SPAWP_Custom_Section( $wp_customize, 
	'heading_typography', 
		array(
			'title'    => esc_html__( 'Headings', 'spawp' ),
			'panel'    => 'typography_panel',
			'priority' => 8,
		)
 ) );

$wp_customize->add_section( new SPAWP_Custom_Section( $wp_customize, 
	'widget_typography', 
		array(
			'title'    => esc_html__( 'Widgets', 'spawp' ),
			'panel'    => 'typography_panel',
			'priority' => 9,
		)
 ) );

$wp_customize->add_section( new SPAWP_Custom_Section( $wp_customize, 
	'footer_typography', 
		array(
			'title'    => esc_html__( 'Footer', 'spawp' ),
			'panel'    => 'typography_panel',
			'priority' => 10,
		)
 ) );