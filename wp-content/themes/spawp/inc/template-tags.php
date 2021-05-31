<?php

if ( ! function_exists( 'spawp_logo' ) ) {
    function spawp_logo(){
        $class = array();
        $theme_logo = '';
        $html = '';
        
        if ( function_exists( 'has_custom_logo' ) ) {
            if ( has_custom_logo()  ) {
                $theme_logo .= get_custom_logo();
            }
        }
        
        echo wp_kses_post( $theme_logo );

        if( !has_custom_logo() ){

            $html = '<a class="site-logo '.esc_attr( join( ' ', $class ) ).'" href="' . esc_url(home_url('/')) . '" rel="home">';
            $html .= '<h1 class="site-title mb-2">' . get_bloginfo('name') . '</h1>';
            $html .= '</a>';
            
            $description = get_bloginfo( 'description', 'display' );
            if ( $description || is_customize_preview() ) {
                $html .= '<p class="site-description pb-0">'.$description.'</p>';
            }
        }

        echo wp_kses_post( $html );
    }
}

function spawp_edit_post_link( $link, $post_id, $text ) {
    if ( is_admin() ) {
        return $link;
    }

    $edit_url = get_edit_post_link( $post_id );

    if ( ! $edit_url ) {
        return;
    }

    $text = sprintf(
        wp_kses(
            /* translators: %s: Post title. Only visible to screen readers. */
            __( 'Edit <span class="screen-reader-text">%s</span>', 'spawp' ),
            array(
                'span' => array(
                    'class' => array(),
                ),
            )
        ),
        get_the_title( $post_id )
    );

    return '<div class="post-meta-wrapper post-meta-edit-link-wrapper"><span class="fa fa-edit mr-2"></span><span class="meta-text"><a href="' . esc_url( $edit_url ) . '">' . $text . '</a></span><!-- .post-meta --></div><!-- .post-meta-wrapper -->';

}
add_filter( 'edit_post_link', 'spawp_edit_post_link', 10, 3 );

function spawp_filter_wp_list_pages_item_classes( $css_class, $page, $depth, $args, $current_page ) {

    // Only apply to wp_list_pages() calls with match_menu_classes set to true.
    $match_menu_classes = isset( $args['match_menu_classes'] );

    if ( ! $match_menu_classes ) {
        return $css_class;
    }

    // Add current menu item class.
    if ( in_array( 'current_page_item', $css_class, true ) ) {
        $css_class[] = 'current-menu-item';
    }

    // Add menu item has children class.
    if ( in_array( 'page_item_has_children', $css_class, true ) ) {
        $css_class[] = 'menu-item-has-children';
    }

    return $css_class;

}
add_filter( 'page_css_class', 'spawp_filter_wp_list_pages_item_classes', 10, 5 );

function spawp_add_sub_toggles_to_main_menu( $args, $item, $depth ) {

    // Add sub menu toggles to the Expanded Menu with toggles.
    if ( isset( $args->show_toggles ) && $args->show_toggles ) {

        // Wrap the menu item link contents in a div, used for positioning.
        $args->before = '<div class="ancestor-wrapper">';
        $args->after  = '';

        // Add a toggle to items with children.
        if ( in_array( 'menu-item-has-children', $item->classes, true ) ) {

            $toggle_target_string = '.menu-modal .menu-item-' . $item->ID . ' > .sub-menu';
            $toggle_duration      = spawp_toggle_duration();

            // Add the sub menu toggle.
            $args->after .= '<button class="toggle sub-menu-toggle fill-children-current-color" data-toggle-target="' . $toggle_target_string . '" data-toggle-type="slidetoggle" data-toggle-duration="' . absint( $toggle_duration ) . '" aria-expanded="false"><span class="screen-reader-text">' . __( 'Show sub menu', 'spawp' ) . '</span><i class="fa fa-caret-down"></i></button>';

        }

        // Close the wrapper.
        $args->after .= '</div><!-- .ancestor-wrapper -->';

        // Add sub menu icons to the primary menu without toggles.
    } elseif ( 'primary' === $args->theme_location || 'secondary' === $args->theme_location ) {
        if ( in_array( 'menu-item-has-children', $item->classes, true ) ) {
            $args->after = '<span class="fa fa-caret-down"></span>';
        } else {
            $args->after = '';
        }
    }

    return $args;

}
add_filter( 'nav_menu_item_args', 'spawp_add_sub_toggles_to_main_menu', 10, 3 );

