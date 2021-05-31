<?php
class SPAWP_Custom_Base_Customize_Settings {

	protected $elements = array();

	protected $active_callback_old = array();

	protected $ac_arr_count = 0;

	private $count_evaluate = 0;

	protected $ac_default = array();

	public function __construct() {
		// Register customizer options.
		add_action( 'customize_register', array( $this, 'spawp_customizer_options' ) );
		// Get array of elements for particular class.
		$this->elements = $this->elements();

	}

	protected function get_menu_options() {
		$all_menus            = get_terms( array(
			'taxonomy'   => 'nav_menu',
			'hide_empty' => true,
		) );
		$menu_options         = array();
		$menu_options['none'] = esc_html__( 'None', 'spawp' );

		foreach ( $all_menus as $menu_item ) {
			$menu_options[ $menu_item->slug ] = esc_html( $menu_item->name );
		}

		return $menu_options;
	}

	public function spawp_customizer_options( $wp_customize ) {
		/*** Loop through array elements. ***/
		foreach ( $this->elements as $el_key => $el_data ) :

			/**
			 * Setting.
			 */
			$setting_args      = $el_data['setting'];
			$default           = isset( $setting_args['default'] ) ? $setting_args['default'] : '';
			$option_type       = isset( $el_data['setting']['type'] ) ? $el_data['setting']['type'] : 'theme_mod';
			$sanitize_callback = isset( $setting_args['sanitize_callback'] ) ? $setting_args['sanitize_callback'] : '';
			$transport = isset( $setting_args['transport'] ) ? $setting_args['transport'] : '';

			$wp_customize->add_setting(
				$el_key,
				array(
					'default'           => $default,
					'type'              => $option_type,
					'capability'        => 'edit_theme_options',
					'sanitize_callback' => $sanitize_callback,
					'transport' => $transport,
				)
			);

			/**
			 * Control.
			 */
			$control_args = $el_data['control'];
			$control_type = $control_args['type'];
			/*** Is custom control? ***/
			$is_custom_control       = ( isset( $control_args['is_default_type'] ) && true === $control_args['is_default_type'] ) ? $control_args['is_default_type'] : 0;
			$control_args['setting'] = $el_key;

			/*** If array provided for active callback modify it to function reference. ***/
			if ( isset( $control_args['active_callback'] ) && is_array( $control_args['active_callback'] ) ) {
				$this->active_callback_old[] = $control_args['active_callback'];
				$cb_setting_id = $this->active_callback_old[ $this->ac_arr_count ][0]['setting'];
				
				if ( 'spawp_pro' === substr( $cb_setting_id, 0, 9 ) && function_exists( 'spawp_pro_options' ) ) {
					$this->ac_default[] = $wp_customize->get_setting( 'spawp_pro_option[' . $cb_setting_id . ']' )->default;
				} else {
					$this->ac_default[] = $wp_customize->get_setting( $cb_setting_id )->default;
				}

				$control_args['active_callback'] = array( $this, 'evaluate' );
				$this->ac_arr_count++;
			}

			/*** If custom control, unset type and use object, else... ***/
			if ( ! $is_custom_control ) {
				unset( $control_args['type'] );
				$control_type_uc = implode( '_', array_map( 'ucfirst', explode( '_', $control_type ) ) );
				$control_type    = 'SPAWP_Customize_' . $control_type_uc . '_Control';
				$wp_customize->add_control( new $control_type( $wp_customize, $el_key, $control_args ) );
			} else {
				$wp_customize->add_control( $el_key, $control_args );
			}

		endforeach;

	}

	public function evaluate() {
		foreach ( $this->active_callback_old[ ( $this->count_evaluate ) ] as $count => $ruleset ) :

			$ac_setting_id = $ruleset['setting'];
			$operator      = $ruleset['operator'];

			if ( 'spawp_pro' === substr( $ac_setting_id, 0, 9 ) && function_exists( 'spawp_pro_options' ) ) {
				$option_val = spawp_pro_options( $ac_setting_id, 'text_html' );
			} else {
				$option_val = get_theme_mod( $ac_setting_id, 'text_html' );
			}
			$check_val = $ruleset['value'];

			switch ( $operator ) {
				case '===':
					$show[] = ( $option_val === $check_val ) ? true : false;
					break;
				case '==':
					$show[] = ( $option_val == $check_val ) ? true : false;
					break;

				case '!==':
					$show[] = ( $option_val !== $check_val ) ? true : false;
					break;

				case '!=':
					$show[] = ( $option_val != $check_val ) ? true : false;
					break;

				default:
					$show[] = ( $option_val == $check_val ) ? true : false;
					break;
			}

		endforeach;

		/*** Evaluate final result ***/
		if ( isset( $show ) ) {
			$this->count_evaluate++;
			foreach ( $show as $result ) {
				if ( ! $result ) {
					return false;
				}
			}
		}
		return true;
	}
}