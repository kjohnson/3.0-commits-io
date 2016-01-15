<?php if ( ! defined( 'ABSPATH' ) ) exit;

return apply_filters( 'ninja-forms-from-restriction-settings', array(

    'logged-in-set' => array(
        'name'    => 'logged-in-set',
        'type'    => 'fieldset',
        'label'   => __( 'Logged In', 'ninja-forms' ),
        'width' => 'full',
        'group' => 'primary',
        'settings' => array(

            /*
             * REQUIRE USER TO BE LOGGED IN TO VIEW FORM?
             */

            'require_user_logged_in_to_view_form' => array(
                'name' => 'require_user_logged_in_to_view_form',
                'type' => 'toggle',
                'label' => __( 'Require user to be logged in to view form?', 'ninja-forms' ),
                'width' => 'one-half',
                'group' => 'primary',
                'value' => TRUE,
                
            ),

            /*
             * NOT LOGGED-IN MESSAGE
             */

            'not_logged_in_message' => array(
                'name' => 'not_logged_in_message',
                'type' => 'textarea', //TODO: Add WYSIWYG
                'label' => __( 'Not Logged-In Message', 'ninja-forms' ),
                'width' => 'full',
                'group' => 'primary',
                'value' => '',
                
                //TODO: Add following text below the WYSIWYG.
                //Message shown to users if the "logged in" checkbox above is checked and they are not logged-in.
            ),
        )
    ),

    'limit-submissions-set' => array(
        'name'    => 'limit-submissions-set',
        'type'    => 'fieldset',
        'label'   => __( 'Limit Submissions', 'ninja-forms' ),
        'width' => 'full',
        'group' => 'primary',
        'settings' => array(

            /*
             * LIMIT SUBMISSIONS
             */

            'limit_submissions' => array(
                'name' => 'limit_submissions',
                'type' => 'number',
                'label' => __( 'Limit Submission', 'ninja-forms' ),
                'width' => 'one-third',
                'group' => 'primary',
                'value' => NULL,
                
                //TODO: Add following text below the element.
                //Select the number of submissions that this form will accept. Leave empty for no limit.
            ),

            /*
             * LIMIT REACHED MESSAGE
             */

            'limit_reached_message' => array(
                'name' => 'limit_reached_message',
                'type' => 'textarea',//TODO: Add WYSIWYG
                'label' => __( 'Limit Reached Message', 'ninja-forms' ),
                'width' => 'full',
                'group' => 'primary',
                'value' => '',
                
                //TODO: Add following text below the WYSIWYG.
                //Please enter a message that you want displayed when this form has reached its submission limit and will not
                //accept new submissions.
            ),
        )
    ),

));
