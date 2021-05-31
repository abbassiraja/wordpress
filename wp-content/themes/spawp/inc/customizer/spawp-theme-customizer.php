<?php
if ( !class_exists( 'Spawp_Theme_Customizer' ) ) :
	
	class Spawp_Theme_Customizer {
		
		public function __construct() {

			add_action( 'customize_register', array( $this, 'customizer_panel_control' ), 10 );
			add_action( 'customize_register', array( $this, 'customizer_register' ), 10 );
			add_action( 'customize_register', array( $this, 'customizer_selective_refresh' ), 10 );
			add_action( 'customize_preview_init', array( $this, 'customizer_preview_js' ), 10 );
			add_action( 'after_setup_theme', array( $this, 'customizer_settings' ), 10 );
			add_action( 'customize_controls_enqueue_scripts', array( $this, 'spawp_customizer_sections_script'), 10 );
		}

		public function customizer_panel_control( $wp_customize ) {

			/*** path ***/
			$customizer_dir = SPAWP_CUSTOMIZER_DIR;

			require SPAWP_CUSTOMIZER_DIR . '/additional-customizer-controls.php';
			$wp_customize->register_section_type( 'Spawp_Section_plus' );

			/*** Add customizer options extending classes ***/
			require $customizer_dir . '/core-custom-section-panel/spawp-custom-panel.php';
			require $customizer_dir . '/core-custom-section-panel/spawp-custom-section.php';

			/*** Register custom section panel ***/
			$wp_customize->register_panel_type( 'SPAWP_Custom_Panel' );
			$wp_customize->register_section_type( 'SPAWP_Custom_Section' );

			require_once( $customizer_dir . '/customizer-base/class/class-customize-base-control.php');
			require_once( $customizer_dir . '/customizer-toggle/class/class-customize-toggle.php');
			require_once( $customizer_dir . '/customizer-range/class/class-customize-range-value-control.php');
			require_once( $customizer_dir . '/customizer-tabs/class/class-customizer-tabs-control.php');
			require_once( $customizer_dir . '/customizer-alpha-color/class/class-customizer-alpha-color-control.php');
			require_once( $customizer_dir . '/customizer-category/class/class-customizer-category-control.php');

			$wp_customize->register_control_type( 'SPAWP_Customize_Toggle_Control' );
			$wp_customize->register_control_type( 'SPAWP_Customize_Range_Value_Control' );
			$wp_customize->register_control_type( 'SPAWP_Customize_Title_Control' );
			$wp_customize->register_section_type( 'SPAWP_Customize_Upgrade_Control' );
		}

		public function customizer_selective_refresh() {
			require_once SPAWP_CUSTOMIZER_DIR . '/spawp-customizer-sanitize.php';
			require_once SPAWP_CUSTOMIZER_DIR . '/spawp-customizer-partials.php';
		}

		public function customizer_register( $wp_customize ) {

			/*** Customizer selective ***/
			require SPAWP_CUSTOMIZER_DIR . '/spawp-customizer-selective.php';

			/*** Panels ***/
			require SPAWP_CUSTOMIZER_DIR . '/spawp-panels.php';

			/*** Sections ***/
			require SPAWP_CUSTOMIZER_DIR . '/spawp-sections.php';
		}

		public function customizer_preview_js() {
			wp_enqueue_script( 'spawp-customizer-preview', SPAWP_CUSTOMIZER_DIR_URI . 'customizer-base/js/customizer.js', array( 'customize-preview' ), 999, true );
		}

		public function customizer_settings() {
		}

		public function spawp_customizer_sections_script(){
			wp_enqueue_script( 'wp-color-picker-alpha', SPAWP_CUSTOMIZER_DIR_URI .'customizer-base/js/wp-color-picker-alpha.js', array( 'wp-color-picker'), '2.1.3', true  );
			$color_picker_strings = array(
				'clear'            => __( 'Clear', 'spawp' ),
				'clearAriaLabel'   => __( 'Clear color', 'spawp' ),
				'defaultString'    => __( 'Default', 'spawp' ),
				'defaultAriaLabel' => __( 'Select default color', 'spawp' ),
				'pick'             => __( 'Select Color', 'spawp' ),
				'defaultLabel'     => __( 'Color value', 'spawp' ),
			);
			wp_localize_script( 'wp-color-picker-alpha', 'wpColorPickerL10n', $color_picker_strings );
			wp_enqueue_script( 'wp-color-picker-alpha' );
			wp_enqueue_style( 'wp-color-picker' );

			wp_enqueue_script( 'spawp-customizer-sections-scroll-js', SPAWP_CUSTOMIZER_DIR_URI .'customizer-base/js/customizer-section.js', array(),'', true  );
		}
	}
endif;
new Spawp_Theme_Customizer();