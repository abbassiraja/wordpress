<?php

/**************************************************
**** Layout Sections Settings Register
***************************************************/

if ( ! class_exists( 'SPAWP_Customize_Layout_Sections_Settings' ) ) :
	
	class SPAWP_Customize_Layout_Sections_Settings extends SPAWP_Custom_Base_Customize_Settings {

		public function elements() {

			$option = spawp_theme_default_data();
			$elements = array();

			// preloader settings
			$elements['spawp_option[preloader]'] = array(
				'setting' => array(
					'default'           => $option['preloader'],
					'sanitize_callback' => 'SPAWP_Customizer_Sanitize::sanitize_checkbox',
					'type' => 'option',
				),
				'control' => array(
					'label'    => sprintf(__( 'Preloader Show', 'spawp' )),
					'section'  => 'preloader_section',
					'type'     => 'toggle',
					'is_default_type' => false,
					'priority' => 1,
				),
			);

			// layout settings
			$elements['spawp_option[layout]'] = array(
				'setting' => array(
					'default'           => $option['layout'],
					'sanitize_callback' => 'SPAWP_Customizer_Sanitize::sanitize_select',
					'type' => 'option',
				),
				'control' => array(
					'label'    => __( 'Layout', 'spawp' ),
					'section'  => 'layout_section',
					'type'     => 'select',
					'choices'  => array(
						'wide' => __('Wide','spawp'),
						'boxed' => __('Boxed','spawp'),
					),
					'is_default_type' => true,
					'priority' => 1,
				),
			);

			// container settings
			$elements['spawp_option[container_width]'] = array(
				'setting' => array(
					'default'           => $option['container_width'],
					'sanitize_callback' => 'spawp_sanitize_range_value',
					'type' => 'option',
					'transport' => 'postMessage',
				),
				'control' => array(
					'label'    => sprintf(__( 'Container Width (px)', 'spawp' )),
					'section'  => 'container_section',
					'type'     => 'range_value',
					'media_query' => false,
                    'input_attr' => array(
                        'mobile' => array(
                            'min' => 200,
                            'max' => 748,
                            'step' => 1,
                            'default_value' => 748,
                        ),
                        'tablet' => array(
                            'min' => 300,
                            'max' => 992,
                            'step' => 1,
                            'default_value' => 992,
                        ),
                        'desktop' => array(
                            'min' => 700,
                            'max' => 2000,
                            'step' => 1,
                            'default_value' => 1200,
                        ),
                    ),
					'is_default_type' => false,
					'priority' => 1,
				),
			);

			// content layout setting
			$elements['spawp_option[content_layout_setting]'] = array(
				'setting' => array(
					'default'           => $option['content_layout_setting'],
					'sanitize_callback' => 'SPAWP_Customizer_Sanitize::sanitize_select',
					'type' => 'option',
				),
				'control' => array(
					'label'    => sprintf(__( 'Content Layout', 'spawp' )),
					'section'  => 'container_section',
					'type'     => 'select',
					'choices'     => array(
						'separate-containers' => __('Separate Containers', 'spawp'),
						'one-container' => __('One Container', 'spawp'),
					),
					'is_default_type' => true,
					'priority' => 4,
				),
			);

			// topbar show
			$elements['spawp_option[topbar_show]'] = array(
				'setting' => array(
					'default'           => $option['topbar_show'],
					'sanitize_callback' => 'SPAWP_Customizer_Sanitize::sanitize_checkbox',
					'type' => 'option',
				),
				'control' => array(
					'label'    => sprintf(__( 'Top Bar Enable', 'spawp' )),
					'section'  => 'topbar_section',
					'type'     => 'toggle',
					'is_default_type' => false,
					'priority' => 1,
				),
			);

			// topbar width
			$elements['spawp_option[topbar_width]'] = array(
				'setting' => array(
					'default'           => $option['topbar_width'],
					'sanitize_callback' => 'SPAWP_Customizer_Sanitize::sanitize_select',
					'type' => 'option',
				),
				'control' => array(
					'label'    => sprintf(__( 'Top Bar Width', 'spawp' )),
					'section'  => 'topbar_section',
					'type'     => 'select',
					'choices' => array(
						'container-fluid' => __('Full','spawp'), 
						'container' => __('Contained','spawp'),
					),
					'is_default_type' => true,
					'priority' => 2,
				),
			);

			// topbar inner width
			$elements['spawp_option[topbar_inner_width]'] = array(
				'setting' => array(
					'default'           => $option['topbar_inner_width'],
					'sanitize_callback' => 'SPAWP_Customizer_Sanitize::sanitize_select',
					'type' => 'option',
				),
				'control' => array(
					'label'    => sprintf(__( 'Top Bar Inner Width', 'spawp' )),
					'section'  => 'topbar_section',
					'type'     => 'select',
					'choices' => array(
						'container-fluid' => __('Full','spawp'), 
						'container' => __('Contained','spawp'),
					),
					'is_default_type' => true,
					'priority' => 3,
				),
			);

			// topbar alignment
			$elements['spawp_option[topbar_alignment]'] = array(
				'setting' => array(
					'default'           => $option['topbar_alignment'],
					'sanitize_callback' => 'SPAWP_Customizer_Sanitize::sanitize_select',
					'type' => 'option',
				),
				'control' => array(
					'label'    => sprintf(__( 'Top Bar Alignment', 'spawp' )),
					'section'  => 'topbar_section',
					'type'     => 'select',
					'choices' => array(
						'left' => __('Left','spawp'), 
						'center' => __('Center','spawp'),
						'right' => __('Right','spawp'),
					),
					'is_default_type' => true,
					'priority' => 4,
				),
			);

			// topbar office time
			$elements['spawp_option[topbar_office_time]'] = array(
				'setting' => array(
					'default'           => $option['topbar_office_time'],
					'sanitize_callback' => 'sanitize_text_field',
					'type' => 'option',
				),
				'control' => array(
					'label'    => sprintf(__( 'Office Time', 'spawp' )),
					'section'  => 'topbar_section',
					'type'     => 'text',
					'is_default_type' => true,
					'priority' => 5,
				),
			);

			// topbar email
			$elements['spawp_option[topbar_email]'] = array(
				'setting' => array(
					'default'           => $option['topbar_email'],
					'sanitize_callback' => 'sanitize_text_field',
					'type' => 'option',
				),
				'control' => array(
					'label'    => sprintf(__( 'Email', 'spawp' )),
					'section'  => 'topbar_section',
					'type'     => 'text',
					'is_default_type' => true,
					'priority' => 6,
				),
			);

			// topbar phone
			$elements['spawp_option[topbar_phone]'] = array(
				'setting' => array(
					'default'           => $option['topbar_phone'],
					'sanitize_callback' => 'sanitize_text_field',
					'type' => 'option',
				),
				'control' => array(
					'label'    => sprintf(__( 'Phone', 'spawp' )),
					'section'  => 'topbar_section',
					'type'     => 'text',
					'is_default_type' => true,
					'priority' => 7,
				),
			);

			// footer width
			$elements['spawp_option[footer_width]'] = array(
				'setting' => array(
					'default'           => $option['footer_width'],
					'sanitize_callback' => 'SPAWP_Customizer_Sanitize::sanitize_select',
					'type' => 'option',
				),
				'control' => array(
					'label'    => sprintf(__( 'Footer Width', 'spawp' )),
					'section'  => 'footer_section',
					'type'     => 'select',
					'choices' => array(
						'container-fluid' => __('Full','spawp'), 
						'container' => __('Contained','spawp'),
					),
					'is_default_type' => true,
					'priority' => 1,
				),
			);

			// footer inner width
			$elements['spawp_option[footer_inner_width]'] = array(
				'setting' => array(
					'default'           => $option['footer_inner_width'],
					'sanitize_callback' => 'SPAWP_Customizer_Sanitize::sanitize_select',
					'type' => 'option',
				),
				'control' => array(
					'label'    => sprintf(__( 'Footer Inner Width', 'spawp' )),
					'section'  => 'footer_section',
					'type'     => 'select',
					'choices' => array(
						'container-fluid' => __('Full','spawp'), 
						'container' => __('Contained','spawp'),
					),
					'is_default_type' => true,
					'priority' => 2,
				),
			);

			// footer widget settings
			$elements['spawp_option[footer_widget_setting]'] = array(
				'setting' => array(
					'default'           => $option['footer_widget_setting'],
					'sanitize_callback' => 'SPAWP_Customizer_Sanitize::sanitize_select',
					'type' => 'option',
				),
				'control' => array(
					'label'    => sprintf(__( 'Footer Widget', 'spawp' )),
					'section'  => 'footer_section',
					'type'     => 'select',
					'choices' => array(
						0 => 0, 
						1 => 1,
						2 => 2,
						3 => 3,
						4 => 4,
					),
					'is_default_type' => true,
					'priority' => 3,
				),
			);

			// footer back to top
			$elements['spawp_option[footer_back_to_top]'] = array(
				'setting' => array(
					'default'           => $option['footer_back_to_top'],
					'sanitize_callback' => 'SPAWP_Customizer_Sanitize::sanitize_select',
					'type' => 'option',
				),
				'control' => array(
					'label'    => sprintf(__( 'Footer Back To Top', 'spawp' )),
					'section'  => 'footer_section',
					'type'     => 'select',
					'choices' => array(
						'enable' => __('Enable','spawp'), 
						'disable' => __('Disable','spawp'), 
					),
					'is_default_type' => true,
					'priority' => 5,
				),
			);

			// footer copyright
			$elements['spawp_option[footer_copyright]'] = array(
				'setting' => array(
					'default'           => $option['footer_copyright'],
					'sanitize_callback' => 'wp_kses_post',
					'type' => 'option',
				),
				'control' => array(
					'label'    => __( 'Copyright', 'spawp' ),
					'section'  => 'footer_section',
					'type'     => 'textarea',
					'is_default_type' => true,
					'priority' => 6,
				),
			);

			// sidebar layout
			$elements['spawp_option[sidebar_layout]'] = array(
				'setting' => array(
					'default'           => $option['sidebar_layout'],
					'sanitize_callback' => 'SPAWP_Customizer_Sanitize::sanitize_select',
					'type' => 'option',
				),
				'control' => array(
					'label'    => sprintf(__( 'Sidebar Layout', 'spawp' )),
					'section'  => 'sidebar_section',
					'type'     => 'select',
					'choices' => array(
						'left-sidebar' => __('Sidebar / Content','spawp'), 
						'right-sidebar' => __('Content / Sidebar','spawp'), 
						'no-sidebar' => __('Content ( No Sidebar )','spawp'), 
						'both-sidebars' => __('Sidebar / Content / Sidebar','spawp'), 
						'both-left' => __('Sidebar / Sidebar / Content','spawp'), 
						'both-right' => __('Content / Sidebar / Sidebar','spawp'), 
					),
					'is_default_type' => true,
					'priority' => 1,
				),
			);

			// Archive sidebar layout
			$elements['spawp_option[sidebar_blog_layout]'] = array(
				'setting' => array(
					'default'           => $option['sidebar_blog_layout'],
					'sanitize_callback' => 'SPAWP_Customizer_Sanitize::sanitize_select',
					'type' => 'option',
				),
				'control' => array(
					'label'    => sprintf(__( 'Archive Sidebar Layout', 'spawp' )),
					'section'  => 'sidebar_section',
					'type'     => 'select',
					'choices' => array(
						'left-sidebar' => __('Sidebar / Content','spawp'), 
						'right-sidebar' => __('Content / Sidebar','spawp'), 
						'no-sidebar' => __('Content ( No Sidebar )','spawp'), 
						'both-sidebars' => __('Sidebar / Content / Sidebar','spawp'), 
						'both-left' => __('Sidebar / Sidebar / Content','spawp'), 
						'both-right' => __('Content / Sidebar / Sidebar','spawp'), 
					),
					'is_default_type' => true,
					'priority' => 2,
				),
			);

			// Single sidebar layout
			$elements['spawp_option[sidebar_single_layout]'] = array(
				'setting' => array(
					'default'           => $option['sidebar_single_layout'],
					'sanitize_callback' => 'SPAWP_Customizer_Sanitize::sanitize_select',
					'type' => 'option',
				),
				'control' => array(
					'label'    => sprintf(__( 'Single Post Sidebar Layout', 'spawp' )),
					'section'  => 'sidebar_section',
					'type'     => 'select',
					'choices' => array(
						'left-sidebar' => __('Sidebar / Content','spawp'), 
						'right-sidebar' => __('Content / Sidebar','spawp'), 
						'no-sidebar' => __('Content ( No Sidebar )','spawp'), 
						'both-sidebars' => __('Sidebar / Content / Sidebar','spawp'), 
						'both-left' => __('Sidebar / Sidebar / Content','spawp'), 
						'both-right' => __('Content / Sidebar / Sidebar','spawp'), 
					),
					'is_default_type' => true,
					'priority' => 3,
				),
			);

			// blog content type
			$elements['spawp_option[archive_content_type]'] = array(
				'setting' => array(
					'default'           => $option['archive_content_type'],
					'sanitize_callback' => 'SPAWP_Customizer_Sanitize::sanitize_select',
					'type' => 'option',
				),
				'control' => array(
					'label'    => sprintf(__( 'Content Type', 'spawp' )),
					'section'  => 'blog_section',
					'type'     => 'select',
					'choices' => array(
						'full' => __('Full Content','spawp'), 
						'excerpt' => __('Excerpt','spawp'), 
					),
					'is_default_type' => true,
					'priority' => 1,
				),
			);

			// primary navigation width
			$elements['spawp_option[nav_width]'] = array(
				'setting' => array(
					'default'           => $option['nav_width'],
					'sanitize_callback' => 'SPAWP_Customizer_Sanitize::sanitize_select',
					'type' => 'option',
				),
				'control' => array(
					'label'    => sprintf(__( 'Navigation Width', 'spawp' )),
					'section'  => 'primary_section',
					'type'     => 'select',
					'choices' => array(
						'container-fluid' => __('Full','spawp'), 
						'container' => __('Contained','spawp'),
					),
					'is_default_type' => true,
					'priority' => 3,
				),
			);

			// primary navigation inner width
			$elements['spawp_option[nav_inner_width]'] = array(
				'setting' => array(
					'default'           => $option['nav_inner_width'],
					'sanitize_callback' => 'SPAWP_Customizer_Sanitize::sanitize_select',
					'type' => 'option',
				),
				'control' => array(
					'label'    => sprintf(__( 'Navigation inner width', 'spawp' )),
					'section'  => 'primary_section',
					'type'     => 'select',
					'choices' => array(
						'container-fluid' => __('Full','spawp'), 
						'container' => __('Contained','spawp'),
					),
					'is_default_type' => true,
					'priority' => 4,
				),
			);

			// primary navigation alignment
			$elements['spawp_option[nav_alignment]'] = array(
				'setting' => array(
					'default'           => $option['nav_alignment'],
					'sanitize_callback' => 'SPAWP_Customizer_Sanitize::sanitize_select',
					'type' => 'option',
				),
				'control' => array(
					'label'    => sprintf(__( 'Navigation Alignment', 'spawp' )),
					'section'  => 'primary_section',
					'type'     => 'select',
					'choices' => array(
						'left' => __('Left','spawp'), 
						'center' => __('Center','spawp'),
						'right' => __('Right','spawp'),
					),
					'is_default_type' => true,
					'priority' => 5,
				),
			);

			// primary navigation dropdown
			$elements['spawp_option[nav_dropdown]'] = array(
				'setting' => array(
					'default'           => $option['nav_dropdown'],
					'sanitize_callback' => 'SPAWP_Customizer_Sanitize::sanitize_select',
					'type' => 'option',
				),
				'control' => array(
					'label'    => sprintf(__( 'Navigation Dropdown', 'spawp' )),
					'section'  => 'primary_section',
					'type'     => 'select',
					'choices' => array(
						'hover' => __('Hover','spawp'), 
						'focus' => __('Click & Hover','spawp'),
					),
					'is_default_type' => true,
					'priority' => 6,
				),
			);

			// primary navigation direction
			$elements['spawp_option[nav_direction]'] = array(
				'setting' => array(
					'default'           => $option['nav_direction'],
					'sanitize_callback' => 'SPAWP_Customizer_Sanitize::sanitize_select',
					'type' => 'option',
				),
				'control' => array(
					'label'    => sprintf(__( 'Navigation Direction', 'spawp' )),
					'section'  => 'primary_section',
					'type'     => 'select',
					'choices' => array(
						'left' => __('Left','spawp'), 
						'right' => __('Right','spawp'),
					),
					'is_default_type' => true,
					'priority' => 7,
				),
			);

			// primary navigation search icon show
			$elements['spawp_option[nav_search_show]'] = array(
				'setting' => array(
					'default'           => $option['nav_search_show'],
					'sanitize_callback' => 'SPAWP_Customizer_Sanitize::sanitize_checkbox',
					'type' => 'option',
				),
				'control' => array(
					'label'    => sprintf(__( 'Navigation search icon show', 'spawp' )),
					'section'  => 'primary_section',
					'type'     => 'toggle',
					'is_default_type' => false,
					'priority' => 8,
				),
			);

			// header setting
			$elements['spawp_option[header_setting]'] = array(
				'setting' => array(
					'default'           => $option['header_setting'],
					'sanitize_callback' => 'SPAWP_Customizer_Sanitize::sanitize_select',
					'type' => 'option',
				),
				'control' => array(
					'label'    => sprintf(__( 'Header Presets', 'spawp' )),
					'section'  => 'header_section',
					'type'     => 'select',
					'choices' => array(
						'default' => __('Default','spawp'), 
						'nav_before' => __('Navigation Before','spawp'),
						'nav_after' => __('Navigation After','spawp'),
						'nav_before_center' => __('Navigation Before - Centered','spawp'),
						'nav_after_center' => __('Navigation After - Centered','spawp'),
						'nav_left' => __('Navigation left','spawp'),
					),
					'is_default_type' => true,
					'priority' => 1,
				),
			);

			// body bg color
			$elements['spawp_option[body_bg_color]'] = array(
				'setting' => array(
					'default'           => $option['body_bg_color'],
					'sanitize_callback' => 'sanitize_hex_color',
					'type' => 'option',
				),
				'control' => array(
					'label'    => sprintf(__( 'Background Color', 'spawp' )),
					'section'  => 'body_colors',
					'type'     => 'color',
					'is_default_type' => true,
					'priority' => 1,
				),
			);

			// body text color
			$elements['spawp_option[body_text_color]'] = array(
				'setting' => array(
					'default'           => $option['body_text_color'],
					'sanitize_callback' => 'sanitize_hex_color',
					'type' => 'option',
				),
				'control' => array(
					'label'    => sprintf(__( 'Text Color', 'spawp' )),
					'section'  => 'body_colors',
					'type'     => 'color',
					'is_default_type' => true,
					'priority' => 2,
				),
			);

			// body link color
			$elements['spawp_option[body_link_color]'] = array(
				'setting' => array(
					'default'           => $option['body_link_color'],
					'sanitize_callback' => 'sanitize_hex_color',
					'type' => 'option',
				),
				'control' => array(
					'label'    => sprintf(__( 'Link Color', 'spawp' )),
					'section'  => 'body_colors',
					'type'     => 'color',
					'is_default_type' => true,
					'priority' => 3,
				),
			);

			// body link Hover color
			$elements['spawp_option[body_link_hover_color]'] = array(
				'setting' => array(
					'default'           => $option['body_link_hover_color'],
					'sanitize_callback' => 'sanitize_hex_color',
					'type' => 'option',
				),
				'control' => array(
					'label'    => sprintf(__( 'Link Color Hover', 'spawp' )),
					'section'  => 'body_colors',
					'type'     => 'color',
					'is_default_type' => true,
					'priority' => 4,
				),
			);

			return $elements;
		}
	}

	new SPAWP_Customize_Layout_Sections_Settings();