function spawp_toggle_duration() {
    $duration = apply_filters( 'spawp_toggle_duration', 250 );

    return $duration;
}

function spawp_breadcrumbs(){
    $header_image = $header_class = '';
    
    if(has_header_image()){
        $header_image = get_header_image();
        $header_class = 'parallaxie background_image overlay';
    }
    ?>
    <section class="page-header <?php echo esc_attr( $header_class ); ?>" style="background-image:url(<?php echo esc_url( $header_image ); ?>);">
      <div class="container">
        <div class="row">        
          <div class="col-xl-8 col-lg-8 col-md-8 col-12 text-lg-left text-sm-left text-center">
            <h3>
                <?php 
                if ( is_day() ) : 
                        
                    printf( __( 'Daily Archives: %s', 'spawp' ), get_the_date() );
                
                elseif ( is_month() ) :
                
                    printf( __( 'Monthly Archives: %s', 'spawp' ), (get_the_date( 'F Y' ) ));
                    
                elseif ( is_year() ) :
                
                    printf( __( 'Yearly Archives: %s', 'spawp' ), (get_the_date( 'Y' ) ) );
                    
                elseif ( is_category() ) :
                
                    printf( __( 'Category Archives: %s', 'spawp' ), (single_cat_title( '', false ) ));

                elseif ( is_tag() ) :
                
                    printf( __( 'Tag Archives: %s', 'spawp' ), (single_tag_title( '', false ) ));
                    
                elseif ( is_404() ) :

                    printf( __( 'Error 404', 'spawp' ));
                    
                elseif ( is_author() ) :
                
                    printf( __( 'Author: %s', 'spawp' ), (get_the_author( '', false ) ));

                elseif ( is_archive() ):        
                    
                    printf( __( 'Archives: %s', 'spawp' ), (get_the_archive_title( '', false ) ));

                else :
                        the_title();
                endif;
                ?>
            </h3>
          </div>
          <div class="col-xl-4 col-lg-4 col-md-4 col-12 text-lg-right text-sm-right text-center">
            <ul>
            <?php 

            $showOnHome = esc_html__('1','spawp');

            $delimiter  = '';

            $home       = esc_html__('Home','spawp');

            $showCurrent= esc_html__('1','spawp');

            $before     = '<li class="active">';
            
            $after      = '</li>';
         
            global $post;
            $homeLink = home_url();

            if ( is_home() || is_front_page() ) {
         
            if ($showOnHome == 1) echo '<li><a href="' . esc_url($homeLink) . '">' . esc_html($home) . '</a></li>';
         
            } else {
         
            echo '<li><a href="' . esc_url($homeLink) . '">' . esc_html($home) . '</a></li>';
         
            if ( is_category() ) {

                $thisCat = get_category(get_query_var('cat'), false);
                if ($thisCat->parent != 0) echo get_category_parents($thisCat->parent, TRUE, ' ' . ' ');
                echo $before . esc_html__('Archive by category','spawp').' "' . esc_html(single_cat_title('', false)) . '"' .$after;
                
            } elseif ( is_search() ) {

                echo $before . esc_html__('Search results for ','spawp').' "' . esc_html(get_search_query()) . '"' . $after;
            
            } elseif ( is_day() ) {

                echo '<li><a href="' . esc_url(get_year_link(get_the_time('Y'))) . '">' . esc_html(get_the_time('Y')) . '</a></li> ';
                echo '<li><a href="' . esc_url(get_month_link(get_the_time('Y'),get_the_time('m'))) . '">' . esc_html(get_the_time('F')) . '</a></li> ';
                echo $before . esc_html(get_the_time('d')) . $after;

            } elseif ( is_month() ) {

                echo '<li><a href="' . esc_url(get_year_link(get_the_time('Y'))) . '">' . esc_html(get_the_time('Y')) . '</a> ' . esc_attr($delimiter);
                echo $before . esc_html(get_the_time('F')) . $after;

            } elseif ( is_year() ) {

                echo $before . esc_html(get_the_time('Y')) . $after;

            } elseif ( is_single() && !is_attachment() ) {

                if ( get_post_type() != 'post' ) {

                    $post_type = get_post_type_object(get_post_type());
                    $slug = $post_type->rewrite;
                    echo '<li><a href="' . esc_url($homeLink) . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a>';
                    if ($showCurrent == 1) echo ' ' . esc_attr($delimiter) . $before . esc_html(get_the_title()) . $after;
                
                } else {

                    $cat = get_the_category(); $cat = $cat[0];
                    $cats = get_category_parents($cat, TRUE, '' . esc_attr($delimiter) . '');
                    if ($showCurrent == 0) $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
                    echo $before . $cats . $after;
                    if ($showCurrent == 1) echo $before . esc_html(get_the_title()) . $after;

                }
         
            } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {

                if ( class_exists( 'WooCommerce' ) ) {

                    if ( is_shop() ) {

                        echo $before . woocommerce_page_title( false ) . $after;

                    }else{
                        if(get_post_type() == 'product'){
                            $terms = get_the_terms(get_the_ID(), 'product_cat', '' , '' );
                            if($terms) {
                                echo '<li>';
                                the_terms( get_the_ID() , 'product_cat' , '' , ' </li><li>' );
                                echo ' ' . $delimiter . '<i class="fa fa-angle-double-right"></i> ' . '<span class="current">' . get_the_title() . '</span>';
                            }else{
                                echo '<span class="current">' . get_the_title() . '</span>';
                            }
                        }
                    }           

                } else {

                    $post_type = get_post_type_object(get_post_type());
                    echo $before . $post_type->labels->singular_name . $after;

                }   

            } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {

                $post_type = get_post_type_object(get_post_type());
                echo $before . $post_type->labels->singular_name . $after;

            } elseif ( is_attachment() ) {

                $parent = get_post($post->post_parent);
                $cat = get_the_category($parent->ID); 
                if(!empty($cat)){
                $cat = $cat[0];
                echo get_category_parents($cat, TRUE, ' ' . esc_attr($delimiter) . '');
                }
                echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a>';
                if ($showCurrent == 1) echo ' ' . esc_attr($delimiter) . ' ' . $before . esc_html(get_the_title()) . $after;
         
            } elseif ( is_page() && !$post->post_parent ) {

                if ($showCurrent == 1) echo $before . esc_html(get_the_title()) . $after;

            } elseif ( is_page() && $post->post_parent ) {

                $parent_id  = $post->post_parent;
                $breadcrumbs = array();

                while ($parent_id) {
                    $page = get_page($parent_id);
                    $breadcrumbs[] = '<a href="' . esc_url(get_permalink($page->ID)) . '">' . esc_html(get_the_title($page->ID)) . '</a>' . '';
                    $parent_id  = $page->post_parent;
                }
                
                $breadcrumbs = array_reverse($breadcrumbs);

                for ($i = 0; $i < count($breadcrumbs); $i++) {
                    echo $breadcrumbs[$i];
                    if ($i != count($breadcrumbs)-1) echo ' ' . esc_attr($delimiter) . '';
                }

                if ($showCurrent == 1) echo ' ' . esc_attr($delimiter) . ' ' . $before . esc_html(get_the_title()) . $after;
         
            } elseif ( is_tag() ) {

                echo $before . esc_html__('Posts tagged ','spawp').' "' . single_tag_title('', false) . '"' . $after;
            
            } elseif ( is_author() ) {

                global $author;
                $userdata = get_userdata($author);
                echo $before . esc_html__('Article posted by ','spawp').'' . $userdata->display_name . $after;
            
            } elseif ( is_404() ) {

                echo $before . esc_html__('Error 404 ','spawp'). $after;

            }
            
            if ( get_query_var('paged') ) {

                if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo '';
                echo ' ( ' . esc_html__('Page','spawp') . '' . esc_html(get_query_var('paged')). ' )';
                if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo '';
            
            }
         
            echo '</li>';
         
          }
             ?>
            </ul>
          </div>
        </div>
      </div>
    </section>
    <?php
}

