<?php

/**
 * Fired when the plugin is uninstalled.
 *
 * When populating this file, consider the following flow
 * of control:
 *
 * - This method should be static
 * - Check if the $_REQUEST content actually is the plugin name
 * - Run an admin referrer check to make sure it goes through authentication
 * - Verify the output of $_GET makes sense
 * - Repeat with other user roles. Best directly by using the links/query string parameters.
 * - Repeat things for multisite. Once for a single site in the network, once sitewide.
 *
 * This file may be updated more in future version of the Boilerplate; however, this is the
 * general skeleton and outline for how the file should work.
 *
 * For more information, see the following discussion:
 * https://github.com/tommcfarlin/WordPress-Plugin-Boilerplate/pull/123#issuecomment-28541913
 *
 * @link       https://hexome.com.ar
 * @since      1.0.0
 *
 * @package    Waps_Service
 */

// If uninstall not called from WordPress, then exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}




function uninstall_waps_service_plugin_advice_final() {
    $message = __('Thank you for using our plugin. Keeping your site free from unnecessary plugins is essential. If you require any assistance or have questions, feel free to contact our support.', 'text-domain');
    add_settings_error(
        'custom_notice',
        'custom_notice_message',
        $message,
        'updated'  // Esta es la clase para un aviso verde
    );
}

function uninstall_waps_service_plugin() {
    add_action('admin_notices', 'uninstall_waps_service_plugin_advice_final');
    require_once plugin_dir_path( __FILE__ ) . 'includes/class-waps-service-licence-asbtraction.php';
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-waps-service-licence.php';
	Waps_Service_Licence::uninstallConsumerLicense();
    foreach ([
        "waps_service_phone",
        "waps_service_whatsapp_message",
        "waps_service_security_key",
        "waps_service_enable_global_web"
    ] as $key) {
        delete_option($key);
    }
}

uninstall_waps_service_plugin();
