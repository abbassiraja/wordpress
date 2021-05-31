<?php
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function royal_magazine_widgets_init()
{

    register_sidebar(array(
        'name' => esc_html__('Main Sidebar', 'royal-magazine'),
        'id' => 'sidebar-1',
        'description' => esc_html__('Add widgets here.', 'royal-magazine'),
        'before_widget' => '<section id="%1$s" class="widget clearfix %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title secondary-font">',
        'after_title' => '</h2>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Home Page Sidebar One', 'royal-magazine'),
        'id' => 'sidebar-home-1',
        'description' => esc_html__('Add widgets here.', 'royal-magazine'),
        'before_widget' => '<section id="%1$s" class="widget clearfix %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title secondary-font mt-20 mb-20 clearfix">',
        'after_title' => '</h2>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Home Page Sidebar Two', 'royal-magazine'),
        'id' => 'sidebar-home-2',
        'description' => esc_html__('Add widgets here.', 'royal-magazine'),
        'before_widget' => '<section id="%1$s" class="widget clearfix %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title secondary-font mt-20 mb-20 clearfix">',
        'after_title' => '</h2>',
    ));

    $royal_magazine_footer_widgets_number = royal_magazine_get_option('number_of_footer_widget');
    if ($royal_magazine_footer_widgets_number > 0) {
        register_sidebar(array(
            'name' => esc_html__('Footer Column One', 'royal-magazine'),
            'id' => 'footer-col-one',
            'description' => esc_html__('Displays items on footer section.', 'royal-magazine'),
            'before_widget' => '<div id="%1$s" class="widget primary-font clearfix %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h2 class="widget-title primary-font">',
            'after_title' => '</h2>',
        ));
        if ($royal_magazine_footer_widgets_number > 1) {
            register_sidebar(array(
                'name' => esc_html__('Footer Column Two', 'royal-magazine'),
                'id' => 'footer-col-two',
                'description' => esc_html__('Displays items on footer section.', 'royal-magazine'),
                'before_widget' => '<div id="%1$s" class="widget primary-font clearfix %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<h2 class="widget-title primary-font">',
                'after_title' => '</h2>',
            ));
        }
        if ($royal_magazine_footer_widgets_number > 2) {
            register_sidebar(array(
                'name' => esc_html__('Footer Column Three', 'royal-magazine'),
                'id' => 'footer-col-three',
                'description' => esc_html__('Displays items on footer section.', 'royal-magazine'),
                'before_widget' => '<div id="%1$s" class="widget primary-font clearfix %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<h2 class="widget-title primary-font">',
                'after_title' => '</h2>',
            ));
        }
    }
}

add_action('widgets_init', 'royal_magazine_widgets_init');
