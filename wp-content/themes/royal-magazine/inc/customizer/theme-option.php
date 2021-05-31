<?php 

/**
 * Theme Options Panel.
 *
 * @package royal-magazine
 */

$default = royal_magazine_get_default_theme_options();

// Add Theme Options Panel.
$wp_customize->add_panel( 'theme_option_panel',
	array(
		'title'      => esc_html__( 'Theme Options', 'royal-magazine' ),
		'priority'   => 200,
		'capability' => 'edit_theme_options',
	)
);

$wp_customize->add_section( 'theme_option_header_settings',
	array(
		'title'      => esc_html__( 'Header Setting', 'royal-magazine' ),
		'priority'   => 100,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_option_panel',
	)
);

/*Home Page Layout*/
$wp_customize->add_setting( 'enable_header_search',
	array(
		'default'           => $default['enable_header_search'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'royal_magazine_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'enable_header_search',
	array(
		'label'    => esc_html__( 'Enable Header Search', 'royal-magazine' ),
		'section'  => 'theme_option_header_settings',
		'type'     => 'checkbox',

	)
);

/*layout management section start */
$wp_customize->add_section( 'theme_option_section_settings',
	array(
		'title'      => esc_html__( 'Layout Management', 'royal-magazine' ),
		'priority'   => 100,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_option_panel',
	)
);

/*Home Page Layout*/
$wp_customize->add_setting( 'home_page_content_status',
	array(
		'default'           => $default['home_page_content_status'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'royal_magazine_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'home_page_content_status',
	array(
		'label'    => esc_html__( 'Enable Static Page Content', 'royal-magazine' ),
		'section'  => 'theme_option_section_settings',
		'type'     => 'checkbox',
		'priority' => 150,
	)
);

/*Home Page Layout*/
$wp_customize->add_setting( 'enable_overlay_option',
	array(
		'default'           => $default['enable_overlay_option'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'royal_magazine_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'enable_overlay_option',
	array(
		'label'    => esc_html__( 'Enable Banner Overlay', 'royal-magazine' ),
		'section'  => 'theme_option_section_settings',
		'type'     => 'checkbox',
		'priority' => 150,
	)
);


/*Home Page Layout*/
$wp_customize->add_setting( 'homepage_layout_option',
	array(
		'default'           => $default['homepage_layout_option'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'royal_magazine_sanitize_select',
	)
);
$wp_customize->add_control( 'homepage_layout_option',
	array(
		'label'    => esc_html__( 'Home Page Layout', 'royal-magazine' ),
		'section'  => 'theme_option_section_settings',
		'choices'  => array(
                'full-width' => esc_html__( 'Full Width', 'royal-magazine' ),
                'boxed' => esc_html__( 'Boxed', 'royal-magazine' ),
		    ),
		'type'     => 'select',
		'priority' => 160,
	)
);

/*Global Layout*/
$wp_customize->add_setting( 'global_layout',
	array(
		'default'           => $default['global_layout'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'royal_magazine_sanitize_select',
	)
);
$wp_customize->add_control( 'global_layout',
	array(
		'label'    => esc_html__( 'Global Layout', 'royal-magazine' ),
		'section'  => 'theme_option_section_settings',
		'choices'               => array(
                'right-sidebar' => esc_html__( 'Content - Primary Sidebar', 'royal-magazine' ),
                'left-sidebar' => esc_html__( 'Primary Sidebar - Content', 'royal-magazine' ),
                'no-sidebar' => esc_html__( 'No Sidebar', 'royal-magazine' )
		    ),
		'type'     => 'select',
		'priority' => 170,
	)
);


/*content excerpt in global*/
$wp_customize->add_setting( 'excerpt_length_global',
	array(
		'default'           => $default['excerpt_length_global'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'royal_magazine_sanitize_positive_integer',
	)
);
$wp_customize->add_control( 'excerpt_length_global',
	array(
		'label'    => esc_html__( 'Set Global Archive Length', 'royal-magazine' ),
		'section'  => 'theme_option_section_settings',
		'type'     => 'number',
		'priority' => 175,
		'input_attrs'     => array( 'min' => 0, 'max' => 200, 'style' => 'width: 150px;' ),

	)
);

// Setting - read_more_button_text.
$wp_customize->add_setting( 'read_more_button_text',
    array(
        'default'           => $default['read_more_button_text'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'read_more_button_text',
    array(
        'label'    => esc_html__( 'Read More Button Text', 'royal-magazine' ),
        'section'  => 'theme_option_section_settings',
        'type'     => 'text',
        'priority' => 175,
    )
);
/*Archive Layout text*/
$wp_customize->add_setting( 'archive_layout',
	array(
		'default'           => $default['archive_layout'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'royal_magazine_sanitize_select',
	)
);
$wp_customize->add_control( 'archive_layout',
	array(
		'label'    => esc_html__( 'Archive Layout', 'royal-magazine' ),
		'section'  => 'theme_option_section_settings',
		'choices'               => array(
			'excerpt-only' => esc_html__( 'Excerpt Only', 'royal-magazine' ),
			'full-post' => esc_html__( 'Full Post', 'royal-magazine' ),
		    ),
		'type'     => 'select',
		'priority' => 180,
	)
);

/*Archive Layout image*/
$wp_customize->add_setting( 'archive_layout_image',
	array(
		'default'           => $default['archive_layout_image'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'royal_magazine_sanitize_select',
	)
);
$wp_customize->add_control( 'archive_layout_image',
	array(
		'label'    => esc_html__( 'Archive Image Alocation', 'royal-magazine' ),
		'section'  => 'theme_option_section_settings',
		'choices'               => array(
			'full' => esc_html__( 'Full', 'royal-magazine' ),
			'right' => esc_html__( 'Right', 'royal-magazine' ),
			'left' => esc_html__( 'Left', 'royal-magazine' ),
			'no-image' => esc_html__( 'No image', 'royal-magazine' )
		    ),
		'type'     => 'select',
		'priority' => 185,
	)
);

/*single post Layout image*/
$wp_customize->add_setting( 'single_post_image_layout',
	array(
		'default'           => $default['single_post_image_layout'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'royal_magazine_sanitize_select',
	)
);
$wp_customize->add_control( 'single_post_image_layout',
	array(
		'label'    => esc_html__( 'Single Post/Page Image Alocation', 'royal-magazine' ),
		'section'  => 'theme_option_section_settings',
		'choices'               => array(
			'full' => esc_html__( 'Full', 'royal-magazine' ),
			'right' => esc_html__( 'Right', 'royal-magazine' ),
			'left' => esc_html__( 'Left', 'royal-magazine' ),
			'no-image' => esc_html__( 'No image', 'royal-magazine' )
		    ),
		'type'     => 'select',
		'priority' => 190,
	)
);


// Pagination Section.
$wp_customize->add_section( 'pagination_section',
	array(
	'title'      => esc_html__( 'Pagination Options', 'royal-magazine' ),
	'priority'   => 110,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_option_panel',
	)
);

// Setting pagination_type.
$wp_customize->add_setting( 'pagination_type',
	array(
	'default'           => $default['pagination_type'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'royal_magazine_sanitize_select',
	)
);
$wp_customize->add_control( 'pagination_type',
	array(
	'label'       => esc_html__( 'Pagination Type', 'royal-magazine' ),
	'section'     => 'pagination_section',
	'type'        => 'select',
	'choices'               => array(
		'default' => esc_html__( 'Default (Older / Newer Post)', 'royal-magazine' ),
		'numeric' => esc_html__( 'Numeric', 'royal-magazine' ),
	    ),
	'priority'    => 100,
	)
);



// Footer Section.
$wp_customize->add_section( 'footer_section',
	array(
	'title'      => esc_html__( 'Footer Options', 'royal-magazine' ),
	'priority'   => 130,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_option_panel',
	)
);


// Setting social_content_heading.
$wp_customize->add_setting( 'number_of_footer_widget',
	array(
	'default'           => $default['number_of_footer_widget'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'royal_magazine_sanitize_select',
	)
);
$wp_customize->add_control( 'number_of_footer_widget',
	array(
	'label'    => esc_html__( 'Number Of Footer Widget', 'royal-magazine' ),
	'section'  => 'footer_section',
	'type'     => 'select',
	'priority' => 100,
	'choices'               => array(
		0 => esc_html__( 'Disable footer sidebar area', 'royal-magazine' ),
		1 => esc_html__( '1', 'royal-magazine' ),
		2 => esc_html__( '2', 'royal-magazine' ),
		3 => esc_html__( '3', 'royal-magazine' ),
	    ),
	)
);

// Setting copyright_text.
$wp_customize->add_setting( 'copyright_text',
	array(
	'default'           => $default['copyright_text'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'copyright_text',
	array(
	'label'    => esc_html__( 'Footer Copyright Text', 'royal-magazine' ),
	'section'  => 'footer_section',
	'type'     => 'text',
	'priority' => 120,
	)
);

$wp_customize->add_setting( 'enable_footer_scroll_top',
	array(
		'default'           => $default['enable_footer_scroll_top'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'royal_magazine_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'enable_footer_scroll_top',
	array(
		'label'    => esc_html__( 'Enable Scroll To Top Button', 'royal-magazine' ),
		'section'  => 'footer_section',
		'type'     => 'checkbox',

	)
);


// Breadcrumb Section.
$wp_customize->add_section( 'breadcrumb_section',
	array(
	'title'      => esc_html__( 'Breadcrumb Options', 'royal-magazine' ),
	'priority'   => 120,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_option_panel',
	)
);

// Setting breadcrumb_type.
$wp_customize->add_setting( 'breadcrumb_type',
	array(
	'default'           => $default['breadcrumb_type'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'royal_magazine_sanitize_select',
	)
);
$wp_customize->add_control( 'breadcrumb_type',
	array(
	'label'       => esc_html__( 'Breadcrumb Type', 'royal-magazine' ),
	'description' => sprintf( esc_html__( 'Advanced: Requires %1$sBreadcrumb NavXT%2$s plugin', 'royal-magazine' ), '<a href="https://wordpress.org/plugins/breadcrumb-navxt/" target="_blank">','</a>' ),
	'section'     => 'breadcrumb_section',
	'type'        => 'select',
	'choices'               => array(
		'disabled' => esc_html__( 'Disabled', 'royal-magazine' ),
		'simple' => esc_html__( 'Simple', 'royal-magazine' ),
		'advanced' => esc_html__( 'Advanced', 'royal-magazine' ),
	    ),
	'priority'    => 100,
	)
);

// Pre loader Section.
$wp_customize->add_section( 'preloader_section',
	array(
	'title'      => esc_html__( 'Preloader Options', 'royal-magazine' ),
	'priority'   => 125,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_option_panel',
	)
);

// Setting enable_preloader_option.
$wp_customize->add_setting( 'enable_preloader_option',
	array(
	'default'           => $default['enable_preloader_option'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'royal_magazine_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'enable_preloader_option',
	array(
		'label'    => esc_html__( 'Enable Preloader', 'royal-magazine' ),
		'section'  => 'preloader_section',
		'type'     => 'checkbox',
		'priority' => 150,
	)
);

$wp_customize->add_section('single_post_setting',
	array(
		'title'      => esc_html__('Single Posts', 'royal-magazine'),
		'priority'   => 120,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_option_panel',
	)
);
$wp_customize->add_setting('ed_floating_next_previous_nav',
    array(
        'default' => $default['ed_floating_next_previous_nav'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'royal_magazine_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_floating_next_previous_nav',
    array(
        'label' => esc_html__('Enable Fixed Floating Next/Previous Articles', 'royal-magazine'),
        'section' => 'single_post_setting',
        'type' => 'checkbox',
    )
);