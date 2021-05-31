<?php
class spawp_dashboard {
	public function __construct() {
		
		add_action('admin_menu', array( $this, 'spawp_about' ) );

		add_action( 'admin_enqueue_scripts', array( $this, 'spawp_admin_scripts' ) );
		
		add_action( 'admin_init', array( $this, 'spawp_admin_dismiss_actions' ) );
		
		add_action('switch_theme', array( $this, 'spawp_reset_recommended_actions' ));
		
		add_action( 'load-themes.php',  array( $this, 'spawp_one_activation_admin_notice' )  );
	}
	function spawp_one_activation_admin_notice(){
		global $pagenow;
		if ( is_admin() && ('themes.php' == $pagenow) && isset( $_GET['activated'] ) ) {
			add_action( 'admin_notices', array( $this, 'spawp_admin_notice' ) );
			add_action( 'admin_notices', array( $this, 'spawp_admin_import_notice' ) );
		}
	}
	function spawp_admin_notice() {
		if ( ! function_exists( 'spawp_get_recommended_actions' ) ) {
			return false;
		}
		$actions = spawp_get_recommended_actions();
		$number_action = $actions['number_notice'];

		if ( $number_action > 0 ) {
			$theme = wp_get_theme();
			?>
			<div class="updated notice notice-success notice-alt is-dismissible">
				<p><?php printf( __( 'Welcome! Thank you for choosing %1$s! To fully take advantage of the best our theme can offer please make sure you visit our <a href="%2$s">Welcome page</a>', 'spawp' ),  $theme->Name, admin_url( 'themes.php?page=bt_themepage' )  ); ?></p>
			</div>
			<?php
		}
	}

	function spawp_admin_import_notice(){
		?>
		<div class="updated notice notice-success notice-alt is-dismissible">
			<p><?php printf( esc_html__( 'Save time by import our demo data, your website will be set up and ready to customize in minutes. %s', 'spawp' ), '<a class="button button-secondary" href="'.esc_url( add_query_arg( array( 'page' => 'bt_themepage&tab=demo-data-importer' ), admin_url( 'themes.php' ) ) ).'">'.esc_html__( 'Import Demo Data', 'spawp' ).'</a>'  ); ?></p>
		</div>
		<?php
	}
	public function spawp_reset_recommended_actions () {
		delete_option('spawp_actions_dismiss');
	}
	function spawp_admin_dismiss_actions(){
		// Action for dismiss
		if ( isset( $_GET['spawp_action_notice'] ) ) {
			$actions_dismiss =  get_option( 'spawp_actions_dismiss' );
			if ( ! is_array( $actions_dismiss ) ) {
				$actions_dismiss = array();
			}
			$action_key = sanitize_text_field( $_GET['spawp_action_notice'] );
			if ( isset( $actions_dismiss[ $action_key ] ) &&  $actions_dismiss[ $action_key ] == 'hide' ){
				$actions_dismiss[ $action_key ] = 'show';
			} else {
				$actions_dismiss[ $action_key ] = 'hide';
			}
			update_option( 'spawp_actions_dismiss', $actions_dismiss );
			$url = wp_unslash( $_SERVER['REQUEST_URI'] );
			$url = remove_query_arg( 'spawp_action_notice', $url );
			wp_redirect( $url );
			die();
		}

	}
	public function spawp_admin_scripts( $hook ){
		
		if ( $hook === 'appearance_page_bt_themepage'  ) {
			
            wp_enqueue_style( 'spawp-admin-css', get_template_directory_uri() . '/inc/about-screen/css/dashboard.css' );

            wp_enqueue_style( 'plugin-install' );

            wp_enqueue_script( 'plugin-install' );

            wp_enqueue_script( 'updates' );

            add_thickbox();

			wp_enqueue_script( 'spawp-plugin-install-helper',  get_template_directory_uri() . '/inc/install/js/install.js' );
				wp_localize_script(
				'spawp-plugin-install-helper', 'spawp_plugin_helper',
				array(
					'activating' => esc_html__( 'Activating ', 'spawp' ),
				)
			);

			wp_localize_script(
				'spawp-plugin-install-helper', 'pagenow',
				array( 'import' )
			);

        }
	}
	
