<?php
/**
 * slider section
 *
 * @package royal-magazine
 */

$default = royal_magazine_get_default_theme_options();

// Slider Main Section.
$wp_customize->add_section( 'slider_section_settings',
	array(
		'title'      => esc_html__( 'Slider Section', 'royal-magazine' ),
		'priority'   => 60,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_front_page_section',
	)
);


// Setting - show_slider_section.
$wp_customize->add_setting( 'show_slider_section',
	array(
		'default'           => $default['show_slider_section'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'royal_magazine_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'show_slider_section',
	array(
		'label'    => esc_html__( 'Enable Slider', 'royal-magazine' ),
		'section'  => 'slider_section_settings',
		'type'     => 'checkbox',
		'priority' => 100,
	)
);


// Setting - show_slider_on_blog_page.
$wp_customize->add_setting( 'show_slider_on_blog_page',
	array(
		'default'           => $default['show_slider_on_blog_page'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'royal_magazine_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'show_slider_on_blog_page',
	array(
		'label'    => esc_html__( 'Show Slider On Blog Page', 'royal-magazine' ),
		'section'  => 'static_front_page',
		'type'     => 'checkbox',
		'priority' => 100,
	)
);


// Setting - drop down category for slider.
$wp_customize->add_setting( 'select_category_for_slider',
	array(
		'default'           => $default['select_category_for_slider'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'absint',
	)
);
$wp_customize->add_control( new Royal_Magazine_Dropdown_Taxonomies_Control( $wp_customize, 'select_category_for_slider',
	array(
        'label'           => esc_html__( 'Category for slider', 'royal-magazine' ),
        'description'     => esc_html__( 'Select category to be shown on tab ', 'royal-magazine' ),
        'section'         => 'slider_section_settings',
        'type'            => 'dropdown-taxonomies',
        'taxonomy'        => 'category',
		'priority'    	  => 130,
    ) ) );


