<?php
if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return null;
}

define( 'SPAWP_ALPHA_VERSION', '1.0.0' );

class SPAWP_Customize_Alpha_Color_Control extends WP_Customize_Control {

	public $type = 'alpha-color';
	public $palette;
	public $show_opacity;

	public function enqueue() {
		wp_enqueue_script(
			'spawp-customizer-alpha-color-picker',
			get_template_directory_uri() . '/inc/customizer/customizer-alpha-color/js/alpha-color-picker.js',
			array( 'jquery', 'wp-color-picker' ),
			SPAWP_ALPHA_VERSION,
			true
		);
		wp_enqueue_style(
			'spawp-customizer-alpha-color-picker',
			get_template_directory_uri() . '/inc/customizer/customizer-alpha-color/css/alpha-color-picker.css',
			array( 'wp-color-picker' ),
			SPAWP_ALPHA_VERSION
		);
	}

	public function render_content() {
		// Process the palette
		if ( is_array( $this->palette ) ) {
			$palette = implode( '|', $this->palette );
		} else {
			// Default to true.
			$palette = ( false === $this->palette || 'false' === $this->palette ) ? 'false' : 'true';
		}
		// Support passing show_opacity as string or boolean. Default to true.
		$show_opacity = ( false === $this->show_opacity || 'false' === $this->show_opacity ) ? 'false' : 'true';
		// Begin the output. ?>
		<label>
			<?php
			// Output the label and description if they were passed in.
			if ( isset( $this->label ) && '' !== $this->label ) {
				echo '<span class="customize-control-title">' . sanitize_text_field( $this->label ) . '</span>';
			}
			if ( isset( $this->description ) && '' !== $this->description ) {
				echo '<span class="description customize-control-description">' . sanitize_text_field( $this->description ) . '</span>';
			}
			?>
			<input class="alpha-color-control" type="text" data-show-opacity="<?php echo esc_attr( $show_opacity ); ?>" data-palette="<?php echo esc_attr( $palette ); ?>" data-default-color="<?php echo esc_attr( $this->settings['default']->default ); ?>" <?php esc_attr( $this->link() ); ?>  />
		</label>
		<?php
	}
}