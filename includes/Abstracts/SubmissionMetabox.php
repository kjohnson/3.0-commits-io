<?php if ( ! defined( 'ABSPATH' ) ) exit;

abstract class NF_Abstracts_SubmissionMetabox extends NF_Abstracts_Metabox
{
    protected $_post_types = array( 'nf_sub' );

    public function __construct()
    {
        parent::__construct();

        if( ! isset( $_GET[ 'post' ] ) ) return;

        $this->_title = __( 'Submission Metabox', 'ninja-forms' );

        $post_id = absint( $_GET[ 'post' ] );

        $this->_callback_args[ 'sub' ] = Ninja_Forms()->form()->get_sub( $post_id );
        
        add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
        add_action( 'save_post', array( $this, '_save_post' ) );
    }

    protected function get_field_values()
    {
        return $this->_callback_args[ 'sub' ]->get_field_values();
    }
}