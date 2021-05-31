<?php
/**
 * Top section
 *
 * @package royal-magazine
 */

$default = royal_magazine_get_default_theme_options();

// Latest featured Section.
$wp_customize->add_section( 'top_section_settings',
	array(
		'title'      => esc_html__( 'Header Section', 'royal-magazine' ),
		'priority'   => 10,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_front_page_section',
	)
);
// Setting - show_top_section_date.
$wp_customize->add_setting( 'show_top_section_date',
	array(
		'default'           => $default['show_top_section_date'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'royal_magazine_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'show_top_section_date',
	array(
		'label'    => esc_html__( 'Enable Date On Top', 'royal-magazine' ),
		'section'  => 'top_section_settings',
		'type'     => 'checkbox',
		'priority' => 100,
	)
);
// Setting - show_navigation_collaps.
$wp_customize->add_setting( 'show_navigation_collaps',
	array(
		'default'           => $default['show_navigation_collaps'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'royal_magazine_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'show_navigation_collaps',
	array(
		'label'    		=> esc_html__( 'Enable navigation collapse', 'royal-magazine' ),
		'description'    => esc_html__( 'Navigation collapse will be shown with the popular post on the basis of comments', 'royal-magazine' ),
		'section' 		 => 'top_section_settings',
		'type'    		 => 'checkbox',
		'priority'		 => 140,
	)
);

// Setting - news_enable_top_bar.
$wp_customize->add_setting( 'news_enable_top_bar',
	array(
		'default'           => $default['news_enable_top_bar'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'royal_magazine_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'news_enable_top_bar',
	array(
		'label'    => esc_html__( 'Enable Top Bar', 'royal-magazine' ),
		'section'  => 'top_section_settings',
		'type'     => 'checkbox',
		'priority' => 90,

	)
);


// Setting - magazine_title_text_1.
$wp_customize->add_setting( 'magazine_title_text_1',
	array(
		'default'           => $default['magazine_title_text_1'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'magazine_title_text_1',
	array(
		'label'    => esc_html__( 'Tinker Title 1', 'royal-magazine' ),
		'description'    => esc_html__( 'This title will only appear on top tinker section first title. If you want to remove just make sure this field is empty', 'royal-magazine' ),
		'section'  => 'top_section_settings',
		'type'     => 'text',
		'priority' => 170,

	)
);

// Setting - magazine_title_text_2.
$wp_customize->add_setting( 'magazine_title_text_2',
	array(
		'default'           => $default['magazine_title_text_2'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'magazine_title_text_2',
	array(
		'label'    => esc_html__( 'Tinker Title 2', 'royal-magazine' ),
		'description'    => esc_html__( 'This title will only appear on top tinker section second title. If you want to remove just make sure this field is empty', 'royal-magazine' ),
		'section'  => 'top_section_settings',
		'type'     => 'text',
		'priority' => 170,

	)
);
// Setting - banner_title_post.
$wp_customize->add_setting( 'banner_title_post',
	array(
		'default'           => $default['banner_title_post'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'banner_title_post',
	array(
		'label'    => esc_html__( 'Banner Title', 'royal-magazine' ),
		'description'    => esc_html__( 'This title will only appear on latest post selection', 'royal-magazine' ),
		'section'  => 'header_image',
		'type'     => 'text',
		'priority' => 10,

	)
);