if(!function_exists('spawp_get_option')){
    function spawp_get_option( $key = 'top_header_show' ){
        $option = wp_parse_args(  get_option( 'spawp_option', array() ), spawp_theme_default_data() );
        return $option[$key];
    }
}

function spawp_frontpage_section_header($sub_title='',$subtitle_color='',$title='',$title_color='',$description='',$description_color='',$divider_show=false,$divider_type='divider div-transparent',$divider_width='w-30'){
    ?>
    <div class="row">
      <div class="col-xl-12 col-lg-12 col-md-12 col-12 text-center">
         <?php if($sub_title){ ?>
        <span class="section_subtitle" <?php if($subtitle_color){ echo 'style="color:'.$subtitle_color.';"'; } ?>><?php echo esc_html($sub_title); ?></span>
        <?php } ?>

        <?php if($title){ ?>
        <h2 class="section_title" <?php if($title_color){ echo 'style="color:'.$title_color.';"'; } ?>><?php echo wp_kses_post($title); ?></h2> <!-- <b> for primary color -->
        <?php } ?>

        <?php if($divider_show){ ?> 
        <div class="divider div-transparent <?php echo esc_attr($divider_type.' '.$divider_width); ?>"></div>
        <?php } ?>

        <?php if($description){ ?>
        <p class="section_description" <?php if($title_color){ echo 'style="color:'.$description_color.';"'; } ?>><?php echo wp_kses_post($description); ?></p>
        <?php } ?>
      </div>
    </div>
    <?php
}
add_action('spawp_frontpage_section_header','spawp_frontpage_section_header',20,9);


