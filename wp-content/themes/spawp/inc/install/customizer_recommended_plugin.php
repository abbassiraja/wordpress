<?php
require get_template_directory() . '/inc/customizer/customizer-notify/spawp-customizer-notify.php';
$config_customizer = array(
	'recommended_plugins'       => array(
		'britetechs-companion' => array(
			'recommended' => true,
			'description' => sprintf('Install and activate <strong>Britetechs Companion</strong> plugin for taking full advantage of all the features this theme has to offer %s.', 'spawp'),
		),
	),
	'recommended_actions'       => array(),
	'recommended_actions_title' => esc_html__( 'Recommended Actions', 'spawp' ),
	'recommended_plugins_title' => esc_html__( 'Recommended Plugin', 'spawp' ),
	'install_button_label'      => esc_html__( 'Install and Activate', 'spawp' ),
	'activate_button_label'     => esc_html__( 'Activate', 'spawp' ),
	'deactivate_button_label'   => esc_html__( 'Deactivate', 'spawp' ),
);
Spawp_Customizer_Notify::init( apply_filters( 'spawp_customizer_notify_array', $config_customizer ) );