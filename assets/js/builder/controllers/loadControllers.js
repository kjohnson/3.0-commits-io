/**
 * Loads all of our controllers using Require JS.
 * 
 * @package Ninja Forms builder
 * @subpackage Fields
 * @copyright (c) 2015 WP Ninjas
 * @since 3.0
 */
define(
	[
		/*
		 * Application controllers
		 */
		'controllers/app/drawer',
		'controllers/app/drawerConfig',		
		'controllers/app/domainConfig',
		'controllers/app/data',		
		'controllers/app/drawerToggleSettingGroup',
		'controllers/app/updateDB',
		'controllers/app/formData',
		'controllers/app/previewLink',
		'controllers/app/menuButtons',
		'controllers/app/trackChanges',
		'controllers/app/undoChanges',
		'controllers/app/publishResponse',
		'controllers/app/changeDomain',
		'controllers/app/pushstate',
		'controllers/app/hotkeys',
		'controllers/app/cleanState',
		'controllers/app/coreUndo',
		'controllers/app/cloneModelDeep',
		'controllers/app/getSettingChildView',
		'controllers/app/changeSettingDefault',
		'controllers/app/fieldset',
		'controllers/app/toggleSetting',
		'controllers/app/itemControls',
		'controllers/app/mergeTags',
		'controllers/app/itemSettingFill',
		'controllers/app/confirmPublish',
		'controllers/app/rte',
		/*
		 * Fields domain controllers
		 */
		'controllers/fields/types',
		'controllers/fields/fieldTypeDrag',
		'controllers/fields/stagingDrag',
		'controllers/fields/savedFieldsSection',
		'controllers/fields/staging',
		'controllers/fields/stagingSortable',
		'controllers/fields/filterTypes',
		'controllers/fields/sortable',
		'controllers/fields/data',
		'controllers/app/optionRepeater',
		'controllers/fields/editActive',
		'controllers/fields/fieldSettings',
		'controllers/fields/fieldCreditCard',
		'controllers/fields/fieldQuantity',
		'controllers/fields/fieldShipping',
		'controllers/fields/key',

		/*
		 * TODO: Actions domain controllers
		 */
		'controllers/actions/types',
		'controllers/actions/data',
		'controllers/actions/actionSettings',
		'controllers/actions/editActive',
		'controllers/actions/addActionTypes',
		'controllers/actions/typeDrag',
		'controllers/actions/droppable',
		'controllers/actions/filterTypes',

		/*
		 * TODO: Settings domain controllers
		 */
		'controllers/advanced/types',
		'controllers/advanced/data',
		'controllers/advanced/formSettings',
		'controllers/advanced/editActive',
		'controllers/advanced/clickEdit'
	],
	function(
		/*
		 * Application controllers
		 */
		Drawer,
		DrawerConfig,
		DomainConfig,
		AppData,
		DrawerToggleSettingGroup,
		UpdateDB,
		FormData,
		PreviewLink,
		AppMenuButtons,
		AppTrackChanges,
		AppUndoChanges,
		AppPublishResponse,
		AppChangeDomain,
		Pushstate,
		Hotkeys,
		CleanState,
		CoreUndo,
		CloneModelDeep,
		DrawerSettingChildView,
		ChangeSettingDefault,
		Fieldset,
		ToggleSetting,
		ItemControls,
		MergeTags,
		ItemSettingFill,
		ConfirmPublish,
		RTE,
		/*
		 * Fields domain controllers
		 */
		FieldTypes,
		FieldTypeDrag,
		FieldStagingDrag,
		SavedFields,
		StagedFieldsData,
		StagedFieldsSortable,
		DrawerFilterFieldTypes,
		MainContentFieldsSortable,
		FieldData,
		OptionRepeater,
		FieldsEditActive,
		FieldSettings,
		FieldCreditCard,
		FieldQuantity,
		FieldShipping,
		FieldKey,
		/*
		 * TODO: Actions domain controllers
		 */
		ActionTypes,
		ActionData,
		ActionSettings,
		ActionEditActive,
		ActionAddTypes,
		ActionTypeDrag,
		ActionDroppable,
		ActionFilterTypes,
		/*
		 * TODO: Settings domain controllers
		 */
		SettingTypes,
		SettingData,
		FormSettings,
		SettingsEditActive,
		SettingsClickEdit
		
	) {
		var controller = Marionette.Object.extend( {
			initialize: function() {
				/*
				 * Application controllers
				 */
				new Hotkeys();
				new Drawer();
				new DrawerConfig();
				new DomainConfig();
				new DrawerToggleSettingGroup();
				new UpdateDB();
				new PreviewLink();
				new AppMenuButtons();
				new AppTrackChanges();
				new AppUndoChanges();
				new AppPublishResponse();
				new AppChangeDomain();
				new CleanState();
				new CoreUndo();
				new CloneModelDeep();
				new ItemControls();
				new ConfirmPublish();
				new RTE();
				// new Pushstate();
				/*
				 * Fields domain controllers
				 * 
				 * Field-specific controllers should be loaded before our field type controller.
				 * This ensures that any 'init' hooks are properly registered.
				 */
				new Fieldset();
				new OptionRepeater();

				new FieldTypes();
				new FieldTypeDrag();
				new FieldStagingDrag();
				new SavedFields();
				new StagedFieldsData();
				new StagedFieldsSortable();
				new DrawerFilterFieldTypes();
				new MainContentFieldsSortable();
				new ChangeSettingDefault();
				new ToggleSetting();
				new DrawerSettingChildView();
				new FieldsEditActive();
				new FieldSettings();
				new FieldCreditCard();
				new FieldQuantity();
				new FieldShipping();
				new FieldKey();
				/*
				 * TODO: Actions domain controllers
				 */
				new ActionTypes();
				new ActionData();
				new ActionSettings();
				new ActionEditActive();
				new ActionAddTypes();
				new ActionTypeDrag();
				new ActionDroppable();
				new ActionFilterTypes();
				/*
				 * TODO: Settings domain controllers
				 */
				new SettingTypes();
				new FormSettings();
				new SettingData();
				new SettingsEditActive();
				new SettingsClickEdit();
				/*
				 * Data controllers need to be set after every other controller has been setup, even if they aren't domain-specific.
				 * AppData() was after FormData();
				 */
				new AppData();
				new FieldData();
				new FormData();
				new MergeTags();
				new ItemSettingFill();
			}
		});

		return controller;
} );
