<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'admin_enqueue_scripts', 'spawp_enqueue_meta_box_scripts' );
function spawp_enqueue_meta_box_scripts( $hook ) {
	if ( in_array( $hook, array( 'post.php', 'post-new.php' ) ) ) {
		$post_types = get_post_types( array( 'public' => true ) );
		$screen = get_current_screen();
		$post_type = $screen->id;

		if ( in_array( $post_type, (array) $post_types ) ) {
			wp_enqueue_style( 'spawp-layout-metabox', get_template_directory_uri() . '/css/admin/meta-box.css' );
		}
	}
}

add_action( 'add_meta_boxes', 'spawp_register_layout_meta_box' );
function spawp_register_layout_meta_box() {
	if ( ! current_user_can( apply_filters( 'spawp_metabox_capability', 'edit_theme_options' ) ) ) {
		return;
	}

	if ( ! defined( 'SPAWP_LAYOUT_META_BOX' ) ) {
		define( 'SPAWP_LAYOUT_META_BOX', true );
	}

	global $post;
	$blog_id = get_option( 'page_for_posts' );

	if ( $blog_id && (int) $blog_id === (int) $post->ID ) {
		return;
	}

	$post_types = get_post_types( array( 'public' => true ) );

	foreach ( $post_types as $type ) {
		if ( 'attachment' !== $type ) {
			add_meta_box(
				'spawp_layout_options_meta_box',
				esc_html__( 'Layout', 'spawp' ),
				'spawp_do_layout_meta_box',
				$type,
				'side'
			);
		}
	}
}

