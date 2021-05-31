/**
 * File customizer.js
 */

( function ( $ ) {

	// site title
	wp.customize( 'blogname', function ( value ) {
		value.bind( function ( newval ) {
			$( '.site-title' ).text( newval );
		} );
	} );

	// site description
	wp.customize( 'blogdescription', function ( value ) {
		value.bind( function ( newval ) {
			$( '.site-description' ).text( newval );
		} );
	} );

	// container width
	wp.customize( 'spawp_option[container_width]', function ( value ) {
		value.bind( function ( newval ) {
			if ( jQuery( 'style#container_width' ).length ) {
				jQuery( 'style#container_width' ).html( 'body .container{max-width:' + newval + 'px;}' );
			} else {
				jQuery( 'head' ).append( '<style id="container_width">body .container{max-width:' + newval + 'px;}</style>' );
				setTimeout(function() {
					jQuery( 'style#container_width' ).not( ':last' ).remove();
				}, 100);
			}
			jQuery('body').trigger('spawp_spacing_updated');
		} );
	} );

	// All sections
	var sections = {
		"service":"service",
		"feature":"feature",
		"testimonial":"testimonial",
		"team":"team",
	};

	$.each( sections, function( key, section ) {

	  	wp.customize( 'spawp_option['+section+'_subtitle]' , function ( value ) {
			value.bind( function ( newval ) {
				$( '.home_section.'+section+' .section_subtitle' ).text( newval );
			} );
		} );

		wp.customize( 'spawp_option['+section+'_title]' , function ( value ) {
			value.bind( function ( newval ) {
				$( '.home_section.'+section+' .section_title' ).text( newval );
			} );
		} );

		wp.customize( 'spawp_option['+section+'_desc]' , function ( value ) {
			value.bind( function ( newval ) {
				$( '.home_section.'+section+' .section_description' ).text( newval );
			} );
		} );

	});

	// blog section
	wp.customize( 'spawp_option[blog_subtitle]' , function ( value ) {
		value.bind( function ( newval ) {
			$( '.home_section.news .section_subtitle' ).text( newval );
		} );
	} );

	wp.customize( 'spawp_option[blog_title]' , function ( value ) {
		value.bind( function ( newval ) {
			$( '.home_section.news .section_title' ).text( newval );
		} );
	} );

	wp.customize( 'spawp_option[blog_desc]' , function ( value ) {
		value.bind( function ( newval ) {
			$( '.home_section.news .section_description' ).text( newval );
		} );
	} );

	
} )( jQuery );