define(
	[
		'controllers/fieldError',
		'controllers/changeField',
		'controllers/changeEmail',
		'controllers/fieldCheckbox',
		'controllers/fieldCheckboxList',
		'controllers/fieldRadio',
		'controllers/mirrorField',
		'controllers/confirmField',
		'controllers/updateFieldModel',
		'controllers/submitInit',
		'controllers/getFormErrors',
		'controllers/selectFile',
		'controllers/validateRequired',
		'controllers/submitError',
		'controllers/actionRedirect',
		'controllers/actionSuccess',
		'controllers/fieldSelect',
		'controllers/coreSubmitResponse',
		'controllers/fieldProduct',
		'controllers/fieldTotal',
		'controllers/fieldQuantity',
		'controllers/fieldSubmit',
		'controllers/calculations'
	],
	function(
		FieldError,
		ChangeField,
		ChangeEmail,
		FieldCheckbox,
		FieldCheckboxList,
		FieldRadio,
		MirrorField,
		ConfirmField,
		UpdateFieldModel,
		SubmitInit,
		GetFormErrors,
		SelectFile,
		ValidateRequired,
		SubmitError,
		ActionRedirect,
		ActionSuccess,
		FieldSelect,
		CoreSubmitResponse,
		FieldProduct,
		FieldTotal,
		FieldQuantity,
		FieldSubmit,
		Calculations
	) {
		var controller = Marionette.Object.extend( {
			initialize: function() {
				new FieldError();
				new ChangeField();
				new ChangeEmail();
				new FieldCheckbox();
				new FieldCheckboxList();
				new FieldRadio();
				new MirrorField();
				new ConfirmField();
				new UpdateFieldModel();
				new SubmitInit();
				new GetFormErrors();
				new SelectFile();
				new ValidateRequired();
				new SubmitError();
				new ActionRedirect();
				new ActionSuccess();
				new FieldSelect();
				new CoreSubmitResponse();
				new FieldProduct();
				new FieldTotal();
				new FieldQuantity();
				new FieldSubmit();
				new Calculations();
			}
		});

		return controller;
} );
