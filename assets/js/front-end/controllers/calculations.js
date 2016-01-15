/**
 * Controller responsible for keeping up with calculations.
 */
define(['models/calcCollection'], function( CalcCollection ) {
	var controller = Marionette.Object.extend( {
		initialize: function() {
			this.calcs = {};

			// When our form initialises, check to see if there are any calculations that need to be tracked.
			this.listenTo( nfRadio.channel( 'form' ), 'loaded', this.registerCalcs );			
		},

		registerCalcs: function( formModel ) {
			this.calcs[ formModel.get( 'id' ) ] = new CalcCollection( formModel.get( 'settings' ).calculations, { formModel: formModel } );
		}
	});

	return controller;
} );