<?php
namespace Connection;

use PDO;
use PDOException;
use Rest\Controllers\ResponseController;

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
            ResponseController::sendResponse(500, 'Bad DB Config!');
            //Exit if bad config
            exit();
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
            try{
                self::$db = new PDO(
                    'mysql:host='.self::$dbHost.';dbname='.self::$dbName,
                    self::$dbUser,
                    self::$dbPassword
                );
            }
            catch( PDOException $Exception ) {
                ResponseController::sendResponse(500, $Exception->getMessage());
                //Exit if Exception
                exit();
            }
        }

        return self::$db;
    }
}

