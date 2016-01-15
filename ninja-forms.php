<?php
/*
Plugin Name: Ninja Forms
Plugin URI: http://ninjaforms.com/
Description: Ninja Forms is a webform builder with unparalleled ease of use and features.
Version: 3.0-Beta-1-SMcCoy
Author: The WP Ninjas
Author URI: http://ninjaforms.com
Text Domain: ninja-forms
Domain Path: /lang/

Copyright 2015 WP Ninjas.
*/

if( get_option( 'ninja_forms_load_deprecated', FALSE ) ) {

    include 'deprecated/ninja-forms.php';

} else {

    /**
     * Class Ninja_Forms
     */
    final class Ninja_Forms
    {

        /**
         * @since 3.0
         */
        const VERSION = '3.0';

        /**
         * @var Ninja_Forms
         * @since 2.7
         */
        private static $instance;

        /**
         * Plugin Directory
         *
         * @since 3.0
         * @var string $dir
         */
        public static $dir = '';

        /**
         * Plugin URL
         *
         * @since 3.0
         * @var string $url
         */
        public static $url = '';

        /**
         * Admin Menus
         *
         * @since 3.0
         * @var array
         */
        public $menus = array();

        /**
         * AJAX Controllers
         *
         * @since 3.0
         * @var array
         */
        public $controllers = array();

        /**
         * Form Fields
         *
         * @since 3.0
         * @var array
         */
        public $fields = array();

        /**
         * Form Actions
         *
         * @since 3.0
         * @var array
         */
        public $actions = array();

        /**
         * Model Factory
         *
         * @var object
         */
        public $factory = '';

        /**
         * Logger
         *
         * @var string
         */
        protected $_logger = '';

        /**
         * @var NF_Session
         */
        protected $session = '';

        /**
         * Plugin Settings
         *
         * @since 3.0
         * @var array
         */
        protected $settings = array();

        /**
         * Main Ninja_Forms Instance
         *
         * Insures that only one instance of Ninja_Forms exists in memory at any one
         * time. Also prevents needing to define globals all over the place.
         *
         * @since 2.7
         * @static
         * @staticvar array $instance
         * @return Ninja_Forms Highlander Instance
         */
        public static function instance()
        {
            if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Ninja_Forms ) ) {
                self::$instance = new Ninja_Forms;

                self::$dir = plugin_dir_path( __FILE__ );

                self::$url = plugin_dir_url( __FILE__ );

                update_option( 'ninja_forms_version', self::VERSION );

                /*
                 * Register our autoloader
                 */
                spl_autoload_register( array( self::$instance, 'autoloader' ) );

                /*
                 * Admin Menus
                 */
                self::$instance->menus[ 'forms' ]           = new NF_Admin_Menus_Forms();
                self::$instance->menus[ 'all-forms' ]       = new NF_Admin_Menus_AllForms();
                self::$instance->menus[ 'add-new' ]         = new NF_Admin_Menus_AddNew();
                self::$instance->menus[ 'settings' ]        = new NF_Admin_Menus_Settings();
                self::$instance->menus[ 'add-ons' ]         = new NF_Admin_Menus_Addons();
                self::$instance->menus[ 'system_status']    = new NF_Admin_Menus_SystemStatus();
                self::$instance->menus[ 'submissions']      = new NF_Admin_Menus_Submissions();
                self::$instance->menus[ 'import-export']    = new NF_Admin_Menus_ImportExport();

                /*
                 * Admin menus used for building out the admin UI
                 *
                 * TODO: removed once building is complete
                 */
                // self::$instance->menus[ 'add-field']        = new NF_Admin_Menus_AddField();
                // self::$instance->menus[ 'edit-field']       = new NF_Admin_Menus_EditField();
                // self::$instance->menus[ 'add-action']       = new NF_Admin_Menus_AddAction();
                // self::$instance->menus[ 'edit-action']      = new NF_Admin_Menus_EditAction();
                // self::$instance->menus[ 'edit-settings']    = new NF_Admin_Menus_EditSettings();
                // self::$instance->menus[ 'fields-layout']    = new NF_Admin_Menus_FieldsLayout();
                self::$instance->menus[ 'mock-data']        = new NF_Admin_Menus_MockData();
                // self::$instance->menus[ 'preview']          = new NF_Admin_Menus_Preview();

                /*
                 * AJAX Controllers
                 */
                self::$instance->controllers[ 'form' ]       = new NF_AJAX_Controllers_Form();
                self::$instance->controllers[ 'preview' ]    = new NF_AJAX_Controllers_Preview();
                self::$instance->controllers[ 'uploads' ]    = new NF_AJAX_Controllers_Uploads();
                self::$instance->controllers[ 'submission' ] = new NF_AJAX_Controllers_Submission();

                /*
                 * Field Class Registration
                 */
                self::$instance->fields = apply_filters( 'ninja_forms_register_fields', self::load_classes( 'Fields' ) );

                /*
                 * Form Action Registration
                 */
                self::$instance->actions = apply_filters( 'ninja_forms_register_actions', self::load_classes( 'Actions' ) );

                /*
                 * WP-CLI Commands
                 */
                if( class_exists( 'WP_CLI_Command' ) ) {
                    WP_CLI::add_command('ninja-forms', 'NF_WPCLI_NinjaFormsCommand');
                }

                /*
                 * Preview Page
                 */
                self::$instance->preview = new NF_Display_Preview();

                /*
                 * Shortcodes
                 */
                self::$instance->shortcodes = new NF_Display_Shortcodes();

                /*
                 * Temporary Shortcodes
                 *
                 * TODO: removed once building is complete
                 */
                require_once( self::$dir . 'includes/Display/Shortcodes/tmp-frontend.php' );
                require_once( self::$dir . 'includes/Display/Shortcodes/tmp-preview.php' );
                require_once( self::$dir . 'includes/Display/Shortcodes/tmp-frontendform.php' );
                require_once( self::$dir . 'includes/Display/Shortcodes/tmp-file-upload.php' );

                /*
                 * Submission CPT
                 */
                new NF_Admin_CPT_Submission();

                /*
                 * Logger
                 */
                self::$instance->_logger = new NF_Database_Logger();

                /*
                 * Merge Tags
                 */
                self::$instance->merge_tags[ 'user' ] = new NF_MergeTags_User();
                self::$instance->merge_tags[ 'post' ] = new NF_MergeTags_Post();
                self::$instance->merge_tags[ 'system' ] = new NF_MergeTags_System();
                self::$instance->merge_tags[ 'fields' ] = new NF_MergeTags_Fields();
                self::$instance->merge_tags[ 'calcs' ] = new NF_MergeTags_Calcs();

                /*
                 * EOS Parser
                 */
                self::$instance->_eos[ 'parser' ] = require_once 'includes/Libraries/EOS/Parser.php';

                self::$instance->session = new NF_Session();

                /*
                 * Plugin Settings
                 */
                self::$instance->settings = get_option( 'ninja_forms_settings' );

                /*
                 * Activation Hook
                 * TODO: Move to a permanent home.
                 */
                register_activation_hook( __FILE__, array( self::$instance, 'activation' ) );

                new NF_Admin_Metaboxes_Example();
                new NF_Admin_Metaboxes_AppendAForm();
            }

            return self::$instance;
        }

        /**
         * Autoloader
         *
         * Autoload Ninja Forms classes
         *
         * @param $class_name
         */
        public function autoloader( $class_name )
        {
            if( class_exists( $class_name ) ) return;

            /* Ninja Forms Prefix */
            if (false !== strpos($class_name, 'NF_')) {
                $class_name = str_replace('NF_', '', $class_name);
                $classes_dir = realpath(plugin_dir_path(__FILE__)) . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR;
                $class_file = str_replace('_', DIRECTORY_SEPARATOR, $class_name) . '.php';
                if (file_exists($classes_dir . $class_file)) {
                    require_once $classes_dir . $class_file;
                }
            }

            /* WP Ninjas Prefix */
            if (false !== strpos($class_name, 'WPN_')) {
                $class_name = str_replace('WPN_', '', $class_name);
                $classes_dir = realpath(plugin_dir_path(__FILE__)) . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR;
                $class_file = str_replace('_', DIRECTORY_SEPARATOR, $class_name) . '.php';
                if (file_exists($classes_dir . $class_file)) {
                    require_once $classes_dir . $class_file;
                }
            }
        }

        /*
         * PUBLIC API WRAPPERS
         */

        /**
         * Form Model Factory Wrapper
         *
         * @param $id
         * @return NF_Abstracts_ModelFactory
         */
        public function form( $id = '' )
        {
            global $wpdb;

            return new NF_Abstracts_ModelFactory( $wpdb, $id );
        }

        /**
         * Logger Class Wrapper
         *
         * Example Use:
         * Ninja_Forms()->logger()->log( 'debug', "Hello, {name}!", array( 'name' => 'world' ) );
         * Ninja_Forms()->logger()->debug( "Hello, {name}!", array( 'name' => 'world' ) );
         *
         * @return string
         */
        public function logger()
        {
            return $this->_logger;
        }

        public function eos()
        {
            return new Parser();
        }

        public function session()
        {
            return $this->session;
        }

        public function get_setting( $key = '' )
        {
            if( empty( $key ) || ! isset( $this->settings[ $key ] ) ) return FALSE;

            return $this->settings[ $key ];
        }

        public function get_settings()
        {
            return $this->settings;
        }

        public function update_setting( $key, $value )
        {
            $this->settings[ $key ] = $value;
            $this->update_settings();
        }

        public function update_settings( $settings = array() )
        {
            $this->settings = array_merge( $this->settings, $settings );
            update_option( 'ninja_forms_settings', $this->settings );
        }


        /**
         * Display Wrapper
         *
         * @param $form_id
         */
        public function display( $form_id, $preview = FALSE )
        {
            if( ! $form_id ) return;

            if( ! $preview ) {
                NF_Display_Render::localize($form_id);
            } else {
                NF_Display_Render::localize_preview($form_id);
            }
        }



        /*
         * PRIVATE METHODS
         */

        /**
         * Load Classes from Directory
         *
         * @param string $prefix
         * @return array
         */
        private static function load_classes( $prefix = '' )
        {
            $return = array();

            $subdirectory = str_replace( '_', DIRECTORY_SEPARATOR, str_replace( 'NF_', '', $prefix ) );

            $directory = 'includes/' . $subdirectory;

            foreach (scandir( self::$dir . $directory ) as $path) {

                $path = explode( DIRECTORY_SEPARATOR, str_replace( self::$dir, '', $path ) );
                $filename = str_replace( '.php', '', end( $path ) );

                $class_name = 'NF_' . $prefix . '_' . $filename;

                if( ! class_exists( $class_name ) ) continue;

                $return[ strtolower( $filename ) ] = new $class_name;
            }

            return $return;
        }



        /*
         * STATIC METHODS
         */

        /**
         * Template
         *
         * @param string $file_name
         * @param array $data
         */
        public static function template( $file_name = '', array $data = array() )
        {
            if( ! $file_name ) return;

            extract( $data );

            include self::$dir . 'includes/Templates/' . $file_name;
        }

        /**
         * Config
         *
         * @param $file_name
         * @return mixed
         */
        public static function config( $file_name )
        {
            return include self::$dir . 'includes/Config/' . $file_name . '.php';
        }

        /**
         * Activation
         * TODO: Move to a permanent home
         */
        public function activation() {
            $mock_data = new NF_Database_MockData();
            $mock_data->form_blank_form();
            $mock_data->form_contact_form_1();
            $mock_data->form_contact_form_2();
            $mock_data->form_email_submission();
            $mock_data->form_long_form();
            $mock_data->form_kitchen_sink();
        }

    } // End Class Ninja_Forms



    /**
     * The main function responsible for returning The Highlander Ninja_Forms
     * Instance to functions everywhere.
     *
     * Use this function like you would a global variable, except without needing
     * to declare the global.
     *
     * Example: <?php $nf = Ninja_Forms(); ?>
     *
     * @since 2.7
     * @return Ninja_Forms Highlander Instance
     */
    function Ninja_Forms()
    {
        return Ninja_Forms::instance();
    }

    Ninja_Forms();
}

