<?php if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Class NF_Fields_HTML
 */
class NF_Fields_HTML extends NF_Abstracts_Input
{
    protected $_name = 'html';

    protected $_section = 'misc';

    protected $_aliases = array( 'html' );

    protected $_type = 'html';

    protected $_templates = 'html';

    protected $_settings_only = array( 'label', 'label_pos', 'default', 'classes' );

    public function __construct()
    {
        parent::__construct();

        $this->_settings[ 'default' ][ 'group' ] = 'primary';
        $this->_settings[ 'default' ][ 'type' ]  = 'textarea';
        $this->_settings[ 'default' ][ 'use_merge_tags' ]  = array(
            'include' => array(
                'calcs'
            ),
        );

        $this->_nicename = __( 'HTML', 'ninja-forms' );
    }

}