	public function spawp_about(){
		
		$recommended_actions = $this->spawp_get_recommended_actions();
		
		$number_count = $recommended_actions['number_notice'];

		if ( $number_count > 0 ){
			
			$update_label = sprintf( _n( '%1$s action required', '%1$s actions required', $number_count, 'spawp' ), $number_count );
			
			$count = "<span class='update-plugins count-".esc_attr( $number_count )."' title='".esc_attr( $update_label )."'><span class='update-count'>" . number_format_i18n($number_count) . "</span></span>";
			
			$menu_title = sprintf( esc_html__('Spawp %s', 'spawp'), $count );
			
		} else {
			
			$menu_title = esc_html__('Spawp Theme', 'spawp');
		}

		add_theme_page( 
			esc_html__( 'Spawp Dashboard', 'spawp' ), 
			$menu_title, 
			'edit_theme_options', 
			'bt_themepage', 
			array($this,'spawp_theme_about_page')
			);
	}
	
	public function spawp_theme_about_page(){
		$theme = wp_get_theme('spawp');
		
		if ( isset( $_GET['spawp_action_dismiss'] ) ) {
			$actions_dismiss =  get_option( 'spawp_actions_dismiss' );
			if ( ! is_array( $actions_dismiss ) ) {
				$actions_dismiss = array();
			}
			$actions_dismiss[ sanitize_text_field( $_GET['spawp_action_dismiss'] ) ] = 'dismiss';
			update_option( 'spawp_actions_dismiss', $actions_dismiss );
		}
		
		$page_tab = null;
		if ( isset( $_GET['tab'] ) ) {
			$page_tab = sanitize_text_field( $_GET['tab'] );
		} else {
			$page_tab = null;
		}
		
		$actions_r = $this->spawp_get_recommended_actions();
		$number_action = $actions_r['number_notice'];
		$actions = $actions_r['actions'];

		$current_action_link =  admin_url( 'themes.php?page=bt_themepage&tab=recommended_actions' );

		$recommend_plugins = get_theme_support( 'recommend-plugins' );
		if ( is_array( $recommend_plugins ) && isset( $recommend_plugins[0] ) ){
			$recommend_plugins = $recommend_plugins[0];
		} else {
			$recommend_plugins[] = array();
		}
		?>
		<div class="wrap about-wrap themepage_wrapper">
		
			<h1>
				<?php printf( esc_html__('Welcome to %2$s - Version %1$s', 'spawp'), $theme->Version, $theme->Name ); ?>
			</h1>
			
			<div class="about-text">
				<?php printf( sprintf( __( 'Spawp is a creative, clean, easy to use and modren multipurpose WordPress theme. This theme is perfect for any kind of bussiness like Spa, beauty salon, wellness center, natural health care beauty business, massage parlor, yoga studio, meditation classes, personal, corporate, agency, photography, wedding, portfolio, blogs, magazines and many others businesses.', 'spawp' ) ) ); ?>
			</div>
			
			<a target="_blank" href="<?php echo esc_url('https://www.britetechs.com/'); ?>" class="britetechs-badge wp-badge"><span><?php _e('Britetechs','spawp') ?></span></a>
			
			<hr class="wp-header-end">
			
			<h2 class="nav-tab-wrapper">
			
				<a href="?page=bt_themepage" class="nav-tab<?php echo is_null($page_tab) ? ' nav-tab-active' : null; ?>"><?php esc_html_e( 'Spawp', 'spawp' ) ?></a>
				
				<a href="?page=bt_themepage&tab=recommended_actions" class="nav-tab<?php echo $page_tab == 'recommended_actions' ? ' nav-tab-active' : null; ?>"><?php esc_html_e( 'Recommended Actions', 'spawp' ); echo ( $number_action > 0 ) ? "<span class='theme-action-count'>{$number_action}</span>" : ''; ?></a>
				
				<?php if( !class_exists('Spawp_Premium_Theme_Setup') && $page_tab == 'free_vs_pro' ){ ?>
				<a href="?page=bt_themepage&tab=free_vs_pro" class="nav-tab<?php echo $page_tab == 'free_vs_pro' ? ' nav-tab-active' : null; ?>"><?php esc_html_e( 'Free vs Pro', 'spawp' ); ?></span></a>
				<?php } ?>

				<?php do_action('spawp_about_page_tabs'); ?>

				<a href="?page=bt_themepage&tab=demo-data-importer" class="nav-tab<?php echo $page_tab == 'demo-data-importer' ? ' nav-tab-active' : null; ?>">
					<?php esc_html_e( 'One Click Demo Import', 'spawp' ); ?></span></a>
			</h2>
			
			<?php 

				if ( is_null( $page_tab ) ) {
					require get_template_directory() . '/inc/about-screen/page_about_theme.php';
				}

				if ( $page_tab == 'recommended_actions' ) {
					require get_template_directory() . '/inc/about-screen/page_recommended_plugins.php';
				}

				if( !class_exists('Spawp_Premium_Theme_Setup') ){
					require get_template_directory() . '/inc/about-screen/page_free_vs_pro.php';
				}

				do_action('spawp_about_page_tabs_content');

				if ( $page_tab == 'demo-data-importer' ) {
					require get_template_directory() . '/inc/about-screen/page_demo_import.php';
				}

			?>	

			<div class="theme-panel-extra">
				<div class="extra-detail w-50">
					<div class="extra-desc-inner">
						<h3><?php _e('Quick customizer settings links','spawp');?></h3>
						<ul class="extra-list">
							<li><span class="dashicons dashicons-button"></span><a href="<?php echo esc_url( admin_url( 'customize.php?autofocus[section]=title_tagline' ) ); ?>"><?php _e('Site Logo','spawp');?></a></li>
							
							<li><span class="dashicons dashicons-schedule"></span><a href="<?php echo esc_url( admin_url( 'customize.php?autofocus[section]=header_image' ) ); ?>"><?php _e('Sub Header Settings','spawp');?></a></li>
							
							<li><span class="dashicons dashicons-align-center"></span><a href="<?php echo esc_url( admin_url( 'customize.php?autofocus[section]=nav_menus' ) ); ?>"><?php _e('Menus Settings','spawp');?></a></li>
							
							<li><span class="dashicons dashicons-admin-customizer"></span><a href="<?php echo esc_url( admin_url( 'customize.php?autofocus[section]=theme_color_panel' ) ); ?>"><?php _e('Colors Settings','spawp');?></a></li>

							<li><span class="dashicons dashicons-grid-view"></span><a href="<?php echo esc_url( admin_url( 'customize.php?autofocus[section]=spawp_portfolio_section' ) ); ?>"><?php _e('Portfolio Settings','spawp');?></a></li>
							
							<li><span class="dashicons dashicons-editor-table"></span><a href="<?php echo esc_url( admin_url( 'customize.php?autofocus[section]=spawp_blog_section' ) ); ?>"><?php _e('Blog Settings','spawp');?></a></li>						

							<li><span class="dashicons dashicons-images-alt2"></span><a href="<?php echo esc_url( admin_url( 'customize.php?autofocus[section]=spawp_slider_section' ) ); ?>"><?php _e('Slider Settings','spawp');?></a></li>

							<li><span class="dashicons dashicons-editor-ul"></span><a href="<?php echo esc_url( admin_url( 'customize.php?autofocus[section]=spawp_service_section' ) ); ?>"><?php _e('Service Settings','spawp');?></a></li>

							<li><span class="dashicons dashicons-welcome-write-blog"></span><a href="<?php echo esc_url( admin_url( 'customize.php?autofocus[section]=footer_section' ) ); ?>"><?php _e('Footer Settings','spawp');?></a></li>

							<li><span class="dashicons dashicons-editor-textcolor"></span><a href="<?php echo esc_url( admin_url( 'customize.php?autofocus[section]=typography_panel' ) ); ?>"><?php _e('Typography Settings','spawp');?></a></li>

							<li><span class="dashicons dashicons-admin-generic"></span><a href="<?php echo esc_url( admin_url( 'customize.php?autofocus[section]=custom_css' ) ); ?>"><?php _e('Additional CSS','spawp');?></a></li>

						</ul>
					</div>
				</div>
				<div class="extra-detail w-50">
					<div class="extra-desc-inner">
						<h3><?php _e('Advanced Features are available in Spawp Pro','spawp');?></h3>
						<ul class="extra-list">
							<li ><i class="dashicons dashicons-align-left"></i><?php _e('Sticky Navigation','spawp');?></li>
							<li ><i class="dashicons dashicons-star-half"></i><?php _e('Light &amp; Dark Color Schemes','spawp');?></li>
							<li ><i class="dashicons dashicons-editor-textcolor"></i><?php _e('Google Fonts Supported','spawp');?></li>
							<li ><i class="dashicons dashicons-admin-customizer"></i><?php _e('Unlimited Colors','spawp');?></li>
							<li ><i class="dashicons dashicons-align-center"></i><?php _e('Wide &amp; Boxed Layouts','spawp');?></li>
							<li ><i class="dashicons dashicons-heading"></i><?php _e('Multiple Header Layouts','spawp');?></li>
							<li ><i class="dashicons dashicons-editor-table"></i><?php _e('Blog Templates','spawp');?></li>
							<li ><i class="dashicons dashicons-list-view"></i><?php _e('Section Reordering','spawp');?></li>
							<li ><i class="dashicons dashicons-translation"></i><?php _e('RTL Supported','spawp');?></li>
							<li ><i class="dashicons dashicons-editor-textcolor"></i><?php _e('Premium Typography Settings','spawp');?></li>
							<li ><i class="dashicons dashicons-database-import"></i><?php _e('One Click Demo Import','spawp');?></li>
							<li ><i class="dashicons dashicons-admin-generic"></i><?php _e('Live Customizer','spawp');?></li>
							<li ><i class="dashicons dashicons-admin-site-alt"></i><?php _e('Translation Ready','spawp');?></li>
							<li ><i class="dashicons dashicons-thumbs-up"></i><?php _e('1 Year Free Updates','spawp');?></li>
							<li ><i class="dashicons dashicons-businesswoman"></i><?php _e('Premium Supports','spawp');?></li>
						</ul>
					</div>
				</div>
			</div>	
		
		</div>
		<?php
	}
	
