define( [], function() {
	var view = Marionette.ItemView.extend({
		tagName: 'div',
		className: 'nf-table-row',
		template: '#nf-tmpl-edit-setting-option-repeater-default-row',
		id: function() {
			return this.model.cid;
		},

		initialize: function( data ) {
			this.settingModel = data.settingModel;
			this.dataModel = data.dataModel;
			this.collection = data.collection;
			this.columns = data.columns;

			if ( 'undefined' != typeof this.settingModel.get( 'tmpl_row' ) ) {
				this.template = '#' + this.settingModel.get( 'tmpl_row' );
			}
		},

		onRender: function() {
			/*
			 * Send out a radio message.
			 */
			nfRadio.channel( 'setting-' + this.settingModel.get( 'name' ) + '-option' ).trigger( 'render:setting', this.model, this.dataModel, this );
		},

		onShow: function() {
			if ( this.model.get( 'new' ) ) {
				jQuery( this.el ).find( 'input:first' ).focus();
				this.model.set( 'new', false );
			}
		},

		events: {
			'change .setting': 'changeOption',
			'click .nf-delete': 'deleteOption',
			'keyup': 'maybeAddOption'
		},

		changeOption: function( e ) {
			nfRadio.channel( 'option-repeater' ).trigger( 'change:option', e, this.model, this.dataModel );
		},

		deleteOption: function( e ) {
			nfRadio.channel( 'option-repeater' ).trigger( 'click:deleteOption', this.model, this.collection, this.dataModel );
		},

		maybeAddOption: function( e ) {
			if ( 13 == e.keyCode ) {
				nfRadio.channel( 'option-repeater' ).trigger( 'click:addOption', this.collection, this.dataModel );
			}
		},

		templateHelpers: function() {
			var that = this;
			return {
				getColumns: function() {
					return that.columns;
				}
			}
		}

	});

	return view;
} );
