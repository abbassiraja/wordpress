<?php
/**
 * Theme widgets.
 *
 * @package Royal Magazine
 */

// Load widget base.
require_once get_template_directory() . '/inc/widgets/widget-base-class.php';

if (!function_exists('royal_magazine_load_widgets')) :
    /**
     * Load widgets.
     *
     * @since 1.0.0
     */
    function royal_magazine_load_widgets()
    {
        // Royal_Magazine_Grid_Panel widget.
        register_widget('Royal_Magazine_widget_style_1');

        // list panel widget.
        register_widget('Royal_Magazine_widget_style_2');

        // Recent Post widget.
        register_widget('Royal_Magazine_sidebar_widget');

        // Tabbed widget.
        register_widget('Royal_Magazine_Tabbed_Widget');

        // Auther widget.
        register_widget('Royal_Magazine_Author_Post_widget');

    }
endif;
add_action('widgets_init', 'royal_magazine_load_widgets');

/*Grid Panel widget*/
if (!class_exists('Royal_Magazine_widget_style_1')) :

    /**
     * Latest news widget Class.
     *
     * @since 1.0.0
     */
    class Royal_Magazine_widget_style_1 extends Royal_Magazine_Widget_Base
    {

        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $opts = array(
                'classname' => 'royal_magazine_grid_panel_widget',
                'description' => __('Displays posts from selected category in grid.', 'royal-magazine'),
                'customize_selective_refresh' => true,
            );
            $fields = array(
                'title' => array(
                    'label' => __('Title:', 'royal-magazine'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
                'post_category' => array(
                    'label' => __('Select Category:', 'royal-magazine'),
                    'type' => 'dropdown-taxonomies',
                    'show_option_all' => __('All Categories', 'royal-magazine'),
                ),
                'post_number' => array(
                    'label' => __('Number of Posts:', 'royal-magazine'),
                    'type' => 'number',
                    'default' => 4,
                    'css' => 'max-width:60px;',
                    'min' => 1,
                    'max' => 10,
                ),
            );

            parent::__construct('royal-magazine-grid-layout', __('RM: Grid Content Widget', 'royal-magazine'), $opts, array(), $fields);
        }

        /**
         * Outputs the content for the current widget instance.
         *
         * @since 1.0.0
         *
         * @param array $args Display arguments.
         * @param array $instance Settings for the current widget instance.
         */
        function widget($args, $instance)
        {

            $params = $this->get_params($instance);

            echo $args['before_widget'];

            if (!empty($params['title'])) {
                echo $args['before_title'] . esc_html( $params['title'] ) . $args['after_title'];
            }

            $qargs = array(
                'posts_per_page' => absint($params['post_number']),
                'no_found_rows' => true,
            );
            if (absint($params['post_category']) > 0) {
                $qargs['cat'] = absint($params['post_category']);
            }
            
            $recent_posts_query = new WP_Query($qargs);
            if ($recent_posts_query->have_posts()) :  ?>
            
            <div class="grid-item clearfix">
                <div class="twp-row row">
                    <?php while ($recent_posts_query->have_posts()) :
                        $recent_posts_query->the_post(); ?>
                            <div class="col col-one-third clear-col">
                                <div class="grid-item-image item-image">
                                    <figure class="twp-article">
                                        <div class="twp-article-item">
                                            <div class="article-item-image">
                                                <?php if (has_post_thumbnail()) {
                                                    $thumb = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'royal-magazine-900-600' );
                                                    $url = $thumb['0'];
                                                } else {
                                                    $url = get_template_directory_uri() . '/images/no-image-900x600.jpg';
                                                }
                                                ?>
                                                <img src="<?php echo esc_url($url); ?>" alt="<?php the_title_attribute(); ?>">
                                            </div>
                                            <div class="hover_effect hover_effect-1">
                                                <a href="<?php the_permalink(); ?>" class="table-align" tabindex="0">
                                                    <div class="table-align-cell v-align-middle">
                                                        <i class="ion-ios-plus-outline meta-icon meta-icon-big"></i>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </figure>
                                </div>
                                <div class="grid-item-details">
                                    <div class="grid-item-metadata pt-10 primary-font">
                                        <div class="item-metadata posts-date small-font">
                                            <?php echo esc_html__( 'Posted On: ', 'royal-magazine' ); ?> 
                                            <span> <?php the_time('j M Y'); ?></span>
                                        </div>
                                    </div>
                                    <div class="grid-item-content">
                                        <h3 class="grid-item-title item-title">
                                            <a href="<?php the_permalink(); ?>">
                                                <?php the_title(); ?>
                                            </a>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        <?php 
                        endwhile; ?>
                </div>
            </div>
            <?php wp_reset_postdata(); ?>

        <?php endif; ?>
            <?php echo $args['after_widget'];
        }
    }
