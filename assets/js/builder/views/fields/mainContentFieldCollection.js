define( ['views/fields/fieldItem', 'views/fields/mainContentEmpty'], function( mainContentFieldView, mainContentFieldEmptyView ) {
	var view = Marionette.CollectionView.extend( {
		tagName: 'div',
		childView: mainContentFieldView,
		emptyView: mainContentFieldEmptyView,
		reorderOnSort: true,

		initialize: function() {
			nfRadio.channel( 'fields' ).reply( 'get:sortableEl', this.getSortableEl, this );
		},

		onRender: function() {
			if ( this.collection.models.length > 0 ) {
				jQuery( this.el ).addClass( 'nf-field-type-droppable' ).addClass( 'nf-fields-sortable' );
				var that = this;
				jQuery( this.el ).sortable( {
					containment: '#nf-main',
					helper: 'clone',
					cancel: '.nf-item-controls',
					placeholder: 'nf-fields-sortable-placeholder',
					opacity: 0.95,
					tolerance: 'intersect',

					receive: function( e, ui ) {
						nfRadio.channel( 'app' ).request( 'receive:fieldsSortable', ui );
					},

					over: function( e, ui ) {
						nfRadio.channel( 'app' ).request( 'over:fieldsSortable', ui );
					},

					out: function( e, ui ) {
						nfRadio.channel( 'app' ).request( 'out:fieldsSortable', ui );
					},

					start: function( e, ui ) {
						nfRadio.channel( 'app' ).request( 'start:fieldsSortable', ui );
					},

					update: function( e, ui ) {
						nfRadio.channel( 'app' ).request( 'update:fieldsSortable', ui );
					},

					stop: function( e, ui ) {
						nfRadio.channel( 'app' ).request( 'stop:fieldsSortable', ui );
					}
				} );
			}
		},

		getSortableEl: function() {
			return this.el;
		}
	} );

	return view;
} );