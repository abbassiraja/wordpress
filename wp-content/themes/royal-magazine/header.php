<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package royal-magazine
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php if (function_exists('wp_body_open')) {
    wp_body_open();
}
?>
<?php if (royal_magazine_get_option('enable_preloader_option') == 1) { ?>
    <div class="preloader">
        <div class="preloader-wrapper">
            <div class="line odd"></div>
            <div class="line even"></div>
            <div class="line odd-1"></div>
            <div class="line even-1"></div>
        </div>
    </div>
<?php } ?>
<!-- full-screen-layout/boxed-layout -->
<?php if (royal_magazine_get_option('homepage_layout_option') == 'full-width') {
    $royal_magazine_homepage_layout = 'full-screen-layout';
} elseif (royal_magazine_get_option('homepage_layout_option') == 'boxed') {
    $royal_magazine_homepage_layout = 'boxed-layout';
}
?>
<div id="page" class="site site-bg <?php echo esc_attr($royal_magazine_homepage_layout); ?>">
    <a class="skip-link screen-reader-text" href="#main"><?php esc_html_e('Skip to content', 'royal-magazine'); ?></a>
    <header id="masthead" class="site-header" role="banner">
        <?php $enable_top_bar = absint(royal_magazine_get_option('news_enable_top_bar'));
        if ($enable_top_bar == 1) { ?>
            <div class="top-bar alt-bgcolor container-fluid no-padding">
                <div class="container">
                    <?php
                    $royal_magazine_text_1 = royal_magazine_get_option('magazine_title_text_1');
                    if (!empty($royal_magazine_text_1)) { ?>
                        <div class="breaking-news">
                            <h3 class="primary-font text-uppercase"><?php echo esc_html($royal_magazine_text_1); ?></h3>
                        </div>
                    <?php } ?>
                    <div class="news primary-bgcolor">
                        <?php
                        $royal_magazine_text_2 = royal_magazine_get_option('magazine_title_text_2');
                        if (!empty($royal_magazine_text_2)) { ?>
                            <span
                                class="secondary-bgcolor primary-font"><?php echo esc_html($royal_magazine_text_2); ?></span>
                        <?php } ?>
                        <?php $tinker_args = array(
                            'post_type' => 'post',
                            'posts_per_page' => 5,
                            'ignore_sticky_posts' => 1,
                        );
                        $royal_magazine_tinker_post_query = new WP_Query($tinker_args);
                        if ($royal_magazine_tinker_post_query->have_posts()) : ?>
                            <div data-speed="10000" data-direction="left" class="marquee">
                                <?php while ($royal_magazine_tinker_post_query->have_posts()) : $royal_magazine_tinker_post_query->the_post();
                                    ?>
                                    <a href="<?php the_permalink(); ?>" class="alt-font">
                                        <span
                                            class="primary-font"><?php printf(_x('%s ago', '%s = human-readable time difference', 'royal-magazine'), human_time_diff(get_the_time('U'), current_time('timestamp'))); ?></span><?php the_title(); ?>
                                    </a>
                                    <?php
                                endwhile; ?>
                            </div>
                            <?php wp_reset_postdata();
                        endif; ?>
                    </div>
                    <?php $enable_date = royal_magazine_get_option('show_top_section_date');
                    if ($enable_date == 1) { ?>
                        <div class="twp-date primary-font">
                            <?php $time = current_time('timestamp');
                            echo date_i18n('l, M j, Y',$time); ?>
                        </div>
                    <?php } ?>
                    <?php if (has_nav_menu('social')) { ?>
                        <div class="twp-social-share">
                            <div class="cd-stretchy-nav social-icons ">
                                <a class="cd-nav-trigger ion-android-share-alt" href="javascript:;"></a>
                                <?php
                                wp_nav_menu(
                                    array('theme_location' => 'social',
                                        'link_before' => '<span class="screen-reader-text">',
                                        'link_after' => '</span>',
                                        'menu_id' => 'social-menu',
                                        'fallback_cb' => false,
                                        'menu_class' => 'twp-social-nav',
                                        'container_class' => 'social-menu-container'
                                    )); ?>

                                <span aria-hidden="true" class="stretchy-nav-bg alt-bgcolor"></span>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
        <div class="header-middle">
            <div class="container container-bg">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="site-branding">
                            <?php
                            royal_magazine_the_custom_logo();
                            if (is_front_page() && is_home()) : ?>
                                <span class="site-title secondary-font">
                                <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                                    <?php bloginfo('name'); ?>
                                </a>
                            </span>
                            <?php else : ?>
                                <span class="site-title secondary-font">
                                <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                                    <?php bloginfo('name'); ?>
                                </a>
                            </span>
                            <?php endif;
                            $description = get_bloginfo('description', 'display');
                            if ($description || is_customize_preview()) : ?>
                                <p class="site-description"><?php echo esc_html( $description ); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="top-header primary-bgcolor">
            <?php
            $navigation_collaps_enable = absint(royal_magazine_get_option('show_navigation_collaps'));
            $enable_header_search = absint(royal_magazine_get_option('enable_header_search'));
            ?>
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <nav class="main-navigation" role="navigation">
                            <?php if ($navigation_collaps_enable == 1) { ?>
                                <span class="popular-post">
                                    <a href="javascript:void(0)" class="skip-link-popular-post-start"></a>
                                    <a data-toggle="collapse" href="#trendingCollapse" aria-expanded="false"
                                      aria-controls="trendingCollapse" class="trending-news">
                                       <span class="arrow"></span>
                                    </a>
                                </span>

                                <div class="collapse primary-bgcolor" id="trendingCollapse">
                                    <div class="container pt-20 pb-20 pt-md-40">
                                        <div class="row">
                                            <?php
                                            $royal_magazine_nav_collaps_args = array(
                                                'post_type' => 'post',
                                                'posts_per_page' => 6,
                                                'orderby' => 'comment_count',
                                                'ignore_sticky_posts' => 1
                                            );
                                            $royal_magazine_nav_collaps_query = new WP_Query($royal_magazine_nav_collaps_args);
                                            if ($royal_magazine_nav_collaps_query->have_posts()) :
                                                while ($royal_magazine_nav_collaps_query->have_posts()) :
                                                    $royal_magazine_nav_collaps_query->the_post();
                                                    if (has_post_thumbnail()) {
                                                        $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'thumbnail');
                                                        $url = $thumb['0'];
                                                    } else {
                                                        $url = get_template_directory_uri() . '/images/no-image.jpg';
                                                    }
                                                    ?>
                                                    <div class="col-md-4 col-sm-6 clear-col mb-20">
                                                        <div class="trending-border clearfix pb-20">
                                                            <div class="row">
                                                                <div class="full-item-image item-image col-xs-4 col-sm-4 pull-left">
                                                                    <div class="full-item-image item-image hover_effect-2">
                                                                        <a href="<?php the_permalink(); ?>" class="news-item-thumb">
                                                                            <img src="<?php echo esc_url($url); ?>">
                                                                            <span class="twp-corner">
                                                                                <i class="ion-ios-photos-outline img-icon"></i>
                                                                            </span>
                                                                        </a>
                                                                    </div>
                                                                </div>

                                                                <div class="full-item-details col-xs-8 col-sm-8">
                                                                    <div class="full-item-metadata">
                                                                        <div class="item-metadata posts-date primary-font">
                                                                            <small>
                                                                                <span><?php echo esc_html(get_the_date('M j Y')); ?></span>
                                                                            </small>
                                                                        </div>
                                                                    </div>
                                                                    <div class="full-item-content">
                                                                        <h4 class="item-title mt-0 pt-0">
                                                                            <a href="<?php the_permalink(); ?>">
                                                                                <?php the_title(); ?>
                                                                            </a>
                                                                        </h4>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                    wp_reset_postdata();
                                                endwhile;
                                            endif;
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <a href="javascript:void(0)" class="skip-link-popular-post-end-skip"></a>
                                <a href="javascript:void(0)" class="skip-link-popular-post-end"></a>

                            <?php } ?>

                            <?php if( $enable_header_search ){ ?>
                                <a href="javascript:void(0)" class="icon-search">
                                    <i class="twp-icon twp-icon-2x ion-ios-search"></i>
                                </a>
                            <?php } ?>

                            <a class="skip-link-menu-start" href="javascript:void(0)"></a>
                            <a href="javascript:void(0)" class="toggle-menu" aria-controls="primary-menu" aria-expanded="false">
                                 <span class="screen-reader-text">
                                    <?php esc_html_e('Primary Menu', 'royal-magazine'); ?>
                                </span>
                                <i class="ham"></i>
                            </a>

                            <?php wp_nav_menu(array(
                                'theme_location' => 'primary',
                                'menu_id' => 'primary-menu',
                                'container' => 'div',
                                'container_class' => 'menu'
                            )); ?>
                            <a class="skip-link-menu-end-skip" href="javascript:void(0)"></a>
                            <a class="skip-link-menu-end" href="javascript:void(0)"></a>

                        </nav><!-- #site-navigation -->
                    </div>
                </div>
            </div>

            <?php if( $enable_header_search ){ ?>
                <div class="popup-search">
                    <div class="table-align">
                        <a class="skip-link-search-start" href="javascript:void(0)"></a>
                        
                        <div class="table-align-cell v-align-middle">
                            <?php get_search_form(); ?>
                        </div>
                        <a href="javascript:void(0)" class="close-popup"></a>
                        <a class="skip-link-search-end" href="javascript:void(0)"></a>
                    </div>
                </div>
            <?php } ?>
            
        </div>
    </header>
    <!-- #masthead -->

    <!-- Innerpage Header Begins Here -->
    <?php
    if (1 == (royal_magazine_get_option('show_slider_on_blog_page'))) {
        if (is_front_page() || is_home()) {
            do_action('royal_magazine_action_front_page');
        } else {
            do_action('royal-magazine-page-inner-title');
        }
    } else {
        if (is_front_page() && ! is_home()){
            do_action('royal_magazine_action_front_page');
        } else {
            do_action('royal-magazine-page-inner-title');
        }
    }
    ?>
    <!-- Innerpage Header Ends Here -->
    <div id="content" class="site-content">