add_action( 'admin_notices', 'nf_alpha_release_admin_notice', -1 );
function nf_alpha_release_admin_notice()
{
    ?>
    <style>
        .nf-alpha-notice {
            border-left: 4px solid #EF4748; /* Ninja Forms Red */
        }
        .nf-alpha-notice ul {
            list-style-type: disc;
            padding-left: 40px;
        }
    </style>
    <div class="update-nag nf-alpha-notice">
        <h3>Ninja Forms 3.0 - BETA 1 - <a href="https://en.wikipedia.org/wiki/Seventh_Doctor" target="_blank">S.McCoy</a></h3>
        <p><strong>NOTICE:</strong> Installed is a Beta Release of Ninja Forms. This is not intended for production.</p>
        <p>Please keep a few things in mind while exploring:</p>
        <ul>
            <li><strong>DO NOT</strong> attempt to install this release on a live website. (If this site falls in that category, remove this plugin)</li>
            <li><strong>DO</strong> install this on a clean WordPress install; by this we mean a completely new WordPress installation to which Ninja Forms 2.9.x or earlier has never been installed.</li>
            <li>There will be database conflicts if you install this alongside 2.9.x, even if 2.9.x has been deactivated or deleted.</li>
            <li>This BETA is best viewed at <strong>1039px wide or greater.</strong> This is because we have not fully implented the responsive UI thus far.</li>
        </ul>
        <p>Please submit all <strong>feedback</strong> on our <a href="http://developer.ninjaforms.com/slack/">Slack group</a></p>
    </div>
    <?php
}
