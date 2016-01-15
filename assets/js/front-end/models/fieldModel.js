define( ['models/fieldErrorCollection'], function( fieldErrorCollection ) {
	var model = Backbone.Model.extend( {
		defaults: {
			placeholder: '',
			value: '',
			label_pos: '',
			classes: 'ninja-forms-field',
			reRender: false,
			mirror_field: false,
			confirm_field: false,
			clean: true,
			disabled: ''
		},

		initialize: function() {
    		this.bind( 'change', this.changeModel, this );
    		this.bind( 'change:value', this.changeValue, this );
    		this.set( 'errors', new fieldErrorCollection() );
		},

		changeModel: function() {
			nfRadio.channel( 'field-' + this.get( 'id' ) ).trigger( 'change:model', this );
			nfRadio.channel( this.get( 'type' ) ).trigger( 'change:model', this );
			nfRadio.channel( 'fields' ).trigger( 'change:model', this );
		},

		changeValue: function() {
			nfRadio.channel( 'field-' + this.get( 'id' ) ).trigger( 'change:modelValue', this );
			nfRadio.channel( this.get( 'type' ) ).trigger( 'change:modelValue', this );
			nfRadio.channel( 'fields' ).trigger( 'change:modelValue', this );
		},

		addWrapperClass: function( cl ) {
			this.set( 'addWrapperClass', cl );
		},

		removeWrapperClass: function( cl ) {
			this.set( 'removeWrapperClass', cl );
		}

	} );

	return model;
} );
