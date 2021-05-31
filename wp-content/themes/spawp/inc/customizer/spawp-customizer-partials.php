<?php
if ( ! class_exists( 'SPAWP_Customizer_Partials' ) ) {

	class SPAWP_Customizer_Partials {

		private static $instance;

		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		public static function blogname() {
			return get_bloginfo( 'name' );
		}

		public static function description() {
			return get_bloginfo( 'description' );
		}

		public static function service_subtitle() {
			return spawp_get_option( 'service_subtitle' );
		}

		public static function service_title() {
			return spawp_get_option( 'service_title' );
		}

		public static function service_desc() {
			return spawp_get_option( 'service_desc' );
		}

		public static function feature_subtitle() {
			return spawp_get_option( 'feature_subtitle' );
		}

		public static function feature_title() {
			return spawp_get_option( 'feature_title' );
		}

		public static function feature_desc() {
			return spawp_get_option( 'service_desc' );
		}

		public static function testimonial_subtitle() {
			return spawp_get_option( 'testimonial_subtitle' );
		}

		public static function testimonial_title() {
			return spawp_get_option( 'testimonial_title' );
		}

		public static function testimonial_desc() {
			return spawp_get_option( 'testimonial_desc' );
		}

		public static function team_subtitle() {
			return spawp_get_option( 'team_subtitle' );
		}

		public static function team_title() {
			return spawp_get_option( 'team_title' );
		}

		public static function team_desc() {
			return spawp_get_option( 'team_desc' );
		}

		public static function blog_subtitle() {
			return spawp_get_option( 'blog_subtitle' );
		}

		public static function blog_title() {
			return spawp_get_option( 'blog_title' );
		}

		public static function blog_desc() {
			return spawp_get_option( 'blog_desc' );
		}

		public static function pricing_subtitle() {
			return spawp_get_option( 'pricing_subtitle' );
		}

		public static function pricing_title() {
			return spawp_get_option( 'pricing_title' );
		}

		public static function pricing_desc() {
			return spawp_get_option( 'pricing_desc' );
		}

		public static function client_subtitle() {
			return spawp_get_option( 'client_subtitle' );
		}

		public static function client_title() {
			return spawp_get_option( 'client_title' );
		}

		public static function client_desc() {
			return spawp_get_option( 'client_desc' );
		}
	}
}
SPAWP_Customizer_Partials::get_instance();

function spawp_get_range_slider_value($control_value){
	if( is_string( $control_value ) && is_array( json_decode( $control_value, true ) ) ){
    $json = json_decode( $control_value );
    	// This will return a array for media query like mobile, tablet and desktop
        return $json;
    } else {
        /* Media queries are disabled so it will return a simple value */
        return $control_value;
    }
}