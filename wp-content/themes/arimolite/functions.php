<?php
# Define
define('ARIMOLITE_LIBS_URI', get_template_directory_uri() . '/libs/');
define('ARIMOLITE_CORE_PATH', get_template_directory() . '/core/');
define('ARIMOLITE_CORE_URI', get_template_directory_uri() . '/core/');
define('ARIMOLITE_CORE_CLASSES', ARIMOLITE_CORE_PATH . 'classes/');
define('ARIMOLITE_CORE_FUNCTIONS', ARIMOLITE_CORE_PATH . 'functions/');

# Set Content Width
if ( ! isset( $content_width ) ) { $content_width = 1530; }

# After setup theme
add_action('after_setup_theme', 'arimolite_setup');
function arimolite_setup()
{
    load_theme_textdomain('arimolite', get_template_directory().'/languages');
	add_theme_support('automatic-feed-links');
	add_theme_support('post-thumbnails');
    add_theme_support('title-tag');
	register_nav_menus(array('primary' => esc_html__('Main Menu', 'arimolite')));
	add_theme_support('post-formats', array( 'image', 'video', 'audio', 'gallery'));
    add_theme_support('editor-styles');
    add_editor_style('style-editor.css');
    $defaults = array(
     'height'      => 100,
     'width'       => 400,
     'flex-height' => true,
     'flex-width'  => true
     );
    add_theme_support( 'custom-logo', $defaults );

}

# Google Fonts
add_action( 'wp_enqueue_scripts', 'arimolite_enqueue_googlefonts' );
function arimolite_enqueue_googlefonts()
{
    $fonts_url = '';
    $Poppins = _x( 'on', 'Poppins: on or off', 'arimolite' );
    if( 'off' != $Poppins)
    {
        $font_families = array();
        if ( 'off' !== $Poppins ) $font_families[] = 'Poppins:300,500,600';
        $query_args = array('family' => urlencode(implode('|', $font_families)), 'subset' => urlencode('latin,latin-ext'));
        $fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
    }

    wp_enqueue_style('arimolite-googlefonts', esc_url_raw($fonts_url), array(), null);
}

add_action( 'enqueue_block_editor_assets', 'arimolite_enqueue_googlefonts' );

# Enqueue Scripts
add_action( 'wp_enqueue_scripts', 'arimolite_load_scripts', 15 );
function arimolite_load_scripts()
{
    # CSS
    wp_enqueue_style('bootstrap', ARIMOLITE_LIBS_URI . 'bootstrap/bootstrap.css');
    wp_enqueue_style('font-awesome', ARIMOLITE_LIBS_URI . 'font-awesome/css/all.css');
    wp_enqueue_style('chosen', ARIMOLITE_LIBS_URI . 'chosen/chosen.css');
     wp_enqueue_style('arimolite-style', get_theme_root_uri() . '/arimolite/style.css');
    wp_enqueue_style('arimolite-theme-style', get_theme_root_uri() . '/arimolite/assets/css/theme.css');

    # JS
	wp_enqueue_script('fitvids', ARIMOLITE_LIBS_URI . 'fitvids/fitvids.js', array(), false, true);
    wp_enqueue_script('chosen', ARIMOLITE_LIBS_URI . 'chosen/chosen.js', array(), false, true);
    wp_enqueue_script('arimolite-scripts', get_template_directory_uri() . '/assets/js/arimolite-scripts.js', array(), false, true);
    
    if ( is_singular() && get_option('thread_comments') ) {
        wp_enqueue_script('comment-reply');
    }
}


# Register Sidebar
add_action( 'widgets_init', 'arimolite_widgets_init' );
function arimolite_widgets_init() {
    register_sidebar(array(
		'name'            => __('Sidebar', 'arimolite'),
		'id'              => 'sidebar',
		'before_widget'   => '<div id="%1$s" class="widget %2$s">',
		'after_widget'    => '</div>',
		'before_title'    => '<h4 class="widget-title">',
		'after_title'     => '</h4>'
	));
    register_sidebar(array(
		'name'            => __('Footer Instagram', 'arimolite'),
		'id'              => 'footer-ins',
		'before_widget'   => '<div id="%1$s" class="widget %2$s">',
		'after_widget'    => '</div>',
		'before_title'    => '<h4 class="widget-title">',
		'after_title'     => '</h4>'
	));
}

# Check file exists
function arimolite_require_file( $path ) {
    if ( file_exists($path) ) {
        require $path;
    }
}

# Require file
arimolite_require_file( get_template_directory() . '/core/init.php' );

