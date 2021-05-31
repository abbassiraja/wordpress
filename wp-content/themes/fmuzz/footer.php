<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "body-content-wrapper" div and all content after.
 *
 */
?>
			<a href="#" class="scrollup"></a>

			<footer id="footer-main">

				<div id="footer-content-wrapper">

					<?php get_sidebar( 'footer' ); ?>

					<div class="clear">
					</div>

				</div><!-- #footer-content-wrapper -->

			</footer>
			<div id="footer-bottom-area">
				<div id="footer-bottom-content-wrapper">
					<div id="copyright">

						<p>
							<?php fmuzz_show_copyright_text(); ?>
						 	<a href="<?php echo esc_url( 'https://tishonator.com/product/fmuzz' ); ?>"
						 		title="<?php esc_attr_e( 'fmuzz Theme', 'fmuzz' ); ?>">
								<?php esc_html_e('fmuzz Theme', 'fmuzz'); ?>
							</a> 
							<?php
								/* translators: %s: WordPress name */
								printf( __( 'Powered by %s', 'fmuzz' ), 'WordPress' ); ?>
						</p>
						
					</div><!-- #copyright -->
				</div>
			</div><!-- #footer-main -->

		</div><!-- #body-content-wrapper -->
		<?php wp_footer(); ?>
	</body>
</html>