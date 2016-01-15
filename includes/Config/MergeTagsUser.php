<?php if ( ! defined( 'ABSPATH' ) ) exit;

return apply_filters( 'ninja-forms-merge-tags-user', array(

    /*
    |--------------------------------------------------------------------------
    | User First Name
    |--------------------------------------------------------------------------
    */

    'firstname' => array(
        'id' => 'firstname',
        'tag' => '{user:firstname}',
        'label' => __( 'First Name', 'ninja_forms' ),
        'callback' => 'user_firstname'
    ),

    /*
    |--------------------------------------------------------------------------
    | User Last Name
    |--------------------------------------------------------------------------
    */

    'lastname' => array(
        'id' => 'lastname',
        'tag' => '{user:lastname}',
        'label' => __( 'Last Name', 'ninja_forms' ),
        'callback' => 'user_lastname'
    ),

    /*
    |--------------------------------------------------------------------------
    | User Email Address
    |--------------------------------------------------------------------------
    */

    'email' => array(
        'id' => 'email',
        'tag' => '{user:email}',
        'label' => __( 'Email', 'ninja_forms' ),
        'callback' => 'user_email'
    ),

));