<?php if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Class NF_Abstracts_List
 */
abstract class NF_Abstracts_List extends NF_Abstracts_Field
{
    protected $_name = '';

    protected $_section = 'common';

    protected $_type = 'list';

    protected $_test_value = FALSE;

    public static $_base_template = 'list';

    public function __construct()
    {
        parent::__construct();

        $this->_settings = $this->load_settings(
            array( 'key', 'label', 'label_pos', 'required', 'options', 'classes' )
        );

        add_filter( 'ninja_forms_custom_columns', array( $this, 'custom_columns' ), 10, 2 );
    }

    public function get_parent_type()
    {
        return parent::get_type();
    }

    public function admin_form_element( $id, $value )
    {
        $field = Ninja_Forms()->form()->get_field( $id );

        $options = '<option>--</option>';
        foreach( $field->get_setting( 'options' ) as $option ){
            $selected = ( $value == $option[ 'value' ] ) ? "selected" : '';
            $options .= "<option value='{$option[ 'value' ]}' $selected>{$option[ 'label' ]}</option>";
        }

        return "<select class='widefat' name='fields[$id]' id=''>$options</select>";
    }

    public function custom_columns( $value, $field )
    {
        if( $this->_name != $field->get_setting( 'type' ) ) return $value;

        if( ! is_array( $value ) ) $value = array( $value );

        $output = '';
        $options = $field->get_setting( 'options' );
        foreach( $options as $option ){

            if( ! in_array( $option[ 'value'], $value ) ) continue;

            $output .= $option[ 'label' ] . "<br />";
        }

        return $output;
    }
}
