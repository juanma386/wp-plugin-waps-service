<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://hexome.com.ar
 * @since      1.0.0
 *
 * @package    Waps_Service
 * @subpackage Waps_Service/public/partials
 */

// Add the wp_head action
add_action('wp_head', 'Waps_Service_inner_data_head');

// Function to insert data into the head
function Waps_Service_inner_data_head() {
    if ( function_exists('get_the_ID') && function_exists('wc_get_product') && function_exists('get_option') ) {
        $product_id = get_the_ID();
        $product = wc_get_product($product_id);
        $enable_global_web = get_option('waps_service_enable_global_web');

        

        if ( $enable_global_web || ($product && (!$product->get_price() || $product->get_price() == 0))) {

            $phone = get_option('waps_service_phone');
            $whatsapp_message = get_option('waps_service_whatsapp_message');
            $security_key = get_option('waps_service_security_key');
            if (!$security_key) {
                register_setting('waps-service-settings', 'waps_service_security_key');
            }
            $advice_out_of_stock = get_option('waps_service_advice_out_of_stock');

            if ( isset($phone) && !empty($phone) ){
                echo '<meta name="tel" content="' . esc_attr($phone) . '">';
            } 
            if  ( isset($whatsapp_message) && !empty($whatsapp_message) ) {
                echo '<meta name="whatsapp_message" content="' . esc_attr($whatsapp_message) . '">';
            }
            if  ( isset($security_key) && !empty($security_key) ) {
                echo '<meta name="security_key" content="' . esc_attr($security_key) . '">';
            }
            if  ( isset($advice_out_of_stock) && !empty($advice_out_of_stock) ) {
                echo '<meta name="advice_out_of_stock" content="' . esc_attr($advice_out_of_stock) . '">';
            }
        } 
    }
}

