<?php if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Class NF_Fields_ProductQuantity
 */
class NF_Fields_Quantity extends NF_Fields_Number
{
    protected $_name = 'quantity';

    protected $_section = 'pricing';

    protected $_aliases = array();

    protected $_type = 'number';

    protected $_templates = 'number';

    protected $_test_value = 'Lorem ipsum';

    protected $_settings = array( 'product_assignment', 'number' );

    protected $_settings_exclude = array( 'required' );

    public function __construct()
    {
        parent::__construct();

        $this->_nicename = __( 'Quantity', 'ninja-forms' );
    }
}
