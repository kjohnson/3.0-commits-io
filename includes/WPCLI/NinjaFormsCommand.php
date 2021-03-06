<?php if ( ! defined( 'ABSPATH' ) ) exit;

if( ! class_exists( 'WP_CLI_Command' ) ) exit;

/**
 * The Ninja Forms WP-CLI Command
 */
class NF_WPCLI_NinjaFormsCommand extends WP_CLI_Command
{
    /**
     * Display Ninja Forms Information
     *
     * @subcommand info
     */
    function info()
    {
        $this->peeking_ninja();
        WP_CLI::success( 'Welcome to the Ninja Forms WP-CLI Extension!' );
        WP_CLI::line( '' );
        WP_CLI::line( '- Ninja Forms Version: ' . Ninja_Forms::VERSION );
        WP_CLI::line( '- Ninja Forms Directory: ' . Ninja_Forms::$dir );
        WP_CLI::line( '- Ninja Forms Public URL: ' . Ninja_Forms::$url );
        WP_CLI::line( '' );
    }

    /**
     * Creates a Form
     *
     * ## OPTIONS
     *
     * <title>
     * : The form title.
     *
     * ## EXAMPLES
     *
     *     wp ninja-forms form "My New Form"
     *
     * @synopsis <title>
     * @subcommand form
     * @alias create-form
     */
    public function create_form( $args, $assoc_args )
    {
        list( $title ) = $args;

        $form = Ninja_Forms()->form()->get();
        $form->update_setting( 'title', $title );
        $form->save();
    }

    /**
     * Installs mock form data
     */
    public function mock()
    {
        $mock_data = new NF_Database_MockData();

        $mock_data->form_contact_form_1();
        $mock_data->form_contact_form_2();
        $mock_data->form_email_submission();
        $mock_data->form_long_form();
    }

    private function peeking_ninja()
    {
        $output = file_get_contents( Ninja_Forms::$dir . 'includes/Templates/wpcli-header-art.txt' );
        WP_CLI::line( $output );
    }

} // END CLASS NF_WPCLI_NinjaFormsCommand
