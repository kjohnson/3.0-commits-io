/**
 * Model for our individual domains.
 * 
 * @package Ninja Forms builder
 * @subpackage Fields
 * @copyright (c) 2015 WP Ninjas
 * @since 3.0
 */
define( [], function() {
	var model = Backbone.Model.extend( {
		defaults: {
			dashicons: '',
			classes: '',
			active: false,
			url: '',
			hotkeys: false,
			disabled: false
		}
	} );
	
	return model;
} );