endif;

/*Grid Panel widget*/
if (!class_exists('Royal_Magazine_widget_style_2')) :

    /**
     * Latest news widget Class.
     *
     * @since 1.0.0
     */
    class Royal_Magazine_widget_style_2 extends Royal_Magazine_Widget_Base
    {

        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $opts = array(
                'classname' => 'royal_magazine_list_panel_widget',
                'description' => __('Displays post form selected category on List Format.', 'royal-magazine'),
                'customize_selective_refresh' => true,
            );
            $fields = array(
                'title' => array(
                    'label' => __('Title:', 'royal-magazine'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
                'post_category' => array(
                    'label' => __('Select Category:', 'royal-magazine'),
                    'type' => 'dropdown-taxonomies',
                    'show_option_all' => __('All Categories', 'royal-magazine'),
                ),
                'post_number' => array(
                    'label' => __('Number of Posts:', 'royal-magazine'),
                    'type' => 'number',
                    'default' => 6,
                    'css' => 'max-width:60px;',
                    'min' => 1,
                    'max' => 10,
                ),
                'excerpt_length' => array(
                    'label' => __('Excerpt Length:', 'royal-magazine'),
                    'description' => __('Number of words', 'royal-magazine'),
                    'type' => 'number',
                    'css' => 'max-width:60px;',
                    'default' => 20,
                    'min' => 0,
                    'max' => 200,
                ),
            );

            parent::__construct('royal-magazine-list-layout', __('RM: Panel Content Widget', 'royal-magazine'), $opts, array(), $fields);
        }

        /**
         * Outputs the content for the current widget instance.
         *
         * @since 1.0.0
         *
         * @param array $args Display arguments.
         * @param array $instance Settings for the current widget instance.
         */
        function widget($args, $instance)
        {

            $params = $this->get_params($instance);

            echo $args['before_widget'];

            if (!empty($params['title'])) {
                echo $args['before_title'] . esc_html( $params['title'] ) . $args['after_title'];
            }

            $qargs = array(
                'posts_per_page' => absint($params['post_number']),
                'no_found_rows' => true,
            );
            if (absint($params['post_category']) > 0) {
                $qargs['cat'] = absint($params['post_category']);
            }
            
            $i = 1;
            $recent_posts_query = new WP_Query($qargs);
            if ($recent_posts_query->have_posts()) :  ?>
            <div class="twp-widget-wrapper clearfix">
                <?php while ($recent_posts_query->have_posts()) :
                        $recent_posts_query->the_post();

                        if ($i % 2 == 1 ) { ?>
                        <div class="full-item pt-50 pb-30">
                            <div class="row">
                                <div class="full-item-image item-image hover_effect-2 mb-20 col-sm-12">
                                    <?php if (has_post_thumbnail()) {
                                        $thumb = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
                                        $url = $thumb['0'];
                                        } else {
                                            $url = get_template_directory_uri() . '/images/no-image-1200x800.jpg';
                                    }
                                    ?>
                                    <a href="<?php the_permalink(); ?>">
                                        <img src="<?php echo esc_url($url); ?>" alt="<?php the_title_attribute(); ?>">
                                    </a>
                                    <span class="twp-corner">
                                        <i class="ion-ios-photos-outline img-icon"></i>
                                    </span>
                                </div>
                                <div class="full-item-details col-sm-12">
                                    <div class="full-item-metadata primary-font">
                                        <div class="item-metadata post-category-label twp-meta-categories">
                                            <?php $categories_list = get_the_category_list(wp_kses_post('</span> <span>', 'royal-magazine')); ?>
                                            <?php if (!empty($categories_list)) { ?>
                                                <?php printf(esc_html__('Category: %1$s', 'royal-magazine'), $categories_list);?>
                                            <?php } ?>
                                        </div>
                                        <div class="item-metadata posts-date small-font">
                                            <?php echo esc_html__( 'Posted On: ', 'royal-magazine' ); ?> 
                                            <span> <?php the_time('j M Y'); ?></span>
                                        </div>
                                        <div class="item-metadata post-author small-font">
                                            <span class="author-avatar">
                                                <?php $author_id =  get_the_author_meta( 'ID' ); ?>
                                                <?php $post_author_url = get_the_author_meta('user_email'); ?>
                                                <?php if (!empty($post_author_url)) : ?>
                                                    <a href="<?php echo esc_url(get_author_posts_url($author_id)) ?>">
                                                        <?php echo esc_html__('Published By: ','royal-magazine') ?></a>
                                                <?php else : ?>
                                                    <?php echo esc_html__('Published By: ','royal-magazine') ?>
                                                <?php endif; ?>
                                            </span>
                                            <span class="author-details">
                                                <a href="<?php echo esc_url(get_author_posts_url($author_id)) ?>">
                                                    <?php echo esc_html(get_the_author_meta('display_name', $author_id)); ?>
                                                </a>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="full-item-content">
                                        <h3 class="full-item-title item-title">
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        </h3>
                                        <div class="full-item-desc">
                                            <?php if (absint($params['excerpt_length']) > 0) : ?>
                                                <?php
                                                $excerpt = royal_magazine_words_count(absint($params['excerpt_length']), get_the_content());
                                                echo wp_kses_post(wpautop($excerpt));
                                                ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } else {?>
                        <div class="full-item pt-30 pb-30">
                            <div class="twp-row row">
                                <div class="full-item-image item-image hover_effect-2 col col-four pull-right">
                                    <?php if (has_post_thumbnail()) {
                                        $thumb = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'royal-magazine-900-600' );
                                        $url = $thumb['0'];
                                        } else {
                                            $url = get_template_directory_uri() . '/images/no-image-900x600.jpg';
                                    }
                                    ?>
                                    <a href="<?php the_permalink(); ?>">
                                        <img src="<?php echo esc_url($url); ?>" alt="<?php the_title_attribute(); ?>">
                                    </a>
                                    <span class="twp-corner">
                                        <i class="ion-ios-photos-outline img-icon"></i>
                                    </span>
                                </div>
                                <div class="full-item-details col col-six">
                                    <div class="full-item-metadata primary-font">
                                        <div class="item-metadata post-category-label twp-meta-categories">
                                            <?php $categories_list = get_the_category_list(wp_kses_post('</span> <span>', 'royal-magazine')); ?>
                                            <?php if (!empty($categories_list)) { ?>
                                                <?php printf(esc_html__('Category: %1$s', 'royal-magazine'), $categories_list);?>
                                            <?php } ?>
                                        </div>
                                        <div class="item-metadata posts-date small-font">
                                            <?php echo esc_html__( 'Posted On: ', 'royal-magazine' ); ?> 
                                            <span> <?php the_time('j M Y'); ?></span>
                                        </div>
                                        <div class="item-metadata post-author small-font">
                                            <span class="author-avatar">
                                                <?php $author_id = get_the_author_meta( 'ID' ); ?>
                                                <?php $post_author_url = get_the_author_meta('user_email'); ?>
                                                <?php if (!empty($post_author_url)) : ?>
                                                    <a href="<?php echo esc_url(get_author_posts_url($author_id)) ?>">
                                                        <?php echo esc_html__('Published By: ','royal-magazine') ?></a>
                                                <?php else : ?>
                                                    <?php echo esc_html__('Published By: ','royal-magazine') ?>
                                                <?php endif; ?>
                                            </span>
                                            <span class="author-details">
                                                <a href="<?php echo esc_url(get_author_posts_url($author_id)) ?>">
                                                    <?php echo esc_html(get_the_author_meta('display_name', $author_id)); ?>
                                                </a>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="full-item-content">
                                        <h3 class="full-item-title item-title">
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        </h3>
                                        <div class="full-item-desc">
                                            <?php if (absint($params['excerpt_length']) > 0) : ?>
                                                <?php
                                                $excerpt = royal_magazine_words_count(absint($params['excerpt_length']), get_the_content());
                                                echo wp_kses_post(wpautop($excerpt));
                                                ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php } $i++; endwhile; ?>
            </div>
            <?php wp_reset_postdata(); ?>

        <?php endif; ?>
            <?php echo $args['after_widget'];
        }
    }
