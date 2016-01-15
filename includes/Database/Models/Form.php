<?php if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Class NF_Database_Models_Form
 */
final class NF_Database_Models_Form extends NF_Abstracts_Model
{
    protected $_type = 'form';

    protected $_table_name = 'ninja_forms_forms';

    protected $_meta_table_name = 'ninja_forms_form_meta';

    protected $_columns = array(
        'title',
        'created_at'
    );

    protected $_fields;

    public function __construct( $db, $id = '' )
    {
        add_action( 'nf_before_import_form', array( $this, 'import_form_backwards_compatibility' ) );
        parent::__construct( $db, $id );
    }

    public function delete()
    {
        parent::delete();

        $fields = Ninja_Forms()->form( $this->_id )->get_fields();

        foreach( $fields as $field ){
            $field->delete();
        }

        $actions = Ninja_Forms()->form( $this->_id )->get_actions();

        foreach( $actions as $action ){
            $action->delete();
        }
    }

    public function import_form_backwards_compatibility( $import )
    {
        // Rename `data` to `settings`
        if( isset( $import[ 'data' ] ) ){
            $import[ 'settings' ] = $import[ 'data' ];
            unset( $import[ 'data' ] );
        }

        // Rename `notifications` to `actions`
        if( isset( $import[ 'notifications' ] ) ){
            $import[ 'actions' ] = $import[ 'notifications' ];
            unset( $import[ 'notifications' ] );
        }

        // Rename `form_title` to `title`
        if( isset( $import[ 'settings' ][ 'form_title' ] ) ){
            $import[ 'settings' ][ 'title' ] = $import[ 'settings' ][ 'form_title' ];
            unset( $import[ 'settings' ][ 'form_title' ] );
        }

        // `Field` to `Fields`
        if( ! isset( $import[ 'fields'] ) && isset( $import[ 'field' ] ) ){
            $import[ 'fields' ] = $import[ 'field' ];
            unset( $import[ 'field' ] );
        }

        // Combine Field and Field Data
        foreach( $import[ 'fields' ] as $field ){

            if( isset( $field[ 'data' ] ) ){
                $field = array_merge( $field, $field[ 'data' ] );
                unset( $field[ 'data' ] );
            }
        }

        return $import;
    }

    public static function get_next_sub_seq( $form_id )
    {
        $form = Ninja_Forms()->form( $form_id )->get();

        $last_seq_num = $form->get_setting( '_seq_num', 1 );

        $form->update_setting( '_seq_num', $last_seq_num + 1 )->save();

        return $last_seq_num;
    }

    public static function import( array $import )
    {
        $import = apply_filters( 'nf_before_import_form', $import );

        /*
        * Create Form
        */
        $form = Ninja_Forms()->form()->get();
        $form->update_settings( $import[ 'settings' ] );
        $form->save();
        $form_id = $form->get_id();

        foreach( $import[ 'fields' ] as $settings ){

            $field = Ninja_Forms()->form( $form_id )->field()->get();

            $settings[ 'parent_id' ] = $form_id;

            $field->update_settings( $settings )->save();
        }

        foreach( $import[ 'actions' ] as $settings ){

            $action = Ninja_Forms()->form( $form_id )->action()->get();
            $action->update_settings( $settings )->save();
        }

//        add_action( 'admin_notices', function() use ( $form_id ){
//            Ninja_Forms()->template( 'admin-notice-form-import.html.php', compact( 'form_id' ) );
//        });
    }

    public static function duplicate( $form_id )
    {
        $form = Ninja_Forms()->form( $form_id )->get();

        $settings = $form->get_settings();

        $new_form = Ninja_Forms()->form()->get();
        $new_form->update_settings( $settings );

        $form_title = $form->get_setting( 'title' );

        $new_form_title = $form_title . " - " . __( 'copy', 'ninja-forms' );

        $new_form->update_setting( 'title', $new_form_title );

        $new_form->save();

        $new_form_id = $new_form->get_id();

        $fields = Ninja_Forms()->form( $form_id )->get_fields();

        foreach( $fields as $field ){

            $field_settings = $field->get_settings();

            $field_settings[ 'parent_id' ] = $new_form_id;

            $new_field = Ninja_Forms()->form( $new_form_id )->field()->get();
            $new_field->update_settings( $field_settings )->save();
        }

        $actions = Ninja_Forms()->form( $form_id )->get_actions();

        foreach( $actions as $action ){

            $action_settings = $action->get_settings();

            $new_action = Ninja_Forms()->form( $new_form_id )->action()->get();
            $new_action->update_settings( $action_settings )->save();
        }

        return $new_form_id;
    }

    public static function export( $form_id, $return = FALSE )
    {
        //TODO: Set Date Format from Plugin Settings
        $date_format = 'm/d/Y';

        $form = Ninja_Forms()->form( $form_id )->get();

        $export = array(
            'settings' => $form->get_settings(),
            'fields' => array(),
            'actions' => array()
        );

        $fields = Ninja_Forms()->form( $form_id )->get_fields();

        foreach( $fields as $field ){
            $export['fields'][] = $field->get_settings();
        }

        $actions = Ninja_Forms()->form( $form_id )->get_actions();

        foreach( $actions as $action ){
            $export[ 'actions' ][] = $action->get_settings();
        }

        if( $return ){
            return $export;
        } else {

            $today = date( $date_format, current_time( 'timestamp' ) );
            $filename = apply_filters( 'nf_form_export_filename', 'nf_form_' . $today );
            $filename = $filename . ".nff";

            header( 'Content-type: application/nff');
            header( 'Content-Disposition: attachment; filename="'.$filename .'"' );
            header( 'Pragma: no-cache');
            header( 'Expires: 0' );
            echo apply_filters( 'nf_form_export_bom',"\xEF\xBB\xBF" ) ; // Byte Order Mark
            echo base64_encode( maybe_serialize( $export ) );

            die();
        }
    }

} // End NF_Database_Models_Form