endif;

if ( ! class_exists( 'SPAWP_Customize_Frontpage_blog_Section_Common_Settings' ) ) :
	class SPAWP_Customize_Frontpage_blog_Section_Common_Settings extends SPAWP_Custom_Base_Customize_Settings {

		/**
		 * Arguments for options.
		 *
		 * @return array
		 */
		public function elements() {

			$option = spawp_theme_default_data();

			$elements = array();

			$section_names = array(
				'blog',
			);

			foreach ($section_names as $key => $name) {
				$title = ucwords($name);

				$elements['spawp_option['.$name.'_show]'] = array(
					'setting' => array(
						'default'           => $option[$name.'_show'],
						'sanitize_callback' => array( 'SPAWP_Customizer_Sanitize', 'sanitize_checkbox' ),
						'type' => 'option',
					),
					'control' => array(
						'label'    => sprintf(__( '%s Enable', 'spawp' ),$title),
						'section'  => 'spawp_'.$name.'_section',
						'type'     => 'toggle',
						'priority' => 5,
					),
				);

				if($name=='blog'){
					$elements['spawp_option['.$name.'_no_to_show]'] = array(
						'setting' => array(
							'default'           => $option[$name.'_no_to_show'],
							'sanitize_callback' => 'absint',
							'type' => 'option',
						),
						'control' => array(
							'label'    => sprintf(__( 'No. of items to show', 'spawp' )),
							'section'  => 'spawp_'.$name.'_section',
							'type'     => 'number',
							'is_default_type' => true,
							'priority' => 6,
						),
					);

					$elements['spawp_option['.$name.'_column_layout]'] = array(
						'setting' => array(
							'default'           => $option[$name.'_column_layout'],
							'sanitize_callback' => 'SPAWP_Customizer_Sanitize::sanitize_select',
							'type' => 'option',
						),
						'control' => array(
							'label'    => sprintf(__( 'Column Layout', 'spawp' )),
							'section'  => 'spawp_'.$name.'_section',
							'type'     => 'select',
							'choices'  => array(
								2 => __('2 Column','spawp'),
								3 => __('3 Column','spawp'),
								4 => __('4 Column','spawp'),
							),
							'is_default_type' => true,
							'priority' => 7,
						),
					);

					$elements['spawp_option['.$name.'_category]'] = array(
						'setting' => array(
							'default'           => $option[$name.'_category'],
							'sanitize_callback' => 'SPAWP_Customizer_Sanitize::sanitize_select',
							'type' => 'option',
						),
						'control' => array(
							'label'    => sprintf(__( 'Select Category', 'spawp' )),
							'section'  => 'spawp_'.$name.'_section',
							'type'     => 'category',
							'is_default_type' => false,
							'priority' => 8,
						),
					);

					$elements['spawp_option['.$name.'_orderby]'] = array(
						'setting' => array(
							'default'           => $option[$name.'_orderby'],
							'sanitize_callback' => 'SPAWP_Customizer_Sanitize::sanitize_select',
							'type' => 'option',
						),
						'control' => array(
							'label'    => sprintf(__( 'Order By', 'spawp' )),
							'section'  => 'spawp_'.$name.'_section',
							'type'     => 'select',
							'choices'  => array(
								'default' => __('Default', 'spawp'),
								'id' => __('ID', 'spawp'),
								'author' => __('Author', 'spawp'),
								'title' => __('Title', 'spawp'),
								'date' => __('Date', 'spawp'),
								'comment_count' => __('Comment Count', 'spawp'),
								'menu_order' => __('Order by Page Order', 'spawp'),
								'rand' => __('Random order', 'spawp'),
							),
							'is_default_type' => true,
							'priority' => 9,
						),
					);

					$elements['spawp_option['.$name.'_order]'] = array(
						'setting' => array(
							'default'           => $option[$name.'_order'],
							'sanitize_callback' => 'SPAWP_Customizer_Sanitize::sanitize_select',
							'type' => 'option',
						),
						'control' => array(
							'label'    => sprintf(__( 'Order', 'spawp' )),
							'section'  => 'spawp_'.$name.'_section',
							'type'     => 'select',
							'choices'  => array(
								'desc' => __('Descending', 'spawp'),
								'asc' => __('Ascending', 'spawp'),
							),
							'is_default_type' => true,
							'priority' => 10,
						),
					);
				}

				if($name!='callout'){
					$elements['spawp_option['.$name.'_subtitle]'] = array(
						'setting' => array(
							'default'           => $option[$name.'_subtitle'],
							'sanitize_callback' => 'sanitize_text_field',
							'type' => 'option',
						),
						'control' => array(
							'label'    => sprintf(__( 'Subtitle', 'spawp' )),
							'section'  => 'spawp_'.$name.'_section',
							'type'     => 'text',
							'is_default_type' => true,
							'priority' => 10,
						),
					);
				}

				$elements['spawp_option['.$name.'_title]'] = array(
					'setting' => array(
						'default'           => $option[$name.'_title'],
						'sanitize_callback' => 'wp_kses_post',
						'type' => 'option',
					),
					'control' => array(
						'label'    => sprintf(__( 'Title', 'spawp' )),
						'section'  => 'spawp_'.$name.'_section',
						'type'     => 'text',
						'is_default_type' => true,
						'priority' => 15,
					),
				);

				$elements['spawp_option['.$name.'_desc]'] = array(
					'setting' => array(
						'default'           => $option[$name.'_desc'],
						'sanitize_callback' => 'wp_kses_post',
						'type' => 'option',
					),
					'control' => array(
						'label'    => sprintf(__( 'Description', 'spawp' )),
						'section'  => 'spawp_'.$name.'_section',
						'type'     => 'textarea',
						'is_default_type' => true,
						'priority' => 20,
					),
				);

				if($name!='callout'){
					$elements['spawp_option['.$name.'_divider_show]'] = array(
						'setting' => array(
							'default'           => $option[$name.'_divider_show'],
							'sanitize_callback' => array( 'SPAWP_Customizer_Sanitize', 'sanitize_checkbox' ),
							'type' => 'option',
						),
						'control' => array(
							'label'    => sprintf(__( 'Divider Show', 'spawp' ),$title),
							'section'  => 'spawp_'.$name.'_section',
							'type'     => 'checkbox',
							'is_default_type' => true,
							'priority' => 25,
						),
					);

					$elements['spawp_option['.$name.'_divider_type]'] = array(
						'setting' => array(
							'default'           => $option[$name.'_divider_type'],
							'sanitize_callback' => array( 'SPAWP_Customizer_Sanitize', 'sanitize_select' ),
							'type' => 'option',
						),
						'control' => array(
							'label'    => sprintf(__( 'Divider Type', 'spawp' )),
							'section'  => 'spawp_'.$name.'_section',
							'type'     => 'select',
							'is_default_type' => true,
							'choices' => array(
								''         => 'Line',
								'div-arrow-down'=>'Arrow Down',
								'div-tab-down'=>'Tab Down',
								'div-stopper'=>'Stopper',
								'div-dot'=>'Dot',
							),
							'priority' => 30,
						),
					);

					$elements['spawp_option['.$name.'_divider_width]'] = array(
						'setting' => array(
							'default'           => $option[$name.'_divider_width'],
							'sanitize_callback' => array( 'SPAWP_Customizer_Sanitize', 'sanitize_select' ),
							'type' => 'option',
						),
						'control' => array(
							'label'    => sprintf(__( 'Divider Width', 'spawp' )),
							'section'  => 'spawp_'.$name.'_section',
							'type'     => 'select',
							'is_default_type' => true,
							'choices' => array(
								'w-10'         => 'w-10',
								'w-20'         => 'w-20',
								'w-30'         => 'w-30',
								'w-40'         => 'w-40',
								'w-50'         => 'w-50',
								'w-60'         => 'w-60',
								'w-70'         => 'w-70',
								'w-80'         => 'w-80',
								'w-90'         => 'w-90',
								'w-100'        => 'w-100',
							),
							'priority' => 31,
						),
					);
				}

			if( class_exists('Spawp_Premium_Theme_Setup') ){

				$elements['spawp_option['.$name.'_subtitle_color]'] = array(
					'setting' => array(
						'default'           => $option[$name.'_subtitle_color'],
						'sanitize_callback' => 'sanitize_hex_color',
						'type' => 'option',
					),
					'control' => array(
						'label'    => sprintf(__( 'Subtitle Color', 'spawp' )),
						'section'  => 'spawp_'.$name.'_section',
						'type'     => 'color',
						'is_default_type' => true,
						'priority' => 34,
					),
				);

				$elements['spawp_option['.$name.'_title_color]'] = array(
					'setting' => array(
						'default'           => $option[$name.'_title_color'],
						'sanitize_callback' => 'sanitize_hex_color',
						'type' => 'option',
					),
					'control' => array(
						'label'    => sprintf(__( 'Title Color', 'spawp' )),
						'section'  => 'spawp_'.$name.'_section',
						'type'     => 'color',
						'is_default_type' => true,
						'priority' => 35,
					),
				);

				$elements['spawp_option['.$name.'_desc_color]'] = array(
					'setting' => array(
						'default'           => $option[$name.'_desc_color'],
						'sanitize_callback' => 'sanitize_hex_color',
						'type' => 'option',
					),
					'control' => array(
						'label'    => sprintf(__( 'Description Color', 'spawp' )),
						'section'  => 'spawp_'.$name.'_section',
						'type'     => 'color',
						'is_default_type' => true,
						'priority' => 40,
					),
				);

				$elements['spawp_option['.$name.'_overlay_show]'] = array(
					'setting' => array(
						'default'           => $option[$name.'_overlay_show'],
						'sanitize_callback' => array( 'SPAWP_Customizer_Sanitize', 'sanitize_checkbox' ),
						'type' => 'option',
					),
					'control' => array(
						'label'    => sprintf(__( 'Overlay Color Show', 'spawp' )),
						'section'  => 'spawp_'.$name.'_section',
						'type'     => 'toggle',
						'priority' => 71,
					),
				);

				$elements['spawp_option['.$name.'_overlay_color]'] = array(
					'setting' => array(
						'default'           => $option[$name.'_overlay_color'],
						'sanitize_callback' => array( 'SPAWP_Customizer_Sanitize', 'sanitize_alpha_color'),
						'type' => 'option',
					),
					'control' => array(
						'label'    => sprintf(__( 'Overlay Color', 'spawp' )),
						'section'  => 'spawp_'.$name.'_section',
						'type'     => 'alpha_color',
						'is_default_type' => false,
						'priority' => 71,
					),
				);

			}

				if($name=='callout'){
					$elements['spawp_option['.$name.'_button_text]'] = array(
						'setting' => array(
							'default'           => $option[$name.'_button_text'],
							'sanitize_callback' => 'sanitize_text_field',
							'type' => 'option',
						),
						'control' => array(
							'label'    => sprintf(__( 'Button Text', 'spawp' )),
							'section'  => 'spawp_'.$name.'_section',
							'type'     => 'text',
							'is_default_type' => true,
							'priority' => 41,
						),
					);
					$elements['spawp_option['.$name.'_button_url]'] = array(
						'setting' => array(
							'default'           => $option[$name.'_button_url'],
							'sanitize_callback' => 'sanitize_text_field',
							'type' => 'option',
						),
						'control' => array(
							'label'    => sprintf(__( 'Button URL', 'spawp' )),
							'section'  => 'spawp_'.$name.'_section',
							'type'     => 'text',
							'is_default_type' => true,
							'priority' => 42,
						),
					);
				}

				$elements['spawp_option['.$name.'_container_width]'] = array(
					'setting' => array(
						'default'           => $option[$name.'_container_width'],
						'sanitize_callback' => array( 'SPAWP_Customizer_Sanitize', 'sanitize_select' ),
						'type' => 'option',
					),
					'control' => array(
						'label'    => sprintf(__( 'Container Width', 'spawp' )),
						'section'  => 'spawp_'.$name.'_section',
						'type'     => 'select',
						'is_default_type' => true,
						'choices' => array(
							'container'=>'Container',
							'container-fluid'=>'Full',
						),
						'priority' => 45,
					),
				);

			if( class_exists('Spawp_Premium_Theme_Setup') ){

				$elements['spawp_option['.$name.'_bg_color]'] = array(
					'setting' => array(
						'default'           => $option[$name.'_bg_color'],
						'sanitize_callback' => 'sanitize_hex_color',
						'type' => 'option',
					),
					'control' => array(
						'label'    => sprintf(__( 'Background Color', 'spawp' )),
						'section'  => 'spawp_'.$name.'_section',
						'type'     => 'color',
						'is_default_type' => true,
						'priority' => 60,
					),
				);

				$elements['spawp_option['.$name.'_item_bg_color]'] = array(
					'setting' => array(
						'default'           => $option[$name.'_item_bg_color'],
						'sanitize_callback' => 'sanitize_hex_color',
						'type' => 'option',
					),
					'control' => array(
						'label'    => sprintf(__( 'Item Background Color', 'spawp' )),
						'section'  => 'spawp_'.$name.'_section',
						'type'     => 'color',
						'is_default_type' => true,
						'priority' => 75,
					),
				);

				$elements['spawp_option['.$name.'_item_title_color]'] = array(
					'setting' => array(
						'default'           => $option[$name.'_item_title_color'],
						'sanitize_callback' => 'sanitize_hex_color',
						'type' => 'option',
					),
					'control' => array(
						'label'    => sprintf(__( 'Item Title Color', 'spawp' )),
						'section'  => 'spawp_'.$name.'_section',
						'type'     => 'color',
						'is_default_type' => true,
						'priority' => 76,
					),
				);

				$elements['spawp_option['.$name.'_item_text_color]'] = array(
					'setting' => array(
						'default'           => $option[$name.'_item_text_color'],
						'sanitize_callback' => 'sanitize_hex_color',
						'type' => 'option',
					),
					'control' => array(
						'label'    => sprintf(__( 'Item Text Color', 'spawp' )),
						'section'  => 'spawp_'.$name.'_section',
						'type'     => 'color',
						'is_default_type' => true,
						'priority' => 77,
					),
				);

				}
			}

			return $elements;
		}
	}
	new SPAWP_Customize_Frontpage_blog_Section_Common_Settings();
