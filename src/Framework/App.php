<?php

namespace Framework;

use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface;
use Framework\Router;

class App
{
    /**
     * List of modules
     * @var arrray
     */
    protected $modules;

    /**
     * Router
     * @var Router
     */
    private $router;

    /**
     * Application constructor
     *
     * @param string[] $modules La liste des modules à chargé.
     */
    public function __construct(array $modules = [], array $dependancies = [])
    {
        $this->router = new Router();

        if (array_key_exists('renderer',$dependancies )) {
            $dependancies['renderer']->addGlobal('router', $this->router);
        }
        if (!empty($modules)) {
            foreach ($modules as $module) {
                $this->modules[] = new $module($this->router, $dependancies['renderer']);
            }
        }
    }

    public function run(ServerRequestInterface $request): ResponseInterface
    {
        $uri = $request->getUri()->getPath();
        // PHP 7
        // si la longueur de $uri est supérieur à 1 dans (request_uri -1) qui a une valeur égale à 1
        if (!empty($uri) && strlen($uri)>1 &&  $uri[-1] === "/") {
            return  (new Response())
                        ->withStatus(301)
                        ->withHeader('Location', substr($uri, 0, -1));
        }

        $route =  $this->router->match($request);

        if (is_null($route)) {
            return new Response(404, [], '<h1>Error 404</h1>');
        }
        $params = $route->getParams();
        
        $request = array_reduce(array_keys($params), function ($request, $key) use ($params) {
            return $request->withAttribute($key, $params[$key]);
        }, $request);


        $response = call_user_func_array($route->getCallback(), [$request]);

        if (is_string($response)) {
            return new Response(200, [], $response);
        } elseif ($response instanceof ResponseInterface) {
            return $response;
        } else {
            throw new \Exception("The response is not string or instance of ResponseInterface");
        }
    }
}