endif;

/*Grid Panel widget*/
if (!class_exists('Royal_Magazine_sidebar_widget')) :

    /**
     * Popular widget Class.
     *
     * @since 1.0.0
     */
    class Royal_Magazine_sidebar_widget extends Royal_Magazine_Widget_Base
    {

        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $opts = array(
                'classname' => 'royal_magazine_popular_post_widget',
                'description' => __('Displays post form selected category specific for popular post in sidebars.', 'royal-magazine'),
                'customize_selective_refresh' => true,
            );
            $fields = array(
                'title' => array(
                    'label' => __('Title:', 'royal-magazine'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
                'post_category' => array(
                    'label' => __('Select Category:', 'royal-magazine'),
                    'type' => 'dropdown-taxonomies',
                    'show_option_all' => __('All Categories', 'royal-magazine'),
                ),
                'enable_discription' => array(
                    'label' => __('Enable Description:', 'royal-magazine'),
                    'type' => 'checkbox',
                    'default' => false,
                ),
                'excerpt_length' => array(
                    'label' => __('Excerpt Length:', 'royal-magazine'),
                    'description' => __('Number of words', 'royal-magazine'),
                    'default' => 15,
                    'css' => 'max-width:60px;',
                    'min' => 0,
                    'max' => 200,
                ),
                'post_number' => array(
                    'label' => __('Number of Posts:', 'royal-magazine'),
                    'type' => 'number',
                    'default' => 4,
                    'css' => 'max-width:60px;',
                    'min' => 1,
                    'max' => 6,
                ),
            );

            parent::__construct('royal-magazine-popular-sidebar-layout', __('RM: Recent Post Widget', 'royal-magazine'), $opts, array(), $fields);
        }

        /**
         * Outputs the content for the current widget instance.
         *
         * @since 1.0.0
         *
         * @param array $args Display arguments.
         * @param array $instance Settings for the current widget instance.
         */
        function widget($args, $instance)
        {

            $params = $this->get_params($instance);

            echo $args['before_widget'];

            if (!empty($params['title'])) {
                echo $args['before_title'] . esc_html( $params['title'] ) . $args['after_title'];
            }

            $qargs = array(
                'posts_per_page' => absint($params['post_number']),
                'no_found_rows' => true,
            );
            if (absint($params['post_category']) > 0) {
                $qargs['cat'] = absint($params['post_category']);
            }
            
            $count = 1;
            $recent_posts_query = new WP_Query($qargs);
            if ($recent_posts_query->have_posts()) :  ?>

            <div class="twp-recent-widget">                
                <ul class="recent-widget-list">
                <?php while ($recent_posts_query->have_posts()) :
                        $recent_posts_query->the_post(); ?>
                    <li class="full-item pt-20 pb-20 clearfix">
                        <div class="twp-row row">
                            <div class="full-item-image item-image col col-four pull-left">
                                <?php if (has_post_thumbnail()) {
                                    $thumb = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'royal-magazine-400-260' );
                                    $url = $thumb['0'];
                                    } else {
                                        $url = get_template_directory_uri() . '/images/no-image.jpg';
                                }
                                ?>
                                <figure class="twp-article">
                                    <div class="twp-article-item">
                                        <div class="article-item-image">
                                         <img src="<?php echo esc_url($url); ?>" alt="<?php the_title_attribute(); ?>">
                                        </div>
                                        <div class="hover_effect hover_effect-1">
                                            <a href="<?php the_permalink(); ?>" class="table-align" tabindex="0">
                                                <div class="table-align-cell v-align-middle">
                                                   <span class="number"> <?php echo $count; ?></span>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </figure>

                            </div>
                            <div class="full-item-details col col-six">
                                <div class="full-item-metadata primary-font">
                                    <div class="item-metadata posts-date small-font">
                                        <?php echo esc_html__( 'Posted On: ', 'royal-magazine' ); ?> 
                                        <span> <?php the_time('j M Y'); ?> </span>                                 
                                    </div>
                                </div>
                                <div class="full-item-content">
                                    <h3 class="full-item-title item-title">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_title(); ?>
                                        </a>
                                    </h3>
                                </div>
                                <div class="full-item-discription">
                                <?php if ( true === $params['enable_discription'] ) { ?>
                                    <div class="post-description">
                                        <?php if (absint($params['excerpt_length']) > 0) : ?>
                                            <?php
                                            $excerpt = royal_magazine_words_count(absint($params['excerpt_length']), get_the_content());
                                            echo wp_kses_post(wpautop($excerpt));
                                            ?>
                                        <?php endif; ?>
                                    </div>
                                <?php } ?>
                                </div>
                            </div>
                        </div>
                    </li>
                <?php 
                $count++;
                endwhile; ?>
                </ul>
            </div>

            <?php wp_reset_postdata(); ?>

        <?php endif; ?>
            <?php echo $args['after_widget'];
        }
    }
