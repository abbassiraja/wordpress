<?php
/**
 * fmuzz functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 */

/**
 * Set a constant that holds the theme's minimum supported PHP version.
 */
define( 'FMUZZ_MIN_PHP_VERSION', '5.6' );

/**
 * Immediately after theme switch is fired we we want to check php version and
 * revert to previously active theme if version is below our minimum.
 */
add_action( 'after_switch_theme', 'fmuzz_test_for_min_php' );

/**
 * Switches back to the previous theme if the minimum PHP version is not met.
 */
function fmuzz_test_for_min_php() {

	// Compare versions.
	if ( version_compare( PHP_VERSION, FMUZZ_MIN_PHP_VERSION, '<' ) ) {
		// Site doesn't meet themes min php requirements, add notice...
		add_action( 'admin_notices', 'fmuzz_min_php_not_met_notice' );
		// ... and switch back to previous theme.
		switch_theme( get_option( 'theme_switched' ) );
		return false;

	};
}

if ( ! function_exists( 'wp_body_open' ) ) {
        function wp_body_open() {
                do_action( 'wp_body_open' );
        }
}

/**
 * An error notice that can be displayed if the Minimum PHP version is not met.
 */
function fmuzz_min_php_not_met_notice() {
	?>
	<div class="notice notice-error is_dismissable">
		<p>
			<?php esc_html_e( 'You need to update your PHP version to run this theme.', 'fmuzz' ); ?> <br />
			<?php
			printf(
				/* translators: 1 is the current PHP version string, 2 is the minmum supported php version string of the theme */
				esc_html__( 'Actual version is: %1$s, required version is: %2$s.', 'fmuzz' ),
				PHP_VERSION,
				FMUZZ_MIN_PHP_VERSION
			); // phpcs: XSS ok.
			?>
		</p>
	</div>
	<?php
}


if ( ! function_exists( 'fmuzz_setup' ) ) :
	/**
	 * fmuzz setup.
	 *
	 * Set up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support post thumbnails.
	 *
	 */
	function fmuzz_setup() {

		/*
		 * Make theme available for translation.
		 *
		 * Translations can be filed in the /languages/ directory
		 *
		 * If you're building a theme based on fmuzz, use a find and replace
		 * to change 'fmuzz' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'fmuzz', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

	

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Add support for Block Styles.
		add_theme_support( 'wp-block-styles' );

		add_theme_support( 'editor-styles' );

		/*
		 * This theme styles the visual editor to resemble the theme style,
		 * specifically font, colors, and column width.
	 	 */
		add_editor_style( array( 'css/editor-style.css', 
								 get_template_directory_uri() . '/css/font-awesome.css',
								 fmuzz_fonts_url()
						  ) );

		/*
		 * Set Custom Background
		 */				 
		add_theme_support( 'custom-background', array ('default-color'  => '#ffffff') );

		// Set the default content width.
		$GLOBALS['content_width'] = 900;

		// This theme uses wp_nav_menu() in header menu
		register_nav_menus( array(
			'primary'   => __( 'Primary Menu', 'fmuzz' ),
		) );

		$defaults = array(
	        'flex-height' => false,
	        'flex-width'  => false,
	        'header-text' => array( 'site-title', 'site-description' ),
	    );
	    add_theme_support( 'custom-logo', $defaults );

	    // add WooCommerce support
		add_theme_support( 'woocommerce' );
	}
endif; // fmuzz_setup
add_action( 'after_setup_theme', 'fmuzz_setup' );

if ( ! function_exists( 'fmuzz_fonts_url' ) ) :
	/**
	 *	Load google font url used in the fmuzz theme
	 */
	function fmuzz_fonts_url() {

	    $fonts_url = '';
	 
	    /* Translators: If there are characters in your language that are not
	    * supported by Arimo, translate this to 'off'. Do not translate
	    * into your own language.
	    */
	    $questrial = _x( 'on', 'Arimo font: on or off', 'fmuzz' );

	    if ( 'off' !== $questrial ) {
	        $font_families = array();
	 
	        $font_families[] = 'Arimo';
	 
	        $query_args = array(
	            'family' => urlencode( implode( '|', $font_families ) ),
	            'subset' => urlencode( 'latin,latin-ext' ),
	        );
	 
	        $fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
	    }
	 
	    return $fonts_url;
	}
