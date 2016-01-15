<?php if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Class NF_Fields_CreditCardExpiration
 */
class NF_Fields_CreditCardExpiration extends NF_Abstracts_Input
{
    protected $_name = 'creditcardexpiration';

    protected $_section = '';

    protected $_templates = 'textbox';

    protected $_test_value = '01/2025';

    public function __construct()
    {
        parent::__construct();

        $this->_nicename = __( 'Credit Card Expiration', 'ninja-forms' );
    }
}
