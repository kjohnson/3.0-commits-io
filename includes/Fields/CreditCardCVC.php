<?php if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Class NF_Fields_CreditCardCVC
 */
class NF_Fields_CreditCardCVC extends NF_Abstracts_Input
{
    protected $_name = 'creditcardcvc';

    protected $_section = '';

    protected $_templates = 'textbox';

    protected $_test_value = '1234';

    public function __construct()
    {
        parent::__construct();

        $this->_nicename = __( 'Credit Card CVC', 'ninja-forms' );
    }
}
