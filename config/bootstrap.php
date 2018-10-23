<?php
require_once join(DIRECTORY_SEPARATOR, [__DIR__,'..','vendor','autoload.php']); //"vendor/autoload.php"

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

// Create a simple "default" Doctrine ORM configuration for Annotation Mapping
$entitiesPath = array(join(DIRECTORY_SEPARATOR,[__DIR__,'..',"src","Entity"]));

$isDevMode  = false;
$proxyDir   = null;
$cache      = null;
$useSimpleAnnotationReader = false;

// Connexion à la base de données
$dbParams = array(
    'driver'        =>  'pdo_mysql',
    'host'          =>  'localhost',
    'charset'       =>  'utf8',
    'user'          =>  'root',
    'password'      =>  '',
    'dbname'        =>  'pool',
);

$config         =  Setup::createAnnotationMetadataConfiguration(
    $entitiesPath,
    $isDevMode,
    $proxyDir,
    $cache,
    $useSimpleAnnotationReader
);

$entityManager  = \Doctrine\ORM\EntityManager::create($dbParams, $config);
// obtaining the entity manager

return $entityManager;
