<?php if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Class NF_Abstracts_ActionNewsletter
 */
abstract class NF_Abstracts_ActionNewsletter extends NF_Abstracts_Action
{
    /**
     * @var array
     */
    protected $_tags = array( 'newsletter' );

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
    }

    /*
    * PUBLIC METHODS
    */

    public function save()
    {

    }

    public function process( $action_settings, $form_id, $data )
    {

    }
}
