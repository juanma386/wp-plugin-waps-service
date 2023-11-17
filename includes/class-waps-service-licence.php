<?php

/**
 * Register all actions and filters for the plugin
 *
 * @link       https://hexome.com.ar
 * @since      1.0.0
 *
 * @package    Waps_Service
 * @subpackage Waps_Service/includes
 */

/**
 * Register all actions and filters for the plugin.
 *
 * Maintain a list of all hooks that are registered throughout
 * the plugin, and register them with the WordPress API. Call the
 * run function to execute the list of actions and filters.
 *
 * @package    Waps_Service
 * @subpackage Waps_Service/includes
 * @author     Hexome Cloud <hi@hexome.cloud>
 */


class Waps_Service_Licence extends Waps_Service_Licence_Abstraction {

    public static function init() {}
    
    public static function activateConsumerLicense() {
        $api_url = self::ACTIVATE_URL . self::PRODUCT_UUID;
        self::sendLicenseRequest($api_url);
    }

    public static function deactivateConsumerLicense() {
        $api_url = self::DEACTIVATE_URL . self::PRODUCT_UUID;
        self::sendLicenseRequest($api_url);
    }


    public static function uninstallConsumerLicense() {
        $api_url = self::UNINSTALL_URL . self::PRODUCT_UUID;
        if (self::sendLicenseRequest($api_url))
        foreach ([
            "waps_service_phone",
            "waps_service_whatsapp_message",
            "waps_service_security_key",
            "waps_service_enable_global_web"
        ] as $key) {
            delete_option($key);
        }
    }


    /**
     * Send consumer license function.
     *
     * @param string $url endpoint with Product UUID.
     * @return mixed
     */

     private static function sendLicenseRequest($url): bool {
        $args = array(
            'headers' => array(
                'Content-Type' => 'application/json',
            ),
        );
    
        $response = wp_remote_get($url, $args);
    
        if (is_wp_error($response)) {
            // Manejar el error aquí si ocurre uno en la solicitud
            return false;
        }
    
        $body = wp_remote_retrieve_body($response);
        $data = json_decode($body, true);
    
        if (is_array($data) && isset($data['status'], $data['license']) && $data['status'] === 'Active') {
            $current_license = get_option('waps_service_security_key');
    
            if (!$current_license) {
                register_setting('waps-service-settings', 'waps_service_security_key');
            }
    
            $new_license = sanitize_text_field($data['license']);
    
            if ($current_license !== $new_license) {
                update_option('waps_service_security_key', $new_license);
                return true;
            }
        }
    
        return false;
    }
    
    
    

}
