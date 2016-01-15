/**
 * Handles interactions with our form settings collection.
 * 
 * @package Ninja Forms builder
 * @subpackage Actions
 * @copyright (c) 2015 WP Ninjas
 * @since 3.0
 */
define( ['models/advanced/settingsModel'], function( settingsModel ) {
	var controller = Marionette.Object.extend( {
		initialize: function() {
			// Load our action collection from our localized form data
			this.model = new settingsModel( preloadedFormData.settings );
			nfRadio.channel( 'settings' ).reply( 'get:settings', this.getSettings, this );
		},

		getSettings: function() {
			return this.model;
		}
	});

	return controller;
} );