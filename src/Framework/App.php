<?php

namespace Framework;

use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface;
use Framework\Router;
use Psr\Container\ContainerInterface;

class App
{
    /**
     * List of modules
     * @var arrray
     */
    protected $modules;

    /**
     * Container
     * 
     * @var ContainerInterface
     */
    private $container;

    /**
     * Application constructor
     *
     * @param ContainerInterface $container
     * @param string[] $modules La liste des modules à chargé.
     */
    public function __construct(ContainerInterface $container, array $modules = [])
    {
        $this->container = $container;
        if (!empty($modules)) {
            foreach ($modules as $module) {
                $this->modules[] = $container->get($module);
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

        $router =  $this->container->get(Router::class);

        $route =  $router->match($request);

        if (is_null($route)) {
            return new Response(404, [], '<h1>Error 404</h1>');
        }
        $params = $route->getParams();
        
        $request = array_reduce(array_keys($params), function ($request, $key) use ($params) {
            return $request->withAttribute($key, $params[$key]);
        }, $request);

        $callback = $route->getCallback();
        if (is_string($callback)) {
            $callback = $this->container->get($callback);
        }
        $response = call_user_func_array($this->container->get($route->getCallback()), [$request]);

        if (is_string($response)) {
            return new Response(200, [], $response);
        } elseif ($response instanceof ResponseInterface) {
            return $response;
        } else {
            throw new \Exception("The response is not string or instance of ResponseInterface");
        }
    }
}
