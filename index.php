<?php
require join(DIRECTORY_SEPARATOR,['config','bootstrap.php']);

define('DS',DIRECTORY_SEPARATOR);

use App\Entity\User;
use Framework\Renderer;

$modules = [

    \App\Blog\BlogModule::class

];


$builder = new \DI\ContainerBuilder();
$builder->addDefinitions(dirname(__FILE__). DS.'config'.DS.'config.php');

foreach($modules as $module) {
    if ($module::DEFINITIONS) {
        $builder->addDefinitions($module::DEFINITIONS);
        
    }
}

$builder->addDefinitions(dirname(__FILE__). DS.'config.php');

$container  = $builder->build();

$app        = new \Framework\App($container,$modules);

$response   = $app->run(\GuzzleHttp\Psr7\ServerRequest::fromGlobals());

\Http\Response\send($response);
