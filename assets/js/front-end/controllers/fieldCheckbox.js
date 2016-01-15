define([], function() {
	var radioChannel = nfRadio.channel( 'checkbox' );

	var controller = Marionette.Object.extend( {
		initialize: function() {
			this.listenTo( radioChannel, 'change:field', this.fieldChange );
			radioChannel.reply( 'validate:required', this.validateRequired );
		},

		fieldChange: function( el, model ) {
			var checked = jQuery( el ).attr( 'checked' );
			if ( checked ) {
				var value = 1;
			} else {
				var value = 0;
			}

			var args = {
				'value' : value,
				'isUpdated' : true
			};
			
			model.set( args );
		},

		validateRequired: function( el, model ) {
			return el[0].checked;
		}
	});

	return controller;
} );