endif;

/*tabed widget*/
if (!class_exists('Royal_Magazine_Tabbed_Widget')) :

    /**
     * Tabbed widget Class.
     *
     * @since 1.0.0
     */
    class Royal_Magazine_Tabbed_Widget extends Royal_Magazine_Widget_Base
    {

        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {

            $opts = array(
                'classname' => 'royal_magazine_widget_tabbed',
                'description' => __('Tabbed widget.', 'royal-magazine'),
            );
            $fields = array(
                'popular_heading' => array(
                    'label' => __('Popular', 'royal-magazine'),
                    'type' => 'heading',
                ),
                'popular_title' => array(
                    'label'         => esc_html__('Popular Posts Title', 'royal-magazine'),
                    'type'          => 'text',
                    'default'          => esc_html__('Popular', 'royal-magazine'),
                ),
                'popular_number' => array(
                    'label' => __('No. of Posts:', 'royal-magazine'),
                    'type' => 'number',
                    'css' => 'max-width:60px;',
                    'default' => 5,
                    'min' => 1,
                    'max' => 10,
                ),
                'enable_discription' => array(
                    'label' => __('Enable Description:', 'royal-magazine'),
                    'type' => 'checkbox',
                    'default' => true,
                ),
                'excerpt_length' => array(
                    'label' => __('Excerpt Length:', 'royal-magazine'),
                    'description' => __('Number of words', 'royal-magazine'),
                    'default' => 10,
                    'css' => 'max-width:60px;',
                    'min' => 0,
                    'max' => 200,
                ),
                'recent_heading' => array(
                    'label' => __('Recent', 'royal-magazine'),
                    'type' => 'heading',
                ),
                'recent_title' => array(
                    'label'         => esc_html__('Recent Posts Title', 'royal-magazine'),
                    'type'          => 'text',
                    'default'          => esc_html__('Recent', 'royal-magazine'),
                ),
                'recent_number' => array(
                    'label' => __('No. of Posts:', 'royal-magazine'),
                    'type' => 'number',
                    'css' => 'max-width:60px;',
                    'default' => 5,
                    'min' => 1,
                    'max' => 10,
                ),
                'comments_heading' => array(
                    'label' => __('Comments', 'royal-magazine'),
                    'type' => 'heading',
                ),
                'comment_title' => array(
                    'label'         => esc_html__('Comment Posts Title', 'royal-magazine'),
                    'type'          => 'text',
                    'default'          => esc_html__('Comment', 'royal-magazine'),
                ),
                'comments_number' => array(
                    'label' => __('No. of Comments:', 'royal-magazine'),
                    'type' => 'number',
                    'css' => 'max-width:60px;',
                    'default' => 5,
                    'min' => 1,
                    'max' => 10,
                ),
            );

            parent::__construct('royal-magazine-tabbed', __('RM: Tab Widgets', 'royal-magazine'), $opts, array(), $fields);

        }

        /**
         * Outputs the content for the current widget instance.
         *
         * @since 1.0.0
         *
         * @param array $args Display arguments.
         * @param array $instance Settings for the current widget instance.
         */
        function widget($args, $instance)
        {

            $params = $this->get_params($instance);
            $popular_title = isset( $params['popular_title'] ) ? $params['popular_title'] : '';
            $recent_title = isset( $params['recent_title'] ) ? $params['recent_title'] : '';
            $comment_title = isset( $params['comment_title'] ) ? $params['comment_title'] : '';
            $tab_id = 'tabbed-' . $this->number;

            echo $args['before_widget'];
            ?>
            <div class="tabbed-container">

                <div class="section-head mb-20">
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="tab tab-popular active">
                            <a href="#<?php echo esc_attr($tab_id); ?>-popular" aria-controls="<?php esc_attr_e('Popular', 'royal-magazine'); ?>" role="tab" data-toggle="tab" class="primary-bgcolor">
                                <?php echo esc_html( $popular_title );?>
                            </a>
                        </li>
                        <li class="tab tab-recent">
                            <a href="#<?php echo esc_attr($tab_id); ?>-recent" aria-controls="<?php esc_attr_e('Recent', 'royal-magazine'); ?>" role="tab" data-toggle="tab" class="primary-bgcolor">
                                <?php echo esc_html( $recent_title );?>
                            </a>
                        </li>
                        <li class="tab tab-comments">
                            <a href="#<?php echo esc_attr($tab_id); ?>-comments" aria-controls="<?php esc_attr_e('Comments', 'royal-magazine'); ?>" role="tab" data-toggle="tab" class="primary-bgcolor">
                                <?php echo esc_html( $comment_title );?>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="tab-content">
                    <div id="<?php echo esc_attr($tab_id); ?>-popular" role="tabpanel" class="tab-pane active">
                        <?php $this->render_news('popular', $params); ?>
                    </div>
                    <div id="<?php echo esc_attr($tab_id); ?>-recent" role="tabpanel" class="tab-pane">
                        <?php $this->render_news('recent', $params); ?>
                    </div>
                    <div id="<?php echo esc_attr($tab_id); ?>-comments" role="tabpanel" class="tab-pane">
                        <?php $this->render_comments($params); ?>
                    </div>
                </div>
            </div>
            <?php

            echo $args['after_widget'];

        }

        /**
         * Render news.
         *
         * @since 1.0.0
         *
         * @param array $type Type.
         * @param array $params Parameters.
         * @return void
         */
        function render_news($type, $params)
        {

            if (!in_array($type, array('popular', 'recent'))) {
                return;
            }

            switch ($type) {
                case 'popular':
                    $qargs = array(
                        'posts_per_page' => $params['popular_number'],
                        'no_found_rows' => true,
                        'orderby' => 'comment_count',
                    );
                    break;

                case 'recent':
                    $qargs = array(
                        'posts_per_page' => $params['recent_number'],
                        'no_found_rows' => true,
                    );
                    break;

                default:
                    break;
            }

            $recent_posts_query = new WP_Query($qargs);
            if ($recent_posts_query->have_posts()) :  ?>

            <ul class="article-item article-list-item article-tabbed-list article-item-left">
                <?php while ($recent_posts_query->have_posts()) :
                        $recent_posts_query->the_post(); ?>
                    <li class="full-item pt-20 pb-20 clearfix">
                        <div class="twp-row row">
                            <div class="full-item-image item-image hover_effect-2 col col-four pull-right">
                                <a href="<?php the_permalink(); ?>" class="news-item-thumb">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'royal-magazine-900-600' ); ?>
                                        <?php if (!empty($image)) : ?>
                                            <img src="<?php echo esc_url($image[0]); ?>" alt=""/>
                                        <?php endif; ?>
                                    <?php else : ?>
                                        <img src="<?php echo esc_url( get_template_directory_uri() ) . '/images/no-image-900x600.jpg'; ?>"
                                             alt=""/>
                                    <?php endif; ?>
                                </a>
                                <span class="twp-corner">
                                    <i class="ion-ios-photos-outline img-icon"></i>
                                </span>
                            </div>
                            <div class="full-item-details col col-six">
                                <div class="full-item-metadata primary-font">
                                    <div class="item-metadata posts-date small-font">
                                        <?php the_time(get_option('date_format')); ?>
                                    </div>
                                </div>
                                <div class="full-item-content">
                                    <h3 class="full-item-title item-title">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_title(); ?>
                                        </a>
                                    </h3>
                                    <div class="full-item-desc">
                                        <?php if ( true === $params['enable_discription'] ) { ?>
                                            <div class="post-description">
                                                <?php if (absint($params['excerpt_length']) > 0) : ?>
                                                    <?php
                                                    $excerpt = royal_magazine_words_count(absint($params['excerpt_length']), get_the_content());
                                                    echo wp_kses_post(wpautop($excerpt));
                                                    ?>
                                                <?php endif; ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div><!-- .news-content -->
                    </li>
                <?php endwhile; ?>
            </ul><!-- .news-list -->

            <?php wp_reset_postdata(); ?>

        <?php endif; ?>

            <?php

        }

        /**
         * Render comments.
         *
         * @since 1.0.0
         *
         * @param array $params Parameters.
         * @return void
         */
        function render_comments($params)
        {

            $comment_args = array(
                'number' => $params['comments_number'],
                'status' => 'approve',
                'post_status' => 'publish',
            );

            $comments = get_comments($comment_args);
            ?>
            <?php if (!empty($comments)) : ?>
            <ul class="article-item article-list-item article-item-left comments-tabbed--list">
                <?php foreach ($comments as $key => $comment) : ?>
                    <li class="article-panel clearfix">
                        <figure class="article-thumbmnail">
                            <?php $comment_author_url = get_comment_author_url($comment); ?>
                            <?php if (!empty($comment_author_url)) : ?>
                                <a href="<?php echo esc_url($comment_author_url); ?>"><?php echo get_avatar($comment, 65); ?></a>
                            <?php else : ?>
                                <?php echo get_avatar($comment, 65); ?>
                            <?php endif; ?>
                        </figure><!-- .comments-thumb -->
                        <div class="comments-content">
                            <?php echo get_comment_author_link($comment); ?>
                            &nbsp;<?php echo esc_html_x('on', 'Tabbed Widget', 'royal-magazine'); ?>&nbsp;<a
                                href="<?php echo esc_url(get_comment_link($comment)); ?>"><?php echo get_the_title($comment->comment_post_ID); ?></a>
                        </div><!-- .comments-content -->
                    </li>
                <?php endforeach; ?>
            </ul><!-- .comments-list -->
        <?php endif; ?>
            <?php
        }

    }
