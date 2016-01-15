define( ['views/app/drawer/headerDefault'], function( defaultHeaderView ) {
	var model = Backbone.Model.extend( {
		defaults: {
			getHeaderView: function( data ) {
				return new defaultHeaderView( data );
			}
		}
	} );
	
	return model;
} );