<?php
/**
 * Default theme options.
 *
 * @package royal-magazine
 */

if ( ! function_exists( 'royal_magazine_get_default_theme_options' ) ) :

	/**
	 * Get default theme options
	 *
	 * @since 1.0.0
	 *
	 * @return array Default theme options.
	 */
	function royal_magazine_get_default_theme_options() {

		$defaults = array();
		
		// Top Section.
		$defaults['show_navigation_collaps']			= 1;
		$defaults['show_top_section_date']				= 1;
		$defaults['banner_title_post']					= esc_html__('Our Blog','royal-magazine');
		$defaults['magazine_title_text_1']				= esc_html__('Trending News','royal-magazine');
		$defaults['magazine_title_text_2']				= esc_html__('Exclusive','royal-magazine');
		$defaults['news_enable_top_bar']				= 1;

		// Slider Section.
		$defaults['show_slider_section']				= 1;
		$defaults['show_slider_on_blog_page']			= 1;
		$defaults['select_category_for_slider']			= 1;
		
		/*Latest Blog Default Value*/
		$defaults['show_featured_section']					= 0;
		$defaults['main_title_featured_section']			= '';
		$defaults['select_category_for_featured']			= 0;

		/*layout*/
		$defaults['home_page_content_status']     	= 1;
		$defaults['enable_overlay_option']			= 1;
		$defaults['homepage_layout_option']			= 'full-width';
		$defaults['global_layout']					= 'right-sidebar';
		$defaults['excerpt_length_global']			= 30;
		$defaults['archive_layout']					= 'excerpt-only';
		$defaults['archive_layout_image']			= 'left';
		$defaults['single_post_image_layout']		= 'full';
        $defaults['read_more_button_text'] = esc_html__( 'Continue Reading', 'royal-magazine' );
		$defaults['pagination_type']				= 'default';
		$defaults['copyright_text']					= esc_html__( 'Copyright All rights reserved', 'royal-magazine' );
		$defaults['number_of_footer_widget']		= 3;
		$defaults['breadcrumb_type']				= 'simple';
		$defaults['enable_preloader_option']		= 1;
		$defaults['enable_header_search']		= 1;
		$defaults['enable_footer_scroll_top']		= 1;
		$defaults['ed_floating_next_previous_nav']             = 0;
		// Pass through filter.
		$defaults = apply_filters( 'royal_magazine_filter_default_theme_options', $defaults );

		return $defaults;

	}

endif;
