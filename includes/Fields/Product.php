<?php if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Class NF_Fields_Product
 */
class NF_Fields_Product extends NF_Abstracts_Input
{
    protected $_name = 'product';

    protected $_section = 'pricing';

    protected $_aliases = array();

    protected $_type = 'textbox';

    protected $_templates = array( 'product', 'textbox', 'hidden', 'listselect' );

    protected $_test_value = '0';

    protected $processing_fields = array( 'quantity', 'modifier', 'shipping', 'tax', 'total' );

    protected $_settings = array( 'product_use_quantity', 'product_price', 'product_type', 'product_type' );

    public function __construct()
    {
        parent::__construct();

        $this->_nicename = __( 'Product', 'ninja-forms' );
    }

    public function process( $product, $data )
    {
        $related = array();

        foreach( $data[ 'fields' ] as $key => $field ){

            if( ! in_array( $field[ 'type' ], $this->processing_fields ) ) continue;

            $type = $field[ 'type' ];

            if( ! isset( $field[ 'product_assignment' ] ) ) continue;

            if( $product[ 'id' ] != $field[ 'product_assignment' ] ) continue;

            $related[ $type ] = &$data[ 'fields' ][ $key ]; // Assign by reference
        }

        $total = floatval( $product[ 'product_price' ] );

        if( isset( $related[ 'quantity' ][ 'value' ] ) && $related[ 'quantity' ][ 'value' ] ){
            $total = $total * $related[ 'quantity' ][ 'value' ];
        } elseif( $product[ 'product_use_quantity'] && $product[ 'value' ] ){
            $total = $total * $product[ 'value' ];
        }

        if( isset( $related[ 'modifier' ] ) ){
            //TODO: Handle multiple modifiers.
        }

        $data[ 'product_totals' ][] = number_format( $total, 2 );

        return $data;
    }
}
