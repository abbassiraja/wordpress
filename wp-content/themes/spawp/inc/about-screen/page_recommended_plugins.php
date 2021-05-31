<div class="action-required-tab info-tab-content">

	<?php if ( $actions_r['number_active']  > 0 ) { ?>
	
		<?php 
		$actions = wp_parse_args( 
			$actions, 
			array( 
			'page_on_front' => '', 
			'page_template' ) 
			);
		?>

		<?php if ( $actions['recommend_plugins'] == 'active' ) {  ?>
			<div id="plugin-filter" class="recommend-plugins action-required">
				<a  title="" class="dismiss" href="<?php echo add_query_arg( array( 'spawp_action_notice' => 'recommend_plugins' ), $current_action_link ); ?>">
					<?php if ( $actions_r['hide_by_click']['recommend_plugins'] == 'hide' ) { ?>
						<span class="dashicons dashicons-hidden"></span>
					<?php } else { ?>
						<span class="dashicons  dashicons-visibility"></span>
					<?php } ?>
				</a>
				<h3><?php esc_html_e( 'Recommend Plugins', 'spawp' ); ?></h3>
				<?php
				$this->spawp_render_recommend_plugins( $recommend_plugins );
				?>
			</div>
		<?php } ?>


		<?php if ( $actions['page_on_front'] == 'active' ) {  ?>
			<div class="theme_link  action-required">
				<a title="<?php  esc_attr_e( 'Dismiss', 'spawp' ); ?>" class="dismiss" href="<?php echo add_query_arg( array( 'spawp_action_notice' => 'page_on_front' ), $current_action_link ); ?>">
					<?php if ( $actions_r['hide_by_click']['page_on_front'] == 'hide' ) { ?>
						<span class="dashicons dashicons-hidden"></span>
					<?php } else { ?>
						<span class="dashicons  dashicons-visibility"></span>
					<?php } ?>
				</a>
				<h3><?php esc_html_e( 'Switch "Front page displays" to "A static page"', 'spawp' ); ?></h3>
				<div class="about">
					<p><?php _e( 'In order to have the one page look for your website, please go to Customize -&gt; Static Front Page and switch "Front page displays" to "A static page".', 'spawp' ); ?></p>
				</div>
				<p>
					<a  href="<?php echo admin_url('options-reading.php'); ?>" class="button"><?php esc_html_e('Setup front page displays', 'spawp'); ?></a>
				</p>
			</div>
		<?php } ?>

		<?php if ( $actions['page_template'] == 'active' ) {  ?>
			<div class="theme_link  action-required">
				<a  title="<?php  esc_attr_e( 'Dismiss', 'spawp' ); ?>" class="dismiss" href="<?php echo add_query_arg( array( 'spawp_action_notice' => 'page_template' ), $current_action_link ); ?>">
					<?php if ( $actions_r['hide_by_click']['page_template'] == 'hide' ) { ?>
						<span class="dashicons dashicons-hidden"></span>
					<?php } else { ?>
						<span class="dashicons  dashicons-visibility"></span>
					<?php } ?>
				</a>
				<h3><?php esc_html_e( 'Set your homepage page template to "Frontpage".', 'spawp' ); ?></h3>

				<div class="about">
					<p><?php esc_html_e( 'In order to change homepage section contents, you will need to set template "Frontpage" for your homepage.', 'spawp' ); ?></p>
				</div>
				<p>
					<?php
					$front_page = get_option( 'page_on_front' );
					if ( $front_page <= 0  ) {
						?>
						<a  href="<?php echo admin_url('options-reading.php'); ?>" class="button"><?php esc_html_e('Setup front page displays', 'spawp'); ?></a>
						<?php

					}

					if ( $front_page > 0 && get_post_meta( $front_page, '_wp_page_template', true ) != 'template-frontpage.php' ) {
						?>
						<a href="<?php echo get_edit_post_link( $front_page ); ?>" class="button"><?php esc_html_e('Change homepage page template', 'spawp'); ?></a>
						<?php
					}
					?>
				</p>
			</div>
		<?php } ?>
		
	<?php  } else { ?>
	
		<h3><?php  printf( __( 'Keep %s updated', 'spawp' ) , $theme->Name ); ?></h3>
		
		<p><?php _e( 'Hey! There are no required actions found.', 'spawp' ); ?></p>
		
	<?php } ?>
	
</div><!-- tab 2 -->