endif;


/*author widget*/
if (!class_exists('Royal_Magazine_Author_Post_widget')) :

    /**
     * Author widget Class.
     *
     * @since 1.0.0
     */
    class Royal_Magazine_Author_Post_widget extends Royal_Magazine_Widget_Base
    {

        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $opts = array(
                'classname' => 'royal_magazine_author_widget',
                'description' => __('Displays authors details in post.', 'royal-magazine'),
                'customize_selective_refresh' => true,
            );
            $fields = array(
                'title' => array(
                    'label' => __('Title:', 'royal-magazine'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
                'author-name' => array(
                    'label' => __('Name:', 'royal-magazine'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
                'discription' => array(
                    'label' => __('Description:', 'royal-magazine'),
                    'type'  => 'textarea',
                    'class' => 'widget-content widefat'
                ),
                'image_url' => array(
                    'label' => __('Author Image:', 'royal-magazine'),
                    'type'  => 'image',
                ),
                'url-fb' => array(
                   'label' => __('Facebook URL:', 'royal-magazine'),
                   'type' => 'url',
                   'class' => 'widefat',
                    ),
                'url-tw' => array(
                   'label' => __('Twitter URL:', 'royal-magazine'),
                   'type' => 'url',
                   'class' => 'widefat',
                    ),
                'url-gp' => array(
                   'label' => __('Instagram URL:', 'royal-magazine'),
                   'type' => 'url',
                   'class' => 'widefat',
                    ),
            );

            parent::__construct('royal-magazine-author-layout', __('RM: Author Widget', 'royal-magazine'), $opts, array(), $fields);
        }

        /**
         * Outputs the content for the current widget instance.
         *
         * @since 1.0.0
         *
         * @param array $args Display arguments.
         * @param array $instance Settings for the current widget instance.
         */
        function widget($args, $instance)
        {

            $params = $this->get_params($instance);

            echo $args['before_widget'];

            if ( ! empty( $params['title'] ) ) {
                echo $args['before_title'] . esc_html( $params['title'] ) . $args['after_title'];
            } ?>

            <!--cut from here-->
            <div class="author-info">
                <div class="author-image">
                    <?php if ( ! empty( $params['image_url'] ) ) { ?>
                        <div class="profile-image bg-image">
                            <img src="<?php echo esc_url( $params['image_url'] ); ?>">
                        </div>
                    <?php } ?>
                </div> <!-- /#author-image -->
                <div class="author-details">
                    <?php if ( ! empty( $params['author-name'] ) ) { ?>
                        <h3 class="author-name"><?php echo esc_html($params['author-name'] );?></h3>
                    <?php } ?>
                    <?php if ( ! empty( $params['discription'] ) ) { ?>
                        <p class="small-font"><?php echo wp_kses_post( $params['discription']); ?></p>
                    <?php } ?>
                </div> <!-- /#author-details -->
                <div class="author-social">
                    <?php if ( ! empty( $params['url-fb'] ) ) { ?>
                        <a href="<?php echo esc_url($params['url-fb']); ?>" target="_blank"><i class="meta-icon ion-social-facebook"></i></a>
                    <?php } ?>
                    <?php if ( ! empty( $params['url-tw'] ) ) { ?>
                        <a href="<?php echo esc_url($params['url-tw']); ?>" target="_blank"><i class="meta-icon ion-social-twitter"></i></a>
                    <?php } ?>
                    <?php if ( ! empty( $params['url-gp'] ) ) { ?>
                        <a href="<?php echo esc_url($params['url-gp']); ?>" target="_blank"><i class="meta-icon ion-social-instagram"></i></a>
                    <?php } ?>
                </div>
            </div>
            <?php echo $args['after_widget'];
        }
    }
endif;

