<?php if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Class NF_Fields_CreditCardZip
 */
class NF_Fields_CreditCardZip extends NF_Fields_Zip
{
    protected $_name = 'creditcardzip';

    protected $_section = '';

    protected $_templates = array( 'zip', 'textbox' );

    public function __construct()
    {
        parent::__construct();

        $this->_nicename = __( 'Credit Card Zip', 'ninja-forms' );
    }
}
