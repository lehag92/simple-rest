<?php
namespace Connection;

use PDO;

class Database {

    private static $db;
    private static $dbName;
    private static $dbHost;
    private static $dbUser;
    private static $dbPassword;
    private function __construct(){}

    /**
     * Set config
     *
     * @param array $config
     * @throws \Exception
     */
    private function setConfig($config)
    {
        $result = false;

        $configKeys = [
            'dbName',
            'dbHost',
            'dbUser',
            'dbPassword'
        ];

        //Check if all necessary keys are present
        foreach ($configKeys as $keyName) {
            if (array_key_exists($keyName, $config)) {
                $result = true;
            } else {
                $result = false;
                break;
            }
        }

        //Check config values and class propertires for this config
        if ($result) {
            foreach ($config as $configKey => $configValue) {
                if (property_exists(self::class, $configKey) && !empty($configValue)) {
                    self::$$configKey = $configValue;
                } else {
                    $result = false;
                    break;
                }
            }
        }

        if (!$result) {
            throw new \Exception('Bad Config!');
        }
    }

    /**
     * Get PDO Object
     *
     * @return PDO
     */
    public static function get() {
        if(!isset(self::$db)){
            self::setConfig(Config::getConfig());
            self::$db = new PDO(
                'mysql:host='.self::$dbHost.';dbname='.self::$dbName,
                self::$dbUser,
                self::$dbPassword
                );
        }

        return self::$db;
    }
}