	public function spawp_get_recommended_actions( ) {

		$actions = array();
		$front_page = get_option( 'page_on_front' );
		$actions['page_on_front'] = 'dismiss';
		$actions['page_template'] = 'dismiss';
		$actions['recommend_plugins'] = 'dismiss';
		if ( 'page' != get_option( 'show_on_front' ) ) {
			$front_page = 0;
		}
		if ( $front_page <= 0  ) {
			$actions['page_on_front'] = 'active';
			$actions['page_template'] = 'active';
		} else {
			if ( get_post_meta( $front_page, '_wp_page_template', true ) == 'template-frontpage.php' ) {
				$actions['page_template'] = 'dismiss';
			} else {
				$actions['page_template'] = 'active';
			}
		}

		$recommend_plugins = get_theme_support( 'recommend-plugins' );
		if ( is_array( $recommend_plugins ) && isset( $recommend_plugins[0] ) ){
			$recommend_plugins = $recommend_plugins[0];
		} else {
			$recommend_plugins[] = array();
		}

		if ( ! empty( $recommend_plugins ) ) {

			foreach ( $recommend_plugins as $plugin_slug => $plugin_info ) {
				$plugin_info = wp_parse_args( $plugin_info, array(
					'name' => '',
					'active_filename' => '',
				) );
				if ( $plugin_info['active_filename'] ) {
					$active_file_name = $plugin_info['active_filename'] ;
				} else {
					$active_file_name = $plugin_slug . '/' . $plugin_slug . '.php';
				}
				if ( ! is_plugin_active( $active_file_name ) ) {
					$actions['recommend_plugins'] = 'active';
				}
			}

		}

		$actions = apply_filters( 'spawp_get_recommended_actions', $actions );
		$hide_by_click = get_option( 'spawp_actions_dismiss' );
		if ( ! is_array( $hide_by_click ) ) {
			$hide_by_click = array();
		}

		$n_active  = $n_dismiss = 0;
		$number_notice = 0;
		foreach ( $actions as $k => $v ) {
			if ( ! isset( $hide_by_click[ $k ] ) ) {
				$hide_by_click[ $k ] = false;
			}

			if ( $v == 'active' ) {
				$n_active ++ ;
				$number_notice ++ ;
				if ( $hide_by_click[ $k ] ) {
					if ( $hide_by_click[ $k ] == 'hide' ) {
						$number_notice -- ;
					}
				}
			} else if ( $v == 'dismiss' ) {
				$n_dismiss ++ ;
			}

		}

		$return = array(
			'actions' => $actions,
			'number_actions' => count( $actions ),
			'number_active' => $n_active,
			'number_dismiss' => $n_dismiss,
			'hide_by_click'  => $hide_by_click,
			'number_notice'  => $number_notice,
		);
		if ( $return['number_notice'] < 0 ) {
			$return['number_notice'] = 0;
		}

		return $return;
	}
	
