<?php if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Class NF_Action_Save
 */
final class NF_Actions_Save extends NF_Abstracts_Action
{
    /**
    * @var string
    */
    protected $_name  = 'save';

    /**
    * @var array
    */
    protected $_tags = array();

    /**
    * @var string
    */
    protected $_timing = 'normal';

    /**
    * @var int
    */
    protected $_priority = '10';

    /**
    * Constructor
    */
    public function __construct()
    {
        parent::__construct();

        $this->_nicename = __( 'Save', 'ninja-forms' );
    }

    /*
    * PUBLIC METHODS
    */

    public function save()
    {

    }

    public function process( $action_settings, $form_id, $data )
    {
        if( isset( $data['settings']['is_preview'] ) && $data['settings']['is_preview'] ){
            return $data;
        }

        $sub = Ninja_Forms()->form( $form_id )->sub()->get();

        foreach( $data['fields'] as $field ){

            $sub->update_field_value( $field['id'], $field['value'] );
        }

        $sub->save();
    }
}
