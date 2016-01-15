<?php if ( ! defined( 'ABSPATH' ) ) exit;

final class NF_Display_Render
{
    protected static $loaded_templates = array(
        'app-layout',
        'app-before-form',
        'app-after-form',
        'app-before-field',
        'app-after-field',
        'form-layout',
        'fields-wrap',
        'fields-wrap-no-label',
        'fields-wrap-no-container',
        'fields-label',
        'fields-error',
    );

    protected static $use_test_values = FALSE;

    public static function localize( $form_id )
    {
        if( isset( $_GET[ 'ninja_forms_test_values' ] ) ){
            self::$use_test_values = TRUE;
        }

        if( ! has_action( 'wp_footer', 'NF_Display_Render::output_templates', 9999 ) ){
            add_action( 'wp_footer', 'NF_Display_Render::output_templates', 9999 );
        }
        $form = Ninja_Forms()->form( $form_id )->get();

        /*
         * Check if user is required to be logged in
         */
        $is_login_required = $form->get_setting( 'require_user_logged_in_to_view_form' );
        $is_logged_in = wp_get_current_user()->ID;
        if( $is_login_required && ! $is_logged_in ){
            echo $form->get_setting( 'not_logged_in_message' );
            return;
        }

        /*
         * Check the form submission limit
         */
        $limit = $form->get_setting( 'limit_submissions' );
        $subs = Ninja_Forms()->form( $form_id )->get_subs();
        if( $limit && ( count( $subs ) >= (int) $limit ) ){
            echo $form->get_setting( 'limit_reached_message' );
            return;
        }

        $form_fields = Ninja_Forms()->form( $form_id )->get_fields();

        $fields = array();

        if( empty( $form_fields ) ){
            echo __( 'No Fields Found.', 'ninja-forms' );
        } else {
            foreach ($form_fields as $field) {

                $field = apply_filters('nf_localize_fields', $field);

                $field_class = $field->get_settings('type');

                $field_class = Ninja_Forms()->fields[$field_class];

                if (self::$use_test_values) {
                    $field->update_setting('value', $field_class->get_test_value());
                }

                $field->update_setting('id', $field->get_id());

                $display_before = apply_filters( 'ninja_forms_display_before_field_type_' . $field->get_setting( 'type' ), 'BEFORE' );
                $display_before = apply_filters( 'ninja_forms_display_before_field_key_' . $field->get_setting( 'key' ), $display_before );
                $field->update_setting( 'displayBefore', $display_before );

                $display_after = apply_filters( 'ninja_forms_display_after_field_type_' . $field->get_setting( 'type' ), 'AFTER' );
                $display_after = apply_filters( 'ninja_forms_display_after_field_key_' . $field->get_setting( 'key' ), $display_after );
                $field->update_setting( 'displayAfter', $display_after );

                $templates = $field_class->get_templates();

                if (!array($templates)) {
                    $templates = array($templates);
                }

                foreach ($templates as $template) {
                    self::load_template('fields-' . $template);
                }

                $settings = $field->get_settings();

                foreach ($settings as $key => $setting) {
                    if (is_numeric($setting)) $settings[$key] = floatval($setting);
                }

                if (isset($settings['default'])) {
                    $default_value = apply_filters('ninja_forms_render_default_value', $settings['default'], $field_class, $settings);

                    if ($default_value) {
                        $settings['value'] = $default_value;
                    }
                }

                // TODO: Find a better way to do this.
                if ('shipping' == $settings['type']) {
                    // TODO: Does the currency marker need to stripped here?
                    $settings['shipping_cost'] = str_replace('$', '', $settings['shipping_cost']);
                    $settings['shipping_cost'] = number_format($settings['shipping_cost'], 2);
                } elseif ('product' == $settings['type']) {
                    // TODO: Does the currency marker need to stripped here?
                    $settings['product_price'] = str_replace('$', '', $settings['product_price']);
                    $settings['product_price'] = number_format($settings['product_price'], 2);
                } elseif ('total' == $settings['type'] && isset($settings['value'])) {
                    $settings['value'] = number_format($settings['value'], 2);
                }

                $settings['element_templates'] = $templates;
                $settings['old_classname'] = $field_class->get_old_classname();
                $settings['wrap_template'] = $field_class->get_wrap_template();

                $fields[] = $settings;
            }
        }

        // Output Form Container
        ?>
            <div id="nf-form-<?php echo $form_id; ?>-cont"></div>
        <?php

        ?>
        <!-- TODO: Move to Template File. -->
        <script>
            var formDisplay = 1;

            // Maybe initialize nfForms object
            var nfForms = nfForms || [];

            // Build Form Data
            var form = [];
            form.id = '<?php echo $form_id; ?>';
            form.settings = <?php echo wp_json_encode( $form->get_settings() ); ?>;

            form.fields = <?php echo wp_json_encode( $fields ); ?>;

            // Add Form Data to nfForms object
            nfForms.push( form );
        </script>

        <?php
        self::enqueue_scripts();
    }

