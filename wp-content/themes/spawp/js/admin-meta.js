jQuery(document).ready(function($) {
	$( '.spawp-meta-box-menu li a' ).on( 'click', function( event ) {
		event.preventDefault();
		$( this ).parent().addClass( 'current' );
		$( this ).parent().siblings().removeClass( 'current' );
		var tab = $( this ).attr( 'data-target' );

		// Page header module still using href.
		if ( ! tab ) {
			tab = $( this ).attr( 'href' );
		}

		$( '.spawp-meta-box-content' ).children( 'div' ).not( tab ).css( 'display', 'none' );
		$( tab ).fadeIn( 100 );
	});
});