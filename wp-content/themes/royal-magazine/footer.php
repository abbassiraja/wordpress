<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package royal-magazine
 */

?>
</div><!-- #content -->

<footer id="colophon" class="site-footer mt-30" role="contentinfo">
    <div class="container-fluid">
        <!-- end col-12 -->
        <div class="row">
        <?php 
        $royal_magazine_footer_widgets_number = royal_magazine_get_option('number_of_footer_widget');
        $enable_footer_scroll_top = royal_magazine_get_option('enable_footer_scroll_top');
        if( 1 == $royal_magazine_footer_widgets_number ){
            $col = 'col-md-12';
        }
        elseif( 2 == $royal_magazine_footer_widgets_number ){
            $col = 'col-md-6';
        }
        elseif( 3 == $royal_magazine_footer_widgets_number ){
            $col = 'col-md-4';
        }
        elseif( 4 == $royal_magazine_footer_widgets_number ){
            $col = 'col-md-3';
        }
        else{
            $col = 'col-md-3';
        }
        if(is_active_sidebar( 'footer-col-one' ) || is_active_sidebar( 'footer-col-two' ) || is_active_sidebar( 'footer-col-three' ) || is_active_sidebar( 'footer-col-four' )){ ?>
            <section class="wrapper block-section footer-widget pt-60 pb-40">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <?php if( is_active_sidebar( 'footer-col-one' ) && $royal_magazine_footer_widgets_number > 0 ) : ?>
                                    <div class="footer-widget-wrapper <?php echo esc_attr( $col );?>">
                                        <?php dynamic_sidebar( 'footer-col-one' ); ?>
                                    </div>
                                <?php endif; ?>
                                <?php if( is_active_sidebar( 'footer-col-two' ) && $royal_magazine_footer_widgets_number > 1 ) : ?>
                                    <div class="footer-widget-wrapper <?php echo esc_attr( $col );?>">
                                        <?php dynamic_sidebar( 'footer-col-two' ); ?>
                                    </div>
                                <?php endif; ?>
                                <?php if( is_active_sidebar( 'footer-col-three' ) && $royal_magazine_footer_widgets_number > 2 ) : ?>
                                    <div class="footer-widget-wrapper <?php echo esc_attr( $col );?>">
                                        <?php dynamic_sidebar( 'footer-col-three' ); ?>
                                    </div>
                                <?php endif; ?>
                                <?php if( is_active_sidebar( 'footer-col-four' ) && $royal_magazine_footer_widgets_number > 3 ) : ?>
                                    <div class="footer-widget-wrapper <?php echo esc_attr( $col );?>">
                                        <?php dynamic_sidebar( 'footer-col-four' ); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php }?>

        <div class="copyright-area">
            <div class="site-info">
                <div class="container">
                    <div class="row">
                        <div class="site-copyright clearfix pb-20 pt-20 primary-font">
                            <div class="col-md-4">
                                <?php
                                $royal_magazine_copyright_text = royal_magazine_get_option('copyright_text');
                                if(!empty ($royal_magazine_copyright_text)){
                                    echo wp_kses_post($royal_magazine_copyright_text);
                                }
                                ?>
                                <br>
                                <?php printf( esc_html__( 'Theme: %1$s by %2$s', 'royal-magazine' ), 'Royal Magazine', '<a href="https://themeinwp.com/" target = "_blank" rel="designer">ThemeinWP </a>' ); ?>
                            </div>
                            <div class="col-md-8">
                                <?php if ( has_nav_menu( 'footer' ) ) { ?>
                                    <div class="site-footer-menu primary-font">
                                        <?php
                                        wp_nav_menu(array(
                                            'theme_location' => 'footer',
                                            'menu_id' => 'footer-menu',
                                            'container' => 'div',
                                            'depth'        => 1,
                                            'menu_class'=> false
                                        )); ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
</div><!-- #page -->

<?php if( $enable_footer_scroll_top ){ ?>
<a id="scroll-up" class="alt-bgcolor"><i class="ion-ios-arrow-up"></i></a>
<?php } ?>

<?php wp_footer(); ?>

</body>
</html>
