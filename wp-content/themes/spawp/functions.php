<?php
// Theme Core Constants
define( 'SPAWP_THEME_DIR', get_template_directory() );
define( 'SPAWP_THEME_URI', get_template_directory_uri() );

final class SPAWP_Main_Class {

	public function __construct(){

		add_action( 'after_setup_theme', array( $this, 'constants' ) );

		// Include all core theme function files
		add_action( 'after_setup_theme', array( $this, 'include_functions' ) );

		// theme setup
		add_action( 'after_setup_theme', array( $this, 'theme_setup' ) );

		// register sidebars
		add_action( 'widgets_init', array( $this, 'register_sidebars' ) );

		add_action( 'wp_enqueue_scripts', array( $this, 'theme_css_and_js' ) );

		add_action( 'admin_enqueue_scripts', array( $this, 'admin_js' ) );
	}

	public function constants(){
		$version = self::theme_version();
		$name = self::theme_name();

		// theme version
		define( 'SPAWP_THEME_VERSION' , $version );
		define( 'SPAWP_THEME_NAME', $name );

		define( 'SPAWP_JS_DIR_URI', SPAWP_THEME_URI .'/js/' );
		define( 'SPAWP_CSS_DIR_URI', SPAWP_THEME_URI .'/css/' );

		// Includes Paths
		define( 'SPAWP_INC_DIR', SPAWP_THEME_DIR .'/inc/' );
		define( 'SPAWP_INC_DIR_URI', SPAWP_THEME_URI .'/inc/' );

		define( 'SPAWP_CUSTOMIZER_DIR', SPAWP_THEME_DIR .'/inc/customizer/' );
		define( 'SPAWP_CUSTOMIZER_DIR_URI', SPAWP_THEME_URI .'/inc/customizer/' );

		// Check if plugins are active
		define( 'SPAWP_BC_ACTIVE', function_exists('bc_init') );
	}

	public static function theme_version(){
		$theme = wp_get_theme();
		return $theme->get( 'Version' );
	}

	public static function theme_name(){
		$theme = wp_get_theme();
		return $theme->get( 'Name' );
	}

	public static function include_functions(){

		$inc_dir = SPAWP_INC_DIR;
		$customizer_dir = SPAWP_CUSTOMIZER_DIR;

		// default theme data file
		require_once ( $inc_dir .'spawp-theme-default-data.php' );

		// template tags file include
		require_once ( $inc_dir .'template-tags.php' );

		require_once ( $inc_dir .'markup.php' );

		// helpers functions file include
		require_once ( $inc_dir .'helpers.php');

		// classes file include
		require_once ( $inc_dir .'classes/class-spawp-walker-page.php');

		require_once( $customizer_dir . '/core-custom-section-panel/spawp-custom-base-customizer-settings.php');

		// customizer files include
		require_once ( $customizer_dir .'spawp-theme-customizer.php');

		// Customizer Repeater Control include
		require_once ( $customizer_dir . '/customizer-repeater/functions.php');

		// Customizer Theme Options
		require_once ( $customizer_dir . '/theme-options/spawp-theme-options.php');

		// front page sections helper file including
		require_once ( $inc_dir .'front-page-helpers.php' );

		// front end dynamic css
		require_once ( $inc_dir .'css-output.php' );

		// meta
		require_once ( $inc_dir .'meta.php' );

		require_once ( $inc_dir .'install/class-install-helper.php' );

		if( !class_exists('Spawp_Premium_Theme_Setup') ){

			require_once ( $inc_dir .'install/customizer_recommended_plugin.php' );
		}
		
		require_once ( $inc_dir .'about-screen/welcome-screen.php' );
	}

	public static function theme_setup(){

		global $content_width;

		if ( ! isset( $content_width ) ) {
			$content_width = 700;
		}

		// Load text domain
		load_theme_textdomain( 'spawp', SPAWP_INC_DIR .'/lang' );

		// Posts and comments RSS feed links to head
		add_theme_support( 'automatic-feed-links' );

		// Register menus
		register_nav_menus( array(
			'primary'    => esc_html__( 'Primary', 'spawp' )
		) );

		// Custom logo.
		$logo_width  = 120;
		$logo_height = 90;

		// If the retina setting is active, double the recommended width and height.
		if ( get_theme_mod( 'retina_logo', false ) ) {
			$logo_width  = floor( $logo_width * 2 );
			$logo_height = floor( $logo_height * 2 );
		}

		add_theme_support(
			'custom-logo',
			array(
				'height'      => $logo_height,
				'width'       => $logo_width,
				'flex-height' => true,
				'flex-width'  => true,
			)
		);

		// Title tag supports
		add_theme_support( 'title-tag' );

		// Post Formats
		add_theme_support( 'post-formats', array( 
			'aside',
			'image',
			'video',
			'quote',
			'link',
			'gallery',
			'status',
			'audio',
			'chat',
		) );

		// Featured Thumbnails on posts and pages
		add_theme_support( 'post-thumbnails' );

		// Custom header image
		add_theme_support( 'custom-header', apply_filters( 'spawp_custom_header', array(
			'width'              => 2000,
			'height'             => 1200,
			'flex-height'        => true,
			'header-text'        => false,
		) ) );

		// Core markup for search form, comment form, comments, galleries, captions and widgets for output valid HTML5.
		add_theme_support( 'html5', array(
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'widgets',
		) );

		// WooCommerce support.
		add_theme_support( 'woocommerce' );
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );

