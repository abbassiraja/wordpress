<?php
class SPAWP_Customizer_Sanitize {

	private static $instance;

	public static function get_instance() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	public function __construct() {
	}

	public static function sanitize_checkbox( $val ) {
		if ( '0' === $val || 'false' === $val ) {
			return false;
		}
		return (bool) $val;
	}

	public static function sanitize_alpha_color( $val ) {
		if ( '' === $val ) { return ''; }
		if ( is_string( $val ) && 'transparent' === trim( $val ) ) {
			return 'transparent';
		}
		if ( false === strpos( $val, 'rgba' ) ) {
			return sanitize_hex_color( $val );
		}
		$color = str_replace( ' ', '', $val );
		sscanf( $color, 'rgba(%d,%d,%d,%f)', $r, $g, $b, $a );
		return "rgba($r,$g,$b,$a)";
	}

	public static function sanitize_radio( $val, $setting ) {
		$val = sanitize_key( $val );
		$choices = $setting->manager->get_control( $setting->id )->choices;
		return array_key_exists( $val, $choices ) ? $val : $setting->default;
	}

	public static function sanitize_sortable( $input, $setting ) {
		// Get list of choices from the control
		// associated with the setting.
		$choices    = $setting->manager->get_control( $setting->id )->choices;
		$input_keys = $input;

		foreach ( $input_keys as $key => $value ) {
			if ( ! array_key_exists( $value, $choices ) ) {
					unset( $input[ $key ] );
			}
		}

		// If the input is a valid key, return it;
		// otherwise, return the default.
		return ( is_array( $input ) ? $input : $setting->default );
	}

	public static function sanitize_select( $input, $setting ){

	    //input must be a slug: lowercase alphanumeric characters, dashes and underscores are allowed only
	    $input = sanitize_key($input);

	    //get the list of possible select options
	    $choices = $setting->manager->get_control( $setting->id )->choices;

	    //return input if valid or return default option
	    return ( array_key_exists( $input, $choices ) ? $input : $setting->default );

	}

	public static function sanitize_variants( $input ) {
		if ( is_array( $input ) ) {
			$input = implode( ',', $input );
		}
		return sanitize_text_field( $input );
	}
}
SPAWP_Customizer_Sanitize::get_instance();