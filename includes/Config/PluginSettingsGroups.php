<?php if ( ! defined( 'ABSPATH' ) ) exit;

return apply_filters( 'ninja-forms-plugin-settings-groups', array(

    'general' => array(
        'id' => 'general',
        'label' => __( 'General Settings', 'ninja-forms' ),
    ),

    'recaptcha' => array(
        'id' => 'recaptcha',
        'label' => __( 'reCaptcha Settings', 'ninja-forms' ),
    ),

    'advanced' => array(
        'id' => 'advanced',
        'label' => __( 'Advanced Settings', 'ninja-forms' ),
    ),

));
