<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "body-content-wrapper" div.
 *
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo('charset'); ?>" />
		<?php
            if ( is_singular() && pings_open() ) :
                printf( '<link rel="pingback" href="%s">' . "\n", get_bloginfo( 'pingback_url' ) );
            endif;
        ?>
		<meta name="viewport" content="width=device-width" />
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
		<?php wp_body_open(); ?>
		<a class="skip-link screen-reader-text" href="#main-content-wrapper">
			<?php _e( 'Skip to content', 'fmuzz' ); ?>
		</a>
		<div id="body-content-wrapper">
			
			<header id="header-main-fixed">

				<div id="header-content-wrapper">

					<div id="header-top">
						<ul class="header-social-widget">
							<?php fmuzz_show_social_sites(); ?>
						</ul>
					</div>

					<div id="header-logo">
						<?php
							if ( function_exists( 'the_custom_logo' ) ) :

								the_custom_logo();

							endif;

							$header_text_color = get_header_textcolor();

						    if ( 'blank' !== $header_text_color ) :
						?>    
						        <div id="site-identity">

						        	<a href="<?php echo esc_url( home_url('/') ); ?>"
						        		title="<?php esc_attr( get_bloginfo('name') ); ?>">

						        		<h1 class="entry-title">
						        			<?php echo esc_html( get_bloginfo('name') ); ?>
										</h1>
						        	</a>
						        	<strong>
						        		<?php echo esc_html( get_bloginfo('description') ); ?>
						        	</strong>
						        </div>
						<?php
						    endif;
						?>
					</div><!-- #header-logo -->

					<nav id="navmain">
						<?php wp_nav_menu( array( 'theme_location' => 'primary',
												  'fallback_cb'    => 'wp_page_menu',
												  'items_wrap'     => fmuzz_nav_wrap(),
												  ) ); ?>
					</nav><!-- #navmain -->
					
					<div class="clear">
					</div><!-- .clear -->

				</div><!-- #header-content-wrapper -->

			</header><!-- #header-main-fixed -->
			<div id="header-spacer">
				&nbsp;
			</div><!-- #header-spacer -->
			<div class="clear">
			</div><!-- .clear -->
		    <div id="page-header"
		    	<?php if ( has_post_thumbnail() ) : ?>
		    		style="background-image: url('<?php echo esc_url( get_the_post_thumbnail_url() ); ?>')"
          		<?php endif; ?>>
		    </div>
