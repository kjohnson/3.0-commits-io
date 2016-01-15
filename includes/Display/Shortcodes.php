<?php

final class NF_Display_Shortcodes
{
    public function __construct()
    {
        add_shortcode( 'ninja_form',  array( $this, 'display_form_front_end' ) );
        add_shortcode( 'ninja_forms', array( $this, 'display_form_front_end' ) );
    }

    public function display_form_front_end( array $atts = array() )
    {
        if( ! isset( $atts[ 'id' ] ) ) return;

        ob_start();
        Ninja_Forms()->display( $atts['id'] );
        return ob_get_clean();
    }

}
