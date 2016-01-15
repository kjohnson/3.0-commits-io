/**
 * Changes collection view.
 *
 * @package Ninja Forms builder
 * @subpackage App
 * @copyright (c) 2015 WP Ninjas
 * @since 3.0
 */
define( ['views/app/drawer/itemSetting'], function( itemSettingView) {
	var view = Marionette.LayoutView.extend( {
		tagName: 'div',
		template: '#nf-tmpl-drawer-content-new-form',

		regions: {
			formName: '.new-form-name'
		},

		onRender: function() {
			var settingModel = nfRadio.channel( 'settings' ).request( 'get:settingModel', 'title' );
			var dataModel = nfRadio.channel( 'settings' ).request( 'get:settings' );
			this.formName.show( new itemSettingView( { model: settingModel, dataModel: dataModel } ) );
		},

		events: {
			'click .publish': 'clickPublish'
		},

		clickPublish: function( e ) {
			nfRadio.channel( 'app' ).trigger( 'click:confirmPublish', e );
		}
	} );

	return view;
} );
