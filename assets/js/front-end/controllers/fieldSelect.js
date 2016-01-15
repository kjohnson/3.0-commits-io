define([], function() {
	var controller = Marionette.Object.extend( {
		initialize: function() {
			this.listenTo( nfRadio.channel( 'listselect' ), 'init:model', this.register );
			this.listenTo( nfRadio.channel( 'listmultiselect' ), 'init:model', this.register );
		},

		register: function( model ) {
			model.set( 'renderOptions', this.renderOptions );
			model.set( 'renderOtherAttributes', this.renderOtherAttributes );
		},

		renderOptions: function() {
			var that = this;
			var html = '';
			_.each( this.options, function( option ) {
				if ( 1 == option.selected ) {
					var selected = true;
				} else {
					var selected = false;
				}

				option.selected = selected;
				option.fieldID = that.id;
				option.classes = that.classes;
				option.currentValue = that.value;
				
				html += _.template( jQuery( '#nf-tmpl-field-listselect-option' ).html(), option );
			} );

			return html;
		},

		renderOtherAttributes: function() {
			var that = this;
			var otherAttributes = '';

			if( 'listmultiselect' == that.type ){
				otherAttributes = otherAttributes + ' multiple';
			}

			return otherAttributes;
		}

	});

	return controller;
} );