	public function spawp_render_recommend_plugins( $recommend_plugins = array() ){
		foreach ( $recommend_plugins as $plugin_slug => $plugin_info ) {
			$plugin_info = wp_parse_args( $plugin_info, array(
				'name' => '',
				'active_filename' => '',
			) );
			$plugin_name = $plugin_info['name'];
			$status = is_dir( WP_PLUGIN_DIR . '/' . $plugin_slug );
			$button_class = 'install-now button';
			if ( $plugin_info['active_filename'] ) {
				$active_file_name = $plugin_info['active_filename'] ;
			} else {
				$active_file_name = $plugin_slug . '/' . $plugin_slug . '.php';
			}

			if ( ! is_plugin_active( $active_file_name ) ) {
				$button_txt = esc_html__( 'Install Now', 'spawp' );
				if ( ! $status ) {
					$install_url = wp_nonce_url(
						add_query_arg(
							array(
								'action' => 'install-plugin',
								'plugin' => $plugin_slug
							),
							network_admin_url( 'update.php' )
						),
						'install-plugin_'.$plugin_slug
					);

				} else {
					$install_url = add_query_arg(array(
						'action' => 'activate',
						'plugin' => rawurlencode( $active_file_name ),
						'plugin_status' => 'all',
						'paged' => '1',
						'_wpnonce' => wp_create_nonce('activate-plugin_' . $active_file_name ),
					), network_admin_url('plugins.php'));
					$button_class = 'activate-now button-primary';
					$button_txt = esc_html__( 'Active Now', 'spawp' );
				}

				$detail_link = add_query_arg(
					array(
						'tab' => 'plugin-information',
						'plugin' => $plugin_slug,
						'TB_iframe' => 'true',
						'width' => '772',
						'height' => '349',

					),
					network_admin_url( 'plugin-install.php' )
				);

				echo '<div class="rcp">';
				echo '<h4 class="rcp-name">';
				echo esc_html( $plugin_name );
				echo '</h4>';
				echo '<p class="action-btn plugin-card-'.esc_attr( $plugin_slug ).'"><a href="'.esc_url( $install_url ).'" data-slug="'.esc_attr( $plugin_slug ).'" class="'.esc_attr( $button_class ).'">'.$button_txt.'</a></p>';
				echo '<a class="plugin-detail thickbox open-plugin-details-modal" href="'.esc_url( $detail_link ).'">'.esc_html__( 'Details', 'spawp' ).'</a>';
				echo '</div>';
			}

		}
	}
}
$GLOBALS['spawp_dashboard'] = new spawp_dashboard();