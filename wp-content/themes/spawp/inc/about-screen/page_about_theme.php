<div class="themepage_info info-tab-content">
	<div class="themepage_info_column clearfix">
		<div class="themepage_info_left">

			<div class="themepage_link">
				<h3><?php esc_html_e( 'Customize Options Settings', 'spawp' ); ?></h3>
				<p class="about"><?php printf(esc_html__('%s theme supports the theme customizer option panel settings. Click on below customize button to customize your theme.', 'spawp'), 'Spawp'); ?></p>
				<p>
					<a href="<?php echo admin_url('customize.php'); ?>" class="button button-primary"><?php esc_html_e('Customize Your Theme', 'spawp'); ?></a>
				</p>
			</div>
			<div class="themepage_link">
				<h3><?php esc_html_e( 'Documentation', 'spawp' ); ?></h3>
				<p class="about"><?php printf(esc_html__('Need to setup your %s WordPress theme? Please click on bottom button  to find the theme documentation.', 'spawp'), 'Spawp'); ?></p>
				<p>
					<a href="<?php echo esc_url( 'https://helpdocs.britetechs.com/category/spawp-pro/' ); ?>" target="_blank" class="button button-secondary"><?php esc_html_e('Spawp Theme Documentation', 'spawp'); ?></a>
				</p>
				<?php do_action( 'spawp_dashboard_theme_links' ); ?>
			</div>
			<div class="themepage_link">
				<h3><?php esc_html_e( 'Need Support?', 'spawp' ); ?></h3>
				<p class="about"><?php printf(esc_html__('If you have more queries with %s WordPress theme. Please click below button to create a ticket.', 'spawp'), 'Spawp'); ?></p>
				<p>
					<a href="<?php echo esc_url('https://www.britetechs.com/support/' ); ?>" target="_blank" class="button button-secondary"><?php echo sprintf( esc_html__('Create a ticket', 'spawp'), 'Spawp'); ?></a>
				</p>
			</div>
		</div>

		<div class="themepage_info_right">
			<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/screenshot.png" alt="spawp Theme Screen" />
		</div>
	</div>
</div><!-- tab 1 -->