function spawp_do_layout_meta_box( $post ) {
	wp_nonce_field( basename( __FILE__ ), 'spawp_layout_nonce' );
	$stored_meta = (array) get_post_meta( $post->ID );
	$stored_meta['_spawp-sidebar-layout-meta'][0] = ( isset( $stored_meta['_spawp-sidebar-layout-meta'][0] ) ) ? $stored_meta['_spawp-sidebar-layout-meta'][0] : '';
	$stored_meta['_spawp-footer-widget-meta'][0] = ( isset( $stored_meta['_spawp-footer-widget-meta'][0] ) ) ? $stored_meta['_spawp-footer-widget-meta'][0] : '';
	$stored_meta['_spawp-full-width-content'][0] = ( isset( $stored_meta['_spawp-full-width-content'][0] ) ) ? $stored_meta['_spawp-full-width-content'][0] : '';
	$stored_meta['_spawp-disable-headline'][0] = ( isset( $stored_meta['_spawp-disable-headline'][0] ) ) ? $stored_meta['_spawp-disable-headline'][0] : '';

	$tabs = apply_filters(
		'spawp_metabox_tabs',
		array(
			'sidebars' => array(
				'title' => esc_html__( 'Sidebars', 'spawp' ),
				'target' => '#spawp-layout-sidebars',
				'class' => 'current',
			),
			'footer_widgets' => array(
				'title' => esc_html__( 'Footer Widgets', 'spawp' ),
				'target' => '#spawp-layout-footer-widgets',
				'class' => '',
			),
			'disable_elements' => array(
				'title' => esc_html__( 'Disable Elements', 'spawp' ),
				'target' => '#spawp-layout-disable-elements',
				'class' => '',
			),
			'container' => array(
				'title' => esc_html__( 'Content Container', 'spawp' ),
				'target' => '#spawp-layout-page-builder-container',
				'class' => '',
			),
		)
	);
	?>
	<div id="spawp-meta-box-container">
		<ul class="spawp-meta-box-menu">
			<?php
			foreach ( (array) $tabs as $tab => $data ) {
				echo '<li class="' . esc_attr( $data['class'] ) . '"><a data-target="' . esc_attr( $data['target'] ) . '" href="#">' . esc_html( $data['title'] ) . '</a></li>';
			}

			do_action( 'spawp_layout_meta_box_menu_item' );
			?>
		</ul>
		<div class="spawp-meta-box-content">
			<div id="spawp-layout-sidebars">
				<div class="spawp_layouts">
					<label for="spawp-sidebar-layout" class="spawp-layout-metabox-section-title"><?php esc_html_e( 'Sidebar Layout', 'spawp' ); ?></label>

					<select name="_spawp-sidebar-layout-meta" id="spawp-sidebar-layout">
						<option value="" <?php selected( $stored_meta['_spawp-sidebar-layout-meta'][0], '' ); ?>><?php esc_html_e( 'Default', 'spawp' ); ?></option>
						<option value="right-sidebar" <?php selected( $stored_meta['_spawp-sidebar-layout-meta'][0], 'right-sidebar' ); ?>><?php esc_html_e( 'Right Sidebar', 'spawp' ); ?></option>
						<option value="left-sidebar" <?php selected( $stored_meta['_spawp-sidebar-layout-meta'][0], 'left-sidebar' ); ?>><?php esc_html_e( 'Left Sidebar', 'spawp' ); ?></option>
						<option value="no-sidebar" <?php selected( $stored_meta['_spawp-sidebar-layout-meta'][0], 'no-sidebar' ); ?>><?php esc_html_e( 'No Sidebars', 'spawp' ); ?></option>
						<option value="both-sidebars" <?php selected( $stored_meta['_spawp-sidebar-layout-meta'][0], 'both-sidebars' ); ?>><?php esc_html_e( 'Both Sidebars', 'spawp' ); ?></option>
						<option value="both-left" <?php selected( $stored_meta['_spawp-sidebar-layout-meta'][0], 'both-left' ); ?>><?php esc_html_e( 'Both Sidebars on Left', 'spawp' ); ?></option>
						<option value="both-right" <?php selected( $stored_meta['_spawp-sidebar-layout-meta'][0], 'both-right' ); ?>><?php esc_html_e( 'Both Sidebars on Right', 'spawp' ); ?></option>
					</select>
				</div>
			</div>

			<div id="spawp-layout-footer-widgets" style="display: none;">
				<div class="spawp_footer_widget">
					<label for="spawp-footer-widget" class="spawp-layout-metabox-section-title"><?php esc_html_e( 'Footer Widgets', 'spawp' ); ?></label>

					<select name="_spawp-footer-widget-meta" id="spawp-footer-widget">
						<option value="" <?php selected( $stored_meta['_spawp-footer-widget-meta'][0], '' ); ?>><?php esc_html_e( 'Default', 'spawp' ); ?></option>
						<option value="0" <?php selected( $stored_meta['_spawp-sidebar-layout-meta'][0], '0' ); ?>><?php esc_html_e( '0 Widgets', 'spawp' ); ?></option>
						<option value="1" <?php selected( $stored_meta['_spawp-sidebar-layout-meta'][0], '1' ); ?>><?php esc_html_e( '1 Widgets', 'spawp' ); ?></option>
						<option value="2" <?php selected( $stored_meta['_spawp-sidebar-layout-meta'][0], '2' ); ?>><?php esc_html_e( '2 Widgets', 'spawp' ); ?></option>
						<option value="3" <?php selected( $stored_meta['_spawp-sidebar-layout-meta'][0], '3' ); ?>><?php esc_html_e( '3 Widgets', 'spawp' ); ?></option>
						<option value="4" <?php selected( $stored_meta['_spawp-sidebar-layout-meta'][0], '4' ); ?>><?php esc_html_e( '4 Widgets', 'spawp' ); ?></option>
					</select>
				</div>
			</div>
			<div id="spawp-layout-page-builder-container" style="display: none;">
				<label for="_spawp-full-width-content" class="spawp-layout-metabox-section-title"><?php esc_html_e( 'Content Container', 'spawp' ); ?></label>

				<p class="page-builder-content" style="color:#666;font-size:13px;margin-top:0;">
					<?php esc_html_e( 'Choose your content container type.', 'spawp' ); ?>
				</p>

				<select name="_spawp-full-width-content" id="_spawp-full-width-content">
					<option value="" <?php selected( $stored_meta['_spawp-full-width-content'][0], '' ); ?>><?php esc_html_e( 'Default', 'spawp' ); ?></option>
					<option value="true" <?php selected( $stored_meta['_spawp-full-width-content'][0], 'true' ); ?>><?php esc_html_e( 'Full Width', 'spawp' ); ?></option>
					<option value="contained" <?php selected( $stored_meta['_spawp-full-width-content'][0], 'contained' ); ?>><?php esc_html_e( 'Contained', 'spawp' ); ?></option>
				</select>
			</div>
			<div id="spawp-layout-disable-elements" style="display: none;">
				<label class="spawp-layout-metabox-section-title"><?php esc_html_e( 'Disable Elements', 'spawp' ); ?></label>
				<?php if ( ! defined( 'SPAWP_PRO_VERSION' ) ) : ?>
					<div class="spawp_disable_elements">
						<label for="meta-spawp-disable-headline" style="display:block;margin: 0 0 1em;" title="<?php esc_attr_e( 'Content Title', 'spawp' ); ?>">
							<input type="checkbox" name="_spawp-disable-headline" id="meta-spawp-disable-headline" value="true" <?php checked( $stored_meta['_spawp-disable-headline'][0], 'true' ); ?>>
							<?php esc_html_e( 'Content Title', 'spawp' ); ?>
						</label>

						<?php if ( ! defined( 'SPAWP_PRO_VERSION' ) ) : ?>
							<span style="display:block;padding-top:1em;border-top:1px solid #EFEFEF;">
								<a href="<?php echo esc_url( 'https://britetechs.com/' ); ?>" target="_blank"><?php esc_html_e( 'Get Premium', 'spawp' ); ?></a>
							</span>
						<?php endif; ?>
					</div>
				<?php endif; ?>

				<?php do_action( 'spawp_layout_disable_elements_section', $stored_meta ); ?>
			</div>
			<?php do_action( 'spawp_layout_meta_box_content', $stored_meta ); ?>
		</div>
	</div>
	<?php
}

