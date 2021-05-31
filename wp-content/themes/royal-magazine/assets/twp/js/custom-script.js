window.addEventListener("load", function(){
        
    jQuery(document).ready(function($){
        "use scrict";

        $("body").addClass("page-loaded");

    });

});

(function (e) {
    "use strict";
    var n = window.TWP_JS || {};
    n.stickyMenu = function () {
        if (e(window).scrollTop() > 350) {
            e("#masthead").addClass("nav-affix");
        } else {
            e("#masthead").removeClass("nav-affix");
        }
    };
    n.mobileMenu = {
        init: function () {
            this.toggleMenu();
            this.menuMobile();
            this.menuArrow();
        },
        toggleMenu: function () {
            e('#masthead').on('click', '.toggle-menu', function (event) {
                var ethis = e('.main-navigation .menu .menu-mobile');
                if (ethis.css('display') == 'block') {
                    ethis.slideUp('300');
                } else {
                    ethis.slideDown('300');
                }
                e('.ham').toggleClass('exit');
            });
            e('.toggle-menu').click(function(){
               
                e('body').toggleClass('active-primary-menu');

            });
            e('#masthead .main-navigation ').on('click', '.menu-mobile a i', function (event) {
                event.preventDefault();

                var ethis = e(this),
                    eparent = ethis.closest('li'),
                    esub_menu = eparent.find('> .sub-menu');
                if (esub_menu.css('display') == 'none') {
                    esub_menu.slideDown('300');
                    ethis.addClass('active');
                } else {
                    esub_menu.slideUp('300');
                    ethis.removeClass('active');
                }
                return false;
            });
        },
        menuMobile: function () {
            if (e('.main-navigation .menu > ul').length) {
                var ethis = e('.main-navigation .menu > ul'),
                    eparent = ethis.closest('.main-navigation'),
                    pointbreak = eparent.data('epointbreak'),
                    window_width = window.innerWidth;
                if (typeof pointbreak == 'undefined') {
                    pointbreak = 991;
                }
                if (pointbreak >= window_width) {
                    ethis.addClass('menu-mobile').removeClass('menu-desktop');
                    e('.main-navigation .toggle-menu').css('display', 'block');
                } else {
                    ethis.addClass('menu-desktop').removeClass('menu-mobile').css('display', '');
                    e('.main-navigation .toggle-menu').css('display', '');
                }
            }

            e('.skip-link-menu-start').focus(function(){
                e('.skip-link-menu-end-skip').focus();
            });

            e('.skip-link-menu-end').focus(function(){
                e('.toggle-menu').focus();
            });

            // Action On Esc Button
            e(document).keyup(function(j) {
                if (j.key === "Escape") { // escape key maps to keycode `27`

                    if ( e( 'body' ).hasClass( 'active-primary-menu' ) ) {
                        e('body').toggleClass('active-primary-menu');
                        var ethis = e('.main-navigation .menu .menu-mobile');
                        if (ethis.css('display') == 'block') {
                            ethis.slideUp('300');
                        } else {
                            ethis.slideDown('300');
                        }
                        e('.ham').toggleClass('exit');
                    }

                }
            });

        },
        menuArrow: function () {
            if (e('#masthead .main-navigation div.menu > ul').length) {
                e('#masthead .main-navigation div.menu > ul .sub-menu').parent('li').find('> a').append('<i class="ion-ios-arrow-down">');
            }
        }
    };
    n.TwpReveal = function () {

        e('.icon-search').on('click', function (event) {
            e('body').toggleClass('reveal-search');
            e('html').attr('style','overflow-y: scroll; position: fixed; width: 100%; left: 0px; top: 0px;');
            setTimeout(function(){ 

                e('a.close-popup').focus();

             }, 300);
            
        });
        e('.close-popup').on('click', function (event) {
            e('body').removeClass('reveal-search');
            e('html').attr('style','');
            setTimeout(function(){

                e('.icon-search').focus();

             }, 300);

        });

        

        e('.skip-link-search-start').focus(function(){
            e('.close-popup').focus();
        });

        e('.skip-link-search-end').focus(function(){
            e('.popup-search .search-field').focus();
        });

        // Action On Esc Button
        e(document).keyup(function(j) {
            if (j.key === "Escape") { // escape key maps to keycode `27`

                if ( e( 'body' ).hasClass( 'reveal-search' ) ) {
                    e('body').removeClass('reveal-search');
                    e('html').attr('style','');
                    setTimeout(function(){

                        e('.icon-search').focus();

                     }, 300);
                }

            }
        });

        e(".mainbanner-jumbotron a").keyup(function () {
            e('a.close-popup').focus();
        });

        e('a.trending-news').click(function(){
            e('body').toggleClass('active-populat-post');
            e('a.trending-news').focus();
        });

        e('.skip-link-popular-post-start').focus(function(){
            e('.skip-link-popular-post-end-skip').focus();
        });
        e('.skip-link-popular-post-end').focus(function(){
            e('a.trending-news').focus();
        });
    };
    n.DataBackground = function () {
        var pageSection = e(".data-bg");
        pageSection.each(function (indx) {
            if (e(this).attr("data-background")) {
                e(this).css("background-image", "url(" + e(this).data("background") + ")");
            }
        });
        e('.bg-image').each(function () {
            var src = e(this).children('img').attr('src');
            if( src ){
                e(this).css('background-image', 'url(' + src + ')').children('img').hide();
            }
        });
    };
    n.InnerBanner = function () {
        var pageSection = e(".data-bg");
        pageSection.each(function (indx) {
            if (e(this).attr("data-background")) {
                e(this).css("background-image", "url(" + e(this).data("background") + ")");
            }
        });
    };
    /* Slick Slider */
    n.SlickCarousel = function () {
        e(".mainbanner-jumbotron").slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            fade: true,
            autoplay: true,
            autoplaySpeed: 8000,
            infinite: true,
            dots: false,
            nextArrow: '<i class="twp-icon slide-icon slide-next ion-ios-arrow-right alt-bgcolor"></i>',
            prevArrow: '<i class="twp-icon slide-icon slide-prev ion-ios-arrow-left alt-bgcolor"></i>',
            asNavFor: '.slider-nav'
        });
        e('.slider-nav').slick({
            slidesToShow: 4,
            slidesToScroll: 1,
            asNavFor: '.mainbanner-jumbotron',
            dots: false,
            arrows: false,
            focusOnSelect: true,
            responsive: [
                {
                    breakpoint: 991,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                        dots: true
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2,
                        dots: true
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        dots: true
                    }
                }
            ]
        });
        e(".gallery-columns-1, ul.wp-block-gallery.columns-1, .wp-block-gallery.columns-1 .blocks-gallery-grid").each(function () {
            e(this).slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                fade: true,
                autoplay: true,
                autoplaySpeed: 8000,
                infinite: true,
                dots: false,
                nextArrow: '<i class="twp-icon slide-icon slide-next ion-ios-arrow-right alt-bgcolor"></i>',
                prevArrow: '<i class="twp-icon slide-icon slide-prev ion-ios-arrow-left alt-bgcolor"></i>',
            });
        });
    };
    n.TwpMarquee = function () {
        e('.marquee').marquee({
            direction: 'left',
            speed: 1500,
            pauseOnHover: true
        });
    };
    n.MagnificPopup = function () {
        e('.gallery, .wp-block-gallery').each(function () {
            e(this).magnificPopup({
                delegate: 'a',
                type: 'image',
                gallery: {
                    enabled: true
                },
                zoom: {
                    enabled: true,
                    duration: 300,
                    opener: function (element) {
                        return element.find('img');
                    }
                }
            });
        });
    };
    n.InnerBanner = function () {
        var pageSection = e(".data-bg");
        pageSection.each(function (indx) {
            if (e(this).attr("data-background")) {
                e(this).css("background-image", "url(" + e(this).data("background") + ")");
            }
        });
    };
    n.twp_matchheight = function () {
        e('.widget-area').theiaStickySidebar({
            additionalMarginTop: 30
        });
    };
    n.show_hide_scroll_top = function () {
        if (e(window).scrollTop() > e(window).height() / 2) {
            e("#scroll-up").fadeIn(300);
            e('body').addClass('theme-floatingbar-active');
        } else {
            e('body').removeClass('theme-floatingbar-active');
            e("#scroll-up").fadeOut(300);
        }
    };
    n.scroll_up = function () {
        e("#scroll-up").on("click", function () {
            e("html, body").animate({
                scrollTop: 0
            }, 800);
            return false;
        });
        if (e('.cd-stretchy-nav').length > 0) {
            var stretchyNavs = e('.cd-stretchy-nav');
            stretchyNavs.each(function () {
                var stretchyNav = e(this),
                    stretchyNavTrigger = stretchyNav.find('.cd-nav-trigger');
                stretchyNavTrigger.on('click', function (event) {
                    event.preventDefault();
                    stretchyNav.toggleClass('nav-is-visible');
                });
            });
            e(document).on('click', function (event) {
                if( !e(event.target).is('.cd-nav-trigger') && !e(event.target).is('.cd-nav-trigger span') ){
                    stretchyNavs.removeClass('nav-is-visible');
                }
            });
        }
    };
    e(document).ready(function () {
        n.mobileMenu.init();
        n.SlickCarousel();
        n.DataBackground();
        n.InnerBanner();
        n.TwpMarquee();
        n.MagnificPopup();
        n.twp_matchheight();
        n.scroll_up();
        n.TwpReveal();
    });
    e(window).scroll(function () {
        n.stickyMenu();
        n.show_hide_scroll_top();
    });
    e(window).resize(function () {
        n.mobileMenu.menuMobile();
    });
})(jQuery);