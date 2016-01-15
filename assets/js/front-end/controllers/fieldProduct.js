define([], function() {
    var controller = Marionette.Object.extend( {
        initialize: function() {
            this.listenTo( nfRadio.channel( 'product' ), 'init:model', this.register );
        },

        register: function( model ) {
            model.set( 'renderProductQuantity', this.renderProductQuantity );
            model.set( 'renderProduct', this.renderProduct );
            model.set( 'renderOptions', this.renderOptions );
        },

        renderProduct: function(){
            switch( this.product_type ) {
                case 'user':
                    return _.template( jQuery( '#nf-tmpl-field-textbox' ).html(), this );
                    break;
                case 'hidden':
                    return _.template( jQuery( '#nf-tmpl-field-hidden' ).html(), this );
                    break;

                case 'dropdown':
                    return _.template( jQuery( '#nf-tmpl-product-dropdown' ).html(), this );
                    break;
                default:
                    return _.template( jQuery( '#nf-tmpl-product-single' ).html(), this );
            }
        },

        renderProductQuantity: function(){
            if ( 1 == this.product_use_quantity ) {
                return _.template( jQuery( '#nf-tmpl-product-quantity' ).html(), this );
            }
        },

        renderOptions: function() {
            var that = this;
            var html = '';
            _.each( this.options, function( option ) {
                if ( 1 == option.selected ) {
                    var selected = true;
                } else {
                    var selected = false;
                }

                option.selected = selected;
                option.fieldID = that.id;
                option.classes = that.classes;
                option.currentValue = that.value;

                html += _.template( jQuery( '#nf-tmpl-product-' + that.product_type + '-option' ).html(), option );
            } );

            return html;
        }
    });

    return controller;
} );
