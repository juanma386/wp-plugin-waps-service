<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://hexome.com.ar
 * @since      1.0.0
 *
 * @package    Waps_Service
 * @subpackage Waps_Service/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Waps_Service
 * @subpackage Waps_Service/includes
 * @author     Hexome Cloud <hi@hexome.cloud>
 */
class Waps_Service_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
		Waps_Service_Licence::deactivateConsumerLicense();
	}

}
