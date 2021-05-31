jQuery(document).ready(function ($) {
	"use strict";

	$('.theme_mobile_menu nav').meanmenu({
		meanScreenWidth:spawp_settings.nav_mobilebtn_breakpoint,
        meanMenuContainer: ".theme_mobile_container",
        meanMenuClose: "X",
        meanMenuOpen: "<div class='meanToggleIcon'><span></span><span></span><span></span></div> "+spawp_settings.nav_mobilebtn_label,
        meanRevealPosition: "center",
        meanExpand: "+",
		meanContract: "-",
		meanRevealClass: ".theme_mobile_container .meanmenu-reveal",
    });

	// Navigation Accessibility
    $(document).on('blur','.mean-last a', function(){
    	$('#site-navigation .meanclose').focus();
    });

    $(document).on('blur','.mean-expand',function(){
    	$(this).parent('li').find('.sub-menu a:first').focus();
    });

    $('.mobile_secondary_menu nav').meanmenu({
		meanScreenWidth:spawp_settings.nav_mobilebtn_breakpoint,
        meanMenuContainer: ".mobile_secondary_container",
        meanMenuClose: "X",
        meanMenuOpen: "<div class='meanToggleIcon'><span></span><span></span><span></span></div> "+spawp_settings.secondary_mobilebtn_label,
        meanRevealPosition: "center",
        meanExpand: "+",
		meanContract: "-",
		meanRevealClass: ".mobile_secondary_container .meanmenu-reveal",
    });
    
	$(window).scroll(function () {
		if ($(this).scrollTop() > 100) {
			$('.backToTop').fadeIn();
		} else {
			$('.backToTop').fadeOut();
		}
	});

	$('.backToTop').click(function () {
		$("html, body").animate({
			scrollTop: 0
		}, 600);
		return false;
	});

	/*OWL Carousel*/
	function SpaWPOwlCaousel($elem) {
		$elem.owlCarousel({
			animateIn: $elem.data( "animatein" ),
			animateOut: $elem.data( "animateout" ),
			items:$elem.data( "collg" ),
			margin:$elem.data( "itemspace" ),
			loop:$elem.data( "loop" ),
			autoplay: $elem.data( "autoplay" ),
			autoplayTimeout: 5000,
			smartSpeed: $elem.data( "smartspeed" ),
			autoplayTimeout: $elem.data( "scrollspeed" ),
			dots:$elem.data( "dots" ),
			nav:$elem.data( "nav" ),
			navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
			mouseDrag: $elem.data( "mousedrag" ),
			responsive:{
				0:{
					items:$elem.data( "colxs" ),
				},
				768:{
					items:$elem.data( "colsm" ),
				},
				992:{
					items:$elem.data( "colmd" ),
				},
				1200:{
					items:$elem.data( "collg" ),
				}
			},
		});
	}
	/* Active carousel */
	if ($('.owl-carousel').length) {
		$('.owl-carousel').each(function() {
			new SpaWPOwlCaousel($( this ));
		});
	}

	var owl = $('.banner-slider');
    owl.owlCarousel();
    owl.on('translate.owl.carousel', function(event) {
        $('.slide .slide_subtitle').removeClass('animated').hide();
        $('.slide .slide_title').removeClass('animated').hide();
        $('.slide .slide_decription').removeClass('animated').hide();
        $('.slide .slide_btn').removeClass('animated').hide();
    });
    owl.on('translated.owl.carousel', function(event) {
        $('.slide .slide_subtitle').addClass('animated fadeInUp').show();
        $('.slide .slide_title').addClass('animated fadeInUp').show();
        $('.slide .slide_decription').addClass('animated fadeInDown').show();
        $('.slide .slide_btn').addClass('animated fadeInUp').show();
    });

	/* Smooth scroll */
    $(document).on('click', '.primary_menu a', function (e) {
        if ($(e.target).is('a[href*="#"]:not([href="#"]')) {
            if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '')
                || location.hostname == this.hostname) {
                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                if (target.length) {
                    $('html,body').animate({
                        scrollTop: target.offset().top
                    }, 1000);
                    return false;
                }
            }
        }
    });

	// search nav icon
	$(document).on( 'click', '.menu-search-icon a', function() {
		if($(this).parent('li').hasClass('close-search')){
			$('.primary_menu').find('form').removeClass('search-nav-active');
			$(this).parent('li').removeClass('close-search');
			$(this).html('<i class="fa fa-search"></i>');
		}else{
			$('.primary_menu').find('form').addClass('search-nav-active');
			$(this).parent('li').addClass('close-search');
			$(this).html('<i class="fa fa-close"></i>');
		}
		return false;
	});

	// add submenu dropdown Toggle button.
    if( $( '.canvas-menu li.menu-item-has-children ul' ).length ){
    	$( '.canvas-menu li.menu-item-has-children ul' ).css('display','none');
        $( '.canvas-menu li.menu-item-has-children > a' ).append( '<div class="dropdown-btn"><span class="fa fa-angle-down"></span></div>' );

        // Dropdown submenue mobile.
        // Click on btn element.
        $( '.canvas-menu li.menu-item-has-children > .dropdown-btn' ).on( 'click', function() {
            $(this).prev( 'ul' ).slideToggle( 500 );
            if( $(this).parent('li').find( 'span' ).hasClass( 'fa-angle-down' ) ){
                $(this).parent('li').find( 'span' ).removeClass( 'fa-angle-down' ).addClass( 'fa-angle-up' );
            }else{
                $(this).parent('li').find( 'span' ).removeClass( 'fa-angle-up' ).addClass( 'fa-angle-down' );
            }
        });

        // Dropdown submenue mobile.
        // Click on a element.
        $( '.canvas-menu li.menu-item-has-children > a' ).on( 'click', function(e) {
            e.preventDefault();
            $(this).next( 'ul' ).slideToggle( 500 );
            var dropdownbtn = $(this).find( '.dropdown-btn' ).find( 'span' );
            if( dropdownbtn.hasClass( 'fa-angle-down' ) ){
                dropdownbtn.removeClass( 'fa-angle-down' ).addClass( 'fa-angle-up' );
            }else{
                dropdownbtn.removeClass( 'fa-angle-up' ).addClass( 'fa-angle-down' );
            }
        });
    }

    $(window).load(function() {
		$(".loader").delay(2000).fadeOut("slow");
		$("#overlayer").delay(2000).fadeOut("slow");
	});
});

new WOW().init();