    </div><!-- #arimolite-primary -->
    <footer id="arimolite-footer">
        <?php if ( is_active_sidebar('footer-ins') ) : ?>
        <div class="footer-ins">
            <?php dynamic_sidebar('footer-ins'); ?>
        </div>
        <?php endif; ?>
        <div class="main-footer">
            <div class="container">
        		<div class="logo-footer">
                    <?php 
                    $custom_logo_id = get_theme_mod( 'custom_logo' );
                    $logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
                    if ( has_custom_logo() && isset($logo[0]) ) { ?>
                        <a class="logo-img" href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url($logo[0]); ?>" alt="<?php echo get_bloginfo('name'); ?>"></a>
                    <?php } ?>
                    <?php if ( !isset($logo[0]) ) { ?>
                        <h2 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo('name'); ?> </a></h2>
                    <?php  } ?>
                    <span class="tag-line"><?php echo get_bloginfo( 'description'); ?></span>

        		</div>
                <?php arimolite_social_network(false); ?>
            </div>
        </div>
        <div class="footer-copyright">
            <div class="container">
                <div class="copyright"><?php echo wp_kses_post(get_theme_mod('arimolite_footer_copyright_text',  __('Your Copyright Text', 'arimolite' ) ) ); ?></div>
            </div>
        </div>
    </footer>
</div>
<?php wp_footer(); ?>    
</body>
</html>