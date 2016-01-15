<?php if ( ! defined( 'ABSPATH' ) ) exit;

return apply_filters( 'ninja-forms-from-settings-types', array(

    'display' 			=> array(
        'id' 			=> 'display',
        'nicename' 		=> __( 'Display Settings', 'ninja-forms' ),
    ),

    'restrictions' 		=> array(
        'id' 			=> 'restrictions',
        'nicename' 		=> __( 'Restrictions', 'ninja-forms' )
    ),

    'calculations' 		=> array(
    	'id' 			=> 'calculations',
    	'nicename' 		=> __( 'Calculations', 'ninja-forms')
    ),

));