endif; // fmuzz_fonts_url

if ( ! function_exists( 'fmuzz_load_scripts' ) ) :
	/**
	 * the main function to load scripts in the fmuzz theme
	 * if you add a new load of script, style, etc. you can use that function
	 * instead of adding a new wp_enqueue_scripts action for it.
	 */
	function fmuzz_load_scripts() {

		// load main stylesheet.
		wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.css', array( ) );
		wp_enqueue_style( 'fmuzz-style', get_stylesheet_uri(), array() );
		
		wp_enqueue_style( 'fmuzz-fonts', fmuzz_fonts_url(), array(), null );
		
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
		
		// Load Utilities JS Script
		wp_enqueue_script( 'fmuzz-utilities',
			get_template_directory_uri() . '/js/utilities.js', array( 'jquery', ) );
	}
endif; // fmuzz_load_scripts
add_action( 'wp_enqueue_scripts', 'fmuzz_load_scripts' );

if ( ! function_exists( 'fmuzz_widgets_init' ) ) :
	/**
	 *	widgets-init action handler. Used to register widgets and register widget areas
	 */
	function fmuzz_widgets_init() {

		// Register Footer Column #1
		register_sidebar( array (
								'name'			 =>  __( 'Footer Column #1', 'fmuzz' ),
								'id' 			 =>  'footer-column-1-widget-area',
								'description'	 =>  __( 'The Footer Column #1 widget area', 'fmuzz' ),
								'before_widget'  =>  '',
								'after_widget'	 =>  '',
								'before_title'	 =>  '<h2 class="footer-title">',
								'after_title'	 =>  '</h2><div class="footer-after-title"></div>',
							) );
		
		// Register Footer Column #2
		register_sidebar( array (
								'name'			 =>  __( 'Footer Column #2', 'fmuzz' ),
								'id' 			 =>  'footer-column-2-widget-area',
								'description'	 =>  __( 'The Footer Column #2 widget area', 'fmuzz' ),
								'before_widget'  =>  '',
								'after_widget'	 =>  '',
								'before_title'	 =>  '<h2 class="footer-title">',
								'after_title'	 =>  '</h2><div class="footer-after-title"></div>',
							) );
		
		// Register Footer Column #3
		register_sidebar( array (
								'name'			 =>  __( 'Footer Column #3', 'fmuzz' ),
								'id' 			 =>  'footer-column-3-widget-area',
								'description'	 =>  __( 'The Footer Column #3 widget area', 'fmuzz' ),
								'before_widget'  =>  '',
								'after_widget'	 =>  '',
								'before_title'	 =>  '<h2 class="footer-title">',
								'after_title'	 =>  '</h2><div class="footer-after-title"></div>',
							) );
	}
endif; // fmuzz_widgets_init
add_action( 'widgets_init', 'fmuzz_widgets_init' );

if ( ! function_exists( 'fmuzz_show_copyright_text' ) ) :
	/**
	 *	Displays the copyright text.
	 */
	function fmuzz_show_copyright_text() {

		$footerText = get_theme_mod('fmuzz_footer_copyright', null);

		if ( !empty( $footerText ) ) {

			echo esc_html( $footerText ) . ' | ';		
		}
	}
endif; // fmuzz_show_copyright_text


if ( ! function_exists( 'fmuzz_custom_header_setup' ) ) :
  /**
   * Set up the WordPress core custom header feature.
   *
   * @uses fmuzz_header_style()
   */
  function fmuzz_custom_header_setup() {

  	add_theme_support( 'custom-header', array (
                         'default-image'          => '%s/img/header-image.jpg',
                         'flex-height'            => true,
                         'flex-width'             => true,
                         'uploads'                => true,
                         'width'                  => 1200,
                         'height'                 => 560,
                         'default-text-color'     => '#434343',
                         'wp-head-callback'       => 'fmuzz_header_style',
                      ) );
  }