		// Add editor style
		add_editor_style( 'css/editor-style.css' );

		// Selective refreshing of widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );
 
		$recommend_plugins = array();
		if( !class_exists('Spawp_Premium_Theme_Setup') ){
			$recommend_plugins['britetechs-companion'] = array(
                'name' => esc_html__( 'Britetechs Companion', 'spawp' ),
                'active_filename' => 'britetechs-companion/britetechs-companion.php',
				'desc' => esc_html__( 'We highly recommend that you install the britetechs companion plugin to gain access to the extra theme sections.', 'spawp' ),
            );

            $recommend_plugins['contact-form-7'] = array(
                'name' => esc_html__( 'Contact Form 7', 'spawp' ),
                'active_filename' => 'contact-form-7/wp-contact-form-7.php',
				'desc' => esc_html__( 'This is also recommended that you install the contact form plugin to show contact form on the contact page.', 'spawp' )
            );
		}else{
			$recommend_plugins['contact-form-7'] = array(
                'name' => esc_html__( 'Contact Form 7', 'spawp' ),
                'active_filename' => 'contact-form-7/wp-contact-form-7.php',
				'desc' => esc_html__( 'This is also recommended that you install the contact form plugin to show contact form on the contact page.', 'spawp' )
            );
		}

		add_theme_support( 'recommend-plugins', $recommend_plugins );

		// load starter Content.

