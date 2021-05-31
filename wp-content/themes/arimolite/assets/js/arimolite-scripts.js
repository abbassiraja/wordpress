(function($){
	"use strict";	
    $(document).ready(function() {

        if ($('body').length ) { $('body').fitVids(); }
        $('select').chosen();
       
        arimolite_main_menu();
        document.onkeyup = KeyPress;        

        // Menu Touch        
        $('.body-overlay').on('click',function() {
            $('body').removeClass('open-menutouch');
        });

        $(document).on('click','.menu-touch',function( event ){
            event.stopPropagation();
            $(this).toggleClass('active');
            $('body').addClass('open-menutouch');
            return false;
        });
        
        //Nav Search
         $(document).on('click','.navbar-search',function(){
            $(this).parent().addClass('search-active');
            return false;
        });
         $(document).on('click','.close-search',function(){
            $(this).closest('.navbar-col').removeClass('search-active');
            return false;
        });

        //Submenu 
        var _subMenu = $('.main-menu-horizontal .arimolite-main-menu > li > .sub-menu');
        _subMenu.each(function(){
            var _widthSub = $(this).outerWidth(),
                _widthContainer = $('.main-wrapper-boxed').outerWidth(),
                offsetContent = ($(window).width() - _widthContainer)/2;
            
            var offsetLeft = $(this).offset().left,
                offsetRight = $(window).width() - offsetLeft;

            var _rightPos =  offsetRight - offsetContent;

            if(_rightPos < _widthSub){
                var _left = (_widthSub - _rightPos) + 50;
                console.log(_left);
                $(this).css({
                    "left": '-'+_left+'px'
                });
                $(this).find('.sub-menu').css({
                    "left": "auto",
                    "right": "100%"
                });
            }

        })

        //MENU
        function KeyPress()
        {
            if ( ! $('ul.arimolite-main-menu  > li a, div.arimolite-main-menu  > ul > li a').is(':focus') ) {
                $('.arimolite-main-menu  li').removeClass('is-focus');
            }
            //Focus
            $('ul.arimolite-main-menu  > li a, div.arimolite-main-menu  > ul > li a').on('focus',function(){
                var prevLi = $(this).parents('li').last().prev(),
                    currentLi = $(this).parents('li').last(),
                    nextLi = $(this).parents('li').last().next();

                    currentLi.addClass('is-focus');
                    if (prevLi.length > 0 && prevLi.hasClass('is-focus') ) {
                        prevLi.removeClass('is-focus');
                    }
                    if (nextLi.length > 0 && nextLi.hasClass('is-focus') ) {
                        nextLi.removeClass('is-focus');
                    }

                var currentFocus = $(this).parent(),
                    prevCurrent = currentFocus.prev(),
                    nextCurrent = currentFocus.next();

                    currentFocus.addClass('is-focus');
                    if (prevCurrent.length > 0 && prevCurrent.hasClass('is-focus') ) {
                        prevCurrent.removeClass('is-focus');
                    }
                    if (nextCurrent.length > 0 && nextCurrent.hasClass('is-focus') ) {
                        nextCurrent.removeClass('is-focus');
                    }
            });
        }
    
         function arimolite_main_menu()
        {
            //Hover
            $('.arimolite-main-menu li.menu-item-has-children,.arimolite-main-menu li.page_item_has_children').hover(function(){
                 $(this).addClass('is-hover');
            },function(){
                 $(this).removeClass('is-hover');
            });

            //Click
            $('.arimolite-main-menu li.menu-item-has-children > a,.arimolite-main-menu li.page_item_has_children > a').on('click',function(e){
                if ($(this).parent().hasClass('show-submenu')) {
                    $(this).parent().removeClass('show-submenu');
                    $(this).removeClass('active');
                } else {
                    $(this).closest('ul').children('li').removeClass('show-submenu');
                    $(this).closest('ul').children('li').children('.active').removeClass('active');
                    $(this).parent().toggleClass('show-submenu');
                    $(this).addClass('active');
                }
                return false;
            });
        }    

    });
    
    
})(jQuery);
