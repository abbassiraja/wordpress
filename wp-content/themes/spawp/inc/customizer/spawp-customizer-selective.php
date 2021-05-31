<?php
$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

if ( isset( $wp_customize->selective_refresh ) ) {
	
	/*** site title ***/
	$wp_customize->selective_refresh->add_partial(
		'blogname',
		array(
			'selector'        => '.site-title',
			'render_callback' => array( 'SPAWP_Customizer_Partials', 'blogname' ),
		)
	);

    /*** site tagline ***/
	$wp_customize->selective_refresh->add_partial(
		'blogdescription',
		array(
			'selector'        => '.site-description',
			'render_callback' => array( 'SPAWP_Customizer_Partials', 'description' ),
		)
	);
}