<?php

abstract class Waps_Service_Licence_Abstraction {

    const PRODUCT_UUID = '37f6b0a1-636c-44d5-9865-f0b93acdc332';
    const API_URL = 'https://licence.hexome.cloud/api/';

    // Definir las URL específicas para cada acción
    const ACTIVATE_URL = self::API_URL . 'activate-consumer/';
    const DEACTIVATE_URL = self::API_URL . 'deactivate-consumer/';
    const UNINSTALL_URL = self::API_URL . 'uninstall-consumer/';

    abstract public static function init();

    abstract public static function activateConsumerLicense();

    abstract public static function deactivateConsumerLicense();
    
    abstract public static function uninstallConsumerLicense();
    

}
