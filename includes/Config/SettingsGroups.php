<?php if ( ! defined( 'ABSPATH' ) ) exit;

return apply_filters( 'ninja_forms_field_settings_groups', array(

    'primary' => array(
        'id' => 'primary',
        'label' => '',
        'display' => TRUE,
        'priority' => 100
    ),

    'rte' => array(
        'id' => 'rte',
        'label' => __( 'Rich Text Editor (RTE)', 'ninja-forms' )
    ),

    'restrictions' => array(
        'id' => 'restrictions',
        'label' => __( 'Restrictions', 'ninja-forms' )
    ),

    'advanced' => array(
        'id' => 'advanced',
        'label' => __( 'Advanced', 'ninja-forms' ),
        'priority' => 800
    ),

    'administration' => array(
        'id' => 'administration',
        'label' => __( 'Administration', 'ninja-forms' ),
        'priority' => 900
    )

));
