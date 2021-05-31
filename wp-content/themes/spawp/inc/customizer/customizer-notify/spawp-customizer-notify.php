<?php
class Spawp_Customizer_Notify {

	private $recommended_actions;

	
	private $recommended_plugins;

	
	private static $instance;

	
	private $recommended_actions_title;

	
	private $recommended_plugins_title;

	
	private $dismiss_button;

	
	private $install_button_label;

	
	private $activate_button_label;

	
	private $deactivate_button_label;

	
	public static function init( $config ) {
		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Spawp_Customizer_Notify ) ) {
			self::$instance = new Spawp_Customizer_Notify;
			if ( ! empty( $config ) && is_array( $config ) ) {
				self::$instance->config = $config;
				self::$instance->setup_config();
				self::$instance->setup_actions();
			}
		}

	}

	
	public function setup_config() {

		global $spawp_customizer_notify_recommended_plugins;
		global $spawp_customizer_notify_recommended_actions;

		global $install_button_label;
		global $activate_button_label;
		global $deactivate_button_label;

		$this->recommended_actions = isset( $this->config['recommended_actions'] ) ? $this->config['recommended_actions'] : array();
		$this->recommended_plugins = isset( $this->config['recommended_plugins'] ) ? $this->config['recommended_plugins'] : array();

		$this->recommended_actions_title = isset( $this->config['recommended_actions_title'] ) ? $this->config['recommended_actions_title'] : '';
		$this->recommended_plugins_title = isset( $this->config['recommended_plugins_title'] ) ? $this->config['recommended_plugins_title'] : '';
		$this->dismiss_button            = isset( $this->config['dismiss_button'] ) ? $this->config['dismiss_button'] : '';

		$spawp_customizer_notify_recommended_plugins = array();
		$spawp_customizer_notify_recommended_actions = array();

		if ( isset( $this->recommended_plugins ) ) {
			$spawp_customizer_notify_recommended_plugins = $this->recommended_plugins;
		}

		if ( isset( $this->recommended_actions ) ) {
			$spawp_customizer_notify_recommended_actions = $this->recommended_actions;
		}

		$install_button_label    = isset( $this->config['install_button_label'] ) ? $this->config['install_button_label'] : '';
		$activate_button_label   = isset( $this->config['activate_button_label'] ) ? $this->config['activate_button_label'] : '';
		$deactivate_button_label = isset( $this->config['deactivate_button_label'] ) ? $this->config['deactivate_button_label'] : '';

	}

	
	public function setup_actions() {

		// Register the section
		add_action( 'customize_register', array( $this, 'spawp_plugin_notification_customize_register' ) );

		// Enqueue scripts and styles
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'spawp_customizer_notify_scripts_for_customizer' ), 0 );

		/* ajax callback for dismissable recommended actions */
		add_action( 'wp_ajax_quality_customizer_notify_dismiss_action', array( $this, 'spawp_customizer_notify_dismiss_recommended_action_callback' ) );

		add_action( 'wp_ajax_ti_customizer_notify_dismiss_recommended_plugins', array( $this, 'spawp_customizer_notify_dismiss_recommended_plugins_callback' ) );

	}

	
	public function spawp_customizer_notify_scripts_for_customizer() {

		wp_enqueue_style( 'spawp-customizer-notify-css', get_template_directory_uri() . '/inc/customizer/customizer-notify/css/spawp-customizer-notify.css', array());

		wp_enqueue_style( 'plugin-install' );
		wp_enqueue_script( 'plugin-install' );
		wp_add_inline_script( 'plugin-install', 'var spawp_pagenow = "customizer";' );

		wp_enqueue_script( 'updates' );

		wp_enqueue_script( 'spawp-customizer-notify-js', get_template_directory_uri() . '/inc/customizer/customizer-notify/js/spawp-customizer-notify.js', array( 'customize-controls' ));
		wp_localize_script(
			'spawp-customizer-notify-js', 'SpawpCustomizercompanionObject', array(
				'ajaxurl'            => admin_url( 'admin-ajax.php' ),
				'template_directory' => get_template_directory_uri(),
				'base_path'          => admin_url(),
				'activating_string'  => __( 'Activating', 'spawp' ),
			)
		);

	}

	
	public function spawp_plugin_notification_customize_register( $wp_customize ) {

		
		require_once get_template_directory() . '/inc/customizer/customizer-notify/spawp-customizer-notify-section.php';

		$wp_customize->register_section_type( 'spawp_Customizer_Notify_Section' );

		$wp_customize->add_section(
			new spawp_Customizer_Notify_Section(
				$wp_customize,
				'spawp-customizer-notify-section',
				array(
					'title'          => $this->recommended_actions_title,
					'plugin_text'    => $this->recommended_plugins_title,
					'dismiss_button' => $this->dismiss_button,
					'priority'       => 0,
				)
			)
		);

	}

	
	public function spawp_customizer_notify_dismiss_recommended_action_callback() {

		global $spawp_customizer_notify_recommended_actions;

		$option = wp_parse_args(  get_option( 'spawp_option', array() ), spawp_theme_default_data() );

		$action_id = ( isset( $_GET['id'] ) ) ? $_GET['id'] : 0;

		echo $action_id; 

		if ( ! empty( $action_id ) ) {

			
			if ( $option['customizer_notify_show'] != '' ) {

				$spawp_customizer_notify_show_recommended_actions = $option['customizer_notify_show'];
				switch ( $_GET['todo'] ) {
					case 'add':
						$spawp_customizer_notify_show_recommended_actions[ $action_id ] = true;
						break;
					case 'dismiss':
						$spawp_customizer_notify_show_recommended_actions[ $action_id ] = false;
						break;
				}
				$option['customizer_notify_show'] = $spawp_customizer_notify_show_recommended_actions;
				update_option('spawp_option',$option);
				
			} else {
				$spawp_customizer_notify_show_recommended_actions = array();
				if ( ! empty( $spawp_customizer_notify_recommended_actions ) ) {
					foreach ( $spawp_customizer_notify_recommended_actions as $spawp_lite_customizer_notify_recommended_action ) {
						if ( $spawp_lite_customizer_notify_recommended_action['id'] == $action_id ) {
							$spawp_customizer_notify_show_recommended_actions[ $spawp_lite_customizer_notify_recommended_action['id'] ] = false;
						} else {
							$spawp_customizer_notify_show_recommended_actions[ $spawp_lite_customizer_notify_recommended_action['id'] ] = true;
						}
					}
					$option['customizer_notify_show'] = $spawp_customizer_notify_show_recommended_actions;
					update_option('spawp_option',$option);
				}
			}
		}
		die(); 
	}

	
	public function spawp_customizer_notify_dismiss_recommended_plugins_callback() {

		$action_id = ( isset( $_GET['id'] ) ) ? $_GET['id'] : 0;

		$option = wp_parse_args(  get_option( 'spawp_option', array() ), spawp_theme_default_data() );

		echo $action_id; 

		if ( ! empty( $action_id ) ) {

			$spawp_lite_customizer_notify_show_recommended_plugins = $option['customizer_notify_show_recommended_plugins'];

			switch ( $_GET['todo'] ) {
				case 'add':
					$spawp_lite_customizer_notify_show_recommended_plugins[ $action_id ] = false;
					break;
				case 'dismiss':
					$spawp_lite_customizer_notify_show_recommended_plugins[ $action_id ] = true;
					break;
			}
			$option['customizer_notify_show_recommended_plugins'] = $spawp_lite_customizer_notify_show_recommended_plugins;
			update_option('spawp_option',$option);
		}
		die(); 
	}

}