endif; // fmuzz_custom_header_setup
add_action( 'after_setup_theme', 'fmuzz_custom_header_setup' );


if ( ! function_exists( 'fmuzz_show_social_sites' ) ) :

	function fmuzz_show_social_sites() {

		$socialURL = get_theme_mod('fmuzz_social_facebook');
		if ( !empty($socialURL) ) {

			echo '<li><a href="' . esc_url( $socialURL ) . '" title="' . __('Follow us on Facebook', 'fmuzz') . '" class="facebook16"></a></li>';
		}

		$socialURL = get_theme_mod('fmuzz_social_twitter');
		if ( !empty($socialURL) ) {

			echo '<li><a href="' . esc_url( $socialURL ) . '" title="' . __('Follow us on Twitter', 'fmuzz') . '" class="twitter16"></a></li>';
		}

		$socialURL = get_theme_mod('fmuzz_social_linkedin');
		if ( !empty($socialURL) ) {

			echo '<li><a href="' . esc_url( $socialURL ) . '" title="' . __('Follow us on LinkedIn', 'fmuzz') . '" class="linkedin16"></a></li>';
		}

		$socialURL = get_theme_mod('fmuzz_social_instagram');
		if ( !empty($socialURL) ) {

			echo '<li><a href="' . esc_url( $socialURL ) . '" title="' . __('Follow us on Instagram', 'fmuzz') . '" class="instagram16"></a></li>';
		}

		$socialURL = get_theme_mod('fmuzz_social_rss');
		if ( !empty($socialURL) ) {

			echo '<li><a href="' . esc_url( $socialURL ) . '" title="' . __('Follow our RSS Feeds', 'fmuzz') . '" class="rss16"></a></li>';
		}

		$socialURL = get_theme_mod('fmuzz_social_tumblr');
		if ( !empty($socialURL) ) {

			echo '<li><a href="' . esc_url( $socialURL ) . '" title="' . __('Follow us on Tumblr', 'fmuzz') . '" class="tumblr16"></a></li>';
		}

		$socialURL = get_theme_mod('fmuzz_social_youtube');
		if ( !empty($socialURL) ) {

			echo '<li><a href="' . esc_url( $socialURL ) . '" title="' . __('Follow us on Youtube', 'fmuzz') . '" class="youtube16"></a></li>';
		}

		$socialURL = get_theme_mod('fmuzz_social_pinterest');
		if ( !empty($socialURL) ) {

			echo '<li><a href="' . esc_url( $socialURL ) . '" title="' . __('Follow us on Pinterest', 'fmuzz') . '" class="pinterest16"></a></li>';
		}

		$socialURL = get_theme_mod('fmuzz_social_vk');
		if ( !empty($socialURL) ) {

			echo '<li><a href="' . esc_url( $socialURL ) . '" title="' . __('Follow us on VK', 'fmuzz') . '" class="vk16"></a></li>';
		}

		$socialURL = get_theme_mod('fmuzz_social_flickr');
		if ( !empty($socialURL) ) {

			echo '<li><a href="' . esc_url( $socialURL ) . '" title="' . __('Follow us on Flickr', 'fmuzz') . '" class="flickr16"></a></li>';
		}

		$socialURL = get_theme_mod('fmuzz_social_vine');
		if ( !empty($socialURL) ) {

			echo '<li><a href="' . esc_url( $socialURL ) . '" title="' . __('Follow us on Vine', 'fmuzz') . '" class="vine16"></a></li>';
		}
	}

endif; // fmuzz_show_social_sites

