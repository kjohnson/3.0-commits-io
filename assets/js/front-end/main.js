require.config( {
	baseUrl: nfFrontEnd.requireBaseUrl + '/front-end/'
} );

var nfRadio = Backbone.Radio;

jQuery( document ).ready( function( $ ) {
	require( ['models/formCollection', 'models/formModel', 'models/fieldCollection', 'controllers/loadControllers', 'views/mainLayout'], function( formCollection, FormModel, FieldCollection, LoadControllers, mainLayout ) {

		var NinjaForms = Marionette.Application.extend({
			forms: {},
			initialize: function( options ) {

				// TODO: Maybe move the resumeProcessing elsewhere.
				if( 'undefined' != typeof nfFrontEnd.resumeProcessing ){
					var formData = JSON.stringify( nfFrontEnd.resumeProcessing );
					var data = {
						'action': 'nf_ajax_resume',
						'security': nfFrontEnd.ajaxNonce,
						'formData': formData
					};

					jQuery.ajax({
						url: nfFrontEnd.adminAjax,
						type: 'POST',
						data: data,
						cache: false,
						success: function( data, textStatus, jqXHR ) {
							var response = jQuery.parseJSON( data );

							nfRadio.channel( 'submit' ).trigger( 'submit:response', response, textStatus, jqXHR );
						},
						error: function( jqXHR, textStatus, errorThrown ) {
							// Handle errors here
							console.log('ERRORS: ' + textStatus);
							// STOP LOADING SPINNER

							nfRadio.channel( 'submit' ).trigger( 'submit:response', 'error', textStatus, jqXHR, errorThrown );
						}
					});
				}

				nfRadio.channel( 'fields' ).reply( 'get:field', this.getField, this );
				nfRadio.channel( 'form' ).reply( 'get:form', this.getForm, this );
				nfRadio.channel( 'form' ).reply( 'submit:form', this.submitForm, this );
				var loadControllers = new LoadControllers();
				/*
				 * Setup our field collections.
				 */
				var that = this;

				/*
				 * Initialize our form collection (incase we have multiple forms on the page)
				 */
				this.forms = new formCollection();

				_.each( nfForms, function( form, index ) {
					var formModel = new FormModel( form );
					var fields = new FieldCollection( form.fields );
					fields.sort();
					formModel.set( 'fields', fields );
					that.forms.add( formModel );
				} );

				_.each( this.forms.models, function( form ) {
					_.each( form.get( 'fields' ).models, function( field ) {
						field.set( 'formID', form.get( 'id' ) );
						nfRadio.channel( field.get( 'type' ) ).trigger( 'init:model', field );
						nfRadio.channel( 'fields' ).trigger( 'init:model', field );
					} );
					nfRadio.channel( 'form' ).trigger( 'loaded', form );
					nfRadio.channel( 'form-' + form.get( 'id' ) ).trigger( 'loaded', form );
				} );
				
			},
			onStart: function() {
				_.each( this.forms.models, function( form, index ) {
					var layoutView = new mainLayout( { model: form, fieldCollection: form.get( 'fields' ) } );			
				} );
			},
			getField: function( id ) {
				var model = false;
				_.each( this.forms.models, function( form ) {
					if ( ! model ) {
						model = form.get( 'fields' ).get( id );	
					}			
				} );
				return model;
			},
			getForm: function( id ) {
				return this.forms.get( id );
			}
		});
	
		var ninjaForms = new NinjaForms();
		ninjaForms.start();		
	} );
} );