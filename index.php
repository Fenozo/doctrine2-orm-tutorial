<?php
require join(DIRECTORY_SEPARATOR,['config','bootstrap.php']);


use App\Entity\User;
use App\Blog\BlogModule;

$app        = new \Framework\App([
    BlogModule::class
]);

$response   = $app->run(\GuzzleHttp\Psr7\ServerRequest::fromGlobals());
\Http\Response\send($response);
