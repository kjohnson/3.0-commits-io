<?php if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Class NF_Action_Email
 */
final class NF_Actions_Email extends NF_Abstracts_Action
{
    /**
    * @var string
    */
    protected $_name  = 'email';

    /**
    * @var array
    */
    protected $_tags = array();

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

        $this->_nicename = __( 'Email', 'ninja-forms' );

        $settings = Ninja_Forms::config( 'ActionEmailSettings' );

        $this->_settings = array_merge( $this->_settings, $settings );
    }

    /*
    * PUBLIC METHODS
    */

    public function save()
    {

    }

    public function process( $action_settings, $form_id, $data )
    {
        wp_mail(
            $action_settings['to'],
            $action_settings['subject'],
            $action_settings['message']
        );
    }
}
