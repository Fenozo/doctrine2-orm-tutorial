<?php
namespace Framework;
use Interop\Http\Server\MiddlewareInterface;
use Interop\Http\Server\RequestHandlerInterface;
use Zend\Stdlib\ResponseInterface;


class ActionTestClass implements MiddlewareInterface
{
    public function __invoke(ServerRequestInterface $request)
    {
        return 'hello';
    }

//  implementation de Interop\Http\Server\MiddlewareInterface 
    
    public function process(\Psr\Http\Message\ServerRequestInterface $request, RequestHandlerInterface $handler) : ResponseInterface
    {
        
        return $handler->handle($request);
    }
}
