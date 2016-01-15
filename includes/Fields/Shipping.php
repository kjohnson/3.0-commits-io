<?php if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Class NF_Field_Shipping
 */
class NF_Fields_Shipping extends NF_Abstracts_Input
{
    protected $_name = 'shipping';

    protected $_section = 'pricing';

    protected $_aliases = array();

    protected $_type = 'textbox';

    protected $_templates = 'shipping';

    protected $_test_value = '0.00';

    protected $_settings =  array( 'shipping_type', 'shipping_cost', 'shipping_options' );

    public function __construct()
    {
        parent::__construct();

        $this->_nicename = __( 'Shipping', 'ninja-forms' );

        add_filter( 'ninja-forms-field-settings-groups', array( $this, 'add_setting_group' ) );
    }

    public function add_setting_group( $groups )
    {
        $groups[ 'advanced_shipping' ] = array(
            'id' => 'advanced_shipping',
            'label' => __( 'Advanced Shipping', 'ninja-forms' ),
        );

        return $groups;
    }

    public function admin_form_element( $id, $value )
    {
        $field = Ninja_Forms()->form()->get_field( $id );

        $value = $field->get_setting( 'shipping_cost' );

        switch( $field->get_setting( 'shipping_type' ) ){
            case 'single':

                return "<input class='widefat' name='fields[$id]' value='$value' />";

            case 'select':

                $options = '<option>--</option>';
                foreach( $field->get_setting( 'shipping_options' ) as $option ){
                    $selected = ( $value == $option[ 'value' ] ) ? "selected" : '';
                    $options .= "<option value='{$option[ 'value' ]}' $selected>{$option[ 'label' ]}</option>";
                }

                return "<select class='widefat' name='fields[$id]' id=''>$options</select>";

            default:
                return "";
        }
    }
}
