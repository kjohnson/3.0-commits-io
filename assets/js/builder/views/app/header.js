/**
 * Main application header. Includes links to all of our domains.
 *
 * @package Ninja Forms builder
 * @subpackage App
 * @copyright (c) 2015 WP Ninjas
 * @since 3.0
 */
define( ['views/app/menu', 'views/app/menuButtons'], function( appMenuCollectionView, appMenuButtonsView ) {
	var view = Marionette.LayoutView.extend( {
		tagName: 'div',
		template: '#nf-tmpl-app-header',

		regions: {
			// Menu is our main app menu.
			menu: '.nf-app-menu',
			// Buttons represents the 'view changes' and 'Publish' buttons.
			buttons: '.nf-app-buttons'
		},

		/**
		 * Since this is a layout region, we need to fill the two areas: menu and buttons whenever we show this view.
		 * 
		 * @since  3.0
		 * @return void
		 */
		onShow: function() {
			// Get our domains
			var appDomainCollection = nfRadio.channel( 'app' ).request( 'get:domainCollection' );
			// show the menu area using the appropriate view, passing our domain collection.
			this.menu.show( new appMenuCollectionView( { collection: appDomainCollection } ) );
			this.buttons.show( new appMenuButtonsView() );
		}
	} );

	return view;
} );