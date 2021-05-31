<?php
function arimolite_custom_css()
{	
    $custom_css = "";
    if (get_theme_mod( 'arimolite_body_color' ) ) {
        $body_color = esc_attr(get_theme_mod('arimolite_body_color'));
        $custom_css .= "
            body{
                color:{$body_color};
            }
        ";
    }
    if ( get_theme_mod('arimolite_accent_color') )
    {
        $accent_color = esc_attr(get_theme_mod('arimolite_accent_color'));
        $custom_css .= "
        	a,blockquote:before,blockquote cite,.social-network a:hover,
        	.screen-reader-text:focus,
			.arimolite-main-menu .sub-menu li a:hover,
			.arimolite-main-menu .sub-menu li.current_page_item > a,
			.arimolite-main-menu .children li a:hover,
			.arimolite-main-menu .children li.current_page_item > a,
			.post-title a:hover,.post-tags a:hover, .post-cats a:hover,
			.post-tags i, .post-cats i,
			.widget_recent_entries li a:hover, .widget_archive li a:hover,.widget_nav_menu li a:hover,
			.widget_categories li a:hover, .widget_meta li a:hover, .widget_pages li a:hover,
			.widget_recent_comments li a:hover{
				color: {$accent_color};
			}
			.arimolite-button, button, .button, input[type='submit'],
			.chosen-container .chosen-results li.highlighted,
			blockquote cite:after,
			ul.arimolite-main-menu > li > a:hover,
			div.arimolite-main-menu > ul > li > a:hover,
			ul.arimolite-main-menu > li.current_page_item > a,
			div.arimolite-main-menu > ul > li.current_page_item > a,
			.post-header .date-post,
			.arimolite-primary .post.format-audio .arimolite-post-audio .mejs-container ,
			.pagination .page-numbers:hover,
			.pagination .page-numbers.current,
			.tagcloud a:hover{
				background-color: {$accent_color};
			}
			.social-network a:hover,
			.arimolite-main-menu .sub-menu,.arimolite-main-menu .children,
			.pagination .page-numbers:hover,
			.pagination .page-numbers.current,
			.tagcloud a:hover{,
				border-color: {$accent_color};
			}
			@media (max-width: 991.98px){
				ul.arimolite-main-menu > li > a:hover, div.arimolite-main-menu > ul > li > a:hover, 
				ul.arimolite-main-menu > li.current_page_item > a, div.arimolite-main-menu > ul > li.current_page_item > a{
					color: {$accent_color};
				}
			}
        ";
        wp_add_inline_style( 'arimolite-theme-style', $custom_css );
    }
}
add_action( 'wp_enqueue_scripts', 'arimolite_custom_css', 15 );
