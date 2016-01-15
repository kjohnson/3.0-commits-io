define([], function() {
    var controller = Marionette.Object.extend( {
        initialize: function() {
            this.listenTo( nfRadio.channel( 'listcheckbox' ), 'change:field', this.fieldChange );
            this.listenTo( nfRadio.channel( 'listcheckbox' ), 'change:modelValue', this.changeModelValue );
            this.listenTo( nfRadio.channel( 'listcheckbox' ), 'init:model', this.register );
        },

        register: function( model ) {
            model.set( 'renderOptions', this.renderOptions );
            model.set( 'renderOtherText', this.renderOtherText );
            model.set( 'selected', [] );
        },

        fieldChange: function( el, model ) {

            var selected = model.get( 'selected' ) || [];
            if ( typeof selected == 'string' ) selected = [ selected ];

            var value = jQuery( el).val();
            var checked = jQuery( el ).attr( 'checked' );
            if ( checked ) {
                selected.push( value );
            } else {

                var i = selected.indexOf( value );
                if( -1 != i ){
                    selected.splice( i, 1 );
                }
            }

            model.set( 'selected', selected );
        },

        changeModelValue: function( model ) {
            if ( 1 == model.get( 'show_other' ) ) {
                model.set( 'reRender', true );
            }

            var selected = model.get( 'selected' );
            model.set( 'value', selected );
        },

        renderOptions: function() {
            var that = this;
            var html = '';
            if ( '' == this.value ) {
                var valueFound = true;
            } else {
                var valueFound = false;
            }

            _.each( this.options, function( option ) {
                if ( option.value == that.value ) {
                    valueFound = true;
                }

                option.fieldID = that.id;
                option.classes = that.classes;
                option.currentValue = that.value;

                if( option.selected ){
                    that.selected.push( option.value );
                }

                html += _.template( jQuery( '#nf-tmpl-field-listcheckbox-option' ).html(), option );
            } );

            if ( 1 == this.show_other ) {
                if ( 'nf-other' == this.value ) {
                    valueFound = false;
                }
                var data = {
                    fieldID: this.id,
                    classes: this.classes,
                    currentValue: this.value,
                    renderOtherText: this.renderOtherText,
                    valueFound: valueFound
                };
                html += _.template( jQuery( '#nf-tmpl-field-listcheckbox-other' ).html(), data );

            }

            return html;
        },

        renderOtherText: function() {
            if ( 'nf-other' == this.currentValue || ! this.valueFound ) {
                if ( 'nf-other' == this.currentValue ) {
                    this.currentValue = '';
                }
                var data = {
                    fieldID: this.fieldID,
                    classes: this.classes,
                    currentValue: this.currentValue
                };
                return _.template( jQuery( '#nf-tmpl-field-listcheckbox-other-text' ).html(), data );
            }
        }
    });

    return controller;
} );