<?php

namespace Framework;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Psr7\Response;

class App
{
    protected $modules;
    /**
     * Application constructor
     * 
     * @param string[] $modules La liste des modules à chargé.
     */
    public function __construct(array $modules = null)
    {
        $router = new Router();

        if (!empty($modules)) {
            foreach ($modules as $module) {
                $this->modules[] = new $module($router);
            }
        }
        
    }

    public function run(ServerRequestInterface $request): ResponseInterface {
        $uri = $request->getUri()->getPath();
        // PHP 7
        // si la longueur de $uri est supérieur à 1 dans (request_uri -1) qui a une valeur égale à 1
        if(!empty($uri) && strlen($uri)>1 &&  $uri[-1] === "/") {
            return  (new Response())
                        ->withStatus(301)
                        ->withHeader('Location', substr($uri, 0 , -1));
        }

        if ($uri === '/blog') {
            return new Response(200,[],'<h1>Bienvenue sur le blog</h1>');
        }

        return new Response(404,[],'<h1>Error 404</h1>');
        
    }
}
