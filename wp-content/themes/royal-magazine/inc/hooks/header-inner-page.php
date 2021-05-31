<?php
global $post;
if (!function_exists('royal_magazine_single_page_title')) :
    function royal_magazine_single_page_title()
    {
        global $post;
        $global_banner_image = get_header_image();
        $royal_magazine_banner_title = royal_magazine_get_option('banner_title_post');
        // Check if single.
        ?>
        <?php if (is_singular()) { ?>
        <div class="wrapper page-inner-title inner-banner-1 twp-inner-banner inner-banner">
            <header class="entry-header">
                <div class="container container-bg">
                    <div class="row">
                        <div class="col-md-12 pt-40">
                            <div class="primary-font twp-bredcrumb">
                                <?php
                                /**
                                 * Hook - royal_magazine_add_breadcrumb.
                                 */
                                do_action('royal_magazine_action_breadcrumb');
                                ?>
                            </div>
                        </div>
                        <div class="col-md-12 pb-20">
                            <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
                            <?php if (!is_page()) { ?>
                                <header class="entry-header">
                                    <div class="entry-meta entry-inner primary-font small-font">
                                        <?php
                                        royal_magazine_posted_on(); ?>
                                    </div>
                                </header>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </header>
        </div>
    <?php } else { ?>
        <div class="wrapper page-inner-title inner-banner-2 twp-inner-banner data-bg" data-background="<?php echo esc_url($global_banner_image); ?>">
            <header class="entry-header">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <?php if (is_404()) { ?>
                                <h1 class="entry-title"><?php esc_html_e('Oops! That page can&rsquo;t be found.', 'royal-magazine'); ?></h1>
                            <?php } elseif (is_archive()) {
                                the_archive_title('<h1 class="entry-title">', '</h1>');
                                the_archive_description('<div class="taxonomy-description">', '</div>');
                            } elseif (is_search()) { ?>
                                <h1 class="entry-title"><?php printf(esc_html__('Search Results for: %s', 'royal-magazine'), '<span>' . get_search_query() . '</span>'); ?></h1>
                            <?php } else { ?>
                                <h1 class="entry-title"><?php echo esc_html($royal_magazine_banner_title); ?></h1>
                            <?php }
                            ?>
                        </div>
                        <div class="col-md-12">
                            <div class="primary-font twp-bredcrumb">
                                <?php
                                /**
                                 * Hook - royal_magazine_add_breadcrumb.
                                 */
                                do_action('royal_magazine_action_breadcrumb');
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <div class="inner-header-overlay"></div>
        </div>
    <?php } ?>

        <?php
    }
endif;
add_action('royal-magazine-page-inner-title', 'royal_magazine_single_page_title', 15);
