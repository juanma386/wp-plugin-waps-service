<?php

/**
 * Provide an admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://hexome.com.ar
 * @since      1.0.0
 *
 * @package    Waps_Service
 * @subpackage Waps_Service/admin/partials
 */

// Function to add the menu in the admin
function waps_service_menu() {
    add_menu_page(
        'WAPS Service',
        'WAPS Service',
        'manage_options',
        'waps-service',
        'waps_service_page'
    );
}

add_action('admin_menu', 'waps_service_menu');

// Function to render the admin page
function waps_service_page() {
    ?>
    <div class="wrap">
        <h2>WAPS Service Configuration</h2>
        <form method="post" action="options.php">
            <?php settings_fields('waps-service-settings'); ?>
            <?php do_settings_sections('waps-service'); ?>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

// Function to register configuration fields
function waps_service_settings() {
    
    register_setting('waps-service-settings', 'waps_service_enable_global_web');
    register_setting('waps-service-settings', 'waps_service_whatsapp_message');
    register_setting('waps-service-settings', 'waps_service_phone');
    register_setting('waps-service-settings', 'waps_service_advice_out_of_stock');
    

    add_settings_field('enable-global-web', 'Enable Global Web:', 'waps_service_enable_global_web_cb', 'waps-service', 'waps-service-section');

    
    add_settings_section('waps-service-section', 'General Configuration', 'waps_service_section_cb', 'waps-service');
    
    add_settings_field('advice-out-of-stock', 'Advice Out of Stock:', 'waps_service_advice_out_of_stock_cb', 'waps-service', 'waps-service-section');
    add_settings_field('security-key', 'License:', 'waps_service_security_key_cb', 'waps-service', 'waps-service-section');
    add_settings_field('whatsapp-message', 'WhatsApp Greeting:', 'waps_service_whatsapp_message_cb', 'waps-service', 'waps-service-section');
    add_settings_field('phone', 'Phone Number:', 'waps_service_phone_cb', 'waps-service', 'waps-service-section');
    


}

add_action('admin_init', 'waps_service_settings');

// Functions to display fields on the admin page
function waps_service_security_key_cb() {
    $value = get_option('waps_service_security_key');
    ?>
    <p class="support-notice">
    <em><?php _e('To obtain support, you require a license. Please proceed with your queries directly for more structured assistance.', 'textdomain'); ?></em>
    </p>
    <a href="https://licence.hexome.cloud/api/get-support/<?php echo ($value); ?>" class="button button-primary" role="button">Get Support</a>
    <?php
}

function waps_service_whatsapp_message_cb() {
    $value = get_option('waps_service_whatsapp_message');
    echo "<input type='text' name='waps_service_whatsapp_message' value='$value' />";
}

function waps_service_phone_cb() {
    $value = get_option('waps_service_phone');
    echo "<input type='text' name='waps_service_phone' value='$value' />";
}

function waps_service_section_cb() {
    echo '<p>Enter the required information:</p>';
}


function waps_service_enable_global_web_cb() {
    $value = get_option('waps_service_enable_global_web');
    ?>
    <p class="support-notice">
        <em><?php _e('To obtain support, you require a license. Please proceed with your queries directly for more structured assistance.', 'textdomain'); ?></em>
    </p>
    <label for="enable-global-web">
        <input type="checkbox" id="enable-global-web" name="waps_service_enable_global_web" <?php checked(1, $value); ?> value="1" />
        <?php _e('Disable to work button on WooCommerce products out of stock', 'textdomain'); ?>
    </label>
    <?php
}


function waps_service_advice_out_of_stock_cb() {
    $value = get_option('waps_service_advice_out_of_stock');
    echo "<input type='text' name='waps_service_advice_out_of_stock' value='$value' />";
}



?>