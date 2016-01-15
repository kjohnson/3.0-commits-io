/**
 * Updates our database with our form data.
 * 
 * @package Ninja Forms builder
 * @subpackage Fields
 * @copyright (c) 2015 WP Ninjas
 * @since 3.0
 */
define( [], function() {
	var controller = Marionette.Object.extend( {
		initialize: function() {
			// Listen for the closing of the drawer and update when it's closed.
			this.listenTo( nfRadio.channel( 'drawer' ), 'closed', this.updateDB );
			// Respond to requests to update the database.
			nfRadio.channel( 'app' ).reply( 'update:db', this.updateDB, this );
		},

		/**
		 * Update our database.
		 * If action isn't specified, assume we're updating the preview.
		 * 
		 * @since  3.0
		 * @param  string 	action preview or publish
		 * @return void
		 */
		updateDB: function( action ) {
			// If our app is clean, dont' update.
			if ( nfRadio.channel( 'app' ).request( 'get:setting', 'clean' ) ) {
				return false;
			}

			// Default action to preview.
			action = action || 'preview';

			// Setup our ajax actions based on the action we're performing
			if ( 'preview' == action ) {
				var jsAction = 'nf_preview_update';
			} else if ( 'publish' == action ) {
				var jsAction = 'nf_save_form';
			}

			var formModel = nfRadio.channel( 'app' ).request( 'get:formModel' );

			if ( 'publish' == action && formModel.get( 'show_publish_options' ) ) {
				nfRadio.channel( 'app' ).request( 'open:drawer', 'newForm' );
				var builderEl = nfRadio.channel( 'app' ).request( 'get:builderEl' );
				jQuery( builderEl ).addClass( 'disable-main' );
				return false;
			}

			// Get our form data
			var formData = nfRadio.channel( 'app' ).request( 'get:formModel' );

			// Turn our formData model into an object
			var data = JSON.parse( JSON.stringify( formData ) );

			/**
			 * Prepare fields for submission.
			 */
			
			// Get the field IDs that we've deleted.
			var removedIDs = formData.get( 'fields' ).removedIDs;

			/*
			 * data.fields is an array of objects like:
			 * field.label = blah
			 * field.label_pos = blah
			 * etc.
			 *
			 * And we need that format to be:
			 * field.settings.label = blah
			 * field.settings.label_pos = blah
			 *
			 * So, we loop through our fields and create a field.settings object.
			 */
			_.each( data.fields, function( field ) {
				var id = field.id;
				// We dont' want to update id or parent_id
				delete field.id;
				delete field.parent_id;
				var settings = {};
				// Loop through all the attributes of our fields
				for (var prop in field) {
				    if ( field.hasOwnProperty( prop ) ) {
				    	// Set our settings.prop value.
				        settings[ prop ] = field[ prop ];
				        // Delete the property from the field.
				        delete field[ prop ];
				    }
				}
				// Update our field object.
				field.settings = settings;
				field.id = id;
			} );

			// Set our deleted_fields object so that we can know which fields were removed.
			data.deleted_fields = removedIDs;

			/**
			 * Prepare actions for submission.
			 */
			
			// Get the action IDs that we've deleted.
			var removedIDs = formData.get( 'actions' ).removedIDs;

			/*
			 * data.actions is an array of objects like:
			 * action.label = blah
			 * action.label_pos = blah
			 * etc.
			 *
			 * And we need that format to be:
			 * action.settings.label = blah
			 * action.settings.label_pos = blah
			 *
			 * So, we loop through our actions and create a field.settings object.
			 */
			_.each( data.actions, function( action ) {
				var id = action.id;
				// We dont' want to update id or parent_id
				delete action.id;
				delete action.parent_id;
				var settings = {};
				// Loop through all the attributes of our actions
				for (var prop in action) {
				    if ( action.hasOwnProperty( prop ) ) {
				    	// Set our settings.prop value.
				        settings[ prop ] = action[ prop ];
				        // Delete the property from the action.
				        delete action[ prop ];
				    }
				}
				// Update our action object.
				action.settings = settings;
				action.id = id;
			} );

			// Set our deleted_actions object so that we can know which actions were removed.
			data.deleted_actions = removedIDs;

			// Turn our object into a JSON string.
			data = JSON.stringify( data );
			// Run anything that needs to happen before we update.
			nfRadio.channel( 'app' ).trigger( 'before:updateDB', data );

			if ( 'publish' == action ) {
				nfRadio.channel( 'app' ).request( 'update:setting', 'loading', true );
				nfRadio.channel( 'app' ).trigger( 'change:loading' );				
			}
			// Update
			jQuery.post( ajaxurl, { action: jsAction, form: data, security: nfAdmin.ajaxNonce }, function( response ) {
				try {
					response = JSON.parse( response );
					response.action = action;
					// Run anything that needs to happen after we update.
					nfRadio.channel( 'app' ).trigger( 'response:updateDB', response );
				} catch( exception ) {
					console.log( 'Something went wrong!' );
					console.log( response );
				}
				
			} );
		}

	});

	return controller;
} );