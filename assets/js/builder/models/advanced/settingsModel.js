/**
 * Model that represents our form settings.
 * 
 * @package Ninja Forms builder
 * @subpackage Form Settings
 * @copyright (c) 2015 WP Ninjas
 * @since 3.0
 */
define( [], function() {
	var model = Backbone.Model.extend( {
		defaults: {
			objectType: 'Form Setting',
			editActive: false
		},

		initialize: function() {
			// Listen for model attribute changes
			this.bind( 'change', this.changeSetting, this );

			this.listenTo( nfRadio.channel( 'settings' ), 'update:fieldKey', this.updateFieldKey );
		},

		/**
		 * When we change the model attributes, fire an event saying we've changed something.
		 * 
		 * @since  3.0
		 * @return void
		 */
		changeSetting: function() {
			nfRadio.channel( 'app' ).trigger( 'update:setting', this );
		},

		updateFieldKey: function( keyModel, settingModel ) {
			nfRadio.channel( 'app' ).request( 'replace:fieldKey', this, keyModel, settingModel );
		}
	} );
	
	return model;
} );