<?php if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Class NF_Fields_StarRating
 */
class NF_Fields_StarRating extends NF_Abstracts_Input
{
    protected $_name = 'star-rating';

    protected $_section = 'misc';

    protected $_aliases = array( 'rating' );

    protected $_type = 'rating';

    protected $_templates = 'starrating';

    protected $_settings_only = array( 'label', 'label_pos', 'default', 'required', 'classes' );

    public function __construct()
    {
        parent::__construct();

        $this->_settings[ 'default' ][ 'group' ] = 'primary';

        $this->_settings[ 'default' ][ 'label' ] = __( 'Number of Stars', 'ninja-forms' );

        $this->_settings[ 'default' ][ 'width' ] = 'one-half';

        $this->_settings[ 'default' ][ 'use_merge_tags' ] = FALSE;

        $this->_nicename = __( 'Star Rating', 'ninja-forms' );
    }

}