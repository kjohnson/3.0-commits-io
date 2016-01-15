define([], function() {
	var controller = Marionette.Object.extend( {
		initialize: function() {
			this.listenTo( nfRadio.channel( 'submit' ), 'submit:response', this.actionSubmit );
		},

		actionSubmit: function( response ) {
			if ( 1 == response.data.settings.clear_successfully_created_form ) {
				
			}

			if ( 1 == response.data.settings.hide_successfully_completed_form ) {
				/**
				 * TODO: This needs to be re-worked for backbone. It's not dynamic enough.
				 */
				jQuery( '.nf-fields' ).hide();
				jQuery( '.nf-form-title' ).hide();
			}
		}

	});

	return controller;
} );