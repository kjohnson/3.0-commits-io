<?php if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Class NF_Fields_CreditCardFullName
 */
class NF_Fields_CreditCardFullName extends NF_Abstracts_Input
{
    protected $_name = 'creditcardfullname';

    protected $_section = '';

    protected $_templates = 'textbox';

    protected $_test_value = 'Tester T. Test';

    public function __construct()
    {
        parent::__construct();

        $this->_nicename = __( 'Credit Card Full Name', 'ninja-forms' );
    }
}