if ( ! function_exists( 'fmuzz_header_style' ) ) :

  /**
   * Styles the header image and text displayed on the blog.
   *
   * @see fmuzz_custom_header_setup().
   */
  function fmuzz_header_style() {

  	$header_text_color = get_header_textcolor();

      if ( ! has_header_image()
          && ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color
               || 'blank' === $header_text_color ) ) {

          return;
      }

      $headerImage = get_header_image();
  ?>
      <style id="fmuzz-custom-header-styles" type="text/css">

      	  <?php if ( has_post_thumbnail() ) { ?>

      	  			#page-header {background-image: url("<?php echo esc_url( get_the_post_thumbnail_url( get_the_id(), 'full' ) ); ?>");}

      	  <?php } else if ( has_header_image() ) { ?>

                  #page-header {background-image: url("<?php echo esc_url( $headerImage ); ?>");}

          <?php } ?>

          <?php if ( get_theme_support( 'custom-header', 'default-text-color' ) !== $header_text_color
                      && 'blank' !== $header_text_color ) : ?>

                  #page-header, #page-header h1.entry-title {color: #<?php echo sanitize_hex_color_no_hash( $header_text_color ); ?>;}

          <?php endif; ?>
      </style>
  <?php
  }
endif; // End of fmuzz_header_style.

if ( class_exists('WP_Customize_Section') ) {
	class fmuzz_Customize_Section_Pro extends WP_Customize_Section {

		// The type of customize section being rendered.
		public $type = 'fmuzz';

		// Custom button text to output.
		public $pro_text = '';

		// Custom pro button URL.
		public $pro_url = '';

		// Add custom parameters to pass to the JS via JSON.
		public function json() {
			$json = parent::json();

			$json['pro_text'] = $this->pro_text;
			$json['pro_url']  = esc_url( $this->pro_url );

			return $json;
		}

		// Outputs the template
		protected function render_template() {
?>

			<li id="accordion-section-{{ data.id }}" class="accordion-section control-section control-section-{{ data.type }} cannot-expand">

				<h3 class="accordion-section-title">
					{{ data.title }}

					<# if ( data.pro_text && data.pro_url ) { #>
						<a href="{{ data.pro_url }}" class="button button-primary alignright" target="_blank">{{ data.pro_text }}</a>
					<# } #>
				</h3>
			</li>
		<?php }
	}
}

/**
 * Singleton class for handling the theme's customizer integration.
 */
final class fmuzz_Customize {

	// Returns the instance.
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	// Constructor method.
	private function __construct() {}

	// Sets up initial actions.
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	// Sets up the customizer sections.
	public function sections( $manager ) {

		// Load custom sections.

		// Register custom section types.
		$manager->register_section_type( 'fmuzz_Customize_Section_Pro' );

		// Register sections.
		$manager->add_section(
			new fmuzz_Customize_Section_Pro(
				$manager,
				'fmuzz',
				array(
					'title'    => esc_html__( 'tMuzz', 'fmuzz' ),
					'pro_text' => esc_html__( 'Upgrade to Pro', 'fmuzz' ),
					'pro_url'  => esc_url( 'https://tishonator.com/product/tmuzz' )
				)
			)
		);
	}

	// Loads theme customizer CSS.
	public function enqueue_control_scripts() {

		wp_enqueue_script( 'fmuzz-customize-controls', trailingslashit( get_template_directory_uri() ) . 'js/customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'fmuzz-customize-controls', trailingslashit( get_template_directory_uri() ) . 'css/customize-controls.css' );
	}
}

if ( ! function_exists( 'fmuzz_sanitize_checkbox' ) ) :

	function fmuzz_sanitize_checkbox( $checked ) {
		// Boolean check.
		return ( ( isset( $checked ) && true == $checked ) ? true : false );
	}

endif;

if ( ! function_exists( 'fmuzz_sanitize_url' ) ) :

	function fmuzz_sanitize_url( $url ) {
		return esc_url_raw( $url );
	}

endif; // fmuzz_sanitize_url

// Doing this customizer thang!
fmuzz_Customize::get_instance();

if ( ! function_exists( 'fmuzz_customize_register' ) ) :
	/**
	 * Add postMessage support for site title and description for the Theme Customizer.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	function fmuzz_customize_register( $wp_customize ) {

		/**
		 * Add Social Sites Section
		 */
		$wp_customize->add_section(
			'fmuzz_social_section',
			array(
				'title'       => __( 'Social Sites', 'fmuzz' ),
				'capability'  => 'edit_theme_options',
			)
		);
		