endif;


function spawp_for_plus( $wp_customize ){

		if( ! class_exists('Spawp_Premium_Theme_Setup') ){
			$wp_customize->add_section( new Spawp_Section_plus( $wp_customize,
				'spawp-plus-section' , 
					array(
					'title'    => __( 'Go Pro', 'spawp' ),
					'plus_text' => __( 'Click Here', 'spawp' ),
					'plus_url'  => esc_url('https://www.britetechs.com/spawp-premium-wordpress-theme/','spawp')
				) 
			) );
		}

		if( ! class_exists('Spawp_Premium_Theme_Setup') ){
			$section_title = sprintf(__('Upgrade to Pro','spawp'));
		}else{
			$section_title = sprintf(__('Get Supports & Love it','spawp'));
		}

		$wp_customize->add_section(
	        'upgrade_with_pro_section',
	        array(
	            'title' 		=> $section_title,
			)
	    );

	    if( class_exists('Spawp_Premium_Theme_Setup') ){
		    $wp_customize->add_setting(
				'upgrade_with_pro_buttons',
				array(
				   'capability'     => 'edit_theme_options',
					'sanitize_callback' => 'sanitize_text_field',
				)	
			);
			
			$wp_customize->add_control( new Spawp_Button_Customize_Control( $wp_customize, 'upgrade_with_pro_buttons', array(
				'section' => 'upgrade_with_pro_section',
				'setting' => 'upgrade_with_pro_buttons',
		    ) ) );
		}
}
add_action( 'customize_register', 'spawp_for_plus' );