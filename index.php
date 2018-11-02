<?php
require join(DIRECTORY_SEPARATOR,['config','bootstrap.php']);
use App\Module\BlogModule;

use App\Entity\User;

$app        = new \Framework\App();

$response   = $app->run(\GuzzleHttp\Psr7\ServerRequest::fromGlobals());
\Http\Response\send($response);
