<?php

namespace Framework;

use Psr\Http\Message\ServerRequestInterface;
use Zend\Expressive\Router\FastRouteRouter;
use Zend\Expressive\Router\Route as ZendRoute;
use Framework\Router\Route;
use Framework\Router\MiddlewareApp;



/**
 * 
 */
class Router
{
    /**
     * @var instanceof Zend\Expressive\Router\Route
     */
    private $router;


    public function __construct()
    {
        $this->router = new FastRouteRouter();
        
    }

    /**
     * @param string $path
     * @param string $callcable
     * @param string $name
     */
    public function get(string $path, callable $callable, ?string $name) {
        $this->router->addRoute(new ZendRoute($path, new MiddlewareApp($callable), ['GET'],$name));

    }
    /**
     * @param ServerRequestInterface $request
     * @return Route|null
     */
    public function match(ServerRequestInterface $request) : ?Route {
        
        $result = $this->router->match($request);
        if ($result->isSuccess()) {

            return new Route(
                $result->getMatchedRouteName(),
                $result->getMatchedRoute()->getMiddleware()->getCallback(),
                $result->getMatchedParams()
            );
        }
        return null;
    }


}
