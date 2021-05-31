function spawp_homepage_sections_scroll( section_id ){
    var scroll_section_id = "slider";

    var $contents = jQuery('#customize-preview iframe').contents();

    switch ( section_id ) {
        case 'accordion-section-spawp_slider_section':
        scroll_section_id = "slider";
        break;

        case 'accordion-section-spawp_service_section':
        scroll_section_id = "service";
        break;

        case 'accordion-section-spawp_feature_section':
        scroll_section_id = "feature";
        break;

        case 'accordion-section-spawp_counter_section':
        scroll_section_id = "funfact";
        break;

        case 'accordion-section-spawp_portfolio_section':
        scroll_section_id = "prortfolio";
        break;

        case 'accordion-section-spawp_callout_section':
        scroll_section_id = "callout";
        break;

        case 'accordion-section-spawp_pricing_section':
        scroll_section_id = "pricing";
        break;

        case 'accordion-section-spawp_testimonial_section':
        scroll_section_id = "testimonial";
        break;

        case 'accordion-section-spawp_team_section':
        scroll_section_id = "team";
        break;
		
		case 'accordion-section-spawp_blog_section':
        scroll_section_id = "news";
        break;
		
		case 'accordion-section-spawp_client_section':
        scroll_section_id = "client";
        break;
    }

    if( $contents.find('#'+scroll_section_id).length > 0 ){
        $contents.find("html, body").animate({
        scrollTop: $contents.find( "#" + scroll_section_id ).offset().top
        }, 1000);
    }
}

jQuery('body').on('click', '#sub-accordion-panel-frontpage_panel .control-subsection .accordion-section-title', function(event) {
        var section_id = jQuery(this).parent('.control-subsection').attr('id');
        spawp_homepage_sections_scroll( section_id );
});