define( ['views/fieldCollection'], function( fieldCollectionView ) {

	var view = Marionette.LayoutView.extend({
		tagName: "nf-section",
		template: "#nf-tmpl-form-layout",

		regions: {
			beforeFields: ".nf-before-fields",
			fields: ".nf-fields",
			afterFields: ".nf-after-fields",
		},

		onRender: function() {
			this.$el = this.$el.children();
			this.$el.unwrap();
			this.setElement( this.$el );
		},

		onShow: function() {
			this.fields.show( new fieldCollectionView( { collection: this.options.fieldCollection } ) );
		}

	});

	return view;
} );