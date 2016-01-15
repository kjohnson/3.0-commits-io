<?php if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Class NF_Abstracts_Action
 */
abstract class NF_Abstracts_Action
{
    /**
     * @var string
     */
    protected $_name  = '';

    /**
     * @var string
     */
    protected $_nicename = '';

    /**
     * @var string
     */
    protected $_section = 'installed';

    /**
     * @var string
     */
    protected $_image = '';

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
     * @var array
     */
    protected $_settings = array();

    /**
     * Constructor
     */
    public function __construct()
    {
        // Loads a settings array from the ActionSettings configuration file.
        $this->_settings = Ninja_Forms::config( 'ActionSettings' );
    }

    //-----------------------------------------------------
    // Public Methods
    //-----------------------------------------------------

    /**
     * Save
     */
    public function save()
    {
        // This section intentionally left blank.
    }

    /**
     * Process
     */
    public abstract function process( $action_id, $form_id, $data );

    /**
     * Get Timing
     *
     * Returns the timing for an action.
     *
     * @return mixed
     */
    public function get_timing()
    {
        $timing = array( 'early' => '1', 'normal' => '0', 'late' => '-1' );

        return $timing[ $this->_timing ];
    }

    /**
     * Get Priority
     *
     * Returns the priority for an action.
     *
     * @return int
     */
    public function get_priority()
    {
        return $this->_priority;
    }

    /**
     * Get Name
     *
     * Returns the name of an action.
     *
     * @return string
     */
    public function get_name()
    {
        return $this->_name;
    }

    /**
     * Get Nicename
     *
     * Returns the nicename of an action.
     *
     * @return string
     */
    public function get_nicename()
    {
        return $this->_nicename;
    }

    /**
     * Get Section
     *
     * Returns the drawer section for an action.
     *
     * @return string
     */
    public function get_section()
    {
        return $this->_section;
    }

    /**
     * Get Image
     *
     * Returns the url of a branded action's image.
     *
     * @return string
     */
    public function get_image()
    {
        return $this->_image;
    }

    /**
     * Get Settings
     *
     * Returns the settings for an action.
     *
     * @return array|mixed
     */
    public function get_settings()
    {
        return $this->_settings;
    }

    /**
     * Sort Actions
     *
     * A static method for sorting two actions by timing, then priority.
     *
     * @param $a
     * @param $b
     * @return int
     */
    public static function sort_actions( $a, $b )
    {
        if( ! isset( Ninja_Forms()->actions[ $a->get_setting( 'type' ) ] ) ) return 1;

        $a->timing   = Ninja_Forms()->actions[ $a->get_setting( 'type' ) ]->get_timing();
        $a->priority = Ninja_Forms()->actions[ $a->get_setting( 'type' ) ]->get_priority();

        $b->timing   = Ninja_Forms()->actions[ $b->get_setting( 'type' ) ]->get_timing();
        $b->priority = Ninja_Forms()->actions[ $b->get_setting( 'type' ) ]->get_priority();

        // Compare Priority if Timing is the same
        if( $a->timing == $b->timing)
            return $a->priority > $b->priority ? 1 : -1;

        // Compare Timing
        return $a->timing < $b->timing ? 1 : -1;
    }

} // END CLASS NF_Abstracts_Action
