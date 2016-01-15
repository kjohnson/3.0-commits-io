<?php if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Class NF_Fields_ExampleOptIn
 */
class NF_Fields_ExampleOptIn extends NF_Abstracts_FieldOptIn
{
    protected $_name = 'exampleoptin';

    public function __construct()
    {
        parent::__construct();

        $this->_nicename = __( 'Example Opt-In', 'ninja-forms' );

        foreach( array( 'a' => 'A', 'b' => 'B' ) as $name => $label ){
            $this->addList( $name, $label );
        }

//        $this->addLists( apply_filter( 'ninja_forms_example_newsletter_lists', array() ) );

    }
}