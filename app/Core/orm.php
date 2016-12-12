<?php
// bootstrap.php
require_once "../vendor/autoload.php";
require_once '../config/config.php';

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

class ORM {

    private static $paths = array("../app/Entities");
    private static $isDevMode = true;

    private static $_entityManager = null;

    //private blocks initializing through constructor
    private function __construct()
    {

    }

    //Singleton Pattern realisation
    static public function getEntityManager()
    {
        if (is_null(self::$_entityManager)) {
            $config = Setup::createAnnotationMetadataConfiguration(self::$paths, self::$isDevMode);

            $dbParams = array(
                'driver'   => 'pdo_mysql',
                'user'     => env("DB_USER"),
                'password' => env("DB_PASS"),
                'dbname'   => env("DB_NAME"),
            );

            self::$_entityManager = EntityManager::create($dbParams, $config);
        }
        return self::$_entityManager;
    }


}