		// Add facebook url
		$wp_customize->add_setting(
			'fmuzz_social_facebook',
			array(
			    'sanitize_callback' => 'fmuzz_sanitize_url',
			)
		);

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'fmuzz_social_facebook',
	        array(
	            'label'          => __( 'Facebook Page URL', 'fmuzz' ),
	            'section'        => 'fmuzz_social_section',
	            'settings'       => 'fmuzz_social_facebook',
	            'type'           => 'text',
	            )
	        )
		);

		// Add Twitter url
		$wp_customize->add_setting(
			'fmuzz_social_twitter',
			array(
			    'sanitize_callback' => 'fmuzz_sanitize_url',
			)
		);

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'fmuzz_social_twitter',
	        array(
	            'label'          => __( 'Twitter URL', 'fmuzz' ),
	            'section'        => 'fmuzz_social_section',
	            'settings'       => 'fmuzz_social_twitter',
	            'type'           => 'text',
	            )
	        )
		);

		// Add LinkedIn url
		$wp_customize->add_setting(
			'fmuzz_social_linkedin',
			array(
			    'sanitize_callback' => 'fmuzz_sanitize_url',
			)
		);

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'fmuzz_social_linkedin',
	        array(
	            'label'          => __( 'LinkedIn URL', 'fmuzz' ),
	            'section'        => 'fmuzz_social_section',
	            'settings'       => 'fmuzz_social_linkedin',
	            'type'           => 'text',
	            )
	        )
		);

		// Add Instagram url
		$wp_customize->add_setting(
			'fmuzz_social_instagram',
			array(
			    'sanitize_callback' => 'fmuzz_sanitize_url',
			)
		);

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'fmuzz_social_instagram',
	        array(
	            'label'          => __( 'LinkedIn URL', 'fmuzz' ),
	            'section'        => 'fmuzz_social_section',
	            'settings'       => 'fmuzz_social_instagram',
	            'type'           => 'text',
	            )
	        )
		);

		// Add RSS Feeds url
		$wp_customize->add_setting(
			'fmuzz_social_rss',
			array(
			    'sanitize_callback' => 'fmuzz_sanitize_url',
			)
		);

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'fmuzz_social_rss',
	        array(
	            'label'          => __( 'RSS Feeds URL', 'fmuzz' ),
	            'section'        => 'fmuzz_social_section',
	            'settings'       => 'fmuzz_social_rss',
	            'type'           => 'text',
	            )
	        )
		);

		// Add Tumblr url
		$wp_customize->add_setting(
			'fmuzz_social_tumblr',
			array(
			    'sanitize_callback' => 'fmuzz_sanitize_url',
			)
		);

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'fmuzz_social_tumblr',
	        array(
	            'label'          => __( 'Tumblr URL', 'fmuzz' ),
	            'section'        => 'fmuzz_social_section',
	            'settings'       => 'fmuzz_social_tumblr',
	            'type'           => 'text',
	            )
	        )
		);

		// Add YouTube channel url
		$wp_customize->add_setting(
			'fmuzz_social_youtube',
			array(
			    'sanitize_callback' => 'fmuzz_sanitize_url',
			)
		);

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'fmuzz_social_youtube',
	        array(
	            'label'          => __( 'YouTube channel URL', 'fmuzz' ),
	            'section'        => 'fmuzz_social_section',
	            'settings'       => 'fmuzz_social_youtube',
	            'type'           => 'text',
	            )
	        )
		);

		// Add Pinterest url
		$wp_customize->add_setting(
			'fmuzz_social_pinterest',
			array(
			    'sanitize_callback' => 'fmuzz_sanitize_url',
			)
		);

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'fmuzz_social_pinterest',
	        array(
	            'label'          => __( 'Pinterest URL', 'fmuzz' ),
	            'section'        => 'fmuzz_social_section',
	            'settings'       => 'fmuzz_social_pinterest',
	            'type'           => 'text',
	            )
	        )
		);

		// Add VK url
		$wp_customize->add_setting(
			'fmuzz_social_vk',
			array(
			    'sanitize_callback' => 'fmuzz_sanitize_url',
			)
		);

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'fmuzz_social_vk',
	        array(
	            'label'          => __( 'VK URL', 'fmuzz' ),
	            'section'        => 'fmuzz_social_section',
	            'settings'       => 'fmuzz_social_vk',
	            'type'           => 'text',
	            )
	        )
		);

		// Add Flickr url
		$wp_customize->add_setting(
			'fmuzz_social_flickr',
			array(
			    'sanitize_callback' => 'fmuzz_sanitize_url',
			)
		);

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'fmuzz_social_flickr',
	        array(
	            'label'          => __( 'Flickr URL', 'fmuzz' ),
	            'section'        => 'fmuzz_social_section',
	            'settings'       => 'fmuzz_social_flickr',
	            'type'           => 'text',
	            )
	        )
		);

		// Add Vine url
		$wp_customize->add_setting(
			'fmuzz_social_vine',
			array(
			    'sanitize_callback' => 'fmuzz_sanitize_url',
			)
		);

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'fmuzz_social_vine',
	        array(
	            'label'          => __( 'Vine URL', 'fmuzz' ),
	            'section'        => 'fmuzz_social_section',
	            'settings'       => 'fmuzz_social_vine',
	            'type'           => 'text',
	            )
	        )
		);

		/**
		 * Add Footer Section
		 */
		$wp_customize->add_section(
			'fmuzz_footer_section',
			array(
				'title'       => __( 'Footer', 'fmuzz' ),
				'capability'  => 'edit_theme_options',
			)
		);
		
		// Add Footer Copyright Text
		$wp_customize->add_setting(
			'fmuzz_footer_copyright',
			array(
			    'default'           => '',
			    'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'fmuzz_footer_copyright',
	        array(
	            'label'          => __( 'Copyright Text', 'fmuzz' ),
	            'section'        => 'fmuzz_footer_section',
	            'settings'       => 'fmuzz_footer_copyright',
	            'type'           => 'text',
	            )
	        )
		);
	}
