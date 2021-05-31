<?php
/**
 * Implement theme metabox.
 *
 * @package Royal Magazine
 */

if (!function_exists('royal_magazine_add_theme_meta_box')) :

    /**
     * Add the Meta Box
     *
     * @since 1.0.0
     */
    function royal_magazine_add_theme_meta_box()
    {

        $apply_metabox_post_types = array('post', 'page');

        foreach ($apply_metabox_post_types as $key => $type) {
            add_meta_box(
                'royal-magazine-theme-settings',
                esc_html__('Single Page/Post Settings', 'royal-magazine'),
                'royal_magazine_render_theme_settings_metabox',
                $type
            );
        }

    }

endif;

add_action('add_meta_boxes', 'royal_magazine_add_theme_meta_box');

add_action( 'admin_enqueue_scripts', 'royal_magazine_backend_scripts');
if ( ! function_exists( 'royal_magazine_backend_scripts' ) ){
    function royal_magazine_backend_scripts( $hook ) {
        wp_enqueue_style( 'wp-color-picker');
        wp_enqueue_script( 'wp-color-picker');
    }
}

if (!function_exists('royal_magazine_render_theme_settings_metabox')) :

    /**
     * Render theme settings meta box.
     *
     * @since 1.0.0
     */
    function royal_magazine_render_theme_settings_metabox($post, $metabox)
    {

        $post_id = $post->ID;
        $royal_magazine_post_meta_value = get_post_meta($post_id);

        // Meta box nonce for verification.
        wp_nonce_field(basename(__FILE__), 'royal_magazine_meta_box_nonce');
        // Fetch Options list.
        $page_layout = get_post_meta($post_id, 'royal-magazine-meta-select-layout', true);
        $page_image_layout = get_post_meta($post_id, 'royal-magazine-meta-image-layout', true);
        ?>

        <div class="royal-magazine-tab-main">

            <div class="royal-magazine-metabox-tab">
                <ul>
                    <li>
                        <a id="twp-tab-general" class="twp-tab-active" href="javascript:void(0)"><?php esc_html_e('Layout Settings', 'royal-magazine'); ?></a>
                    </li>
                </ul>
            </div>

            <div class="royal-magazine-tab-content">
                
                <div id="twp-tab-general-content" class="royal-magazine-content-wrap royal-magazine-tab-content-active">

                    <div class="royal-magazine-meta-panels">

                         <div class="royal-magazine-opt-wrap royal-magazine-opt-wrap-alt">
                            <label><?php esc_html_e('Single Page/Post Layout', 'royal-magazine'); ?></label>
                            <select name="royal-magazine-meta-select-layout" id="royal-magazine-meta-select-layout">
                                <option value="global" <?php selected('global', $page_layout); ?>>
                                    <?php esc_html_e('Global', 'royal-magazine') ?>
                                </option>
                                <option value="right-sidebar" <?php selected('right-sidebar', $page_layout); ?>>
                                    <?php esc_html_e('Content - Primary Sidebar', 'royal-magazine') ?>
                                </option>
                                <option value="left-sidebar" <?php selected('left-sidebar', $page_layout); ?>>
                                    <?php esc_html_e('Primary Sidebar - Content', 'royal-magazine') ?>
                                </option>
                                <option value="no-sidebar" <?php selected('no-sidebar', $page_layout); ?>>
                                    <?php esc_html_e('No Sidebar', 'royal-magazine') ?>
                                </option>
                            </select>
                        </div>

                        <div class="royal-magazine-opt-wrap royal-magazine-opt-wrap-alt">
                            <label><?php esc_html_e('Single Page/Post Image Layout', 'royal-magazine'); ?></label>
                            <select name="royal-magazine-meta-image-layout" id="royal-magazine-meta-image-layout">
                                <option value="global" <?php selected('global', $page_layout); ?>>
                                    <?php esc_html_e('Global', 'royal-magazine') ?>
                                </option>
                                <option value="full" <?php selected('full', $page_image_layout); ?>>
                                    <?php esc_html_e('Full', 'royal-magazine') ?>
                                </option>
                                <option value="left" <?php selected('left', $page_image_layout); ?>>
                                    <?php esc_html_e('Left', 'royal-magazine') ?>
                                </option>
                                <option value="right" <?php selected('right', $page_image_layout); ?>>
                                    <?php esc_html_e('Right', 'royal-magazine') ?>
                                </option>
                                <option value="no-image" <?php selected('no-image', $page_image_layout); ?>>
                                    <?php esc_html_e('No Image', 'royal-magazine') ?>
                                </option>
                            </select>
                        </div>


                    </div>
                </div>

            </div>
        </div>

        <?php
    }

endif;


if (!function_exists('royal_magazine_save_theme_settings_meta')) :

    /**
     * Save theme settings meta box value.
     *
     * @since 1.0.0
     *
     * @param int $post_id Post ID.
     * @param WP_Post $post Post object.
     */
    function royal_magazine_save_theme_settings_meta($post_id, $post)
    {

        // Verify nonce.
        if (!isset($_POST['royal_magazine_meta_box_nonce']) || !wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['royal_magazine_meta_box_nonce'] ) ), basename(__FILE__))) {
            return;
        }

        // Bail if auto save or revision.
        if (defined('DOING_AUTOSAVE') || is_int(wp_is_post_revision($post)) || is_int(wp_is_post_autosave($post))) {
            return;
        }

        // Check the post being saved == the $post_id to prevent triggering this call for other save_post events.
        if ( !isset( $_POST['post_ID'] ) || empty( $_POST['post_ID'] ) || sanitize_text_field( wp_unslash( $_POST['post_ID'] ) ) != $post_id ) {
            return;
        }

        // Check permission.
        if( isset( $_POST['post_type'] ) && $_POST['post_type'] && 'page' ===  sanitize_text_field( wp_unslash( $_POST['post_type'] ) ) ) {
            if (!current_user_can('edit_page', $post_id)) {
                return;
            }
        } else if (!current_user_can('edit_post', $post_id)) {
            return;
        }

        $royal_magazine_meta_select_layout = isset( $_POST['royal-magazine-meta-select-layout'] ) ? sanitize_text_field( wp_unslash( $_POST['royal-magazine-meta-select-layout'] ) ) : '';
        if (!empty($royal_magazine_meta_select_layout)) {
            update_post_meta($post_id, 'royal-magazine-meta-select-layout', sanitize_text_field($royal_magazine_meta_select_layout));
        }
        $royal_magazine_meta_image_layout = isset( $_POST['royal-magazine-meta-image-layout'] ) ? sanitize_text_field( wp_unslash( $_POST['royal-magazine-meta-image-layout'] ) ) : '';
        if (!empty($royal_magazine_meta_image_layout)) {
            update_post_meta($post_id, 'royal-magazine-meta-image-layout', sanitize_text_field($royal_magazine_meta_image_layout));
        }

    }

endif;

add_action('save_post', 'royal_magazine_save_theme_settings_meta', 10, 3);