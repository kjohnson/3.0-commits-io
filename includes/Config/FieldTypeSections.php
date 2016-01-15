<?php if ( ! defined( 'ABSPATH' ) ) exit;

return apply_filters( 'ninja-forms-field-type-sections', array(

    /*
    |--------------------------------------------------------------------------
    | Common Fields
    |--------------------------------------------------------------------------
    */

    'common' => array(
        'id' => 'common',
        'nicename' => __( 'Common Fields', 'ninja-forms' ),
        'fieldTypes' => array(),
    ),

    /*
    |--------------------------------------------------------------------------
    | User Information Fields
    |--------------------------------------------------------------------------
    */

    'userinfo' => array(
        'id' => 'userinfo',
        'nicename' => __( 'User Information Fields', 'ninja-forms' ),
        'fieldTypes' => array(),
    ),

    /*
    |--------------------------------------------------------------------------
    | Pricing Fields
    |--------------------------------------------------------------------------
    */

    'pricing' => array(
        'id' => 'pricing',
        'nicename' => __( 'Pricing Fields', 'ninja-forms' ),
        'fieldTypes' => array(),
    ),

    /*
    |--------------------------------------------------------------------------
    | Layout Fields
    |--------------------------------------------------------------------------
    */

    'layout' => array(
        'id' => 'layout',
        'nicename' => __( 'Layout Fields', 'ninja-forms' ),
        'fieldTypes' => array(),
    ),

    /*
    |--------------------------------------------------------------------------
    | Miscellaneous Fields
    |--------------------------------------------------------------------------
    */

    'misc' => array(
        'id' => 'misc',
        'nicename' => __( 'Miscellaneous Fields', 'ninja-forms' ),
        'fieldTypes' => array(),
    ),
));