endif; // fmuzz_customize_register
add_action( 'customize_register', 'fmuzz_customize_register' );

if ( ! function_exists( 'fmuzz_nav_wrap' ) ) :

	function fmuzz_nav_wrap() {

		// open the <ul>, set 'menu_class' and 'menu_id' values
  		$wrap  = '<ul id="%1$s" class="%2$s">';
  
	  	// get nav items as configured in /wp-admin/
	  	$wrap .= '%3$s';

	  	if ( class_exists( 'WooCommerce' ) ) {

	  		global $woocommerce;

			$wrap .= '<li><a class="cart-contents-icon" href="'.wc_get_cart_url().'" title="'.__('View your shopping cart', 'fmuzz')
					   .'"></a><div id="cart-popup-content"><div class="widget_shopping_cart_content"></div></div></li>';

		}
  
  		// close the <ul>
  		$wrap .= '</ul>';
  
  		// return the result
  		return $wrap;
	}

endif; // fmuzz_nav_wrap

if ( ! function_exists( 'fmuzz_disable_woocommerce_sidebar' ) ) :

	function fmuzz_disable_woocommerce_sidebar() {
		remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10); 
	}

endif; // fmuzz_disable_woocommerce_sidebar
add_action('init', 'fmuzz_disable_woocommerce_sidebar');

/**
 * Fix skip link focus in IE11.
 *
 * This does not enqueue the script because it is tiny and because it is only for IE11,
 * thus it does not warrant having an entire dedicated blocking script being loaded.
 *
 * @link https://git.io/vWdr2
 */
function fmuzz_skip_link_focus_fix() {
	// The following is minified via `terser --compress --mangle -- js/skip-link-focus-fix.js`.
	?>
	<script>
	/(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())},!1);
	</script>
	<?php
}
add_action( 'wp_print_footer_scripts', 'fmuzz_skip_link_focus_fix' );
