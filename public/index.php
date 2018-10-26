<?php

use App\Entity\User;
use GuzzleHttp\Psr7\ServerRequest;

require join(DIRECTORY_SEPARATOR, ['..', 'config', 'bootstrap.php']);
$app        = new \App\Application();
$response   = $app->run(ServerRequest::fromGlobals());
\Http\Response\send($response);
