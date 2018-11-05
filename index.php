<?php
require join(DIRECTORY_SEPARATOR,['config','bootstrap.php']);

define('DS',DIRECTORY_SEPARATOR);

use App\Entity\User;
use App\Blog\BlogModule;
use Framework\Renderer;

$renderer =  new \Framework\Renderer\TwigRenderer(dirname(__FILE__) . DS .'views');

// $loader = new Twig_Loader_Filesystem(dirname(__DIR__).'/views');
// $twig = new Twig_Environment($loader,[]);

$app        = new \Framework\App([
    BlogModule::class
],[
    'renderer' => $renderer
]);


$response   = $app->run(\GuzzleHttp\Psr7\ServerRequest::fromGlobals());
\Http\Response\send($response);
