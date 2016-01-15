<?php if ( ! defined( 'ABSPATH' ) ) exit;

return apply_filters( 'ninja-forms-field-settings', array(

    /*
    |--------------------------------------------------------------------------
    | Primary Settings
    |--------------------------------------------------------------------------
    |
    | The most commonly used settings for a field.
    |
    */

    /*
     * LABEL
     */

    'label' => array(
        'name' => 'label',
        'type' => 'textbox',
        'label' => __( 'Label', 'ninja-forms'),
        'width' => 'one-half',
        'group' => 'primary',
        'value' => '',
        'help' => __( 'Enter the label of the form field. This is how users will identify individual fields.', 'ninja-forms' ),
    ),

    /*
     * LABEL POSITION
     */

    'label_pos' => array(
        'name' => 'label_pos',
        'type' => 'select',
        'label' => __( 'Label Position', 'ninja-forms' ),
        'options' => array(
            array(
                'label' => __( 'Form Default', 'ninja-forms' ),
                'value' => 'default'
            ),
            array(
                'label' => __( 'Above Element', 'ninja-forms' ),
                'value' => 'above'
            ),
            array(
                'label' => __( 'Below Element', 'ninja-forms' ),
                'value' => 'below'
            ),
            array(
                'label' => __( 'Left of Element', 'ninja-forms' ),
                'value' => 'left'
            ),
            array(
                'label' => __( 'Right of Element', 'ninja-forms' ),
                'value' => 'right'
            ),
            array(
                'label' => __( 'Hidden', 'ninja-forms' ),
                'value' => 'hidden'
            ),
        ),
        'width' => 'one-half',
        'group' => 'primary',
        'value' => 'above',
        'help' => __( 'Select the position of your label relative to the field element itself.', 'ninja-forms' ),

    ),

    /*
     * REQUIRED
     */

    'required' => array(
        'name' => 'required',
        'type' => 'toggle',
        'label' => __( 'Required Field', 'ninja-forms' ),
        'width' => 'one-half',
        'group' => 'primary',
        'value' => FALSE,
        'help' => __( 'Ensure that this field is completed before allowing the form to be submitted.', 'ninja-forms' ),

    ),

    /*
     * NUMBER
     */

    'number' => array(
        'name' => 'number',
        'type' => 'fieldset',
        'label' => __( 'Number Options', 'ninja-forms' ),
        'width' => 'full',
        'group' => 'primary',
        'settings' => array(
            array(
                'name' => 'num_min',
                'type' => 'number',
                'placeholder' => '',
                'label' => __( 'Min', 'ninja-forms' ),
                'width' => 'one-third',
                'value' => ''
            ),
            array(
                'name' => 'num_max',
                'type' => 'number',
                'label' => __( 'Max', 'ninja-forms' ),
                'placeholder' => '',
                'width' => 'one-third',
                'value' => ''
            ),
            array(
                'name' => 'num_step',
                'type' => 'textbox',
                'label' => __( 'Step', 'ninja-forms' ),
                'placeholder' => '',
                'width' => 'one-third',
                'value' => 1
            ),
        ),

    ),

    /*
     * Checkbox Default Value
     */

    'checkbox_default_value' => array(
        'name' => 'default_value',
        'type' => 'select',
        'label' => __( 'Default Value', 'ninja-forms' ),
        'options' => array(
            array(
                'label' => __( 'Unchecked', 'ninja-forms' ),
                'value' => 'unchecked'
            ),
            array(
                'label' => __( 'Checked', 'ninja-forms'),
                'value' => 'checked',
            ),
        ),
        'width' => 'one-half',
        'group' => 'primary',
        'value' => 'unchecked',

    ),

    /*
     * OPTIONS
     */

    'options' => array(
        'name' => 'options',
        'type' => 'option-repeater',
        'label' => __( 'Options', 'ninja-forms' ) . ' <a href="#" class="nf-add-new">' . __( 'Add New', 'ninja-forms' ) . '</a>',
        'width' => 'full',
        'group' => 'primary',
        // 'value' => 'option-repeater',
        'value' => array(
            array( 'label'  => 'One', 'value' => 'one', 'calc' => '', 'selected' => 0, 'order' => 0 ),
            array( 'label'  => 'Two', 'value' => 'two', 'calc' => '', 'selected' => 0, 'order' => 1 ),
            array( 'label'  => 'Three', 'value' => 'three', 'calc' => '', 'selected' => 0, 'order' => 2 ),
        ),
        'columns'           => array( 
           'label'          => array(
                'header'    => __( 'Label', 'ninja-forms' ),
                'default'   => '',
            ),
            
            'value'         => array(
                'header'    => __( 'Value', 'ninja-forms' ),
                'default'   => '',
            ),
            'calc'          => array(
                'header'    =>__( 'Calc Value', 'ninja-forms' ),
                'default'   => '',
            ),
            'selected'      => array(
                'header'    => '<span class="dashicons dashicons-yes"></span>',
                'default'   => 0,
            ),
        ),

    ),

    /*
    |--------------------------------------------------------------------------
    | Restriction Settings
    |--------------------------------------------------------------------------
    |
    | Limit the behavior or validation of an input.
    |
    */

    /*
     * MASK
     */

    // 'mask' => array(
    //     'name' => 'mask',
    //     'type' => 'select',
    //     'label' => __( 'Input Mask', 'ninja-forms'),
    //     'width' => 'one-half',
    //     'group' => 'restrictions',
    //     'options' => array(
    //         array(
    //             'label' => __( 'none', 'ninja-forms' ),
    //             'value' => ''
    //         ),
    //         array(
    //             'label' => __( 'US Phone', 'ninja-forms' ),
    //             'value' => 'us-phone'
    //         ),
    //         array(
    //             'label' => __( 'Date', 'ninja-forms' ),
    //             'value' => 'date'
    //         ),
    //     )
    //     'value' => '',
    //
    // ),

    /*
     * INPUT LIMIT SET
     */

    // 'input_limit_set' => array(
    //     'name' => 'input_limit_set',
    //     'type' => 'fieldset',
    //     'label' => __( 'Limit Input to this Number', 'ninja-forms' ),
    //     'width' => 'full',
    //     'group' => 'restrictions',
    //     'settings' => array(
    //         array(
    //             'name' => 'input_limit',
    //             'type' => 'textbox',
    //             'placeholder' => 150,
    //             'width' => 'one-half',
    //             'value' => ''
    //         ),
    //         array(
    //             'name' => 'input_limit_type',
    //             'type' => 'select',
    //             'options' => array(
    //                 array(
    //                     'label' => __( 'Character(s)', 'ninja-forms' ),
    //                     'value' => 'characters'
    //                 ),
    //                 array(
    //                     'label' => __( 'Word(s)', 'ninja-forms' ),
    //                     'value' => 'words'
    //                 ),
    //             ),
    //             'value' => 'characters'
    //         ),
    //         array(
    //             'name' => 'input_limit_message',
    //             'type' => 'textbox',
    //             'label' => __( 'Text to Appear After Counter', 'ninja-forms' ),
    //             'placeholder' => __( 'Character(s) left' ),
    //             'width' => 'full',
    //             'value' => __( 'Character(s) left' )
    //         )
    //     ),
    //
    // ),

    /*
    |--------------------------------------------------------------------------
    | Advanced Settings
    |--------------------------------------------------------------------------
    |
    | The least commonly used settings for a field.
    | These settings should only be used for specific reasons.
    |
    */

    /*
     * INPUT PLACEHOLDER
     */

    'placeholder' => array(
        'name' => 'placeholder',
        'type' => 'textbox',
        'label' => __( 'Placeholder', 'ninja-forms' ),
        'width' => 'full',
        'group' => 'advanced',
        'value' => '',
        'help' => __( 'Enter text you would like displayed in the field before a user enters any data.', 'ninja-forms' ),
        'use_merge_tags' => FALSE,
    ),


    /*
     * DEFAULT VALUE
     */

     'default' => array(
         'name' => 'default',
         'label' => __( 'Default Value' ),
         'type' => 'textbox',
         'width' => 'full',
         'value' => '',
         'group' => 'advanced',
         'use_merge_tags' => array(
             'exclude' => array(
                 'fields'
             )
         ),
     ),

    /*
    * CLASSES
    */
    'classes' => array(
        'name' => 'classes',
        'type' => 'fieldset',
        'label' => __( 'Custom Class Names', 'ninja-forms' ),
        'width' => 'full',
        'group' => 'advanced',
        'settings' => array(
            array(
                'name' => 'wrapper_class',
                'type' => 'textbox',
                'placeholder' => '',
                'label' => __( 'Wrapper', 'ninja-forms' ),
                'width' => 'one-half',
                'value' => '',
                'use_merge_tags' => FALSE,
            ),
            array(
                'name' => 'element_class',
                'type' => 'textbox',
                'label' => __( 'Element', 'ninja-forms' ),
                'placeholder' => '',
                'width' => 'one-half',
                'value' => '',
                'use_merge_tags' => FALSE,
            ),
        ),
    ),

    /*
     * DATEPICKER
     */

    'datepicker' => array(
        'name' => 'datepicker',
        'type' => 'toggle',
        'label' => __( 'Use the JQueryUI datepicker.', 'ninja-forms' ),
        'width' => 'full',
        'group' => 'advanced',
        'value' => FALSE,

    ),



    /*
     * TIME SETTING
     */

    'time_submit' => array(
        'name' => 'time_submit',
        'type' => 'textbox',
        'label' => __( 'Number of seconds for timed submit.', 'ninja-forms' ),
        'width' => 'full',
        'group' => 'advanced',
        'value' => FALSE,

    ),


    /*
     * KEY
     */

    'key' => array(
        'name' => 'key',
        'type' => 'textbox',
        'label' => __( 'Field Key', 'ninja-forms'),
        'width' => 'full',
        'group' => 'administration',
        'value' => '',
        'help' => __( 'Programmatic name that can be used to reference this field.', 'ninja-forms' ),
    ),

    /*
    |--------------------------------------------------------------------------
    | Un-Grouped Settings
    |--------------------------------------------------------------------------
    |
    | Hidden from grouped listings, but still searchable.
    |
    */

   /*
    * Spam Question
    */

    'spam_question' => array(
        'name' => 'spam_question',
        'type' => 'textbox',
        'label' => __( 'Spam Question', 'ninja-forms' ),
        'value' => __( 'Anti-Spam', 'ninja-forms' ),
        'width' => '',
        'group' => '',
        'value' => '',

    ),

   /*
    * Spam Answer
    */

    'spam_answer' => array(
        'name' => 'spam_answer',
        'type' => 'textbox',
        'label' => __( 'Spam Answer', 'ninja-forms' ),
        'width' => '',
        'group' => '',
        'value' => '',

    ),

   /*
    * Timed Submit Label
    */

   // 'timed_submit' => array(
   //      'name' => 'timed_submit',
   //      'type' => 'fieldset',
   //      'label' => __( 'Timed Submit', 'ninja-forms' ),
   //      'width' => 'full',
   //      'group' => 'advanced',
   //      'settings' => array(
   //          array(
   //              'name' => 'timed_submit_countdown',
   //              'type' => 'number',
   //              'label' => __( 'Countdown', 'ninja-forms' ),
   //              'value' => 10,
   //              'placeholder' => '',
   //              'width' => 'one-half',
   //
   //          ),
   //          array(
   //              'name' => 'timed_submit_label',
   //              'type' => 'textbox',
   //              'placeholder' => '',
   //              'label' => __( 'Timer Label', 'ninja-forms' ),
   //              'value' => __( 'Please wait %n seconds', 'ninja-forms' ),
   //              'width' => 'one-half'
   //
   //          ),
   //      ),
   //  ),

                'timed_submit_label' => array(
                    'name' => 'timed_submit_label',
                    'type' => 'textbox',
                    'label' => __( 'Label', 'ninja-forms' ),
                    //The following text appears below the element
                    //'Submit button text after timer expires'
                    'width' => '',
                    'group' => '',
                    'value' => '',
                    'use_merge_tags' => TRUE,
                ),

               /*
                * Timed Submit Timer
                */

                'timed_submit_timer' => array(
                    'name' => 'timed_submit_timer',
                    'type' => 'textbox',
                    'label' => __( 'Label' , 'ninja-forms' ),
                    // This text was located below the element '%n will be used to signfify the number of seconds'
                    'value' => __( 'Please wait %n seconds', 'ninja-forms' ),
                    'width' => '',
                    'group' => '',

                ),

               /*
                * Timed Submit Countdown
                */

                'timed_submit_countdown' => array (
                    'name' => 'timed_submit_countdown',
                    'type' => 'number',
                    'label' => __( 'Number of seconds for the countdown', 'ninja-forms' ),
                    //The following text appears to the right of the element
                    //"This is how long the user must waitin to submit the form"
                    'value' => 10,
                    'width' => '',
                    'group' => '',

                ),



   /*
    * Show Rich Text Editor
    */

    // 'rte_enable' => array(
    //     'name' => 'rte_enable', // TODO was rich_text_editor
    //     'type' => 'toggle',
    //     'label' => __( 'Enable RTE', 'ninja-forms' ),
    //     'width' => 'one-half',
    //     'group' => 'rte',
    //     'value' => FALSE,
    //
    // ),

    // 'rte_media' => array(
    //     'name' => 'rte_media', // TODO was media_upload_button
    //     'type' => 'toggle',
    //     'label' => __( 'Enable Media Button', 'ninja-forms' ),
    //     'width' => 'one-half',
    //     'group' => 'rte',
    //     'value' => FALSE,
    //
    // ),

    // 'rte_mobile' => array(
    //     'name' => 'rte_mobile', // TODO was disable_moblile_rich_text_editor
    //     'type' => 'toggle',
    //     'label' => __( 'Mobile Friendly', 'ninja-forms' ),
    //     'width' => 'one-half',
    //     'group' => 'rte',
    //     'value' => FALSE,
    //
    // ),

   /*
    * Password Registration checkbox
    */

    'password_registration_checkbox' => array(
        'name' => 'password_registration_checkbox',
        'type' => 'checkbox',
        'value' => 'unchecked',
        'label' => __( 'Use this as a reistration password field. If this box is check, both
                        password and re-password textboxes will be output', 'ninja-forms' ),
        'width' => '',
        'group' => '',

    ),


   /*
    * Number of Stars Textbox
    */

    'number_of_stars' => array(
        'name' => 'number_of_stars',
        'type' => 'textbox',
        'value' => 5,
        'label' => __( 'Number of stars', 'ninja-forms' ),
        'width' => '',
        'group' => '',

    ),

   /*
    * Disable Browser Autocomplete
    */

    'disable_browser_autocomplete' => array(
        'name' => 'disable_browser_autocomplete',
        'type' => 'checkbox',
        'value' => 'unchecked',
        'label' => __( 'Disable Browser Autocomplete', 'ninja-forms' ),
        'width' => '',
        'group' => '',

    ),

    //TODO: Ask about the list of states and countries.
   /*
    *  Country - Use Custom First Option
    */

    'use_custom_first_option' => array(
        'name' => 'use_custom_first_option',
        'type' => 'checkbox',
        'value' => 'unchecked',
        'label' => __( 'Use a custom first option', 'ninja-forms' ),
        'width' => '',
        'group' => '',

    ),

   /*
    * Country - Custom first option
    */

    'custom_first_option' => array(
        'name' => 'custom_first_option',
        'type' => 'textbox',
        'label' => __( 'Custom first option', 'ninja-forms' ),
        'width' => '',
        'group' => '',
        'value' => FALSE,

    ),

    'type'         => array(
        'name'              => 'type',
        'type'              => 'select',
        'options'           => array(),
        'label'             => __( 'Type', 'ninja-forms' ),
        'width'             => 'full',
        'group'             => 'primary',
        'value'             => 'single',
    ),

    'fieldset' => array(
        'name' => 'fieldset',
        'type' => 'fieldset',
        'label' => __( 'Settings', 'ninja-forms' ),
        'width' => 'full',
        'group' => 'primary',
        'settings' => array(),
    ),

    /*
    |--------------------------------------------------------------------------
    | Submit Button Settings
    |--------------------------------------------------------------------------
    */

    'processing_label' => array(
        'name' => 'processing_label',
        'type' => 'textbox',
        'label' => __( 'Processing Label', 'ninja-forms' ),
        'width' => 'full',
        'group' => 'primary',
        'value' => __( 'Processing', 'ninja-forms' )
    ),

    /*
    |--------------------------------------------------------------------------
    | Pricing Fields Settings
    |--------------------------------------------------------------------------
    */

    'product_price' => array(
        'name' => 'product_price',
        'type' => 'textbox',
        'label' => __( 'Price', 'ninja-forms' ),
        'width' => 'one-half',
        'group' => 'primary',
        'value' => '0.00',
        'mask' => array(
            'type' => 'currency', // 'numeric', 'currency', 'custom'
            'options' => array()
        )
    ),

    'product_use_quantity' => array(
        'name' => 'product_use_quantity',
        'type' => 'toggle',
        'label' => __( 'Use Quantity', 'ninja-forms' ),
        'width' => 'one-half',
        'group' => 'primary',
        'value' => TRUE,

    ),

    'product_type' => array(
        'name' => 'product_type',
        'type' => 'select',
        'label' => __( 'Product Type', 'ninja-forms' ),
        'width' => 'full',
        'group' => 'advanced',
        'options' => array(
            array(
                'label' => __( 'Single Product (default)', 'ninja-forms' ),
                'value' => 'single'
            ),
            array(
                'label' => __( 'Multi Product - Dropdown', 'ninja-forms' ),
                'value' => 'dropdown'
            ),
            array(
                'label' => __( 'Multi Product - Choose Many', 'ninja-forms' ),
                'value' => 'checkboxes'
            ),
            array(
                'label' => __( 'Multi Product - Choose One', 'ninja-forms' ),
                'value' => 'radiolist'
            ),
            array(
                'label' => __( 'User Entry', 'ninja-forms' ),
                'value' => 'user'
            ),
            array(
                'label' => __( 'Hidden', 'ninja-forms' ),
                'value' => 'hidden'
            ),
        ),
        'value' => 'single',
        'use_merge_tags' => FALSE
    ),

    'shipping_cost'         => array(
        'name'              => 'shipping_cost',
        'type'              => 'textbox',
        'label'             => __( 'Cost', 'ninja-forms' ),
        'width'             => 'full',
        'group'             => 'primary',
        'value'             => '0.00',
        'mask' => array(
            'type' => 'currency', // 'numeric', 'currency', 'custom'
            'options' => array()
        ),
        'deps'              => array(
            'shipping_type' => 'single',
        ),
    ),

    'shipping_options'      => array(
        'name'              => 'shipping_options',
        'type'              => 'option-repeater',
        'label'             => __( 'Cost Options', 'ninja-forms' ) . ' <a href="#" class="nf-add-new">' . __( 'Add New', 'ninja-forms' ) . '</a>',
        'width'             => 'full',
        'group'             => 'primary',
        'value'             => array(
            array( 'label'  => 'One', 'value' => '1.00', 'order' => 0 ),
            array( 'label'  => 'Two', 'value' => '2.00', 'order' => 1 ),
            array( 'label'  => 'Three', 'value' => '3.00', 'order' => 2 ),
        ),
         'columns'          => array( 
            'label'         => array(
                'header'    => __( 'Label', 'ninja-forms' ),
                'default'   => '',
            ),
            
            'value'         => array(
                'header'    => __( 'Value', 'ninja-forms' ),
                'default'   => '',
            ),
        ),
        'deps'              => array(
            'shipping_type' => 'select'
        ),
    ),

    'shipping_type'         => array(
        'name'              => 'shipping_type',
        'type'              => 'select',
        'options'           => array(
            array(
                'label'     => __( 'Single Cost', 'ninja-forms' ),
                'value'     => 'single',
            ),
            array(
                'label'     => __( 'Cost Dropdown', 'ninja-forms' ),
                'value'     => 'select',
            ),
        ),
        'label'             => __( 'Cost Type', 'ninja-forms' ),
        'width'             => 'full',
        'group'             => 'primary',
        'value'             => 'single',
    ),

    'product_assignment'      => array(
        'name'              => 'product_assignment',
        'type'              => 'select',
        'label'             => __( 'Product', 'ninja-forms' ),
        'width'             => 'full',
        'group'             => 'primary',
        'options'           => array(),
        'select_product'    => array(
            'value'         => '',
            'label'         => __( '- Select a Product', 'ninja-forms' ),
        ),
    ),

));


// Example of settings

// Add all core settings. Fields can unset if unneeded.
// $this->_settings = $this->load_settings(
//     array( 'label', 'label_pos', 'required', 'number', 'spam_question', 'mask', 'input_limit_set','rich_text_editor', 'placeholder', 'textare_placeholder', 'default', 'checkbox_default_value', 'classes', 'timed_submit' )
// );