add_action( 'save_post', 'spawp_save_layout_meta_data' );
function spawp_save_layout_meta_data( $post_id ) {

	$is_autosave = wp_is_post_autosave( $post_id );
	$is_revision = wp_is_post_revision( $post_id );

	$is_valid_nonce = ( isset( $_POST['spawp_layout_nonce'] ) && wp_verify_nonce( sanitize_key( $_POST['spawp_layout_nonce'] ), basename( __FILE__ ) ) ) ? true : false;

	if ( $is_autosave || $is_revision || ! $is_valid_nonce ) {
		return;
	}

	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return $post_id;
	}

	$sidebar_layout_key   = '_spawp-sidebar-layout-meta';
	$sidebar_layout_value = filter_input( INPUT_POST, $sidebar_layout_key, FILTER_SANITIZE_STRING );

	if ( $sidebar_layout_value ) {
		update_post_meta( $post_id, $sidebar_layout_key, $sidebar_layout_value );
	} else {
		delete_post_meta( $post_id, $sidebar_layout_key );
	}

	$footer_widget_key   = '_spawp-footer-widget-meta';
	$footer_widget_value = filter_input( INPUT_POST, $footer_widget_key, FILTER_SANITIZE_STRING );

	// Check for empty string to allow 0 as a value.
	if ( '' !== $footer_widget_value ) {
		update_post_meta( $post_id, $footer_widget_key, $footer_widget_value );
	} else {
		delete_post_meta( $post_id, $footer_widget_key );
	}

	$page_builder_container_key   = '_spawp-full-width-content';
	$page_builder_container_value = filter_input( INPUT_POST, $page_builder_container_key, FILTER_SANITIZE_STRING );

	if ( $page_builder_container_value ) {
		update_post_meta( $post_id, $page_builder_container_key, $page_builder_container_value );
	} else {
		delete_post_meta( $post_id, $page_builder_container_key );
	}

	if ( ! defined( 'SPAWP_PRO_VERSION' ) ) {
		$disable_content_title_key   = '_spawp-disable-headline';
		$disable_content_title_value = filter_input( INPUT_POST, $disable_content_title_key, FILTER_SANITIZE_STRING );

		if ( $disable_content_title_value ) {
			update_post_meta( $post_id, $disable_content_title_key, $disable_content_title_value );
		} else {
			delete_post_meta( $post_id, $disable_content_title_key );
		}
	}

	do_action( 'spawp_layout_meta_box_save', $post_id );
}


if ( ! function_exists( 'spawp_disable_elements' ) ) {
	function spawp_disable_elements() {
		
		if ( ! is_singular() ) {
			return;
		}

		global $post;

		// Prevent PHP notices
		if ( isset( $post ) ) {
			$disable_header = get_post_meta( $post->ID, '_spawp-disable-header', true );
			$disable_nav = get_post_meta( $post->ID, '_spawp-disable-nav', true );
			$disable_secondary_nav = get_post_meta( $post->ID, '_spawp-disable-secondary-nav', true );
			$disable_post_image = get_post_meta( $post->ID, '_spawp-disable-post-image', true );
			$disable_headline = get_post_meta( $post->ID, '_spawp-disable-headline', true );
			$disable_footer = get_post_meta( $post->ID, '_spawp-disable-footer', true );
		}

		$return = '';

		if ( ! empty( $disable_header ) && false !== $disable_header ) {
			$return = '.top_header__wrap, .page-header {display:none}';
		}

		if ( ! empty( $disable_nav ) && false !== $disable_nav ) {
			$return .= '#site-navigation.primary_menu {display:none !important}';
		}

		if ( ! empty( $disable_secondary_nav ) && false !== $disable_secondary_nav ) {
			$return .= '#secondary-navigation {display:none}';
		}

		if ( ! empty( $disable_post_image ) && false !== $disable_post_image ) {
			$return .= '.spawp-page-header, .post-thumbnail {display:none}';
		}

		if ( ( ! empty( $disable_headline ) && false !== $disable_headline ) && ! is_single() ) {
			$return .= '.archive-header, .entry-header {display:none} .page-content, .entry-content, .entry-summary {margin-top:0}';
		}

		if ( ! empty( $disable_footer ) && false !== $disable_footer ) {
			$return .= '.footer__wrap, .copyright__wrap {display:none}';
		}

		return $return;
	}
}

/**
 * Enqueue styles
 */
if ( ! function_exists('spawp_disable_scripts') ) {
	add_action( 'wp_enqueue_scripts', 'spawp_disable_scripts', 50 );
	function spawp_disable_scripts() {
		wp_register_style( 'spawp-disable-elements-style', false );
		wp_enqueue_style( 'spawp-disable-elements-style' );
		wp_add_inline_style( 'spawp-disable-elements-style', spawp_disable_elements() );
	}
}