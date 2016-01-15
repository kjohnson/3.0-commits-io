<?php if ( ! defined( 'ABSPATH' ) ) exit;

abstract class NF_Abstracts_Metabox
{
    protected $_id = ''; // Dynamically set in constructor using the class name.

    protected $_title = ''; // Should be set (and translated) in the constructor.

    protected $_callback = 'render_metabox';

    protected $_post_types = array();

    protected $_context = 'side';

    protected $_priority = 'default';

    protected $_callback_args = array();

    protected $_capability = 'edit_post';

    public function __construct()
    {
        if( ! isset( $_GET[ 'post' ] ) ) return;

        $this->_id = strtolower( get_class( $this ) );
        $this->_title = __( 'Metabox', 'ninja-forms' );

        add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
        add_action( 'save_post', array( $this, '_save_post' ) );
    }

    public function add_meta_boxes()
    {
        add_meta_box(
            $this->_id,
            $this->_title,
            array( $this, $this->_callback ),
            $this->_post_types,
            $this->_context,
            $this->_priority,
            $this->_callback_args
        );
    }

    abstract public function render_metabox( $post, $metabox );

    public function _save_post( $post_id )
    {
        $nonce = 'myplugin_meta_box_nonce';

        // Check if our nonce is set.
        if ( ! isset( $_POST[ $nonce ] ) ) return;

        // Verify that the nonce is valid.
        if ( ! wp_verify_nonce( $_POST[ $nonce ], $nonce ) ) return;

        // If this is an autosave, our form has not been submitted, so we don't want to do anything.
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

        // Check Post Type
        if ( ! isset( $_POST['post_type'] ) ||  'nf_sub' != $_POST['post_type'] ) return;

        // TODO: Maybe update with Ninja Forms specific capabilities.
        if ( ! current_user_can( $this->_capability, $post_id ) ) return;

        /* OK, it's safe for us to save the data now. */

        // TODO: Make sure that it is set.

        // TODO: Sanitize user input.

        $this->save_post( $post_id );
    }

    protected function save_post( $post_id )
    {
        // This section intentionally left blank.
    }
}