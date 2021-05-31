<?php
if ( ! function_exists( 'royal_magazine_widget_section' ) ) :
    /**
     *
     * @since Royal Magazine 1.0.0
     *
     * @param null
     * @return null
     *
     */
    function royal_magazine_widget_section() {
        ?>
        <!-- Main Content section -->       
        <?php 
        $sidebar_home_1 = '';
        if (! is_active_sidebar( 'sidebar-home-2') ) {
            $sidebar_home_1 = "full-width";
        }?>
        <?php if ( is_active_sidebar( 'sidebar-home-1') || is_active_sidebar( 'sidebar-home-2') ) {  ?>
            <section class="section-block section-block-upper">
                <div class="container container-bg">
                    <div class="row">
                        <div id="primary" class="content-area <?php echo esc_attr($sidebar_home_1); ?>">
                            <main id="main" class="site-main">
                                <?php dynamic_sidebar('sidebar-home-1'); ?>
                            </main>
                        </div>
                        <?php if (is_active_sidebar( 'sidebar-home-2') ) { ?>
                            <aside id="secondary" class="widget-area">
                                <div class="theiaStickySidebar">
                                <?php dynamic_sidebar('sidebar-home-2'); ?>
                                    </div>
                            </aside>
                        <?php } ?>
                    </div>
                </div>
            </section>
        <?php } ?>
    <?php
    }
endif;
add_action( 'royal_magazine_action_sidebar_section', 'royal_magazine_widget_section', 50 );