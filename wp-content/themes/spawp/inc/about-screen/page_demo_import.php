
<div class="demo-import-tab-content info-tab-content">

	<?php if ( class_exists('OCDI_Plugin') ) {?>
	
		<div id="plugin-filter" class="demo-import-boxed">
		<?php printf(sprintf(__( '<p>Congratulations! you have installed importer plugin successfully. Click Here to start <a href="%1$s">Import Data</a></p>', 'spawp' ), esc_url( admin_url('themes.php?page=pt-one-click-demo-import') ) )); ?>
		</div>
		
	<?php } else { ?>
		<div id="plugin-filter" class="demo-import-boxed">
			<?php
			$plugin_name = 'one-click-demo-import';
			$plugin_status = is_dir( WP_PLUGIN_DIR . '/' . $plugin_name );
			$button_class = 'install-now button';
			$button_txt = esc_html__( 'Install Now', 'spawp' );
			if ( ! $plugin_status ) {
				$install_url = wp_nonce_url(
					add_query_arg(
						array(
							'action' => 'install-plugin',
							'plugin' => $plugin_name
						),
						network_admin_url( 'update.php' )
					),
					'install-plugin_'.$plugin_name
				);

			} else {
				$install_url = add_query_arg(array(
					'action' => 'activate',
					'plugin' => rawurlencode( $plugin_name . '/' . $plugin_name . '.php' ),
					'plugin_status' => 'all',
					'paged' => '1',
					'_wpnonce' => wp_create_nonce('activate-plugin_' . $plugin_name . '/' . $plugin_name . '.php'),
				), network_admin_url('plugins.php'));
				$button_class = 'activate-now button-primary';
				$button_txt = esc_html__( 'Active Now', 'spawp' );
			}

			$detail_link = add_query_arg(
				array(
					'tab' => 'plugin-information',
					'plugin' => $plugin_name,
					'TB_iframe' => 'true',
					'width' => '772',
					'height' => '349',

				),
				network_admin_url( 'plugin-install.php' )
			);

			echo '<p>';
			printf( esc_html__(
				'%1$s you will need to install and activate the %2$s plugin first.', 'spawp' ),
				'<b>'.esc_html__( 'Hey.', 'spawp' ).'</b>',
				'<a class="thickbox open-plugin-details-modal" href="'.esc_url( $detail_link ).'">'.esc_html__( 'Theme Demo Importer', 'spawp' ).'</a>'
			);
			echo '</p>';

			echo '<p class="plugin-card-'.esc_attr( $plugin_name ).'"><a href="'.esc_url( $install_url ).'" data-slug="'.esc_attr( $plugin_name ).'" class="'.esc_attr( $button_class ).'">'.$button_txt.'</a></p>';

			?>
		</div>
	<?php } ?>
</div><!-- tab 3 -->