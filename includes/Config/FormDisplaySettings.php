<?php if ( ! defined( 'ABSPATH' ) ) exit;

return apply_filters( 'ninja-forms-from-display-settings', array(

    /*
    * FORM TITLE
    */

    'title' => array(
        'name' => 'title',
        'type' => 'textbox',
        'label' => __( 'Form Title', 'ninja-forms' ),
        'width' => 'full',
        'group' => 'primary',
        'value' => '',
        
    ),

    /*
    * DISPLAY FORM TITLE
    */

    'display_form_title' => array(
        'name' => 'display_form_title',
        'type' => 'toggle',
        'label' => __( 'Display Form Title', 'ninja-forms' ),
        'width' => 'full',
        'group' => 'primary',
        'value' => TRUE,
        
    ),

    /*
    * CLEAR SUCCESSFULLY COMPLETED FORM
    */

    'clear_successfully_created_form' => array(
        'name' => 'clear_successfully_created_form',
        'type' => 'toggle',
        'label' => __( 'Clear successfully completed form?', 'ninja-forms' ),
        'width' => 'full',
        'group' => 'primary',
        'value' => TRUE,
        
        //TODO: Add following text below the element.
        //If this box is checked, Ninja Forms will clear the form values after it has been successfully submitted.
    ),

    /*
    * HIDE SUCCESSFULLY COMPLETED FORMS
    */

    'hide_successfully_completed_form' => array(
        'name' => 'hide_successfully_completed_form',
        'type' => 'toggle',
        'label' => __( 'Hide successfully completed forms?', 'ninja-forms' ),
        'width' => 'full',
        'group' => 'primary',
        'value' => TRUE,
        
        //TODO: Add following text below the element.
        //If this box is checked, Ninja Forms will hide the form after it has been successfully submitted.
    ),

    /*
     * Currency
     */

    'currency' => array(
        'name' => 'currency',
        'type' => 'select',
        'label' => __( 'Currency', 'ninja-forms' ),
        'group' => 'advanced',
        'width' => 'full',
        'options' => array(
            array(
                'label' => __( 'USD - $', 'ninja-forms' ),
                'value' => 'usd'
            ),
        ),
        'value' => 'usd',
        'use_merge_tags' => FALSE
    ),

));
