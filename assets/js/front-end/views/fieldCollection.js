define( ['views/fieldItem'], function( fieldItem ) {
	var view = Marionette.CollectionView.extend({
		tagName: 'nf-fields-wrap',
		childView: fieldItem

	});

	return view;
} );