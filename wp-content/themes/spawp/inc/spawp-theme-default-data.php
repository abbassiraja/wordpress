<?php
if(!function_exists('spawp_theme_default_data')){
	function spawp_theme_default_data(){
		$data = array(
                  'preloader' => true,
                  'layout' => 'wide', // wide or boxed
                  'primary_color' => '#f78fa6',
                  'container_width' => 1200,
                  'content_layout_setting' => 'separate-containers', // one-container
                  'footer_copyright' => '',
			'topbar_show' => true,
                  'topbar_width' => 'container-fluid', // container-fluid
                  'topbar_inner_width' => 'container',
                  'topbar_alignment' => 'left',
                  'topbar_office_time' => '',
                  'topbar_email' => '',
                  'topbar_phone' => '',
                  'topbar_icons' => '',
                  'tb_bg_color' => '#f78fa6',
                  'tb_text_color' => '#fff',
                  'tb_link_color' => '#fff',
                  'tb_link_hover_color' => '#272727',
                  'header_setting' => 'default',
                  'nav_mobilebtn_breakpoint' => 991,
                  'nav_mobilebtn_label' => __('Menu','spawp'),
                  'nav_width' => 'container-fluid',
                  'nav_inner_width' => 'container',
                  'nav_alignment' => 'left',
                  'nav_dropdown' => 'focus', // hover, focus-arrow
                  'nav_direction' => 'right', // left
                  'nav_search_show' => false,
                  'p_nav_bg_color' => '',
                  'p_nav_text_color' => '',
                  'p_nav_bg_hover_color' => '',
                  'p_nav_text_hover_color' => '',
                  'p_nav_bg_current_color' => '',
                  'p_nav_text_current_color' => '',
                  'secondary_mobilebtn_label' => __('Menu','spawp'),
                  'secondary_nav_position' => false, // below, above
                  'sticky_nav' => false,
                  'footer_width' => 'container-fluid',
                  'footer_inner_width' => 'container',
                  'footer_widget_setting' => 4,
                  'footer_back_to_top' => 'enable',
                  'footer_bar_alignment' => 'center',
                  'archive_excerpt_length' => 20,
                  'archive_readmore_label' => __('Read More','spawp'),
                  'archive_readmore_button' => true,
                  'archive_date_show' => true,
                  'archive_author_show' => true,
                  'archive_categories_show' => true,
                  'archive_tags_show' => true,
                  'archive_comment_count_show' => true,
                  'archive_feature_image_show' => true,
                  'archive_feature_image_position' => 'above', // below
                  'archive_feature_image_alignment' => 'center', // left, right
                  'archive_feature_image_title' => '',
                  'single_date_show' => true,
                  'single_author_show' => true,
                  'single_categories_show' => true,
                  'single_tags_show' => true,
                  'single_navigation_show' => true,
                  'single_feature_image_show' => true,
                  'single_feature_image_position' => 'above', // below, above-content-area
                  'single_feature_image_alignment' => 'center', // left, right
                  'single_feature_image_title' => '',
                  'sidebar_layout' => 'right-sidebar',
                  'sidebar_blog_layout' => 'right-sidebar',
                  'sidebar_single_layout' => 'right-sidebar',
                  'archive_content_type' => 'excerpt',
                  'body_bg_color' => '#ffffff',
                  'body_text_color' => '',
                  'body_link_color' => '',
                  'body_link_hover_color' => '',
                  'customizer_notify_show' => '',
                  'customizer_notify_show_recommended_plugins' => '',
			);

            $section_names = array('blog');

            foreach ($section_names as $key => $name) {
                 $data[$name.'_show'] = true;
                        $data[$name.'_subtitle'] = '';
                        $data[$name.'_subtitle_color'] = '';
                        $data[$name.'_title'] = '';
                        $data[$name.'_title_color'] = '';
                        $data[$name.'_desc'] = '';
                        $data[$name.'_desc_color'] = '';
                        $data[$name.'_bg_color'] = '';
                        $data[$name.'_bg_image'] = '';
                        $data[$name.'_container_width'] = 'container';
                        $data[$name.'_divider_show'] = true;
                        $data[$name.'_divider_type'] = 'div-dot';
                        $data[$name.'_divider_width'] = 'w-10';
                        $data[$name.'_item_bg_color'] = '';
                        $data[$name.'_item_title_color'] = '';
                        $data[$name.'_item_text_color'] = '';
                        $data[$name.'_overlay_show'] = true;
                        $data[$name.'_overlay_color'] = '';

                  if($name=='blog'){
                        $data[$name.'_no_to_show'] = 3;
                        $data[$name.'_column_layout'] = 4;
                        $data[$name.'_category'] = '';
                        $data[$name.'_orderby'] = '';
                        $data[$name.'_order'] = '';
                  }
            }

		$data = apply_filters( 'spawp_theme_default_data', $data);
		return $data;
	}
}