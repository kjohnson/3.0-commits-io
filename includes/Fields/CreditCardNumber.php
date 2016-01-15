<?php if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Class NF_Fields_CreditCardNumber
 */
class NF_Fields_CreditCardNumber extends NF_Abstracts_Input
{
    protected $_name = 'creditcardnumber';

    protected $_section = '';

    protected $_templates = 'textbox';

    protected $_test_value = '4242424242424242';

    protected $_settings_exclude = array( 'default' );

    public function __construct()
    {
        parent::__construct();

        $this->_nicename = __( 'Credit Card Number', 'ninja-forms' );
    }
}