if ( ! function_exists( 'spawp_get_sidebar_layout' ) ) {
    function spawp_get_sidebar_layout() {
        $sidebar_layout = spawp_get_option( 'sidebar_layout' );

        // For single page template
        if ( is_single() ) {
            $sidebar_layout = spawp_get_option( 'sidebar_single_layout' );
        }

        // For singular page template
        if ( is_singular() ) {
            $meta = get_post_meta( get_the_ID(), '_spawp-sidebar-layout-meta', true );

            if ( $meta ) {
                $sidebar_layout = $meta;
            }
        }

        // For archive page template
        if ( is_home() || is_archive() || is_search() || is_tax() ) {
            $sidebar_layout = spawp_get_option( 'sidebar_blog_layout' );
        }

        // woocommerce
        if ( 
            class_exists('woocommerce') && is_woocommerce() || 
            class_exists('woocommerce') && is_shop() || 
            class_exists('woocommerce') && is_cart() || 
            class_exists('woocommerce') && is_product() || 
            class_exists('woocommerce') && is_checkout() || 
            class_exists('woocommerce') && is_account_page() 
        ) {
            $sidebar_layout = 'right-sidebar';
        }


        return apply_filters( 'spawp_sidebar_layout', $sidebar_layout );
    }
}

function spawp_get_content_area_classes(){
   $sidebar_layout = spawp_get_sidebar_layout();
    $class = '';
    if($sidebar_layout=='left-sidebar' || $sidebar_layout=='right-sidebar'){
        $class = 'col-lg-8 col-md-8 col-sm-8';
    }else if($sidebar_layout=='no-sidebar'){
        $class = 'col-lg-12 col-md-12 col-sm-12';
    }else{
        $class = 'col-lg-6 col-md-6 col-sm-6';
    }
    if($sidebar_layout=='both-left'){
        $class .= ' order-3';
    }else if($sidebar_layout=='both-right'){
        $class .= ' order-1';
    }else if($sidebar_layout=='both-sidebars'){
        $class .= ' order-2';
    }
    return $class;
}

function spawp_get_right_sidebar_classes(){
   $sidebar_layout = spawp_get_sidebar_layout();
    $class = '';
    if($sidebar_layout=='left-sidebar' || $sidebar_layout=='right-sidebar'){
        $class = 'col-lg-4 col-md-4 col-sm-4';
    }else{
        $class = 'col-lg-3 col-md-3 col-sm-3';
    }
    if($sidebar_layout=='both-left'){
        $class .= ' order-2';
    }else if($sidebar_layout=='both-right'){
        $class .= ' order-3';
    }else if($sidebar_layout=='both-sidebars'){
        $class .= ' order-1';
    }
    return $class;
}

