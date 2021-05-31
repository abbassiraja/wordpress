<?php
class SPAWP_Customize_Base_Control extends WP_Customize_Control {

	public function enqueue() {

		// Color picker alpha.
		wp_enqueue_script( 'wp-color-picker-alpha', SPAWP_CUSTOMIZER_DIR_URI . 'customizer-base/js/wp-color-picker-alpha.js', array( 'wp-color-picker' ), '2.1.3', true );
		
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

		// Scripts for nesting panel/section.
		wp_enqueue_script( 'spawp-extend-customizer', SPAWP_CUSTOMIZER_DIR_URI . 'customizer-base/js/extend-customizer.js', array( 'jquery' ), false, true );
		wp_enqueue_style( 'spawp-extend-customizer', SPAWP_CUSTOMIZER_DIR_URI . 'customizer-base/css/extend-customizer.css' );
	}

	public function to_json() {

		parent::to_json();

		$this->json['default'] = $this->setting->default;
		if ( isset( $this->default ) ) {
			$this->json['default'] = $this->default;
		}

		$this->json['id']      = $this->id;
		$this->json['value']   = $this->value();
		$this->json['choices'] = $this->choices;
		$this->json['link']    = $this->get_link();
		$this->json['l10n']    = $this->l10n();

		$this->json['inputAttrs'] = '';
		foreach ( $this->input_attrs as $attr => $value ) {
			$this->json['inputAttrs'] .= $attr . '="' . esc_attr( $value ) . '" ';
		}

	}

	protected function render_content() {
	}

	protected function content_template() {
	}

	protected function l10n() {
		return array();
	}

}