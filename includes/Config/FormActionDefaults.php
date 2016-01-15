<?php if ( ! defined( 'ABSPATH' ) ) exit;

return apply_filters( 'ninja-forms-from-display-settings', array(

    array(
        'id'      => 'tmp-1',
        'label'   => 'Success Message',
        'type'    => 'successmessage',
        'message' => 'This is a default success message',
        'order'   => 1,
        'active'  => TRUE,
    ),

    array(
        'id'      => 'tmp-2',
        'label'   => 'Admin Email',
        'type'    => 'email',
        'to'      => array( 'myformbuildingbringsallthedeveloperstotheyard@wpninjas.com' ),
        'subject' => 'This is an email action.',
        'message' => 'Hello, Ninja Forms!',
        'order'   => 2,
        'active'  => TRUE,
    ),

    array(
        'id'    => 'tmp-3',
        'label' => 'Save Submission',
        'type'  => 'save',
        'order' => 3,
        'active'=> TRUE,
    ),

));