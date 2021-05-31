<?php
/**
 * royal-magazine functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package royal-magazine
 */

if (!function_exists('royal_magazine_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function royal_magazine_setup()
    {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on royal-magazine, use a find and replace
         * to change 'royal-magazine' to the name of your theme in all the template files.
         */
        load_theme_textdomain( 'royal-magazine', get_template_directory() . '/languages' );

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for custom logo.
         */
        add_theme_support('custom-logo', array(
            'header-text' => array('site-title', 'site-description'),
        ));
        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');
        add_image_size('royal-magazine-1140-600', 1140, 600, true);
        add_image_size('royal-magazine-400-260', 400, 260, true);
        add_image_size('royal-magazine-900-600', 900, 600, true);


        // Set up the WordPress core custom header feature.
        add_theme_support('custom-header', apply_filters('royal_magazine_custom_header_args', array(
            'width' => 1400,
            'height' => 380,
            'flex-height' => true,
            'header-text' => false,
            'default-text-color' => '000',
            'default-image' => get_template_directory_uri() . '/images/banner-image.jpg',
        )));

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'primary' => esc_html__('Primary Menu', 'royal-magazine'),
            'footer' => esc_html__('Footer Menu', 'royal-magazine'),
            'social' => esc_html__('Social Menu', 'royal-magazine'),
        ));

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));

        // Set up the WordPress core custom background feature.
        add_theme_support('custom-background', apply_filters('royal_magazine_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        )));

        /**
         * Load Init for Hook files.
         */
        require get_template_directory() . '/inc/hooks/hooks-init.php';

    }
endif;
add_action('after_setup_theme', 'royal_magazine_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function royal_magazine_content_width()
{
    $GLOBALS['content_width'] = apply_filters('royal_magazine_content_width', 640);
}

add_action('after_setup_theme', 'royal_magazine_content_width', 0);

/**
 * function for google fonts
 */
if (!function_exists('royal_magazine_fonts_url')) :

    /**
     * Return fonts URL.
     *
     * @since 1.0.0
     * @return string Fonts URL.
     */
    function royal_magazine_fonts_url()
    {

        $fonts_url = '';
        $fonts = array();
        $subsets = 'latin,latin-ext';

        /* translators: If there are characters in your language that are not supported by Merriweather, translate this to 'off'. Do not translate into your own language. */
        if ('off' !== _x('on', 'Merriweather font: on or off', 'royal-magazine')) {
            $fonts[] = 'Merriweather';
        }
        /* translators: If there are characters in your language that are not supported by Karla, translate this to 'off'. Do not translate into your own language. */
        if ('off' !== _x('on', 'Karla font: on or off', 'royal-magazine')) {
            $fonts[] = 'Karla:400,400i,700,700i';
        }

        /* translators: If there are characters in your language that are not supported by Playfair Display, translate this to 'off'. Do not translate into your own language. */
        if ('off' !== _x('on', 'Playfair Display font: on or off', 'royal-magazine')) {
            $fonts[] = 'Playfair+Display:400,400i,700,700i,900';
        }

        if ($fonts) {
            $fonts_url = add_query_arg(array(
                'family' => urldecode(implode('|', $fonts)),
                'subset' => urldecode($subsets),
            ), 'https://fonts.googleapis.com/css');
        }
        return $fonts_url;
    }
endif;
/**
 * Enqueue scripts and styles.
 */
function royal_magazine_scripts()
{
    $min = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
    wp_enqueue_style('jquery-slick', get_template_directory_uri() . '/assets/libraries/slick/css/slick' . $min . '.css');
    wp_enqueue_style('ionicons', get_template_directory_uri() . '/assets/libraries/ionicons/css/ionicons' . $min . '.css');
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/libraries/bootstrap/css/bootstrap' . $min . '.css');
    wp_enqueue_style('magnific-popup', get_template_directory_uri() . '/assets/libraries/magnific-popup/magnific-popup.css');
    wp_enqueue_style('royal-magazine-style', get_stylesheet_uri());
    /*inline style*/
    wp_add_inline_style('royal-magazine-style', royal_magazine_trigger_custom_css_action());

    $fonts_url = royal_magazine_fonts_url();
    if (!empty($fonts_url)) {
        wp_enqueue_style('royal-magazine-google-fonts', $fonts_url, array(), null);
    }
    wp_enqueue_script('royal-magazine-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true);

    wp_enqueue_script('royal-magazine-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true);

    wp_enqueue_script('jquery-slick', get_template_directory_uri() . '/assets/libraries/slick/js/slick' . $min . '.js', array('jquery'), '', true);
    wp_enqueue_script('jquery-bootstrap', get_template_directory_uri() . '/assets/libraries/bootstrap/js/bootstrap' . $min . '.js', array('jquery'), '', true);
    wp_enqueue_script('jquery-marquee', get_template_directory_uri() . '/assets/libraries/marquee/jquery.marquee.js', array('jquery'), '', true);
    wp_enqueue_script('jquery-sticky-sdebar', get_template_directory_uri() . '/assets/libraries/theiaStickySidebar/theia-sticky-sidebar' . $min . '.js', array('jquery'), '', true);
    wp_enqueue_script('magnific-popup', get_template_directory_uri() . '/assets/libraries/magnific-popup/jquery.magnific-popup' . $min . '.js', array('jquery'), '', true);
    wp_enqueue_script('royal-magazine-script', get_template_directory_uri() . '/assets/twp/js/custom-script.js', array('jquery'), '', 1);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}

add_action('wp_enqueue_scripts', 'royal_magazine_scripts');

/**
 * Enqueue admin scripts and styles.
 */
function royal_magazine_admin_scripts($hook)
{
    if ('widgets.php' === $hook) {
        wp_enqueue_media();
        wp_enqueue_script('royal-magazine-custom-widgets', get_template_directory_uri() . '/assets/twp/js/widgets.js', array('jquery'), '1.0.0', true);
    }

    wp_enqueue_style('royal-magazine-admin-css', get_template_directory_uri() . '/assets/twp/css/rm-admin.css');
    

}

add_action('admin_enqueue_scripts', 'royal_magazine_admin_scripts');

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';


/**
 * Customizer control scripts and styles.
 *
 * @since 1.0.5
 */
function royal_magazine_customizer_control_scripts()
{

    wp_enqueue_style('royal-magazine-customize-controls', get_template_directory_uri() . '/assets/twp/css/customize-controls.css');

}

add_action('customize_controls_enqueue_scripts', 'royal_magazine_customizer_control_scripts', 0);