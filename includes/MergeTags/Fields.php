<?php if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Class NF_MergeTags_Fields
 */
final class NF_MergeTags_Fields extends NF_Abstracts_MergeTags
{
    protected $id = 'fields';

    public function __construct()
    {
        parent::__construct();
        $this->title = __( 'Fields', 'ninja-forms' );
    }

    public function __call($name, $arguments)
    {
        return $this->merge_tags[ $name ][ 'field_value' ];
    }

    public function set_merge_tags( $key, $value )
    {
        $callback = ( is_numeric( $key ) ) ? 'field_' . $key : $key;

        $this->merge_tags[ $callback ] = array(
            'id' => $key,
            'tag' => "{field:$key}",
//            'label' => __( '', 'ninja_forms' ),
            'callback' => $callback,
            'field_value' => $value
        );
    }

} // END CLASS NF_MergeTags_Fields
