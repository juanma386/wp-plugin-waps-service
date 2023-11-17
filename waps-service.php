<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://hexome.com.ar
 * @since             1.0.0
 * @package           Waps_Service
 *
 * @wordpress-plugin
 * Plugin Name:       WAPS Service 
 * Plugin URI:        https://hexome.cloud
 * Description:       Enhance online interaction with a custom button, streamlining processes for a seamless user experience. WhatsApp button for easy product retrieval and ordering.
 * Version:           1.0.0
 * Author:            Hexome Cloud
 * Author URI:        https://hexome.com.ar/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       waps-service
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'WAPS_SERVICE_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-waps-service-activator.php
 */


 function activate_waps_service_plugin_advice_final() {
    $message = __('Thank you for activating our plugin! We hope you enjoy the features it offers!', 'text-domain'); 
    add_settings_error(
        'custom_notice',
        'custom_notice_message',
        $message,
        'updated'  // Esta es la clase para un aviso verde
    );
}


function activate_waps_service() {
		 add_action('admin_notices', 'activate_waps_service_plugin_advice_final');
		 require_once plugin_dir_path(  __FILE__ ) . 'includes/class-waps-service-licence-asbtraction.php';
		 require_once plugin_dir_path(  __FILE__ ) . 'includes/class-waps-service-licence.php';
		 Waps_Service_Licence::activateConsumerLicense();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-waps-service-deactivator.php
 */
function deactivate_waps_service_plugin_advice_final() {
    $message = __('We appreciate you using our plugin! If you ever need it again, we are here for you. Feel free to reinstall and enjoy the features!', 'text-domain');
    add_settings_error(
        'custom_notice',
        'custom_notice_message',
        $message,
        'updated'  // Esta es la clase para un aviso verde
    );
}

function deactivate_waps_service() {
		add_action('admin_notices', 'deactivate_waps_service_plugin_advice_final');
		require_once plugin_dir_path(  __FILE__  ) . 'includes/class-waps-service-licence-asbtraction.php';
		require_once plugin_dir_path(  __FILE__  ) . 'includes/class-waps-service-licence.php';
		Waps_Service_Licence::deactivateConsumerLicense();
}

register_activation_hook( __FILE__, 'activate_waps_service' );
register_deactivation_hook( __FILE__, 'deactivate_waps_service' );


/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-waps-service.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_waps_service() {

	$plugin = new Waps_Service();
	$plugin->run();

}
run_waps_service();
