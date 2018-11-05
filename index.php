<?php
require join(DIRECTORY_SEPARATOR,['config','bootstrap.php']);

define('DS',DIRECTORY_SEPARATOR);

use App\Entity\User;
use App\Blog\BlogModule;
use Framework\Renderer;

$renderer = new Renderer();

$renderer->addPath(dirname(__FILE__) . DS .'views');

$app        = new \Framework\App([
    BlogModule::class
],[
    'renderer' => $renderer
]);

$response   = $app->run(\GuzzleHttp\Psr7\ServerRequest::fromGlobals());
\Http\Response\send($response);
