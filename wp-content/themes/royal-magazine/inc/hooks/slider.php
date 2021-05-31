<?php
if (!function_exists('royal_magazine_banner_slider')) :
    /**
     * Banner Slider
     *
     * @since royal-magazine 1.0.0
     *
     */
    function royal_magazine_banner_slider()
    {
        if (1 != royal_magazine_get_option('show_slider_section')) {
            return null;
        }
        $royal_magazine_slider_category = esc_attr(royal_magazine_get_option('select_category_for_slider'));
        $royal_magazine_slider_number = 4;
        ?>
        <!-- slider News -->
        <section class="main-banner section-block">
            <div class="container container-bg">
                <div class="row">
                    <?php 
                    $royal_magazine_banner_slider_args = array(
                        'post_type' => 'post',
                        'cat' => esc_attr($royal_magazine_slider_category),
                        'ignore_sticky_posts' => true,
                        'posts_per_page' => absint( $royal_magazine_slider_number ),
                    ); ?>
                    <?php $rtl_class = 'false';
                    if(is_rtl()){ 
                        $rtl_class = 'true';
                    }?>
                    <div class="col-sm-12 slider-nav pt-30" data-slick='{"rtl": <?php echo($rtl_class); ?>}'>
                    <?php $royal_magazine_banner_slider_post_query = new WP_Query($royal_magazine_banner_slider_args);
                    $i = 1;
                    if ($royal_magazine_banner_slider_post_query->have_posts()) :
                        while ($royal_magazine_banner_slider_post_query->have_posts()) : $royal_magazine_banner_slider_post_query->the_post();
                            if(has_post_thumbnail()){
                                $thumb = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'royal-magazine-1140-600' );
                                $url = $thumb['0'];
                            }
                            else{
                                $url = get_template_directory_uri().'/images/no-image-1200x800.jpg';
                            } 
                            ?>
                            <div class="slider-nav-item">
                                <figure class="twp-article twp-article-slides">
                                    <div class="twp-article-item">
                                        <div class="article-item-image primary-bgcolor data-bg data-bg-1" data-background="<?php echo esc_url($url); ?>">
                                        </div>
                                        <div class="hover_effect hover_effect-1">
                                            <a href="javascript:;" class="table-align">
                                                <div class="table-align-cell v-align-middle">
                                                    <i class="ion-ios-plus-outline meta-icon meta-icon-big"></i>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <figcaption class="primary-bgcolor">
                                        <span class="primary-font slide-item-number secondary-bgcolor"><?php echo $i ?></span>
                                        <h4 class="primary-font slide-nav-title small-font"><?php the_title(); ?></h4>
                                    </figcaption>
                                </figure>
                            </div>
                        <?php 
                        $i++;
                        endwhile;
                    endif; 
                    wp_reset_postdata(); 
                    ?>
                    </div>
                    <!-- Slide -->
                    <?php $rtl_class = 'false';
                    if(is_rtl()){ 
                        $rtl_class = 'true';
                    }?>
                    <div class="col-sm-12 mainbanner-jumbotron mt-20 mb-50" data-slick='{"rtl": <?php echo($rtl_class); ?>}'>
                        <?php 
                        $royal_magazine_banner_slider_post_query = new WP_Query($royal_magazine_banner_slider_args);
                        if ($royal_magazine_banner_slider_post_query->have_posts()) :
                            while ($royal_magazine_banner_slider_post_query->have_posts()) : $royal_magazine_banner_slider_post_query->the_post();
                                if(has_post_thumbnail()){
                                    $thumb = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'royal-magazine-1140-600' );
                                    $url = $thumb['0'];
                                }
                                else{
                                    $url = get_template_directory_uri().'/images/no-image-1200x800.jpg';
                                }
                                global $post;
                                $author_id = $post->post_author;
                                ?>
                                    <figure class="slick-item">
                                        <a href="<?php the_permalink(); ?>" class="data-bg data-bg-slide" data-background="<?php echo esc_url($url); ?>">
                                        <span class="bg-pattern"></span>
                                        </a>
                                        <figcaption class="slider-figcaption">
                                            <div class="slider-figcaption-wrapper primary-bgcolor text-center pt-40 pb-40">
                                                <div class="item-metadata twp-meta-categories posts-date mb-10 pb-10 big-font primary-font text-uppercase">
                                                    <?php royal_magazine_entry_category(); ?>
                                                </div>
                                                <h2 class="slide-title">
                                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                </h2>
                                                <div class="post-meta small-font">
                                                    <?php royal_magazine_posted_on(); ?>
                                                </div>
                                            </div>
                                        </figcaption>
                                    </figure>
                                <?php 
                                endwhile;
                        endif; 
                        wp_reset_postdata(); 
                        ?>
                    </div>
                </div>
            </div>
        </section>

        <!-- end slider-section -->
        <?php
    }
endif;
add_action('royal_magazine_action_front_page', 'royal_magazine_banner_slider', 40);