// Social Network
function arimolite_social_network( $header = true )
{
    $empty = false;
    $facebook_url   = get_theme_mod('arimolite_facebook_url');
    $twitter_url    = get_theme_mod('arimolite_twitter_url');
    $instagram_url  = get_theme_mod('arimolite_instagram_url');
    $pinterest_url  = get_theme_mod('arimolite_pinterest_url');
    $youtube_url    = get_theme_mod('arimolite_youtube_url');
    $vimeo_url      = get_theme_mod('arimolite_vimeo_url');

    if ( $facebook_url == '' && $twitter_url == '' && $instagram_url =='' && $pinterest_url == '' && $youtube_url == '' && $vimeo_url == '' ) {
        $empty = true;
    }
    $class = $header ? 'header-social' : 'footer-social';
    if ( ! $empty ) { ?>
        <div class="social-network <?php echo esc_attr($class); ?>">
            <?php if( $facebook_url ) { ?>
            <a href="<?php echo esc_url($facebook_url); ?>"><i class="fab fa-facebook-f"></i></a>
            <?php } ?>
            <?php if ( $twitter_url ){ ?>
            <a href="<?php echo esc_url($twitter_url); ?>"><i class="fab fa-twitter"></i></a>
            <?php } ?>
            <?php if( $pinterest_url ){ ?>
            <a href="<?php echo esc_url($pinterest_url); ?>"><i class="fab fa-pinterest"></i></a>
            <?php } ?>
            <?php if( $instagram_url ){ ?>
            <a href="<?php echo esc_url($instagram_url); ?>"><i class="fab fa-instagram"></i></a>
            <?php } ?>
            <?php if( $youtube_url ){ ?>
            <a href="<?php echo esc_url($youtube_url); ?>"><i class="fab fa-youtube"></i></a>
            <?php } ?> 
            <?php if( $vimeo_url ){ ?>
            <a href="<?php echo esc_url($vimeo_url); ?>"><i class="fab fa-vimeo-v"></i></a>
            <?php } ?>
        </div><?php
    }
}

# Comment Layout
function arimolite_custom_comment($comment, $args, $depth) {
	extract($args, EXTR_SKIP);

	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
?>
	<<?php echo esc_attr($tag); ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
	<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
	<?php endif; ?>
		<div class="comment-author">
		<?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
		</div>
		<div class="comment-content">
		    <h4 class="author-name"><?php echo get_comment_author_link(); ?></h4>
			<div class="date-comment">
				<a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>">
				<?php printf( esc_html__('%1$s at %2$s', 'arimolite'), get_comment_date(),  get_comment_time() ); ?></a>
			</div>
			<div class="reply">
				<?php edit_comment_link( esc_html__( '(Edit)', 'arimolite' ), '  ', '' );?>
				<?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div>
			<?php if ( $comment->comment_approved == '0' ) : ?>
				<em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'arimolite' ); ?></em>
				<br />
			<?php endif; ?>
			<div class="comment-text"><?php comment_text(); ?></div>
		</div>	
	<?php if ( 'div' != $args['style'] ) : ?>
	</div>
	<?php endif; ?>
<?php
}

# Pagination
function arimolite_pagination()
{
    global $wp_query;
    if ( get_the_posts_pagination() ) : ?>
    <div class="arimolite-pagination"><?php
        $args = array(
            'prev_text' => '<span class="fa fa-angle-left"></span>',
            'next_text' => '<span class="fa fa-angle-right"></span>'
        );
        the_posts_pagination($args);
    ?>
    </div>
    <?php
    endif;
}


# Include the TGM_Plugin_Activation class
add_action('tgmpa_register', 'arimolite_register_required_plugins');
function arimolite_register_required_plugins()
{
	$plugins = array(
		array(
			'name'   => __('Contact Form 7', 'arimolite'),
			'slug'   => 'contact-form-7'
		),
        array(
			'name'   => __('MailChimp for WordPress', 'arimolite'),
			'slug'   => 'mailchimp-for-wp'
		),
        array(
            'name'   => __('Arimolite Core', 'arimolite'),
            'slug'   => 'arimolite-core',
            'source' => esc_url( 'https://plugins.theme-xoda.com/arimolite-core.zip' )
        ),
	);

	$config = array(
		'id'           => 'arimolite',
		'default_path' => '',
		'menu'         => 'tgmpa-install-plugins',
		'parent_slug'  => 'themes.php',
		'capability'   => 'edit_theme_options',
		'has_notices'  => true,
		'dismissable'  => true,
		'dismiss_msg'  => '',
		'is_automatic' => true,
		'message'      => ''
	);
	tgmpa($plugins, $config);
}
