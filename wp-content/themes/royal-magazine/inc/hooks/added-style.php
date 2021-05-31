<?php
/**
 * CSS related hooks.
 *
 * This file contains hook functions which are related to CSS.
 *
 * @package royal-magazine
 */

if (!function_exists('royal_magazine_trigger_custom_css_action')) :

    /**
     * Do action theme custom CSS.
     *
     * @since 1.0.0
     */
    function royal_magazine_trigger_custom_css_action()
    {
        $royal_magazine_enable_banner_overlay = royal_magazine_get_option('enable_overlay_option');
        ?>
        <style type="text/css">
            <?php
            /* Banner Image */
            if ( $royal_magazine_enable_banner_overlay == 1 ){
                ?>
                    .inner-header-overlay,
                    .hero-slider.overlay .slide-item .bg-image:before {
                        background: #282828;
                        filter: alpha(opacity=65);
                        opacity: 0.65;
                    }
            <?php
        } ?>
        </style>

    <?php }

endif;