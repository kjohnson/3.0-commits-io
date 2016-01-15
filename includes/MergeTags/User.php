<?php if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Class NF_MergeTags_User
 */
final class NF_MergeTags_User extends NF_Abstracts_MergeTags
{
    protected $id = 'user';

    public function __construct()
    {
        parent::__construct();
        $this->title = __( 'User', 'ninja-forms' );
        $this->merge_tags = Ninja_Forms()->config( 'MergeTagsUser' );
    }

    protected function user_firstname()
    {
        $current_user = wp_get_current_user();

        return ( $current_user ) ? $current_user->user_firstname : '';
    }

    protected function user_lastname()
    {
        $current_user = wp_get_current_user();

        return ( $current_user ) ? $current_user->user_lastname : '';
    }

    protected function user_email()
    {
        $current_user = wp_get_current_user();

        return ( $current_user ) ? $current_user->user_email : '';
    }

} // END CLASS NF_MergeTags_System