		add_theme_support( 'starter-content', spawp_wp_starter_pack() );

	}

	public static function register_sidebars(){

		$heading = 'h4';
		$heading = apply_filters( 'spawp_sidebar_heading', $heading );

		// Default Sidebar
		register_sidebar( array(
			'name'			=> esc_html__( 'Right Sidebar', 'spawp' ),
			'id'			=> 'sidebar',
			'description'	=> esc_html__( 'This sidebar will be displayed in the left or right sidebar area.', 'spawp' ),
			'before_widget'	=> '<aside id="%1$s" class="widget wow zoomIn %2$s">',
			'after_widget'	=> '</aside>',
			'before_title'	=> '<'. $heading .' class="widget-title">',
			'after_title'	=> '</'. $heading .'>',
		) );

		// Left Sidebar
		register_sidebar( array(
			'name'			=> esc_html__( 'Left Sidebar', 'spawp' ),
			'id'			=> 'sidebar-2',
			'description'	=> esc_html__( 'This sidebar area are used in the left sidebar region if you use the Both Sidebars layout.', 'spawp' ),
			'before_widget'	=> '<aside id="%1$s" class="widget wow zoomIn %2$s">',
			'after_widget'	=> '</aside>',
			'before_title'	=> '<'. $heading .' class="widget-title">',
			'after_title'	=> '</'. $heading .'>',
		) );

		// Footer Sidebar 1
		register_sidebar( array(
			'name'			=> esc_html__( 'Footer Sidebar 1', 'spawp' ),
			'id'			=> 'footer-1',
			'description'	=> esc_html__( 'Footer 1 Sidebar Area', 'spawp' ),
			'before_widget'	=> '<aside id="%1$s" class="widget %2$s">',
			'after_widget'	=> '</aside>',
			'before_title'	=> '<'. $heading .' class="widget-title"><i class="fa fa-leaf"></i> ',
			'after_title'	=> '</'. $heading .'>',
		) );

		// Footer Sidebar 2
		register_sidebar( array(
			'name'			=> esc_html__( 'Footer Sidebar 2', 'spawp' ),
			'id'			=> 'footer-2',
			'description'	=> esc_html__( 'Footer 2 Sidebar Area', 'spawp' ),
			'before_widget'	=> '<aside id="%1$s" class="widget %2$s">',
			'after_widget'	=> '</aside>',
			'before_title'	=> '<'. $heading .' class="widget-title"><i class="fa fa-leaf"></i> ',
			'after_title'	=> '</'. $heading .'>',
		) );

		// Footer Sidebar 3
		register_sidebar( array(
			'name'			=> esc_html__( 'Footer Sidebar 3', 'spawp' ),
			'id'			=> 'footer-3',
			'description'	=> esc_html__( 'Footer 3 Sidebar Area', 'spawp' ),
			'before_widget'	=> '<aside id="%1$s" class="widget %2$s">',
			'after_widget'	=> '</aside>',
			'before_title'	=> '<'. $heading .' class="widget-title"><i class="fa fa-leaf"></i> ',
			'after_title'	=> '</'. $heading .'>',
		) );

		// Footer Sidebar 4
		register_sidebar( array(
			'name'			=> esc_html__( 'Footer Sidebar 4', 'spawp' ),
			'id'			=> 'footer-4',
			'description'	=> esc_html__( 'Footer 4 Sidebar Area', 'spawp' ),
			'before_widget'	=> '<aside id="%1$s" class="widget %2$s">',
			'after_widget'	=> '</aside>',
			'before_title'	=> '<'. $heading .' class="widget-title"><i class="fa fa-leaf"></i> ',
			'after_title'	=> '</'. $heading .'>',
		) );

		// Top Bar
		register_sidebar( array(
			'name'			=> esc_html__( 'Top Bar', 'spawp' ),
			'id'			=> 'topbar',
			'description'	=> esc_html__( 'This sidebar will be displayed in the header area.', 'spawp' ),
			'before_widget'	=> '<aside id="%1$s" class="widget mb-0 mt-5 %2$s">',
			'after_widget'	=> '</aside>',
			'before_title'	=> '<'. $heading .' class="widget-title">',
			'after_title'	=> '</'. $heading .'>',
		) );

		// Woocommerce
		register_sidebar( array(
			'name'			=> esc_html__( 'Woocommerce', 'spawp' ),
			'id'			=> 'woocommerce',
			'description'	=> esc_html__( 'This sidebar will be displayed in the woocommerce pages.', 'spawp' ),
			'before_widget'	=> '<aside id="%1$s" class="widget wow zoomIn %2$s">',
			'after_widget'	=> '</aside>',
			'before_title'	=> '<'. $heading .' class="widget-title">',
			'after_title'	=> '</'. $heading .'>',
		) );
	}

	public static function theme_css_and_js(){

		// Define dir
		$css_dir = SPAWP_CSS_DIR_URI;
		$js_dir = SPAWP_JS_DIR_URI;

		wp_enqueue_style( 'font-awesome', $css_dir .'font-awesome-4.7.0/css/font-awesome.min.css', false, '4.7.0' );

		wp_enqueue_style( 'bootstrap', $css_dir .'bootstrap.css', false, '4.4.1' );

		wp_enqueue_style( 'animate', $css_dir .'animate.css', false, '3.5.2' );

		wp_enqueue_style( 'owl-carousel', $css_dir .'owl.carousel.css', false, '2.2.1' );

		wp_enqueue_style( 'spawp-theme-extra', $css_dir .'theme-extra.css', false, SPAWP_THEME_VERSION );

		wp_enqueue_style( 'spawp-style', get_stylesheet_uri(), array(), SPAWP_THEME_VERSION );		

		wp_enqueue_style( 'meanmenu-css', $css_dir .'meanmenu.css', false, SPAWP_THEME_VERSION );

		wp_enqueue_style( 'spawp-woocommerce', $css_dir .'woocommerce.css', false, SPAWP_THEME_VERSION );

		wp_enqueue_script( 'bootstrap-js', $js_dir .'bootstrap.js', array( 'jquery' ), SPAWP_THEME_VERSION, true );

		wp_enqueue_script( 'owl-carousel-js', $js_dir .'owl.carousel.js', array( 'jquery' ), SPAWP_THEME_VERSION, true );

		wp_enqueue_script( 'wow-js', $js_dir .'wow.js', array( 'jquery' ), SPAWP_THEME_VERSION, true );
		
		wp_enqueue_script( 'meanmenu-js', $js_dir .'jquery.meanmenu.js', array( 'jquery' ), SPAWP_THEME_VERSION, true );
		
		wp_enqueue_script( 'smooth-scroll-js', $js_dir .'smooth-scroll.js', array( 'jquery' ), SPAWP_THEME_VERSION, true );

		wp_enqueue_script( 'waypoints-js', $js_dir .'jquery.waypoints.js', array( 'jquery' ), SPAWP_THEME_VERSION, true );

		wp_enqueue_script( 'spawp-custom', $js_dir .'custom.js', array( 'jquery' ), SPAWP_THEME_VERSION, true );

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		// js settings.
	    $settings = array(
	        'homeUrl'     => esc_url( home_url( '/' ) ),
			'nav_mobilebtn_breakpoint' => absint( spawp_get_option('nav_mobilebtn_breakpoint') ),
			'nav_mobilebtn_label' => esc_attr( spawp_get_option('nav_mobilebtn_label') ),
			'secondary_mobilebtn_label' => esc_attr( spawp_get_option('secondary_mobilebtn_label') ),
			'sticky_nav' => esc_attr( spawp_get_option('sticky_nav') ),
	    );
		wp_localize_script( 'spawp-custom', 'spawp_settings', $settings );
	}

	public static function admin_js(){
		$js_dir = SPAWP_JS_DIR_URI;
		wp_enqueue_script( 'spawp-admin-meta-js', $js_dir .'admin-meta.js', array(), SPAWP_THEME_VERSION, true );
	}
}

new SPAWP_Main_Class;