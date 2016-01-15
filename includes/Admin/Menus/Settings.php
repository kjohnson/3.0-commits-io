<?php if ( ! defined( 'ABSPATH' ) ) exit;

final class NF_Admin_Menus_Settings extends NF_Abstracts_Submenu
{
    public $parent_slug = 'ninja-forms';

    public $page_title = 'Settings';

    public $priority = 11;

    protected $_prefix = 'ninja_forms';

    public function __construct()
    {
        parent::__construct();

        if( isset( $_POST[ 'update_ninja_forms_settings' ] ) ) {
            $this->update_settings();
        }
    }

    public function display()
    {
        wp_enqueue_style( 'nf-admin-settings', Ninja_Forms::$url . 'assets/css/admin-settings.css' );

        $groups = Ninja_Forms()->config( 'PluginSettingsGroups' );

        $grouped_settings = $this->get_settings();

        $save_button_text = __( 'Save Settings', 'ninja-forms' );

        $setting_defaults = Ninja_Forms()->get_settings();

        foreach( $grouped_settings as $group => $settings ){

            foreach( $settings as $key => $setting ){

                $default = ( isset( $setting_defaults[ $key ] ) ) ? $setting_defaults[$key] : '';

                $grouped_settings[$group][$key]['id'] = $this->prefix( $grouped_settings[$group][$key]['id'] );
                $grouped_settings[$group][$key]['value'] = $default;
            }
        }

        $grouped_settings[ 'general' ][ 'version' ][ 'value' ] = Ninja_Forms::VERSION;

        Ninja_Forms::template( 'admin-menu-settings.html.php', compact( 'groups', 'grouped_settings', 'save_button_text' ) );

    }

    private function update_settings()
    {
        if( ! isset( $_POST[ $this->_prefix ] ) ) return;

        $settings = $_POST[ 'ninja_forms' ];

        foreach( $settings as $id => $value ){
            Ninja_Forms()->update_setting( $id, sanitize_text_field( $value ) );
        }
    }

    private function get_settings()
    {
        return apply_filters( 'ninja_forms_plugin_settings', array(
            'general' => Ninja_Forms()->config( 'PluginSettingsGeneral' ),
            'recaptcha' => Ninja_Forms()->config( 'PluginSettingsReCaptcha' ),
            'advanced' => Ninja_Forms()->config( 'PluginSettingsAdvanced' ),
        ));
    }

    private function prefix( $value ){
        return "{$this->_prefix}[$value]";
    }

} // End Class NF_Admin_Settings