    public static function localize_preview( $form_id )
    {
        if( isset( $_GET[ 'ninja_forms_test_values' ] ) ){
            self::$use_test_values = TRUE;
        }

        add_action( 'wp_footer', 'NF_Display_Render::output_templates', 9999 );

        $form = get_user_option( 'nf_form_preview_' . $form_id );

        if( ! $form ){
            self::localize( $form_id );
            return;
        }

        $form[ 'settings' ][ 'is_preview' ] = TRUE;

        $fields = array();

        if( empty( $form['fields'] ) ){
            echo __( 'No Fields Found.', 'ninja-forms' );
        } else {
            foreach ($form['fields'] as $field_id => $field) {

                $field['settings']['id'] = $field_id;

                $field = apply_filters('nf_localize_fields_preview', $field);

                $field_class = $field['settings']['type'];

                foreach ($field['settings'] as $key => $setting) {
                    if (is_numeric($setting)) $field['settings'][$key] = floatval($setting);
                }

                $field_class = Ninja_Forms()->fields[$field_class];

                $templates = $field_class->get_templates();

                if (!array($templates)) {
                    $templates = array($templates);
                }

                foreach ($templates as $template) {
                    self::load_template('fields-' . $template);
                }

                if (self::$use_test_values) {
                    $field['settings']['value'] = $field_class->get_test_value();
                }

                if (isset($field['settings']['default'])) {
                    $default_value = apply_filters('ninja_forms_render_default_value', $field['settings']['default'], $field_class, $field['settings']);

                    if ($default_value) {
                        $field['settings']['value'] = $default_value;
                    }
                }

                // TODO: Find a better way to do this.
                if ('shipping' == $field['settings']['type']) {
                    $field['settings']['shipping_cost'] = number_format($field['settings']['shipping_cost'], 2);
                } elseif ('product' == $field['settings']['type']) {
                    // TODO: Does the currency marker need to stripped here?
                    $field['settings']['product_price'] = str_replace('$', '', $field['settings']['product_price'] );
                    $field['settings']['product_price'] = number_format($field['settings']['product_price'], 2);
                } elseif ('total' == $field['settings']['type']) {
                    $field['settings']['value'] = number_format($field['settings']['value'], 2);
                }

                $field['settings']['element_templates'] = $templates;
                $field['settings']['old_classname'] = $field_class->get_old_classname();
                $field['settings']['wrap_template'] = $field_class->get_wrap_template();

                $fields[] = $field['settings'];
            }
        }

        // Output Form Container
        ?>
        <div id="nf-form-<?php echo $form_id; ?>-cont"></div>
        <?php

        ?>
        <!-- TODO: Move to Template File. -->
        <script>
            // Maybe initialize nfForms object
            var nfForms = nfForms || [];

            // Build Form Data
            var form = [];
            form.id = '<?php echo $form['id']; ?>';
            form.settings = JSON.parse( '<?php echo WPN_Helper::addslashes( wp_json_encode( $form['settings'] ) ); ?>' );

            form.fields = JSON.parse( '<?php echo WPN_Helper::addslashes( wp_json_encode(  $fields ) ); ?>' );

            // Add Form Data to nfForms object
            nfForms.push( form );
        </script>

        <?php
        self::enqueue_scripts();
    }

    public static function enqueue_scripts()
    {
        wp_enqueue_style( 'nf-display-structure', Ninja_Forms::$url . 'assets/css/display-structure.css' );
        wp_enqueue_style( 'nf-display-opinions', Ninja_Forms::$url . 'assets/css/display-opinions.css' );

        wp_enqueue_script( 'backbone-marionette', Ninja_Forms::$url . 'assets/js/lib/backbone.marionette.min.js', array( 'jquery', 'backbone' ) );
        wp_enqueue_script( 'backbone-radio', Ninja_Forms::$url . 'assets/js/lib/backbone.radio.min.js', array( 'jquery', 'backbone' ) );

        // wp_enqueue_script( 'requirejs', Ninja_Forms::$url . 'assets/js/lib/require.js', array( 'jquery', 'backbone' ) );
        wp_enqueue_script( 'nf-front-end', Ninja_Forms::$url . 'assets/js/min/front-end.js', array( 'jquery', 'backbone' ) );

        $data = apply_filters( 'ninja_forms_render_localize_script_data', array(
            'ajaxNonce' => wp_create_nonce( 'ninja_forms_ajax_nonce' ),
            'adminAjax' => admin_url( 'admin-ajax.php' ),
            'requireBaseUrl' => Ninja_Forms::$url . 'assets/js/'
        ));

        wp_localize_script( 'nf-front-end', 'nfFrontEnd', $data );

    }

    protected static function load_template( $file_name = '' )
    {
        if( ! $file_name ) return;

        if( self::is_template_loaded( $file_name ) ) return;

        self::$loaded_templates[] = $file_name;
    }

    public static function output_templates()
    {
        // Build File Path Hierarchy
        $file_paths = apply_filters( 'ninja_forms_field_template_file_paths', array(
            get_template_directory() . '/ninja-forms/templates/',
        ));

        $file_paths[] = Ninja_Forms::$dir . 'includes/Templates/';

        // Search for and Output File Templates
        foreach( self::$loaded_templates as $file_name ) {

            foreach( $file_paths as $path ){

                if( file_exists( $path . "$file_name.html" ) ){
                    echo file_get_contents( $path . "$file_name.html" );
                    break;
                }
            }
        }

        ?>
        <script>
            var post_max_size = '<?php echo WPN_Helper::string_to_bytes( ini_get('post_max_size') ); ?>';
            var upload_max_filesize = '<?php echo WPN_Helper::string_to_bytes( ini_get( 'upload_max_filesize' ) ); ?>';
            var wp_memory_limit = '<?php echo WPN_Helper::string_to_bytes( WP_MEMORY_LIMIT ); ?>';
        </script>
        <?php

        // Action to Output Custom Templates
        do_action( 'nf_output_templates' );
    }

    /*
     * UTILITY
     */

    protected static function is_template_loaded( $template_name )
    {
        return ( in_array( $template_name, self::$loaded_templates ) ) ? TRUE : FALSE ;
    }

} // End Class NF_Display_Render
