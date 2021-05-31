<?php

function arimolite_sanitize_checkbox( $checked ) { 
    return ( ( isset( $checked ) && true == $checked ) ? true : false );
}

/** Customizer - Add Settings */
function arimolite_register_theme_customizer( $wp_customize )
{
    # Theme Options
    $wp_customize->add_panel('arimolite_panel', array('priority' => 1, 'capability'=> 'edit_theme_options', 'title' => esc_html__('ArimoLite Theme Options', 'arimolite') ));
    
	# Sections
    $wp_customize->add_section( 'arimolite_section_social_media', array( 'title' => esc_html__('Social Networks', 'arimolite'), 'panel' => 'arimolite_panel', 'priority' => 24 ) );
    $wp_customize->add_section( 'arimolite_section_footer', array('title' => esc_html__('Copyright Text', 'arimolite'), 'panel' => 'arimolite_panel', 'priority' => 25 ));
    
    # Site Title - Tagline
    $wp_customize->add_setting('arimolite_hide_tagline', array('default' => false, 'sanitize_callback' => 'arimolite_sanitize_checkbox'));
     $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'arimolite_hide_tagline',
            array(
                'label' => esc_html__('Hide Tagline?', 'arimolite'),
                'section' => 'title_tagline',
                'type' => 'checkbox'
            )
        )
    );

    /** Social Media */
    $wp_customize->add_setting('arimolite_facebook_url', array('default' => '', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_setting('arimolite_twitter_url', array('default' => '', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_setting('arimolite_instagram_url', array('default' => '', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_setting('arimolite_pinterest_url', array('default' => '', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_setting('arimolite_youtube_url', array('default' => '', 'sanitize_callback' => 'sanitize_text_field')); 
    $wp_customize->add_setting('arimolite_vimeo_url', array('default' => '', 'sanitize_callback' => 'sanitize_text_field'));
    
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'arimolite_facebook_url', array('label' => esc_html__('Facebook URL', 'arimolite'), 'section' => 'arimolite_section_social_media', 'settings' => 'arimolite_facebook_url', 'type' => 'text', 'priority' => 1)));
	$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'arimolite_twitter_url', array('label' => esc_html__('Twitter URL', 'arimolite'), 'section' => 'arimolite_section_social_media', 'settings' => 'arimolite_twitter_url', 'type' => 'text', 'priority' => 2)));
	$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'arimolite_instagram_url', array('label' => esc_html__('Instagram URL', 'arimolite'), 'section' => 'arimolite_section_social_media', 'settings' => 'arimolite_instagram_url', 'type' => 'text', 'priority' => 3)));
	$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'arimolite_pinterest_url', array('label' => esc_html__('Pinterest URL', 'arimolite'), 'section' => 'arimolite_section_social_media', 'settings' => 'arimolite_pinterest_url', 'type' => 'text', 'priority' => 4)));
	$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'arimolite_youtube_url', array('label' => esc_html__('Youtube URL', 'arimolite'), 'section' => 'arimolite_section_social_media', 'settings'  => 'arimolite_youtube_url', 'type' => 'text', 'priority' => 6)));
	$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'arimolite_vimeo_url', array('label' => esc_html__('Vimeo URL', 'arimolite'), 'section' => 'arimolite_section_social_media', 'settings' => 'arimolite_vimeo_url', 'type' => 'text', 'priority' => 7)));


    
    /** Footer */
    //Copyright
    $wp_customize->add_setting( 'arimolite_footer_copyright_text', array( 'default' => esc_html__('2019 Your copyright Text', 'arimolite'), 'sanitize_callback' => 'sanitize_text_field'));
    
    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'footer_copyright',
            array(
            'label' => esc_html__('Copyright Text', 'arimolite'), 
            'section' => 'arimolite_section_footer', 
            'settings' => 'arimolite_footer_copyright_text', 
            'type' => 'text'
        )
    ));
    
    /** Colors */
    $wp_customize->add_setting('arimolite_body_color', array('default' => esc_attr('#555'), 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_setting('arimolite_accent_color', array('default' => esc_attr('#84a220'), 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'arimolite_body_color', array('label' => esc_html__('Body Text Color', 'arimolite'), 'section' => 'colors', 'settings' => 'arimolite_body_color')));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'arimolite_accent_color', array('label' => esc_html__('Accent Color', 'arimolite'), 'section' => 'colors', 'settings' => 'arimolite_accent_color')));
}
add_action( 'customize_register', 'arimolite_register_theme_customizer' );
