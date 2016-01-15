/**
 * Config file for our app domains.
 * 
 * this.collection represents all of our app domain (fields, actions, settings) information.
 *
 * This doesn't store the current domain, but rather all the data about each.
 * 
 * This data includes:
 * hotkeys
 * header view
 * subheader view
 * content view
 * 
 * @package Ninja Forms builder
 * @subpackage Main App
 * @copyright (c) 2015 WP Ninjas
 * @since 3.0
 */
define( [
	// Require our domain collection
	'models/app/domainCollection',
	// Require our fields domain files
	'views/fields/mainHeader',
	'views/fields/subHeader',
	'views/fields/mainContentFieldCollection',
	// Require our actions domain files
	'views/actions/mainHeader', 
	'views/actions/subHeader',
	'views/actions/mainContent',
	// Require our settings domain files
	'views/advanced/mainHeader',
	'views/advanced/subHeader',
	'views/advanced/mainContent',
	], 
	function( 
		appDomainCollection,
		fieldsMainHeaderView,
		fieldsSubHeaderView,
		fieldsMainContentFieldCollectionView,
		actionsMainHeaderView,
		actionsSubHeaderView,
		actionsMainContentView,
		settingsMainHeaderView,
		settingsSubHeaderView,
		settingsMainContentView
	) {
	var controller = Marionette.Object.extend( {
		initialize: function() {
			// Define our app domains
			this.collection = new appDomainCollection( [
				{
					id: 'fields',
					nicename: 'Form Fields',
					hotkeys: {
						'Esc'				: 'close:drawer',
						'Ctrl+Shift+n'		: 'add:newField',
						'Ctrl+Shift+a'		: 'changeDomain:actions',
						'Ctrl+Shift+s'		: 'changeDomain:settings',
						'Alt+Ctrl+t'		: 'open:mergeTags',
						'up'				: 'up:mergeTags',
						'down'				: 'down:mergeTags',
						'Shift+return'		: 'return:mergeTags'
					},

					getMainHeaderView: function() {
						return new fieldsMainHeaderView();
					},

					getSubHeaderView: function() {
						return new fieldsSubHeaderView();
					},

					getMainContentView: function( collection ) {
						var collection = nfRadio.channel( 'fields' ).request( 'get:collection' );
						return new fieldsMainContentFieldCollectionView( { collection: collection } );
					}
				},
				{
					id: 'actions',
					nicename: 'Emails & Actions',
					hotkeys: {
						'Esc'				: 'close:drawer',
						'Ctrl+Shift+n'		: 'add:newAction',
						'Ctrl+Shift+f'		: 'changeDomain:fields',
						'Ctrl+Shift+s'		: 'changeDomain:settings',
						'Alt+Ctrl+t'		: 'open:mergeTags',
						'up'				: 'up:mergeTags',
						'down'				: 'down:mergeTags',
						'Shift+return'		: 'return:mergeTags'
					},

					getMainHeaderView: function() {
						return new actionsMainHeaderView();
					},

					getSubHeaderView: function() {
						return new actionsSubHeaderView();
					},
					
					getMainContentView: function() {
						var collection = nfRadio.channel( 'actions' ).request( 'get:collection' );
						return new actionsMainContentView( { collection: collection } );
					}
				},
				{
					id: 'settings',
					nicename: 'Advanced',
					hotkeys: {
						'Esc'				: 'close:drawer',
						'Ctrl+Shift+f'		: 'changeDomain:fields',
						'Ctrl+Shift+a'		: 'changeDomain:actions',
						'Alt+Ctrl+t'		: 'open:mergeTags',
						'up'				: 'up:mergeTags',
						'down'				: 'down:mergeTags',
						'Shift+return'		: 'return:mergeTags'
					},

					getMainHeaderView: function() {
						return new settingsMainHeaderView();
					},

					getSubHeaderView: function() {
						return new settingsSubHeaderView();
					},
					
					getMainContentView: function() {
						var collection = nfRadio.channel( 'settings' ).request( 'get:typeCollection' );
						return new settingsMainContentView( { collection: collection } );
					}
				},
				{
					id: 'preview',
					nicename: 'Preview Form',
					classes: 'preview',
					dashicons: 'dashicons-visibility',
					url: nfAdmin.previewurl
				}
			] );

			/*
			 * Respond to requests to get the app domain collection.
			 */
			nfRadio.channel( 'app' ).reply( 'get:domainCollection', this.getDomainCollection, this );
			nfRadio.channel( 'app' ).reply( 'get:domainModel', this.getDomainModel, this );
		},

		getDomainCollection: function() {
			return this.collection;
		},

		getDomainModel: function( id ) {
			return this.collection.get( id );
		}

	});

	return controller;
} );