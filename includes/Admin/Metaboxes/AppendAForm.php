<?php if ( ! defined( 'ABSPATH' ) ) exit;

final class NF_Admin_Metaboxes_AppendAForm extends NF_Abstracts_Metabox
{
    protected $_post_types = array( 'post', 'page' );

    public function __construct()
    {
        parent::__construct();

        $this->_title = __( 'Append a Ninja Forms', 'ninja-forms' );
    }

    protected function save_post( $post_id )
    {
        // TODO: Save
    }

    public function render_metabox( $post, $metabox )
    {
        $forms = Ninja_Forms()->form()->get_forms();

        Ninja_Forms()->template( 'admin-metabox-append-a-form.html.php', compact( 'forms' ) );
    }
}