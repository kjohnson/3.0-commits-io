define( [], function() {
	var model = Backbone.Model.extend( {
		initialize: function() {
			// Set our form id
			this.set( 'formID', this.collection.options.formModel.get( 'id' ) );

			var eq = this.get( 'eq' );
			// Check to see if we have any merge tags in our equation.
			console.log( eq.split( '{field:' ).split( '}' ) );
			// Send a message out on our form channel asking for the fieldModel that corresponds to any merge tags found in this equation.
			
		}
	} );

	return model;
} );
