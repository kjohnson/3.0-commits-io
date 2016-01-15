define([], function() {
	var controller = Marionette.Object.extend( {
		initialize: function() {
			this.listenTo( nfRadio.channel( 'listradio' ), 'change:modelValue', this.changeModelValue );
			this.listenTo( nfRadio.channel( 'listradio' ), 'init:model', this.register );
		},

		register: function( model ) {
			model.set( 'renderOptions', this.renderOptions );
			model.set( 'renderOtherText', this.renderOtherText );
		},

		changeModelValue: function( model ) {
			if ( 1 == model.get( 'show_other' ) ) {
				model.set( 'reRender', true );
			}
		},

		renderOptions: function() {
			var that = this;
			var html = '';
			if ( '' == this.value ) {
				var valueFound = true;
			} else {
				var valueFound = false;
			}
			
			_.each( this.options, function( option ) {
				if ( option.value == that.value ) {
					valueFound = true;
				}

				option.fieldID = that.id;
				option.classes = that.classes;
				option.currentValue = that.value;
				
				html += _.template( jQuery( '#nf-tmpl-field-listradio-option' ).html(), option );
			} );

			if ( 1 == this.show_other ) {
				if ( 'nf-other' == this.value ) {
					valueFound = false;
				}
				var data = {
					fieldID: this.id,
					classes: this.classes,
					currentValue: this.value,
					renderOtherText: this.renderOtherText,
					valueFound: valueFound
				};
				html += _.template( jQuery( '#nf-tmpl-field-listradio-other' ).html(), data );

			}

			return html;
		},

		renderOtherText: function() {
			if ( 'nf-other' == this.currentValue || ! this.valueFound ) {
				if ( 'nf-other' == this.currentValue ) {
					this.currentValue = '';
				}
				var data = {
					fieldID: this.fieldID,
					classes: this.classes,
					currentValue: this.currentValue
				};
				return _.template( jQuery( '#nf-tmpl-field-listradio-other-text' ).html(), data );
			}
		}
	});

	return controller;
} );