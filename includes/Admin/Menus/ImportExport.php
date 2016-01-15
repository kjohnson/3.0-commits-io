<?php if ( ! defined( 'ABSPATH' ) ) exit;

final class NF_Admin_Menus_ImportExport extends NF_Abstracts_Submenu
{
    public $parent_slug = 'ninja-forms';

    public $page_title = 'Import / Export';

    public function __construct()
    {
        add_action( 'plugins_loaded', array( $this, 'import_form_listener' ) );
        add_action( 'plugins_loaded', array( $this, 'export_form_listener' ) );

        parent::__construct();
    }

    public function import_form_listener()
    {
        if( isset( $_FILES[ 'nf_import_form' ] ) && $_FILES[ 'nf_import_form' ] ){

            $import = file_get_contents( $_FILES[ 'nf_import_form' ][ 'tmp_name' ] );

            $import = unserialize( base64_decode( $import ) );

            Ninja_Forms()->form()->import_form( $import );
        }
    }

    public function export_form_listener()
    {
        if( isset( $_REQUEST[ 'nf_export_form' ] ) && $_REQUEST[ 'nf_export_form' ] ){
            $form_id = $_REQUEST[ 'nf_export_form' ];
            Ninja_Forms()->form( $form_id )->export_form();
        }
    }

    public function display()
    {
        $tabs = apply_filters( 'nf-import-export-tabs', array(
            'forms' => __( 'Form', 'ninja-forms' ),
            'favorite_fields' => __( 'Favorite Fields', 'ninja-forms' )
            )
        );

        $tab_keys = array_keys( $tabs );
        $active_tab = ( isset( $_GET[ 'tab' ] ) ) ? $_GET[ 'tab' ] : reset( $tab_keys );

        $this->add_meta_boxes();

        wp_enqueue_script('postbox');
        wp_enqueue_script('jquery-ui-draggable');

        wp_nonce_field( 'closedpostboxes', 'closedpostboxesnonce', false );
        wp_nonce_field( 'meta-box-order', 'meta-box-order-nonce', false );

        Ninja_Forms::template( 'admin-menu-import-export.html.php', compact( 'tabs', 'active_tab' ) );
    }

    public function add_meta_boxes()
    {
        /*
         * Forms
         */
        add_meta_box(
            'nf_import_export_forms_import',
            __( 'Import Forms', 'ninja-forms' ),
            array( $this, 'template_import_forms' ),
            'nf_import_export_forms'
        );

        add_meta_box(
            'nf_import_export_forms_export',
            __( 'Export Forms', 'ninja-forms' ),
            array( $this, 'template_export_forms' ),
            'nf_import_export_forms'
        );

        /*
         * FAVORITE FIELDS
         */
        add_meta_box(
            'nf_import_export_favorite_fields_import',
            __( 'Import Favorite Fields', 'ninja-forms' ),
            array( $this, 'template_import_favorite_fields' ),
            'nf_import_export_favorite_fields'
        );

        add_meta_box(
            'nf_import_export_favorite_fields_export',
            __( 'Export Favorite Fields', 'ninja-forms' ),
            array( $this, 'template_export_favorite_fields' ),
            'nf_import_export_favorite_fields'
        );
    }

    public function template_import_forms()
    {
        Ninja_Forms::template( 'admin-metabox-import-export-forms-import.html.php' );
    }

    public function template_export_forms()
    {
        $forms = Ninja_Forms()->form()->get_forms();
        Ninja_Forms::template( 'admin-metabox-import-export-forms-export.html.php', compact( 'forms' ) );
    }

    public function template_import_favorite_fields()
    {
        Ninja_Forms::template( 'admin-metabox-import-export-favorite-fields-import.html.php' );
    }

    public function template_export_favorite_fields()
    {
        Ninja_Forms::template( 'admin-metabox-import-export-favorite-fields-export.html.php' );
    }
}
