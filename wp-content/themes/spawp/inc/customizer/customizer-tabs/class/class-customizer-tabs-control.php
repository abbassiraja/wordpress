<?php
class SPAWP_Customize_Tabs_Control extends SPAWP_Customize_Base_Control {

	public function __construct( WP_Customize_Manager $manager, $id, array $args = array() ) {
		parent::__construct( $manager, $id, $args );

		add_action( 'customize_preview_init', array( $this, 'partials_helper_script_enqueue' ) );

		if ( ! empty( $this->tabs ) ) {
			foreach ( $this->tabs as $value => $args ) {
				$this->controls[ $value ] = $args['controls'];
			}
		}
	}

	public $controls = array();

	public $type = 'interface-tabs';

	public $transport = 'postMessage';

	public $priority = -10;

	public $tabs;

	public function render_content() {
		/* If no tabs are provided, bail. */
		if ( empty( $this->tabs ) || ! $this->more_than_one_valid_tab() ) {
			return;
		}

		$output = '';
		$i      = 0;

		$output .= '<div class="tabs-control" id="input_' . esc_attr( $this->id ) . '">';
		foreach ( $this->tabs as $value => $args ) {
			if ( ! empty( $args['controls'] ) && ( $this->tab_has_controls( $args['controls'] ) ) ) {

				foreach ($args['controls'] as $key => $value) {
					$value = trim(str_replace('[', '-', $value),']');
					$args['controls'][$key] = $value;
				}
				$controls_attribute = json_encode( $args['controls'] );

				$output .= '<div class="customizer-tab">';

				$output .= '<input type="radio"';
				$output .= 'value="' . esc_attr( $value ) . '" ';
				$output .= 'name="' . esc_attr( "_customize-radio-{$this->id}" ) . '" ';
				$output .= 'id="' . esc_attr( "{$this->id}-{$value}" ) . '" ';
				$output .= 'data-controls="' . esc_attr( $controls_attribute ) . '" ';
				if ( $i === 0 ) {
					$output .= 'checked="true" ';
				}
				$i ++;
				$output .= '/><!-- /input -->';

				$label_classes = '';
				foreach ( $args['controls'] as $control_id ) {
					$label_classes .= esc_attr( $control_id . ' ' );
				}

				$output .= '<label class = "' . $label_classes . '" ';
				$output .= 'for="' . esc_attr( "{$this->id}-{$value}" ) . '">';
				if ( ! empty( $args['nicename'] ) ) {
					$output .= '<span class="screen-reader-text">' . esc_html( $args['nicename'] ) . '</span>';
				}
				if ( ! empty( $args['icon'] ) ) {
					$output .= '<i class="fa fa-' . esc_attr( $args['icon'] ) . '"></i>';
				}
				if ( ! empty( $args['nicename'] ) ) {
					$output .= $args['nicename'];
				}
				$output .= '</label>';
				$output .= '</div>';
			}
		}
		$output .= '</div>';

		echo $output;
	}

	public function enqueue() {

		if ( empty( $this->tabs ) || ! $this->more_than_one_valid_tab() ) {
			return;
		}

		wp_enqueue_script( 'spawp-tabs-control-script', get_template_directory_uri() . '/inc/customizer/customizer-tabs/js/script.js', array( 'jquery' ),'1.0',true );
		wp_enqueue_style( 'spawp-tabs-control-style', get_template_directory_uri() . '/inc/customizer/customizer-tabs/css/tab-style.css' );

	}

	public function partials_helper_script_enqueue() {
		wp_enqueue_script( 'spawp-tabs-addon-script', get_template_directory_uri() . '/inc/customizer/customizer-tabs/js/customizer-addon-script.js', array( 'jquery' ),'1.0',true);
	}

	protected final function tab_has_controls( $controls_array ) {
		$i = 0;
		foreach ( $controls_array as $control ) {
			$setting = $this->manager->get_setting( $control );
			if ( ! empty( $setting ) ) {
				$i++;
			}
		}
		if ( $i === 0 ) {
			return false;
		}
		return true;
	}

	protected final function more_than_one_valid_tab() {
		$i = 0;
		foreach ( $this->tabs as $tab ) {
			if ( $this->tab_has_controls( $tab['controls'] ) ) {
				$i++;
			}
		}
		if ( $i > 1 ) {
			return true;
		}
		return false;
	}
}


class SPAWP_Customize_Title_Control extends SPAWP_Customize_Base_Control {
	public $type = 'spawp-customizer-title';
	public $title = '';
	
	public function enqueue() {
		$theme = wp_get_theme();
		$theme_version = $theme->get( 'Version' );
		wp_enqueue_style( 'spawp-title-customize-control', get_template_directory_uri() . '/inc/customizer/customizer-tabs/css/title-customizer.css', array(), $theme_version );
	}

	public function to_json() {
		parent::to_json();
		$this->json[ 'title' ] = esc_html( $this->title );
	}
	
	public function content_template() {
		?>
		<div class="spawp-customizer-title">
			<span>{{ data.title }}</span>
		</div>
		<?php
	}
}