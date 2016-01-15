<?php if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Class NF_Abstracts_FieldOptIn
 */
class NF_Abstracts_FieldOptIn extends NF_Abstracts_Input
{
    protected $_name = 'optin';

    protected $_section = 'misc';

    protected $_type = 'optin';

    protected $_templates = 'optin';

    protected $_settings = array( 'type', 'fieldset' );

    protected $_settings_exclude = array( 'required', 'placeholder' );

    protected $_lists = array();

    public function __construct()
    {
        parent::__construct();

        $this->_settings[ 'type' ][ 'options' ] = array(
            array(
                'label'     => __( 'Single', 'ninja-forms' ),
                'value'     => 'single',
            ),
            array(
                'label'     => __( 'Multiple', 'ninja-forms' ),
                'value'     => 'multiple',
            ),
        );

        $this->_settings[ 'fieldset' ][ 'label' ] = __( 'Lists', 'ninja-forms' ) . ' <a href="#"><small>' . __( 'refresh', 'ninja-forms' ) . '</small></a>';
        $this->_settings[ 'fieldset' ][ 'deps' ] = array( 'type' => 'multiple' );
    }

    protected function addList( $name, $label )
    {
        $this->_settings[ 'fieldset' ][ 'settings' ][] = array(
            'name' => $name,
            'type' => 'toggle',
            'label' => $label,
            'width' => 'full',
            'value' => ''
        );
    }

    protected function addLists( array $lists = array() )
    {
        if( empty( $lists ) ) return;

        foreach( $lists as $name => $label ){
            $this->addList( $name, $label );
        }
    }

}