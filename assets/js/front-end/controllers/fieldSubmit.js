define([], function() {
    var controller = Marionette.Object.extend({

        initialize: function () {
            this.listenTo(nfRadio.channel('submit'), 'init:model', this.register);
            this.listenTo(nfRadio.channel('submit'), 'submit:response', this.onResponse );
        },

        register: function (submitModel) {
            console.log( submitModel );
            this.submitModel = submitModel;

            this.listenTo( nfRadio.channel( 'submit' ), 'click:field', this.onClick );
        },

        onClick: function() {
            this.label = this.submitModel.get( 'label' );
            var processingLabel = this.submitModel.get( 'processing_label' );
            this.submitModel.set( 'label', processingLabel );
            this.submitModel.set( 'reRender', true );
        },

        onResponse: function() {
            this.submitModel.set( 'label', this.label );
            this.submitModel.set( 'reRender', true );
        }

    });

    return controller;
});