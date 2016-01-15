<?php if ( ! defined( 'ABSPATH' ) ) exit;

return apply_filters( 'ninja-forms-from-calculation-settings', array(

    /*
    * Calculation
    */

    'calculations' => array(
        'name' => 'calculations',
        'type' => 'option-repeater',
        'label' => ' <a href="#" class="nf-add-new">' . __( 'Add New', 'ninja-forms' ) . '</a>',
        'width' => 'full',
        'group' => 'primary',
        'tmpl_row' => 'nf-tmpl-edit-setting-calculation-repeater-row',
        'columns' => array(
            'var_name'      => array(
                'header'    => __( 'Variable Name', 'ninja-forms' ),
                'default'   => '',
            ),
            'eq'            => array(
                'header'    => __( 'Equation', 'ninja-forms' ),
                'default'   => '',
            ),
        ),
        
    ),


));