function spawp_get_left_sidebar_classes(){
   $sidebar_layout = spawp_get_sidebar_layout();
    $class = '';
    if($sidebar_layout=='left-sidebar' || $sidebar_layout=='right-sidebar'){
        $class = 'col-lg-4 col-md-4 col-sm-4';
    }else{
        $class = 'col-lg-3 col-md-3 col-sm-3';
    }
    if($sidebar_layout=='both-left'){
        $class .= ' order-1';
    }else if($sidebar_layout=='both-right'){
        $class .= ' order-2';
    }else if($sidebar_layout=='both-sidebars'){
        $class .= ' order-3';
    }
    return $class;
}


if ( ! function_exists( 'spawp_menu_search_icon' ) ) {
    add_filter( 'wp_nav_menu_items', 'spawp_menu_search_icon', 10, 2 );
    function spawp_menu_search_icon( $nav, $args ) {
        $search_icon = spawp_get_option('nav_search_show');

        $form = sprintf(__('<form role="search" method="get" class="search-form search-nav" action="%1$s">
            <input type="search" class="search-field" placeholder="%2$s" value="%3$s" name="s" />
          </form>','spawp'),
        esc_url( home_url( '/' ) ),
        esc_attr_x( 'Search &hellip;', 'placeholder', 'spawp' ),
        get_search_query()
        );

        if ( $search_icon && 'primary' === $args->theme_location ) {
            return sprintf(__('%1$s<li class="menu-search-icon"><a href="#"><i class="fa fa-search"></i></a>%2$s</li>','spawp'),
                $nav,
                $form
            );
        }

        return $nav;
    }
}


if ( ! function_exists( 'spawp_get_footer_widgets_layout' ) ) {
    function spawp_get_footer_widgets_layout() {
        $ft_widget_setting = spawp_get_option( 'footer_widget_setting' );

        if ( is_singular() ) {
            $meta = get_post_meta( get_the_ID(), '_spawp-footer-widget-meta', true );

            if ( $meta ) {
                $ft_widget_setting = $meta;
            }
        }

        return apply_filters( 'spawp_get_footer_widgets_layout', $ft_widget_setting );
    }
}

if ( ! function_exists( 'spawp_get_content_container_layout' ) ) {
    function spawp_get_content_container_layout() {
        $content_container_setting = 'contained';

        if ( is_singular() ) {
            $meta = get_post_meta( get_the_ID(), '_spawp-full-width-content', true );

            if ( $meta ) {
                $content_container_setting = $meta;
            }
        }

        return apply_filters( 'spawp_get_content_container_layout', $content_container_setting );
    }
}

function spawp_pll_string_register_helper( $theme_mod, $default = false, $name ) {
    if ( ! function_exists( 'pll_register_string' ) ) {
        return;
    }
    $option = wp_parse_args(  get_option( 'spawp_option', array() ), spawp_theme_default_data() );
    $repeater_content = $option[$theme_mod];

    $repeater_content = json_decode( $repeater_content );
    if ( ! empty( $repeater_content ) ) {
        foreach ( $repeater_content as $repeater_item ) {
            foreach ( $repeater_item as $field_name => $field_value ) {

                if(
                    $field_name == 'content_align' ||
                    $field_name == 'image_url' ||
                    $field_name == 'currency' ||
                    $field_name == 'price' ||
                    $field_name == 'icon_value'
                ){
                    continue;
                }

                if ( $field_value !== 'undefined' ) {
                    if ( $field_name === 'social_repeater' ) {
                        $social_repeater_value = json_decode( $field_value );
                        if ( ! empty( $social_repeater_value ) ) {
                            foreach ( $social_repeater_value as $social ) {
                                foreach ( $social as $key => $value ) {
                                    if ( $key === 'link' ) {
                                        pll_register_string( 'Social link', $value, $name );
                                    }
                                    if ( $key === 'icon' ) {
                                        pll_register_string( 'Social icon', $value, $name );
                                    }
                                }
                            }
                        }
                    } else {
                        if ( $field_name !== 'id' ) {
                            $f_n = ucfirst( $field_name );
                            pll_register_string( $f_n, $field_value, $name );
                        }
                    }
                }
            }
        }
    }
}

function spawp_register_strings() {
    spawp_pll_string_register_helper( 'slider_content', $default = false, 'Slider section' );
    spawp_pll_string_register_helper( 'service_content', $default = false, 'Service section' );
    spawp_pll_string_register_helper( 'feature_content', $default = false, 'Feature section' );
    spawp_pll_string_register_helper( 'team_content', $default = false, 'Team section' );
    spawp_pll_string_register_helper( 'testimonial_content', $default = false, 'Testimonial section' );
}
add_action( 'after_setup_theme', 'spawp_register_strings', 30 );

function spawp_translate_single_string( $original_value, $domain ) {
  if ( is_customize_preview() ) {
    $wpml_translation = $original_value;
  } else {
    $wpml_translation = apply_filters( 'wpml_translate_single_string', $original_value, $domain, $original_value );
    if ( $wpml_translation === $original_value && function_exists( 'pll__' ) ) {
      return pll__( $original_value );
    }
  }
  return $wpml_translation;
}
add_filter( 'spawp_translate_single_string', 'spawp_translate_single_string', 10, 2 );


/**
 * Content starter pack data
 */
function spawp_wp_starter_pack() {

    // Define and register starter contents

    $starter_content = array(
        'widgets'     => array(
            'sidebar'   => array(
                'search',
                'categories',
                'tag',
                'meta',
            ),
            'footer-1'    => array(
                'my_text' => array( 'text', 
                    array(
                    'title' => _x('About US', 'My text starter contents', 'spawp'),
                    'text'  => _x('Lorem ipsum dolor sit amet consectetur dipisicing elit sed do eiusmod tempor incididunt ut labore et dolore magna aliqua Ut enim ad minim veniam.', 'My text starter contents', 'spawp')
                ) ) ),
            'footer-2'    => array(
                'search' => array(
                    'search',
                    array(
                        'title' => _x( 'search', 'My text starter contents', 'spawp' ),
                    )
                ),
            ),
            'footer-3'    => array(
                'categories'=> array(
                    'categories',
                    array(
                        'title' => _x( 'categories', 'My text starter contents', 'spawp' ),
                    )
                ),
            ),
            'footer-4'    => array(
                'calendar'=> array(
                    'calendar',
                    array(
                        'title' => _x( 'calendar', 'My text starter contents', 'spawp' ),
                    )
                ),
            ),
            'sidebar-2' => array(
                'my_text' => array(
                    'text',
                    array(
                        'title' => _x('About US', 'My text starter contents', 'spawp'),
                        'text'  =>  _x('Lorem ipsum dolor sit amet consectetur dipisicing elit sed do eiusmod tempor incididunt ut labore et dolore magna aliqua Ut enim ad minim veniam.', 'My text starter contents', 'spawp'),
                    ),
                ),
            ),
        ),
        'posts'       => array(
            'home',
            'about',
            'contact',
            'blog',
        ),
        'options'     => array(
            'show_on_front'  => 'page',
            'page_on_front'  => '{{home}}',
            'page_for_posts' => '{{blog}}',
            'header_image'   => '',
        ),
        'nav_menus'   => array(
            'primary'    => array(
                'name'  => __( 'Primary Menu', 'spawp' ),
                'items' => array(
                    'link_home',
                    'page_about',
                    'page_blog',
                    'page_contact',
                    'page_loremuipsum' => array(
                        'type'      => 'post_type',
                        'object'    => 'page',
                        'object_id' => '{{loremipsum}}',
                    ),
                ),
            ),
        ),
    );

    return apply_filters( 'spawp_wp_starter_pack', $starter_content );
}


if ( ! function_exists( 'spawp_edit_link' ) ) :
    function spawp_edit_link() {
        edit_post_link(
            sprintf(
                /* translators: %s: Post title. */
                __( 'Edit<span class="screen-reader-text"> "%s"</span>', 'spawp' ),
                get_the_title()
            ),
            '<span class="edit-link">',
            '</span>'
        );
    }
endif;

// Theme Preloader
if( !function_exists('spawp_preloader') ){
    function spawp_preloader(){
        $is_preloader = spawp_get_option('preloader');

        if($is_preloader){
        ?>
        <div id="overlayer">
          <span class="loader">
            <span class="loader-inner"></span>
          </span>
        </div>
        <?php
        }
    }
    add_action('spawp_before_outer_wrap','spawp_preloader');
}