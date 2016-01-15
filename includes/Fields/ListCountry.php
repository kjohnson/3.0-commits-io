<?php if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Class NF_Fields_CountryList
 */
class NF_Fields_ListCountry extends NF_Abstracts_List
{
    protected $_name = 'listcountry';

    protected $_nicename = 'Country';

    protected $_section = 'userinfo';

    protected $_templates = 'listcountry';

    public function __construct()
    {
        parent::__construct();

        $this->_nicename = __( 'Country', 'ninja-forms' );
    }
}
